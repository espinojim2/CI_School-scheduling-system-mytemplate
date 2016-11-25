<?php
$mode=$_POST['mode'];
$lvlid=$_POST['lvlid'];

$lvlcode=mysql_real_escape_string($_POST['lvlcode']); 
$lvlname=mysql_real_escape_string($_POST['lvlname']);
$seq=$_POST['seq'];
$status=$_POST['status'];

$sql=""; $msg=""; $ex1=""; $ex2=""; $ex3="";
if(trim($lvlcode)==""){ $msg="Invalid Level Code"; $ex1='1'; $ex2=''; $ex3='';}
else if(trim($lvlname)==""){ $msg="Invalid Level Name"; $ex2='1'; $ex1=''; $ex3=''; }
else if(trim($seq)==""){ $msg="Invalid Sequence No."; $ex3='1'; $ex2=''; $ex1='';}

if($mode=='add')
{
$q1=$this->db->query("select * from sys_levels where lvlcode='$lvlcode'");
if($q1->num_rows()>0){ $msg="Level Code Already Exists,Try another one"; $ex1="1"; }


$q=$this->db->query("select * from sys_levels where lvlcode='$lvlcode' and lvlname like '$lvlname'");	
if($q->num_rows()==0)
{
$lvlid=$this->mainmodel->getMaxId("sys_levels","lvlid")+1;	
$sql.="insert into sys_levels values('$lvlid','$lvlcode','$lvlname','$seq','1');";	
}
else
{
$msg="This Level Already Exists"; $ex1="1"; $ex2="1";	
}
}
if($mode=='edit')
{
$q1=$this->db->query("select * from sys_levels where lvlcode='$lvlcode' and not lvlid='$lvlid'");
if($q1->num_rows()>0){ $msg="Level Code Already Exists,Try another one"; $ex1="1"; }	
$sql.="update sys_levels set lvlcode='$lvlcode',lvlname='$lvlname',seq='$seq',remark='$status' where lvlid='$lvlid';";	
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
