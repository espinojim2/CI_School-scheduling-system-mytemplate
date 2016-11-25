<?php
$syid=(isset($_POST['syid']))?$_POST['syid']:"";
$pid=(empty($_POST['pid']))?array():$_POST['pid'];
$ischk=(empty($_POST['ischk']))?array():$_POST['ischk'];
$teachtype=$_POST['teachtype'];
$sql=""; $msg="";
if(count($pid)==0){
$msg="Theres Nothing to save";	
}
else if($syid==""){ $msg="No School Year Found"; }
for($x=0;$x<count($pid);$x++)
{
$chk="";
if($teachtype=='0')
{
$chk=($ischk[$x]==0)?"0":"1";	
}
else if($teachtype=='1')
{
$chk=($ischk[$x]==0)?"1":"0";	
}

$q=$this->db->query("select * from sys_teacher_assign where pid='$pid[$x]' and syid='$syid'");	
if($q->num_rows()==0)
{	
$sql.="insert into sys_teacher_assign values('$pid[$x]','$syid','$chk','1');";	
}
else
{
$sql.="update sys_teacher_assign set isteacher='$chk' where pid='$pid[$x]' and syid='$syid';";	
}

}














if($msg==""){
$this->db->query("begin");
$e=explode(";",$sql); $b=true;
for($y=0;$y<count($e)-1;$y++)
{
$q1=$this->db->query($e[$y]);
$b=$b && $q1;
}
if($b){ $this->db->query("commit;"); }else{ $this->db->query("rollback;"); } 

}



$a['msg']=$msg;
echo json_encode($a);
?>