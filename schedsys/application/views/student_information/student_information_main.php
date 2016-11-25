<div>
<ul class="nav nav-tabs">
  <li id='nav1' class="active"><a href="#" onclick='shownav1()'>Register Student</a></li>
  <li id='nav2'><a href="#" onclick='shownav2()'>Enroll Student</a></li>
</ul>
</div>
<div id='tcontennt'></div>
<script type="text/javascript">
$(document).ready(function(){
shownav1();

});

function shownav1(){
$('#nav1').attr("class","active");	
$('#nav2').attr("class","inactive");	
$.post(URL+"index.php/main/loadStudentRegisterMain").done(function(data){
$('#tcontennt').html(data);
});
}


function shownav2(){
$('#nav2').attr("class","active");	
$('#nav1').attr("class","inactive");	
$.post(URL+"index.php/main/loadStudentEnrollMain").done(function(data){
$('#tcontennt').html(data);
});
}
</script>
