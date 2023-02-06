@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.service.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
            @csrf
            {{-- @include('admin.services.form') --}}
            <div class="form-group">
                <div class="form-check {{ $errors->has('visibility') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="visibility" value="0">
                    <input class="form-check-input" type="checkbox" name="visibility" id="visibility" value="1" {{
                        old('visibility', 0)==1 || old('visibility')===null ? 'checked' : '' }}>
                    <label class="form-check-label" for="visibility">Visible on site</label>
                </div>
                @if($errors->has('visibility'))
                <div class="invalid-feedback">
                    {{ $errors->first('visibility') }}
                </div>
                @endif
                {{-- <span class="help-block">Visibility</span> --}}
            </div>
            <div class="form-group">
                <label class="required" for="service_name">{{ trans('cruds.service.fields.service_name') }}</label>
                <input class="form-control {{ $errors->has('service_name') ? 'is-invalid' : '' }}" type="text"
                    name="service_name" id="service_name" value="{{ old('service_name', '') }}" required>
                @if($errors->has('service_name'))
                <div class="invalid-feedback">
                    {{ $errors->first('service_name') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.service.fields.service_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="service_description">{{ trans('cruds.service.fields.service_description') }}</label>
                <input class="form-control {{ $errors->has('service_description') ? 'is-invalid' : '' }}" type="text"
                    name="service_description" id="service_description" value="{{ old('service_description', '') }}">
                @if($errors->has('service_description'))
                <div class="invalid-feedback">
                    {{ $errors->first('service_description') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.service.fields.service_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="service_image">{{ trans('cruds.service.fields.service_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('service_image') ? 'is-invalid' : '' }}"
                    id="service_image-dropzone">
                </div>
                @if($errors->has('service_image'))
                <div class="invalid-feedback">
                    {{ $errors->first('service_image') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.service.fields.service_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price">{{ trans('cruds.service.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price"
                    id="price" value="{{ old('price', '') }}" step="0.01">
                @if($errors->has('price'))
                <div class="invalid-feedback">
                    {{ $errors->first('price') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.service.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="duration">{{ trans('cruds.service.fields.duration') }}</label>
                <input class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}" type="number"
                    name="duration" id="duration" value="{{ old('duration', '') }}" step="1" required>
                @if($errors->has('duration'))
                <div class="invalid-feedback">
                    {{ $errors->first('duration') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.service.fields.duration_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="service_providers">{{ trans('cruds.service.fields.service_provider') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all')
                        }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{
                        trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('service_providers') ? 'is-invalid' : '' }}"
                    name="service_providers[]" id="service_providers" multiple>
                    @foreach($service_providers as $id => $service_provider)
                    <option value="{{ $id }}" {{ in_array($id, old('service_providers', [])) ? 'selected' : '' }}>{{
                        $service_provider }}</option>
                    @endforeach
                </select>
                @if($errors->has('service_providers'))
                <div class="invalid-feedback">
                    {{ $errors->first('service_providers') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.service.fields.service_provider_helper') }}</span>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1 pt-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch1" value="1" name="monday"
                            checked>
                        <label class="custom-control-label" for="customSwitch1">Monday</label>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="monday_start">Start Time</label>
                    <input class="form-control timepicker {{ $errors->has('monday_start') ? 'is-invalid' : '' }}"
                        type="text" name="monday_start" id="monday_start" value="{{ old('monday_start') }}" required>
                    @if($errors->has('monday_start'))
                    <div class="invalid-feedback">
                        {{ $errors->first('monday_start') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.serviceSchedule.fields.start_time_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="monday_end">End Time</label>
                    <input class="form-control timepicker {{ $errors->has('monday_end') ? 'is-invalid' : '' }}"
                        type="text" name="monday_end" id="monday_end" value="{{ old('monday_end') }}" required>
                    @if($errors->has('monday_end'))
                    <div class="invalid-feedback">
                        {{ $errors->first('monday_end') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.serviceSchedule.fields.end_time_helper') }}</span>
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-1 pt-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch2" value="2" name="tuesday"
                            checked>
                        <label class="custom-control-label" for="customSwitch2">Tuesday</label>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="tuesday_start">Start Time</label>
                    <input class="form-control timepicker {{ $errors->has('tuesday_start') ? 'is-invalid' : '' }}"
                        type="text" name="tuesday_start" id="tuesday_start" value="{{ old('tuesday_start') }}" required>
                    @if($errors->has('tuesday_start'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tuesday_start') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.serviceSchedule.fields.start_time_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="tuesday_end">End Time</label>
                    <input class="form-control timepicker {{ $errors->has('tuesday_end') ? 'is-invalid' : '' }}"
                        type="text" name="tuesday_end" id="tuesday_end" value="{{ old('tuesday_end') }}" required>
                    @if($errors->has('tuesday_end'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tuesday_end') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.serviceSchedule.fields.end_time_helper') }}</span>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.serviceImageDropzone = {
    url: '{{ route('admin.services.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="service_image"]').remove()
      $('form').append('<input type="hidden" name="service_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="service_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($service) && $service->service_image)
      var file = {!! json_encode($service->service_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="service_image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection