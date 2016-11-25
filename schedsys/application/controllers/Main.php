<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function links(){
        $str='<link rel="stylesheet" type="text/css" href="' . base_url() . 'resources/bootstrap3/css/bootstrap.min.css"></link>
              <link rel="stylesheet" type="text/css" href="' . base_url() . 'resources/datatable/datatables.bootstrap.min.css"></link>
              <link rel="stylesheet" type="text/css" href="' . base_url() . 'resources/bootdate/css/bootstrap-datepicker.min.css"></link>
              <link rel="shortcut icon" href="' . base_url() . 'resources/images/logo.png"></link>
             <link rel="stylesheet" type="text/css" href="' . base_url() . 'resources/template/template.css"></link>
             <link rel="stylesheet" type="text/css" href="' . base_url() . 'resources/template/simple-sidebar.css"></link>

             <script type="text/javascript" src="' . base_url() . 'resources/jquery.min.js"></script>

             <script type="text/javascript" src="' . base_url() . 'resources/bootstrap3/js/bootstrap.min.js"></script>
             <script type="text/javascript" src="' . base_url() . 'resources/bootbox/bootbox.min.js"></script> 
             <script type="text/javascript" src="' . base_url() . 'resources/bootdate/js/bootstrap-datepicker.min.js"></script> 
             <script type="text/javascript" src="' . base_url() . 'resources/jseDialog/jseDialog.js"></script>
             <script type="text/javascript" src="' . base_url() . 'resources/datatable/jquery.dataTables.min.js"></script> 
             <script type="text/javascript"  src="' . base_url() . 'resources/datatable/dataTables.bootstrap.min.js"></script>
             <script type="text/javascript" charset="utf8" src="' . base_url() . 'resources/datatable/dataTables.min.js"></script>
             

             
             <script type="text/javascript" src="' . base_url() . 'resources/jscripts/script.js"></script>
            
             <script type="text/javascript"> 
                var URL = "'.base_url().'";
                var cURL = "'.current_url().'";
               
             </script> ';
     return $str;	
	}


	public function index()
	{
		$this->login();
	}

    public function login(){
        $data['extraHeadContent'] = $this->links();
         $data['title']="Scheduling System";
        $this->load->view("login/login",$data);
    }
    public function loadLogout(){
     $this->load->view("login/logout");
    }

    public function loadLoginProcess(){
     $this->load->model("mainmodel");   
     $this->load->view("login/login_process");   
    }

    public function loadSidebar(){
        $this->load->model("mainmodel");
     $this->load->view("sidebar/sidebar");   
    }

    
	public function pages($pageId,$accountId){
		 $pagedata=$this->mainmodel->getSystemPagesDatas($pageId);
         $moduleId=$pagedata[0]['moduleId'];
         $mod=$this->mainmodel->detModuleData($moduleId);
         $pageAlias=$pagedata[0]['pageAlias'];
         $modName=$mod[0]['moduleName'];
         $data['extraHeadContent'] = $this->links();
         $data['pagetitle']=$modName."/".$pagedata[0]['pageName'];
         $data['title']="Scheduling System";
          if($this->mainmodel->hasAccess($accountId)){ $this->load->view("$pageAlias/$pageAlias",$data); }
          else{ $this->load->view("zno_access/zno_access",$data); }       
         
	}

public function locateNOACCESS(){
   $this->load->view("znoaccess/no_access");  
}





	/***********Links****************/
public function locateDashboard(){
$this->load->view("dashboard/dashboard_main");	
}	

/*   Systempages   */
public function locateSystempages(){
$this->load->view("system_template/system_template_main");	
}

public function set_page_template(){
$this->load->view("system_template/system_template_set");    
}

public function page_template_save(){

$this->load->view("system_template/system_template_save");    
}

public function loadPageTemplateUpdateAuthorization(){

$this->load->view("system_template/system_template_updatepageAuthorization");
}

/*  System Privilege */
public function locateSystemprivilege(){
$this->load->view("system_privilege/system_privilege_main");      
}
public function page_autorization_setEmployeeOpt(){
$this->load->view("system_privilege/system_privilege_person_options");    
}
public function set_page_authorization(){
$this->load->view("system_privilege/system_privilege_set");    
}

public function page_authorization_save(){    
$this->load->view("system_privilege/system_privilege_save");    
} 

/* Personnel Info */
public function locatePersonInfo(){
$this->load->view("personnel_information/personnel_information_main");   
}
public function loadAddPersonnelForm(){
$this->load->view("personnel_information/personnel_information_form");    
}
public function loadPersonSave(){
$this->load->view("personnel_information/personnel_information_save");    
}
public function loadPersonList(){
$this->load->view("personnel_information/personnel_information_list");    
}

