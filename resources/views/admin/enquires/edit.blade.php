@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Update Walkin</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.aztec.update', $enquiry->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" value="{{$enquiry->name}}" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text"  name="phone" class="form-control" value="{{$enquiry->phone}}" required>
                        </div>
                        <div class="form-group">
                            <label for="secondary_phone">Secondary Phone:</label>
                            <input type="text"  name="secondary_phone" class="form-control" value="{{$enquiry->secondary_phone}}" >
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text"  name="email" class="form-control"value="{{$enquiry->email}}"  required>
                        </div>
                        <div class="form-group">
                            <label for="additional_email">Additional Email:</label>
                            <input type="text"  name="additional_email" class="form-control"value="{{$enquiry->additional_email}}"  >
                        </div>
                        <div class="form-group">
                            <label for="city">City:</label>
                            <input type="text"  name="city" class="form-control" value="{{$enquiry->city}}" required>
                        </div>
                        <div class="form-group">
                            <label class="required" for="project_id">Referred By</label>
                            <select class="form-control select2 {{ $errors->has('project') ? 'is-invalid' : '' }}" name="referred_by" id="leadSource" required>
                                <option value="{{$enquiry->referred_by}}" selected>{{$enquiry->referred_by}}</option>
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
                        @foreach ($enquiry->leads as $lead)
                        <div class="form-group">
                            <label for="channelPartner" class="required">Remarks:</label>
                            <input type="text"  name="cp_comments" class="form-control" value="{{$lead->cp_comments}}" required>
                        </div>
                        @endforeach
                        <input type="hidden" name="project_id" class="form-control" value= "1" required>
                        <input type="hidden" name="comments" class="form-control" value= "Direct Walk-in attended" required>

                        <button type="submit" class="btn btn-success">Update Walkin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

