@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Show MerlomLead</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="walkinDetailsTable">
                            <tbody>
                                <tr>
                                    <th>Ref Num</th>
                                    <td>{{ $merlomLead->ref_num }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $merlomLead->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $merlomLead->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $merlomLead->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Project</th>
                                    <td>{{ $merlomLead->project->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Source</th>
                                    <td>{{ $merlomLead->source }}</td>
                                </tr>
                                <tr>
                                    <th>Sub Source</th>
                                    <td>{{ $merlomLead->sub_source }}</td>
                                </tr>
                                <tr>
                                    <th>Sell.do.id</th>
                                    <td>{{ $merlomLead->sell_do_id }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{!! $merlomLead->status == 0 ? '<b class="text-danger">Duplicate</b>' : '<b class="text-success">New</b>' !!}</td>
                                </tr>


                                <!-- Add other fields as needed -->
                            </tbody>
                        </table>
                    </div>

                    <a href="{{ route('admin.merlom-leads.index') }}" class="btn btn-primary">Back to List</a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#walkinDetailsTable').DataTable({
                    "paging": false,
                    "searching": false,
                    "info": false,
                });
            });
        </script>
    @endpush
@endsection
