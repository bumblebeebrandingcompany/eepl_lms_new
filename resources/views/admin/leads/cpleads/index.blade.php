@extends('layouts.admin')

@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h2> CpLead {{ trans('global.list') }}</h2>
        </div>
    </div>

    <div class="card card-primary card-outline">

        <div class="card-header">
            {{-- @if (auth()->user()->checkPermission('client_create')) --}}
            <a class="btn btn-success float-right" href="{{ route('admin.cp-leads.create') }}">
                {{ trans('global.add') }} CpLead
            </a>
            {{-- @endif --}}
        </div>

        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-Client">

                    <thead>
                        <tr>
                            <th width="10"></th>
                            <th>Ref Num</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Project</th>
                            <th>Source</th>
                            <th>Sub Source</th>
                            <th>Sell.do.id</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cpLeads as $cpLead)
                            <tr>
                                <td width="10"></td>

                                {{-- <td> {{ $lead->ref_num }}</td> --}}

                                <td> {{ $cpLead->ref_num ?? '' }}</td>
                                <td> {{ $cpLead->name ?? '' }}</td>
                                <td> {{ $cpLead->email ?? '' }}</td>
                                <td> {{ $cpLead->phone ?? '' }}</td>
                                <td> {{ $cpLead->project->name ?? '' }}</td>
                                <td> {{ $cpLead->source ?? '' }}</td>
                                <td> {{ $cpLead->sub_source ?? '' }}</td>
                                <td> {{ $cpLead->sell_do_id ?? '' }}</td>

                                <td>{!! $cpLead->status == 0 ? '<b class="text-danger">Duplicate</b>' : '<b class="text-success">New</b>' !!}</td>



                                {{-- @endforeach --}}
                                <td>
                                    <div class="d-flex justify-content-between flex-nowrap">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <!-- Button to trigger the edit modal -->
                                                <a href="{{ route('admin.cp-leads.show', $cpLead->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    View
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <!-- Button to trigger the edit modal -->
                                                <a href="{{ route('admin.cp-leads.edit', $cpLead->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    Edit
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <!-- Button to trigger the delete modal -->
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#deleteModal{{ $cpLead->id }}">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>



                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $cpLead->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteModalLabel{{ $cpLead->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $cpLead->id }}">Delete
                                                    CpLead</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body d-flex">
                                                <div>
                                                    <p>Are you sure you want to delete this cpLead?</p>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.cp-leads.destroy', $cpLead->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(function() {
            // Existing JavaScript code for DataTable initialization

            // Additional customization for DataTable
            let table = $('.datatable-Client').DataTable();
            table.on('draw.dt', function() {
                // Add any additional customization after the table is drawn
            });
        });
    </script>
@endsection
