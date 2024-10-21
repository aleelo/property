<?php

namespace App\Controllers;

class Agreement_type extends Security_Controller {

    function __construct() {
        parent::__construct();
        $this->access_only_admin_or_settings_admin();
    }

    //load leave type list view
    function index() {
        return $this->template->rander("Agreement_type/index");
    }

    //load leave type add/edit form
    function modal_form() {
        $view_data['model_info'] = $this->Agreement_type_model->get_one($this->request->getPost('id'));
        $view_data['Services'] = array("" => " -- choose a service -- ") + $this->Notary_services_model->get_dropdown_list(array("service_name"), "id");

        return $this->template->view('Agreement_type/modal_form', $view_data);
    }

    //save leave type
    function save() {

        $this->validate_submitted_data(array(
            "id" => "numeric",
            "agreement_type" => "required",
            "service_id" => "required"
        ));

        $id = $this->request->getPost('id');
        $data = array(
            "agreement_type" => $this->request->getPost('agreement_type'),
            "service_id" => $this->request->getPost('service_id'),
        );
        $save_id = $this->Agreement_type_model->ci_save($data, $id);
        if ($save_id) {
            echo json_encode(array("success" => true, "data" => $this->_row_data($save_id), 'id' => $save_id, 'message' => app_lang('record_saved')));
        } else {
            echo json_encode(array("success" => false, 'message' => app_lang('error_occurred')));
        }
    }

    //delete/undo a leve type
    function delete() {
        $this->validate_submitted_data(array(
            "id" => "required|numeric"
        ));

        $id = $this->request->getPost('id');
        if ($this->request->getPost('undo')) {
            if ($this->Agreement_type_model->delete($id, true)) {
                echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => app_lang('record_undone')));
            } else {
                echo json_encode(array("success" => false, app_lang('error_occurred')));
            }
        } else {
            if ($this->Agreement_type_model->delete($id)) {
                echo json_encode(array("success" => true, 'message' => app_lang('record_deleted')));
            } else {
                echo json_encode(array("success" => false, 'message' => app_lang('record_cannot_be_deleted')));
            }
        }
    }

    //prepare leave types list data for datatable
    function list_data() {
        $list_data = $this->Agreement_type_model->get_details()->getResult();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }
        echo json_encode(array("data" => $result));
    }

    //get a row of leave types row
    private function _row_data($id) {
        $options = array("id" => $id);
        $data = $this->Agreement_type_model->get_details($options)->getRow();
        return $this->_make_row($data);
    }

    //make a row of leave types row
    private function _make_row($data) {
        return array(
            $data->agreement_type,
            $data->service_name,
            modal_anchor(get_uri("agreement_type/modal_form"), "<i data-feather='edit' class='icon-16'></i>", array("class" => "edit", "title" => app_lang('edit_agreement_type'), "data-post-id" => $data->id))
            . js_anchor("<i data-feather='x' class='icon-16'></i>", array('title' => app_lang('delete_agreement_type'), "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("agreement_type/delete"), "data-action" => "delete"))
        );
    }

}

/* End of file leave_types.php */
/* Location: ./app/controllers/leave_types.php */