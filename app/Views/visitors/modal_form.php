<?php echo form_open(get_uri("visitors/save"), array("id" => "lead-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <div class="container-fluid">
        <?php echo view("visitors/lead_form_fields"); ?>
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
        //hide by default
        $('#add_visitors_table').hide();

        // add visitor table
        $('#add_visitor_btn').on('click', function(){

            $('#add_visitors_table').show();

            $('#add_visitors_table tbody').append(
                "<tr class=''>"+
                "<td>" + k + "</td>"+
                    "<td><input type='text' class='form-control' data-rule-required data-msg-required='This field is required.' id='visitor_name_" + k + "' placeholder='Visitor Name' name='visitor_name[]'></td>"+
                    "<td><input type='text' class='form-control' data-rule-required data-msg-required='This field is required.' id='visitor_mobile_" + k + "' placeholder='Visitor Mobile'  name='visitor_mobile[]'></td>"+
                    "<td><input type='text' class='form-control' data-rule-required data-msg-required='This field is required.' id='vehicle_details_" + k + "' placeholder='Vehicle Details'  name='vehicle_details[]'></td>"+
                    "<td style='width: 110px;'><button type='button' class='btn btn-danger btn-sm mt-2 float-end' onclick='$(this).parent().parent().remove();k--;'><i data-feather='minus-circle' class='icon'></i> Remove</button></td>"+
                "</tr>"
            );
            k = k+1;

        });

        
        setDatePicker(".date");

        $(".select2").select2();

        function removeRow(el){
            $(el).parent().parent().remove();
            k = k-1;
        }
        
        $('.modal-dialog').removeClass('modal-lg').addClass('modal-xl');

        $("#lead-form").appForm({
            onSuccess: function (result) {
                if (result.view === "details") {
                    appAlert.success(result.message, {duration: 10000});

                    setTimeout(function () {
                       
                        window.location.reload();

                    }, 500);
                } else {
                    appAlert.success(result.message, {duration: 10000});

                        if(result.webUrl != null) {
                            let newTab = window.open();
                            newTab.location.target = '_blank';
                            newTab.location.href = result.webUrl;
                        }
                        
                        setTimeout(function () {
                            window.location.reload();
                        }, 500);

                    $("#lead-table").appTable({newData: result.data, dataId: result.id});
                    $("#reload-kanban-button:visible").trigger("click");
                }
            }
        });
        setTimeout(function () {
            $("#company_name").focus();
        }, 200);
    });
</script>    