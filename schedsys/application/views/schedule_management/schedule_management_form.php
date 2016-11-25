<?php
$mode=$_POST['mode'];
$schedid=$_POST['schedid'];
$syid=$_POST['syid'];
//$room=$this->mainmodel->room_data($roomid);
//$roomcode=($mode=='add')?"":htmlspecialchars($room[0]['roomcode']);
//$roomname=($mode=='add')?"":htmlspecialchars($room[0]['roomname']);
//$status=($mode=='add')?"":$room[0]['remark'];
?>
<script type="text/javascript">
$(document).ready(function(){
//$('#status').val($('#formstat').val());	
formsetSect();
});

function formsetSect()
{
var lvlid=$('#form_lvlid').val();
$.post(URL+"index.php/main/loadSectionOptions",{lvlid:lvlid}).done(function(data){
$('#form_sectid').html(data);
});		
}
</script>
<input type='hidden' id='form_syid' value="<?= $syid; ?>">
<div id='msg' style='margin-top:2%;'></div>
<div style='width:100%; padding:2%;' align='center'>
<div style='width:50%;'>
<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>Teacher</label></div>
<div class='col-sm-8'><select class='form-control' id='teach_pid'>
<?php
$per="";
$q=$this->db->query("select * from sys_p_person where pid in(select pid from sys_teacher_assign where isteacher='1' and syid='$syid')");
$r=$q->result_array();
for($x=0;$x<count($r);$x++)
{
$pid=$r[$x]['pid'];
$name=ucwords($r[$x]['lname']." ".$r[$x]['ename'].", ".$r[$x]['fname']." ".$r[$x]['mname']);	
$per.="<option value='$pid'>$name</option>";	
}
if(count($r)==0){ $per.="<option value=''>No Assigned Teachers Yet</option>"; }
echo $per;
?>
</div>
</div>

<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>Level</label></div>
<div class='col-sm-8'><select class='form-control' id='form_lvlid1'></select></div>
</div>
<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>Level</label></div>
<div class='col-sm-8'><select class='form-control' id='form_lvlid' onchange='formsetSect()'><?= $this->load->view("optiontags/level_options"); ?></select></div>
</div>
<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>Section</label></div>
<div class='col-sm-8'><select class='form-control' id='form_sectid'></select></div>
</div>
<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>Room</label></div>
<div class='col-sm-8'><select class='form-control' id='form_roomid'><?= $this->load->view("optiontags/room_options"); ?></select></div>
</div>
<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>Day</label></div>
<div class='col-sm-8'><select class='form-control' id='form_day'><?= $this->load->view("optiontags/day_options"); ?></select></div>
</div>
<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>Start Time</label></div>
<div class='col-sm-8'>
<select id='shour' style='width:30%;' >
<?php
$sh="";
for($x=1;$x<=24;$x++){ 
$sv=($x<10)?"0":"";
$sh.=($x==7)?"<option value='$x' selected>$sv$x</option>":"<option value='$x'>$sv$x</option>"; }
echo $sh;
?>
</select>
<select id='smin'  style='width:30%;'>
<?php
$sm="";
for($x=0;$x<=59;$x++){
$sv=($x<10)?"0":"";
 $sm.="<option value='$x'>$sv$x</option>"; }
echo $sm;
?>
</select>
</div>


</div>

<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>End Time</label></div>
<div class='col-sm-8'>
<select id='ehour' style='width:30%;' >
<?php
$sh="";
for($x=1;$x<=24;$x++){ 
$sv=($x<10)?"0":"";
$sh.=($x==8)?"<option value='$x' selected>$sv$x</option>":"<option value='$x'>$sv$x</option>"; }
echo $sh;
?>
</select>
<select id='emin'  style='width:30%;'>
<?php
$sm="";
for($x=0;$x<=59;$x++){
$sv=($x<10)?"0":"";
 $sm.="<option value='$x'>$sv$x</option>"; }
echo $sm;
?>
</select>
</div>
</div>


<div class='row'>
<div class='col-sm-4'></div>	
<div class='col-sm-8'><button class='btn btn-primary form-control' onclick='SYS_saveSchedule()'>Save</button></div>
</div>
</div>

</div>
<input type='hidden' id='formmode' value="<?= $mode; ?>" >
<input type='hidden' id='formschedid' value="" >
<input type='hidden' id='formstat' value="" >
<script type="text/javascript">


</script>