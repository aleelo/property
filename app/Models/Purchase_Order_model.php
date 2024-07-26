<?php

namespace App\Models;

class Purchase_Order_model extends Crud_model {

    protected $table = 'purchase_orders';

    function __construct() {
        $this->table = 'purchase_orders';
        parent::__construct($this->table);
    }

    
    function get_details($options = array()) {
        $purchase_order_table = $this->db->prefixTable('purchase_orders');
        $users_table = $this->db->prefixTable('users');
        $suppliers_table = $this->db->prefixTable('suppliers');
        $departments_table = 'departments';
        
        $where = "";
        
        $id = $this->_get_clean_value($options, "id");
        if ($id) {
            $where .= " AND $purchase_order_table.id=$id";
        }

        $status = $this->_get_clean_value($options, "status");
        if ($status) {
            $where .= " AND $purchase_order_table.status='$status'";
        }
        
        $start_date = $this->_get_clean_value($options, "start_date");        
        $end_date = $this->_get_clean_value($options, "end_date");
    
        if($start_date){
            $where .= " and $purchase_order_table.order_date between '$start_date' and '$end_date'";
        }


        $sql = "SELECT $purchase_order_table.*,$suppliers_table.supplier_name as supplier,$suppliers_table.address,$suppliers_table.contact_person,
        $suppliers_table.phone,$suppliers_table.email,$users_table.image as avatar,$departments_table.nameSo as department,
        concat($users_table.first_name,' ',$users_table.last_name) user
         FROM $purchase_order_table
        LEFT JOIN $users_table ON $purchase_order_table.ordered_by=$users_table.id
        LEFT JOIN $suppliers_table ON $purchase_order_table.supplier_id=$suppliers_table.id
        LEFT JOIN $departments_table ON $purchase_order_table.department_id=$departments_table.id
        WHERE $purchase_order_table.deleted=0 $where
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

    
    //update invoice status
    function update_order_status($invoice_id = 0, $status = "partial") {
        $status = $status ? $this->db->escapeString($status) : $status;
        $status_data = array("status" => $status);
        return $this->ci_save($status_data, $invoice_id);
    }

      
    function get_order_items_report($options = array()) {
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

        $department_id = $this->_get_clean_value($options, "department_id");
        if ($department_id) {
            $where .= " AND $purchase_order_table.department_id like '$department_id'";
        }        

        $ordered_by = $this->_get_clean_value($options, "ordered_by");
        if ($ordered_by) {
            $where .= " AND $purchase_order_table.ordered_by like '$ordered_by'";
        }
        

        $sql = "SELECT $purchase_order_items_table.*,$purchase_items_table.name FROM $purchase_order_items_table
                LEFT JOIN $purchase_items_table ON $purchase_items_table.id=$purchase_order_items_table.item_id
                LEFT JOIN $purchase_order_table ON $purchase_order_items_table.purchase_order_id=$purchase_order_table.id
                WHERE $purchase_order_items_table.deleted=0 $where
                ORDER BY $purchase_order_table.id DESC";
        
        return $this->db->query($sql);
    }

        
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

        return $result;
    }

    public function check_order_status($purchase_order_id){
        
        $purchase_receive_items_table = $this->db->prefixTable('purchase_receive_items');
        $purchase_order_items_table = $this->db->prefixTable('purchase_order_items');
        $purchase_order_table = $this->db->prefixTable('purchase_orders');
       
        // $result = $this->get_invoice_total_meta($purchase_order_id);

        $sql = "SELECT SUM(poi.total - pri.total) AS balance
        FROM $purchase_order_table as po
        LEFT JOIN $purchase_order_items_table as poi on po.id = poi.purchase_order_id
        LEFT JOIN $purchase_receive_items_table as pri on po.id = pri.purchase_order_id
        WHERE poi.deleted=0 AND pri.deleted=0 AND poi.purchase_order_id=$purchase_order_id";

        $result = $this->db->query($sql)->getRow();

        if($result->balance > 0){
            return $result->balance; // unpaid
        }else{
            return 0; // paid
        }

    }
 
}
