{{-- essential Fields --}}
<div class="row">
    <div class="col-md-5">
        @if ($project->essential_fields)
            @foreach ($project->essential_fields as $key => $essentialField)
                @if (isset($essentialField['enabled']) && $essentialField['enabled'] === '1')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required">
                                    @lang('messages.key')
                                </label>
                                <input type="text"
                                    name="api[{{ $webhook_key }}][request_body][{{ $rb_key }}][key][]"
                                    value="{{ $essentialField['name_value'] }}" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="required">
                                @lang('messages.value')
                            </label>

                            <select class= "select2"
                                name="api[{{ $webhook_key }}][request_body][{{ $rb_key }}][value][]"
                                class="form-control">
                                <option value="" selected>Please Select</option>
                                @foreach ($selldo as $selldoData) 
                                    <option value="{{ $selldoData->name }}">{{ $selldoData->name }}</option>
                                @endforeach

                            </select>

                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <div class="form-group">
                <label class="required">
                    @lang('messages.value')
                </label>
                <input type="text" name="essential_fields[description]" value="" class="form-control">
                <div class="col-md-1 mt-auto mb-auto">
                    <div class="form-group">
                        <button type="button" class="btn btn-danger btn-sm float-right delete_request_body_row">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Custom Fields --}}
<div class="row">
    <div class="col-md-5">
        @if ($project->custom_fields)
            @foreach ($project->custom_fields as $key => $customField)
                @if (isset($customField['enabled']) && $customField['enabled'] === '1')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required">
                                    @lang('messages.key')
                                </label>
                                <input type="text"
                                    name="api[{{ $webhook_key }}][request_body][{{ $rb_key }}][key][]"
                                    value="{{ $customField['name_value'] }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required">
                                @lang('messages.value')
                            </label>

                            <select class= "select2"
                                name="api[{{ $webhook_key }}][request_body][{{ $rb_key }}][value][]"
                                class="form-control">
                                <option value="" selected>Please Select</option>
                                @foreach ($selldo as $selldoData)
                                  

                                    <option value="{{ $selldoData->name }}">{{ $selldoData->name }}</option>
                                @endforeach
                                <!-- Add other options as needed -->
                            </select>

                        </div>
                    </div>
                @endif
            @endforeach
        @else
        @endif
    </div>
</div>


{{-- sales fields --}}
<div class="row">
    <div class="col-md-5">
        @if ($project->sales_fields)
            @foreach ($project->sales_fields as $key => $salesField)
                @if (isset($salesField['enabled']) && $salesField['enabled'] === '1')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required">
                                    @lang('messages.key')
                                </label>
                                <input type="text"
                                    name="api[{{ $webhook_key }}][request_body][{{ $rb_key }}][key][]"
                                    value="{{ $salesField['name_value'] }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required">
                                @lang('messages.value')
                            </label>

                            <select class= "select2"
                                name="api[{{ $webhook_key }}][request_body][{{ $rb_key }}][value][]"
                                class="form-control">
                                <option value="" selected>Please Select</option>
                                @foreach ($selldo as $selldoData)
                                  

                                    <option value="{{ $selldoData->name }}">{{ $selldoData->name }}</option>
                                @endforeach
                                <!-- Add other options as needed -->
                            </select>

                        </div>
                    </div>
                @endif
            @endforeach
        @else
        @endif
    </div>
</div>

{{-- system fields --}}
<div class="row">
    <div class="col-md-5">
        @if ($project->system_fields)
            @foreach ($project->system_fields as $key => $systemField)
                @if (isset($systemField['enabled']) && $systemField['enabled'] === '1')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required">
                                    @lang('messages.key')
                                </label>
                                <input type="text"
                                    name="api[{{ $webhook_key }}][request_body][{{ $rb_key }}][key][]"
                                    value="{{ $systemField['name_value'] }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required">
                                @lang('messages.value')
                            </label>

                            <select class= "select2"
                                name="api[{{ $webhook_key }}][request_body][{{ $rb_key }}][value][]"
                                class="form-control">
                                <option value="" selected>Please Select</option>
                                @foreach ($selldo as $selldoData)
                                   
                                    <option value="{{ $selldoData->name }}">{{ $selldoData->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                @endif
            @endforeach
        @else
        @endif
    </div>
</div>
