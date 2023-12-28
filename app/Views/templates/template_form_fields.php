<input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
<input type="hidden" name="view" value="<?php echo isset($view) ? $view : ""; ?>" />

<div class="form-group">
    <div class="row">
        <label for="name" class="col-3"><?php echo app_lang('template_name'); ?></label>
        <div class="col-9">
            <?php
            echo form_input(array(
                "id" => "name",
                "name" => "name",
                "value" => $model_info->name,
                "class" => "form-control",
                "placeholder" => app_lang('template_name'),
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => app_lang("field_required"),
            ));
            ?>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <label for="name" class="col-3"><?php echo app_lang('template_prefix'); ?></label>
        <div class="col-9">
            <?php
            echo form_input(array(
                "id" => "ref_prefix",
                "name" => "ref_prefix",
                "value" => $model_info->ref_prefix,
                "class" => "form-control",
                "placeholder" => app_lang('template_prefix'),
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => app_lang("field_required"),
            ));
            ?>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <label for="name" class="col-3"><?php echo app_lang('template_destination'); ?></label>
        <div class="col-9">
            <?php
            echo form_input(array(
                "id" => "destination_folder",
                "name" => "destination_folder",
                "value" => $model_info->destination_folder,
                "class" => "form-control",
                "placeholder" => app_lang('template_destination'),
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => app_lang("field_required"),
            ));
            ?>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <label for="section" class="col-3"><?php echo app_lang('template_path'); ?>
        </label>
        <div class="col-9">
            <?php
            echo form_input(array(
                "id" => "path",
                "name" => "path",
                "value" => $model_info->path,
                "class" => "form-control",
                "placeholder" => app_lang('template_path')
            ));
            ?>
        </div>
    </div>
</div>

<div class="form-group" style="display:block;">
    <div class="row">
        <label for="department" class="col-3"><?php echo app_lang('depertment'); ?>
        </label>
        <div class="col-9">
            <?php
            echo form_dropdown(array(
                "id" => "department",
                "name" => "department",
                // "value" => $model_info->department,
                "class" => "form-control select2",
                "placeholder" => app_lang('depertment')
            ),$departments,[$model_info->department],"style='display:block';");
            ?>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $('[data-bs-toggle="tooltip"]').tooltip();
        $(".select2").select2();

        // $('#owner_id').select2({data: <?php //echo json_encode($owners_dropdown); ?>});

        // $("#lead_labels").select2({multiple: true, data: <?php //echo json_encode($label_suggestions); ?>});

    });
</script>
