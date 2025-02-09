@can('patient_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.patients.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.patient.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.patient.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-campaignOrgPatients">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.office') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.campaign_org') }}
                        </th>
                        <th>
                            {{ trans('cruds.campaignOrg.fields.started_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.city') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.middle_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.surname') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.mother_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.father_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.citizenship') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.passport_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.passport_origin') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.foriegn_phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.birthday') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.birth_place') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.weight') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.height') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.blood_group') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.treating_doctor') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.code') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.patient.fields.passport_image') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patients as $key => $patient)
                        <tr data-entry-id="{{ $patient->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $patient->id ?? '' }}
                            </td>
                            <td>
                                {{ $patient->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $patient->office->name ?? '' }}
                            </td>
                            <td>
                                {{ $patient->campaign_org->title ?? '' }}
                            </td>
                            <td>
                                {{ $patient->campaign_org->started_at ?? '' }}
                            </td>
                            <td>
                                {{ $patient->city->name ?? '' }}
                            </td>
                            <td>
                                {{ $patient->name ?? '' }}
                            </td>
                            <td>
                                {{ $patient->middle_name ?? '' }}
                            </td>
                            <td>
                                {{ $patient->surname ?? '' }}
                            </td>
                            <td>
                                {{ $patient->mother_name ?? '' }}
                            </td>
                            <td>
                                {{ $patient->father_name ?? '' }}
                            </td>
                            <td>
                                {{ $patient->citizenship ?? '' }}
                            </td>
                            <td>
                                {{ $patient->passport_no ?? '' }}
                            </td>
                            <td>
                                {{ $patient->passport_origin ?? '' }}
                            </td>
                            <td>
                                {{ $patient->phone ?? '' }}
                            </td>
                            <td>
                                {{ $patient->foriegn_phone ?? '' }}
                            </td>
                            <td>
                                {{ $patient->email ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Patient::GENDER_SELECT[$patient->gender] ?? '' }}
                            </td>
                            <td>
                                {{ $patient->birthday ?? '' }}
                            </td>
                            <td>
                                {{ $patient->birth_place ?? '' }}
                            </td>
                            <td>
                                {{ $patient->address ?? '' }}
                            </td>
                            <td>
                                {{ $patient->weight ?? '' }}
                            </td>
                            <td>
                                {{ $patient->height ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Patient::BLOOD_GROUP_SELECT[$patient->blood_group] ?? '' }}
                            </td>
                            <td>
                                {{ $patient->treating_doctor ?? '' }}
                            </td>
                            <td>
                                {{ $patient->code ?? '' }}
                            </td>
                            <td>
                                @if($patient->photo)
                                    <a href="{{ $patient->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $patient->photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if($patient->passport_image)
                                    <a href="{{ $patient->passport_image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $patient->passport_image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('patient_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.patients.show', $patient->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('patient_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.patients.edit', $patient->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('patient_delete')
                                    <form action="{{ route('admin.patients.destroy', $patient->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('patient_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.patients.massDestroy') }}",
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
  let table = $('.datatable-campaignOrgPatients:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection