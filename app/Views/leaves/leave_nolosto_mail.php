
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


        @media screen and (max-width: 414px) {
            
            
        #search-container1 .container {
            background-color: #c8eaff;
            width: 100%;
            margin: auto;
            border-top-left-radius:  7px;
            border-top-right-radius:  7px;
            padding: 0px;
            color: midnightblue;
            height: 100%;
        }
        h2{
            font-size: 20px;
        }
        #search-container1 .ticket-header {
            background-color: #3cb4ff;
            color: white;
            border-top-left-radius:  7px;
            border-top-right-radius:  7px;
            text-align: center;
            padding: 15px 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ticket-header h2{
            font-size: 20px;
        }

        #logo {
            /* width: 45px; */
            /* border: 2px solid white; */
            /* border-radius: 100%; */
        }

        .ticket-body {
            padding: 30px 15px;
        }

        #search-container1 .ticket-name p {
            font-size: 0.9rem;
            color: midnightblue;
            font-weight: 300;
        }

        #search-container1 .ruler {
            margin: 1rem 0;
            height: 1px;
            background: #20a3f6;
        }

        .ticket-number-date {
            display: flex;
            justify-content: space-between;
            margin: 0 5%;
        }

        .ticket-from-and-to {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* margin: 0 15%; */
            /* border-bottom: 2.5px dashed #20a3f6; */
            /* padding-bottom: 20px; */
        }

        .plane-body {
            display: flex;
            align-items: center;
            justify-content:center;
            width: 250px;
        }

        .plane {
            width: 50px;
            margin-top: 15px;
            /* display: flex; */
        }

        .ter-gat-set {
            margin-top: 10px;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .bording {
            margin-top: 10px;
            display: flex;
            justify-content: center;
        }

        #search-container1 .bording-content {
            border: 2px dashed #20a3f6;
            padding: 10px 73px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .qrcode {
            margin-top: 20px;
            display: felx;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .code {
            height:200px;
            width: 200px;
        }

        #search-container1 {
                width: 100%;
            }

        }
        .badge{
            display: inline-block;
            padding: 4px 5px;
            font-weight: normal;
            font-size: 85%;
            margin-top: 5px;
        } 
        .bg-primary{
            background-color: #6690F4 !important;
            color: #fff;
        } 
        
    </style>

    <div class=" search-container" style="margin-left:auto;margin-right: auto;width: 440px;" id="search-container1" >

        <div class="shadow d-flex justify-content-center col-xs-12 mt-3 mb-3 " id="search-card1">
            <?php if(!empty($leave_info)){ ?>
            <div class="" >                   
                <div class="container" style=" background-color: #c8eaff;
            width: 440px;
            border-top-left-radius:  7px;
            border-top-right-radius:  7px;
            padding: 0px;
            color: #4f4f74;">
                    <div class="ticket-header" style="padding: 0px !important;background-color: #6bc6ff !important;background-color: #3cb4ff;
            color: white;
            border-top-left-radius:  7px;
            border-top-right-radius:  7px;
            text-align: center;
            padding: 15px 5px;
            display: flex;
            align-items: center;
            justify-content: center;height: 25px;">
                        <!-- <img id="logo" src="<?php //echo base_url().'assets/images/sys-logo-white.png';?>" style="width: 400px;"> -->
                        &nbsp;&nbsp;
                    </div>
                    <div class="ticket-body" style=" padding: 20px 15px;">
                        <h2 class="text-center mb-3" style="margin-bottom: 15px;color: #264a78;text-align:center"><?php echo strtoupper($leave_info->leave_type) ?></h2>
                        <div class="ticket-name">
                            <p style=" font-size: 0.9rem;
                                color: midnightblue;font-weight: 300;">Howlwadeen:</p>
                            <h2 style="font-size: 20px;"><?php echo $leave_info->applicant_name;?></h2>
                        </div>
                        <div class="ruler"  style="margin: 1rem 0; height: 1px; background: #20a3f6;"></div>
                        <div class="ticket-number-date" style=" display: flex;justify-content: space-between;margin: 0 10%;">
                            <div>
                                <p style="font-size: 0.9rem;color: midnightblue;margin:0;">PASSPORT NO.</p>
                                <h2 style="font-size: 20px;margin:0;"><?php echo $leave_info->passport_no;?></h2>
                            </div>
                            <div>
                                <p style="font-size: 0.9rem;color: midnightblue;margin:0;">DATE</p>
                                <h2 style="font-size: 20px;margin:0;"><?php echo date_format(new DateTime($leave_info->start_date),'d M, Y');?></h2>
                            </div>
                        </div>
                        <div class="ruler"  style="margin: 1rem 0; height: 1px; background: #20a3f6;"></div>
                        <div class="ticket-from-and-to justify-content-center" style=" display: flex; justify-content: space-between;align-items: center;">
                            <div class="clearfix" style="display: flex;
                                        width: 100%;
                                        align-items: center;
                                        text-align: center;
                                        gap: 10px;
                                        flex-direction: column;">
                                <div class="flex-shrink-0">
                                    <span class="avatar" style="width: 100px;height: 130px;display: flex;justify-content: center;">
                                        <img src="<?php echo get_avatar($leave_info->applicant_avatar); ?>" alt="..." style="border-radius: 50%;" />
                                    </span>
                                </div>
                                <div class="ps-2 pt5">
                                    <div class="m0">
                                        <?php echo $leave_info->applicant_name; ?>
                                    </div>
                                    <p style="margin: 0;"><span class='badge bg-primary' style="border-radius: 20px;display: inline-block;
                                    padding: 4px 5px;font-weight: normal;font-size: 85%;margin-top: 5px;background-color: #6690F4 !important;color: #fff;">
                                    <?php echo $leave_info->job_title; ?></span> </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="ruler" style="margin: 1rem 0; height: 1px; background: #20a3f6;"></div>
                        <div class="bording" style=" margin-top: 10px;display: flex;justify-content: center;">
                            <div class="bording-content" style="padding: 20px 35px;border: 2px dashed #20a3f6; display: flex;justify-content: center;align-items: center;flex-direction: column;">
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

                            echo "<img style='border-radius: 7px;border: 1px solid #1f8bf2;' width='150' src=".get_uri('files/system/qrcode.png')." alt='Scan to see' />";?>
                    
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


