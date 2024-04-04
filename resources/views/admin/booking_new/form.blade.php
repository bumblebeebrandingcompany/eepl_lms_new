@extends('layouts.admin')
@section('content')
    <h2>Registration Form</h2>
    <form id="BookingFormId" method="POST" enctype="multipart/form-data"
        action="{{ route('admin.booking.update', $booking->id) }}">
        @csrf
        @method('PUT')
        <div id="showfollowup" class="myDiv">
            <div class="modal-body">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="payment_mode">Mode of Payment</label>
                            <select name="payment_mode" id="payment_mode" class="form-control">
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
                            <div id="chequeDetails" style="display: none;">
                                <div class="form-group">
                                    <label for="cheque_no">Cheque No</label>
                                    <input class="form-control {{ $errors->has('cheque_no') ? 'is-invalid' : '' }}"
                                        type="text" name="cheque_no" id="cheque_no" value="{{ old('cheque_no', '') }}">
                                    @if ($errors->has('cheque_no'))
                                        <span class="text-danger">{{ $errors->first('cheque_no') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                                </div>
                                <div class="col-sm-3">
                                    <label for="Date"> Select Cheque Date </label>
                                    <input type="date"
                                        class="form-control datepicker {{ $errors->has('form-control datepicker') ? 'is-invalid' : '' }}"
                                        name="cheque_date" id="cheque_date" rows="3">{{ old('cheque_date') }}
                                </div>
                                <br>


                                <br>
                                <div class="form-group">
                                    <label for="account_no">Account No</label>
                                    <input class="form-control {{ $errors->has('account_no') ? 'is-invalid' : '' }}"
                                        type="text" name="account_no" id="account_no"
                                        value="{{ old('account_no', '') }}">
                                    @if ($errors->has('account_no'))
                                        <span class="text-danger">{{ $errors->first('account_no') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                                </div>
                            </div>
                            <div id="ddDetails" style="display: none;">
                                <div class="form-group">
                                    <label for="Bank Name">DD name</label>
                                    <input class="form-control {{ $errors->has('dd_name') ? 'is-invalid' : '' }}"
                                        type="text" name="dd_name" id="dd_name" value="{{ old('dd_name', '') }}">
                                    @if ($errors->has('dd_name'))
                                        <span class="text-danger">{{ $errors->first('dd_name') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="Bank Name">DD Bank</label>
                                    <input class="form-control {{ $errors->has('dd_bank') ? 'is-invalid' : '' }}"
                                        type="text" name="dd_bank" id="dd_bank" value="{{ old('dd_bank', '') }}">
                                    @if ($errors->has('dd_bank'))
                                        <span class="text-danger">{{ $errors->first('dd_bank') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="dd_no">DD No</label>
                                    <input class="form-control {{ $errors->has('dd_no') ? 'is-invalid' : '' }}"
                                        type="text" name="dd_no" id="dd_no" value="{{ old('dd_no', '') }}">
                                    @if ($errors->has('dd_no'))
                                        <span class="text-danger">{{ $errors->first('dd_no') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="account_no">Account No</label>
                                    <input class="form-control {{ $errors->has('account_no') ? 'is-invalid' : '' }}"
                                        type="text" name="account_no" id="account_no"
                                        value="{{ old('account_no', '') }}">
                                    @if ($errors->has('account_no'))
                                        <span class="text-danger">{{ $errors->first('account_no') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                                </div>
                            </div>
                            <script>
                                document.getElementById('payment_mode').addEventListener('change', function() {
                                    var chequeDetails = document.getElementById('chequeDetails');
                                    var ddDetails = document.getElementById('ddDetails');

                                    chequeDetails.style.display = (this.value === '4') ? 'block' : 'none';
                                    ddDetails.style.display = (this.value === '5') ? 'block' : 'none';

                                });
                            </script>

                            <br>
                            <label for="Credited/Not_Credited">Credited/Not Credited</label>
                            <select name="credit/not_credit" id="credit_not_credit" class="form-control">
                                <option value="">@lang('messages.please_select')</option>
                                <option value="1">Credited</option>
                                <option value="2">Not Credited</option>
                            </select>

                            <!-- Hidden input field to store the status_id -->
                            <input type="hidden" name="status_id" id="status_id" value="0">

                            <script>
                                // Get the select element
                                var selectElement = document.getElementById('credit_not_credit');

                                // Add event listener to listen for changes
                                selectElement.addEventListener('change', function() {
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
                            <br>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="modal-footer">
                                        <button class="btn btn-danger" id=save_button type="submit">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
