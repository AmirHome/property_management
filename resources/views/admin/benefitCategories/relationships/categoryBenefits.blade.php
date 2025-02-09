@can('benefit_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.benefits.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.benefit.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.benefit.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-categoryBenefits">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.benefit.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.benefit.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.benefit.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.benefit.fields.credit_amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.benefit.fields.picture') }}
                        </th>
                        <th>
                            {{ trans('cruds.benefit.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.benefit.fields.start') }}
                        </th>
                        <th>
                            {{ trans('cruds.benefit.fields.end') }}
                        </th>
                        <th>
                            {{ trans('cruds.benefit.fields.category') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($benefits as $key => $benefit)
                        <tr data-entry-id="{{ $benefit->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $benefit->id ?? '' }}
                            </td>
                            <td>
                                {{ $benefit->title ?? '' }}
                            </td>
                            <td>
                                {{ $benefit->description ?? '' }}
                            </td>
                            <td>
                                {{ $benefit->credit_amount ?? '' }}
                            </td>
                            <td>
                                @if($benefit->picture)
                                    <a href="{{ $benefit->picture->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $benefit->picture->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ App\Models\Benefit::STATUS_SELECT[$benefit->status] ?? '' }}
                            </td>
                            <td>
                                {{ $benefit->start ?? '' }}
                            </td>
                            <td>
                                {{ $benefit->end ?? '' }}
                            </td>
                            <td>
                                {{ $benefit->category->title ?? '' }}
                            </td>
                            <td>
                                @can('benefit_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.benefits.show', $benefit->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('benefit_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.benefits.edit', $benefit->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('benefit_delete')
                                    <form action="{{ route('admin.benefits.destroy', $benefit->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('benefit_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.benefits.massDestroy') }}",
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
  let table = $('.datatable-categoryBenefits:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection