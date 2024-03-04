<?php echo form_open(get_uri("team_members/add_team_member"), array("id" => "team_member-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <div class="container-fluid">

    <style>
        .app-alert.alert-danger {
            margin-top: 70px;
        }
    </style>
        <div class="form-widget">
            <div class="widget-title clearfix">
                <div class="row">
                    <div id="general-info-label" class="col-sm-3"><i data-feather="circle" class="icon-16"></i><strong> <?php echo app_lang('general_info'); ?></strong></div>
                    <div id="job-info-label" class="col-sm-3"><i data-feather="circle" class="icon-16"></i><strong>  <?php echo app_lang('job_info'); ?></strong></div>
                    <div id="account-info-label" class="col-sm-3"><i data-feather="circle" class="icon-16"></i><strong>  <?php echo app_lang('account_settings'); ?></strong></div> 
                </div>
            </div>

            <div class="progress ml15 mr15">
                <div id="form-progress-bar" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                </div>
            </div>
        </div>

        <div class="tab-content mt15">
         <div role="tabpanel" class="tab-pane active" id="general-info-tab">
                
                <div class="mb-4">
                    <h4  class="text-muted">Basic Information</h4>
                    <hr class="mt-0"/> 
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="first_name" class=" col-md-3"><?php echo app_lang('first_name'); ?></label>
                        <div class=" col-md-9">
                            <?php
                            echo form_input(array(
                                "id" => "first_name",
                                "name" => "first_name",
                                "class" => "form-control",
                                "placeholder" => app_lang('first_name'),
                                "autofocus" => true,
                                "data-rule-required" => true,
                                "data-msg-required" => app_lang("field_required"),
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="last_name" class=" col-md-3"><?php echo app_lang('last_name'); ?></label>
                        <div class=" col-md-9">
                            <?php
                            echo form_input(array(
                                "id" => "last_name",
                                "name" => "last_name",
                                "class" => "form-control",
                                "placeholder" => app_lang('last_name'),
                                "data-rule-required" => true,
                                "data-msg-required" => app_lang("field_required"),
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="address" class=" col-md-3"><?php echo app_lang('mailing_address'); ?></label>
                        <div class=" col-md-9">
                            <?php
                            echo form_textarea(array(
                                "id" => "address",
                                "name" => "address",
                                "class" => "form-control",
                                "placeholder" => app_lang('mailing_address')
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="phone" class=" col-md-3"><?php echo app_lang('phone'); ?></label>
                        <div class=" col-md-9">
                            <?php
                            echo form_input(array(
                                "id" => "phone",
                                "name" => "phone",
                                "class" => "form-control",
                                "placeholder" => app_lang('phone')
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="marital_status" class=" col-md-3"><?php echo 'Marital Status'; ?></label>
                        <div class=" col-md-9">
                            <?php
                            echo form_input(array(
                                "id" => "marital_status",
                                "name" => "marital_status",
                                "class" => "form-control",
                                "placeholder" => 'Marital Status'
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="gender" class=" col-md-3"><?php echo app_lang('gender'); ?></label>
                        <div class=" col-md-9">
                            <?php
                            echo form_radio(array(
                                "id" => "gender_male",
                                "name" => "gender",
                                "class" => "form-check-input",
                                    ), "male", true);
                            ?>
                            <label for="gender_male" class="mr15"><?php echo app_lang('male'); ?></label> 
                            <?php
                            echo form_radio(array(
                                "id" => "gender_female",
                                "name" => "gender",
                                "class" => "form-check-input",
                                    ), "female", false);
                            ?>
                            <label for="gender_female" class="mr15"><?php echo app_lang('female'); ?></label>
                            <?php
                            echo form_radio(array(
                                "id" => "gender_other",
                                "name" => "gender",
                                "class" => "form-check-input",
                                    ), "other", false);
                            ?>
                            <label for="gender_other" class=""><?php echo app_lang('other'); ?></label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="birth_date" class=" col-md-3"><?php echo 'Date of Birth'; ?></label>
                        <div class=" col-md-9">
                            <?php
                            echo form_input(array(
                                "id" => "birth_date",
                                "name" => "birth_date",
                                "class" => "form-control date_input",
                                "placeholder" => 'Date of Birth'
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <label for="birth_place" class=" col-md-3"><?php echo 'Place of Birth'; ?></label>
                        <div class=" col-md-9">
                            <?php
                            echo form_input(array(
                                "id" => "birth_place",
                                "name" => "birth_place",
                                "class" => "form-control",
                                "placeholder" => 'Place of Birth'
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="passport_no" class=" col-md-3"><?php echo 'Passport Number'; ?></label>
                        <div class="col-md-9">
                            <?php
                            echo form_input(array(
                                "id" => "passport_no",
                                "name" => "passport_no",
                                "class" => "form-control",
                                "placeholder" => 'Passport Number'
                            ));
                            ?>
                        </div>
                    </div>
                </div>
              
            </div>
                
            <div role="tabpanel" class="tab-pane" id="job-info-tab">
                
                    <div class="form-group">
                        <div class="row">
                            <label for="employee_type" class=" col-md-3"><?php echo 'Employee Type'; ?></label>
                            <div class=" col-md-9">
                                <?php
                                echo form_dropdown(array(
                                    "id" => "employee_type",
                                    "name" => "employee_type",
                                    "class" => "form-control select2",
                                    "placeholder" => 'Employee Type',
                                    "autocomplete" => "off"
                                ),['Fixed'=>'Fixed','Temporary'=>'Temporary','Internship'=>'Internship']);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="department_id" class=" col-md-3"><?php echo 'Employee Department'; ?></label>
                            <div class=" col-md-9">
                                <?php
                                echo form_dropdown(array(
                                    "id" => "department_id",
                                    "name" => "department_id",
                                    "class" => "form-control select2",
                                    "placeholder" => 'Employee Department',
                                    "autocomplete" => "off",
                                    "data-rule-required" => true,
                                    "data-msg-required" => app_lang("field_required"),
                                ),$departments);
                                ?>
                            </div>
                        </div>
                    </div>
 
                <div class="form-group">
                    <div class="row">
                        <label for="section_id" class=" col-md-3"><?php echo 'Department Section'; ?></label>
                        <div class=" col-md-9">
                            <?php
                            echo form_dropdown(array(
                                "id" => "section_id",
                                "name" => "section_id",
                                "class" => "form-control select2",
                                "placeholder" => 'Department Section',
                                "autocomplete" => "off",
                                "data-rule-required" => true,
                                "data-msg-required" => app_lang("field_required"),
                            ),$sections);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="job_title_en" class=" col-md-3"><?php echo 'Job Title English'; ?></label>
                        <div class=" col-md-9">
                            <?php
                            echo form_input(array(
                                "id" => "job_title_en",
                                "name" => "job_title_en",
                                "class" => "form-control",
                                "placeholder" => 'Job Title English',
                                "data-rule-required" => true,
                                "data-msg-required" => app_lang("field_required"),
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="job_title_so" class=" col-md-3"><?php echo 'Job Title Somali'; ?></label>
                        <div class=" col-md-9">
                            <?php
                            echo form_input(array(
                                "id" => "job_title_so",
                                "name" => "job_title_so",
                                "class" => "form-control",
                                "placeholder" => 'Job Title Somali',
                                "data-rule-required" => true,
                                "data-msg-required" => app_lang("field_required"),
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group "  style="display:none;">
                    <div class="row">
                        <label for="salary" class=" col-md-3"><?php echo app_lang('salary'); ?></label>
                        <div class=" col-md-9">
                            <?php
                            echo form_input(array(
                                "id" => "salary",
                                "name" => "salary",
                                "class" => "form-control",
                                "placeholder" => app_lang('salary')
                            ),'500',['style' => 'display:none']);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="display:none;">
                    <div class="row">
                        <label for="salary_term" class=" col-md-3"><?php echo app_lang('salary_term'); ?></label>
                        <div class=" col-md-9">
                            <?php
                            echo form_input(array(
                                "id" => "salary_term",
                                "name" => "salary_term",
                                "class" => "form-control",
                                "placeholder" => app_lang('salary_term')
                            ),'test',['style' => 'display:none']);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="date_of_hire" class=" col-md-3"><?php echo app_lang('date_of_hire'); ?></label>
                        <div class=" col-md-9">
                            <?php
                            echo form_input(array(
                                "id" => "date_of_hire",
                                "name" => "date_of_hire",
                                "class" => "form-control",
                                "placeholder" => app_lang('date_of_hire'),
                                "autocomplete" => "off"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <label for="employee_id" class=" col-md-3"><?php echo 'Employee Number'; ?></label>
                        <div class=" col-md-9">
                            <?php
                            echo form_input(array(
                                "id" => "employee_id",
                                "name" => "employee_id",
                                "class" => "form-control",
                                "placeholder" => 'eg. Employee Card Number',
                                "autocomplete" => "off"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

    </div>
</div>


<div class="modal-footer">
    <button class="btn btn-default" data-bs-dismiss="modal"><span data-feather="x" class="icon-16"></span> <?php echo app_lang('close'); ?></button>
    <button id="form-submit" type="button" class="btn btn-primary hide"><span data-feather="check-circle" class="icon-16"></span> <?php echo app_lang('save'); ?></button>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#team_member-form").appForm({
            onSuccess: function (result) {
                if (result.success) {
                    $("#team_member-table").appTable({newData: result.data, dataId: result.id});
                }
            },
            onSubmit: function () {
                $("#form-previous").attr('disabled', 'disabled');
            },
            onAjaxSuccess: function () {
                $("#form-previous").removeAttr('disabled');
            }
        });

        setTimeout(function () {
            $("#first_name").focus();
        }, 200);
        $("#team_member-form .select2").select2();

        setDatePicker("#date_of_hire");
        setDatePicker(".date_input");

        $("#form-submit").click(function () {
            $("#team_member-form").trigger('submit');
        });

      
    });
</script>