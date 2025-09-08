<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Asia/Manila");

class Profile extends CI_Controller {

	public function __construct() {

        parent::__construct();
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

		ob_start();

        $this->load->model('profile_model');
        $this->load->model('orders_model');

		if(!isset($this->session->userdata['logged_in']['user_id'])){
			redirect("auth");
		}

    }

	public function index()
	{

        $data['profile']    = $this->profile_model->get_profile_information($this->session->userdata['logged_in']['user_id']);

		$data['pending']     = $this->orders_model->get_orders_status(0);
        $data['approved']    = $this->orders_model->get_orders_status(1);
        $data['fordelivery'] = $this->orders_model->get_orders_status(2);
        $data['logistics']   = $this->orders_model->get_orders_status(3);
        $data['delivered']   = $this->orders_model->get_orders_status(4);
		$data['returned']    = $this->orders_model->get_orders_status(5);
		$data['pullout']     = $this->orders_model->get_pull_out();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/profile/index',$data);
		$this->load->view('accounts/templates/footer');
	}

    public function update_profile(){
		$this->profile_model->update_profile($_POST);
		redirect('/profile?updated', 'refresh');
	}

	public function update_password(){
		$this->profile_model->update_password($_POST);
		redirect('/profile?password-updated', 'refresh');
	}

    public function check_password(){

		$result = $this->profile_model->check_password($_POST);
		echo $result;

	}

}
