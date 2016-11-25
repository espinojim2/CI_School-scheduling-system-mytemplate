<?php


$usr=mysql_real_escape_string($_POST['usr']); $pass=$_POST['pass'];
$passMD5=(trim($pass)=="")?"":md5($pass);
$q=$this->db->query("select * from sys_p_account where username='$usr' and password='$passMD5' and pid in(select pid from sys_p_person where remark='1') and active='1' and accountStatus='1'");
 $rnum=$q->num_rows();
$bool=false;

$r=$q->result_array();

if($rnum > 0 && trim($r[0]['username'])==trim($usr)){

$_SESSION['id']=$r[0]['pid']; /*Person ID*/
$_SESSION['accountId']=$r[0]['accountId'];

$data=array('accountId' => $_SESSION['accountId'],'pid' => $r[0]['pid'] );
$this->session->set_userdata($data);
$pid=$this->session->userdata('pid');
$accountId=$this->session->userdata('accountId');
$ip=$this->session->userdata('ip_address');
$datelogin=date("Y-m-d h:i:s");
$session_id=$this->session->userdata('session_id');

$m="";
/*load link to homepage*/
 $bool=true;      
}
else if(trim($usr)!="" && trim($pass)!="" && $rnum == 0)
{
            $mssg = 'Username and Password didn\'t matched. Please try again.';
             $m=$mssg;
}
else if(trim($usr)!="" && trim($pass)!="" && trim($r[0]['username'])!=trim($usr) && $rnum > 0) /*to avoid sql injection*/
{
            $mssg = 'Username and Password didn\'t matched. Please try again.';
         $m=$mssg;  
}
else
{
            $mssg = 'Username and Password are required. Please try again.';
$m=$mssg;
}
$accountId=$this->session->userdata('accountId');
$a['accountId']=$accountId;
$a['booll']=$bool;
$a['msg']=$m;
echo json_encode($a);
?>