<?php
$syid=(isset($_POST['syid']))?$_POST['syid']:"";
$pid=(isset($_POST['pid']))?$_POST['pid']:"";
$lvlid=(isset($_POST['lvlid']))?$_POST['lvlid']:"";
$sectid=(isset($_POST['sectid']))?$_POST['sectid']:"";
$roomid=(isset($_POST['roomid']))?$_POST['roomid']:"";
$day=$_POST['day'];
$stime=$_POST['stime'];
$etime=$_POST['etime'];

$stotmin=getMinutes($stime);
$etotmin=getMinutes($etime);
$msg=""; $sql="";

if($syid==""){ $msg="Invalid! No School Year Found"; }
else if($pid==""){ $msg="Invalid! No Personnels Found"; }
else if($lvlid==""){ $msg="Invalid! No Level Found"; }
else if($sectid==""){ $msg="Invalid! No Section Found";}
else if($roomid==""){ $msg="Invalid! No Room Found"; }
else if($stotmin==$etotmin){ $msg="Invalid! Start time must not be equal to Ending time"; }
else if($stotmin>$etotmin){ $msg="Invalid! Start time must be greater than ending time"; }




$q=$this->db->query("select * from sys_schedule where syid='$syid' and  remark='1'");



$r=$q->result_array();
for($x=0;$x<count($r);$x++)
{
$s_pid=$r[$x]['pid'];
$s_lvlid=$r[$x]['lvlid'];
$s_sectid=$r[$x]['sectid'];
$s_roomid=$r[$x]['roomid'];
$s_day=$r[$x]['day'];
$s_stime=$r[$x]['stime'];
$s_etime=$r[$x]['etime'];

$s_stotmin=getMinutes($s_stime);
$s_etotmin=getMinutes($s_etime);

if($s_lvlid==$lvlid && $s_sectid==$sectid && $s_roomid==$roomid && $s_day==$day && ($stotmin < $s_stotmin && $etotmin > $s_stotmin && $etotmin==$s_etotmin))
{
$msg="Invalid! This Schedule might cause Conflicts";
}
else if($s_lvlid==$lvlid && $s_sectid==$sectid && $s_roomid==$roomid && $s_day==$day && ($stotmin > $s_stotmin && $stotmin > $s_etotmin && $etotmin > $s_etotmin))
{
$msg="Invalid! This Schedule might cause Conflicts";
}
else if($s_lvlid==$lvlid && $s_sectid==$sectid && $s_roomid==$roomid && $s_day==$day && ($stotmin < $s_stotmin && $etotmin > $s_etotmin))
{
$msg="Invalid! This Schedule might cause Conflicts";
}
else if($s_lvlid==$lvlid && $s_sectid==$sectid && $s_roomid==$roomid && $s_day==$day && ($stotmin > $s_stotmin && $etotmin < $s_etotmin))
{
$msg="Invalid! This Schedule might cause Conflicts";
}
else if($s_lvlid==$lvlid && $s_sectid==$sectid && $s_roomid==$roomid && $s_day==$day && ($stotmin==$s_stotmin && $etotmin < $s_etotmin))
{
$msg="Invalid! This Schedule might cause Conflicts";
}
else if($s_lvlid==$lvlid && $s_sectid==$sectid && $s_roomid==$roomid && $s_day==$day && ($stotmin < $s_stotmin && $etotmin == $s_etotmin))
{
$msg="Invalid! This Schedule might cause Conflicts";
}
else if($s_lvlid==$lvlid && $s_sectid==$sectid && $s_roomid==$roomid && $s_day==$day && ($stotmin > $s_stotmin && $etotmin==$s_etotmin))
{
$msg="Invalid! This Schedule might cause Conflicts";
}
else if($s_lvlid==$lvlid && $s_sectid==$sectid && $s_roomid==$roomid && $s_day==$day && ($stotmin==$s_stotmin && $etotmin>$s_etotmin))
{
$msg="Invalid! This Schedule might cause Conflicts";
}
else if($s_lvlid==$lvlid && $s_sectid==$sectid && $s_roomid==$roomid && $s_day==$day && ($stotmin==$s_stotmin && $etotmin==$s_etotmin))
{
$msg="Invalid! This Schedule might cause Conflicts";
}


}


$q1=$this->db->query("select * from sys_schedule where pid='$pid' and lvlid='$lvlid' and sectid='$sectid' and roomid='$roomid' and day='$day' and stime='$stime' and etime='$etime' and remark='1'");
if($q1->num_rows()==0)
{
$schedid=$this->mainmodel->getMaxId("sys_schedule","schedid")+1;	
$sql.="insert into sys_schedule values('$schedid','$syid','$pid','$lvlid','$sectid','$roomid','$day','$stime','$etime','1');";
}
else{
$msg="This schedule already exists";	
}	


if($msg=="")
{
$this->db->query("begin;");
$e=explode(";",$sql); $b=true;
for($x=0;$x<count($e)-1;$x++)
{
$q3=$this->db->query($e[$x]);	
$b=$b && $q3;
}
if($b){ $this->db->query("commit;"); }else{ $this->db->query("rollback;"); }
}


$a['msg']=$msg;
echo json_encode($a);

function getMinutes($militime)
{
$e1=explode(":",$militime);
$sminutes=($e1[0]*60)+$e1[1];
return $sminutes;
}

?>