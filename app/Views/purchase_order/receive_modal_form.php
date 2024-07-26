<?php echo form_open(get_uri("purchase_receive/save"), array("id" => "order-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <div class="container-fluid" style="width: 70%;padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
       
        <input type="hidden" id='id' name="id" value="<?php echo $model_info?->id; ?>" />
        <input type="hidden" id='purchase_order_id' name="purchase_order_id" value="<?php echo $model_info?->order_id; ?>" />
        <input type="hidden" name="view" value="<?php echo isset($view) ? $view : ""; ?>" />
        
        <div class="form-group">
            <div class="row">
                <label for="order_id" class="col-3"><?php echo app_lang('purchase_order'); ?></label>
                <div class="col-9">
                    <?php
                    echo form_dropdown(array(
                        "id" => "order_id",
                        "name" => "order_id",
                        "class" => "form-control select2",
                        "placeholder" => app_lang('purchase_order'),
                        "disabled" => "disabled",
                        "autofocus" => true,
                        "data-rule-required" => true,
                        "data-msg-required" => app_lang("field_required"),
                    ),$orders_dropdown,[$model_info?->order_id]);
                    ?>
                </div>
            </div>
        </div>
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
                    ),['Product'=>'Product','Service'=>'Service'],[$model_info?->product_type]);
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
                    ),$suppliers,[$model_info?->supplier]);
                    ?>
                </div>
            </div>
        </div>
        
        <!-- fuel_type supplier receive_date barrels	litters	received_by	vehicle_model	plate	 -->

        <div class="form-group">
            <div class="row">
                <label for="receive_date" class="col-3"><?php echo 'Receive Date'; ?>
                </label>
                <div class="col-9">
                    <?php
                    echo form_input(array(
                        "id" => "receive_date",
                        "name" => "receive_date",
                        "value" => empty($model_info?->receive_date) ? date("Y-m-d") : $model_info?->receive_date,
                        "class" => "form-control date",
                        "placeholder" => app_lang('receive_date')
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
                    ),$model_info?->remarks ?? '');
                    ?>
                </div>
            </div> 
        </div>

    </div>
    
    <?php //if(!empty($model_info?->id)){?>
    <div class="container-fluid">
        <div class="form-group mb0">
            <h4 class="fw-bold mb-1 mt-4 mb0">Purchase Receive Details:</h4>
            <hr class="mt-1 mb0">
            <!-- <button type="button" class="btn btn-success float-end mb-2" id="add_item_btn"><i data-feather="plus-circle" class='icon'></i> Add Items</button> -->

        </div>

        <div class="form-group p-3" style="clear: both;">
            <div class="row">
                <table class="table table-bordered" id="add_items_table">
                    <thead>
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
    <?php //}?>


