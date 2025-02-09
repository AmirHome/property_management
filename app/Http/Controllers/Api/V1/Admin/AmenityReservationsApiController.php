<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAmenityReservationRequest;
use App\Http\Requests\UpdateAmenityReservationRequest;
use App\Http\Resources\Admin\AmenityReservationResource;
use App\Models\AmenityReservation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AmenityReservationsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('amenity_reservation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AmenityReservationResource(AmenityReservation::with(['amenity', 'user'])->get());
    }

    public function store(StoreAmenityReservationRequest $request)
    {
        $amenityReservation = AmenityReservation::create($request->all());

        return (new AmenityReservationResource($amenityReservation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AmenityReservation $amenityReservation)
    {
        abort_if(Gate::denies('amenity_reservation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AmenityReservationResource($amenityReservation->load(['amenity', 'user']));
    }

    public function update(UpdateAmenityReservationRequest $request, AmenityReservation $amenityReservation)
    {
        $amenityReservation->update($request->all());

        return (new AmenityReservationResource($amenityReservation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AmenityReservation $amenityReservation)
    {
        abort_if(Gate::denies('amenity_reservation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $amenityReservation->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
