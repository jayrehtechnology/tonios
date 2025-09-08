<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url');
        $this->load->model('authentication_model');

    }
    public function index() {

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		
		$username = $this->input->post('username');
		$password = $this->input->post('password');
        
		$data = array(
				'username' => $username,
				'password' => $password,
			);

		$login = $this->security->xss_clean($data);

		$result = $this->authentication_model->authentication($login);

		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

		echo json_encode($response);

	}
	

}
