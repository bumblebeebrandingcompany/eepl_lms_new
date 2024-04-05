<div class="card">
    <div class="card-header">
        <h1>Prices</h1>
    </div>
    <div class="card-body">
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addPriceModal">
            Add Price
        </button>
        <table class="table table-bordered table-striped table-hover datatable datatable-projectCampaigns">
            <thead>
                <tr>
                    <th></th>
                    <th>No</th>
                    <th>User type</th>
                    <th>Price / sqft</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $counter = 1;
                @endphp
                @foreach ($price as $prices)
                    <tr>
                        <td></td>
                        <td>{{ $counter++ }}</td>
                        <td> {{ $prices->user_type }}</td>
                        <td> {{ $prices->price_per_sqft }}</td>
                        <td>{{ $prices->date ?? '' }}</td>
                        <td>
                            <a href="{{ route('admin.price.edit', $prices->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('admin.price.create')
