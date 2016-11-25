
            <?php
            $str="";
            $q=$this->db->query("select * from sys_schoolyear where 1 order by strt");
            $r=$q->result_array();
            for($x=0;$x<count($r);$x++){
            $id=$r[$x]['syid'];
            $strt=$r[$x]['strt'];
            $end=$r[$x]['end'];

            $e1=explode("-",$strt); 
            $e2=explode("-",$end);
            $sy=$e1[0]." - ".$e2[0]; 
            $rem=($r[$x]['remark']=='1')?"<span class='text-success'>Enabled</span>":"<span class='text-warning'>Disabled</span>";

            $str.="
            <tr>
            <td>".($x+1)."</td>
            <td>$id</td>
            <td>$strt</td>
            <td>$end</td>
            <td>$sy</td>
            <td><b>$rem</b></td>
            <td><button class='btn' style='background:rgba(0,0,0,0)' title='Update' onclick='SYS_editSY($id)'><span class='glyphicon glyphicon-edit'></span></button></td>
            </tr>
            ";    
            }
            echo $str;
            ?> 
     