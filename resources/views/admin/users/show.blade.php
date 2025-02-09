@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.phone') }}
                        </th>
                        <td>
                            {{ $user->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.picture') }}
                        </th>
                        <td>
                            @if($user->picture)
                                <a href="{{ $user->picture->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $user->picture->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
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
            <a class="nav-link" href="#user_crm_customers" role="tab" data-toggle="tab">
                {{ trans('cruds.crmCustomer.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_crm_documents" role="tab" data-toggle="tab">
                {{ trans('cruds.crmDocument.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_tasks" role="tab" data-toggle="tab">
                {{ trans('cruds.task.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#owner_teams" role="tab" data-toggle="tab">
                {{ trans('cruds.team.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#landlord_units" role="tab" data-toggle="tab">
                {{ trans('cruds.unit.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#tenant_units" role="tab" data-toggle="tab">
                {{ trans('cruds.unit.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#tenant_contracts" role="tab" data-toggle="tab">
                {{ trans('cruds.contract.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_maintenance_requests" role="tab" data-toggle="tab">
                {{ trans('cruds.maintenanceRequest.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_amenity_reservations" role="tab" data-toggle="tab">
                {{ trans('cruds.amenityReservation.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_alerts" role="tab" data-toggle="tab">
                {{ trans('cruds.userAlert.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="user_crm_customers">
            @includeIf('admin.users.relationships.userCrmCustomers', ['crmCustomers' => $user->userCrmCustomers])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_crm_documents">
            @includeIf('admin.users.relationships.userCrmDocuments', ['crmDocuments' => $user->userCrmDocuments])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_tasks">
            @includeIf('admin.users.relationships.userTasks', ['tasks' => $user->userTasks])
        </div>
        <div class="tab-pane" role="tabpanel" id="owner_teams">
            @includeIf('admin.users.relationships.ownerTeams', ['teams' => $user->ownerTeams])
        </div>
        <div class="tab-pane" role="tabpanel" id="landlord_units">
            @includeIf('admin.users.relationships.landlordUnits', ['units' => $user->landlordUnits])
        </div>
        <div class="tab-pane" role="tabpanel" id="tenant_units">
            @includeIf('admin.users.relationships.tenantUnits', ['units' => $user->tenantUnits])
        </div>
        <div class="tab-pane" role="tabpanel" id="tenant_contracts">
            @includeIf('admin.users.relationships.tenantContracts', ['contracts' => $user->tenantContracts])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_maintenance_requests">
            @includeIf('admin.users.relationships.userMaintenanceRequests', ['maintenanceRequests' => $user->userMaintenanceRequests])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_amenity_reservations">
            @includeIf('admin.users.relationships.userAmenityReservations', ['amenityReservations' => $user->userAmenityReservations])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_alerts">
            @includeIf('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])
        </div>
    </div>
</div>

@endsection