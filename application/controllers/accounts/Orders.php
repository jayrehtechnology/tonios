<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Asia/Manila");
//error_reporting(1);
class Orders extends CI_Controller {

	public function __construct() {

        parent::__construct();
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

		ob_start();

        $this->load->model('orders_model');
        $this->load->model('products_model');

		$this->load->library('phpmailer_library');

        
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

        $data['orders'] = $this->orders_model->get_orders_data(0);

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/warehouse/orders/pending', $data);
		$this->load->view('accounts/templates/footer');
	}

    public function approved()
	{

		$data['pending']     = $this->orders_model->get_orders_status(0);
        $data['approved']    = $this->orders_model->get_orders_status(1);
        $data['fordelivery'] = $this->orders_model->get_orders_status(2);
        $data['logistics']   = $this->orders_model->get_orders_status(3);
        $data['delivered']   = $this->orders_model->get_orders_status(4);
		$data['returned']    = $this->orders_model->get_orders_status(5);
		$data['pullout']     = $this->orders_model->get_pull_out();

        $data['orders'] = $this->orders_model->get_orders_data(1);
		$data['products'] = $this->products_model->get_products_data();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/warehouse/orders/approved', $data);
		$this->load->view('accounts/templates/footer');
	}

    public function for_delivery()
	{
		$data['pending']     = $this->orders_model->get_orders_status(0);
        $data['approved']    = $this->orders_model->get_orders_status(1);
        $data['fordelivery'] = $this->orders_model->get_orders_status(2);
        $data['logistics']   = $this->orders_model->get_orders_status(3);
        $data['delivered']   = $this->orders_model->get_orders_status(4);
		$data['returned']    = $this->orders_model->get_orders_status(5);
		$data['pullout']     = $this->orders_model->get_pull_out();

        $data['orders']    = $this->orders_model->get_orders_data(2);
        $data['logistics_1'] = $this->orders_model->get_logistics_data();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/warehouse/orders/fordelivery', $data);
		$this->load->view('accounts/templates/footer');
	}

	public function logistics()
	{
		$data['pending']     = $this->orders_model->get_orders_status(0);
        $data['approved']    = $this->orders_model->get_orders_status(1);
        $data['fordelivery'] = $this->orders_model->get_orders_status(2);
        $data['logistics']   = $this->orders_model->get_orders_status(3);
        $data['delivered']   = $this->orders_model->get_orders_status(4);
		$data['returned']    = $this->orders_model->get_orders_status(5);
		$data['pullout']     = $this->orders_model->get_pull_out();
		
        $data['orders']    = $this->orders_model->get_orders_data(3);
        $data['logistics_1'] = $this->orders_model->get_logistics_data();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/warehouse/orders/logistics', $data);
		$this->load->view('accounts/templates/footer');
	}

	
	public function delivered()
	{
		$data['pending']     = $this->orders_model->get_orders_status(0);
        $data['approved']    = $this->orders_model->get_orders_status(1);
        $data['fordelivery'] = $this->orders_model->get_orders_status(2);
        $data['logistics']   = $this->orders_model->get_orders_status(3);
        $data['delivered']   = $this->orders_model->get_orders_status(4);
		$data['returned']    = $this->orders_model->get_orders_status(5);
		$data['pullout']     = $this->orders_model->get_pull_out();

        $data['orders']    = $this->orders_model->get_orders_data(4);

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/warehouse/orders/delivered', $data);
		$this->load->view('accounts/templates/footer');
	}

	public function returned()
	{
		$data['pending']     = $this->orders_model->get_orders_status(0);
        $data['approved']    = $this->orders_model->get_orders_status(1);
        $data['fordelivery'] = $this->orders_model->get_orders_status(2);
        $data['logistics']   = $this->orders_model->get_orders_status(3);
        $data['delivered']   = $this->orders_model->get_orders_status(4);
		$data['returned']    = $this->orders_model->get_orders_status(5);
		$data['pullout']     = $this->orders_model->get_pull_out();

        $data['returned_1']  = $this->orders_model->get_returned_data();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/warehouse/orders/returned', $data);
		$this->load->view('accounts/templates/footer');
	}


