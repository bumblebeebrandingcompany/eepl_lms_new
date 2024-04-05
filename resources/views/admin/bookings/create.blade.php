{{-- @extends('layouts.admin')
@section('content')
<div class="row mb-2">
   <div class="col-sm-6">
        <h2>
            {{ trans('global.add') }} Booking
        </h2>
   </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ route("admin.bookings.store") }}" enctype="multipart/form-data" id="bookings">
            @csrf
            @includeIf('admin.bookings.partials.form', ['lead' => '', 'event' => ''])
            <div class="row float-right">
                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
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
