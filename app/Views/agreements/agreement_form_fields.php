
<input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
<input type="hidden" name="ower_log_id" value="<?php echo $ower_log_id; ?>" />
<input type="hidden" name="view" value="<?php echo isset($view) ? $view : ""; ?>" />

<!----------------------------------------- Property  ------------------------------------>

<div class="form-group">
    <div class="row">
        <label for="property" class=" <?php echo $label_column; ?>"><?php echo 'Property'; ?></label>
        <div class=" col-md-9">
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

<!----------------------------------------- Files  ------------------------------------>

<div class="form-group">
    <div class="col-md-12">
        <?php
        echo view("includes/file_list", array("files" => $model_info->files));
        ?>
    </div>
</div>

<?php echo view("includes/dropzone_preview"); ?>

<?php echo view("custom_fields/form/prepare_context_fields", array("custom_fields" => $custom_fields, "label_column" => $label_column, "field_column" => $field_column)); ?> 

<script type="text/javascript">
    var k=1;
    $(document).ready(function () {

        $("#property").change(function () {
            var propertyId = $(this).val();

            // Clear the Agreement Type dropdown and reset any selected value
            $("#agreement_type_id").html('<option value=""> -- choose an agreement type -- </option>').val("").trigger('change');

            // Check if a valid property ID is selected
            if (propertyId) {
                $.ajax({
                    url: "<?php echo get_uri('agreements/get_agreement_types_by_property_id'); ?>",
                    type: 'POST',
                    data: {property_id: propertyId},
                    success: function (data) {
                        // Parse the response if it contains valid JSON data
                        var options = JSON.parse(data);
                        if (options && Object.keys(options).length > 0) {
                            $.each(options, function (key, value) {
                                $("#agreement_type_id").append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    },
                    error: function () {
                        alert("An error occurred while fetching agreement types.");
                    }
                });
            }
        });

        setDatePicker("#Start_Date")
        setDatePicker("#End_Date")
        
        $('[data-bs-toggle="tooltip"]').tooltip();

<?php if (isset($currency_dropdown)) { ?>
            if ($('#currency').length) {
                $('#currency').select2({data: <?php echo json_encode($currency_dropdown); ?>});
            }
<?php } ?>

<?php if (isset($groups_dropdown)) { ?>
            $("#group_ids").select2({
                multiple: true,
                data: <?php echo json_encode($groups_dropdown); ?>
            });
<?php } ?>

<?php if ($login_user->is_admin || get_array_value($login_user->permissions, "client") === "all") { ?>
            $('#created_by').select2({data: <?php echo $team_members_dropdown; ?>});
<?php } ?>

<?php if ($login_user->user_type === "staff") { ?>
            $("#client_labels").select2({multiple: true, data: <?php echo json_encode($label_suggestions); ?>});
<?php } ?>
        $('.account_type').click(function () {
            var inputValue = $(this).attr("value");
            if (inputValue === "person") {
                $(".company_name_section").html("Name");
                $(".company_name_input_section").attr("placeholder", "Name");
            } else {
                $(".company_name_section").html("Company name");
                $(".company_name_input_section").attr("placeholder", "Company name");
            }
        });

        $("#client-form .select2").select2();

// ---------------------------------------------------------------------------------------------//
        // Function to reset other fields when an agreement type changes
function resetOtherFields(excludeFieldIds) {
    // Define all field selectors that might need to be reset
    var fields = ['#buyer_section', '#tenant_section', '#lease_period_section', '#payment_frequency_section'];
    
    // Remove the excluded fields from the list
    fields = fields.filter(function (field) {
        return !excludeFieldIds.includes(field);
    });

    // Loop through each field and reset the values or hide them
    fields.forEach(function (field) {
        $(field).val(null).trigger('change'); // Clear selection or value
        $(field).hide(); // Hide the field
    });
}

// Initially hide all fields
function hideAllFields() {
    // $('#buyer_section').hide();
    $('#tenant_section').hide();
    $('#lease_period_section').hide();
    $('#payment_frequency_section').hide();
}

// Call this function whenever the "agreement_type_id" dropdown changes
$('#agreement_type_id').on('change', function () {
    var agreementType = $(this).val();

    // Hide all fields first
    hideAllFields();

    // Show the appropriate fields based on the selected agreement type and reset others
    switch (agreementType) {
        case '2':
            $('#tenant_section').show();
            $('#lease_period_section').show();
            $('#payment_frequency_section').show();
            resetOtherFields(['#tenant_section', '#lease_period_section', '#payment_frequency_section']);
            break;
        case '1':
            $('#buyer_section').show();
            resetOtherFields(['#buyer_section']);
            break;
        default:
            hideAllFields(); // If no valid selection is made, hide all fields and reset all inputs
            resetOtherFields([]);
    }
});

// Trigger change on page load to set the correct visibility based on any pre-selected value
$('#agreement_type_id').trigger('change');


    });
</script>