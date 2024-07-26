<table id="purchase-item-table" class="table display dataTable text-right strong table-responsive">
    <tr>
        <td><?php echo app_lang("sub_total"); ?></td>
        <td style="width: 120px;"><?php echo to_currency($purchase_total_summary->purchase_total, '$'); ?></td>
        <?php if ($can_edit_purchase) { ?>
            <td style="width: 100px;"> </td>
        <?php } ?>
    </tr>

  
</table>