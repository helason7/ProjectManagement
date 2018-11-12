<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Divisi_model extends CI_Model
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

	// public function GetWhere($table, $data){
	//     $res=$this->db->get_where($table, $data);
	//     return $res->result_array();
	// }


	function getListDivisiByID($id)
	{
		$this->db->select("A.ID, A.NAME, B.NAME as DIVNAME, A.SUPERIOR_DIV");
        $this->db->from("M_DIVISION A, M_DIVISION B");
		$this->db->where("A.SUPERIOR_DIV = B.ID");
		$this->db->where("A.ID = ", $id);
		$this->db->order_by("A.ID");
		$query = $this->db->get();
        
        $result = $query->result();
		
	
        return $result;
	}

	// public function Update($table, $data, $where){
 //        $res = $this->db->update($table, $data, $where); // Kode ini digunakan untuk merubah record yang sudah ada dalam sebuah tabel
 //        return $res;
 //    }
 
    function editDivisi($divInfo, $divId)
    {
      $this->db->trans_start();
      $this->db->where('ID', $divId);

      if($this->db->update('M_DIVISION', $divInfo)){
        $this->db->trans_complete();
        return 1;
      }else{
        return 0;
      }
    }
    
    public function Delete($table, $where){
        $res = $this->db->delete($table, $where); // Kode ini digunakan untuk menghapus record yang sudah ada
        return $res;
    }

	function setupDivisi($array)
    {
        $this->db->trans_start();
        $this->db->insert('M_DIVISION', $array);
        
        $this->db->select_max('ID');
		$query = $this->db->get('M_DIVISION'); 
        $insert_id = $query->row();
		
        $this->db->trans_complete();
        
        return $insert_id->ID;
    }
	
	function getListDivisi()
	{
		$this->db->select("A.ID, A.NAME, B.NAME as DIVNAME");
        $this->db->from("M_DIVISION A, M_DIVISION B");
		$this->db->where("A.SUPERIOR_DIV = B.ID");
		$this->db->order_by("A.ID");
		$query = $this->db->get();
        
        $result = $query->result();
		
	
        return $result;
	}
	
	function getListActiveDivisi()
	{
		$this->db->select("A.SET_NAME, A.STATUS");
        $this->db->from("M_DIVISION A");
        $this->db->where("A.STATUS = ", 'ACTIVE');
		$this->db->group_by("A.SET_NAME, A.STATUS");
		$query = $this->db->get();
        
        $result = $query->result();
		
	
        return $result;
	}
	
	function getListCompDivisi($idOpp)
	{
		$this->db->select("A.*");
        $this->db->from("M_DIVISION A");
        $this->db->join("OPPORTUNITY_BUDGET O", "A.ID = O.BUDGET_ID");
        $this->db->where("A.STATUS = ", 'ACTIVE');
        $this->db->where("O.OPPORTUNITY_ID = ", $idOpp);
        $this->db->order_by('A.ORDER_NO ASC');
		$query = $this->db->get();
        
        $result = $query->result();
		
	
        return $result;
	}
	
	function getDivisiInfo($oppID, $bID)
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
			$link = base_url().'docs/divisi/'.$file['file_name'];
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
	
	function getDetailDivisi($name)
	{
		$this->db->select("*");
        $this->db->from("M_DIVISION");
        $this->db->where("SET_NAME = ", $name);  
		//$this->db->order_by('ID', 'ASC'); 
		$query = $this->db->get();
        
        $result = $query->result();
		
		$divisi = array();
		
		foreach($result as $key=>$val)
		{
			if($val->PARENT == 0)
			{
				$divisi[$val->ID]['TYPE_NAME'] = $val->NAME;
				$divisi[$val->ID]['ORDER'] = $val->ORDER_NO;
				$divisi[$val->ID]['COMP_NAME'][] = "";
			}
			else
			{
				$divisi[$val->PARENT]['COMP_NAME'][] = $val->NAME."|".$val->ORDER_NO."|".$val->ID;
			}
		}
		 return $divisi;
	}
	
	function getDivisiUsage($oppID,$bName)
	{
		$this->db->select("B.*, NVL(O.AMOUNT, 0) AS AMOUNT, O.USAGE, O.REMAINDER");
        $this->db->from("M_DIVISION B");
		$this->db->join("OPPORTUNITY_BUDGET O","B.ID = O.BUDGET_ID", "left outer");
        $this->db->where("O.OPPORTUNITY_ID = ", $oppID) 
				 ->or_group_start()
					->where("B.SET_NAME = ", $bName)
					->where("O.OPPORTUNITY_ID IS NULL")
				 ->group_end();
		//$this->db->order_by('B.ID', 'ASC');
		
		$query = $this->db->get();
        
        $result = $query->result();
		
		$divisi = array();
		
		foreach($result as $key=>$val)
		{
			if($val->PARENT == 0)
			{
				$divisi[$val->ID]['TYPE_NAME'] = $val->NAME;
				$divisi[$val->ID]['ORDER'] = $val->ORDER_NO;
				$divisi[$val->ID]['AMOUNT'] = $val->AMOUNT;
				$divisi[$val->ID]['USAGE'] = $val->USAGE;
				$divisi[$val->ID]['REMAINDER'] = $val->REMAINDER;
				$divisi[$val->ID]['COMP_NAME'][] = "";
			}
			else
			{
				$divisi[$val->PARENT]['COMP_NAME'][] = $val->NAME."|".$val->ORDER_NO."|".$val->ID."|".$val->AMOUNT."|".$val->USAGE."|".$val->REMAINDER;
			}
		}
		 return $divisi;
	}
	
	function getSpendingOpp($oppID)
	{
		$this->db->select("B.NAME, B.ORDER_NO, S.DESCRIPTION, S.AMOUNT, S.ACTIVITY_DATE, D.FILE_LINK, U.NAME AS UNAME, S.FILE_ID");
        $this->db->from("TRX_BUDGET_USED S");
		$this->db->join("OPPORTUNITY_BUDGET O","S.OPP_BUDGET_ID = O.ID");
		$this->db->join("M_DIVISION B","O.BUDGET_ID = B.ID");
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
	
	function getListAllocatedDivisi()
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
	
	function getListAllocatedDivisiPost()
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