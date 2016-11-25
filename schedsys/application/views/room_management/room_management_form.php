<?php
$mode=$_POST['mode'];
$roomid=$_POST['roomid'];

$room=$this->mainmodel->room_data($roomid);
$roomcode=($mode=='add')?"":htmlspecialchars($room[0]['roomcode']);
$roomname=($mode=='add')?"":htmlspecialchars($room[0]['roomname']);
$status=($mode=='add')?"":$room[0]['remark'];
?>
<script type="text/javascript">
$(document).ready(function(){
$('#status').val($('#formstat').val());	
});
</script>
<div id='msg' style='margin-top:2%;'></div>
<div style='width:100%; padding:2%;' align='center'>
<div style='width:50%;'>
<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>Room Code</label></div>
<div class='col-sm-8'><input type='text' class='form-control datefield' id='roomcode' value="<?= $roomcode; ?>"></div>
</div>
<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>Room Name</label></div>
<div class='col-sm-8'><input type='text' class='form-control datefield' id='roomname' value="<?= $roomname; ?>"></div>
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
<div class='col-sm-8'><button class='btn btn-primary form-control' onclick='SYS_saveRoom()'>Save</button></div>
</div>
</div>

</div>
<input type='hidden' id='formmode' value="<?= $mode; ?>" >
<input type='hidden' id='formroomid' value="<?= $roomid; ?>" >
<input type='hidden' id='formstat' value="<?= $status; ?>" >
<script type="text/javascript">


</script>