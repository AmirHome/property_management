<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMaintenanceRequestRequest;
use App\Http\Requests\UpdateMaintenanceRequestRequest;
use App\Http\Resources\Admin\MaintenanceRequestResource;
use App\Models\MaintenanceRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceRequestsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('maintenance_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MaintenanceRequestResource(MaintenanceRequest::with(['unit', 'user', 'team'])->get());
    }

    public function store(StoreMaintenanceRequestRequest $request)
    {
        $maintenanceRequest = MaintenanceRequest::create($request->all());

        return (new MaintenanceRequestResource($maintenanceRequest))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MaintenanceRequest $maintenanceRequest)
    {
        abort_if(Gate::denies('maintenance_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MaintenanceRequestResource($maintenanceRequest->load(['unit', 'user', 'team']));
    }

    public function update(UpdateMaintenanceRequestRequest $request, MaintenanceRequest $maintenanceRequest)
    {
        $maintenanceRequest->update($request->all());

        return (new MaintenanceRequestResource($maintenanceRequest))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MaintenanceRequest $maintenanceRequest)
    {
        abort_if(Gate::denies('maintenance_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintenanceRequest->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
