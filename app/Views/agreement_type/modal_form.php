<?php echo form_open(get_uri("agreement_type/save"), array("id" => "leave-type-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <div class="container-fluid">
        <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />

        <div class="form-group">
            <div class="row">
                <label for="service_name" class=" col-md-3"><?php echo 'Agreement Type'; ?></label>
                <div class=" col-md-9">
                    <?php
                    echo form_input(array(
                        "id" => "agreement_type",
                        "name" => "agreement_type",
                        "value" => $model_info->agreement_type,
                        "class" => "form-control",
                        "placeholder" => 'Agreement Type',
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
                <label for="service_id" class=" col-md-3"><?php echo 'Service'; ?></label>
                <div class=" col-md-9">
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
        
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-bs-dismiss="modal"><span data-feather="x" class="icon-16"></span> <?php echo app_lang('close'); ?></button>
    <button type="submit" class="btn btn-primary"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('save'); ?></button>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#leave-type-form").appForm({
            onSuccess: function (result) {
                $("#leave-type-table").appTable({newData: result.data, dataId: result.id});
            }
        });
        setTimeout(function () {
            $("#name").focus();
        }, 200);

        $("#leave-type-form .select2").select2();


    });
</script>    