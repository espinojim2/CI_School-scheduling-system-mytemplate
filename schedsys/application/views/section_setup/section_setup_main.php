
<div style='padding:2%;'>
<div style='width:100%; padding:1%;'>
<label>Level</label>
<select id='filt_lvlid' style='width:200px;' onchange='setSectionTable();'><option value=''>-- All --</option><?php echo "".$this->load->view("optiontags/level_options"); ?></select>
</div>    
<div style='width:100%; margin-bottom:2%; background:rgb(102,0,102)'>
<button class='btn btn-primary' style='background:rgb(102,0,102);' onclick='SYS_addSection()'><span class='glyphicon glyphicon-plus'></span> Add Section</button></div>
<table id="table_idd" class="table table-striped table-hover table-bordered table-condensed" cellspacing="0" width="100%">
  <thead>
            <tr>
                <th style='width:5px;'>&nbsp;</th>
                <th style='width:10px;'>ID</th>
                <th style='width:100px;'>Section Code</th>
                <th style='width:50px;'>Section Name</th>
                <th>Description</th>
                <th>Level</th>
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
  setSectionTable();
 $('#dialog1').jseDialog({
autoOpen:false,
},function(){   $("#wrapper").toggleClass("toggled"); });     
});
/*********************************/


function setSectionTable(){
var lvlid=$('#filt_lvlid').val();    
SYS_TableStart('#table_idd'); 
$.post(URL+"index.php/main/loadSectionList",{lvlid:lvlid}).done(function(data){ 
$('#table_idd tbody').html(data);
SYS_TablefirstInstance('#table_idd');    
});
}


function SYS_addSection(){
$.post(URL+"index.php/main/loadAddSectionForm",{mode:"add",sectid:""}).done(function(data){
$('#dialog1').html(data);
$("#wrapper").toggleClass("toggled"); 
$('#dialog1').jseDialog('open');
 
});
}


function SYS_editSection(sectid){
$.post(URL+"index.php/main/loadAddSectionForm",{mode:"edit",sectid:sectid}).done(function(data){
$('#dialog1').html(data);
$("#wrapper").toggleClass("toggled"); 
$('#dialog1').jseDialog('open');
 
});
}

</script>