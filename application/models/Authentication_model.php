<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Manila');


class Authentication_Model extends CI_Model {

    public function __construct()  {
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        parent::__construct();

		$this->load->library('session');

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
	public function authentication($data){

		$user     = $this->user_authentication($data);

		if($user == 'success') { return 'user'; } 
		else {
			return "error";
		}
	}
	
	public function user_authentication($data) {
		$this->db->select('*');
		$this->db->from('tonios_employee');
		$this->db->where(array('email' => $data['username'], 'is_system' => 1));
		$query = $this->db->get();
		if ( $query->num_rows() > 0 ) {
				$datas 	      = $query->result();
				if($this->verifyHash($data['password'],$datas[0]->password) == TRUE){

							$session_data = array(
                                    'user_id'          => $datas[0]->id,
                                    'fullname'         => $datas[0]->fullname,
                                    'email'            => $datas[0]->email,
                                    'position'         => $datas[0]->position,
									'department'       => $datas[0]->department,
									'name'             => $datas[0]->fullname ,
								);
							$this->session->set_userdata('logged_in', $session_data);
							
					return 'success';   
				} else {
					return 'fail';
				}
		} else {
				return 'fail';   
		}
	}



}