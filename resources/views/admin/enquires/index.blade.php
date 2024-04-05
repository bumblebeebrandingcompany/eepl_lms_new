@extends('layouts.admin')

@section('content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h2> Walkin {{ trans('global.list') }}</h2>
    </div>
</div>

<div class="card card-primary card-outline">

    <div class="card-header">
        {{-- @if (auth()->user()->checkPermission('client_create')) --}}
        <a class="btn btn-success float-right" href="{{ route('admin.aztec.create') }}">
            {{ trans('global.add') }} Walkin
        </a>
        {{-- @endif --}}
    </div>

    <div class="card-body">
        <div class="table-responsive">

            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-Client">

                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>Ref num </th>

                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>City</th>

                        <th>Sell.do.id</th>
                        <th>Status</th>
                        <th>
                            Sell.do.date
                        </th>
                        <th>
                            Sell.do.time
                        </th>
                        <th>Referred By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($enquires as $enquiry)

                    <tr>
                        <td width="10"></td>
                        @foreach ($enquiry->leads as $lead)
                        <td> {{ $lead->ref_num }}</td>


                        <td> {{ $enquiry->name }}</td>
                        <td> {{ $enquiry->email }}</td>
                        <td> {{ $enquiry->phone }}</td>
                        <td> {{ $enquiry->city }}</td>
                        <td> {{ $lead->sell_do_lead_id }}</td>
                        <td>
                            @if ($lead->sell_do_is_exist)
                            <b class="text-danger">Duplicate</b>
                            @else
                            <b class="text-success">New</b>
                            @endif
                        </td>

                        <td>
                            @if (!empty($lead->sell_do_lead_created_at))
                            {{ Carbon\Carbon::parse($lead->sell_do_lead_created_at)->format('d/m/Y') }}
                            @endif
                        </td>

                        <td>
                            @if (!empty($lead->sell_do_lead_created_at))
                            {{ Carbon\Carbon::parse($lead->sell_do_lead_created_at)->format('h:i A') }}
                            @endif
                        </td>
                        <td> {{ $enquiry->referred_by }}</td>
                        @endforeach
                        <td>
                            <div class="d-flex justify-content-between flex-nowrap">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <!-- Button to trigger the edit modal -->
                                        <a href="{{ route('admin.aztec.show', $enquiry->id) }}"
                                            class="btn btn-primary btn-sm">
                                            View
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <!-- Button to trigger the edit modal -->
                                        <a href="{{ route('admin.aztec.edit', $enquiry->id) }}"
                                            class="btn btn-info btn-sm">
                                            Edit
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <!-- Button to trigger the delete modal -->
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#deleteModal{{ $enquiry->id }}">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>



                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $enquiry->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="deleteModalLabel{{ $enquiry->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $enquiry->id }}">Delete
                                            Walkin</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body d-flex">
                                        <div>
                                            <p>Are you sure you want to delete this enquiry?</p>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                        <form action="{{ route('admin.aztec.destroy', $enquiry->id) }}" method="POST">
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
    $(function () {
        // Existing JavaScript code for DataTable initialization

        // Additional customization for DataTable
        let table = $('.datatable-Client').DataTable();
        table.on('draw.dt', function () {
            // Add any additional customization after the table is drawn
        });
    });
</script>
@endsection