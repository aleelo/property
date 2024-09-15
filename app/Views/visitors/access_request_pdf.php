<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Ogolaanshaha soo gelista</title>
        <?php 
        
    $domain = $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];
    $domain = preg_replace('/index.php.*/', '', $domain);
    $domain = strtolower($domain);
    if(str_contains($domain,'localhost')) {
        $prefix = '/evilla/';
        $domain = 'http://' . $domain;
    }else{
        $prefix = '';
        $domain = 'https://' . $domain;
    }
    // die($domain);

    // die($domain);
    $css_files = array(
        // "/rise/assets/bootstrap/css/bootstrap.min.css",
        "assets/js/select2/select2.css", //don't combine this css because of the images path
        "assets/js/select2/select2-bootstrap.min.css",
        "assets/css/app.all.css",
    );

    array_push($css_files, "assets/css/custom-style.css"); //add to last. custom style should not be merged


    echo "<style type='text/css'>";
    foreach ($css_files as $uri) {
        echo file_get_contents($domain . $uri);
        // echo "<link rel='stylesheet' type='text/css' href='" . base_url($uri) . "?v=3' />";
    }
    // echo file_get_contents("http://localhost/rise/assets/bootstrap/css/bootstrap.min.css");
    echo "</style>";
        ?>
        <style>
                
                #search-container1 {
                   width: 480px;
               }
       
               /* @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
       
               * {
                   margin: 0;
                   box-sizing: border-box;
                   font-family: 'Poppins', sans-serif;
               } */
           
        </style>
    </head>
    <body style="background: #fff !important;">
        
        
    <style>    
           
               
           </style>
       
           <div class=" search-container" style="margin-left:auto;margin-right: auto;width: 100%;font-family: 'system-ui';" id="search-container1" >
       
               <div class="shadow d-flex justify-content-center col-xs-12 mt-3 mb-3 " id="search-card1" style="display: flex;justify-content: center;">
                                
                    <div class="container" style=" background-color: #e7f6ff;
                            width: 480px; border-top-left-radius:  7px;border-top-right-radius:  7px;
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
                                ?>" style="width: 400px;margin-top: 25px;padding:0;margin-bottom: 0;">
                            &nbsp;&nbsp;
                        </div>
                        <div class="ticket-body" style=" padding: 20px 15px;">
                            <h2 class="text-center " style="margin-bottom: 15px;color: #264a78;text-align:center;margin-top: 0;"><?php echo 'CODSI SOO DEYN' ?></h2>
                            <div class="ticket-name">
                                <p style=" font-size: 0.9rem;
                                    color: #12123f;font-weight: 300;margin:0;">Waaxda/Xafiiska:</p>
                                <h2 style="font-size: 20px;margin:0;"><?php echo $visitor_info->department;?></h2>
                            </div>
                            <div class="ruler"  style="margin: 1rem 0; height: 1px; background: #20a3f6;"></div>
                            <div class="ticket-number-date" style=" margin: 0 10%;">
                                <div style="float: left;">
                                    <p style="font-size: 0.9rem;color: #12123f;margin:0;">CODSI LAMBER:</p>
                                    <h2 style="font-size: 20px;margin:0;" class="text-info"><?php echo '#' .$visitor_info->id;?></h2>
                                </div>
                                <div style="float: right;">
                                    <p style="font-size: 0.9rem;color: #12123f;margin:0;">TAARIIKH:</p>
                                    <h2 style="font-size: 20px;margin:0;margin-bottom: 0px;">
                                    <?php echo date_format(new DateTime($visitor_info->created_at),'Y-m-d');?>
                                        <small style="font-size: 12px;font-weight: bold"><?php echo date("h:i a",strtotime(date_format(new DateTime($visitor_info->start_date),'Y-m-d').' '.$visitor_info->visit_time)); ?></small>
                                </h2>
                                </div>
                            </div>
                            <div class="ruler"  style="margin: 1rem 0; height: 1px; background: #20a3f6;clear: both;"></div>
                            <div class="ticket-from-and-to justify-content-center" style="align-items: center;">
                               <div class="">
                                <div style="width: 350px;">
                                    <h3 style="padding: 3px;margin: 0px;text-align:center;font-weight: bold;color: #12123f;">LIISKA MARTIDA</h3>
                                </div>
                               <table class="table b-t" style="margin-top: 10px;text-align: left;width:100%;background: transparent;color: #12123f;">
                                   
                                    <tbody>
                                        <?php $i = 1;
                                        $vehicle_details = '';
                                        ?>

                                        <?php foreach ($visitor_details as $d){
                                            
                                            if($d->image){

                                                $file = @unserialize($d->image);
                                                $image = get_array_value($file,'file_name');
                                                // $image =$image;
                                                
                                                $path = $domain.'files/visitors/'.$image;
                                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                                $data = file_get_contents($path);
                                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                            }else{
                                                $image = '';
                                            }
                                            ?>
                                            <tr style="vertical-align: top;">
                                                <td style="width: 30px;"></td>
                                                <td><?php echo $i.'.'; ?>
                                                
                                                <?php if($image){?>
                                                    <img  width="50" src="<?php echo $base64;?>" class="rounded" style="margin-right: 10px;" />
                                                    <?php }?>
                                                <span  style="vertical-align: top;"><?php echo $d->visitor_name; ?></span></td>
                                                
                                            </tr>
                                        <?php
                                        if(!$vehicle_details){

                                            $vehicle_details = $d->vehicle_details;
                                        }
                                            $i++; 
                                        } ?>

                                    </tbody>
                                </table>
                               </div>
                            </div>
                            
                            <div class="ruler" style="margin: 1rem 0; height: 1px; background: #20a3f6;"></div>
                            <div class="bording" style=" margin-top: 10px;margin-left: auto;margin-right: auto;">
                                <h4 style="text-align: center;">Faah faahin</h4>
                                <div class="bording-content" style="padding: 20px 20px;border: 2px dashed #20a3f6;text-align: center;display:flex">
                                    <div class="col-sm-6" style="width: 49%;display: inline-block">
                                        <p style="margin:0;margin-bottom: 5px;font-weight: bold;">Mudada </p>
                                        <h4 style="font-size: 14px;margin:0;"><?php
                                        $days = $visitor_info->total_days == 1 ? '1 Maalin' : $visitor_info->total_days.' Maalmood';
                                         echo $days.', ku eg: '.date_format(new DateTime($visitor_info->end_date),'F d, Y');?></h4>
                                    </div>
                                    <div class="col-sm-6"  style="width: 49%;display: inline-block">
                                        <p style="margin:0;margin-bottom: 5px;font-weight: bold;">Albaabada (Gates)</p>
                                        <h4 style="font-size: 14px;margin:0"><?php echo $visitor_info->allowed_gates;?></h4>
                                    </div>
                                    <?php if($vehicle_details){?>
                                        <div class="col-sm-12" style="width: 100%;display: inline-block;margin-top: 20px;">
                                            <p style="margin:0;margin-bottom: 5px;font-weight: bold;">Xogta Gaadiidka</p>
                                            <h4 style="font-size: 14px;margin:0;"><?php echo $vehicle_details;?></h4>
                                        </div>
                                    <?php }?>
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
                                    // 'cachefile' => ROOTPATH . 'files/system/qrcode.png',
                                    'outputType'=>chillerlan\QRCode\Output\QROutputInterface::GDIMAGE_PNG,
                                    'logoSpaceHeight' => 17,
                                    'logoSpaceWidth' => 17,
                                    'scale' => 20,
                                    'version' => chillerlan\QRCode\Common\Version::AUTO,
    
                                ]);
    
                                (new chillerlan\QRCode\QRCode($options))->render(get_uri('visitors_info/show_visitor_qrcode/'.$visitor_info->uuid));
    
                                $p = get_uri('files/system/qrcode.png');
                                $type = pathinfo($p, PATHINFO_EXTENSION);
                                $d = file_get_contents($p);
                                $logo_image = 'data:image/' . $type . ';base64,' . base64_encode($d);
    
                                echo "<img style='border-radius: 7px;border: 1px solid #1f8bf2;' width='150' src=".$logo_image." alt='Scan to see' />";?>
                        
                                <!-- <svg class="code" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 448 448" enable-background="new 0 0 448 448" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path fill="#323232" d="M288,0v160h160V0H288z M416,128h-96V32h96V128z"></path> <rect x="64" y="64" fill="#323232" width="32" height="32"></rect> <rect x="352" y="64" fill="#323232" width="32" height="32"></rect> <polygon fill="#323232" points="256,64 224,64 224,32 256,32 256,0 192,0 192,96 224,96 224,128 256,128 "></polygon> <path fill="#323232" d="M160,160V0H0v160h32H160z M32,32h96v96H32V32z"></path> <polygon fill="#323232" points="0,192 0,256 32,256 32,224 64,224 64,192 "></polygon> <polygon fill="#323232" points="224,224 256,224 256,160 224,160 224,128 192,128 192,192 224,192 "></polygon> <rect x="352" y="192" fill="#323232" width="32" height="32"></rect> <rect x="416" y="192" fill="#323232" width="32" height="32"></rect> <polygon fill="#323232" points="320,256 320,288 352,288 352,320 384,320 384,256 352,256 352,224 320,224 320,192 288,192 288,224 256,224 256,256 "></polygon> <rect x="384" y="224" fill="#323232" width="32" height="32"></rect> <path fill="#323232" d="M0,288v160h160V288H0z M128,416H32v-96h96V416z"></path> <polygon fill="#323232" points="256,256 224,256 224,224 192,224 192,192 96,192 96,224 64,224 64,256 128,256 128,224 160,224 160,256 192,256 192,288 224,288 224,320 256,320 "></polygon> <rect x="288" y="288" fill="#323232" width="32" height="32"></rect> <rect x="416" y="256" fill="#323232" width="32" height="64"></rect> <rect x="320" y="320" fill="#323232" width="32" height="32"></rect> <rect x="384" y="320" fill="#323232" width="32" height="32"></rect> <rect x="64" y="352" fill="#323232" width="32" height="32"></rect> <polygon fill="#323232" points="320,384 320,352 288,352 288,320 256,320 256,352 224,352 224,320 192,320 192,384 224,384 224,416 256,416 256,384 "></polygon> <polygon fill="#323232" points="352,384 320,384 320,416 352,416 352,448 384,448 384,352 352,352 "></polygon> <rect x="416" y="352" fill="#323232" width="32" height="32"></rect> <rect x="192" y="416" fill="#323232" width="32" height="32"></rect> <rect x="256" y="416" fill="#323232" width="64" height="32"></rect> <rect x="416" y="416" fill="#323232" width="32" height="32"></rect> </g> </g></svg> -->
                            </div>
                            <div class="d-flex justify-content-end mt-3 hprint">
                                <!-- <a class="btn btn-warning text-white mr10 hprint" href="<?php //echo get_uri('visitors_info/show_leave_qrcode_return/'.$visitor_info->uuid);?>">
                            <i data-feather='file' class='icon-16 '></i> Passport Celin</a> -->
                            </div>
                        </div>
                    </div>
                           
               </div>
           </div>
              

<?php echo view("includes/footer"); ?>
    </body>
</html>