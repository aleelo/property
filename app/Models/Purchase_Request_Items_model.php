<?php

namespace App\Models;

class Purchase_Request_Items_model extends Crud_model {

    protected $table = 'purchase_request_items';

    function __construct() {
        $this->table = 'purchase_request_items';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $purchase_request_table = $this->db->prefixTable('purchase_requests');
        $users_table = $this->db->prefixTable('users');
        $purchase_items_table = $this->db->prefixTable('purchase_items');
        $purchase_request_items_table = $this->db->prefixTable('purchase_request_items');
        
        $where = "";
        $purchase_request_id = $this->_get_clean_value($options, "purchase_request_id");
        if ($purchase_request_id) {
            $where .= " AND $purchase_request_items_table.purchase_request_id=$purchase_request_id";
        }

        $item_id = $this->_get_clean_value($options, "item_id");
        if ($item_id) {
            $where .= " AND $purchase_request_items_table.item_id=$item_id";
        }
        

        $sql = "SELECT $purchase_request_items_table.* FROM $purchase_request_items_table
                LEFT JOIN $purchase_items_table ON $purchase_items_table.id=$purchase_request_items_table.item_id
                LEFT JOIN $purchase_request_table ON $purchase_request_items_table.purchase_request_id=$purchase_request_table.id
                WHERE $purchase_request_items_table.deleted=0 $where
                ORDER BY $purchase_request_table.id DESC";
        
        return $this->db->query($sql);
    }
    
    function get_request_items($options = array()) {
        $purchase_request_table = $this->db->prefixTable('purchase_requests');
        $users_table = $this->db->prefixTable('users');
        $purchase_items_table = $this->db->prefixTable('purchase_items');
        $purchase_request_items_table = $this->db->prefixTable('purchase_request_items');
        
        $where = "";
        $purchase_request_id = $this->_get_clean_value($options, "purchase_request_id");
        if ($purchase_request_id) {
            $where .= " AND $purchase_request_items_table.purchase_request_id=$purchase_request_id";
        }

        $item_id = $this->_get_clean_value($options, "item_id");
        if ($item_id) {
            $where .= " AND $purchase_request_items_table.item_id=$item_id";
        }
        

        $sql = "SELECT $purchase_request_items_table.* FROM $purchase_request_items_table
                LEFT JOIN $purchase_items_table ON $purchase_items_table.id=$purchase_request_items_table.item_id
                LEFT JOIN $purchase_request_table ON $purchase_request_items_table.purchase_request_id=$purchase_request_table.id
                WHERE $purchase_request_items_table.deleted=0 $where
                ORDER BY $purchase_request_table.id DESC";
        
        return $this->db->query($sql);
    }
    
    function get_item_suggestion($keyword = "", $user_type = "") {
        $items_table = $this->db->prefixTable('purchase_items');

        if ($keyword) {
            $keyword = $this->db->escapeLikeString($keyword);
        }
       
        $sql = "SELECT $items_table.id, $items_table.name
        FROM $items_table
        WHERE $items_table.deleted=0  AND $items_table.name LIKE '%$keyword%' ESCAPE '!' 
        LIMIT 10 
        ";
        return $this->db->query($sql)->getResult();
    }

    function get_item_info_suggestion($options = array()) {

        $items_table = $this->db->prefixTable('purchase_items');

        $where = "";
        $item_name = get_array_value($options, "item_name");
        if ($item_name) {
            $item_name = $this->db->escapeLikeString($item_name);
            $where .= " AND $items_table.name LIKE '%$item_name%' ESCAPE '!'";
        }

        $item_id = $this->_get_clean_value($options, "item_id");
        if ($item_id) {
            $where .= " AND $items_table.id=$item_id";
        }    

        $sql = "SELECT $items_table.*
        FROM $items_table
        WHERE $items_table.deleted=0 $where
        ORDER BY id DESC LIMIT 1
        ";

        $result = $this->db->query($sql);

        if ($result->resultID->num_rows) {
            return $result->getRow();
        }
    }

    function save_item_and_update_invoice($data, $id, $invoice_id) {
        $result = $this->ci_save($data, $id);

        $invoices_model = model("App\Models\Invoices_model");
        $invoices_model->update_invoice_total_meta($invoice_id);

        return $result;
    }

    function delete_item_and_update_invoice($id, $undo = false) {
        $item_info = $this->get_one($id);

        $result = $this->delete($id, $undo);

        $invoices_model = model("App\Models\Invoices_model");
        $invoices_model->update_invoice_total_meta($item_info->invoice_id);

        return $result;
    }
    
    
    function get_purchase_total_summary($purchase_request_id) {
        $purchase_request_items_table = $this->db->prefixTable('purchase_request_items');
        $purchase_request_table = $this->db->prefixTable('purchase_requests');
       
        // $result = $this->get_invoice_total_meta($purchase_request_id);

        $sql = "SELECT SUM(poi.total) AS purchase_total
        FROM $purchase_request_table as pr
        LEFT JOIN $purchase_request_items_table as poi on pr.id = poi.purchase_request_id
        WHERE poi.deleted=0 AND pr.deleted=0 AND poi.purchase_request_id=$purchase_request_id";

        $result = $this->db->query($sql)->getRow();

        // $result->total_paid = is_null($payment->total_paid) ? 0 : $payment->total_paid;
        // $result->balance_due = number_format($result->invoice_total, 2, ".", "") - number_format($result->total_paid, 2, ".", "");

        return $result;
    }

}
