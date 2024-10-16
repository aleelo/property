<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo view('includes/head'); ?>
    </head>
    <body>

    <div class=" d-flex justify-content-center">
        <div class="card col-md-5 col-xs-12 mt-3 shadow-lg">
            <div class="card-title text-center"><h4 class="fw-bold">Document Information #<?php echo $agreement->id; ?></h4></div>
                
            <div class="modal-body">
                <div class="row">
                    <!-- `client_type`, `access_duration`, `image`, `name`, `created_by`, `visit_date`, `visit_time`, `created_at`, `deleted`, `remarks`, `status` -->
                    <div class="table-responsive mb15">
                        <table class="table dataTable display b-t">
                            <tr>
                                <th class=""> <?php echo 'Title Deed NO'; ?></th>
                                <td><?php echo $agreement->titleDeedNo; ?></td>
                            </tr>
                            <tr>
                                <th class=""> <?php echo 'Buyer'; ?></th>
                                <td><?php echo $agreement->buyer; ?></td>
                            </tr>
                            <tr>
                                <th class=""> <?php echo 'Seller'; ?></th>
                                <td><?php echo $agreement->seller; ?></td>
                            </tr>
                            <tr>
                                <th class=""> <?php echo 'Witness'; ?></th>
                                <td><?php echo $agreement->witness; ?></td>
                            </tr>
                            <tr>
                                <th class=""> <?php echo 'Ref Number'; ?></th>
                                <td><?php echo $agreement->ref_number; ?></td>
                            </tr>
                            <tr>
                                <th class=""> <?php echo app_lang('created_at'); ?></th>
                                <td><?php echo $created_at_meta; ?></td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function () {

        $('#js-init-chat-icon').hide();

        });
        
    </script>    
    </body>
</html>