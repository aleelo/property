<div class="modal-body">
    <div class="row">
        <!-- `client_type`, `access_duration`, `image`, `name`, `created_by`, `visit_date`, `visit_time`, `created_at`, `deleted`, `remarks`, `status` -->
        <div class="table-responsive mb15">
            <table class="table dataTable display b-t">
                <tr>
                    <td class=""> <?php echo app_lang('client_type'); ?></td>
                    <td><?php echo $visitor_info->client_type; ?></td>
                </tr>
                <?php if ($visitor_info->client_type != 'person'){?>
                    <tr>
                        <td class=""> <?php echo app_lang('company_name'); ?></td>
                        <td><?php echo $visitor_info->name; ?></td>
                    </tr>
                <?php }?>
                <tr>
                    <td> <?php echo app_lang('access_duration'); ?></td>
                    <td><?php echo $visitor_info->access_duration; ?></td>
                </tr>
                <tr>
                    <td> <?php echo app_lang('visit_date'); ?></td>
                    <td><?php echo date("h:i a, F d, Y",strtotime(date_format(new DateTime($visitor_info->visit_date),'Y-m-d').' '.$visitor_info->visit_time)); ?></td>
                </tr>
                <tr>
                    <td> <?php echo app_lang('status'); 
                    $bg = $visitor_info->status == 'Pending'?'warning': ($visitor_info->status == 'Approved'? 'primary' : 'danger');
                    
                    ?></td>
                    <td><span class='badge bg-<?php echo $bg; ?>'> <?php echo $visitor_info->status; ?></span></td>
                </tr>
                <?php if ($visitor_info->status === "Rejected") { ?>
                    <tr>
                        <td> <?php echo app_lang('rejected_by'); ?></td>
                        <td><?php
                            $image_url = get_avatar($visitor_info->rejected_avatar);
                            echo "<span class='avatar avatar-xs mr10'><img src='$image_url' alt=''></span><span>" . $visitor_info->rejected_by . "</span>";
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                <?php if ($visitor_info->status === "Approved") { ?>
                    <tr>
                        <td> <?php echo app_lang('approved_by'); ?></td>
                        <td><?php
                            $image_url = get_avatar($visitor_info->approved_avatar);
                            echo "<span class='avatar avatar-xs mr10'><img src='$image_url' alt=''></span><span>" . $visitor_info->approved_by . "</span>";
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td> <?php echo app_lang('remarks'); ?></td>
                    <td><?php echo nl2br($visitor_info->remarks ? $visitor_info->remarks : ""); ?></td>
                </tr>
            </table>
        </div>

        <div class="table-responsive mb15">
            <h3 class="text-info">Access Information</h3>
            <table class="table dataTable display b-t">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Visitor Name</th>
                        <th>Mobile</th>
                        <th>Vehicle Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;?>

                    <?php foreach ($visitor_details as $d){?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $d->visitor_name; ?></td>
                            <td><?php echo $d->mobile; ?></td>
                            <td><?php echo $d->vehicle_details; ?></td>
                        </tr>
                    <?php
                        $i++; 
                    } ?>

                </tbody>
            </table>
        </div>

    </div>
</div>
<?php echo form_open(get_uri("visitors/update_status"), array("id" => "visitor-status-form", "class" => "general-form", "role" => "form")); ?>
<input type="hidden" name="id" value="<?php echo $visitor_info->id; ?>" />
<input type="hidden" id="leave_status_input"  name="leave_status_input" value="" />

<div class="modal-footer">
    <button type="button" class="btn btn-default btn-sm" data-bs-dismiss="modal"><span data-feather="x" class="icon-16"></span> <?php echo app_lang('close'); ?></button>
    <!-- <?php //if ($visitor_info->status === "Pending" && $login_user->id === $visitor_info->applicant_id) { ?>
        <button data-status="canceled" type="submit" class="btn btn-danger btn-sm update-leave-status"><span data-feather="x-circle" class="icon-16"></span> <?php echo app_lang('cancel'); ?></button>
    <?php //} ?>    -->
    <?php if ($visitor_info->status === "Pending") { ?>
        <button data-status="Rejected" type="submit" class="btn btn-danger btn-sm update-leave-status"><span data-feather="x-circle" class="icon-16"></span> <?php echo app_lang('reject'); ?></button>
        <button data-status="Approved" type="submit" class="btn btn-success btn-sm update-leave-status"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('approve'); ?></button>
    <?php } ?>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function () {

        $('.modal-dialog').removeClass('modal-xl');

        $(".update-leave-status").click(function () {
            $("#leave_status_input").val($(this).attr("data-status"));
        });

        $("#visitor-status-form").appForm({
            onSuccess: function () {
                location.reload();
            }
        });

    });
</script>    