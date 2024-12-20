<?php

namespace App\Models;

class Leave_applications_model extends Crud_model {

    protected $table = null;

    function __construct() {
        $this->table = 'leave_applications';
        parent::__construct($this->table);
    }

    function get_details_info($id = 0) {
        $leave_applications_table = $this->db->prefixTable('leave_applications');
        $users_table = $this->db->prefixTable('users');
        $leave_types_table = $this->db->prefixTable('leave_types');

        $sql = "SELECT $leave_applications_table.*, 
                CONCAT(applicant_table.first_name, ' ',applicant_table.last_name) AS applicant_name, applicant_table.image as applicant_avatar, applicant_table.job_title,
                CONCAT(checker_table.first_name, ' ',checker_table.last_name) AS checker_name, checker_table.image as checker_avatar,
                $leave_types_table.title as leave_type_title,   $leave_types_table.color as leave_type_color
            FROM $leave_applications_table
            LEFT JOIN $users_table AS applicant_table ON applicant_table.id= $leave_applications_table.applicant_id
            LEFT JOIN $users_table AS checker_table ON checker_table.id= $leave_applications_table.checked_by
            LEFT JOIN $leave_types_table ON $leave_types_table.id= $leave_applications_table.leave_type_id        
            WHERE $leave_applications_table.deleted=0 AND $leave_applications_table.id=$id";
        return $this->db->query($sql)->getRow();
    }

    function get_list($options = array()) {
        $leave_applications_table = $this->db->prefixTable('leave_applications');
        $users_table = $this->db->prefixTable('users');
        $leave_types_table = $this->db->prefixTable('leave_types');
        $where = "";
        $id = $this->_get_clean_value($options, "id");
        if ($id) {
            $where = " AND $leave_applications_table.id=$id";
        }


        //role and user info:
        $Users_model = model("App\Models\Users_model");
       $role = $Users_model->get_user_role();
       $user = $Users_model->get_access_info($Users_model->login_user_id());

        // die($role);
        $d = $this->db->query("SELECT t.department_id from rise_team_member_job_info t left join rise_users u on u.id=t.user_id where t.user_id = $user->id")->getRow();
        $department_id = $d?->department_id;
        $created_by = $user->id;

        if($role == 'Employee'){
            $created_by = $user->id;
        }elseif($role == 'Director' || $role == 'Secretary'){
            $created_by = '%';
        }elseif($role == 'HRM' || $role == 'Admin' || $role == 'Administrator'){
            $created_by = '%';
            $department_id = '%';
        }

        $status = $this->_get_clean_value($options, "status");
        $view_type = get_array_value($options, 'view_type');

      
        if($status ){
            if($view_type == 'pending_list'){
                $where .= " AND $leave_applications_table.status IN('$status','active')";
            }else{
                $where .= " AND $leave_applications_table.status='$status'";
            }
            
        }
        
        $start_date = $this->_get_clean_value($options, "start_date");
        $end_date = $this->_get_clean_value($options, "end_date");

        if ($start_date && $end_date) {
            $where .= " AND ($leave_applications_table.start_date BETWEEN '$start_date' AND '$end_date') ";
        }

        $applicant_id = $this->_get_clean_value($options, "applicant_id");
        // if ($applicant_id) {
        //     $where .= " AND $leave_applications_table.applicant_id=$applicant_id";
        // }

        $today = get_today_date();
        $on_leave_today = $this->_get_clean_value($options, "on_leave_today");
        if ($on_leave_today) {
            $where .= " AND ('$today' BETWEEN $leave_applications_table.start_date AND $leave_applications_table.end_date)";
        }

        $access_type = $this->_get_clean_value($options, "access_type");
     
        // if (!$id && $access_type !== "all") {

        //     $allowed_members = $this->_get_clean_value($options, "allowed_members");
        //     if (is_array($allowed_members) && count($allowed_members)) {
        //         $allowed_members = join(",", $allowed_members);
        //     } else {
        //         $allowed_members = '0';
        //     }
        //     $login_user_id = $this->_get_clean_value($options, "login_user_id");
        //     if ($login_user_id) {
        //         $allowed_members .= "," . $login_user_id;
        //     }
        //     $where .= " AND $leave_applications_table.applicant_id IN($allowed_members)";
        // }

        $where.= " AND $leave_applications_table.applicant_id like '$created_by' AND $leave_applications_table.department_id like '$department_id'";

        $sql = "SELECT $leave_applications_table.id, $leave_applications_table.start_date, $leave_applications_table.end_date, $leave_applications_table.total_hours,
                $leave_applications_table.total_days, $leave_applications_table.applicant_id, $leave_applications_table.status,
                CONCAT($users_table.first_name, ' ',$users_table.last_name) AS applicant_name, $users_table.image as applicant_avatar,
                $leave_types_table.title as leave_type_title,   $leave_types_table.color as leave_type_color,$leave_applications_table.leave_type_id,$leave_applications_table.uuid,
                $leave_applications_table.nolo_status
            FROM $leave_applications_table
            LEFT JOIN $users_table ON $users_table.id= $leave_applications_table.applicant_id
            LEFT JOIN $leave_types_table ON $leave_types_table.id= $leave_applications_table.leave_type_id        
            
            WHERE $leave_applications_table.deleted=0 $where order by start_date desc";
        return $this->db->query($sql);
    }

