<?php
$accountTypeId=$_POST['accountTypeId'];
$acctype=$this->mainmodel->getAccountType_Data($accountTypeId);
$str="";
if($acctype[0]['accntclass']!='ST')
{
$q=$this->db->query("select * from sys_p_person where 1 order by lname");
$r1=$q->result_array();
for($x=0;$x<count($r1);$x++)
{
$pid=$r1[$x]['pid'];
$name=ucwords($r1[$x]['lname']." ".$r1[$x]['ename'].", ".$r1[$x]['fname']." ".$r1[$x]['mname']);	
$str.="<option value='$pid'>$name</option>";	
}

}
else
{
$q=$this->db->query("select * from sys_p_person whered  pid in(select pid from sys_s_student where remark='1') order by lname order by lname");
$r1=$q->result_array();
for($x=0;$x<count($r1);$x++)
{
$pid=$r1[$x]['pid'];
$name=ucwords($r1[$x]['lname']." ".$r1[$x]['ename'].", ".$r1[$x]['fname']." ".$r1[$x]['mname']);	
$str.="<option value='$pid'>$name</option>";	
}
}

echo $str;

?>