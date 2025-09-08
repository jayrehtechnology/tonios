<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Asia/Manila");

class Warehouse extends CI_Controller {

	public function __construct() {

        parent::__construct();
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

		ob_start();

        $this->load->model('warehouse_model');
		$this->load->model('customer_model');
        $this->load->model('sales_model');
        $this->load->model('products_model');
        $this->load->model('orders_model');

        
		if(!isset($this->session->userdata['logged_in']['user_id'])){
			redirect("auth");
		}

    }

	public function inventory()
	{
        $data['products'] = $this->warehouse_model->get_products_data();
		$data['pending']     = $this->orders_model->get_orders_status(0);
        $data['approved']    = $this->orders_model->get_orders_status(1);
        $data['fordelivery'] = $this->orders_model->get_orders_status(2);
        $data['logistics']   = $this->orders_model->get_orders_status(3);
        $data['delivered']   = $this->orders_model->get_orders_status(4);
		$data['returned']    = $this->orders_model->get_orders_status(5);
		$data['pullout']     = $this->orders_model->get_pull_out();
		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/warehouse/inventory', $data);
		$this->load->view('accounts/templates/footer');
	}

	
	public function pulled_out()
	{
        $data['pullouts']    = $this->warehouse_model->get_pullout_data_1();
		$data['pending']     = $this->orders_model->get_orders_status(0);
        $data['approved']    = $this->orders_model->get_orders_status(1);
        $data['fordelivery'] = $this->orders_model->get_orders_status(2);
        $data['logistics']   = $this->orders_model->get_orders_status(3);
        $data['delivered']   = $this->orders_model->get_orders_status(4);
		$data['returned']    = $this->orders_model->get_orders_status(5);
		$data['pullout']     = $this->orders_model->get_pull_out();
		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/warehouse/pulled_out', $data);
		$this->load->view('accounts/templates/footer');
	}


	public function receivable()
	{
        $data['products'] = $this->warehouse_model->get_receivable_data();
		$data['pending']     = $this->orders_model->get_orders_status(0);
        $data['approved']    = $this->orders_model->get_orders_status(1);
        $data['fordelivery'] = $this->orders_model->get_orders_status(2);
        $data['logistics']   = $this->orders_model->get_orders_status(3);
        $data['delivered']   = $this->orders_model->get_orders_status(4);
		$data['returned']    = $this->orders_model->get_orders_status(5);
		$data['pullout']     = $this->orders_model->get_pull_out();
		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/warehouse/receivable', $data);
		$this->load->view('accounts/templates/footer');
	}

	public function receivable_details()
	{
        $data['products'] = $this->warehouse_model->get_receivable_list_data($_GET['batch_no']);
		$data['pending']     = $this->orders_model->get_orders_status(0);
        $data['approved']    = $this->orders_model->get_orders_status(1);
        $data['fordelivery'] = $this->orders_model->get_orders_status(2);
        $data['logistics']   = $this->orders_model->get_orders_status(3);
        $data['delivered']   = $this->orders_model->get_orders_status(4);
		$data['returned']    = $this->orders_model->get_orders_status(5);
		$data['pullout']     = $this->orders_model->get_pull_out();
		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/warehouse/receivable-details', $data);
		$this->load->view('accounts/templates/footer');
	}


	public function charity()
	{

		$data['customer'] = $this->customer_model->get_customer_data();
        $data['agent']    = $this->sales_model->get_agent_data();
        $data['products'] = $this->products_model->get_products_data();
        $data['charity'] = $this->sales_model->get_charity_data(1);
		$data['pending']     = $this->orders_model->get_orders_status(0);
        $data['approved']    = $this->orders_model->get_orders_status(1);
        $data['fordelivery'] = $this->orders_model->get_orders_status(2);
        $data['logistics']   = $this->orders_model->get_orders_status(3);
        $data['delivered']   = $this->orders_model->get_orders_status(4);
		$data['returned']    = $this->orders_model->get_orders_status(5);
		$data['pullout']     = $this->orders_model->get_pull_out();
		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/warehouse/charity', $data);
		$this->load->view('accounts/templates/footer');
	}

