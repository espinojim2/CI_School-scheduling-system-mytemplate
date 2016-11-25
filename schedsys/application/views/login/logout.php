<?php
unset($_SESSION['id']);
$session_id=$this->session->userdata('session_id');
$date=date("Y-m-d h:i:s");

$this->session->unset_userdata('pid');
$this->session->unset_userdata('accountId');

$res=false;
if(!isset($_SESSION['id'])){
$res=true;	
}
$a['res']=$res;
echo json_encode($a);
?>