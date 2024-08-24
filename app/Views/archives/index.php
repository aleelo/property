
<div id="page-content" class="page-wrapper clearfix">
    <div class="clearfix grid-button">
        <ul id="client-tabs" data-bs-toggle="ajax-tab" class="nav nav-tabs bg-white title" role="tablist">
            <li><a role="presentation" data-bs-toggle="tab" href="<?php echo_uri("archives/archives"); ?>" data-bs-target="#archives"><?php echo app_lang('archives'); ?></a></li>
            <li><a role="presentation" data-bs-toggle="tab" href="<?php echo_uri("archives/folders/"); ?>" data-bs-target="#folders"><?php echo app_lang('folders'); ?></a></li>
            <div class="tab-title clearfix no-border">
                <div class="title-button-group">
                    <?php
                    if ($login_user->user_type == "staff" ) {
                        echo modal_anchor(get_uri("archives/file_modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_files'), array("class" => "btn btn-default", "title" => app_lang('add_files'), "data-post-client_id" => 0));
                        echo modal_anchor(get_uri("archives/folders_modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_folders'), array("class" => "btn btn-default", "title" => app_lang('add_folders'), "data-post-id" => 0));
                    }
                    ?>
                </div>
            </div>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade" id="archives"></div>
            <div role="tabpanel" class="tab-pane fade" id="folders"></div>
        </div>
    </div>
</div>


<script>
    $('#jstree_demo_div').jstree();
    feather.replace();
</script>

<script type="text/javascript">
    $(document).ready(function () {
        setTimeout(function () {
            var tab = window.location.hash.substring(1);
            if (tab === "archives" ) {
                $("[data-bs-target='#archives']").trigger("click");

                window.selectedClientQuickFilter = tab;
            } else if (tab === "folders") {
                $("[data-bs-target='#folders']").trigger("click");

                window.selectedContactQuickFilter = tab;
            }
        }, 210);
    });
</script>