<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Accounting_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Manila');


        $this->load->database();

    }


    public function get_orders_data($data, $lid) {
			
			$this->db->select('a.*,
			(SELECT COUNT(*) FROM tonios_customer_orders dd WHERE dd.is_delivered_complete = 2 AND dd.trans_code = a.trans_code ) AS orders_with_status_2,
			(SELECT COUNT(*) FROM tonios_customer_orders dd WHERE dd.is_returned = 1 AND dd.trans_code = a.trans_code ) AS orders_with_status_3,
			sum(total_return) total_return,sum(process_quantity) - sum(total_return) total_delivered,
			sum(a.quantity)total_qty,
			sum(a.delivered_quantity)process_quantity,
			sum(a.delivered_quantity * a.price) totalprocesssum, 
			sum(a.total) total_amount ,
			 b.customer_name,b.customer_contact,b.customer_address,c.fullname');
			$this->db->from('tonios_customer_orders a');
			$this->db->join('tonios_customers b', 'a.customer_id = b.id', 'left');
			$this->db->join('tonios_employee c', 'a.assign_logistic = c.id', 'left');
			$this->db->where("a.status", $data);
			$this->db->where("a.is_sales", 0);

			if($lid !=0){
				$this->db->where("a.assign_logistic", $lid);
			}

			$this->db->group_by('a.trans_code'); 
	
		
 
		$query = $this->db->get();

        return $query->result();

	}

	public function get_orders_data_1($data) {
			
		$this->db->select('a.*,(SELECT COUNT(*) FROM tonios_customer_orders dd WHERE dd.is_delivered_complete = 2 AND dd.trans_code = a.trans_code ) AS orders_with_status_2,(SELECT COUNT(*) FROM tonios_customer_orders dd WHERE dd.is_returned = 1 AND dd.trans_code = a.trans_code ) AS orders_with_status_3,sum(total_return) total_return,sum(process_quantity) - sum(total_return) total_delivered,sum(a.quantity)total_qty,sum(a.process_quantity)process_quantity, sum(a.total) total_amount , b.customer_name,b.customer_contact,b.customer_address,c.fullname');
		$this->db->from('tonios_customer_orders a');
		$this->db->join('tonios_customers b', 'a.customer_id = b.id', 'left');
		$this->db->join('tonios_employee c', 'a.assign_logistic = c.id', 'left');
		$this->db->where("a.status", $data);
		$this->db->where("a.is_sales", 1);

		$this->db->group_by('a.trans_code'); 

	

		$query = $this->db->get();

		return $query->result();

    }


	public function get_expenses_data() {
        
        $this->db->select('*');
		$this->db->from('tonios_expenses_reports');
		$query = $this->db->get();
        return $query->result();

	}


	public function get_payroll_data() {
        
        $this->db->select('*');
		$this->db->from('tonios_payroll');
		$query = $this->db->get();
        return $query->result();

	}

	public function get_daily_sales_data() {
        
        $this->db->select('*');
		$this->db->from('tonios_daily_sales');
		$query = $this->db->get();
        return $query->result();

	}


	public function get_daily_credit_sales($date) {
        
        $this->db->select('a.*, b.customer_name');
		$this->db->from('tonios_sales_reports a');
		$this->db->join('tonios_customers b', 'b.id = a.customer_id', 'left'); // LEFT JOIN
		$this->db->where('DATE(a.date_added)', $date); 
		$this->db->where('a.mop', 'FULL CREDIT'); 
		$this->db->or_where('a.is_credit_sales', 1);
		$query = $this->db->get();
		return $query->result();
	
	}

	public function get_daily_non_cash($date) {
        
        $this->db->select('a.*, b.customer_name');
		$this->db->from('tonios_sales_reports a');
		$this->db->join('tonios_customers b', 'b.id = a.customer_id', 'left'); // LEFT JOIN
		$this->db->where('DATE(a.date_added)', $date); 
		$this->db->where_not_in('a.mop', ['FULL CREDIT', 'CASH', 'PARTIAL CREDIT' , 'COLLECTION']);

		$query = $this->db->get();
		return $query->result();
	
	}

	public function get_for_collection_data() {
        
        $this->db->select('a.*,b.customer_name');
		$this->db->from('tonios_sales_credit a');
        $this->db->join('tonios_customers b', 'b.id = a.customer_id', 'left'); // LEFT JOIN

		$query = $this->db->get();
        return $query->result();

	}

	public function get_for_collection_records_data($data) {
        
        $this->db->select('a.*');
		$this->db->from('tonios_collection_records a');
		$this->db->where('sales_credit_id', $data); 

		$query = $this->db->get();
        return $query->result();

	}

	public function get_daily_cash($date) {
        
        $this->db->select('a.*, b.customer_name');
		$this->db->from('tonios_sales_reports a');
		$this->db->join('tonios_customers b', 'b.id = a.customer_id', 'left'); 
		$this->db->where('DATE(a.date_added)', $date); 
		$this->db->where('a.mop','CASH');

		$query = $this->db->get();
		return $query->result();
	
	}

	public function get_daily_collection($date) {
        
        $this->db->select('a.*, b.customer_name');
		$this->db->from('tonios_sales_reports a');
		$this->db->join('tonios_customers b', 'b.id = a.customer_id', 'left'); 
		$this->db->where('DATE(a.date_added)', $date); 
		$this->db->where('a.mop','COLLECTION');

		$query = $this->db->get();
		return $query->result();
	
	}


	public function get_payroll_list_data($data) {
        
        $this->db->select('*');
		$this->db->from('tonios_payroll_data');
		$this->db->where("payroll_id", $data);
		$query = $this->db->get();
        return $query->result();

	}

	public function get_reimbursement_data() {
        
        $this->db->select('*');
		$this->db->from('tonios_reimbursement');
		$query = $this->db->get();
        return $query->result();

	}

	public function get_order_list_data($trans) {
        
        $this->db->select('a.*,b.product_name');
		$this->db->from('tonios_customer_orders a');
		$this->db->join('tonios_products b', 'a.product_id = b.id', 'left');
		$this->db->where("a.trans_code", $trans);


		$query = $this->db->get();
        return $query->result();

	}


	

	public function process_returned($data) {

		$id = $data['id'];

		$this->db->query("UPDATE `tonios_customer_orders` SET `is_returned` = '1' WHERE `id` = '$id'");


		return $this->db->affected_rows() > 0;
	}

	public function process_endorse_warehouse($data) {

		$trans_code = $data['transaction'];

		$this->db->query("UPDATE `tonios_pull_out_products` SET `is_endorse` = '1' WHERE `trans_code` = '$trans_code'");


		return $this->db->affected_rows() > 0;
	}

	public function process_sales($data) {

		$transaction     = $data['transaction'];
		$total_sales     = $data['total_remittance'];

		$this->db->query("UPDATE `tonios_customer_orders` SET `is_sales` = '1' , total_sales='$total_sales' WHERE `trans_code` = '$transaction'");


		return $this->db->affected_rows() > 0;
	}


	public function process_collection($data) {

		$id     = $data['id'];

		$this->db->query("UPDATE `tonios_collection_records` SET `is_collected` = '1'  WHERE `id` = '$id'");


		return $this->db->affected_rows() > 0;
	}

    public function process_delivered($data) {

		$trans_code      = $data['trans_code'];
		$total_collected = $data['total_collected'];

		$this->db->query("UPDATE `tonios_customer_orders` SET `status` = '4' , total_collected='$total_collected' WHERE `trans_code` = '$trans_code'");


		return $this->db->affected_rows() > 0;
	}

	public function process_sales_1($data) {
        
	    $this->db->insert('tonios_sales_reports',$data);

		return $this->db->affected_rows() > 0;
	}

	public function process_reimbursement($data) {
        
	    $this->db->insert('tonios_reimbursement',$data);

		return $this->db->affected_rows() > 0;
	}

	public function process_payroll($data) {
        
	    $this->db->insert('tonios_payroll',$data);

		return $this->db->affected_rows() > 0;
	}

	public function process_payroll_list($data) {
        
	    $this->db->insert('tonios_payroll_data',$data);

		return $this->db->affected_rows() > 0;
	}

	public function process_daily_sales($data) {
        
	    $this->db->insert('tonios_daily_sales',$data);

		return $this->db->affected_rows() > 0;
	}
	

	public function delete_sales_reports($data) {

		$this->db->where("id", $data);
		$this->db->delete("tonios_daily_sales");
        
        return $this->db->affected_rows();

	}


}
	
?>