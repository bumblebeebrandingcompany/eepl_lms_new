@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Create Walkin</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.aztec.store') }}" method="post">
                        @csrf

                        <div class="form-group" class="required">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group" class="required">
                            <label for="phone">Phone:</label>
                            <input type="text" name="phone" id="phone"
                                value="{{ old('phone') ? old('phone') : $phone ?? '' }}" class="form-control input_number"
                                @if (!auth()->user()->is_superadmin) required @endif>
                        </div>
                        <div class="form-group">
                            <label for="secondary_phone">Secondary Phone:</label>
                            <input type="text" name="secondary_phone" class="form-control">
                        </div>
                        <div class="form-group" class="required">
                            <label for="email">Email:</label>
                            <input type="text" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="additional_email">Additional Email:</label>
                            <input type="text" name="additional_email" class="form-control" >
                        </div>
                        <div class="form-group" class="required">
                            <label for="city">City:</label>
                            <input type="text" name="city" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="required" for="project_id">Referred By</label>
                            <select class="form-control select2 {{ $errors->has('project') ? 'is-invalid' : '' }}"
                                name="referred_by" id="leadSource" required>
                                <option value="Direct Walk-in">Direct Walk-in</option>
                                <option value="Banker">Banker</option>
                                <option value="Organic-Website">Organic-Website</option>
                                <option value="Referrel">Refferrel</option>
                                <option value="News Paper">News Paper</option>
                                <option value="TV Ads">TV Ads</option>
                                <option value="Radio">Radio</option>
                                <option value="Social Media">Social Media</option>
                                <option value="Youtube">Youtube</option>
                                <option value="Digital Ads">Digital Ads</option>
                                <option value="Hoarding">Hoarding</option>
                                <option value="Channel Partner">Channel Partner</option>
                                <option value="Existing Customer">Existing Customer</option>
                                <option value="Inshots">Inshots</option>
                                <option value="My Gate">My Gate</option>
                                <option value="Sun Pack">Sun Pack</option>
                                <option value="Canter Van">Canter Van</option>
                                <option value="Flyer">Flyer</option>
                                <option value="Paper Insert">Paper Insert</option>
                                <option value="Whatsapp">Whatsapp</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="channelPartner" class="required">Remarks:</label>
                            <input type="text" name="cp_comments" class="form-control" value="" required>
                        </div>
                        <input type="hidden" name="project_id" class="form-control" value= "1" required>
                        <input type="hidden" name="comments" class="form-control" value= "Direct Walk-in attended"
                            required>

                        <button type="submit" class="btn btn-success">Create Walkin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
