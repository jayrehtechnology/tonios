<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Asia/Manila");

class Logout extends CI_Controller {

	public function __construct() {

        parent::__construct();
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

		ob_start();


}

public function index() {

    $this->load->driver('cache');

    $this->session->sess_destroy();

    $this->cache->clean();

    ob_clean();

    redirect('auth');
}


}
