<form id="BookingFormId" method="POST" enctype="multipart/form-data" action="{{ route('admin.booking.store') }}">

    <div class="modal-body">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <label for="name">Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                    id="name" value="{{ old('name', '') }}">
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
                                @elsex
                                @if ($key == 'ChannelPartner')
                                    <option value="{{ $key }}" selected>
                                        {{ $label }}
                                    </option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="base_price">Per Sqft Base Price</label>
                                <input class="form-control {{ $errors->has('base_price') ? 'is-invalid' : '' }}"
                                    type="text" name="per_sqft_based_price" id="base_price"
                                    oninput="calculateTotal()">
                                @if ($errors->has('base_price'))
                                    <span class="text-danger">{{ $errors->first('base_price') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{-- 
                        <div class="form-group">
                            <label for="overall_sqft">Overall Sqft</label>
                            <input class="form-control {{ $errors->has('overall_sqft') ? 'is-invalid' : '' }}"
                                type="text" name="overall_sqft" id="overall_sqft"
                                value=" {{ $plotdetail->total_sqfts }}" oninput="calculateTotal()" readonly>
                            @if ($errors->has('overall_sqft'))
                                <span class="text-danger">{{ $errors->first('overall_sqft') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                        </div> --}}
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
                                <input class="form-control" type="text" name="total_amount"
                                    id="totalAfterDiscount" readonly>
                            </div>
                        </div>
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
                    <button type="button" onclick="addAdvanceAmountField()" class="btn btn-primary">Add</button>
                    <div class="parent-container">
                        <div class="payment-container">
                            <div class="row">
                                <div class="col-md-4">
                                    <div id="advance_amount_container">
                                        <label for="advance_amount">Advance Amount</label>
                                        <input class="form-control advance_amount_input" type="text"
                                            name="advance_amount[][advance_amount]" id="advance_amount"
                                            oninput="calculateTotal()">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="payment_mode">Mode of Payment</label>
                                    <select name="advance_amount[][payment_mode]" id="payment_mode"
                                        class="form-control">
                                        <option value="">@lang('messages.please_select')</option>
                                        <option value="1">Card</option>
                                        <option value="2">Cash</option>
                                        <option value="3">UPI</option>
                                        <option value="4">Cheque</option>
                                        <option value="5">Demand Draft(DD)</option>
                                        <option value="6">NEFT</option>
                                        <option value="7">RTGS</option>
                                        <option value="8">UPI</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div id="chequeDetails" style="display: none;">
                                        <div class="form-group">
                                            <label for="advance_amount">Cheque No</label>
                                            <input
                                                class="form-control {{ $errors->has('cheque_no') ? 'is-invalid' : '' }}"
                                                type="text" name="advance_amount[][cheque_no]" id="cheque_no"
                                                value="{{ old('cheque_no', '') }}">
                                            @if ($errors->has('cheque_no'))
                                                <span class="text-danger">{{ $errors->first('cheque_no') }}</span>
                                            @endif
                                            <span
                                                class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="advance_amount"> Select Cheque Date </label>
                                            <input type="date"
                                                class="form-control datepicker {{ $errors->has('form-control datepicker') ? 'is-invalid' : '' }}"
                                                name="advance_amount[][cheque_date]" id="cheque_date"
                                                rows="3">{{ old('cheque_date') }}
                                        </div>
                                        <br>
                                        <br>
                                        <div class="form-group">
                                            <label for="advance_amount">Account No</label>
                                            <input
                                                class="form-control {{ $errors->has('account_no') ? 'is-invalid' : '' }}"
                                                type="text" name="advance_amount[][account_no]" id="account_no"
                                                value="{{ old('account_no', '') }}">
                                            @if ($errors->has('account_no'))
                                                <span class="text-danger">{{ $errors->first('account_no') }}</span>
                                            @endif
                                            <span
                                                class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                                        </div>
                                    </div>
                                    <div id="ddDetails" style="display: none;">
                                        <div class="form-group">
                                            <label for="advance_amount">DD name</label>
                                            <input
                                                class="form-control {{ $errors->has('dd_name') ? 'is-invalid' : '' }}"
                                                type="text" name="advance_amount[][dd_name]" id="dd_name">

                                            @if ($errors->has('dd_name'))
                                                <span class="text-danger">{{ $errors->first('dd_name') }}</span>
                                            @endif
                                            <span
                                                class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="advance_amount">DD Bank</label>
                                            <input
                                                class="form-control {{ $errors->has('dd_bank') ? 'is-invalid' : '' }}"
                                                type="text" name="advance_amount[][advance_amount]"
                                                id="advance_amount">


                                        </div>
                                        <div class="form-group">
                                            <label for="dd_no">DD No</label>
                                            <input
                                                class="form-control {{ $errors->has('dd_no') ? 'is-invalid' : '' }}"
                                                type="text" name="advance_amount[][dd_no]" id="dd_no">

                                        </div>
                                        <div class="form-group">
                                            <label for="account_no">Account No</label>
                                            <input
                                                class="form-control {{ $errors->has('account_no') ? 'is-invalid' : '' }}"
                                                type="text" name="advance_amount[][account_no]" id="account_no">
                                            @if ($errors->has('account_no'))
                                                <span class="text-danger">{{ $errors->first('account_no') }}</span>
                                            @endif
                                            <span
                                                class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                                        </div>



                                    </div>
                                    <div>
                                        <label for="Credited/Not_Credited">Credited/Not Credited</label>
                                        <select name="advance_amount[][credit_not_credit]" id="credit_not_credit"
                                            class="form-control">
                                            <option value="">@lang('messages.please_select')</option>
                                            <option value="1">Credited</option>
                                            <option value="2">Not Credited</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <!-- Hidden input field to store the status_id -->
                                    <input type="hidden" name="status_id" id="status_id" value="0">
                                </div>
                            </div>
                            <script>
                                // Get the select element
                                var selectElement = document.getElementById('credit_not_credit');

                                // Add event listener to listen for changes
                                selectElement.addEventListener('chan    ge', function() {
                                    var selectedValue = this.value;
                                    var statusIdInput = document.getElementById('status_id');

                                    // Update the value of status_id based on the selected option
                                    if (selectedValue === '1') {
                                        statusIdInput.value = '1'; // Set status_id to 1 if "Credited" is selected
                                    } else {
                                        statusIdInput.value = '2'; // Set status_id to 0 if "Not Credited" or no option is selected
                                    }
                                });
                            </script>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pending_amount">Pending Amount</label>
                                <input class="form-control" type="text" name="pending_amount" id="pending_amount"
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="form-group">
            <input type="hidden" name="plot_id" id="plot_id" class="form-control" value="{{ $plotdetail->id }}">
        </div> --}}
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

</form>

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
        window.onload = function() {
            calculateTotal();
        };
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initial setup for existing elements
            setupEventListeners();

            // Function to handle dynamic field addition
            function addAdvanceAmountField() {
                var parentContainer = document.querySelector('.parent-container');
                var paymentContainer = document.querySelector('.payment-container').cloneNode(true);

                // Reset input values and IDs
                var inputs = paymentContainer.querySelectorAll('input, select');
                inputs.forEach(function(input) {
                    input.value = '';
                    input.id = ''; // Remove ID to prevent conflicts
                });

                parentContainer.appendChild(paymentContainer);

                // Remove existing event listeners before setting up new ones
                removeEventListeners();
                // Set up event listeners for the newly added elements
                setupEventListeners();
            }

            // Event listener for the add button
            var addButton = document.querySelector('.btn.btn-primary');
            addButton.addEventListener('click', addAdvanceAmountField);

            // Function to set up event listeners for payment mode and display details
            function setupEventListeners() {
                var paymentMode = document.querySelectorAll(
                    '.payment-container select[name^="advance_amount["][name$="][payment_mode]"]');
                var chequeDetails = document.querySelectorAll('.payment-container #chequeDetails');
                var ddDetails = document.querySelectorAll('.payment-container #ddDetails');

                paymentMode.forEach(function(select, index) {
                    select.addEventListener('change', function() {
                        chequeDetails[index].style.display = (this.value === '4') ? 'block' :
                        'none';
                        ddDetails[index].style.display = (this.value === '5') ? 'block' : 'none';
                    });
                });
            }

            // Function to remove event listeners
            function removeEventListeners() {
                var paymentMode = document.querySelectorAll(
                    '.payment-container select[name^="advance_amount["][name$="][payment_mode]"]');
                paymentMode.forEach(function(select) {
                    select.removeEventListener('change', setupEventListeners);
                });
            }
        });
    </script>
