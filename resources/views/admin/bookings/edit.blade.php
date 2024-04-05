{{-- @extends('layouts.admin')
@section('content')
<div class="row mb-2">
   <div class="col-sm-6">
        <h2>
         Booking
        </h2>
   </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ route("admin.bookings.update", ["booking" => $lead_event->lead_id]) }}" enctype="multipart/form-data" id="bookings">
            @csrf
            @method('PUT')
            @includeIf('admin.bookings.partials.form', ['lead' => $lead_event->lead, 'event' => $lead_event])
            <div class="row float-right">
                <div class="col-md-12">
             <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.update') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
       @includeIf('admin.bookings.partials.common_js')
    });
</script>
@endsection --}}
