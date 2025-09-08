<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Asia/Manila");

class Sales extends CI_Controller {

	public function __construct() {

        parent::__construct();
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

		ob_start();
        
		$this->load->model('customer_model');
        $this->load->model('sales_model');
        $this->load->model('products_model');
		$this->load->model('orders_model');

		$this->load->library('phpmailer_library');


		if(!isset($this->session->userdata['logged_in']['user_id'])){
			redirect("auth");
		}

    }

	public function agent()
	{

        $data['agent'] = $this->sales_model->get_agent_data();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/sales/agent', $data);
		$this->load->view('accounts/templates/footer');
	}

	public function collection()
	{

        $data['collection'] = $this->sales_model->get_for_collection_data();
        $data['logistics'] = $this->orders_model->get_logistics_data();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/sales/collection', $data);
		$this->load->view('accounts/templates/footer');
	}

	public function order_details()
	{

        $data['customer']      = $this->customer_model->get_customer_data();
        $data['agent']         = $this->sales_model->get_agent_data();
        $data['products']      = $this->products_model->get_products_data();
        $data['orders_list']   = $this->sales_model->get_order_list_data($_GET['transaction']);

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/sales/order_details', $data);
		$this->load->view('accounts/templates/footer');
	}

	public function charity()
	{

		$data['customer'] = $this->customer_model->get_customer_data();
        $data['agent']    = $this->sales_model->get_agent_data();
        $data['products'] = $this->products_model->get_products_data();
        $data['charity'] = $this->sales_model->get_charity_data(0);

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/sales/charity', $data);
		$this->load->view('accounts/templates/footer');
	}

	public function monthly_reports()
	{

		if(isset($_GET['year'])){

			$results    = $this->orders_model->products_reports_by_month($_GET['year']);

		} else {
			$results    = $this->orders_model->products_reports_by_month($y = date('Y'));

		}

		

		$months = [
			1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
			5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
			9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
		];
	
		$report = [];
	
		foreach ($results as $row) {
			$product = $row->product_name;
			$month = (int)$row->month_number;
	
			if (!isset($report[$product])) {
				foreach ($months as $m => $name) {
					$report[$product][$name] = ['total_qty' => 0, 'total_sum' => 0];
				}
			}
	
			$report[$product][$row->month_name] = [
				'total_qty' => $row->total_qty,
				'total_sum' => $row->total_sum
			];
		}
	
		$data['report'] = $report;
		$data['months'] = array_values($months);
		$data['year'] = 2025;


		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/sales/reports/monthly', $data);
		$this->load->view('accounts/templates/footer');
	}

	public function mtd_ytd_reports()
	{

		$cutoff_date = date('Y-m-d');

		if(isset($_GET['year'])){
			$summary  = $this->orders_model->products_reports_by_mtd_ytd($cutoff_date,$_GET['year']);

		} else {
			$summary = $this->orders_model->products_reports_by_mtd_ytd($cutoff_date,$y = date('Y'));

		}


		$data = [
			'mtd_2024' => $summary->mtd_2024,
			'mtd_2025' => $summary->mtd_2025,
			'ytd_2024' => $summary->ytd_2024,
			'ytd_2025' => $summary->ytd_2025,
			'mtd_growth' => $summary->mtd_2025 - $summary->mtd_2024,
			'ytd_growth' => $summary->ytd_2025 - $summary->ytd_2024
		];
		
		
	

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/sales/reports/mtd_ytd', $data);
		$this->load->view('accounts/templates/footer');
	}

	public function daily_sales_report()
	{

		if(isset($_GET['year'])){

			$data['results']    = $this->orders_model->products_reports_by_daily($_GET['year'], $_GET['month']);

		} else {
			$data['results']    = $this->orders_model->products_reports_by_daily($y = date('Y'), $m = date('m'));

		}


		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/sales/reports/daily_sales', $data);
		$this->load->view('accounts/templates/footer');
	}

	public function quarterly_sales_reports()
	{

		if(isset($_GET['year'])){

			$data['results'] = $this->orders_model->get_quarterly_sales_report($_GET['year']);

		} else {
			$data['results'] = $this->orders_model->get_quarterly_sales_report($y = date('Y'));

		}

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/sales/reports/quarterly_sales', $data);
		$this->load->view('accounts/templates/footer');
	}

	public function customer_sales_reports()
	{
		if(isset($_GET['year'])){

			$data['results'] = $this->orders_model->get_sales_by_customer_by_year($_GET['year']);

		} else {
			$data['results'] = $this->orders_model->get_sales_by_customer_by_year($y = date('Y'));

		}


		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/sales/reports/sales_by_customer', $data);
		$this->load->view('accounts/templates/footer');
	}

	public function top_customer_sales_reports()
	{

		if(isset($_GET['year'])){

			$data['results'] = $this->orders_model->get_top_customer_sales($_GET['year'],100);

		} else {
			$data['results'] = $this->orders_model->get_top_customer_sales($y = date('Y'),100);

		}


		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/sales/reports/top_sales_customer', $data);
		$this->load->view('accounts/templates/footer');
	}

