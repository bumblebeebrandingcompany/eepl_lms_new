@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Create SellDo</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.selldo.store') }}" method="post">
                        @csrf

                        <div class="form-group" class="required">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>



                        <button type="submit" class="btn btn-success">Create SellDo field</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