	public function pullout()
	{
		$data['pending']     = $this->orders_model->get_orders_status(0);
        $data['approved']    = $this->orders_model->get_orders_status(1);
        $data['fordelivery'] = $this->orders_model->get_orders_status(2);
        $data['logistics']   = $this->orders_model->get_orders_status(3);
        $data['delivered']   = $this->orders_model->get_orders_status(4);
		$data['returned']    = $this->orders_model->get_orders_status(5);
		$data['pullout']     = $this->orders_model->get_pull_out();

        $data['pullouts']    = $this->orders_model->get_pullout_data();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/warehouse/orders/pullout', $data);
		$this->load->view('accounts/templates/footer');
	}

    public function order_list()
	{

		$data['pending']     = $this->orders_model->get_orders_status(0);
        $data['approved']    = $this->orders_model->get_orders_status(1);
        $data['fordelivery'] = $this->orders_model->get_orders_status(2);
        $data['logistics']   = $this->orders_model->get_orders_status(3);
        $data['delivered']   = $this->orders_model->get_orders_status(4);
		$data['returned']    = $this->orders_model->get_orders_status(5);
		$data['pullout']     = $this->orders_model->get_pull_out();

        $data['orders_list']   = $this->orders_model->get_order_list_data($_GET['transaction']);

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav',$data);
		$this->load->view('accounts/warehouse/orders/order_details', $data);
		$this->load->view('accounts/templates/footer');
	}


    public function process_approved()
	{

		$trans_code        = $this->input->post('trans_code');
		$email             = $this->input->post('email');
		$fullname          = $this->input->post('fullname');
		$customer_name     = $this->input->post('customer_name');


                $data = array(
					'trans_code'   => $trans_code,
                );

                $this->orders_model->process_approved($data);
		
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
		
				$mail1->Subject = 'Order Approved ' . $trans_code;
				$mail1->isHTML(true);
		
		
				$html1  = '<html>';
				$html1 .= '<body>';
				$html1 .= '<h2 class="text-danger">Approved Order ' . $trans_code. ' </h2>';
				$html1 .= '<p style="font-size:20px;color:#00000;"> Hello ' . $fullname   .', </p>';
				$html1 .= '<p style="font-size:20px;color:#00000;"> Order request has been approved by warehouse</p>';
		
				$html1 .= '<table cellpadding="0" cellspacing="0" border="0" width="600">';
				$html1 .= '<tr><td>';
				$html1 .= '<table cellpadding="0" cellspacing="0" border="1" width="100%" style=" font-size:20px;">';
				$html1 .= '<tr>
							<td style="text-align:left;">Transaction Code</td>
							<td style="padding-left: 10%;">'.$trans_code.'</td>
						   </tr>';
				$html1 .= '<tr>
						   <td style="text-align:left;">Customer Name </td>
						   <td style="padding-left: 10%;">'.$customer_name .'</td>
						  </tr>';
				
		    	$html1 .= '<tr>
						  <td style="text-align:left;">Approved By</td>
						  <td style="padding-left: 10%;">'.$this->session->userdata['logged_in']['name'].'</td>
						 </tr>';
			   
				$html1 .='</table>';
				$html1 .='</td></tr>';				
				$html1 .='
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

        $this->session->set_flashdata('success', 'Orders Approved Successfully!');
        redirect('orders/pending');
       
	}

    public function process_for_delivery()
	{

		$trans_code        = $this->input->post('trans_code');
		$email             = $this->input->post('email');
		$fullname          = $this->input->post('fullname');
		$customer_name     = $this->input->post('customer_name');

                $data = array(
					'trans_code'   => $trans_code,
                );


                $this->orders_model->process_for_delivery($data);

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
		
				$mail1->Subject = 'Order Ready For Delivery ' . $trans_code;
				$mail1->isHTML(true);
		
		
				$html1  = '<html>';
				$html1 .= '<body>';
				$html1 .= '<h2 class="text-danger"> Order ' . $trans_code. ' </h2>';
				$html1 .= '<p style="font-size:20px;color:#00000;"> Hello ' . $fullname   .', </p>';
				$html1 .= '<p style="font-size:20px;color:#00000;"> Order request has been processed for delivery by warehouse</p>';
		
				$html1 .= '<table cellpadding="0" cellspacing="0" border="0" width="600">';
				$html1 .= '<tr><td>';
				$html1 .= '<table cellpadding="0" cellspacing="0" border="1" width="100%" style=" font-size:20px;">';
				$html1 .= '<tr>
							<td style="text-align:left;">Transaction Code</td>
							<td style="padding-left: 10%;">'.$trans_code.'</td>
						   </tr>';
				$html1 .= '<tr>
						   <td style="text-align:left;">Customer Name </td>
						   <td style="padding-left: 10%;">'.$customer_name .'</td>
						  </tr>';
				
		    	$html1 .= '<tr>
						  <td style="text-align:left;">Processed By</td>
						  <td style="padding-left: 10%;">'.$this->session->userdata['logged_in']['name'].'</td>
						 </tr>';
			   
				$html1 .='</table>';
				$html1 .='</td></tr>';				
				$html1 .='
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

        $this->session->set_flashdata('success', 'Ready for Delivery Status Success!');
        redirect('orders/approved');
       
	}

