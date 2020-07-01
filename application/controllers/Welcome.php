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
			$this->load->view('forgotpassword/frmForgotpasswrod');
			$this->load->view('include/footer');
            $this->load->view('forgotpassword/forgotpassword_script');
		}catch (Exception $e){
			$data['message']= "Message:".$e->getMessage();
			$data['status']=false;
			$data['error']=true;
			echo json_encode($data);
			exit();
		}
    }
    public function other_login()
    {
        try{
            $this->load->view('include/header');
            $this->load->view('other_login/other_login');
            $this->load->view('include/footer');
            $this->load->view('other_login/other_login_script');
        }catch (Exception $e){
            $data['message']= "Message:".$e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
            exit();
        }
    }
    public function user_verification(){
        try{
            extract($_POST);
            $data=array();
            if(isset($txtUserVerification) && $txtUserVerification!=null){
                $isemail=false;
                $ismobile=false;
                if(preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/",$txtUserVerification)){
                    $data['message']="Its an email id.";
                    $isemail=true;
                }else if(preg_match("/[6,7,8,9]{1}+[0-9]{9}/",$txtUserVerification)){
                    $data['message']="Its a mobile number.";
                    $ismobile=true;
                }else{
                    $data['message']="Provided User id is not Valid.";
                    $data['status']=false;
                    echo json_encode($data);
                    exit();
                }
                if($isemail){
                    $where="vendormail='$txtUserVerification'";
                }else if($ismobile){
                    $where="vendorcontacts=$txtUserVerification";
                }else{
                    $data['message']="Error";
                    $data['data']="Something went wrong";
                    $data['status']=false;
                    echo json_encode($data);
                    exit();
                }
                $where.=" and isactive=true";
                $res=$this->Model_Db->select(10,null,$where);
                if($res!=false){
                    if(count($res)>1){
                        $data['message']="Duplicate userid exiests.";
                        $data['status']=false;
                    }else{
                        $data['message']="User is exits";
                        $data['status']=true;
                        $data['userid']=$res[0]->id;
//                        $otp=rand(324653,876532);
                        $otp=123456;
                        $mobile=$res[0]->vendorcontacts;
                        $message="Your login otp is - ".$otp.". Please do not share this with any one.";
                        $this->load->library("Sms");
                        $this->sms->send($mobile,$message);
                        echo json_encode($data);
                        $data['otp']=$otp;
                        $this->session->set_userdata('userVerification',$data);
                    }
                }else{
                    $data['message']="Error.";
                    $data['data']="No User Found.";
                    $data['status']=false;
                }
            }
//            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= "Message:".$e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
            exit();
        }
    }
    public function otp_verificaton(){
        try{
            extract($_POST);
            $status=true;
            $data=array();
            $insert=array();
            if(isset($txtOtpVerification) && is_numeric($txtOtpVerification) && isset($userid) && is_numeric($userid)){
                    if($this->session->userVerification['userid'] == $userid && $this->session->userVerification['otp']==$txtOtpVerification){
                        $data['message']="Successful.";
                        $data['data']="Otp Verification Successful";
                        $data['status']=true;
                        $data['userid']=$userid;

                    }else{
                        $data['message']="Error.";
                        $data['data']="password not found";
                        $data['status']=false;
                    }
            }else{
                $data['message']="Error.";
                $data['data']="password not found";
                $data['status']=false;
            }
            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= "Message:".$e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
            exit();
        }
    }
    public function password_reset(){
        try{
            extract($_POST);
            $status=true;
            $data=array();
            $insert=array();
            if(isset($txtResetPassword) && $txtResetPassword !=null){
                if(isset($txtReEnterResetPassword) && $txtReEnterResetPassword !=null){
                    if($txtResetPassword == $txtReEnterResetPassword){
                        if(isset($userid) && is_numeric($userid) && $this->session->userVerification['userid']== $userid){
                            $insert[0]['auth']= password_hash($txtResetPassword,PASSWORD_ARGON2I);
                            $where="id=$userid and isactive=true";
                            $insert[0]['updateby'] = $userid;
                            $insert[0]['updateat']=date("Y-m-d H:i:s");
                            $res=$this->Model_Db->update(10,$insert,"id",$userid);
                            if($res!=false){
                                $data['message']="Success.";
                                $data['data']="Password Reset Successfully";
                                $data['status']=true;
                                $this->session->unset_userdata(
                                    array(
                                        'userVerification'
                                    )
                                );
                            }else{
                                $data['message']="Error.";
                                $data['data']="Password could not reset";
                                $data['status']=false;
                            }
                        }else{
                            $data['message']="Error.";
                            $data['data']="Userid not found";
                            $data['status']=false;
                        }
                    }else{
                        $data['message']="Error.";
                        $data['data']="Password mismatch";
                        $data['status']=false;
                    }
                }else{
                    $data['message']="Error.";
                    $data['data']="password verification error";
                    $data['status']=false;
                }
            }else{
                $data['message']="Error.";
                $data['data']="password not found";
                $data['status']=false;
            }
            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= "Message:".$e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
            exit();
        }
    }
    public function other_user_verification(){
        try{
            extract($_POST);
            $data=array();
           if(isset($txtOtherUsertype) && is_numeric($txtOtherUsertype)){
               if(isset($txtUserVerification) && $txtUserVerification!=null){
                   $isemail=false;
                   $ismobile=false;
                   if(preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/",$txtUserVerification)){
                       $data['message']="Its an email id.";
                       $isemail=true;
                   }else if(preg_match("/[6,7,8,9]{1}+[0-9]{9}/",$txtUserVerification)){
                       $data['message']="Its a mobile number.";
                       $ismobile=true;
                   }else{
                       $data['message']="Provided User id is not Valid.";
                       $data['status']=false;
                       echo json_encode($data);
                       exit();
                   }
                   if($isemail){
                       $where="emailid='$txtUserVerification'";
                   }else if($ismobile){
                       $where="mobile=$txtUserVerification";
                   }else{
                       $data['message']="Error";
                       $data['data']="Something went wrong";
                       $data['status']=false;
                       echo json_encode($data);
                       exit();
                   }
                   $where.=" and isactive=true";
                   if($txtOtherUsertype==1){
                       $res=$this->Model_Db->select(32,null,$where);
                   }else if($txtOtherUsertype == 2){
                       $res=$this->Model_Db->select(33,null,$where);
                   }else{
                       $data['message']="Error";
                       $data['data']="Something went wrong";
                       $data['status']=false;
                       echo json_encode($data);
                       exit();
                   }
                   if($res!=false){
                       if(count($res)>1){
                           $data['message']="Duplicate userid exiests.";
                           $data['status']=false;
                       }else{
                           $data['message']="User is exits";
                           $data['status']=true;
                           $data['userid']=$res[0]->id;
                           $data['usertypeid']=$txtOtherUsertype;
//                        $otp=rand(324653,876532);
                           $otp=123456;
                           $mobile=$res[0]->emailid;
                           $message="Your login otp is - ".$otp.". Please do not share this with any one.";
                           $this->load->library("Sms");
                           $this->sms->send($mobile,$message);
                           echo json_encode($data);
                           $data['otp']=$otp;
                           $this->session->set_userdata('userVerification',$data);
                       }
                   }else{
                       $data['message']="Error.";
                       $data['data']="No User Found.";
                       $data['status']=false;
                   }
               }
           }else{
               $data['message']= "Error";
               $data['status']=false;
               $data['error']=true;
               echo json_encode($data);
               exit();
           }
//            echo json_encode($data);
        }catch (Exception $e){
            $data['message']= "Message:".$e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
            exit();
        }
    }
    public function other_user_otp_verificaton(){
        try{
            extract($_POST);
            $data=array();
            if(isset($txtOtherUserOtpVerification) && is_numeric($txtOtherUserOtpVerification) && isset($userid) && is_numeric($userid)){
                if($this->session->userVerification['userid'] == $userid && $this->session->userVerification['otp']==$txtOtherUserOtpVerification){
                    $data['message']="Successful.";
                    $data['data']="Otp Verification Successful";
                    $data['status']=true;
                     if($usertype==1){
                         $userid = $this->session->userVerification['userid'];
                         $where="id=$userid and isactive=true";
                         $res=$this->Model_Db->select(32,null,$where);
                             $info=array(
                                 'usertype'=>'Aggregator',
                                 'userid'=>$res[0]->id,
                                 'name'=>$res[0]->companyname,
                                 'contactnumber'=>$res[0]->mobile,
                                 'emailid'=>$res[0]->emailid
                             );
                     }else if ($usertype==2){
                         $userid = $this->session->userVerification['userid'];
                         $where="id=$userid and isactive=true";
                         $res=$this->Model_Db->select(33,null,$where);
                         $info=array(
                             'usertype'=>'Deliver Boy',
                             'userid'=>$res[0]->id,
                             'name'=>$res[0]->name,
                             'contactnumber'=>$res[0]->mobile,
                             'emailid'=>$res[0]->emailid
                         );
                     }else{
                         $data['message']="Error.";
                         $data['data']="Invalid data.";
                         $data['status']=false;
                         echo json_encode($data);
                         exit();
                     }
                    $this->session->unset_userdata(
                        array(
                            'userVerification'
                        )
                    );
                    $this->session->set_userdata('adminLogin',$info);
                }else{
                    $data['message']="Error.";
                    $data['data']="Otp Verification Failed";
                    $data['status']=false;
                }
            }else{
                $data['message']="Error.";
                $data['data']="Otp found";
                $data['status']=false;
            }
            echo json_encode($data);
            exit();
        }catch (Exception $e){
            $data['message']= "Message:".$e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
            exit();
        }
    }
}
