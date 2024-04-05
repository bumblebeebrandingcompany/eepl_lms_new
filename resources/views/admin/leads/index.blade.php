@extends('layouts.admin')

@section('content')
    <style>
        .cardd {
            transition: transform 0.3s;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            overflow: hidden;
            width: 200px;
            height: 200px;
            margin: 35px;
            display: inline-flex;
            position: relative;
            justify-content: center;

            text-align: center;
            /* Apply text-align: center here */
        }

        .cardd:hover {
            transform: scale(1.05);
            background-color: #f0f0f0;
            /* Change the hover color */
        }

        .popup {
            display: none;
            position: absolute;
            background-color: white;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 15px;
            border-radius: 5px;
            width: 200px;
            z-index: 1;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
            text-align: center;
            color: black;
            font-family: sans-serif;
        }

        .cardd:hover .popup {
            display: block;
            background-color: grey;
        }

        .cardd:hover {
            background-color: #CEB2FC;
            --bg-color-light: #F0E7FF;
            /* Change to blue when hover */
        }
        .cardd-content {
            text-align: center;
            word-wrap: break-word;
            margin: 25px;
        }
    </style>

    <div id="project-list">
        @foreach ($projects as $project)
            <div class="cardd">
                <div class="cardd-content">
                    Id : {{ ucwords($project->id) }}<br>
                    Name : {{ ucwords($project->name) }}<br>
                    Location :{{ ucwords($project->location) }}<br>
                    No of Plots :{{ ucwords($project->no_of_plots ?? 'Not Updated') }}<br>
                    <a href="{{ route('admin.leads.lead', ['id' => $project->id]) }}">
                        <div class="popup">
                            Pick Here
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
