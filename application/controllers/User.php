<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Chart (ChartController)
 * chart dashboard.
 * @author : Port SOlution Warrior
 * @version : X
 * @since : 23 Januari 2018
 */
class User extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
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

			$data['users']	= $this->user_model->getAllUser();

			$this->loadViews("user/list", $this->global, $data);


		}
        else
        {
            redirect('/Main');
        }
    }

	public function addNewForm()
    {
        $this->global['pageTitle'] = 'Dashboard';

		if($this->isAdmin() == true)
        {

			$data['divs']	= $this->user_model->getDivision();
			$data['subdivs']	= $this->user_model->getSubDivision();
			$data['types']	= $this->user_model->getUserType();
			$data['specs']	= $this->user_model->getSpesialization();

			$this->loadViews("user/add_form", $this->global, $data);
		}
        else
        {
            redirect('/Main');
        }
    }

    public function editForm($id){
          $this->global['pageTitle'] = 'Dashboard';

  		if($this->isAdmin() == true){
			//$where = array('ID' => $ID);
			//$data['userData'] = $this->user_model->editUserInfo($where, 'MST_USER')->result();
			$data['userInfo'] = $this->user_model->getUserInfo($id);
  			$data['divs']	= $this->user_model->getDivision();
  			$data['subdivs']	= $this->user_model->getSubDivision();
  			$data['types']	= $this->user_model->getUserType();
  			$data['specs']	= $this->user_model->getSpesialization();

  			$this->loadViews("user/edit_form", $this->global, $data);
  		} else
          {
               redirect('/Main');
          }
      }

	public function doAddUser()
	{
		if($this->isAdmin() == TRUE)
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('nik','NIK','trim|required|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');

            if($this->form_validation->run() == FALSE)
            {
				$this->session->set_flashdata('error', 'User creation failed, missing required input data');
                $this->addNewForm();
            }
            else
            {
                $username = ucwords(strtolower($this->input->post('username')));
                $name = $this->input->post('name');
                $password = $this->input->post('password');
                $nik = $this->input->post('nik');
                $division = $this->input->post('division');
                $subdivision = $this->input->post('subdivision');
                $type = $this->input->post('type');

                $specs = $this->input->post('specs');
				// 'password'=>getHashedPassword($password)

                $userInfo = array('NAME'=> $name, 'USERNAME'=>$username, 'PASSWORD'=>$password,'TYPE_ID'=>$type, 'NIK'=>$nik);

               $result = $this->user_model->addNewUser($userInfo, $specs);
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New User created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }

                redirect('/user/addNewForm');
            }
        }
        else
        {
            redirect('/Main');
        }
	}

	public function doEditUser($id)
	{
		if($this->isAdmin() == TRUE)
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('nik','NIK','trim|required|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');

            // echo "<pre>";
            // print_r($id);
            // echo "</pre>";
            // die();
            if($this->form_validation->run() == FALSE)
            {
				        $this->session->set_flashdata('error', 'User Edit failed, missing required input data');
                $this->editForm($id);
            }
            else
            {
                $username = ucwords(strtolower($this->input->post('username')));
                $name = $this->input->post('name');
                $password = $this->input->post('password');
                $nik = $this->input->post('nik');
                $division = $this->input->post('division');
                $subdivision = $this->input->post('subdivision');
                $type = $this->input->post('type');

                $specs = $this->input->post('specs');
				// 'password'=>getHashedPassword($password)

                $userInfo = array('NAME'=> $name, 'USERNAME'=>$username, 'PASSWORD'=>$password,'TYPE_ID'=>$type, 'NIK'=>$nik);

                $result = $this->user_model->editUser($userInfo, $id);

                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Edit User successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Edit User failed');
                }

                redirect('/User/index');
            }
        }
        else
        {
            redirect('/Main');
        }
	}

    public function delete_data($id){

        $id = array('ID' => $id);
        $this->load->model('user_model');
        $this->user_model->Delete('MST_USER', $id);
        redirect('User/index/');
    }

    /**
     * This function is used to load the user list
     */
    function userListing()
    {
        if($this->isAdmin() == 1)
        {
            $this->loadThis();
        }
        else
        {
            redirect('/Main');
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('user_model');
            $data['roles'] = $this->user_model->getUserRoles();

            $this->global['pageTitle'] = 'CodeInsect : Add New User';

            $this->loadViews("addNew", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists()
    {
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");

        if(empty($userId)){
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }

    /**
     * This function is used to add new user to the system
     */
    function addNewUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]|xss_clean');

            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->input->post('mobile');

                $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>$roleId, 'name'=> $name,
                                    'mobile'=>$mobile, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));

                $this->load->model('user_model');
                $result = $this->user_model->addNewUser($userInfo);

                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New User created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }

                redirect('addNew');
            }
        }
    }


    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($userId = NULL)
    {
        if($this->isAdmin() == TRUE || $userId == 1)
        {
            $this->loadThis();
        }
        else
        {
            if($userId == null)
            {
                redirect('userListing');
            }

            $data['roles'] = $this->user_model->getUserRoles();
            $data['userInfo'] = $this->user_model->getUserInfo($userId);

            $this->global['pageTitle'] = 'CodeInsect : Edit User';

            $this->loadViews("editOld", $this->global, $data, NULL);
        }
    }


    /**
     * This function is used to edit the user information
     */
    function editUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');

            $userId = $this->input->post('userId');

            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]|xss_clean');

            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($userId);
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->input->post('mobile');

                $userInfo = array();

                if(empty($password))
                {
                    $userInfo = array('email'=>$email, 'roleId'=>$roleId, 'name'=>$name,
                                    'mobile'=>$mobile, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                }
                else
                {
                    $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>$roleId,
                        'name'=>ucwords($name), 'mobile'=>$mobile, 'updatedBy'=>$this->vendorId,
                        'updatedDtm'=>date('Y-m-d H:i:s'));
                }

                $result = $this->user_model->editUser($userInfo, $userId);

                if($result == true)
                {
                    $this->session->set_flashdata('success', 'User updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');
                }

                redirect('userListing');
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $userId = $this->input->post('userId');
            $userInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));

            $result = $this->user_model->deleteUser($userId, $userInfo);

            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }

    /**
     * This function is used to load the change password screen
     */
    function loadChangePass()
    {
        $this->global['pageTitle'] = 'CodeInsect : Change Password';

        $this->loadViews("changePassword", $this->global, NULL, NULL);
    }


    /**
     * This function is used to change the password of the user
     */
    function changePassword()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');

        if($this->form_validation->run() == FALSE)
        {
            $this->loadChangePass();
        }
        else
        {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');

            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);

            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Your old password not correct');
                redirect('loadChangePass');
            }
            else
            {
                $usersData = array('password'=>getHashedPassword($newPassword), 'updatedBy'=>$this->vendorId,
                                'updatedDtm'=>date('Y-m-d H:i:s'));

                $result = $this->user_model->changePassword($this->vendorId, $usersData);

                if($result > 0) { $this->session->set_flashdata('success', 'Password updation successful'); }
                else { $this->session->set_flashdata('error', 'Password updation failed'); }

                redirect('loadChangePass');
            }
        }
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Dashboard : 404 - Page Not Found';

        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>