	public function process_for_delivery_logistic()
	{

		$trans_code          = $this->input->post('trans_code');
		$logistic_id         = $this->input->post('logistic_id');
		$helper_name         = $this->input->post('helper_name');
		$plate_number        = $this->input->post('plate_number');
		$vehicle_type        = $this->input->post('vehicle_type');

		$email             = $this->input->post('email');
		$fullname          = $this->input->post('fullname');
		$customer_name     = $this->input->post('customer_name');


                $data = array(
					'trans_code'    => $trans_code,
					'logistic_id'   => $logistic_id,
					'helper_name'   => $helper_name,
					'plate_number'  => $plate_number,
					'vehicle_type'  => $vehicle_type,

                );

                $this->orders_model->process_for_delivery_logistic($data);

				$row = $this->db->query("SELECT * FROM tonios_employee WHERE id = '$logistic_id'")->row_array();

		
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
		
				$mail1->Subject = 'Order Assigned Logistics ' . $trans_code;
				$mail1->isHTML(true);
		
		
				$html1  = '<html>';
				$html1 .= '<body>';
				$html1 .= '<h2 class="text-danger"> Order ' . $trans_code. ' </h2>';
				$html1 .= '<p style="font-size:20px;color:#00000;"> Hello ' . $fullname   .', </p>';
				$html1 .= '<p style="font-size:20px;color:#00000;"> Order request has been assigned logistics by warehouse</p>';
		
				$html1 .= '<table cellpadding="0" cellspacing="0" border="0" width="600">';
				$html1 .= '<tr><td>';
				$html1 .= '<table cellpadding="0" cellspacing="0" border="1" width="100%" style=" font-size:20px;">';
				$html1 .= '<tr>
							<td style="text-align:left;">Transaction Code</td>
							<td style="padding-left: 10%;">'.$trans_code.'</td>
						   </tr>';
				$html1 .= '<tr>
						   <td style="text-align:left;">Customer Name </td>
						   <td style="padding-left: 10%;">'.$customer_name .'</td>
						  </tr>';
				
				$html1 .= '<tr>
						  <td style="text-align:left;">Logistics Name </td>
						  <td style="padding-left: 10%;">'.$row['fullname'] .'</td>
						 </tr>';
				
				$html1 .= '<tr>
						 <td style="text-align:left;">Logistics Contact </td>
						 <td style="padding-left: 10%;">'.$row['contact_no'] .'</td>
						</tr>';

				$html1 .= '<tr>
						<td style="text-align:left;">Helper  </td>
						<td style="padding-left: 10%;">'.$helper_name .'</td>
					   </tr>';

				$html1 .= '<tr>
					   <td style="text-align:left;">Plate Number  </td>
					   <td style="padding-left: 10%;">'.$plate_number .'</td>
					  </tr>';

				$html1 .= '<tr>
					  <td style="text-align:left;">Vehicle Type  </td>
					  <td style="padding-left: 10%;">'.$vehicle_type .'</td>
					 </tr>';

		    	$html1 .= '<tr>
						  <td style="text-align:left;">Processed By</td>
						  <td style="padding-left: 10%;">'.$this->session->userdata['logged_in']['name'].'</td>
						 </tr>';
			   
				$html1 .='</table>';
				$html1 .='</td></tr>';				
				$html1 .='
							</table>
							</body>
		
					</html>';

			    	$mail1->Body = $html1;
					if ($mail1->send()) {
						$message = 'success';
					} else {
						$message = 'failed';
					}

				// Email Logistics

				$mail2 = $this->phpmailer_library->load();
				$mail2->isSMTP();
				$mail2->Host     = 'smtp.hostinger.com';
				$mail2->SMTPAuth = true;
				$mail2->Username = 'notification@toniossisig.com';
				$mail2->Password = '@Programmer2013';
				$mail2->SMTPSecure = 'ssl'; // tls
				$mail2->Port     = 465; // 587
				$mail2->setFrom('notification@toniossisig.com', 'Tonios Sisig System Notification');
		
				$mail2->addAddress($email);
		
				$mail2->Subject = 'Order Assigned Logistics ' . $trans_code;
				$mail2->isHTML(true);
		
		
				$html2  = '<html>';
				$html2 .= '<body>';
				$html2 .= '<h2 class="text-danger"> Order ' . $trans_code. ' </h2>';
				$html2 .= '<p style="font-size:20px;color:#00000;"> Hello ' . $row['fullname']   .', </p>';
				$html2 .= '<p style="font-size:20px;color:#00000;"> Order request has been assigned to you by warehouse</p>';
		
				$html2 .= '<table cellpadding="0" cellspacing="0" border="0" width="600">';
				$html2 .= '<tr><td>';
				$html2 .= '<table cellpadding="0" cellspacing="0" border="1" width="100%" style=" font-size:20px;">';
				$html2 .= '<tr>
							<td style="text-align:left;">Transaction Code</td>
							<td style="padding-left: 10%;">'.$trans_code.'</td>
						   </tr>';
				$html2 .= '<tr>
						   <td style="text-align:left;">Customer Name </td>
						   <td style="padding-left: 10%;">'.$customer_name .'</td>
						  </tr>';
				
				$html2 .= '<tr>
						<td style="text-align:left;">Helper  </td>
						<td style="padding-left: 10%;">'.$helper_name .'</td>
					   </tr>';

				$html2 .= '<tr>
					   <td style="text-align:left;">Plate Number  </td>
					   <td style="padding-left: 10%;">'.$plate_number .'</td>
					  </tr>';

				$html2 .= '<tr>
					  <td style="text-align:left;">Vehicle Type  </td>
					  <td style="padding-left: 10%;">'.$vehicle_type .'</td>
					 </tr>';

		    	$html2 .= '<tr>
						  <td style="text-align:left;">Processed By</td>
						  <td style="padding-left: 10%;">'.$this->session->userdata['logged_in']['name'].'</td>
						 </tr>';
			   
				$html2 .='</table>';
				$html2 .='</td></tr>';				
				$html2 .='
							</table>
							</body>
		
					</html>';

			    	$mail2->Body = $html2;
					if ($mail2->send()) {
						$message = 'success';
					} else {
						$message = 'failed';
					}

		sleep(2);

        $this->session->set_flashdata('success', 'Asisgned Logistic Success!');
        redirect('orders/fordelivery');
       
	}

