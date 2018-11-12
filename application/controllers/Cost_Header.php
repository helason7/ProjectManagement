<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Chart (ChartController)
 * chart dashboard.
 * @author : Port SOlution Warrior
 * @version : X
 * @since : 23 Januari 2018
 */
class Cost_Header extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('project_model');
        $this->load->model('costheader_model');
        $this->load->model('accpel_model');
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
            
			redirect('Cost_Header/costheaderList/');
        
		
		}
        else
        {
            redirect('/Main');
        }
    }
	
	public function costheaderList()
    {
        $this->global['pageTitle'] = 'ILCS MANAGEMENT DASHBOARD';
        
		
		$data['costheaders']	= $this->costheader_model->getListcostheader();
		$data['project']	= $this->project_model->getProjectId($id);
		
		$this->loadViews("project/viewProjectAnalisys", $this->$data);
		
    }
	
	public function addNewcostheader($id)
    {
        $this->global['pageTitle'] = 'Setup Master Account';
        
		if(true)
        {
            
			//$data['opportunities']	= $this->project_model->getAllOpportunities();
			$data['a'] 			= "addNewActivity";
			$data['accpels']	= $this->accpel_model->getListAccpel();
			$data['project']	= $this->project_model->getProjectId($id);
			$data['id']			= $id;

			$this->loadViews("costheader/add_form", $this->global, $data);
        
		
		}
        else
        {
            redirect('/Main');
        }
    }
	
	public function doAddCostheader()
    {
        $this->form_validation->set_rules('budget_name','Budget Name','required');
            // $this->form_validation->set_rules('idAcc','ID Account','max_length[8]|xss_clean|numeric|required');
             if($this->form_validation->run() == FALSE){
					$this->session->set_flashdata('error', 'Budget creation failed');
					$this->loadViews('Project/viewProjectAnalysis');
             }else{

				// echo "<pre>";
				// print_r($_POST);
				// echo "</pre>";die();
				// print_r($_POST);
				//$this->loadViews("project/list_projects", $this->global, $data);
				$name 			= $this->input->post('budget_name');
				$Account_Pel 	= $this->input->post('accpel');
				$project 		= $this->input->post('idProject');
				$id 			= $this->input->post('id');
				$status			= 'PROPOSED';
				$flag			= '0';
				$update 		= date('d/m/Y');

				
				$array = array('BUDGET_NAME'=> $name,
								'ACC_PEL'	=> $Account_Pel,
								'ID_PROJECT'=> $project,
								'STATUS'	=> $status,
								'FLAG'		=> $flag
							);
				$result = $this->costheader_model->insertCostheader($array,$update);
				if($result > 0)
				{
					$this->session->set_flashdata('success', 'Budget Set Submitted Successfully');
				}
				else
				{
					$this->session->set_flashdata('error', 'Budget creation failed');
					$this->loadViews('Project/viewProjectAnalysis');
				}
				
				redirect('Project/ProjectAnalisys/'.$id);
             }
    }
	
	public function approvedCostHeader($id,$idProject)
    {

             	$data 	=  $this->costheader_model->getListCostheaderByid($idProject);

             	// $data2['cost']	=	$this->costheader_model->getListCostheaderByid($id);

             	$dataLenght = count($data);
             	for ($i=0; $i < $dataLenght; $i++) { 
             		
				$status			= 'APPROVED';
				$flag			= '1';
				$update 		= date('d/m/Y');
				$dataArray 		= $data[$i];
				$array 			= json_decode(json_encode($dataArray), True);

				$name 			= $array['BUDGET_NAME'];
				$Account_Pel 	= $array['ACC_PEL'];
				$project 		= $array['ID_PROJECT'];
				$idCost 		= $array['ID_COSTHEAD'];

					$arr = array('BUDGET_NAME'		=> $name,
									'ACC_PEL'		=> $Account_Pel,
									'STATUS'		=> $status,
									// 'LAST_UPDATE'	=> $update,
									'ID_PROJECT'	=> $project,
									'ID_COSTHEAD'	=> $idCost,
									'FLAG'			=> $flag
								);

				
					$result 		= 	$this->costheader_model->insertCostheader($arr, $update);
					$this->doAddCostPlan($idCost,$project);
						        // echo '<pre> dataLenght ';
						        // print_r($dataLenght);
						        // echo '</pre>';


             	}
             	$idRed = $id; 
				if($result > 0)
				{
					$this->session->set_flashdata('success', 'Budget Set Submitted Successfully'.$result->ID_COSTHEAD);
				}
				else
				{
					$this->session->set_flashdata('error', 'Budget creation failed');
					$this->loadViews('Project/viewProjectAnalysis');
				}
			redirect('Project/ProjectAnalisys/'.$idRed);
    }
	
	public function doAddCostPlan($idCost,$project)
    {
				    $approved 		=  	$this->costheader_model->getListApprovedCostheader($project);
				    $approvedLen	= count($approved);
						        echo '<pre>';
						        print_r($approvedLen);
						        echo '</pre>';
				    
				        for ($i=0; $i < $approvedLen; $i++) { 

				        	$appArray 	= $approved[$i];
						    $appArr 	= json_decode(json_encode($appArray), True);
						    $idCost2 	= $appArr['ID_COSTHEAD'];
						    $this->doAddCostPlan2($idCost,$idCost2,$project);
						        // echo '<pre> param ';
						        // print_r($dataLenght2);
						        // echo '</pre>';
							}
		// $ID_PROJECT 	= $project;
        // echo "<pre>";
        // print_r($approved);
        // echo "</pre>";
        // die();
						// log_message('error','--- > doAddsharedservices :'.json_encode($params));
						// $result=$this->project_model->addNewCostPlan($params,$ENTRY_DATE);
		      //   return $params;
		      //   }
        // }
    }

    public function doAddCostPlan2($idCost,$idCost2,$project){

			$data2 			= $this->costheader_model->getListCostPlanByid($idCost);
			$dataLenght2 	= count($data2);
				for ($i=0; $i < $dataLenght2 ; $i++) { 

					$dataArray 		= $data2[$i];
					$array2			= json_decode(json_encode($dataArray), True);

				 	$JUMLAH 		= $array2['JUMLAH'];
					$SATUAN_JUMLAH 	= $array2['SATUAN_JUMLAH'];
					$DURASI 		= $array2['DURASI'];
					$SATUAN_DURASI 	= $array2['SATUAN_DURASI'];
					$kegiatan 		= $array2['ID_KEGIATAN'];
					$UNIT_COST		= $array2['UNIT_COST'];

					$ENTRY_DATE		= date('Y-m-d');

					$params 		= array(
										'ID_PROJECT' 	=> $project,
										'JUMLAH' 		=> $JUMLAH,
										'SATUAN_JUMLAH' => $SATUAN_JUMLAH,
										'DURASI' 		=> $DURASI,
										'SATUAN_DURASI' => $SATUAN_DURASI,
										'UNIT_COST' 	=> $UNIT_COST,
										'ID_KEGIATAN' 	=> $kegiatan,
														// 'ENTRYDATE' => $ENTRY_DATE,
										'ID_COSTHEAD' 	=> $idCost2
										);
				$result=$this->project_model->addNewCostPlan($params,$ENTRY_DATE);
				}
    }

	public function delete_data($id){

	    $id = array('ID_COSTHEAD' => $id);
	    $this->load->model('costheader_model');
	    $this->costheader_model->Delete('COST_HEADER', $id);
	    redirect('Cost_Header/costheaderList/');
	}

	public function update_data($id){
		 $this->global['pageTitle'] = 'Dashboard';

  		if($this->isAdmin() == true){
  			$data['costheaders'] = $this->costheader_model->getcostheaderById($id);
  			$this->loadViews("costheader/edit_form", $this->global, $data);
  		} else
          {
               redirect('/Main');
          }
	}

	public function doEditcostheader($id)
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
					$this->loadViews('costheader/edit_form');
             }else{

				// $newId = $this->input->post('newId');
				$name = $this->input->post('name');

				// $array = array('ID_COA'=> $newId, 'KETERANGAN'=> $name);

				$result = $this->costheader_model->updateData($name, $id);
				
				if($result > 0)
				{
					$this->session->set_flashdata('success', 'Account Set Submitted Successfully');
				}
				else
				{
					$this->session->set_flashdata('error', 'Failed to Edit Account');
					$this->loadViews('costheader/edit_form');
				}
				
				redirect('/Cost_Header/costheaderList');

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