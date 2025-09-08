<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Pettycash_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Manila');


        $this->load->database();

    }

    public function verifyHash($password,$vpassword) {
		if(password_verify($password,$vpassword))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	 }

	public function get_petty_cash($data) {
        
        $this->db->select('*');
		$this->db->from('tonios_petty_cash_request');
		$this->db->where("employee_id", $data);
        
		$query = $this->db->get();
        return $query->result();

	}

	public function get_petty_cash_1() {
        
        $this->db->select('*');
		$this->db->from('tonios_petty_cash_request');
		$this->db->where_in("department", ['Logistics', 'Sales']); // Where department is Logistics or Sales
        
		$query = $this->db->get();
        return $query->result();

	}


    public function process_petty_cash($data) {
        
	    $this->db->insert('tonios_petty_cash_request',$data);

		return $this->db->affected_rows() > 0;
	}

	public function process_approved_petty_cash($data) {

		$id   = $data['id'];
		$date = date('Y-m-d H:i:s');

		$this->db->query("UPDATE `tonios_petty_cash_request` SET `is_status` = '1', manager_approved_date = '$date' WHERE `id` = '$id'");


		return $this->db->affected_rows() > 0;
	}


}
	
?>