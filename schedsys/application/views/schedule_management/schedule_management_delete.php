<?php
$schedid=$_POST['schedid'];
$sql="update sys_schedule set remark='0' where schedid='$schedid';";

$this->db->query("begin;");
$e=explode(";",$sql); $b=true;
for($x=0;$x<count($e)-1;$x++)
{
$q3=$this->db->query($e[$x]);	
$b=$b && $q3;
}
if($b){ $this->db->query("commit;"); }else{ $this->db->query("rollback;"); }

?>