<?php 
// prepare the data

// 'total_diploma' => $total_diploma, 'total_graduate' => $total_graduate,
// 'total_bachelor' => $total_bachelor, 'total_master' => $total_master,
// 'total_doctorate' => $total_doctorate, 'total_other' => $total_other,

// 'total_1530' => $total_1530, 'total_3145' => $total_3145,
// 'total_4660' => $total_4660, 'total_6075' => $total_6075,
// 'total_60up' => $total_76up
?>
<div class="card bg-white">
    <div class="card-header">
        <i data-feather="users" class="icon-16"></i> &nbsp;<?php echo app_lang("team_members_departments_overview"); ?>
    </div>
    <div class="rounded-bottom">

        <div class="col-md-6 col b-r-2 ps-4 pe-4">
            <h4>Employee Education Levels</h4>
            <div class="pb-2">
                <div class="color-tag border-circle me-3 wh10" style="background-color: #DEA701;"></div>
                Diploma                        <span class="strong float-end"><?php echo $total_diploma; ?></span>
            </div>
            <div class="pb-2">
                <div class="color-tag border-circle me-3 wh10" style="background-color: #F4325B;"></div>
                Graduate                        <span class="strong float-end"><?php echo $total_graduate; ?></span>
            </div>
            <div class="pb-2">
                <div class="color-tag border-circle me-3 wh10" style="background-color: #485ABD;"></div>
                Bachelor                        <span class="strong float-end"><?php echo $total_bachelor; ?></span>
            </div>
            <div class="pb-2">
                <div class="color-tag border-circle me-3 wh10" style="background-color: #485ABD;"></div>
                Masterate                        <span class="strong float-end"><?php echo $total_master; ?></span>
            </div>
            <div class="pb-2">
                <div class="color-tag border-circle me-3 wh10" style="background-color: #485ABD;"></div>
                Doctoral                        <span class="strong float-end"><?php echo $total_doctorate; ?></span>
            </div>
            <div class="pb-2">
                <div class="color-tag border-circle me-3 wh10" style="background-color: #485ABD;"></div>
                Other/Skill                     <span class="strong float-end"><?php echo $total_other; ?></span>
            </div>
        </div>

        <div class="col-md-6 col  ps-4 pe-4">
            <h4>Employee Age Groups</h4>
            <div class="pb-2">
                <div class="color-tag border-circle me-3 wh10" style="background-color: #DEA701;"></div>
                Between 15 - 31                        <span class="strong float-end"><?php echo $total_1530; ?></span>
            </div>
            <div class="pb-2">
                <div class="color-tag border-circle me-3 wh10" style="background-color: #DEA701;"></div>
                Between 31 - 45                        <span class="strong float-end"><?php echo $total_3145; ?></span>
            </div>
            <div class="pb-2">
                <div class="color-tag border-circle me-3 wh10" style="background-color: #DEA701;"></div>
                Between 46 - 59                        <span class="strong float-end"><?php echo $total_4660; ?></span>
            </div>
            <div class="pb-2">
                <div class="color-tag border-circle me-3 wh10" style="background-color: #DEA701;"></div>
                Between 60 - 75                        <span class="strong float-end"><?php echo $total_6075; ?></span>
            </div>
            <div class="pb-2">
                <div class="color-tag border-circle me-3 wh10" style="background-color: #DEA701;"></div>
                Between 76 & Above                        <span class="strong float-end"><?php echo $total_76up; ?></span>
            </div>
           
        </div>
    </div>
</div>