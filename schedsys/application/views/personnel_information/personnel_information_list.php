
            <?php
            $str="";
            $q=$this->db->query("select * from sys_p_person where 1 and not pid in(select pid from sys_s_student) order by lname,remark");
            $r=$q->result_array();
            for($x=0;$x<count($r);$x++){
            $id=$r[$x]['pid'];
            $name=ucwords($r[$x]['lname']." ".$r[$x]['ename'].", ".$r[$x]['fname']." ".$r[$x]['mname']);
            $gen=($r[$x]['gender']=='m')?"Male":"Female"; 
            $contact=$r[$x]['contact'];
            $rem=($r[$x]['remark']=='1')?"<span class='text-success'>Active</span>":"<span class='text-warning'>Inactive</span>";

            $str.="
            <tr>
            <td>".($x+1)."</td>
            <td>$id</td>
            <td>$name</td>
            <td>$gen</td>
            <td>$contact</td>
            <td><b>$rem</b></td>
            <td><button class='btn' style='background:rgba(0,0,0,0)' title='Update' onclick='SYS_editPersonnel($id)'><span class='glyphicon glyphicon-edit'></span></button></td>
            </tr>
            ";    
            }
            echo $str;
            ?> 
  