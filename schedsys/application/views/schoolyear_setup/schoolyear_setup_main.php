
<div style='padding:2%;'>
<div style='width:100%; margin-bottom:2%; background:rgb(102,0,102)'>
<button class='btn btn-primary' style='background:rgb(102,0,102);' onclick='SYS_addSY()'><span class='glyphicon glyphicon-plus'></span> Add School Year</button></div>
<table id="table_idd" class="table table-striped table-hover table-bordered table-condensed" cellspacing="0" width="100%">
  <thead>
            <tr>
                <th style='width:5px;'>&nbsp;</th>
                <th style='width:10px;'>ID</th>
                <th style='width:100px;'>Start of Year</th>
                <th style='width:50px;'>End of Year</th>
                <th style='width:10px;'>School year</th>
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
  setSYTable();
 $('#dialog1').jseDialog({
autoOpen:false,
},function(){   $("#wrapper").toggleClass("toggled"); });     
});
/*********************************/


function setSYTable(){
SYS_TableStart('#table_idd'); 
$.post(URL+"index.php/main/loadSYList").done(function(data){ 
$('#table_idd tbody').html(data);
SYS_TablefirstInstance('#table_idd');    
});
}


function SYS_addSY(){
$.post(URL+"index.php/main/loadAddSYForm",{mode:"add",syid:""}).done(function(data){
$('#dialog1').html(data);
$("#wrapper").toggleClass("toggled"); 
$('#dialog1').jseDialog('open');
 
});
}


function SYS_editSY(syid){
$.post(URL+"index.php/main/loadAddSYForm",{mode:"edit",syid:syid}).done(function(data){
$('#dialog1').html(data);
$("#wrapper").toggleClass("toggled"); 
$('#dialog1').jseDialog('open');
 
});
}

</script>