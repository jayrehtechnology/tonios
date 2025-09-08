<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Sales_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Manila');


        $this->load->database();

    }

	public function get_agent_data() {
        
        $this->db->select('*');
		$this->db->from('tonios_employee');
		$this->db->where('position', 'Sales Agent');
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


    public function get_charity_data($data) {
        
       

        if($data == 1){

            $this->db->select('*, sum(quantity) total_qty, sum(quantity_done) total_done_qty ');
            $this->db->from('tonios_charity_orders');
            $this->db->where('status IN (3,4,5)');
            
        } else {

            $this->db->select('*');
            $this->db->from('tonios_charity_orders');
        }

        $this->db->group_by('trans_code'); 

      

		$query = $this->db->get();
        return $query->result();

	}


    public function get_order_list_data($trans) {
        
        $this->db->select('a.*,b.product_name');
		$this->db->from('tonios_charity_orders a');
		$this->db->join('tonios_products b', 'a.product_id = b.id', 'left');
		$this->db->where("a.trans_code", $trans);


		$query = $this->db->get();
        return $query->result();

	}

	

	public function process_sales_agent($data) {

        
	    $this->db->insert('tonios_employee',$data);

		return $this->db->affected_rows() > 0;
	}

    public function update_sales_agent($data) {

		$this->db->where('id', $data['id']);
        $this->db->update('tonios_employee', $data);
        
        return $this->db->affected_rows();

	}


    public function update_customer_order($data) {

		$this->db->where("id", $data['id']);
        $this->db->update('tonios_customer_orders', $data);
        
        return $this->db->affected_rows();

	}

    public function process_assigned_collection($data) {

		$this->db->where("id", $data['id']);
        $this->db->update('tonios_sales_credit', $data);
        
        return $this->db->affected_rows();

	}



	

}
	
?>