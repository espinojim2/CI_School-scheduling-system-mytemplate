
            <?php
            $str="";
            $q=$this->db->query("select * from sys_levels where 1 order by seq");
            $r=$q->result_array();
            for($x=0;$x<count($r);$x++){
            $id=$r[$x]['lvlid'];
            $lvlcode=$r[$x]['lvlcode'];
            $lvlname=$r[$x]['lvlname'];
            $rem=($r[$x]['remark']=='1')?"<span class='text-success'>Available</span>":"<span class='text-warning'>Not Available</span>";

            $str.="
            <tr>
            <td>".($x+1)."</td>
            <td>$id</td>
            <td>$lvlcode</td>
            <td>$lvlname</td>
            <td><b>$rem</b></td>
            <td><button class='btn' style='background:rgba(0,0,0,0)' title='Update' onclick='SYS_editLevel($id)'><span class='glyphicon glyphicon-edit'></span></button></td>
            </tr>
            ";    
            }
            echo $str;
            ?> 
     