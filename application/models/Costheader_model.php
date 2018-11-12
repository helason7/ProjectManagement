<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Costheader_model extends CI_Model
{
    
	public function __construct(){
		//$this->load->database();
	}
    /**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
	function insertCostheader($array, $date)
    {
        $this->db->trans_start();
        // $this->db->set('ACCOUNT_NAME', $array);
        $this->db->set('LAST_UPDATE',"to_date('$date','dd/mm/yyyy')",false);
        $res = $this->db->insert('COST_HEADER', $array);


        $this->db->select_max('ID_COSTHEAD');
        $query = $this->db->get('COST_HEADER'); 
        $insert_id = $query->row();

    
        $this->db->trans_complete();
        
        return $insert_id ->ID_COSTHEAD;
    }
	
	function getListCostheader()
	{  
        // $idProject = '3';
		$this->db->select("*");
        $this->db->from("COST_HEADER");
        // $this->db->where("ACC_PEL = ",$idProject);
		// $this->db->group_by("A.COA_NAME, A.ADDRESS, A.NPWP, A.PIC, A.STATUS_COA, A.REMARK");
		$query = $this->db->get();
        
        $result = $query->result();
		    return $result;
	}
	   
    function getListCostheaderByid($idProject)
    {
        $this->db->select("*");
        $this->db->from("COST_HEADER");
        $this->db->where("ID_PROJECT = ",$idProject);
        // $this->db->group_by("A.COA_NAME, A.ADDRESS, A.NPWP, A.PIC, A.STATUS_COA, A.REMARK");
        $query = $this->db->get();
        
        $result = $query->result();
            return $result;
    }
    
    function getCostPlanByid($idCost)
    {
        $this->db->select("ID_COSTHEAD");
        $this->db->from("TR_COST_PLAN");
        $this->db->where("ID_COSTHEAD = ",$idCost);
        // $this->db->group_by("A.COA_NAME, A.ADDRESS, A.NPWP, A.PIC, A.STATUS_COA, A.REMARK");
        $query = $this->db->get();
        
        $result = $query->result();
            return $result;
    }

    function getListCostPlanByid($idCost)
    {
        $this->db->select("*");
        $this->db->from("TR_COST_PLAN");
        $this->db->where("ID_COSTHEAD = ",$idCost);
        // $this->db->group_by("A.COA_NAME, A.ADDRESS, A.NPWP, A.PIC, A.STATUS_COA, A.REMARK");
        $query = $this->db->get();
        
        $result = $query->result();
            return $result;
    }

    function getListApprovedCostheader($idProject)
    {
        $status = 'APPROVED';
        $this->db->select("*");
        $this->db->from("COST_HEADER");
        $this->db->where("ID_PROJECT = ",$idProject);
        $this->db->where("STATUS = ",$status);
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
      $this->db->where('ID_COSTHEAD', $id);
      $this->db->set('BUDGET_NAME', $name);

      if($this->db->update('COST_HEADER')){
        $this->db->trans_complete();
        return 1;
      }else{
        return 0;
      }
    }
    
	function getCostheaderById($id)
	{
		$this->db->select("*");
        $this->db->from("COST_HEADER");
        $this->db->where("ID_COSTHEAD = ", $id);  
		//$this->db->order_by('ID', 'ASC'); 
		$query = $this->db->get();
        
        $result = $query->result();
		
		 return $result;
	}
	
  function getCostbyProjectID($id,$status)
  {
        // $status = 'APPROVED';
        $this->db->select("A.BUDGET_NAME, A.ID_PROJECT, A.ACC_PEL, A.ID_COSTHEAD");
        $this->db->select(", B.ACCOUNT_NAME");
        $this->db->select(", TO_CHAR(SUM((C.JUMLAH * C.DURASI * C.UNIT_COST)), '999G999G999G999')as TOTAL_COST"); 
        $this->db->from("COST_HEADER A");
        $this->db->join("MST_ACC_PEL B", "A.ACC_PEL = B.ID_ACCOUNT_PEL");
        $this->db->join("TR_COST_PLAN C", "A.ID_COSTHEAD = C.ID_COSTHEAD", "LEFT");
        $this->db->where("A.ID_PROJECT = ", $id);
        $this->db->where("A.STATUS = ", $status);
        $this->db->group_by("A.BUDGET_NAME, A.ID_PROJECT, A.ACC_PEL,  A.ID_COSTHEAD, B.ACCOUNT_NAME");
        $query = $this->db->get();
        
        //echo $this->db->last_query();die();
        $opps = $query->result();
        
        return $opps;
  
    }
	
  function getAprrovalBudget($id)
  {
        $status = 'APPROVED';
        $this->db->select("A.BUDGET_NAME, A.ID_PROJECT, A.ACC_PEL, A.ID_COSTHEAD");
        $this->db->select(", B.ACCOUNT_NAME");
        $this->db->select(", TO_CHAR(SUM((C.JUMLAH * C.DURASI * C.UNIT_COST)), '999G999G999G999')as TOTAL_COST"); 
        $this->db->from("COST_HEADER A");
        $this->db->join("MST_ACC_PEL B", "A.ACC_PEL = B.ID_ACCOUNT_PEL");
        $this->db->join("TR_COST_PLAN C", "A.ID_COSTHEAD = C.ID_COSTHEAD", "LEFT");
        $this->db->where("A.ID_PROJECT = ", $id);
        $this->db->where("A.STATUS = ", $status);
        // $this->db->where("C.ID_COSTHEAD = ", $id);
        $this->db->group_by("A.BUDGET_NAME, A.ID_PROJECT, A.ACC_PEL,  A.ID_COSTHEAD, B.ACCOUNT_NAME");
        $query = $this->db->get();
        
        //echo $this->db->last_query();die();
        $opps = $query->result();
        
        return $opps;
  
    }
    
	
	//-----------------------------------------------------------------------------------------------------------------
	
	
	
	
}

?>