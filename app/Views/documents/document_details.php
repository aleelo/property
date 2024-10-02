<div class="modal-body">
    <div class="row">
 
        <!-- uuid, document_title,created_by,ref_number,depertment,template,item_id,webUrl -->
        <div class="table-responsive mb15">
            <table class="table dataTable display b-t">
                <tr>
                    <td class="w100"> <?php echo app_lang('document_title'); ?></td>
                    <td><?php echo $document_info->document_title; ?></td>
                </tr>
                <tr>
                    <td> <?php echo app_lang('created_at'); ?></td>
                    <td><?php echo date_format(new \DateTime($document_info->created_at),'d M Y'); ?></td>
                </tr>
                <tr>
                    <td> <?php echo app_lang('ref_number'); ?></td>
                    <td><?php echo $document_info->ref_number; ?></td>
                </tr>
                <tr>
                    <td> <?php echo app_lang('item_id'); ?></td>
                    <td><?php echo $document_info->item_id; ?></td>
                </tr>
                <tr>
                    <td> <?php echo app_lang('template'); ?></td>
                    <td><?php echo nl2br($document_info->template); ?></td>
                </tr>
                <tr>
                    <td> <?php echo app_lang('status'); ?></td>
                    <td><?php echo $document_info->status_meta; ?></td>
                </tr>
                <tr>
                    <td> <?php echo app_lang('created_by'); ?></td>
                    <td><?php
                        $image_url = get_avatar($document_info->created_by_image);
                        echo "<span class='avatar avatar-xs mr10'><img src='$image_url' alt=''></span><span>" . $document_info->created_by_user . "</span>";
                        ?>
                    </td>
                </tr>
                <?php if ($document_info->status === "rejected") { ?>
                    <tr>
                        <td> <?php echo app_lang('rejected_by'); ?></td>
                        <td><?php
                            $image_url = get_avatar($document_info->checked_by_image);
                            echo "<span class='avatar avatar-xs mr10'><img src='$image_url' alt=''></span><span>" . $document_info->checked_by_user . "</span>";
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                <?php if ($document_info->status === "approved") { ?>
                    <tr>
                        <td> <?php echo app_lang('approved_by'); ?></td>
                        <td><?php
                            $image_url = get_avatar($document_info->checked_by_image);
                            echo "<span class='avatar avatar-xs mr10'><img src='$image_url' alt=''></span><span>" . $document_info->checked_by_user . "</span>";

                            ?>
                        </td>
                    </tr>
                <?php } ?>
              
            </table>
        </div>
    </div>
</div>

<?php echo form_open(get_uri("documents/update_status"), array("id" => "leave-status-form", "class" => "general-form", "role" => "form")); ?>
<input type="hidden" name="id" value="<?php echo $document_info->id; ?>" />
<input id="leave_status_input" type="hidden" name="status" value="" />

<div class="modal-footer">

    <button type="button" class="btn btn-default btn-sm" data-bs-dismiss="modal"><span data-feather="x" class="icon-16"></span> <?php echo app_lang('close'); ?></button>

    <!-- Reject, Verify & Approve -->

    <?php if (($document_info->status === "active" || $document_info->status === "pending" ) && $show_approve_reject) { ?>

        <button data-status="rejected" type="submit" class="btn btn-danger btn-sm update-leave-status"><span data-feather="x-circle" class="icon-16"></span> <?php echo app_lang('reject'); ?></button>

        <?php if ($role === 'admin' || $role === 'HRM' || $role === 'Administrator') { ?>
            <!-- <button data-status="pending" type="submit" class="btn btn-warning btn-sm update-leave-status text-white"><span data-feather="check-circle" class="icon-16"></span> <?php //echo app_lang('verify'); ?></button> -->
            <button data-status="approved" type="submit" class="btn btn-success btn-sm update-leave-status"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('approve'); ?></button>
        <?php }else if ($role == 'Director' ) { ?>
            <button data-status="pending" type="submit" class="btn btn-warning btn-sm update-leave-status text-white"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('verify'); ?></button>
        <?php }?>

    <?php } ?>

    <?php if(strtolower($document_info->status) === "verified" || strtolower($document_info->status) === "pending" || strtolower($document_info->status) === "allowed"){?>
        <span class="text-warning">Waiting for approval.</span>
    <?php }?>
    </div>
    <?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function () {

        $(".update-leave-status").click(function () {
            $("#leave_status_input").val($(this).attr("data-status"));
        });

        $("#leave-status-form").appForm({
            onSuccess: function () {
                location.reload();
            }
        });

    });
</script>    