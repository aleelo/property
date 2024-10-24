<?php

namespace App\Controllers;

class Notary extends Security_Controller {

    function __construct() {
        parent::__construct();
        $this->access_only_admin_or_settings_admin();
    }

    //load leave type list view
    function index() {
        $view_data['regions'] = $this->Regions();
        $view_data['districts'] = $this->Districts();
        $view_data['model_info'] = $this->Notary_model->get_one($this->request->getPost('id'));
        $view_data['owner'] = array("" => " -- choose owner -- ") + $this->Users_model->get_dropdown_list(array("first_name", "last_name"), "id");

        // $view_data['owner'] = array("" => " -- Choose Owner -- ") + $this->Users_model->get_dropdown_list(array("first_name"," ","last_name")), "id");


        return $this->template->rander("notary/index", $view_data);
    }

    //load leave type add/edit form
    function modal_form() {
        $view_data['model_info'] = $this->Notary_model->get_one($this->request->getPost('id'));
        
        return $this->template->view('notary/modal_form', $view_data);
    }

    //save leave type
    function save() {

        $this->validate_submitted_data(array(
            "id" => "numeric",
            "legal_name" => "required",
            "legal_structure" => "required",
            "region" => "required",
            "district" => "required",
            "address" => "required",
            "notary_owner_id" => "required",
        ));

        $id = $this->request->getPost('id');
        $data = array(
            "legal_name" => $this->request->getPost('legal_name'),
            "legal_structure" => $this->request->getPost('legal_structure'),
            "region" => $this->request->getPost('region'),
            "district" => $this->request->getPost('district'),
            "address" => $this->request->getPost('address'),
            "notary_owner_id" => $this->request->getPost('notary_owner_id'),
        );
        $save_id = $this->Notary_model->ci_save($data, $id);
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
            if ($this->Notary_model->delete($id, true)) {
                echo json_encode(array("success" => true, "data" => $this->_row_data($id), "message" => app_lang('record_undone')));
            } else {
                echo json_encode(array("success" => false, app_lang('error_occurred')));
            }
        } else {
            if ($this->Notary_model->delete($id)) {
                echo json_encode(array("success" => true, 'message' => app_lang('record_deleted')));
            } else {
                echo json_encode(array("success" => false, 'message' => app_lang('record_cannot_be_deleted')));
            }
        }
    }

    //prepare leave types list data for datatable
    function list_data() {
        $list_data = $this->Notary_model->get_details()->getResult();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }
        echo json_encode(array("data" => $result));
    }

    //get a row of leave types row
    private function _row_data($id) {
        $options = array("id" => $id);
        $data = $this->Notary_model->get_details($options)->getRow();
        return $this->_make_row($data);
    }

    //make a row of leave types row
    private function _make_row($data) {
        return array(
            $data->legal_name,
            modal_anchor(get_uri("notary/index"), "<i data-feather='edit' class='icon-16'></i>", array("class" => "edit", "title" => app_lang('edit_leave_type'), "data-post-id" => $data->id))
            . js_anchor("<i data-feather='x' class='icon-16'></i>", array('title' => app_lang('delete_leave_type'), "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("notary/delete"), "data-action" => "delete"))
        );
    }

    function Regions(){
        $regions_of_somalia = array(
            "" => " -- ", "Awdal" => "Awdal", "Bakool" => "Bakool", "Banaadir" => "Banaadir", "Bari" => "Bari", 
            "Bay" => "Bay", "Galguduud" => "Galguduud", "Gedo" => "Gedo", "Hiiraan" => "Hiiraan", 
            "Jubbada Dhexe" => "Jubbada Dhexe", "Jubbada Hoose" => "Jubbada Hoose",
            "Mudug" => "Mudug", "Nugaal" => "Nugaal", "Sanaag" => "Sanaag", 
            "Shabeellaha Dhexe" => "Shabeellaha Dhexe", "Shabeellaha Hoose" => "Shabeellaha Hoose", 
            "Sool" => "Sool", "Togdheer" => "Togdheer", "Woqooyi Galbeed" => "Woqooyi Galbeed"
        );
        
        return $regions_of_somalia;
    }

    function Districts(){
        $districts_of_somalia = array(
            "" => " -- ", "Baki" => "Baki", "Borama" => "Borama", "Dilla" => "Dilla", "Lughaya" => "Lughaya", 
            "Saylac" => "Saylac", "El Barde" => "El Barde", "Hoddur" => "Hoddur", "Rabdhure" => "Rabdhure", 
            "Tayeeglow" => "Tayeeglow", "Wajid" => "Wajid", "Abdiaziz" => "Abdiaziz", "Bondhere" => "Bondhere", 
            "Daynile" => "Daynile", "Dharkenley" => "Dharkenley", "Hamar Jabjab" => "Hamar Jabjab", 
            "Hamar Weyne" => "Hamar Weyne", "Hawl Wadaag" => "Hawl Wadaag", "Hodan" => "Hodan", 
            "Howlwadag" => "Howlwadag", "Karaan" => "Karaan",
            "Shangani" => "Shangani", "Shibis" => "Shibis", "Wadajir" => "Wadajir", "Wardhigley" => "Wardhigley", 
            "Yaaqshid" => "Yaaqshid", "Alula" => "Alula", "Bandarbeyla" => "Bandarbeyla", "Bosaso" => "Bosaso", 
            "Qandala" => "Qandala", "Iskushuban" => "Iskushuban", "Ufayn" => "Ufayn", "Baidoa" => "Baidoa", 
            "Buurhakaba" => "Buurhakaba", "Diinsoor" => "Diinsoor", "Qansahdhere" => "Qansahdhere", 
            "Abudwak" => "Abudwak", "Adado" => "Adado", "El Bur" => "El Bur", "El Dher" => "El Dher", "Guriel" => "Guriel",
            "Bardera" => "Bardera", "Belet Hawo" => "Belet Hawo", "Bur Dubo" => "Bur Dubo", "El Wak" => "El Wak", 
            "Garbaharey" => "Garbaharey", "Luuq" => "Luuq", "Beledweyne" => "Beledweyne", "Bulo Burde" => "Bulo Burde", 
            "Jalalaqsi" => "Jalalaqsi", "Mataban" => "Mataban", "Bu'aale" => "Bu'aale", "Jilib" => "Jilib", 
            "Saakow" => "Saakow", "Afmadow" => "Afmadow", "Badhaadhe" => "Badhaadhe", "Kismayo" => "Kismayo", 
            "Jamame" => "Jamame", "Gaalkacyo" => "Gaalkacyo", "Galdogob" => "Galdogob", "Harardhere" => "Harardhere",
            "Hobyo" => "Hobyo", "Jariban" => "Jariban", "Burtinle" => "Burtinle", "Eyl" => "Eyl", 
            "Garowe" => "Garowe", "Badhan" => "Badhan", "Ceerigaabo" => "Ceerigaabo", "Dhahar" => "Dhahar", 
            "Laasqoray" => "Laasqoray", "Adale" => "Adale", "Bal'ad" => "Bal'ad", "Jowhar" => "Jowhar", 
            "Mahaday" => "Mahaday", "Afgooye" => "Afgooye", "Baraawe" => "Baraawe", "Kurtunwarey" => "Kurtunwarey", 
            "Marka" => "Marka", "Qoryooley" => "Qoryooley", "Wanlaweyn" => "Wanlaweyn", "Ainabo" => "Ainabo",
            "Laas Anod" => "Laas Anod", "Taleh" => "Taleh", "Burao" => "Burao", "Oodweyne" => "Oodweyne", 
            "Berbera" => "Berbera", "Gabiley" => "Gabiley", "Hargeisa" => "Hargeisa"
        );
        
        return $districts_of_somalia;
    }

}

/* End of file leave_types.php */
/* Location: ./app/controllers/leave_types.php */