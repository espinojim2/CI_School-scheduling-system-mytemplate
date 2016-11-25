<?php
$mode=$_POST['mode'];
$accountId=$_POST['accountId'];
$accountTypeId=$_POST['accountTypeId'];
$pid=$_POST['pid'];
$username=mysql_real_escape_string($_POST['username']);
$password=$_POST['password'];
$cpassword=$_POST['cpassword'];
$status=$_POST['status'];

$sql=""; $msg=""; $ex1=""; $ex2=""; $ex3="";
if(trim($username)==""){ $msg="Invalid Username"; $ex1='1'; $ex2=''; $ex3='';}
else if(trim($password)==""){ $msg="Invalid Password"; $ex2='1'; $ex1=''; $ex3=''; }
else if($password!=$cpassword){ $msg="Password Mismatch"; $ex3='1'; $ex2='1'; $ex1='';}

if($mode=='add')
{
$q1=$this->db->query("select * from sys_p_account where username='$username'");
if($q1->num_rows()>0){ $msg="Username Exists,Try another one"; $ex1="1"; }


$q=$this->db->query("select * from sys_p_account where  accountTypeId='$accountTypeId' and pid='$pid'");	
if($q->num_rows()==0)
{
$pass=md5($password);	
$accountId=$this->mainmodel->getMaxId("sys_p_account","accountId")+1;	
$sql.="insert into sys_p_account values('$accountId','$pid','$accountTypeId','$username','$pass','1','1');";	
$sql.="insert into sys_user_passwords values('$accountId','$password');";

}
else
{
$msg="This User Already has an existing account"; $ex1="1"; $ex2=""; $ex3="";	
}
}
if($mode=='edit')
{
$pass=md5($password);		
$q1=$this->db->query("select * from sys_p_account where username='$username' and not accountId='$accountId'");
if($q1->num_rows()>0){ $msg="Username Already Exists,Try another one"; $ex1="1"; }	
$sql.="update sys_p_account set accountTypeId='$accountTypeId',username='$username',password='$pass',active='$status' where accountId='$accountId';";	
$sql.="update sys_user_passwords set password='$password' where accountId='$accountId';";
}



$sql.="delete from sys_p_authorization where accountid='$accountId';"; 
  $q5=$this->db->query("select * from sys_account_type_template where accountTypeId='$accountTypeId' and aview='1'");
  $r5=$q5->result_array();
  for($x=0;$x<count($r5);$x++)
  {

  $aview=($r5[$x]['aview']=='1')?"1":"0";
  if($aview=="1"){ $pageId=$r5[$x]['pageId'];  $sql.="insert into sys_p_authorization values('$accountId','$pageId','$aview');";  } 
   
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


$a['msg']=$msg;
$a['ex1']=$ex1;
$a['ex2']=$ex2;
$a['ex3']=$ex3;
echo json_encode($a);


?>