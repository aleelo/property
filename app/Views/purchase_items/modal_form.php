<?php echo form_open(get_uri("purchase_items/save"), array("id" => "purchase-items-form", "class" => "general-form", "role" => "form")); ?>
<div id="items-dropzone" class="post-dropzone">
    <div class="modal-body clearfix">
        <div class="container-fluid">
            <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />

            <?php if ($model_info->id) { ?>
                <div class="form-group">
                    <div class="row">
                        <!-- <div class="col-md-12 text-off"> <?php //echo app_lang('item_edit_instruction'); ?></div> -->
                    </div>
                </div>
            <?php } ?>

            <div class="form-group">
                <div class="row">
                    <label for="name" class=" col-md-3"><?php echo app_lang('name'); ?></label>
                    <div class="col-md-9">
                        <?php
                        echo form_input(array(
                            "id" => "name",
                            "name" => "name",
                            "value" => $model_info->name,
                            "class" => "form-control validate-hidden",
                            "placeholder" => app_lang('name'),
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
                    <label for="description" class="col-md-3"><?php echo app_lang('description'); ?></label>
                    <div class=" col-md-9">
                        <?php
                        echo form_textarea(array(
                            "id" => "description",
                            "name" => "description",
                            "value" => $model_info->description ? process_images_from_content($model_info->description, false) : "",
                            "class" => "form-control",
                            "placeholder" => app_lang('description'),
                            "data-rich-text-editor" => true
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="unit_type" class=" col-md-3"><?php echo app_lang('unit_type'); ?></label>
                    <div class="col-md-9">
                        <?php
                        echo form_input(array(
                            "id" => "unit_type",
                            "name" => "unit_type",
                            "value" => $model_info->unit_type,
                            "class" => "form-control",
                            "placeholder" => app_lang('unit_type') . ' (Ex: hours, pc, etc.)'
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="item_price" class=" col-md-3"><?php echo app_lang('item_price'); ?></label>
                    <div class="col-md-9">
                        <?php
                        echo form_input(array(
                            "id" => "item_price",
                            "name" => "item_price",
                            "value" => $model_info->price ? to_decimal_format($model_info->price) : "",
                            "class" => "form-control",
                            "placeholder" => app_lang('item_price'),
                            "data-rule-required" => true,
                            "data-msg-required" => app_lang("field_required"),
                        ));
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal-footer">
        <!-- <button class="btn btn-default upload-file-button float-start btn-sm round me-auto" type="button" style="color:#7988a2"><i data-feather="camera" class="icon-16"></i> <?php echo app_lang("upload_image"); ?></button> -->
        <button type="button" class="btn btn-default" data-bs-dismiss="modal"><span data-feather="x" class="icon-16"></span> <?php echo app_lang('close'); ?></button>
        <button type="submit" class="btn btn-primary"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('save'); ?></button>
    </div>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function () {
        // var uploadUrl = "<?php //echo get_uri("purchase_items/upload_file"); ?>";
        // var validationUri = "<?php //echo get_uri("purchase_items/validate_items_file"); ?>";

        // var dropzone = attachDropzoneWithForm("#items-dropzone", uploadUrl, validationUri);

        $("#purchase-items-form").appForm({
            onSuccess: function (result) {
                
                $("#purchase-item-table").appTable({newData: result.data, dataId: result.id});
                if (result.id) {
               
                }
            }
        });

        $("#purchase-items-form .select2").select2();
    });
</script>