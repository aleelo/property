
<input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
<input id="status" type="hidden" name="status" value="rejected" />
<input type="hidden" name="view" value="<?php echo isset($view) ? $view : ""; ?>" />


<!----------------------------------------- Property  ------------------------------------>

<div class="form-group">
    <div class="row">
        <div class="col-md-12">
            <?php
            // Ensure $client_name is an associative array in the format ['id' => 'name']
            if (!is_array($client_name)) {
                $client_name = []; // Set default to prevent errors if it's null or not an array
            }

            // Convert buyer_ids to an array if it's a comma-separated string
            $selected_client = isset($model_info->buyer_ids) ? $model_info->buyer_ids : ''; // Single selection instead of array

            echo form_dropdown(
                array(
                    "id" => "property",
                    "name" => "property", // Single selection, keep name simple
                    "class" => "form-control select2", // You can still use select2 for better UX
                    "placeholder" => 'Property',
                    "autocomplete" => "off",
                    'data-rule-required' => true,
                    'data-msg-required' => app_lang('field_required'),
                ),
                $client_name,
                $selected_client
            );
            ?>
        </div>
    </div>
</div>


<!----------------------------------------- Signature Pad  ------------------------------------>


    <div class="form-group">
        <div class="row">
            <div id="signature-pad" style="width: 96%; height: 300px; border: 0.5px solid #007bff; border-radius: 5px; margin: 0 auto;">
                <canvas id="signature-canvas" width="700" height="300"></canvas>
            </div>
        </div>
    </div>



<?php echo view("custom_fields/form/prepare_context_fields", array("custom_fields" => $custom_fields, "label_column" => $label_column, "field_column" => $field_column)); ?> 



<script type="text/javascript">

    var k=1;
    $(document).ready(function () {

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

        setDatePicker("#appointment_date");
        setTimePicker("#appointment_time");


        // Function to reset other dropdowns
        function resetOtherDropdowns(excludeSection) {
            var sections = ['#departments_section', '#sections_section', '#units_section', '#payers_section', '#partners_section', '#visitors_section', '#employees_section'];
        
        // Remove the excluded section from the list
        sections = sections.filter(function (item) {
            return item !== excludeSection;
        });

        // Loop through each section and reset the values
        sections.forEach(function (section) {
            $(section + ' select').val(null).trigger('change'); // Clear selection
        });
    }

    // Initially hide all sections
    function hideAllSections() {
        $('#departments_section').hide();
        $('#sections_section').hide();
        $('#units_section').hide();
        $('#payers_section').hide();
        $('#partners_section').hide();
        $('#visitors_section').hide();
        $('#employees_section').hide();
    }

    // Call this function whenever the "Meeting With" dropdown changes
    $('#meeting_with').on('change', function () {
        var meeting_with = $(this).val();

        // Hide all sections first
        hideAllSections();

        // Show the appropriate section(s) based on the selected meeting_with value and reset others
        switch (meeting_with) {
            case 'Departments':
                $('#departments_section').show();
                resetOtherDropdowns('#departments_section');
                break;
            case 'Sections':
                $('#sections_section').show();
                resetOtherDropdowns('#sections_section');
                break;
            case 'Units':
                $('#units_section').show();
                resetOtherDropdowns('#units_section');
                break;
            case 'Payers':
                $('#payers_section').show();
                resetOtherDropdowns('#payers_section');
                break;
            case 'Partners':
                $('#partners_section').show();
                resetOtherDropdowns('#partners_section');
                break;
            case 'Visitors':
                $('#visitors_section').show();
                resetOtherDropdowns('#visitors_section');
                break;
            case 'Employees':
                $('#employees_section').show();
                resetOtherDropdowns('#employees_section');
                break;
            default:
                hideAllSections(); // If no valid selection is made, hide all sections and reset all dropdowns
                resetOtherDropdowns(null);
        }
    });

    // Trigger change on page load to set the correct visibility based on any pre-selected value
    $('#meeting_with').trigger('change');



    });
</script>