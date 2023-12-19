<div class=" d-flex justify-content-center">
    <div class="card col-md-5 col-xs-12 mt-3">
        <div class="card-title text-center"><h4 class="fw-bold">Access Request Information #<?php echo $visitor_info->id; ?></h4></div>
            
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
                            <td>
                                <?php 
                                if($visitor_info->access_duration == 'hours'){
                                    $hours = (int)$visitor_info->total_hours;
                                    echo $visitor_info->access_type.' ('.$hours.' hours)'; 
                                }else{
                                    
                                    echo $visitor_info->access_type.' ('.$visitor_info->total_days.' days)'; 
                                }
                                ?>
                            </td>
                        </tr>
                        <?php if($visitor_info->access_duration == 'multiple_days'){ ?>
                        <tr>
                            <td> <?php echo app_lang('start_date'); ?></td>
                            <td><?php echo $visitor_info->start_date; ?></td>
                        </tr>
                        <tr>
                            <td> <?php echo app_lang('end_date'); ?></td>
                            <td><?php echo $visitor_info->end_date; ?></td>
                        </tr>
                        <?php }else{?>
                            <tr>
                                <td> <?php echo app_lang('date'); ?></td>
                                <td><?php echo date("F d, Y",strtotime(date_format(new DateTime($visitor_info->start_date),'Y-m-d'))); ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td> <?php echo app_lang('visit_time'); ?></td>
                            <td><?php echo date("l, h:i a",strtotime(date_format(new DateTime($visitor_info->start_date),'Y-m-d').' '.$visitor_info->visit_time)); ?></td>
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
                    <h3 class="text-info m-3 mb-1 text-center mb-4">Access Information</h3>
                    <div class="d-flex flex-column justify-content-center mt-3 font-arial m-3">
                        <div class=" col-8 mx-auto" style="font-family: system-ui;font-size: 16px;">
                                
                            <div class="d-flex justify-content-between mb-4">
                                <span class=""><b>Tix:</b> <?php echo 'text'?></span>
                                <span class=""><b>Date:</b> <?php echo date_format(new DateTime($visitor_info->created_at),'Y-m-d');?></span>
                            </div>

                            <p>
                            <b>Ku:</b> Heeganka Sare ee Madaxtooyada JFS.<br>
                            <b>Og:</b> Agaasimaha Teknoolajiyadda & Amniga ee Madaxtooyada JFS.
                            </p>

                            <p>
                            <b>UJEEDO: SOO DEYN MARTI GAAR AH - <?php echo $visitor_info->document_title; ?></b>
                            </p>

                            <p>
                            Waxaan si xushmad & qadarin mudan kaga codsanaynaa Heeganka Sare ee <br>
                            Madaxtooyada JFS inaad noosoo fududeysaan marti shir ku leh Xafiiska Amniga<br>
                            Qaranka JFS, <b>( <?php echo date("l, h:i a",strtotime(date_format(new DateTime($visitor_info->start_date),'Y-m-d').' '.$visitor_info->visit_time)); ?> )</b>, martidas oo u bahan so deyn irdaha laga galo<br>
                            Madaxtooyada J.F.S. (Ceelgaabta, Kashmir, Radio Muqdisho & Gate 1).<br>
                            </p>
                            
                        </div>
                    </div>
                    <table class="table dataTable display b-t">
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

                            <?php foreach ($visitor_details as $d){?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><img width="50" src="<?php echo get_visitor_avatar($d->image);?>" class="rounded" style="margin-right: 10px;" /><span><?php echo $d->visitor_name; ?></span></td>
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
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {

       $('#js-init-chat-icon').hide();

    });
    
</script>    