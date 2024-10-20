<?php

namespace App\Models;

class Properties_model extends Crud_model {

    protected $table = null;

    function __construct() {
        $this->table = 'properties';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $properties_table = $this->db->prefixTable('properties');
        $departments_table = $this->db->prefixTable('departments');
        $clients_table = $this->db->prefixTable('clients');
        $notary_services_table = $this->db->prefixTable('notary_services');

        $projects_table = $this->db->prefixTable('projects');
        $users_table = $this->db->prefixTable('users');
        $invoices_table = $this->db->prefixTable('invoices');
        $invoice_payments_table = $this->db->prefixTable('invoice_payments');
        $client_groups_table = $this->db->prefixTable('client_groups');
        $lead_status_table = $this->db->prefixTable('lead_status');
        $estimates_table = $this->db->prefixTable('estimates');
        $estimate_requests_table = $this->db->prefixTable('estimate_requests');
        $tickets_table = $this->db->prefixTable('tickets');
        $orders_table = $this->db->prefixTable('orders');
        $proposals_table = $this->db->prefixTable('proposals');

        $where = "";
        $id = $this->_get_clean_value($options, "id");
        if ($id) {
            $where .= " AND $properties_table.id=$id";
        }

        $custom_field_type = "clients";

        $leads_only = $this->_get_clean_value($options, "leads_only");
        if ($leads_only) {
            $custom_field_type = "leads";
            $where .= " AND $properties_table.is_lead=1";
        }

        $status = $this->_get_clean_value($options, "status");
        if ($status) {
            $where .= " AND $properties_table.lead_status_id='$status'";
        }

        $source = $this->_get_clean_value($options, "source");
        if ($source) {
            $where .= " AND $properties_table.lead_source_id='$source'";
        }

        $owner_id = $this->_get_clean_value($options, "owner_id");
        if ($owner_id) {
            $where .= " AND $properties_table.owner_id=$owner_id";
        }

        $created_by = $this->_get_clean_value($options, "created_by");
        if ($created_by) {
            $where .= " AND $properties_table.created_by=$created_by";
        }

        $show_own_clients_only_user_id = $this->_get_clean_value($options, "show_own_clients_only_user_id");
        if ($show_own_clients_only_user_id) {
            $where .= " AND $properties_table.section_head_id=$show_own_clients_only_user_id";
        }


        $quick_filter = $this->_get_clean_value($options, "quick_filter");
        if ($quick_filter) {
            $where .= $this->make_quick_filter_query($quick_filter, $properties_table, $projects_table, $invoices_table, $invoice_payments_table, $estimates_table, $estimate_requests_table, $tickets_table, $orders_table, $proposals_table);
        }

        $start_date = $this->_get_clean_value($options, "start_date");
        if ($start_date) {
            $where .= " AND DATE($properties_table.created_date)>='$start_date'";
        }
        $end_date = $this->_get_clean_value($options, "end_date");
        if ($end_date) {
            $where .= " AND DATE($properties_table.created_date)<='$end_date'";
        }

        $label_id = $this->_get_clean_value($options, "label_id");
        if ($label_id) {
            $where .= " AND (FIND_IN_SET('$label_id', $properties_table.labels)) ";
        }

        $select_labels_data_query = $this->get_labels_data_query();

        $client_groups = $this->_get_clean_value($options, "client_groups");
        $where .= $this->prepare_allowed_client_groups_query($properties_table, $client_groups);

        //prepare custom fild binding query
        $custom_fields = get_array_value($options, "custom_fields");
        $custom_field_filter = get_array_value($options, "custom_field_filter");
        $custom_field_query_info = $this->prepare_custom_field_query_string($custom_field_type, $custom_fields, $properties_table, $custom_field_filter);
        $select_custom_fieds = get_array_value($custom_field_query_info, "select_string");
        $join_custom_fieds = get_array_value($custom_field_query_info, "join_string");
        $custom_fields_where = get_array_value($custom_field_query_info, "where_string");

        $this->db->query('SET SQL_BIG_SELECTS=1');

        $limit_offset = "";
        $limit = $this->_get_clean_value($options, "limit");
        if ($limit) {
            $skip = $this->_get_clean_value($options, "skip");
            $offset = $skip ? $skip : 0;
            $limit_offset = " LIMIT $limit OFFSET $offset ";
        }


        $available_order_by_list = array(
            "id" => $properties_table . ".id",
            "titleDeedNo" => $properties_table . ".titleDeedNo",
            "owner_name" => "CONCAT($users_table.first_name, ' ', $users_table.last_name)",
            "address" => "CONCAT($properties_table.region,' ',$properties_table.district,' ',$properties_table.address)",
            "type" => $properties_table . ".type",
            "area" => $properties_table . ".area",
            "propertyValue" => $properties_table . ".propertyValue",
            "created_at" => $properties_table . ".created_at",
            "status" => $properties_table . ".status",
        );

        $order_by = get_array_value($available_order_by_list, $this->_get_clean_value($options, "order_by"));

        $order = "";

        if ($order_by) {
            $order_dir = $this->_get_clean_value($options, "order_dir");
            $order = " ORDER BY $order_by $order_dir ";
        }


        $search_by = get_array_value($options, "search_by");
        if ($search_by) {
            $search_by = $this->db->escapeLikeString($search_by);
            $labels_table = $this->db->prefixTable("labels");

            $where .= " AND (";
            $where .= " $properties_table.id LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR $properties_table.titleDeedNo LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR CONCAT($users_table.first_name,' ',$users_table.last_name) LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR CONCAT($properties_table.region,' ',$properties_table.district,' ',$properties_table.address) LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR $properties_table.type LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR $properties_table.area LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR $properties_table.propertyValue LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR $properties_table.created_at LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR $properties_table.status LIKE '%$search_by%' ESCAPE '!' ";
            $where .= " OR (SELECT GROUP_CONCAT($labels_table.title, ', ') FROM $labels_table WHERE FIND_IN_SET($labels_table.id, $properties_table.labels)) LIKE '%$search_by%' ESCAPE '!' ";

            if ($leads_only) {
                $where .= " OR $lead_status_table.title LIKE '%$search_by%' ESCAPE '!' ";
                $where .= $this->get_custom_field_search_query($properties_table, "leads", $search_by);
            } else {
                $where .= $this->get_custom_field_search_query($properties_table, "clients", $search_by);
            }

            $where .= " )";
        }


        $sql = "SELECT SQL_CALC_FOUND_ROWS $properties_table.*,
        $clients_table.company_name as owner_name,
        $notary_services_table.service_name
        FROM $properties_table
        LEFT JOIN $clients_table ON $clients_table.id = $properties_table.owner_ids
        LEFT JOIN $notary_services_table ON $notary_services_table.id = $properties_table.service_id
        $join_custom_fieds               
        WHERE $properties_table.deleted=0 $where $custom_fields_where  
        $order $limit_offset";

        // print_r($sql);die;

        $raw_query = $this->db->query($sql);

        $total_rows = $this->db->query("SELECT FOUND_ROWS() as found_rows")->getRow();

        if ($limit) {
            return array(
                "data" => $raw_query->getResult(),
                "recordsTotal" => $total_rows->found_rows,
                "recordsFiltered" => $total_rows->found_rows,
            );
        } else {
            return $raw_query;
        }
    }

