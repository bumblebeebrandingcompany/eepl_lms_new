@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Show CpLead</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="walkinDetailsTable">
                            <tbody>
                                <tr>
                                    <th>Ref Num</th>
                                    <td>{{ $cpLead->ref_num }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $cpLead->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $cpLead->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $cpLead->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Project</th>
                                    <td>{{ $cpLead->project->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Source</th>
                                    <td>{{ $cpLead->source }}</td>
                                </tr>
                                <tr>
                                    <th>Sub Source</th>
                                    <td>{{ $cpLead->sub_source }}</td>
                                </tr>
                                <tr>
                                    <th>Sell.do.id</th>
                                    <td>{{ $cpLead->sell_do_id }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{!! $cpLead->status == 0 ? '<b class="text-danger">Duplicate</b>' : '<b class="text-success">New</b>' !!}</td>
                                </tr>


                                <!-- Add other fields as needed -->
                            </tbody>
                        </table>
                    </div>

                    <a href="{{ route('admin.cp-leads.index') }}" class="btn btn-primary">Back to List</a>
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
