<?php
$mode=$_POST['mode'];
$sectid=$_POST['sectid'];

$sect=$this->mainmodel->section_data($sectid);
$sectcode=($mode=='add')?"":htmlspecialchars($sect[0]['sectcode']);
$sectname=($mode=='add')?"":htmlspecialchars($sect[0]['sectname']);
$sectdesc=($mode=='add')?"":htmlspecialchars($sect[0]['sectdesc']);
$sequence=($mode=='add')?($this->mainmodel->getMaxId("sys_sections","seq")+1):$sect[0]['seq'];


$status=($mode=='add')?"":$sect[0]['remark'];
?>
<script type="text/javascript">
$(document).ready(function(){
$('#status').val($('#formstat').val());	

});
</script>
<input type='hidden' id='formseq' value="<?= $sequence; ?>">
<div id='msg' style='margin-top:2%;'></div>
<div style='width:100%; padding:2%;' align='center'>
<div style='width:50%;'>

<div class='row' style='margin-bottom:2%; <?= $st; ?>'>
<div class='col-sm-4'><label>Level</label></div>
<div class='col-sm-8'><select class='form-control' id='lvlid'><?php echo $this->load->view("optiontags/level_options"); ?></select></div>
</div>

<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>Section Code</label></div>
<div class='col-sm-8'><input type='text' class='form-control' id='sectcode' value="<?= $sectcode; ?>"></div>
</div>
<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>Section Name</label></div>
<div class='col-sm-8'><input type='text' class='form-control ' id='sectname' value="<?= $sectname; ?>"></div>
</div>
<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>Section Description</label></div>
<div class='col-sm-8'><input type='text' class='form-control ' id='sectdesc' value="<?= $sectdesc; ?>"></div>
</div>
<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>Sequence No.</label></div>
<div class='col-sm-8'><input type='number' min='1' class='form-control' id='seq' value="<?= $sequence; ?>"></div>
</div>
<?php 
$st=($mode=='add')?"display:none;":"";
?>
<div class='row' style='margin-bottom:2%; <?= $st; ?>'>
<div class='col-sm-4'><label>Status</label></div>
<div class='col-sm-8'><select class='form-control' id='status'><option value='1'>Available</option><option value='0'>No Available</option></select></div>
</div>


<div class='row'>
<div class='col-sm-4'></div>	
<div class='col-sm-8'><button class='btn btn-primary form-control' onclick='SYS_saveSections()'>Save</button></div>
</div>
</div>

</div>
<input type='hidden' id='formmode' value="<?= $mode; ?>" >
<input type='hidden' id='formsectid' value="<?= $sectid; ?>" >
<input type='hidden' id='formstat' value="<?= $status; ?>" >
<script type="text/javascript">


</script>