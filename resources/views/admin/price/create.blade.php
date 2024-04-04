<div class="modal fade" id="addPriceModal" tabindex="-1" role="dialog" aria-labelledby="addPriceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPriceModalLabel">Add Price</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.price.store') }}" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="price_per_sqft">Price Per sqft
                        </label>
                        <input class="form-control {{ $errors->has('price_per_sqft	') ? 'is-invalid' : '' }}"
                            type="text" name="price_per_sqft" id="price_per_sqft"
                            value="{{ old('price_per_sqft	', '') }}">
                        @if ($errors->has('price_per_sqft'))
                            <span class="text-danger">{{ $errors->first('price_per_sqft') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.project.fields.location_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required">{{ trans('cruds.user.fields.user_type') }}</label>
                        <select
                            class="form-control user_type_input select2 {{ $errors->has('user_type') ? 'is-invalid' : '' }}"
                            name="user_type" id="user_type" required>
                            @foreach (App\Models\User::USER_TYPE_RADIO as $key => $label)
                                @if (!auth()->user()->is_channel_partner_manager)
                                    <option value="{{ $key }}"
                                        {{ old('user_type', '') === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                    @elsex
                                    @if ($key == 'ChannelPartner')
                                        <option value="{{ $key }}" selected>
                                            {{ $label }}
                                        </option>
                                    @endif
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('user_type'))
                            <span class="text-danger">{{ $errors->first('user_type') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.user_type_helper') }}</span>
                    </div>
                    <div class="col-sm-3">
                        <label for="Date">Select Date </label>
                        <input type="date"
                            class="form-control datepicker {{ $errors->has('form-control datepicker') ? 'is-invalid' : '' }}"
                            name="date" id="date" rows="3" required>{{ old('date') }}
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="hidden" name="project_id" class="form-control" value="{{ $project->id }}">
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
