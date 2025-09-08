<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Asia/Manila");

class Customers extends CI_Controller {

	public function __construct() {

        parent::__construct();
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

		ob_start();

		$this->load->library('phpmailer_library');

        
        $this->load->model('customer_model');
        $this->load->model('sales_model');
        $this->load->model('products_model');


		if(!isset($this->session->userdata['logged_in']['user_id'])){
			redirect("auth");
		}

    }

	public function index()
	{

        $data['customer'] = $this->customer_model->get_customer_data();
        $data['agent']    = $this->sales_model->get_agent_data();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/customers/index', $data);
		$this->load->view('accounts/templates/footer');
	}

	public function order()
	{

        $data['customer'] = $this->customer_model->get_customer_data_1();
        $data['agent']    = $this->sales_model->get_agent_data();
        $data['products'] = $this->products_model->get_products_data();

		if($this->session->userdata['logged_in']['position'] == 'Sales Agent'){

			$id = $this->session->userdata['logged_in']['user_id'];
 
		} else {

			$id = "";


		}


        $data['orders']   = $this->customer_model->get_orders_data($id);

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/customers/order', $data);
		$this->load->view('accounts/templates/footer');
	}

	public function order_details()
	{

        $data['customer']      = $this->customer_model->get_customer_data();
        $data['agent']         = $this->sales_model->get_agent_data();
        $data['products']      = $this->products_model->get_products_data();
        $data['orders_list']   = $this->customer_model->get_order_list_data($_GET['transaction']);

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/customers/order_details', $data);
		$this->load->view('accounts/templates/footer');
	}

	public function process_customer_order()
	{

		$transaction_code = "TONIOS-" . strtoupper(uniqid()); // Generate a unique transaction code
		$product_id       = $this->input->post('product_id');
		$customer_id      = $this->input->post('customer_id');
        $prices           = $this->input->post('price');
        $quantities       = $this->input->post('quantity');
        $totals           = $this->input->post('price_product');
        $grand_total      = $this->input->post('grand_total');
        $customer_type    = $this->input->post('customer_type');
		$agent_id         = $this->input->post('agent_id');



        if (!empty($product_id)) {
            for ($i = 0; $i < count($product_id); $i++) {

				if($customer_type == 'Distributor'){

					$distributor_type =  $this->input->post('distributor_type');
                    if($distributor_type == 'Percentage'){

                        $distributor_price_percentage =  $this->input->post('distributor_price_percentage');

                         $amount = ($distributor_price_percentage / 100) * $price;

                    } else {

                        $amount =  $this->input->post('distributor_price_amount');;

                    }
					$nprice = $prices[$i] - $amount;

				} else {
					$nprice = $prices[$i];
				}

                $data = array(
					'trans_code'       => $transaction_code,
					'agent_id'         => $agent_id,
					'customer_id'      => $customer_id,
                    'product_id'       => $product_id[$i],
                    'price'            => $nprice,
                    'quantity'         => $quantities[$i],
                    'total'            => $totals[$i],
					'date_Added'       => date('Y-m-d H:i:s'),
                );

                $this->customer_model->process_customer_order($data);
            }
        }

		$row = $this->db->query("SELECT * FROM tonios_customers WHERE id = '$customer_id'")->row_array();


		$mail1 = $this->phpmailer_library->load();
		$mail1->isSMTP();
		$mail1->Host     = 'smtp.hostinger.com';
		$mail1->SMTPAuth = true;
		$mail1->Username = 'notification@toniossisig.com';
		$mail1->Password = '@Programmer2013';
		$mail1->SMTPSecure = 'ssl'; // tls
		$mail1->Port     = 465; // 587
		$mail1->setFrom('notification@toniossisig.com', 'Tonios Sisig System Notification');

		$mail1->addAddress("kevinjayroluna@gmail.com");

		$mail1->Subject = 'Customer Order - ' . $transaction_code;
		$mail1->isHTML(true);


		$html1  = '<html>';
		$html1 .= '<body>';
		$html1 .= '<h2 class="text-danger">Customer Order ' . $transaction_code. ' </h2>';
		$html1 .= '<p style="font-size:20px;color:#00000;"> Hello Sales, </p>';
		$html1 .= '<p style="font-size:20px;color:#00000;"> Please check new order for customer</p>';

		$html1 .= '<table cellpadding="0" cellspacing="0" border="0" width="600">';
		$html1 .= '<tr><td>';
		$html1 .= '<table cellpadding="0" cellspacing="0" border="1" width="100%" style=" font-size:20px;">';
		$html1 .= '<tr>
					<td style="text-align:left;">Transaction Code</td>
					<td style="padding-left: 10%;">'.$transaction_code.'</td>
				   </tr>';
		$html1 .= '<tr>
				   <td style="text-align:left;">Customer Name </td>
				   <td style="padding-left: 10%;">'.$row['customer_name'] .'</td>
				  </tr>';
		
	$html1 .= '<tr>
				  <td style="text-align:left;">Agent Name </td>
				  <td style="padding-left: 10%;">'.$this->session->userdata['logged_in']['name'].'</td>
				 </tr>';
	   
		$html1 .='</table>';
		$html1 .='</td></tr>';				
		$html1 .='<tr>
						<td>
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
							<tr>
								<td>
								<h2 style="text-align:center;color:#484848;margin-top:2.5%;margin-bottom:5%;"><b> View Order  <a href="#">here</a> </b></h2>
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

		sleep(2);

        $this->session->set_flashdata('success', 'Orders Submitted Successfully!');
        redirect('customers/order');
       
	}

