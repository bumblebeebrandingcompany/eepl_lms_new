@extends('layouts.admin')

@section('content')
    <style>
        .square-card {
            width: 200px;
            /* Adjust the width as needed */
            height: 200px;
            /* Adjust the height to match the width for square shape */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            cursor: pointer;
            /* Add cursor pointer to indicate clickable */
        }
    </style>
    @if ($project->isNotEmpty())
        <div class="card-group">
            <div class="row">
                @foreach ($project as $projects)
                    <div class="col-md-3 mb-5">
                        <div class="card card-primary card-outline square-card">
                            <div>{{ $projects->name ?? '' }}</div>
                            <div>{{ $projects->location ?? '' }}</div>

                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('admin.booking.create', ['projectId' => $projects->id]) }}">
                                        <button type="button" class="btn btn-primary float-left">
                                            Booking
                                        </button>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.booking.book', ['projectId' => $projects->id]) }}">
                                        <button type="button" class="btn btn-primary float-end">
                                            Booked
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p>No projects found.</p>
    @endif
@endsection
