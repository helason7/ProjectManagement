<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    
	public function __construct(){
		//$this->load->database();
	}
    /**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
    function getAllUSer()
    {
        $this->db->select("B.*,G.NAME AS G_NAME,H.NAME AS DIVISION, J.NAME AS SUBDIVISION");
        $this->db->from("MST_USER B");       
		$this->db->join("M_USER_TYPE G","G.ID = B.TYPE_ID");
		$this->db->join("M_DIVISION H","G.DIVISION_ID = H.ID");
		$this->db->join("M_DIVISION J","G.SUBDIVISION_ID = J.ID");
		$query = $this->db->get();
        
        $user = $query->result();

        return $user;;
  
    }

	function getDivision()
    {
        $this->db->select("*");
        $this->db->from("M_DIVISION");     
        $this->db->where("SUPERIOR_DIV <= 2");             
		$query = $this->db->get();
        
        $divs = $query->result();

        return $divs;
  
    }
	
	function getSubDivision()
    {
        $this->db->select("*");
        $this->db->from("M_DIVISION");   
        $this->db->where("SUPERIOR_DIV > 2");     
		$query = $this->db->get();
        
        $divs = $query->result();

        return $divs;
  
    }
	
	
	function getUserType()
    {
        $this->db->select("*");
        $this->db->from("M_USER_TYPE");    
        $this->db->where("IS_ADMIN <> 1");     
		$query = $this->db->get();
        
        $types = $query->result();

        return $types;
  
    }
	
	function getSpesialization()
    {
        $this->db->select("*");
        $this->db->from("M_SPESIALIZATION");       
		$query = $this->db->get();
        
        $specs = $query->result();

        return $specs;
  
    }
	
	function addNewUser($userInfo, $specs)
    {
        $this->db->trans_start();
        $this->db->insert('MST_USER', $userInfo);
        
        $this->db->select_max('ID');
		$query = $this->db->get('MST_USER'); 
        $insert_id = $query->row();
		
		foreach($specs as $spec)
		{
			$user_spec =  array('USER_ID'=> $insert_id->ID, 'SPESIALIST_ID'=>$spec);
			$this->db->insert('USER_SPESIAL', $user_spec);
		}
		
        $this->db->trans_complete();
        
        return $insert_id->ID;
    }

}

?>