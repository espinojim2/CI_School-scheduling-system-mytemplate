
<div style='padding:2%;'>
<div class='row' style='margin-bottom:1%;'>
<div class='col-sm-2'>School Year</div>
<div class='col-sm-8'><select id='syid' style='width:200px;' onchange='setStudentEnrollTable()'><?= $this->load->view("optiontags/schoolyear_options"); ?></select></div>
</div>
<div class='row' style='margin-bottom:1%;'>
<div class='col-sm-2'>Level</div>
<div class='col-sm-8'><select id='lvlid' style='width:200px;' onchange="SYS_setSection()"><?= $this->load->view("optiontags/level_options"); ?></select></div>
</div>
<div class='row' style='margin-bottom:1%;'>
<div class='col-sm-2'>Section</div>
<div class='col-sm-8'><select id='sectid' style='width:200px;' onchange='setStudentEnrollTable()'></select></div>
</div>
</div>    
<div style='width:100%; margin-bottom:2%; background:rgb(102,0,102)'>
<button class='btn btn-primary' style='background:rgb(102,0,102);' onclick='SYS_EnrollStudent()'><span class='glyphicon glyphicon-plus'></span>Enroll Student</button></div>
<table id="table_idd" class="table table-striped table-hover table-bordered table-condensed" cellspacing="0" width="100%">
  <thead>
            <tr>
                <th style='width:5px;'>&nbsp;</th>
                <th style='width:100px;'>ID</th>
                <th style='width:200px;'>Name</th>
                <th style='width:50px;'>Gender</th>
                <th>Level</th>
                <th>Section</th>
                <th>School Year</th>
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
SYS_setSection();
  //setStudentEnrollTable();
 $('#dialog1').jseDialog({
autoOpen:false,
},function(){   $("#wrapper").toggleClass("toggled"); });     
});
/*********************************/


function setStudentEnrollTable(){
var syid=$('#syid').val();    
var lvlid=$('#lvlid').val();
var sectid=$('#sectid').val();
SYS_TableStart('#table_idd'); 
$.post(URL+"index.php/main/loadEnrollStudentList",{syid:syid,lvlid:lvlid,sectid:sectid}).done(function(data){
$('#table_idd tbody').html(data);
SYS_TablefirstInstance('#table_idd');    
});
}

function SYS_setSection()
{
var lvlid=$('#lvlid').val();
$.post(URL+"index.php/main/loadSectionOptions",{lvlid:lvlid}).done(function(data){
$('#sectid').html("<option value=''>-- All --</option>"+data);
setStudentEnrollTable();
}); 
}

function SYS_EnrollStudent(){
var syid=$('#syid').val();    
var lvlid=$('#lvlid').val();    
$.post(URL+"index.php/main/loadEnrollStudentForm",{mode:"add",enrollid:"",syid:syid,lvlid:lvlid}).done(function(data){
$('#dialog1').html(data);
$("#wrapper").toggleClass("toggled"); 
$('#dialog1').jseDialog('open');
 
});
}


function SYS_editEnrollStudent(enrollid)
{
var syid=$('#syid').val();    
var lvlid=$('#lvlid').val();    
$.post(URL+"index.php/main/loadEnrollStudentForm",{mode:"edit",enrollid:enrollid,syid:syid,lvlid:lvlid}).done(function(data){
$('#dialog1').html(data);
$("#wrapper").toggleClass("toggled"); 
$('#dialog1').jseDialog('open');
 
});
}



</script>