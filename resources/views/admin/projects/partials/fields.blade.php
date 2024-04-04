@include('admin.projects.partials.fields.essential_fields')
@include('admin.projects.partials.fields.sales_fields')
@include('admin.projects.partials.fields.system_fields')
@include('admin.projects.partials.fields.custom_fields')
@section('scripts')
<script>
    $(document).ready(function() {
        let essentialFieldsArray = [];
        $('div.row.mb-2').each(function() {
            const nameData = $(this).find('input[name="name_data[]"]').val();
            const nameKey = $(this).find('input[name="name_key[]"]').val();
            const nameValue = $(this).find('input[name="name_value[]"]').val();
            const enabled = $(this).find('input[name="enabled[]"]').prop('checked') ? '1' : '0';
            const disabled = '0'; // Assuming 'disabled' is always '0' based on your format

            const fieldData = {
                name_data: nameData,
                name_key: nameKey,
                name_value: nameValue,
                enabled: enabled,
                disabled: disabled,
            };

            essentialFieldsArray.push(fieldData);
        });

        $('#essential-fields-json').val(JSON.stringify(essentialFieldsArray));
    });
</script>
    {{-- sales fields --}}
    <script>
        $(document).ready(function() {
            let salesFieldsArray = [];
            $('div.row.mb-2').each(function() {
                const nameData = $(this).find('input[name="name_data[]"]').val();
                const nameKey = $(this).find('input[name="name_key[]"]').val();
                const nameValue = $(this).find('input[name="name_value[]"]').val();
                const enabled = $(this).find('input[name="enabled[]"]').prop('checked') ? '1' : '0';
                const disabled = '0';

                const fieldData = {
                    name_data: nameData,
                    name_key: nameKey,
                    name_value: nameValue,
                    enabled: enabled,
                    disabled: disabled,
                };

                salesFieldsArray.push(fieldData);
            });

            $('#sales-fields-json').val(JSON.stringify(salesFieldsArray));
        });
    </script>
    <script>
        $(document).ready(function() {
            let fieldCounter =
                {{ isset($project) && is_array($project->virtual_number) ? count($project->virtual_number) : 0 }};
            const customFields = {};

            $('#add-virtual-number').on('click', function() {
                fieldCounter++;

                const customFieldInput = `
            <div class="row mb-2">
                <div class="col-md-3">
                    <input class="form-control" type="text" name="virtual_number[${fieldCounter}][name_data]" placeholder="Enter a number">
                </div>
                <div class="col-md-3">
                    <input class="form-control" type="text" name="virtual_number[${fieldCounter}][name_key]" placeholder="sources">
                </div>

                <div class="col-md-3">
                    <button type="button" class="btn btn-danger remove-field">Remove</button>
                </div>
            </div>`;
                // Append the custom field input to the container
                $('#virtual-number-container').append(customFieldInput);
            });

            // Remove Field button click event
            $('#virtual-number-container').on('click', '.remove-field', function() {
                $(this).parent().parent().remove();
            });

            // Form submission event
            $('form').on('submit', function() {
                // Collect and format custom fields as JSON
                const customFieldsArray = [];
                $('#virtual-number-container input[name^="virtual_number"]').each(function() {
                    const fieldData = $(this).attr('name_key').split('[');
                    const fieldIndex = fieldData[1];
                    const fieldName = fieldData[2].split(']')[0];
                    const fieldValue = $(this).val();
                    const isEnabled = $(`input[name="virtual_number[${fieldIndex}][enabled]"]`).prop(
                        'checked');
                    customFieldsArray.push({
                        name_data: fieldName,
                        name_key: $(`input[name="virtual_number[${fieldIndex}][name_key]"]`)
                            .val(),
                        name_value: fieldValue,
                        enabled: isEnabled,
                    });
                });

                customFields['virtual_number'] = customFieldsArray;
                $('#virtual-number-json').val(JSON.stringify(customFields)); // Serialize as JSON
            });
        });
    </script>
       <script>
        $(document).ready(function() {
            let fieldCounter =
                {{ isset($project) && is_array($project->custom_fields) ? count($project->custom_fields) : 0 }};
            const customFields = {};

            $('#add-custom-field').on('click', function() {
                fieldCounter++;

                const customFieldInput = `
            <div class="row mb-2">
                <div class="col-md-3">
                    <input class="form-control" type="text" name="custom_fields[${fieldCounter}][name_data]" placeholder="Field Name">
                </div>
                <div class="col-md-3">
                    <input class="form-control" type="text" name="custom_fields[${fieldCounter}][name_key]" placeholder="Field Name">
                </div>
                <div class="col-md-3">
                    <input class="form-control" type="text" name="custom_fields[${fieldCounter}][name_value]" placeholder="Field Value">
                </div>
                <div class="col-md-1">
                    <label class="switch">
                        <input type="checkbox" name="custom_fields[${fieldCounter}][enabled]" value="1">
                        <span class="slider round"></span>
                        <input type="hidden" name="custom_fields[${fieldCounter}][disabled]" value="0">
                    </label>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger remove-field">Remove</button>
                </div>
            </div>`;
                // Append the custom field input to the container
                $('#custom-fields-container').append(customFieldInput);
            });

            // Remove Field button click event
            $('#custom-fields-container').on('click', '.remove-field', function() {
                $(this).parent().parent().remove();
            });

            // Form submission event
            $('form').on('submit', function() {
                // Collect and format custom fields as JSON
                const customFieldsArray = [];
                $('#custom-fields-container input[name^="custom_fields"]').each(function() {
                    const fieldData = $(this).attr('name_key').split('[');
                    const fieldIndex = fieldData[1];
                    const fieldName = fieldData[2].split(']')[0];
                    const fieldValue = $(this).val();
                    const isEnabled = $(`input[name="custom_fields[${fieldIndex}][enabled]"]`).prop(
                        'checked');
                    customFieldsArray.push({
                        name_data: fieldName,
                        name_key: $(`input[name="custom_fields[${fieldIndex}][name_key]"]`)
                            .val(),
                        name_value: fieldValue,
                        enabled: isEnabled,
                    });
                });

                customFields['custom_fields'] = customFieldsArray;
                $('#custom-fields-json').val(JSON.stringify(customFields)); // Serialize as JSON
            });
        });
    </script>
    {{-- system fields --}}
 <script>
    $(document).ready(function() {
        let systemFieldsArray = [];
        $('div.row.mb-2').each(function() {
            const nameData = $(this).find('input[name="name_data[]"]').val();
            const nameKey = $(this).find('input[name="name_key[]"]').val();
            const nameValue = $(this).find('input[name="name_value[]"]').val();
            const enabled = $(this).find('input[name="enabled[]"]').prop('checked') ? '1' : '0';
            const disabled = '0'; // Assuming 'disabled' is always '0' based on your format

            const fieldData = {
                name_data: nameData,
                name_key: nameKey,
                name_value: nameValue,
                enabled: enabled,
                disabled: disabled,
            };

            systemFieldsArray.push(fieldData);
        });

        $('#system-fields-json').val(JSON.stringify(systemFieldsArray));
    });
</script>
@endsection

