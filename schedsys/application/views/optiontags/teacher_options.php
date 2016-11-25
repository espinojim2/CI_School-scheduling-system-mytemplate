<?php
$str="";
$q=$this->db->query("select * from sys_p_person where 1 and pid in(select pid from sys_schedule where remark='1') order by lname");
$r1=$q->result_array();
for($x=0;$x<count($r1);$x++)
{
$pid=$r1[$x]['pid'];
$name=ucwords($r1[$x]['lname']." ".$r1[$x]['ename'].", ".$r1[$x]['fname']." ".$r1[$x]['mname']);	
$str.="<option value='$pid'>$name</option>";	
}

echo $str;
?>