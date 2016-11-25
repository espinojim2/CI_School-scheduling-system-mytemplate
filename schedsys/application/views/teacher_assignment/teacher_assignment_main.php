<div style='width:100%; padding:2%;'>
<div class='row' style='margin-bottom:1%;'>
<div class='col-sm-2'>School Year</div>
<div class='col-sm-8'><select id='syid' style='width:200px;' onchange="setPersonsToAssign();"><?= $this->load->view("optiontags/schoolyear_options"); ?></select></div>
</div>
<div class='row'>
<div class='col-sm-2'>Filter</div>
<div class='col-sm-8'><select id='teachtype' style='width:200px;' onchange="setPersonsToAssign();">
<option value='0'>Unassigned Teacher</option>
<option value='1'>Assigned Teacher</option>
</select></div>
</div>

<div style='width:100%;' id='tassign_cont'></div>
</div>
<script type="text/javascript">
$(document).ready(function(){

setPersonsToAssign();
});

function setPersonsToAssign(){
var syid=$('#syid').val();
var teachtype=$('#teachtype').val(); 
$.post(URL+"index.php/main/loadTeacherAssignmentList",{syid:syid,teachtype:teachtype}).done(function(data){
$('#tassign_cont').html(data);

});

}

function SYS_teacherTransfer(){
var cnt=$('#personcnt').val();
var syid=$('#syid').val();
var teachtype=$('#teachtype').val(); 
var pid=[]; var ischk=[]; z=0;
for(x=0;x<cnt;x++)
{
pid[x]=$('#personchk'+x).val();
ischk[x]=($('#personchk'+x).is(':checked'))?"1":"0";
z+=ischk[x];
}
if(z==0){ bootbox.alert("There's nothing to assign", function() {});  }
else
{
$.post(URL+"index.php/main/loadTeaxherTransferSave",{teachtype:teachtype,pid:pid,syid:syid,ischk:ischk}).done(function(data){ 
n=JSON.parse(data);
if(n.msg==""){ bootbox.alert("Done", function() {}); setPersonsToAssign(); }
else{ bootbox.alert(n.msg, function() {}); }
});	
}

}


</script>