<div class="form-group">
    <div class="col-md-6">
        <label for="essential_fields">{{ trans('cruds.project.fields.essential') }}</label>
    </div>
    <div class="row mb-2">
        <div class="col-md-3">
            <label for="essential_fields">Full Name</label>
            <input type="hidden" name="essential_fields[0][name_data]" value="Full Name">
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="essential_fields[0][name_key]" id="email_value"
                value="name" readonly>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="essential_fields[0][name_value]"
                id="name_value" value="bbc_lms[lead][name]" readonly>
        </div>
        <div class="col-md-1">
            <label class="switch">
                <input type="checkbox" name="essential_fields[0][enabled]" value="1">
                <span class="slider round"></span>
                <input type="hidden" name="essential_fields[0][disabled]" value="0">
            </label>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-3">
            <label for="essential_fields">Phone Number </label>
            <input type="hidden" name="essential_fields[1][name_data]" value="Phone Number ">
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="essential_fields[1][name_key]"
                id="email_value" value="phone_number" readonly>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="essential_fields[1][name_value]"
                id="name_value" value="bbc_lms[lead][phone]" readonly>
        </div>
        <div class="col-md-1">
            <label class="switch">
                <input type="checkbox" name="essential_fields[1][enabled]" value="1">
                <span class="slider round"></span>
                <input type="hidden" name="essential_fields[1][disabled]" value="0">
            </label>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-md-3">
            <label for="essential_fields">Email</label>
            <input type="hidden" name="essential_fields[2][name_data]" value="Email">
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="essential_fields[2][name_key]"
                id="email_value" value="email" readonly>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="essential_fields[2][name_value]"
                id="name_value" value="bbc_lms[lead][email]" readonly>
        </div>
        <div class="col-md-1">
            <label class="switch">
                <input type="checkbox" name="essential_fields[2][enabled]" value="1">
                <span class="slider round"></span>
                <input type="hidden" name="essential_fields[2][disabled]" value="0">
            </label>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-3">
            <label for="essential_fields">Addl Number</label>
            <input type="hidden" name="essential_fields[3][name_data]" value="Addl Number">
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="essential_fields[3][name_key]"
                id="email_value" value="addl_number" readonly>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="essential_fields[3][name_value]"
                id="name_value" value="bbc_lms[lead][addl_number]" readonly>
        </div>
        <div class="col-md-1">
            <label class="switch">
                <input type="checkbox" name="essential_fields[3][enabled]" value="1">
                <span class="slider round"></span>
                <input type="hidden" name="essential_fields[3][disabled]" value="0">
            </label>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-3">
            <label for="essential_fields">Addl Email</label>
            <input type="hidden" name="essential_fields[4][name_data]" value="Addl Email">
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="essential_fields[4][name_key]"
                id="email_value" value="addl_email" readonly>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="essential_fields[4][name_value]"
                id="name_value" value="bbc_lms[lead][addl_email]" readonly>
        </div>
        <div class="col-md-1">
            <label class="switch">
                <input type="checkbox" name="essential_fields[4][enabled]" value="1">
                <span class="slider round"></span>
                <input type="hidden" name="essential_fields[4][disabled]" value="0">
            </label>
        </div>
    </div>
    <div id="essential-fields-container">
    </div>
</div>


