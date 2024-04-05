<!-- resources/views/plcs/edit.blade.php -->

@extends('layouts.admin')

@section('content')
    <h1>Edit PLC</h1>
    <form action="{{ route('plcs.update', $plc->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $plc->name }}">
        </div>
        <div class="form-group">
            <label for="tag">Tag</label>
            <input type="number" name="tag" class="form-control" value="{{ $plc->tag }}">
        </div>
        <div class="form-group">
            <label for="increment/decrement">Increment/Decrement</label>
            <input type="number" name="increment/decrement" class="form-control" value="{{ $plc->increment_decrement }}">
        </div>
        <div class="form-group">
            <label for="project_id">Project ID</label>
            <input type="number" name="project_id" class="form-control" value="{{ $plc->project_id }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
