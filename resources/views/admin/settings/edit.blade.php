@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.setting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.settings.update", [$setting->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="central_hospital_mail">{{ trans('cruds.setting.fields.central_hospital_mail') }}</label>
                <input class="form-control {{ $errors->has('central_hospital_mail') ? 'is-invalid' : '' }}" type="text" name="central_hospital_mail" id="central_hospital_mail" value="{{ old('central_hospital_mail', $setting->central_hospital_mail) }}" required>
                @if($errors->has('central_hospital_mail'))
                    <div class="invalid-feedback">
                        {{ $errors->first('central_hospital_mail') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.central_hospital_mail_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="central_hospital_mail_cc">{{ trans('cruds.setting.fields.central_hospital_mail_cc') }}</label>
                <input class="form-control {{ $errors->has('central_hospital_mail_cc') ? 'is-invalid' : '' }}" type="text" name="central_hospital_mail_cc" id="central_hospital_mail_cc" value="{{ old('central_hospital_mail_cc', $setting->central_hospital_mail_cc) }}">
                @if($errors->has('central_hospital_mail_cc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('central_hospital_mail_cc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.central_hospital_mail_cc_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="central_hospital_mail_bcc">{{ trans('cruds.setting.fields.central_hospital_mail_bcc') }}</label>
                <input class="form-control {{ $errors->has('central_hospital_mail_bcc') ? 'is-invalid' : '' }}" type="text" name="central_hospital_mail_bcc" id="central_hospital_mail_bcc" value="{{ old('central_hospital_mail_bcc', $setting->central_hospital_mail_bcc) }}">
                @if($errors->has('central_hospital_mail_bcc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('central_hospital_mail_bcc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.central_hospital_mail_bcc_helper') }}</span>
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