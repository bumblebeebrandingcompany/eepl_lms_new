@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Update Walkin</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.plotdetails.update', [$plotdetails->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Plot No:</label>
                            <input type="text" name="name" class="form-control" value="{{ $plotdetails->plot_no }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Plot Type:</label>
                            <input type="text" name="email" class="form-control" value=" {{ $plotdetails->plot_type }}"
                                required>
                        </div>
                   
                        <div class="form-group">
                            <label for="dimension_length">Dimension Length:</label>
                            <input type="text" name="dimension_length" class="form-control" value="{{ $plotdetails->dimension_length }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="dimension_breadth">Dimension Breadth:</label>
                            <input type="text" name="dimension_breadth" class="form-control"
                                value="{{ $plotdetails->dimension_breadth }}">
                        </div>
                        <div class="form-group">
                            <label for="overall_sqft_price">Dimension Breadth:</label>
                            <input type="text" name="overall_sqft_price" class="form-control"
                                value="{{ $plotdetails->overall_sqft_price }}">
                        </div>     <div class="form-group">
                            <label for="total_sqfts">Dimension Breadth:</label>
                            <input type="text" name="total_sqfts" class="form-control"
                                value=" {{ $plotdetails->total_sqfts }}">
                        </div>
                        <input type="hidden" name="comments" class="form-control" value= "Direct Walk-in attended"
                            required>
                        <button type="submit" class="btn btn-success">Update Plot Details</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

