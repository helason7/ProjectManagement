<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Main extends BaseController {

	public function __construct()
    {
       parent::__construct();
	    $this->load->helper('url');
        $this->load->model('project_model');
        $this->isLoggedIn();
    }


	
	public function index()
	{
		
		 $usertype= $this->session->userdata ( 'type_id' );
		if($this->isAdmin() == true or $this->session->userdata ( 'type_id' ) == '2' )
        {
			$data['a'] = "asd";
			$data['CountOpp']		= count($this->project_model->getAllOpportunities());
			$data['CountProject']	= count($this->project_model->getAllProjects());
			$data['CountAct']		= count($this->project_model->getAllActivities());
			$data['CountIssue']		= count($this->project_model->getAllIssues());

			$data['AccountOpp']		= $this->project_model->getAccountOpp();

			$data['Issues']			= $this->project_model->getCriticalIssues();
			
			$data['Projects']		= $this->project_model->getAllProjects();
			
			
			$data['url1']= 	base_url().'project/viewprojectDocumentAM/';
			
			
			$this->loadViews("main/home", $this->global, $data);
		}	
		else if($usertype == '9' )
        {
			$data['a'] = "asd";
			$data['CountOpp']		= count($this->project_model->getAllOpportunities());
			$data['CountProject']	= count($this->project_model->getAllProjects());
			$data['CountAct']		= count($this->project_model->getAllActivities());
			$data['CountIssue']		= count($this->project_model->getAllIssues());

			$data['AccountOpp']		= $this->project_model->getAccountOpp();

			$data['Issues']			= $this->project_model->getCriticalIssues();
			
			$data['Projects']		= $this->project_model->getAllProjects();
			
			
			$data['url1']= 	base_url().'project/viewprojectDocumentAM/';
			
			
			$this->loadViews("main/home_2", $this->global, $data);
		}	
	
	
	}

	public function logout(){
			$data = new stdClas();

			if(isset($_SESSION['isLoggedIn'])&& $_SESSION['isLoggedIn'] === true){
				foreach ($_SESSION as $key => $value) {
					unset($_SESSION[$key]);
				}

				$this->load->view('/login', $data);
			}else{
				redirect('/');
			}
	}
}
