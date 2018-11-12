<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Welcome extends BaseController {

	public function __construct()
    {
       parent::__construct();
	   	 $this->load->helper('url');
        //$this->load->database();
        //$this->load->helper('url');
        //$this->load->model('user_model');
        //$this->isLoggedOut();
    }


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['a'] = "asd";
		$this->loadViews("main/home", $this->global, $data);
		$this->loadViews("apps/login", $this->global);
		//$this->load->view('includes/header');
        //$this->load->view('main/home');
        //$this->load->view('includes/footer');
	}

	public funtion isLoggedOut(){
		redirect("/login");
	}
}

?>
