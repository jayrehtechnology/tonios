<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Warehouse_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Manila');


        $this->load->database();

    }

	public function get_products_data() {
        
        $this->db->select('*');
		$this->db->from('tonios_products');
		$query = $this->db->get();
        return $query->result();

	}

	

	public function process_stock_in($data) {

		// Adding Restock Data // 
        
	    $this->db->insert('tonios_warehouse_stock_in',$data);

		// Updating Restock Data // 

		$add = $data['quantity'];
		$id  = $data['product'];

		$this->db->query("UPDATE `tonios_products` SET `inventory_in` = `inventory_in` + $add WHERE `id` = $id");


		return $this->db->affected_rows() > 0;
	}


	public function process_receive_product($data) {


		$add           = $data['quantity'];
		$id            = $data['id'];
		$received_by   = $data['received_by'];
		$received_date = $data['received_date'];
		$is_complete   = $data['status'];
		$reason        = $data['reason'];

		$this->db->query("UPDATE `tonios_warehouse_stock_receivable` SET `received_quantity` = `received_quantity` + $add ,received_by='$received_by', received_date='$received_date',is_complete='$is_complete',reason='$reason'  WHERE `id` = $id");

		return $this->db->affected_rows() > 0;
	}


    public function get_stock_in_data() {
        
        $this->db->select('a.* , b.product_name  , c.firstname , c.lastname');
		$this->db->from('tonios_warehouse_stock_in a');
		$this->db->join('tonios_products b', 'a.product = b.id', 'left');
		$this->db->join('tonios_system_user c', 'c.id = a.process_by', 'left');

		$query = $this->db->get();
        return $query->result();

	}

	public function get_stock_out_data() {
        
        $this->db->select('a.* , b.product_name');
		$this->db->from('tonios_customer_orders a');
		$this->db->join('tonios_products b', 'a.product_id = b.id', 'left');

		$query = $this->db->get();
        return $query->result();

	}

	public function process_charity($data) {

		$this->db->where("trans_code", $data['trans_code']);
        $this->db->update('tonios_charity_orders', $data);
        
        return $this->db->affected_rows();

	}

	public function process_charity_order($data) {

		$this->db->where("id", $data['id']);
        $this->db->update('tonios_charity_orders', $data);


		$quantity = $data['quantity_done'];
		$product_id = $data['product_id'];


		$this->db->query("UPDATE `tonios_products` SET `inventory_in`  = inventory_in- '$quantity'  ,  inventory_out = inventory_out + '$quantity' WHERE `id` = '$product_id'");

        
        return $this->db->affected_rows();

	}

	
	public function get_pullout_data_1() {
        
		$this->db->select('a.*, b.customer_name');
		$this->db->from('tonios_pull_out_products a');
        $this->db->join('tonios_customers b', 'b.id = a.customer_id', 'left'); // LEFT JOIN
		$this->db->where("a.is_process",1);

		$this->db->group_by('a.trans_code'); 

		$query = $this->db->get();
        return $query->result();

	}

	public function process_pullout($data) {

		  // Update inventory if needed
		  if ($data['qty_for_inventory'] > 0) {
            $this->db->query("
                UPDATE tonios_products 
                SET inventory_in = inventory_in + {$data['qty_for_inventory']} 
                WHERE id = {$data['product_id']}
            ");
        }

	  // Update original pull out product record (status or mark processed)
        $this->db->where("trans_code", $data['trans_code']);
        $this->db->where("product_id", $data['product_id']);
        $this->db->update("tonios_pull_out_products", $data);



        
        return $this->db->affected_rows();

	}



	public function get_receivable_data() {
        
		$this->db->select('a.*,sum(a.quantity) total_quantity,sum(a.received_quantity) received_quantity,b.product_name');
		$this->db->from('tonios_warehouse_stock_receivable a');
		$this->db->join('tonios_products b', 'a.product = b.id', 'left');
		$this->db->group_by('a.batch_no'); 
		$query = $this->db->get();
        return $query->result();
	}

	public function get_receivable_list_data($data) {
        
		$this->db->select('a.*,b.product_name , b.id as product_id');
		$this->db->from('tonios_warehouse_stock_receivable a');
		$this->db->join('tonios_products b', 'a.product = b.id', 'left');
		$this->db->where("a.batch_no", $data);

		$query = $this->db->get();
        return $query->result();
	}


	public function get_expenses_data($data) {
        
        $this->db->select('*');
		$this->db->from('tonios_expenses_reports');
		$this->db->where('department', $data);
		$query = $this->db->get();
        return $query->result();

	}

	public function process_expenses_reports($data) {
        
	    $this->db->insert('tonios_expenses_reports',$data);

		return $this->db->affected_rows() > 0;
	}
	


	

}
	
?>