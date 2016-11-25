<?php
$mode=$_POST['mode'];
$accountId=$_POST['accountId'];

$acct=$this->mainmodel->useraccount_data($accountId);
$acctpass=$this->mainmodel->useraccount_password_data($accountId);
$pid=($mode=='add')?"":$acct[0]['pid'];
$accountTypeId=($mode=='add')?"":$acct[0]['accountTypeId'];
$username=($mode=='add')?"":$acct[0]['username'];
$status=($mode=='add')?"":$acct[0]['active'];
$password="";
if(isset($acctpass[0]['password']))
{
$password=($mode=='add')?"":$acctpass[0]['password'];	
}


?>
<script type="text/javascript">
$(document).ready(function(){
$('#status').val($('#formstat').val());	
SYS_setUserByUserType();
$('#accountTypeId').val($('#accountTypeId2').val());
});

function SYS_setUserByUserType()
{
var accountTypeId=$('#accountTypeId').val();
$.post(URL+"index.php/main/loadUserByUserTypeOptions",{accountTypeId:accountTypeId}).done(function(data){
$('#form_pid').html(data);

$('#form_pid').val($('#pid2').val());
});
}
</script>
<input type='hidden' id='pid2' value="<?= $pid; ?>">
<input type='hidden' id='accountTypeId2' value="<?= $accountTypeId; ?>">
<div id='msg' style='margin-top:2%;'></div>
<div style='width:100%; padding:2%;' align='center'>
<div style='width:50%;'>
<div class='row' style='margin-bottom:2%;'>

<div class='col-sm-4'><label>UserType</label></div>
<div class='col-sm-8'><select class='form-control' onchange='SYS_setUserByUserType()' id='accountTypeId' ><?= $this->load->view("optiontags/personnel_usertype_options"); ?></select></div>
</div>
<?php
$ut=($mode=='add')?"":"disabled";
?>	
<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>User</label></div>
<div class='col-sm-8'><select class='form-control' id='form_pid' <?= $ut; ?>></select></div>
</div>
<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>Username</label></div>
<div class='col-sm-8'><input type='text' class='form-control' id='username' value="<?= $username; ?>"></div>
</div>
<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>Password</label></div>
<div class='col-sm-8'><input type='password' class='form-control' id='password' value="<?= $password; ?>"></div>
</div>
<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>Confirm Password</label></div>
<div class='col-sm-8'><input type='password' class='form-control' id='cpassword' value="<?= $password; ?>"></div>
</div>
<?php 
$st=($mode=='add')?"display:none;":"";
?>
<div class='row' style='margin-bottom:2%; <?= $st; ?>'>
<div class='col-sm-4'><label>Status</label></div>
<div class='col-sm-8'><select class='form-control' id='status'><option value='1'>Available</option><option value='0'>No Available</option></select></div>
</div>


<div class='row'>
<div class='col-sm-4'></div>	
<div class='col-sm-8'><button class='btn btn-primary form-control' onclick='SYS_saveUserAccount()'>Save</button></div>
</div>
</div>

</div>
<input type='hidden' id='formmode' value="<?= $mode; ?>" >
<input type='hidden' id='formaccountId' value="<?= $accountId; ?>" >
<input type='hidden' id='formstat' value="<?= $status; ?>" >
<script type="text/javascript">


</script>