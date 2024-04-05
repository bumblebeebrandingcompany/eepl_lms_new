@php
    $details_of_co_applicant = $event->webhook_data['details_of_co_applicant'] ?? [];
@endphp
@includeIf('admin.bookings.partials.common_details_of_co_applicant')
<div class="col-md-6">
    <div class="form-group">
        <label for="details_of_co_applicant_sex">
            @lang('messages.gender')
        </label>
        <select name="details_of_co_applicant[gender]" id="details_of_co_applicant_sex" class="form-control">
            <option value="">@lang('messages.please_select')</option>
            <option value="Male" @if(!empty($details_of_co_applicant['gender']) && $details_of_co_applicant['gender'] == 'Male') selected @endif>Male</option>
            <option value="Female" @if(!empty($details_of_co_applicant['gender']) && $details_of_co_applicant['gender'] == 'Female') selected @endif>Female</option>
        </select>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="details_of_co_applicant_Profession">
            Profession
        </label>
        <input type="text" name="details_of_co_applicant[profession]" id="details_of_co_applicant_Profession" class="form-control"
        value="{{$details_of_co_applicant['profession'] ?? ''}}">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="details_of_co_applicant_Designation">
            Designation
        </label>
        <input type="text" name="details_of_co_applicant[designation]" id="details_of_co_applicant_Designation" class="form-control" value="{{$details_of_co_applicant['designation'] ?? ''}}">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="details_of_co_applicant_company_name">
            @lang('messages.company_name')
        </label>
        <input type="text" name="details_of_co_applicant[company_name]" id="details_of_co_applicant_company_name" class="form-control"
        value="{{$details_of_co_applicant['company_name'] ?? ''}}">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="details_of_co_applicant_residential_status">
            @lang('messages.residential_status')
        </label>
        <select name="details_of_co_applicant[residential_status]" id="details_of_co_applicant_residential_status" class="form-control">
            <option value="">@lang('messages.please_select')</option>
            <option value="Resident" @if(!empty($details_of_co_applicant['residential_status']) && $details_of_co_applicant['residential_status'] == 'Resident') selected @endif>Resident</option>
            <option value="NRI" @if(!empty($details_of_co_applicant['residential_status']) && $details_of_co_applicant['residential_status'] == 'NRI') selected @endif>NRI</option>
        </select>
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label for="details_of_co_applicant_Correspondence_Address">
            Correspondence Address
        </label>
        <textarea name="details_of_co_applicant[correspondence_address]" id="details_of_co_applicant_Correspondence_Address" class="form-control" cols="2">{!!$details_of_co_applicant['correspondence_address'] ?? ''!!}</textarea>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="details_of_co_applicant_pan">
            @lang('messages.pan')
        </label>
        <input type="text" name="details_of_co_applicant[pan]" id="details_of_co_applicant_pan" class="form-control"
            value="{{$details_of_co_applicant['pan'] ?? ''}}">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="details_of_co_applicant_age">
            Age
        </label>
        <input type="text" name="details_of_co_applicant[age]" id="details_of_co_applicant_age" class="form-control co_applicant_age"  value="{{$details_of_co_applicant['age'] ?? ''}}">
    </div>
</div>
