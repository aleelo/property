<?php

namespace App\Models;

class Notary_model extends Crud_model {

    protected $table = null;

    function __construct() {
        $this->table = 'notary';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $notary_table = $this->db->prefixTable('notary');

        $where = "";
        $id = $this->_get_clean_value($options, "id");
        if ($id) {
            $where = " AND $notary_table.id=$id";
        }

        $sql = "SELECT $notary_table.*
        FROM $notary_table
        WHERE $notary_table.deleted=0 $where";
        return $this->db->query($sql);
    }

}
