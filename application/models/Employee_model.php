<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Employee_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Manila');


        $this->load->database();

    }

	public function get_employee_data() {
        
        $this->db->select('*');
		$this->db->from('tonios_employee a');
		$query = $this->db->get();
        return $query->result();

	}

	

	public function process_employee($data) {

        
	    $this->db->insert('tonios_employee',$data);

		return $this->db->affected_rows() > 0;
	}


	public function update_employee($data) {

		$this->db->where("id", $data['id']);
        $this->db->update('tonios_employee', $data);
        
        return $this->db->affected_rows();

	}

	public function delete_employee($data) {

		$this->db->where("id", $data['id']);
        $this->db->delete('tonios_employee', $data);
        
        return $this->db->affected_rows();

	}


}
	
?>