    public function get_notary_service_id_by_property($property_id)
    {
        // Define the SQL query to fetch the notary service ID for the given property ID
        $sql = "SELECT service_id FROM rise_properties WHERE id = ?";
        
        // Execute the query and fetch the result
        $query = $this->db->query($sql, array($property_id));
        
        if ($query && $query->getNumRows() > 0) {
            $result = $query->getRow();
            return $result->service_id;
        } else {
            // Log an error if no rows are found or the query fails
            log_message('error', 'No notary service found for property ID: ' . $property_id);
            return null;
        }
    }

    private function make_quick_filter_query($filter, $clients_table, $projects_table, $invoices_table, $invoice_payments_table, $estimates_table, $estimate_requests_table, $tickets_table, $orders_table, $proposals_table) {
        $query = "";
        $tolarance = get_paid_status_tolarance();
        if ($filter == "has_open_projects" || $filter == "has_completed_projects" || $filter == "has_any_hold_projects" || $filter == "has_canceled_projects") {
            $status_id = 1;
            if ($filter == "has_completed_projects") {
                $status_id = 2;
            } else if ($filter == "has_any_hold_projects") {
                $status_id = 3;
            } else if ($filter == "has_canceled_projects") {
                $status_id = 4;
            }

            $query = " AND $clients_table.id IN(SELECT $projects_table.client_id FROM $projects_table WHERE $projects_table.deleted=0 AND $projects_table.project_type='client_project' AND $projects_table.status_id='$status_id') ";
        } else if ($filter == "has_unpaid_invoices" || $filter == "has_overdue_invoices" || $filter == "has_partially_paid_invoices") {
            $now = get_my_local_time("Y-m-d");

            $invoice_where = " AND $invoices_table.status ='not_paid' AND IFNULL(payments_table.payment_received,0)<=0"; //has_unpaid_invoices
            if ($filter == "has_overdue_invoices") {
                $invoice_where = " AND $invoices_table.status ='not_paid' AND $invoices_table.due_date<'$now' AND TRUNCATE(IFNULL(payments_table.payment_received,0),2)<$invoices_table.invoice_total-$tolarance";
            } else if ($filter == "has_partially_paid_invoices") {
                $invoice_where = " AND IFNULL(payments_table.payment_received,0)>0 AND IFNULL(payments_table.payment_received,0)<$invoices_table.invoice_total-$tolarance";
            }

            $query = " AND $clients_table.id IN(
                            SELECT $invoices_table.client_id FROM $invoices_table 
                               LEFT JOIN (SELECT invoice_id, SUM(amount) AS payment_received FROM $invoice_payments_table WHERE deleted=0 GROUP BY invoice_id) AS payments_table ON payments_table.invoice_id = $invoices_table.id  
                            WHERE $invoices_table.deleted=0 $invoice_where
                    ) ";
        } else if ($filter == "has_open_estimates" || $filter == "has_accepted_estimates") {
            $status = "sent";
            if ($filter == "has_accepted_estimates") {
                $status = "accepted";
            }

            $query = " AND $clients_table.id IN(SELECT $estimates_table.client_id FROM $estimates_table WHERE $estimates_table.deleted=0 AND $estimates_table.status='$status') ";
        } else if ($filter == "has_new_estimate_requests" || $filter == "has_estimate_requests_in_progress") {
            $status = "new";
            if ($filter == "has_estimate_requests_in_progress") {
                $status = "processing";
            }

            $query = " AND $clients_table.id IN(SELECT $estimate_requests_table.client_id FROM $estimate_requests_table WHERE $estimate_requests_table.deleted=0 AND $estimate_requests_table.status='$status') ";
        } else if ($filter == "has_open_tickets") {
            $query = " AND $clients_table.id IN(SELECT $tickets_table.client_id FROM $tickets_table WHERE $tickets_table.deleted=0 AND $tickets_table.status!='closed') ";
        } else if ($filter == "has_new_orders") {
            $query = " AND $clients_table.id IN(SELECT $orders_table.client_id FROM $orders_table WHERE $orders_table.deleted=0 AND $orders_table.status_id='1') ";
        } else if ($filter == "has_open_proposals" || $filter == "has_accepted_proposals" || $filter == "has_rejected_proposals") {
            $status = "sent";
            if ($filter == "has_accepted_proposals") {
                $status = "accepted";
            } else if ($filter == "has_rejected_proposals") {
                $status = "declined";
            }

            $query = " AND $clients_table.id IN(SELECT $proposals_table.client_id FROM $proposals_table WHERE $proposals_table.deleted=0 AND $proposals_table.status='$status') ";
        }