    function get_summary($options = array()) {
        $leave_applications_table = $this->db->prefixTable('leave_applications');
        $users_table = $this->db->prefixTable('users');
        $leave_types_table = $this->db->prefixTable('leave_types');

        $where = "";

        $where .= " AND $leave_applications_table.status='approved'";


        $start_date = $this->_get_clean_value($options, "start_date");
        $end_date = $this->_get_clean_value($options, "end_date");

        if ($start_date && $end_date) {
            $where .= " AND ($leave_applications_table.start_date BETWEEN '$start_date' AND '$end_date') ";
        }

        $applicant_id = $this->_get_clean_value($options, "applicant_id");
        if ($applicant_id) {
            $where .= " AND $leave_applications_table.applicant_id=$applicant_id";
        }

        $leave_type_id = $this->_get_clean_value($options, "leave_type_id");
        if ($leave_type_id) {
            $where .= " AND $leave_applications_table.leave_type_id=$leave_type_id";
        }

        $access_type = $this->_get_clean_value($options, "access_type");

        if ($access_type !== "all") {

            $allowed_members = $this->_get_clean_value($options, "allowed_members");
            if (is_array($allowed_members) && count($allowed_members)) {
                $allowed_members = join(",", $allowed_members);
            } else {
                $allowed_members = '0';
            }
            $login_user_id = $this->_get_clean_value($options, "login_user_id");
            if ($login_user_id) {
                $allowed_members .= "," . $login_user_id;
            }
            $where .= " AND $leave_applications_table.applicant_id IN($allowed_members)";
        }


        $sql = "SELECT  SUM($leave_applications_table.total_hours) AS total_hours,
                SUM($leave_applications_table.total_days) AS total_days, MAX($leave_applications_table.applicant_id) AS applicant_id, $leave_applications_table.status,
                CONCAT($users_table.first_name, ' ',$users_table.last_name) AS applicant_name, $users_table.image as applicant_avatar,
                $leave_types_table.title as leave_type_title,   $leave_types_table.color as leave_type_color
            FROM $leave_applications_table
            LEFT JOIN $users_table ON $users_table.id= $leave_applications_table.applicant_id
            LEFT JOIN $leave_types_table ON $leave_types_table.id= $leave_applications_table.leave_type_id        
            WHERE $leave_applications_table.deleted=0 $where
            GROUP BY $leave_applications_table.applicant_id, $leave_applications_table.leave_type_id";
        return $this->db->query($sql);
    }

}
