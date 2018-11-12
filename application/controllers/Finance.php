<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Chart (ChartController)
 * chart dashboard.
 * @author : Port SOlution Warrior
 * @version : X
 * @since : 23 Januari 2018
 */
class Finance extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('project_model');
        $this->load->model('budget_model');
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
            
			redirect('Finance/posAnggaran/');
        
		
		}
        else
        {
            redirect('/Main');
        }
    }
	
	public function posAnggaran()
    {
        $this->global['pageTitle'] = 'ILCS MANAGEMENT DASHBOARD';
        
		
		$data['budgets']	= $this->budget_model->getListAllocatedBudget();
		$data['posts']	= $this->budget_model->getListAllocatedBudgetPost();
		
		$data['budget_type']	= $this->budget_model->getListActiveBudget();
		
		$this->loadViews("finance/list_anggaran", $this->global, $data);
		
    }
	
	public function ViewPost($type, $id)
    {
        $this->global['pageTitle'] = 'ILCS MANAGEMENT DASHBOARD';
        
		if($type == "oppb")
		{
			//get opp data
			
			$data['post'] 		= $this->project_model->getOpportunity($id);
			$data['budgets']	= $this->budget_model->getListActiveBudget();
			$data['budgetComp']	= $this->budget_model->getListCompBudget($id);
			$data['spending']	= $this->budget_model->getSpendingOpp($id);
			
			$bName =  str_replace("_"," ",$data['post']->BUDGET_GROUP);
			
			$data['summbudgets']	= $this->budget_model->getBudgetUsage($id,$bName);
		}
		else
		{
			// get anggaran data
			$data['post'] = $this->budget_model->getPostAnggaran($id);
			$data['budgets']	= $this->budget_model->getListActiveBudget();
			$data['budgetComp']	= $this->budget_model->getListCompBudget($id);
			$data['spending']	= $this->budget_model->getSpendingOpp($id);
			$bName =  str_replace("_"," ",$data['post']->BUDGET_GROUP);
			
			$data['summbudgets']	= $this->budget_model->getBudgetUsage($id,$bName);
		}
		
		$data['type'] = $type;
		
		$this->loadViews("finance/viewPost", $this->global, $data);
		
    }
	
	public function summ_budget($oppID, $bName)
    {
        $this->global['pageTitle'] = 'CBB Usage';
        
            
		$bName =  str_replace("_"," ",$bName);
		
		$data['budgets']	= $this->budget_model->getBudgetUsage($oppID,$bName);
		
		
		$this->load->View("budget/usage_budget_detail", $data);
	
	
    }
	
	public function doAddPost()
	{
		if($this->isAdmin() == true)
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('name','Opportunity Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('desc','Description','trim|required|max_length[256]|xss_clean');
             
            if($this->form_validation->run() == FALSE)
            {
				$this->session->set_flashdata('error', 'Submission failed, missing required input data');
                $this->posAnggaran();
            }
            else
            {
                $name = $this->input->post('name');
                $description = $this->input->post('desc');
                $status = "OPEN";
                $group 	= $this->input->post('budget_group');
				// 'password'=>getHashedPassword($password)
				
                $post = array('NAME'=> $name,'DESCRIPTION'=>$description,'STATUS'=>$status, 'BUDGET_GROUP'=>$group);
                
                $idOPP = $this->budget_model->addNewPost($post);
                
				//-------------------------------------------------------
				
				$name = $this->input->post('budget_group');
                
				$budget = $this->input->post('budget');
				
				$result = $this->project_model->setBudget($budget, $idOPP);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Opportunity Edited Successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Edit failed - DB error');
                }
                
                redirect('/Finance/posAnggaran');
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