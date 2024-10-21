<?php

namespace App\Models;

class Agreement_type_model extends Crud_model {

    protected $table = null;

    function __construct() {
        $this->table = 'agreement_type';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $agreement_type_table = $this->db->prefixTable('agreement_type');
        $notary_services_table = $this->db->prefixTable('notary_services');

        $where = "";
        $id = $this->_get_clean_value($options, "id");
        if ($id) {
            $where = " AND $agreement_type_table.id=$id";
        }

        $sql = "SELECT $agreement_type_table.*,
        $notary_services_table.service_name
        FROM $agreement_type_table
        LEFT JOIN $notary_services_table ON $notary_services_table.id = $agreement_type_table.service_id
        WHERE $agreement_type_table.deleted=0 $where";
        return $this->db->query($sql);
    }

}
