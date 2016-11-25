
<div style='padding:2%;'>
<div style='width:100%; margin-bottom:2%; background:rgb(102,0,102)'>
<button class='btn btn-primary' style='background:rgb(102,0,102);' onclick='SYS_addStudent()'><span class='glyphicon glyphicon-plus'></span> Add Student</button></div>
<table id="table_idd" class="table table-striped table-hover table-bordered table-condensed" cellspacing="0" width="100%">
  <thead>
            <tr>
                <th style='width:5px;'>&nbsp;</th>
                <th style='width:100px;'>ID</th>
                <th style='width:200px;'>Name</th>
                <th style='width:50px;'>Gender</th>
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
  setStudentTable();
 $('#dialog1').jseDialog({
autoOpen:false,
},function(){   $("#wrapper").toggleClass("toggled"); });     
});
/*********************************/


function setStudentTable(){
SYS_TableStart('#table_idd'); 
$.post(URL+"index.php/main/loadStudentList").done(function(data){ 
$('#table_idd tbody').html(data);
SYS_TablefirstInstance('#table_idd');    
});
}


function SYS_addStudent(){
$.post(URL+"index.php/main/loadAddStudentForm",{mode:"add",pid:""}).done(function(data){
$('#dialog1').html(data);
$("#wrapper").toggleClass("toggled"); 
$('#dialog1').jseDialog('open');
 
});
}


function SYS_editStudent(pid){
$.post(URL+"index.php/main/loadAddStudentForm",{mode:"edit",pid:pid}).done(function(data){
$('#dialog1').html(data);
$("#wrapper").toggleClass("toggled"); 
$('#dialog1').jseDialog('open');
 
});
}

</script>