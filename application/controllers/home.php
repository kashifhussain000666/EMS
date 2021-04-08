<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

  public function __construct() {
    parent::__construct();
    
     if($this->session->userdata('user_id') == '' || $this->session->userdata('user_id') == 0){
      header('Location:'. base_url());
    }
   }

  public function index()
  {
  	$this->load->helper('url'); // load helper fuction

    $this->load->model('model_common');
    if($this->session->userdata('user_id') != '' || $this->session->userdata('user_id') != 0){
    }
    else
    {
    }
    $data[] = "";
    $this->load->view('user/home',$data);
  }
  public function login()
  { 
    $this->load->view('user/login');
  }
  
  public function GetuserInfo($user_id)
  {
    $this->load->model('model_user');
    $user_info =  $this->model_user->LoginUser();
    return $user_info; 
  }

 
}