<input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
<input type="hidden" name="view" value="<?php echo isset($view) ? $view : ""; ?>" />

<div class="form-group">
    <div class="row">
        <label for="type" class="<?php echo $label_column; ?>"><?php echo app_lang('type'); ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_radio(array(
                "id" => "type_organization",
                "name" => "account_type",
                "class" => "form-check-input account_type",
                "data-msg-required" => app_lang("field_required"),
                    ), "organization", ($model_info->type === "organization") ? true : (($model_info->type !== "person") ? true : false));
            ?>
            <label for="type_organization" class="mr15"><?php echo app_lang('organization'); ?></label>
            <?php
            echo form_radio(array(
                "id" => "type_person",
                "name" => "account_type",
                "class" => "form-check-input account_type",
                "data-msg-required" => app_lang("field_required"),
                    ), "person", ($model_info->type === "person") ? true : false);
            ?>
            <label for="type_person" class=""><?php echo app_lang('person'); ?></label>
        </div>
    </div>
</div>

<?php if ($model_info->id) { ?>
    <div class="form-group">
        <div class="row">
            <?php if ($model_info->type == "person") { ?>
                <label for="name" class="<?php echo $label_column; ?> company_name_section"><?php echo app_lang('name'); ?></label>
            <?php } else { ?>
                <label for="company_name" class="<?php echo $label_column; ?> company_name_section"><?php echo app_lang('company_name'); ?></label>
            <?php } ?>
            <div class="<?php echo $field_column; ?>">
                <?php
                echo form_input(array(
                    "id" => ($model_info->type == "person") ? "name" : "company_name",
                    "name" => "company_name",
                    "value" => $model_info->company_name,
                    "class" => "form-control company_name_input_section",
                    "placeholder" => app_lang('company_name'),
                    "autofocus" => true,
                    "data-rule-required" => true,
                    "data-msg-required" => app_lang("field_required"),
                ));
                ?>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="form-group">
        <div class="row">
            <label for="company_name" class="<?php echo $label_column; ?> company_name_section"><?php echo app_lang('company_name'); ?></label>
            <div class="<?php echo $field_column; ?>">
                <?php
                echo form_input(array(
                    "id" => "company_name",
                    "name" => "company_name",
                    "value" => $model_info->company_name,
                    "class" => "form-control company_name_input_section",
                    "placeholder" => app_lang('company_name'),
                    "autofocus" => true,
                    "data-rule-required" => true,
                    "data-msg-required" => app_lang("field_required"),
                ));
                ?>
            </div>
        </div>
    </div>
<?php } ?>


<!-----------------------------------------  Mother Name ------------------------------------>

<div class="form-group">
    <div class="row">
        <label for="mother_name" class="<?php echo $label_column; ?>"><?php echo 'Mother Name'; ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_input(array(
                "id" => "mother_name",
                "name" => "mother_name",
                "value" => $model_info->mother_name,
                "class" => "form-control",
                "placeholder" => 'Mother Name'
            ));
            ?>
        </div>
    </div>
</div>

<!-----------------------------------------  Nationalities  ------------------------------------>

<div class="form-group">
    <div class="row">
        <label for="nationality" class="<?php echo $label_column; ?>"><?php echo 'Nationality'; ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_dropdown(array(
                "id" => "nationality",
                "name" => "nationality",
                "class" => "form-control select2",
                "placeholder" => 'Nationality',
                "autocomplete" => "off",
                'data-rule-required' => true,
                'data-msg-required' => app_lang('field_required'),
            ),$Nationalities,[$model_info->nationality]);
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

<!----------------------------------------- Address ------------------------------------>

<div class="form-group">
    <div class="row">
        <label for="address" class="<?php echo $label_column; ?>"><?php echo app_lang('address'); ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_textarea(array(
                "id" => "address",
                "name" => "address",
                "value" => $model_info->address ? $model_info->address : "",
                "class" => "form-control",
                "placeholder" => app_lang('address')
            ));
            ?>

        </div>
    </div>
</div>

<!----------------------------------------- Email ------------------------------------>

<div class="form-group">
    <div class="row">
        <label for="email" class="<?php echo $label_column; ?>"><?php echo app_lang('email'); ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_input(array(
                "id" => "email",
                "name" => "email",
                "value" => $model_info->email,
                "class" => "form-control",
                "placeholder" => app_lang('email')
            ));
            ?>
        </div>
    </div>
</div>

<!----------------------------------------- Phone ------------------------------------>

