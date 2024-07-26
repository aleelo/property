<div class="card bg-white">
    <div class="card-header">
        <i data-feather="users" class="icon-16"></i> &nbsp;<?php echo app_lang("team_members_departments_overview"); ?>
    </div>
    <div class="row rounded-bottom pt-2 pb-3">
        <?php
        $i = 1;
         foreach ($departments as $k=>$v){ 
            if($i%2 == 0 ){?>                
                <div class="col-sm-6  b-r-2">
           
                    <div class="pt-2  px-2">
                        <div class="d-inline">
                            <div class="color-tag border-circle me-3 wh10" style="background-color: #e78000;"></div><?php echo $v?->department; ?>                        
                           
                        </div> 
                        <span class="strong float-end"><?php echo $v?->count; ?></span>
                    </div>
  
                </div>
            <?php }else{?>
                <div class="col-sm-6  b-r-2">
           
                    <div class="pt-2  px-2">
                        <div class="d-inline">
                            <div class="color-tag border-circle me-3 wh10" style="background-color: #e78000;"></div><?php echo $v?->department; ?>                        
                          
                        </div>  
                        <span class="strong float-end"><?php echo $v?->count; ?></span>
                    </div>

                </div>
            <?php }?>
             
        <?php $i++;}?>
    </div>
</div>