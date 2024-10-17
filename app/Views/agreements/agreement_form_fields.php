
<input type="hidden" name="id" value="<?php echo $model_info->id; ?>" />
<input type="hidden" name="ower_log_id" value="<?php echo $ower_log_id; ?>" />
<input type="hidden" name="view" value="<?php echo isset($view) ? $view : ""; ?>" />

<!----------------------------------------- Property  ------------------------------------>

<div class="form-group">
    <div class="row">
        <label for="property" class=" <?php echo $label_column; ?>"><?php echo 'Property'; ?></label>
        <div class=" col-md-9">
            <?php
            echo form_dropdown(array(
                "id" => "property",
                "name" => "property",
                "class" => "form-control select2",
                "placeholder" => 'Property',
                "autocomplete" => "off",
                'data-rule-required' => true,
                'data-msg-required' => app_lang('field_required'),
            ),$properties,[$model_info->property_id]);
            ?>
        </div>
    </div>
</div>

<!-----------------------------------------  Ref NO  ------------------------------------>


<div class="form-group">
    <div class="row">
        <label for="notary_ref" class="<?php echo $label_column; ?> company_name_section"><?php echo 'Notary Ref'; ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_input(array(
                "id" => "notary_ref",
                "name" => "notary_ref",
                "value" => $model_info->notary_ref,
                "class" => "form-control company_name_input_section",
                "placeholder" => 'Notary Ref',
                'data-rule-required' => true,
                'data-msg-required' =>   app_lang('field_required'),
            ));
            ?>
        </div>
    </div>
</div>

<!----------------------------------------- Buyer  ------------------------------------>

<div class="form-group" id="departments_section">
    <div class="row">
        <label for="buyer_ids" class=" <?php echo $label_column; ?>"><?php echo 'Buyer'; ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            
            echo form_dropdown(array(
                "id" => "buyer_ids",
                "name" => "buyer_ids[]",
                "class" => "form-control select2",
                "multiple" => "multiple",
                "placeholder" => ' -- choose buyer -- ',
                "autocomplete" => "off",
                'data-rule-required' => true,
                'data-msg-required' =>   app_lang('field_required'),
            ),$buyers,$model_info->buyer_ids ? explode(',', $model_info->buyer_ids) : []); // Handle multiple values
            ?>
        </div>
    </div>
</div>

<!----------------------------------------- Seller  ------------------------------------>

<div class="form-group" id="departments_section">
    <div class="row">
        <label for="seller_ids" class=" <?php echo $label_column; ?>"><?php echo 'seller'; ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            
            echo form_dropdown(array(
                "id" => "seller_ids",
                "name" => "seller_ids[]",
                "class" => "form-control select2",
                "multiple" => "multiple",
                "placeholder" => ' -- choose seller -- ',
                "autocomplete" => "off",
                'data-rule-required' => true,
                'data-msg-required' =>   app_lang('field_required'),
            ),$sellers,$model_info->seller_ids ? explode(',', $model_info->seller_ids) : []); // Handle multiple values
            ?>
        </div>
    </div>
</div>


<!----------------------------------------- Witness  ------------------------------------>

<div class="form-group" id="departments_section">
    <div class="row">
        <label for="witness_ids" class=" <?php echo $label_column; ?>"><?php echo 'Witness'; ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            
            echo form_dropdown(array(
                "id" => "witness_ids",
                "name" => "witness_ids[]",
                "class" => "form-control select2",
                "multiple" => "multiple",
                "placeholder" => ' -- choose seller -- ',
                "autocomplete" => "off",
                'data-rule-required' => true,
                'data-msg-required' =>   app_lang('field_required'),
            ),$witnesses,$model_info->witness_ids ? explode(',', $model_info->witness_ids) : []); // Handle multiple values
            ?>
        </div>
    </div>
</div>


<!----------------------------------------- Agreement Type  ------------------------------------>

<div class="form-group">
    <div class="row">
        <label for="agreement_type" class=" <?php echo $label_column; ?>"><?php echo 'Agreement Type'; ?></label>
        <div class=" col-md-9">
            <?php
            $agreement_type = [''=>' -- choose agreement type -- ','Sale'=>'Sale','Lease'=>'Lease','Transfer'=>'Transfer','Gift (Hibeyn)'=>'Gift (Hibeyn)'];
            echo form_dropdown(array(
                "id" => "agreement_type",
                "name" => "agreement_type",
                "class" => "form-control select2",
                "placeholder" => 'Agreement Type',
                "autocomplete" => "off",
                'data-rule-required' => true,
                'data-msg-required' =>   app_lang('field_required'),
            ),$agreement_type,[$model_info->agreement_type]);
            ?>
        </div>
    </div>
