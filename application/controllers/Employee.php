<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends CI_Controller 
{

  public function __construct() {
    parent::__construct();

    if($this->session->userdata('user_id') == '' || $this->session->userdata('user_id') == 0){
      header('Location:'. base_url());
    }
    
   }

  public function index()
  {
  }

  public function ViewEmployees()
  {
    $data[] = "";
    $this->load->model('model_employee');

    $data['Employees'] = $this->model_employee->GetEmployees();
    $data['AllEmployees'] = $this->model_employee->GetAllEmployees();
    
    $this->load->view('user/ViewEmployees',$data);
  }

  public function WeeklyReports()
  {
    $data[] = "";
    $this->load->model('model_employee');
	
	$user_id = $this->session->userdata('user_id');
	$data['sel_Employee'] = $this->input->post('sel_Employee');
	if( $this->session->userdata('user_designation_id') == 3 )
	{
		$data['sel_Employee'] = $user_id;			
	}


    $data['WeeklyReports'] = $this->model_employee->GetWeeklyReports($data['sel_Employee']);
    $data['AllEmployees'] = $this->model_employee->GetAllEmployees();

	$data['IsShowAddWeeklyBtn'] = $this->session->userdata('user_designation_id') == 3;
	$data['IsEditAllow'] = $this->session->userdata('user_designation_id');
  $data['IsApproveAllow'] = $this->session->userdata('user_designation_id') == 2;
    $this->load->view('user/viewWeeklyReports',$data);
  }
  public function MarkApproved()
  {
		$this->load->model('model_employee');
		$user_WeeklyReport_id = $_POST['user_WeeklyReport_id'];
		$WhereArray = array();
		$WhereArray['user_WeeklyReport_id'] = $user_WeeklyReport_id;
		$WeeklyReportData['user_WeeklyReport_isapproved'] = 1;
		$this->model_employee->UpdateWeeklyReportData($WhereArray,$WeeklyReportData);
  }
  
  public function AddWeekData()
  {
    $data[] = "";
    $this->load->model('model_employee');
	$day = date('w');
	$data['WeekStart'] = date('d-m-Y', strtotime('-'.$day.' days'));
	$data['WeekEnd'] = date('d-m-Y', strtotime('+'.(6-$day).' days'));
	$data['Employee_id'] = $this->session->userdata('user_id');
	
	if (isset($_REQUEST['WeekStart']))
		$data['WeekStart'] = $_REQUEST['WeekStart'];
	if (isset($_REQUEST['WeekEnd']))
		$data['WeekEnd'] = $_REQUEST['WeekEnd'];
	if (isset($_REQUEST['Employee_id']))
		$data['Employee_id'] = $_REQUEST['Employee_id'];
	
	$UserWhereArray['user_id'] = $data['Employee_id'];
	$QEmployee = $this->model_employee->GetEmployeeData($UserWhereArray)[0];
	
	if( isset($_POST['btn_submitTimes_Add']) )
	{
		$date = $data['WeekStart'];
		$timeSpentArray = array();
		while (strtotime($date) <= strtotime($data['WeekEnd'])) 
		{
			$timeSpentArray[] = $_POST['timeSpent'.date ("Ymd",strtotime($date))];;
			$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
		}
		
		$this->db->trans_start();
		$WeeklyReportData['user_id'] = $data['Employee_id'];
		$WeeklyReportData['user_WeeklyReport_Startdate'] = $data['WeekStart'];
		$WeeklyReportData['user_WeeklyReport_Enddate'] = $data['WeekEnd'];
		$WeeklyReportData['user_WeeklyReport_isapproved'] = 0;
		$WeeklyReportData['user_WeeklyReport_TimeSpend'] = $this->AddPlayTime($timeSpentArray);
		$WeeklyReportData['user_WeeklyReport_SalaryPerHour'] = $QEmployee['user_salaryPerHour'];
		$WeeklyReportData['user_WeeklyReport_TotalSalary'] = $QEmployee['user_salaryPerHour'] * $this->AddPlayTime($timeSpentArray);
		$user_WeeklyReport_id = $this->model_employee->SaveWeeklyReportData($WeeklyReportData);
		
		$date = $data['WeekStart'];
		while (strtotime($date) <= strtotime($data['WeekEnd'])) 
		{
			$ReportData['user_id'] = $data['Employee_id'];
			$ReportData['user_DailyReport_date'] = date ("Y-m-d",strtotime($date));
			$ReportData['user_DailyReport_TimeStart'] = $_POST['HrFrom'.date ("Ymd",strtotime($date))];
			$ReportData['user_DailyReport_TimeEnd'] = $_POST['HrTo'.date ("Ymd",strtotime($date))];
			$ReportData['user_WeeklyReport_id'] = $user_WeeklyReport_id;
			$ReportData['user_DailyReport_isapproved'] = 0;
			$ReportData['user_DailyReport_TimeSpend'] = $_POST['timeSpent'.date ("Ymd",strtotime($date))];;
			$this->model_employee->SaveReportData($ReportData);
			
			$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
		}
		$this->db->trans_complete();
	}
	elseif( isset($_POST['btn_submitTimes_Update']) )
	{
		$date = $data['WeekStart'];
		$timeSpentArray = array();
		while (strtotime($date) <= strtotime($data['WeekEnd'])) 
		{
			$timeSpentArray[] = $_POST['timeSpent'.date ("Ymd",strtotime($date))];;
			$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
		}
		
		$this->db->trans_start();
		$WhereArray = array();
		$WhereArray['user_id'] = $data['Employee_id'];
		$WhereArray['user_WeeklyReport_Startdate'] = $data['WeekStart'];
		$WhereArray['user_WeeklyReport_Enddate'] = $data['WeekEnd'];
		$WeeklyReportData['user_WeeklyReport_TimeSpend'] = $this->AddPlayTime($timeSpentArray);
		$WeeklyReportData['user_WeeklyReport_SalaryPerHour'] = $QEmployee['user_salaryPerHour'];
		$WeeklyReportData['user_WeeklyReport_TotalSalary'] = $QEmployee['user_salaryPerHour'] * $this->AddPlayTime($timeSpentArray);
		$this->model_employee->UpdateWeeklyReportData($WhereArray,$WeeklyReportData);
		
		$date = $data['WeekStart'];
		$WhereArray = array();
		while (strtotime($date) <= strtotime($data['WeekEnd'])) 
		{
			$WhereArray['user_id'] = $data['Employee_id'];
			$WhereArray['user_DailyReport_date'] = date ("Y-m-d",strtotime($date));
			$ReportData['user_DailyReport_TimeStart'] = $_POST['HrFrom'.date ("Ymd",strtotime($date))];
			$ReportData['user_DailyReport_TimeEnd'] = $_POST['HrTo'.date ("Ymd",strtotime($date))];
			$ReportData['user_DailyReport_isapproved'] = 0;
			$ReportData['user_DailyReport_TimeSpend'] = $_POST['timeSpent'.date ("Ymd",strtotime($date))];;
			$this->model_employee->UpdateReportData($WhereArray,$ReportData);
			
			$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
		}
		$this->db->trans_complete();
	}
	
	$data['SavedReportData'] = $this->model_employee->GetSavedReportData($data['Employee_id'],date ("Y-m-d",strtotime($data['WeekStart'])),date ("Y-m-d",strtotime($data['WeekEnd'])));
	$WhereArray = array();
	$WhereArray['user_id'] = $data['Employee_id'];
	$WhereArray['user_WeeklyReport_Startdate'] = date ("Y-m-d",strtotime($data['WeekStart']));
	$WhereArray['user_WeeklyReport_Enddate'] = date ("Y-m-d",strtotime($data['WeekEnd']));
	$data['QWeeklyReportData'] = $this->model_employee->GetWeeklyReportData($WhereArray);
	
	$data['IsWeekAdded'] = count($data['SavedReportData']) > 0;
	$data['IsEditAllow'] = $this->session->userdata('user_designation_id') == 2; // 2 director
	if( count($data['QWeeklyReportData']) > 0 && $data['QWeeklyReportData'][0]['user_WeeklyReport_isapproved'] == 1 )
	{
		$data['IsEditAllow'] = false;
	}
	
	$this->load->view('user/AddWeekData',$data);
	}	
	function AddPlayTime($times) {

		$all_seconds=0;
		foreach ($times as $time) {
			list($hour, $minute, $second) = explode(':', $time);
			$all_seconds += $hour * 3600;
			$all_seconds += $minute * 60;
			$all_seconds += $second;

		}

		$total_minutes = floor($all_seconds/60);
		$seconds = $all_seconds % 60;
		$hours = floor($total_minutes / 60); 
		$minutes = $total_minutes % 60;

		// returns the time already formatted
		return $hours;
	}

  public function AddEditEmployee()
  {
    $this->load->model('model_employee');
      $data['error']="";
      $data['success']="";

      $Employee_id =$this->uri->segment(3);
      
      if($Employee_id != '')
      {
        $temp_Employee_id = '';
        $user_infos = $this->model_employee->IsEmployeeAlreadyExist($Employee_id);
        foreach($user_infos as $user_info)
        {
          $temp_Employee_id = $user_info['user_id'];
        }
        if($temp_Employee_id != 0 && $temp_Employee_id != '')
        {
          $data['Employee_id'] = $temp_Employee_id;

          $data['user_infos'] = $user_infos;
        }
      }
      $txt_user_name              = $this->input->post('txt_user_name');
      $txt_user_email             = $this->input->post('txt_user_email');
      $txt_user_phone             = $this->input->post('txt_user_phone');
      $txt_user_password          = $this->input->post('txt_user_password');
      $txt_retype_user_password   = $this->input->post('txt_retype_user_password');
      $txt_user_salaryPerHour     = $this->input->post('txt_user_salaryPerHour');
      $txt_user_city              = $this->input->post('txt_user_city');
      $txt_user_state             = $this->input->post('txt_user_state');
      $txt_user_zip               = $this->input->post('txt_user_zip');
      $txt_user_country           = $this->input->post('txt_user_country');
      
      if(isset($_POST['hdn_btn_createUser'])=="")
      {
      }
      else
      {
        if($txt_user_name == "")
        {
          $data['error'] = "Invalid user name";
        }
        elseif($txt_user_phone == "")
        {
          $data['error'] = "Invalid phone";
        }
        elseif($txt_user_email == "")
        {
          $data['error'] = "Invalid email";
        }
        elseif($txt_user_email != "")
        {

          $user_id =  $this->IsEmailAlreadyExist(); // Validate if the user email already exist.

          if($user_id == 0)
          {}
          else
          {
            $data['error'] = "This user name already exist. Try another one";
          }
        }

        if($txt_user_password == "")
        {
          $data['error'] = "Please provide password";
        }
        elseif($txt_retype_user_password == "")
        {
          $data['error'] = "Please provide Re-password";
        }
        elseif($txt_retype_user_password != $txt_user_password)
        {
          $data['error'] = "Password not match";
        }
        elseif($txt_user_city == "")
        {
          $data['error'] = "Please provide City";
        }
        elseif($txt_user_state == "")
        {
          $data['error'] = "Please provide State";
        }
        elseif($txt_user_zip == "")
        {
          $data['error'] = "Please provide Zip";
        }
        elseif($txt_user_country == "")
        {
          $data['error'] = "Please provide Country";
        }
        else{}


        if($data['error'] == "")
        {
          $this->model_employee->AddEditEmployee(); //Call the model function to Add new user
          
          // $data['success'] == "You have succesfully signup";
          
          // // Set flash data 
          // $this->session->set_flashdata('success_signup', 'You have successfully signup !! Please varify your account bu clicking on link send in the email & login to continue.');
          header('Location:'. base_url().'Employee/ViewEmployees');
        }
        else
        {

        }
      }
      $data['AllDepartments'] = $this->model_employee->GetAllDepartments();
      $data['AllDesignations'] = $this->model_employee->GetAllDesignations();
  
      $this->load->view('user/AddEditEmployee',$data);
    
  }

  public function AddEditWeeklyReport()
  {
    //$this->load->model('model_user');
    $this->load->model('model_employee');
    $this->load->model('model_common');
      $data['error']="";
      $data['success']="";

      $txt_first_name             = $this->input->post('txt_first_name');
      $txt_last_name              = $this->input->post('txt_last_name');
      $txt_user_name              = $this->input->post('txt_user_name');
      $txt_password               = $this->input->post('txt_password');
      $txt_retype_password        = $this->input->post('txt_retype_password');
      $phoneNo                    = $this->input->post('phoneNo');
      $txt_cnic                   = $this->input->post('txt_cnic');

      $sel_city                  = $this->input->post('sel_city');
      $user_type                  = $this->input->post('user_type');
      $txt_email                  = $this->input->post('txt_email');
      $sel_doctor_category        = $this->input->post('sel_doctor_category');

      if(isset($_POST['hdn_btn_createUser'])=="")
      {
      }
      else
      {
        if($txt_first_name == "")
        {
          $data['error'] = "Invalid first name";
        }
        elseif($txt_last_name == "")
        {
          $data['error'] = "Invalid last name";
        }
        elseif($txt_user_name == "")
        {
          $data['error'] = "Invalid user name";
        }
        elseif($txt_user_name != "")
        {

          $user_id =  $this->IsUserNameAlreadyExist(); // Validate if the user email already exist.

          if($user_id == 0)
          {}
          else
          {
            $data['error'] = "This user name already exist. Try another one";
          }
        }
        
        if($txt_email == "" )
        {
          $data['error'] = "Invalid email";
        }
        elseif($phoneNo == "")
        {
          $data['error'] = "Invalid Phone no";
        }
        elseif($txt_cnic == "")
        {
          $data['error'] = "Invalid cnic";
        }
        elseif($sel_city == "" || $sel_city == 0)
        {
          $data['error'] = "Invalid city";
        }
        elseif($user_type == "" || $user_type == 0)
        {
          $data['error'] = "Invalid user type";
        }
        elseif($user_type == 1 && ($sel_doctor_category == 0 || $sel_doctor_category == '')) /* 1- doctor*/
        {
          $data['error'] = "Invalid doctor category";
        }
        elseif($txt_password == "")
        {
          $data['error'] = "Please provide password";
        }
        elseif($txt_retype_password == "")
        {
          $data['error'] = "Please provide Re-password";
        }
        elseif($txt_password != $txt_retype_password)
        {
          $data['error'] = "Password not match";
        }
        else{}
        if($data['error'] == "")
        {
          $LatestUserId = $this->model_user->AddNewuser(); //Call the model function to Add new user

      
          $data['success'] == "You have succesfully signup";
          
          // Set flash data 
          $this->session->set_flashdata('success_signup', 'You have successfully signup !! Please varify your account bu clicking on link send in the email & login to continue.');
          
          
          header('Location:'. base_url().'');
        }
        else
        {

        }
      }
      $data['user_designations'] = $this->model_common->getuser_designation($getCustomField=2); // 2 - cities 

      $this->load->view('user/AddEditEmployee',$data);
    
  }

  public function IsEmailAlreadyExist($Isajaxcall='')
  {
    $this->load->model('model_employee');
    $Isajaxcall               = $this->input->post('Isajaxcall');
    $Employee_id               = $this->input->post('Employee_id');
    $user_id= 0;
    $user_infos = $this->model_employee->IsEmailAlreadyExist();
    foreach($user_infos as $user_info)
    {
      $user_id = $user_info['user_id'];
    }
    if($user_id != 0 && $user_id != '')
    {
      if($Isajaxcall == 1)
      {
        echo "Already Exist";
      }
      else
      {
        return $user_id;
      }
    }
    else
    {
      if($Isajaxcall == 1)
      {
        echo "Already Not Exist";
      }
      else
      {
        return 0;
      }
      
    }
  }

  public function Leaves()
  {
    $data[] = "";
    $this->load->model('model_employee');
  
  $user_id = $this->session->userdata('user_id');
  $data['sel_Employee'] = $this->input->post('sel_Employee');
  if( $this->session->userdata('user_designation_id') == 3 )
  {
    $data['sel_Employee'] = $user_id;     
  }


    $data['Leaves'] = $this->model_employee->GetLeaves($data['sel_Employee']);
    $data['AllEmployees'] = $this->model_employee->GetAllEmployees();

  $data['IsShowAddWeeklyBtn'] = $this->session->userdata('user_designation_id') == 3;
  $data['IsEditAllow'] = $this->session->userdata('user_designation_id');
  $data['IsApproveAllow'] = $this->session->userdata('user_designation_id') == 2;
    $this->load->view('user/viewLeaves',$data);
  }

  public function MarkLeaveApproved()
  {
    $this->load->model('model_employee');
    $user_Leave_id = $_POST['user_Leave_id'];
    $WhereArray = array();
    $WhereArray['user_Leave_id'] = $user_Leave_id;
    $WeeklyReportData['user_Leave_isapproved'] = 1;
    $this->model_employee->UpdateLeaveData($WhereArray,$WeeklyReportData);
  }

   public function IsLeaveAlreadyExist($Isajaxcall='')
  {
    $this->load->model('model_employee');
    $Isajaxcall               = $this->input->post('Isajaxcall');
    $user_Leave_id= 0;
    $user_infos = $this->model_employee->IsLeaveAlreadyExist();
    foreach($user_infos as $user_info)
    {
      $user_Leave_id = $user_info['user_Leave_id'];
    }
    if($user_Leave_id != 0 && $user_Leave_id != '')
    {
      if($Isajaxcall == 1)
      {
        echo "Already Exist";
      }
      else
      {
        return $user_Leave_id;
      }
    }
    else
    {
      if($Isajaxcall == 1)
      {
        echo "Already Not Exist";
      }
      else
      {
        return 0;
      }
      
    }
  }

  public function AddEditLeave()
  {
    $this->load->model('model_employee');
      $data['error']="";
      $data['success']="";

      $txt_user_Leave_date             = $this->input->post('txt_user_Leave_date');
      $txt_user_Leave_desciption           = $this->input->post('txt_user_Leave_desciption');
      
      if(isset($_POST['hdn_btn_addLeave'])=="")
      {
      }
      else
      {
        if($txt_user_Leave_date == "")
        {
          $data['error'] = "Please enter date";
        }
        elseif(trim($txt_user_Leave_desciption) == "")
        {
          $data['error'] = "Please enter Description";
        }
        elseif($txt_user_Leave_date != "")
        {

          $user_Leave_id =  $this->IsLeaveAlreadyExist(); // Validate if the user email already exist.

          if($user_Leave_id == 0)
          {}
          else
          {
            $data['error'] = "Leave already exist for this date. Try another one";
          }
        }

        if($data['error'] == "")
        {
          $user_id = $this->session->userdata('user_id');
          $Formated_user_Leave_date = date('Y-m-d', strtotime($txt_user_Leave_date));

          $LeaveData['user_id'] = $user_id;
          $LeaveData['user_Leave_date'] = $Formated_user_Leave_date;
          $LeaveData['user_Leave_desciption'] = trim($txt_user_Leave_desciption);
          $LeaveData['user_Leave_isapproved'] = 0;
          $user_user_leave_id = $this->model_employee->SaveleavesData($LeaveData);
          header('Location:'. base_url().'Employee/Leaves');
        }
        else
        {

        }
      }
  
      $this->load->view('user/AddEditLeave',$data);
    
  }

  
}