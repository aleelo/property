<?php

namespace App\Models;

class Notary_services_model extends Crud_model {

    protected $table = null;

    function __construct() {
        $this->table = 'notary_services';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $notary_services_table = $this->db->prefixTable('notary_services');

        $where = "";
        $id = $this->_get_clean_value($options, "id");
        if ($id) {
            $where = " AND $notary_services_table.id=$id";
        }

        $sql = "SELECT $notary_services_table.*
        FROM $notary_services_table
        WHERE $notary_services_table.deleted=0 $where";
        return $this->db->query($sql);
    }

}
