<div style='width:100%; padding:1%;'>
<div class='row' style='margin-bottom:1%;'>
<div class='col-sm-2'>School Year</div>
<div class='col-sm-8'><select id='syid' style='width:200px;' onchange="setScheduleList()"><?= $this->load->view("optiontags/schoolyear_options"); ?></select></div>
</div>
<div class='row' style='margin-bottom:1%;'>
<div class='col-sm-2'>Teacher</div>
<div class='col-sm-8'><select id='teacher_pid' style='width:200px;' onchange="setScheduleList()"><?= $this->load->view("optiontags/teacher_options"); ?></select></div>
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
SYS_setSection();
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



function SYS_setSection()
{
var lvlid=$('#lvlid').val();
$.post(URL+"index.php/main/loadSectionOptions",{lvlid:lvlid}).done(function(data){
$('#sectid').html(data);
setScheduleList();
});	
}

function SYS_add_schedule(){
var syid=$('#syid').val();	
$.post(URL+"index.php/main/loadAddScheduleForm",{mode:"add",schedid:"",syid:syid}).done(function(data){
$('#dialog1').html(data);
$("#wrapper").toggleClass("toggled"); 
$('#dialog1').jseDialog('open');
 
});	
}

function SYS_deleteSchedule(schedid){
 bootbox.confirm("Are you Sure?", function() {
$.post(URL+"index.php/main/loadScheduleDelete",{schedid:schedid}).done(function(data){ alert(data);
bootbox.alert("Done Deleting", function() {});
	setTimeout(function(){ setScheduleList(); },500);

});
            }); 




}


function SYS_saveSchedule()
{
var syid=$('#form_syid').val();
var pid=$('#teach_pid').val();
var lvlid=$('#form_lvlid').val();
var sectid=$('#form_sectid').val();
var roomid=$('#form_roomid').val();
var day=$('#form_day').val();
var stime=$('#shour').val()+":"+$('#smin').val();
var etime=$('#ehour').val()+":"+$('#emin').val();	

$.post(URL+"index.php/main/loadScheduleSave",{syid:syid,pid:pid,lvlid:lvlid,sectid:sectid,roomid:roomid,day:day,stime:stime,etime:etime}).done(function(data){
n=JSON.parse(data);
if(n.msg==""){ 
	setTimeout(function(){ setScheduleList(); },500);
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