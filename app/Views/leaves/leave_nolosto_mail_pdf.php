
    <style>    
               
        #search-container1 {
            width: 440px;
        }

        /* @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

        * {
            margin: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        } */
    
        
    </style>

    <div class=" search-container" style="margin-left:auto;margin-right: auto;width: 100%;font-family: 'system-ui';" id="search-container1" >

        <div class="shadow d-flex justify-content-center col-xs-12 mt-3 mb-3 " id="search-card1" style="display: flex;justify-content: center;">
            <?php if(!empty($leave_info)){ ?>
            <div class="" >                   
                <div class="container" style=" background-color: #e7f6ff;
            width: 440px; border-top-left-radius:  7px;border-top-right-radius:  7px;
            padding: 0px; color: #4f4f74;margin-left:auto;margin-right: auto;">
                    <div class="ticket-header" style="padding: 0px !important;background-color: #6bc6ff !important;background-color: #88d1ff !important;
            color: white;
            border-top-left-radius:  7px;
            border-top-right-radius:  7px;
            text-align: center;
            padding: 15px 5px;
            display: flex;
            align-items: center;justify-content: center;height: 90px">
                        <img id="logo" src="<?php
                          $p = get_uri('assets/images/sys-logo-white.png');
                         
                          $type = pathinfo($p, PATHINFO_EXTENSION);
                          $d = file_get_contents($p);
                          $logo_image = 'data:image/' . $type . ';base64,' . base64_encode($d);
                          
                          echo $logo_image;
                          ?>" style="width: 400px;margin-top: 18px;padding:0;margin-bottom: 0;">
                        &nbsp;&nbsp;
                    </div>
                    <div class="ticket-body" style=" padding: 20px 15px;">
                        <h2 class="text-center " style="margin-bottom: 15px;color: #264a78;text-align:center;margin-top: 0;"><?php echo strtoupper($leave_info->leave_type) ?></h2>
                        <div class="ticket-name">
                            <p style=" font-size: 0.9rem;
                                color: midnightblue;font-weight: 300;margin:0;">Howlwadeen:</p>
                            <h2 style="font-size: 20px;margin:0;"><?php echo $leave_info->applicant_name;?></h2>
                        </div>
                        <div class="ruler"  style="margin: 1rem 0; height: 1px; background: #20a3f6;"></div>
                        <div class="ticket-number-date" style=" margin: 0 10%;">
                            <div style="float: left;">
                                <p style="font-size: 0.9rem;color: midnightblue;margin:0;">PASSPORT NO.</p>
                                <h2 style="font-size: 20px;margin:0;"><?php echo $leave_info->passport_no;?></h2>
                            </div>
                            <div style="float: right;">
                                <p style="font-size: 0.9rem;color: midnightblue;margin:0;">DATE</p>
                                <h2 style="font-size: 20px;margin:0;margin-bottom: 10px;"><?php echo date_format(new DateTime($leave_info->start_date),'d M, Y');?></h2>
                            </div>
                        </div>
                        <div class="ruler"  style="margin: 1rem 0; height: 1px; background: #20a3f6;clear: both;"></div>
                        <div class="ticket-from-and-to justify-content-center" style="align-items: center;">
                            <div class="clearfix" style="
                                        width: 100%;
                                        text-align: center;
                                        margin-left: auto;margin-right: auto;">
                                <div class="flex-shrink-0" style="    margin-top: 23px;">
                                    <span class="avatar" style="margin-left: auto;margin-right: auto;">
                                        <img src="<?php 
                                        // assets/images/sys-logo-white.png
                                        $file_info = @unserialize($leave_info->applicant_avatar);
                                        $file_name = get_array_value($file_info, 'file_name');

                                        if($file_name){
                                            $p = get_uri('files/profile_images/'.$file_name);
                                        }else{                                            
                                            $p = get_uri('assets/images/avatar.jpg');
                                        }

                                        $type = pathinfo($p, PATHINFO_EXTENSION);
                                        $d = file_get_contents($p);
                                        $logo_image = 'data:image/' . $type . ';base64,' . base64_encode($d);
                                        
                                        echo $logo_image; ?>" alt="..." style="border-radius: 50%;width: 130px;" />
                                    </span>
                                </div>
                                <div class="" style="margin-top: 7px;">
                                    <div class="m0">
                                        <?php echo $leave_info->applicant_name; ?>
                                    </div>
                                    <p style="margin: 0;"><span class='badge bg-primary' style="border-radius: 20px;display: inline-block;
                                    padding: 4px 7px;font-weight: normal;font-size: 85%;margin-top: 5px;background-color: #6690F4 !important;color: #fff;">
                                    <?php echo $leave_info->job_title; ?></span> </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="ruler" style="margin: 1rem 0; height: 1px; background: #20a3f6;"></div>
                        <div class="bording" style=" margin-top: 10px;margin-left: auto;margin-right: auto;">
                            <div class="bording-content" style="padding: 20px 35px;border: 2px dashed #20a3f6;text-align: center;">
                                <p style="margin:0;margin-bottom: 5px;">LEAVE DATE #</p>
                                <h4 style="font-size: 14px;margin:0"><?php echo date_format(new DateTime($leave_info->start_date),'F d, Y').' - '.date_format(new DateTime($leave_info->end_date),'F d, Y');?></h4>
                            </div>
                        </div>
                        <div class="qrcode" style="  margin-top: 20px;
                                display: felx;
                                justify-content: center;
                                align-items: center;
                                text-align: center;">
                        <?php
                                    
                            $options = new chillerlan\QRCode\QROptions([
                                'eccLevel' => chillerlan\QRCode\Common\EccLevel::L,
                                'outputBase64' => true,
                                'cachefile' => ROOTPATH . 'files/system/qrcode.png',
                                'outputType'=>chillerlan\QRCode\Output\QROutputInterface::GDIMAGE_PNG,
                                'logoSpaceHeight' => 17,
                                'logoSpaceWidth' => 17,
                                'scale' => 20,
                                'version' => chillerlan\QRCode\Common\Version::AUTO,

                            ]);

                            (new chillerlan\QRCode\QRCode($options))->render(get_uri('visitors_info/show_leave_qrcode/'.$leave_info->uuid));

                            $p = get_uri('files/system/qrcode.png');
                            $type = pathinfo($p, PATHINFO_EXTENSION);
                            $d = file_get_contents($p);
                            $logo_image = 'data:image/' . $type . ';base64,' . base64_encode($d);

                            echo "<img style='border-radius: 7px;border: 1px solid #1f8bf2;' width='150' src=".$logo_image." alt='Scan to see' />";?>
                    
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

        </div>
    </div>


