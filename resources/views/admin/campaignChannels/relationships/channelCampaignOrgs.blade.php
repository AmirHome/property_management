@can('campaign_org_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.campaign-orgs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.campaignOrg.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.campaignOrg.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-channelCampaignOrgs">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.campaignOrg.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.campaignOrg.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.campaignOrg.fields.channel') }}
                        </th>
                        <th>
                            {{ trans('cruds.campaignOrg.fields.started_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.campaignOrg.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($campaignOrgs as $key => $campaignOrg)
                        <tr data-entry-id="{{ $campaignOrg->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $campaignOrg->id ?? '' }}
                            </td>
                            <td>
                                {{ $campaignOrg->title ?? '' }}
                            </td>
                            <td>
                                {{ $campaignOrg->channel->title ?? '' }}
                            </td>
                            <td>
                                {{ $campaignOrg->started_at ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\CampaignOrg::STATUS_RADIO[$campaignOrg->status] ?? '' }}
                            </td>
                            <td>
                                @can('campaign_org_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.campaign-orgs.show', $campaignOrg->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('campaign_org_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.campaign-orgs.edit', $campaignOrg->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('campaign_org_delete')
                                    <form action="{{ route('admin.campaign-orgs.destroy', $campaignOrg->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('campaign_org_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.campaign-orgs.massDestroy') }}",
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
  let table = $('.datatable-channelCampaignOrgs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection