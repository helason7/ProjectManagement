<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Accpel_model extends CI_Model
{
    
	public function __construct(){
		//$this->load->database();
	}
    /**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
	function insertAccpel($array)
    {
    //      $this->db->select_max('ID_ACCOUNT_PEL');
    // $query = $this->db->get('MST_ACC_PEL');
    //     $insert_id = $query->row();
    //         echo "<pre>";
    //         print_r($insert_id);
    //         echo "</pre>";
    //         die();
        $this->db->trans_start();
        // $this->db->set('ACCOUNT_NAME', $array);
        $res = $this->db->insert('MST_ACC_PEL', $array);


        $this->db->select_max('ID_ACCOUNT_PEL');
        $query = $this->db->get('MST_ACC_PEL'); 
        $insert_id = $query->row();
        // $this->db->set('ID_ACCOUNT_PEL', $insert_id);
        // $insert_id ->ID_ACCOUNT_PEL;

    
        $this->db->trans_complete();
        
        return $insert_id ->ID_ACCOUNT_PEL;
    }
	
	function getListAccpel()
	{
		$this->db->select("*");
        $this->db->from("MST_ACC_PEL");
		// $this->db->group_by("A.COA_NAME, A.ADDRESS, A.NPWP, A.PIC, A.STATUS_COA, A.REMARK");
		$query = $this->db->get();
        
        $result = $query->result();
		    return $result;
	}
	

    public function Delete($table, $where){
        $res = $this->db->delete($table, $where); // Kode ini digunakan untuk menghapus record yang sudah ada
        return $res;
    }

    function updateData($name, $id)
    {

      $this->db->trans_start();
      $this->db->where('ID_ACCOUNT_PEL', $id);
      $this->db->set('ACCOUNT_NAME', $name);

      if($this->db->update('MST_ACC_PEL')){
        $this->db->trans_complete();
        return 1;
      }else{
        return 0;
      }
    }
    
	function getAccpelById($id)
	{
		$this->db->select("*");
        $this->db->from("MST_ACC_PEL");
        $this->db->where("ID_ACCOUNT_PEL = ", $id);  
		//$this->db->order_by('ID', 'ASC'); 
		$query = $this->db->get();
        
        $result = $query->result();
		
		 return $result;
	}
	
	
	
	//-----------------------------------------------------------------------------------------------------------------
	
	
	
	
}

?>