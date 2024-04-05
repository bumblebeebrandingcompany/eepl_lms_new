@extends('layouts.admin')
@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h2>
                {{ trans('cruds.project.title_singular') }} {{ trans('global.list') }}
            </h2>
        </div>
    </div>
    <div class="card card-primary card-outline">
        @if (auth()->user()->checkPermission('project_create'))
            <div class="card-header">
                <button class="btn btn-warning float-right m-1" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                <a class="btn btn-success float-right m-1" href="{{ route('admin.projects.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.project.title_singular') }}
                </a>
                @include('csvImport.modal', [
                    'model' => 'Project',
                    'route' => 'admin.projects.parseCsvImport',
                ])
            </div>
        @endif
        <div class="table-container">
            <div class="tableFixHead">
                <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-Project">
                    <thead>
                        <tr>
                            <th width="10">
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
                                Rera no
                            </th>
                            <th>
                                Local Body No
                            </th>
                            <th>
                                dtcp/cmda </th>
                            <th>
                                Overall sqfts </th>
                            <th>
                                No of Plots </th>
                            <th>
                                Create At</th>
                            <th>
                                Action
                            </th>
                        </tr>

                    </thead>


                </table>
            </div>
        </div>
    </div>
@endsection
    @section('scripts')
        @parent
        <script>
            $(function() {
                let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
                @if (auth()->user()->checkPermission('project_delete'))
                    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                    let deleteButton = {
                        text: deleteButtonTrans,
                        url: "{{ route('admin.projects.massDestroy') }}",
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
                    ajax: "{{ route('admin.projects.index') }}",
                    columns: [{
                            data: 'placeholder',
                            name: 'placeholder'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'start_date',
                            name: 'start_date'
                        },
                        {
                            data: 'end_date',
                            name: 'end_date'
                        },
                        {
                            data: 'created_by_name',
                            name: 'created_by.name'
                        },
                        {
                            data: 'client_name',
                            name: 'client.name'
                        },
                        {
                            data: 'client.email',
                            name: 'client.email'
                        },

                        {
                            data: 'location',
                            name: 'location'
                        },
                        {
                            data: 'rera_no',
                            name: 'rera_no'
                        },
                        {
                            data: 'local_body_no',
                            name: 'local_body_no'
                        },
                        {
                            data: 'dtcp/cmda',
                            name: 'dtcp/cmda'
                        },
                        {
                            data: 'overall_sqfts',
                            name: 'overall_sqfts'
                        },
                        {
                            data: 'no_of_plots',
                            name: 'no_of_plots'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'actions',
                            name: '{{ trans('global.actions') }}'
                        }
                    ],
                    orderCellsTop: true,
                    order: [
                        [1, 'desc']
                    ],
                    pageLength: 100,
                };
                let table = $('.datatable-Project').DataTable(dtOverrideGlobals);
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
    @endsection
    <style>
        .tableFixHead {
            table-layout: fixed;
            width: auto;
            border-collapse: collapse;
        }

        .tableFixHead tbody {
            display: block;
            width: auto;
            overflow: auto;
            height: 510px;
        }

        .tableFixHead thead tr {
            display: block;
            text-align: center;
            width: auto;
        }

        .tableFixHead th,
        .tableFixHead td {
            width: 200px;
        }

        th {
            background: #ABDD93;
        }


        <style>.table-container {
            width: 100%;
            overflow-x: auto;
        }

        .tableFixHead th,
        .tableFixHead td {
            padding: 8px;
            border: 1px solid #ddd;
            white-space: nowrap;
        }
    </style>
