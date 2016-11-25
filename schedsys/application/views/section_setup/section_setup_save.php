<?php
$mode=$_POST['mode'];
$sectid=$_POST['sectid'];

$lvlid=$_POST['lvlid'];
$sectcode=mysql_real_escape_string($_POST['sectcode']); 
$sectname=mysql_real_escape_string($_POST['sectname']);
$sectdesc=mysql_real_escape_string($_POST['sectdesc']);
$seq=$_POST['seq'];
$status=$_POST['status'];

$sql=""; $msg=""; $ex1=""; $ex2=""; $ex3="";
if(trim($sectcode)==""){ $msg="Invalid Section Code"; $ex1='1'; $ex2=''; $ex3='';}
else if(trim($sectname)==""){ $msg="Invalid Section Name"; $ex2='1'; $ex1=''; $ex3=''; }
else if(trim($seq)==""){ $msg="Invalid Sequence No."; $ex3='1'; $ex2=''; $ex1='';}

if($mode=='add')
{
$q1=$this->db->query("select * from sys_sections where lvlid='$lvlid' and sectcode='$sectcode'");
if($q1->num_rows()>0){ $msg="Section Code Already Exists in this Level,Try another one"; $ex1="1"; }

$q=$this->db->query("select * from sys_sections where sectcode='$sectcode' and sectname like '$sectname' and lvlid='$lvlid'");	
if($q->num_rows()==0)
{
$sectid=$this->mainmodel->getMaxId("sys_sections","sectid")+1;	
$sql.="insert into sys_sections values('$sectid','$lvlid','$sectcode','$sectname','$sectdesc','$seq','1');";	
}
else
{
$msg="This Section Already Exists"; $ex1="1"; $ex2="1";	
}
}
if($mode=='edit')
{
$q1=$this->db->query("select * from sys_sections where lvlid='$lvlid' and sectcode='$sectcode' and not sectid='$sectid'");
if($q1->num_rows()>0){ $msg="Level Code Already Exists,Try another one"; $ex1="1"; }	
$sql.="update sys_sections set sectcode='$sectcode',sectname='$sectname',sectdesc='$sectdesc',seq='$seq',remark='$status' where sectid='$sectid';";	
}


if($msg=="")
{

$e1=explode(";",$sql); $b=true;

$this->db->query("begin;");
for($y=0;$y<count($e1)-1;$y++)
{
$q2=$this->db->query($e1[$y]);
$b=$b && $q2;
}
if($q2){ $this->db->query("commit;");  }else{ $this->db->query("rollback;");  }	

}


$a['msg']=$msg;
$a['ex1']=$ex1;
$a['ex2']=$ex2;
$a['ex3']=$ex3;
echo json_encode($a);
?>
