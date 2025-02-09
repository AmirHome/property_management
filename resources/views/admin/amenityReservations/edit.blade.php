@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.amenityReservation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.amenity-reservations.update", [$amenityReservation->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="amenity_id">{{ trans('cruds.amenityReservation.fields.amenity') }}</label>
                <select class="form-control select2 {{ $errors->has('amenity') ? 'is-invalid' : '' }}" name="amenity_id" id="amenity_id" required>
                    @foreach($amenities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('amenity_id') ? old('amenity_id') : $amenityReservation->amenity->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('amenity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amenity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.amenityReservation.fields.amenity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.amenityReservation.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $amenityReservation->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.amenityReservation.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start">{{ trans('cruds.amenityReservation.fields.start') }}</label>
                <input class="form-control datetime {{ $errors->has('start') ? 'is-invalid' : '' }}" type="text" name="start" id="start" value="{{ old('start', $amenityReservation->start) }}">
                @if($errors->has('start'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.amenityReservation.fields.start_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end">{{ trans('cruds.amenityReservation.fields.end') }}</label>
                <input class="form-control datetime {{ $errors->has('end') ? 'is-invalid' : '' }}" type="text" name="end" id="end" value="{{ old('end', $amenityReservation->end) }}" required>
                @if($errors->has('end'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.amenityReservation.fields.end_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.amenityReservation.fields.status') }}</label>
                @foreach(App\Models\AmenityReservation::STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', $amenityReservation->status) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.amenityReservation.fields.status_helper') }}</span>
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