	public function order_details()
	{

        $data['customer']      = $this->customer_model->get_customer_data();
        $data['agent']         = $this->sales_model->get_agent_data();
        $data['products']      = $this->products_model->get_products_data();
        $data['orders_list']   = $this->sales_model->get_order_list_data($_GET['transaction']);
		$data['pending']     = $this->orders_model->get_orders_status(0);
        $data['approved']    = $this->orders_model->get_orders_status(1);
        $data['fordelivery'] = $this->orders_model->get_orders_status(2);
        $data['logistics']   = $this->orders_model->get_orders_status(3);
        $data['delivered']   = $this->orders_model->get_orders_status(4);
		$data['returned']    = $this->orders_model->get_orders_status(5);
		$data['pullout']     = $this->orders_model->get_pull_out();
		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/warehouse/order_details', $data);
		$this->load->view('accounts/templates/footer');
	}

    public function stock_in()
	{
        $data['stock_in'] = $this->warehouse_model->get_stock_in_data();
		$data['pending']     = $this->orders_model->get_orders_status(0);
        $data['approved']    = $this->orders_model->get_orders_status(1);
        $data['fordelivery'] = $this->orders_model->get_orders_status(2);
        $data['logistics']   = $this->orders_model->get_orders_status(3);
        $data['delivered']   = $this->orders_model->get_orders_status(4);
		$data['returned']    = $this->orders_model->get_orders_status(5);
		$data['pullout']     = $this->orders_model->get_pull_out();
		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/warehouse/stock_in', $data);
		$this->load->view('accounts/templates/footer');
	}

	public function stock_out()
	{
        $data['stock_in'] = $this->warehouse_model->get_stock_out_data();
		$data['pending']     = $this->orders_model->get_orders_status(0);
        $data['approved']    = $this->orders_model->get_orders_status(1);
        $data['fordelivery'] = $this->orders_model->get_orders_status(2);
        $data['logistics']   = $this->orders_model->get_orders_status(3);
        $data['delivered']   = $this->orders_model->get_orders_status(4);
		$data['returned']    = $this->orders_model->get_orders_status(5);
		$data['pullout']     = $this->orders_model->get_pull_out();
		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/warehouse/stock_out', $data);
		$this->load->view('accounts/templates/footer');
	}

	public function expenses()
	{
        $data['expenses'] = $this->warehouse_model->get_expenses_data($this->session->userdata['logged_in']['department']);
		$data['pending']     = $this->orders_model->get_orders_status(0);
        $data['approved']    = $this->orders_model->get_orders_status(1);
        $data['fordelivery'] = $this->orders_model->get_orders_status(2);
        $data['logistics']   = $this->orders_model->get_orders_status(3);
        $data['delivered']   = $this->orders_model->get_orders_status(4);
		$data['returned']    = $this->orders_model->get_orders_status(5);
		$data['pullout']     = $this->orders_model->get_pull_out();
		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/warehouse/expenses', $data);
		$this->load->view('accounts/templates/footer');
	}

    public function restock()
	{
        $data['restocks']  = $this->production_model->get_restocks_data();
		$data['pending']     = $this->orders_model->get_orders_status(0);
        $data['approved']    = $this->orders_model->get_orders_status(1);
        $data['fordelivery'] = $this->orders_model->get_orders_status(2);
        $data['logistics']   = $this->orders_model->get_orders_status(3);
        $data['delivered']   = $this->orders_model->get_orders_status(4);
		$data['returned']    = $this->orders_model->get_orders_status(5);
		$data['pullout']     = $this->orders_model->get_pull_out();
		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/production/restock', $data);
		$this->load->view('accounts/templates/footer');
	}

    public function reduction()
	{
        $data['reduction']  = $this->production_model->get_reduction_data();
		$data['pending']     = $this->orders_model->get_orders_status(0);
        $data['approved']    = $this->orders_model->get_orders_status(1);
        $data['fordelivery'] = $this->orders_model->get_orders_status(2);
        $data['logistics']   = $this->orders_model->get_orders_status(3);
        $data['delivered']   = $this->orders_model->get_orders_status(4);
		$data['returned']    = $this->orders_model->get_orders_status(5);
		$data['pullout']     = $this->orders_model->get_pull_out();
		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/production/reduction', $data);
		$this->load->view('accounts/templates/footer');
	}

