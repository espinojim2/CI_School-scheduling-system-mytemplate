<?php
$pid=$_POST['pid'];
$syid=$_POST['syid'];
$str="";
$q=$this->db->query("select * from sys_s_registration where syid='$syid' and pid='$pid'");
$r=$q->result_array();
for($x=0;$x<count($r);$x++)
{
$lvlid=$r[0]['lvlid'];
$lvl=$this->mainmodel->level_data($lvlid);
$name=$lvl[0]['lvlname'];	
$str="<option value='$lvlid'>$name</option>";	
}

echo $str;

?>