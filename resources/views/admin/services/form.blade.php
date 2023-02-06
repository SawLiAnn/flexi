<div class="form-group">
    <label class="required" for="service_name">{{ trans('cruds.service.fields.service_name') }}</label>
    <input class="form-control {{ $errors->has('service_name') ? 'is-invalid' : '' }}" type="text" name="service_name"
        id="service_name" value="{{ old('service_name', $service->service_name) }}" required>
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
        name="service_description" id="service_description"
        value="{{ old('service_description', $service->service_description) }}">
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
    <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price"
        value="{{ old('price', $service->price) }}" step="0.01">
    @if($errors->has('price'))
    <div class="invalid-feedback">
        {{ $errors->first('price') }}
    </div>
    @endif
    <span class="help-block">{{ trans('cruds.service.fields.price_helper') }}</span>
</div>
<div class="form-group">
    <label class="required" for="duration">{{ trans('cruds.service.fields.duration') }}</label>
    <input class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}" type="number" name="duration"
        id="duration" value="{{ old('duration', $service->duration) }}" step="1" required>
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
        <option value="{{ $id }}" {{ (in_array($id, old('service_providers', [])) || $service->
            service_providers->contains($id)) ? 'selected' : '' }}>{{
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
                @if($monday->is_open == 1 || $monday->is_open == null) checked @endif>
            <label class="custom-control-label" for="customSwitch1">Monday</label>
        </div>
    </div>
    <div class="form-group col-md-4">
        <label class="required" for="monday_start">Start Time</label>
        <input class="form-control timepicker {{ $errors->has('monday_start') ? 'is-invalid' : '' }}" type="text"
            name="monday_start" id="monday_start" value="{{ old('monday_start', $monday->start_time) }}" required>
        @if($errors->has('monday_start'))
        <div class="invalid-feedback">
            {{ $errors->first('monday_start') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.serviceSchedule.fields.start_time_helper') }}</span>
    </div>
    <div class="form-group col-md-4">
        <label class="required" for="monday_end">End Time</label>
        <input class="form-control timepicker {{ $errors->has('monday_end') ? 'is-invalid' : '' }}" type="text"
            name="monday_end" id="monday_end" value="{{ old('monday_end') }}" required>
        @if($errors->has('monday_end'))
        <div class="invalid-feedback">
            {{ $errors->first('monday_end') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.serviceSchedule.fields.end_time_helper') }}</span>
    </div>
</div>


{{-- <div class="form-row">
    <div class="form-group col-md-1 pt-4">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="customSwitch2" value="2" name="tuesday" checked>
            <label class="custom-control-label" for="customSwitch2">Tuesday</label>
        </div>
    </div>
    <div class="form-group col-md-4">
        <label class="required" for="start_time">Start Time</label>
        <input class="form-control timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text"
            name="start_time" id="start_time" value="{{ old('start_time') }}" required>
        @if($errors->has('start_time'))
        <div class="invalid-feedback">
            {{ $errors->first('start_time') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.serviceSchedule.fields.start_time_helper') }}</span>
    </div>
    <div class="form-group col-md-4">
        <label class="required" for="end_time">End Time</label>
        <input class="form-control timepicker {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="text"
            name="end_time" id="end_time" value="{{ old('end_time') }}" required>
        @if($errors->has('end_time'))
        <div class="invalid-feedback">
            {{ $errors->first('end_time') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.serviceSchedule.fields.end_time_helper') }}</span>
    </div>
</div> --}}
<div class="form-group">
    <button class="btn btn-danger" type="submit">
        {{ trans('global.save') }}
    </button>
</div>