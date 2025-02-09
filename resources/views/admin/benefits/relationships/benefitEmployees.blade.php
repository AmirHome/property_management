@can('employee_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.employees.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.employee.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.employee.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-benefitEmployees">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.employee.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.employee.fields.identity') }}
                        </th>
                        <th>
                            {{ trans('cruds.employee.fields.birthday') }}
                        </th>
                        <th>
                            {{ trans('cruds.employee.fields.mobile') }}
                        </th>
                        <th>
                            {{ trans('cruds.employee.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.employee.fields.family') }}
                        </th>
                        <th>
                            {{ trans('cruds.employee.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.employee.fields.job_title') }}
                        </th>
                        <th>
                            {{ trans('cruds.employee.fields.department') }}
                        </th>
                        <th>
                            {{ trans('cruds.employee.fields.yearly_credit') }}
                        </th>
                        <th>
                            {{ trans('cruds.employee.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.employee.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.employee.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.employee.fields.picture') }}
                        </th>
                        <th>
                            {{ trans('cruds.employee.fields.benefit') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $key => $employee)
                        <tr data-entry-id="{{ $employee->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $employee->id ?? '' }}
                            </td>
                            <td>
                                {{ $employee->identity ?? '' }}
                            </td>
                            <td>
                                {{ $employee->birthday ?? '' }}
                            </td>
                            <td>
                                {{ $employee->mobile ?? '' }}
                            </td>
                            <td>
                                {{ $employee->name ?? '' }}
                            </td>
                            <td>
                                {{ $employee->family ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Employee::GENDER_SELECT[$employee->gender] ?? '' }}
                            </td>
                            <td>
                                {{ $employee->job_title ?? '' }}
                            </td>
                            <td>
                                {{ $employee->department ?? '' }}
                            </td>
                            <td>
                                {{ $employee->yearly_credit ?? '' }}
                            </td>
                            <td>
                                {{ $employee->email ?? '' }}
                            </td>
                            <td>
                                {{ $employee->phone ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Employee::STATUS_SELECT[$employee->status] ?? '' }}
                            </td>
                            <td>
                                @if($employee->picture)
                                    <a href="{{ $employee->picture->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $employee->picture->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @foreach($employee->benefits as $key => $item)
                                    <span class="badge badge-info">{{ $item->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('employee_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.employees.show', $employee->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('employee_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.employees.edit', $employee->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('employee_delete')
                                    <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('employee_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.employees.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-benefitEmployees:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection