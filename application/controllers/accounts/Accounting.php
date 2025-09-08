<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Asia/Manila");

class Accounting extends CI_Controller {

	public function __construct() {

        parent::__construct();
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

		ob_start();

        $this->load->model('orders_model');
        $this->load->model('logistics_model');
        $this->load->model('accounting_model');
        $this->load->model('production_model');

		if(!isset($this->session->userdata['logged_in']['user_id'])){
			redirect("auth");
		}

    }

	public function index()
	{
        if(isset($_GET['logistic_id'])){
            $lid =  $_GET['logistic_id'];
        } else {
            $lid =  0;
        }
        $data['orders']    = $this->accounting_model->get_orders_data(4, $lid);    
        $data['logistics'] = $this->orders_model->get_logistics_data();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/accounting/order', $data);
		$this->load->view('accounts/templates/footer');
	}


    public function sales()
	{
        $data['orders']    = $this->accounting_model->get_orders_data_1(4);    

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/accounting/sales', $data);
		$this->load->view('accounts/templates/footer');
	}


	public function payroll()
	{
        $data['payroll']    = $this->accounting_model->get_payroll_data();    

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/accounting/payroll', $data);
		$this->load->view('accounts/templates/footer');
	}


	public function payroll_list()
	{
        $data['payroll']    = $this->accounting_model->get_payroll_list_data($_GET['data']);    

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/accounting/payroll_list', $data);
		$this->load->view('accounts/templates/footer');
	}


    



    public function expenses()
	{
        $data['expenses'] = $this->accounting_model->get_expenses_data();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/accounting/expenses', $data);
		$this->load->view('accounts/templates/footer');
	}

    public function reimbursement()
	{
        $data['expenses'] = $this->accounting_model->get_reimbursement_data();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/accounting/reimbursement', $data);
		$this->load->view('accounts/templates/footer');
	}

 

    public function order_details()
	{
      
        $data['orders_list']   = $this->accounting_model->get_order_list_data($_GET['transaction']);
		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/accounting/order_details', $data);
		$this->load->view('accounts/templates/footer');
	}

    public function reports()
	{
      
        $data['expenses'] = $this->accounting_model->get_daily_sales_data();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/accounting/reports', $data);
		$this->load->view('accounts/templates/footer');
	}

    public function collection()
	{
      
        $data['collection'] = $this->accounting_model->get_for_collection_data();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/accounting/collection', $data);
		$this->load->view('accounts/templates/footer');
	}

    public function collection_records()
	{
      
        $data['collection'] = $this->accounting_model->get_for_collection_records_data($_GET['data']);

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/accounting/collection_records', $data);
		$this->load->view('accounts/templates/footer');
	}

    public function reports_data()
	{
      
        $data['expenses']     = $this->accounting_model->get_daily_sales_data();
        $data['credit_sales'] = $this->accounting_model->get_daily_credit_sales($_GET['date']);
        $data['non_cash']     = $this->accounting_model->get_daily_non_cash($_GET['date']);
        $data['cash']         = $this->accounting_model->get_daily_cash($_GET['date']);
        $data['collection']   = $this->accounting_model->get_daily_collection($_GET['date']);

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/accounting/reports-data', $data);
		$this->load->view('accounts/templates/footer');
	}

    public function pullout()
	{

        $data['pullout']  = $this->logistics_model->get_pullout_products_data();


		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/logistics/pullout', $data);
		$this->load->view('accounts/templates/footer');
	}


