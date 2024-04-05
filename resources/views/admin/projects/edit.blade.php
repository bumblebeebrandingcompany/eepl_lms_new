@extends('layouts.admin')
@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h2>
                {{ trans('global.edit') }} {{ trans('cruds.project.title_singular') }}
            </h2>
        </div>
    </div>
    <div class="card card-primary card-outline">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.projects.update', [$project->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.project.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                        id="name" value="{{ old('name', $project->name) }}" required>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.project.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="start_date">{{ trans('cruds.project.fields.start_date') }}</label>
                    <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text"
                        name="start_date" id="start_date" value="{{ old('start_date', $project->start_date) }}">
                    @if ($errors->has('start_date'))
                        <span class="text-danger">{{ $errors->first('start_date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.project.fields.start_date_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="end_date">{{ trans('cruds.project.fields.end_date') }}</label>
                    <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text"
                        name="end_date" id="end_date" value="{{ old('end_date', $project->end_date) }}">
                    @if ($errors->has('end_date'))
                        <span class="text-danger">{{ $errors->first('end_date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.project.fields.end_date_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="client_id">{{ trans('cruds.project.fields.client') }}</label>
                    <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id"
                        id="client_id" required>
                        @foreach ($clients as $id => $entry)
                            <option value="{{ $id }}"
                                {{ (old('client_id') ? old('client_id') : $project->client->id ?? '') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('client'))
                        <span class="text-danger">{{ $errors->first('client') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.project.fields.client_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="location">{{ trans('cruds.project.fields.location') }}</label>
                    <input class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" type="text"
                        name="location" id="location" value="{{ old('location', $project->location) }}">
                    @if ($errors->has('location'))
                        <span class="text-danger">{{ $errors->first('location') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="rera_no">Rera No</label>
                    <input class="form-control {{ $errors->has('rera_no') ? 'is-invalid' : '' }}" type="text"
                        name="rera_no" id="rera_no" value="{{ old('rera_no', $project->rera_no) }}">
                    @if ($errors->has('rera_no'))
                        <span class="text-danger">{{ $errors->first('rera_no') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="local_body_no">Local Body No</label>
                    <input class="form-control {{ $errors->has('local_body_no') ? 'is-invalid' : '' }}" type="text"
                        name="local_body_no" id="local_body_no"
                        value="{{ old('local_body_no', $project->local_body_no) }}">
                    @if ($errors->has('local_body_no'))
                        <span class="text-danger">{{ $errors->first('local_body_no') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="overall_sqfts">Overall Sqfts</label>
                    <input class="form-control {{ $errors->has('overall_sqfts') ? 'is-invalid' : '' }}" type="text"
                        name="overall_sqfts" id="overall_sqfts"
                        value="{{ old('overall_sqfts', $project->overall_sqfts) }}">
                    @if ($errors->has('overall_sqfts'))
                        <span class="text-danger">{{ $errors->first('overall_sqfts') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="no_of_plots">Total Plots</label>
                    <input class="form-control {{ $errors->has('no_of_plots') ? 'is-invalid' : '' }}" type="text"
                        name="no_of_plots" id="no_of_plots" value="{{ old('no_of_plots', $project->no_of_plots) }}">
                    @if ($errors->has('no_of_plots'))
                        <span class="text-danger">{{ $errors->first('no_of_plots') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="dtcp/cmda">Select anyone</label>
                    <select name="dtcp/cmda" class="edit-field"
                        style="{{ $errors->has('dtcp/cmda') ? '' : 'display:none;' }}" value="{{ old('dtcp/cmda') }}">
                        @if ($project->{'dtcp/cmda'})
                            <option value="{{ $project->{'dtcp/cmda'} }}" selected>{{ $project->{'dtcp/cmda'} }}
                            </option>
                        @else
                            <option value="" selected> Select one</option>
                        @endif
                        <option value="0">dtcp</option>
                        <option value="1">cmda</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dtcp/cmda_no">Dtcp/Cmda No </label>
                    <input class="form-control {{ $errors->has('dtcp/cmda_no') ? 'is-invalid' : '' }}" type="text"
                        name="dtcp/cmda_no" id="dtcp/cmda_no"
                        value="{{ old('dtcp/cmda_no', $project->{'dtcp/cmda_no'}) }}">
                    @if ($errors->has('dtcp/cmda_no'))
                        <span class="text-danger">{{ $errors->first('dtcp/cmda_no') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description">{{ trans('cruds.project.fields.description') }}</label>
                    <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                        id="description">{!! old('description', $project->description) !!}</textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.project.fields.description_helper') }}</span>
                </div>

                <!-- Your existing code for iterating over essential_fields -->


                <div class="form-group">
                    <label for="essential_fields">{{ trans('cruds.project.fields.essential') }}</label>
                    @if ($project->essential_fields)
                        @foreach ($project->essential_fields as $index => $field)
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label for="essential_fields">{{ $field['name_data'] }}</label>
                                    <input type="hidden" name="essential_fields[{{ $index }}][name_data]"
                                        value="{{ $field['name_data'] }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control"
                                        name="essential_fields[{{ $index }}][name_key]" id="email_value"
                                        value="{{ $field['name_key'] }}" readonly>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control"
                                        name="essential_fields[{{ $index }}][name_value]" id="name_value"
                                        value="{{ $field['name_value'] }}" readonly>
                                </div>
                                <div class="col-md-1">
                                    <label class="switch">
                                        <input type="checkbox" name="essential_fields[{{ $index }}][enabled]"
                                            value="1"
                                            {{ isset($field['enabled']) && $field['enabled'] ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                        <input type="hidden" name="essential_fields[{{ $index }}][disabled]"
                                            value="0">
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Handle the case where essential_fields is null or empty -->
                        No essential fields found.
                    @endif
                </div>
                <div class="form-group">
                    <label for="sales_fields">{{ trans('cruds.project.fields.sales') }}</label>
                    @if ($project->sales_fields)
                        @foreach ($project->sales_fields as $index => $field)
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label for="sales_fields">{{ $field['name_data'] }}</label>
                                    <input type="hidden" name="sales_fields[{{ $index }}][name_data]"
                                        value="{{ $field['name_data'] }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control"
                                        name="sales_fields[{{ $index }}][name_key]" id="email_value"
                                        value="{{ $field['name_key'] }}" readonly>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control"
                                        name="sales_fields[{{ $index }}][name_value]" id="name_value"
                                        value="{{ $field['name_value'] }}" readonly>
                                </div>
                                <div class="col-md-1">
                                    <label class="switch">
                                        <input type="checkbox" name="sales_fields[{{ $index }}][enabled]"
                                            value="1"
                                            {{ isset($field['enabled']) && $field['enabled'] ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                        <input type="hidden" name="sales_fields[{{ $index }}][disabled]"
                                            value="0">
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Handle the case where essential_fields is null or empty -->
                        No Sales fields found.
                    @endif
                </div>
                <div class="form-group">
                    <label for="system_fields">{{ trans('cruds.project.fields.system') }}</label>
                    @foreach ($project->system_fields as $index => $field)
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label for="system_fields">{{ $field['name_data'] }}</label>
                                <input type="hidden" name="system_fields[{{ $index }}][name_data]"
                                    value="{{ $field['name_data'] }}">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control"
                                    name="system_fields[{{ $index }}][name_key]" id="email_value"
                                    value="{{ $field['name_key'] }}" readonly>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control"
                                    name="system_fields[{{ $index }}][name_value]" id="name_value"
                                    value="{{ $field['name_value'] }}" readonly>
                            </div>
                            <div class="col-md-1">
                                <label class="switch">
                                    <input type="checkbox" name="system_fields[{{ $index }}][enabled]"
                                        value="1"
                                        {{ isset($field['enabled']) && $field['enabled'] ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                    <input type="hidden" name="system_fields[{{ $index }}][disabled]"
                                        value="0">
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <h3 class="bold">Custom Fields</h3>
                <div id="custom-fields-container">
                    @foreach ($project->custom_fields as $index => $custom_field)
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <input class="form-control" type="text"
                                    name="custom_fields[{{ $index }}][name_data]" placeholder="Field Name"
                                    value="{{ $custom_field['name_data'] }}">
                            </div>
                            <div class="col-md-3">
                                <input class="form-control" type="text"
                                    name="custom_fields[{{ $index }}][name_key]" placeholder="Field Name"
                                    value="{{ $custom_field['name_key'] }}">
                            </div>
                            <div class="col-md-3">
                                <input class="form-control" type="text"
                                    name="custom_fields[{{ $index }}][name_value]" placeholder="Field Value"
                                    value="{{ $custom_field['name_value'] }}">
                            </div>
                            <div class="col-md-1">
                                <label class="switch">
                                    <input type="checkbox" name="custom_fields[{{ $index }}][enabled]"
                                        value="1" {{ $custom_field['enabled'] ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                    <input type="hidden" name="custom_fields[{{ $index }}][disabled]"
                                        value="0">
                                </label>
                            </div>
                    @endforeach
                </div>
                <div class="col-md-6" style="margin-bottom: 20px">
                    <label for="custom_fields">{{ trans('cruds.project.fields.custom') }}</label>
                    <button type="button" id="add-custom-field" class="btn btn-primary rounded-pill">Add Field</button>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @foreach ($campaigns as $campaign)
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" name="campaign_id[]" value="{{ $campaign->id }}"
                                                {{ in_array($campaign->id, $selectedCampaigns) ? 'checked' : '' }}>
                                            {{ $campaign->campaign_name }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <select class="form-control select2" name="source_id[]" multiple>
                                            <option value="">@lang('messages.please_select')</option>
                                            @forelse ($sources as $source)
                                                @if ($source->campaign && $source->campaign->campaign_name == $campaign->campaign_name)
                                                    <option value="{{ $source->id }}"
                                                        {{ in_array($source->id, $selectedSources) ? 'selected' : '' }}>
                                                        {{ $source->name }}
                                                    </option>
                                                @endif
                                            @empty
                                                <option value="">No sources available</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">{{ trans('global.save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            function SimpleUploadAdapter(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                    return {
                        upload: function() {
                            return loader.file
                                .then(function(file) {
                                    return new Promise(function(resolve, reject) {
                                        // Init request
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST',
                                            '{{ route('admin.projects.storeCKEditorImages') }}',
                                            true);
                                        xhr.setRequestHeader('x-csrf-token', window._token);
                                        xhr.setRequestHeader('Accept', 'application/json');
                                        xhr.responseType = 'json';

                                        // Init listeners
                                        var genericErrorText =
                                            `Couldn't upload file: ${ file.name }.`;
                                        xhr.addEventListener('error', function() {
                                            reject(genericErrorText)
                                        });
                                        xhr.addEventListener('abort', function() {
                                            reject()
                                        });
                                        xhr.addEventListener('load', function() {
                                            var response = xhr.response;

                                            if (!response || xhr.status !== 201) {
                                                return reject(response && response
                                                    .message ?
                                                    `${genericErrorText}\n${xhr.status} ${response.message}` :
                                                    `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`
                                                );
                                            }

                                            $('form').append(
                                                '<input type="hidden" name="ck-media[]" value="' +
                                                response.id + '">');

                                            resolve({
                                                default: response.url
                                            });
                                        });

                                        if (xhr.upload) {
                                            xhr.upload.addEventListener('progress', function(
                                                e) {
                                                if (e.lengthComputable) {
                                                    loader.uploadTotal = e.total;
                                                    loader.uploaded = e.loaded;
                                                }
                                            });
                                        }

                                        // Send request
                                        var data = new FormData();
                                        data.append('upload', file);
                                        data.append('crud_id', '{{ $project->id ?? 0 }}');
                                        xhr.send(data);
                                    });
                                })
                        }
                    };
                }
            }

            var allEditors = document.querySelectorAll('.ckeditor');
            for (var i = 0; i < allEditors.length; ++i) {
                ClassicEditor.create(
                    allEditors[i], {
                        extraPlugins: [SimpleUploadAdapter]
                    }
                );
            }
        });
    </script>

    @include('admin.projects.partials.fields')
@endsection
