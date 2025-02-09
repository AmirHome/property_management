<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUnitRequest;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Models\Building;
use App\Models\Unit;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UnitsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('unit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Unit::with(['building', 'landlord', 'tenant'])->select(sprintf('%s.*', (new Unit)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'unit_show';
                $editGate      = 'unit_edit';
                $deleteGate    = 'unit_delete';
                $crudRoutePart = 'units';

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

            $table->editColumn('unit_number', function ($row) {
                return $row->unit_number ? $row->unit_number : '';
            });
            $table->addColumn('landlord_name', function ($row) {
                return $row->landlord ? $row->landlord->name : '';
            });

            $table->editColumn('landlord.email', function ($row) {
                return $row->landlord ? (is_string($row->landlord) ? $row->landlord : $row->landlord->email) : '';
            });
            $table->addColumn('tenant_name', function ($row) {
                return $row->tenant ? $row->tenant->name : '';
            });

            $table->editColumn('tenant.email', function ($row) {
                return $row->tenant ? (is_string($row->tenant) ? $row->tenant : $row->tenant->email) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'building', 'landlord', 'tenant']);

            return $table->make(true);
        }

        return view('admin.units.index');
    }

    public function create()
    {
        abort_if(Gate::denies('unit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $buildings = Building::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $landlords = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tenants = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.units.create', compact('buildings', 'landlords', 'tenants'));
    }

    public function store(StoreUnitRequest $request)
    {
        $unit = Unit::create($request->all());

        return redirect()->route('admin.units.index');
    }

    public function edit(Unit $unit)
    {
        abort_if(Gate::denies('unit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $buildings = Building::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $landlords = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tenants = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $unit->load('building', 'landlord', 'tenant');

        return view('admin.units.edit', compact('buildings', 'landlords', 'tenants', 'unit'));
    }

    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $unit->update($request->all());

        return redirect()->route('admin.units.index');
    }

    public function show(Unit $unit)
    {
        abort_if(Gate::denies('unit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unit->load('building', 'landlord', 'tenant', 'unitContracts', 'unitMaintenanceRequests');

        return view('admin.units.show', compact('unit'));
    }

    public function destroy(Unit $unit)
    {
        abort_if(Gate::denies('unit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unit->delete();

        return back();
    }

    public function massDestroy(MassDestroyUnitRequest $request)
    {
        $units = Unit::find(request('ids'));

        foreach ($units as $unit) {
            $unit->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
