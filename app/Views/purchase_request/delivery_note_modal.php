<?php echo form_open(get_uri("purchase_request/save_delivery_note"), array("id" => "delivery-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <div class="container-fluid p-4" >
           
        <input type="hidden" id='id' name="id" value="<?php echo $id; ?>" />
        <div class="form-group">
            <div class="row">
                <div class="col-12">
                <label for="delivered_by" class="fw-bold"><?php echo 'Delivered By'; ?>
                </label>
                    <?php
                    echo form_input(array(
                        "id" => "delivered_by",
                        "name" => "delivered_by",
                        "class" => "form-control",
                        "placeholder" => app_lang('delivered_by')
                    ));
                    ?>
                </div>
            
            </div> 
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-12">
                <label for="delivered_note" class="fw-bold"><?php echo app_lang('delivery_note'); ?>
                </label>
                    <?php
                    echo form_textarea(array(
                        "id" => "delivery_note",
                        "name" => "delivery_note",
                        "rows" => "40",
                        "cols" => "40",
                        "style" => "height: 233px;",
                        "class" => "form-control",
                        "placeholder" => app_lang('delivery_note').', if any'
                    ));
                    ?>
                </div>
            </div> 
        </div>

    </div>
    

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-bs-dismiss="modal"><span data-feather="x" class="icon-16"></span> <?php echo app_lang('close'); ?></button>
    
    <button type="submit" class="btn btn-primary"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('save'); ?></button>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    var k = 1;
    

    $(document).ready(function () {
     
        setDatePicker(".date");

        setTimePicker(".time");


        $("#delivery-form").appForm({
            onSuccess: function (result) {
                
                appAlert.success(result.message, {duration: 10000});

                    setTimeout(function () {
                        window.location.reload();
                    }, 500);
                        
            }
        });

        setTimeout(function () {
            $("#product_type").focus();
        }, 200);

        $('[data-bs-toggle="tooltip"]').tooltip();
        $(".select2").select2();   

    });
</script>    