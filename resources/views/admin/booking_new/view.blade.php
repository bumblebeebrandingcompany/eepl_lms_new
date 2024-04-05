@extends('layouts.admin')
@section('content')
    <div class="row mb-2">
        <div class="col-sm-12 d-flex align-items-center justify-content-between">
            <h2>
               Booking
            </h2>
            <a class="btn btn-default float-right" href="{{ route('admin.bookings.index') }}" id="go_back_to_list_btn">
                <i class="fas fa-chevron-left"></i>
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            @includeIf('admin.bookings.partials.lead_details', ['lead' => $event->lead, 'project' => $event->project])
        </div>
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    @includeIf('admin.leads.partials.event_details.expression_of_interest', ['event' => $event, 'enable_header' => false])
                </div>
            </div>
        </div>
    </div>
@endsection
