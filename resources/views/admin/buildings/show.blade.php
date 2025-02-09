@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.building.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.buildings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.building.fields.id') }}
                        </th>
                        <td>
                            {{ $building->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.building.fields.name') }}
                        </th>
                        <td>
                            {{ $building->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.building.fields.address') }}
                        </th>
                        <td>
                            {{ $building->address }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.buildings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#building_units" role="tab" data-toggle="tab">
                {{ trans('cruds.unit.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#building_amenities" role="tab" data-toggle="tab">
                {{ trans('cruds.amenity.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="building_units">
            @includeIf('admin.buildings.relationships.buildingUnits', ['units' => $building->buildingUnits])
        </div>
        <div class="tab-pane" role="tabpanel" id="building_amenities">
            @includeIf('admin.buildings.relationships.buildingAmenities', ['amenities' => $building->buildingAmenities])
        </div>
    </div>
</div>

@endsection