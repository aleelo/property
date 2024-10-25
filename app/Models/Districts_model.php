<?php

namespace App\Models;

class Districts_model extends Crud_model {

    protected $table = null;

    function __construct() {
        $this->table = 'districts';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $districts_table = $this->db->prefixTable('districts');

        $where = "";
        $id = $this->_get_clean_value($options, "id");
        if ($id) {
            $where = " AND $districts_table.id=$id";
        }

        $sql = "SELECT $districts_table.*
        FROM $districts_table
        WHERE $districts_table.deleted=0 $where";
        return $this->db->query($sql);
    }
    
    public function get_drop_list($region_id)
    {
        if (!is_numeric($region_id)) {
            log_message('error', 'Invalid region ID provided: ' . $region_id);
            return array();
        }

        // Define the SQL query with a placeholder for the region ID
        $sql = "SELECT id, district FROM rise_districts WHERE region_id = ?";
        
        // Execute the query
        $query = $this->db->query($sql, array($region_id));

        // Check if the query was successful and returned any rows
        if ($query && $query->getNumRows() > 0) {
            $result = $query->getResult();
            
            // Prepare the dropdown list in the key-value format
            $dropdown = array();
            foreach ($result as $row) {
                $dropdown[$row->id] = $row->district;
            }

            return $dropdown;
        } else {
            // Log an error if no rows are found or the query fails
            log_message('error', 'No districts found for region ID: ' . $region_id);
            return array();
        }
    }

}
