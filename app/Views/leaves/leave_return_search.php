
        <style>
            #return-table tbody th, #return-table tbody td {
                border-top: 1px solid #f2f2f2;
                padding-left: 40px !important;
                background-color: #fcab73 !important;
                color: white;
            }

            .qrcode-style{
                background-color: #fcab73 !important;
                color: white;
            }

            @media print {
                .qrcode-style {
                    background-color: #fcab73 !important;
                    color: white;
                }

                #default-navbar,#leaves-tabs,#leave-return-form,#js-init-chat-icon,.page-title,.sidebar {
                    display: none;
                }
                .print-area{
                    display: flex;
                }
                #return-table.dataTable.display tbody th, #return-table.dataTable.display tbody td {
                    border-top: 1px solid #f2f2f2;
                    padding-left: 40px !important;
                    background-color: #fcab73 !important;
                    color: white;
                }

                #search-card2{
                    width: 400px;
                    margin-left:auto;margin-right: auto;
                    margin-left: -150px;
                    background-color: #fcab73 !important;
                    color: white;
                }
                #return-table tbody td,#return-table tbody th {
                border-top: 1px solid #f2f2f2;
                    padding-left: 40px !important;
                    background-color: #fcab73 !important;
                    color: white;
                } 
                
                body,.page-wrapper,.sidebar-menu,.sidebar-scroll,.sidebar,#left-menu-toggle-mask{
                    background: #fff
                }
            }
           
            #searchTerm::placeholder {
                color: #a8aaae;
                /* color: #b2b3b4; */
                /* background-color: #fff; */
            }
        </style>

    <div class=" col-md-4 search-container" style="margin-left:auto;margin-right: auto;" id="search-container">

        <?php echo form_open(get_uri("leaves/leave_return_search"), array("id" => "leave-return-form", "class" => "general-form", "role" => "form","method"=>"POST")); ?>
            <div class="shadow d-flex align-item-center col-xs-12 mt-3">
                <input type="text" id="searchTerm" name="searchTerm" value="<?php echo $search == 0? '' : $search; ?>" class="form-control" placeholder="Search by id,name,mobile or any unique property" >
                <button type="submit" class="btn btn-primary rounded-0 rounded-end"><i class="search"></i> Search</button>
                
            </div>
        <?php echo form_close() ?>

        <?php if(!empty($leave_info)){ ?>
        <div class="card col-xs-12 mt-3 shadow-lg " style="background-color: #fcab73 !important;color: white;" id="search-card2">

            <div class="card-title text-center">
                <h4 class="fw-bold">Leave Information #<?php echo $leave_info->id; ?></h4>
                <h4 class="fw-bold mt-1">PASSPORT CELIN</h4>
            </div>
                
            <div class="modal-body">
                <div class="row">
                    <div class="p10 clearfix">
                        <div class="d-flex  justify-content-center">
                            <div class="flex-shrink-0">
                                <span class="avatar avatar-sm">
                                    <img src="<?php echo get_avatar($leave_info->applicant_avatar); ?>" alt="..." />
                                </span>
                            </div>
                            <div class="ps-2 pt5">
                                <div class="m0">
                                    <?php echo $leave_info->applicant_name; ?>
                                </div>
                                <p><span class='badge bg-primary'><?php echo $leave_info->job_title; ?></span> </p>
                            </div>
                        </div>
                    </div>
                    <!-- `client_type`, `access_duration`, `image`, `name`, `created_by`, `visit_date`, `visit_time`, `created_at`, `deleted`, `remarks`, `status` -->
                    <div class="table-responsive mb15">
                        <table class="table dataTable display b-t" id="return-table">
                        <tr>
                            <th class=""> <?php echo app_lang('leave_type'); ?></th>
                            <td><?php echo $leave_info->leave_type; ?></td>
                        </tr>
                        
                        <tr>
                            <th> <?php echo app_lang('duration'); ?></th>
                            <td><?php echo $leave_info->duration.' days'; ?></td>
                        </tr>

                        <?php if($leave_info->duration == 1){ ?>
                        <tr>
                            <th> <?php echo app_lang('date'); ?></th>
                            <td><?php echo date_format(new DateTime($leave_info->start_date),'M d,Y'); ?></td>
                        </tr>
                        <?php }else{ ?>
                            <tr>
                                <th> <?php echo app_lang('start_date'); ?></th>
                                <td><?php echo date_format(new DateTime($leave_info->start_date),'M d,Y'); ?></td>
                            </tr>
                            <tr>
                                <th> <?php echo app_lang('end_date'); ?></th>
                                <td><?php echo date_format(new DateTime($leave_info->end_date),'M d,Y'); ?></td>
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

                    <div class="d-flex justify-content-center mb-3">
                        <?php
                        
                            $options = new chillerlan\QRCode\QROptions([
                                'eccLevel' => chillerlan\QRCode\Common\EccLevel::H,
                                'outputBase64' => true,
                                // 'cachefile' => APPPATH . 'Views/documents/qrcode.png',
                                // 'outputType'=>QROutputInterface::GDIMAGE_PNG,
                                'logoSpaceHeight' => 17,
                                'logoSpaceWidth' => 17,
                                'scale' => 20,
                                'version' => chillerlan\QRCode\Common\Version::AUTO,

                            ]);
                            echo "<img style='border-radius: 7px;border: 1px solid #db620e;' width='150' src=". (new chillerlan\QRCode\QRCode($options))->render(get_uri('visitors_info/show_leave_qrcode/'.$leave_info->uuid))." alt='Scan to see' />";?>
                    </div>

                </div>
            </div>
        </div>
        <?php }else{ ?>
            <div class="shadow d-flex justify-content-center col-xs-12 mt-3 mb-3 " id="search-card2">
                <p class="p10 m10 fs-3">No result to show</p>
            </div>
            <?php } ?>
    </div>

<script>

$('#leave-return-form').on('submit', function(e){

    e.preventDefault();


    $.ajax({
            url: 'leaves/leave_return_search_form',
            data: {
                'searchTerm': $('#searchTerm').val(),
                // 'rise_csrf_token': $('input[name="rise_csrf_token"]').val(),
            },
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function (res) {
            //    console.log(result.success);
                $("#search-card2").html(res.result);


                feather.replace();
            },
            statusCode: {
                403: function () {
                    console.log("403: Session expired.");
                    // location.reload();
                },
                404: function () {
                    $("#search-container").find('.modal-body').html("");
                    appAlert.error("404: Page not found.", {container: '.search-container', animate: false});
                }
            },
            error: function () {
                $("#search-container").find('.modal-body').html("");
                appAlert.error("500: Internal Server Error.", {container: '.search-container', animate: false});
            }
        });

        
});
</script>

