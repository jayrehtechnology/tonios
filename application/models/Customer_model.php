<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Customer_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Manila');


        $this->load->database();

    }

	public function get_customer_data() {
        
        $this->db->select('a.*, b.fullname');
		$this->db->from('tonios_customers a');
		$this->db->join('tonios_employee b', 'a.agent_id = b.id', 'left');

		$query = $this->db->get();
        return $query->result();

	}

	public function get_customer_data_1() {
        
        $this->db->select('a.*, b.fullname');
		$this->db->from('tonios_customers a');
		$this->db->join('tonios_employee b', 'a.agent_id = b.id', 'left');
		$this->db->where("a.customer_type !=''");

		$query = $this->db->get();
        return $query->result();

	}


	public function get_orders_data($id) {
        
      

		if($id !=''){

			$this->db->select('a.*,sum(a.quantity)total_quantity, sum(a.total) total, b.customer_name,b.customer_contact,b.customer_address');
			$this->db->from('tonios_customer_orders a');
			$this->db->join('tonios_customers b', 'a.customer_id = b.id', 'left');
			$this->db->where("a.agent_id", $id);

		} else {

			$this->db->select('a.*,b.customer_name,b.customer_contact,b.customer_address,c.fullname');
			$this->db->from('tonios_customer_orders a');
			$this->db->join('tonios_customers b', 'a.customer_id = b.id', 'left');
			$this->db->join('tonios_employee c', 'a.agent_id = c.id', 'left');
			
		}

		$this->db->group_by('a.trans_code'); 

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

	public function update_customer_order($data) {

		$this->db->where("id", $data['id']);
        $this->db->update('tonios_customer_orders', $data);
        
        return $this->db->affected_rows();

	}

	

	public function process_customers($data) {

        
	    $this->db->insert('tonios_customers',$data);

		return $this->db->affected_rows() > 0;
	}

	public function process_customer_order($data) {

        
	    $this->db->insert('tonios_customer_orders',$data);

		return $this->db->affected_rows() > 0;
	}


	public function process_pullout_order($data) {

        
	    $this->db->insert('tonios_pull_out_products',$data);

		return $this->db->affected_rows() > 0;
	}

	


	public function process_charity_order($data) {

        
	    $this->db->insert('tonios_charity_orders',$data);

		return $this->db->affected_rows() > 0;
	}



	public function update_customers($data) {

		$this->db->where("id", $data['id']);
        $this->db->update('tonios_customers', $data);
        
        return $this->db->affected_rows();

	}

	public function delete_customers($data) {

		$this->db->where("id", $data['id']);
        $this->db->delete('tonios_customers', $data);
        
        return $this->db->affected_rows();

	}

	public function remove_order($data) {

		$this->db->where("trans_code", $data['trans_code']);
        $this->db->delete('tonios_customer_orders', $data);
        
        return $this->db->affected_rows();

	}

	public function process_removed_charity($data) {

		$this->db->where("trans_code", $data['trans_code']);
        $this->db->delete('tonios_charity_orders', $data);
        
        return $this->db->affected_rows();

	}


	public function process_charity($data) {

		$this->db->where("trans_code", $data['trans_code']);
        $this->db->update('tonios_charity_orders', $data);
        
        return $this->db->affected_rows();

	}

	


}
	
?>