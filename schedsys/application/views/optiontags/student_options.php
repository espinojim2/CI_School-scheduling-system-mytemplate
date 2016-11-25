<?php
$q=$this->db->query("select * from sys_p_person where remark='1' and pid in(select pid from sys_s_student where remark='1')");
$r=$q->result_array();
$str="";
for($x=0;$x<count($r);$x++)
{
$pid=$r[$x]['pid'];	
$name=ucwords($r[$x]['lname']." ".$r[$x]['ename'].", ".$r[$x]['fname']." ".$r[$x]['mname']);
$str.="<option value='$pid'>$name</option>";	
}

echo $str;
?>