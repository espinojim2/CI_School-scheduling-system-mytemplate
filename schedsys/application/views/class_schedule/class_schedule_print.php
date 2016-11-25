
<style type="text/css">
@media print{
#tbl{ border-collapse: collapse;  width:100%;}

}

#tbl{ border-collapse: collapse; width:100%;}
</style>
<script type="text/javascript">
window.print();
</script>
<?php
$syid=(isset($_GET['syid']))?$_GET['syid']:"";
$lvlid=(isset($_GET['lvlid']))?$_GET['lvlid']:"";
$sectid=(isset($_GET['sectid']))?$_GET['sectid']:"";
$roomid=(isset($_GET['roomid']))?$_GET['roomid']:"";
$day=(isset($_GET['day']))?$_GET['day']:"";

$srch="";
$srch.=($syid=="")?"":" and syid='$syid'";
$srch.=($lvlid=="")?"":" and lvlid='$lvlid'";
$srch.=($sectid=="")?"":" and sectid='$sectid'";
$srch.=($roomid=="")?"":" and roomid='$roomid'";
$srch.=($day=="")?"":" and day='$day'";


$lvl=$this->mainmodel->level_data($lvlid);
$sect=$this->mainmodel->section_data($sectid);
$level=$lvl[0]['lvlname'];
$sectioncode=$sect[0]['sectcode'];
$section=$sect[0]['sectname'];
           
$r1=$this->mainmodel->syear_data($syid);
           $strt=$r1[0]['strt'];
            $end=$r1[0]['end'];

            $e1=explode("-",$strt); 
            $e2=explode("-",$end);
            $sy=$e1[0]." - ".$e2[0]; 


?>
<center><h3>Class Schedule for S.Y.<?= $sy; ?></h3>
<p>Level: <?= $level; ?></p>
<p>Section: <?= $section; ?></p>
</center>
<table border='1' id='tbl' style='font-size:13px;'>
<thead>
<th>Time</th>
<th>Day</th>
<th>Level</th>
<th>Section</th>
<th>Room</th>
<th>Teacher</th>

</thead>
<tbody>
<?php




$sql="select * from sys_schedule where remark='1' $srch order by stime,etime";
$q=$this->db->query($sql);
$r=$q->result_array();
$str="";
for($x=0;$x<count($r);$x++)
{
$schedid=$r[$x]['schedid'];	
$e1=explode(":",$r[$x]['stime']);
$e2=explode(":",$r[$x]['etime']);
$stime=$this->mainmodel->numformat(2,$e1[0]).":".$this->mainmodel->numformat(2,$e1[1]);
$etime=$this->mainmodel->numformat(2,$e2[0]).":".$this->mainmodel->numformat(2,$e2[1]);
$rday=ucwords($r[$x]['day']);
$lvl=$this->mainmodel->level_data($r[$x]['lvlid']);
$sect=$this->mainmodel->section_data($r[$x]['sectid']);
$level=$lvl[0]['lvlname'];
$sectioncode=$sect[0]['sectcode'];
$section=$sect[0]['sectname'];
$rm=$this->mainmodel->room_data($r[$x]['roomid']);
$roomname=$rm[0]['roomname'];
$person=$this->mainmodel->person_data($r[$x]['pid']);
$name=ucwords($person[0]['lname']." ".$person[0]['ename'].", ".$person[0]['fname']." ".$person[0]['mname']);


$str.="
<tr>
<td>$stime - $etime</td>
<td>$rday</td>
<td>$level</td>
<td>$sectioncode - $section</td>
<td>$roomname</td>
<td>$name</td>
</tr>
";	
}

if(count($r)==0)
{
$str.="
<tr>
<td colspan='7'>No results found</td>
</tr>
";	
}
echo $str;
?>
</tbody>
</table>