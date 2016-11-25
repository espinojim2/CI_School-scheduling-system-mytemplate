
<div style='padding:2%;'>
<div style='width:100%; margin-bottom:2%; background:rgb(102,0,102)'>
<button class='btn btn-primary' style='background:rgb(102,0,102);' onclick='SYS_addUserAccount()'><span class='glyphicon glyphicon-plus'></span> Add User Account</button></div>
<table id="table_idd" class="table table-striped table-hover table-bordered table-condensed" cellspacing="0" width="100%">
  <thead>
            <tr>
                <th style='width:5px;'>&nbsp;</th>
                <th style='width:200px;'>Name</th>
                <th style='width:100px;'>User Type</th>
                <th style='width:50px;'>Username</th>
                <th>Status</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody></tbody>      
    </table>


</div>
<div id='dialog1'></div>






<script type="text/javascript">

$(document).ready(function(){
  setUserAcctTable();
 $('#dialog1').jseDialog({
autoOpen:false,
},function(){   $("#wrapper").toggleClass("toggled"); });     
});
/*********************************/


function setUserAcctTable(){
SYS_TableStart('#table_idd'); 
$.post(URL+"index.php/main/loadUserAccountList").done(function(data){ 
$('#table_idd tbody').html(data);
SYS_TablefirstInstance('#table_idd');    
});
}


function SYS_addUserAccount(){
$.post(URL+"index.php/main/loadAddUserAccountForm",{mode:"add",accountId:""}).done(function(data){
$('#dialog1').html(data);
$("#wrapper").toggleClass("toggled"); 
$('#dialog1').jseDialog('open');
 
});
}


function SYS_editUserAccount(accountId){
$.post(URL+"index.php/main/loadAddUserAccountForm",{mode:"edit",accountId:accountId}).done(function(data){ 
$('#dialog1').html(data);
$("#wrapper").toggleClass("toggled"); 
$('#dialog1').jseDialog('open');
 
});
}

</script>