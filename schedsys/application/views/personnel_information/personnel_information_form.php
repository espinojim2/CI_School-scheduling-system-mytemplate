<style type="text/css">
#jcodeform{ margin-top: 3%;}
#jcodeform .row div{ padding:1%;}
#jcodeform .row div input,#jcodeform .row div button,#jcodeform .row div input,#jcodeform .row div select{ width: 90%;}
#jcodeform .row div span{ font-weight: bold; color:rgba(0,0,0,0.7);}
</style>
<?php
$mode=$_POST['mode'];
$pid=$_POST['pid'];

$person=$this->mainmodel->person_data($pid);
$fname=($mode=='add')?"":$person[0]['fname'];
$mname=($mode=='add')?"":$person[0]['mname'];
$lname=($mode=='add')?"":$person[0]['lname'];
$ename=($mode=='add')?"":$person[0]['ename'];
$contact=($mode=='add')?"":$person[0]['contact'];
$gender=($mode=='add')?"":$person[0]['gender'];
$bdate=($mode=='add')?"":$person[0]['bdate'];
$bplace=($mode=='add')?"":$person[0]['bplace'];
$email=($mode=='add')?"":$person[0]['email'];
$remark=($mode=='add')?"":$person[0]['remark'];
?>

<div id='msg' style='margin-top:2%;'></div>
<div class='container form-group' id='jcodeform'>
<input type='hidden' id='gender1' value="<?= $gender; ?>">

<script type="text/javascript">
$(document).ready(function(){
$('#gender').val($('#gender1').val());	
$('#status').val($('#formstat').val());
});
</script>
<div class='row'>
<div class='col-sm-2'><span>First Name</span></div>
<div class='col-sm-4'><input type='text' class='form-control' id='fname' value='<?= $fname; ?>'></div>
<div class='col-sm-2'><span>Gender</span></div>
<div class='col-sm-4'><select class='form-control' id='gender'><option value='m'>Male</option><option value='f'>Female</option></select></div>
</div>

<div class='row'>
<div class='col-sm-2'><span>Middle Name</span></span></div>
<div class='col-sm-4'><input type='text' class='form-control' id='mname' value='<?= $mname; ?>'></div>
<div class='col-sm-2'><span>Birth Date</span></div>
<div class='col-sm-4'><input type='date' class='form-control datefield' id='bdate' value="<?= $bdate; ?>"></div>
</div>

<div class='row'>
<div class='col-sm-2'><span>Last Name</span></div>
<div class='col-sm-4'><input type='text' class='form-control' id='lname' value='<?= $lname; ?>'></div>
<div class='col-sm-2'><span>Birth Place</span></div>
<div class='col-sm-4'><input type='text' class='form-control' id='bplace' <?= $bplace; ?>></div>
</div>


<div class='row'>
<div class='col-sm-2'><span>Suffix</span></div>
<div class='col-sm-4'><input type='text' class='form-control' id='ename' value='<?= $ename; ?>'></div>
<div class='col-sm-2'><span>Email</span></div>
<div class='col-sm-4'><input type='email' class='form-control' id='email' value="<?= $email; ?>"></div>
</div>

<div class='row'>
<div class='col-sm-2'><span>Contact Number</span></div>
<div class='col-sm-4'><input type='text' class='form-control' id='contact' value="<?= $contact; ?>"></div>
<?php
$st=($mode=='add')?"display:none;":"";
?>
<div class='col-sm-2' style="<?= $st; ?>"><span>Status</span></div>
<div class='col-sm-4' style="<?= $st; ?>"><select class='form-control' id='status'>
<option value='1'>Active</option>
<option value='0'>Inactive</option>
</select></div>
</div>

<div class='row'>
<div class='col-sm-2'><span></span></div>
<div class='col-sm-4'></div>
<div class='col-sm-2'><span></span></div>
<div class='col-sm-4'><button class='btn btn-primary form-control' onclick='PersonvalidateSave()'>Save</button></div>
</div>

</div>
<input type='hidden' id='formmode' value="<?= $mode; ?>" >
<input type='hidden' id='formpid' value="<?= $pid; ?>" >
<input type='hidden' id='formstat' value="<?= $remark; ?>" >

<script type="text/javascript">
$(document).ready(function(){
$('.datefield').datepicker({
 autoclose: true,
 todayBtn: false,
  clearBtn: false,
 orientation: "top auto", //bottom auto,auto left,bottom left,auto right,top right,bottom right
 todayHighlight: true,
// defaultViewDate: { year: 1977, month: 04, day: 25 }
});

});



function PersonvalidateSave(){
fname=$('#fname').val();
mname=$('#mname').val();
lname=$('#lname').val();
ename=$('#ename').val();
gender=$('#gender').val();
bdate=$('#bdate').val();
bplace=$('#bplace').val();
email=$('#email').val();
contact=$('#contact').val();
mode=$('#formmode').val();
pid=$('#formpid').val();
var status=$('#status').val(); 
$.post(URL+"index.php/main/loadPersonSave",{status:status,pid:pid,fname:fname,mname:mname,lname:lname,ename:ename,gender:gender,bdate:bdate,bplace:bplace,email:email,contact:contact,mode:mode}).done(function(data){
n=JSON.parse(data);
if(n.msg==""){ setPersonTable(); $('#dialog1').jseDialog('close');  bootbox.alert("Done Saving", function() {
                console.log("Alert Callback");
            }); }  
else
{
$('#msg').html(validateMsg(n.msg));
if(n.ex1==""){ $('#fname').css({'border-color':'rgb(104, 190, 253);'}); }else{ $('#fname').css({'border-color':'red'}); }  
if(n.ex2==""){ $('#mname').css({'border-color':'rgb(104, 190, 253);'}); }else{ $('#mname').css({'border-color':'red'}); }   
if(n.ex3==""){ $('#lname').css({'border-color':'rgb(104, 190, 253);'}); }else{ $('#lname').css({'border-color':'red'}); }  
if(n.ex4==""){ $('#ename').css({'border-color':'rgb(104, 190, 253);'}); }else{ $('#ename').css({'border-color':'red'}); }   
if(n.ex5==""){ $('#bplace').css({'border-color':'rgb(104, 190, 253);'}); }else{ $('#bplace').css({'border-color':'red'}); }  

}  
});  

}
</script>