        return $query;
    }

    function get_primary_contact($client_id = 0, $info = false) {
        $users_table = $this->db->prefixTable('users');

        $sql = "SELECT $users_table.id, $users_table.first_name, $users_table.last_name
        FROM $users_table
        WHERE $users_table.deleted=0 AND $users_table.client_id=$client_id AND $users_table.is_primary_contact=1";
        $result = $this->db->query($sql);
        if ($result->resultID->num_rows) {
            if ($info) {
                return $result->getRow();
            } else {
                return $result->getRow()->id;
            }
        }
    }

    function add_remove_star($client_id, $user_id, $type = "add") {
        $clients_table = $this->db->prefixTable('clients');
        $client_id = $client_id ? $this->db->escapeString($client_id) : $client_id;

        $action = " CONCAT($clients_table.starred_by,',',':$user_id:') ";
        $where = " AND FIND_IN_SET(':$user_id:',$clients_table.starred_by) = 0"; //don't add duplicate

        if ($type != "add") {
            $action = " REPLACE($clients_table.starred_by, ',:$user_id:', '') ";
            $where = "";
        }

        $sql = "UPDATE $clients_table SET $clients_table.starred_by = $action
        WHERE $clients_table.id=$client_id $where";
        return $this->db->query($sql);
    }

    function get_starred_clients($user_id, $client_groups = "") {
        $clients_table = $this->db->prefixTable('clients');

        $where = $this->prepare_allowed_client_groups_query($clients_table, $client_groups);

        $sql = "SELECT $clients_table.id,  $clients_table.company_name
        FROM $clients_table
        WHERE $clients_table.deleted=0 AND FIND_IN_SET(':$user_id:',$clients_table.starred_by) $where
        ORDER BY $clients_table.company_name ASC";
        return $this->db->query($sql);
    }

    function delete_client_and_sub_items($client_id) {
        $clients_table = $this->db->prefixTable('clients');
        $general_files_table = $this->db->prefixTable('general_files');
        $users_table = $this->db->prefixTable('users');

        //get client files info to delete the files from directory 
        $client_files_sql = "SELECT * FROM $general_files_table WHERE $general_files_table.deleted=0 AND $general_files_table.client_id=$client_id; ";
        $client_files = $this->db->query($client_files_sql)->getResult();

        //delete the client and sub items
        //delete client
        $delete_client_sql = "UPDATE $clients_table SET $clients_table.deleted=1 WHERE $clients_table.id=$client_id; ";
        $this->db->query($delete_client_sql);

        //delete contacts
        $delete_contacts_sql = "UPDATE $users_table SET $users_table.deleted=1 WHERE $users_table.client_id=$client_id; ";
        $this->db->query($delete_contacts_sql);

        //delete the project files from directory
        $file_path = get_general_file_path("client", $client_id);
        foreach ($client_files as $file) {
            delete_app_files($file_path, array(make_array_of_file($file)));
        }

        return true;
    }

    function is_duplicate_company_name($company_name, $id = 0) {

        $result = $this->get_all_where(array("company_name" => $company_name, "is_lead" => 0, "deleted" => 0));
        if (count($result->getResult()) && $result->getRow()->id != $id) {
            return $result->getRow();
        } else {
            return false;
        }
    }

    function get_leads_kanban_details($options = array()) {
        $clients_table = $this->db->prefixTable('clients');
        $lead_source_table = $this->db->prefixTable('lead_source');
        $users_table = $this->db->prefixTable('users');
        $events_table = $this->db->prefixTable('events');
        $notes_table = $this->db->prefixTable('notes');
        $estimates_table = $this->db->prefixTable('estimates');
        $general_files_table = $this->db->prefixTable('general_files');
        $estimate_requests_table = $this->db->prefixTable('estimate_requests');

        $where = "";

        $status = $this->_get_clean_value($options, "status");
        if ($status) {
            $where .= " AND $clients_table.lead_status_id='$status'";
        }

        $owner_id = $this->_get_clean_value($options, "owner_id");
        if ($owner_id) {
            $where .= " AND $clients_table.owner_id='$owner_id'";
        }

        $source = $this->_get_clean_value($options, "source");
        if ($source) {
            $where .= " AND $clients_table.lead_source_id='$source'";
        }

        $search = get_array_value($options, "search");
        if ($search) {
            $search = $this->db->escapeLikeString($search);
            $where .= " AND $clients_table.company_name LIKE '%$search%' ESCAPE '!'";
        }

        $label_id = $this->_get_clean_value($options, "label_id");
        if ($label_id) {
            $where .= " AND (FIND_IN_SET('$label_id', $clients_table.labels)) ";
        }

        $custom_field_filter = get_array_value($options, "custom_field_filter");
        $custom_field_query_info = $this->prepare_custom_field_query_string("leads", "", $clients_table, $custom_field_filter);
        $custom_fields_where = get_array_value($custom_field_query_info, "where_string");

        $users_where = "$users_table.client_id=$clients_table.id AND $users_table.deleted=0 AND $users_table.user_type='lead'";

        $this->db->query('SET SQL_BIG_SELECTS=1');

        $sql = "SELECT $clients_table.id, $clients_table.company_name, $clients_table.sort, IF($clients_table.sort!=0, $clients_table.sort, $clients_table.id) AS new_sort, $clients_table.lead_status_id, $clients_table.owner_id,
                (SELECT $users_table.image FROM $users_table WHERE $users_where AND $users_table.is_primary_contact=1) AS primary_contact_avatar,
                (SELECT COUNT($users_table.id) FROM $users_table WHERE $users_where) AS total_contacts_count,
                (SELECT COUNT($events_table.id) FROM $events_table WHERE $events_table.deleted=0 AND $events_table.client_id=$clients_table.id) AS total_events_count,
                (SELECT COUNT($notes_table.id) FROM $notes_table WHERE $notes_table.deleted=0 AND $notes_table.client_id=$clients_table.id) AS total_notes_count,
                (SELECT COUNT($estimates_table.id) FROM $estimates_table WHERE $estimates_table.deleted=0 AND $estimates_table.client_id=$clients_table.id) AS total_estimates_count,
                (SELECT COUNT($general_files_table.id) FROM $general_files_table WHERE $general_files_table.deleted=0 AND $general_files_table.client_id=$clients_table.id) AS total_files_count,
                (SELECT COUNT($estimate_requests_table.id) FROM $estimate_requests_table WHERE $estimate_requests_table.deleted=0 AND $estimate_requests_table.client_id=$clients_table.id) AS total_estimate_requests_count,
                $lead_source_table.title AS lead_source_title,
                CONCAT($users_table.first_name, ' ', $users_table.last_name) AS owner_name
        FROM $clients_table 
        LEFT JOIN $lead_source_table ON $clients_table.lead_source_id = $lead_source_table.id 
        LEFT JOIN $users_table ON $users_table.id = $clients_table.owner_id AND $users_table.deleted=0 AND $users_table.user_type='staff' 
        WHERE $clients_table.deleted=0 AND $clients_table.is_lead=1 $where $custom_fields_where
        ORDER BY new_sort ASC";

        return $this->db->query($sql);
    }

    function get_search_suggestion($search = "", $options = array()) {
        $clients_table = $this->db->prefixTable('clients');

        $where = "";
        $show_own_clients_only_user_id = $this->_get_clean_value($options, "show_own_clients_only_user_id");
        if ($show_own_clients_only_user_id) {
            $where .= " AND ($clients_table.created_by=$show_own_clients_only_user_id OR $clients_table.owner_id=$show_own_clients_only_user_id)";
        }

        if ($search) {
            $search = $this->db->escapeLikeString($search);
        }

        $client_groups = $this->_get_clean_value($options, "client_groups");
        $where .= $this->prepare_allowed_client_groups_query($clients_table, $client_groups);

        $sql = "SELECT $clients_table.id, $clients_table.company_name AS title
        FROM $clients_table  
        WHERE $clients_table.deleted=0 AND $clients_table.is_lead=0 AND $clients_table.company_name LIKE '%$search%' ESCAPE '!' $where
        ORDER BY $clients_table.company_name ASC
        LIMIT 0, 10";

        return $this->db->query($sql);
    }

    function count_total_clients($options = array()) {
        $clients_table = $this->db->prefixTable('clients');
        $tickets_table = $this->db->prefixTable('tickets');
        $invoices_table = $this->db->prefixTable('invoices');
        $invoice_payments_table = $this->db->prefixTable('invoice_payments');
        $projects_table = $this->db->prefixTable('projects');
        $estimates_table = $this->db->prefixTable('estimates');
        $estimate_requests_table = $this->db->prefixTable('estimate_requests');
        $orders_table = $this->db->prefixTable('orders');
        $proposals_table = $this->db->prefixTable('proposals');

        $where = "";

        $show_own_clients_only_user_id = $this->_get_clean_value($options, "show_own_clients_only_user_id");
        if ($show_own_clients_only_user_id) {
            $where .= " AND $clients_table.created_by=$show_own_clients_only_user_id";
        }

        $filter = $this->_get_clean_value($options, "filter");
        if ($filter) {
            $where .= $this->make_quick_filter_query($filter, $clients_table, $projects_table, $invoices_table, $invoice_payments_table, $estimates_table, $estimate_requests_table, $tickets_table, $orders_table, $proposals_table);
        }

        $client_groups = $this->_get_clean_value($options, "client_groups");
        $where .= $this->prepare_allowed_client_groups_query($clients_table, $client_groups);

        $sql = "SELECT COUNT($clients_table.id) AS total
        FROM $clients_table 
        WHERE $clients_table.deleted=0 AND $clients_table.is_lead=0 $where";
        return $this->db->query($sql)->getRow()->total;
    }

    function get_conversion_rate_with_currency_symbol() {
        $clients_table = $this->db->prefixTable('clients');

        $sql = "SELECT $clients_table.currency_symbol, $clients_table.currency
        FROM $clients_table 
        WHERE $clients_table.deleted=0 AND $clients_table.currency!='' AND $clients_table.currency IS NOT NULL
        GROUP BY $clients_table.currency";
        return $this->db->query($sql);
    }

    function count_total_leads($options = array()) {
        $clients_table = $this->db->prefixTable('clients');

        $where = "";
        $show_own_leads_only_user_id = $this->_get_clean_value($options, "show_own_leads_only_user_id");
        if ($show_own_leads_only_user_id) {
            $where .= " AND $clients_table.owner_id=$show_own_leads_only_user_id";
        }

        $sql = "SELECT COUNT($clients_table.id) AS total
        FROM $clients_table 
        WHERE $clients_table.deleted=0 AND $clients_table.is_lead=1 $where";
        return $this->db->query($sql)->getRow()->total;
    }

    function get_lead_statistics($options = array()) {
        $clients_table = $this->db->prefixTable('clients');
        $lead_status_table = $this->db->prefixTable('lead_status');

        try {
            $this->db->query("SET sql_mode = ''");
        } catch (\Exception $e) {
            
        }
        $where = "";

        $show_own_leads_only_user_id = $this->_get_clean_value($options, "show_own_leads_only_user_id");
        if ($show_own_leads_only_user_id) {
            $where .= " AND ($clients_table.owner_id=$show_own_leads_only_user_id)";
        }

        $converted_to_client = "SELECT COUNT($clients_table.id) AS total
        FROM $clients_table
        WHERE $clients_table.deleted=0 AND $clients_table.is_lead=0 AND $clients_table.lead_status_id!=0 $where";

        $lead_statuses = "SELECT COUNT($clients_table.id) AS total, $clients_table.lead_status_id, $lead_status_table.title, $lead_status_table.color
        FROM $clients_table
        LEFT JOIN $lead_status_table ON $lead_status_table.id = $clients_table.lead_status_id
        WHERE $clients_table.deleted=0 AND $clients_table.is_lead=1 $where
        GROUP BY $clients_table.lead_status_id
        ORDER BY $lead_status_table.sort ASC";

        $info = new \stdClass();
        $info->converted_to_client = $this->db->query($converted_to_client)->getRow()->total;
        $info->lead_statuses = $this->db->query($lead_statuses)->getResult();

        return $info;
    }

    function is_currency_editable($client_id) {
        $clients_table = $this->db->prefixTable('clients');
        $invoices_table = $this->db->prefixTable('invoices');
        $estimates_table = $this->db->prefixTable('estimates');
        $orders_table = $this->db->prefixTable('orders');
        $proposals_table = $this->db->prefixTable('proposals');
        $contracts_table = $this->db->prefixTable('contracts');
        $subscriptions_table = $this->db->prefixTable('subscriptions');

        $client_id = $this->db->escapeString($client_id);

        $invoices_sql = "SELECT $invoices_table.id
                        FROM $invoices_table
                        WHERE $invoices_table.deleted=0 
                        AND $invoices_table.client_id=$client_id AND $invoices_table.status!='draft' AND $invoices_table.status!='cancelled'
                        ORDER BY $invoices_table.id DESC LIMIT 1";

        $invoices_count = $this->db->query($invoices_sql)->getRow();
        $invoices_count = $invoices_count ? $invoices_count->id : 0;
        if ($invoices_count) {
            return false;
        }

        $estimates_sql = "SELECT $estimates_table.id 
                        FROM $estimates_table
                        WHERE $estimates_table.deleted=0 
                        AND $estimates_table.client_id=$client_id AND $estimates_table.status!='draft' AND $estimates_table.status!='declined'
                        ORDER BY $estimates_table.id DESC LIMIT 1";

        $estimates_count = $this->db->query($estimates_sql)->getRow();
        $estimates_count = $estimates_count ? $estimates_count->id : 0;
        if ($estimates_count) {
            return false;
        }

        $orders_sql = "SELECT $orders_table.id 
                        FROM $orders_table
                        WHERE $orders_table.deleted=0 AND $orders_table.client_id=$client_id
                        ORDER BY $orders_table.id DESC LIMIT 1";

        $orders_count = $this->db->query($orders_sql)->getRow();
        $orders_count = $orders_count ? $orders_count->id : 0;
        if ($orders_count) {
            return false;
        }

        $proposals_sql = "SELECT $proposals_table.id 
                        FROM $proposals_table
                        WHERE $proposals_table.deleted=0
                        AND $proposals_table.client_id=$client_id AND $proposals_table.status!='draft' AND $proposals_table.status!='declined'
                        ORDER BY $proposals_table.id DESC LIMIT 1";

        $proposals_count = $this->db->query($proposals_sql)->getRow();
        $proposals_count = $proposals_count ? $proposals_count->id : 0;
        if ($proposals_count) {
            return false;
        }

        $contracts_sql = "SELECT $contracts_table.id 
                        FROM $contracts_table
                        WHERE $contracts_table.deleted=0
                        AND $contracts_table.client_id=$client_id AND $contracts_table.status!='draft' AND $contracts_table.status!='declined'
                        ORDER BY $contracts_table.id DESC LIMIT 1";

        $contracts_count = $this->db->query($contracts_sql)->getRow();
        $contracts_count = $contracts_count ? $contracts_count->id : 0;
        if ($contracts_count) {
            return false;
        }

        $subscriptions_sql = "SELECT $subscriptions_table.id 
                        FROM $subscriptions_table
                        WHERE $subscriptions_table.deleted=0
                        AND $subscriptions_table.client_id=$client_id AND $subscriptions_table.status!='draft' AND $subscriptions_table.status!='cancelled'
                        ORDER BY $subscriptions_table.id DESC LIMIT 1";

        $subscriptions_count = $this->db->query($subscriptions_sql)->getRow();
        $subscriptions_count = $subscriptions_count ? $subscriptions_count->id : 0;
        if ($subscriptions_count) {
            return false;
        }

        //have nothing, the currency is editable
        return true;
    }

    function get_leads_team_members_summary($options = array()) {
        $clients_table = $this->db->prefixTable('clients');
        $users_table = $this->db->prefixTable('users');

        $clients_where = "";
        $created_date_from = $this->_get_clean_value($options, "created_date_from");
        $created_date_to = $this->_get_clean_value($options, "created_date_to");
        if ($created_date_from && $created_date_to) {
            $clients_where .= " AND ($clients_table.created_date BETWEEN '$created_date_from' AND '$created_date_to') ";
        }

        $source_id = $this->_get_clean_value($options, "source_id");
        if ($source_id) {
            $clients_where .= " AND $clients_table.lead_source_id='$source_id'";
        }


        $label_id = $this->_get_clean_value($options, "label_id");
        if ($label_id) {
            $clients_where .= " AND (FIND_IN_SET('$label_id', $clients_table.labels)) ";
        }

        $sql = "SELECT $users_table.id AS team_member_id, CONCAT($users_table.first_name, ' ',$users_table.last_name) AS team_member_name, $users_table.image, leads_details.status_total_meta, leads_migrated.converted_to_client
                FROM $users_table
                INNER JOIN(
                    SELECT leads_group_table.owner_id, GROUP_CONCAT(CONCAT(leads_group_table.lead_status_id,'_',leads_group_table.total_leads)) AS status_total_meta
                    FROM (SELECT $clients_table.owner_id, $clients_table.lead_status_id, COUNT(1) AS total_leads FROM $clients_table WHERE $clients_table.is_lead=1 AND $clients_table.deleted=0 $clients_where GROUP BY $clients_table.owner_id, $clients_table.lead_status_id) AS leads_group_table
                    GROUP BY leads_group_table.owner_id
                ) AS leads_details ON leads_details.owner_id = $users_table.id
                LEFT JOIN (SELECT $clients_table.owner_id, COUNT(1) AS converted_to_client FROM $clients_table WHERE $clients_table.is_lead=0 AND $clients_table.deleted=0 AND $clients_table.client_migration_date > '2000-01-01' $clients_where GROUP BY $clients_table.owner_id) as leads_migrated ON leads_migrated.owner_id = $users_table.id
                WHERE $users_table.deleted=0 AND $users_table.status='active' AND $users_table.user_type='staff'
                GROUP BY $users_table.id";
        return $this->db->query($sql);
    }

    function get_converted_to_client_statistics($options = array()) {
        $clients_table = $this->db->prefixTable('clients');
        $users_table = $this->db->prefixTable('users');
        $lead_source_table = $this->db->prefixTable('lead_source');

        $where = "";

        $date_range_type = $this->_get_clean_value($options, "date_range_type");

        $start_date = $this->_get_clean_value($options, "start_date");
        $end_date = $this->_get_clean_value($options, "end_date");
        
        $date_group_by_field = "$clients_table.created_date";

        if ($start_date && $end_date && $date_range_type == "created_date_wise") {
            $where .= " AND ($clients_table.created_date BETWEEN '$start_date' AND '$end_date') ";
        } else if ($start_date && $end_date) {
            $where .= " AND ($clients_table.client_migration_date BETWEEN '$start_date' AND '$end_date') ";
            $date_group_by_field = "$clients_table.client_migration_date";
        }

        $owner_id = $this->_get_clean_value($options, "owner_id");
        if ($owner_id) {
            $where .= " AND $clients_table.owner_id=$owner_id";
        }

        $source_id = $this->_get_clean_value($options, "source_id");
        if ($source_id) {
            $where .= " AND $clients_table.lead_source_id=$source_id";
        }

        $group_by = $this->_get_clean_value($options, "group_by");

        $sql = "";

        if ($group_by == "created_date") {
            $sql = "SELECT DATE_FORMAT($date_group_by_field,'%d') AS day, SUM(1) total_converted
                FROM $clients_table 
                WHERE $clients_table.is_lead=0 AND $clients_table.deleted=0 AND $clients_table.client_migration_date > '2000-01-01' $where
                GROUP BY DATE($date_group_by_field)";
        } else if ($group_by == "owner_id") {
            $sql = "SELECT $clients_table.owner_id, SUM(1) total_converted, CONCAT($users_table.first_name, ' ' ,$users_table.last_name) AS owner_name  
                FROM $clients_table 
                LEFT JOIN $users_table ON $users_table.id = $clients_table.owner_id
                WHERE $clients_table.is_lead=0 AND $clients_table.deleted=0 AND $clients_table.client_migration_date > '2000-01-01' $where
                GROUP BY $clients_table.owner_id";
        } else if ($group_by == "source_id") {
            $sql = "SELECT $clients_table.lead_source_id, SUM(1) total_converted, $lead_source_table.title
                FROM $clients_table 
                LEFT JOIN $lead_source_table ON $lead_source_table.id = $clients_table.lead_source_id
                WHERE $clients_table.is_lead=0 AND $clients_table.deleted=0 AND $clients_table.client_migration_date > '2000-01-01' $where
                GROUP BY $clients_table.lead_source_id";
        }

        return $this->db->query($sql);
    }

}
