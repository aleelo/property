<?php

namespace App\Controllers;

class Visitors_info extends App_Controller
{

    private $signin_validation_errors;

    public function __construct()
    {
        parent::__construct();
        $this->signin_validation_errors = array();
        helper('email');
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
                                    LEFT JOIN departments d on d.id = v.department_id 
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


    public function show_leave_qrcode($id=0) {
        $leave_info = $this->db->query("SELECT t.title as leave_type,t.color,l.start_date,l.end_date,l.total_days as duration,l.id,l.uuid,CONCAT(a.first_name, ' ',a.last_name) as applicant_name ,e.job_title_so as job_title,
        a.image as applicant_avatar,CONCAT(cb.first_name, ' ',cb.last_name) AS checker_name,cb.image as checker_avatar,l.status,l.reason FROM rise_leave_applications l 
        
        LEFT JOIN rise_users a on l.applicant_id = a.id
        LEFT JOIN rise_users cb on l.applicant_id = cb.id
        LEFT JOIN rise_team_member_job_info e on e.user_id = a.id
        left join rise_leave_types t on t.id=l.leave_type_id where l.uuid = '$id'")->getRow();
        
        $view_data['leave_info'] = $leave_info;

        return $this->template->view('leaves/leave_qr_code',$view_data);
    }
}