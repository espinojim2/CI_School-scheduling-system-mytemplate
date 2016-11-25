<?php
$fname=mysql_real_escape_string($_POST['fname']);
$mname=mysql_real_escape_string($_POST['mname']);
$lname=mysql_real_escape_string($_POST['lname']);
$ename=mysql_real_escape_string($_POST['ename']);
$gender=$_POST['gender'];
$bdate=$_POST['bdate'];

$student_id=$_POST['student_id'];

$bplace=mysql_real_escape_string($_POST['bplace']); 
$email=mysql_real_escape_string($_POST['email']);
$contact=mysql_real_escape_string($_POST['contact']);
$status=$_POST['status'];
$mode=$_POST['mode'];
$pid=$_POST['pid'];
$msg="";
$imgid="0";
$ex1=""; $ex2=""; $ex3=""; $ex4=""; $ex5=""; $ex6="";
$pat1="/^[0-9]+$/"; $pat2="/^\D+$/"; $pat3="/^[a-zA-Z0-9]$/"; $c=0;
$msg=""; $sql="";

if(!preg_match($pat2,$fname)){ $msg="Invalid First name";  $ex1="1"; }
else if(preg_match($pat1,$mname)){ $msg="Invalid Middle name";  $ex2="1"; }
else if(!preg_match($pat2,$lname)){ $msg="Invalid Last name";  $ex3="1"; }
else if(preg_match($pat1,$ename)){ $msg="Invalid Suffix";  $ex4="1"; }
else if(preg_match($pat1,$bplace)){ $msg="Invalid Birth place"; $ex5="1"; }
else if(trim($student_id)==""){ $msg="Invalid Student ID"; $ex6="1"; }
$sql="";

$yoe=date("Y");
$code=$this->mainmodel->numformat(6,$this->mainmodel->getMaxVal("sys_s_student","count","where yoe='$yoe'")+1);

if($mode=='add')
 {
 $qq1=$this->db->query("select * from sys_p_person where fname like '$fname' and lname like '$lname' and mname like '$mname' and ename like '$ename' and gender='$gender' ");
if($qq1->num_rows()>0){ $msg="Invalid! Personnel already Exists "; }

$q=$this->db->query("select * from sys_p_person where fname like '$fname' and lname like '$lname' and mname like '$mname' and ename like '$ename' and gender='$gender'");
if($q->num_rows()==0)
{
$pid=$this->mainmodel->getMaxId("sys_p_person","pid")+1;
$sql.="insert into  sys_p_person values('$pid','$fname','$mname','$lname','$ename','$gender','$bdate','$bplace','$imgid','$email','','1');";
}
else
{
$r=$q->result_array(); $pid=$r[0]['pid'];	
$sql.="update sys_p_person set remark='1',bdate='$bdate',bplace='$bplace',imgId='$imgid',email='$email',contact='' where pid='$pid';";	
}

$q3=$this->db->query("select * from sys_s_student where student_id='$student_id' and not pid='$pid'");
if($q3->num_rows()>0){ $msg="Student Id Already Exists"; $ex6="1"; }

$q2=$this->db->query("select * from sys_s_student where pid='$pid'");
if($q2->num_rows()==0)
{
$sql.="insert into sys_s_student values('$pid','$student_id','$yoe','$code','1');";	
}
else
{
$msg="This Student Already Exists";	
}


$username=strtolower($fname."".$mname."".$lname);	
$q4=$this->db->query("select * from sys_p_account where username='$username' and accountTypeId='5' and pid='$pid'");	
if($q4->num_rows()==0)
{

$pass=md5("$lname");	
$accountId=$this->mainmodel->getMaxId("sys_p_account","accountId")+1;	
$sql.="insert into sys_p_account values('$accountId','$pid','5','$username','$pass','1','1');";	
$sql.="insert into sys_user_passwords values('$accountId','$lname');";

}
else
{
	
}

}

if($mode=='edit')
{
$sql.="update sys_p_person set fname='$fname',mname='$mname',lname='$lname',ename='$ename',bdate='$bdate',bplace='$bplace',contact='$contact',imgId='$imgid',email='$email',remark='$status' where pid='$pid';";

$q3=$this->db->query("select * from sys_s_student where student_id='$student_id' and not pid='$pid'");
if($q3->num_rows()>0){ $msg="Student Id Already Exists"; $ex6="1"; }

$sql.="update sys_s_student set student_id='$student_id',remark='$status' where $pid='$pid';";
$pass=md5("$lname");	
$password=$lname;
$username=strtolower($fname."".$mname."".$lname);	
$q4=$this->db->query("select * from sys_p_account where username='$username' and accountTypeId='5' and pid='$pid'");	
if($q4->num_rows()==0)
{


$accountId=$this->mainmodel->getMaxId("sys_p_account","accountId")+1;	
$sql.="insert into sys_p_account values('$accountId','$pid','5','$username','$pass','1','1');";	
$sql.="insert into sys_user_passwords values('$accountId','$lname');";

}
else
{
$r=$q4->result_array();
$accountId=$r[0]['accountId'];	
$sql.="update sys_p_account set username='$username',password='$pass',active='1' where accountId='$accountId';";	
$sql.="update sys_user_passwords set password='$password' where accountId='$accountId';";
}



}


if($msg=="")
{

$e1=explode(";",$sql); $b=true;
$this->db->query("begin;");
for($y=0;$y<count($e1)-1;$y++)
{
$q1=$this->db->query($e1[$y]);
$b=$b && $q1;
}
if($q1){ $this->db->query("commit;");  }else{ $this->db->query("rollback;");  }	



}


$a['ex1']=$ex1;
$a['ex2']=$ex2;
$a['ex3']=$ex3;
$a['ex4']=$ex4;
$a['ex5']=$ex5;
$a['msg']=$msg;
echo json_encode($a);



?>