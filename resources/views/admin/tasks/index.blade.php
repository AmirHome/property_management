@extends('layouts.admin')
@section('content')
@can('task_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.tasks.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.task.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.task.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Task">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.task.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.due_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.emergency') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.assigned_to') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.attachment') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.created_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.task.fields.user') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('task_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tasks.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.tasks.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'due_date', name: 'due_date' },
{ data: 'name', name: 'name' },
{ data: 'emergency', name: 'emergency' },
{ data: 'status_name', name: 'status.name' },
{ data: 'assigned_to_name', name: 'assigned_to.name' },
{ data: 'attachment', name: 'attachment', sortable: false, searchable: false },
{ data: 'created_at', name: 'created_at' },
{ data: 'user_name', name: 'user.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 8, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-Task').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection