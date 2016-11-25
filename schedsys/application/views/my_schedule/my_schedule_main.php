<?php
$user_person_id=$_POST['user_person_id'];

$q=$this->db->query("select * from sys_p_person where not pid in(select pid from sys_s_student where remark='1') and pid='$user_person_id' and remark='1'");
if($q->num_rows()>0)
{
?>
<input type='hidden' id='pid' value="<?= $user_person_id; ?>";>
<div style='width:100%; padding:1%;'>
<div class='row' style='margin-bottom:1%;'>
<div class='col-sm-2'>School Year</div>
<div class='col-sm-8'><select id='syid' style='width:200px;' onchange="setScheduleList()"><?= $this->load->view("optiontags/schoolyear_options"); ?></select></div>
</div>
<div class='row' style='margin-bottom:1%;'>
<div class='col-sm-2'>Teacher</div>
<div class='col-sm-8'><select id='teacher_pid' style='width:200px;' onchange="setScheduleList()" disabled><?= $this->load->view("optiontags/teacher_options"); ?></select></div>
</div>
</div>

<div style='width:100%; margin-top:1%; '>
<button class='btn btn-primary' style='float:right; margin-bottom:1%; font-size:13px;' onclick="SYS_print_teacher_schedule()"><span class='glyphicon glyphicon-plus'></span> Print Schedule</button>
</div>
<table class='table table-condensed table-bordered table-striped table-hover' id='schedtblcont' style='font-size:13px;'>
<thead>
<th>Teacher</th>	
<th>Time</th>
<th>Day</th>
<th>Level</th>
<th>Section</th>
<th>Room</th>

</thead>
<tbody>

</tbody>
</table>
</div>
<div id='dialog1'></div>
<script type="text/javascript">
$(document).ready(function(){
$('#teacher_pid').val($("#pid").val());

setTimeout(function(){ setScheduleList(); },500);
});

function setScheduleList()
{
var syid=$('#syid').val();
var pid=$('#teacher_pid').val();

$.post(URL+"index.php/main/loadTeacherScheduleList",{syid:syid,pid:pid}).done(function(data){
$('#schedtblcont tbody').html(data);
});	
}

function SYS_print_teacher_schedule(){
var syid=$('#syid').val();
var pid=$('#teacher_pid').val();	
x=(screen.width/2)-((900/2)+10);
y=(screen.width/2)-((600/2)+50);	
window.open(URL+"index.php/main/loadTeacherSchedulePrintList?syid="+syid+"&pid="+pid+"","","width=900,height=600,top="+y+",left="+x+"");	
}





</script>
<?php
}
else
{



?>


<input type='hidden' id='pid' value="<?= $user_person_id; ?>";>
<div style='width:100%; padding:1%;'>
<div class='row' style='margin-bottom:1%;'>
<div class='col-sm-2'>School Year</div>
<div class='col-sm-8'><select id='syid' style='width:200px;' onchange="setMyLevels(); setScheduleList();"><?= $this->load->view("optiontags/schoolyear_options"); ?></select></div>
</div>
<div class='row' style='margin-bottom:1%;'>
<div class='col-sm-2'>Level</div>
<div class='col-sm-8'><select id='lvlid' style='width:200px;' onchange="setMySection(); setScheduleList(); " disabled><?= $this->load->view("optiontags/level_options"); ?></select></div>
</div>
<div class='row' style='margin-bottom:1%;'>
<div class='col-sm-2'>Section</div>
<div class='col-sm-8'><select id='sectid' style='width:200px;' onchange="setScheduleList()" disabled></select></div>
</div>
<div class='row' style='margin-bottom:1%;'>
<div class='col-sm-2'>Room</div>
<div class='col-sm-8'><select id='roomid' style='width:200px;' onchange="setScheduleList()"><option value=''>-- All --</option><?= $this->load->view("optiontags/room_options"); ?></select></div>
</div>
<div class='row' style='margin-bottom:1%;'>
<div class='col-sm-2'>Day</div>
<div class='col-sm-8'><select id='day' style='width:200px;' onchange="setScheduleList()"><option value=''>-- All --</option>
<?= $this->load->view("optiontags/day_options"); ?>
</select></div>
</div>

<div style='width:100%; margin-top:2%; '>
<button class='btn btn-primary' style='float:right; margin-bottom:1%; font-size:13px;' onclick="SYS_print_class_schedule()"><span class='glyphicon glyphicon-plus'></span> Print Schedule</button>
</div>
<table class='table table-condensed table-bordered table-striped table-hover' id='schedtblcont' style='font-size:13px;'>
<thead>
<th>Time</th>
<th>Day</th>
<th>Level</th>
<th>Section</th>
<th>Room</th>
<th>Teacher</th>

</thead>
<tbody>

</tbody>
</table>
</div>
<div id='dialog1'></div>
<script type="text/javascript">
$(document).ready(function(){
setMyLevels();
setTimeout(function(){ setScheduleList(); },500);
});
function setMyLevels(){
var pid=$('#pid').val();
var syid=$('#syid').val();
$.post(URL+"index.php/main/loadMyLevels",{pid:pid,syid:syid}).done(function(data){
$('#lvlid').html(data);
setMySection();
});
}

function setMySection(){
var pid=$('#pid').val();
var syid=$('#syid').val();
$.post(URL+"index.php/main/loadMySections",{pid:pid,syid:syid}).done(function(data){
$('#sectid').html(data);
});	
}

function setScheduleList()
{
var syid=$('#syid').val();
var lvlid=$('#lvlid').val();
var sectid=$('#sectid').val(); 
var roomid=$('#roomid').val();
var day=$('#day').val();
$.post(URL+"index.php/main/loadClassScheduleList",{syid:syid,lvlid:lvlid,sectid:sectid,roomid:roomid,day:day}).done(function(data){
$('#schedtblcont tbody').html(data);
});	
}

function SYS_print_class_schedule(){
var syid=$('#syid').val();
var lvlid=$('#lvlid').val();
var sectid=$('#sectid').val(); 
var roomid=$('#roomid').val();
var day=$('#day').val();	
x=(screen.width/2)-((900/2)+10);
y=(screen.width/2)-((600/2)+50);	
window.open(URL+"index.php/main/loadSchedulePrintList?syid="+syid+"&lvlid="+lvlid+"&sectid="+sectid+"&roomid="+roomid+"&day="+day+"","","width=900,height=600,top="+y+",left="+x+"");	
}



function SYS_setSection()
{
var lvlid=$('#lvlid').val();
$.post(URL+"index.php/main/loadSectionOptions",{lvlid:lvlid}).done(function(data){
$('#sectid').html(data);
setScheduleList();
});	
}



</script>












<?php
}
?>