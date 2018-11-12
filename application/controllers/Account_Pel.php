<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Chart (ChartController)
 * chart dashboard.
 * @author : Port SOlution Warrior
 * @version : X
 * @since : 23 Januari 2018
 */
class Account_Pel extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('project_model');
        $this->load->model('Accpel_model');
        $this->load->library('form_validation');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Dashboard';
        
		if($this->isAdmin() == true)
        {
            
			redirect('Account_Pel/AccpelList/');
        
		
		}
        else
        {
            redirect('/Main');
        }
    }
	
	public function accpelList()
    {
        $this->global['pageTitle'] = 'ILCS MANAGEMENT DASHBOARD';
        
		
		$data['accpels']	= $this->Accpel_model->getListAccpel();
			
		
		$this->loadViews("accpel/list_accpel", $data);
		
    }
	
	public function addNewAccpel()
    {
        $this->global['pageTitle'] = 'Setup Master Account';
        
		if(true)
        {
            
			//$data['opportunities']	= $this->project_model->getAllOpportunities();
			$data['a'] = "addNewActivity";
			$this->loadViews("accpel/add_form", $this->global, $data);
        
		
		}
        else
        {
            redirect('/Main');
        }
    }
	
	public function doAddAccpel()
    {
        
		if(true)
        {
            
            $this->form_validation->set_rules('name','Account Name','required');
            // $this->form_validation->set_rules('idAcc','ID Account','max_length[8]|xss_clean|numeric|required');
             if($this->form_validation->run() == FALSE){
					$this->session->set_flashdata('error', 'Account creation failed');
					$this->loadViews('Accpel/add_form');
             }else{

				print_r($_POST);
				//$this->loadViews("project/list_projects", $this->global, $data);
				$name = $this->input->post('name');
				// $idAccount_Pel = $this->input->post('idAcc');
				
				
				$array = array('ACCOUNT_NAME'=> $name);

				$result = $this->Accpel_model->insertAccpel($array);
				if($result > 0)
				{
					$this->session->set_flashdata('success', 'Account Set Submitted Successfully');
				}
				else
				{
					$this->session->set_flashdata('error', 'Account creation failed');
					$this->loadViews('accpel/add_form');
				}
				
				redirect('/Account_Pel/accpelList');
             }
        
		
		}
        else
        {
          	  redirect('/Main');
        }
    }
	

	public function delete_data($id){

	    $id = array('ID_ACCOUNT_PEL' => $id);
	    $this->load->model('Accpel_model');
	    $this->Accpel_model->Delete('MST_ACC_PEL', $id);
	    redirect('Account_Pel/accpelList/');
	}

	public function update_data($id){
		 $this->global['pageTitle'] = 'Dashboard';

  		if($this->isAdmin() == true){
  			$data['accpels'] = $this->Accpel_model->getAccpelById($id);
  			$this->loadViews("accpel/edit_form", $this->global, $data);
  		} else
          {
               redirect('/Main');
          }
	}

	public function doEditAccpel($id)
	{
		if($this->isAdmin() == TRUE)
        {

        	// echo "<pre>";
        	// print_r($_POST);
        	// echo "</pre>";
        	// die();
			//$this->loadViews("project/list_projects", $this->global, $data);

            $this->form_validation->set_rules('name','Account Name','required');
            // $this->form_validation->set_rules('newId','ID COA','max_length[8]|xss_clean|numeric|required');
            // $this->form_validation->set_rules('deadline','Deadline','required|max_length[30]');
             if($this->form_validation->run() == FALSE){
					$this->session->set_flashdata('error', 'Failed to Edit Account');
					$this->loadViews('accpel/edit_form');
             }else{

				// $newId = $this->input->post('newId');
				$name = $this->input->post('name');

				// $array = array('ID_COA'=> $newId, 'KETERANGAN'=> $name);

				$result = $this->Accpel_model->updateData($name, $id);
				
				if($result > 0)
				{
					$this->session->set_flashdata('success', 'Account Set Submitted Successfully');
				}
				else
				{
					$this->session->set_flashdata('error', 'Failed to Edit Account');
					$this->loadViews('accpel/edit_form');
				}
				
				redirect('/Account_Pel/accpelList');

             }
        
        }
        else
        {
            redirect('/Main');
        }
	}

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Dashboard : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }

}

?>