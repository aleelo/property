<?php

namespace App\Models;

use chillerlan\QRCode\Common\EccLevel;
use chillerlan\QRCode\Common\Version;
use chillerlan\QRCode\Output\QROutputInterface;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class Purchase_Request_model extends Crud_model {

    protected $table = 'purchase_requests';

    function __construct() {
        $this->table = 'purchase_requests';
        parent::__construct($this->table);
    }

    
    
    function get_details($options = array()) {
        $purchase_request_table = $this->db->prefixTable('purchase_requests');
        $users_table = $this->db->prefixTable('users');
        $suppliers_table = $this->db->prefixTable('suppliers');
        $departments_table = 'departments';
        
        $where = "";
        $id = $this->_get_clean_value($options, "id");
        if ($id) {
            $where .= " AND $purchase_request_table.id=$id";
        }

        $requested_by = $this->_get_clean_value($options, "requested_by");
        if ($requested_by) {
            $where .= " AND $purchase_request_table.requested_by like '$requested_by'";
        }

        $department_id = $this->_get_clean_value($options, "department_id");
        if ($department_id) {
            $where .= " AND $purchase_request_table.department_id like '$department_id'";
        }
        
        $start_date = $this->_get_clean_value($options, "start_date");        
        $end_date = $this->_get_clean_value($options, "end_date");
    
        if($start_date){
            $where .= " and $purchase_request_table.request_date between '$start_date' and '$end_date'";
        }

        
        $limit_offset = "";
        $limit = $this->_get_clean_value($options, "limit");
        if ($limit) {
            $skip = $this->_get_clean_value($options, "skip");
            $offset = $skip ? $skip : 0;
            $limit_offset = " LIMIT $limit ";
        }

        $available_order_by_list = array(
            "first_name" => $users_table . ".first_name",
            "product_type" => $purchase_request_table . ".product_type",
            "request_date" => $purchase_request_table . ".request_date",
            "suppliers_table" => $suppliers_table . ".supplier_name"
        );

        $order_by = get_array_value($available_order_by_list, $this->_get_clean_value($options, "order_by"));

        $order = "ORDER BY $users_table.id";

        if ($order_by) {
            $order_dir = $this->_get_clean_value($options, "order_dir");
            $order = " ORDER BY $order_by $order_dir ";
        }else{
            $order ="ORDER BY $purchase_request_table.id DESC";
        }

        $search_by = get_array_value($options, "search_by");
        if ($search_by) {
            $search_by = $this->db->escapeLikeString($search_by);

            $where .= " AND (";
            $where .= " $purchase_request_table.product_type LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR $purchase_request_table.request_date LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR $purchase_request_table.quantity LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR $suppliers_table.supplier_name LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR CONCAT($users_table.first_name, ' ', $users_table.last_name) LIKE '%$search_by%' ESCAPE '!' ";
            $where .= $this->get_custom_field_search_query($users_table, "client_contacts", $search_by);
            $where .= " )";
        }


        $sql = "SELECT SQL_CALC_FOUND_ROWS $purchase_request_table.*,$suppliers_table.supplier_name as supplier,$suppliers_table.id as supplier_id,$suppliers_table.address,$suppliers_table.contact_person,
                $suppliers_table.phone,$suppliers_table.email,$users_table.image as avatar,$departments_table.nameSo as department,
                concat($users_table.first_name,' ',$users_table.last_name) user
                FROM $purchase_request_table
                LEFT JOIN $users_table ON $purchase_request_table.requested_by=$users_table.id
                LEFT JOIN $suppliers_table ON $purchase_request_table.supplier_id=$suppliers_table.id
                LEFT JOIN $departments_table ON $purchase_request_table.department_id=$departments_table.id
                WHERE $purchase_request_table.deleted=0 $where  $order $limit_offset";

        // print_r($sql);die;  
        $raw_query = $this->db->query($sql);

        $total_rows = $this->db->query("SELECT FOUND_ROWS() as found_rows")->getRow();

        if ($limit) {
            // die($limit);
            return array(
                "data" => $raw_query->getResult(),
                "recordsTotal" => $total_rows->found_rows,
                "recordsFiltered" => $total_rows->found_rows,
            );
        } else {
            return $raw_query;
        }
    }

    
    //update invoice status
    function update_status($request_id = 0, $status = "partial") {
        $status = $status ? $this->db->escapeString($status) : $status;
        $status_data = array("status" => $status);
        return $this->ci_save($status_data, $request_id);
    }

      
    function get_request_items($options = array()) {
        $purchase_request_table = $this->db->prefixTable('purchase_requests');
        $users_table = $this->db->prefixTable('users');
        $purchase_items_table = $this->db->prefixTable('purchase_items');
        $purchase_request_items_table = $this->db->prefixTable('purchase_request_items');
        
        $where = "";
        $purchase_request_id = $this->_get_clean_value($options, "purchase_request_id");
        if ($purchase_request_id) {
            $where .= " AND $purchase_request_items_table.purchase_request_id=$purchase_request_id";
        }

        $item_id = $this->_get_clean_value($options, "item_id");
        if ($item_id) {
            $where .= " AND $purchase_request_items_table.item_id=$item_id";
        }
        

        $sql = "SELECT $purchase_request_items_table.*,$purchase_items_table.price FROM $purchase_request_items_table
                LEFT JOIN $purchase_items_table ON $purchase_items_table.id=$purchase_request_items_table.item_id
                LEFT JOIN $purchase_request_table ON $purchase_request_items_table.purchase_request_id=$purchase_request_table.id
                WHERE $purchase_request_items_table.deleted=0 $where
                ORDER BY $purchase_request_table.id DESC";
        
        return $this->db->query($sql);
    }

     // Creates the Document Using the Provided Template
     public function createDoc($data =array())
     {
 
         require_once ROOTPATH . 'vendor/autoload.php';
 
         // Creating the new document...
         // $phpWord = new \PhpOffice\PhpWord\PhpWord();
         $template = new \PhpOffice\PhpWord\TemplateProcessor(APPPATH . 'Views/documents/'.$data['template']);
        
         $ext = pathinfo(APPPATH.'Views/documents/'.$data['template'],PATHINFO_EXTENSION);
         $save_as_name = 'requisition_'.$data['id'].'_'.date('m').'.'.date('Y').'.'.$ext;
         
 
         $path_absolute = APPPATH . 'Views/documents/'.$save_as_name;
         // var_dump($data);
         // var_dump($save_as_name);
         // die();
         
         $template->setValues([
 
             'ref' => $data['ref_number'],
             'date' => date('F d, Y',strtotime($data['created_at'])),
             'visitDate' => $data['visit_date'],
             'documentTitle'=>$data['document_title'],
             'gatesText'=>$data['allowed_gates'],
            //  'sqn'=>$data['id'],
             'department'=>$data['department'],
 
         ]);
 
         if($data['remarks']){
             $template->setValue('remarksTitle','Faahfaahin Dheeri ah:');
             $template->setValue('remarks',$data['remarks']);
         }else{
             $template->setValue('remarksTitle','');
             $template->setValue('remarks','');
         }
 
         $template->cloneRowAndSetValues(
             'id',
             $data['table']
         );
 
         $options = new QROptions([
             'eccLevel' => EccLevel::H,
             'outputBase64' => true,
             'cachefile' => APPPATH . 'Views/documents/qrcode.png',
             'outputType'=>QROutputInterface::GDIMAGE_PNG,
             'logoSpaceHeight' => 17,
             'logoSpaceWidth' => 17,
             'scale' => 20,
             'version' => Version::AUTO,
 
           ]);
 
         //   $template->setMacroChars()
         //   $options->outputType = ;
 
         $qrcode = (new QRCode($options))->render(get_uri('purchase_request/get_purchase_requisition_order_pdf/'.$data['uuid']));//->getQRMatrix(current_url())
 
         // $qrOutputInterface = new QRImageWithLogo($options, $qrcode);
 
         // // dump the output, with an additional logo
         // $out = $qrOutputInterface->dump(APPPATH . 'Views/documents/qrcode.png', APPPATH . 'Views/documents/logo.png');
 
         $template->setImageValue('qrcode',
             [
                 'path' => APPPATH . 'Views/documents/qrcode.png',
                 'width' => '100',
                 'height' => '100',
                 'ratio' => false,
             ]);          
 
         $template->saveAs($path_absolute);
 
         return $save_as_name;
 
     }
}
