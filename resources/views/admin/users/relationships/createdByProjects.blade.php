<div class="m-3">
    <div class="card">
        @if(auth()->user()->is_superadmin)
            <div class="card-header">
                <a class="btn btn-success float-right" href="{{ route('admin.projects.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.project.title_singular') }}
                </a>
            </div>
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-createdByProjects">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.project.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.start_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.end_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.created_by') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.client') }}
                            </th>
                            <th>
                                {{ trans('cruds.client.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.location') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $key => $project)
                            <tr data-entry-id="{{ $project->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $project->id ?? '' }}
                                </td>
                                <td>
                                    {{ $project->name ?? '' }}
                                </td>
                                <td>
                                    {{ $project->start_date ?? '' }}
                                </td>
                                <td>
                                    {{ $project->end_date ?? '' }}
                                </td>
                                <td>
                                    {{ $project->created_by->name ?? '' }}
                                </td>
                                <td>
                                    {{ $project->client->name ?? '' }}
                                </td>
                                <td>
                                    {{ $project->client->email ?? '' }}
                                </td>
                                <td>
                                    {{ $project->location ?? '' }}
                                </td>
                                <td>
                                    @can('project_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.projects.show', $project->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('project_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.projects.edit', $project->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('project_delete')
                                        <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  @if(auth()->user()->is_superadmin)
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.projects.massDestroy') }}",
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
@endif

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-createdByProjects:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection