<?php
$r=$this->mainmodel->room_list();
$str="";
for($x=0;$x<count($r);$x++){
$id=$r[$x]['roomid'];
$code=$r[$x]['roomcode'];
$name=$r[$x]['roomname'];
$str.="<option value='$id'>$code - $name</option>";	
}
echo $str;
?>