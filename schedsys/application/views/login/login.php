
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $title; ?></title>
    <?php echo $extraHeadContent; ?>
</head>
<body>
<input type='hidden' id='URL' value="<?= base_url(); ?>">
<script type="text/javascript">
var URL=$('#URL').val();
</script>
<div id='headerwrap' style='height:200px; padding:1%;'>
 <img src="<?php echo base_url(); ?>resources/images/logo.png" style='width:150px;'>   
 <span style='color:#FFF; font-size:30px;'>Scheduling System</span>
</div>
<div style='width:100%; position:absolute; top:200px;' align='center'>
<div style='width:500px; height:auto; padding:1.5%; background:rgba(
102,0,102,0.2); font-family: helvetica, arial, sans-serif;' class='container'>
	<span id='msg'></span>
<input id='usr' type='text' class='form-control' placeholder="Username" style='width:100%; font-size:18px; height:50px;  margin-top:3px; margin-bottom:2%;' >
<input id='pass'type='password' class='form-control' placeholder="Password" style='width:100%; font-size:18px;  height:50px; padding:9px;  margin-bottom:2%;'>
<button class='btn btn-primary form-control' style='background:rgb(102,0,102); height:50px; font-weight:bold;' onclick='loginn()'>Login</button>
</div>
</div>
<div id='loadingDiv' style=' position:fixed; z-index:1000; width:100%; background:rgba(0,0,0,0.1); height:100%; padding:15%; overflow:hidden;' align='center'>
<div class="spinner-loader">
  Loading…
</div>
</div>
</body>
<script type="text/javascript">
var $loading = $('#loadingDiv');
    $(document).ready(function(){ $loading.hide(); });
    $(document).ajaxStart(function () { $loading.show(); }).ajaxStop(function () { $loading.hide(); });

$(document).ready(function(){
 $("#pass,#usr").keydown(function(e){ if(e.keyCode==13){ loginn(); } });     

});
function loginn(){
usr=$('#usr').val();
pass=$('#pass').val();

$.post(URL+"index.php/main/loadLoginProcess",{usr:usr,pass:pass}).done(function(data){
	
n=JSON.parse(data);
accountId=n.accountId;
if(n.msg!=""){ $('#msg').html(validateMsg(n.msg)); }else{ $('#msg').html(""); }   
if(n.booll){  window.location.href=URL+"index.php/main/pages/1/"+accountId;  } 
});

}


Object.defineProperty(console,'_commandLineAPI',{ get:function(){ throw 'Sorry, developer tools are blocked here' }});  
</script>
</html>