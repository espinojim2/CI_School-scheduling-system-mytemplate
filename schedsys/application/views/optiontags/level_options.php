<?php
$r=$this->mainmodel->level_list();
$str="";
for($x=0;$x<count($r);$x++){
$id=$r[$x]['lvlid'];
$code=$r[$x]['lvlcode'];
$name=$r[$x]['lvlname'];
$str.="<option value='$id'>$code - $name</option>";	
}
echo $str;
?>