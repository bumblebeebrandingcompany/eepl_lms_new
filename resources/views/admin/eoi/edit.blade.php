@extends('layouts.admin')
@section('content')
<div class="row mb-2">
   <div class="col-sm-6">
        <h2>
            {{ trans('global.edit') }} {{ trans('messages.expression_of_interest') }}
        </h2>
   </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ route("admin.eoi.update", ["eoi" => $lead_event->lead_id]) }}" enctype="multipart/form-data" id="eoi">
            @csrf
            @method('PUT')
            @includeIf('admin.eoi.partials.form', ['lead' => $lead_event->lead, 'event' => $lead_event])
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
       @includeIf('admin.eoi.partials.common_js')
    });
</script>
@endsection