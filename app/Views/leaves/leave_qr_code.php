<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo view('includes/head'); ?>
    </head>
    <body>

    <div class=" d-flex justify-content-center">
        <div class="card col-md-5 col-xs-12 mt-3 shadow-lg">
            <div class="card-title text-center"><h4 class="fw-bold">Leave Information #<?php echo $leave_info->id; ?></h4></div>
                
            <div class="modal-body">
                <div class="row">
                    <div class="p10 clearfix">
                        <div class="d-flex bg-white">
                            <div class="flex-shrink-0">
                                <span class="avatar avatar-sm">
                                    <img src="<?php echo get_avatar($leave_info->applicant_avatar); ?>" alt="..." />
                                </span>
                            </div>
                            <div class="ps-2 w-100 pt5">
                                <div class="m0">
                                    <?php echo $leave_info->applicant_name; ?>
                                </div>
                                <p><span class='badge bg-primary'><?php echo $leave_info->job_title; ?></span> </p>
                            </div>
                        </div>
                    </div>
                    <!-- `client_type`, `access_duration`, `image`, `name`, `created_by`, `visit_date`, `visit_time`, `created_at`, `deleted`, `remarks`, `status` -->
                    <div class="table-responsive mb15">
                        <table class="table dataTable display b-t">
                        <tr>
                            <th class="w200"> <?php echo app_lang('leave_type'); ?></th>
                            <td><?php echo $leave_info->leave_type; ?></td>
                        </tr>
                        
                        <tr>
                            <th> <?php echo app_lang('duration'); ?></th>
                            <td><?php echo $leave_info->duration.' days'; ?></td>
                        </tr>

                        <?php if($leave_info->duration == 1){ ?>
                        <tr>
                            <th> <?php echo app_lang('date'); ?></th>
                            <td><?php echo date_format(new DateTime($leave_info->start_date),'l,F d,Y'); ?></td>
                        </tr>
                        <?php }else{ ?>
                            <tr>
                                <th> <?php echo app_lang('start_date'); ?></th>
                                <td><?php echo date_format(new DateTime($leave_info->start_date),'l,F d,Y'); ?></td>
                            </tr>
                            <tr>
                                <th> <?php echo app_lang('end_date'); ?></th>
                                <td><?php echo date_format(new DateTime($leave_info->end_date),'l,F d,Y'); ?></td>
                            </tr>
                        <?php }?>
                        <tr>
                            <th> <?php echo app_lang('reason'); ?></th>
                            <td><?php echo nl2br($leave_info->reason ? $leave_info->reason : ""); ?></td>
                        </tr>
                        <tr>
                            <th> <?php echo app_lang('status'); ?></th>
                            <td><?php echo $leave_info->status; ?></td>
                        </tr>
                        <?php if ($leave_info->status === "rejected") { ?>
                            <tr>
                                <th> <?php echo app_lang('rejected_by'); ?></th>
                                <td><?php
                                    $image_url = get_avatar($leave_info->checker_avatar);
                                    echo "<span class='avatar avatar-xs mr10'><img src='$image_url' alt=''></span><span>" . $leave_info->checker_name . "</span>";
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if ($leave_info->status === "approved") { ?>
                            <tr>
                                <th> <?php echo app_lang('approved_by'); ?></th>
                                <td><?php
                                    $image_url = get_avatar($leave_info->checker_avatar);
                                    echo "<span class='avatar avatar-xs mr10'><img src='$image_url' alt=''></span><span>" . $leave_info->checker_name . "</span>";
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function () {

        $('#js-init-chat-icon').hide();

        });
        
    </script>    

</body>
</html>