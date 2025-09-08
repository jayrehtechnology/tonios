<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Production_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Manila');


        $this->load->database();

    }

	public function get_category_data() {
        
        $this->db->select('*');
		$this->db->from('tonios_production_inventory_category');
		$query = $this->db->get();
        return $query->result();

	}

	public function get_inventory_data() {
        
        $this->db->select('a.* , b.category as cat_name');
		$this->db->from('tonios_production_inventory a');
		$this->db->join('tonios_production_inventory_category b', 'a.category = b.id', 'left');
		$query = $this->db->get();
        return $query->result();

	}

	public function get_inventory_data_1() {
        
        $this->db->select('*');
		$this->db->from('tonios_production_inventory');
		$query = $this->db->get();
        return $query->result();

	}

	public function get_endorsed_data() {
        
        $this->db->select('a.* , b.product, b.unit');
		$this->db->from('tonios_production_inventory_reduction a');
		$this->db->join('tonios_production_inventory b', 'a.product = b.id', 'left');
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

	public function get_finish_data() {
        
		$this->db->select('a.*,sum(a.quantity) total_quantity,b.product_name');
		$this->db->from('tonios_warehouse_stock_receivable a');
		$this->db->join('tonios_products b', 'a.product = b.id', 'left');
		$this->db->group_by('a.batch_no'); 
		$query = $this->db->get();
        return $query->result();
	}

	public function check_production_inventory($data) {
        
        $this->db->select('*');
		$this->db->from('tonios_production_inventory');
		$this->db->like('product', $data, 'both'); 

		$query = $this->db->get();
        return $query->result();

	}



	public function get_restocks_data() {
        
        $this->db->select('a.* , b.product , b.unit ');
		$this->db->from('tonios_production_inventory_restock a');
		$this->db->join('tonios_production_inventory b', 'a.product = b.id', 'left');

		$query = $this->db->get();
        return $query->result();

	}

	public function get_reduction_data() {
        
        $this->db->select('a.* , b.product , b.unit ');
		$this->db->from('tonios_production_inventory_reduction a');
		$this->db->join('tonios_production_inventory b', 'a.product = b.id', 'left');

		$query = $this->db->get();
        return $query->result();

	}


	public function process_production_inventory($data) {
        
	    $this->db->insert('tonios_production_inventory',$data);

		return $this->db->affected_rows() > 0;
	}

	public function process_production_inventory_restock($data) {

		// Adding Restock Data // 
        
	    $this->db->insert('tonios_production_inventory_restock',$data);

		// Updating Restock Data // 

		$add = $data['quantity'];
		$id  = $data['product'];

		$this->db->query("UPDATE `tonios_production_inventory` SET `quantity` = `quantity` + $add WHERE `id` = $id");


		return $this->db->affected_rows() > 0;
	}

	public function process_production_inventory_reduction($data) {

       // Adding Out Data // 

	    $this->db->insert('tonios_production_inventory_reduction',$data);

		// Updating Out Data // 

		$add = $data['quantity'];
		$id  = $data['product'];

		$this->db->query("UPDATE `tonios_production_inventory` SET `quantity` = `quantity` - $add WHERE `id` = $id");

		return $this->db->affected_rows() > 0;
	}

	public function process_expenses_reports($data) {
        
	    $this->db->insert('tonios_expenses_reports',$data);

		return $this->db->affected_rows() > 0;
	}

	public function update_production_inventory($data) {

		$this->db->where('id', $data['id']);
        $this->db->update('tonios_production_inventory', $data);
        
        return $this->db->affected_rows();

	}

	public function process_production_inventory_category($data) {
        
	    $this->db->insert('tonios_production_inventory_category',$data);

		return $this->db->affected_rows() > 0;
	}

	public function update_production_inventory_category($data) {

		$this->db->where('id', $data['id']);
        $this->db->update('tonios_production_inventory_category', $data);
        
        return $this->db->affected_rows();

	}

	public function delete_production_inventory_category($data) {

		$this->db->where("id", $data['id']);
		$this->db->delete("tonios_production_inventory_category");
        
        return $this->db->affected_rows();

	}

	public function delete_expenses_reports($data) {

		$this->db->where("id", $data['id']);
		$this->db->delete("tonios_expenses_reports");
        
        return $this->db->affected_rows();

	}

	public function received_endorse_inventory($data) {

		$this->db->where('id', $data['id']);
        $this->db->update('tonios_production_inventory_reduction', $data);
        
        return $this->db->affected_rows();

	}

	public function process_finish_products($data) {

        
	    $this->db->insert('tonios_warehouse_stock_receivable',$data);

		return $this->db->affected_rows() > 0;
	}

	public function remove_batch_products($data) {

		$this->db->where("batch_no", $data);
		$this->db->delete("tonios_warehouse_stock_receivable");
        
        return $this->db->affected_rows();

	}

	public function endorse_batch_products($data) {

		$this->db->where('batch_no', $data['batch_no']);
        $this->db->update('tonios_warehouse_stock_receivable', $data);
        
        return $this->db->affected_rows();

	}




}
	
?>