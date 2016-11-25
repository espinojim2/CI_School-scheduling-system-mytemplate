<?php
$str="";
$r=$this->mainmodel->syear_list();
for($x=0;$x<count($r);$x++){
$id=$r[$x]['syid'];
$e=explode("-",$r[$x]['strt']);
$e1=explode("-",$r[$x]['end']);
$strt=$e[0]." - ".$e1[0];
$str.="<option value='$id'>$strt</option>";	
}
echo $str;


?>