</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-bs-dismiss="modal"><span data-feather="x" class="icon-16"></span> <?php echo app_lang('close'); ?></button>
    
    <button type="submit" class="btn btn-primary"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('receive_purchase_order'); ?></button>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    var k = 1;
    var isUpdate = "<?php echo $model_info?->id?>";
    
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
        $('#add_items_table tbody #footer_total').html( total.toLocaleString('en-US', {minimumFractionDigits:2, maximumFractionDigits:2, style: 'currency', currency: 'USD'}));

    }

    $(document).ready(function () {
        //hide by default
        // $('#add_items_table').hide();

        // // add visitor table
        // $('#add_item_btn').on('click', function(){

        //     $('#add_items_table').show();
          
        //     //remove button
        //    var actions = "<button id='remove-btn' type='button' class='btn btn-danger btn-sm mt-2  round ml-2 p-1 ' onclick='$(this).parent().parent().remove();k--;'><i data-feather='minus-circle' class='icon'></i></button>";

        //     $('#add_items_table tbody').append(
        //         "<tr class=''>"+
        //         "<td>" + k + "</td>"+
        //             "<td><input type='text' class='form-control' data-rule-required data-msg-required='This field is required.' id='item_name_" + k + "' placeholder='Item Name' name='item_name[]'></td>"+
        //             "<td><input type='text' class='form-control'  id='description_" + k + "' placeholder='description'  name='description[]'></td>"+
        //             // "<td><input type='text' class='form-control'  id='unit_type_" + k + "' placeholder='Visitor Mobile'  name='unit_type[]'></td>"+
        //             "<td><input type='text' class='form-control'  id='quantity_" + k + "' placeholder='quantity'  name='quantity[]' value='0'></td>"+
        //             "<td><input type='text' class='form-control'  id='price_" + k + "' placeholder='price'  name='price[]' value='0.00'></td>"+
        //             "<td><input type='text' class='form-control'  id='total_" + k + "' placeholder='Total' value='0.00'  name='total[]' style='text-align: center; width: 90px;' readonly></td>"+
        //             "<td style='width: 70px;'>" + actions + "</td>"+
        //         "</tr>"
        //     );

        //     feather.replace();

        //     // $('.upload').on('change', function(){
        //     //     $('#file-indicator_'+k).show();
        //     // });

        //     k = k+1;
        // });



        $('.modal-dialog').removeClass('modal-lg').addClass('modal-xl');

        setDatePicker(".date");

        setTimePicker(".time");

        //read details for visitor:

        getReceiveItemsDetail();


        $("#order-form").appForm({
            onSuccess: function (result) {
                if (result.view === "details") {
                    appAlert.success(result.message, {duration: 10000});

                    setTimeout(function () {
                       
                        window.location.reload();

                    }, 500);
                } else {
                    appAlert.success(result.message, {duration: 10000});

                        setTimeout(function () {
                            window.location.reload();
                        }, 500);

                    $("#purchase-receive-table").appTable({newData: result.data, dataId: result.id});
                    $("#reload-kanban-button:visible").trigger("click");
                }
            }
        });

        setTimeout(function () {
            $("#product_type").focus();
        }, 200);

        $('[data-bs-toggle="tooltip"]').tooltip();
        $(".select2").select2();
        setDatePicker("#receive_date");
        // $('#owner_id').select2({data: <?php //echo json_encode($owners_dropdown); ?>});

        // $("#lead_labels").select2({multiple: true, data: <?php //echo json_encode($label_suggestions); ?>});     
        

        $('#order_id').on('change',function(e){

            e.preventDefault();

                //get items detail:
                getReceiveItemsDetail();
            });

            function getReceiveItemsDetail(){
                setTimeout(function () {

                // $('#order_id').select2('destroy');
                // $('#order_id').select2({ disabled:'readonly' });

                },100);
                
                $.ajax({
                    url: "<?php echo base_url().'purchase_receive/order_items_json/' ?>"+ $('#purchase_order_id').val(),
                    cache: false,
                    type: 'GET',
                    success: function (data) {

                        $('#add_items_table').show();
                        $('#add_items_table tbody').html('');
                        data = JSON.parse(data);
                        // console.log(data);
                        var total = 0;

                        //remove button
                        var actions = "<button type='button' class='btn btn-danger btn-sm mt-2  round ml-2 p-1 ' onclick='$(this).parent().parent().remove();k--;getFooterTotal("+total+",this);'><i data-feather='minus-circle' class='icon'></i></button>";

                        if(data.length > 0 && data[0].id != null){
                            for(let i=0;i< data.length;i++){
                                $('#add_items_table tbody').append(
                                    "<tr class='' style='vertical-align: middle;'>"+
                                    "<td>" + k + "</td>"+
                                        "<td><input type='hidden' class='form-control'  value='" + data[i].item_id + "'  id='item_id_" + k + "' placeholder='item Name' name='item_id[]'>"+
                                        "<input type='text' class='form-control' style='background-color: #dddddd;' value='" + data[i].name + "' data-rule-required data-msg-required='This field is required.' id='item_name_" + k + "' placeholder='item Name' name='item_name[]' readonly style='border: 0'></td>"+
                                        "<td><textarea class='form-control' style='background-color: #fafdff;' id='description_" + k + "' placeholder='description'  name='description[]' style='border: 0'>" + data[i].description + "</textarea></td>"+
                                        // "<td><input type='text' class='form-control' style='background-color: #fafdff' value='" + data[i].unit_type + "' data-rule-required data-msg-required='This field is required.' id='unit_type_" + k + "' placeholder='Unit Type'  name='unit_type[]' readonly style='border: 0'></td>"+
                                        "<td><input type='text' class='form-control' style='background-color: #fafdff;text-align:center' value='" + data[i].quantity + "' oninput='calculate_total(this)' "+
                                        "data-rule-required data-msg-required='This field is required.' id='quantity_" + k + "' placeholder='Quantity'  name='quantity[]' style='border: 0'></td>"+
                                        "<td><input type='text' class='form-control' style='background-color: #fafdff;' value='" + data[i].price + "' data-rule-required data-msg-required='This field is required.' id='price_" + k + "' placeholder='Price'  name='price[]' style='border: 0'></td>"+
                                        "<td><input type='text' class='form-control' style='background-color: #fafdff;' value='" + parseFloat(data[i].total).toFixed(2) + "' data-rule-required data-msg-required='This field is required.' id='total_" + k + "' placeholder='Total'  name='total[]' style='border: 0'></td>"+
                                        "<td style='text-align: center;'>" + actions + "</td>"+
                                    "</tr>"
                                );
                                k = k+1;
                                total += parseFloat(data[i].total);
                            }
                            localStorage.setItem('curTotal', total);
                            
                            $('#add_items_table tbody').append("<tr style='border-bottom: transparent;'><td colspan='4' style='border:0'></td><td>Total: </td><td style='font-weight: bold;'><span id='footer_total'>" + total.toLocaleString('en-US', {minimumFractionDigits:2, maximumFractionDigits:2, style: 'currency', currency: 'USD'}) + "</span></td></tr>");

                        }else{
                            $('#add_items_table tbody').html('');
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