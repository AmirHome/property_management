<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMaintenanceRequestRequest;
use App\Http\Requests\StoreMaintenanceRequestRequest;
use App\Http\Requests\UpdateMaintenanceRequestRequest;
use App\Models\MaintenanceRequest;
use App\Models\Unit;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MaintenanceRequestsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('maintenance_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MaintenanceRequest::with(['unit', 'user', 'team'])->select(sprintf('%s.*', (new MaintenanceRequest)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'maintenance_request_show';
                $editGate      = 'maintenance_request_edit';
                $deleteGate    = 'maintenance_request_delete';
                $crudRoutePart = 'maintenance-requests';

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
            $table->addColumn('unit_unit_number', function ($row) {
                return $row->unit ? $row->unit->unit_number : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('user.email', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->email) : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? MaintenanceRequest::STATUS_RADIO[$row->status] : '';
            });
            $table->editColumn('priority', function ($row) {
                return $row->priority ? MaintenanceRequest::PRIORITY_RADIO[$row->priority] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'unit', 'user']);

            return $table->make(true);
        }

        return view('admin.maintenanceRequests.index');
    }

    public function create()
    {
        abort_if(Gate::denies('maintenance_request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = Unit::pluck('unit_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.maintenanceRequests.create', compact('units', 'users'));
    }

    public function store(StoreMaintenanceRequestRequest $request)
    {
        $maintenanceRequest = MaintenanceRequest::create($request->all());

        return redirect()->route('admin.maintenance-requests.index');
    }

    public function edit(MaintenanceRequest $maintenanceRequest)
    {
        abort_if(Gate::denies('maintenance_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = Unit::pluck('unit_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $maintenanceRequest->load('unit', 'user', 'team');

        return view('admin.maintenanceRequests.edit', compact('maintenanceRequest', 'units', 'users'));
    }

    public function update(UpdateMaintenanceRequestRequest $request, MaintenanceRequest $maintenanceRequest)
    {
        $maintenanceRequest->update($request->all());

        return redirect()->route('admin.maintenance-requests.index');
    }

    public function show(MaintenanceRequest $maintenanceRequest)
    {
        abort_if(Gate::denies('maintenance_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintenanceRequest->load('unit', 'user', 'team');

        return view('admin.maintenanceRequests.show', compact('maintenanceRequest'));
    }

    public function destroy(MaintenanceRequest $maintenanceRequest)
    {
        abort_if(Gate::denies('maintenance_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintenanceRequest->delete();

        return back();
    }

    public function massDestroy(MassDestroyMaintenanceRequestRequest $request)
    {
        $maintenanceRequests = MaintenanceRequest::find(request('ids'));

        foreach ($maintenanceRequests as $maintenanceRequest) {
            $maintenanceRequest->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
