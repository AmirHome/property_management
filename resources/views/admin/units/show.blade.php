@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.unit.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.units.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.id') }}
                        </th>
                        <td>
                            {{ $unit->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.building') }}
                        </th>
                        <td>
                            {{ $unit->building->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.unit_number') }}
                        </th>
                        <td>
                            {{ $unit->unit_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.landlord') }}
                        </th>
                        <td>
                            {{ $unit->landlord->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.tenant') }}
                        </th>
                        <td>
                            {{ $unit->tenant->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.units.index') }}">
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
            <a class="nav-link" href="#unit_contracts" role="tab" data-toggle="tab">
                {{ trans('cruds.contract.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#unit_maintenance_requests" role="tab" data-toggle="tab">
                {{ trans('cruds.maintenanceRequest.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="unit_contracts">
            @includeIf('admin.units.relationships.unitContracts', ['contracts' => $unit->unitContracts])
        </div>
        <div class="tab-pane" role="tabpanel" id="unit_maintenance_requests">
            @includeIf('admin.units.relationships.unitMaintenanceRequests', ['maintenanceRequests' => $unit->unitMaintenanceRequests])
        </div>
    </div>
</div>

@endsection