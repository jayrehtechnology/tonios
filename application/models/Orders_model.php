<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Orders_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Manila');


        $this->load->database();

    }

	public function get_orders_status($data) {
        
		if($data == 5){

			$query = $this->db->query("SELECT count(total_return) total_return FROM tonios_customer_orders where status='4' and is_returned = '1'");
			return $query->num_rows();

		} else {

			$query = $this->db->query("SELECT * FROM tonios_customer_orders where status='$data'");
			return $query->num_rows();

		}

	}
	
	public function get_pull_out() {
        
		$query = $this->db->query("SELECT count(*)  FROM tonios_pull_out_products group by trans_code");
		return $query->num_rows();

	}

	public function get_pullout_data() {
        
		$this->db->select('a.*, b.customer_name');
		$this->db->from('tonios_pull_out_products a');
        $this->db->join('tonios_customers b', 'b.id = a.customer_id', 'left'); // LEFT JOIN
		$this->db->where("a.is_process", 0);

		$this->db->group_by('a.trans_code'); 

		$query = $this->db->get();
        return $query->result();

	}

	
	public function order_transactions() {
        
		$query = $this->db->query("SELECT count(*) total_trans FROM tonios_customer_orders group by trans_code");
		return $query->num_rows();

	}

	public function product_sold() {
        
		$query = $this->db->query("SELECT sum(delivered_quantity) delivered_quantity FROM tonios_customer_orders");
        return  $query->row(); 

	}

	public function charity_donation() {
        
		$query = $this->db->query("SELECT count(*) total_charity  FROM tonios_charity_orders");
        return  $query->row(); 

	}
	
	public function total_customers() {
        
		$query = $this->db->query("SELECT count(*)  total_customer   FROM tonios_customers");
        return  $query->row(); 

	}

	public function report_sales() {
        
		$query = $this->db->query("SELECT  sum(total_collected) total_sales FROM tonios_sales_reports");
        return  $query->row(); 

	}

	public function credits_sales() {
        
		$query = $this->db->query("SELECT  sum(total_credit) total_credit FROM tonios_sales_reports");
        return  $query->row(); 

	}

	public function reports_collections() {
        
		$query = $this->db->query("SELECT  sum(total_collected) total_collected FROM tonios_sales_reports where mop = 'COLLECTION' ");
        return  $query->row(); 

	}

	public function report_expenses() {
        
		$query = $this->db->query("SELECT  sum(amount) total_expenses FROM tonios_expenses_reports");
        return  $query->row(); 

	}

	public function report_reimbursement() {
        
		$query = $this->db->query("SELECT  sum(amount) total_reimbursement FROM tonios_reimbursement");
        return  $query->row(); 

	}

	public function report_payroll() {
        
		$query = $this->db->query("SELECT  sum(netpay) total_netpay FROM tonios_payroll_data");
        return  $query->row(); 

	}

	public function products_reports(){

		$query = $this->db->query("SELECT b.product_name, sum(a.delivered_quantity) total_qty, sum(a.delivered_quantity * a.price) total_sum FROM `tonios_customer_orders` a LEFT JOIN tonios_products b on a.product_id = b.id group by a.product_id");

        return $query->result();
		

	}

	public function products_reports_by_month($y){

		$query = $this->db->query("
		SELECT 
            b.product_name, 
            MONTH(a.delivered_date) AS month_number,
            MONTHNAME(a.delivered_date) AS month_name, 
            YEAR(a.delivered_date) AS year, 
            SUM(a.delivered_quantity) AS total_qty, 
            SUM(a.delivered_quantity * a.price) AS total_sum 
        FROM tonios_customer_orders a 
        LEFT JOIN tonios_products b ON a.product_id = b.id 
        WHERE YEAR(a.delivered_date) = '$y'
        GROUP BY b.product_name, MONTH(a.delivered_date), YEAR(a.delivered_date) 
        ORDER BY year, month_number, b.product_name
		");

        return $query->result();
		

	}

	public function products_reports_by_daily($y , $m){

		$query = $this->db->query("
		  SELECT 
            DATE(a.delivered_date) AS sales_date,
            SUM(a.delivered_quantity) AS total_qty,
            SUM(a.delivered_quantity * a.price) AS total_sum
        FROM tonios_customer_orders a
        WHERE MONTH(a.delivered_date) = '$m' AND YEAR(a.delivered_date) = '$y'
        GROUP BY DATE(a.delivered_date)
        ORDER BY sales_date ASC
		");

        return $query->result();
		

	}

	public function get_quarterly_sales_report($y){

		$query = $this->db->query("
		  SELECT 
            b.product_name,
            QUARTER(a.delivered_date) AS quarter,
            YEAR(a.delivered_date) AS year,
            SUM(a.delivered_quantity) AS total_qty,
            SUM(a.delivered_quantity * a.price) AS total_sum
        FROM tonios_customer_orders a
        LEFT JOIN tonios_products b ON a.product_id = b.id
		WHERE YEAR(a.delivered_date) = '$y'
        GROUP BY b.product_name, YEAR(a.delivered_date), QUARTER(a.delivered_date)
        ORDER BY year ASC, quarter ASC, b.product_name ASC
		");

        return $query->result();
		

	}

	public function get_sales_by_customer_by_year($y)
	{
			$query = $this->db->query("
				SELECT 
					c.id AS customer_id,
					c.customer_name,
					YEAR(a.delivered_date) AS year,
					SUM(a.delivered_quantity) AS total_qty,
					SUM(a.delivered_quantity * a.price) AS total_sum
				FROM tonios_customer_orders a
				LEFT JOIN tonios_customers c ON a.customer_id = c.id
				WHERE YEAR(a.delivered_date) = '$y'
				GROUP BY a.customer_id, YEAR(a.delivered_date)
				ORDER BY year ASC, total_sum DESC
			");

			return $query->result();
	}

	public function get_top_customer_sales($y, $limit = 100)
	{
		$query = $this->db->query("
			SELECT 
				c.id AS customer_id,
				c.customer_name,
				SUM(a.delivered_quantity) AS total_qty,
				SUM(a.delivered_quantity * a.price) AS total_sales
			FROM tonios_customer_orders a
			LEFT JOIN tonios_customers c ON a.customer_id = c.id
			WHERE YEAR(a.delivered_date) = '$y'

			GROUP BY a.customer_id
			ORDER BY total_sales DESC
			LIMIT $limit
		");

		return $query->result();
	}

	public function products_reports_by_mtd_ytd($cutoff_date = null, $y){

		$cutoff = date('m-d');
		$mtd_start_2024 = $y-1 .'-07-01';
		$mtd_end_2024   = $y-1 .date('m-d');
	
		$mtd_start_2025 = $y .  '-' .date('m').'-01';
		$mtd_end_2025   = $y . date('m-d');
	
		$ytd_start_2024 = $y-1 .'-01-01';
		$ytd_end_2024   = $y-1 . date('m-d');
	
		$ytd_start_2025 = $y .'-01-01';
		$ytd_end_2025   = $y . date('m-d');
	
		$query = $this->db->query("
			SELECT 
				SUM(CASE WHEN delivered_date BETWEEN ? AND ? THEN delivered_quantity ELSE 0 END) AS mtd_2024,
				SUM(CASE WHEN delivered_date BETWEEN ? AND ? THEN delivered_quantity ELSE 0 END) AS mtd_2025,
				SUM(CASE WHEN date_added BETWEEN ? AND ? THEN delivered_quantity ELSE 0 END) AS ytd_2024,
				SUM(CASE WHEN delivered_date BETWEEN ? AND ? THEN delivered_quantity ELSE 0 END) AS ytd_2025
			FROM tonios_customer_orders
		", [
			$mtd_start_2024, $mtd_end_2024,
			$mtd_start_2025, $mtd_end_2025,
			$ytd_start_2024, $ytd_end_2024,
			$ytd_start_2025, $ytd_end_2025
		]);
	
		return $query->row();

		

	}

	public function get_sales_data() {


		$query = $this->db->query("SELECT b.product_name, sum( a.delivered_quantity * a.price) total_sum FROM `tonios_customer_orders` a left join tonios_products b on a.product_id = b.id where a.status = 4 group by a.product_id");

        return $query->result();
    }
	

	public function get_sales_per_month() {

		$query = $this->db->query("SELECT b.product_name,YEAR(a.delivered_date) AS sale_year,MONTH(a.delivered_date) AS sale_month,   sum( a.process_quantity * a.price) total_sum FROM `tonios_customer_orders` a left join tonios_products b on a.product_id = b.id where a.status = 4 group by YEAR(a.delivered_date), MONTH(a.delivered_date)");
        return $query->result();

    }

	public function get_monthly_sales(){

		$query = $this->db->query("
			SELECT SUM(IF(month = 'Jan', total, 0)) AS 'Jan', 
			SUM(IF(month = 'Feb', total, 0)) AS 'Feb', 
			SUM(IF(month = 'Mar', total, 0)) AS 'Mar', 
			SUM(IF(month = 'Apr', total, 0)) AS 'Apr', 
			SUM(IF(month = 'May', total, 0)) AS 'May', 
			SUM(IF(month = 'Jun', total, 0)) AS 'Jun', 
			SUM(IF(month = 'Jul', total, 0)) AS 'Jul', 
			SUM(IF(month = 'Aug', total, 0)) AS 'Aug', 
			SUM(IF(month = 'Sep', total, 0)) AS 'Sep', 
			SUM(IF(month = 'Oct', total, 0)) AS 'Oct', 
			SUM(IF(month = 'Nov', total, 0)) AS 'Nov', 
			SUM(IF(month = 'Dec', total, 0)) AS 'Dec' 
			FROM ( SELECT DATE_FORMAT(delivered_date, '%b') AS month, 
			SUM(delivered_quantity * price) as total FROM tonios_customer_orders 
			WHERE delivered_date <= NOW() and delivered_date >= Date_add(Now(),interval - 12 month) and status = 4 GROUP BY DATE_FORMAT(delivered_date, '%m-%Y')) as sub

		");

        return $query->row_array();


	}

	public function get_monthly_expenses(){

		$query = $this->db->query("
			SELECT SUM(IF(month = 'Jan', total, 0)) AS 'Jan', 
			SUM(IF(month = 'Feb', total, 0)) AS 'Feb', 
			SUM(IF(month = 'Mar', total, 0)) AS 'Mar', 
			SUM(IF(month = 'Apr', total, 0)) AS 'Apr', 
			SUM(IF(month = 'May', total, 0)) AS 'May', 
			SUM(IF(month = 'Jun', total, 0)) AS 'Jun', 
			SUM(IF(month = 'Jul', total, 0)) AS 'Jul', 
			SUM(IF(month = 'Aug', total, 0)) AS 'Aug', 
			SUM(IF(month = 'Sep', total, 0)) AS 'Sep', 
			SUM(IF(month = 'Oct', total, 0)) AS 'Oct', 
			SUM(IF(month = 'Nov', total, 0)) AS 'Nov', 
			SUM(IF(month = 'Dec', total, 0)) AS 'Dec' 
			FROM ( SELECT DATE_FORMAT(date_added, '%b') AS month, 
			SUM(amount) as total FROM tonios_expenses_reports 
			WHERE date_added <= NOW() and date_added >= Date_add(Now(),interval - 12 month)  GROUP BY DATE_FORMAT(date_added, '%m-%Y')) as sub

		");

        return $query->row_array();


	}

	public function get_orders_data($data) {
        
   
		if($data == 2){
			
			$this->db->select('a.*,sum(a.quantity)total_qty,sum(a.process_quantity)process_quantity, sum(a.process_quantity * a.price) total_sum, sum(a.total) total_amount , b.customer_name,b.customer_contact,b.customer_address,c.fullname,c.email');
			$this->db->from('tonios_customer_orders a');
			$this->db->join('tonios_customers b', 'a.customer_id = b.id', 'left');
			$this->db->join('tonios_employee c', 'a.agent_id = c.id', 'left');
			$this->db->where("a.status", $data);
			$this->db->group_by('a.trans_code'); 
	
		}
		else if($data == 3){
			
			$this->db->select('a.*,sum(a.quantity)total_qty,sum(a.process_quantity)process_quantity, sum(a.process_quantity * a.price) total_sum, sum(a.total) total_amount , b.customer_name,b.customer_contact,b.customer_address,c.fullname,c.email');
			$this->db->from('tonios_customer_orders a');
			$this->db->join('tonios_customers b', 'a.customer_id = b.id', 'left');
			$this->db->join('tonios_employee c', 'a.assign_logistic = c.id', 'left');
			$this->db->where("a.status", $data);
			$this->db->group_by('a.trans_code'); 
	
		}
		else if($data == 4){
			
			$this->db->select('a.*,(SELECT COUNT(*) FROM tonios_customer_orders dd WHERE dd.is_delivered_complete = 2 AND dd.trans_code = a.trans_code ) AS orders_with_status_2,(SELECT COUNT(*) FROM tonios_customer_orders dd WHERE dd.is_returned = 1 AND dd.trans_code = a.trans_code ) AS orders_with_status_3,sum(total_return) total_return,sum(process_quantity) - sum(total_return) total_delivered,sum(a.quantity)total_qty,sum(a.process_quantity)process_quantity, sum(a.total) total_amount , b.customer_name,b.customer_contact,b.customer_address,c.fullname,c.email');
			$this->db->from('tonios_customer_orders a');
			$this->db->join('tonios_customers b', 'a.customer_id = b.id', 'left');
			$this->db->join('tonios_employee c', 'a.assign_logistic = c.id', 'left');
			$this->db->where("a.status", $data);
			$this->db->group_by('a.trans_code'); 
	
		} else {

			$this->db->select('a.*,sum(a.quantity)total_qty,sum(a.process_quantity)process_quantity, sum(a.total) total_amount , b.customer_name,b.customer_contact,b.customer_address,c.fullname,c.email');
			$this->db->from('tonios_customer_orders a');
			$this->db->join('tonios_customers b', 'a.customer_id = b.id', 'left');
			$this->db->join('tonios_employee c', 'a.agent_id = c.id', 'left');
			$this->db->where("a.status", $data);
			$this->db->group_by('a.trans_code'); 

		}
 
		$query = $this->db->get();

        return $query->result();

	}

	public function get_returned_data() {
        
		    $this->db->select('a.*,(SELECT COUNT(*) FROM tonios_customer_orders dd WHERE dd.is_delivered_complete = 2 AND dd.trans_code = a.trans_code ) AS orders_with_status_2,(SELECT COUNT(*) FROM tonios_customer_orders dd WHERE dd.is_returned = 1 AND dd.trans_code = a.trans_code ) AS orders_with_status_3,sum(total_return) total_return,sum(process_quantity) - sum(total_return) total_delivered,sum(a.quantity)total_qty,sum(a.process_quantity)process_quantity, sum(a.total) total_amount , b.customer_name,b.customer_contact,b.customer_address,c.product_name,c.id product_id');
			$this->db->from('tonios_customer_orders a');
			$this->db->join('tonios_customers b', 'a.customer_id = b.id', 'left');
			$this->db->join('tonios_products c', 'a.product_id = c.id', 'left');
			$this->db->where("a.status", 4);
			$this->db->where("a.is_returned", 1);

 
		$query = $this->db->get();

        return $query->result();

	}


	public function get_logistics_data() {
        
        $this->db->select('*');
		$this->db->from('tonios_employee a');
        $this->db->where("department", 'Logistics');
		$query = $this->db->get();
        return $query->result();

	}


	

	public function process_approved($data) {

		$trans_code = $data['trans_code'];

		$this->db->query("UPDATE `tonios_customer_orders` SET `status` = '1' WHERE `trans_code` = '$trans_code'");


		return $this->db->affected_rows() > 0;
	}


    public function process_for_delivery($data) {

		$trans_code = $data['trans_code'];

		$this->db->query("UPDATE `tonios_customer_orders` SET `status` = '2' WHERE `trans_code` = '$trans_code'");


		return $this->db->affected_rows() > 0;
	}


	public function process_for_delivery_logistic($data) {

		$trans_code   = $data['trans_code'];
		$logistic_id  = $data['logistic_id'];
		$helper_name  = $data['helper_name'];
		$plate_number = $data['plate_number'];
		$vehicle_type = $data['vehicle_type'];

		$this->db->query("UPDATE `tonios_customer_orders` SET `status` = '3' ,  assign_logistic='$logistic_id' ,  helper_name='$helper_name' ,  plate_number='$plate_number' ,  vehicle_type='$vehicle_type' WHERE `trans_code` = '$trans_code'");


		return $this->db->affected_rows() > 0;
	}


    public function process_for_delivery_order($data) {

		$id                 = $data['id'];
		$quantity           = $data['quantity'];
		$status             = $data['status'];
		$partial_reason_w   = $data['partial_reason_w'];
		$product_id         = $data['product_id'];
		$process_date       = date('Y-m-d H:i:s');

		$this->db->query("UPDATE `tonios_products` SET `inventory_in`  = inventory_in- '$quantity'  ,  inventory_out = inventory_out + '$quantity' WHERE `id` = '$product_id'");

		$this->db->query("UPDATE `tonios_customer_orders` SET process_quantity = process_quantity + '$quantity' , is_complete='$status' , partial_reason_w='$partial_reason_w',process_date='$process_date' WHERE `id` = '$id'");


		return $this->db->affected_rows() > 0;
	}


	public function process_return_inventory($data) {

		$id         = $data['id'];
		$quantity   = $data['total_return'];
		$product_id = $data['product_id'];

		$this->db->query("UPDATE `tonios_products` SET inventory_in = inventory_in + '$quantity'  WHERE `id` = '$product_id'");
		$this->db->query("UPDATE `tonios_customer_orders` SET is_returned_inventory = 1  WHERE `id` = '$id'");


		return $this->db->affected_rows() > 0;
	}





    public function get_stock_in_data() {
        
        $this->db->select('a.* , b.product_name  , c.firstname , c.lastname');
		$this->db->from('tonios_warehouse_stock_in a');
		$this->db->join('tonios_products b', 'a.product = b.id', 'left');
		$this->db->join('tonios_system_user c', 'c.id = a.process_by', 'left');

		$query = $this->db->get();
        return $query->result();

	}


    public function get_order_list_data($trans) {
        
        $this->db->select('a.*,b.product_name');
		$this->db->from('tonios_customer_orders a');
		$this->db->join('tonios_products b', 'a.product_id = b.id', 'left');
		$this->db->where("a.trans_code", $trans);


		$query = $this->db->get();
        return $query->result();

	}

	

}
	
?>