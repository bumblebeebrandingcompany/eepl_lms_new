<div class="container">
    <div class="card">
        @if (!auth()->user()->is_client)
            <div class="card-header">
                <h2>Plot Details</h2>
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addPlotModel">
                    Add Plot
                </button>
            </div>
        @endif
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover datatable datatable-projectCampaigns">
                <thead>
                    <tr>
                        <th></th>
                        <th>Plot No</th>
                        <th>Plot Type</th>
                        <th>Dimension in Length</th>
                        <th>Dimension in Breadth</th>
                        <th>Total Sqfts</th>
                        <th>Overall Sqft Price</th>
                        <th>PLC Values</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($plotdetail)
                        @foreach ($plotdetail as $plotdetails)
                            <tr>
                                <td></td>
                                <td>{{ $plotdetails->plot_no ?? '' }}</td>
                                <td>{{ $plotdetails->plot_type ?? '' }}</td>
                                <td>{{ $plotdetails->dimension_length ?? '' }}</td>
                                <td>{{ $plotdetails->dimension_breadth ?? '' }}</td>
                                <td>{{ $plotdetails->total_sqfts ?? '' }}</td>
                                <td>{{ $plotdetails->overall_sqft_price ?? '' }}</td>
                                {{-- <td>
                                    @php
                                        $plcArray = json_decode($plotdetails->plc);
if ($plcArray === null && json_last_error() !== JSON_ERROR_NONE) {
    echo "Error decoding PLC data: " . json_last_error_msg();
}
                                    @endphp
                            
                                    @if ($plcArray !== null)
                                        @foreach ($plcArray as $plc)
                                            {{ $plc->name }}
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    @else
                                        Empty PLC data
                                    @endif
                                </td>
                                 --}}
                                <td>{{$plotdetails->plc_values ?? ''}}</td>

                                <td>
                                    <div class="d-flex justify-content-between flex-nowrap">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <a href="{{ route('admin.plotdetails.show', $plotdetails->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    View
                                                </a>
                                            </div>
                                        </div>
                                        @if (!auth()->user()->is_client)
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <a href="{{ route('admin.plotdetails.edit', $plotdetails->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        Edit
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#deleteModal_{{ $plotdetails->id }}">
                                                        Delete
                                                    </button>
                                                    <!-- Delete Confirmation Modal -->
                                                    <div class="modal fade" id="deleteModal_{{ $plotdetails->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="deleteModalLabel_{{ $plotdetails->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="deleteModalLabel_{{ $plotdetails->id }}">
                                                                        Confirm Deletion</h5><button type="button"
                                                                        class="close" data-dismiss="modal"
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
                                                                    <!-- Form to handle the actual deletion -->
                                                                    <form
                                                                        action="{{ route('admin.plotdetails.destroy', $plotdetails->id) }}"
                                                                        method="POST">
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
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('admin.plot_details.create')
