@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.amenityReservation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.amenity-reservations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.amenityReservation.fields.id') }}
                        </th>
                        <td>
                            {{ $amenityReservation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenityReservation.fields.amenity') }}
                        </th>
                        <td>
                            {{ $amenityReservation->amenity->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenityReservation.fields.user') }}
                        </th>
                        <td>
                            {{ $amenityReservation->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenityReservation.fields.start') }}
                        </th>
                        <td>
                            {{ $amenityReservation->start }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenityReservation.fields.end') }}
                        </th>
                        <td>
                            {{ $amenityReservation->end }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenityReservation.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\AmenityReservation::STATUS_RADIO[$amenityReservation->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.amenity-reservations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection