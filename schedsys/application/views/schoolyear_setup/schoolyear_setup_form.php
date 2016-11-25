<script type="text/javascript">
$(document).ready(function(){
$('.datefield').datepicker({
 autoclose: true,
 todayBtn: false,
  clearBtn: false,
 orientation: "top auto", //bottom auto,auto left,bottom left,auto right,top right,bottom right
 todayHighlight: true,
 //defaultViewDate: { year: 2015, month: 04, day: 25 }
});
$('#status').val($('#formstat').val());
});
</script>
<?php
$mode=$_POST['mode'];
$syid=$_POST['syid'];

$sy=$this->mainmodel->syear_data($syid);
$strt=($mode=='add')?"":$sy[0]['strt'];
$end=($mode=='add')?"":$sy[0]['end'];
$status=($mode=='add')?"":$sy[0]['remark'];
?>

<div id='msg' style='margin-top:2%;'></div>
<div style='width:100%; padding:2%;' align='center'>
<div style='width:50%;'>
<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>Start of S.Y</label></div>
<div class='col-sm-8'><input type='text' class='form-control datefield' id='strtdate' value="<?= $strt; ?>"></div>
</div>
<div class='row' style='margin-bottom:2%;'>
<div class='col-sm-4'><label>End of S.Y</label></div>
<div class='col-sm-8'><input type='text' class='form-control datefield' id='enddate' value="<?= $end; ?>"></div>
</div>

<?php 
$st=($mode=='add')?"display:none;":"";
?>
<div class='row' style='margin-bottom:2%; <?= $st; ?>'>
<div class='col-sm-4'><label>Status</label></div>
<div class='col-sm-8'><select class='form-control' id='status'><option value='1'>Enable</option><option value='0'>Disable</option></select></div>
</div>




<div class='row'>
<div class='col-sm-4'></div>	
<div class='col-sm-8'><button class='btn btn-primary form-control' onclick='SYS_saveSY()'>Save</button></div>
</div>
</div>

</div>
<input type='hidden' id='formmode' value="<?= $mode; ?>" >
<input type='hidden' id='formsyid' value="<?= $syid; ?>" >
<input type='hidden' id='formstat' value="<?= $status; ?>" >
<script type="text/javascript">


</script>