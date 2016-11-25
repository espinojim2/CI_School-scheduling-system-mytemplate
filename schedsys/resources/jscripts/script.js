

SYS_TableStart=function(tablename){
$(tablename).hide();  
$(tablename).DataTable().destroy(); 	
}


SYS_TablefirstInstance=function(tablename){
$(tablename).fadeIn();  
$(tablename).DataTable({
   searching:true,
   ordering:true,
   select:false,
   aLengthMenu: [[10,25, 50, 75, -1], [10,25, 50, 75, "All"]],
   pageLength: 10,
    });
   $(tablename).css({'font-size':'12px','width':'100%'}); 

}



set_all_template_check=function() /*checks all checkbox in page_template*/
{
$('.cb1-element').prop('checked',true);
$('.ch').show();
}
unsetset_all_template_check=function(){
$('.cb1-element').prop('checked',false);	
$('.ch').hide();
}

searchnavi=function() /*sidebar search*/
{
accountid=$('#user_accountid').val();
  $('#sidebar-wrapper').html(""); 
 setTimeout(function(){

 	$.post(URL+"index.php/main/loadSidebar",{accountid:accountid}).done(function(data){  

  $('#sidebar-wrapper').html(data); });
 },1000); 

}

validateMsg=function(msg) /*Validation message*/
{
str="<div class='alert alert-danger' style='width:100%; height:auto; background:rgba(255,0,0,0.1); margin-bottom:1em;  padding:0.5%; border-radius:0.5em; border:rgba(255,0,0,0.1) solid 1px;'><span class='glyphicon glyphicon-warning-sign text-danger' style='margin-left:1em; '> </span><span class='text-danger' style='font-family:arial,tahoma,verdana; margin-left:1em;'>"+msg+"</span></div>"; 
return str; 
}

/* School Year */
SYS_saveSY=function(){
var mode=$('#formmode').val();
var syid=$('#formsyid').val();
var strtdate=$('#strtdate').val();
var enddate=$('#enddate').val();
var status=$('#status').val();
$.post(URL+"index.php/main/loadSYSave",{mode:mode,syid:syid,strtdate:strtdate,enddate:enddate,status:status}).done(function(data){
n=JSON.parse(data);
if(n.msg==""){ 
              setSYTable();
             $('#dialog1').jseDialog('close');  bootbox.alert("Done Saving", function() {
                console.log("Alert Callback");
            }); 
            }  
else
{
$('#msg').html(validateMsg(n.msg));
if(n.ex1==""){ $('#strtdate').css({'border-color':'rgb(104, 190, 253);'}); }else{ $('#strtdate').css({'border-color':'red'}); }  
if(n.ex2==""){ $('#enddate').css({'border-color':'rgb(104, 190, 253);'}); }else{ $('#enddate').css({'border-color':'red'}); }   
}  
});

}
/* Rooms */
SYS_saveRoom=function()
{
var mode=$('#formmode').val();
var roomid=$('#formroomid').val();	
var roomcode=$('#roomcode').val();
var roomname=$('#roomname').val();
var status=$('#status').val();
$.post(URL+"index.php/main/loadRoomSave",{mode:mode,roomid:roomid,roomcode:roomcode,roomname:roomname,status:status}).done(function(data){
n=JSON.parse(data);
if(n.msg==""){ 
               setRoomTable();
             $('#dialog1').jseDialog('close');  bootbox.alert("Done Saving", function() {
                console.log("Alert Callback");
            }); 
            }  
else
{
$('#msg').html(validateMsg(n.msg));
if(n.ex1==""){ $('#roomcode').css({'border-color':'rgb(104, 190, 253);'}); }else{ $('#roomcode').css({'border-color':'red'}); }  
if(n.ex2==""){ $('#roomname').css({'border-color':'rgb(104, 190, 253);'}); }else{ $('#roomname').css({'border-color':'red'}); }   
} 
});
}
/* Level Setup*/
SYS_saveLevel=function(){
var mode=$('#formmode').val();
var lvlid=$('#formlvlid').val();	
var lvlcode=$('#lvlcode').val();
var lvlname=$('#lvlname').val();
var seq=$('#seq').val();
var status=$('#status').val();
$.post(URL+"index.php/main/loadLevelSave",{mode:mode,lvlid:lvlid,lvlcode:lvlcode,lvlname:lvlname,seq:seq,status:status}).done(function(data){
n=JSON.parse(data);
if(n.msg==""){ 
               setLevelTable();
             $('#dialog1').jseDialog('close');  bootbox.alert("Done Saving", function() {
                console.log("Alert Callback");
            }); 
            }  
else
{
$('#msg').html(validateMsg(n.msg)); 
if(n.ex1==""){ $('#lvlcode').css({'border-color':'rgb(104, 190, 253);'}); }else{ $('#lvlcode').css({'border-color':'red'}); }  
if(n.ex2==""){ $('#lvlname').css({'border-color':'rgb(104, 190, 253);'}); }else{ $('#lvlname').css({'border-color':'red'}); }  
if(n.ex3==""){ $('#seq').css({'border-color':'rgb(104, 190, 253);'}); }else{ $('#seq').css({'border-color':'red'}); } 

} 
});

}

