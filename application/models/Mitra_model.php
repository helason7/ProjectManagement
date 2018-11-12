<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Mitra_model extends CI_Model
{
    
	public function __construct(){
		//$this->load->database();
	}
    /**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
	function setupMitra($array)
    {
        $this->db->trans_start();
        $this->db->insert('M_MITRA', $array);
        
        $this->db->select_max('ID_MITRA');
		$query = $this->db->get('M_MITRA'); 
        $insert_id = $query->row();
		
        $this->db->trans_complete();
        
        return $insert_id->ID;
    }
	
	function getListMitra()
	{
		$this->db->select("A.*");
        $this->db->from("M_MITRA A");
		// $this->db->group_by("A.MITRA_NAME, A.ADDRESS, A.NPWP, A.PIC, A.STATUS_MITRA, A.REMARK");
		$query = $this->db->get();
        
        $result = $query->result();
		
	
        return $result;
	}
	

    public function Delete($table, $where){
        $res = $this->db->delete($table, $where); // Kode ini digunakan untuk menghapus record yang sudah ada
        return $res;
    }

    function updateData($array, $id)
    {
      $this->db->trans_start();
      $this->db->where('ID_MITRA', $id);

      if($this->db->update('M_MITRA', $array)){
        $this->db->trans_complete();
        return 1;
      }else{
        return 0;
      }
    }
    
	function getMitraById($id)
	{
		$this->db->select("*");
        $this->db->from("M_MITRA");
        $this->db->where("ID_MITRA = ", $id);  
		//$this->db->order_by('ID', 'ASC'); 
		$query = $this->db->get();
        
        $result = $query->result();
		
		 return $result;
	}
	
	
	
	//-----------------------------------------------------------------------------------------------------------------
	
	
	
	
}

?>