    public function process_returned(){

        $id            = $this->input->post('id');
        $customer      = $this->input->post('customer');
        $transaction   = $this->input->post('transaction');

        $data = array(

            'id'                         => $id,

         );

		$process  = $this->security->xss_clean($data);
	
		$result = $this->accounting_model->process_returned($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

		sleep(2);

         $this->session->set_flashdata('success', ' Product Returned to Warehouse Successfully!');
        redirect('accounting/delivered-list?transaction='.$transaction.'&customer='.$customer);


    }

    public function process_endorse_warehouse(){

        $transaction   = $this->input->post('trans_code');

        $data = array(

            'transaction' => $transaction,

         );

		$process  = $this->security->xss_clean($data);
	
		$result = $this->accounting_model->process_endorse_warehouse($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

		sleep(2);

         $this->session->set_flashdata('success', ' Pull Out Products endorsed to Warehouse Successfully!');
        redirect('accounting/pull-out');


    }

    public function process_sales(){

        $transaction       = $this->input->post('trans_code');
        $total_remittance  = $this->input->post('total_remittance');
        $total_credits     = $this->input->post('total_credits');
        $customer_id       = $this->input->post('customer_id');
        $mop               = $this->input->post('mop');
        $is_credit_sales   = $this->input->post('is_credit_sales');

        $data = array(

            'transaction'                    => $transaction,
            'total_remittance'               => $total_remittance,

         );


         $sales = array(

            'transcode'           => $transaction,
            'total_collected'     => $total_remittance,
            'total_credit'        => $total_credits,
            'customer_id'         => $customer_id,
            'mop'                 => $mop,
            'is_credit_sales'     => $is_credit_sales,
            'date_added'          => date('Y-m-d H:i:s'),

         );

		$process  = $this->security->xss_clean($data);
		$result = $this->accounting_model->process_sales($process);

        $process_sales  = $this->security->xss_clean($sales);
		$result_sales = $this->accounting_model->process_sales_1($process_sales);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

		sleep(2);

        $this->session->set_flashdata('success', ' Sales Process Successfully!');
        redirect('accounting/orders');


    }


	public function process_payroll(){

        $title        = $this->input->post('title');
        $date         = $this->input->post('date');
        $week         =  $this->input->post('week');

        $data = array(

            'payroll_title'       => $title,
            'payroll_date'        => $date,
            'week'                => $week,
            'process_by'          =>$this->session->userdata['logged_in']['name'],
			'date_added'          => date('Y-m-d H:i:s'),

         );

		$process  = $this->security->xss_clean($data);
	
		$result = $this->accounting_model->process_payroll($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

		sleep(2);

        $this->session->set_flashdata('success', ' Payroll Process Successfully!');
        redirect('accounting/payroll');


    }

    public function process_daily_sales(){

        $date_today        = $this->input->post('date_today');
        

        $data = array(

            'date_today'          => $date_today,
            'process_by'          =>$this->session->userdata['logged_in']['name'],
			'date_added'          => date('Y-m-d H:i:s'),

         );

		$process  = $this->security->xss_clean($data);
	
		$result = $this->accounting_model->process_daily_sales($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

		sleep(2);

        $this->session->set_flashdata('success', ' Daily Sales Added Successfully!');
        redirect('accounting/reports');


    }

    public function process_collection_to_sales(){

        $transaction       = $this->input->post('transcode');
        $total_collected   = $this->input->post('total_collected');
        $customer_id       = $this->input->post('customer_id');
        $id                = $this->input->post('id');
        $customer_name     = $this->input->post('customer_name');
        $data_id           = $this->input->post('data');
        $data = array(

            'id'                    => $id,

         );


         $sales = array(

            'transcode'           => $transaction,
            'total_collected'     => $total_collected,
            'customer_id'         => $customer_id,
            'mop'                 => "COLLECTION",
            'date_added'          => date('Y-m-d H:i:s'),

         );

		$process  = $this->security->xss_clean($data);
		$result = $this->accounting_model->process_collection($process);

        $process_sales  = $this->security->xss_clean($sales);
		$result_sales = $this->accounting_model->process_sales_1($process_sales);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

		sleep(2);

        $this->session->set_flashdata('success', ' Sales Process Successfully!');
        redirect('accounting/view-credits-records?data='.$data_id.'&transcode='.$transaction.'&customer_id='.$customer_id.'&customer_name='.$customer_name);


    }
    public function delete_sales_reports(){

        $id        = $this->input->post('id');

		$result = $this->accounting_model->delete_sales_reports($id);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

		sleep(2);

        $this->session->set_flashdata('success', ' Daily Sales Reports Deleted Successfully!');
        redirect('accounting/reports');


    }

    public function process_expenses(){

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
                'category'       => $category,
                'department'     => "Accounting",
				'report_by'      => $this->session->userdata['logged_in']['name'],
				'date_Added'     => date('Y-m-d H:i:s'),
  
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->production_model->process_expenses_reports($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

        sleep(2);

        $this->session->set_flashdata('success', ' Expenses Record Successfully!');
		redirect("accounting/expenses");   


    }

    public function process_reimbursement(){

        $title        = $this->input->post('title');
        $amount       = $this->input->post('amount');
        $description  = $this->input->post('description');

        $image      = addslashes(file_get_contents($_FILES['file']['tmp_name']));
		$image_name = addslashes($_FILES['file']['name']);
		$image_size = getimagesize($_FILES['file']['tmp_name']);
	
		
	
		move_uploaded_file($_FILES["file"]["tmp_name"], "assets/reimbursement/" . $_FILES["file"]["name"]);
		$location   =  $_FILES["file"]["name"];

		$data = array(

                'title'          => $title,
				'amount'         => $amount,
                'description'    => $description,
                'receipt'        => $location,
				'report_by'      => $this->session->userdata['logged_in']['name'],
				'date_Added'     => date('Y-m-d H:i:s'),
  
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->accounting_model->process_reimbursement($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

        sleep(2);

        $this->session->set_flashdata('success', ' Resimbursement Record Successfully!');
		redirect("accounting/reimbursement");   


    }


	public function process_payroll_list() {

		$payroll_date  = $this->input->post('payroll_date');
        $week          = $this->input->post('week');
        $id            = $this->input->post('data');


        if (isset($_FILES['csv_file']['name']) && $_FILES['csv_file']['name'] != '') {
            $filename = $_FILES['csv_file']['tmp_name'];

            if (($handle = fopen($filename, 'r')) !== FALSE) {
                fgetcsv($handle); // Skip header

                while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
                    $data = [
                        'employee_name'      => $row[0],
                        'rate'               => $row[1],
						'work_days'          => $row[2],
                        'sil'                => $row[3],
                        'holiday_special'    => $row[4],
                        'holiday_regular'    => $row[5],
                        'restday_ot'         => $row[6],
                        'total_days'         => $row[7],
                        'overtime'           => $row[8],
                        'grosspay'           => $row[9],
                        'no_days_absent_1'   => $row[10],
                        'no_days_absent_2'   => $row[11],
                        'late_1'             => $row[12],
                        'late_2'             => $row[13],
                        'cash_adv'           => $row[14],
                        'sss'                => $row[15],
                        'philhealth'         => $row[16],
                        'pagibig'            => $row[17],
                        'credit'             => $row[18],
                        'credit_sisig'       => $row[19],
                        'netpay'             => $row[20],
                        'process_by'         => $this->session->userdata['logged_in']['name'],
                        'date_added'         => date('Y-m-d H:i:s'),
                        'payroll_id'         => $id,

                    ];

					$this->accounting_model->process_payroll_list($data);
                }
                fclose($handle);

                
                $this->session->set_flashdata('success', 'CSV imported successfully!');
              
            }
        } else {
            $this->session->set_flashdata('success', 'Please upload a CSV file.');
        }

		redirect('accounting/payroll-list?payroll_date='.$payroll_date.'&week='.$week.'&data='.$id);

    }


 
}
