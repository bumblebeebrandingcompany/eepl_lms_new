<div class="row">
    <div class="col-md-12">
        @if(!empty($event))
            <input type="hidden" name="lead_event_id" class="form-control" value="{{$event->id}}">
        @endif
        <div class="card card-primary card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required" for="project_id">{{ trans('messages.project') }}</label>
                            <select name="project_id" id="project_id" class="form-control {{ $errors->has('project_id') ? 'is-invalid' : '' }}" >
                                @foreach($projects as $id => $project)
                                    <option value="{{$id}}">
                                        {{$project}}
                                    </option>
                                @endforeach
                            </select>
                            @if($errors->has('project_id'))
                                <span class="text-danger">Project is required.</span>
                            @endif
                            <span class="help-block text-muted">{{ trans('messages.choose_project') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="search_phone" class="required">
                                @lang('messages.phone')
                            </label>
                            <div class="input-group">
                                <input type="text" name="search_phone" id="search_phone" value="{{ old('search_phone') ? old('search_phone') : ($phone ?? '') }}" class="form-control input_number">
                                <div class="input-group-append search_lead cursor-pointer">
                                    <span class="input-group-text">
                                        Search
                                    </span>
                                </div>
                            </div>
                            <span class="help-block text-muted">
                                {{ trans('messages.search_lead_by_phone') }} <br>
                                Enter phone number including country code without + sign.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row info_section sell_do_and_lead_info">
    @includeIf('admin.eoi.partials.sell_do_and_lead_info')
</div>
<div class="row info_section">
    <div class="col-md-12">
        <div id="basic_details_of_co_applicant_accordion">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h4 class="card-title w-100">
                        <a class="d-block w-100 collapsed" data-toggle="collapse" href="#basic_details_of_co_applicant_accordion_collapse" aria-expanded="false">
                            <i class="fas fa-plus"></i>
                            Add Co-Applicant
                        </a>
                    </h4>
                </div>
                <div id="basic_details_of_co_applicant_accordion_collapse" class="collapse" data-parent="#basic_details_of_co_applicant_accordion">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <h5>
                                    @lang('messages.basic_details_of_co_applicant')
                                </h5>
                            </div>
                        </div>
                        <div class="row basic_common_details_of_co_applicant">
                            @includeIf('admin.eoi.partials.basic_common_details_of_co_applicant')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row info_section">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    Plot Details
                </h3>
            </div>
            @php
                $Plot_Details = $event->webhook_data['Plot_Details'] ?? [];
            @endphp
            <div class="card-body">
                <div class="form-group">
                    <label for="Extent_in_SQFT">
                        Extent in SQFT.
                    </label>
                    <input type="text" name="Plot_Details[Extent_in_SQFT]" id="Extent_in_SQFT" class="form-control"
                        value="{!! $Plot_Details['Extent_in_SQFT'] ?? '' !!}">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row info_section">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    EOI Application Date
                </h3>
            </div>
            @php
                $EOI_Application_Date = $event->webhook_data['EOI_Application_Date'] ?? [];
            @endphp
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Application_date">
                                Application date
                            </label>
                            <input type="text" name="EOI_Application_Date[Application_date]" id="Application_date" class="form-control application_date" readonly value="{{$EOI_Application_Date['Application_date'] ?? ''}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Application_time">
                                Application time
                            </label>
                            <input type="text" name="EOI_Application_Date[Application_time]" id="Application_time" class="form-control application_time" readonly value="{{$EOI_Application_Date['Application_time'] ?? ''}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row info_section">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    Loan
                </h3>
            </div>
            <div class="card-body">
            @php
                $Loan = $event->webhook_data['Loan'] ?? [];
            @endphp
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="interested_in_loan" class="required">
                                Interested in loan
                            </label>
                            <select name="Loan[interested_in_loan]" id="interested_in_loan" class="form-control" required>
                                <option value="">@lang('messages.please_select')</option>
                                <option value="Yes" @if(!empty($Loan['interested_in_loan']) && $Loan['interested_in_loan'] == 'Yes') selected @endif>Yes</option>
                                <option value="No" @if(!empty($Loan['interested_in_loan']) && $Loan['interested_in_loan'] == 'No') selected @endif>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 loan_div">
                        <div class="form-group">
                            <label for="loan_amount">
                                Loan Amount
                            </label>
                            <input type="number" name="Loan[loan_amount]" id="loan_amount" class="form-control" value="{{$Loan['loan_amount'] ?? ''}}">
                        </div>
                    </div>
                    <div class="col-md-4 loan_div">
                        <div class="form-group">
                            <label for="loan_from_which_bank">
                                Loan from which bank
                            </label>
                            <input type="text" name="Loan[loan_from_which_bank]" id="loan_from_which_bank" class="form-control" value="{{$Loan['loan_from_which_bank'] ?? ''}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row info_section">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    Advance Amount
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @php
                        $Advance_Amount = $event->webhook_data['Advance_Amount'] ?? [];
                    @endphp
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Cheque_No">
                                Cheque No.
                            </label>
                            <input type="text" name="Advance_Amount[Cheque_No]" id="Cheque_No" class="form-control" value="{{$Advance_Amount['Cheque_No'] ?? ''}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="adv_amount_date">
                                Date
                            </label>
                            <input type="text" name="Advance_Amount[date]" id="adv_amount_date" class="form-control adv_amount_date" value="{{$Advance_Amount['date'] ?? ''}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="adv_amount_bank">
                                Bank/Branch
                            </label>
                            <input type="text" name="Advance_Amount[bank]" id="adv_amount_bank" class="form-control" value="{{$Advance_Amount['bank'] ?? ''}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Advance_Amount_amount">
                                Amount
                            </label>
                            <input type="number" name="Advance_Amount[amount]" id="Advance_Amount_amount" class="form-control" value="{{$Advance_Amount['amount'] ?? ''}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row info_section">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    Financing Plan
                </h3>
            </div>
            <div class="card-body">
                @php
                    $Financing_Plan = $event->webhook_data['Financing_Plan'] ?? [];
                @endphp
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Financing_Plan_interested_in_loan" class="required">
                                Interested in loan
                            </label>
                            <select name="Financing_Plan[interested_in_loan]" id="Financing_Plan_interested_in_loan" class="form-control" required>
                                <option value="">@lang('messages.please_select')</option>
                                <option value="Yes" @if(!empty($Financing_Plan['interested_in_loan']) && $Financing_Plan['interested_in_loan'] == 'Yes') selected @endif>Yes</option>
                                <option value="No" @if(!empty($Financing_Plan['interested_in_loan']) && $Financing_Plan['interested_in_loan'] == 'No') selected @endif>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 Financing_Plan_div">
                        <div class="form-group">
                            <label for="Financing_Plan_Preferred_Bank">
                                Preferred Bank
                            </label>
                            <input type="text" name="Financing_Plan[preferred_bank]" id="Financing_Plan_Preferred_Bank" class="form-control" value="{{$Financing_Plan['preferred_bank'] ?? ''}}">
                        </div>
                    </div>
                    <div class="col-md-4 Financing_Plan_div">
                        <div class="form-group">
                            <label for="Financing_Plan_Own_Fund">
                                Own Fund
                            </label>
                            <input type="text" name="Financing_Plan[own_fund]" id="Financing_Plan_Own_Fund" class="form-control"
                            value="{{$Financing_Plan['own_fund'] ?? ''}}">
                        </div>
                    </div>
                    <div class="col-md-6 Financing_Plan_div">
                        <div class="form-group">
                            <label for="Financing_Plan_amount_of_loan">
                                Amount of Loan
                            </label>
                            <input type="number" name="Financing_Plan[amount_of_loan]" id="Financing_Plan_amount_of_loan" class="form-control" value="{{$Financing_Plan['amount_of_loan'] ?? ''}}">
                        </div>
                    </div>
                    <div class="col-md-6 Financing_Plan_div">
                        <div class="form-group">
                            <label for="Financing_Plan_Total">
                                Total
                            </label>
                            <input type="number" name="Financing_Plan[total]" id="Financing_Plan_Total" class="form-control" value="{{$Financing_Plan['total'] ?? ''}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div class="row info_section">
   <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    Sales Person Details
                </h3>
            </div>
            <div class="card-body">
                @php
                    $Sales_Person_Details = $event->webhook_data['Sales_Person_Details'] ?? [];
                @endphp
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Sales_Person_Details_Sell_do_ID">
                                Sell.do ID
                            </label>
                            <input type="text" name="Sales_Person_Details[Sell_do_ID]" id="Sales_Person_Details_Sell_do_ID" class="form-control" value="{{$Sales_Person_Details['Sell_do_ID'] ?? ''}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Sales_Person_Details_Sell_do_name">
                                Name
                            </label>
                            <input type="text" name="Sales_Person_Details[name]" id="Sales_Person_Details_Sell_do_name" class="form-control" value="{{$Sales_Person_Details['name'] ?? ''}}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div> -->
<div class="row info_section">
   <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-body">
                @php
                    $other = $event->webhook_data['other'] ?? [];
                @endphp
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="is_planning_to_construct_home" class="required">
                                Planning to Construct Home ?
                            </label>
                            <select name="other[is_planning_to_construct_home]" id="is_planning_to_construct_home" class="form-control" required>
                                <option value="">@lang('messages.please_select')</option>
                                <option value="Yes" @if(!empty($other['is_planning_to_construct_home']) && $other['is_planning_to_construct_home'] == 'Yes') selected @endif>Yes</option>
                                <option value="No" @if(!empty($other['is_planning_to_construct_home']) && $other['is_planning_to_construct_home'] == 'No') selected @endif>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Planning_to_Construct_Home">
                                If Yes, Please mention when ?
                            </label>
                            <select name="other[planning_to_construct_home]" id="Planning_to_Construct_Home" class="form-control">
                                <option value="">@lang('messages.please_select')</option>
                                <option value="Immediately" @if(!empty($other['planning_to_construct_home']) && $other['planning_to_construct_home'] == 'Immediately') selected @endif>Immediately</option>
                                <option value="Within 6-12 months" @if(!empty($other['planning_to_construct_home']) && $other['planning_to_construct_home'] == 'Within 6-12 months') selected @endif>Within 6-12 months</option>
                                <option value="After 1 year" @if(!empty($other['planning_to_construct_home']) && $other['planning_to_construct_home'] == 'After 1 year') selected @endif>After 1 year</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>
