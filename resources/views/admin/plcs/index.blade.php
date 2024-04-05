<div class="card">
    <div class="card-header">
        <h1>PLCs</h1>
    </div>
    <div class="card-body">
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addPlcModal">
            Add PLC
        </button>
        <table class="table table-bordered table-striped table-hover datatable datatable-projectCampaigns">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Tag</th>
                    <th>Price</th>
                    <th>Increment/Decrement</th>
                    <th>Project ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plcs as $plc)
                    <tr>
                        <td></td>
                        <td>{{ $plc->name }}</td>
                     
                        <td>
                            {{ $plc->tag }}
                        </td>
                        <td>{{ $plc->price }}</td>
                        <td>
                            @if ($plc->{'increment/decrement'} == 1)
                                Increment
                            @else
                                Decrement
                            @endif
                        </td>
                        <td>{{ $plc->projects->name }}</td>
                        <td>
                            <a href="{{ route('admin.plcs.edit', $plc->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('admin.plcs.create')
