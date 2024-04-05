@extends('layouts.admin')

@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h2> MerlomLead {{ trans('global.list') }}</h2>
        </div>
    </div>

    <div class="card card-primary card-outline">

        <div class="card-header">
            {{-- @if (auth()->user()->checkPermission('client_create')) --}}
            <a class="btn btn-success float-right" href="{{ route('admin.merlom-leads.create') }}">
                {{ trans('global.add') }} MerlomLead
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
                        @foreach ($merlomLeads as $merlomLead)
                            <tr>
                                <td width="10"></td>

                                {{-- <td> {{ $lead->ref_num }}</td> --}}

                                <td> {{ $merlomLead->ref_num ?? '' }}</td>
                                <td> {{ $merlomLead->name ?? '' }}</td>
                                <td> {{ $merlomLead->email ?? '' }}</td>
                                <td> {{ $merlomLead->phone ?? '' }}</td>
                                <td> {{ $merlomLead->project->name ?? '' }}</td>
                                <td> {{ $merlomLead->source ?? '' }}</td>
                                <td> {{ $merlomLead->sub_source ?? '' }}</td>
                                <td> {{ $merlomLead->sell_do_id ?? '' }}</td>

                                <td>{!! $merlomLead->status == 0 ? '<b class="text-danger">Duplicate</b>' : '<b class="text-success">New</b>' !!}</td>



                                {{-- @endforeach --}}
                                <td>
                                    <div class="d-flex justify-content-between flex-nowrap">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <!-- Button to trigger the edit modal -->
                                                <a href="{{ route('admin.merlom-leads.show', $merlomLead->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    View
                                                </a>
                                            </div>
                                        </div>
                                        @if (auth()->user()->checkPermission('merlom_edit'))
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <!-- Button to trigger the edit modal -->
                                                    <a href="{{ route('admin.merlom-leads.edit', $merlomLead->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        Edit
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                        @if (auth()->user()->checkPermission('merlom_delete'))
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <!-- Button to trigger the delete modal -->
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#deleteModal{{ $merlomLead->id }}">
                                                        Delete
                                                    </button>
                                                </div>
                                            </div>
                                    </div>
                                </td>
                        @endIf

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $merlomLead->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="deleteModalLabel{{ $merlomLead->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $merlomLead->id }}">Delete
                                            MerlomLead</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body d-flex">
                                        <div>
                                            <p>Are you sure you want to delete this merlomLead?</p>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                        <form action="{{ route('admin.merlom-leads.destroy', $merlomLead->id) }}"
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