/* Section Setup */
SYS_saveSections=function()
{
var mode=$('#formmode').val();
var sectid=$('#formsectid').val();
var lvlid=$('#lvlid').val();	
var sectcode=$('#sectcode').val();
var sectname=$('#sectname').val();
var sectdesc=$('#sectdesc').val();
var seq=$('#seq').val();
var status=$('#status').val();
$.post(URL+"index.php/main/loadSectionSave",{mode:mode,sectid:sectid,lvlid:lvlid,sectcode:sectcode,sectname:sectname,sectdesc:sectdesc,seq:seq,status:status}).done(function(data){

n=JSON.parse(data);
if(n.msg==""){ 
               setSectionTable();
             $('#dialog1').jseDialog('close');  bootbox.alert("Done Saving", function() {
                console.log("Alert Callback");
            }); 
            }  
else
{
$('#msg').html(validateMsg(n.msg)); 
if(n.ex1 ==""){ $('#sectcode').css({'border-color':'rgb(104, 190, 253);'}); }else{ $('#sectcode').css({'border-color':'red'}); }  
if(n.ex2 ==""){ $('#sectname').css({'border-color':'rgb(104, 190, 253);'}); }else{ $('#sectname').css({'border-color':'red'}); }  
if(n.ex3 ==""){ $('#seq').css({'border-color':'rgb(104, 190, 253);'}); }else{ $('#seq').css({'border-color':'red'}); } 

} 
});

}

/*User Account */
SYS_saveUserAccount=function()
{
var mode=$('#formmode').val();
var accountId=$('#formaccountId').val();	
var accountTypeId=$('#accountTypeId').val();
var pid=$('#form_pid').val();
var username=$('#username').val();
var password=$('#password').val();
var cpassword=$('#cpassword').val();
var status=$('#status').val();

$.post(URL+"index.php/main/loadUserAccountSave",{mode:mode,accountId:accountId,accountTypeId:accountTypeId,pid:pid,username:username,password:password,cpassword:cpassword,status:status}).done(function(data){
n=JSON.parse(data);
if(n.msg==""){ 
                 setUserAcctTable();
             $('#dialog1').jseDialog('close');  bootbox.alert("Done Saving", function() {
                console.log("Alert Callback");
            }); 
            }  
else
{
$('#msg').html(validateMsg(n.msg)); 
if(n.ex1 ==""){ $('#username').css({'border-color':'rgb(104, 190, 253);'}); }else{ $('#username').css({'border-color':'red'}); }  
if(n.ex2 ==""){ $('#password').css({'border-color':'rgb(104, 190, 253);'}); }else{ $('#password').css({'border-color':'red'}); }  
if(n.ex3 ==""){ $('#cpassword').css({'border-color':'rgb(104, 190, 253);'}); }else{ $('#cpassword').css({'border-color':'red'}); } 
} 
});	
}

