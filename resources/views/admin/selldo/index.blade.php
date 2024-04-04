@extends('layouts.admin')

@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h2> SellDo {{ trans('global.list') }}</h2>
        </div>
    </div>

    <div class="card card-primary card-outline">

        <div class="card-header">
            {{-- @if (auth()->user()->checkPermission('client_create')) --}}
            <a class="btn btn-success float-right" href="{{ route('admin.selldo.create') }}">
                {{ trans('global.add') }} SellDo
            </a>
            {{-- @endif --}}
        </div>

        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-Client">

                    <thead>
                        <tr>
                            <th width="10"></th>


                            <th>Name</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($selldo as $selldodata)
                            <tr>
                                <td width="10"></td>



                                <td> {{ $selldodata->name }}</td>

                                <td>
                                    <div class="d-flex justify-content-between flex-nowrap">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <!-- Button to trigger the edit modal -->
                                                <a href="{{ route('admin.selldo.show', $selldodata->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    View
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <!-- Button to trigger the edit modal -->
                                                <a href="{{ route('admin.selldo.edit', $selldodata->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    Edit
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <!-- Button to trigger the delete modal -->
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#deleteModal{{ $selldodata->id }}">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>



                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $selldodata->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteModalLabel{{ $selldodata->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $selldodata->id }}">Delete
                                                    SellDo</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body d-flex">
                                                <div>
                                                    <p>Are you sure you want to delete this selldodata?</p>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.selldo.destroy', $selldodata->id) }}"
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
