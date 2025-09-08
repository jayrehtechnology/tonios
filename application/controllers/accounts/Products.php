<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Asia/Manila");

class Products extends CI_Controller {

	public function __construct() {

        parent::__construct();
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

		ob_start();

        $this->load->model('products_model');
        $this->load->model('orders_model');

		if(!isset($this->session->userdata['logged_in']['user_id'])){
			redirect("auth");
		}

    }

	public function index()
	{

        $data['products'] = $this->products_model->get_products_data();

		$data['pending']     = $this->orders_model->get_orders_status(0);
        $data['approved']    = $this->orders_model->get_orders_status(1);
        $data['fordelivery'] = $this->orders_model->get_orders_status(2);
        $data['logistics']   = $this->orders_model->get_orders_status(3);
        $data['delivered']   = $this->orders_model->get_orders_status(4);
		$data['returned']    = $this->orders_model->get_orders_status(5);
		$data['pullout']     = $this->orders_model->get_pull_out();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/products/index', $data);
		$this->load->view('accounts/templates/footer');
	}

    public function process_products(){

        $product      = $this->input->post('product');
        $amount       = $this->input->post('amount');
        $description  = $this->input->post('description');

        $image      = addslashes(file_get_contents($_FILES['file']['tmp_name']));
		$image_name = addslashes($_FILES['file']['name']);
		$image_size = getimagesize($_FILES['file']['tmp_name']);
	
		
	
		move_uploaded_file($_FILES["file"]["tmp_name"], "assets/products/" . $_FILES["file"]["name"]);
		$location   =  $_FILES["file"]["name"];

		$data = array(

                'product_name'   => $product,
				'amount'         => $amount,
                'description'    => $description,
                'image'          => $location,
				'date_Added'     => date('Y-m-d H:i:s'),
  
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->products_model->process_products($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
		
		sleep(2);

        $this->session->set_flashdata('success', 'Product Added Successfully!');
		redirect("products");   


    }

    public function update_products(){

        $product      = $this->input->post('product');
        $amount       = $this->input->post('amount');
        $description  = $this->input->post('description');
        $id           = $this->input->post('id');

        
        if ($_FILES["file"]["name"] == '') {

            $location  = $this->input->post('file1');

        } else {

            $image      = addslashes(file_get_contents($_FILES['file']['tmp_name']));
            $image_name = addslashes($_FILES['file']['name']);
            $image_size = getimagesize($_FILES['file']['tmp_name']);
        
            move_uploaded_file($_FILES["file"]["tmp_name"], "assets/products/" . $_FILES["file"]["name"]);
            $location   =  $_FILES["file"]["name"];


        }

        $data = array(

            'product_name'   => $product,
            'amount'         => $amount,
            'description'    => $description,
            'image'          => $location,
            'id'             => $id,
            'date_Added'     => date('Y-m-d H:i:s'),

        );

		$process  = $this->security->xss_clean($data);
	
		$result = $this->products_model->update_products($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
		
		sleep(2);

        $this->session->set_flashdata('success', 'Product Updated Successfully!');
		redirect("products");   


    }

    public function delete_products(){

        $id        = $this->input->post('id');

		$data = array(

                'id'              => $id,
  
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->products_model->delete_products($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
		
		sleep(2);

        $this->session->set_flashdata('success', 'Product Deleted Successfully!');
		redirect("products");   


    }

}
