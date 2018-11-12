<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Chart (ChartController)
 * chart dashboard.
 * @author : Port SOlution Warrior
 * @version : X
 * @since : 23 Januari 2018
 */
class Master_Salesstage extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('project_model');
        $this->load->model('salesstage_model');
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
            
			redirect('Salesstage/salesstageList/');
        
		
		}
        else
        {
            redirect('/Main');
        }
    }
	
	public function salesstageList()
    {
        $this->global['pageTitle'] = 'ILCS MANAGEMENT DASHBOARD';
        
		
		$data['salesstages']	= $this->salesstage_model->getListSalesstage();
			
		
		$this->loadViews("salesstage/list_salesstage", $this->global, $data);
		
    }
	
	public function setup_salesstage()
    {
        $this->global['pageTitle'] = 'Setup Master Salesstage';
        
		if(true)
        {
            
			//$data['opportunities']	= $this->project_model->getAllOpportunities();
			$data['a'] = "addNewActivity";
			$this->loadViews("salesstage/setup", $this->global, $data);
        
		
		}
        else
        {
            redirect('/Main');
        }
    }
	
	public function delete_data($id){

	    $id = array('ID' => $id);
	    $this->load->model('salesstage_model');
	    $this->salesstage_model->Delete('M_SALES_STAGE', $id);
	    redirect('Master_Salesstage/salesstageList/');
	}

	public function update_data($id){
		 $this->global['pageTitle'] = 'Dashboard';

  		if($this->isAdmin() == true){
  			$data['salesstages'] = $this->salesstage_model->getDataById($id);
  		$this->loadViews("salesstage/edit_form", $this->global, $data);
  		} else
          {
               redirect('/Main');
          }
	}

	public function doEditSalesstage($Id)
	{
		if($this->isAdmin() == TRUE)
        {
			//$this->loadViews("project/list_projects", $this->global, $data);
			$name = $this->input->post('name');
			
			$array = array('NAME'=> $name);

			$result = $this->salesstage_model->updateData($array, $Id);
			
			if($result > 0)
			{
				$this->session->set_flashdata('success', 'Account Set Submitted Successfully');
			}
			else
			{
				$this->session->set_flashdata('error', 'Account creation failed');
			}
			
			redirect('/Master_Salesstage/salesstageList');
        
        }
        else
        {
            redirect('/Main');
        }
	}

	public function detail_salesstage($name)
    {
        $this->global['pageTitle'] = 'Setup Master Salesstage';
        
		if(true)
        {
            
			$name =  str_replace("_"," ",$name);
			//$data['opportunities']	= $this->project_model->getAllOpportunities();
			
			$data['salesstage']	= $this->salesstage_model->getDetailSalesstage($name);
			
			
			$this->load->View("salesstage/salesstage_detail", $data);
        
		
		}
        else
        {
            redirect('/Main');
        }
    }
	
	public function set_detail_salesstage($name)
    {
        $this->global['pageTitle'] = 'Setup Master Salesstage';
        
            
		$name =  str_replace("_"," ",$name);
		//$data['opportunities']	= $this->project_model->getAllOpportunities();
		
		$data['salesstage']	= $this->salesstage_model->getDetailSalesstage($name);
		
		
		$this->load->View("salesstage/set_salesstage_detail", $data);
	
	
	
    }
	
	public function usage_detail_salesstage($oppID, $bName)
    {
        $this->global['pageTitle'] = 'CBB Usage';
        
            
		$bName =  str_replace("_"," ",$bName);
		
		$data['salesstages']	= $this->salesstage_model->getSalesstageUsage($oppID,$bName);
		
		
		$this->load->View("salesstage/usage_salesstage_detail", $data);
	
	
    }
	
	public function spending_form($oppID, $bID)
    {
        
          
		$data['salesstages']	= $this->salesstage_model->getSalesstageInfo($oppID,$bID);
		
		$data['oppID'] 	= $oppID;
		$data['bID']	= $bID;
		$this->load->View("salesstage/spending_form", $data);
	
	
    }
	
	public function doSetupSalesstage()
    {
        
		if(true)
        {
            
			print_r($_POST);
			//$this->loadViews("project/list_projects", $this->global, $data);
			$name = $this->input->post('name');
			
			$array = array('NAME'=> $name);
			$result = $this->salesstage_model->setupData($array);
			if($result > 0)
			{
				$this->session->set_flashdata('success', 'Salesstage Set Submitted Successfully');
			}
			else
			{
				$this->session->set_flashdata('error', 'Salesstage creation failed');
			}
			
			redirect('/Master_Salesstage/salesstageList');
        
		
		}
        else
        {
          	  redirect('/Main');
        }
    }
	
	public function doAddSpending($source)
    {
		$this->load->library('form_validation');
            
		$this->form_validation->set_rules('desc','Description','trim|required|max_length[256]|xss_clean');
		$this->form_validation->set_rules('cost','COSTS','trim|numeric|xss_clean|max_length[10]');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', 'Submission failed, missing required input data');
			
			if($source == "opp")
			{
				redirect('/project/ViewOpportunity/'.$this->input->post('idOPP'));
			}	
			else if($source == "project")
			{
				redirect('/project/ViewProject/'.$this->input->post('idProject'));
			}
			else if($source == "oppb")
			{
				redirect('/finance/ViewPost/oppb/'.$this->input->post('idOPP'));
			}
			else if($source == "post")
			{
				redirect('/finance/ViewPost/post/'.$this->input->post('id'));
			}
		}
		else
		{
			$config['upload_path']          = 'docs/salesstage';
			$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|docx|xlsx|ppt|pptx|zip|rar|';
			$config['max_size']             = 10000;
			date_default_timezone_set("Asia/Bangkok");
			$name 	= $this->input->post('name');
			$oppID 	= $this->input->post('idOPP');
			$oppbID = $this->input->post('idOPPB');
			$bID 	= $this->input->post('bID');
			$cost 	= $this->input->post('cost');
			$description = $this->input->post('desc');			
			$user = $this->session->userdata ( 'userId' );	
			$date = date('Y-m-d', strtotime($this->input->post('act_date')));
			$file = "0";
			
			//check remaining salesstage
			$balance = $this->salesstage_model->checkBalance($cost, $oppbID);
			
			if($balance < 0)
			{
				$this->session->set_flashdata('error', 'Anggaran tidak tersedia');
				redirect('/project/ViewOpportunity/'.$this->input->post('idOPP'));
			}
			
			$this->load->library('upload', $config);
			
			if (!empty($_FILES['doc']['name'])) 
			{
				if ( ! $this->upload->do_upload('doc'))
				{
						$this->session->set_flashdata('error', $this->upload->display_errors());
						redirect('/project/ViewOpportunity/'.$this->input->post('idOPP'));
				}
				else
				{
					$file = $this->upload->data();
				}
			}
			
				
					
			// 'password'=>getHashedPassword($password)
			
			$spending = array('DESCRIPTION'=> $description, 'USER_ENTRY'=> $user, 'AMOUNT'=>$cost, 'OPP_BUDGET_ID'=>$oppbID);
			
			$result = $this->salesstage_model->addNewSpending($spending, $file, $balance, $date);
			
			if($result > 0)
			{
				$this->session->set_flashdata('success', 'Spending Submitted Successfully');
			}
			else
			{
				$this->session->set_flashdata('error', 'Failed');
			}
			
			if($source == "opp")
			{
				redirect('/project/ViewOpportunity/'.$this->input->post('idOPP'));
			}	
			else if($source == "project")
			{
				redirect('/project/ViewProject/'.$this->input->post('idProject'));
			}
			else if($source == "oppb")
			{
				redirect('/finance/ViewPost/oppb/'.$this->input->post('idOPP'));
			}
			else if($source == "post")
			{
				redirect('/finance/ViewPost/post/'.$this->input->post('idOPP'));
			}
		}        
    }
	
	public function addNewOpportunity()
    {
        $this->global['pageTitle'] = 'Dashboard';
        
		if($this->isAdmin() == true)
        {
            
			$data['accounts']	= $this->project_model->getAccount();
			$data['ams']		= $this->project_model->getUser("Account Manager");
			$data['stages']		= $this->project_model->getStageOpp();
			
			$this->loadViews("project/addOpp_form", $this->global, $data);
		}
        else
        {
            redirect('/Main');
        }
    }
	
	public function ViewOpportunity($id)
    {
        $this->global['pageTitle'] = 'ILCS MANAGEMENT DASHBOARD';
        
		
		$data['accounts']	= $this->project_model->getAccount();
		$data['ams']		= $this->project_model->getUser("Account Manager"); 
		$data['opportunity']	= $this->project_model->getOpportunity($id);
		$data['activities']		= $this->project_model->getActivities($id, 'OPPORTUNITY');
		$data['summary_act']	= $this->project_model->getSummAct($id, 'OPPORTUNITY');
		
		$data['stages']	= $this->project_model->getStageOpp();
		
		$data['issues']		= $this->project_model->getIssues($id, 'OPPORTUNITY');
		$data['summary_issues']	= $this->project_model->getSummIssues($id, 'OPPORTUNITY');
			
		
		$this->loadViews("project/viewOpp", $this->global, $data);
		
    }
	
	public function doAddOpportunity()
	{
		if($this->isAdmin() == true)
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('name','Opportunity Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('desc','Description','trim|required|max_length[256]|xss_clean');
            $this->form_validation->set_rules('deadline','Deadline','required|max_length[30]');
             
            if($this->form_validation->run() == FALSE)
            {
				$this->session->set_flashdata('error', 'Submission failed, missing required input data');
                $this->addNewOpportunity();
            }
            else
            {
                $name = $this->input->post('name');
                $id_account = $this->input->post('account');
                $currency = $this->input->post('currency');
                $am_id = $this->input->post('am');
                $expected_deadline = date('Y-m-d', strtotime($this->input->post('deadline')));
                $amount = $this->input->post('amount');
                $sales_stage_id = 1;
                $probability = $this->input->post('prob');
                $description = $this->input->post('desc');
                $entry_date = date('Y-m-d');
                $status = "OPEN";
				// 'password'=>getHashedPassword($password)
				
                $opportunity = array('NAME'=> $name, 'ID_ACCOUNT'=>$id_account, 'CURRENCY'=>$currency,'AM_ID'=>$am_id, 'EXPECTED_DEADLINE'=>$expected_deadline,'AMOUNT'=>$amount,'SALES_STAGE_ID'=>$sales_stage_id,'PROBABILITY'=>$probability,'DESCRIPTION'=>$description,'ENTRY_DATE'=>$entry_date,'STATUS'=>$status);
                
                $result = $this->project_model->addNewOpportunity($opportunity);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Opportunity Submitted Successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                
                redirect('/project/addNewOpportunity');
            }
        }
        else
        {
            redirect('/Main');
        }
	}
	
	public function doOppEdit($idOpp)
	{
		if($this->isAdmin() == true)
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('name','Opportunity Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('desc','Description','trim|required|max_length[256]|xss_clean');
            $this->form_validation->set_rules('deadline','Deadline','required|max_length[30]');
             
            if($this->form_validation->run() == FALSE)
            {
				$this->session->set_flashdata('error', 'Edit failed, missing required input data');
                $this->viewOpportunity($idOpp);
            }
            else
            {
                $name = $this->input->post('name');
                $id_account = $this->input->post('account');
                $currency = $this->input->post('currency');
                $am_id = $this->input->post('am');
                $expected_deadline = date('Y-m-d', strtotime($this->input->post('deadline')));
                $amount = $this->input->post('amount');
                $sales_stage_id = $this->input->post('stage');
                $probability = $this->input->post('prob');
                $description = $this->input->post('desc');
				
				if($sales_stage_id == 999)
				{
					$status = "OPEN";
				}
				else
				{
					$status = "CLOSED";
				}
				
                $opportunity = array('NAME'=> $name, 'ID_ACCOUNT'=>$id_account, 'CURRENCY'=>$currency,'AM_ID'=>$am_id, 'EXPECTED_DEADLINE'=>$expected_deadline,'AMOUNT'=>$amount,'SALES_STAGE_ID'=>$sales_stage_id,'PROBABILITY'=>$probability,'DESCRIPTION'=>$description,'STATUS'=>$status);
                
                $result = $this->project_model->editOpportunity($opportunity, $idOpp);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Opportunity Edited Successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Edit failed - DB error');
                }
                
                redirect('/project/viewOpportunity/'.$idOpp);
            }
        }
        else
        {
            redirect('/Main');
        }
	}
    
	function doAddActivityOPP()
	{
		$this->load->library('form_validation');
            
		$this->form_validation->set_rules('name','Opportunity Name','trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('desc','Description','trim|required|max_length[256]|xss_clean');
		$this->form_validation->set_rules('pic','PIC','trim|required|xss_clean|max_length[128]');
		$this->form_validation->set_rules('cost','COSTS','trim|numeric|xss_clean|max_length[10]');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', 'Submission failed, missing required input data');
			$this->viewOpportunity($this->input->post('idOPP'));
		}
		else
		{
			$config['upload_path']          = 'docs/activity';
			$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|docx|xlsx|ppt|pptx|zip|rar|';
			$config['max_size']             = 10000;

			$file = "0";
			
			$this->load->library('upload', $config);
			
			if (!empty($_FILES['doc']['name'])) 
			{
				if ( ! $this->upload->do_upload('doc'))
				{
						$this->session->set_flashdata('error', $this->upload->display_errors());
						$this->viewOpportunity($this->input->post('idOPP'));
				}
				else
				{
					$file = $this->upload->data();
				}
			}
			
				
					$name = $this->input->post('name');
					$pic  = $this->input->post('pic');
					$date = date('Y-m-d', strtotime($this->input->post('dateAct')));
					$cost = $this->input->post('cost');
					$status = $this->input->post('status');
					$description = $this->input->post('desc');
					$ext_id = $this->input->post('idOPP');
					$type = "OPPORTUNITY";
					// 'password'=>getHashedPassword($password)
					
					$activity = array('NAME'=> $name, 'PIC_INTERNAL'=>$pic, 'DATE_ACTIVITY'=>$date,'STATUS_ACTIVITY'=>$status, 'DESCRIPTION'=>$description,'COSTS'=>$cost,'EXT_ID'=>$ext_id,'TYPE'=>$type);
					
					$result = $this->project_model->addNewActivity($activity, $file);
					
					if($result > 0)
					{
						$this->session->set_flashdata('success', 'Opportunity Submitted Successfully');
					}
					else
					{
						$this->session->set_flashdata('error', 'User creation failed');
					}
					
					redirect('/project/viewOpportunity/'.$this->input->post('idOPP'));
			
		}
	}
	
	function doAddIssueOPP()
	{
		$this->load->library('form_validation');
            
		$this->form_validation->set_rules('name','Issue Name','trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('desc','Description','trim|required|max_length[256]|xss_clean');
		$this->form_validation->set_rules('pic','PIC','trim|required|xss_clean|max_length[128]');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', 'Submission failed, missing required input data');
			$this->viewOpportunity($this->input->post('idOPP'));
		}
		else
		{
				
			$name = $this->input->post('name');
			$pic  = $this->input->post('pic');
			$deadline = date('d-m-Y', strtotime($this->input->post('deadline')));
			$date = date('d-m-Y');
			$status = $this->input->post('status');
			$description = $this->input->post('desc');
			$ext_id = $this->input->post('idOPP');
			$type = "OPPORTUNITY";
			// 'password'=>getHashedPassword($password)
			
			$issue = array('NAME'=> $name, 'PIC'=>$pic, 'DATE_ENTRY'=>$date, 'DEADLINE'=>$deadline,'STATUS_ISSUE'=>$status, 'DESCRIPTION'=>$description, 'EXT_ID'=>$ext_id,'TYPE'=>$type);
			
			$result = $this->project_model->addNewIssue($issue);
			
			if($result > 0)
			{
				$this->session->set_flashdata('success', 'Opportunity Submitted Successfully');
			}
			else
			{
				$this->session->set_flashdata('error', 'User creation failed');
			}
			
			redirect('/project/viewOpportunity/'.$this->input->post('idOPP'));
	
		}
	}
	
	
	function doChangeStatIssue($type, $id_issue, $stat, $id)
	{
		
		
		$result = $this->project_model->ChangeStatIssue($type, $stat,$id_issue);
		
		if($result > 0)
		{
			$this->session->set_flashdata('success', 'Issue Status Set Successfully');
		}
		else
		{
			$this->session->set_flashdata('error', 'User creation failed');
		}
		
		if($type == "OPPORTUNITY")	
			redirect('/project/viewOpportunity/'.$id);
		else	
			redirect('/project/viewProject/'.$id);
	}
	
	function doChangeStatAct($type, $id_act, $stat, $id)
	{
	
		
		$result = $this->project_model->ChangeStatAct($type, $stat,$id_act);
		
		if($result > 0)
		{
			$this->session->set_flashdata('success', 'Issue Status Set Successfully');
		}
		else
		{
			$this->session->set_flashdata('error', 'User creation failed');
		}
		
		if($type == "OPPORTUNITY")	
			redirect('/project/viewOpportunity/'.$id);
		else	
			redirect('/project/viewProject/'.$id);

	}
	
	function doIssueDone()
	{
		$this->load->library('form_validation');
            
		$this->form_validation->set_rules('solution','Solution','trim|required|max_length[200]|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', 'Submission failed, missing required input data');
			$this->viewOpportunity($this->input->post('idOPP'));
		}
		else
		{
				
			$solution = $this->input->post('solution');
			$id_issue = $this->input->post('issue_id');
			
			
			$result = $this->project_model->setIssueDone($solution,$id_issue);
			
			if($result > 0)
			{
				$this->session->set_flashdata('success', 'Issue Status Set Successfully');
			}
			else
			{
				$this->session->set_flashdata('error', 'Submission failed');
			}
			
			redirect('/project/viewOpportunity/'.$this->input->post('idOPP'));
	
		}
	}
	
	//-----------------------PROJECT RELATED--------------------------
	
	public function addNewProjectOpp($id_opp = FALSE)
    {
        $this->global['pageTitle'] = 'Add New Project';
        
		if($this->isAdmin() == true)
        {
            //$data['ams']		= $this->project_model->getUser("Account Manager");
			
			$data['opportunities']	= $this->project_model->getOpportunityProject();
			$data['stages']			= $this->project_model->getStageProject();
			$data['id_opp']			= $id_opp;
			
			$this->loadViews("project/addProjectOpp_form", $this->global, $data);
		}
        else
        {
            redirect('/Main');
        }
    }
	
	public function addNewProjectNew()
    {
        $this->global['pageTitle'] = 'Add New Project';
        
		if($this->isAdmin() == true)
        {
			
			$data['stages']			= $this->project_model->getStageProject();
			$data['accounts']	= $this->project_model->getAccount();
			
			$this->loadViews("project/addProjectNew_form", $this->global, $data);
		}
        else
        {
            redirect('/Main');
        }
    }
	
	public function doAddProjectOpp()
	{
		if($this->isAdmin() == true)
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('name','Project Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('desc','Description','trim|required|max_length[256]|xss_clean');
            $this->form_validation->set_rules('start','Start','required|max_length[30]');
            $this->form_validation->set_rules('end','End','required|max_length[30]');
             
            if($this->form_validation->run() == FALSE)
            {
				$this->session->set_flashdata('error', 'Submission failed, missing required input data');
                $this->addNewProjectOpp();
            }
            else
            {
                $name = $this->input->post('name');
                $id_opp = $this->input->post('opp_id');
                $start = date('Y-m-d', strtotime($this->input->post('start')));
                $end = date('Y-m-d', strtotime($this->input->post('end')));
                $description = $this->input->post('desc');
                $status = $this->input->post('status');
                $stage = 6;
				
				$account = $this->project_model->getOppAccount($id_opp);
				$account_id = $account->ID;
                //echo $id_opp;
				
				//print_r($account);
				//die;
				// 'password'=>getHashedPassword($password)
				
                $project = array('NAME'=> $name, 'OPPORTUNITY_ID'=>$id_opp, 'STATUS'=>$status,'DESCRIPTION'=>$description, 'STAGES_ID' => $stage, 'ACCOUNT_ID' => $account_id);
                
                $result = $this->project_model->addNewProjectOpp($project, $start, $end);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Opportunity Submitted Successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                
                redirect('/project/projectList');
            }
        }
        else
        {
            redirect('/Main');
        }
	}
	
	public function doAddProjectNew()
	{
		if($this->isAdmin() == true)
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('name','Project Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('desc','Description','trim|required|max_length[256]|xss_clean');
            $this->form_validation->set_rules('start','Start','required|max_length[30]');
            $this->form_validation->set_rules('end','End','required|max_length[30]');
             
            if($this->form_validation->run() == FALSE)
            {
				$this->session->set_flashdata('error', 'Submission failed, missing required input data');
                $this->addNewProjectNew();
            }
            else
            {
                $name = $this->input->post('name');
                $start = date('Y-m-d', strtotime($this->input->post('start')));
                $end = date('Y-m-d', strtotime($this->input->post('end')));
                $description = $this->input->post('desc');
                $id_account = $this->input->post('account');
                $status = $this->input->post('status');
                $stage = 6;
				
                //echo $id_opp;
				
				//print_r($account);
				//die;
				// 'password'=>getHashedPassword($password)
				
                $project = array('NAME'=> $name, 'ACCOUNT_ID'=> $id_account, 'STATUS'=>$status,'DESCRIPTION'=>$description, 'STAGES_ID' => $stage);
                
                $result = $this->project_model->addNewProjectNew($project, $start, $end);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Opportunity Submitted Successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                
                redirect('/project/projectList');
            }
        }
        else
        {
            redirect('/Main');
        }
	}
	
	public function ViewProject($id)
    {
        $this->global['pageTitle'] = 'ILCS MANAGEMENT DASHBOARD';
        
		$data['project']	= $this->project_model->getProject($id);
		
		//$data['opportunity']	= $this->project_model->getProjectOpp($id);
	
		$data['activities']		= $this->project_model->getActivities($id, 'PROJECT');
		$data['summary_act']	= $this->project_model->getSummAct($id, 'PROJECT');
		
		$data['stages']	= $this->project_model->getStageOpp();
		
		$data['issues']		= $this->project_model->getIssues($id, 'PROJECT');
		$data['summary_issues']	= $this->project_model->getSummIssues($id, "PROJECT");
		
		
		$data['pms']		= $this->project_model->getUser("Project Manager");
		$data['bas']		= $this->project_model->getUser("Business Analyst");		
		$data['sas']		= $this->project_model->getUser("System Analyst");

		$data['progs']		= $this->project_model->getUser("Programmer");
		$data['integrs']	= $this->project_model->getUser("Integrator");
		$data['tws']		= $this->project_model->getUser("Technical Writer");
		$data['leads']		= $this->project_model->getUser("Lead Developer");
		
		$data['team']		= $this->project_model->getTeam($id);
		
		$data['timeline']	= $this->project_model->getProgressTimeline($id);
		$data['percentage']	= $this->project_model->getProgressPercentage($id);
		
		$data['progress']	= $this->project_model->getProgress($id);
		$data['report']		= $this->project_model->getReport($id);
		
		$this->loadViews("project/viewProject", $this->global, $data);
		
    }
	
	function doAddActivityProject()
	{
		$this->load->library('form_validation');
            
		$this->form_validation->set_rules('name','Opportunity Name','trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('desc','Description','trim|required|max_length[256]|xss_clean');
		$this->form_validation->set_rules('pic','PIC','trim|required|xss_clean|max_length[128]');
		$this->form_validation->set_rules('cost','COSTS','trim|numeric|xss_clean|max_length[10]');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', 'Submission failed, missing required input data');
			$this->viewOpportunity($this->input->post('idOPP'));
		}
		else
		{
			$config['upload_path']          = 'docs/activity';
			$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|docx|xlsx|ppt|pptx|zip|rar|';
			$config['max_size']             = 10000;

			$file = "0";
			
			$this->load->library('upload', $config);
			
			if (!empty($_FILES['doc']['name'])) 
			{
				if ( ! $this->upload->do_upload('doc'))
				{
						$this->session->set_flashdata('error', $this->upload->display_errors());
						$this->viewProject($this->input->post('idProject'));
				}
				else
				{
					$file = $this->upload->data();
				}
			}
			
				
					$name = $this->input->post('name');
					$pic  = $this->input->post('pic');
					$date = date('Y-m-d', strtotime($this->input->post('dateAct')));
					$cost = $this->input->post('cost');
					$status = $this->input->post('status');
					$description = $this->input->post('desc');
					$ext_id = $this->input->post('idProject');
					$type = "PROJECT";
					// 'password'=>getHashedPassword($password)
					
					$activity = array('NAME'=> $name, 'PIC_INTERNAL'=>$pic, 'DATE_ACTIVITY'=>$date,'STATUS_ACTIVITY'=>$status, 'DESCRIPTION'=>$description,'COSTS'=>$cost,'EXT_ID'=>$ext_id,'TYPE'=>$type);
					
					$result = $this->project_model->addNewActivity($activity, $file);
					
					if($result > 0)
					{
						$this->session->set_flashdata('success', 'Activity Submitted Successfully');
					}
					else
					{
						$this->session->set_flashdata('error', 'Activity creation failed');
					}
					
					redirect('/project/viewProject/'.$this->input->post('idProject'));
			
		}
	}
	
	function doAddIssueProject()
	{
		$this->load->library('form_validation');
            
		$this->form_validation->set_rules('name','Issue Name','trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('desc','Description','trim|required|max_length[256]|xss_clean');
		$this->form_validation->set_rules('pic','PIC','trim|required|xss_clean|max_length[128]');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', 'Submission failed, missing required input data');
			$this->viewOpportunity($this->input->post('idOPP'));
		}
		else
		{
				
			$name = $this->input->post('name');
			$pic  = $this->input->post('pic');
			$deadline = date('d-m-Y', strtotime($this->input->post('deadline')));
			$date = date('d-m-Y');
			$status = $this->input->post('status');
			$description = $this->input->post('desc');
			$ext_id = $this->input->post('idProject');
			$type = "PROJECT";
			// 'password'=>getHashedPassword($password)
			
			$issue = array('NAME'=> $name, 'PIC'=>$pic, 'DATE_ENTRY'=>$date, 'DEADLINE'=>$deadline,'STATUS_ISSUE'=>$status, 'DESCRIPTION'=>$description, 'EXT_ID'=>$ext_id,'TYPE'=>$type);
			
			$result = $this->project_model->addNewIssue($issue);
			
			if($result > 0)
			{
				$this->session->set_flashdata('success', 'Opportunity Submitted Successfully');
			}
			else
			{
				$this->session->set_flashdata('error', 'User creation failed');
			}
			
			redirect('/project/viewProject/'.$this->input->post('idProject'));
	
		}
	}
	
	
	
	
	
	
	
	function projectTeam()
	{
		$idProject 	= $this->input->post('idProject');
		$pm 		= $this->input->post('pm');
		$ba 		= $this->input->post('ba');
		$sa 		= $this->input->post('sa');
		$lead 		= $this->input->post('lead');
		$progs 		= $this->input->post('progs');
		$integrs 	= $this->input->post('integrs');
		$tws		= $this->input->post('tws');
		
		
		$team = array('pm'=> $pm, 'ba'=>$ba, 'sa'=>$sa, 'lead'=>$lead,'progs'=>$progs, 'integrs'=>$integrs, 'tws'=>$tws);
					
		$result = $this->project_model->buildTeam($idProject, $team);
		
		if($result > 0)
		{
			$this->session->set_flashdata('success', 'Team Created Successfully');
		}
		else
		{
			$this->session->set_flashdata('error', 'Team creation failed');
		}
		
		redirect('/project/viewProject/'.$idProject);
	
	}
	
	function doAddProgress()
	{
		$this->load->library('form_validation');
            
		//$this->form_validation->set_rules('detail','Description','trim|required|max_length[256]|xss_clean');
		$this->form_validation->set_rules('target','Target','trim|required|xss_clean|max_length[128]');
		$this->form_validation->set_rules('real','Realisasi','trim|numeric|xss_clean|max_length[10]');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', 'Submission failed, missing required input data');
			$this->viewProject($this->input->post('idProject'));
		}
		else
		{
			$config['upload_path']          = 'docs/progress';
			$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|docx|xlsx|ppt|pptx|zip|rar|';
			$config['max_size']             = 15000;

			$file = "0";
			
			$this->load->library('upload', $config);
			
			if (!empty($_FILES['doc']['name'])) 
			{
				if ( ! $this->upload->do_upload('doc'))
				{
						$this->session->set_flashdata('error', $this->upload->display_errors());
						$this->viewProject($this->input->post('idProject'));
				}
				else
				{
					$file = $this->upload->data();
				}
			}
			
				
					$detail 	= $this->input->post('detail');
					$target 	= $this->input->post('target');
					$real 		= $this->input->post('real');
					$project_id = $this->input->post('idProject');
					
					
					$progress = array('TARGET'=> $target, 'PERCENTAGE'=>$real, 'PROJECT_ID'=>$project_id,'DETAIL'=>$detail);
					
					$result = $this->project_model->addNewProgress($progress, $file);
					
					if($result > 0)
					{
						$this->session->set_flashdata('success', 'Progress Submitted Successfully');
					}
					else
					{
						$this->session->set_flashdata('error', 'Progress update failed');
					}
					
					redirect('/project/viewProject/'.$this->input->post('idProject'));
			
		}
	}
	
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Dashboard : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>