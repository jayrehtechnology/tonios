<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Asia/Manila");

class Dashboard extends CI_Controller {

	public function __construct() {

        parent::__construct();
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

        $this->load->model('orders_model');

		ob_start();
        
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

		$data['sales']       = $this->orders_model->get_sales_data();
		$data['sales_m']     = $this->orders_model->get_sales_per_month();

		$data['order_transactions'] = $this->orders_model->order_transactions();
		$data['product_sold']       = $this->orders_model->product_sold();
		$data['charity_donation']   = $this->orders_model->charity_donation();
		$data['total_customers']    = $this->orders_model->total_customers();

		$data['products_reports']     = $this->orders_model->products_reports();
		$data['report_sales']         = $this->orders_model->report_sales();
		$data['report_expenses']      = $this->orders_model->report_expenses();
		$data['report_reimbursement'] = $this->orders_model->report_reimbursement();
		$data['report_payroll']       = $this->orders_model->report_payroll();
		$data['get_monthly_sales']    = $this->orders_model->get_monthly_sales();
		$data['get_monthly_expenses'] = $this->orders_model->get_monthly_expenses();
		$data['reports_collections']  = $this->orders_model->reports_collections();
		$data['credits_sales']        = $this->orders_model->credits_sales();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/dashboard/index',$data);
		$this->load->view('accounts/templates/footer');
	}

}
