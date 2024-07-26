<?php

namespace App\Models;

class Purchase_Order_Items_model extends Crud_model {

    protected $table = 'purchase_order_items';

    function __construct() {
        $this->table = 'purchase_order_items';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $purchase_order_table = $this->db->prefixTable('purchase_orders');
        $users_table = $this->db->prefixTable('users');
        $purchase_items_table = $this->db->prefixTable('purchase_items');
        $purchase_order_items_table = $this->db->prefixTable('purchase_order_items');
        
        $where = "";
        $purchase_order_id = $this->_get_clean_value($options, "purchase_order_id");
        if ($purchase_order_id) {
            $where .= " AND $purchase_order_items_table.purchase_order_id=$purchase_order_id";
        }

        $item_id = $this->_get_clean_value($options, "item_id");
        if ($item_id) {
            $where .= " AND $purchase_order_items_table.item_id=$item_id";
        }
        

        $sql = "SELECT $purchase_order_items_table.* FROM $purchase_order_items_table
                LEFT JOIN $purchase_items_table ON $purchase_items_table.id=$purchase_order_items_table.item_id
                LEFT JOIN $purchase_order_table ON $purchase_order_items_table.purchase_order_id=$purchase_order_table.id
                WHERE $purchase_order_items_table.deleted=0 $where
                ORDER BY $purchase_order_table.id DESC";
        
        return $this->db->query($sql);
    }
    
    
    function get_order_items($options = array()) {
        $purchase_order_table = $this->db->prefixTable('purchase_orders');
        $users_table = $this->db->prefixTable('users');
        $purchase_items_table = $this->db->prefixTable('purchase_items');
        $purchase_order_items_table = $this->db->prefixTable('purchase_order_items');
        $purchase_receive_items_table = $this->db->prefixTable('purchase_receive_items');
        
        $where = "";
        $purchase_order_id = $this->_get_clean_value($options, "purchase_order_id");
        if ($purchase_order_id) {
            $where .= " AND $purchase_order_items_table.purchase_order_id=$purchase_order_id";
        }

        $item_id = $this->_get_clean_value($options, "item_id");
        if ($item_id) {
            $where .= " AND $purchase_order_items_table.item_id=$item_id";
        }

        $all = $this->_get_clean_value($options, "all");
        if (!$all) {
            $where .= " AND $purchase_items_table.id not in (select item_id from $purchase_receive_items_table where $purchase_receive_items_table.purchase_order_id=$purchase_order_id)";
        }
        

        $sql = "SELECT $purchase_order_items_table.* FROM $purchase_order_items_table
                LEFT JOIN $purchase_items_table ON $purchase_items_table.id=$purchase_order_items_table.item_id
                LEFT JOIN $purchase_order_table ON $purchase_order_items_table.purchase_order_id=$purchase_order_table.id
                WHERE $purchase_order_items_table.deleted=0  $where
                ORDER BY $purchase_order_table.id DESC";
                // die($sql);
        
        return $this->db->query($sql);
    }    
    
    function get_item_details($options = array()) {
        $purchase_order_table = $this->db->prefixTable('purchase_orders');
        $purchase_items_table = $this->db->prefixTable('purchase_items');
        $purchase_order_items_table = $this->db->prefixTable('purchase_order_items');
        $purchase_receive_items_table = $this->db->prefixTable('purchase_receive_items');
        
        $where = "";
        $purchase_order_id = $this->_get_clean_value($options, "purchase_order_id");
       
        $item_id = $this->_get_clean_value($options, "item_id");
                     
        $sql1 = "SELECT SUM($purchase_order_items_table.total) as orderTotal,$purchase_order_items_table.quantity as orderQty FROM $purchase_order_items_table
                LEFT JOIN $purchase_items_table ON $purchase_items_table.id=$purchase_order_items_table.item_id
                LEFT JOIN $purchase_order_table ON $purchase_order_items_table.purchase_order_id=$purchase_order_table.id
                WHERE $purchase_items_table.deleted=0 AND $purchase_items_table.id = $item_id AND $purchase_order_items_table.purchase_order_id=$purchase_order_id";
        $result1 = $this->query($sql1)->getRow();
        
        $sql2 = "SELECT SUM($purchase_receive_items_table.total) as receiveTotal,$purchase_receive_items_table.quantity as receiveQty FROM $purchase_receive_items_table
                LEFT JOIN $purchase_items_table ON $purchase_items_table.id=$purchase_receive_items_table.item_id
                LEFT JOIN $purchase_order_table ON $purchase_receive_items_table.purchase_order_id=$purchase_order_table.id
                WHERE $purchase_items_table.deleted=0 AND $purchase_items_table.id = $item_id AND $purchase_receive_items_table.purchase_order_id=$purchase_order_id";
        
                // die($sql1.'--- sql2: --- '.$sql2);
        $result2 = $this->query($sql2)->getRow();

        $orderTotal = $result1->orderTotal;
        $orderQty = $result1->orderQty;

        $receiveTotal = $result2->receiveTotal;
        $receiveQty = $result2->receiveQty;

        $result = new \stdClass();

        if(empty($receiveQty) && empty($receiveTotal)){
            
            $remainder_for_receive = '-';
        }else if(empty($receiveQty) && !empty($receiveTotal)){

            $remainder_for_receive = 0;
        }
        else{

            $remainder_for_receive = $orderQty - $receiveQty;
        }

        $balance = empty($receiveTotal) ? 0 : $orderTotal - $receiveTotal;   

        $result->orderTotal = $orderTotal;
        $result->orderQty = $orderQty;

        $result->receiveTotal = $receiveTotal;
        $result->receiveQty = $receiveQty;

        $result->balance = $balance;    
        $result->remainder = $remainder_for_receive;    
        
        return $result;
    }

