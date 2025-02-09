@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.unit.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.units.update", [$unit->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="building_id">{{ trans('cruds.unit.fields.building') }}</label>
                <select class="form-control select2 {{ $errors->has('building') ? 'is-invalid' : '' }}" name="building_id" id="building_id" required>
                    @foreach($buildings as $id => $entry)
                        <option value="{{ $id }}" {{ (old('building_id') ? old('building_id') : $unit->building->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('building'))
                    <div class="invalid-feedback">
                        {{ $errors->first('building') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.unit.fields.building_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="unit_number">{{ trans('cruds.unit.fields.unit_number') }}</label>
                <input class="form-control {{ $errors->has('unit_number') ? 'is-invalid' : '' }}" type="text" name="unit_number" id="unit_number" value="{{ old('unit_number', $unit->unit_number) }}">
                @if($errors->has('unit_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('unit_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.unit.fields.unit_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="landlord_id">{{ trans('cruds.unit.fields.landlord') }}</label>
                <select class="form-control select2 {{ $errors->has('landlord') ? 'is-invalid' : '' }}" name="landlord_id" id="landlord_id" required>
                    @foreach($landlords as $id => $entry)
                        <option value="{{ $id }}" {{ (old('landlord_id') ? old('landlord_id') : $unit->landlord->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('landlord'))
                    <div class="invalid-feedback">
                        {{ $errors->first('landlord') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.unit.fields.landlord_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tenant_id">{{ trans('cruds.unit.fields.tenant') }}</label>
                <select class="form-control select2 {{ $errors->has('tenant') ? 'is-invalid' : '' }}" name="tenant_id" id="tenant_id">
                    @foreach($tenants as $id => $entry)
                        <option value="{{ $id }}" {{ (old('tenant_id') ? old('tenant_id') : $unit->tenant->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('tenant'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tenant') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.unit.fields.tenant_helper') }}</span>
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