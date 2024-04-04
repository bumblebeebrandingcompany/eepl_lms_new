@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Update SellDo</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.selldo.update', ['selldo' => $selldo->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" value="{{$selldo->name}}" required>
                        </div>

                        <button type="submit" class="btn btn-success">Update SellDo</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

