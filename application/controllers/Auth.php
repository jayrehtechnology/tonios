<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');

    }

	public function index()
	{
		$this->load->view('login/front/header');
		$this->load->view('login/front/index');
		$this->load->view('login/front/footer');

	}

	public function admin()
	{
		$this->load->view('login/administrator/header');
		$this->load->view('login/administrator/index');
		$this->load->view('login/administrator/footer');

	}
}
