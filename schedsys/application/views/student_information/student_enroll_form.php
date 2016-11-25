<?php
$mode=$_POST['mode'];
$enrollid=$_POST['enrollid'];

$syid=$_POST['syid'];
$lvlid=$_POST['lvlid'];

$reg=$this->mainmodel->enroll_data($enrollid);
$lvlid=($mode=='add')?"":$reg[0]['lvlid'];
$sectid=($mode=='add')?"":$reg[0]['sectid'];
$pid=($mode=='add')?"":$reg[0]['pid'];
$status=($mode=='add')?"":$reg[0]['remark'];
?>
<script type="text/javascript">
$(document).ready(function(){
$('#status').val($('#formstat').val());	
$('#form_lvlid').val($('#formlvlid').val());
$('#form_sectid').val($('#formsectid').val());
$("#form_pid").val($('#formpid').val());
});
</script>
<div id='msg' style='margin-top:2%;'></div>
<div style='width:100%; padding:2%;' align='center'>
<div style='width:50%;'>
<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>School Year</label></div>
<div class='col-sm-8'>
<select class='form-control' id='form_syid'>
	<?= $this->load->view("optiontags/schoolyear_options"); ?>
</select></div>
</div>

<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>Level</label></div>
<div class='col-sm-8'><select class='form-control' id='form_lvlid' onchange="SYS_setSection1()"><?= $this->load->view("optiontags/level_options"); ?></select></div>
</div>

<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>Section</label></div>
<div class='col-sm-8'><select class='form-control' id='form_sectid'></select></div>
</div>

<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>Student</label></div>
<div class='col-sm-8'><select class='form-control' id='form_pid'><?= $this->load->view("optiontags/student_options"); ?></select></div>
</div>




<?php 
$st=($mode=='add')?"display:none;":"";
?>
<div class='row' style='margin-bottom:2%; <?= $st; ?>'>
<div class='col-sm-4'><label>Status</label></div>
<div class='col-sm-8'><select class='form-control' id='status'><option value='1'>Enrolled</option><option value='0'>Not Enrolled</option></select></div>
</div>




<div class='row'>
<div class='col-sm-4'></div>	
<div class='col-sm-8'><button class='btn btn-primary form-control' onclick='SYS_saveEnrollStudent()'>Save</button></div>
</div>
</div>

</div>
<input type='hidden' id='formmode' value="<?= $mode; ?>" >
<input type='hidden' id='formenrollid' value="<?= $enrollid; ?>" >
<input type='hidden' id='formstat' value="<?= $status; ?>" >
<input type='hidden' id='formlvlid' value="<?= $lvlid; ?>" >
<input type='hidden' id='formsectid' value="<?= $sectid; ?>" >
<input type='hidden' id='formpid' value="<?= $pid; ?>" >

<script type="text/javascript">
$(document).ready(function(){

SYS_setSection1();
});
function SYS_setSection1()
{
var lvlid=$('#form_lvlid').val();
$.post(URL+"index.php/main/loadSectionOptions",{lvlid:lvlid}).done(function(data){
$('#form_sectid').html(data);

}); 
}

function SYS_saveEnrollStudent()
{
var syid=$('#form_syid').val();	
var lvlid=$('#form_lvlid').val();	
var sectid=$('#form_sectid').val();
var pid=$('#form_pid').val();
var mode=$('#formmode').val();
var stat=$('#status').val();
var enrollid=$('#formenrollid').val();
$.post(URL+"index.php/main/loadEnrollStudentSave",{syid:syid,lvlid:lvlid,sectid:sectid,pid:pid,mode:mode,enrollid:enrollid,stat:stat}).done(function(data){
  n=JSON.parse(data);
  if(n.msg==""){ setStudentEnrollTable();
  $('#dialog1').jseDialog('close');  bootbox.alert("Done Saving", function() {
                console.log("Alert Callback");
            });
}
else
{
$('#msg').html(validateMsg(n.msg));	
}


});
}
</script>