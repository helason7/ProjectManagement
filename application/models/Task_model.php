<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Task_model extends CI_Model
{
    
	public function __construct(){
		//$this->load->database();
	}
    /**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
	function insertTask($array, $date)
    {
        $this->db->trans_start();
        $this->db->set('START_TASK',"to_date('$date','dd/mm/yyyy')",false);
        // $this->db->set('END_TASK',"to_date('$end','dd/mm/yyyy')",false);
        $this->db->insert('TASK', $array);
        
        $this->db->select_max('ID');
		$query = $this->db->get('TASK'); 
        $insert_id = $query->row();
		
        $this->db->trans_complete();
        
        return $insert_id->ID;
    }

	function getTodoList($id){
        $this->db->select("A.*");
        $this->db->from("M_TASK A");
        $this->db->where("A.USER_TYPE = ", $id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

	function getListTask($user)
	{

		$this->db->select("A.*, B.NAME AS USERNAME, C.NAME AS PROJECT, D.TODO_LIST");
        $this->db->from("MST_USER B");
        $this->db->join("TASK A","A.USER_ID = B.ID");
        $this->db->join("TRX_OPPORTUNITIES C","A.ID_PROJECT = C.ID");
        $this->db->join("M_TASK D","A.ID_TASK = D.ID_TASK");
        $this->db->where("A.USER_ID = ", $user);
		// $this->db->group_by("A.MITRA_NAME, A.ADDRESS, A.NPWP, A.PIC, A.STATUS_MITRA, A.REMARK");

        // $this->db->select("A.*");
        // $this->db->from("TASK A");
		$query = $this->db->get();
        
        $result = $query->result();
		
            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";
            // die();
        return $result;
	}
    
    function getTaskById($id)
    {
        $this->db->select("A.*, B.NAME AS B_NAME, C.NAME AS C_NAME");
        $this->db->from("MST_USER B");
        $this->db->join("TASK A","A.AM = B.ID");
        $this->db->join("MST_USER C","A.SOLUTION = C.ID");
        $this->db->where("A.ID = ", $id);  
        //$this->db->order_by('ID', 'ASC'); 
        $query = $this->db->get();
        
        $result = $query->result();
        
         return $result;
    }

    public function Delete($table, $where){
        $res = $this->db->delete($table, $where); // Kode ini digunakan untuk menghapus record yang sudah ada
        return $res;
    }

    function updateData($array, $id, $start, $end)
    {

      $this->db->trans_start();
      $this->db->where('ID', $id);
      $this->db->set('START_TASK',"to_date('$start','dd/mm/yyyy')",false);
      $this->db->set('END_TASK',"to_date('$end','dd/mm/yyyy')",false);

      if($this->db->update('TASK', $array)){
        $this->db->trans_complete();
        return 1;
      }else{
        return 0;
      }
    }
    
	function getAMById(){
        $this->db->select("A.*");
        $this->db->from("MST_USER A");
        $this->db->join("M_USER_TYPE B","A.TYPE_ID = B.ID");
        // $this->db->join("M_DIVISION C","B.DIVISION_ID = C.ID");
        $this->db->where("A.TYPE_ID = '2'");

        $query = $this->db->get();
        $res = $query->result();

        return $res;
    }
	
    function getSolutionById(){
        $this->db->select("A.*");
        $this->db->from("MST_USER A");
        $this->db->join("M_USER_TYPE B","A.TYPE_ID = B.ID");
        // $this->db->join("M_DIVISION C","B.DIVISION_ID = C.ID");
        $this->db->where("A.TYPE_ID = '9'");

        $query = $this->db->get();
        $res = $query->result();

        return $res;
    }

    function updateStatus($id, $status, $end)
    {

      $this->db->trans_start();
      $this->db->where('ID', $id);
      $this->db->set('END_TASK',"to_date('$end','dd/mm/yyyy')",false);
      $this->db->set('STATUS_ID', $status);

      if($this->db->update('TASK')){
        $this->db->trans_complete();
        return 1;
      }else{
        return 0;
      }
    }

    function insertTaskMail($array, $tgl)
    {
            // echo "<pre>";
            // print_r($array);
            // echo "</pre>";
            // die();
        $this->db->trans_start();
        $this->db->set('TGL',"to_date('$tgl','dd/mm/yyyy')",false);
        $this->db->insert('TASK_EMAIL', $array);
        
        $this->db->select_max('ID');
        $query = $this->db->get('TASK_EMAIL'); 
        $insert_id = $query->row();
        
        $this->db->trans_complete();
        
        return $insert_id->ID;
    }
    
	//-----------------------------------------------------------------------------------------------------------------
	
	
	
	
}

?>