<div id="page-content" class="page-wrapper clearfix">
    <div class="row">
        <div class="col-sm-3 col-lg-2">
            <?php
            $tab_view['active_tab'] = "templates";
            echo view("settings/tabs", $tab_view);
            ?>
        </div>

        <div class="col-sm-9 col-lg-10">
            <div class="card">
                <div class="page-title clearfix">
                    <h4> <?php echo app_lang('templates'); ?></h4>
                    <div class="title-button-group">
                        <?php echo modal_anchor(get_uri("documents/template_modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_template'), array("class" => "btn btn-default", "title" => app_lang('add_template'))); ?>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="template-table" class="display" cellspacing="0" width="100%">            
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {

    var ignoreSavedFilter = false;
            var hasString = window.location.hash.substring(1);
            if (hasString){
    var ignoreSavedFilter = true;
    }

    // `document_title`,`created_by`, `ref_number`, `depertment`, `template`, `item_id`, `created_at`
    $("#template-table").appTable({
    source: '<?php echo_uri("documents/templates_list_data") ?>',
            serverSide: true,
            // smartFilterIdentity: "all_leads_list", //a to z and _ only. should be unique to avoid conflicts
            ignoreSavedFilter: ignoreSavedFilter,
            order: [[0, "desc"]],
            columnDefs:[
                {
                    "targets": "_all",
                    "defaultContent": "-",
                }
            ],
            columns: [
            {title: "<?php echo 'ID' ?>", "class": "all", order_by: "id"},
            {title: "<?php echo app_lang("name") ?>", "class": "all", order_by: "document_title"},
            {title: "<?php echo app_lang("ref_prefix") ?>", order_by: "ref_prefix"},
            {title: "<?php echo app_lang("destination_folder") ?>", order_by: "destination_folder"},
            {title: "<?php echo app_lang("service_name") ?>", order_by: "service_name"},
            {title: "<?php echo app_lang("agreement_type") ?>", order_by: "agreement_type"},
            {title: "<?php echo app_lang("description") ?>", order_by: "description"},
            {title: "<?php echo app_lang("created_at") ?>", order_by: "created_at"}
            <?php echo $custom_field_headers; ?>,
            {title: '<i data-feather="menu" class="icon-16"></i>', "class": "text-center option w10p"}
            ],
            filterDropdown: [
                <?php //if (get_array_value($login_user->permissions, "lead") !== "own") { ?>
                 //{name: "owner_id", class: "w200", options: <?php //echo json_encode($owners_dropdown); ?>},
            <?php //} ?>
                //{name: "status", class: "w200", options: <?php //echo view("documents/lead_statuses"); ?>},
            //{name: "label_id", class: "w200", options: <?php //echo $labels_dropdown; ?>},

            //{name: "source", class: "w200", options: <?php //echo view("documents/lead_sources"); ?>} ,

            <?php //echo $custom_field_filters; ?>
            ],
            // rangeDatepicker: [{startDate: {name: "start_date", value: ""}, endDate: {name: "end_date", value: ""}, showClearButton: true}],
            printColumns: combineCustomFieldsColumns([0, 1, 2, 4, 5], '<?php echo $custom_field_headers; ?>'),
            xlsColumns: combineCustomFieldsColumns([0, 1, 2, 4, 5], '<?php echo $custom_field_headers; ?>')
    });
    }
    );
</script>