    public function generatePassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function hash($password){
        $hash = password_hash($password,PASSWORD_DEFAULT);
        return $hash;
    }

    public function process_sales_agent(){

        $id_no              = $this->input->post('id_no');
        $fullname           = $this->input->post('full_name');
        $contact_no         = $this->input->post('contact_no');
        $email              = $this->input->post('email');
        $address            = $this->input->post('address');
        $age                = $this->input->post('age');
        $birthdate          = $this->input->post('birthdate');
        $gender             = $this->input->post('gender');
        $position           = $this->input->post('position');
        $incase_emegency    = $this->input->post('incase_emegency');
        $date_hired         = $this->input->post('date_hired');
        $password   = $this->generatePassword();

		$data = array(

			'id_no'           => $id_no,
			'fullname'        => $fullname,
			'contact_no'      => $contact_no,
			'email'           => $email,
			'address'         => $address,
			'age'             => $age,
			'birthdate'       => $birthdate,
			'gender'          => $gender,
			'position'        => 'Sales Agent',
			'incase_emegency' => $incase_emegency,
			'date_hired'      => $date_hired,
			'department'      => 'Sales',
			'is_system'       => 1,
			'password'        => $this->hash($password),
			'date_registered' => date('Y-m-d H:i:s'),

		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->sales_model->process_sales_agent($process);

        $mail1 = $this->phpmailer_library->load();
		$mail1->isSMTP();
		$mail1->Host     = 'smtp.hostinger.com';
		$mail1->SMTPAuth = true;
		$mail1->Username = 'notification@toniossisig.com';
		$mail1->Password = '@Programmer2013';
		$mail1->SMTPSecure = 'ssl'; // tls
		$mail1->Port     = 465; // 587
		$mail1->setFrom('notification@toniossisig.com', 'Tonios Sisig System Notification');
		$mail1->addAddress($email);

		$mail1->Subject = 'System Sales Agent Account';
		$mail1->isHTML(true);


		$html1  = '<html>';
		$html1 .= '<body>';
		$html1 .= '<h2 class="text-danger">Welcome to Tonios Sisig System</h2>';
		$html1 .= '<p style="font-size:20px;color:#00000;"> Hello ' . $firstname  . ' '. $lastname.', </p>';
		$html1 .= '<p style="font-size:20px;color:#00000;"> User Account for login</p>';
		$html1 .= '<table cellpadding="0" cellspacing="0" border="0" width="600">';
		$html1 .= '<tr><td>';
		$html1 .= '<table cellpadding="0" cellspacing="0" border="1" width="100%" style=" font-size:20px;">';
		$html1 .= '<tr>
					<td style="text-align:left;">User Name</td>
					<td style="padding-left: 10%;">'.$email.'</td>
				   </tr>';
		$html1 .= '<tr>
				   <td style="text-align:left;">Password </td>
				   <td style="padding-left: 10%;">'.$password.'</td>
				  </tr>';
	   
		$html1 .='</table>';
		$html1 .='</td></tr>';				
		$html1 .='<tr>
						<td>
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
							<tr>
								<td>
                                    <h2 style="text-align:center;color:#484848;margin-top:2.5%;margin-bottom:5%;"><b> Login to System <a href="#">here</a> </b></h2>
								</td>
							</tr>
							
							</table>
						</td>
						</tr>
					</table>
					</body>

					</html>';

	


	
		$mail1->Body = $html1;
		if ($mail1->send()) {
			$message = 'success';
		} else {
			$message = 'failed';
		}
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

        redirect("sales/agent?added");   

	
    }

    public function update_sales_agent(){

		$id_no              = $this->input->post('id_no');
        $fullname           = $this->input->post('full_name');
        $contact_no         = $this->input->post('contact_no');
        $email              = $this->input->post('email');
        $address            = $this->input->post('address');
        $age                = $this->input->post('age');
        $birthdate          = $this->input->post('birthdate');
        $gender             = $this->input->post('gender');
        $position           = $this->input->post('position');
        $incase_emegency    = $this->input->post('incase_emegency');
        $date_hired         = $this->input->post('date_hired');
        $id                 = $this->input->post('id');

     

      	$data = array(

			'id_no'           => $id_no,
			'fullname'        => $fullname,
			'contact_no'      => $contact_no,
			'email'           => $email,
			'address'         => $address,
			'age'             => $age,
			'birthdate'       => $birthdate,
			'gender'          => $gender,
			'incase_emegency' => $incase_emegency,
			'date_hired'      => $date_hired,
			'id'              => $id,

		);
		$process  = $this->security->xss_clean($data);
	
		$result = $this->sales_model->update_sales_agent($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
	
        redirect("sales/agent?updated");   


    }

    public function deactivate_sales_agent(){

        $id         = $this->input->post('id');

        $data = array(

            'is_system'        => 0,
            'id'               => $id,

         );

		$process  = $this->security->xss_clean($data);
	
		$result = $this->sales_model->update_sales_agent($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
	
        redirect("sales/agent?deactivated");   


    }

    public function activate_sales_agent(){

        $id         = $this->input->post('id');

        $data = array(

            'is_system'        => 1,
            'id'               => $id,

         );

		$process  = $this->security->xss_clean($data);
	
		$result = $this->sales_model->update_sales_agent($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
	
        redirect("sales/agent?activated");   


    }

	public function process_charity_order()
	{

		$transaction_code = "TONIOS-CHARITY-" . strtoupper(uniqid()); // Generate a unique transaction code
		$product_id       = $this->input->post('product_id');
		$charity          = $this->input->post('charity');
		$contact_name     = $this->input->post('contact_name');
		$contact_number   = $this->input->post('contact_number');
		$location         = $this->input->post('location');
        $prices           = $this->input->post('price');
        $quantities       = $this->input->post('quantity');
        $totals           = $this->input->post('price_product');
        $grand_total      = $this->input->post('grand_total');
		$process_by       = $this->input->post('process_by');
		$charity_date     = $this->input->post('charity_date');

        if (!empty($product_id)) {
            for ($i = 0; $i < count($product_id); $i++) {

				$nprice = $prices[$i];

                $data = array(
					'charity_date'     => $charity_date,
					'trans_code'       => $transaction_code,
					'process_by'       => $process_by,
					'charity_name'     => $charity,
					'contact_name'     => $contact_name,
					'contact_number'   => $contact_number,
					'location'         => $location,
                    'product_id'       => $product_id[$i],
                    'price'            => $nprice,
                    'quantity'         => $quantities[$i],
                    'total'            => $totals[$i],
					'date_Added'       => date('Y-m-d H:i:s'),
                );

                $this->customer_model->process_charity_order($data);
            }
        }


		sleep(2);

        $this->session->set_flashdata('success', 'Orders for Charity Successfully!');
        redirect('sales/charity');
       
	}

	public function process_approve_charity(){

        $trans_code         = $this->input->post('trans_code');

        $data = array(

            'status'        => 1,
            'trans_code'    => $trans_code,

         );

		$process  = $this->security->xss_clean($data);
	
		$result = $this->customer_model->process_charity($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

		sleep(2);

         $this->session->set_flashdata('success', ' Charity Approved Successfully!');
        redirect('sales/charity');


    }

	public function process_assigned_collection(){

        $id            = $this->input->post('id');
        $logistic_id   = $this->input->post('logistic_id');

        $data = array(

            'id'                   => $id,
            'assigned_logistics'   => $logistic_id,

         );

		$process  = $this->security->xss_clean($data);
	
		$result = $this->sales_model->process_assigned_collection($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

		sleep(2);

         $this->session->set_flashdata('success', ' Collection Assigned to Logistic Successfully!');
        redirect('sales/collection');


    }


	public function process_warehouse_charity(){

        $trans_code         = $this->input->post('trans_code');

        $data = array(

            'status'        => 3,
            'trans_code'    => $trans_code,

         );

		$process  = $this->security->xss_clean($data);
	
		$result = $this->customer_model->process_charity($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

		sleep(2);

        $this->session->set_flashdata('success', ' Charity Process to Warehouse Successfully!');
        redirect('sales/charity');


    }

	public function process_removed_charity(){

        $trans_code         = $this->input->post('trans_code');

        $data = array(

            'trans_code'    => $trans_code,

         );

		$process  = $this->security->xss_clean($data);
	
		$result = $this->customer_model->process_removed_charity($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

		sleep(2);

         $this->session->set_flashdata('success', ' Charity Removed Successfully!');
        redirect('sales/charity');


    }

	public function process_declined_charity(){

        $trans_code         = $this->input->post('trans_code');
        $reason             = $this->input->post('reason');

        $data = array(

            'status'        => 2,
			'reason'        => $reason,
            'trans_code'    => $trans_code,

         );

		$process  = $this->security->xss_clean($data);
	
		$result = $this->customer_model->process_charity($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

		sleep(2);

         $this->session->set_flashdata('success', 'Charity Declined Successfully!');
        redirect('sales/charity');


    }


	public function update_customer_order()
	{

		$id          = $this->input->post('id');
		$price       = $this->input->post('price');
		$quantity    = $this->input->post('quantity');
		$customer    = $this->input->post('customer');
		$transaction = $this->input->post('transaction');


         

                $data = array(
					'id'            => $id,
					'total'         => $price,
					'quantity'      => $quantity,
                  
                );

                $this->sales_model->update_customer_order($data);


		sleep(2);

        $this->session->set_flashdata('success', 'Charity Products Updated Successfully!');
        redirect('sales/order-details?transaction='. $transaction . '&customer='. $customer);
       
	}



}
