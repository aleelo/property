<?php

namespace App\Controllers;

use chillerlan\QRCode\QRCode;
use Dompdf\Dompdf;
use Dompdf\Options;

class Visitors_info extends App_Controller
{

    private $signin_validation_errors;

    public function __construct()
    {
        parent::__construct();
        $this->signin_validation_errors = array();
        helper('email');
    }
    
    function request_qrcode($id) {
       
        $model_info = $this->db->query("select rc.*,u.image as avatar,dp.nameSo as department,concat(u.first_name,' ',u.last_name) user from rise_fuel_requests rc 
        LEFT JOIN rise_users u on rc.requested_by = u.id 
        LEFT JOIN rise_departments dp on rc.department_id = dp.id 
        where rc.uuid='$id'")->getRow();

        if (!$model_info) {
            show_404();
        }


        $view_data['model_info'] = $model_info;
        return $this->template->view("fuel/request_qrcode", $view_data);
    }
    

    public function test_qr($id){
        $visitor_info = $this->db->query("SELECT * FROM rise_cardholders WHERE id = $id")->getRow();
        echo '<img width="150" src="'.(new QRCode())->render(get_uri('verify/show_visitor_qrcode/qr/'.$visitor_info->uid)).'" alt="Show Access Info" />';
    }

    /**
     * api for cardholder for nfc reader device:
     */
    
     public function cardholder_single($id=0){
        // echo $id;
        $cardholder = $this->db->query("SELECT * FROM rise_cardholders WHERE uid = '$id'")->getRow();
        echo json_encode($cardholder);
    }

    /** QR Code for Access requests */
    public function show_visitor_qrcode($id = 0){

        $view_data['visitor_info'] = $this->db->query("SELECT v.*,cb.image as created_avatar,ab.image as approved_avatar,rb.image as rejected_avatar,
                                    concat(cb.first_name,' ',cb.last_name) as created_by,concat(rb.first_name,' ',rb.last_name) as rejected_by,
                                    concat(ab.first_name,' ',ab.last_name) as approved_by,d.nameSo as department,rd.ref_number  FROM rise_visitors v 

                                    LEFT JOIN rise_visitors_detail vd on v.id = vd.visitor_id
                                    LEFT JOIN rise_users cb on v.created_by = cb.id
                                    LEFT JOIN rise_users ab on v.approved_by = ab.id
                                    LEFT JOIN rise_users rb on v.rejected_by = rb.id                                                    
                                    LEFT JOIN rise_departments d on d.id = v.department_id 
                                    LEFT JOIN rise_visitor_document dv on v.id = dv.visitor_id 
                                    LEFT JOIN rise_documents rd on rd.id = dv.document_id 
                                    WHERE v.uuid = '$id'
                                    ")->getRow();
        $visitor_id = $view_data['visitor_info']->id;
        $view_data['visitor_details'] = $this->db->query("SELECT vd.* from rise_visitors v left join rise_visitors_detail vd on v.id=vd.visitor_id where v.id = $visitor_id")->getResult();

        return $this->template->view('visitors/visitor_qr_code', $view_data);
    }

    
    
    /** show document QR CODE */
    public function show_document_qrcode($id=0){
        
        $doc = $this->db->query("select d.*,t.name as template,t.destination_folder as folder,concat(u.first_name,' ',u.last_name) user from rise_documents d 
        LEFT JOIN rise_users u on d.created_by = u.id 
        LEFT JOIN rise_templates t on d.template = t.id 
        where d.deleted=0 and d.uuid ='$id'");
    
        $view_data['document'] = $doc->getRow();


        return $this->template->view('documents/document_qr_code',$view_data);
    }
    
    /** show document QR CODE */
    public function show_agreement_qrcode($id=0){
        $agr = $this->db->query("SELECT ag.*, p.titleDeedNo, 
        GROUP_CONCAT(DISTINCT concat(bu_s.first_name, ' ', bu_s.last_name) SEPARATOR ', ') as buyers, 
        GROUP_CONCAT(DISTINCT concat(se_u.first_name, ' ', se_u.last_name) SEPARATOR ', ') as sellers, 
        GROUP_CONCAT(DISTINCT concat(wi_u.first_name, ' ', wi_u.last_name) SEPARATOR ', ') as witnesses
        FROM rise_users bu_s 
        LEFT JOIN rise_users bu_s ON FIND_IN_SET(bu_s.id, ag.buyer_ids)
        LEFT JOIN rise_users se_u ON FIND_IN_SET(se_u.id, ag.seller_ids)
        LEFT JOIN rise_users wi_u ON FIND_IN_SET(wi_u.id, ag.witness_ids)
        LEFT JOIN rise_properties p ON p.id = ag.property_id
        WHERE ag.uuid ='$id'")->getRow();

        $view_data['buyers'] = $this->format_names($agr->buyers);
        $view_data['sellers'] = $this->format_names($agr->sellers);
        $view_data['witnesses'] = $this->format_names($agr->witnesses);

        if (isset($agr->created_at)) {
            $cre_at = format_to_date($agr->created_at, FALSE);
            $view_data['created_at_meta'] = $cre_at;
        }
    
        $view_data['agreement'] = $agr;


        return $this->template->view('agreements/documents/agreement_qr_code',$view_data);
    }

    public function show_leave_qrcode($id=0) {
        $leave_info = $this->db->query("SELECT t.title as leave_type,t.color,l.start_date,l.end_date,l.total_days as duration,l.id,l.uuid,CONCAT(a.first_name, ' ',a.last_name) as applicant_name ,e.job_title_so as job_title,
        a.image as applicant_avatar,CONCAT(cb.first_name, ' ',cb.last_name) AS checker_name,cb.image as checker_avatar,l.status,l.reason,a.passport_no FROM rise_leave_applications l 
        
        LEFT JOIN rise_users a on l.applicant_id = a.id
        LEFT JOIN rise_users cb on l.applicant_id = cb.id
        LEFT JOIN rise_team_member_job_info e on e.user_id = a.id
        left join rise_leave_types t on t.id=l.leave_type_id where l.uuid = '$id'")->getRow();
        
        $view_data['leave_info'] = $leave_info;

        return $this->template->view('leaves/leave_qr_code',$view_data);
    }

    
    public function show_leave_qrcode_return($id=0) {
        $leave_info = $this->db->query("SELECT t.title as leave_type,t.color,l.start_date,l.end_date,l.total_days as duration,l.id,l.uuid,CONCAT(a.first_name, ' ',a.last_name) as applicant_name ,e.job_title_so as job_title,
        a.image as applicant_avatar,CONCAT(cb.first_name, ' ',cb.last_name) AS checker_name,cb.image as checker_avatar,l.status,l.reason,a.passport_no FROM rise_leave_applications l 
        
        LEFT JOIN rise_users a on l.applicant_id = a.id
        LEFT JOIN rise_users cb on l.applicant_id = cb.id
        LEFT JOIN rise_team_member_job_info e on e.user_id = a.id
        left join rise_leave_types t on t.id=l.leave_type_id where l.uuid = '$id'")->getRow();
        
        $view_data['leave_info'] = $leave_info;

        return $this->template->view('leaves/leave_qr_code_return',$view_data);
    }

    public function cardholder_qrcode($qid,$uuid) {
        // die($uuid);
        $model_info = $this->db->query("SELECT * FROM rise_cardholders c where uid = '$uuid'")->getRow();
        
        $view_data['model_info'] = $model_info;
        return $this->template->view('cardholders/employee_qr_code',$view_data);
    }

    private function format_names($names) {
        $names_array = explode(',', $names);
        $total_names = count($names_array);
        
        if ($total_names == 2) {
            return $names_array[0] . " and " . $names_array[1];
        } else if ($total_names > 2) {
            $last_name = array_pop($names_array);
            return implode(', ', $names_array) . " and " . $last_name;
        }
    
        return $names; // If only one name, just return it
    }

    function confirm_dispense() {

        $this->validate_submitted_data(array(
            "id" => "required|numeric",
            "driver_name" => "required"
        ));

        $id = $this->request->getPost('id');
        $driver_name = $this->request->getPost('driver_name');
        // die($status);
        $data = array('driver_name' => $driver_name,'status'=>'dispensed');

        $save_id = $this->Fuel_Request_model->ci_save($data, $id);
        // $info = $this->Fuel_Request_model->get_one($id);

        if ($save_id) {

            // $notification_options = array("leave_id" => $id, "to_user_id" => $applicatoin_info->applicant_id);

            // if ($status == "approved") {
            //     log_notification("leave_approved_HR", $notification_options);//leave_approved
            // } else if ($status == "pending") {
            //     log_notification("leave_approved_Director", $notification_options);
            // } else if ($status == "rejected") {
            //     log_notification("leave_rejected", $notification_options);
            // } else if ($status == "canceled") {
            //     log_notification("leave_canceled", $notification_options);
            // }

            // return app_redirect('visitors_info/request_qrcode/'.$info->uuid);

            echo json_encode(array("success" => true, 'id' => $save_id, 'message' => 'Successfully comfirmed!'));
        } else {
            echo json_encode(array("success" => false, 'message' => app_lang('error_occurred')));
        }
    }

    
    /**
     * start document functions
     */    
     
     public function get_leave_mail_pdf($id,$type,$mode='view'){
        $leave_info = $this->db->query("SELECT t.title as leave_type,t.color,l.start_date,l.end_date,l.total_days as duration,l.id,l.uuid,CONCAT(a.first_name, ' ',a.last_name) as applicant_name ,e.job_title_so as job_title,
        a.image as applicant_avatar,CONCAT(cb.first_name, ' ',cb.last_name) AS checker_name,cb.image as checker_avatar,l.status,l.reason,a.passport_no,l.nolo_status FROM rise_leave_applications l 
        LEFT JOIN rise_users a on l.applicant_id = a.id
        LEFT JOIN rise_users cb on l.applicant_id = cb.id
        LEFT JOIN rise_team_member_job_info e on e.user_id = a.id
        left join rise_leave_types t on t.id=l.leave_type_id 
        where l.uuid = '$id'")->getRow();
        
        $view_data['leave_info'] = $leave_info;
        
        $pdf_file_name = "leave_document_info_".$id.".pdf";
       
        $options = new Options([
            'enable_remote' => true,
            'isRemoteEnabled' => true,
            'chroot',base_url('files/system'),
        ]);
        
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $dompdf->setOptions($options);
        
        // var_dump($options->get('chroot'));
        // die();
        // file_get_contents('visitors/',$dompdf->output());
        $view_data['leave_info'] = $leave_info;

        if($type == 'nulla_osta'){
            $html = view('leaves/leave_nolosto_mail_pdf',$view_data);
        }else if($type == 'passport_return'){
            $html = view('leaves/leave_passport_return_mail_pdf',$view_data);
        }
        // print_r($html);
        $dompdf->loadHtml($html);
        

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($pdf_file_name,['Attachment'=>0]);
        exit();
    }


}