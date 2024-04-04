@extends('layouts.admin')
@section('content')
    <form id="BookingFormId" method="POST" enctype="multipart/form-data" action="{{ route('admin.booking.store') }}">
        @csrf
        <div id="showfollowup" class="myDiv">
            <div class="modal-body">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <label for="name">Name</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                            name="name" id="name" value="{{ old('name', '') }}">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                        <label for="aadhar_no">Aadhar No</label>
                        <input class="form-control {{ $errors->has('aadhar_no') ? 'is-invalid' : '' }}" type="text"
                            name="aadhar_no" id="aadhar_no" value="{{ old('aadhar_no', '') }}">
                        @if ($errors->has('aadhar_no'))
                            <span class="text-danger">{{ $errors->first('aadhar_no') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                        <div class="form-group">
                            <label for="pan">Pan</label>
                            <input class="form-control {{ $errors->has('pan') ? 'is-invalid' : '' }}" type="text"
                                name="pan" id="pan" value="{{ old('pan', '') }}">
                            @if ($errors->has('pan'))
                                <span class="text-danger">{{ $errors->first('pan') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text"
                                name="phone" id="phone" value="{{ old('phone', '') }}">
                            @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="secondary_phone">Secondary Phone</label>
                            <input class="form-control {{ $errors->has('secondary_phone') ? 'is-invalid' : '' }}"
                                type="text" name="secondary_phone" id="secondary_phone"
                                value="{{ old('secondary_phone', '') }}">
                            @if ($errors->has('secondary_phone'))
                                <span class="text-danger">{{ $errors->first('secondary_phone') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text"
                                name="email" id="email" value="{{ old('email', '') }}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="secondary_email">Secondary email</label>
                            <input class="form-control {{ $errors->has('secondary_email') ? 'is-invalid' : '' }}"
                                type="text" name="secondary_email" id="secondary_email"
                                value="{{ old('secondary_email', '') }}">
                            @if ($errors->has('secondary_email'))
                                <span class="text-danger">{{ $errors->first('secondary_email') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                            <div class="form-group">
                                <label for="remarks">Remarks</label>
                                <select name="remarks" id="remarks" class="form-control">
                                    <option value="">@lang('messages.please_select')</option>
                                    <option value="Loan">Loan</option>
                                    <option value="Own Funding">Own Funding</option>
                                </select>
                            </div>
                            <label for="user_type">User Type</label>

                            <select
                                class="form-control user_type_input select2 {{ $errors->has('user_type') ? 'is-invalid' : '' }}"
                                name="user_type" id="user_type" required>
                                @foreach (App\Models\User::USER_TYPE_RADIO as $key => $label)
                                    @if (!auth()->user()->is_channel_partner_manager)
                                        <option value="{{ $key }}"
                                            {{ old('user_type', '') === (string) $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @else
                                        @if ($key == 'ChannelPartner')
                                            <option value="{{ $key }}" selected>
                                                {{ $label }}
                                            </option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card card-primary card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="base_price">Per Sqft Base Price</label>
                            <input class="form-control {{ $errors->has('base_price') ? 'is-invalid' : '' }}" type="text"
                                name="per_sqft_based_price" id="base_price" oninput="calculateTotal()">
                            @if ($errors->has('base_price'))
                                <span class="text-danger">{{ $errors->first('base_price') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="overall_sqft">Overall Sqft</label>
                            <input class="form-control {{ $errors->has('overall_sqft') ? 'is-invalid' : '' }}"
                                type="text" name="overall_sqft" id="overall_sqft"
                                value=" {{ $plotdetail->total_sqfts }}" oninput="calculateTotal()" readonly>
                            @if ($errors->has('overall_sqft'))
                                <span class="text-danger">{{ $errors->first('overall_sqft') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="total">Total Amount</label>
                            <input class="form-control" type="text" name="total" id="total" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="discount_value_sqft_based">Discount %</label>
                            <input
                                class="form-control {{ $errors->has('discount_value_sqft_based') ? 'is-invalid' : '' }}"
                                type="text" name="discount_value_sqft_based" id="discount"
                                value="{{ old('discount_value_sqft_based', '') }}" oninput="calculateTotal()">
                            @if ($errors->has('discount_value_sqft_based'))
                                <span class="text-danger">{{ $errors->first('discount_value_sqft_based') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="discount_amount_sqft_based">Discount Amount</label>
                            <input class="form-control" type="text" name="discount_amount_sqft_based"
                                id="discountAmount" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="total_amount">Amount</label>
                            <input class="form-control" type="text" name="total_amount" id="totalAfterDiscount"
                                readonly>
                        </div>
                    </div>
                </div>

                {{-- <div class="row">
                    @php
                        $plcNames = json_decode($plotdetail->plc_values);
                    @endphp
                    @if ($plcNames && is_array($plcNames))
                        @foreach ($plcNames as $plcName)
                            @php
                                $plc = App\Models\Plc::where('name', $plcName)->first();
                            @endphp
                            @if ($plc)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="total">PLC Name</label>
                                        <input class="form-control" type="text" name="total"
                                            value="{{ $plc->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="total">PLC Price</label>
                                        <input class="form-control" type="text"id="per_sqft_plc" name="plc_values"
                                            value="{{ $plc->price }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="total">PLC Price</label>
                                        <input class="form-control total_sqft_plc" type="text" id="total_sqft_plc"
                                            name="total" data-plc-tag="{{ $plc->{'increment/decrement'} }}"
                                            value="{{ $plc->price * $plotdetail->total_sqfts }}" readonly>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="total" value="PLC not found"
                                            readonly>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="total">Total PLC</label>
                                <input class="form-control" type="text" id="plc_price" name="plc_values" readonly>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="total_plc">Total Amount</label>
                            <input class="form-control" type="text" name="total_plc" id="total_plc" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="discount_value_including_plc">Discount PLC (%)</label>
                            <input class="form-control" type="text" name="discount_value_including_plc"
                                id="discount_value_including_plc" oninput="calculateTotal()">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="discount_amount_including_plc">Discount PLC Price</label>
                            <input class="form-control" type="text" name="discount_amount_including_plc"
                                id="discount_amount_including_plc" readonly>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="col-md-3">
                        <div class="form-group">
                            <label for="plc_values">Total</label>
                            <input class="form-control" type="text" name="total_amount" id="plc_values" readonly>
                        </div>
                    </div> --}}
                <button type="button" onclick="addAdvanceAmountField()" class="btn btn-primary">Add</button>


                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                        <div id="advance_amount_container">
                            <div class="form-group">
                                <label for="advance_amount">Advance Amount</label>
                                <input class="form-control advance_amount_input" type="text" name="advance_amount[]"
                                    id="advance_amount" oninput="calculateTotal()">
                            </div>
                        </div>
                    </div>
                    <div id="advance_amount_container"></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pending_amount">Pending Amount</label>
                            <input class="form-control" type="text" name="pending_amount" id="pending_amount"
                                readonly>
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group">
                <input type="hidden" name="plot_id" id="plot_id" class="form-control"
                    value="{{ $plotdetail->id }}">
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label for="status_id">Status</label>
                    <select name="status_id" id="status_id" class="form-control">
                        <option value="">@lang('messages.please_select')</option>
                        <option value="1">Booked</option>
                        <option value="2">Blocked</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="modal-footer">
                        <button class="btn btn-danger" type="submit">
                            Save
                        </button>
                    </div>
                </div>
            </div>

        </div>
        </div>
        </div>

    </form>
@endsection

{{-- <script>
    function calculateTotal() {
        var perSqft = parseFloat(document.getElementById('base_price').value);
        var overallSqft = parseFloat(document.getElementById('overall_sqft').value);
        var discount = parseFloat(document.getElementById('discount').value);
        var advanceAmount = parseFloat(document.getElementById('advance_amount').value);
        var plcPrice = 0;
        var totalSqftPLCInputs = document.getElementsByClassName('total_sqft_plc');


        // for (var i = 0; i < totalSqftPLCInputs.length; i++) {
        //     var plcTag = totalSqftPLCInputs[i].getAttribute('data-plc-tag');
        //     var plcValue = parseFloat(totalSqftPLCInputs[i].value) || 0;

        //     console.log('plots:', i, 'data-plc-tag:', plcTag);

        //     if (plcTag !== null) { 
        //         plcTag = parseInt(plcTag);
        //         if (!isNaN(plcTag)) { 
        //             if (plcTag === 1) {
        //                 plcPrice += plcValue;
        //             } else if (plcTag === 0) { // Decrement
        //                 plcPrice -= plcValue;
        //             }
        //         }
        //     }
        // }
        discount = isNaN(discount) ? 0 : discount;
        var total = perSqft * overallSqft;
        var discountAmount = (total * discount) / 100;
        var totalAfterDiscount = total - discountAmount;

        var totalPLCAmount = isNaN(plcPrice) ? 0 : plcPrice;
        var totalAmountWithPLC = totalAfterDiscount + totalPLCAmount;

        document.getElementById('total').value = isNaN(total) ? '' : total.toFixed(2);
        document.getElementById('discountAmount').value = isNaN(discountAmount) ? '' : discountAmount.toFixed(2);
        document.getElementById('totalAfterDiscount').value = isNaN(totalAfterDiscount) ? '' : totalAfterDiscount
            .toFixed(2);
        // document.getElementById('total_plc').value = isNaN(totalAmountWithPLC) ? '' : totalAmountWithPLC.toFixed(2);
        // document.getElementById('plc_price').value = isNaN(plcPrice) ? '' : plcPrice.toFixed(2);
        // var discountPLC = parseFloat(document.getElementById('discount_value_including_plc').value);
        // discountPLC = isNaN(discountPLC) ? 0 : discountPLC;
        // var discountAmountPLC = (totalAmountWithPLC * discountPLC) / 100;
        // document.getElementById('discount_amount_including_plc').value = isNaN(discountAmountPLC) ? '' :
        //     discountAmountPLC.toFixed(2);


        // var plcValues = totalAmountWithPLC - discountAmountPLC;
        // document.getElementById('plc_values').value = isNaN(plcValues) ? '' : plcValues.toFixed(2);
        // var pendingAmount = 0;
        // if (isNaN(advanceAmount) || advanceAmount === '') {
        //     pendingAmount = totalAfterDiscount;
        // } else {
        //     pendingAmount = totalAfterDiscount - advanceAmount;
        // }
        pendingAmount = totalAfterDiscount - advanceAmount;
        document.getElementById('pending_amount').value = isNaN(pendingAmount) ? '' : pendingAmount.toFixed(2);
    }
    if (pendingAmount !== 0) {
            var newAdvanceAmountField = document.createElement('input');
            newAdvanceAmountField.setAttribute('class', 'form-control');
            newAdvanceAmountField.setAttribute('type', 'text');
            newAdvanceAmountField.setAttribute('name', 'advance_amount[]');
            newAdvanceAmountField.setAttribute('id', 'advance_amount_2');
            newAdvanceAmountField.setAttribute('oninput', 'calculateTotal()');
            document.getElementById('advance_amount_container').appendChild(newAdvanceAmountField);
        }
    // Call calculateTotal() when the page loads
    window.onload = function() {
        calculateTotal();
    };
</script> --}}
<script>
    function calculateTotal() {
        var perSqft = parseFloat(document.getElementById('base_price').value);
        var overallSqft = parseFloat(document.getElementById('overall_sqft').value);
        var discount = parseFloat(document.getElementById('discount').value);
        var total = perSqft * overallSqft;
        var discountAmount = (total * discount) / 100;
        var totalAfterDiscount = total - discountAmount;
        var totalAdvanceAmount = 0;

        // Sum up all advance amounts
        var advanceAmountInputs = document.getElementsByClassName('advance_amount_input');
        for (var i = 0; i < advanceAmountInputs.length; i++) {
            totalAdvanceAmount += parseFloat(advanceAmountInputs[i].value) || 0;
        }

        var pendingAmount = totalAfterDiscount - totalAdvanceAmount;

        // Update total amount, discount amount, total after discount, and pending amount fields
        document.getElementById('total').value = isNaN(total) ? '' : total.toFixed(2);
        document.getElementById('discountAmount').value = isNaN(discountAmount) ? '' : discountAmount.toFixed(2);
        document.getElementById('totalAfterDiscount').value = isNaN(totalAfterDiscount) ? '' : totalAfterDiscount
            .toFixed(2);
        document.getElementById('pending_amount').value = isNaN(pendingAmount) ? '' : pendingAmount.toFixed(2);
    }

    function addAdvanceAmountField() {
        var container = document.getElementById('advance_amount_container');
        var newAdvanceAmountField = document.createElement('div');
        newAdvanceAmountField.innerHTML = `
            <div class="form-group">
                <label for="advance_amount">Advance Amount</label>
                <input class="form-control advance_amount_input" type="text" name="advance_amount[]" oninput="calculateTotal()">
            </div>
        `;
        container.appendChild(newAdvanceAmountField);
    }

    // Call calculateTotal() when the page loads
    window.onload = function() {
        calculateTotal();
    };
</script>
