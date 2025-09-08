<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Profile_model extends CI_Model {

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

	public function get_profile_information($data) {
        
        $this->db->select('*');
		$this->db->from('tonios_employee');
		$this->db->where("id", $data);
        
		$query = $this->db->get();
        return $query->result();

	}

    public function update_profile($data) {
        

		$this->db->where('id', $data['id']);
        $this->db->update('tonios_employee', $data);
        
        return $this->db->affected_rows();

	}

	public function update_password($data) {
        

		$this->db->where('id', $data['id']);
        $this->db->update('tonios_employee', array("password"=> $this->hash($data['password']) ));
        
        return $this->db->affected_rows();

	}


    public function check_password($data) {
        
		$this->db->select('*');
		$this->db->from('tonios_employee');
		$this->db->where(array('id' => $data['id']));
		$query = $this->db->get();
		if ( $query->num_rows() > 0 ) {
				$datas 	      = $query->result();
				if($this->verifyHash($data['password'],$datas[0]->password) == TRUE){
					return '1';   
				} else {
					return '0';
				}
		} else {
				return '0';   
		}
	}




}
	
?>