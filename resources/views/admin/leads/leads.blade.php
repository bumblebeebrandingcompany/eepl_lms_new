@extends('layouts.admin')
@section('content')
     @includeIf('admin.leads.partials.header')
    @if ($lead_view == 'list' && count($leads) > 0)
    <div class="m-3">
        <div class="card">
            @if (auth()->user()->checkPermission('lead_create'))
                <div class="card-header">
                    <a class="btn btn-success float-right"
                        href="{{ route('admin.leads.create', ['project_id' => $project->id]) }}">
                        {{ trans('global.add') }} {{ trans('cruds.lead.title_singular') }}
                    </a>
                </div>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class=" table table-bordered table-striped table-hover datatable datatable-projectLeads">
                        <thead>
                            @php
                                $lead = App\Models\Project::findOrFail($project->id);
                                $decodedData = $lead->essential_fields ?? [];
                                $salesData = $lead->sales_fields ?? [];
                                $systemData = $lead->system_fields ?? [];
                                $customData = $lead->custom_fields ?? [];
                            @endphp
                            <tr>
                                <th></th>
                                <th>Ref.Num</th>
                                @foreach ($decodedData as $key => $essentialField)
                                    @if (isset($essentialField['enabled']) && $essentialField['enabled'] === '1')
                                        <th>{{ $essentialField['name_data'] }}</th>
                                    @endif
                                @endforeach
                                @foreach ($salesData as $key => $salesField)
                                    @if (isset($salesField['enabled']) && $salesField['enabled'] === '1')
                                        <th>{{ $salesField['name_data'] }}</th>
                                    @endif
                                @endforeach
                                @foreach ($systemData as $key => $systemField)
                                    @if (isset($systemField['enabled']) && $systemField['enabled'] === '1')
                                        <th>{{ $systemField['name_data'] }}</th>
                                    @endif
                                @endforeach
                                @foreach ($customData as $key => $customField)
                                    @if (isset($customField['enabled']) && $customField['enabled'] === '1')
                                        <th>{{ $customField['name_data'] }}</th>
                                    @endif
                                @endforeach
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leads as $lead)
                                <tr>
                                    <td></td>
                                    <td>{{ $lead->ref_num }}</td>
                                    @foreach (json_decode($lead->essential_fields, true) ?? [] as $key => $value)
                                        <td>{{ $value }}</td>
                                    @endforeach
                                    @foreach (json_decode($lead->sales_fields, true) ?? [] as $key => $value)
                                        <td>{{ $value }}</td>
                                    @endforeach
                                    @foreach (json_decode($lead->system_fields, true) ?? [] as $key => $value)
                                        <td>{{ $value }}</td>
                                    @endforeach
                                    @foreach (json_decode($lead->custom_fields, true) ?? [] as $key => $value)
                                        <td>{{ $value }}</td>
                                    @endforeach
    
                                    <td>
                                        @if (auth()->user()->checkPermission('lead_view'))
                                            <a class="btn btn-xs btn-primary"
                                                href="{{ route('admin.leads.show', $lead->id) }}">
                                                {{ trans('global.view') }}
                                            </a>
                                        @endif
                                        @if (auth()->user()->checkPermission('lead_edit'))
                                            <a class="btn btn-xs btn-info"
                                                href="{{ route('admin.leads.edit', $lead->id) }}">
                                                {{ trans('global.edit') }}
                                            </a>
                                        @endif
                                        @if (auth()->user()->checkPermission('lead_delete'))
                                            <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST"
                                                onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-xs btn-danger"
                                                    value="{{ trans('global.delete') }}">
                                            </form>
                                        @endif
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
            $(function() {
                let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
                @if (auth()->user()->checkPermission('lead_delete'))
                    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                    let deleteButton = {
                        text: deleteButtonTrans,
                        url: "{{ route('admin.leads.massDestroy') }}",
                        className: 'btn-danger',
                        action: function(e, dt, node, config) {
                            var ids = $.map(dt.rows({
                                selected: true
                            }).nodes(), function(entry) {
                                return $(entry).data('entry-id')
                            });
    
                            if (ids.length === 0) {
                                alert('{{ trans('global.datatables.zero_selected') }}')
    
                                return
                            }
    
                            if (confirm('{{ trans('global.areYouSure') }}')) {
                                $.ajax({
                                        headers: {
                                            'x-csrf-token': _token
                                        },
                                        method: 'POST',
                                        url: config.url,
                                        data: {
                                            ids: ids,
                                            _method: 'DELETE'
                                        }
                                    })
                                    .done(function() {
                                        location.reload()
                                    })
                            }
                        }
                    }
                    dtButtons.push(deleteButton)
                @endif
    
                $.extend(true, $.fn.dataTable.defaults, {
                    orderCellsTop: true,
                    order: [
                        [1, 'desc']
                    ],
                    pageLength: 100,
                });
                let table = $('.datatable-projectLeads:not(.ajaxTable)').DataTable({
                    buttons: dtButtons
                })
                $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                    $($.fn.dataTable.tables(true)).DataTable()
                        .columns.adjust();
                });
    
            })
        </script>
    @endsection
    
    @else
        <p>No leads available.</p>
    @endif
@endsection
