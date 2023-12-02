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
        
        setTimePicker(".time");

        $(".select2").select2();

        function removeRow(el){
            $(el).parent().parent().remove();
            k = k-1;
        }
        
        $('.modal-dialog').removeClass('modal-lg').addClass('modal-xl');

        //read details for visitor:
        
        if($('#id').val() != ''){
            $.ajax({
                url: 'visitors/visitor_details_json/'+$('#id').val(),
                cache: false,
                type: 'GET',
                success: function (data) {

                    $('#add_visitors_table').show();
                    $('#add_visitors_table tbody').html('');
                    data = JSON.parse(data);
                    console.log(data.length);

                    if(data.length > 0 && data[0].visitor_name != null){
                        for(let i=0;i< data.length;i++){
                            $('#add_visitors_table tbody').append(
                                "<tr class=''>"+
                                "<td>" + k + "</td>"+
                                    "<td><input type='text' class='form-control' value='" + data[i].visitor_name + "' data-rule-required data-msg-required='This field is required.' id='visitor_name_" + k + "' placeholder='Visitor Name' name='visitor_name[]'></td>"+
                                    "<td><input type='text' class='form-control' value='" + data[i].mobile + "' data-rule-required data-msg-required='This field is required.' id='visitor_mobile_" + k + "' placeholder='Visitor Mobile'  name='visitor_mobile[]'></td>"+
                                    "<td><input type='text' class='form-control' value='" + data[i].vehicle_details + "' data-rule-required data-msg-required='This field is required.' id='vehicle_details_" + k + "' placeholder='Vehicle Details'  name='vehicle_details[]'></td>"+
                                    "<td style='width: 110px;'><button type='button' class='btn btn-danger btn-sm mt-2 float-end' onclick='$(this).parent().parent().remove();k--;'><i data-feather='minus-circle' class='icon'></i> Remove</button></td>"+
                                "</tr>"
                            );
                            k = k+1;
                        }
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