    function get_order_item_qty($options = array()){

        $purchase_order_table = $this->db->prefixTable('purchase_orders');
        $purchase_items_table = $this->db->prefixTable('purchase_items');
        $purchase_order_items_table = $this->db->prefixTable('purchase_order_items');
        $purchase_receive_items_table = $this->db->prefixTable('purchase_receive_items');
        
        $purchase_order_id = $this->_get_clean_value($options, "purchase_order_id");       
        $item_id = $this->_get_clean_value($options, "item_id");

        $sql = "SELECT $purchase_order_items_table.quantity-$purchase_receive_items_table.quantity as remainder_for_receive FROM $purchase_order_items_table
                LEFT JOIN $purchase_items_table ON $purchase_items_table.id=$purchase_order_items_table.item_id
                LEFT JOIN $purchase_order_table ON $purchase_order_items_table.purchase_order_id=$purchase_order_table.id
                LEFT JOIN $purchase_receive_items_table ON $purchase_receive_items_table.purchase_order_id=$purchase_order_table.id
                WHERE $purchase_items_table.deleted=0 AND $purchase_items_table.id = $item_id AND $purchase_order_items_table.purchase_order_id=$purchase_order_id";
                // die($sql);
        $result = $this->query($sql)->getRow();

        return $result->remainder_for_receive;
    }

    function get_item_available_qty($options=array()){
      
        $purchase_items_table = $this->db->prefixTable('purchase_items');
        $purchase_order_items_table = $this->db->prefixTable('purchase_order_items');
           
        $item_id = $this->_get_clean_value($options, "item_id");

        $sql = "SELECT $purchase_items_table.quantity - $purchase_order_items_table.quantity as availableQty FROM $purchase_order_items_table
                LEFT JOIN $purchase_items_table ON $purchase_items_table.id=$purchase_order_items_table.item_id
                WHERE $purchase_items_table.deleted=0 AND $purchase_items_table.id = $item_id ";
                // die($sql);
        $result = $this->query($sql)->getRow();

        return $result->availableQty;
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
    
    
    // function get_purchase_total_summary($purchase_order_id) {
    //     $purchase_receive_items_table = $this->db->prefixTable('purchase_receive_items');
    //     $purchase_order_items_table = $this->db->prefixTable('purchase_order_items');
    //     $purchase_order_table = $this->db->prefixTable('purchase_orders');
       
    //     // $result = $this->get_invoice_total_meta($purchase_order_id);

    //     $sql = "SELECT SUM(poi.total) AS purchase_total,SUM(pr.total) AS receive_total,SUM(poi.total - pr.total) AS balance
    //     FROM $purchase_order_table as po
    //     LEFT JOIN $purchase_order_items_table as poi on po.id = poi.purchase_order_id
    //     LEFT JOIN $purchase_receive_items_table as pr on po.id = pr.purchase_order_id
    //     WHERE poi.deleted=0 AND pr.deleted=0 AND poi.purchase_order_id=$purchase_order_id";

    //     $result = $this->db->query($sql)->getRow();

    //     // $result->total_paid = is_null($payment->total_paid) ? 0 : $payment->total_paid;
    //     // $result->balance_due = number_format($result->invoice_total, 2, ".", "") - number_format($result->total_paid, 2, ".", "");

    //     return $result;
    // }

       
    function get_purchase_total_summary($purchase_order_id) {
        $purchase_receive_items_table = $this->db->prefixTable('purchase_receive_items');
        $purchase_order_items_table = $this->db->prefixTable('purchase_order_items');
        $purchase_order_table = $this->db->prefixTable('purchase_orders');
       
        // $result = $this->get_invoice_total_meta($purchase_order_id);

        $sql1 = "SELECT SUM(poi.total) AS purchase_total
        FROM $purchase_order_items_table as poi
        LEFT JOIN $purchase_order_table as po on po.id = poi.purchase_order_id
        WHERE poi.deleted=0 AND po.deleted=0 AND poi.purchase_order_id=$purchase_order_id";

        $result1= $this->db->query($sql1)->getRow();
        $purchase_total = $result1->purchase_total;

        $sql2 = "SELECT SUM(pri.total) AS receive_total
        FROM $purchase_receive_items_table as pri
        LEFT JOIN $purchase_order_table as po on po.id = pri.purchase_order_id
        WHERE pri.deleted=0 AND po.deleted=0 AND pri.purchase_order_id=$purchase_order_id";

        $result2= $this->db->query($sql2)->getRow();
        $receive_total = $result2->receive_total;

        $balance = $purchase_total - $receive_total;
        
        if ($balance == $purchase_total){
            $balance = 0;
        }

        // print_r($purchase_total);
        // print_r('bal: '.$balance);
        // print_r($receive_total);
        // die($sql2);

        $result = new \stdClass();
        $result->purchase_total = $purchase_total;
        $result->receive_total = $receive_total;
        $result->balance = $balance;

        // print_r($result);die;

        // $result->total_paid = is_null($payment->total_paid) ? 0 : $payment->total_paid;
        // $result->balance_due = number_format($result->invoice_total, 2, ".", "") - number_format($result->total_paid, 2, ".", "");

        return $result;
    }

}
