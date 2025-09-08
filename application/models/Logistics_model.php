<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Logistics_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Manila');


        $this->load->database();

    }


    public function get_orders_data($data) {
        
			
			$this->db->select('a.*,sum(total_return) total_return,sum(a.delivered_quantity) total_delivered,sum(a.delivered_quantity * a.price) total_amount_delivered,sum(a.quantity)total_qty,sum(a.process_quantity)process_quantity,sum(a.process_quantity * a.price) totalprocesssum, sum(a.total) total_amount , b.customer_name,b.customer_contact,b.customer_address,c.fullname');
			$this->db->from('tonios_customer_orders a');
			$this->db->join('tonios_customers b', 'a.customer_id = b.id', 'left');
			$this->db->join('tonios_employee c', 'a.assign_logistic = c.id', 'left');
			$this->db->where("a.status", $data);
			$this->db->group_by('a.trans_code'); 
	
		
 
		$query = $this->db->get();

        return $query->result();

	}

	
    public function get_for_collection_data($data) {
        
        $this->db->select('a.*,b.customer_name');
		$this->db->from('tonios_sales_credit a');
        $this->db->join('tonios_customers b', 'b.id = a.customer_id', 'left'); // LEFT JOIN
		$this->db->where("a.assigned_logistics", $data);
		$query = $this->db->get();
        return $query->result();

	}



	public function process_delivery_completed($data) {

		$id       = $data['id'];
		$quantity = $data['quantity'];

		$this->db->query("UPDATE `tonios_customer_orders` SET `is_delivered_complete` = '1' , delivered_quantity = '$quantity'  WHERE `id` = '$id'");


		return $this->db->affected_rows() > 0;
	}

	public function process_delivery_return($data) {

		$id             = $data['id'];
		$return         = $data['total_return'];
		$quantity       = $data['quantity'];
		$return_reason  = $data['return_reason'];

		$delivered = $quantity - $return;

		$this->db->query("UPDATE `tonios_customer_orders` SET `is_delivered_complete` = '2', delivered_quantity = '$delivered' , total_return='$return', return_reason='$return_reason' WHERE `id` = '$id'");


		return $this->db->affected_rows() > 0;
	}

    public function process_delivered($data) {

		$trans_code      = $data['trans_code'];
		$total_collected = $data['total_collected'];
		$mop             = $data['mop'];
		$receipt         = $data['receipt'];
		$is_credit       = $data['is_credit_sales'];
		$balance         = $data['balance'];
		$delivered_date  = date('Y-m-d H:i:s');

		$this->db->query("UPDATE `tonios_customer_orders` SET `status` = '4' , total_collected='$total_collected', mop='$mop', receipt = '$receipt' , is_credit_sales='$is_credit', balance='$balance' , delivered_date='$delivered_date' WHERE `trans_code` = '$trans_code'");


		return $this->db->affected_rows() > 0;
	}

	public function process_credits($data) {

		$this->db->insert('tonios_sales_credit',$data);

		return $this->db->affected_rows() > 0;
	}


	public function process_collection($data) {

        
	    $this->db->insert('tonios_collection_records',$data);

		return $this->db->affected_rows() > 0;
	}

	public function process_collection_1($data) {

		$id      = $data['id'];
		$total_collected = $data['total_collected'];

		$this->db->query("UPDATE `tonios_sales_credit` SET `paid_amount` = paid_amount + '$total_collected' , is_collected = 1 WHERE `id` = '$id'");


		return $this->db->affected_rows() > 0;
	}


	public function get_pullout_products_data() {
        
        $this->db->select('a.*, b.customer_name');
		$this->db->from('tonios_pull_out_products a');
        $this->db->join('tonios_customers b', 'b.id = a.customer_id', 'left'); // LEFT JOIN

		$this->db->group_by('a.trans_code'); 

		$query = $this->db->get();
        return $query->result();

	}


	

}
	
?>