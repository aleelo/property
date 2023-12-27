<!DOCTYPE html>
<html lang="en">
    <head>
        <?php 
        
        
    $css_files = array(
        // "/rise/assets/bootstrap/css/bootstrap.min.css",
        "/rise/assets/js/select2/select2.css", //don't combine this css because of the images path
        "/rise/assets/js/select2/select2-bootstrap.min.css",
        "/rise/assets/css/app.all.css",
    );

    array_push($css_files, "/rise/assets/css/custom-style.css"); //add to last. custom style should not be merged


    echo "<style type='text/css'>";
    foreach ($css_files as $uri) {
        echo file_get_contents("http://localhost" . $uri);
        // echo "<link rel='stylesheet' type='text/css' href='" . base_url($uri) . "?v=3' />";
    }
    // echo file_get_contents("http://localhost/rise/assets/bootstrap/css/bootstrap.min.css");
    echo "</style>";
        ?>
    </head>
    <body style="background: #fff !important;">

    <div class=" d-flex justify-content-center">
        <div class="card col-md-5 col-xs-12 mt-3 shadow-lg">
            <div class="card-title text-center border-bottom"><h4 class="fw-bold">Access Request Information #<?php echo $visitor_info->id; ?></h4></div>
                
            <div class="modal-body">
                <div class="row">
              
                    <div class="table-responsive mb15">
                        <div class="text-center mb-4">
                            <?php echo $qrcode;?>
                            <div style="margin-top: -15px; margin-bottom: 20px;">
                                <span class="text-info" style="font-size: 34px; font-weight: bold">#<?php echo $visitor_info->id; ?></span>
                            </div>
                        </div>
                        <div class="d-flex flex-column justify-content-center mt-3 font-arial mb-3">     
                                <div class="d-flex justify-content-between mb-4" style="display:flex;justify-content: space-between;text-align: center;margin-left: 70px;">
                                    <span style="margin-right: 100px;"><b>Date:</b> <?php echo date_format(new DateTime($visitor_info->created_at),'Y-m-d');?></span>
                                    <span style=""><b>Time:</b> <?php echo date("l, h:i a",strtotime(date_format(new DateTime($visitor_info->start_date),'Y-m-d').' '.$visitor_info->visit_time)); ?></span>
                                </div>

                        </div>
                        <table class="table dataTable display b-t" style="margin-top: 20px;width:100%;">
                            <thead>
                                <tr>
                                    <th style="width:20px">ID</th>
                                    <th>Visitor Name</th>
                                    <th>Mobile</th>
                                    <th>Vehicle Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;?>

                                <?php foreach ($visitor_details as $d){
                                    
                                    if($d->image){

                                        $file = @unserialize($d->image);
                                        $image = get_array_value($file,'file_name');
                                        // $image =$image;
                                        $path = 'http://localhost/rise/files/visitors/'.$image;
                                        $type = pathinfo($path, PATHINFO_EXTENSION);
                                        $data = file_get_contents($path);
                                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                    }else{
                                        $image = 'avatar.jpg';
                                        
                                        $path = 'http://localhost/rise/files/visitors/'.$image;
                                        $type = pathinfo($path, PATHINFO_EXTENSION);
                                        $data = file_get_contents($path);
                                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                    }
                                    ?>
                                    <tr style="vertical-align: top;">
                                        <td><?php echo $i; ?></td>
                                        <td ><img  width="50" src="<?php echo $base64;?>" class="rounded" style="margin-right: 10px;" />
                                        <span  style="vertical-align: top;"><?php echo $d->visitor_name; ?></span></td>
                                        <td><?php echo $d->mobile;?></td>
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
        </div>
    </div>      

<?php echo view("includes/footer"); ?>
    </body>
</html>