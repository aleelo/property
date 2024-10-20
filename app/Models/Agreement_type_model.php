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

    public function get_drop_list($service_id)
    {
        // Validate service ID to prevent SQL injection or invalid values
        if (!is_numeric($service_id)) {
            log_message('error', 'Invalid service ID provided: ' . $service_id);
            return array();
        }
    
        // Define the SQL query with a placeholder for the service_id
        $sql = "SELECT id, agreement_type FROM rise_agreement_type WHERE service_id = ? and deleted = 0";
        
        // Execute the query
        $query = $this->db->query($sql, array($service_id));
    
        // Check if the query was successful and returned any rows
        if ($query && $query->getNumRows() > 0) {
            $result = $query->getResult();
            
            // Prepare the dropdown list in the key-value format
            $dropdown = array();
            foreach ($result as $row) {
                $dropdown[$row->id] = $row->agreement_type;
            }
    
            // Debug log for checking the output format
            log_message('debug', 'Dropdown list: ' . print_r($dropdown, true));
    
            return $dropdown;
        } else {
            // Log an error if no rows are found or the query fails
            log_message('error', 'Query failed or no rows found for service_id: ' . $service_id);
            return array();
        }
    }
    



}
