<?php
$mode=$_POST['mode'];
$syid=$_POST['syid'];

$strtdate=$_POST['strtdate']; 
$enddate=$_POST['enddate'];
$status=$_POST['status'];

$sql=""; $msg=""; $ex1=""; $ex2="";
if(trim($strtdate)==""){ $msg="Invalid Start Date"; $ex1='1'; $ex2=''; }
else if(trim($enddate)==""){ $msg="Invalid End Date"; $ex2='1'; $ex1=''; }


if($mode=='add')
{

$q=$this->db->query("select * from sys_schoolyear where strt='$strtdate' and end='$enddate'");	
if($q->num_rows()==0)
{
$syid=$this->mainmodel->getMaxId("sys_schoolyear","syid")+1;	
$sql.="insert into sys_schoolyear values('$syid','$strtdate','$enddate','1');";	
}
else
{
$msg="This School Year Already Exists"; $ex1="1"; $ex2="1";	
}
}
if($mode=='edit')
{
$sql.="update sys_schoolyear set strt='$strtdate',end='$enddate',remark='$status' where syid='$syid';";	
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
echo json_encode($a);
?>
