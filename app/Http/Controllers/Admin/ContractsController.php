<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyContractRequest;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\Contract;
use App\Models\Unit;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ContractsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('contract_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Contract::with(['unit', 'tenant', 'team'])->select(sprintf('%s.*', (new Contract)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'contract_show';
                $editGate      = 'contract_edit';
                $deleteGate    = 'contract_delete';
                $crudRoutePart = 'contracts';

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

            $table->addColumn('tenant_name', function ($row) {
                return $row->tenant ? $row->tenant->name : '';
            });

            $table->editColumn('tenant.email', function ($row) {
                return $row->tenant ? (is_string($row->tenant) ? $row->tenant : $row->tenant->email) : '';
            });

            $table->editColumn('rent_amount', function ($row) {
                return $row->rent_amount ? $row->rent_amount : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Contract::STATUS_RADIO[$row->status] : '';
            });
            $table->editColumn('contract_file', function ($row) {
                if (! $row->contract_file) {
                    return '';
                }
                $links = [];
                foreach ($row->contract_file as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('contract_link', function ($row) {
                return $row->contract_link ? $row->contract_link : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'unit', 'tenant', 'contract_file']);

            return $table->make(true);
        }

        return view('admin.contracts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('contract_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = Unit::pluck('unit_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tenants = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.contracts.create', compact('tenants', 'units'));
    }

    public function store(StoreContractRequest $request)
    {
        $contract = Contract::create($request->all());

        foreach ($request->input('contract_file', []) as $file) {
            $contract->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('contract_file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $contract->id]);
        }

        return redirect()->route('admin.contracts.index');
    }

    public function edit(Contract $contract)
    {
        abort_if(Gate::denies('contract_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = Unit::pluck('unit_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tenants = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contract->load('unit', 'tenant', 'team');

        return view('admin.contracts.edit', compact('contract', 'tenants', 'units'));
    }

    public function update(UpdateContractRequest $request, Contract $contract)
    {
        $contract->update($request->all());

        if (count($contract->contract_file) > 0) {
            foreach ($contract->contract_file as $media) {
                if (! in_array($media->file_name, $request->input('contract_file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $contract->contract_file->pluck('file_name')->toArray();
        foreach ($request->input('contract_file', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $contract->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('contract_file');
            }
        }

        return redirect()->route('admin.contracts.index');
    }

    public function show(Contract $contract)
    {
        abort_if(Gate::denies('contract_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contract->load('unit', 'tenant', 'team');

        return view('admin.contracts.show', compact('contract'));
    }

    public function destroy(Contract $contract)
    {
        abort_if(Gate::denies('contract_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contract->delete();

        return back();
    }

    public function massDestroy(MassDestroyContractRequest $request)
    {
        $contracts = Contract::find(request('ids'));

        foreach ($contracts as $contract) {
            $contract->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('contract_create') && Gate::denies('contract_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Contract();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
