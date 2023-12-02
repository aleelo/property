<input type="hidden" name="id" id='id' value="<?php echo $model_info->id; ?>" />
<input type="hidden" name="view" value="<?php echo isset($view) ? $view : ""; ?>" />


<!-- `document_title`, `ref_number`, `depertment`, `template`, `item_id`, `created_at` -->

<div class="form-group">
    <div class="row">
        <label for="type" class="<?php echo 'col-3'; ?>"><?php echo app_lang('visitor_type'); ?></label>
        <div class="col-9">
            <?php
            echo form_radio(array(
                "id" => "type_organization",
                "name" => "client_type",
                "class" => "form-check-input client_type",
                "data-msg-required" => app_lang("field_required"),
                    ), "organization", ($model_info->client_type === "organization") ? true : (($model_info->client_type !== "person") ? true : false));
            ?>
            <label for="type_organization" class="mr15"><?php echo app_lang('organization'); ?></label>
            <?php
            echo form_radio(array(
                "id" => "type_person",
                "name" => "client_type",
                "class" => "form-check-input client_type",
                "data-msg-required" => app_lang("field_required"),
                    ), "person", ($model_info->client_type === "person") ? true : false);
            ?>
            <label for="type_person" class=""><?php echo app_lang('person'); ?></label>
        </div>
    </div>
</div>

<?php if ($model_info->id) { ?>
    <div class="form-group">
        <div class="row">
            <?php if ($model_info->client_type == "person") { ?>
                <label for="name" class="<?php echo $label_column; ?> company_name_section"><?php echo app_lang('name'); ?></label>
            <?php } else { ?>
                <label for="company_name" class="<?php echo $label_column; ?> company_name_section"><?php echo app_lang('company_name'); ?></label>
            <?php } ?>
            <div class="<?php echo $field_column; ?>">
                <?php
                echo form_input(array(
                    "id" => ($model_info->client_type == "person") ? "name" : "company_name",
                    "name" => "name",
                    "value" => $model_info->name,
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
                    "name" => "name",
                    "value" => $model_info->name,
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

<div class="form-group">
    <div class="row">
        <label for="visit_date" class="<?php echo 'col-3'; ?>"><?php echo app_lang('visit_date'); ?></label>
        <div class="col-6">
            <?php
            echo form_input(array(
                "id" => "visit_date",
                "name" => "visit_date",
                "value" => $model_info->visit_date ? $model_info->visit_date : "",
                "class" => "form-control date",
                "placeholder" => app_lang('visit_date'),
                "data-rule-required" => true,
                "data-msg-required" => app_lang("field_required"),
            ),);
            ?>

        </div>
        <div class="col-3">
            <?php
            echo form_input(array(
                "id" => "visit_time",
                "name" => "visit_time",
                "value" => $model_info->visit_time ? $model_info->visit_time : "",
                "class" => "form-control time",
                "placeholder" => app_lang('visit_time'),
                "data-rule-required" => true,
                "data-msg-required" => app_lang("field_required"),
            ),);
            ?>

        </div>
    </div>
</div>

<div class="form-group ">
    <hr class="mt-4 mb-4">
    <button type="button" class="btn btn-success float-end" id="add_visitor_btn"><i data-feather="plus-circle" class='icon'></i> Add Visitors</button>

</div>
<div class="form-group mt-4" style="clear: both;">
    <div class="row">
         <table class="table" id="add_visitors_table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Visitor Name</th>
                    <th>Mobile</th>
                    <th>Vehicle Details</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
         </table>       
    </div>
</div>

<div class="form-group">
    <div class="row">
        <label for="remarks" class="<?php echo app_lang('remarks'); ?>"><?php echo app_lang('remarks'); ?></label>
        <div class="">
            <?php
            echo form_textarea(array(
                "id" => "remarks",
                "name" => "remarks",
                "value" => $model_info->remarks ? $model_info->remarks : "",
                "class" => "form-control",
                'rows' => '5',
                'cols' => '7',
                "placeholder" => 'Additional Information'
            ),);
            ?>

        </div>
    </div>
</div>

<?php //echo view("custom_fields/form/prepare_context_fields", array("custom_fields" => $custom_fields, "label_column" => $label_column, "field_column" => $field_column)); ?> 

<script type="text/javascript">
    $(document).ready(function () {
        $('[data-bs-toggle="tooltip"]').tooltip();
        $(".select2").select2();

        // $('#owner_id').select2({data: <?php //echo json_encode($owners_dropdown); ?>});

        // $("#lead_labels").select2({multiple: true, data: <?php //echo json_encode($label_suggestions); ?>});

        $('.client_type').click(function () {
            var inputValue = $(this).attr("value");
            if (inputValue === "person") {
                $(".company_name_section").html("Name");
                $(".company_name_input_section").attr("placeholder", "Name");
                $('#company_name').val('Person')
                $('#company_name').parent().parent().hide();
            } else {
                $(".company_name_section").html("Company name");
                $(".company_name_input_section").attr("placeholder", "Company name");

                $('#company_name').val('');
                $('#company_name').parent().parent().show();
                
            }
        });
    });

    feather.replace();
</script>