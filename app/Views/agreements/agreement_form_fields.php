
<input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
<input type="hidden" name="view" value="<?php echo isset($view) ? $view : ""; ?>" />

<!----------------------------------------- Property  ------------------------------------>

<div class="form-group">
    <div class="row">
        <label for="property" class=" <?php echo $label_column; ?>"><?php echo 'Property'; ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_dropdown(array(
                "id" => "property",
                "name" => "property",
                "class" => "form-control select2",
                "placeholder" => 'Property',
                "autocomplete" => "off",
                'data-rule-required' => true,
                'data-msg-required' => app_lang('field_required'),
            ),$properties,[$model_info->property_id]);
            ?>
        </div>
    </div>
</div>


<!----------------------------------------- Agreement Type  ------------------------------------>

<div class="form-group">
    <div class="row">
        <label for="agreement_type_id" class="<?php echo $label_column; ?>"><?php echo 'Agreement Type'; ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_dropdown(array(
                "id" => "agreement_type_id",
                "name" => "agreement_type_id",
                "class" => "form-control select2",
                "placeholder" => 'Agreement Type',
                "autocomplete" => "off",
                'data-rule-required' => true,
                'data-msg-required' => app_lang('field_required'),
            ),$agreement_types,[$model_info->agreement_type_id]);
            ?>
            <span id="agreement_type_validation_msg" class="text-danger"></span>
        </div>
    </div>
</div>

<!-----------------------------------------  Ref NO  ------------------------------------>


<div class="form-group">
    <div class="row">
        <label for="notary_ref" class="<?php echo $label_column; ?> company_name_section"><?php echo 'Notary Ref'; ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_input(array(
                "id" => "notary_ref",
                "name" => "notary_ref",
                "value" => $model_info->notary_ref,
                "class" => "form-control company_name_input_section",
                "placeholder" => 'Notary Ref',
                'data-rule-required' => true,
                'data-msg-required' =>   app_lang('field_required'),
            ));
            ?>
        </div>
    </div>
</div>

<!----------------------------------------- Owner  ------------------------------------>

<div class="form-group" id="owner_section">
    <div class="row">
        <label for="owner_ids" class=" <?php echo $label_column; ?>"><?php echo 'Owner'; ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            
            echo form_dropdown(array(
                "id" => "owner_ids",
                "name" => "owner_ids[]",
                "class" => "form-control select2",
                "multiple" => "multiple",
                "placeholder" => ' -- choose Owner -- ',
                "autocomplete" => "off",
                'data-rule-required' => true,
                'data-msg-required' =>   app_lang('field_required'),
            ),$sellers,$model_info->owner_ids ? explode(',', $model_info->owner_ids) : []); // Handle multiple values
            ?>
        </div>
    </div>
</div>

<!----------------------------------------- Buyer  ------------------------------------>

<div class="form-group" id="buyer_section">
    <div class="row">
        <label for="buyer_ids" class=" <?php echo $label_column; ?>"><?php echo 'Buyer'; ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            
            echo form_dropdown(array(
                "id" => "buyer_ids",
                "name" => "buyer_ids[]",
                "class" => "form-control select2",
                "multiple" => "multiple",
                "placeholder" => ' -- choose buyer(s) -- ',
                "autocomplete" => "off",
                'data-rule-required' => true,
                'data-msg-required' =>   app_lang('field_required'),
            ),$buyers,$model_info->buyer_ids ? explode(',', $model_info->buyer_ids) : []); // Handle multiple values
            ?>
        </div>
    </div>
</div>

<!----------------------------------------- Tenant  ------------------------------------>

<div class="form-group" id="tenant_section">
    <div class="row">
        <label for="tenant_ids" class=" <?php echo $label_column; ?>"><?php echo 'Tenant'; ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            
            echo form_dropdown(array(
                "id" => "tenant_ids",
                "name" => "tenant_ids[]",
                "class" => "form-control select2",
                "multiple" => "multiple",
                "placeholder" => ' -- choose Tenant(s) -- ',
                "autocomplete" => "off",
                'data-rule-required' => true,
                'data-msg-required' =>   app_lang('field_required'),
            ),$sellers,$model_info->tenant_ids ? explode(',', $model_info->tenant_ids) : []); // Handle multiple values
            ?>
        </div>
    </div>
</div>

<!----------------------------------------- Witness  ------------------------------------>

