<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Asia/Manila");

class Production extends CI_Controller {

	public function __construct() {

        parent::__construct();
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

		ob_start();

        $this->load->model('production_model');
        $this->load->model('products_model');
		$this->load->library('phpmailer_library');

        
		if(!isset($this->session->userdata['logged_in']['user_id'])){
			redirect("auth");
		}

    }

	public function inventory()
	{
        $data['category'] = $this->production_model->get_category_data();
        $data['inventory'] = $this->production_model->get_inventory_data();
        $data['inventory_1'] = $this->production_model->get_inventory_data_1();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/production/inventory', $data);
		$this->load->view('accounts/templates/footer');
	}

    public function expenses()
	{
        $data['expenses'] = $this->production_model->get_expenses_data($this->session->userdata['logged_in']['department']);

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/production/expenses', $data);
		$this->load->view('accounts/templates/footer');
	}

    public function restock()
	{
        $data['restocks']  = $this->production_model->get_restocks_data();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/production/restock', $data);
		$this->load->view('accounts/templates/footer');
	}

    public function reduction()
	{
        $data['reduction']  = $this->production_model->get_reduction_data();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/production/reduction', $data);
		$this->load->view('accounts/templates/footer');
	}


	public function endorsed()
	{
        $data['endorsed']  = $this->production_model->get_endorsed_data();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/production/endorsed', $data);
		$this->load->view('accounts/templates/footer');
	}

	public function finish_products()
	{
        $data['finish']   = $this->production_model->get_finish_data();
        $data['products'] = $this->products_model->get_products_data();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/production/finish_products', $data);
		$this->load->view('accounts/templates/footer');
	}

    public function category()
	{

        $data['category'] = $this->production_model->get_category_data();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/production/category' , $data);
		$this->load->view('accounts/templates/footer');
	}

