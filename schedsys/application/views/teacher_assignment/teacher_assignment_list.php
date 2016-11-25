<?php
$syid=$_POST['syid'];
$teachtype=$_POST['teachtype']; /*0=unassigned 1=assigned*/
$sql=""; $btn="";
if($teachtype=='0')
{
$btn="Assign";	
$sql="select * from sys_p_person where remark='1' and not pid in(select pid from sys_teacher_assign where isteacher='1' and syid='$syid' and remark='1') and not pid in(select pid from sys_s_student)";	
}
else if($teachtype=='1')
{
$btn="Unassign";	
$sql="select * from sys_p_person where remark='1' and  pid in(select pid from sys_teacher_assign where isteacher='1' and syid='$syid' and remark='1') and not pid in(select pid from sys_s_student)";		
}
$q=$this->db->query($sql);
$r=$q->result_array();
$str="
<div style='margin-top:2%; width:100%; height:50px;'>
<button class='btn btn-primary'  style='float:right;' onclick='SYS_teacherTransfer()'><span class='glyphicon glyphicon-transfer'></span>$btn</button>
</div>
<table class='table table-bordered table-condensed table-striped table-hover' style=' font-size:13px;'>
<thead>
<th style='width:30px;'></th>
<th>Personnel Name</th>
</thead><tbody>
";

for($x=0;$x<count($r);$x++)
{
$pid=$r[$x]['pid'];
$name=ucwords($r[$x]['lname']." ".$r[$x]['ename'].", ".$r[$x]['fname']." ".$r[$x]['mname']);
$str.="
<tr>
<td><input type='checkbox' class='personchk' id='personchk$x' value='$pid'></td>
<td>$name</td>
</tr>
";

}
if(count($r)==0)
{
$str.="<tr><td colspan='2'>No results Found</td></tr>";	
}
$str.="</tbody></table>
<div style='margin-top:2%; width:100%; height:50px;'>
<button class='btn btn-primary'  style='float:right;' onclick='SYS_teacherTransfer()'><span class='glyphicon glyphicon-transfer'></span>$btn</button>
</div>
<input type='hidden' id='personcnt' value='".count($r)."'>
";
echo $str;
?>