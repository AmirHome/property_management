<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBuildingRequest;
use App\Http\Requests\UpdateBuildingRequest;
use App\Http\Resources\Admin\BuildingResource;
use App\Models\Building;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BuildingsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('building_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BuildingResource(Building::with(['team'])->get());
    }

    public function store(StoreBuildingRequest $request)
    {
        $building = Building::create($request->all());

        return (new BuildingResource($building))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Building $building)
    {
        abort_if(Gate::denies('building_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BuildingResource($building->load(['team']));
    }

    public function update(UpdateBuildingRequest $request, Building $building)
    {
        $building->update($request->all());

        return (new BuildingResource($building))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Building $building)
    {
        abort_if(Gate::denies('building_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $building->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
