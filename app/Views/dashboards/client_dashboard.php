<div id="page-content" class="page-wrapper clearfix">
    <?php
    if (count($dashboards) && !get_setting("disable_dashboard_customization_by_clients")) {
        echo view("dashboards/dashboard_header");
    }

    if (in_array($role, ['ID Printer','Head of IDs','admin'])) { 
        echo announcements_alert_widget();
    }else{

        echo last_announcement_widget();
    }

    app_hooks()->do_action('app_hook_dashboard_announcement_extension');
    ?>
    <div class="">
        <?php echo view("clients/info_widgets/index"); ?>
    </div>

    <?php if (in_array($role, ['ID Printer','Head of IDs'])) { ?>
        <div class="">
            <?php echo view("cardholders/index"); ?>
        </div>
    <?php }else{ ?>
        <div class="row">
            <div class="col-md-8 col-sm-6">                    
                <div class="row">
                    <div class="col-sm-6  widget-container">
                        <?php echo tasks_overview_widget("my_tasks_overview"); ?>
                    </div>

                    <div class=" col-sm-6  widget-container">
                        <?php echo events_widget(); ?>
                    </div>
                </div>
                <div class="row">             
                    <div class="col-sm-12  widget-container">
                        <?php echo my_tasks_list_widget(); ?>
                    </div>
                </div>
            </div>        

            <div class="col-md-4 col-sm-6  widget-container">
                <?php echo todo_list_widget(); ?>
            </div>
        
            <div class="col-sm-12  widget-container">
                <?php echo sticky_note_widget("h370");; ?>
            </div>
        
        </div>

    <?php } ?>

    <?php //if (!in_array("projects", $hidden_menu)) { ?>
        <!-- <div class="">
            <?php //echo view("clients/projects/index"); ?>
        </div> -->
    <?php //} ?>

</div>