</div>



<!----------------------------------------- Amount  ------------------------------------>


<div class="form-group">
    <div class="row">
        <label for="amount" class="<?php echo $label_column; ?> company_name_section"><?php echo app_lang('amount'); ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
            echo form_input(array(
                "id" => "amount",
                "name" => "amount",
                "value" => $model_info->amount,
                "class" => "form-control company_name_input_section",
                "placeholder" => app_lang('amount'),
                'data-rule-required' => true,
                'data-msg-required' =>   app_lang('field_required'),
            ));
            ?>
        </div>
    </div>
</div>

<!----------------------------------------- Payment Method  ------------------------------------>


<div class="form-group">
    <div class="row">
        <label for="payment_method" class="<?php echo $label_column; ?> company_name_section"><?php echo app_lang('payment_method'); ?></label>
        <div class="<?php echo $field_column; ?>">
            <?php
                echo form_dropdown(array(
                    "id" => "payment_method",
                    "name" => "payment_method",
                    "class" => "form-control select2",
                    "placeholder" => 'Payment Method',
                    "autocomplete" => "off",
                    'data-rule-required' => true,
                    'data-msg-required' =>   app_lang('field_required'),
                ),$payment_method,[$model_info->payment_method]);
            ?>
        </div>
    </div>
</div>


<!----------------------------------------- Template  ------------------------------------>

<div class="form-group">
    <div class="row">
        <label for="template_id" class=" <?php echo $label_column; ?>"><?php echo 'Template'; ?></label>
        <div class=" col-md-9">
            <?php
            // $documents = [''=>' -- choose document -- ','Dhul Bannaan'=>'Dhul Bannaan','Dhul Dhisan'=>'Dhul Dhisan','Dhul Beereed'=>'Dhul Beereed'];
            echo form_dropdown(array(
                "id" => "template_id",
                "name" => "template_id",
                "class" => "form-control select2",
                "placeholder" => 'Template',
                "autocomplete" => "off",
                'data-rule-required' => true,
                'data-msg-required' =>   app_lang('field_required'),
            ),$documents,[$model_info->template_id]);
            ?>
        </div>
    </div>
</div>

<!----------------------------------------- Files  ------------------------------------>

<div class="form-group">
    <div class="col-md-12">
        <?php
        echo view("includes/file_list", array("files" => $model_info->files));
        ?>
    </div>
</div>

<?php echo view("includes/dropzone_preview"); ?>

<?php echo view("custom_fields/form/prepare_context_fields", array("custom_fields" => $custom_fields, "label_column" => $label_column, "field_column" => $field_column)); ?> 

<script type="text/javascript">
    var k=1;
    $(document).ready(function () {

      

        setDatePicker("#Start_Date")
        setDatePicker("#End_Date")
        
        $('[data-bs-toggle="tooltip"]').tooltip();

<?php if (isset($currency_dropdown)) { ?>
            if ($('#currency').length) {
                $('#currency').select2({data: <?php echo json_encode($currency_dropdown); ?>});
            }
<?php } ?>

<?php if (isset($groups_dropdown)) { ?>
            $("#group_ids").select2({
                multiple: true,
                data: <?php echo json_encode($groups_dropdown); ?>
            });
<?php } ?>

<?php if ($login_user->is_admin || get_array_value($login_user->permissions, "client") === "all") { ?>
            $('#created_by').select2({data: <?php echo $team_members_dropdown; ?>});
<?php } ?>

<?php if ($login_user->user_type === "staff") { ?>
            $("#client_labels").select2({multiple: true, data: <?php echo json_encode($label_suggestions); ?>});
<?php } ?>
        $('.account_type').click(function () {
            var inputValue = $(this).attr("value");
            if (inputValue === "person") {
                $(".company_name_section").html("Name");
                $(".company_name_input_section").attr("placeholder", "Name");
            } else {
                $(".company_name_section").html("Company name");
                $(".company_name_input_section").attr("placeholder", "Company name");
            }
        });

        $("#client-form .select2").select2();

    });
</script>