<div class="form-group" id="departments_section">
    <div class="row">
        <label for="witness_ids" class=" <?php echo $label_column; ?>"><?php echo 'Witness'; ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            
            echo form_dropdown(array(
                "id" => "witness_ids",
                "name" => "witness_ids[]",
                "class" => "form-control select2",
                "multiple" => "multiple",
                "placeholder" => ' -- choose seller -- ',
                "autocomplete" => "off",
                'data-rule-required' => true,
                'data-msg-required' =>   app_lang('field_required'),
            ),$witnesses,$model_info->witness_ids ? explode(',', $model_info->witness_ids) : []); // Handle multiple values
            ?>
        </div>
    </div>
</div>



<!----------------------------------------- Leas Period  ------------------------------------>


<div class="form-group" id="lease_period_section">
    <div class="row">
        <label for="lease_period" class="<?php echo $label_column; ?> company_name_section"><?php echo 'Lease Period'; ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_input(array(
                "id" => "lease_period",
                "name" => "lease_period",
                "value" => $model_info->lease_period,
                "class" => "form-control company_name_input_section",
                "placeholder" => 'Lease Period ',
                'data-rule-required' => true,
                'data-msg-required' =>   app_lang('field_required'),
            ));
            ?>
        </div>
    </div>
</div>

<!----------------------------------------- Amount  ------------------------------------>


<div class="form-group">
    <div class="row">
        <label for="amount" class="<?php echo $label_column; ?> company_name_section"><?php echo app_lang('amount'); ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_input(array(
                "id" => "amount",
                "name" => "amount",
                "value" => $model_info->amount,
                "class" => "form-control company_name_input_section",
                "placeholder" => app_lang('amount'),
                'data-rule-required' => true,
                'data-msg-required' =>   app_lang('field_required'),
            ));
            ?>
        </div>
    </div>
</div>

<!----------------------------------------- Payment Method  ------------------------------------>


<div class="form-group">
    <div class="row">
        <label for="payment_method" class="<?php echo $label_column; ?> company_name_section"><?php echo app_lang('payment_method'); ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
                echo form_dropdown(array(
                    "id" => "payment_method",
                    "name" => "payment_method",
                    "class" => "form-control select2",
                    "placeholder" => 'Payment Method',
                    "autocomplete" => "off",
                    'data-rule-required' => true,
                    'data-msg-required' =>   app_lang('field_required'),
                ),$payment_method,[$model_info->payment_method]);
            ?>
        </div>
    </div>
</div>

<!----------------------------------------- Payment Frequency  ------------------------------------>

<div class="form-group" id="payment_frequency_section">
    <div class="row">
        <label for="payment_frequency" class="<?php echo $label_column; ?> company_name_section"><?php echo 'Payment Frequency'; ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_input(array(
                "id" => "payment_frequency",
                "name" => "payment_frequency",
                "value" => $model_info->payment_frequency,
                "class" => "form-control company_name_input_section",
                "placeholder" => app_lang('amount'),
                'data-rule-required' => true,
                'data-msg-required' =>   app_lang('field_required'),
            ));
            ?>
        </div>
    </div>
</div>

<?php echo view("includes/dropzone_preview"); ?>

<?php echo view("custom_fields/form/prepare_context_fields", array("custom_fields" => $custom_fields, "label_column" => $label_column, "field_column" => $field_column)); ?> 

