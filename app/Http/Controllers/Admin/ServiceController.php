<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyServiceRequest;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use App\Models\ServiceProvider;
use App\Models\ServiceSchedule;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = Service::with(['service_providers', 'team', 'media'])->get();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        abort_if(Gate::denies('service_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $service=new Service;

        $service_providers = ServiceProvider::pluck('name', 'id');
        // same as:
        // $service_providers = ServiceProvider::all();
        // $service_providers = new ServiceProvider;
        
        return view('admin.services.create', compact('service', 'service_providers'));
    }

    public function store(StoreServiceRequest $request)
    {
        $service = Service::create($request->all());
        $service->service_providers()->sync($request->input('service_providers', []));
        
        // $data->addNew($request->all(), $service->id, $service->team_id, "add");
        $monday_schedule = ServiceSchedule::create([
                'service_id' => $service->id,
                'team_id' => $service->team_id,
                'day_of_week' => 1,
                'start_time' => $request->input('monday_start'),
                'end_time' => $request->input('monday_end'),
            ]);
            if( $request->has('monday') ) {
                $monday_schedule->update([
                    'is_open' => 1,
                ]);
            }
            else {
                $monday_schedule->update([
                    'is_open' => 0,
                ]);
            }
        
        $tuesday_schedule = ServiceSchedule::create([
                'service_id' => $service->id,
                'team_id' => $service->team_id,
                'day_of_week' => 2,
                'start_time' => $request->input('tuesday_start'),
                'end_time' => $request->input('tuesday_end'),
            ]);
            if( $request->has('tuesday') ) {
                $tuesday_schedule->update([
                    'is_open' => 1,
                ]);
            }
            else {
                $tuesday_schedule->update([
                    'is_open' => 0,
                ]);
            }

        if ($request->input('service_image', false)) {
            $service->addMedia(storage_path('tmp/uploads/' . basename($request->input('service_image'))))->toMediaCollection('service_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $service->id]);
        }

        return redirect()->route('admin.services.index');
    }

    public function edit(Service $service)
    {
        abort_if(Gate::denies('service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $service_providers = ServiceProvider::pluck('name', 'id');

        $service->load('service_providers', 'team');

        $service_schedules = ServiceSchedule::where('service_id', $service->id)->where('team_id', $service->team_id)->get();
        $monday=$service_schedules->where('day_of_week', 1)->first();
        $tuesday=$service_schedules->where('day_of_week', 2)->first();
        $wednesday=$service_schedules->where('day_of_week', 3)->first();
        $thursday=$service_schedules->where('day_of_week', 4)->first();
        $friday=$service_schedules->where('day_of_week', 5)->first();
        $saturday=$service_schedules->where('day_of_week', 6)->first();
        $sunday=$service_schedules->where('day_of_week', 7)->first();
        // dd($service_schedules);

        return view('admin.services.edit', compact('service', 'service_providers', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'));
    }

    public function update(UpdateServiceRequest $request, Service $service, ServiceSchedule $schedule)
    {
        $service->update($request->all());
        $service->service_providers()->sync($request->input('service_providers', []));

        $monday_schedule = ServiceSchedule::where('service_id', $service->id)->where('team_id', $service->team_id)->where('day_of_week', 1)->first();
        $monday_schedule->update([
            'start_time' => $request->input('monday_start'),
            'end_time' => $request->input('monday_end'),
        ]);
        if( $request->has('monday') ) {
            $monday_schedule->update([
                'is_open' => 1,
            ]);
        }
        else {
            $monday_schedule->update([
                'is_open' => 0,
            ]);
        }

        $tuesday_schedule = ServiceSchedule::where('service_id', $service->id)->where('team_id', $service->team_id)->where('day_of_week', 2)->first();
        $tuesday_schedule->update([
            'start_time' => $request->input('tuesday_start'),
            'end_time' => $request->input('tuesday_end'),
        ]);
        if( $request->has('tuesday') ) {
            $tuesday_schedule->update([
                'is_open' => 1,
            ]);
        }
        else {
            $tuesday_schedule->update([
                'is_open' => 0,
            ]);
        }

        
        if ($request->input('service_image', false)) {
            if (!$service->service_image || $request->input('service_image') !== $service->service_image->file_name) {
                if ($service->service_image) {
                    $service->service_image->delete();
                }
                $service->addMedia(storage_path('tmp/uploads/' . basename($request->input('service_image'))))->toMediaCollection('service_image');
            }
        } elseif ($service->service_image) {
            $service->service_image->delete();
        }

        return redirect()->route('admin.services.index');
    }

    public function show(Service $service)
    {
        
    }

    public function destroy(Service $service)
    {
        abort_if(Gate::denies('service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $service->delete();

        return back();
    }

    public function massDestroy(MassDestroyServiceRequest $request)
    {
        Service::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('service_create') && Gate::denies('service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Service();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
