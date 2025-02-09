@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.contract.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contracts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.contract.fields.id') }}
                        </th>
                        <td>
                            {{ $contract->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contract.fields.unit') }}
                        </th>
                        <td>
                            {{ $contract->unit->unit_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contract.fields.tenant') }}
                        </th>
                        <td>
                            {{ $contract->tenant->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contract.fields.start') }}
                        </th>
                        <td>
                            {{ $contract->start }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contract.fields.end') }}
                        </th>
                        <td>
                            {{ $contract->end }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contract.fields.rent_amount') }}
                        </th>
                        <td>
                            {{ $contract->rent_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contract.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Contract::STATUS_RADIO[$contract->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contract.fields.contract_file') }}
                        </th>
                        <td>
                            @foreach($contract->contract_file as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contract.fields.contract_link') }}
                        </th>
                        <td>
                            {{ $contract->contract_link }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contracts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection