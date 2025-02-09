<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAmenityReservationRequest;
use App\Http\Requests\StoreAmenityReservationRequest;
use App\Http\Requests\UpdateAmenityReservationRequest;
use App\Models\Amenity;
use App\Models\AmenityReservation;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AmenityReservationsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('amenity_reservation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AmenityReservation::with(['amenity', 'user'])->select(sprintf('%s.*', (new AmenityReservation)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'amenity_reservation_show';
                $editGate      = 'amenity_reservation_edit';
                $deleteGate    = 'amenity_reservation_delete';
                $crudRoutePart = 'amenity-reservations';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('amenity_name', function ($row) {
                return $row->amenity ? $row->amenity->name : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('user.email', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->email) : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? AmenityReservation::STATUS_RADIO[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'amenity', 'user']);

            return $table->make(true);
        }

        return view('admin.amenityReservations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('amenity_reservation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $amenities = Amenity::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.amenityReservations.create', compact('amenities', 'users'));
    }

    public function store(StoreAmenityReservationRequest $request)
    {
        $amenityReservation = AmenityReservation::create($request->all());

        return redirect()->route('admin.amenity-reservations.index');
    }

    public function edit(AmenityReservation $amenityReservation)
    {
        abort_if(Gate::denies('amenity_reservation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $amenities = Amenity::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $amenityReservation->load('amenity', 'user');

        return view('admin.amenityReservations.edit', compact('amenities', 'amenityReservation', 'users'));
    }

    public function update(UpdateAmenityReservationRequest $request, AmenityReservation $amenityReservation)
    {
        $amenityReservation->update($request->all());

        return redirect()->route('admin.amenity-reservations.index');
    }

    public function show(AmenityReservation $amenityReservation)
    {
        abort_if(Gate::denies('amenity_reservation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $amenityReservation->load('amenity', 'user');

        return view('admin.amenityReservations.show', compact('amenityReservation'));
    }

    public function destroy(AmenityReservation $amenityReservation)
    {
        abort_if(Gate::denies('amenity_reservation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $amenityReservation->delete();

        return back();
    }

    public function massDestroy(MassDestroyAmenityReservationRequest $request)
    {
        $amenityReservations = AmenityReservation::find(request('ids'));

        foreach ($amenityReservations as $amenityReservation) {
            $amenityReservation->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
