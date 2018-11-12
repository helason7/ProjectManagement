<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Chart (ChartController)
 * chart dashboard.
 * @author : Port SOlution Warrior
 * @version : X
 * @since : 23 Januari 2018
 */
class Task extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('project_model');
        $this->load->model('task_model');
        $this->load->model('login_model');
        // $this->load->library('email');
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
            
			redirect('Task/taskList/');
        
		
		}
        else
        {
            redirect('/Main');
        }
    }
	
	public function taskList()
    {
        $this->global['pageTitle'] = 'ILCS MANAGEMENT DASHBOARD';
        
			// echo "<pre>";
   //      	print_r($data);
   //      	echo "</pre>";
   //      	die();
		$user 	 		= $this->session->userdata ( 'userId' );
		$data['tasks']	= $this->task_model->getListTask($user);
			
		
		$this->loadViews("task/list_task", $this->global, $data);
		
    }
	
	public function addNewTask()
    {
        $this->global['pageTitle'] = 'Setup Master Task';
        $userType = $this->session->userdata ( 'type_id' );
		if(true)
        {

            // $am = 'ACCOUNT MANAGER';
            // $sol = 'SOLUTION';
			//$data['opportunities']	= $this->project_model->getAllOpportunities();
			$data['a'] = "addNewActivity";
			$data['am'] = $this->task_model->getAMById();
			$data['sol'] = $this->task_model->getSolutionById();
			$data['todo'] = $this->task_model->getTodoList($userType);
			$data['project'] = $this->project_model->getAllOpportunities();

			// echo "<pre>";
   //      	print_r($data);
   //      	echo "</pre>";
   //      	die();
			$this->loadViews("task/add_form", $this->global, $data);        
		
		}
        else
        {
            redirect('/Main');
        }
    }
	
	public function doAddTask()
    {
        
        // echo "<pre>";
        // 	print_r($_POST);
        // 	echo "</pre>";
        // 	die();

		if(true)
        {
            
			print_r($_POST);
			//$this->loadViews("project/list_projects", $this->global, $data);
			// $idm = $id;
			$task  	 = $this->input->post('todo');
			$status	 = $this->input->post('status');
			$project = $this->input->post('project');
			$user 	 = $this->session->userdata ( 'userId' );
			// $am = $this->input->post('am');
			// $sol = $this->input->post('sol');
			$start = date('d/m/Y');

			if($status == 1){
				$end = date('d/m/Y');
			}else{
				$end = '';
			}
			
			
			$array = array(	'ID_TASK'		=> $task, 
							'STATUS_ID'		=> $status,
							'USER_ID'		=> $user,
							'ID_PROJECT'	=> $project
						);

			$result = $this->task_model->insertTask($array, $start);
			if($result > 0)
			{
				$this->session->set_flashdata('success', 'Task Set Submitted Successfully');
			}
			else
			{
				$this->session->set_flashdata('error', 'Task creation failed');
			}
			
			redirect('/Task/taskList');
        
		
		}
        else
        {
          	  redirect('/Main');
        }
    }
	

	public function delete_data($id){

	    $id = array('ID' => $id);
	    $this->load->model('task_model');
	    $this->task_model->Delete('TASK', $id);
	    redirect('Task/taskList/');
	}

	public function update_data($id){
		 $this->global['pageTitle'] = 'Dashboard';
		 $idm = $this->session->userdata('division_id');
  		if(true){

			$data['am'] = $this->task_model->getAMById();
			$data['sol'] = $this->task_model->getSolutionById();
  			$data['tasks'] = $this->task_model->getTaskById($id);
        	
  		$this->loadViews("task/edit_form", $this->global, $data);
  		} else
          {
               redirect('/Main');
          }
	}

	public function doEditTask($id)
	{
		if(TRUE)
        {
			//$this->loadViews("project/list_projects", $this->global, $data);
			
       		// echo "<pre>";
        	// print_r($_POST);
        	// echo "</pre>";
        	// die();
			$task  = $this->input->post('task');
			$status	 = $this->input->post('status');
			$am = $this->input->post('am');
			$sol = $this->input->post('sol');
			$start = $this->input->post('start');

			if($status == '1'){
				$end = date('d/m/Y');
			}else{
				$end = '';
			}

			$array = array(	'TODO_LIST'		=> $task, 
							'STATUS_ID'		=> $status, 
							'AM'			=> $am,
							'SOLUTION'		=> $sol);

			$result = $this->task_model->updateData($array, $id, $start, $end);

			if($result > 0)
			{
				$this->session->set_flashdata('success', 'Task Set Submitted Successfully');
			}
			else
			{
				$this->session->set_flashdata('error', 'Task creation failed');
			}
			
			redirect('/Task/taskList');
        
        }
        else
        {
            redirect('/Main');
        }
	}

	public function updateStatus($id)
	{
		if(TRUE)
        {
			//$this->loadViews("project/list_projects", $this->global, $data);
			
       		// echo "<pre>";
        	// print_r($_POST);
        	// echo "</pre>";
        	// die();
			$status	 = 1;
			$end = date('d/m/Y');

			// $array = array(	'TODO_LIST'		=> $task, 
			// 				'STATUS_ID'		=> $status, 
			// 				'AM'			=> $am,
			// 				'SOLUTION'		=> $sol);

			$result = $this->task_model->updateStatus($id, $status, $end);

			if($result > 0)
			{
				$this->session->set_flashdata('success', 'Update Status Success');
			}
			else
			{
				$this->session->set_flashdata('error', 'Update Status failed');
			}
			
			redirect('/Task/taskList');
        
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

    function sendMail($emailSender, $emailTitle, $emailBody){

    	$emailSender 	= 'heilhelas@gmail.com';
    	$emailReceiver 	= 'szigottre90@gmail.com';
    	$emailTitle		= 'tester';
    	$emailBody		= 'ini email bukan sembarang email';
    	$senderUser		= 'heil helas';
        // Konfigurasi email.
        $config = [
               'useragent' => 'CodeIgniter',
               'protocol'  => 'smtp',
               'mailpath'  => '/usr/sbin/sendmail',
               'smtp_host' => 'ssl://smtp.gmail.com',
               'smtp_user' => 'heilhelas@gmail.com',   // Ganti dengan email gmail Anda.
               'smtp_pass' => 'anjinglu',             // Password gmail Anda.
               'smtp_port' => 465,
               'smtp_keepalive' => TRUE,
               'smtp_crypto' => 'SSL',
               'wordwrap'  => TRUE,
               'wrapchars' => 80,
               'mailtype'  => 'html',
               'charset'   => 'utf-8',
               'validate'  => TRUE,
               'crlf'      => "\r\n",
               'newline'   => "\r\n",
           ];
 
        // Load library email dan konfigurasinya.

        $this->load->library('email');

		$this->email->initialize($config);
    	$sender 	= $this->email->from($emailSender, $senderUser);
		$receiver 	= $this->email->to($emailReceiver );
		// $cc 		= $this->email->cc('another@another-example.com');
		// $bcc 		= $this->email->bcc('them@their-example.com');

		$title 		= $this->email->subject($emailTitle	);
		$body 		= $this->email->message($senderUser	);

		$tgl = date('d/m/Y');
			
				// $this->email->send();
				// echo $this->email->print_debugger();

			if($this->email->send())
			{
				$this->session->set_flashdata('success', 'Task Set Submitted Successfully');
				$array = array(	'SENDER'		=> $emailSender, 
								'RECEIVER'		=> $emailReceiver,
								// 'CC'			=> $cc, 
								// 'BCC'			=> $bcc,  
								'TITLE'			=> $emailTitle,
								'BODY'			=> $emailBody);

				$result = $this->task_model->insertTaskMail($array, $tgl);
			}
			else
			{
				$this->session->set_flashdata('error', 'Task creation failed');
			}
			
			redirect('/Task/taskList');

    }
}

?>