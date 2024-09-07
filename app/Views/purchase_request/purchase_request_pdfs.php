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
                                    <?php echo app_lang("purchase_request").': #'.get_PR_ID($purchase_info->id); ?>&nbsp;</span><br />
                                   
                              
                                    <?php                                        
                                        echo '<b>'. app_lang("request_date") . "</b>: " . format_to_date($purchase_info->request_date, false);?><br />
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
                                    echo 'Villa Somalia, The Presidency';
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
                            <div class="float-start mt20 ml15">
                                <?php echo modal_anchor(get_uri("purchase_request/item_modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_item'), array("class" => "btn btn-info text-white", "title" => app_lang('add_item'), "data-post-purchase_request_id" => $purchase_info->id)); ?>
                            </div>
                            <div class="float-end pr15" id="invoice-total-section">
                                <?php //echo view("purchase_request/purchase_total_section", array("purchase_id" => $purchase_info->id,'purchase_total_summary'=>$purchase_total_summary, "can_add_purchase" => true, "can_edit_purchase" => true)); ?>
                            </div>
                        </div>           

                        <!-- <p class="b-t b-info pt10 m15"><?php //echo nl2br($purchase_info->note ? process_images_from_content($purchase_info->note) : ""); ?></p> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 d-flex align-items-stretch">
            <div class="card p15 w-100">
                <div class="clearfix p20">
                    <div class="row">
                    <div id="invoice-status-bar">
                        <div class="col-md-12 mb15">
                            <strong><?php echo app_lang('status') . ": "; ?></strong><?php echo $purchase_info->status; ?>
                        </div>
                        <div class="col-md-12 mb15">
                            <strong><?php echo app_lang('created_at') . ": "; ?></strong>
                            <?php echo format_to_relative_time($purchase_info->created_at); ?>
                        </div>

                        <?php if ($purchase_info->requested_by) { ?>
                            <div class="col-md-12 mb15">
                                <strong><?php echo app_lang('requested_by') . ": "; ?></strong>
                                <?php echo get_team_member_profile_link($purchase_info->requested_by, $purchase_info->user); ?>
                            </div>
                        <?php } ?>

                        <hr>
                        
                                               

                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
