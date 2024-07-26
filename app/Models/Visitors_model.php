<?php

namespace App\Models;

class Visitors_model extends Crud_model {

    protected $table = 'visitors';

    function __construct() {
        $this->table = 'visitors';
        parent::__construct($this->table);
    }

    function count_visitors_status($options = array()){
        $visitors_table = $this->db->prefixTable('visitors');
        $user_id = get_array_value($options,'user_id');
        $role = get_array_value($options,'role');
        $where = "";

        if($role && in_array($role,['admin','Administrator','Access Controll'])){
            $user_id = "%";
        }

        if($user_id){
            $where.= " AND created_by like '$user_id'";
        }

        $pending_status = $this->db->query("SELECT COUNT(*) as pending FROM $visitors_table WHERE status = 'Pending' $where ")->getRow();
        $approved_status = $this->db->query("SELECT COUNT(*) as approved FROM $visitors_table WHERE status = 'Approved' $where ")->getRow();
        $rejected_status = $this->db->query("SELECT COUNT(*) as rejected FROM $visitors_table WHERE status = 'Rejected' $where ")->getRow();

        $total_status = $this->db->query("SELECT COUNT(*) as total FROM $visitors_table WHERE status = 'Approved' or status = 'Pending' $where ")->getRow();

        $info = new \stdClass();
        $info->pending = $pending_status->pending;
        $info->approved = $approved_status->approved;
        $info->rejected = $rejected_status->rejected;

        $info->total = $total_status->total;

        return $info;

    }
}
