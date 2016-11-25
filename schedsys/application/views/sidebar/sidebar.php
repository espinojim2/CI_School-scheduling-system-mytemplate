 <ul class="sidebar-nav">
                <li  style='padding:5%;'>    
                </li>
       
<?php
$accountid=$_POST['accountid'];
$srch=($accountid=="")?"":" AND sys_p_authorization.accountId =  '$accountid' ";
$select = "SELECT DISTINCT
                    sys_module.moduleId,
                    sys_module.moduleAlias,
                    sys_module.moduleName
                    FROM
                    sys_module,
                    sys_p_authorization,
                    sys_systempages,
                    sys_account_type_template
                    WHERE 1
                   $srch
                    AND sys_p_authorization.aview='1'
                    AND sys_account_type_template.aview='1'
                    AND NOT sys_module.moduleId = 'NULL' 
                    AND sys_p_authorization.pageId = sys_systempages.pageId
                    AND  sys_systempages.moduleId = sys_module.moduleId
                  
                    AND sys_account_type_template.pageId=sys_systempages.pageId
                 
                    ";    
        $select .=  " ORDER BY sys_module.moduleOrder,sys_module.moduleName";



$q=$this->db->query($select);
$r=$q->result_array();
$str="";
$z=0;
for($x=0;$x<count($r);$x++)
{
$moduleId=$r[$x]['moduleId'];
$moduleAlias=$r[$x]['moduleAlias'];
$moduleName=ucwords($r[$x]['moduleName']);
$str.="
 <li>
<a href='#' style='background:rgba(255,255,255,0.1);'>$moduleName</a>                
";
  

$q1=$this->db->query("select * from sys_systempages where moduleId='$moduleId' and pageId in(select pageId from sys_account_type_template where aview='1') order by pageOrder");
$r1=$q1->result_array();
for($y=0;$y<count($r1);$y++)
{
$pageId=$r1[$y]['pageId'];
$pageAlias=$r1[$y]['pageAlias'];
$pageName=ucwords($r1[$y]['pageName']);    
$str.="
<ul class='sidebar-sub' type='none'>
    <li>
    <a href='#'' onclick='setPage($z)'><span class='glyphicon glyphicon-arrow-right'></span> $pageName</a>
    <input type='hidden' id='pageId$z' value='$pageId'>
    <input type='hidden' id='pageAlias$z' value='$pageAlias'>
    </li>
</ul>
";
$z++;
}
$str.="
</li>";
}

$str.="
 <li>
<a href='#' style='background:rgba(255,255,255,0.1);'>&nbsp;</a>                
<ul class='sidebar-sub' type='none'>
    <li>
    <a href='#'' onclick='logoutt()'>Logout</a>
    </li>
</ul>
</li>
 <li  style='padding:9%;'>    
                </li>
";

echo $str;
?>
</ul>

<script type="text/javascript">
function setPage(z){
pageId=$('#pageId'+z).val();
pageAlias=$('#pageAlias'+z).val();
accountId=$('#user_accountid').val();
window.location.href=URL+"index.php/main/pages/"+pageId+"/"+accountId+"/"+pageAlias; 
}

function logoutt(){
	
$.post(URL+"index.php/main/loadLogout").done(function(data){
n=JSON.parse(data);
if(n.res){ window.location.href=URL+""; }
 });	
}
</script>
