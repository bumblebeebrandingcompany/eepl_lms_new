@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h2>
                @lang('messages.lead_activities')
            </h2>
        </div>
    </div>
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label for="lead-activity">
                            Api to add lead activity
                        </label>
                        <input type="text" class="form-control" id="lead-activity" 
                            readonly value="{{route('webhook.store.lead.activity')}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4>@lang('messages.log')</h4>
                </div>
                <div class="col-md-12 mb-2">
                    <form method="get" action="{{ route('admin.webhook.lead.activities.log') }}" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search on lead activities..." id="lead_activities_response_search" value="{{$search_text ?? ''}}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-secondary search_data">
                                        @lang('messages.search')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th>@lang('messages.created_at')</th>
                                    <th>@lang('messages.event_type')</th>
                                    <th>@lang('messages.webhook_response')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($leads_activities_history as $lead_activity)
                                    <tr>
                                        <td>
                                            {{@format_datetime($lead_activity->created_at)}}
                                        </td>
                                        <td>
                                            {{ucfirst(str_replace('_', ' ', $lead_activity->event_type))}}
                                        </td>
                                        <td>
                                            @if(!empty($lead_activity->webhook_data))
                                                {{json_encode($lead_activity->webhook_data)}}
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            No log found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if(!empty($leads_activities_history->links()))
                    <div class="col-md-12 text-right mt-3">
                        {{ $leads_activities_history->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection