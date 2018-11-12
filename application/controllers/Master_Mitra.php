<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Chart (ChartController)
 * chart dashboard.
 * @author : Port SOlution Warrior
 * @version : X
 * @since : 23 Januari 2018
 */
class Master_Mitra extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('project_model');
        $this->load->model('mitra_model');
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
            
			redirect('Mitra/mitraList/');
        
		
		}
        else
        {
            redirect('/Main');
        }
    }
	
	public function mitraList()
    {
        $this->global['pageTitle'] = 'ILCS MANAGEMENT DASHBOARD';
        
		
		$data['mitras']	= $this->mitra_model->getListMitra();
			
		
		$this->loadViews("mitra/list_mitra", $this->global, $data);
		
    }
	
	public function setup_mitra()
    {
        $this->global['pageTitle'] = 'Setup Master Mitra';
        
		if(true)
        {
            
			//$data['opportunities']	= $this->project_model->getAllOpportunities();
			$data['a'] = "addNewActivity";
			$this->loadViews("mitra/setup", $this->global, $data);
        
		
		}
        else
        {
            redirect('/Main');
        }
    }
	
	public function doSetupMitra()
    {
        
		if(true)
        {
            
			print_r($_POST);
			//$this->loadViews("project/list_projects", $this->global, $data);
			$name = $this->input->post('name');
			$address = $this->input->post('address');
			$npwp  = $this->input->post('npwp');
			$pic	 = $this->input->post('pic');
			$status	 = $this->input->post('status');
			$remark	 = $this->input->post('remark');
			
			
			$array = array('MITRA_NAME'=> $name, 'ADDRESS'=> $address, 'NPWP'=> $npwp, 'PIC'=>$pic, 'STATUS_MITRA'=>$status, 'REMARK'=>$remark);

			$result = $this->mitra_model->setupMitra($array);
			if($result > 0)
			{
				$this->session->set_flashdata('success', 'Mitra Set Submitted Successfully');
			}
			else
			{
				$this->session->set_flashdata('error', 'Mitra creation failed');
			}
			
			redirect('/Master_Mitra/mitraList');
        
		
		}
        else
        {
          	  redirect('/Main');
        }
    }
	

	public function delete_data($id){

	    $id = array('ID_MITRA' => $id);
	    $this->load->model('mitra_model');
	    $this->mitra_model->Delete('M_MITRA', $id);
	    redirect('Master_Mitra/mitraList/');
	}

	public function update_data($id){
		 $this->global['pageTitle'] = 'Dashboard';

  		if($this->isAdmin() == true){
  			$data['mitras'] = $this->mitra_model->getMitraById($id);
  		$this->loadViews("mitra/edit_form", $this->global, $data);
  		} else
          {
               redirect('/Main');
          }
	}

	public function doEditMitra($id)
	{
		if($this->isAdmin() == TRUE)
        {
			//$this->loadViews("project/list_projects", $this->global, $data);
			$name = $this->input->post('name');
			$address = $this->input->post('address');
			$npwp  = $this->input->post('npwp');
			$pic	 = $this->input->post('pic');
			$status	 = $this->input->post('status');
			$remark	 = $this->input->post('remark');
			
			
			$array = array('MITRA_NAME'=> $name, 'ADDRESS'=> $address, 'NPWP'=> $npwp, 'PIC'=>$pic, 'STATUS_MITRA'=>$status, 'REMARK'=>$remark);

			$result = $this->mitra_model->updateData($array, $id);

			if($result > 0)
			{
				$this->session->set_flashdata('success', 'Mitra Set Submitted Successfully');
			}
			else
			{
				$this->session->set_flashdata('error', 'Mitra creation failed');
			}
			
			redirect('/Master_Mitra/mitraList');
        
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