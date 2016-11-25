/*
This is developed and licensed by JCoderz.org and JSE industries
copyright 2015
*/
jse={};
jse.jseMain=function(){
jse.jsecount=0;
jse.z1=0;
$('.dataTable thead th').each(function(){
jse.z1+=1;
});

if((jse.SetColVisible).length!=(jse.setColumnId).length){ alert("Error! Table will not work properly if column length in array is not equal to jse.Setcovisible array length"); }


$('.dataTable tbody tr').each(function(){
$(this).attr("id","row"+jse.jsecount);
$(this).attr("onclick","jse.SelectRow("+jse.jsecount+")");
$(this).attr("ondblclick","jse.DblClickSelectRow("+jse.jsecount+")");

jse.z=0;
$(this).children("td").each(function(){
  $(this).attr('abbr',jse.setColumnId[jse.z]); jse.z+=1;
});

jse.jsecount+=1;
});

jse.z1=0;
$('.dataTable thead tr th').each(function(){
  $(this).attr('abbr',jse.setColumnId[jse.z1]); 
  jse.z1+=1;
});


jse.z1=0;
$('.dataTable thead tr th').each(function(){
if($(this).attr('abbr')==jse.setColumnId[jse.z1]){
  if(jse.SetColVisible[jse.z1]==false){ 
  	$(this).hide(); 
    $('.dataTable tbody tr td[abbr='+jse.setColumnId[jse.z1]+']').hide();
  }
}
  jse.z1+=1;
});


  jse.keycount=-1;
  
  $("body").keydown(function(e){  
     if(e.keyCode==40){
     $('.dataTables_length select').blur();
     $('.dataTables_filter input').blur();
     jse.keycount+=1;
     if(jse.keycount==jse.jsecount){ jse.keycount=0;  }
     $('.dataTable tbody tr.odd').css({'background':'rgba(249,249,249,1)','color':'rgba(0,0,0,1)'});
     $('.dataTable tbody tr.even').css({'background':'#FFF','color':'rgba(0,0,0,1)'});
     $('.dataTable tbody tr').removeClass("trSelected");	
     $('#row'+jse.keycount).css({'background':'rgba(0,0,0,0.8)','color':'#FFF'});
     $('#row'+jse.keycount).addClass("trSelected");
     
     
    }
    if(e.keyCode==38){
    jse.keycount-=1;
    if(jse.keycount<0){ jse.keycount=jse.jsecount-1;  }
    $('.dataTables_length select').blur();
     $('.dataTables_filter input').blur();
    $('.dataTable tbody tr.odd').css({'background':'rgba(249,249,249,1)','color':'rgba(0,0,0,1)'});
     $('.dataTable tbody tr.even').css({'background':'#FFF','color':'rgba(0,0,0,1)'});
     $('.dataTable tbody tr').removeClass("trSelected");	
     $('#row'+jse.keycount).css({'background':'rgba(0,0,0,0.8)','color':'#FFF'});
     $('#row'+jse.keycount).addClass("trSelected");	
    }


    if(e.keyCode==13){
    jse.rowKeypresses();	
    }
    if(e.keyCode==39){
    jse.currentpage=parseInt($('li.paginate_button.active a').attr('data-dt-idx'));
    jse.currentpage+=1;
    $('a[data-dt-idx='+jse.currentpage+']').click();  	
    }
    if(e.keyCode==37){
    jse.currentpage=parseInt($('li.paginate_button.active a').attr('data-dt-idx'));
    jse.currentpage-=1;
    $('a[data-dt-idx='+jse.currentpage+']').click();  		
    }
});



/*$(this).attr("class","trSelected");
$('li.paginate_button.active a').attr('data-dt-idx') get current page
$('a[data-dt-idx=2]').click(); for page count
$('.dataTables_length select').val()  get num of rows dropdown
*/
$('.dataTables_length select').attr('onchange','jse.updatepagerows()');
$('.dataTables_paginate ul.pagination li.paginate_button').each(function(){
$(this).attr('onclick','jse.updatepagerows()');
});
$('.dataTable thead tr').each(function(){
$(this).attr('onclick','jse.updatepagerows()');
});

$('.dataTables_filter input').attr('onkeyup','jse.updatepagerows()');


$('.dataTables_length,.dataTables_filter').css({'color':'rgba(0,0,0,0.5)'});
 $('.dataTables_wrapper').css({'margin-left':'5%','margin-right':'5%'});
 $('.dataTables_filter').css({'text-align':'right'});
 $('.dataTables_paginate').css({'text-align':'right'});
 $('.dataTables_wrapper').prepend("<div id='table_btn_wrapper'></div>");
 var tbl="<button class='jbtn btn btn-primary jseAdd' onclick='jse.clickAdd()'><span class='glyphicon glyphicon-plus'></span>Add</button>"+
         "<button class='jbtn btn btn-primary jseEdit' onclick='jse.clickEdit()'><span class='glyphicon glyphicon-edit'></span>Edit</button>"+
         "<button class='jbtn btn btn-primary jseDel' onclick='jse.clickDelete()'><span class='glyphicon glyphicon-trash'></span>Delete</button>";
 $('#table_btn_wrapper').html(tbl);
 $('#table_btn_wrapper button.jbtn').css({'margin-left':'2px','font-size':'12px','margin-bottom':'7px'}); 
 $('#table_btn_wrapper').prepend("<div style='width:100%; height:30px; background:#48708D; color:#FFF; margin-bottom:5px;'></div>");
if(jse.SetBtnVisible[0]==false){ $('.jseAdd').hide(); }
if(jse.SetBtnVisible[1]==false){ $('.jseEdit').hide(); }
if(jse.SetBtnVisible[2]==false){ $('.jseDel').hide(); }

jse.RefreshTable=function(){
 jse.currentpage=parseInt($('li.paginate_button.active a').attr('data-dt-idx'));
  $('a[data-dt-idx='+jse.currentpage+']').click();    
}

jse.SelectRow=function(n){

$('.dataTable tbody tr.odd').css({'background':'rgba(249,249,249,1)','color':'rgba(0,0,0,1)'});
$('.dataTable tbody tr.even').css({'background':'#FFF','color':'rgba(0,0,0,1)'});
$('.dataTable tbody tr').removeClass("trSelected");

$('#row'+n).css({'background':'rgba(0,0,0,0.8)','color':'#FFF'});
$('#row'+n).addClass("trSelected");
jse.keycount=(n);
}

jse.rowKeypresses=function()
{
jse.TableKeypressed();	
}
jse.DblClickSelectRow=function(n){
jse.TableDblClick();    
}


jse.updatepagerows=function(){
jse.jsecount=0;
jse.keycount=-1;
$('.dataTable tbody tr.odd').css({'background':'rgba(249,249,249,1)','color':'rgba(0,0,0,1)'});
$('.dataTable tbody tr.even').css({'background':'#FFF','color':'rgba(0,0,0,1)'});

$('.dataTable tbody tr').each(function(){
$(this).attr("id","row"+jse.jsecount);
$(this).attr("onclick","jse.SelectRow("+jse.jsecount+")");



$('.dataTables_length select').attr('onchange','jse.updatepagerows()');
$('.dataTables_paginate ul.pagination li.paginate_button').each(function(){
$(this).attr('onclick','jse.updatepagerows()');
});
$('.dataTable thead tr').each(function(){
$(this).attr('onclick','jse.updatepagerows()');
});

$('.dataTables_filter input').attr('onkeyup','jse.updatepagerows()');


jse.z=0;
$(this).children("td").each(function(){
  $(this).attr('abbr',jse.setColumnId[jse.z]); jse.z+=1;
});

jse.jsecount+=1;
});



jse.z1=0;
$('.dataTable thead tr th').each(function(){
if($(this).attr('abbr')==jse.setColumnId[jse.z1]){
  if(jse.SetColVisible[jse.z1]==false){ 
  	$(this).hide(); 
    $('.dataTable tbody tr td[abbr='+jse.setColumnId[jse.z1]+']').hide();
  }
}
  jse.z1+=1;
});



$('.dataTable thead tr').each(function(){
$(this).attr('onclick','jse.updatepagerows()');
});


$('.dataTables_paginate ul.pagination li.paginate_button').each(function(){
$(this).attr('onclick','jse.updatepagerows()');
});

$('.dataTables_filter input').attr('onkeyup','jse.updatepagerows()');

}


}