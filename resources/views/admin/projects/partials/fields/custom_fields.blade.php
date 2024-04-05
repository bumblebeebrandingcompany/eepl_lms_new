<div class="form-group">
    <div class="row">
        <div class="col-md-6"  style="margin-bottom: 20px">
            <label for="custom_fields">{{ trans('cruds.project.fields.custom') }}</label>
        {{-- </div> --}}

            <button type="button" id="add-custom-field" class="btn btn-primary rounded-pill">Add Field</button>
        </div>
    </div>
    <div id="custom-fields-container">
    </div>
</div>
<div class="form-group text-end">
    <input type="hidden" id="custom-fields-json" name="custom_fields_json" value="">






