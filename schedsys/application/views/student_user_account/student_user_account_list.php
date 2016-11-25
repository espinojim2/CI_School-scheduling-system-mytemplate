
            <?php
            $str="";
            $q=$this->db->query("select * from sys_p_account where 1 and  pid in(select pid from sys_s_student where remark='1') order by accountTypeId");
            $r=$q->result_array();
            for($x=0;$x<count($r);$x++){
            $id=$r[$x]['accountId'];
            $pid=$r[$x]['pid'];
            $accountTypeId=$r[$x]['accountTypeId'];
            $username=$r[$x]['username'];

            $rem=($r[$x]['active']=='1')?"<span class='text-success'>Active</span>":"<span class='text-warning'>Inactive</span>";
            
            $person=$this->mainmodel->person_data($pid);
            $usrtyp=$this->mainmodel->getAccountType_Data($accountTypeId);

            $name=ucwords($person[0]['lname']." ".$person[0]['ename'].", ".$person[0]['fname']." ".$person[0]['mname']);
            $userType=$usrtyp[0]['accountType'];
            $str.="
            <tr>
            <td>".($x+1)."</td>
            <td>$name</td>
            <td>$userType</td>
            <td>$username</td>
            <td><b>$rem</b></td>
            <td><button class='btn' style='background:rgba(0,0,0,0)' title='Update' onclick='SYS_editUserAccount($id)'><span class='glyphicon glyphicon-edit'></span></button></td>
            </tr>
            ";    
            }
            echo $str;
            ?> 
