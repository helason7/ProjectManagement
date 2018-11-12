<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Salesstage_model extends CI_Model
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
	

	// function setupSalesstage($p_order, $p_name, $c_order, $c_name, $set_name)
 //    {
 //        $this->db->trans_start();
	// 	$insert_id = '';
		
	// 	//insert parent nodes
		
	// 	foreach($p_order as $key=>$val)
	// 	{
	// 		$salesstage = array('NAME'=> $p_name[$key], 'PARENT'=> 0, 'ORDER_NO'=> $val, 'STATUS'=> 'ACTIVE','SET_NAME'=> $set_name);
	// 		$this->db->insert('M_SALES_STAGE', $salesstage);
	// 	}
		
	// 	//insert component nodes
	// 	if(count($c_order) > 0)
	// 	{
	// 		foreach($c_order as $key=>$val)
	// 		{
	// 			$this->db->select("ID");
	// 			$this->db->from("M_SALES_STAGE");     
	// 			$this->db->where("ORDER_NO = ", $p_order[$key]);  
	// 			$this->db->where("SET_NAME = ", $set_name);  
	// 			$query = $this->db->get();
				
	// 			$parent = $query->row();
	// 			$parent_id	= $parent->ID;
				
	// 			foreach($val as $key_=>$val_)
	// 			{
	// 				$salesstage = array('NAME'=> $c_name[$key][$key_], 'PARENT'=> $parent_id, 'ORDER_NO'=> $val_, 'STATUS'=> 'ACTIVE','SET_NAME'=> $set_name);
	// 				$this->db->insert('M_SALES_STAGE', $salesstage);
	// 			}
	// 		}
	// 	}
		
		
		
 //        $this->db->trans_complete();
        
	// 	$this->db->select_max('ID');
	// 	$query = $this->db->get('M_SALES_STAGE'); 
	// 	$res = $query->row();			
        
	// 	return $res->ID;
 //    }
	
	function setupData($name)
    {
        $this->db->trans_start();
        $this->db->insert('M_SALES_STAGE', $name);
        
        $this->db->select_max('ID');
		$query = $this->db->get('M_SALES_STAGE'); 
        $insert_id = $query->row();
		
        $this->db->trans_complete();
        
        return $insert_id->ID;
    }
    
    public function Delete($table, $where){
        $res = $this->db->delete($table, $where); // Kode ini digunakan untuk menghapus record yang sudah ada
        return $res;
    }

    function updateData($array, $Id)
    {
      $this->db->trans_start();
      $this->db->where('ID', $Id);

      if($this->db->update('M_SALES_STAGE', $array)){
        $this->db->trans_complete();
        return 1;
      }else{
        return 0;
      }
    }

	function getDataById($id)
	{
		$this->db->select("*");
        $this->db->from("M_SALES_STAGE");
        $this->db->where("ID = ", $id);  
		//$this->db->order_by('ID', 'ASC'); 
		$query = $this->db->get();
        
        $result = $query->result();
		
		 return $result;
	}

	function getListSalesstage()
	{
		$this->db->select("A.NAME, A.ID");
        $this->db->from("M_SALES_STAGE A");
		$this->db->group_by("A.NAME, A.ID");
		$query = $this->db->get();
        
        $result = $query->result();
		
	
        return $result;
	}
	
	function getListActiveSalesstage()
	{
		$this->db->select("A.SET_NAME, A.STATUS");
        $this->db->from("M_SALES_STAGE A");
        $this->db->where("A.STATUS = ", 'ACTIVE');
		$this->db->group_by("A.SET_NAME, A.STATUS");
		$query = $this->db->get();
        
        $result = $query->result();
		
	
        return $result;
	}
	
	function getListCompSalesstage($idOpp)
	{
		$this->db->select("A.*");
        $this->db->from("M_SALES_STAGE A");
        $this->db->join("OPPORTUNITY_BUDGET O", "A.ID = O.BUDGET_ID");
        $this->db->where("A.STATUS = ", 'ACTIVE');
        $this->db->where("O.OPPORTUNITY_ID = ", $idOpp);
        $this->db->order_by('A.ORDER_NO ASC');
		$query = $this->db->get();
        
        $result = $query->result();
		
	
        return $result;
	}
	
	function getSalesstageInfo($oppID, $bID)
	{
		$this->db->select("AMOUNT, USAGE, REMAINDER, ID");
        $this->db->from("OPPORTUNITY_BUDGET");
        $this->db->where("BUDGET_ID = ", $bID);
        $this->db->where("OPPORTUNITY_ID = ", $oppID);
		$query = $this->db->get();
        
        $result = $query->row();
		
	
        return $result;
	}
	
	function addNewSpending($spending, $file, $balance, $date)
    {
        $this->db->trans_start();
		$insert_id = (object)[];
		$insert_id->ID = "";
		
		if($file != '0')
		{
			$name = $file['file_name'];
			$link = base_url().'docs/salesstage/'.$file['file_name'];
			$date = date('Y-m-d');
			$user = $this->session->userdata ( 'userId' );		


			$files = array('NAME'=> $name, 'FILE_LINK'=>$link, 'DATE_UPLOAD'=>$date,'USER_UPLOAD'=>$user);
					
			$this->db->insert('DOCUMENTS', $files);
			
			$this->db->select_max('ID');
			$query = $this->db->get('DOCUMENTS'); 
			$insert_id = $query->row();			
		}
		
		$this->db->set('FILE_ID', $insert_id->ID);
		$this->db->set('ACTIVITY_DATE', "to_date('$date', 'YYYY-MM-DD')", FALSE);	
        $this->db->insert('TRX_BUDGET_USED', $spending);

		$usage = (int)$spending['AMOUNT'];
		
		$this->db->set('REMAINDER', $balance);
		$this->db->set('USAGE', 'USAGE+'.$usage.'', FALSE);
		$this->db->where('ID', $spending['OPP_BUDGET_ID']);
		$this->db->update('OPPORTUNITY_BUDGET');
        
        $this->db->trans_complete();
        
		$this->db->select_max('ID');
		$query = $this->db->get('TRX_BUDGET_USED'); 
		$res = $query->row();			
        
		return $res->ID;
    }
	
	function getDetailSalesstage($name)
	{
		$this->db->select("*");
        $this->db->from("M_SALES_STAGE");
        $this->db->where("SET_NAME = ", $name);  
		//$this->db->order_by('ID', 'ASC'); 
		$query = $this->db->get();
        
        $result = $query->result();
		
		$salesstage = array();
		
		foreach($result as $key=>$val)
		{
			if($val->PARENT == 0)
			{
				$salesstage[$val->ID]['TYPE_NAME'] = $val->NAME;
				$salesstage[$val->ID]['ORDER'] = $val->ORDER_NO;
				$salesstage[$val->ID]['COMP_NAME'][] = "";
			}
			else
			{
				$salesstage[$val->PARENT]['COMP_NAME'][] = $val->NAME."|".$val->ORDER_NO."|".$val->ID;
			}
		}
		 return $salesstage;
	}
	
	function getSalesstageUsage($oppID,$bName)
	{
		$this->db->select("B.*, NVL(O.AMOUNT, 0) AS AMOUNT, O.USAGE, O.REMAINDER");
        $this->db->from("M_SALES_STAGE B");
		$this->db->join("OPPORTUNITY_BUDGET O","B.ID = O.BUDGET_ID", "left outer");
        $this->db->where("O.OPPORTUNITY_ID = ", $oppID) 
				 ->or_group_start()
					->where("B.SET_NAME = ", $bName)
					->where("O.OPPORTUNITY_ID IS NULL")
				 ->group_end();
		//$this->db->order_by('B.ID', 'ASC');
		
		$query = $this->db->get();
        
        $result = $query->result();
		
		$salesstage = array();
		
		foreach($result as $key=>$val)
		{
			if($val->PARENT == 0)
			{
				$salesstage[$val->ID]['TYPE_NAME'] = $val->NAME;
				$salesstage[$val->ID]['ORDER'] = $val->ORDER_NO;
				$salesstage[$val->ID]['AMOUNT'] = $val->AMOUNT;
				$salesstage[$val->ID]['USAGE'] = $val->USAGE;
				$salesstage[$val->ID]['REMAINDER'] = $val->REMAINDER;
				$salesstage[$val->ID]['COMP_NAME'][] = "";
			}
			else
			{
				$salesstage[$val->PARENT]['COMP_NAME'][] = $val->NAME."|".$val->ORDER_NO."|".$val->ID."|".$val->AMOUNT."|".$val->USAGE."|".$val->REMAINDER;
			}
		}
		 return $salesstage;
	}
	
	function getSpendingOpp($oppID)
	{
		$this->db->select("B.NAME, B.ORDER_NO, S.DESCRIPTION, S.AMOUNT, S.ACTIVITY_DATE, D.FILE_LINK, U.NAME AS UNAME, S.FILE_ID");
        $this->db->from("TRX_BUDGET_USED S");
		$this->db->join("OPPORTUNITY_BUDGET O","S.OPP_BUDGET_ID = O.ID");
		$this->db->join("M_SALES_STAGE B","O.BUDGET_ID = B.ID");
		$this->db->join("MST_USER U","S.USER_ENTRY = U.ID");
		$this->db->join("DOCUMENTS D","S.FILE_ID = D.ID","left outer");
        $this->db->where("O.OPPORTUNITY_ID = ", $oppID);  
		$query = $this->db->get();
        
        $result = $query->result();
		
		return $result;
	}
	
	function checkBalance($cost,$oppbID)
	{
		$this->db->select("AMOUNT, USAGE, REMAINDER");
        $this->db->from("OPPORTUNITY_BUDGET");
        $this->db->where("ID = ", $oppbID);
        $query = $this->db->get();
        
        $result = $query->row();
		
		$balance = $result->REMAINDER - $cost;
		
		return $balance;
		
	}
	
	function getListAllocatedSalesstage()
	{
		$this->db->select("A.ID AS ID, A.NAME AS NAME,G.NAME AS G_NAME, SUM(O.AMOUNT) AS ALLOCATED, SUM(O.USAGE) AS USED, SUM(O.REMAINDER) AS REMAIN");
        $this->db->from("TRX_OPPORTUNITIES A");       
		$this->db->join("M_ACCOUNTS G","G.ID = A.ID_ACCOUNT");
		$this->db->join("OPPORTUNITY_BUDGET O","A.ID = O.OPPORTUNITY_ID");
		$this->db->where("A.BUDGET_GROUP IS NOT NULL ");
		$this->db->group_by("A.ID, A.NAME, G.NAME");
		$query = $this->db->get();
        
        $opps = $query->result();
		
		return $opps;
	}
	
	function getListAllocatedSalesstagePost()
	{
		$this->db->select("A.ID AS ID, A.NAME AS NAME, SUM(O.AMOUNT) AS ALLOCATED, SUM(O.USAGE) AS USED, SUM(O.REMAINDER) AS REMAIN");
        $this->db->from("TRX_POS_ANGGARAN A");       
		$this->db->join("OPPORTUNITY_BUDGET O","A.ID = O.OPPORTUNITY_ID");
		$this->db->where("A.BUDGET_GROUP IS NOT NULL ");
		$this->db->group_by("A.ID, A.NAME");
		$query = $this->db->get();
        
        $res = $query->result();
		
		return $res;
	}
	
	function getPost($id)
    {
        $this->db->select("A.*,G.NAME AS G_NAME,G.ORGANIZATION AS ORG, G.PIC AS PIC, U.NAME AS AM_NAME, S.NAME AS SALES_STAGE, NVL(A.BUDGET_GROUP,'NOT SET') AS BUDGET_GROUP");
        $this->db->from("TRX_OPPORTUNITIES A");       
		$this->db->join("M_ACCOUNTS G","G.ID = A.ID_ACCOUNT");
		$this->db->join("MST_USER U","A.AM_ID = U.ID");
		$this->db->join("M_SALES_STAGE S","S.ID = A.SALES_STAGE_ID");
		$this->db->where("A.ID = ", $id);
		$query = $this->db->get();
        
        $opps = $query->row();

        return $opps;
  
    }
	
	function addNewPost($post)
    {
        $this->db->trans_start();
        $this->db->insert('TRX_POS_ANGGARAN', $post);
        
        $this->db->select_max('ID');
		$query = $this->db->get('TRX_POS_ANGGARAN'); 
        $insert_id = $query->row();
		
        $this->db->trans_complete();
        
        return $insert_id->ID;
    }
	
	function getPostAnggaran($id)
    {
        $this->db->select("A.*, 'FINANCE' AS AM_NAME,  NVL(A.BUDGET_GROUP,'NOT SET') AS BUDGET_GROUP");
        $this->db->from("TRX_POS_ANGGARAN A");       
		$this->db->where("A.ID = ", $id);
		$query = $this->db->get();
        
        $res = $query->row();

        return $res;
  
    }
	
	//-----------------------------------------------------------------------------------------------------------------
	
	
	
    function getAllProjects()
    {
        $this->db->select("A.*,G.NAME AS G_NAME,G.ORGANIZATION AS ORG, G.PIC AS PIC, S.NAME AS SALES_STAGE");
        $this->db->from("TRX_PROJECTS A");       
		$this->db->join("TRX_OPPORTUNITIES O","A.OPPORTUNITY_ID = O.ID", "left outer");
		$this->db->join("M_ACCOUNTS G","G.ID = A.ACCOUNT_ID", "left outer");
		$this->db->join("M_SALES_STAGE S","S.ID = A.STAGES_ID");
		$query = $this->db->get();
        
        $result = $query->result();
		
		//print_r($result);

        return $result;
  
    }

	function getOpportunityProject()
    {
        $this->db->select("A.*");
        $this->db->from("TRX_OPPORTUNITIES A");     
		$this->db->where("A.SALES_STAGE_ID = ", 5);  
		$query = $this->db->get();
        
        $opps = $query->result();

        return $opps;
  
    }
	
	
	//-----------------------------------------------------------------------------------------------------------------
	
	
	
	
}

?>