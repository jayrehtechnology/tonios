<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Asia/Manila");

class Pettycash extends CI_Controller {

	public function __construct() {

        parent::__construct();
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

		ob_start();

        $this->load->model('pettycash_model');
        $this->load->model('orders_model');

		if(!isset($this->session->userdata['logged_in']['user_id'])){
			redirect("auth");
		}

    }

	public function index()
	{


		$data['pending']     = $this->orders_model->get_orders_status(0);
        $data['approved']    = $this->orders_model->get_orders_status(1);
        $data['fordelivery'] = $this->orders_model->get_orders_status(2);
        $data['logistics']   = $this->orders_model->get_orders_status(3);
        $data['delivered']   = $this->orders_model->get_orders_status(4);
		$data['returned']    = $this->orders_model->get_orders_status(5);
		$data['pullout']     = $this->orders_model->get_pull_out();


		if($this->session->userdata['logged_in']['position'] == 'Manager' && $this->session->userdata['logged_in']['department'] == 'Sales'){

			$data['petty']       = $this->pettycash_model->get_petty_cash_1();

		} else {

			$data['petty']       = $this->pettycash_model->get_petty_cash($this->session->userdata['logged_in']['user_id']);

		}


		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/pettycash/index',$data);
		$this->load->view('accounts/templates/footer');
	}

    
    public function process_petty_cash(){

        $or_number    = $this->input->post('or_number');
        $amount       = $this->input->post('amount');
        $description  = $this->input->post('description');
        $category     = $this->input->post('category');

        $image      = addslashes(file_get_contents($_FILES['file']['tmp_name']));
		$image_name = addslashes($_FILES['file']['name']);
		$image_size = getimagesize($_FILES['file']['tmp_name']);
	
		
	
		move_uploaded_file($_FILES["file"]["tmp_name"], "assets/pettycash/" . $_FILES["file"]["name"]);
		$location   =  $_FILES["file"]["name"];

		$data = array(

                'or_number'       => $or_number,
				'amount'          => $amount,
                'particulars'     => $description,
                'location'        => $location,
				'category'        => $category,
				'employee_id'     => $this->session->userdata['logged_in']['user_id'],
				'department'      => $this->session->userdata['logged_in']['department'],
				'date_added'      => date('Y-m-d H:i:s'),
  
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->pettycash_model->process_petty_cash($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

        sleep(2);

        $this->session->set_flashdata('success', ' Petty Cash Request  Successfully!');
		redirect("pettycash");   


    }


	public function process_approved_petty_cash(){

        $id    = $this->input->post('id');
     
		$data = array(

                'id'       => $id,
  
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->pettycash_model->process_approved_petty_cash($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

        sleep(2);

        $this->session->set_flashdata('success', ' Petty Cash Request  Approved!');
		redirect("pettycash");   


    }
	
}
