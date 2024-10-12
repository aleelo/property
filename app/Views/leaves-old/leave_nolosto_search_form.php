  
        <?php if(!empty($leave_info)){ ?>
        <div class="" >                   
            <div class="container">
                <div class="ticket-header" style="padding: 0px !important;background-color: #6bc6ff !important;">
                    <img id="logo" src="<?php echo base_url().'assets/images/sys-logo-white.png';?>" style="width: 400px;">
                    &nbsp;&nbsp;
                </div>
                <div class="ticket-body">
                    <h2 class="text-center mb-3"><?php echo strtoupper($leave_info->leave_type) ?></h2>
                    <div class="ticket-name">
                        <p>Howlwadeen:</p>
                        <h2 style="font-size: 20px;"><?php echo $leave_info->applicant_name;?></h2>
                    </div>
                    <div class="ruler"></div>
                    <div class="ticket-number-date">
                        <div>
                            <p>PASSPORT NO.</p>
                            <h2 style="font-size: 20px;"><?php echo $leave_info->passport_no;?></h2>
                        </div>
                        <div>
                            <p>DATE</p>
                            <h2 style="font-size: 20px;"><?php echo date_format(new DateTime($leave_info->start_date),'d M, Y');?></h2>
                        </div>
                    </div>
                    <div class="ruler"></div>
                    <div class="ticket-from-and-to justify-content-center">
                        <div class="clearfix">
                                <div class="d-flex text-center align-items-center">
                                    <div class="flex-shrink-0">
                                        <span class="avatar" style="width: 100px;height: 130px;">
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
                    </div>
                    
                    <div class="ruler"></div>
                    <div class="bording">
                        <div class="bording-content" style="padding: 20px 35px;">
                            <p>LEAVE DATE #</p>
                            <h4 style="font-size: 14px;"><?php echo date_format(new DateTime($leave_info->start_date),'F d, Y').' - '.date_format(new DateTime($leave_info->end_date),'F d, Y');?></h4>
                        </div>
                    </div>
                    <div class="qrcode">
                    <?php
                                
                        $options = new chillerlan\QRCode\QROptions([
                            'eccLevel' => chillerlan\QRCode\Common\EccLevel::L,
                            'outputBase64' => true,
                            // 'cachefile' => APPPATH . 'Views/documents/qrcode.png',
                            // 'outputType'=>QROutputInterface::GDIMAGE_PNG,
                            'logoSpaceHeight' => 17,
                            'logoSpaceWidth' => 17,
                            'scale' => 20,
                            'version' => chillerlan\QRCode\Common\Version::AUTO,

                        ]);
                        echo "<img style='border-radius: 7px;border: 1px solid #1f8bf2;' width='150' src=". (new chillerlan\QRCode\QRCode($options))->render(get_uri('visitors_info/show_leave_qrcode/'.$leave_info->uuid))." alt='Scan to see' />";?>
                
                        <!-- <svg class="code" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 448 448" enable-background="new 0 0 448 448" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path fill="#323232" d="M288,0v160h160V0H288z M416,128h-96V32h96V128z"></path> <rect x="64" y="64" fill="#323232" width="32" height="32"></rect> <rect x="352" y="64" fill="#323232" width="32" height="32"></rect> <polygon fill="#323232" points="256,64 224,64 224,32 256,32 256,0 192,0 192,96 224,96 224,128 256,128 "></polygon> <path fill="#323232" d="M160,160V0H0v160h32H160z M32,32h96v96H32V32z"></path> <polygon fill="#323232" points="0,192 0,256 32,256 32,224 64,224 64,192 "></polygon> <polygon fill="#323232" points="224,224 256,224 256,160 224,160 224,128 192,128 192,192 224,192 "></polygon> <rect x="352" y="192" fill="#323232" width="32" height="32"></rect> <rect x="416" y="192" fill="#323232" width="32" height="32"></rect> <polygon fill="#323232" points="320,256 320,288 352,288 352,320 384,320 384,256 352,256 352,224 320,224 320,192 288,192 288,224 256,224 256,256 "></polygon> <rect x="384" y="224" fill="#323232" width="32" height="32"></rect> <path fill="#323232" d="M0,288v160h160V288H0z M128,416H32v-96h96V416z"></path> <polygon fill="#323232" points="256,256 224,256 224,224 192,224 192,192 96,192 96,224 64,224 64,256 128,256 128,224 160,224 160,256 192,256 192,288 224,288 224,320 256,320 "></polygon> <rect x="288" y="288" fill="#323232" width="32" height="32"></rect> <rect x="416" y="256" fill="#323232" width="32" height="64"></rect> <rect x="320" y="320" fill="#323232" width="32" height="32"></rect> <rect x="384" y="320" fill="#323232" width="32" height="32"></rect> <rect x="64" y="352" fill="#323232" width="32" height="32"></rect> <polygon fill="#323232" points="320,384 320,352 288,352 288,320 256,320 256,352 224,352 224,320 192,320 192,384 224,384 224,416 256,416 256,384 "></polygon> <polygon fill="#323232" points="352,384 320,384 320,416 352,416 352,448 384,448 384,352 352,352 "></polygon> <rect x="416" y="352" fill="#323232" width="32" height="32"></rect> <rect x="192" y="416" fill="#323232" width="32" height="32"></rect> <rect x="256" y="416" fill="#323232" width="64" height="32"></rect> <rect x="416" y="416" fill="#323232" width="32" height="32"></rect> </g> </g></svg> -->
                    </div>
                    <div class="d-flex justify-content-end mt-3 hprint">
                        <!-- <a class="btn btn-warning text-white mr10 hprint" href="<?php //echo get_uri('visitors_info/show_leave_qrcode_return/'.$leave_info->uuid);?>">
                    <i data-feather='file' class='icon-16 '></i> Passport Celin</a> -->
                    </div>
                </div>
            </div>
                
        <?php }else{ ?>
            <div class="d-flex justify-content-center col-xs-12 ">
                <p class="p10 m10 fs-3">No result to show</p>
            </div>
            <?php } ?>

        <?php if(!empty($leave_info) && $leave_info->nolo_status == 0){ ?>
         
            <div class=" col-md-12 search-container" style="" id="btn-confirm">         
            <?php echo form_open(get_uri("leaves/approve_nolosto/".$leave_info->id),  array("data-id"=> $leave_info->id, "id" => "leave-nolosto_approve", "class" => "general-form", "role" => "form","method"=>"POST")); ?>

                <div class="shadow d-flex  col-xs-12 mx-0 mb-0 rounded-0">
                    <button type="submit" class="btn btn-primary w100p rounded-0"><i class="search"></i> Approve Nolo Osto  </button>
                </div>
                <?php echo form_close() ?>

            </div>
        <?php } ?>
   
    </div>

<script>
    
$('#leave-nolosto_approve').on('submit', function(e){
    e.preventDefault();
    
    // alert('submit');
    $.ajax({
        url: 'leaves/approve_nolosto/'+ $(this).attr('data-id'),
        cache: false,
        dataType: 'json',
        type: 'POST',
        success: function (result) {

            //  console.log(result.success);
            alert(result.message);
            // window.location.reload();
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