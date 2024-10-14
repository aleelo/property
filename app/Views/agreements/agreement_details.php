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
                    <td><?php echo date_format(new \DateTime($agreement_info->created_at),'d M Y'); ?></td>
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
              
            </table>
        </div>
    </div>
</div>

<?php echo form_open(get_uri("agreements/update_status"), array("id" => "leave-status-form", "class" => "general-form", "role" => "form")); ?>
<input type="hidden" name="id" value="<?php echo $agreement_info->id; ?>" />
<input id="leave_status_input" type="hidden" name="status" value="" />

<div class="modal-footer">

    <button type="button" class="btn btn-default btn-sm" data-bs-dismiss="modal"><span data-feather="x" class="icon-16"></span> <?php echo app_lang('close'); ?></button>

    <!-- Reject, Verify & Approve -->

    <?php if ($agreement_info->status === "active" || $agreement_info->status === "pending") { ?>

        <?php if ($role === 'admin' || $role === 'HRM' || $role === 'Administrator') { ?>
            <!-- <button data-status="pending" type="submit" class="btn btn-warning btn-sm update-leave-status text-white"><span data-feather="check-circle" class="icon-16"></span> <?php //echo app_lang('verify'); ?></button> -->
            <button data-status="signed" type="submit" class="btn btn-success btn-sm update-leave-status"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('signed'); ?></button>
            <button data-status="completed" type="submit" class="btn btn-success btn-sm update-leave-status"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('completed'); ?></button>
        <?php }else if ($role == 'Director' ) { ?>
            <button data-status="pending" type="submit" class="btn btn-warning btn-sm update-leave-status text-white"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('verify'); ?></button>
        <?php }?>

    <?php } ?>

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