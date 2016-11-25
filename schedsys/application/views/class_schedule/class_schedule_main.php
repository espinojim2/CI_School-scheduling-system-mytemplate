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