    public function process_production_inventory(){

        $category  = $this->input->post('category');
        $product   = $this->input->post('product');
        $quantity  = $this->input->post('quantity');
        $unit      = $this->input->post('unit');

		$data = array(

				'category'        => $category,
                'product'         => $product,
				'quantity'        => $quantity,
				'unit'            => $unit,
				'process_by'      => $this->session->userdata['logged_in']['name'],
				'date_Added'      => date('Y-m-d H:i:s'),
  
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->production_model->process_production_inventory($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
	
    }

    public function process_production_inventory_restock(){

        $category  = $this->input->post('category');
        $product   = $this->input->post('product');
        $quantity  = $this->input->post('quantity');

		$data = array(

                'product'         => $product,
				'quantity'        => $quantity,
				'process_by'      => $this->session->userdata['logged_in']['name'],
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
                'category'       => $category,
                'department'     => $this->session->userdata['logged_in']['department'],
				'report_by'      => $this->session->userdata['logged_in']['name'],
				'date_Added'     => date('Y-m-d H:i:s'),
  
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->production_model->process_expenses_reports($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
	
		redirect("production/expenses?added");   


    }

    public function process_production_inventory_reduction(){

        $category  = $this->input->post('category');
        $product   = $this->input->post('product');
        $quantity  = $this->input->post('quantity');

		$data = array(

                'product'         => $product,
				'quantity'        => $quantity,
				'process_by'      => $this->session->userdata['logged_in']['name'],
				'date_Added'      => date('Y-m-d H:i:s'),
  
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->production_model->process_production_inventory_reduction($process);


		$row = $this->db->query("SELECT * FROM tonios_production_inventory WHERE id = '$product'")->row_array();



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
 
		$mail1->Subject = "Production Planning Endorse Inventory";
		$mail1->isHTML(true);
 
 
		$html1  = '<html>';
		$html1 .= '<body>';
		$html1 .= '<p style="font-size:20px;color:#00000;"> Hello Production, </p>';
		$html1 .= '<p style="font-size:20px;color:#00000;"> Production Planning endorse inventory</p>';
 
		$html1 .= '<table cellpadding="0" cellspacing="0" border="0" width="600">';
		$html1 .= '<tr><td>';
		$html1 .= '<table cellpadding="0" cellspacing="0" border="1" width="100%" style=" font-size:20px;">';
		$html1 .= '<tr>
					<td style="text-align:left;">Inventory Name</td>
					<td style="padding-left: 10%;">'.$row['product'].'</td>
				   </tr>';
		$html1 .= '<tr>
				   <td style="text-align:left;">Stock Quantity (Kilo/pcs)  </td>
					<td style="padding-left: 10%;">'.$quantity.'</td>
				  </tr>';
		$html1 .= '<tr>
				  <td style="text-align:left;">Endorse by  </td>
				   <td style="padding-left: 10%;">'.$this->session->userdata['logged_in']['name'].'</td>
				 </tr>';
		$html1 .= '<tr>
				  <td style="text-align:left;">Date </td>
				  <td style="padding-left: 10%;">'. date('Y-m-d H:i:s').'</td>
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
		 
 
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
	


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

	public function received_endorse_inventory(){

        $id        = $this->input->post('id');
     
		$data = array(

                'id'              => $id,
				'is_received'     => 1,
                'received_by'     => $this->session->userdata['logged_in']['name'],
                'received_date'   => date('Y-m-d H:i:s'),

		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->production_model->received_endorse_inventory($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
	
		redirect("production/inventory/endorsed");   


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


	public function process_finish_products()
	{

		$product_id       = $this->input->post('product_id');
        $quantities       = $this->input->post('quantity');
        $batch_no         = $this->input->post('batch_no');

        if (!empty($product_id)) {
            for ($i = 0; $i < count($product_id); $i++) {

                $data = array(
					'batch_no'         => $batch_no,
					'process_by'       => $this->session->userdata['logged_in']['name'],
                    'product'          => $product_id[$i],
                    'quantity'         => $quantities[$i],
					'date_Added'       => date('Y-m-d H:i:s'),
                );

                $this->production_model->process_finish_products($data);
            }
        }


		sleep(2);

        $this->session->set_flashdata('success', 'Orders Submitted Successfully!');
        redirect('production/inventory/finish-products');
       
	}

	public function remove_batch_products()
	{

       $batch_no         = $this->input->post('batch_no');

       $this->production_model->remove_batch_products($batch_no);
        

		sleep(2);

        $this->session->set_flashdata('success', 'Btach Products Removed Successfully!');
        redirect('production/inventory/finish-products');
       
	}


	public function endorse_batch_products()
	{

       $batch_no         = $this->input->post('batch_no');


	   $data = array(

		'batch_no'        => $batch_no,
		'is_status'       => 1,
		'endorse_by'      => $this->session->userdata['logged_in']['name'],
		'endorse_date'    => date('Y-m-d H:i:s'),

		);

		$process  = $this->security->xss_clean($data);


       $this->production_model->endorse_batch_products($process);


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

	   $mail1->Subject = "Production Products -  Batch : " . $batch_no;
	   $mail1->isHTML(true);


	   $html1  = '<html>';
	   $html1 .= '<body>';
	   $html1 .= '<p style="font-size:20px;color:#00000;"> Hello Warehouse, </p>';
	   $html1 .= '<h2 class="text-danger">Production Products Batch ' . $batch_no. ' </h2>';
	   $html1 .= '<p style="font-size:20px;color:#00000;"> Please check Inventory for Receivable</p>';

	   $html1 .= '<table cellpadding="0" cellspacing="0" border="0" width="600">';
	   $html1 .= '<tr><td>';
	   $html1 .= '<table cellpadding="0" cellspacing="0" border="1" width="100%" style=" font-size:20px;">';
	   $html1 .= '<tr>
				   <td style="text-align:left;">Batch Name</td>
				   <td style="padding-left: 10%;">'.$batch_no.'</td>
				  </tr>';
	   $html1 .= '<tr>
				  <td style="text-align:left;">Process By  </td>
				  <td style="padding-left: 10%;">'.$this->session->userdata['logged_in']['name'] .'</td>
				 </tr>';
	   
       $html1 .= '<tr>
				 <td style="text-align:left;">Date </td>
				 <td style="padding-left: 10%;">'. date('Y-m-d H:i:s').'</td>
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

        $this->session->set_flashdata('success', 'Batch Products Endorse to warehouse Successfully!');
        redirect('production/inventory/finish-products');
       
	}

    

}