<script type="text/javascript">
    $(document).ready(function () {
        var preSelectedOwnerId = $("#owner_ids").data('preselected');
        // Initialize Select2 and tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();
        $(".select2").select2();
        feather.replace();

        $("#property").change(function () {
        var propertyId = $(this).val();

        // Clear and reset the Owner dropdown
        // $("#owner_ids").html('<option value=""> -- choose Owners -- </option>').val("").trigger('change');

        if (propertyId) {
            // Fetch Property Owners
            $.ajax({
                url: "<?php echo site_url('properties/get_owners_by_property_id'); ?>",
                type: 'POST',
                data: {property_id: propertyId},
                success: function (data) {
                    var owners = JSON.parse(data);
                    if (owners && Object.keys(owners).length > 0) {
                        $("#owner_ids").empty(); // Clear the dropdown

                        $.each(owners, function (key, value) {
                            $("#owner_ids").append('<option value="' + key + '">' + value + '</option>');
                        });

                        // 2. **Set the selected owner values in the dropdown** (highlighted)
                        if (preSelectedOwnerId) {
                            $("#owner_ids").val(preSelectedOwnerId).trigger('change'); // This ensures the owners are pre-selected
                        }
                    }
                },
                error: function () {
                    alert("An error occurred while fetching property owners.");
                }
            });
        } else {
            // Reset the owner dropdown if no property is selected
            $("#owner_ids").html('<option value=""> -- choose Owners -- </option>').val("").trigger('change');
        }
    });

        // Handle property selection to dynamically load agreement types and owners
       // Handle property selection to dynamically load owners
        $("#property").change(function () {
            var propertyId = $(this).val();

            // Clear and reset the Owner dropdown
            // $("#owner_ids").html('<option value=""> -- choose Owners -- </option>').val("").trigger('change');

            if (propertyId) {
                // Fetch Property Owners
                $.ajax({
                    url: "<?php echo site_url('properties/get_owners_by_property_id'); ?>",
                    type: 'POST',
                    data: {property_id: propertyId},
                    success: function (data) {
                        var owners = JSON.parse(data);
                        if (owners && Object.keys(owners).length > 0) {
                            $("#owner_ids").empty(); // Clear the dropdown
                            $.each(owners, function (key, value) {
                                $("#owner_ids").append('<option value="' + key + '">' + value + '</option>');
                                // alert(value);
                            });
                            // Disable the owner dropdown to make it read-only
                            // $("#owner_ids").prop('disabled', true);
                        }
                    },
                    error: function () {
                        alert("An error occurred while fetching property owners.");
                    }
                });
            } else {
                // Reset the owner dropdown if no property is selected
                $("#owner_ids").html('<option value=""> -- choose Ownersss -- </option>').val("").trigger('change');
                $("#owner_ids").prop('disabled', false); // Enable it if needed
            }
             // Pre-populate the Owner field on page load, if a value is present
            if (preSelectedOwnerId) {
                 $("#owner_ids").val(preSelectedOwnerId).trigger('change');
                 console.log(value)
             }
             else{
                console.log("no data")
             }
        });


        // Keep owners dropdown enabled during form submission so values are sent
        $("#myForm").on('submit', function () {
            $("#owner_ids").prop('disabled', false); // Enable it just before submitting the form
        });

        // Handle Agreement Type selection to validate the agreement and show/hide fields
        $("#agreement_type_id").change(function () {
            var agreementTypeId = $(this).val();
            var $agreementTypeField = $(this);

            // Reset validation messages and disable submit button if necessary
            $('#agreement_type_validation_msg').text('');
            $("#save_button").prop("disabled", false);

            if (agreementTypeId) {
                $.ajax({
                    url: "<?php echo get_uri('agreements/check_agreement_template'); ?>",
                    type: 'POST',
                    data: {agreement_type_id: agreementTypeId},
                    success: function (response) {
                        var result = JSON.parse(response);

                        if (result.has_template) {
                            // If the agreement type has a template, no need for error message
                            $('#agreement_type_validation_msg').text('');
                            $("#save_button").prop("disabled", false);
                        } else {
                            // If the agreement type does not have a template, show error message
                            $('#agreement_type_validation_msg').text('This agreement type has no template. Please choose another one.');
                            $("#save_button").prop("disabled", true);
                        }
                    },
                    error: function () {
                        alert("An error occurred while checking agreement type template.");
                    }
                });
            }
        });

        // Hide/Show fields based on Agreement Type selection
        function hideAllSections() {
            $('#buyer_section').hide();
            $('#tenant_section').hide();
            $('#lease_period_section').hide();
            $('#payment_frequency_section').hide();
        }

        function resetSections(excludeSections) {
            var sections = ['#buyer_section', '#tenant_section', '#lease_period_section', '#payment_frequency_section'];
            sections = sections.filter(function (section) {
                return excludeSections.indexOf(section) === -1;
            });

            sections.forEach(function (section) {
                $(section).val(null).trigger('change');
                $(section).hide();
            });
        }

        // On Agreement Type change, display the relevant fields
        $('#agreement_type_id').on('change', function () {
            var agreementType = $(this).val();

            // Hide all sections initially
            hideAllSections();

            // Show relevant sections based on the selected agreement type
            switch (agreementType) {
                case '2': // Example case for Lease
                    $('#tenant_section').show();
                    $('#lease_period_section').show();
                    $('#payment_frequency_section').show();
                    resetSections(['#tenant_section', '#lease_period_section', '#payment_frequency_section']);
                    break;
                case '1': // Example case for Sale
                    $('#buyer_section').show();
                    resetSections(['#buyer_section']);
                    break;
                default:
                    hideAllSections();
                    resetSections([]);
            }
        });

        // Trigger change on page load to set the correct visibility based on any pre-selected value
        $('#agreement_type_id').trigger('change');

        // Date pickers initialization for lease periods
        setDatePicker("#lease_period_start");
        setDatePicker("#lease_period_end");
    });
</script>

