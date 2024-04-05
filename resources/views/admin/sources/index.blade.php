@extends('layouts.admin')

@section('content')
    <div class="row mb-2">
        <div class="col-sm-12">
            <h2>{{ $project->name }}</h2>
            <!-- Display project details -->
            <p>Project ID: {{ $project->id }}</p>
        </div>
    </div>

    <div class="card card-primary card-outline">
        <div class="card-body">
            <h3>{{ trans('cruds.source.title_singular') }} {{ trans('global.list') }}</h3>
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-Source">
                <thead>
                    <tr>
                        <th width="10">
                        </th>
                        <!-- <th>
                            {{ trans('cruds.source.fields.project') }}
                        </th> -->
                        <th>
                            {{ trans('cruds.source.fields.campaign') }}
                        </th>
                        <th>
                            {{ trans('cruds.source.fields.name') }}
                        </th>
                        <th>
                            {{ trans('messages.source_name') }}
                            <i class="fas fa-info-circle" data-html="true" data-toggle="tooltip"
                                title="{{ trans('messages.source_name_help_text') }}">
                            </i>
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                        </td>
                        <!-- <td>

                            @if (empty($__global_clients_filter))
                                <select class="search">
                                    <option value>{{ trans('global.all') }}</option>
                                    @foreach ($projects as $key => $items)
                                        <option value="{{ $items->name }}">{{ $items->name }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </td> -->

                        <td>
                            @if (empty($__global_clients_filter))
                                <select class="search">
                                    <option value>{{ trans('global.all') }}</option>
                                    @foreach ($campaigns as $key => $item)
                                        <option value="{{ $item->campaign_name }}">{{ $item->campaign_name }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif


                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">


                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        @foreach ($sources as $source)
                            <td></td>

                            <!-- <td>
                                {{ $items->name }}

                            </td> -->
                            <td>
                                {{ $item->campaign_name }}
                            </td>


                            <td>
                                {{ $source->name }}
                            </td>
                            <td>
                                {{ $source->source_name }}

                            </td>
                            <td>
                                <div class="d-flex flex-wrap">
                                    <div class="form-group mr-1 mb-1">
                                        <a href="{{ route('admin.sources.show', $source->id) }}"
                                            class="btn btn-primary btn-sm mb-1">
                                            View
                                        </a>
                                    </div>

                                    @if (!auth()->user()->is_client)
                                        <div class="form-group mr-1 mb-1">
                                            <a href="{{ route('admin.sources.edit', $source->id) }}"
                                                class="btn btn-info btn-sm mb-1">
                                                Edit
                                            </a>
                                        </div>
                                        <div class="form-group mr-1 mb-1">
                                            <a href="{{ route('admin.sources.webhook', $source->id) }}"
                                                class="btn btn-info btn-sm mb-1">
                                                Incoming Webhook
                                            </a>
                                        </div>
                                        <div class="form-group mr-1 mb-1">
                                            <button type="button" class="btn btn-danger btn-sm mb-1" data-toggle="modal"
                                                data-target="#deleteModal_{{ $source->id }}">
                                                Delete
                                            </button>
                                            <!-- Delete Confirmation Modal -->
                                            <div class="modal fade" id="deleteModal_{{ $source->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteModalLabel_{{ $source->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="deleteModalLabel_{{ $source->id }}">Confirm Deletion
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this item?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                            <form  action="{{ route('admin.sources.destroy', $source->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

{{-- @section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @if (auth()->user()->checkPermission('source_delete'))
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.sources.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).data(), function(entry) {
                            return entry.id
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

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.sources.index') }}",
                columns: [{
                        data: 'placeholder',
                        name: 'placeholder'
                    },
                    {
                        data: 'project_name',
                        name: 'project.name'
                    },
                    {
                        data: 'campaign_campaign_name',
                        name: 'campaign.campaign_name'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'source_name',
                        name: 'source_name'
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                orderCellsTop: true,
                order: [
                    [3, 'desc']
                ],
                pageLength: 100,
            };
            let table = $('.datatable-Source').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

            let visibleColumnsIndexes = null;
            $('.datatable thead').on('input', '.search', function() {
                let strict = $(this).attr('strict') || false
                let value = strict && this.value ? "^" + this.value + "$" : this.value

                let index = $(this).parent().index()
                if (visibleColumnsIndexes !== null) {
                    index = visibleColumnsIndexes[index]
                }

                table
                    .column(index)
                    .search(value, strict)
                    .draw()
            });
            table.on('column-visibility.dt', function(e, settings, column, state) {
                visibleColumnsIndexes = []
                table.columns(":visible").every(function(colIdx) {
                    visibleColumnsIndexes.push(colIdx);
                });
            })
        });
    </script>
@endsection --}}
