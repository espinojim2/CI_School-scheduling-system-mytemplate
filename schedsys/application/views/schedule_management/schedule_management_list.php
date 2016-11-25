<?php
$syid=(isset($_POST['syid']))?$_POST['syid']:"";
$lvlid=(isset($_POST['lvlid']))?$_POST['lvlid']:"";
$sectid=(isset($_POST['sectid']))?$_POST['sectid']:"";
$roomid=(isset($_POST['roomid']))?$_POST['roomid']:"";
$day=(isset($_POST['day']))?$_POST['day']:"";

$srch="";
$srch.=($syid=="")?"":" and syid='$syid'";
$srch.=($lvlid=="")?"":" and lvlid='$lvlid'";
$srch.=($sectid=="")?"":" and sectid='$sectid'";
$srch.=($roomid=="")?"":" and roomid='$roomid'";
$srch.=($day=="")?"":" and day='$day'";



$sql="select * from sys_schedule where remark='1' $srch order by stime,etime";
$q=$this->db->query($sql);
$r=$q->result_array();
$str="";
for($x=0;$x<count($r);$x++)
{
$schedid=$r[$x]['schedid'];	
$e1=explode(":",$r[$x]['stime']);
$e2=explode(":",$r[$x]['etime']);
$stime=$this->mainmodel->numformat(2,$e1[0]).":".$this->mainmodel->numformat(2,$e1[1]);
$etime=$this->mainmodel->numformat(2,$e2[0]).":".$this->mainmodel->numformat(2,$e2[1]);
$rday=ucwords($r[$x]['day']);
$lvl=$this->mainmodel->level_data($r[$x]['lvlid']);
$sect=$this->mainmodel->section_data($r[$x]['sectid']);
$level=$lvl[0]['lvlname'];
$sectioncode=$sect[0]['sectcode'];
$section=$sect[0]['sectname'];
$rm=$this->mainmodel->room_data($r[$x]['roomid']);
$roomname=$rm[0]['roomname'];
$person=$this->mainmodel->person_data($r[$x]['pid']);
$name=ucwords($person[0]['lname']." ".$person[0]['ename'].", ".$person[0]['fname']." ".$person[0]['mname']);


$str.="
<tr>
<td>$stime - $etime</td>
<td>$rday</td>
<td>$level</td>
<td>$sectioncode - $section</td>
<td>$roomname</td>
<td>$name</td>
<td><button class='btn' style='background:rgba(0,0,0,0);' onclick='SYS_deleteSchedule($schedid)'><span class='glyphicon glyphicon-remove'></span></button></td>
</tr>
";	
}

if(count($r)==0)
{
$str.="
<tr>
<td colspan='7'>No results found</td>
</tr>
";	
}
echo $str;
?>