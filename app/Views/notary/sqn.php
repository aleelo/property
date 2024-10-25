                
    <?php echo form_open(get_uri("notary/save_sqn"), array("id" => "notary-form", "class" => "general-form dashed-row", "role" => "form")); ?>
        <div class="card-body">
            <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />

            <!-----------------------------------------  Legal Name ------------------------------------>

            <div class="form-group">
                <div class="row">
                    <label for="sqn_notary" class=" col-md-2"><?php echo 'Sequence Number'; ?></label>
                    <div class=" col-md-10">
                        <?php
                        echo form_input(array(
                            "id" => "sqn_notary",
                            "name" => "sqn_notary",
                            "value" => get_setting("sqn_notary"),
                            "class" => "form-control",
                            "placeholder" => 'SQN'
                        ));
                        ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><span data-feather='check-circle' class="icon-16"></span> <?php echo app_lang('save'); ?></button>
        </div>
    <?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#notary-form").appForm({
            isModal: false,
            beforeAjaxSubmit: function (data) {
                $.each(data, function (index, obj) {
                    if (obj.name === "invoice_footer") {
                        data[index]["value"] = encodeAjaxPostData(getWYSIWYGEditorHTML("#invoice_footer"));
                    }
                });
            },
            onSuccess: function (result) {
                if (result.success) {
                    appAlert.success(result.message, {duration: 10000});
                } else {
                    appAlert.error(result.message);
                }
            }
        });
        $("#notary-form .select2").select2();

        initWYSIWYGEditor("#invoice_footer", {height: 100});

        $(".cropbox-upload").change(function () {
            showCropBox(this);
        });

        $(".invoice-styles .item").click(function () {
            $(".invoice-styles .item").removeClass("active");
            $(".invoice-styles .item .selected-mark").addClass("hide");
            $(this).addClass("active");
            $(this).find(".selected-mark").removeClass("hide");
            $("#invoice_style").val($(this).attr("data-value"));
        });

        $('[data-bs-toggle="tooltip"]').tooltip();
    });
</script>