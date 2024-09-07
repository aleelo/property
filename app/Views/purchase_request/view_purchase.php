<div class="page-content invoice-details-view clearfix">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="invoice-title-section">
                    <div class="page-title no-bg clearfix mb5 no-border">
                        <h1 class="pl0">
                                                      
                            <?php  $procLink = "<span class='invoice-info-title' style='padding: 5px; font-weight: bold;color: #287ec9;'>
                           <i data-feather='shopping-cart' class='icon'></i></span> <a href='".get_uri('purchase_request')."' class='b_b' style='color: #287ec9;font-size: 20px;'>Purchase Request</a> / ";
                            
                            echo $procLink."
                            <span>
                                    <font style='font-weight: bold;color: #287ec9;'> Purchase Request: #".get_PR_ID($purchase_info->id)."</font></span>"; ?>
                           
                        </h1>

                        <div class="title-button-group mr0">
                            
                            <?php if ($can_add_purchase) { ?>
                                <?php //echo modal_anchor(get_uri("purchase_request/order_modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_purchase'), array("class" => "btn btn-default", "title" => app_lang('add_payment'), "data-post-invoice_id" => $purchase_info->id)); ?>
                            <?php } ?>

                            <span class="dropdown inline-block">
                                <button class="btn btn-info text-white dropdown-toggle caret" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                                    <i data-feather="tool" class="icon-16"></i> <?php echo app_lang('actions'); ?>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <?php if (strtolower($purchase_info->status) !== "cancelled" && $can_add_purchase) { ?>
<!--                                     
                                    <li role="presentation"><?php //echo modal_anchor(get_uri("purchase_request/send_invoice_modal_form/" . $purchase_info->id), "<i data-feather='mail' class='icon-16'></i> " . app_lang('email_invoice_to_client'), array("title" => app_lang('email_invoice_to_client'), "data-post-id" => $purchase_info->id, "role" => "menuitem", "tabindex" => "-1", "class" => "dropdown-item")); ?> </li>
                                       
                                    <li role="presentation"><?php //echo anchor(get_uri("purchase_request/download_pdf/" . $purchase_info->id), "<i data-feather='download' class='icon-16'></i> " . app_lang('download_pdf'), array("title" => app_lang('download_pdf'), "class" => "dropdown-item")); ?> </li>
                                    <li role="presentation"><?php //echo anchor(get_uri("purchase_request/download_pdf/" . $purchase_info->id . "/view"), "<i data-feather='file-text' class='icon-16'></i> " . app_lang('view_pdf'), array("title" => app_lang('view_pdf'), "target" => "_blank", "class" => "dropdown-item")); ?> </li>
                                    <li role="presentation"><?php //echo anchor(get_uri("purchase_request/preview/" . $purchase_info->id . "/1"), "<i data-feather='search' class='icon-16'></i> " . app_lang('preview'), array("title" => app_lang('preview'), "target" => "_blank", "class" => "dropdown-item")); ?> </li>
                                    <li role="presentation"><?php //echo js_anchor("<i data-feather='printer' class='icon-16'></i> " . app_lang('print'), array('title' => app_lang('print'), 'id' => 'print-invoice-btn', "class" => "dropdown-item")); ?> </li> -->

                                        <!-- <li role="presentation" class="dropdown-divider"></li> -->
                                      
                                        <!-- <li role="presentation"><?php //echo modal_anchor(get_uri('purchase_request/modal_form'), "<i data-feather='edit' class='icon-16'></i> " . app_lang('edit_invoice'), array("title" => app_lang('edit_invoice'), "data-post-id" => $purchase_info->id, "role" => "menuitem", "tabindex" => "-1", "class" => "dropdown-item")); ?> </li> -->
                                        <?php if(strtolower($purchase_info->status) !== 'delivered'){?>
                                            <li role="presentation"><?php echo js_anchor("<i data-feather='x' class='icon-16'></i> " . app_lang('mark_as_cancelled'), array('title' => app_lang('mark_as_cancelled'), "data-action-url" => get_uri("purchase_request/update_purchase_status/" . $purchase_info->id . "/cancelled"), "data-action" => "delete-confirmation", "data-reload-on-success" => "1", "class" => "dropdown-item")); ?> </li>
                                        <?php } ?>
                                        <?php if(strtolower($purchase_info->status) === 'pending' || strtolower($purchase_info->status) === 'draft'){?>
                                            <li role="presentation"><?php echo ajax_anchor(get_uri("purchase_request/update_purchase_status/" . $purchase_info->id . "/Submitted"),"<i data-feather='check' class='icon-16'></i> " . app_lang('submit_request'), array('title' => app_lang('submit_request'),  "data-reload-on-success" => "1", "class" => "dropdown-item")); ?> </li>
                                        <?php } ?>
                                        <?php if(strtolower($purchase_info->status) === 'submitted'){?>
                                            <li role="presentation"><?php echo modal_anchor(get_uri("purchase_request/delivery_note_modal/" . $purchase_info->id),"<i data-feather='external-link' class='icon-16'></i> " . app_lang('process_for_delivery'), array('title' => app_lang('process_for_delivery'),  "data-reload-on-success" => "1", "class" => "dropdown-item")); ?> </li>
                                        <?php } ?>

                                        <li role="presentation"><?php echo anchor(get_uri("purchase_request/get_purchase_requisition_slip_pdf/" . $purchase_info->id),"<i data-feather='external-link' class='icon-16'></i> " . app_lang('requisition_form'), array('title' => app_lang('requisition_form'), 'target' => '_blank',  "data-reload-on-success" => "1", "class" => "dropdown-item")); ?> </li>
                                        <li role="presentation"><?php echo anchor(get_uri("purchase_request/get_purchase_requisition_slip_pdf/" . $purchase_info->id),"<i data-feather='external-link' class='icon-16'></i> " . app_lang('requisition_slip'), array('title' => app_lang('requisition_slip'), 'target' => '_blank',  "data-reload-on-success" => "1", "class" => "dropdown-item")); ?> </li>
                                       
                                    <?php } ?>

                                </ul>
                            </span>
                        </div>
                    </div>

                    <ul id="invoice-tabs" data-bs-toggle="ajax-tab" class="nav nav-pills rounded classic mb20 scrollable-tabs border-white" role="tablist">
                        <li><a role="presentation" data-bs-toggle="tab"  href="<?php echo_uri("purchase_request/request_details_tab/" . $purchase_info->id); ?>" data-bs-target="#request-details-tab"><?php echo app_lang("request_details"); ?></a></li>
                     
                        <!-- <li><a role="presentation" data-bs-toggle="tab" href="<?php //echo_uri("purchase_request/payments/" . $purchase_info->id); ?>" data-bs-target="#invoice-payments-section"><?php //echo app_lang('payments'); ?></a></li>
                         
                        <li><a role="presentation" data-bs-toggle="tab" href="<?php //echo_uri("purchase_request/tasks/" . $purchase_info->id); ?>" data-bs-target="#invoice-tasks-section"><?php //echo app_lang('tasks'); ?></a></li> -->
                    </ul>
                </div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active" id="request-details-tab"></div>
