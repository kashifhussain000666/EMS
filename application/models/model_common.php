<?php 
//date_default_timezone_set('Asia/Karachi');
class model_common extends CI_Model 
{
	public function __construct()	

	{
		  $this->load->database();
	}

	public function getuser_designation()
	{
		$query  = $this->db->query(" 	
										SELECT * 
										FROM `tbl_user_designation`
										WHERE user_designation_id != 1
									");
		
		$result = $query->result_array();			
		return $result;
	}



	public function sendmail()
	{
		
	}


}