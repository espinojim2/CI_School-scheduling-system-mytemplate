
            <?php
            $lvlid=$_POST['lvlid'];
            $srch=($lvlid=="")?"":" and lvlid='$lvlid'";
            $str="";
            $q=$this->db->query("select * from sys_sections where 1 $srch order by seq");
            $r=$q->result_array();
            for($x=0;$x<count($r);$x++){
            $id=$r[$x]['sectid'];
            $sectcode=$r[$x]['sectcode'];
            $sectname=$r[$x]['sectname'];
            $sectdesc=$r[$x]['sectdesc'];
            $lvl=$this->mainmodel->level_data($r[$x]['lvlid']);
            $level=(isset($lvl[0]['lvlname']))?"":ucwords($lvl[0]['lvlname']);
            $rem=($r[$x]['remark']=='1')?"<span class='text-success'>Available</span>":"<span class='text-warning'>Not Available</span>";

            $str.="
            <tr>
            <td>".($x+1)."</td>
            <td>$id</td>
            <td>$sectcode</td>
            <td>$sectname</td>
            <td>$sectdesc</td>
            <td>$level</td>
            <td><b>$rem</b></td>
            <td><button class='btn' style='background:rgba(0,0,0,0)' title='Update' onclick='SYS_editSection($id)'><span class='glyphicon glyphicon-edit'></span></button></td>
            </tr>
            ";    
            }
            echo $str;
            ?> 
     