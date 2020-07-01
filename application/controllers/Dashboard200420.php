<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
header("Access-Control-Allow-Origin: *");

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		try{
			if(isset($this->session->adminLogin['userid'])){
				$this->load->view('include/header');
				$this->load->view('include/topbar');
				$this->load->view('include/sidebar');
				$this->load->view('Dashboard/dashboard');
				$this->load->view('include/footer');
				$this->load->view('Dashboard/dashboard_script');
			}else{
				redirect('Welcome/');
			}
		}catch (Exception $e){
			$data['message']= "Message:".$e->getMessage();
			$data['status']=false;
			$data['error']=true;
			echo json_encode($data);
			exit();
		}
	}
}
