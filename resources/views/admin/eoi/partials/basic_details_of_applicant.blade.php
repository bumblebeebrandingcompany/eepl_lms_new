@includeIf('admin.eoi.partials.common_details_of_applicant')
@if(!empty($lead))
    <input type="hidden" name="lead_id" class="form-control" id="lead_id" value="{{$lead->id}}">
@endif
<div class="col-md-6">
    <div class="form-group">
        <label for="lead_details_pan]">
            @lang('messages.pan')
        </label>
        <input type="text" name="lead_details[pan]" id="lead_details_pan" value="@if(!empty($lead) && !empty($lead->lead_info['pan'])) {{$lead->lead_info['pan']}} @endif" class="form-control">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="lead_details_age">
            DOB
        </label>
        <input type="text" name="lead_details[dob]" id="lead_details_age" value="@if(!empty($lead) && !empty($lead->lead_info['dob'])) {{$lead->lead_info['dob']}} @endif" class="form-control applicant_dob" readonly>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="lead_details_sex" class="required">
            @lang('messages.sex')
        </label>
        <select name="lead_details[sex]" id="lead_details_sex" class="form-control" required>
            <option value="">@lang('messages.please_select')</option>
            <option value="Male" @if(!empty($lead) && !empty($lead->lead_info['sex']) && $lead->lead_info['sex'] == 'Male') selected @endif>Male</option>
            <option value="Female" @if(!empty($lead) && !empty($lead->lead_info['sex']) && $lead->lead_info['sex'] == 'Female') selected @endif>Female</option>
        </select>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="lead_details_Profession">
            Profession
        </label>
        <input type="text" name="lead_details[profession]" id="lead_details_Profession" value="@if(!empty($lead) && !empty($lead->lead_info['profession'])) {{$lead->lead_info['profession']}} @endif" class="form-control">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="lead_details_Designation">
            Designation
        </label>
        <input type="text" name="lead_details[designation]" id="lead_details_Designation" value="@if(!empty($lead) && !empty($lead->lead_info['designation'])) {{$lead->lead_info['designation']}} @endif" class="form-control">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="lead_details_company_name">
            @lang('messages.company_name')
        </label>
        <input type="text" name="lead_details[company_name]" id="lead_details_company_name" value="@if(!empty($lead) && !empty($lead->lead_info['company_name'])) {{$lead->lead_info['company_name']}} @endif" class="form-control">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="lead_details_residential_status">
            @lang('messages.residential_status')
        </label>
        <select name="lead_details[residential_status]" id="lead_details_residential_status" class="form-control">
            <option value="">@lang('messages.please_select')</option>
            <option value="Resident" @if(!empty($lead) && !empty($lead->lead_info['residential_status']) && $lead->lead_info['residential_status'] == 'Resident') selected @endif>Resident</option>
            <option value="NRI" @if(!empty($lead) && !empty($lead->lead_info['residential_status']) && $lead->lead_info['residential_status'] == 'NRI') selected @endif">NRI</option>
        </select>
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label for="lead_details_Correspondence_Address">
            Correspondence Address
        </label>
        <textarea name="lead_details[correspondence_address]" id="lead_details_Correspondence_Address" class="form-control" cols="2">@if(!empty($lead) && !empty($lead->lead_info['correspondence_address'])) {!!$lead->lead_info['correspondence_address']!!} @endif</textarea>
    </div>
</div>