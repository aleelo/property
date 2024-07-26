<div id="page-content" class="page-wrapper clearfix">
    <div class="clearfix grid-button">
        <ul id="client-tabs" data-bs-toggle="ajax-tab" class="nav nav-tabs bg-white title" role="tablist">
            <li><a role="presentation" data-bs-toggle="tab" href="<?php echo_uri("purchase_request"); ?>" data-bs-target="#purchase_request"><?php echo app_lang('purchase_request'); ?></a></li>
            <li><a role="presentation" data-bs-toggle="tab" href="<?php echo_uri("purchase_order"); ?>" data-bs-target="#purchase_order"><?php echo app_lang('purchase_order'); ?></a></li>
            <li><a role="presentation" data-bs-toggle="tab" href="<?php echo_uri("purchase_receive"); ?>" data-bs-target="#purchase_receive"><?php echo app_lang('purchase_receive'); ?></a></li>
            <div class="tab-title clearfix no-border">
                <div class="title-button-group">
                    <?php
                        // echo modal_anchor(get_uri("labels/modal_form"), "<i data-feather='tag' class='icon-16'></i> " . app_lang('manage_labels'), array("class" => "btn btn-outline-light", "title" => app_lang('manage_labels'), "data-post-type" => "client"));
                        // echo modal_anchor(get_uri("clients/import_clients_modal_form"), "<i data-feather='upload' class='icon-16'></i> " . app_lang('import_clients'), array("class" => "btn btn-default", "title" => app_lang('import_clients')));
                        // echo modal_anchor(get_uri("clients/modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_client'), array("class" => "btn btn-default", "title" => app_lang('add_client')));
                 
                    ?>
                </div>
            </div>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade" id="purchase_request"></div>
            <div role="tabpanel" class="tab-pane fade" id="purchase_order"></div>
            <div role="tabpanel" class="tab-pane fade" id="purchase_receive"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setTimeout(function () {
            
            var hash = window.location.hash.substring(1);
            if (hash === "purchase_request") {
                $("[data-bs-target='#purchase_request']").trigger("click");

                window.selectedClientQuickFilter = hash;
            } else if (hash === "purchase_order") {
                $("[data-bs-target='#purchase_order']").trigger("click");

                window.selectedContactQuickFilter = hash;
            } else if (hash === "purchase_receive") {
                $("[data-bs-target='#purchase_receive']").trigger("click");

                window.selectedContactQuickFilter = hash;
            }
        }, 210);
    });
</script>