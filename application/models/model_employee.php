<?php 
//date_default_timezone_set('Asia/Karachi');
class model_employee extends CI_Model 
{
	public function __construct()	
	{
		  $this->load->database();
	}

	//Function get Employees
	public function GetEmployees()
	{	
		$WhereCondition = "";
		$sel_Employee     = $this->input->post('sel_Employee');
		if($sel_Employee != '' && $sel_Employee != 0)
		{
			$WhereCondition .= "AND tu.user_id = '$sel_Employee'";
		}

		$query  = $this->db->query(" 	
										SELECT * FROM `tbl_user` tu
										WHERE user_designation_id = 3
										$WhereCondition
									");
		$result = $query->result_array();			
		return $result;
	}
	//Function get All Employees
	public function GetAllEmployees()
	{	
		$WhereCondition = "";
		$query  = $this->db->query(" 	
										SELECT * FROM `tbl_user`
										WHERE user_designation_id = 3
										$WhereCondition
										ORDER BY user_name
									");
		$result = $query->result_array();			
		return $result;
	}
	//Function get all departments 
	public function GetAllDepartments()
	{	
		$WhereCondition = "";
		$query  = $this->db->query(" 	
									SELECT * FROM `tbl_user_department`
									");
		$result = $query->result_array();			
		return $result;
	}
	//Function get all designations
	public function GetAllDesignations()
	{	
		$WhereCondition = "";
		$query  = $this->db->query(" 	
									SELECT * FROM `tbl_user_designation`
									WHERE user_designation_id != 1
									");
		$result = $query->result_array();			
		return $result;
	}
	
	// Function Add employee
	public function AddEditEmployee()
	{
		$user_id = $this->session->userdata('user_id');
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
	    $Employee_id              	= $this->input->post('Employee_id');

	     // UPDATE CASE
	    if( $Employee_id != '')
        {
        	$query = $this->db->query("
									UPDATE tbl_user
									SET 
									user_name = '$txt_user_name',
									user_email = '$txt_user_email',
									user_phone= '$txt_user_phone',
									user_password= '$txt_user_password',
									user_salaryPerHour = '$txt_user_salaryPerHour',
									user_city = '$txt_user_city',
									user_state = '$txt_user_state',
									user_zip = '$txt_user_zip',
									user_country = '$txt_user_country'
									WHERE user_id = $Employee_id
								");
        }
        else //ADD CASE
        {
        	$query = $this->db->query("
									INSERT iNTO tbl_user
									(
										user_name,
										user_email,
										user_phone,
										user_password,
										user_department_id,
										user_salaryPerHour,
										user_city,
										user_state,
										user_zip,
										user_country,
										user_designation_id,
										CreatedBY
									)
									VALUES 
									(
									'$txt_user_name',
									'$txt_user_email',
									'$txt_user_phone',
									'$txt_user_password',
									'1 '/*Requested*/,
									'$txt_user_salaryPerHour',
									'$txt_user_city',
									'$txt_user_state',
									'$txt_user_zip',
									'$txt_user_country',
									'3',
									'$user_id'
									)	
								");
        }
		
	}
	//Function check if email already exist
	public function IsEmailAlreadyExist()
	{
		$txt_user_email              = $this->input->post('txt_user_email');
		$Employee_id               = $this->input->post('Employee_id');
		
		$WhereCondition = "";
		if($Employee_id != '' && $Employee_id != 0)
		{
			$WhereCondition = " AND tu.user_id != $Employee_id ";
		}
	  	$query  = $this->db->query(" 	
	  									SELECT user_id
	  									FROM `tbl_user` tu
										WHERE tu.user_email = '$txt_user_email'
										$WhereCondition
									");
		
		$result = $query->result_array();			
		return $result;
	}

	//Function check if employee already exist
	public function IsEmployeeAlreadyExist($Employee_id)
	{
	  	$query  = $this->db->query(" 	
	  									SELECT *
	  									FROM `tbl_user` tu
										WHERE tu.user_id = '$Employee_id'
										AND tu.user_designation_id = 3
									");
		
		$result = $query->result_array();			
		return $result;
	}


	public function GetWeeklyReports()
	{	
		$WhereCondition = "";
		$user_id = $this->session->userdata('user_id');

		$sel_Employee     = $this->input->post('sel_Employee');
		$sel_status     = $this->input->post('sel_status');
		$Report_date_from     = $this->input->post('Report_date_from');
		$Report_date_to     = $this->input->post('Report_date_to');


		if($sel_Employee != '' && $sel_Employee != 0)
		{
			$WhereCondition .= "AND tuwr.user_id = '$sel_Employee'";
		} 

		if($sel_status != ''  && $sel_status != 0 )
		{
			if($sel_status == 'Pending')
			{
				$WhereCondition .= "AND tuwr.user_WeeklyReport_isapproved != 1"; 
			}
			else
			{
				$WhereCondition .= "AND tuwr.user_WeeklyReport_isapproved = 1"; 
			}
		} 

		if(($Report_date_from != "" && $Report_date_to !="" && $Report_date_from <= $Report_date_to) )
		{	
			$Formated_Report_date_from = date('Y-m-d', strtotime($Report_date_from));
			$Formated_Report_date_to = date('Y-m-d', strtotime($Report_date_to));
			$WhereCondition .= "AND tuwr.user_WeeklyReport_Startdate BETWEEN '$Formated_Report_date_from' AND '$Formated_Report_date_to' ";
		}

		$query  = $this->db->query(" 	
									SELECT * ,
									(
									    SELECT tu.user_name
									    FROM tbl_user tu
									    WHERE tu.user_id = tuwr.user_id
									) as employee_name
									FROM tbl_user_weeklyreport tuwr
									WHERE 1 =1 
									$WhereCondition
									ORDER BY tuwr.user_WeeklyReport_Startdate DESC
									");
		
		$result = $query->result_array();			
		return $result;
	}





}