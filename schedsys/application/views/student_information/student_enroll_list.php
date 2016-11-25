
            <?php
            $str="";
            $syid=$_POST['syid'];
            $lvlid=$_POST['lvlid'];
            $sectid=$_POST['sectid'];
            $srch=($syid=="")?"":" and c.syid";
            $srch.=($lvlid=="")?"":" and c.lvlid='$lvlid'";
            $srch.=($sectid=="")?"":" and c.sectid='$sectid'";

            $q=$this->db->query("select contact,student_id,a.pid as pid,lname,ename,fname,mname,gender,c.remark as stat,lvlid,sectid,syid,enrollid from sys_p_person as a,sys_s_student as b,sys_s_registration as c where b.pid=c.pid and a.pid=b.pid $srch order by lname,c.remark");
            $r=$q->result_array();
            for($x=0;$x<count($r);$x++){
            $id=$r[$x]['enrollid'];
            $ID=$r[$x]['student_id'];
           
            $lvl=$this->mainmodel->level_data($r[$x]['lvlid']);
            $level=$lvl[0]['lvlname'];
            $sect=$this->mainmodel->section_data($r[$x]['sectid']);
            $section=$sect[0]['sectname'];

            $syr=$this->mainmodel->syear_data($r[$x]['syid']);
           $strt=$syr[0]['strt'];
            $end=$syr[0]['end'];

            $e1=explode("-",$strt); 
            $e2=explode("-",$end);
            $sy=$e1[0]." - ".$e2[0]; 

            $name=ucwords($r[$x]['lname']." ".$r[$x]['ename'].", ".$r[$x]['fname']." ".$r[$x]['mname']);
            $gen=($r[$x]['gender']=='m')?"Male":"Female"; 
            $contact=$r[$x]['contact'];
            $rem=($r[$x]['stat']=='1')?"<span class='text-success'>Enrolled</span>":"<span class='text-warning'>Not Enrolled</span>";

            $str.="
            <tr>
            <td>".($x+1)."</td>
            <td>$ID</td>
            <td>$name</td>
            <td>$gen</td>
            <td>$level</td>
            <td>$section</td>
            <td>$sy</td>
           <td><b>$rem</b></td>
            <td><button class='btn' style='background:rgba(0,0,0,0)' title='Update' onclick='SYS_editEnrollStudent($id)'><span class='glyphicon glyphicon-edit'></span></button></td>
            </tr>
            ";    
            }
            echo $str;
            ?> 
  