    public function category()
	{

        $data['category'] = $this->warehouse_model->get_category_data();
		$data['pending']     = $this->orders_model->get_orders_status(0);
        $data['approved']    = $this->orders_model->get_orders_status(1);
        $data['fordelivery'] = $this->orders_model->get_orders_status(2);
        $data['logistics']   = $this->orders_model->get_orders_status(3);
        $data['delivered']   = $this->orders_model->get_orders_status(4);
		$data['returned']    = $this->orders_model->get_orders_status(5);
		$data['pullout']     = $this->orders_model->get_pull_out();
		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/production/category' , $data);
		$this->load->view('accounts/templates/footer');
	}

    public function process_stock_in(){

        $quantity  = $this->input->post('quantity');
        $id  = $this->input->post('id');

		$data = array(

                'product'         => $id,
				'quantity'        => $quantity,
				'process_by'      => $this->session->userdata['logged_in']['user_id'],
				'date_Added'      => date('Y-m-d H:i:s'),
  
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->warehouse_model->process_stock_in($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

        redirect("warehouse/inventory?added");   

    }


	public function process_receive_product(){

        $quantity    = $this->input->post('received_quantity');
		$product_id  = $this->input->post('product_id');
		$status      = $this->input->post('status');
		$reason      = $this->input->post('reason');
        $id          = $this->input->post('id');
        $batch_no    = $this->input->post('batch_no');

		$data = array(

                'id'              => $id,
                'product_id'      => $product_id,
				'status'          => $status,
				'reason'          => $reason,
				'quantity'        => $quantity,
				'recived_by'      => $this->session->userdata['logged_in']['user_id'],
				'recived_date'    => date('Y-m-d H:i:s'),
  
		);

		$stockin = array(

			'batch_no'        => $batch_no,
			'product'         => $product_id,
			'quantity'        => $quantity,
			'process_by'      => $this->session->userdata['logged_in']['user_id'],
			'date_Added'      => date('Y-m-d H:i:s'),

	    );
	
		$process   = $this->security->xss_clean($data);
		$process1  = $this->security->xss_clean($stockin);

		$result = $this->warehouse_model->process_receive_product($process);
		$result = $this->warehouse_model->process_stock_in($process1);

		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

        redirect("warehouse/receivable-details?batch_no=".$batch_no);   

    }

    public function process_production_inventory_restock(){

        $category  = $this->input->post('category');
        $product   = $this->input->post('product');
        $quantity  = $this->input->post('quantity');

		$data = array(

                'product'         => $product,
				'quantity'        => $quantity,
				'process_by'      => $this->session->userdata['logged_in']['user_id'],
				'date_Added'      => date('Y-m-d H:i:s'),
  
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->production_model->process_production_inventory_restock($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
	


    }

    public function process_expenses_reports(){

        $title        = $this->input->post('title');
        $amount       = $this->input->post('amount');
        $description  = $this->input->post('description');
        $category     = $this->input->post('category');

        $image      = addslashes(file_get_contents($_FILES['file']['tmp_name']));
		$image_name = addslashes($_FILES['file']['name']);
		$image_size = getimagesize($_FILES['file']['tmp_name']);
	
		
	
		move_uploaded_file($_FILES["file"]["tmp_name"], "assets/expenses/receipt/" . $_FILES["file"]["name"]);
		$location   =  $_FILES["file"]["name"];

		$data = array(

                'title'          => $title,
				'amount'         => $amount,
                'description'    => $description,
                'receipt'        => $location,
                'category'      => $category,
                'department'     => 'Warehouse',
				'report_by'      => $this->session->userdata['logged_in']['user_id'],
				'date_Added'     => date('Y-m-d H:i:s'),
  
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->warehouse_model->process_expenses_reports($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
	
		redirect("warehouse/expenses?added");   


    }

    public function process_production_inventory_reduction(){

        $category  = $this->input->post('category');
        $product   = $this->input->post('product');
        $quantity  = $this->input->post('quantity');

		$data = array(

                'product'         => $product,
				'quantity'        => $quantity,
				'process_by'      => $this->session->userdata['logged_in']['user_id'],
				'date_Added'      => date('Y-m-d H:i:s'),
  
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->production_model->process_production_inventory_reduction($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
	


    }


	public function process_pullout()
	{

		$trans_code         = $this->input->post('trans_code');
		$for_inventory      = $this->input->post('for_inventory');
        $for_disposal       = $this->input->post('for_disposal');
        $product_ids         = $this->input->post('product_id');

		echo json_encode($_POST);

		$insert_data = [];


        

		foreach ($product_ids as $product_id) {
			$insert_data = [
				'trans_code'        => $trans_code,
				'product_id'        => $product_id,
				'qty_disposal'      => isset($for_disposal[$product_id]) ? $for_disposal[$product_id] : 0,
				'qty_for_inventory' => isset($for_inventory[$product_id]) ? $for_inventory[$product_id] : 0,
				'date_process'      => date('Y-m-d H:i:s'),
				'is_process'        => 1

			];

			$this->warehouse_model->process_pullout($insert_data);

		}



		sleep(2);

        $this->session->set_flashdata('success', 'Pull Out products processed Successfully!');
        redirect('orders/pull-out');
       
	}



    public function update_production_inventory(){

        $category  = $this->input->post('category');
        $product   = $this->input->post('product');
        $quantity  = $this->input->post('quantity');
        $unit      = $this->input->post('unit');
        $id        = $this->input->post('id');

		$data = array(

                'id'              => $id,
				'category'        => $category,
                'product'         => $product,
				'quantity'        => $quantity,
				'unit'            => $unit,
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->production_model->update_production_inventory($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
	
		redirect("production/inventory?updated");   


    }


    public function process_production_inventory_category(){

        $category  = $this->input->post('category');

		$data = array(

				'category'        => $category,
				'date_Added'      => date('Y-m-d H:i:s'),
  
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->production_model->process_production_inventory_category($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
	


    }

    public function update_production_inventory_category(){

        $category  = $this->input->post('category');
        $id        = $this->input->post('id');

		$data = array(

                'id'              => $id,
				'category'        => $category
  
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->production_model->update_production_inventory_category($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
	
		redirect("production/category?updated");   


    }

    public function delete_production_inventory_category(){

        $category  = $this->input->post('category');
        $id        = $this->input->post('id');

		$data = array(

                'id'              => $id,
  
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->production_model->delete_production_inventory_category($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
	
		redirect("production/category?deleted");   


    }

    public function delete_expenses_reports(){

        $id        = $this->input->post('id');

		$data = array(

                'id'              => $id,
  
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->production_model->delete_expenses_reports($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
	
		redirect("production/expenses?deleted");   


    }

    public function check_production_inventory(){

        $product        = $this->input->post('product');

		$result = $this->production_model->check_production_inventory($product);

        $response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
        
        echo json_encode($response);
	
		


    }

	public function process_charity(){

        $trans_code     = $this->input->post('trans_code');
        $status         = $this->input->post('status');

        $data = array(

            'status'        => $status,
            'trans_code'    => $trans_code,

         );

		$process  = $this->security->xss_clean($data);
	
		$result = $this->warehouse_model->process_charity($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

		sleep(2);

		if($status == 4){
			$this->session->set_flashdata('success', ' Charity Products Process Successfully!');
		}
		if($status == 5){
			$this->session->set_flashdata('success', ' Charity Products Completed Successfully!');
		}
        redirect('warehouse/charity');


    }


	public function process_charity_order(){

        $id                 = $this->input->post('id');
        $quantity           = $this->input->post('quantity');
        $transaction        = $this->input->post('transaction');
        $product_id         = $this->input->post('product_id');

        $data = array(

            'quantity_done'   => $quantity,
            'id'              => $id,
            'product_id'      => $product_id,

         );

		$process  = $this->security->xss_clean($data);
	
		$result = $this->warehouse_model->process_charity_order($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

		sleep(2);

         $this->session->set_flashdata('success', ' Charity Products Updated Successfully!');
		 redirect('warehouse/order-details?transaction='. $transaction . '&customer='. $customer);


    }

	
    

}
