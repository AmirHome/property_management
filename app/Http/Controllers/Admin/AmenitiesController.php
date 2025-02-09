<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAmenityRequest;
use App\Http\Requests\StoreAmenityRequest;
use App\Http\Requests\UpdateAmenityRequest;
use App\Models\Amenity;
use App\Models\Building;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AmenitiesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('amenity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Amenity::with(['building', 'team'])->select(sprintf('%s.*', (new Amenity)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'amenity_show';
                $editGate      = 'amenity_edit';
                $deleteGate    = 'amenity_delete';
                $crudRoutePart = 'amenities';

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
            $table->addColumn('building_name', function ($row) {
                return $row->building ? $row->building->name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'building']);

            return $table->make(true);
        }

        return view('admin.amenities.index');
    }

    public function create()
    {
        abort_if(Gate::denies('amenity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $buildings = Building::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.amenities.create', compact('buildings'));
    }

    public function store(StoreAmenityRequest $request)
    {
        $amenity = Amenity::create($request->all());

        return redirect()->route('admin.amenities.index');
    }

    public function edit(Amenity $amenity)
    {
        abort_if(Gate::denies('amenity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $buildings = Building::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $amenity->load('building', 'team');

        return view('admin.amenities.edit', compact('amenity', 'buildings'));
    }

    public function update(UpdateAmenityRequest $request, Amenity $amenity)
    {
        $amenity->update($request->all());

        return redirect()->route('admin.amenities.index');
    }

    public function show(Amenity $amenity)
    {
        abort_if(Gate::denies('amenity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $amenity->load('building', 'team', 'amenityAmenityReservations');

        return view('admin.amenities.show', compact('amenity'));
    }

    public function destroy(Amenity $amenity)
    {
        abort_if(Gate::denies('amenity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $amenity->delete();

        return back();
    }

    public function massDestroy(MassDestroyAmenityRequest $request)
    {
        $amenities = Amenity::find(request('ids'));

        foreach ($amenities as $amenity) {
            $amenity->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
