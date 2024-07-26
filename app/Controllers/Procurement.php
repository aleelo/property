<?php

namespace App\Controllers;


class Procurement extends Security_Controller{
    
    /* load index list view */
    public function index()
    {
        
    //    $res = $this->check_access('lead');
       $role = $this->get_user_role();
       $can_add_template = $role == 'admin';
       $view_data["can_add_template"] = $can_add_template;
        // $this->access_only_allowed_members();
        // $this->check_module_availability("module_lead");


        return $this->template->rander("procurement/index", $view_data);
    }

}