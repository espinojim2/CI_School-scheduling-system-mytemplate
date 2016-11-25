<?php
$syid=$_POST['syid'];
$lvlid=$_POST['lvlid'];
$sectid=$_POST['sectid'];
$pid=$_POST['pid'];
$mode=$_POST['mode'];
$enrollid=$_POST['enrollid'];
$stat=$_POST['stat'];
$sql=""; $msg="";
if($mode=='add')
{
$q=$this->db->query("select * from sys_s_registration where syid='$syid' and pid='$pid'");	
if($q->num_rows()==0)
{
$enrollid=$this->mainmodel->getMaxId("sys_s_registration","enrollid")+1;	
$sql.="insert into sys_s_registration values('$enrollid','$syid','$lvlid','$sectid','$pid','1');";
}
else
{
$msg="This Student is Already Enrolled before, Check the table ";	
//$sql.="update sys_s_registration set remark='$stat',lvlid='$lvlid',sectid='$sectid' where syid='$syid' and pid='$pid';";
}

}
if($mode=='edit')
{
$sql.="update sys_s_registration set remark='$stat',lvlid='$lvlid',sectid='$sectid' where enrollid='$enrollid';";	
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

echo json_encode($a);
?>