<?php echo form_open(get_uri("agreements/save"), array("id" => "client-form", "class" => "general-form", "role" => "form")); ?>
<div id="agreements-dropzone" class="post-dropzone">
    <div class="modal-body clearfix">
        <div class="container-fluid">
            <input type="hidden" name="ticket_id" value="<?php echo $ticket_id; ?>" />
            <?php echo view("agreements/agreement_form_fields"); ?>

            <!----------------------------------------- Files  ------------------------------------>

            <div class="form-group">
                <?php
                    echo view("includes/multi_file_uploader", array(
                        "upload_url" => get_uri("clients/upload_file"),
                        "validation_url" => get_uri("clients/validate_file"),
                    ));
                ?>
            </div>

        </div>
    </div>

    <div class="modal-footer">
        <div id="link-of-add-contact-modal" class="hide">
            <?php echo modal_anchor(get_uri("agreements/add_new_contact_modal_form"), "", array()); ?>
        </div>

        <button class="btn btn-default upload-file-button float-start me-auto btn-sm round" type="button" style="color:#7988a2"><i data-feather="camera" class="icon-16"></i> <?php echo app_lang("upload_file"); ?></button>

        <button type="button" class="btn btn-default" data-bs-dismiss="modal"><span data-feather="x" class="icon-16"></span> <?php echo app_lang('close'); ?></button>

        <!-- <?php if (!$model_info->id) { ?>
            <button type="button" id="save-and-continue-button" class="btn btn-info text-white"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('save_and_continue'); ?></button>
        <?php } ?> -->

        <button id="save_button" type="submit" class="btn btn-primary"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('save'); ?></button>
    </div>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function () {

        var uploadUrl = "<?php echo get_uri("agreements/upload_file"); ?>";
        var validationUri = "<?php echo get_uri("agreements/validate_events_file"); ?>";

        var dropzone = attachDropzoneWithForm("#agreements-dropzone", uploadUrl, validationUri);
        
        var ticket_id = "<?php echo $ticket_id; ?>";

        window.clientForm = $("#client-form").appForm({
            closeModalOnSuccess: false,
            onSuccess: function (result) {
                var $addMultipleContactsLink = $("#link-of-add-contact-modal").find("a");

                if (result.view === "details" || ticket_id) {
                    if (window.showAddNewModal) {
                        $addMultipleContactsLink.attr("data-post-client_id", result.id);
                        $addMultipleContactsLink.attr("data-title", "<?php echo app_lang('add_multiple_contacts') ?>");
                        $addMultipleContactsLink.attr("data-post-add_type", "multiple");

                        $addMultipleContactsLink.trigger("click");
                    } else {
                        appAlert.success(result.message, {duration: 10000});
                        setTimeout(function () {
                            location.reload();
                        }, 500);
                    }
                } else if (window.showAddNewModal) {
                    $addMultipleContactsLink.attr("data-post-client_id", result.id);
                    $addMultipleContactsLink.attr("data-title", "<?php echo app_lang('add_multiple_contacts') ?>");
                    $addMultipleContactsLink.attr("data-post-add_type", "multiple");

                    $addMultipleContactsLink.trigger("click");

                    $("#client-table").appTable({newData: result.data, dataId: result.id});
                } else {
                    $("#client-table").appTable({newData: result.data, dataId: result.id});
                    window.clientForm.closeModal();
                }
                location.reload();

            }
        });
        // setTimeout(function () {
        //     $("#company_name").focus();
        // }, 200);

        //save and open add new contact member modal
        window.showAddNewModal = false;

        $("#save-and-continue-button").click(function () {
            window.showAddNewModal = true;
            $(this).trigger("submit");
        });
        
    });
</script>    