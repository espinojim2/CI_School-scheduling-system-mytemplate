<?php
$mode=$_POST['mode'];
$lvlid=$_POST['lvlid'];

$lvl=$this->mainmodel->level_data($lvlid);
$lvlcode=($mode=='add')?"":htmlspecialchars($lvl[0]['lvlcode']);
$lvlname=($mode=='add')?"":htmlspecialchars($lvl[0]['lvlname']);
$sequence=($mode=='add')?($this->mainmodel->getMaxId("sys_levels","seq")+1):$lvl[0]['seq'];


$status=($mode=='add')?"":$lvl[0]['remark'];
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
<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>Level Code</label></div>
<div class='col-sm-8'><input type='text' class='form-control' id='lvlcode' value="<?= $lvlcode; ?>"></div>
</div>
<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>Level Name</label></div>
<div class='col-sm-8'><input type='text' class='form-control ' id='lvlname' value="<?= $lvlname; ?>"></div>
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
<div class='col-sm-8'><button class='btn btn-primary form-control' onclick='SYS_saveLevel()'>Save</button></div>
</div>
</div>

</div>
<input type='hidden' id='formmode' value="<?= $mode; ?>" >
<input type='hidden' id='formlvlid' value="<?= $lvlid; ?>" >
<input type='hidden' id='formstat' value="<?= $status; ?>" >
<script type="text/javascript">


</script>