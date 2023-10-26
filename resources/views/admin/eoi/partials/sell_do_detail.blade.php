<div class="col-md-6">
    <div class="form-group">
        <label for="sell_do_lead_id">
            Sell.do ID
        </label>
        <input type="text" name="sell_do_lead_id" id="sell_do_lead_id" value="@if(!empty($lead) && !empty($lead->sell_do_lead_id)) {{$lead->sell_do_lead_id}} @endif" class="form-control" readonly>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="ref_num">
            Lead ref num
        </label>
        <input type="text" name="ref_num" id="ref_num" value="@if(!empty($lead) && !empty($lead->ref_num)) {{$lead->ref_num}} @endif" class="form-control" readonly>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="lead_date">
            Lead date
        </label>
        <input type="text" name="lead_date" id="lead_date" value="@if(!empty($lead) && !empty($lead->sell_do_lead_created_at)) {{@format_datetime($lead->sell_do_lead_created_at)}} @endif" class="form-control" readonly disabled>
    </div>
</div>
@if(!empty($sources))
@php
    $source_id = $event->webhook_data['source_id'] ?? '';
@endphp
<div class="col-md-6">
    <div class="form-group">
        <label for="source_id">
            Source
        </label>
        <select name="source_id" id="source_id" class="form-control select2">
            @foreach($sources as $id => $name)
                <option value="{{$id}}"
                    @if(!empty($source_id) && $source_id == $id)
                        selected
                    @endif>
                    {{$name}}
                </option>
            @endforeach
        </select>
    </div>
</div>
@endif
<div class="col-md-6">
    @php
        $sub_source = $event->webhook_data['sub_source'] ?? '';
    @endphp
    <div class="form-group">
        <label for="sub_source">
            Sub Source
        </label>
        <input type="text" name="sub_source" id="sub_source" value="{{$sub_source ?? ''}}" class="form-control">
    </div>
</div>
@if(!empty($campaigns))
@php
    $campaign_id = $event->webhook_data['campaign_id'] ?? '';
@endphp
<div class="col-md-6">
    <div class="form-group">
        <label for="campaign_id">
            Campaign
        </label>
        <select name="campaign_id" id="campaign_id" class="form-control select2">
            @foreach($campaigns as $id => $name)
                <option value="{{$id}}" @if(!empty($campaign_id) && $campaign_id == $id) selected @endif>
                    {{$name}}
                </option>
            @endforeach
        </select>
    </div>
</div>
@endif
@php
    $Sales_Person_Details = $event->webhook_data['Sales_Person_Details'] ?? [];
@endphp
<div class="col-md-6">
    <div class="form-group">
        <label for="Sales_Person_Details_Sell_do_name">
            Sales Person Name
        </label>
        <input type="text" name="Sales_Person_Details[Sales_Person_Name]" id="Sales_Person_Details_Sell_do_name" class="form-control" value="{{$Sales_Person_Details['Sales_Person_Name'] ?? ''}}">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="Sales_Person_Details_Sell_do_ID">
            Sales Person ID
        </label>
        <input type="text" name="Sales_Person_Details[Sales_Person_ID]" id="Sales_Person_Details_Sell_do_ID" class="form-control" value="{{$Sales_Person_Details['Sales_Person_ID'] ?? ''}}">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="interested_project">
            Project Interested In
        </label>
        <input type="text" name="interested_project" class="form-control" id="interested_project" value="{{$lead->project->name ?? ''}}" readonly>
    </div>
</div>