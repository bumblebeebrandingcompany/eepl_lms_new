<div class="row">
    <div class="col-md-12">
        @foreach ($campaigns as $campaign)
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="campaign_id[]" value="{{ $campaign->id }}">
                            {{ $campaign->campaign_name }}
                        </label>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Select Source</label>
                        <select class="form-control select2" name="source_id[{{ $campaign->id }}][]" multiple>
                            <option value="" disabled>Please Select</option>
                            @forelse ($sources as $source)
                                @if ($source->campaign && $source->campaign->campaign_name == $campaign->campaign_name)
                                    <option value="{{ $source->id }}">{{ $source->name }}</option>
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
