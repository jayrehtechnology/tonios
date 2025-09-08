<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Asia/Manila");

class Employee extends CI_Controller {

	public function __construct() {

        parent::__construct();
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

		ob_start();
        $this->load->library('phpmailer_library');

        $this->load->model('employee_model');


		if(!isset($this->session->userdata['logged_in']['user_id'])){
			redirect("auth");
		}

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

	public function index()
	{

        $data['customer'] = $this->employee_model->get_employee_data();

		$this->load->view('accounts/templates/header');
		$this->load->view('accounts/templates/nav');
		$this->load->view('accounts/employee/index', $data);
		$this->load->view('accounts/templates/footer');
	}

	public function process_employee(){

      

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
        $department         = $this->input->post('department');
        $is_system          = $this->input->post('system_access');
      
       
        if($is_system == 1){

            $password       = $this->generatePassword();
            $is_systems     = 1;

            $data = array(

				'id_no'           => $id_no,
                'fullname'        => $fullname,
				'contact_no'      => $contact_no,
				'email'           => $email,
				'address'         => $address,
                'age'             => $age,
				'birthdate'       => $birthdate,
				'gender'          => $gender,
				'position'        => $position,
				'incase_emegency' => $incase_emegency,
				'date_hired'      => $date_hired,
				'department'      => $department,
				'is_system'       => $is_systems,
                'password'         => $this->hash($password),
				'date_registered' => date('Y-m-d H:i:s'),
  
		    );

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
    
            $mail1->Subject = 'System Account';
            $mail1->isHTML(true);
    
    
            $html1  = '<html>';
            $html1 .= '<body>';
            $html1 .= '<h2 class="text-danger">Welcome to Tonios Sisig System</h2>';
            $html1 .= '<p style="font-size:20px;color:#00000;"> Hello ' . $fullname .', </p>';
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
        } else {
            $is_systems = 0;
            $data = array(

				'id_no'           => $id_no,
                'fullname'        => $fullname,
				'contact_no'      => $contact_no,
				'email'           => $email,
				'address'         => $address,
                'age'             => $age,
				'birthdate'       => $birthdate,
				'gender'          => $gender,
				'position'        => $position,
				'incase_emegency' => $incase_emegency,
				'date_hired'      => $date_hired,
				'department'      => $department,
				'is_system'       => $is_systems,
				'date_registered' => date('Y-m-d H:i:s'),
  
		    );
        }

	
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->employee_model->process_employee($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
        
        sleep(2);

        $this->session->set_flashdata('success', ' Employee Data Added! ');

		redirect("employees");   

    }


    public function update_employee(){

      

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
        $department         = $this->input->post('department');
        $is_system          = $this->input->post('system_access');
        $id                 = $this->input->post('id');

       
        if($is_system == 1){

            $data = array(
				'id'              => $id,
				'id_no'           => $id_no,
                'fullname'        => $fullname,
				'contact_no'      => $contact_no,
				'email'           => $email,
				'address'         => $address,
                'age'             => $age,
				'birthdate'       => $birthdate,
				'gender'          => $gender,
				'position'        => $position,
				'incase_emegency' => $incase_emegency,
				'date_hired'      => $date_hired,
				'department'      => $department,
				'is_system'       => $is_systems,
                'password'         => $this->hash($password),
				'date_registered' => date('Y-m-d H:i:s'),
  
		    );

        } else {
            $is_systems = 0;
            $data = array(
				'id'              => $id,
				'id_no'           => $id_no,
                'fullname'        => $fullname,
				'contact_no'      => $contact_no,
				'email'           => $email,
				'address'         => $address,
                'age'             => $age,
				'birthdate'       => $birthdate,
				'gender'          => $gender,
				'position'        => $position,
				'incase_emegency' => $incase_emegency,
				'date_hired'      => $date_hired,
				'department'      => $department,
				'is_system'       => $is_systems,
				'date_registered' => date('Y-m-d H:i:s'),
  
		    );
        }

	
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->employee_model->update_employee($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
        
        sleep(2);

        $this->session->set_flashdata('success', ' Employee Data Updated! ');

		redirect("employees");   

    }

	public function update_customers(){

        $customer_name      = $this->input->post('customer_name');
        $customer_contact   = $this->input->post('customer_contact');
        $customer_address   = $this->input->post('customer_address');
        $customer_type      = $this->input->post('customer_type');
        $agent_id           = $this->input->post('agent_id');
        $id                 = $this->input->post('id');

		$data = array(

				'customer_name'        => $customer_name,
                'customer_contact'     => $customer_contact,
				'customer_address'     => $customer_address,
				'customer_type'        => $customer_type,
				'agent_id'             => $agent_id,
				'id'                   => $id,
  
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->customer_model->update_customers($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
	
		redirect("customers?updated");   

    }

	public function delete_employee(){

       
        $id                 = $this->input->post('id');

		$data = array(

				'id'                   => $id,
  
		);
	
		$process  = $this->security->xss_clean($data);
	
		$result = $this->employee_model->delete_employee($process);
	
		$response = array(
			'csrfHash' => $this->security->get_csrf_hash(),
			'result' => $result,
		);
        
        sleep(2);

        $this->session->set_flashdata('success', ' Employee Data Deleted! ');

		redirect("employees");   

    }



}
