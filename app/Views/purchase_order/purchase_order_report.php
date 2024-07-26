<?php echo get_reports_topbar(); ?>

<div id="page-content" class="page-wrapper clearfix grid-button">
    <div class="card">
        <ul id="project-all-timesheet-tabs" data-bs-toggle="ajax-tab" class="nav nav-tabs bg-white title" role="tablist">
           <li class="title-tab"><h4 class="pl15 pt10 pr15"><?php //echo app_lang("timesheets"); ?></h4></li>
 
            <li><a id="timesheet-details-button"  role="presentation" data-bs-toggle="tab" href="javascript:;" data-bs-target="#activity-details"><?php echo app_lang("purchase_order"); ?></a></li>
      <!--       <li><a role="presentation" data-bs-toggle="tab" href="<?php //echo_uri("projects/all_timesheet_summary/"); ?>" data-bs-target="#timesheet-summary"><?php //echo app_lang('summary'); ?></a></li>
            <li><a role="presentation" data-bs-toggle="tab" href="<?php //echo_uri("projects/timesheet_chart/"); ?>" data-bs-target="#timesheet-chart"><?php //echo app_lang('chart'); ?></a></li> -->
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade" id="activity-details">
                <div class="table-responsive">
                    <table id="purchase-order-report-table" class="display" width="99%">  
                    </table>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="timesheet-summary"></div>
            <div role="tabpanel" class="tab-pane fade" id="timesheet-chart"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
    
    var optionVisibility = false;

        var table = $("#purchase-order-report-table").appTable({
            source: '<?php echo_uri("purchase_order/order_report_list_data") ?>',
            filterDropdown: [
                {name: "ordered_by", class: "w200", options: <?php echo $employees_dropdown; ?>},
                {name: "order_id", class: "w300", options: <?php echo $orders_dropdown; ?>},
                {name: "department_id", class: "w200", options: <?php echo $departments_dropdown; ?>},
                
            ],
            serverSide: true,
            rangeDatepicker: [{startDate: {name: "start_date", value: moment().subtract(7,'days').format("YYYY-MM-DD")}, 
                               endDate: {name: "end_date", value: moment().format("YYYY-MM-DD")}, showClearButton: true, 
                               label: "<?php echo app_lang('date'); ?>", ranges: ['this_month', 'last_month', 'this_year', 'last_year', 'last_30_days', 'last_7_days']}],
            columns: [
                {title: "<?php echo app_lang("id") ?>",order_by: "id", "class": "all"},
                {title: "<?php echo app_lang("po_id") ?>", order_by: "type", "class": "w5p"},
                {title: "<?php echo app_lang("name") ?>", order_by: "name", "class": "w20p"},
                {title: "<?php echo app_lang("description") ?>", "class": "w20p", order_by: "description"},
                {title: "<?php echo app_lang("quantity") ?>","class": "text-right " },
                {title: "<?php echo app_lang('price') ?>", "class": "text-right "},
                {title: "<?php echo app_lang('total') ?>", "class": "text-right "},
                // {visible: optionVisibility, title: '<i data-feather="menu" class="icon-16"></i>', "class": "text-center option w100"}
            ],
            
            footerCallback: function ( row, data, start, end, display ) {
                var api = new $.fn.dataTable.Api("#purchase-order-report-table");
                var balSum = 0;
                console.log(api);
                // for(var i = 0; i < data.length; i++) {
                //     balSum += parseInt(data[i][6]);
                // }


                // var nthSum = api.column(6).data().sum()
                // var footer = $(api.column(6).footer()).append(nthSum);
                // console.log(footer);

                // $(row).find('th').eq(6).html(parseFloat(balSum).toFixed(2));

    
            //     // converting to interger to find total
            //     var intVal = function ( i ) {
            //         return typeof i === 'string' ?
            //             i.replace(/[\$,]/g, '')*1 :
            //             typeof i === 'number' ?
            //                 i : 0;
            //     };
    
                
            //     // Update footer by showing the total with the reference of the column index 
            $( api.column( 0 ).footer() ).html('Total');
                
            //     $( api.column( 5 ).footer() ).html(friTotal);
            },
            printColumns: [0, 1, 2, 3, 4, 5, 6],
            xlsColumns: [0, 1, 2, 3, 4, 5, 6],
            summation: [{column: 6,dataType: "number"},{column: 6,dataType: "number"}]
        });
    });
</script>