	public function process_pullout_order()
	{

		$transaction_code = "PULLOUT-" . strtoupper(uniqid()); // Generate a unique transaction code
		$product_id       = $this->input->post('product_id');
		$customer_id      = $this->input->post('customer_id');
        $quantities       = $this->input->post('quantity');
        $logistics        = $this->session->userdata['logged_in']['user_id'];



        if (!empty($product_id)) {
            for ($i = 0; $i < count($product_id); $i++) {

                $data = array(
					'trans_code'       => $transaction_code,
					'customer_id'      => $customer_id,
					'logistics'        => $logistics,
                    'product_id'       => $product_id[$i],
                    'quantity'         => $quantities[$i],
					'date_added'       => date('Y-m-d H:i:s'),
                );

                $this->customer_model->process_pullout_order($data);
            }
        }



		sleep(2);

        $this->session->set_flashdata('success', 'Pull Out products processed Successfully!');
        redirect('logistics/pullout');
       
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

                $this->customer_model->update_customer_order($data);


		sleep(2);

        $this->session->set_flashdata('success', 'Orders Updated Successfully!');
        redirect('customers/order-details?transaction='. $transaction . '&customer='. $customer);
       
	}

	public function process_customers(){

        $customer_name      = $this->input->post('customer_name');
        $customer_contact   = $this->input->post('customer_contact');
        $customer_address   = $this->input->post('customer_address');
        $customer_type      = $this->input->post('customer_type');
        $agent_id           = $this->input->post('agent_id');


		$percentage         = '';
		$amount             = '';

		if($customer_type == 'Distributor'){

			$distributor_type = $this->input->post('distributor_type');

			if($distributor_type == 'Percentage'){

				$percentage =  $this->input->post('distributor_price_percentage');

			} else {

				$amount     =  $this->input->post('distributor_price_amount');

			}


			$data = array(

				'customer_name'        => $customer_name,
                'customer_contact'     => $customer_contact,
				'customer_address'     => $customer_address,
				'customer_type'        => $customer_type,
				'distributor_type'     => $distributor_type,
				'distributor_price_percentage' => $percentage,
				'distributor_price_amount'     => $amount,
				'agent_id'             => $agent_id,
				'date_Added'           => date('Y-m-d H:i:s'),
  
			);
	


		} else {

			$data = array(

				'customer_name'        => $customer_name,
                'customer_contact'     => $customer_contact,
				'customer_address'     => $customer_address,
				'customer_type'        => $customer_type,
				'agent_id'             => $agent_id,
				'date_Added'           => date('Y-m-d H:i:s'),
  
			);
	

		}

	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->customer_model->process_customers($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
		
		sleep(2);

        $this->session->set_flashdata('success', 'Customer Data added Successfully!');

		redirect("customers");   

    }

	public function update_customers(){

        $customer_name      = $this->input->post('customer_name');
        $customer_contact   = $this->input->post('customer_contact');
        $customer_address   = $this->input->post('customer_address');
        $customer_type      = $this->input->post('customer_type');
        $agent_id           = $this->input->post('agent_id');
        $id                 = $this->input->post('id');


		$distributor_type = $this->input->post('distributor_type');

			if($distributor_type == 'Percentage'){

				$percentage =  $this->input->post('distributor_price_percentage');

			} else {

				$amount     =  $this->input->post('distributor_price_amount');

			}


		$data = array(

				'customer_name'        => $customer_name,
                'customer_contact'     => $customer_contact,
				'customer_address'     => $customer_address,
				'customer_type'        => $customer_type,
				'agent_id'             => $agent_id,
				'distributor_type'     => $distributor_type,
				'distributor_price_percentage' => $percentage,
				'distributor_price_amount'     => $amount,
				'id'                   => $id,
  
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->customer_model->update_customers($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
		
		sleep(2);

        $this->session->set_flashdata('success', 'Customer Data updated Successfully!');
		redirect("customers");   

    }

	public function delete_customers(){

       
        $id                 = $this->input->post('id');

		$data = array(

				'id'                   => $id,
  
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->customer_model->delete_customers($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
		sleep(2);

        $this->session->set_flashdata('success', 'Customer Data deleted Successfully!');
		redirect("customers");   

    }


	public function remove_order(){

       
        $trans_code                 = $this->input->post('trans_code');

		$data = array(

				'trans_code'                   => $trans_code,
  
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->customer_model->remove_order($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);

		sleep(2);

		$this->session->set_flashdata('removed', 'Orders Removed Successfully!');
        redirect('customers/order');

    }



}
