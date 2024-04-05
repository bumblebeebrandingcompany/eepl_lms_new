@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Edit MerlomLead</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.merlom-leads.update', $merlomLead->id) }}" method="post">
                        @csrf
                        @method('PUT') <!-- Add this line for the update method -->

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $merlomLead->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="project_id">{{ trans('cruds.lead.fields.project') }}</label>
                            <select class="form-control select2 {{ $errors->has('project_id') ? 'is-invalid' : '' }}"
                                name="project_id" id="project_id" required>
                                @foreach ($projects as $id => $entry)
                                    <option value="{{ $id }}" {{ old('project_id', $merlomLead->project_id) == $id ? 'selected' : '' }}>
                                        {{ $entry }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('project_id'))
                                <span class="text-danger">{{ $errors->first('project_id') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lead.fields.project_helper') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" name="phone" id="phone" class="form-control input_number"
                                value="{{ old('phone', $merlomLead->phone) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" name="email" class="form-control" value="{{ old('email', $merlomLead->email) }}" required>
                        </div>

                        <button type="submit" class="btn btn-success">Update MerlomLead</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
