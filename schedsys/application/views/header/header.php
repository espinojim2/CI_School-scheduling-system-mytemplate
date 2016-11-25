
<?php
$this->load->library('session');
$accountId=$this->session->userdata('accountId');
$pid=$this->session->userdata('pid');
?>
<input type='hidden' id='user_accountid' value='<?= $accountId; ?>'>
<input type='hidden' id='user_person_id' value='<?= $pid; ?>'>
<div id='headerwrap'>

<span class="glyphicon glyphicon-menu-hamburger " id='menu-toggle' ></span>
<span id='logotitle' style='font-size:20px; margin-left:1%; color:#FFF;'>Scheduling System</span>

</div>
<div id='loadingDiv' style=' position:fixed; z-index:1000; width:100%; background:rgba(0,0,0,0.1); height:100%; padding:15%; overflow:hidden;' align='center'>
<div class="spinner-loader">
  Loading…
</div>
</div>
<input type='hidden' id='URL' value="<?= base_url(); ?>">
  <script type='text/javascript'>
    
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
<script type="text/javascript">
$(document).ready(function(){
searchnavi();
});

var URL=$('#URL').val();
var $loading = $('#loadingDiv');
    $(document).ready(function(){ $loading.hide(); });
    $(document).ajaxStart(function () { $loading.show(); }).ajaxStop(function () { $loading.hide(); });

Object.defineProperty(console,'_commandLineAPI',{ get:function(){ throw 'Sorry, developer tools are blocked here' }});  
</script>