@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.maintenanceRequest.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.maintenance-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.maintenanceRequest.fields.id') }}
                        </th>
                        <td>
                            {{ $maintenanceRequest->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.maintenanceRequest.fields.unit') }}
                        </th>
                        <td>
                            {{ $maintenanceRequest->unit->unit_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.maintenanceRequest.fields.user') }}
                        </th>
                        <td>
                            {{ $maintenanceRequest->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.maintenanceRequest.fields.description') }}
                        </th>
                        <td>
                            {{ $maintenanceRequest->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.maintenanceRequest.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\MaintenanceRequest::STATUS_RADIO[$maintenanceRequest->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.maintenanceRequest.fields.priority') }}
                        </th>
                        <td>
                            {{ App\Models\MaintenanceRequest::PRIORITY_RADIO[$maintenanceRequest->priority] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.maintenance-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection