<?php

namespace App\Models;

class Documents_model extends Crud_model {

    protected $table = 'documents';

    function __construct() {
        $this->table = 'documents';
        parent::__construct($this->table);
    }

    
    function get_details($options = array()) {
        $documents_table = $this->db->prefixTable('documents');
        $templates_table = $this->db->prefixTable('templates');
        $departments_table = $this->db->prefixTable('departments');
        $users_table = $this->db->prefixTable('users');
        
        
        $role = get_array_value($options, 'role');
        $department_id = get_array_value($options, 'department_id');
        $created_by = get_array_value($options, 'created_by');

        $where = "";
        $id = $this->_get_clean_value($options, "id");
        if ($id) {
            $where .= " AND $documents_table.id=$id";
        }
        
        $uuid = $this->_get_clean_value($options, "uuid");
        if ($uuid) {
            $where .= " AND $documents_table.uuid=$uuid";
        }

        $name = $this->_get_clean_value($options, "name");
        if ($name) {
            $where .= " AND $documents_table.document_title = '$name'";
        }

        $ref_number = $this->_get_clean_value($options, "ref_number");
        if ($ref_number) {
            $where .= "  AND $documents_table.ref_number = '$ref_number'";
        }

        $item_id = $this->_get_clean_value($options, "item_id");
        if ($item_id) {
            $where .= "  AND $documents_table.item_id = '$item_id'";
        }

        
        $skip_s = $this->_get_clean_value($options, "skip");
        $offset_s = $skip_s ? $skip_s : 0;

        $limit_offset = "";
        $limit = $this->_get_clean_value($options, "limit");
        if ($limit) {
            $skip = $this->_get_clean_value($options, "skip");
            $offset = $skip ? $skip : 0;
            $limit_offset = " LIMIT $limit OFFSET $offset ";
        }
      
        $order_by = $this->_get_clean_value($options, "order_by");

        $order = "ORDER BY $documents_table.id";

        if ($order_by) {
            $order_dir = $this->_get_clean_value($options, "order_dir");
            $order = " ORDER BY $order_by $order_dir ";
        }

        $search_by = get_array_value($options,"search_by");

        if ($search_by) {
            $search_by = $this->db->escapeLikeString($search_by);

            // `document_title`, `ref_number`, `depertment`, `template`, `item_id`,`created_by`, `created_at`
            $where .= " AND (";
            $where .= " $documents_table.id LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR $documents_table.document_title LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR $documents_table.ref_number LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR $documents_table.depertment LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR $documents_table.template LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR $documents_table.item_id LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR $users_table.first_name LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR $users_table.last_name LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR $documents_table.created_at LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " )";
        } 

        $extraWhere = " AND $templates_table.destination_folder NOT LIKE 'Visitor' AND $templates_table.destination_folder NOT LIKE 'Leave'";
                
        $sql = "SELECT $documents_table.*,$templates_table.name as template,$departments_table.nameSo as depertment,$users_table.image created_by_image,
            $users_table.image checked_by_image,CONCAT($users_table.first_name,' ',$users_table.last_name) created_by_user,CONCAT($users_table.first_name,' ',$users_table.last_name) checked_by_user 
            FROM $documents_table 
            LEFT JOIN $templates_table  on $documents_table.template = $templates_table.id
            LEFT JOIN $departments_table on $documents_table.depertment = $departments_table.id
            LEFT JOIN $users_table ON $users_table.id = $documents_table.created_by
            LEFT JOIN $users_table ch ON ch.id = $documents_table.checked_by
            WHERE $documents_table.deleted=0 $where $extraWhere $order $limit_offset";
    

        $raw_query = $this->db->query($sql);

        $total_rows = $this->db->query("SELECT COUNT(*) as total_rows 
         FROM $documents_table 
            LEFT JOIN $templates_table  on $documents_table.template = $templates_table.id
            LEFT JOIN $departments_table on $documents_table.depertment = $departments_table.id
            LEFT JOIN $users_table ON $users_table.id = $documents_table.created_by
            WHERE $documents_table.deleted=0 $where $extraWhere ")->getRow();

        $found_rows = $this->db->query("SELECT COUNT(*) as found_rows 
             FROM $documents_table 
            LEFT JOIN $users_table ON $users_table.id = $documents_table.created_by
            LEFT JOIN $templates_table  on $documents_table.template = $templates_table.id
            LEFT JOIN $departments_table on $documents_table.depertment = $departments_table.id
            WHERE $documents_table.deleted=0 $where $extraWhere  $limit_offset")->getRow();

        // print_r($sql);
        // die;

        $total = empty($total_rows) ? 0 : $total_rows->total_rows;
        $found = empty($found_rows) ? 0 : $found_rows->found_rows;

        if($offset_s > 0){
            $found = $total;
        }

        if ($limit) {
            return array(
                "data" => $raw_query->getResult(),
                "recordsTotal" => $total,
                "recordsFiltered" => $found,
            );
        } else {
            return $raw_query;
        }
    }
}
