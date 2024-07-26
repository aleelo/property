<?php

namespace App\Models;

class Purchase_Receive_model extends Crud_model {

    protected $table = 'purchase_receives';

    function __construct() {
        $this->table = 'purchase_receives';
        parent::__construct($this->table);
    }

    
    
    function get_details($options = array()) {
        $purchase_receive_table = $this->db->prefixTable('purchase_receives');
        $users_table = $this->db->prefixTable('users');
        $suppliers_table = $this->db->prefixTable('suppliers');
        $departments_table = 'departments';
        
        $where = "";
        $id = $this->_get_clean_value($options, "id");
        if ($id) {
            $where .= " AND $purchase_receive_table.id=$id";
        }

        $created_by = $this->_get_clean_value($options, "created_by");
        if ($created_by) {
            $where .= " AND $purchase_receive_table.received_by like '$created_by'";
        }

        $department_id = $this->_get_clean_value($options, "department_id");
        if ($department_id) {
            $where .= " AND $purchase_receive_table.department_id like '$department_id'";
        }
        
        $start_date = $this->_get_clean_value($options, "start_date");        
        $end_date = $this->_get_clean_value($options, "end_date");
    
        if($start_date){
            $where .= " and $purchase_receive_table.receive_date between '$start_date' and '$end_date'";
        }

        
        $limit_offset = "";
        $limit = $this->_get_clean_value($options, "limit");
        if ($limit) {
            $skip = $this->_get_clean_value($options, "skip");
            $offset = $skip ? $skip : 0;
            $limit_offset = " LIMIT $limit ";
        }

        $available_order_by_list = array(
            "first_name" => $users_table . ".first_name",
            "product_type" => $purchase_receive_table . ".product_type",
            "receive_date" => $purchase_receive_table . ".receive_date",
            "suppliers_table" => $suppliers_table . ".supplier_name"
        );

        $order_by = get_array_value($available_order_by_list, $this->_get_clean_value($options, "order_by"));

        $order = "ORDER BY $users_table.id";

        if ($order_by) {
            $order_dir = $this->_get_clean_value($options, "order_dir");
            $order = " ORDER BY $order_by $order_dir ";
        }else{
            $order ="ORDER BY $purchase_receive_table.id DESC";
        }

        $search_by = get_array_value($options, "search_by");
        if ($search_by) {
            $search_by = $this->db->escapeLikeString($search_by);

            $where .= " AND (";
            $where .= " $purchase_receive_table.product_type LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR $purchase_receive_table.receive_date LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR $purchase_receive_table.quantity LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR $suppliers_table.supplier_name LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR CONCAT($users_table.first_name, ' ', $users_table.last_name) LIKE '%$search_by%' ESCAPE '!' ";
            $where .= $this->get_custom_field_search_query($users_table, "client_contacts", $search_by);
            $where .= " )";
        }


        $sql = "SELECT SQL_CALC_FOUND_ROWS $purchase_receive_table.*,$suppliers_table.supplier_name as supplier,$suppliers_table.id as supplier_id,$suppliers_table.address,$suppliers_table.contact_person,
                $suppliers_table.phone,$suppliers_table.email,$users_table.image as avatar,$departments_table.nameSo as department,
                concat($users_table.first_name,' ',$users_table.last_name) user
                FROM $purchase_receive_table
                LEFT JOIN $users_table ON $purchase_receive_table.received_by=$users_table.id
                LEFT JOIN $suppliers_table ON $purchase_receive_table.supplier=$suppliers_table.id
                LEFT JOIN $departments_table ON $purchase_receive_table.department_id=$departments_table.id
                WHERE $purchase_receive_table.deleted=0 $where  $order $limit_offset";

        // print_r($sql);die;  
        $raw_query = $this->db->query($sql);

        $total_rows = $this->db->query("SELECT FOUND_ROWS() as found_rows")->getRow();

        if ($limit) {
            // die($limit);
            return array(
                "data" => $raw_query->getResult(),
                "recordsTotal" => $total_rows->found_rows,
                "recordsFiltered" => $total_rows->found_rows,
            );
        } else {
            return $raw_query;
        }
    }

    
    function get_receive_items($options = array()) {
        $purchase_receive_table = $this->db->prefixTable('purchase_receives');
        $users_table = $this->db->prefixTable('users');
        $purchase_items_table = $this->db->prefixTable('purchase_items');
        $purchase_order_items_table = $this->db->prefixTable('purchase_order_items');
        $purchase_receive_items_table = $this->db->prefixTable('purchase_receive_items');
        
        $where = "";
        $purchase_order_id = $this->_get_clean_value($options, "purchase_order_id");
        if ($purchase_order_id) {
            $where .= " AND $purchase_receive_items_table.purchase_order_id=$purchase_order_id";
        }

        $item_id = $this->_get_clean_value($options, "item_id");
        if ($item_id) {
            $where .= " AND $purchase_receive_items_table.item_id=$item_id";
        }
        

        $sql = "SELECT $purchase_receive_items_table.* FROM $purchase_receive_items_table
                LEFT JOIN $purchase_items_table ON $purchase_items_table.id=$purchase_receive_items_table.item_id
                LEFT JOIN $purchase_receive_table ON $purchase_receive_items_table.purchase_order_id=$purchase_receive_table.id
                WHERE $purchase_receive_items_table.deleted=0 $where
                ORDER BY $purchase_receive_table.id DESC";
        
        return $this->db->query($sql);
    }


}