	public function process_for_delivery_order()
	{

		$id                  = $this->input->post('id');
		$quantity            = $this->input->post('quantity');
		$status              = $this->input->post('status');
		$transaction         = $this->input->post('transaction');
		$customer            = $this->input->post('customer');
		$partial_reason_w    = $this->input->post('partial_reason_w');
		$status_1            = $this->input->post('status_1');
		$type                = $this->input->post('type');
		$product_id          = $this->input->post('product_id');


                $data = array(
					'id'               => $id,
					'quantity'         => $quantity,
					'status'           => $status,
					'partial_reason_w' => $partial_reason_w,
					'product_id'       => $product_id,

                );

                $this->orders_model->process_for_delivery_order($data);


		sleep(2);

        $this->session->set_flashdata('success', 'Order Process Success!');
        redirect('orders/order-list?transaction='. $transaction . '&customer='. $customer. '&status='. $status_1. '&type='. $type);
       
	}


	public function process_return_inventory()
	{

		$id            = $this->input->post('id');
		$total_return  = $this->input->post('total_return');
		$product_id    = $this->input->post('product_id');

                $data = array(

					'id'             => $id,
					'total_return'   => $total_return,
					'product_id'     => $product_id,

                );

                $this->orders_model->process_return_inventory($data);


		sleep(2);

        $this->session->set_flashdata('success', 'Success Returned to Inventory');
        redirect('orders/returned');
       
	}
 
}
