@can('travel_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.travels.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.travel.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.travel.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-departmentTravels">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.travel.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.travel.fields.patient') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.middle_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.surname') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.code') }}
                        </th>
                        <th>
                            {{ trans('cruds.travel.fields.group') }}
                        </th>
                        <th>
                            {{ trans('cruds.travel.fields.hospital') }}
                        </th>
                        <th>
                            {{ trans('cruds.travel.fields.department') }}
                        </th>
                        <th>
                            {{ trans('cruds.travel.fields.last_status') }}
                        </th>
                        <th>
                            {{ trans('cruds.travelStatus.fields.ordering') }}
                        </th>
                        <th>
                            {{ trans('cruds.travel.fields.attendant_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.travel.fields.attendant_address') }}
                        </th>
                        <th>
                            {{ trans('cruds.travel.fields.attendant_phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.travel.fields.has_pestilence') }}
                        </th>
                        <th>
                            {{ trans('cruds.travel.fields.hospital_mail_notify') }}
                        </th>
                        <th>
                            {{ trans('cruds.travel.fields.notify_hospitals') }}
                        </th>
                        <th>
                            {{ trans('cruds.travel.fields.reffering') }}
                        </th>
                        <th>
                            {{ trans('cruds.travel.fields.hospitalization_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.travel.fields.planning_discharge_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.travel.fields.arrival_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.travel.fields.departure_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.travel.fields.wants_shopping') }}
                        </th>
                        <th>
                            {{ trans('cruds.travel.fields.visa_status') }}
                        </th>
                        <th>
                            {{ trans('cruds.travel.fields.visa_start_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.travel.fields.visa_end_date') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($travels as $key => $travel)
                        <tr data-entry-id="{{ $travel->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $travel->id ?? '' }}
                            </td>
                            <td>
                                {{ $travel->patient->name ?? '' }}
                            </td>
                            <td>
                                {{ $travel->patient->middle_name ?? '' }}
                            </td>
                            <td>
                                {{ $travel->patient->surname ?? '' }}
                            </td>
                            <td>
                                {{ $travel->patient->code ?? '' }}
                            </td>
                            <td>
                                {{ $travel->group->name ?? '' }}
                            </td>
                            <td>
                                {{ $travel->hospital->name ?? '' }}
                            </td>
                            <td>
                                {{ $travel->department->name ?? '' }}
                            </td>
                            <td>
                                {{ $travel->last_status->title ?? '' }}
                            </td>
                            <td>
                                {{ $travel->last_status->ordering ?? '' }}
                            </td>
                            <td>
                                {{ $travel->attendant_name ?? '' }}
                            </td>
                            <td>
                                {{ $travel->attendant_address ?? '' }}
                            </td>
                            <td>
                                {{ $travel->attendant_phone ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $travel->has_pestilence ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $travel->has_pestilence ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $travel->hospital_mail_notify ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $travel->hospital_mail_notify ? 'checked' : '' }}>
                            </td>
                            <td>
                                @foreach($travel->notify_hospitals as $key => $item)
                                    <span class="badge badge-info">{{ $item->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $travel->reffering ?? '' }}
                            </td>
                            <td>
                                {{ $travel->hospitalization_date ?? '' }}
                            </td>
                            <td>
                                {{ $travel->planning_discharge_date ?? '' }}
                            </td>
                            <td>
                                {{ $travel->arrival_date ?? '' }}
                            </td>
                            <td>
                                {{ $travel->departure_date ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $travel->wants_shopping ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $travel->wants_shopping ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $travel->visa_status ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $travel->visa_status ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $travel->visa_start_date ?? '' }}
                            </td>
                            <td>
                                {{ $travel->visa_end_date ?? '' }}
                            </td>
                            <td>
                                @can('travel_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.travels.show', $travel->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('travel_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.travels.edit', $travel->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('travel_delete')
                                    <form action="{{ route('admin.travels.destroy', $travel->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('travel_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.travels.massDestroy') }}",
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
    pageLength: 10,
  });
  let table = $('.datatable-departmentTravels:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection