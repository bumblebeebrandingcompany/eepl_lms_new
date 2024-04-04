@extends('layouts.admin')
@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h2>
                Plot Details </h2>
        </div>
    </div>
    <div>
        <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-plotdetails">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Plot No</th>
                    <th>Plot Type</th>
                    <th>Dimension in length</th>
                    <th>Dimension in breadth</th>
                    <th>Total Sqfts</th>
                    <th>Overall Sqfft Price</th>
                    <th>PLC Values</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $counter = 1;
                @endphp
                @foreach ($plotdetail as $plotdetails)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td> {{ $plotdetails->plot_no }}</td>
                        <td> {{ $plotdetails->plot_type }}</td>
                        <td> {{ $plotdetails->dimension_length }}</td>
                        <td> {{ $plotdetails->dimension_breadth }}</td>
                        <td> {{ $plotdetails->total_sqfts }}</td>
                        <td> {{ $plotdetails->overall_sqft_price }}</td>
                        <td> {{ $plotdetails->plc->name ?? '' }}</td>
                        <td>
                         
                                @if ($plotdetails->status_id === 1)
                                <span class="badge badge-success">Booked</span>
                                @else
                                    <a href="{{ route('admin.booking.plots', $plotdetails->id) }}" class="btn btn-info btn-sm">
                                        Book
                                    </a>
                                @endif
                           
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  
@endsection
