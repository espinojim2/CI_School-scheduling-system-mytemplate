<div style='width:100%; padding:1%;'>
<div class='row' style='margin-bottom:1%;'>
<div class='col-sm-2'>School Year</div>
<div class='col-sm-8'><select id='syid' style='width:200px;' onchange="setScheduleList()"><?= $this->load->view("optiontags/schoolyear_options"); ?></select></div>
</div>
<div class='row' style='margin-bottom:1%;'>
<div class='col-sm-2'>Level</div>
<div class='col-sm-8'><select id='lvlid' style='width:200px;' onchange="SYS_setSection()"><?= $this->load->view("optiontags/level_options"); ?></select></div>
</div>
<div class='row' style='margin-bottom:1%;'>
<div class='col-sm-2'>Section</div>
<div class='col-sm-8'><select id='sectid' style='width:200px;' onchange="setScheduleList()"></select></div>
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
<button class='btn btn-primary' style='float:right; margin-bottom:1%; font-size:13px;' onclick="SYS_add_schedule()"><span class='glyphicon glyphicon-plus'></span> Add Schedule</button>
</div>
<table class='table table-condensed table-bordered table-striped table-hover' id='schedtblcont' style='font-size:13px;'>
<thead>
<th>Time</th>
<th>Day</th>
<th>Level</th>
<th>Section</th>
<th>Room</th>
<th>Teacher</th>
<th></th>
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
var lvlid=$('#lvlid').val();
var sectid=$('#sectid').val(); 
var roomid=$('#roomid').val();
var day=$('#day').val();
$.post(URL+"index.php/main/loadScheduleList",{syid:syid,lvlid:lvlid,sectid:sectid,roomid:roomid,day:day}).done(function(data){
$('#schedtblcont tbody').html(data);
});	
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