@extends('layouts.admin')
@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h2>Plot Details</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <a class="btn btn-default float-right" href="{{ route('admin.plotdetails.index') }}">
                        <i class="fas fa-chevron-left"></i>
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                {{-- @foreach ($plotdetail as $plotdetails) --}}
                    
                                <tr>
                                    
                                    <th>{{ trans('cruds.client.fields.name') }}</th>
                                    <td> {{ $plotdetail->plot_no }}</td>
                                </tr>
                                <tr>
                                    <th>Plot type</th>
                                    <td> {{ $plotdetail->plot_type }}</td>
                                </tr>
                                <tr>
                                    <th>Dimension Length</th>
                                    <td> {{ $plotdetail->dimension_length }}</td>
                                </tr>
                                <tr>
                                    <th>Dimension Breadth</th>
                                    <td> {{ $plotdetail->dimension_breadth }}</td>
                                </tr>
                                <tr>
                                    <th>Overall Sqft Price</th>
                                    <td> {{ $plotdetail->overall_sqft_price }}</td>
                                </tr>
                                {{-- <tr>
                                    <th>Secondary Phone</th>
                                    <td class="word-break">{{ $walkin->secondary_phone ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Project</th>
                                    <td class="word-break">{{ $walkin->project->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Campaign</th>
                                    <td class="word-break">{{ $walkin->campaign->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Source</th>
                                    <td class="word-break">{{ $walkin->source->name ?? '' }}</td>
                                </tr> --}}
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
