<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Welcome extends CI_Controller {

	public function index()
	{
		try{
			if(isset($this->session->login['userid'])){
				redirect('Dashboard/');
			}else{
				$this->load->view('login');
			}
		}catch (Exception $e){
			$data['message']= "Message:".$e->getMessage();
			$data['status']=false;
			$data['error']=true;
			echo json_encode($data);
			exit();
		}
	}
    public function forgot_password()
    {
		try{
			$this->load->view('include/header');
			$this->load->view('forgotpassword/forgotpassword');
			$this->load->view('include/footer');
		}catch (Exception $e){
			$data['message']= "Message:".$e->getMessage();
			$data['status']=false;
			$data['error']=true;
			echo json_encode($data);
			exit();
		}
    }

}
