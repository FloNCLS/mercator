@extends('layouts.admin')
@section('content')

<form method="POST" action="{{ route("admin.storage-devices.store") }}" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.storageDevice.title_singular') }}
        </div>
        <div class="card-body">
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.storageDevice.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.storageDevice.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.storageDevice.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.storageDevice.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="recommended" for="maturity">{{ trans('cruds.maturity.maturity') }}</label>
                <input class="form-control {{ $errors->has('maturity') ? 'is-invalid' : '' }}" type="number" min="0" max="5" name="maturity" id="maturity" value="{{ old('maturity', '') }}">
                @if($errors->has('maturity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('maturity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.maturity.maturity_helper') }}</span>
            </div>
        </div>
        <!---------------------------------------------------------------------------------------------------->
        <div class="card-header">
            {{ trans("cruds.menu.physical_infrastructure.title_short") }}
        </div>
        <!---------------------------------------------------------------------------------------------------->
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="site_id">{{ trans('cruds.storageDevice.fields.site') }}</label>
                        <select class="form-control select2 {{ $errors->has('site') ? 'is-invalid' : '' }}" name="site_id" id="site_id">
                            @foreach($sites as $id => $site)
                                <option value="{{ $id }}" {{ old('site_id') == $id ? 'selected' : '' }}>{{ $site }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('site'))
                            <div class="invalid-feedback">
                                {{ $errors->first('site') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.storageDevice.fields.site_helper') }}</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="building_id">{{ trans('cruds.storageDevice.fields.building') }}</label>
                        <select class="form-control select2 {{ $errors->has('building') ? 'is-invalid' : '' }}" name="building_id" id="building_id">
                            @foreach($buildings as $id => $building)
                                <option value="{{ $id }}" {{ old('building_id') == $id ? 'selected' : '' }}>{{ $building }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('building'))
                            <div class="invalid-feedback">
                                {{ $errors->first('building') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.storageDevice.fields.building_helper') }}</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="bay_id">{{ trans('cruds.storageDevice.fields.bay') }}</label>
                        <select class="form-control select2 {{ $errors->has('bay') ? 'is-invalid' : '' }}" name="bay_id" id="bay_id">
                            @foreach($bays as $id => $bay)
                                <option value="{{ $id }}" {{ old('bay_id') == $id ? 'selected' : '' }}>{{ $bay }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('bay'))
                            <div class="invalid-feedback">
                                {{ $errors->first('bay') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.storageDevice.fields.bay_helper') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-danger" type="submit">
            {{ trans('global.save') }}
        </button>
    </div>
</form>
@endsection

@section('scripts')
<script>
$(document).ready(function () {

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: []
      }
    );
  }

  $(".select2-free").select2({
        placeholder: "{{ trans('global.pleaseSelect') }}",
        allowClear: true,
        tags: true
    })

});
</script>
@endsection
