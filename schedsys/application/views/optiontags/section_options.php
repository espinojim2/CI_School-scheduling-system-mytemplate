<?php
$lvlid=$_POST['lvlid'];
$r=$this->mainmodel->section_list($lvlid);
$str="";
for($x=0;$x<count($r);$x++){
$id=$r[$x]['sectid'];
$name=$r[$x]['sectname'];
$str.="<option value='$id'>$name</option>";	
}
echo $str;
?>