<div class="form-group">
    <div class="row">
        <label for="phone" class="<?php echo $label_column; ?>"><?php echo app_lang('phone'); ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_input(array(
                "id" => "phone",
                "name" => "phone",
                "value" => $model_info->phone,
                "class" => "form-control",
                "placeholder" => app_lang('phone')
            ));
            ?>
        </div>
    </div>
</div>

<!----------------------------------------- Gender ------------------------------------>

<div class="form-group">
    <div class="row">
        <label for="gender" class="<?php echo $label_column; ?>"><?php echo app_lang('gender'); ?></label>
        <div class=" col-md-9">
            <?php
            echo form_radio(array(
                "id" => "gender_male",
                "name" => "gender",
                "class" => "form-check-input",
                    ), "Male", ($model_info->gender === "Male") ? true : false, "class='form-check-input'");
            ?>
            <label for="gender_male" class="mr15 p0"><?php echo app_lang('male'); ?></label> 
            <?php
            echo form_radio(array(
                "id" => "gender_female",
                "name" => "gender",
                "class" => "form-check-input",
                    ), "Female", ($model_info->gender === "Female") ? true : false, "class='form-check-input'");
            ?>
            <label for="gender_female" class="p0 mr15"><?php echo app_lang('female'); ?></label>
            
        </div>
    </div>
</div>

<!----------------------------------------- Place of Birth ------------------------------------>

<div class="form-group">
    <div class="row">
        <label for="birth_place" class="<?php echo $label_column; ?>"><?php echo 'Place of Birth'; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "birth_place",
                "name" => "birth_place",
                "value" => $model_info->birth_place,
                "class" => "form-control",
                "placeholder" => 'Place of Birth'
            ));
            ?>
        </div>
    </div>
</div>

<!----------------------------------------- Date of Birth ------------------------------------>

<div class="form-group">
    <div class="row">
        <label for="birth_date" class="<?php echo $label_column; ?>"><?php echo 'Date of Birth'; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "birth_date",
                "name" => "birth_date",
                "value" => $model_info->birth_date,
                "class" => "form-control",
                "placeholder" => 'Date of Birth'
            ));
            ?>
        </div>
    </div>
</div>

<div class="form-group">
    <?php
        echo view("includes/multi_file_uploader", array(
            "upload_url" => get_uri("clients/upload_file"),
            "validation_url" => get_uri("clients/validate_file"),
        ));
    ?>
</div>


<!----------------------------------------- Photo ------------------------------------>

<!-- 
<div class="form-group">
    <div class="row">
        <label for="photo" class="<?php //echo $label_column; ?>"><?php// echo 'Photo'; ?></label>
        <div class=" col-md-9">
            <button class="btn btn-default upload-file-button float-start me-auto btn-sm round" type="button" style="color:#7988a2"><i data-feather="camera" class="icon-16"></i> <?php echo "Upload Photo" ?></button>
            <?php// echo view("includes/dropzone_preview"); ?>
            <?php// echo view("includes/file_list", array("files" => $model_info->photo)); ?>
        </div>
    </div>
</div> -->

<!----------------------------------------- identification ------------------------------------>
<!-- 
<div class="form-group">
    <div class="row">
        <label for="identification" class="<?php// echo $label_column; ?>"><?php //echo 'Identification'; ?></label>
        <div class=" col-md-9">
            <button class="btn btn-default upload-file-button float-start me-auto btn-sm round" type="button" style="color:#7988a2"><i data-feather="camera" class="icon-16"></i> <?php echo "Upload Identification" ?></button>
            <?php //echo view("includes/dropzone_preview"); ?>
            <?php //echo view("includes/file_list", array("files" => $model_info->identification)); ?>
        </div>
    </div>
</div> -->

<!----------------------------------------- Signature ------------------------------------>

<!-- <div class="form-group">
    <div class="row">
        <label for="signature" class="<?php// echo $label_column; ?>"><?php// echo 'Signature'; ?></label>
        <div class=" col-md-9">
            <button class="btn btn-default upload-file-button float-start me-auto btn-sm round" type="button" style="color:#7988a2"><i data-feather="camera" class="icon-16"></i> <?php echo "Upload Signature" ?></button>
            <?php// echo view("includes/dropzone_preview"); ?>
            <?php //echo view("includes/file_list", array("files" => $model_info->signature)); ?>
        </div>
    </div>
</div> -->

<script type="text/javascript">
    $(document).ready(function () {

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


        setDatePicker("#birth_date");
        $("#client-form .select2").select2();


    });
</script>