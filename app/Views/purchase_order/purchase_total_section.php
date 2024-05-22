<table id="purchase-item-table" class="table display dataTable text-right strong table-responsive">
    <tr>
        <td><?php echo app_lang("sub_total"); ?></td>
        <td style="width: 120px;"><?php echo to_currency($purchase_total_summary->purchase_total, '$'); ?></td>
        <?php if ($can_edit_purchase) { ?>
            <td style="width: 100px;"> </td>
        <?php } ?>
    </tr>

    <?php if ($purchase_total_summary->receive_total) { ?>
        <tr>
            <td><?php echo app_lang("total_received"); ?></td>
            <td><?php echo to_currency($purchase_total_summary->receive_total, '$'); ?></td>
            <?php if ($can_edit_purchase) { ?>
                <td></td>
            <?php } ?>
        </tr>
    <?php } ?>
    <tr>
        <td><?php echo app_lang("balance"); ?></td>
        <td><?php echo to_currency($purchase_total_summary->balance, '$'); ?></td>
        <?php if ($can_edit_purchase) { ?>
            <td></td>
        <?php } ?>
    </tr>
</table>