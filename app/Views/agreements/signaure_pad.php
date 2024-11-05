<?php echo form_open(get_uri("appointments/update_status"), array("id" => "client-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <div class="container-fluid">
        <input type="hidden" name="ticket_id" value="<?php echo $ticket_id; ?>" />
        <?php echo view("agreements/signaure_pad_field"); ?>

    </div>
</div>

<div class="modal-footer">
    <div id="link-of-add-contact-modal" class="hide">
        <?php echo modal_anchor(get_uri("appointments/add_new_contact_modal_form"), "", array()); ?>
    </div>

    <button type="button" class="btn btn-default" data-bs-dismiss="modal"><span data-feather="x" class="icon-16"></span> <?php echo 'Close'; ?></button>
    <button type="button" id="clear-signature" class="btn btn-default" ><span data-feather="x" class="icon-16"></span> <?php echo 'Clear'; ?></button>
    <button type="submit" id="save-signature" class="btn btn-primary"><span data-feather="check-circle" class="icon-16"></span> <?php echo 'Save & Sign'; ?></button>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function () {
        
        var ticket_id = "<?php echo $ticket_id; ?>";

        window.clientForm = $("#client-form").appForm({
            closeModalOnSuccess: false,
            onSuccess: function (result) {
                var $addMultipleContactsLink = $("#link-of-add-contact-modal").find("a");

                if (result.view === "details" || ticket_id) {
                    if (window.showAddNewModal) {
                        $addMultipleContactsLink.attr("data-post-client_id", result.id);
                        $addMultipleContactsLink.attr("data-title", "<?php echo app_lang('add_multiple_contacts') ?>");
                        $addMultipleContactsLink.attr("data-post-add_type", "multiple");

                        $addMultipleContactsLink.trigger("click");
                    } else {
                        appAlert.success(result.message, {duration: 10000});
                        setTimeout(function () {
                            location.reload();
                        }, 500);
                    }
                } else if (window.showAddNewModal) {
                    $addMultipleContactsLink.attr("data-post-client_id", result.id);
                    $addMultipleContactsLink.attr("data-title", "<?php echo app_lang('add_multiple_contacts') ?>");
                    $addMultipleContactsLink.attr("data-post-add_type", "multiple");

                    $addMultipleContactsLink.trigger("click");

                    $("#client-table").appTable({newData: result.data, dataId: result.id});
                } else {
                    $("#client-table").appTable({newData: result.data, dataId: result.id});
                    window.clientForm.closeModal();
                }
                location.reload();
            }
        });
        // setTimeout(function () {
        //     $("#company_name").focus();
        // }, 200);

        //save and open add new contact member modal
        window.showAddNewModal = false;

        $("#save-and-continue-button").click(function () {
            window.showAddNewModal = true;
            $(this).trigger("submit");
        });


        // ---------------------------- Signature Pad ------------------------ //

            const canvas = document.getElementById('signature-canvas');
            const ctx = canvas.getContext('2d');
            let painting = false;

            // Function to clear the canvas
            function clearCanvas() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.beginPath(); // Ensure no artifacts remain
            }

            // Clear canvas button event
            $('#clear-signature').on('click', function () {
                clearCanvas();
                console.log('Canvas cleared'); // Debugging to confirm the button works
            });

            // Functions to handle the drawing
            function startPosition(e) {
                painting = true;
                draw(e);
            }

            function endPosition() {
                painting = false;
                ctx.beginPath();
            }

            function draw(e) {
                if (!painting) return;
                ctx.lineWidth = 2;
                ctx.lineCap = 'round';
                ctx.strokeStyle = 'black';

                const rect = canvas.getBoundingClientRect();
                ctx.lineTo(e.clientX - rect.left, e.clientY - rect.top);
                ctx.stroke();
                ctx.beginPath();
                ctx.moveTo(e.clientX - rect.left, e.clientY - rect.top);
            }

            // Mouse events
            canvas.addEventListener('mousedown', startPosition);
            canvas.addEventListener('mouseup', endPosition);
            canvas.addEventListener('mousemove', draw);

            // Clear canvas button
            document.getElementById('clear').addEventListener('click', function () {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
            });

            // Save canvas as PNG button
            document.getElementById('save').addEventListener('click', function () {
                const dataURL = canvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.href = dataURL;
                link.download = 'signature.png';
                link.click();
            });

            $('#clear-signature').on('click', function () {
                console.log('Clear button clicked'); // Add this for debugging
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.beginPath(); // Ensure no artifacts remain
            });


            $('#save-signature').on('click', function () {
                const dataURL = canvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.href = dataURL;
                link.download = 'signature.png';
                link.click();
            });

        // ---------------------------------------------------------- //

    });
</script>    