<!--                   
                    <div role="tabpanel" class="tab-pane fade grid-button" id="invoice-payments-section"></div>
                       
                    <div role="tabpanel" class="tab-pane fade grid-button" id="invoice-tasks-section"></div> -->
                </div>
            </div>
        </div>
    </div>    
</div>
<script type="text/javascript">
    $(document).ready(function () {
        //modify the delete confirmation texts
        $("#confirmationModalTitle").html("<?php echo app_lang('cancel') . "?"; ?>");
        $("#confirmDeleteButton").html("<i data-feather='x' class='icon-16'></i> <?php echo app_lang("cancel"); ?>");
    });

    updateInvoiceStatusBar = function (invoiceId) {
        $.ajax({
            url: "<?php echo get_uri("purchase_request/get_invoice_status_bar"); ?>/" + invoiceId,
            success: function (result) {
                if (result) {
                    $("#invoice-status-bar").html(result);
                }
            }
        });
    };

    //print invoice
    $("#print-invoice-btn").click(function () {
        appLoader.show();

        $.ajax({
            url: "<?php echo get_uri('purchase_request/print_invoice/' . $purchase_info->id) ?>",
            dataType: 'json',
            success: function (result) {
                if (result.success) {
                    document.body.innerHTML = result.print_view; //add invoice's print view to the page
                    $("html").css({"overflow": "visible"});

                    setTimeout(function () {
                        window.print();
                    }, 200);
                } else {
                    appAlert.error(result.message);
                }

                appLoader.hide();
            }
        });
    });

    //reload page after finishing print action
    window.onafterprint = function () {
        location.reload();
    };

</script>

<?php
//required to send email 

load_css(array(
    "assets/js/summernote/summernote.css",
));
load_js(array(
    "assets/js/summernote/summernote.min.js",
));
?>