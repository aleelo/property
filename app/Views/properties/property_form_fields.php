
<input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
<input type="hidden" name="view" value="<?php echo isset($view) ? $view : ""; ?>" />


<!----------------------------------------- Type  ------------------------------------>

<div class="form-group">
    <div class="row">
        <label for="service_id" class="<?php echo $label_column; ?>"><?php echo 'Property Type'; ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_dropdown(array(
                "id" => "service_id",
                "name" => "service_id",
                "class" => "form-control select2",
                "placeholder" => 'Service',
                "autocomplete" => "off",
                'data-rule-required' => true,
                'data-msg-required' => app_lang('field_required'),
            ),$Services,[$model_info->service_id]);
            ?>
        </div>
    </div>
</div>


<!-----------------------------------------  Title Deed NO  ------------------------------------>


<div class="form-group">
    <div class="row">
        <label for="title_deed_no" class="<?php echo $label_column; ?> company_name_section"><?php echo app_lang('title_deed_no'); ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_input(array(
                "id" => "title_deed_no",
                "name" => "title_deed_no",
                "value" => $model_info->titleDeedNo,
                "class" => "form-control company_name_input_section",
                "placeholder" => app_lang('title_deed_no'),
                "data-rule-required" => true,
                "data-msg-required" => app_lang("field_required"),
            ));
            ?>
        </div>
    </div>
</div>


<!-----------------------------------------  Owners  ------------------------------------>

<div class="form-group" id="departments_section">
    <div class="row">
        <label for="owner_ids" class=" <?php echo $label_column; ?>"><?php echo 'Owner(s) Property'; ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            
            echo form_dropdown(array(
                "id" => "owner_ids",
                "name" => "owner_ids[]",
                "class" => "form-control select2",
                "multiple" => "multiple",
                "placeholder" => ' -- choose owner(s) -- ',
                "autocomplete" => "off",
                'data-rule-required' => true,
                'data-msg-required' =>   app_lang('field_required'),
            ),$owners,$model_info->owner_ids ? explode(',', $model_info->owner_ids) : []); // Handle multiple values
            ?>
        </div>
    </div>
</div>

<!-----------------------------------------  Region & Disctrict ------------------------------------>

<div class="form-group">
    <div class="row">
        
        <label for="region" class=" <?php echo $label_column; ?>"><?php echo 'Region'; ?></label>
        <div class="<?php echo $field_column_2; ?>">
            <?php
            echo form_dropdown(array(
                "id" => "region",
                "name" => "region",
                "class" => "form-control select2",
                "placeholder" => 'Region',
                "autocomplete" => "off",
                'data-rule-required' => true,
                'data-msg-required' => app_lang('field_required'),
            ),$regions,[$model_info->region]);
            ?>
        </div>
        
        <label for="district" class=" <?php echo $label_column_2; ?>"><?php echo 'District'; ?></label>
        <div class="<?php echo $field_column_4; ?>">
            <?php
            echo form_dropdown(array(
                "id" => "district",
                "name" => "district",
                "class" => "form-control select2",
                "placeholder" => 'Owner Property',
                "autocomplete" => "off",
                'data-rule-required' => true,
                'data-msg-required' => app_lang('field_required'),
            ),$districts,[$model_info->district]);
            ?>
        </div>
    </div>
</div>

<!----------------------------------------- Address  ------------------------------------>


<div class="form-group">
    <div class="row">
        <label for="address" class=" <?php echo $label_column; ?>"><?php echo 'Address'; ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_textarea(array(
                "id" => "address",
                "name" => "address",
                "class" => "form-control",
                "placeholder" => 'Address',
                'data-rule-required' => true,
                'data-msg-required' => app_lang('field_required'),
                "value" => $model_info->address
            ));
            ?>
        </div>
    </div>
</div>

<!----------------------------------------- Area  ------------------------------------>


<div class="form-group">
    <div class="row">
        <label for="area" class="<?php echo $label_column; ?> company_name_section"><?php echo app_lang('area'); ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_input(array(
                "id" => "area",
                "name" => "area",
                "value" => $model_info->area,
                "class" => "form-control company_name_input_section",
                "placeholder" => app_lang('area'),
                'data-rule-required' => true,
                'data-msg-required' => app_lang('field_required'),
            ));
            ?>
        </div>
    </div>
</div>

<!----------------------------------------- property Value  ------------------------------------>


<div class="form-group">
    <div class="row">
        <label for="property_value" class="<?php echo $label_column; ?> company_name_section"><?php echo app_lang('property_value'); ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_input(array(
                "id" => "property_value",
                "name" => "property_value",
                "value" => $model_info->propertyValue,
                "class" => "form-control company_name_input_section",
                "placeholder" => app_lang('property_value'),
                'data-rule-required' => true,
                'data-msg-required' => app_lang('field_required'),
            ));
            ?>
        </div>
    </div>
</div>



<!-- 

<div class="form-group">
    <div class="col-md-12">
        <?php
        //echo view("includes/file_list", array("files" => $model_info->files));
        ?>
    </div>
</div> -->


<?php echo view("includes/dropzone_preview"); ?>


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

    });
</script>