/* School Year Management */
public function locateSchoolYearSetup(){
$this->load->view("schoolyear_setup/schoolyear_setup_main");     
}
public function loadAddSYForm(){
$this->load->view("schoolyear_setup/schoolyear_setup_form");    
}
public function loadSYSave(){
$this->load->view("schoolyear_setup/schoolyear_setup_save");    
}
public function loadSYList(){
$this->load->view("schoolyear_setup/schoolyear_setup_list");    
}
/* Room Management */
public function locateRoomSetup(){
$this->load->view("room_management/room_management_main");    
}
public function loadAddRoomForm(){
$this->load->view("room_management/room_management_form");    
}
public function loadRoomSave(){
$this->load->view("room_management/room_management_save");    
}
public function loadRoomList(){
$this->load->view("room_management/room_management_list");    
}
/* Level Setup */
public function locateLevelSetup(){
$this->load->view("level_setup/level_setup_main");    
}
public function loadAddLevelForm(){
$this->load->view("level_setup/level_setup_form");    
}
public function loadLevelSave(){
$this->load->view("level_setup/level_setup_save");    
}
public function loadLevelList(){
$this->load->view("level_setup/level_setup_list");    
}
/* Section Setup */
public function locateSectionSetup(){
$this->load->view("section_setup/section_setup_main");    
}
public function loadAddSectionForm(){
$this->load->view("section_setup/section_setup_form");    
}
public function loadSectionSave(){
$this->load->view("section_setup/section_setup_save");    
}
public function loadSectionList(){
$this->load->view("section_setup/section_setup_list");    
}


/*User Accounts*/
public function locateUserAccounts(){
$this->load->view("user_accounts/user_accounts_main");       
}
public function loadAddUserAccountForm(){
$this->load->view("user_accounts/user_accounts_form");    
}
public function loadUserAccountSave(){
$this->load->view("user_accounts/user_accounts_save");    
}
public function loadUserAccountList(){
$this->load->view("user_accounts/user_accounts_list");    
}


/* Student Information */
public function locateStudentInfomain(){
$this->load->view("student_information/student_information_main");     
}
public function loadStudentRegisterMain(){
$this->load->view("student_information/student_registration_main");    
}
public function loadAddStudentForm(){
$this->load->view("student_information/student_registration_form");    
}
public function loadStudentSave(){
$this->load->view("student_information/student_registration_save");    
}
public function loadStudentList(){
$this->load->view("student_information/student_registration_list");     
}
public function loadStudentEnrollMain(){
$this->load->view("student_information/student_enroll_main");     
}
public function loadEnrollStudentForm(){
$this->load->view("student_information/student_enroll_form");    
}
public function loadEnrollStudentSave(){
$this->load->view("student_information/student_enroll_save");    
}
public function loadEnrollStudentList(){
$this->load->view("student_information/student_enroll_list");       
}

/* Student User Account */
public function locateStudentUserAccountmain(){
$this->load->view("student_user_account/student_user_account_main");         
}
public function loadStudentUserAccountList()
{
$this->load->view("student_user_account/student_user_account_list");    
}
public function loadStudentAddUserAccountForm(){
$this->load->view("student_user_account/student_user_account_form");    
}
/* Teacher Assignment */
public function locateTeacherAssignMain(){
$this->load->view("teacher_assignment/teacher_assignment_main");     
}
public function loadTeacherAssignmentList(){
$this->load->view("teacher_assignment/teacher_assignment_list");    
}
public function loadTeaxherTransferSave(){
$this->load->view("teacher_assignment/teacher_assignment_save");    
}


/* Schedule Management */
public function locateScheduleManagementMain(){
$this->load->view("schedule_management/schedule_management_main");    
}
public function loadAddScheduleForm(){
$this->load->view("schedule_management/schedule_management_form");        
}
public function loadScheduleSave(){
$this->load->view("schedule_management/schedule_management_save");    
}
public function loadScheduleList()
{
$this->load->view("schedule_management/schedule_management_list");    
}
public function loadScheduleDelete()
{
$this->load->view("schedule_management/schedule_management_delete");    
}

/*Class Schedule */
public function locateClassSchedule(){
$this->load->view("class_schedule/class_schedule_main");    
}
public function loadSchedulePrintList(){
$this->load->view("class_schedule/class_schedule_print");      
}
public function loadClassScheduleList()
{
$this->load->view("class_schedule/class_schedule_list");          
}

/*Teacher Schedule Management */
public function locateTeacherScheduleMain(){
$this->load->view("teacher_schedule/teacher_schedule_main");    
}
public function loadTeacherScheduleList(){
$this->load->view("teacher_schedule/teacher_schedule_list");      
}
public function loadTeacherSchedulePrintList(){
$this->load->view("teacher_schedule/teacher_schedule_print");    
}

/* My Schedule */
public function locateMyScheduleMain(){
$this->load->view("my_schedule/my_schedule_main");     
}
public function loadMyLevels(){
$this->load->view("my_schedule/my_schedule_setLevel");    
}
public function loadMySections(){
$this->load->view("my_schedule/my_schedule_setSections");
}

/* Option tags */
public function loadUserByUserTypeOptions(){
$this->load->view("optiontags/user_by_accounttype_options");    
}
public function loadSectionOptions(){
$this->load->view("optiontags/section_options");    
}
public function loadStudentUserByUserTypeOptions(){
$this->load->view("optiontags/user_by_student_accounttype_options");    
}


}
