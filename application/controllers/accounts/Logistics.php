<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Asia/Manila");

class Logistics extends CI_Controller {

	public function __construct() {

        parent::__construct();
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

		ob_start();

        $this->load->model('orders_model');
        $this->load->model('logistics_model');
        $this->load->model('customer_model');
        $this->load->model('products_model');


		if(!isset($this->session->userdata['logged_in']['user_id'])){
			redirect("auth");
		}

    }

	public function index()
	{
        $data['orders']    = $this->logistics_model->get_orders_data(3);

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/logistics/fordelivery', $data);
		$this->load->view('accounts/templates/footer');
	}

    public function delivered()
	{
        $data['orders']    = $this->logistics_model->get_orders_data(4);

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/logistics/delivered', $data);
		$this->load->view('accounts/templates/footer');
	}

    

    public function order_details()
	{
      
        $data['orders_list']   = $this->orders_model->get_order_list_data($_GET['transaction']);
		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/logistics/order_details', $data);
		$this->load->view('accounts/templates/footer');
	}


    public function process_delivery_completed(){

        $id            = $this->input->post('id');
        $transaction   = $this->input->post('transaction');
        $customer      = $this->input->post('customer');
        $quantity      = $this->input->post('quantity');

        $data = array(

            'is_delivered_complete'      => 1,
            'id'                         => $id,
            'quantity'                   => $quantity,

         );

		$process  = $this->security->xss_clean($data);
	
		$result = $this->logistics_model->process_delivery_completed($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

		sleep(2);

         $this->session->set_flashdata('success', ' Product Delivered Completely!');
        redirect('logistics/delivery-list?transaction='.$transaction.'&customer='.$customer);


    }

    public function process_delivery_return(){

        $id            = $this->input->post('id');
        $transaction   = $this->input->post('transaction');
        $customer      = $this->input->post('customer');
        $id            = $this->input->post('id');
        $total_return  = $this->input->post('total_return');
        $quantity      = $this->input->post('quantity');
        $return_reason = $this->input->post('return_reason');

        $data = array(

            'is_delivered_complete'      => 2,
            'id'                         => $id,
            'total_return'               => $total_return,
            'quantity'                   => $quantity,
            'return_reason'                   => $return_reason,

         );

		$process  = $this->security->xss_clean($data);
	
		$result = $this->logistics_model->process_delivery_return($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

		sleep(2);

         $this->session->set_flashdata('success', ' Product Delivered Completely!');
        redirect('logistics/delivery-list?transaction='.$transaction.'&customer='.$customer);


    }

    
	public function collection()
	{

        $data['collection'] = $this->logistics_model->get_for_collection_data($this->session->userdata['logged_in']['user_id']);
        $data['logistics'] = $this->orders_model->get_logistics_data();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/logistics/collection', $data);
		$this->load->view('accounts/templates/footer');
	}

    public function pullout()
	{

        $data['customer'] = $this->customer_model->get_customer_data_1();
        $data['products'] = $this->products_model->get_products_data();
        $data['pullout']  = $this->logistics_model->get_pullout_products_data();


		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/logistics/pullout', $data);
		$this->load->view('accounts/templates/footer');
	}

    public function process_delivered(){

        $trans_code       = $this->input->post('trans_code');
        $total_collected  = $this->input->post('total_collected');
        $mop              = $this->input->post('mop');
        $customer_id      = $this->input->post('customer_id');
        $is_partial       = $this->input->post('is_partial');

        echo json_encode($_POST);

       // exit;

        if(isset($is_partial)){

            $credit_amount = $this->input->post('credit_amount');
            $due_date      = $this->input->post('due_date');


            $data = array(

                'trans_code'          => $trans_code,
                'total_collected'     => $total_collected ,
                'mop'                 => $mop,
                'is_credit_sales'     => 1,
                'balance'             => $credit_amount,
             );

             $credit = array(

                'amount'              => $credit_amount,
                'due_date'            => $due_date,
                'customer_id'         => $customer_id,
                'trans_code'          => $trans_code,
                'date_added'          => date('Y-m-d H:i:s'),

             );


             $process  = $this->security->xss_clean($data);
             $credits  = $this->security->xss_clean($credit);

             $result = $this->logistics_model->process_delivered($process);
             $this->logistics_model->process_credits($credits);

        } else {

            if($mop == 'FULL CREDIT'){

                $data = array(

                    'trans_code'          => $trans_code,
                    'total_collected'     => 0,
                    'mop'                 => $mop,
                    'is_credit_sales'     => 1,
                    'balance'             => $total_collected,
                 );
    
                 $credit = array(
    
                    'amount'              => $total_collected,
                    'due_date'            => $due_date,
                    'customer_id'         => $customer_id,
                    'trans_code'          => $trans_code,
                    'date_added'          => date('Y-m-d H:i:s'),
    
                 );
    
    
                 $process  = $this->security->xss_clean($data);
                 $credits  = $this->security->xss_clean($credit);
    
                 $result = $this->logistics_model->process_delivered($process);
                 $this->logistics_model->process_credits($credits);
    

            } else {

                $image      = addslashes(file_get_contents($_FILES['file']['tmp_name']));
                $image_name = addslashes($_FILES['file']['name']);
                $image_size = getimagesize($_FILES['file']['tmp_name']);
                    
                        
                move_uploaded_file($_FILES["file"]["tmp_name"], "assets/receipt/" . $_FILES["file"]["name"]);
                $location   =  $_FILES["file"]["name"];
    
    
                $data = array(
    
                    'trans_code'          => $trans_code,
                    'total_collected'     => $total_collected,
                    'mop'                 => $mop,
                    'receipt'             => $location,
        
                 );

                 $process  = $this->security->xss_clean($data);
	
                 $result = $this->logistics_model->process_delivered($process);

            }
          
             

          
	

        }


       
      

		
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

		sleep(2);

         $this->session->set_flashdata('success', ' Transaction Delivered Completely!');
        redirect('logistics/delivery');


    }

    public function process_collection(){

        $id                = $this->input->post('id');
        $total_collected   = $this->input->post('total_collected');
        $mop               = $this->input->post('mop');


        $image      = addslashes(file_get_contents($_FILES['file']['tmp_name']));
        $image_name = addslashes($_FILES['file']['name']);
        $image_size = getimagesize($_FILES['file']['tmp_name']);
            
                
        move_uploaded_file($_FILES["file"]["tmp_name"], "assets/receipt/" . $_FILES["file"]["name"]);
        $location   =  $_FILES["file"]["name"];

        $data1 = array(

            'sales_credit_id'   => $id,
            'total_collected'   => $total_collected,
            'mop'               => $mop,
            'location'          => $location,
            'date_added'        => date('Y-m-d H:i:s'),

         );

         $data2 = array(

            'id'                => $id,
            'total_collected'   => $total_collected,

         );

		$process1  = $this->security->xss_clean($data1);
        $process2  = $this->security->xss_clean($data2);

		$result = $this->logistics_model->process_collection($process1);
        $this->logistics_model->process_collection_1($process2);

		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

		sleep(2);

         $this->session->set_flashdata('success', ' Collected Successfully!');
        redirect('logistics/collection');


    }

 
}
