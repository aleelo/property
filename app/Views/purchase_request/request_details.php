<div class="modal-body">
    <div class="row">
     
          <!--   // id	uuid	supplier	fuel_type	barrels	litters	receive_date	received_by	department_id	vehicle_model	plate	remarks	created_at	deleted	-->

          <?php 
          
        
          if (strtolower($model_info->status) === "pending") {
                $status_class = "bg-warning";
            } else if (strtolower($model_info->status) === "approved") {
                $status_class = "bg-success";//btn-success
            }else if (strtolower($model_info->status) === "delivered") {
                $status_class = "btn-success";//btn-success
            } else if (strtolower($model_info->status) === "submitted") {
                $status_class = "bg-success";//btn-success
            }  else if (strtolower($model_info->status) === "cancelled") {
                $status_class = "bg-danger";//btn-success
            
            } else if (strtolower($model_info->status) === "rejected") {
                $status_class = "bg-danger";
            } else {
                $status_class = "bg-secondary";
            }
            $status_meta = "<span class='badge $status_class'>" . app_lang($model_info->status) . "</span>";
    
          ?>

        <div class="table-responsive mb15">
            <table class="table dataTable display b-t">
                <tr>
                    <td class="w150"> <?php echo app_lang('pr_no'); ?></td>
                    <td><?php echo 'PR'.str_pad($model_info->id,4,'0',STR_PAD_LEFT); ?></td>
                </tr>
                <tr>
                    <td class="w150"> <?php echo app_lang('purchase_type'); ?></td>
                    <td><?php echo $model_info->product_type; ?></td>
                </tr>
                <tr>
                    <td> <?php echo app_lang('supplier'); ?></td>
                    <td><?php echo $model_info->supplier; ?></td>
                </tr>
                                        
                <tr>
                    <td> <?php echo app_lang('request_date'); ?></td>
                    <td><?php echo date_format(new DateTime($model_info->request_date),'F d, Y'); ?></td>
                </tr>
               
                <tr>
                    <td> <?php echo app_lang('requested_by'); ?></td>
                    <td><?php
                        $image_url = get_avatar($model_info->avatar);
                        echo "<span class='avatar avatar-xs mr10'><img src='$image_url' alt=''></span><span>" . $model_info->user . "</span>";
                        ?>
                    </td>
                </tr>
                <?php if($model_info->delivery_date){?>
                    
                    <tr>
                        <td> <?php echo app_lang('delivered_by'); ?></td>
                        <td><?php
                            echo $model_info->delivered_by ;
                            ?>
                        </td>
                    </tr>
               
                    <tr>
                        <td> <?php echo app_lang('delivery_date'); ?></td>
                        <td><?php echo date_format(new DateTime($model_info->delivery_date),'F d, Y'); ?></td>
                    </tr>
                
                    <tr>
                        <td> <?php echo app_lang('delivery_note'); ?></td>
                        <td><?php
                            echo $model_info->delivery_note ;
                            ?>
                        </td>
                    </tr>
                <?php }?>
                <tr>
                    <td> <?php echo app_lang('depertment'); ?></td>
                    <td><?php echo $model_info->department; ?></td>
                </tr>
                <tr>
                    <td> <?php echo app_lang('status'); ?></td>
                    <td><?php echo $status_meta; ?></td>
                </tr>
                <tr>
                    <td> <?php echo app_lang('remarks'); ?></td>
                    <td><?php echo $model_info->remarks; ?></td>
                </tr>
            </table>
        </div>

        
    <?php if(!empty($model_info?->id)){?>
    <div class="container-fluid">
        <div class="form-group mb0">
            <h4 class="fw-bold mb-1 mt-4 mb0">Purchase Request Details:</h4>
            <hr class="mt-1 mb0">
            <!-- <button type="button" class="btn btn-success float-end mb-2" id="add_item_btn"><i data-feather="plus-circle" class='icon'></i> Add Items</button> -->

        </div>

        <div class="form-group p-3" style="clear: both;">
            <div class="row">
                <table class="table" id="add_items_table" style="color: #56749b;">
                      
                <?php 
                    $total = 0;
                ?>
                    <thead style="color: #547fb7;">
                        <tr>
                            <th>ID</th>
                            <th>Item Name</th>
                            <th>Description</th>
                            <!-- <th>Unit Type</th> -->
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($request_details as $index => $order) {?>
                            <tr>
                                <td><?php echo $index+1;?></td>
                                <td><?php echo $order->name;?></td>
                                <td><?php echo $order->description;?></td>
                                <!-- <td><?php //echo $order->unit_type;?></td> -->
                                <td><?php echo $order->quantity;?></td>
                            </tr>
                        <?php } ?>
                      
                    </tbody>
                </table>       
            </div>
        </div>
    </div>
    <?php }?>
    </div>
</div>
<?php echo form_open(get_uri("purchase_request/update_status"), array("id" => "leave-status-form", "class" => "general-form", "role" => "form")); ?>
<input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
<input id="leave_status_input" type="hidden" name="status" value="" />
<div class="modal-footer">
       
    <?php if(!empty($model_info?->id)){?>
        <a href="<?php echo get_uri('purchase_request/view/'.$model_info->id)?>" class="btn btn-outline text-primary"><span data-feather="edit" class="icon-16"></span> Edit Purchase Request</a>
    <?php }?>

    <button type="button" class="btn btn-default btn-sm" data-bs-dismiss="modal"><span data-feather="x" class="icon-16"></span> <?php echo app_lang('close'); ?></button>
  
    <?php if (1) { ?>
        <!-- <button data-status="rejected" type="submit" class="btn btn-danger btn-sm update-leave-status"><span data-feather="x-circle" class="icon-16"></span> <?php echo app_lang('reject'); ?></button>
        <button data-status="approved" type="submit" class="btn btn-success btn-sm update-leave-status"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('approve'); ?></button> -->
    <?php } ?>

    <!-- <?php //if (strtolower($model_info->status) === "approved" && $model_info->leave_type_id !== 3 && $model_info->nolo_status == 1 && $login_user->id === $model_info->applicant_id) { ?>
        <a target="_blank" href="<?php //echo get_uri('visitors_info/show_leave_qrcode_return/'.$model_info->uuid);?>" class="btn btn-success btn-sm update-leave-status"><span data-feather="file-text" class="icon-16"></span> <?php echo 'Passport Return'; ?></a>
    <?php // } else if ((strtolower($model_info->status) !== "cancelled" && strtolower($model_info->status) !== "approved" ) && $model_info->leave_type_id !== 3 && $login_user->id === $model_info->applicant_id ) {  ?>
        <a target="_blank" href="<?php //echo get_uri('visitors_info/show_leave_qrcode/'.$model_info->uuid);?>" class="btn btn-success btn-sm update-leave-status"><span data-feather="user" class="icon-16"></span> <?php echo 'Nolo Osto'; ?></a>
        <?php //} ?> -->
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function () {
        
        $('.modal-dialog').removeClass('modal-xl').addClass('modal-lg');

        $(".update-leave-status").click(function () {
            $("#leave_status_input").val($(this).attr("data-status"));
        });

        $("#leave-status-form").appForm({
            onSuccess: function () {
                location.reload();
            }
        });

    });
</script>    