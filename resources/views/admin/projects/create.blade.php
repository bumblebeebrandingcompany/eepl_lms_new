@extends('layouts.admin')
@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h2>
                {{ trans('global.create') }} {{ trans('cruds.project.title_singular') }}
            </h2>
        </div>
    </div>
    <div class="card card-primary card-outline">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.project.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                        id="name" value="{{ old('name', '') }}" required>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.project.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="start_date">{{ trans('cruds.project.fields.start_date') }}</label>
                    <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text"
                        name="start_date" id="start_date" value="{{ old('start_date') }}">
                    @if ($errors->has('start_date'))
                        <span class="text-danger">{{ $errors->first('start_date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.project.fields.start_date_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="end_date">{{ trans('cruds.project.fields.end_date') }}</label>
                    <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text"
                        name="end_date" id="end_date" value="{{ old('end_date') }}">
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
                            <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>
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
                        name="location" id="location" value="{{ old('location', '') }}">
                    @if ($errors->has('location'))
                        <span class="text-danger">{{ $errors->first('location') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="rera_no">Rera No</label>
                    <input class="form-control {{ $errors->has('rera_no') ? 'is-invalid' : '' }}" type="text"
                        name="rera_no" id="rera_no" value="{{ old('rera_no', '') }}">
                    @if ($errors->has('rera_no'))
                        <span class="text-danger">{{ $errors->first('rera_no') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="local_body_no">Local Body No</label>
                    <input class="form-control {{ $errors->has('local_body_no') ? 'is-invalid' : '' }}" type="text"
                        name="local_body_no" id="local_body_no" value="{{ old('local_body_no', '') }}">
                    @if ($errors->has('local_body_no'))
                        <span class="text-danger">{{ $errors->first('local_body_no') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="overall_sqfts">Overall Sqfts</label>
                    <input class="form-control {{ $errors->has('overall_sqfts') ? 'is-invalid' : '' }}" type="text"
                        name="overall_sqfts" id="overall_sqfts" value="{{ old('overall_sqfts', '') }}">
                    @if ($errors->has('overall_sqfts'))
                        <span class="text-danger">{{ $errors->first('overall_sqfts') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="no_of_plots">Total No Plots </label>
                    <input class="form-control {{ $errors->has('no_of_plots') ? 'is-invalid' : '' }}" type="text"
                        name="no_of_plots" id="no_of_plots" value="{{ old('no_of_plots', '') }}">
                    @if ($errors->has('no_of_plots'))
                        <span class="text-danger">{{ $errors->first('no_of_plots') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                </div>

                <div class="form-group">
                    <label for="dtcp/cmda">Select anyone</label>
                    <select name="dtcp/cmda" id="dtcp/cmda" class="form-control">
                        <option value="">@lang('messages.please_select')</option>
                        <option value="0">dtcp</option>
                        <option value="1">cmda</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dtcp/cmda_no">Dtcp/Cmda No </label>
                    <input class="form-control {{ $errors->has('dtcp/cmda_no') ? 'is-invalid' : '' }}" type="text"
                        name="dtcp/cmda_no" id="dtcp/cmda_no" value="{{ old('dtcp/cmda_no', '') }}">
                    @if ($errors->has('dtcp/cmda_no'))
                        <span class="text-danger">{{ $errors->first('dtcp/cmda_no') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                </div>
        </div>
        <div class="form-group">
            <label for="description">{{ trans('cruds.project.fields.description') }}</label>
            <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                id="description">{!! old('description') !!}</textarea>
            @if ($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
            @endif
            <span class="help-block">{{ trans('cruds.project.fields.description_helper') }}</span>
        </div>

        @if ($errors->has('description'))
            <span class="text-danger">{{ $errors->first('description') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.project.fields.description_helper') }}</span>
        @include('admin.projects.partials.fields')
        @include('admin.projects.partials.tree')
    </div>
    <div class="form-group">
        <button class="btn btn-danger" type="submit">
            {{ trans('global.save') }}
        </button>
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
@endsection
