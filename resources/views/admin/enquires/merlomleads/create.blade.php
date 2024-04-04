@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Create MerlomLead</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.merlom-leads.store') }}" method="post">
                        @csrf

                        <div class="form-group" class="required">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="required" for="project_id">{{ trans('cruds.lead.fields.project') }}</label>
                            <select class="form-control select2 {{ $errors->has('project') ? 'is-invalid' : '' }}"
                                name="project_id" id="project_id" required>
                                @foreach ($projects as $id => $entry)
                                    @if ($id == 1 || $id == 9)
                                        <option value="{{ $id }}"
                                            {{ old('project_id') == $id || $project_id == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('project'))
                                <span class="text-danger">{{ $errors->first('project') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lead.fields.project_helper') }}</span>
                        </div>

                        <div class="form-group" class="required">
                            <label for="phone">Phone:</label>
                            <input type="text" name="phone" id="phone"
                                value="{{ old('phone') ? old('phone') : $phone ?? '' }}" class="form-control input_number"
                                @if (!auth()->user()->is_superadmin) required @endif>
                        </div>

                        <div class="form-group" class="required">
                            <label for="email">Email:</label>
                            <input type="text" name="email" class="form-control" required>
                        </div>


                        <button type="submit" class="btn btn-success">Create MerlomLead</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
