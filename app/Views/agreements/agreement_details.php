<div class="modal-body">
    <div class="row">
 
        <!-- uuid, document_title,created_by,ref_number,depertment,template,item_id,webUrl -->
        <div class="table-responsive mb15">
            <table class="table dataTable display b-t">
                <tr>
                    <td class="w100"> <?php echo app_lang('title_deed_no'); ?></td>
                    <td><?php echo $agreement_info->titleDeedNo; ?></td>
                </tr>
                <tr>
                    <td> <?php echo app_lang('created_at'); ?></td>
                    <td><?php echo $agreement_info->created_at_meta; ?></td>
                </tr>
                <tr>
                    <td> <?php echo app_lang('buyer'); ?></td>
                    <td><?php echo $agreement_info->buyer; ?></td>
                </tr>
                <tr>
                    <td> <?php echo app_lang('seller'); ?></td>
                    <td><?php echo $agreement_info->seller; ?></td>
                </tr>
                <tr>
                    <td> <?php echo app_lang('witness'); ?></td>
                    <td><?php echo nl2br($agreement_info->witness); ?></td>
                </tr>
                <tr>
                    <td> <?php echo app_lang('agreement_type'); ?></td>
                    <td><?php echo nl2br($agreement_info->agreement_type); ?></td>
                </tr>
                <tr>
                    <td> <?php echo app_lang('amount'); ?></td>
                    <td><?php echo nl2br($agreement_info->amount); ?></td>
                </tr>
                <tr>
                    <td> <?php echo app_lang('payment_method'); ?></td>
                    <td><?php echo nl2br($agreement_info->payment_method); ?></td>
                </tr>
                <tr>
                    <td> <?php echo app_lang('status'); ?></td>
                    <td><?php echo $agreement_info->status_meta; ?></td>
                </tr>
                <?php if ($agreement_info->status === 'pending' || $agreement_info->status === 'signed') { ?>
                    <tr>
                        <td> <?php echo 'Sign From'; ?></td>
                        <td>
                            <?php
                            echo form_radio(array(
                                "id" => "sign_from_system",
                                "name" => "sign_from",
                                "class" => "form-check-input",
                            ), "System", ($agreement_info->sign_from === "System") ? true : false, "class='form-check-input'");
                            ?>
                            <label for="sign_from_system" class="mr15 p0"><?php echo 'System'; ?></label> 
                            <?php
                            echo form_radio(array(
                                "id" => "sign_from_manual",
                                "name" => "sign_from",
                                "class" => "form-check-input",
                            ), "Manual", ($agreement_info->sign_from === "Manual") ? true : false, "class='form-check-input'");
                            ?>
                            <label for="sign_from_manual" class="p0 mr15"><?php echo 'Manual'; ?></label>
                        </td>
                    </tr>
                <?php } ?>
              
            </table>
        </div>
    </div>
</div>

<?php echo form_open(get_uri("agreements/update_status"), array("id" => "leave-status-form", "class" => "general-form", "role" => "form")); ?>
<input type="hidden" name="id" value="<?php echo $agreement_info->id; ?>" />
<input type="hidden" name="status" id="agreement_status_input" value="" />
<input type="hidden" name="sign_from" id="agreement_sign_from_input" value="" />

<div class="modal-footer">

    <button type="button" class="btn btn-default btn-sm" data-bs-dismiss="modal"><span data-feather="x" class="icon-16"></span> <?php echo app_lang('close'); ?></button>
    <?php if ($agreement_info->status === 'pending') { ?>
        <button data-status="Signed" type="submit" class="btn btn-success btn-sm update-leave-status" style="background-color: #6341c5; border-color: #6341c5;"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('signed'); ?></button>
    <?php } ?>
    <?php if ($agreement_info->status === 'pending' || $agreement_info->status === 'signed') { ?>
        <button data-status="Completed" type="submit" class="btn btn-success btn-sm update-leave-status"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('completed'); ?></button>
    <?php } ?>
</div>
    <?php echo form_close(); ?>

    <script type="text/javascript">
    $(document).ready(function () {
        // Update status when a button is clicked
        $(".update-leave-status").click(function () {
            $("#agreement_status_input").val($(this).attr("data-status"));
        });

        // Update sign_from value based on selected radio button
        $('input[name="sign_from"]').change(function () {
            let selectedSignFrom = $('input[name="sign_from"]:checked').val();
            $("#agreement_sign_from_input").val(selectedSignFrom);
        });

        // Initialize the form submission
        $("#leave-status-form").appForm({
            onSuccess: function () {
                location.reload();
            }
        });

        // Trigger setting the sign_from input when the page is ready (to ensure default selected value is captured)
        let selectedSignFrom = $('input[name="sign_from"]:checked').val();
        $("#agreement_sign_from_input").val(selectedSignFrom);
    });
</script>
