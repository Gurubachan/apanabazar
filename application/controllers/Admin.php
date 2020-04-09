<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
header("Access-Control-Allow-Origin: *");
class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function check_login(){
		try{
			$data=array();
			$status=false;
			$request=json_decode(json_encode($_POST));
			if(isset($request)){
				if(isset($request->username) && $request->username!=null){
					$isemail=false;
					$ismobile=false;
					if(preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/",$request->username)){
						$data['message']="Its an email id.";
						$isemail=true;
					}else if(preg_match("/[6,7,8,9]{1}+[0-9]{9}/",$request->username)){
						$data['message']="Its a mobile number.";
						$ismobile=true;
					}else{
						$data['status']=false;
						$data['message']="Invalid User id.";
						echo json_encode($data);
						exit();
					}
					if($isemail){
						$where="='emailid=$request->username' ";
					}else if($ismobile){
						$where="contactnumber=$request->username ";
					}
					$where.=" and isactive=true";
					$res=$this->Model_Db->select(1,null,$where);
					if($res!=false){
						if(count($res)>1){
							$data['status']=false;
							$data['message']="Uexpected error occoured.Please contact admin.";
						}else{
							if($res[0]->authactive==true && password_verify($request->password,$res[0]->auth)){
								$data['message']="Password matched.";
								$data['status']=true;
								$info=array(
									'userid'=>$res[0]->id,
									'companyid'=>$res[0]->companyid,
									'name'=>$res[0]->name,
									'contactnumber'=>$res[0]->contactnumber,
									'emailid'=>$res[0]->emailid,
									'address'=>$res[0]->address,
									'contactverified'=>$res[0]->contactverified,
									'emailverified'=>$res[0]->emailverified,
									'address'=>$res[0]->address,
									'iscomplete'=>$res[0]->iscomplete,
								);
								$this->session->set_userdata('adminLogin',$info);
							}else{
								$data['message']="Wrong Password.";
								$data['status']=false;
							}
						}
					}else{
						$data['status']=false;
						$data['message']="Userid doesnot exist.";
					}
				}else{
					$data['status']=false;
					$data['message']="No Userid entered.";
				}
				echo json_encode($data);
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
