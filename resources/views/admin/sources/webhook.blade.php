@extends('layouts.admin')
@section('content')
    <div class="row mb-2">
        <div class="col-sm-12">
            <h2>
                @lang('messages.configure_webhook_details')
                <small>
                    <strong>Source:</strong>
                    <span class="text-primary">{{ $source->name }}</span>
                    <strong>Project:</strong>
                    <span class="text-primary">{{ optional($source->project)->name }}</span>
                </small>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title">
                                {{ trans('messages.receive_webhook') }}
                            </h3>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-default float-right" href="{{ route('admin.sources.index') }}">
                                <i class="fas fa-chevron-left"></i>
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group webhook_div">
                                    <label for="webhook_url">
                                        {{ trans('messages.webhook_url') }}
                                    </label>
                                    <div class="input-group">
                                        <input type="text" id="webhook_url"
                                            value="{{ route('webhook.processor', ['secret' => $source->webhook_secret]) }}"
                                            class="form-control cursor-pointer copy_link" readonly>
                                        <div class="input-group-append cursor-pointer copy_link">
                                            <span class="input-group-text">
                                                <i class="fas fa-copy"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-12 d-flex justify-content-between mb-2">
                                <h3>
                                    {{ trans('messages.most_recent_lead') }}
                                </h3>
                                <button type="button" class="btn btn-outline-primary btn-xs refresh_latest_lead">
                                    <i class="fas fa-sync"></i>
                                    {{ trans('messages.refresh') }}
                                </button>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>{{ trans('messages.key') }}</th>
                                                <th>{{ trans('messages.value') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($lead) && !empty($lead->lead_info))
                                                @php
                                                    $serial_num = 0;
                                                @endphp
                                                @php
                                                    $decodedData = json_decode($lead->essential_fields, true) ?? [];
                                                    $salesData = json_decode($lead->sales_fields, true) ?? [];
                                                    $systemData = json_decode($lead->system_fields, true) ?? [];
                                                    $customData = json_decode($lead->custom_fields, true) ?? [];
                                                @endphp
                                                @foreach ($decodedData as $key => $value)
                                                    <tr>
                                                        <td>
                                                            {{ $key }}
                                                        </td>
                                                        <td>
                                                            {{ $value }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @foreach ($salesData as $key => $value)
                                                    <tr>
                                                        <td>
                                                            {{ $key }}
                                                        </td>
                                                        <td>
                                                            {{ $value }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @foreach ($systemData as $key => $value)
                                                    <tr>
                                                        <td>
                                                            {{ $key }}
                                                        </td>
                                                        <td>
                                                            {{ $value }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @foreach ($customData as $key => $value)
                                                    <tr>
                                                        <td>
                                                            {{ $key }}
                                                        </td>
                                                        <td>
                                                            {{ $value }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="2" class="text-center">
                                                        <span class="text-center">
                                                            {{ trans('messages.no_data_found') }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <form action="{{ route('admin.update.email.and.phone.key') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="source_id" value="{{ $source->id }}" id="source_id">
                                    <div class="row">

                                        @if ($source->project->essential_fields)
                                            @foreach ($source->project->essential_fields as $key => $essentialField)
                                                @if (isset($essentialField['enabled']) && $essentialField['enabled'] === '1')
                                                    <input type="hidden"
                                                        name="essential_fields[{{ $key }}][name_data]"
                                                        value="{{ $essentialField['name_data'] }}" class="form-control"
                                                        readonly>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="name">{{ $essentialField['name_data'] }}</label><br>
                                                            <label
                                                                for="name">{{ $essentialField['name_value'] }}</label><br>
                                                            <input type="hidden"
                                                                name="essential_fields[{{ $key }}][name_value]"
                                                                value="{{ $essentialField['name_value'] }}"
                                                                class="form-control" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <br>
                                                            <select class="form-control select2"
                                                                name="essential_fields[{{ $key }}][name_key]"
                                                                id="name_key">
                                                                <option value="">@lang('messages.please_select')</option>
                                                                @foreach ($existing_keys as $existing_key_value)
                                                                    @if (metaphone($existing_key_value) == metaphone($essentialField['name_value']))
                                                                        <option value="{{ $existing_key_value }}" selected>
                                                                            {{ $existing_key_value }}</option>
                                                                    @else
                                                                        <option value="{{ $existing_key_value }}">
                                                                            {{ $existing_key_value }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                        @if ($source->project->sales_fields)
                                            @foreach ($source->project->sales_fields as $key => $salesField)
                                                @if (isset($salesField['enabled']) && $salesField['enabled'] === '1')
                                                    <input type="hidden"
                                                        name="sales_fields[{{ $key }}][name_data]"
                                                        value="{{ $salesField['name_data'] }}" class="form-control"
                                                        readonly>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>
                                                                {{ $salesField['name_data'] }}
                                                            </label><br>
                                                            <label>
                                                                {{ $salesField['name_value'] }}
                                                            </label><br>
                                                            <input type="hidden"
                                                                name="sales_fields[{{ $key }}][name_value]"
                                                                value="{{ $salesField['name_value'] }}"
                                                                class="form-control" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <br>
                                                            <select class="form-control select2"
                                                                name="sales_fields[{{ $key }}][name_key]"
                                                                id="name_key">
                                                                <option value="">@lang('messages.please_select')</option>
                                                                @foreach ($existing_keys as $existing_key)
                                                                    @if (metaphone($existing_key) === metaphone($salesField['name_value']))
                                                                        <option value="{{ $existing_key }}" selected>
                                                                            {{ $existing_key }}</option>
                                                                    @else
                                                                        <option value="{{ $existing_key }}">
                                                                            {{ $existing_key }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                        @if ($source->project->system_fields)
                                            @foreach ($source->project->system_fields as $key => $systemField)
                                                @if (isset($systemField['enabled']) && $systemField['enabled'] === '1')
                                                    <input type="hidden"
                                                        name="system_fields[{{ $key }}][name_data]"
                                                        value="{{ $systemField['name_data'] }}" class="form-control"
                                                        readonly>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>
                                                                {{ $systemField['name_data'] }}
                                                            </label><br>
                                                            <label>
                                                                {{ $systemField['name_value'] }}
                                                            </label><br>
                                                            <input type="hidden"
                                                                name="system_fields[{{ $key }}][name_value]"
                                                                value="{{ $systemField['name_value'] }}"
                                                                class="form-control" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <br>
                                                            <select class="form-control select2"
                                                                name="system_fields[{{ $key }}][name_key]"
                                                                id="name_key">
                                                                <option value="">@lang('messages.please_select')</option>
                                                                @foreach ($existing_keys as $existing_key)
                                                                    @if (metaphone($existing_key) === metaphone($systemField['name_value']))
                                                                        <option value="{{ $existing_key }}" selected>
                                                                            {{ $existing_key }}</option>
                                                                    @else
                                                                        <option value="{{ $existing_key }}">
                                                                            {{ $existing_key }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                        @if ($source->project->custom_fields)
                                            @foreach ($source->project->custom_fields as $key => $customField)
                                                @if (isset($customField['enabled']) && $customField['enabled'] === '1')
                                                    <input type="hidden"
                                                        name="custom_fields[{{ $key }}][name_data]"
                                                        value="{{ $customField['name_data'] }}" class="form-control"
                                                        readonly>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>
                                                                {{ $customField['name_data'] }}
                                                            </label><br>
                                                            <label>
                                                                {{ $customField['name_value'] }}
                                                            </label><br>
                                                            <input type="hidden"
                                                                name="custom_fields[{{ $key }}][name_value]"
                                                                value="{{ $customField['name_value'] }}"
                                                                class="form-control" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            br>
                                                            <select class="form-control select2"
                                                                name="custom_fields[{{ $key }}][name_key]"
                                                                id="name_key">
                                                                <option value="">@lang('messages.please_select')</option>
                                                                @foreach ($existing_keys as $existing_key)
                                                                    @if (metaphone($existing_key) === metaphone($customField['name_value']))
                                                                        <option value="{{ $existing_key }}" selected>
                                                                            {{ $existing_key }}</option>
                                                                    @else
                                                                        <option value="{{ $existing_key }}">
                                                                            {{ $existing_key }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif


                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-outline-primary">
                                                {{ trans('messages.save') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function() {
            $(document).on('click', '.copy_link', function() {
                copyToClipboard($("#webhook_url").val());
            });

            function copyToClipboard(text) {
                const textarea = document.createElement('textarea');
                textarea.value = text;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);

                const span = document.createElement('span');
                span.innerText = 'Link copied to clipboard!';
                $(".webhook_div").append(span);
                setTimeout(() => {
                    span.remove();
                }, 300);
            }

            $(document).on('click', '.refresh_latest_lead', function() {
                location.reload();
            });
        });
    </script>
@endsection
