<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Project_model extends CI_Model
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
	 function getAllOpportunitiesbyam($id)
    {
        $this->db->select("A.*,TO_CHAR(A.AMOUNT, '99G999G999G9999') as TOTAL,rownum,G.NAME AS G_NAME,G.ORGANIZATION AS ORG, G.PIC AS PIC, U.NAME AS AM_NAME, S.NAME AS SALES_STAGE");
        $this->db->from("TR_PROJECT A");       
		$this->db->join("M_ACCOUNTS G","G.ID = A.ID_CUSTOMER");
		$this->db->join("MST_USER U","A.ID_AM = U.ID");
		$this->db->join("M_SALES_STAGE S","S.ID = A.KODE_STATUS");
		$this->db->where("A.ID_AM = ", $id);
		$query = $this->db->get();
        
        //$opps = $query->result();
		return $query->result_array();
       // return $opps;
  
    }
	
	function getAllOpportunitiesbysolution($id)
    {
        $this->db->select("A.*,TO_CHAR(A.AMOUNT, '99G999G999G9999') as TOTAL,rownum,G.NAME AS G_NAME,G.ORGANIZATION AS ORG, G.PIC AS PIC, U.NAME AS AM_NAME, S.NAME AS SALES_STAGE");
        $this->db->from("TR_PROJECT A");       
		$this->db->join("M_ACCOUNTS G","G.ID = A.ID_CUSTOMER");
		$this->db->join("MST_USER U","A.ID_AM = U.ID");
		$this->db->join("M_SALES_STAGE S","S.ID = A.KODE_STATUS");
		$this->db->where("A.ID_SOLUTION = ", $id);
		$query = $this->db->get();
        
        //$opps = $query->result();
		return $query->result_array();
       // return $opps;
  
    }
	
	function getAllOpportunitiesbyStage($stage_id)
    {
        $this->db->select("A.*,G.NAME AS G_NAME,G.ORGANIZATION AS ORG, G.PIC AS PIC, U.NAME AS AM_NAME, S.NAME AS SALES_STAGE");
        $this->db->from("TRX_OPPORTUNITIES A");       
		$this->db->join("M_ACCOUNTS G","G.ID = A.ID_ACCOUNT");
		$this->db->join("MST_USER U","A.AM_ID = U.ID");
		$this->db->join("M_SALES_STAGE S","S.ID = A.SALES_STAGE_ID");
		$this->db->where("A.SALES_STAGE_ID = ", $stage_id);
		$query = $this->db->get();
        
        $opps = $query->result();

        return $opps;
  
    }

	function getBudgetbyProjectID($id)
    {
        $this->db->select("A.ID_PROJECT,D.PROJECT_NAME,C.ID_ACCOUNT_PEL,C.ACCOUNT_NAME,TO_CHAR(SUM((A.JUMLAH * A.DURASI * A.UNIT_COST)), '999G999G999G999')as TOTAL_COST");
        $this->db->from("TR_COST_PLAN A");       
		$this->db->join("MST_KEGIATAN B","A.ID_KEGIATAN=B.ID_KEGIATAN");
		$this->db->join("MST_ACC_PEL C","B.ID_ACCOUNT_PEL=C.ID_ACCOUNT_PEL");
		$this->db->join("TR_PROJECT D","A.ID_PROJECT=D.ID_PROJECT");
		$this->db->where("A.ID_PROJECT = ", $id);
		$this->db->group_by("A.ID_PROJECT,D.PROJECT_NAME,C.ACCOUNT_NAME,C.ID_ACCOUNT_PEL"); 
		$query = $this->db->get();
        
        $opps = $query->result();

        return $opps;
    }

	function getdetailBudgetbyProjectID($id,$id_pel,$idCost)
    {
        $this->db->select("A.ID_TR_COST_PLAN,A.ID_PROJECT,A.JUMLAH,A.SATUAN_JUMLAH,A.DURASI,A.SATUAN_DURASI,A.UNIT_COST,(A.JUMLAH*A.DURASI*A.UNIT_COST)AS TOTAL_COST,A.PERCENTAGE_APPROVED,A.ID_KEGIATAN,A.DISTRIBUTEDBUDGET,A.ENTRYDATE,A.UPDATEDATE,C.ACCOUNT_NAME,B.KEGIATAN,B.ID_COA,D.PROJECT_NAME ");
        $this->db->from("TR_COST_PLAN A");       
		$this->db->join("MST_KEGIATAN B","A.ID_KEGIATAN=B.ID_KEGIATAN");
		$this->db->join("MST_ACC_PEL C","B.ID_ACCOUNT_PEL=C.ID_ACCOUNT_PEL");
		$this->db->join("TR_PROJECT D","A.ID_PROJECT=D.ID_PROJECT");
		$this->db->where("A.ID_PROJECT = ", $id);
		$this->db->where("B.ID_ACCOUNT_PEL = ", $id_pel);
		$this->db->where("A.ID_COSTHEAD = ", $idCost);
		
		$query = $this->db->get();
        
        $opps = $query->result();
		log_message('error','--- > getdetailBudgetbyProjectID :'.json_encode($this->db->last_query()));
        return $opps;
  
    }
	
	function getOpportunity($id)
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
	
	function getActivities($id, $type)
    {
        $this->db->select("A.*, D.NAME AS DOC_NAME, NVL(D.ID,0) AS FILE_ID, NVL(D.FILE_LINK,0) AS F_LINK");
        $this->db->from("TRX_ACTIVITIES A");       
		$this->db->join("DOCUMENTS D","A.FILE_ID = D.ID","left outer");
		$this->db->where("A.EXT_ID = ", $id);
		$this->db->where("A.TYPE = ", $type);
		$query = $this->db->get();
        
        $result = $query->result();

        return $result;  
    }
	
	
	function getSummAct($id, $type)
    {
        $this->db->select("COUNT(A.ID) AS JML, A.STATUS_ACTIVITY");
        $this->db->from("TRX_ACTIVITIES A");       
		$this->db->where("A.EXT_ID = ", $id);
		$this->db->where("A.TYPE = ", $type);
		$this->db->group_by("A.STATUS_ACTIVITY");
		$query = $this->db->get();
        
        $result = $query->result();
		$row = array();
		
		foreach($result as $key=>$val)
		{
			$row[$val->STATUS_ACTIVITY] = $val->JML;
		}
		
        return $row;  
    }
	
	
	function getIssues($id, $type)
    {
        $this->db->select("A.*");
        $this->db->from("TRX_ISSUES A");       
		$this->db->where("A.EXT_ID = ", $id);
		$this->db->where("A.TYPE = ", $type);
		$query = $this->db->get();
        
        $result = $query->result();

        return $result;  
    }
	
	
	function getSummIssues($id, $type)
    {
        $this->db->select("COUNT(A.ID) AS JML, A.STATUS_ISSUE");
        $this->db->from("TRX_ISSUES A");       
		$this->db->where("A.EXT_ID = ", $id);
		$this->db->where("A.TYPE = ", $type);
		$this->db->group_by("A.STATUS_ISSUE");
		$query = $this->db->get();
        
        $result = $query->result();
		$row = array();
		
		foreach($result as $key=>$val)
		{
			$row[$val->STATUS_ISSUE] = $val->JML;
		}
		
        return $row;  
    }

	function getAccount()
    {
        $this->db->select("*");
        $this->db->from("M_ACCOUNTS");     
		$query = $this->db->get();
        
        $result = $query->result();

        return $result;
  
    }
	function getSolution()
    {
        $this->db->select("*");
        $this->db->from("MST_USER");   
		$this->db->where("TYPE_ID = ", 9);  		
		$query = $this->db->get();
        
        $result = $query->result();

        return $result;
  
    }
	
	function getKegiatan($id)
    { //ID_ACCOUNT_PEL
        $this->db->select("*");
        $this->db->from("MST_KEGIATAN A");   
		$this->db->join("MST_ACC_PEL B","A.ID_ACCOUNT_PEL = B.ID_ACCOUNT_PEL");
		$this->db->where("A.ID_ACCOUNT_PEL = ", $id);  		
		$query = $this->db->get();
        $result = $query->result();

        return $result;
  
    }
	function getAccountPelName($id)
    { //ID_ACCOUNT_PEL
        $this->db->select("ACCOUNT_NAME");
        $this->db->from("MST_ACC_PEL A");   
		$this->db->where("A.ID_ACCOUNT_PEL = ", $id);  		
		$query = $this->db->get();
       

       return $query->result_array();
  
    }
	
	
	function getStageOpp()
    {
        $this->db->select("*");
        $this->db->from("M_SALES_STAGE");   
        $this->db->where("ID <= ", 5);  
		$this->db->order_by('ID', 'ASC'); 
		$query = $this->db->get();
        
        $result = $query->result();

        return $result;
  
    }
	
	
	function getUser($spec)
    {
        $this->db->select("A.*");
        $this->db->from("MST_USER A");
		$this->db->join("USER_SPESIAL U","U.USER_ID = A.ID");
		$this->db->join("M_SPESIALIZATION S","S.ID = U.SPESIALIST_ID");    
        $this->db->where("S.NAME =",$spec);     
		$query = $this->db->get();
        
        $result = $query->result();

        return $result;
  
    }
	
	function getSpesialization()
    {
        $this->db->select("*");
        $this->db->from("M_SPESIALIZATION");       
		$query = $this->db->get();
        
        $specs = $query->result();

        return $specs;
  
    }
	
	function addNewOpportunity($opportunity)
    {
        $this->db->trans_start();
        $this->db->insert('TRX_OPPORTUNITIES', $opportunity);
        
        $this->db->select_max('ID');
		$query = $this->db->get('TRX_OPPORTUNITIES'); 
        $insert_id = $query->row();
		
        $this->db->trans_complete();
        
        return $insert_id->ID;
    }
	
	function addNewCostPlan($params,$ENTRY_DATE)
    {
	
        $this->db->trans_start();
        $this->db->set('ENTRYDATE',"to_date('$ENTRY_DATE','YYYY-MM-DD')",false);
        $this->db->insert('TR_COST_PLAN', $params);
        
        $this->db->select_max('ID_TR_COST_PLAN');
		$query = $this->db->get('TR_COST_PLAN'); 
        $insert_id = $query->row();
		
        $this->db->trans_complete();
        
        return $insert_id->ID_TR_COST_PLAN;
    
	
  //      $query = "INSERT INTO TR_COST_PLAN(
		// 						ID_PROJECT,JUMLAH,SATUAN_JUMLAH,DURASI,SATUAN_DURASI,UNIT_COST,ID_KEGIATAN,ENTRYDATE, ID_COSTHEAD
		// 						)
		// 				VALUES (?,?,?,?,?,?,?,to_date(?, 'YYYY-MM-DD'),?)
		// 				";
		// $result = $this->db->query($query,$params);
		// log_message('error','--- > addNewCostPlan :'.json_encode($this->db->last_query()));
		// return $result;
		
	
	}
	function insertCostPlan($array)
    {
    //      $this->db->select_max('ID_COSTHEAD');
    // $query = $this->db->get('COST_HEADER');
    //     $insert_id = $query->row();
    //         echo "<pre>";
    //         print_r($insert_id);
    //         echo "</pre>";
    //         die();
        $this->db->trans_start();
        // $this->db->set('ACCOUNT_NAME', $array);
        // $this->db->set('START_TASK',"to_date('$date','yyyy/mm/dd')",false);
        $res = $this->db->insert('TR_COST_PLAN', $array);


        $this->db->select_max('ID_TR_COST_PLAN');
        $query = $this->db->get('TR_COST_PLAN'); 
        $insert_id = $query->row();
        // $this->db->set('ID_COSTHEAD', $insert_id);
        // $insert_id ->ID_COSTHEAD;

    
        $this->db->trans_complete();
        
        return $insert_id ->ID_TR_COST_PLAN;
    }
	function addNewOpportunity1($params)
    {
		
		
       $query = "INSERT INTO TR_PROJECT(
								ID_PROJECT,PROJECT_NAME,CURRENCY,ID_AM,TARGET_END_DATE,TARGET_START_DATE,NO_KONTRAK_CUSTOMER,AMOUNT,DELIVERY_TIME,ID_CUSTOMER,ID_SOLUTION,DESKRIPSI,ID_PORTOFOLIO,KODE_STATUS,ENTRY_DATE
								)
						VALUES (?,?,?,?,to_date(?, 'YYYY-MM-DD'),to_date(?, 'YYYY-MM-DD'),?,?,?,?,?,?,?,'1',to_date(?, 'YYYY-MM-DD'))
						";
		$result = $this->db->query($query,$params);
		//log_message('error','--- > d :'.json_encode($this->db->last_query()));
		return $result;
    }
	function updateOpportunity1($params)
    {
		
							
	 $query = "update TR_PROJECT set
								ID_PROJECT=?,PROJECT_NAME=?,CURRENCY=?,
								ID_AM=?,TARGET_END_DATE=to_date(?, 'YYYY-MM-DD'),TARGET_START_DATE=to_date(?, 'YYYY-MM-DD'),
								NO_KONTRAK_CUSTOMER=?,AMOUNT=?,
								DELIVERY_TIME=?,ID_CUSTOMER=?,
								ID_SOLUTION=?,DESKRIPSI=?,ID_PORTOFOLIO=?,
								UPDATE_DATE=to_date(?, 'YYYY-MM-DD')
								where id=?";
								
		$result = $this->db->query($query,$params);
		//log_message('error','--- > d :'.json_encode($this->db->last_query()));
		return $result;

	
	}
	function getProjectbyID($id)
    {
        $this->db->select("A.*,TO_CHAR(A.AMOUNT, '99G999G999G9999') as TOTAL,rownum,G.NAME AS G_NAME,G.ORGANIZATION AS ORG, G.PIC AS PIC, U.NAME AS AM_NAME, S.NAME AS SALES_STAGE");
        $this->db->from("TR_PROJECT A");       
		$this->db->join("M_ACCOUNTS G","G.ID = A.ID_CUSTOMER");
		$this->db->join("MST_USER U","A.ID_AM = U.ID");
		$this->db->join("M_SALES_STAGE S","S.ID = A.KODE_STATUS");
		$this->db->where("A.ID = ", $id);
		$query = $this->db->get();
        //log_message('error','--- > getProjectbyID :'.json_encode($query));
		return $query->result_array();
  
    }
	function getProjectbyProjectID($id)
    {
        $this->db->select("A.*,TO_CHAR(A.AMOUNT, '99G999G999G9999') as TOTAL,rownum,G.NAME AS G_NAME,G.ORGANIZATION AS ORG, G.PIC AS PIC, U.NAME AS AM_NAME, S.NAME AS SALES_STAGE");
        $this->db->from("TR_PROJECT A");       
		$this->db->join("M_ACCOUNTS G","G.ID = A.ID_CUSTOMER");
		$this->db->join("MST_USER U","A.ID_AM = U.ID");
		$this->db->join("M_SALES_STAGE S","S.ID = A.KODE_STATUS");
		$this->db->where("A.ID_PROJECT = ", $id);
		$query = $this->db->get();
        //log_message('error','--- > getProjectbyID :'.json_encode($query));
		return $query->result_array();
  
    }
	function getdocumentProjectbyID($id)
    {
		$this->db->select("A.*");
        $this->db->from("V_STRING_DOC A");
		
		$query = $this->db->get();
		$dataq='';
		
		foreach ($query->result_array() as $row)
		{
				$dataq=$row['STRINGDD'];
				
		}
		
		/*  $this->db->select("A.*");
        $this->db->from("V_DOKUMENT A");  
		$this->db->where("A.ID_PROJECT = ", $id);	
		$query = $this->db->get(); 
        //log_message('error','--- > getProjectbyID :'.json_encode($query));
		return $query->result_array();	 */	 
		
		$query 	= $this->db->query("select * FROM 
     (select ID_PROJECT,ID_UPLOADED,DOC_TYPE,COUNT(DOC_TYPE)TOTAL FROM TR_PROJECT_ATTACHEMENT A where ID_PROJECT='$id' GROUP BY ID_PROJECT,ID_UPLOADED,DOC_TYPE)
     PIVOT (SUM (TOTAL)as DOC FOR (DOC_TYPE)IN($dataq))");
		//json_encode($query->result_array());
		
		return $query->result_array();
		 
		 
	}
	function getdocumentDetailProjectbyID($id)
    {
		
		$query 	= $this->db->query("select A.*,B.DOC_DESCRIPTION,C.NAME from TR_PROJECT_ATTACHEMENT A JOIN T_DOC_TYPE B ON A.DOC_TYPE=B.DOC_TYPE JOIN MST_USER C ON A.ID_UPLOADED=C.ID where A.ID_PROJECT='$id' ORDER BY A.DOC_TYPE,A.UPLOADED_DATE ASC");
		//json_encode($query->result_array());
		
		return $query->result_array();
		 
		 
	}
	function get_T_COMMENT($id)
    {
		
		$query 	= $this->db->query(" select A.ID_PROJECT,A.ENTRY_USER,C.NAME,A.ENTRY_DATE,A.KOMENTAR,B.ID AS PID from T_COMMENT A JOIN TR_PROJECT B ON A.ID_PROJECT=B.ID_PROJECT JOIN MST_USER C ON A.ENTRY_USER=C.ID WHERE B.ID=$id ORDER BY ENTRY_DATE ASC");
		//json_encode($query->result_array());
		
		return $query->result_array();
		 
		 
	}
	
	function getdocumentProjectbyAM($id)
    {
		$this->db->select("A.*");
        $this->db->from("V_DOKUMENT A");  
		$this->db->where("A.ID_UPLOADED = ", $id);	
		$query = $this->db->get();
        //log_message('error','--- > getProjectbyID :'.json_encode($query));
		return $query->result_array();		 
	}
	
	
	
	function addNewProjectDoc($params)
    {
		
		
       $query = "INSERT INTO TR_PROJECT_ATTACHEMENT(
								ID_PROJECT,DOC_TYPE,DOC_NAME,ID_UPLOADED,UPLOADED_DATE,TITLE_DOC
								)
						VALUES (?,?,?,?,to_date(?, 'YYYY-MM-DD'),?)
						";
		$result = $this->db->query($query,$params);
		//log_message('error','--- > d :'.json_encode($this->db->last_query()));
		return $result;
    }
	
	
	function addNewActivity($activity, $file)
    {
        $this->db->trans_start();
		$insert_id = '';
		
		if($file != '0')
		{
			$name = $file['file_name'];
			$link = base_url().'docs/activity/'.$file['file_name'];
			$date = date('Y-m-d');
			$user = $this->session->userdata ( 'userId' );		


			$files = array('NAME'=> $name, 'FILE_LINK'=>$link, 'DATE_UPLOAD'=>$date,'USER_UPLOAD'=>$user);
					
			$this->db->insert('DOCUMENTS', $files);
			
			$this->db->select_max('ID');
			$query = $this->db->get('DOCUMENTS'); 
			$insert_id = $query->row();			
		}
		
		
		
		$this->db->set('FILE_ID', $insert_id->ID);
        $this->db->insert('TRX_ACTIVITIES', $activity);
        
        $this->db->trans_complete();
        
		$this->db->select_max('ID');
		$query = $this->db->get('TRX_ACTIVITIES'); 
		$res = $query->row();			
        
		return $res->ID;
    }
	
	
	function addNewIssue($issue)
    {
        $this->db->trans_start();
        $this->db->insert('TRX_ISSUES', $issue);
        
        $this->db->trans_complete();
        
		$this->db->select_max('ID');
		$query = $this->db->get('TRX_ISSUES'); 
		$res = $query->row();			
        
		return $res->ID;
    }
	
	function editOpportunity($opportunity, $id)
    {
        $this->db->trans_start();
        
		$this->db->where('ID', $id);
        
        if($this->db->update('TRX_OPPORTUNITIES', $opportunity))
		{
			$this->db->trans_complete();
			return 1;
		}
		else
		{
			return 0;
		}
	}

	function ChangeStatIssue($type, $stat, $issue_id)
    {
        $this->db->trans_start();
        
		$this->db->set('STATUS_ISSUE', $stat);
		$this->db->where('ID', $issue_id);
		$this->db->where('TYPE', $type);
		$this->db->update('TRX_ISSUES');
        
        $this->db->trans_complete();
        
		return 1;
    }
	
	function ChangeStatAct($type, $stat, $act_id)
    {
        $this->db->trans_start();
        
		$this->db->set('STATUS_ACTIVITY', $stat);
		$this->db->where('ID', $act_id);
		$this->db->where('TYPE', $type);
		$this->db->update('TRX_ACTIVITIES');
        
        $this->db->trans_complete();
        
		return 1;
    }
	
	function setIssueDone($solution, $issue_id)
    {
        $this->db->trans_start();
        
		$this->db->set('STATUS_ISSUE', 'DONE');
		$this->db->set('SOLUTION', $solution);
		$this->db->where('ID', $issue_id);
		$this->db->update('TRX_ISSUES');
        
        $this->db->trans_complete();
        
		return 1;
    }
	
	
	//-----------------------------------------------------------------PROJECT RELATED-------------------------------------------
	
	function getOppAccount($id)
	{
		$this->db->select("A.*");
        $this->db->from("M_ACCOUNTS A");  
		$this->db->join("TRX_OPPORTUNITIES O","O.ID_ACCOUNT = A.ID"); 
        $this->db->where("O.ID = ", $id);    
		$query = $this->db->get();
        
        $result = $query->row();

        return $result;
	}
	
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
	function getAllProjectsbyAm()
    {
        $AMID=$this->session->userdata ('userId');
		$this->db->select("A.*,G.NAME AS G_NAME,G.ORGANIZATION AS ORG, G.PIC AS PIC, S.NAME AS SALES_STAGE");
        $this->db->from("TRX_PROJECTS A");       
		$this->db->join("TRX_OPPORTUNITIES O","A.OPPORTUNITY_ID = O.ID", "left outer");
		$this->db->join("M_ACCOUNTS G","G.ID = A.ACCOUNT_ID", "left outer");
		$this->db->join("M_SALES_STAGE S","S.ID = A.STAGES_ID");
		$this->db->where("O.AM_ID = ", $AMID); 
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
	
	
	function getStageProject()
    {
        $this->db->select("*");
        $this->db->from("M_SALES_STAGE");   
        $this->db->where("ID > ", 5);  
		$this->db->order_by('ID', 'ASC'); 
		$query = $this->db->get();
        
        $result = $query->result();

        return $result;
  
    }
	
	function addNewProjectOpp($project, $start_date, $end_date)
    {
        $this->db->trans_start();
		
		$this->db->set('START_DATE', "to_date('$start_date', 'YYYY-MM-DD')", FALSE);	
		$this->db->set('END_DATE', "to_date('$end_date', 'YYYY-MM-DD')", FALSE);		
		
        $this->db->insert('TRX_PROJECTS', $project);
        
        $this->db->select_max('ID');
		$query = $this->db->get('TRX_PROJECTS'); 
        $insert_id = $query->row();
		
		if ($insert_id > 0)
		{
			$id_opp = $project["OPPORTUNITY_ID"];
			$this->db->set('SALES_STAGE_ID', 6);
			$this->db->where('ID', $id_opp);
			$this->db->update('TRX_OPPORTUNITIES');
			
		}
		
        $this->db->trans_complete();
        
        return $insert_id->ID;
    }
	
	
	function addNewProjectNew($project, $start_date, $end_date)
    {
        $this->db->trans_start();
		
		$this->db->set('START_DATE', "to_date('$start_date', 'YYYY-MM-DD')", FALSE);	
		$this->db->set('END_DATE', "to_date('$end_date', 'YYYY-MM-DD')", FALSE);		
		
        $this->db->insert('TRX_PROJECTS', $project);
        
        $this->db->select_max('ID');
		$query = $this->db->get('TRX_PROJECTS'); 
        $insert_id = $query->row();
		
        $this->db->trans_complete();
        
        return $insert_id->ID;
    }
	
	function getProject($id)
    {
        $this->db->select("A.*,G.NAME AS G_NAME,G.ORGANIZATION AS ORG, G.PIC AS PIC, S.NAME AS SALES_STAGE, NVL(O.BUDGET_GROUP, 'NOT SET') AS BUDGET_GROUP");
        $this->db->from("TRX_PROJECTS A");       
		$this->db->join("M_SALES_STAGE S","S.ID = A.STAGES_ID");
		$this->db->join("M_ACCOUNTS G","G.ID = A.ACCOUNT_ID", "left outer");
		$this->db->join("TRX_OPPORTUNITIES O","A.OPPORTUNITY_ID = O.ID", "left outer");
		$this->db->where("A.ID = ", $id);
		$query = $this->db->get();
        
        $result = $query->row();

        return $result;
  
    }
	
	function getProjectOpp($id)
    {
        $this->db->select("A.*,G.NAME AS G_NAME,G.ORGANIZATION AS ORG, G.PIC AS PIC, U.NAME AS AM_NAME, S.NAME AS SALES_STAGE");
        $this->db->from("TRX_OPPORTUNITIES A");       
		$this->db->join("M_ACCOUNTS G","G.ID = A.ID_ACCOUNT");
		$this->db->join("MST_USER U","A.AM_ID = U.ID");
		$this->db->join("M_SALES_STAGE S","S.ID = A.SALES_STAGE_ID");
		$this->db->join("TRX_PROJECTS P","P.OPPORTUNIY_ID = A.ID");
		$this->db->where("P.ID = ", $id);
		$query = $this->db->get();
        
        $result = $query->row();

        return $result;
    }
	
	function getSummProject()
    {
        $this->db->select("COUNT(A.ID) AS JML");
        $this->db->from("TRX_OPPORTUNITIES A");       
		$this->db->where("A.SALES_STAGE_ID = ", 5);
		$query = $this->db->get();
        
        $result = $query->row();
		$row = array();
		
		$row['HANDOVER'] = $result->JML;
		
		$this->db->select("COUNT(A.ID) AS JML");
        $this->db->from("TRX_PROJECTS A");       
		$this->db->where("A.STATUS != ", "CLOSED");
		$query = $this->db->get();
        $result = $query->row();
		
		$row['ONGOING'] = $result->JML;
		
		$this->db->select("COUNT(A.ID) AS JML");
        $this->db->from("TRX_PROJECTS A");       
		$this->db->where("A.STATUS = ", "CRITICAL");
		$query = $this->db->get();
        $result = $query->row();
		
		$row['CRITICAL'] = $result->JML;
		
        return $row;  
    }
	
	function buildTeam($idProject, $team)
    {
        $this->db->trans_start();
		
		$this->db->delete('ASSOC_USER_PROJECT', array('PROJECT_ID' => $idProject));
		
		$pm	= array('USER_ID' => $team['pm'], 'PROJECT_ID' => $idProject, 'SPESIALIZATION_ID' => 9);		
        $this->db->insert('ASSOC_USER_PROJECT', $pm);
        
		$sa	= array('USER_ID' => $team['sa'], 'PROJECT_ID' => $idProject, 'SPESIALIZATION_ID' => 3);		
        $this->db->insert('ASSOC_USER_PROJECT', $sa);
        
		$ba	= array('USER_ID' => $team['ba'], 'PROJECT_ID' => $idProject, 'SPESIALIZATION_ID' => 4);
        $this->db->insert('ASSOC_USER_PROJECT', $ba);
        
		$lead	= array('USER_ID' => $team['lead'], 'PROJECT_ID' => $idProject, 'SPESIALIZATION_ID' => 10);
        $this->db->insert('ASSOC_USER_PROJECT', $lead);
        
		$progs = array();
		
		foreach($team['progs'] as $prog)
		{
			if($prog != "")
				$progs[] = array('USER_ID' => $prog, 'PROJECT_ID' => $idProject, 'SPESIALIZATION_ID' => 1);

		}
		
		if(count($progs) == 0)
			$progs[] = array('USER_ID' => "", 'PROJECT_ID' => $idProject, 'SPESIALIZATION_ID' => 1);
		
		$this->db->insert_batch('ASSOC_USER_PROJECT', $progs);
        		
		$integrs = array();
		
		foreach($team['integrs'] as $integr)
		{
			if($integr != "")
				$integrs[] = array("USER_ID" => $integr, 'PROJECT_ID' => $idProject, "SPESIALIZATION_ID" => 5);

		}
		
		if(count($integrs) == 0)
				$integrs[] = array('USER_ID' => "", 'PROJECT_ID' => $idProject, 'SPESIALIZATION_ID' => 5);
			
		$this->db->insert_batch('ASSOC_USER_PROJECT', $integrs); 
		
		$tws = array();
		
		foreach($team['tws'] as $tw)
		{
			if($tw != "")
				$tws[] = array("USER_ID" => $tw, 'PROJECT_ID' => $idProject, "SPESIALIZATION_ID" => 11);
		
		}
		
		if(count($tws) == 0)
			$tws[] = array('USER_ID' => "", 'PROJECT_ID' => $idProject, 'SPESIALIZATION_ID' => 11);
		
		$this->db->insert_batch('ASSOC_USER_PROJECT', $tws);
        
		
		
		
        $this->db->select('PROJECT_ID');
        $this->db->where("PROJECT_ID = ", $idProject);    
		$query = $this->db->get('ASSOC_USER_PROJECT');
		
		
        $id = $query->row();
		
        $this->db->trans_complete();
		//die;
        return $id->PROJECT_ID;
    }
	
	function getTeam($id)
    {
        $this->db->select("ASSOC_USER_PROJECT.*, NVL(MST_USER.NAME,'No Allocation') AS NAME, M_SPESIALIZATION.NAME AS S_NAME");
        $this->db->from("ASSOC_USER_PROJECT");
        $this->db->join("MST_USER", "ASSOC_USER_PROJECT.USER_ID = MST_USER.ID", "left outer");
        $this->db->join("M_SPESIALIZATION", "ASSOC_USER_PROJECT.SPESIALIZATION_ID = M_SPESIALIZATION.ID");
		$this->db->where("PROJECT_ID = ", $id);
		$query = $this->db->get();
        
        $result = $query->result();
		$team	= array();
		
		foreach($result as $key => $val)
		{
			$team[$val->S_NAME][]		= array('ID'=>$val->USER_ID,'NAME'=>$val->NAME);
		}

        return $team;
  
    }
	
	function addNewProgress($progress, $file)
    {
        $this->db->trans_start();
		$insert_id = '';
		
		if($file != '0')
		{
			$name = $file['file_name'];
			$link = base_url().'docs/progress/'.$file['file_name'];
			$date = date('Y-m-d');
			$user = $this->session->userdata ( 'userId' );		


			$files = array('NAME'=> $name, 'FILE_LINK'=>$link, 'DATE_UPLOAD'=>$date,'USER_UPLOAD'=>$user);
					
			$this->db->insert('DOCUMENTS', $files);
			
			$this->db->select_max('ID');
			$query = $this->db->get('DOCUMENTS'); 
			$insert_id = $query->row();			
		}
		
		
		
		$this->db->set('FILE_ID', $insert_id->ID);
        $this->db->insert('TRX_PROGRESS', $progress);
        
        $this->db->trans_complete();
        
		$this->db->select_max('ID');
		$query = $this->db->get('TRX_PROGRESS'); 
		$res = $query->row();			
        
		return $res->ID;
    }
	
	function getProgressTimeline($id)
    {
        $this->db->select("TO_CHAR(ENTRY_DATE, 'dd/mm/yyyy') AS ENTRY_DATE");
        $this->db->from("TRX_PROGRESS");
		$this->db->where("PROJECT_ID = ", $id);
		$query = $this->db->get();
        
        $result = $query->result();
		$arr	= array();
		//$arr[]	= "'start'";
		foreach($result as $key => $val)
		{
			$arr[]		= "'".$val->ENTRY_DATE."'";
		}
		
		//$arr[]	= "'end'";
		
		$res = preg_replace('/"/', '', json_encode($arr));
		
		return $res;
  
    }
	
	function getProgressPercentage($id)
    {
        $this->db->select("PERCENTAGE");
        $this->db->from("TRX_PROGRESS");
		$this->db->where("PROJECT_ID = ", $id);
		$query = $this->db->get();
        
        $result = $query->result();
		$arr	= array();
		
		//$arr[]  = 0;
		foreach($result as $key => $val)
		{
			$arr[]		= $val->PERCENTAGE;
		}
		
		
		
		$res = preg_replace('/"/', '', json_encode($arr));
		
        return $res;
  
    }
	
	function getProgress($id)
    {
        $this->db->select("NVL(PERCENTAGE,0) PERCENTAGE, NVL(TARGET,0) TARGET");
        $this->db->from("TRX_PROGRESS");
		$this->db->where("PROJECT_ID = ", $id);
		$this->db->order_by('ID', 'DESC'); 
		$query = $this->db->get();
        
        $result = $query->row();
		
		if(count($result) == 0)
		{
			$result = new stdClass();
			$result->PERCENTAGE = 0;
			$result->TARGET = 0;
		}
		
        return $result;
  
    }
	
	function getReport($id)
    {
        $this->db->select("TRX_PROGRESS.*, TO_CHAR(ENTRY_DATE, 'dd/mm/yyyy') AS ENTRY_DATE, D.FILE_LINK");
        $this->db->from("TRX_PROGRESS");
		$this->db->join("DOCUMENTS D","TRX_PROGRESS.FILE_ID = D.ID","left outer");
		$this->db->where("PROJECT_ID = ", $id);
		$this->db->order_by('TRX_PROGRESS.ID', 'DESC'); 
		$query = $this->db->get();
        
        $result = $query->result();
		
        return $result;
  
    }
	
	//------------------------------------------------------------------------------------------------------------------
	
	
	function getAllActivities()
    {
        $this->db->select("TRX_ACTIVITIES.*");
        $this->db->from("TRX_ACTIVITIES");
		$this->db->where("STATUS_ACTIVITY != ", "DONE");
		$this->db->order_by('TRX_ACTIVITIES.ID', 'DESC'); 
		$query = $this->db->get();
        
        $result = $query->result();
		
        return $result;
  
    }
	
	function getAllIssues()
    {
        $this->db->select("TRX_ISSUES.*");
        $this->db->from("TRX_ISSUES");
		$this->db->where("STATUS_ISSUE != ", "DONE");
		$this->db->order_by('TRX_ISSUES.ID', 'DESC'); 
		$query = $this->db->get();
        
        $result = $query->result();
		
        return $result;
  
    }
	
	
	
	function getAccountOpp()
    {
        $this->db->select("COUNT(TRX_OPPORTUNITIES.ID) AS JML, TRX_OPPORTUNITIES.ID_ACCOUNT AS ID_ACCOUNT, M_ACCOUNTS.NAME AS NAME");
        $this->db->from("TRX_OPPORTUNITIES");
		$this->db->join("M_ACCOUNTS", "TRX_OPPORTUNITIES.ID_ACCOUNT = M_ACCOUNTS.ID");
		$this->db->group_by("M_ACCOUNTS.NAME, TRX_OPPORTUNITIES.ID_ACCOUNT");
		$this->db->order_by('TRX_OPPORTUNITIES.ID_ACCOUNT', 'ASC'); 
		$query = $this->db->get();
        
        $result = $query->result();
		
		
        return $result;
  
    }
	
	function getCriticalIssues()
    {
        $this->db->select("A.NAME AS ISSUENAME, A.PIC AS PIC, A.DEADLINE AS DEADLINE, A.TYPE AS TYPE, B.NAME AS OPPNAME, C.NAME AS PROJECTNAME");
        $this->db->from("TRX_ISSUES A");
        $this->db->join("TRX_OPPORTUNITIES B", "A.EXT_ID = B.ID AND A.TYPE = 'OPPORTUNITY'", "left outer");
        $this->db->join("TRX_PROJECTS C", "A.EXT_ID = C.ID AND A.TYPE = 'PROJECT'", "left outer");  
		$this->db->where("STATUS_ISSUE != ", "DONE");
		$query = $this->db->get();
        
        $result = $query->result();
		//print_r($result);die;
        return $result;  
    }
	
//----------------------------------------------BUDGET RELATED-------------------------------------------------------------------------------------------
	function setBudget($budget, $idOpp)
    {
        $this->db->trans_start();
		
		$this->db->delete('OPPORTUNITY_BUDGET', array('OPPORTUNITY_ID' => $idOpp));
		
		$set_data = array();
		
		foreach($budget as $key=>$val)
		{
			$set_data[] = array('BUDGET_ID' => $key, 'OPPORTUNITY_ID' => $idOpp, 'AMOUNT' => $val, 'STATUS' => 'ACTIVE');

		}
		
		if(count($set_data) > 0)
		{
			$this->db->insert_batch('OPPORTUNITY_BUDGET', $set_data);
		}
		
		$this->db->select('OPPORTUNITY_ID');
        $this->db->where("OPPORTUNITY_ID = ", $idOpp);    
		$query = $this->db->get('OPPORTUNITY_BUDGET');
		
		
        $id = $query->row();
		
        $this->db->trans_complete();
		//die;
        return $id->OPPORTUNITY_ID;
    }
    function getProjectId($id){
    	$this->db->select('ID_PROJECT');
    	$this->db->from('TR_PROJECT');
    	$this->db->where('ID =', $id);
    	$query = $this->db->get();

    	$res = $query->result();
        
        return $res;
  
    }
}

?>