<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model
{
    
	public function __construct(){
		//$this->load->database();
	}
    /**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
    function getAllOpportunities()
    {
        $this->db->select("A.*,G.NAME AS G_NAME,G.ORGANIZATION AS ORG, G.PIC AS PIC, U.NAME AS AM_NAME, S.NAME AS SALES_STAGE");
        $this->db->from("TRX_OPPORTUNITIES A");       
		$this->db->join("M_ACCOUNTS G","G.ID = A.ID_ACCOUNT");
		$this->db->join("MST_USER U","A.AM_ID = U.ID");
		$this->db->join("M_SALES_STAGE S","S.ID = A.SALES_STAGE_ID");
		$query = $this->db->get();
        
        $opps = $query->result();

        return $opps;
  
    }
	

    public function Delete($table, $where){
        $res = $this->db->delete($table, $where); // Kode ini digunakan untuk menghapus record yang sudah ada
        return $res;
    }

	function setupAccount($array)
    {
        $this->db->trans_start();
        $this->db->insert('M_ACCOUNTS', $array);
        
        $this->db->select_max('ID');
		$query = $this->db->get('M_ACCOUNTS'); 
        $insert_id = $query->row();
		
        $this->db->trans_complete();
        
        return $insert_id->ID;
    }
	
	function getListAccount()
	{
		$this->db->select("*");
        $this->db->from("M_ACCOUNTS ");
		// $this->db->group_by("A.NAME, A.ORGANIZATION, , A.PIC");
		$query = $this->db->get();
        
        $result = $query->result();
		
	
        return $result;
	}
	
    function updateData($accInfo, $accId)
    {
      $this->db->trans_start();
      $this->db->where('ID', $accId);

      if($this->db->update('M_ACCOUNTS', $accInfo)){
        $this->db->trans_complete();
        return 1;
      }else{
        return 0;
      }
    }
    
	
	function getAccById($id)
	{
		$this->db->select("*");
        $this->db->from("M_ACCOUNTS");
        $this->db->where("ID = ", $id);  
		//$this->db->order_by('ID', 'ASC'); 
		$query = $this->db->get();
        
        $result = $query->result();
		
		 return $result;
	}
	//-----------------------------------------------------------------------------------------------------------------
	
	
}

?>