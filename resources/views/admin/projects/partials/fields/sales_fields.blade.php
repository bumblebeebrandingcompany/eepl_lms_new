{{-- sales fields --}}
<div class="form-group">

    <div class="col-md-6">
        <label for="sales_fields">{{ trans('cruds.project.fields.sales') }}</label>
    </div>
    <div class="row mb-2">
        <div class="col-md-3">
            <label for="sales_fields">Sales User</label>
            <input type="hidden" name="sales_fields[0][name_data]" value="Sales User">
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="sales_fields[0][name_key]" id="email_value"
                value="sales_user" readonly>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="sales_fields[0][name_value]" id="name_value"
                value="bbc_lms[lead][sales_user]" readonly>
        </div>
        <div class="col-md-1">
            <label class="switch">
                <input type="checkbox" name="sales_fields[0][enabled]" value="1">
                <span class="slider round"></span>
                <input type="hidden" name="sales_fields[0][disabled]" value="0">
            </label>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-3">
            <label for="sales_fields">Lead Pickup Date</label>
            <input type="hidden" name="sales_fields[1][name_data]" value="Lead Pickup date">
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="sales_fields[1][name_key]" id="email_value"
                value="lead_pickup_date" readonly>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="sales_fields[1][name_value]" id="name_value"
                value="bbc_lms[lead][lead_pickup_date]" readonly>
        </div>
        <div class="col-md-1">
            <label class="switch">
                <input type="checkbox" name="sales_fields[1][enabled]" value="1">
                <span class="slider round"></span>
                <input type="hidden" name="sales_fields[1][disabled]" value="0">
            </label>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-md-3">
            <label for="sales_fields">Lead Pickup Time</label>
            <input type="hidden" name="sales_fields[2][name_data]" value="Lead Pickup Time">
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="sales_fields[2][name_key]" id="email_value"
                value="lead_pickup_time" readonly>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="sales_fields[2][name_value]" id="name_value"
                value="bbc_lms[lead][lead_pickup_time]" readonly>
        </div>
        <div class="col-md-1">
            <label class="switch">
                <input type="checkbox" name="sales_fields[2][enabled]" value="1">
                <span class="slider round"></span>
                <input type="hidden" name="sales_fields[2][disabled]" value="0">
            </label>
        </div>
    </div>
</div>
<div id="sales-fields-container">
</div>


