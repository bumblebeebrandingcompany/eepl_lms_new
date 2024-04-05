@extends('layouts.admin')
@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h2>
               Walkin
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <a class="btn btn-default float-right" href="{{ route('admin.aztec.index') }}">
                        <i class="fas fa-chevron-left"></i>
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                @foreach ($enquiry->leads as $lead)
                                <tr>
                                   
                                        <th>
                                          Ref Num
                                        </th>

                                        <td> {{ $lead->ref_num }}</td>
                                    </tr>
                                    <tr>
                                    <th>
                                        {{ trans('cruds.client.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $enquiry->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Email
                                    </th>
                                    <td>
                                        {{ $enquiry->email }}
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th>
                                        Phone
                                    </th>
                                    <td class="word-break">
                                        {{ $enquiry->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        City
                                    </th>
                                    <td>
                                        {{ $enquiry->city }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Sell.do.id
                                    </th>
                                    <td> {{ $lead->sell_do_lead_id }}</td>
                               
                                </tr>
                                <tr>
                                    <th>
                                        Status
                                    </th>
                                    <td>
                                        @if ($lead->sell_do_is_exist)
                                            <b class="text-danger">Duplicate</b>
                                        @else
                                            <b class="text-success">New</b>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Sell.do.date
                                    </th>
                                    <td>
                                        @if (!empty($lead->sell_do_lead_created_at))
                                            {{ Carbon\Carbon::parse($lead->sell_do_lead_created_at)->format('d/m/Y') }}
                                        @endif
                                    </td>
                                  
                               
                                </tr>
                                <tr>
                                    <th>
                                        Sell.do.time
                                    </th>
                                    <td>
                                        @if (!empty($lead->sell_do_lead_created_at))
                                            {{ Carbon\Carbon::parse($lead->sell_do_lead_created_at)->format('h:i A') }}
                                        @endif
                                    </td>
                               
                                </tr>
                                <tr>
                                    <th>
                                        Referred By
                                    </th>
                                    <td>
                                        {{ $enquiry->referred_by }}
                                    </td>
                                </tr>
@endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

@endsection
