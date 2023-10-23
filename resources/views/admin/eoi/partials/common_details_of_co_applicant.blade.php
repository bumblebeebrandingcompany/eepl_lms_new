<div class="col-md-6">
    <div class="form-group">
        <label for="co_applicant_name">
            @lang('messages.name')
        </label>
        <input type="text" name="details_of_co_applicant[name]" id="co_applicant_name" class="form-control"
            value="{{$details_of_co_applicant['name'] ?? ''}}">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="co_applicant_email">
            @lang('messages.email')
        </label>
        <input type="email" name="details_of_co_applicant[email]" id="co_applicant_email" class="form-control"
            value="{{$details_of_co_applicant['email'] ?? ''}}">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="co_applicant_additional_email_key">
            @lang('messages.additional_email_key')
        </label>
        <input type="email" name="details_of_co_applicant[additional_email]" id="co_applicant_additional_email_key"  class="form-control" value="{{$details_of_co_applicant['additional_email'] ?? ''}}">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="co_applicant_phone">
            @lang('messages.phone')
        </label>
        <input type="text" name="details_of_co_applicant[phone]" id="co_applicant_phone" class="form-control input_number"
        value="{{$details_of_co_applicant['phone'] ?? ''}}">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="co_applicant_secondary_phone_key">
            @lang('messages.secondary_phone_key')
        </label>
        <input type="text" name="details_of_co_applicant[secondary_phone]" id="co_applicant_secondary_phone_key" class="form-control input_number" value="{{$details_of_co_applicant['secondary_phone'] ?? ''}}">
    </div>
</div>