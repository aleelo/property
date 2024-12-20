<div class="clearfix default-bg">
    <div class="row">
        <div class="col-md-9 d-flex align-items-stretch">
            <div class="card p15 w-100">
                <div id="page-content" class="clearfix grid-button">
                    <div style="max-width: 1000px; margin: auto;">
                        <div class="clearfix p20">
                            <!-- small font size is required to generate the pdf, overwrite that for screen -->
                            <style type="text/css"> .invoice-meta {
                                    font-size: 100% !important;
                                }</style>

                         <!-- header and purchase ifo -->
                         <table class="header-style" style="font-size: 13.5px;">
                            <tr class="invoice-preview-header-row">
                                <td style="width: 45%; vertical-align: top;">
                                    <?php echo get_company_logo(1, "purchase"); ?>
                                </td>
                                <td class="hidden-invoice-preview-row" style="width: 20%;"></td>
                                <td class="invoice-info-container invoice-header-style-one" style="float: right; vertical-align: top; text-align: left">
                                
                                    <span class="invoice-info-title" style="font-size:20px; font-weight: bold;background-color: #287ec9; color: #fff;">&nbsp;
                                    <?php echo 'Purchase: #'.get_PO_ID($purchase_info->id); ?>&nbsp;</span><br />
                                   
                              
                                    <?php                                        
                                        echo '<b>'. app_lang("order_date") . "</b>: " . format_to_date($purchase_info->order_date, false);?><br />
                                        <?php echo '<b>'. app_lang("type") . "</b>: " . $purchase_info->product_type; ?><br />
                                        <?php echo '<b>'. app_lang("department") . "</b>: " . $purchase_info?->department;?> <br />
                                        
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 5px;"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><?php
                                    echo 'Villa Somalia';
                                    ?>
                                </td>
                                <td></td>
                                <td><?php
                                    // echo view('invoices/invoice_parts/bill_to', $data);
                                    ?>
                                </td>
                            </tr>
                        </table>
                        </div>

                        <div class="table-responsive mt15 pl15 pr15">
                            <table id="purchase-item-table" class="display" width="100%">            
                            </table>
                        </div>

                        <div class="clearfix">
                            <?php if ($can_add_purchase && $purchase_info->status !== "cancelled") { ?>
                                <div class="float-start mt20 ml15">
                                    <?php echo modal_anchor(get_uri("purchase_order/item_modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_item'), array("class" => "btn btn-info text-white", "title" => app_lang('add_item'), "data-post-purchase_order_id" => $purchase_info->id)); ?>
                                </div>
                            <?php } ?>
                            <div class="float-end pr15" id="invoice-total-section">
                                <?php echo view("purchase_order/purchase_total_section", array("purchase_id" => $purchase_info->id,'purchase_total_summary'=>$purchase_total_summary, "can_add_purchase" => $can_add_purchase)); ?>
                            </div>
                        </div>           

                        <!-- <p class="b-t b-info pt10 m15"><?php //echo nl2br($purchase_info->note ? process_images_from_content($purchase_info->note) : ""); ?></p> -->
                    </div>
                </div>
            </div>
        </div>
        <?php 
            
            if (strtolower($purchase_info->status) === "pending") {
                $status_class = "bg-warning";
            } else if (strtolower($purchase_info->status) === "approved") {
                $status_class = " bg-primary";//btn-success
            } else if (strtolower($purchase_info->status) === "complete") {
                $status_class = " btn-success";//btn-success
            } else if (strtolower($purchase_info->status) === "cancelled" ) {
                $status_class = " bg-danger";//btn-success
            
            } else {
                $status_class = " bg-secondary";
            }

            $status_meta = "<span class='badge $status_class'>" . app_lang($purchase_info->status) . "</span>";
        ?>
        <div class="col-md-3 d-flex align-items-stretch">
            <div class="card p15 w-100">
                <div class="clearfix p20">
                    <div class="row">
                    <div id="invoice-status-bar">
                        <div class="col-md-12 mb15">
                            <strong><?php echo app_lang('status') . ": "; ?></strong><?php echo $status_meta; ?>
                        </div>
                        <div class="col-md-12 mb15">
                            <strong><?php echo app_lang('created_at') . ": "; ?></strong>
                            <?php echo format_to_relative_time($purchase_info->created_at); ?>
                        </div>

                        <?php if ($purchase_info->ordered_by) { ?>
                            <div class="col-md-12 mb15">
                                <strong><?php echo app_lang('ordered_by') . ": "; ?></strong>
                                <?php echo get_team_member_profile_link($purchase_info->ordered_by, $purchase_info->user); ?>
                            </div>
                        <?php } ?>

                        <hr>
                        
                        <div class="col-md-12 mb15">
                            <strong><?php echo app_lang("supplier") . ": "; ?></strong>
                            <?php echo modal_anchor(get_uri("suppliers/modal_form/" . $purchase_info->supplier_id), 'Supplier Info: '.$purchase_info->supplier,array("class" => "", "title" => app_lang('add_purchase_order'))); ?>
                        </div>
                        <div class="col-md-12 mb15">
                            <strong><?php echo app_lang("address") . ": "; ?></strong>
                            <?php echo $purchase_info->address; ?>
                        </div>
                        <div class="col-md-12 mb15">
                            <strong><?php echo app_lang("contact_person") . ": "; ?></strong>
                            <?php echo $purchase_info->contact_person; ?>
                        </div>

                       

                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
        
    $(document).ready(function () {
                
        var optionVisibility = false;
        if ("<?php echo $can_edit_purchase ?>") {
            optionVisibility = true;
        }
        var delay;
        var taxableRows = [];

        $("#purchase-item-table").appTable({
            source: '<?php echo_uri("purchase_order/item_list_data/" . $purchase_info->id) ?>',
            order: [[0, "asc"]],
            hideTools: true,
            displayLength: 100,
            stateSave: false,
            columns: [
                {visible: false, searchable: false},
                {title: '<?php echo app_lang("item") ?> ', sortable: false},
                {title: '<?php echo app_lang("quantity") ?>', "class": "text-right w15p", sortable: false},
                {title: '<?php echo app_lang("price") ?>', "class": "text-right w15p", sortable: false},
                {title: '<?php echo app_lang("total") ?>', "class": "text-right w15p", sortable: false},
                {title: '<i data-feather="menu" class="icon-16"></i>', "class": "text-center option w100", sortable: false, visible: optionVisibility}
            ],
            // rowCallback: function (nRow, aData) {
            //     var column = $("#purchase-item-table").DataTable().column(4);
            //     var taxableColumn = "<?php //echo get_setting('taxable_column'); ?>";
            //     if (taxableColumn == "always_show") {
            //         column.visible(true);
            //     } else if (taxableColumn == "never_show") {
            //         column.visible(false);
            //     } else {
            //         taxableRows.push(aData[4]);
            //         clearTimeout(delay);
            //         delay = setTimeout(function () {
            //             var unique = getUniqueArray(taxableRows);

            //             if (unique.length === 2) {
            //                 column.visible(true);
            //             } else {
            //                 column.visible(false);
            //             }
            //             taxableRows = [];
            //         }, 100);
            //     }

            // },
            onInitComplete: function () {
                <?php if ($can_edit_purchase) { ?>
                    //apply sortable
                    $("#purchase-item-table").find("tbody").attr("id", "purchase-item-table-sortable");
                    var $selector = $("#purchase-item-table-sortable");

                    Sortable.create($selector[0], {
                        animation: 150,
                        chosenClass: "sortable-chosen",
                        ghostClass: "sortable-ghost",
                        onUpdate: function (e) {
                            appLoader.show();
                            //prepare sort indexes 
                            var data = "";
                            $.each($selector.find(".item-row"), function (index, ele) {
                                if (data) {
                                    data += ",";
                                }

                                data += $(ele).attr("data-id") + "-" + index;
                            });

                            //update sort indexes
                            // $.ajax({
                            //     url: '<?php //echo_uri("invoices/update_item_sort_values") ?>',
                            //     type: "POST",
                            //     data: {sort_values: data},
                            //     success: function () {
                            //         appLoader.hide();
                            //     }
                            // });
                        }
                    });

<?php } ?>

            },
            onDeleteSuccess: function (result) {
                $("#invoice-total-section").html(result.invoice_total_view);
                if (typeof updateInvoiceStatusBar == 'function') {
                    updateInvoiceStatusBar(result.invoice_id);
                }
            },
            onUndoSuccess: function (result) {
                $("#invoice-total-section").html(result.invoice_total_view);
                if (typeof updateInvoiceStatusBar == 'function') {
                    updateInvoiceStatusBar(result.invoice_id);
                }
            }
        });

        
        feather.replace();
    });
</script>