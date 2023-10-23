<!-- @if(!empty($lead) && !empty($lead->sell_do_lead_id))
    <div class="col-md-6">
        <div class="form-group">
            <label for="sell_do_lead_id">
                Sell.do ID
            </label>
            <input type="text" name="sell_do_lead_id" id="sell_do_lead_id" value="@if(!empty($lead) && !empty($lead->sell_do_lead_id)) {{$lead->sell_do_lead_id}} @endif" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="campaign_id">
                Campaign
            </label>
            <select name="campaign_id" id="campaign_id" class="form-control">
                @foreach($campaigns as $id => $name)
                    <option value="{{$id}}" @if(!empty($lead) && !empty($lead->campaign_id) && $lead->campaign_id == $id) selected @endif>
                        {{$name}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="medium">
                Medium
            </label>
            <input type="text" name="medium" id="medium" value="@if(!empty($lead) && !empty($lead->medium)) {{$lead->medium}} @endif" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="source">
                Source
            </label>
            <select name="source_id" id="source_id" class="form-control">
                <option value="Male" @if(!empty($lead) && !empty($lead->source_id) && $lead->source_id == 'Male') selected @endif>
                    Male
                </option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="sub_source">
                Sub Source
            </label>
            <input type="text" name="sub_source" id="sub_source" value="@if(!empty($lead) && !empty($lead->sub_source)) {{$lead->sub_source}} @endif" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="project">
                Project
            </label>
            <select name="project_id" id="project_id" class="form-control">
                @foreach($projects as $id => $name)
                    <option value="{{$id}}" 
                        @if(!empty($lead) && !empty($lead->project_id) && $lead->project_id == $id) selected @endif>
                        {{$name}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="sell_do_lead_created_at">
                Lead datetime {{\Carbon\Carbon::createFromTimestamp(strtotime($lead->sell_do_lead_created_at))->format('Y-m-d h:i A')}}
            </label>
            <input type="text" name="sell_do_lead_created_at" id="sell_do_lead_created_at" class="form-control sell_do_lead_created_at" readonly>
        </div>
    </div>
@endif -->