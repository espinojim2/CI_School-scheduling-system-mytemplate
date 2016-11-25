<?php
$mode=$_POST['mode'];
$roomid=$_POST['roomid'];

$roomcode=mysql_real_escape_string($_POST['roomcode']); 
$roomname=mysql_real_escape_string($_POST['roomname']);
$status=$_POST['status'];

$sql=""; $msg=""; $ex1=""; $ex2="";
if(trim($roomcode)==""){ $msg="Invalid Room Code"; $ex1='1'; $ex2='';}
else if(trim($roomname)==""){ $msg="Invalid Room Name"; $ex2='1'; $ex1=''; }


if($mode=='add')
{

$q=$this->db->query("select * from sys_rooms where roomcode='$roomcode' and roomname like '$roomname'");	
if($q->num_rows()==0)
{
$roomid=$this->mainmodel->getMaxId("sys_rooms","roomid")+1;	
$sql.="insert into sys_rooms values('$roomid','$roomcode','$roomname','1');";	
}
else
{
$msg="This Room Already Exists"; $ex1="1"; $ex2="1";	
}
}
if($mode=='edit')
{
$sql.="update sys_rooms set roomcode='$roomcode',roomname='$roomname',remark='$status' where roomid='$roomid';";	
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
