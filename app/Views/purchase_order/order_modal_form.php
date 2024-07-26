<?php echo form_open(get_uri("purchase_order/save_order"), array("id" => "order-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <div class="container-fluid" style="width: 80%;padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
       
        <input type="hidden" id='order_id' name="id" value="<?php echo $model_info->id; ?>" />
        <input type="hidden" name="view" value="<?php echo isset($view) ? $view : ""; ?>" />
        
        <div class="form-group">
            <div class="row">
            <label for="request_id" class="col-3"> <?php echo app_lang('type'); ?></label>
                <div class="col-5">
                    <?php
                    echo form_radio(array(
                        "id" => "new_from_purchase_request",
                        "name" => "order_type",
                        "class" => "form-check-input order_type",
                        "placeholder" => app_lang('purchase_request'),
                        "data-rule-required" => true,
                        "data-msg-required" => app_lang("field_required"),
                    ),"new_from_purchase_request",$model_info?->id ? ($model_info->order_type == 'new_from_purchase_request' ? true : false): true);
                    ?>
                <label for="new_from_purchase_request" class=""> <?php echo app_lang('new_from_purchase_request'); ?></label>
                </div>
                
                <div class="col-4">
                    <?php
                    echo form_radio(array(
                        "id" => "new_purchase_order",
                        "name" => "order_type",
                        "class" => "form-check-input order_type",
                        "placeholder" => app_lang('purchase_request'),
                        "data-rule-required" => true,
                        "data-msg-required" => app_lang("field_required"),
                    ),"new_purchase_order",$model_info->order_type == 'new_purchase_order' ? true : false);
                    ?>
                <label for="new_purchase_order" class=""> <?php echo app_lang('new_purchase_order'); ?></label>
                </div>
            </div>
        </div>

        <?php if($model_info?->id && $model_info->order_type == 'new_from_purchase_request'){ ?>
            <div class="form-group" id="s2id_request_container">
                <div class="row">
                    <label for="request_id" class="col-3"><?php echo app_lang('purchase_request'); ?></label>
                    <div class="col-9">
                        <?php
                        echo form_dropdown(array(
                            "id" => "request_id",
                            "name" => "request_id",
                            "class" => "form-control select2",
                            "placeholder" => app_lang('purchase_request'),
                            "autofocus" => true,
                            "data-rule-required" => true,
                            "data-msg-required" => app_lang("field_required"),
                        ),$requests_dropdown,[$model_info?->request_id]);
                        ?>
                    </div>
                </div>
            </div>            
        <?php }elseif(!$model_info?->id){?>
            <div class="form-group" id="s2id_request_container">
                <div class="row">
                    <label for="request_id" class="col-3"><?php echo app_lang('purchase_request'); ?></label>
                    <div class="col-9">
                        <?php
                        echo form_dropdown(array(
                            "id" => "request_id",
                            "name" => "request_id",
                            "class" => "form-control select2",
                            "placeholder" => app_lang('purchase_request'),
                            "autofocus" => true,
                            "data-rule-required" => true,
                            "data-msg-required" => app_lang("field_required"),
                        ),$requests_dropdown,[$model_info?->request_id]);
                        ?>
                    </div>
                </div>
            </div>            
        <?php }?>

        <div class="form-group">
            <div class="row">
                <label for="product_type" class="col-3"><?php echo app_lang('purchase_type'); ?></label>
                <div class="col-9">
                    <?php
                    echo form_dropdown(array(
                        "id" => "product_type",
                        "name" => "product_type",
                        "class" => "form-control select2",
                        "placeholder" => app_lang('purchase_type'),
                        "autofocus" => true,
                        "data-rule-required" => true,
                        "data-msg-required" => app_lang("field_required"),
                    ),['Product'=>'Product','Service'=>'Service'],[$model_info->product_type]);
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="supplier_id" class="col-3"><?php echo app_lang('supplier'); ?></label>
                <div class="col-9">
                    <?php
                    echo form_dropdown(array(
                        "id" => "supplier_id",
                        "name" => "supplier_id",
                        "class" => "form-control select2",
                        "placeholder" => app_lang('supplier'),
                        "autofocus" => true,
                        "data-rule-required" => true,
                        "data-msg-required" => app_lang("field_required"),
                    ),$suppliers,[$model_info->supplier_id]);
                    ?>
                </div>
            </div>
        </div>
        <!-- fuel_type supplier receive_date barrels	litters	received_by	vehicle_model	plate	 -->

        <div class="form-group">
            <div class="row">
                <label for="order_date" class="col-3"><?php echo 'Order Date'; ?>
                </label>
                <div class="col-9">
                    <?php
                    echo form_input(array(
                        "id" => "order_date",
                        "name" => "order_date",
                        "value" => empty($model_info->order_date) ? date("Y-m-d") : $model_info->order_date,
                        "class" => "form-control date",
                        "placeholder" => app_lang('order_date')
                    ));
                    ?>
                </div>
            
            </div> 
        </div>

        <!-- <div class="form-group">
            <div class="row">
                <label for="quantity" class="col-3"><?php echo app_lang('quantity'); ?>
                </label>
                <div class="col-9">
                    <?php
                    // echo form_input(array(
                    //     "id" => "quantity",
                    //     "name" => "quantity",
                    //     "value" => $model_info->quantity,
                    //     "class" => "form-control",
                    //     "placeholder" => app_lang('quantity')
                    // ));
                    ?>
                </div>
            </div> 
        </div> -->
        
        <div class="form-group">
            <div class="row">
                <label for="remarks" class="col-3"><?php echo app_lang('remarks'); ?>
                </label>
                <div class="col-9">
                    <?php
                    echo form_textarea(array(
                        "id" => "remarks",
                        "name" => "remarks",
                        "rows" => "10",
                        "cols" => "10",
                        "class" => "form-control",
                        "placeholder" => app_lang('remarks')
                    ),$model_info->remarks);
                    ?>
                </div>
            </div> 
        </div>

    </div>
    
    <?php if(!empty($model_info?->id)){?>
    <div class="container-fluid">
        <div class="form-group mb0">
            <h4 class="fw-bold mb-1 mt-4 mb0">Purchase Order Details:</h4>
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
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_details as $index => $order) {?>
                            <?php                                     
                                $item_details = get_item_details($order->item_id, $order->purchase_order_id);

                                if($item_details->remainder == 0 || $item_details->remainder ==  '-'){
                                    $q = '';
                                }else{

                                    $q = "(".$item_details->remainder.")";
                                }

                                if($item_details->remainder == 0){
                                    $color = '#69d669';
                                }else if($item_details->remainder ==  '-'){

                                    $color = "#ed3d3d";
                                }else{
                                    $color = "#de8d40";
                                }

                                // $color = $item_details->remainder == 0 ? '#69d669' : '#de8d40';
                            ?>
                            <tr>
                                <td><?php echo $index+1;?></td>
                                <td><?php echo $order->name;?></td>
                                <td><?php echo $order->description;?></td>
                                <!-- <td><?php //echo $order->unit_type;?></td> -->
                                <td style="color: <?php echo $color ?>"><?php echo $q.$order->quantity;?></td>
                                <td style="color: <?php echo $color ?>"><?php echo $order->price;?></td>
                                <td style="color: <?php echo $color ?>"><?php echo '$'.number_format($order->total,2);?></td>
                                
                                <?php 
                                    $total += $order->total;
                                ?>
                            </tr>
                        <?php } ?>
                        <tr style="border-bottom: transparent;">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-weight: bold;"><?php echo '$'.number_format($total,2);?></td>
                        </tr>
                    </tbody>
                </table>       

                <div class="" style="">
                    <div class="row">
                        <h6><div class="d-inline-block mr5" style='background-color: #69d669;border-radius: 50%; height: 10px; width: 10px;'></div> Fully Received</h6>
                        <h6><div class="d-inline-block mr5" style='background-color: #de8d40;border-radius: 50%; height: 10px; width: 10px;'></div> Partially Received</h6>
                        <h6><div class="d-inline-block mr5" style='background-color: #ed3d3d;border-radius: 50%; height: 10px; width: 10px;'></div> Not Received</h6>
                        <h6><div class="d-inline-block mr5" style='color: #de8d40; '>(...)</div> Total remaining items to recevie</h6>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <?php }else{?>

    <div class="container-fluid" id="table-container">
        <div class="form-group mb0">
            <h4 class="fw-bold mb-1 mt-4 mb0">Purchase Request Details: <span  title="Check prices well, before submitting!" ><span data-feather="info" class="icon-16 text-info"></span></span></h4>
            <hr class="mt-1 mb0">
            <!-- <button type="button" class="btn btn-success float-end mb-2" id="add_item_btn"><i data-feather="plus-circle" class='icon'></i> Add Items</button> -->

        </div>

        <div class="form-group p-3" style="clear: both;">
            <div class="row">
                <table class="table" id="add_items_table_rq" style="color: #56749b;">
                    <?php 
                        $total = 0; 
                    ?>
                    <thead style="color: #547fb7;">
                        <tr>
                            <th style="text-align: center;width: 30px">ID</th>
                            <th style="width: 30%">Item Name</th>
                            <th style="width: 30%">Description</th>
                            <!-- <th>Unit Type</th> -->
                            <th style="width: 50px">Quantity</th>
                            <th style="width: 200px">Price</th>
                            <th style="width: 200px">Total</th>
                            <th style="">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                                              
                    </tbody>
                </table>       

                
            </div>
        </div>
    </div>
    <?php }?>


</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-bs-dismiss="modal"><span data-feather="x" class="icon-16"></span> <?php echo app_lang('close'); ?></button>
    
    <?php if(!empty($model_info?->id)){?>
        <a href="<?php echo get_uri('purchase_order/view/'.$model_info->id)?>" class="btn btn-outline text-primary"><span data-feather="edit" class="icon-16"></span> Edit Purchase Order</a>
    <?php }?>
    <button type="submit" class="btn btn-primary"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('save'); ?></button>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    var k = 1;
    

    function calculate_total(el){
    
        let quantity = $(el).val();
        let priceInput = $(el).parent().next().find('input');
        let price = priceInput.val();

        let totalInput = priceInput.parent().next().find('input');
        let total = parseFloat(price) * parseFloat(quantity);
        // console.log($(el));
        // console.log($(priceInput));
        // console.log($(total));
        totalInput.val(total.toFixed(2));
    }
            
    function getFooterTotal(total=0.0,el){

        let t = $(el).parent().prev().find('input').val();
        curTotal = localStorage.getItem('curTotal');
        total = curTotal - t;

        localStorage.setItem('curTotal',total);
        $('#add_items_table_rq tbody #footer_total').html( total.toLocaleString('en-US', {minimumFractionDigits:2, maximumFractionDigits:2, style: 'currency', currency: 'USD'}));

    }

    $(document).ready(function () {
        
        var isUpdate = "<?php echo $model_info?->id; ?>";

        if(isUpdate){

        }
        $('.modal-dialog').removeClass('modal-lg').addClass('modal-xl');


        // $('#table-container').hide();

        $('.order_type').on('change', function(){
            var order_type = $(this).val();

            if(order_type == 'new_from_purchase_request'){
                $('#s2id_request_id').show();
                $('#s2id_request_container').show();
                
                $('.modal-dialog').removeClass('modal-lg').addClass('modal-xl');
                
                $('#table-container').show();
                
                $('#add_items_table_rq tbody').html('');
            }else{
                $('#s2id_request_id').hide();
                $('#s2id_request_container').hide();
                
                $('.modal-dialog').removeClass('modal-xl').addClass('modal-lg');
                
                $('#table-container').hide();
            }

        });

        $('#request_id').on('change', function(){
            var order_type = $(this).val();

            getRequestItemsDetail();
          
            $('#table-container').show();

        });

        setDatePicker(".date");

        setTimePicker(".time");


        $("#order-form").appForm({
            onSuccess: function (result) {
                if (result.view === "details") {
                    appAlert.success(result.message, {duration: 10000});

                    setTimeout(function () {
                        var origin = "<?php echo base_url('purchase_order/view/') ?>" + result.id;
                       
                        window.location.assign(origin);

                    }, 500);
                } else {
                    appAlert.success(result.message, {duration: 10000});

                        setTimeout(function () {
                            window.location.reload();
                        }, 500);

                    $("#purchase-order-table").appTable({newData: result.data, dataId: result.id});
                    $("#reload-kanban-button:visible").trigger("click");
                }
            }
        });

        setTimeout(function () {
            $("#product_type").focus();
        }, 200);

        $('[data-bs-toggle="tooltip"]').tooltip();
        $(".select2").select2();
        setDatePicker("#order_date");
        // $('#owner_id').select2({data: <?php //echo json_encode($owners_dropdown); ?>});

        // $("#lead_labels").select2({multiple: true, data: <?php //echo json_encode($label_suggestions); ?>});     

        function getRequestItemsDetail(){
                
                $.ajax({
                    url: "<?php echo base_url().'purchase_request/request_items_json/' ?>"+ $('#request_id').val(),
                    cache: false,
                    type: 'GET',
                    success: function (data) {

                        $('#add_items_table_rq').show();
                        $('#add_items_table_rq tbody').html('');
                        data = JSON.parse(data);
                        // console.log(data);
                        var total = 0;

                        //remove button
                        var actions = "<button type='button' class='btn btn-danger btn-sm mt-2  round ml-2 p-1 ' onclick='$(this).parent().parent().remove();k--;getFooterTotal("+total+",this);'><i data-feather='minus-circle' class='icon'></i></button>";

                        if(data.length > 0 && data[0].id != null){
                            for(let i=0;i< data.length;i++){
                                var item_total = data[i].price * data[i].quantity;
                                $('#add_items_table_rq tbody').append(
                                    "<tr class='' style='vertical-align: middle;'>"+
                                    "<td>" + k + "</td>"+
                                        "<td><input type='hidden' class='form-control'  value='" + data[i].item_id + "'  id='item_id_" + k + "' placeholder='item Name' name='item_id[]'>"+
                                        "<input type='text' class='form-control' style='background-color: #dddddd;' value='" + data[i].name + "' data-rule-required data-msg-required='This field is required.' id='item_name_" + k + "' placeholder='item Name' name='item_name[]' readonly style='border: 0'></td>"+
                                        "<td><textarea class='form-control' style='background-color: #fafdff;' id='description_" + k + "' placeholder='description'  name='description[]' style='border: 0'>" + data[i].description + "</textarea></td>"+
                                        // "<td><input type='text' class='form-control' style='background-color: #fafdff' value='" + data[i].unit_type + "' data-rule-required data-msg-required='This field is required.' id='unit_type_" + k + "' placeholder='Unit Type'  name='unit_type[]' readonly style='border: 0'></td>"+
                                        "<td><input type='text' class='form-control' style='background-color: #fafdff;text-align:center' value='" + data[i].quantity + "' oninput='calculate_total(this)' "+
                                        "data-rule-required data-msg-required='This field is required.' id='quantity_" + k + "' placeholder='Quantity'  name='quantity[]' style='border: 0'></td>"+
                                        "<td><input type='text' class='form-control' style='background-color: #fafdff;' value='" + data[i].price + "' data-rule-required data-msg-required='This field is required.' id='price_" + k + "' placeholder='Price'  name='price[]' style='border: 0' oninput='calculate_total(this)' ></td>"+
                                        "<td><input type='text' class='form-control' style='background-color: #fafdff;' value='" + parseFloat(item_total).toFixed(2) + "' data-rule-required data-msg-required='This field is required.' id='total_" + k + "' placeholder='Total'  name='total[]' style='border: 0'></td>"+
                                        "<td style='text-align: center;'>" + actions + "</td>"+
                                    "</tr>"
                                );
                                k = k+1;
                                total += parseFloat(item_total);
                            }
                            localStorage.setItem('curTotal', total);
                            
                            $('#add_items_table_rq tbody').append("<tr style='border-bottom: transparent;'><td colspan='4' style='border:0'></td><td>Total: </td><td style='font-weight: bold;'><span id='footer_total'>" + total.toLocaleString('en-US', {minimumFractionDigits:2, maximumFractionDigits:2, style: 'currency', currency: 'USD'}) + "</span></td></tr>");
                            
                        }else{
                            $('#add_items_table_rq tbody').html('');
                        }

                        feather.replace();
                    },
                    statusCode: {
                        403: function () {
                            console.log("403: Session expired.");
                            window.location.reload();
                        },
                        404: function () {
                            appLoader.hide();
                            appAlert.error("404: Page not found.");
                        }
                    },
                    error: function () {
                        appLoader.hide();
                        appAlert.error("500: Internal Server Error.");
                    }
                });
            }

    });
</script>    