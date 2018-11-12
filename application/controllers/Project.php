<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Chart (ChartController)
 * chart dashboard.
 * @author : Port SOlution Warrior
 * @version : X
 * @since : 23 Januari 2018
 */
class Project extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('project_model');
        $this->load->model('budget_model');
        $this->load->model('Accpel_model');
        $this->load->model('Task_model');
        $this->load->model('costheader_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Dashboard';
        
		if($this->isAdmin() == true or $this->session->userdata ( 'type_id' ) == '2')
        {
            
			redirect('/presale/');
        
		
		}
        else
        {
            redirect('/Main');
        }
    }
	
	public function presale()
    {
        $this->global['pageTitle'] = 'Upload Project Document';
        $usrtype=$this->session->userdata( 'type_id' );
		
		if($this->isAdmin() == true or $usrtype == '2' or $usrtype == '9')
        {
            $USERID=$this->session->userdata ('userId');
			//$data['opportunities']	= $this->project_model->getAllOpportunities();
			if ($usrtype=='2'){
			$data['opportunities']	= $this->project_model->getAllOpportunitiesbyam($USERID);
			}
			else if ($usrtype=='9'){
			$data['opportunities']	= $this->project_model->getAllOpportunitiesbysolution($USERID);	
			}
			else{
				
			$data['opportunities']	= $this->project_model->getAllOpportunitiesbysolution($USERID);		
			}
			$data['opportunities']="";
			$this->loadViews("project/list_opportunities", $this->global, $data);
        
		
		}
        else
        {
            redirect('/Main');
        }
    }
	
	public function ProjectAnalisys($id)
    {
		$this->global['pageTitle'] = 'ILCS MANAGEMENT DASHBOARD';


				// echo "<pre>";
				// print_r($id);
				// echo "</pre>";die();
        
		$data['accounts']		= 	$this->project_model->getAccount();
		$data['ams']			= 	$this->project_model->getUser("Account Manager");
		$data['sharedservice']	= 	$this->project_model->getKegiatan(1);
		$data['stages']			= 	$this->project_model->getStageOpp();
		$data['url']			= 	base_url().'project/doAddsharedservices/'.$id;	
		$data['id']			= 	$id;
		$data['url1']		= 	base_url().'project/viewBudget/';	
		$data['url2']		=	base_url().'project/viewCost/';
		$data['url3']		=	base_url().'project/viewApprovalBudget/';
		// $data['accpels']	= $this->Accpel_model->getListAccpel();
		$data['project']	= $this->project_model->getProjectbyID($id);
		$data['comment']	= $this->project_model->get_T_COMMENT($id);
		$data['solution_pic']	= 	$this->project_model->getSolution();
		
		$this->loadViews("project/viewProjectAnalisys", $this->global, $data);
	
	
	}
	public function budget($id)
    {
		$this->global['pageTitle'] = 'ILCS MANAGEMENT DASHBOARD';
        
		$data['accounts']	= 	$this->project_model->getAccount();
		$data['ams']		= 	$this->project_model->getUser("Account Manager");
		$data['sharedservice']	= 	$this->project_model->getKegiatan(1);
		$data['stages']		= 	$this->project_model->getStageOpp();
		$data['url']= 	base_url().'project/doAddsharedservices/'.$id;	
		$data['url1']= 	base_url().'project/viewBudget/';	
		
		$data['project']	= $this->project_model->getProjectbyID($id);
		$data['solution_pic']	= 	$this->project_model->getSolution();
		
		$this->loadViews("project/viewProjectAnalisys_SHS", $this->global, $data);
	
	
	}
	public function budget1($idCost,$id,$projectid)
    {
	
	    $this->global['pageTitle'] = 'ILCS MANAGEMENT DASHBOARD';
        $data['accounts']			= $this->project_model->getAccount();
		$data['sharedservice']		= $this->project_model->getKegiatan($id);
		$data['url']				= base_url().'project/doAddsharedservices/';	
		$data['url1']				= base_url().'project/viewdetailBudget/'.$projectid.'/'.$id.'/'.$idCost;	
		$data['projectid']			= $projectid;
		$data['pospel']				= $id;
		$data['idCost']				= $idCost;
		$data['project']			= $this->project_model->getProjectbyProjectID($projectid);
		$data['solution_pic']		= $this->project_model->getSolution();
		
		$this->loadViews("project/viewProjectAnalisys_SSO", $this->global, $data);
	
	
	
	
	}
	public function viewOpurtinitydata()
	{
		
		$USERID=$this->session->userdata ('userId');
		$usrtype=$this->session->userdata( 'type_id' );
		
		if ($usrtype=='2'){
			$query	= $this->project_model->getAllOpportunitiesbyam($USERID);
			}
			else if ($usrtype=='9'){
			$query	= $this->project_model->getAllOpportunitiesbysolution($USERID);	
			}
			else{
				
			$query	= $this->project_model->getAllOpportunitiesbysolution($USERID);		
			}
			
		
		echo ($this->security->xss_clean(json_encode($query)));
	}	
	public function viewBudget($id)
	{
		
				// echo "<pre>";
				// print_r($id);
				// echo "</pre>";die();
			
		$query	= $this->project_model->getBudgetbyProjectID($id);		
		
			
		
		echo ($this->security->xss_clean(json_encode($query)));
	}
	public function viewdetailBudget($id,$id_pel,$idCost)
	{
		
			
		$query	= $this->project_model->getdetailBudgetbyProjectID($id,$id_pel,$idCost);		
		
			
		
		echo ($this->security->xss_clean(json_encode($query)));
	}
	
	
	public function viewBudgetDetail($id)
	{
		
			
		$query	= $this->project_model->getBudgetbyProjectID($id);		
		
			
		
		echo ($this->security->xss_clean(json_encode($query)));
	}
	
	public function doAddsharedservices()
	{
		$ID_PROJECT = $this->input->post('ID_PROJECT');
        $kegiatan = $this->input->post('kegiatan');
        $JUMLAH = $this->input->post('JUMLAH');
		 $pospel = $this->input->post('pospel');
		 $idCost = $this->input->post('idCost');
		$SATUAN_JUMLAH = $this->input->post('SATUAN_JUMLAH');
		$DURASI = $this->input->post('DURASI');
		$SATUAN_DURASI = $this->input->post('SATUAN_DURASI');
		$UNIT_COST = $this->input->post('UNIT_COST');
		$ENTRY_DATE = date('Y-m-d');
		
		foreach($JUMLAH as $a => $b){
			
			
			
			$params = array(
							'ID_PROJECT' => $ID_PROJECT,
							'JUMLAH' => $JUMLAH[$a],
							'SATUAN_JUMLAH' => $SATUAN_JUMLAH[$a],
							'DURASI' => $DURASI[$a],
							'SATUAN_DURASI' => $SATUAN_DURASI[$a],
							'UNIT_COST' => $UNIT_COST[$a],
							'ID_KEGIATAN' => $kegiatan[$a],
							// 'ENTRYDATE' => $ENTRY_DATE,
							'ID_COSTHEAD' => $idCost
							);
			//log_message('error','--- > doAddsharedservices :'.json_encode($params));
			$result=$this->project_model->addNewCostPlan($params,$ENTRY_DATE);	
		}
		redirect('Project/budget1/'.$idCost.'/'.$pospel.'/'.$ID_PROJECT);
		
	}
	
	public function projectList()
    {
        $this->global['pageTitle'] = 'Opportunity List';
        
		if($this->isAdmin() == true or $this->session->userdata ( 'type_id' ) == '2')
        {
            
			$data['projects']	= $this->project_model->getAllProjects();
			$data['opportunities']	= $this->project_model->getAllOpportunitiesbyStage(5);
			$data['summary_project']	= $this->project_model->getSummProject();
			
			$this->loadViews("project/list_projects", $this->global, $data);
        
		
		}
        else
        {
            redirect('/Main');
        }
    }
	
	public function addNewOpportunity()
    {
        $this->global['pageTitle'] = 'Dashboard';
		
		if($this->isAdmin() == true or $this->session->userdata ( 'type_id' ) == '2')
        {
            
			$data['accounts']	= 	$this->project_model->getAccount();
			$data['ams']		= 	$this->project_model->getUser("Account Manager");
			$data['solution_pic']	= 	$this->project_model->getSolution();
			$data['stages']		= 	$this->project_model->getStageOpp();
			$data['am']		=	$this->session->userdata ( 'name' );
			$this->loadViews("project/addOpp_form1", $this->global, $data);
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
		
		$data['budgets']	= $this->budget_model->getListActiveBudget();
		$data['budgetComp']	= $this->budget_model->getListCompBudget($id);
		$data['spending']	= $this->budget_model->getSpendingOpp($id);
		
		$data['stages']	= $this->project_model->getStageOpp();
		
		$data['issues']		= $this->project_model->getIssues($id, 'OPPORTUNITY');
		$data['summary_issues']	= $this->project_model->getSummIssues($id, 'OPPORTUNITY');
			
		
		$this->loadViews("project/viewOpp", $this->global, $data);
		
    }
	
	public function updateproject($id)
    {
        $this->global['pageTitle'] = 'ILCS MANAGEMENT DASHBOARD';
        
		$data['accounts']	= 	$this->project_model->getAccount();
		$data['ams']		= 	$this->project_model->getUser("Account Manager");
		$data['solution_pic']	= 	$this->project_model->getSolution();
		$data['stages']		= 	$this->project_model->getStageOpp();
		$data['url']= 	base_url().'project/doupdateOpportunity1/'.$id;	
		$data['project']	= $this->project_model->getProjectbyID($id);
		
		
		$this->loadViews("project/viewOpp1", $this->global, $data);
		
    }
	
	public function saveGambar()
	{
		   if(isset($_FILES["file"]["name"]))  
			 {  
				  $config['upload_path'] = './docs/projects/';  
				  $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';  
				  $new_name = time().'_'.$_FILES['file']['name'];
				  $config['file_name'] = $new_name;

				  $this->load->library('upload', $config);  
				  if(!$this->upload->do_upload('file'))  
				  {  
					   $this->upload->display_errors();  
					   return FALSE;
				  }  
				  else  
				  {  
						//log_message('error','---> save gambar : ');
						$data = $this->upload->data();                 
						echo base_url().'docs/projects/'.$new_name;                                     
				  }  
			 }  
 
		 
	}	
	
	public function doAddOpportunity()
	{
		if($this->isAdmin() == true or $this->session->userdata ( 'type_id' ) == '2')
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
               
				$am_id = $this->session->userdata ( 'userId' );
				
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
	
	
	public function doAddOpportunity1()
	{
		if($this->isAdmin() == true or $this->session->userdata ( 'type_id' ) == '2')
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('ID_PROJECT','ID_PROJECT ID','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('PROJECT_NAME','PROJECT_NAME','required|max_length[100]');
             
            if($this->form_validation->run() == FALSE)
            {
				$this->session->set_flashdata('error', 'Submission failed, missing required input data');
                $this->addNewOpportunity();
            }
            else
            {
                $ID_PROJECT = $this->input->post('ID_PROJECT');
                $PROJECT_NAME = $this->input->post('PROJECT_NAME');
                $CURRENCY = $this->input->post('currency');
               
				$AM_ID = $this->session->userdata ( 'userId' );
                $TARGET_END_DATE = date('Y-m-d', strtotime($this->input->post('TARGET_END_DATE')));
				$TARGET_START_DATE = date('Y-m-d', strtotime($this->input->post('TARGET_START_DATE')));
                $NO_KONTRAK_CUSTOMER = $this->input->post('NO_KONTRAK_CUSTOMER');
				$AMOUNT = $this->input->post('AMOUNT');
				$DESKRIPSI = $this->input->post('DESKRIPSI');
				$ID_PORTOFOLIO = $this->input->post('ID_PORTOFOLIO');
				
				$DELIVERY_TIME = $this->input->post('deliverytime');
				
				$ID_CUSTOMER = $this->input->post('ID_CUSTOMER');
				$ID_SOLUTION = $this->input->post('ID_SOLUTION');
				
                $KODE_STATUS = 1;
               
                $ENTRY_DATE = date('Y-m-d');
               

			   $params = array(
							'ID_PROJECT' => $ID_PROJECT,
							'PROJECT_NAME' => $PROJECT_NAME,
							'CURRENCY' => $CURRENCY,
							'AM_ID' => $AM_ID,
							'TARGET_END_DATE' => $TARGET_END_DATE,
							'TARGET_START_DATE' => $TARGET_START_DATE,
							'NO_KONTRAK_CUSTOMER' => $NO_KONTRAK_CUSTOMER,
							'AMOUNT' => $AMOUNT,
							'DELIVERY_TIME' => $DELIVERY_TIME,
							'ID_CUSTOMER' => $ID_CUSTOMER,
							'ID_SOLUTION' => $ID_SOLUTION,
							'DESKRIPSI' => $DESKRIPSI,
							'ID_PORTOFOLIO' => $ID_PORTOFOLIO,
							'ENTRY_DATE' => $ENTRY_DATE
							);

				$result=$this->project_model->addNewOpportunity1($params);	
			   
                
                if($result > 0)
                {
		            $this->session->set_flashdata('success', 'Opportunity Submitted Successfully');
		   //             $taskArray = array(
		   //             				'ID_PROJECT' => $ID_PROJECT;
		   //             				'AM'		 => $AM_ID;
		   //             				'SOLUTION'	 => $ID_SOLUTION;
		   //             				'TODO_LIST'	 => 'SUBMIT '
		   //             );
					// $task = $this->task_model->insert_task($taskArray, $ENTRY_DATE)
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
	
	public function doupdateOpportunity1($id){
		
		if($this->isAdmin() == true or $this->session->userdata ( 'type_id' ) == '2')
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('ID_PROJECT','ID_PROJECT ID','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('PROJECT_NAME','PROJECT_NAME','required|max_length[100]');
             
            if($this->form_validation->run() == FALSE)
            {
				$this->session->set_flashdata('error', 'Submission failed, missing required input data');
                $this->addNewOpportunity();
            }
            else
            {
                $ID_PROJECT = $this->input->post('ID_PROJECT');
                $PROJECT_NAME = $this->input->post('PROJECT_NAME');
                $CURRENCY = $this->input->post('currency');
               
				$AM_ID = $this->session->userdata ( 'userId' );
                $TARGET_END_DATE = date('Y-m-d', strtotime($this->input->post('TARGET_END_DATE')));
				$TARGET_START_DATE = date('Y-m-d', strtotime($this->input->post('TARGET_START_DATE')));
                $NO_KONTRAK_CUSTOMER = $this->input->post('NO_KONTRAK_CUSTOMER');
				$AMOUNT = $this->input->post('AMOUNT');
				$DESKRIPSI = $this->input->post('DESKRIPSI');
				$ID_PORTOFOLIO = $this->input->post('ID_PORTOFOLIO');
				
				$DELIVERY_TIME = $this->input->post('deliverytime');
				
				$ID_CUSTOMER = $this->input->post('ID_CUSTOMER');
				$ID_SOLUTION = $this->input->post('ID_SOLUTION');
				
                $KODE_STATUS = 1;
               
                $ENTRY_DATE = date('Y-m-d');
               
			   $params = array(
							'ID_PROJECT' => $ID_PROJECT,
							'PROJECT_NAME' => $PROJECT_NAME,
							'CURRENCY' => $CURRENCY,
							'AM_ID' => $AM_ID,
							'TARGET_END_DATE' => $TARGET_END_DATE,
							'TARGET_START_DATE' => $TARGET_START_DATE,
							'NO_KONTRAK_CUSTOMER' => $NO_KONTRAK_CUSTOMER,
							'AMOUNT' => $AMOUNT,
							'DELIVERY_TIME' => $DELIVERY_TIME,
							'ID_CUSTOMER' => $ID_CUSTOMER,
							'ID_SOLUTION' => $ID_SOLUTION,
							'DESKRIPSI' => $DESKRIPSI,
							'ID_PORTOFOLIO' => $ID_PORTOFOLIO,
							'ENTRY_DATE' => $ENTRY_DATE,
							'ID' => $id
							);
			
				$result=$this->project_model->updateOpportunity1($params);	
			   
                
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
	public function uploaddoc($id){
		$this->global['pageTitle'] = 'ILCS MANAGEMENT DASHBOARD';
        
			
		$data['url']= 	base_url().'project/upload_document/'.$id;	
		$data['project']	= $this->project_model->getProjectbyID($id);
		
		
		$this->loadViews("project/upload_doc", $this->global, $data);
		
		
	}
	public function upload_document($id){
		
		$DOC_TYPE=$this->input->post('DOC_TYPE');
		$ID_PROJECT=$this->input->post('ID_PROJECT');
		$ID=$this->input->post('ID');
		$TITLE_DOC=$this->input->post('TITLE_DOC');
		$AM_ID = $this->session->userdata ( 'userId' );
		if($_FILES['file']['name']!=='')  
			 {  
				  $config['upload_path'] = './docs/projects/';  
				  $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|xlsx|docx';  
				  $new_name = $DOC_TYPE.'_'.$ID_PROJECT.'_'.time().'_'.$_FILES['file']['name'];
				  $config['file_name'] = $new_name;

				  $this->load->library('upload', $config);  
				  if(!$this->upload->do_upload('file'))  
				  {  
					   $this->upload->display_errors();  
					   return FALSE;
				  }  
				  else  
				  {  
						//log_message('error','---> save gambar : ');
						$data = $this->upload->data();                 
						/* echo base_url().'docs/projects/'.$new_name;         */ 
						$ENTRY_DATE = date('Y-m-d');
             
						$params = array(
							'ID_PROJECT' => $ID_PROJECT,
							'DOC_TYPE' => $DOC_TYPE,
							'DOC_NAME' => $new_name,
							'ID_UPLOADED' => $AM_ID,
							'UPLOADED_DATE' => $ENTRY_DATE,
							'TITLE_DOC'=>$TITLE_DOC);
						$result=$this->project_model->addNewProjectDoc($params);	
						if($result > 0)
						{
							$this->session->set_flashdata('success', 'Document Submitted Successfully');
						}
						else
						{
							$this->session->set_flashdata('error', 'Document Submitted failed');
						}
						redirect('/project/uploaddoc/'.$ID);
				  }  
				  
			 } 
			else{
				$this->session->set_flashdata('error', 'Document Must be filled');
				redirect('/project/uploaddoc/'.$ID);
			}
		
		
		
	}
	
	public function viewprojectDocument($id)
	{
		
		$query	= $this->project_model->getdocumentProjectbyID($id);
		echo ($this->security->xss_clean(json_encode($query)));
	}
	public function viewdetailprojectDocument($id)
	{
		
		$query	= $this->project_model->getdocumentDetailProjectbyID($id);
		echo ($this->security->xss_clean(json_encode($query)));
	}
	
	public function viewprojectDocumentAM()
	{
		$AMID=$this->session->userdata ('userId');
		$query	= $this->project_model->getdocumentProjectbyAM($AMID);
		echo ($this->security->xss_clean(json_encode($query)));
	}
	
	public function doOppEdit($idOpp)
	{
		if($this->isAdmin() == true or $this->session->userdata ( 'type_id' ) == '2')
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
	
	public function doSetBudget($idOpp)
	{
		if($this->isAdmin() == true or $this->session->userdata ( 'type_id' ) == '2')
        {
			    $name = $this->input->post('budget_group');
                
				$budget = $this->input->post('budget');
				
                $opportunity = array('BUDGET_GROUP'=> $name);
                
                $result = $this->project_model->editOpportunity($opportunity, $idOpp);
                
				$result = $this->project_model->setBudget($budget, $idOpp);
                
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
		if($this->isAdmin() == true or $this->session->userdata ( 'type_id' ) == '2')
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
				date_default_timezone_set("Asia/Bangkok");
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
		if($this->isAdmin() == true or $this->session->userdata ( 'type_id' ) == '2')
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
		
		
		$data['budgetComp']	= $this->budget_model->getListCompBudget($data['project']->OPPORTUNITY_ID);
		$data['spending']	= $this->budget_model->getSpendingOpp($data['project']->OPPORTUNITY_ID);
		
		
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


	public function viewCost($id)
	{
			$status = 'PROPOSED';
				// echo "<pre>";
				// print_r($query);
				// echo "</pre>";die();
		
		$query	= $this->costheader_model->getCostbyProjectID($id,$status);	
		
		echo ($this->security->xss_clean(json_encode($query)));
	}

	public function viewApprovalBudget($id)
	{
			
			$status = 'APPROVED';
				// echo "<pre>";
				// print_r($query);
				// echo "</pre>";die();
		$query	= $this->costheader_model->getCostbyProjectID($id,$status);		
		// $query	= $this->costheader_model->getAprrovalBudget($id);		
		
		
		echo ($this->security->xss_clean(json_encode($query)));
	}

}

?>