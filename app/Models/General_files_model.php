<?php

namespace App\Models;

class General_files_model extends Crud_model {

    protected $table = null;

    function __construct() {
        $this->table = 'general_files';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $general_files_table = $this->db->prefixTable('general_files');
        $users_table = $this->db->prefixTable('users');
        $where = "";
        $id = $this->_get_clean_value($options, "id");
        if ($id) {
            $where = " AND $general_files_table.id=$id";
        }

        $client_id = $this->_get_clean_value($options, "client_id");
        if ($client_id) {
            $where = " AND $general_files_table.client_id=$client_id";
        }

        $property_id = $this->_get_clean_value($options, "property_id");
        if ($property_id) {
            $where = " AND $general_files_table.property_id=$property_id";
        }

        $agreement_id = $this->_get_clean_value($options, "agreement_id");
        if ($agreement_id) {
            $where = " AND $general_files_table.agreement_id=$agreement_id";
        }

        $user_id = $this->_get_clean_value($options, "user_id");
        if ($user_id) {
            $where = " AND $general_files_table.user_id = $user_id";
        }


        $sql = "SELECT $general_files_table.*, CONCAT($users_table.first_name, ' ', $users_table.last_name) AS uploaded_by_user_name, $users_table.image AS uploaded_by_user_image, $users_table.user_type AS uploaded_by_user_type
        FROM $general_files_table
        LEFT JOIN $users_table ON $users_table.id= $general_files_table.uploaded_by
        WHERE $general_files_table.deleted=0 $where";
        return $this->db->query($sql);
    }

}
