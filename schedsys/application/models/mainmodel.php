<?php
class Mainmodel extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
public function getMaxId($tbl,$id){ /*Gets maximum Id from any table*/
          $q=$this->db->query("select max($id) as id from $tbl");
          $r=$q->result_array();
          return ($r[0]['id']==NULL)?"0":$r[0]['id'];
    }
  public function getMaxVal($tbl,$id,$cond){ /*Gets maximum Id from any table*/
          $q=$this->db->query("select max($id) as id from $tbl $cond");
          $r=$q->result_array();
          return ($r[0]['id']==NULL)?"0":$r[0]['id'];
  }

  public function numformat($length,$val){
   $l=$length-strlen($val); $str='';
  for($x=0;$x<$l;$x++){ $str.="0"; }
   return $str.''.$val;
 }

/*Your main db transactions here*/
public function getSystemPagesDatas($pageId) /*Gets submenu page datas*/
{
    $q=$this->db->query("select * from sys_systempages  where pageId='$pageId'");
    $r=$q->result_array();
    return $r; 
   
}
public function detModuleData($moduleId){
	$q=$this->db->query("select * from sys_module  where moduleId='$moduleId'");
    $r=$q->result_array();
    return $r; 
}

public function getAccountTypes(){
$q=$this->db->query("select * from sys_account_type order by accountTypeId");
    return $q->result_array();
   	
}

function getPersonnelAccountTypes()
{
 $q=$this->db->query("select * from sys_account_type where not accntclass='ST' order by accountTypeId");
    return $q->result_array(); 
}
function getStudentAccountTypes(){
$q=$this->db->query("select * from sys_account_type where accntclass='ST' order by accountTypeId");
    return $q->result_array();   
}


public function getAccountType_Data($accountTypeId){
$q=$this->db->query("select * from sys_account_type where accountTypeId='$accountTypeId'");
    return $q->result_array();  
}

public function getAccountId($pid,$accountTypeId) /*gets user account of the person through ID*/
    {
    $query=$this->db->query("select accountId from sys_p_account where pid='$pid' and accountTypeId='$accountTypeId'");
    if ($query->num_rows() > 0)
        {
        $row = $query->row(); 
      $pagecont = $row->accountId;
        return $pagecont;
        }
    }

public function useraccount_data($accountId)
{
  $query=$this->db->query("select * from sys_p_account where accountId='$accountId'");  
return $query->result_array();
}

public function useraccount_password_data($accountId)
{
  $query=$this->db->query("select * from sys_user_passwords where accountId='$accountId'");  
return $query->result_array();
}

 public function hasAccess($accountId){
    $query=$this->db->query("select * from sys_p_account where accountId='$accountId'");
    $r=$query->num_rows();
    if($r>0){ return true; }
    else if($r==0){ return false; }
  }
public function person_data($pid){
$q=$this->db->query("select * from sys_p_person where pid='$pid'");  
return $q->result_array();
}


/*School Year*/
public function syear_data($syid){
$q=$this->db->query("select * from sys_schoolyear where syid='$syid'");  
return $q->result_array();  
}
public function syear_list(){
$q=$this->db->query("select * from sys_schoolyear where remark='1' order by syid");  
return $q->result_array();    
}

/* Room */
public function room_data($id){
$q=$this->db->query("select * from sys_rooms where roomid='$id'");  
return $q->result_array();    
}
public function room_list(){
$q=$this->db->query("select * from sys_rooms where 1");  
return $q->result_array();    
}

/* Level */
public function level_list(){
$q=$this->db->query("select * from sys_levels where remark='1' order by seq");  
return $q->result_array();    
}
public function level_data($lvlid){
$q=$this->db->query("select * from sys_levels where lvlid='$lvlid'");  
return $q->result_array();  
}

/* Sections */
public function section_list($lvlid){
$q=$this->db->query("select * from sys_sections where lvlid='$lvlid' and remark='1' order by seq");  
return $q->result_array();    
}
public function section_data($sectid){
$q=$this->db->query("select * from sys_sections where sectid='$sectid'");  
return $q->result_array();  
}

/* Student info*/
public function student_data($pid)
{
$q=$this->db->query("select * from sys_s_student where pid='$pid'");  
return $q->result_array();  
}

/* Student Enroll */
public function enroll_data($enrollid)
{
$q=$this->db->query("select * from sys_s_registration where enrollid='$enrollid'");  
return $q->result_array();    
}

}
?>