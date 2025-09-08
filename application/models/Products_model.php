<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Products_model extends CI_Model {

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

    public function process_products($data) {
        
	    $this->db->insert('tonios_products',$data);

		return $this->db->affected_rows() > 0;
	}

    public function update_products($data) {

		$this->db->where('id', $data['id']);
        $this->db->update('tonios_products', $data);
        
        return $this->db->affected_rows();

	}

    public function delete_products($data) {

		$this->db->where("id", $data['id']);
		$this->db->delete("tonios_products");
        
        return $this->db->affected_rows();

	}


	
}
	
?>