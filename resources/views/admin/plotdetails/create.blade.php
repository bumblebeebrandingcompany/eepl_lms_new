<div class="modal fade" id="addPlotModel" tabindex="-1" role="dialog" aria-labelledby="addPlotModelLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> <!-- Added modal-lg class here -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPlotModelLabel">Add plc</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.plotdetails.store') }}" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="plot_no">Plot No</label>
                        <input class="form-control {{ $errors->has('plot_no') ? 'is-invalid' : '' }}" type="text"
                            name="plot_no" id="plot_no" value="{{ old('plot_no', '') }}">
                        @if ($errors->has('plot_no'))
                            <span class="text-danger">{{ $errors->first('plot_no') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="plot_type">Plot type</label>
                        <select class="form-control {{ $errors->has('plot_type') ? 'is-invalid' : '' }}"
                            name="plot_type" id="plot_type">
                            <option value="residential" {{ old('plot_type') == 'residential' ? 'selected' : '' }}>
                                Residential</option>
                            <option value="commercial" {{ old('plot_type') == 'commercial' ? 'selected' : '' }}>
                                Commercial</option>
                        </select>
                        @if ($errors->has('plot_type'))
                            <span class="text-danger">{{ $errors->first('plot_type') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="dimension_length">Dimension Length</label>
                        <input class="form-control {{ $errors->has('dimension_length') ? 'is-invalid' : '' }}"
                            type="text" name="dimension_length" id="dimension_length"
                            value="{{ old('dimension_length', '') }}">
                        @if ($errors->has('dimension_length'))
                            <span class="text-danger">{{ $errors->first('dimension_length') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="dimension_breadth">Dimension Breadth</label>
                        <input class="form-control {{ $errors->has('dimension_breadth') ? 'is-invalid' : '' }}"
                            type="text" name="dimension_breadth" id="dimension_breadth"
                            value="{{ old('dimension_breadth', '') }}">
                        @if ($errors->has('dimension_breadth'))
                            <span class="text-danger">{{ $errors->first('dimension_breadth') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="total_sqfts">Total Sqfts</label>
                        <input class="form-control {{ $errors->has('total_sqfts') ? 'is-invalid' : '' }}"
                            type="text" name="total_sqfts" id="total_sqfts" value="{{ old('total_sqfts', '') }}">
                        @if ($errors->has('total_sqfts'))
                            <span class="text-danger">{{ $errors->first('total_sqfts') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="plc_values">Select Plcs:</label>
                        <br>
                        <select multiple name="plc_values[]" id="plc_values" class="form-control select2" required>
                            @foreach ($plcs as $plc)
                                <option value="{{ $plc->name }}">{{ $plc->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="project_id" class="form-control" value="{{ $project->id }}">
                    </div>
                    <div class="form-group">
                        <label for="overall_sqft_price">Total Price</label>
                        <input class="form-control {{ $errors->has('overall_sqft_price') ? 'is-invalid' : '' }}"
                            type="text" name="overall_sqft_price" id="overall_sqft_price"
                            value="{{ old('overall_sqft_price', '') }}">
                        @if ($errors->has('overall_sqft_price'))
                            <span class="text-danger">{{ $errors->first('overall_sqft_price') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
