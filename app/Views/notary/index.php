<div id="page-content" class="page-wrapper clearfix">
    <div class="row">
        <div class="col-sm-3 col-lg-2">
            <?php
            $tab_view['active_tab'] = "notary";
            echo view("settings/tabs", $tab_view);
            ?>
        </div>

        <div class="col-sm-9 col-lg-10">
            <?php echo form_open(get_uri("notary/save"), array("id" => "notary-form", "class" => "general-form dashed-row", "role" => "form")); ?>
            <div class="card">
                <div class=" card-header">
                    <h4><?php echo 'Notary'; ?></h4>
                </div>
                <div class="card-body">

                <input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />

                    <!-----------------------------------------  Legal Name ------------------------------------>

                    <div class="form-group">
                        <div class="row">
                            <label for="legal_name" class=" col-md-2"><?php echo 'Legal Name'; ?></label>
                            <div class=" col-md-10">
                                <?php
                                echo form_input(array(
                                    "id" => "legal_name",
                                    "name" => "legal_name",
                                     "value" => $model_info->legal_name,
                                    "class" => "form-control",
                                    "placeholder" => 'Legal Name'
                                ));
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-----------------------------------------  Legal Structure ------------------------------------>

                    <div class="form-group">
                        <div class="row">
                            <label for="legal_structure" class=" col-md-2"><?php echo 'Legal Structure'; ?></label>
                            <div class=" col-md-10">
                                <?php
                                echo form_input(array(
                                    "id" => "legal_structure",
                                    "name" => "legal_structure",
                                     "value" => $model_info->legal_structure,
                                    "class" => "form-control",
                                    "placeholder" => 'Legal Structure'
                                ));
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-----------------------------------------  Region ------------------------------------>

                    <div class="form-group">
                        <div class="row">
                            <label for="region" class=" col-md-2"><?php echo 'Region'; ?></label>
                            <div class=" col-md-10">
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
                        </div>
                    </div>

                    <!----------------------------------------- Disctrict ------------------------------------>

                    <div class="form-group">
                        <div class="row">
                            <label for="district" class=" col-md-2"><?php echo 'District'; ?></label>
                            <div class=" col-md-10">
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
                            <label for="address" class="col-md-2"><?php echo 'Address'; ?></label>
                            <div class=" col-md-10">
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

                    
                    <!----------------------------------------- Owner  ------------------------------------>

                    <div class="form-group">
                        <div class="row">
                            <label for="notary_owner_id" class="col-md-2"><?php echo 'Owner'; ?></label>
                            <div class="col-md-10">
                                <?php
                                echo form_dropdown(array(
                                    "id" => "notary_owner_id",
                                    "name" => "notary_owner_id",
                                    "class" => "form-control select2",
                                    "placeholder" => 'Service',
                                    "autocomplete" => "off",
                                    'data-rule-required' => true,
                                    'data-msg-required' => app_lang('field_required'),
                                ),$owner,[$model_info->notary_owner_id]);
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><span data-feather='check-circle' class="icon-16"></span> <?php echo app_lang('save'); ?></button>
                </div>
            </div>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<?php echo view("includes/cropbox"); ?>

<?php
load_css(array(
    "assets/js/summernote/summernote.css"
));
load_js(array(
    "assets/js/summernote/summernote.min.js"
));
?>

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