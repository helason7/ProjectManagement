<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Chart (ChartController)
 * chart dashboard.
 * @author : Port SOlution Warrior
 * @version : X
 * @since : 23 Januari 2018
 */
class Master_Account extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('project_model');
        $this->load->model('account_model');
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
            
			redirect('Account/accountList/');
        
		
		}
        else
        {
            redirect('/Main');
        }
    }
	
	public function accountList()
    {
        $this->global['pageTitle'] = 'ILCS MANAGEMENT DASHBOARD';
        
		
		$data['accounts']	= $this->account_model->getListAccount();
			
		
		$this->loadViews("account/list_account", $this->global, $data);
		
    }
	
	public function setup_account()
    {
        $this->global['pageTitle'] = 'Setup Master Account';
        
		if(true)
        {
            
			//$data['opportunities']	= $this->project_model->getAllOpportunities();
			$data['a'] = "addNewActivity";
			$this->loadViews("account/setup", $this->global, $data);
        
		
		}
        else
        {
            redirect('/Main');
        }
    }
	
	public function detail_account($name)
    {
        $this->global['pageTitle'] = 'Setup Master Account';
        
		if(true)
        {
            
			$name =  str_replace("_"," ",$name);
			//$data['opportunities']	= $this->project_model->getAllOpportunities();
			
			$data['account']	= $this->account_model->getDetailAccount($name);
			
			
			$this->load->View("account/account_detail", $data);
        
		
		}
        else
        {
            redirect('/Main');
        }
    }
	
	public function set_detail_account($name)
    {
        $this->global['pageTitle'] = 'Setup Master Account';
        
            
		$name =  str_replace("_"," ",$name);
		//$data['opportunities']	= $this->project_model->getAllOpportunities();
		
		$data['account']	= $this->account_model->getDetailAccount($name);
		
		
		$this->load->View("account/set_account_detail", $data);
	
	
	
    }
	
	public function usage_detail_account($oppID, $bName)
    {
        $this->global['pageTitle'] = 'CBB Usage';
        
            
		$bName =  str_replace("_"," ",$bName);
		
		$data['accounts']	= $this->account_model->getAccountUsage($oppID,$bName);
		
		
		$this->load->View("account/usage_account_detail", $data);
	
	
    }
	
	public function spending_form($oppID, $bID)
    {
        
          
		$data['accounts']	= $this->account_model->getAccountInfo($oppID,$bID);
		
		$data['oppID'] 	= $oppID;
		$data['bID']	= $bID;
		$this->load->View("account/spending_form", $data);
	
	
    }
	
	public function doSetupAccount()
    {
        
		if(true)
        {
            
			print_r($_POST);
			//$this->loadViews("project/list_projects", $this->global, $data);
			$name = $this->input->post('name');
			$organ  = $this->input->post('organ');
			$address = $this->input->post('address');
			$email	 = $this->input->post('email');
			$pic	 = $this->input->post('pic');
			
			
			$array = array('NAME'=> $name, 'ORGANIZATION'=> $organ, 'EMAIL'=>$email, 'ADDRESS'=> $address,'PIC'=>$pic);

			$result = $this->account_model->setupAccount($array);
			
			if($result > 0)
			{
				$this->session->set_flashdata('success', 'Account Set Submitted Successfully');
			}
			else
			{
				$this->session->set_flashdata('error', 'Account creation failed');
			}
			
			redirect('/Master_Account/accountList');
        
		
		}
        else
        {
          	  redirect('/Main');
        }
    }
	

	public function delete_data($id){

	    $id = array('ID' => $id);
	    $this->load->model('account_model');
	    $this->account_model->Delete('M_ACCOUNTS', $id);
	    redirect('Master_Account/accountList/');
	}

	public function update_data($id){
		 $this->global['pageTitle'] = 'Dashboard';

  		if($this->isAdmin() == true){
  			$data['accounts'] = $this->account_model->getAccById($id);
  		$this->loadViews("account/edit_form", $this->global, $data);
  		} else
          {
               redirect('/Main');
          }
	}

	public function doEditAccount($accId)
	{
		if($this->isAdmin() == TRUE)
        {
			//$this->loadViews("project/list_projects", $this->global, $data);
			$name = $this->input->post('name');
			$organ  = $this->input->post('organ');
			$address = $this->input->post('address');
			$email	 = $this->input->post('email');
			$pic	 = $this->input->post('pic');
			
			
			$array = array('NAME'=> $name, 'ORGANIZATION'=> $organ, 'EMAIL'=>$email, 'ADDRESS'=> $address,'PIC'=>$pic);

			$result = $this->account_model->updateData($array, $accId);
			
			if($result > 0)
			{
				$this->session->set_flashdata('success', 'Account Set Submitted Successfully');
			}
			else
			{
				$this->session->set_flashdata('error', 'Account creation failed');
			}
			
			redirect('/Master_Account/accountList');
        
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