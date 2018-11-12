<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
    
	public function __construct(){
		$this->load->database();
	}
    /**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
    function loginMe($uname, $password)
    {
        $this->db->select("B.*, G.DIVISION_ID, G.IS_ADMIN AS IS_ADMIN, G.NAME AS G_NAME ");
        $this->db->from("MST_USER B");       
		$this->db->join("M_USER_TYPE G","G.ID = B.TYPE_ID");
        $this->db->where("B.USERNAME", $uname);
		$query = $this->db->get();

        
        $user = $query->result();
                        // log_message('error','---->User:'.json_encode($user));
		if(!empty($user)){
            //if(verifyHashedPassword($password, $user[0]->PASSWORD)){
            if($password == $user[0]->PASSWORD){
  				return $user;
                
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    /**
     * This function used to check email exists or not
     * @param {string} $email : This is users email id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkEmailExist($email)
    {
        $this->db->select('USERID');
        $this->db->where('EMAIL', $email);
        $this->db->where('ISDELETED', 0);
        $query = $this->db->get('M_USERS');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }


    /**
     * This function used to insert reset password data
     * @param {array} $data : This is reset password data
     * @return {boolean} $result : TRUE/FALSE
     */
    function resetPasswordUser($data)
    {
        $result = $this->db->insert('M_RESET', $data);

        if($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * This function is used to get customer information by email-id for forget password email
     * @param string $email : Email id of customer
     * @return object $result : Information of customer
     */
    function getCustomerInfoByEmail($email)
    {
        $this->db->select('USERID, EMAIL, NAME');
        $this->db->from('M_USERS');
        $this->db->where('ISDELETED', 0);
        $this->db->where('EMAIL', $email);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This function used to check correct activation deatails for forget password.
     * @param string $email : Email id of user
     * @param string $activation_id : This is activation string
     */
    function checkActivationDetails($email, $activation_id)
    {
        $this->db->select('ID');
        $this->db->from('M_RESET');
        $this->db->where('EMAIL', $email);
        $this->db->where('ACTIVATION_ID', $activation_id);
        $query = $this->db->get();
        return $query->num_rows;
    }

    // This function used to create new password by reset link
    function createPasswordUser($email, $password)
    {
        $this->db->where('EMAIL', $email);
        $this->db->where('ISDELETED', 0);
        $this->db->update('M_USERS', array('password'=>getHashedPassword($password)));
        $this->db->delete('M_RESET', array('email'=>$email));
    }
}

?>