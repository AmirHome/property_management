@extends('layouts.admin')
@section('content')
@can('crm_customer_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.crm-customers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.crmCustomer.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.crmCustomer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-CrmCustomer">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.crmCustomer.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.crmCustomer.fields.first_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.crmCustomer.fields.last_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.crmCustomer.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.crmCustomer.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.crmCustomer.fields.phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.crmCustomer.fields.address') }}
                    </th>
                    <th>
                        {{ trans('cruds.crmCustomer.fields.skype') }}
                    </th>
                    <th>
                        {{ trans('cruds.crmCustomer.fields.website') }}
                    </th>
                    <th>
                        {{ trans('cruds.crmCustomer.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.crmCustomer.fields.birthday') }}
                    </th>
                    <th>
                        {{ trans('cruds.crmCustomer.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.crmCustomer.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
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
@can('crm_customer_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.crm-customers.massDestroy') }}",
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
    ajax: "{{ route('admin.crm-customers.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'first_name', name: 'first_name' },
{ data: 'last_name', name: 'last_name' },
{ data: 'status_name', name: 'status.name' },
{ data: 'email', name: 'email' },
{ data: 'phone', name: 'phone' },
{ data: 'address', name: 'address' },
{ data: 'skype', name: 'skype' },
{ data: 'website', name: 'website' },
{ data: 'description', name: 'description' },
{ data: 'birthday', name: 'birthday' },
{ data: 'city_name', name: 'city.name' },
{ data: 'user_name', name: 'user.name' },
{ data: 'user.email', name: 'user.email' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-CrmCustomer').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection