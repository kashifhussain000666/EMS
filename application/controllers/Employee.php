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

    $data['WeeklyReports'] = $this->model_employee->GetWeeklyReports();
    $data['AllEmployees'] = $this->model_employee->GetAllEmployees();

    $this->load->view('user/viewWeeklyReports',$data);
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

  
}