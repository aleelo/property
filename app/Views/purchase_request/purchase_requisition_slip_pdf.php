<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Ogolaanshaha soo gelista</title>
        <?php

use chillerlan\QRCode\QRCode;

    $domain = $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];
    $domain = preg_replace('/index.php.*/', '', $domain);
    $domain = strtolower($domain);
    if(str_contains($domain,'localhost')) {
        $prefix = '/rise/';
        $domain = 'http://' . $domain;
    }else{
        $prefix = '';
        $domain = 'https://' . $domain;
    }

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
        
    }
    
    echo "</style>";
        ?>

        <style>
            @media print {
                #form-container{
                    width: 95% !important;
                }
            }
        </style>
    </head>
    <body style="background: #fff !important; padding: 0; margin: 0;">

        <div class=" d-flex justify-content-center">
            <div class="" id="form-container" style="margin-left: auto;margin-right: auto; border: 1px solid #aaa; margin-top: 20px;width: 750px; 
            padding: 15px;border-radius: 5px;overflow: auto;">
                <div class="" style="text-align: center">
                        <?php 

                            $path = $domain.'assets/images/sys-logo.png';
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $data = file_get_contents($path);
                            $header = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            
                            ?>
                        <img src="<?php echo $header?>"  style="height: 80px;">
                </div>
                <div class="card-title text-center border-bottom mt-3 fw-semibold">
                    <h3 style="margin: 0;font-weight: bold;font-size: 16px" class="">ITEMS REQUISITION SLIP </h3>
                    <h4 style="margin: 0;font-size: 12px" >OUTGOING ITEMS FROM STORE</h4>
                    <span style="font-size: 12px;">(Alaabta ka baxaysa bakhaarka)</span>
                </div>
                
                <div class="" style="display: flex;border: 1px solid #999;padding: 0px;margin-top: 20px; margin-left: auto; margin-right: auto;">
                    <div class="" style="width: 100%;border-right: 1px solid #999;">                               
                        <div class="col-6" style="padding: 5px;">
                            <h4 style="font-weight: bold;font-size: 14px;margin:0;">Requested by: <span style="font-weight: 500;"><?php echo $purchase_info->user;?></span></h4>
                            <span class="">(Codsaday)</span>
                        </div>
                          
                        <div class="col-6" style="padding: 5px;">
                            <h4 style="font-weight: bold;font-size: 14px;margin:0;">Charge to: _____________________________</h4>
                            <span class="">(Ku xisaabi)</span>
                        </div>

                    </div>
                    <div class="" style="width: 60%;">     
                        <div class="col-6" style="padding: 5px;">
                        <h4 style="font-weight: bold;font-size: 14px;margin:0;">Request NO: <span style="font-weight: 500;"><?php echo get_PR_ID($purchase_info->id);?></span></h4>
                        <span class="">Tirsiga Dalabka</span>
                        </div>
                        <div class="col-6" style="padding: 5px;">
                            <h4 style="font-weight: bold;font-size: 14px;margin:0;">Date: <?php echo date('d/m/Y');?></h4>
                            <span class="">Taariikh</span>
                        </div>
                    </div>
                    
                </div>

                <h4 style="font-size: 16px;font-weight: bold;text-align: center;margin-bottom: 0px;margin-top: 20px;">Office of the procurement and Logistics Department of Admin & Finance</h4>
                <div class="body" style="padding: 5px;">

                    <div class="table-responsive">
                
                        <div class="table-responsive mb15">
                            
                        <table style="width: 100%;" border="1" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 20px;padding-bottom: 4px;padding-top: 4px;padding-right: 10px;padding-left: 10px;border: 0;border-bottom: 1px solid #777;border-right: 1px solid #777;">No</th>
                                    <th style="padding-bottom: 4px;padding-top: 4px;padding-right: 10px;padding-left: 10px;border: 0;border-bottom: 1px solid #777;border-right: 1px solid #777;">Item Name</th>
                                    <th style="padding-bottom: 4px;padding-top: 4px;padding-right: 10px;padding-left: 10px;border: 0;border-bottom: 1px solid #777;border-right: 1px solid #777;">Quantity</th>
                                    <th style="padding-bottom: 4px;padding-top: 4px;padding-right: 10px;padding-left: 10px;border: 0;border-bottom: 1px solid #777;border-right: 1px solid #777;">Description</th>
                                </tr>
                            </thead>         
                            <tbody>
                                <?php foreach ($items_info as $k => $item) { ?>

                                    <tr>
                                        <td style="width: 20px;padding-bottom: 4px;padding-top: 4px;padding-right: 10px;padding-left: 10px;border: 0;border-bottom: 1px solid #777;border-right: 1px solid #777;"><?php echo $k + 1?></td>
                                        <td style="padding-bottom: 4px;padding-top: 4px;padding-right: 10px;padding-left: 10px;border: 0;border-bottom: 1px solid #777;border-right: 1px solid #777;"><?php echo $item->name?></td>
                                        <td style="text-align: center;padding-bottom: 4px;padding-top: 4px;padding-right: 10px;padding-left: 10px;border: 0;border-bottom: 1px solid #777;border-right: 1px solid #777;"><?php echo $item->quantity?></td>
                                        <td style="padding-bottom: 4px;padding-top: 4px;padding-right: 10px;padding-left: 10px;border: 0;border-bottom: 1px solid #777;border-right: 1px solid #777;"><?php echo $item->description?></td>
                                    </tr>

                                <?php } ?>

                            </tbody>   
                        </table>

                        </div>

                    </div>

                    <div class="orderedby" style="margin-top: 25px;width: 55%;margin-right: auto;margin-left: auto;;margin-bottom: 25px">
                        <h4 style="text-align: center;font-weight: bold;margin-bottom: 0;margin-top: 20px">Received By</h4>
                        <p style="margin: 0;text-align: center;">(Gudoomay)</p>

                            <p><span style="width: 65px;font-weight: bold;display: inline-block">Name</span>: ___________________________________</p>
                            <p><span style="width: 65px;font-weight: bold;display: inline-block">Title</span>: ___________________________________</p>
                            <p><span style="width: 65px;font-weight: bold;display: inline-block">Signature</span>: ___________________________________</p>
                    </div>
                    <h4 style="text-align: center;margin-bottom: 0">For Office User Only</h4>

                    <hr style="border: 1px dashed #696969;margin-top: 30px;">

                    <div class="text-center mb-4" style="display: inline-block; width: 100%;" >
                        <div class="" style="">

                        <p style="font-size: 14px;color: #1f2c35;text-align: left; float: left;margin-top: 25px;">
                            <b>Approved By:</b>__________________________________ 
                        </p>

                        </div>
                        <div class="" style="">

                            <img src="<?php echo (new QRCode)->render(get_uri('purchase_request/get_purchase_requisition_slip_pdf/'.$purchase_info->id));?>" alt="Show Request Info"  style="float: right;width:100px;">                         
                        </div>
                    </div>
                        
                </div>
            </div>
        </div>      

        <?php echo view("includes/footer"); ?>
    </body>
</html>