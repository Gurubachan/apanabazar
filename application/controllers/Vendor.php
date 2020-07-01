<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
header("Access-Control-Allow-Origin: *");
class Vendor extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function new_registrtion(){
	    try{
        $this->load->view('vendor_registration');
        }catch (Exception $e){
	        echo "Message:".$e->getMessage();
        }
    }
    public function vendorlist()
    {
        try{
            if(isset($this->session->adminLogin['userid'])){
                $this->load->view('include/header');
                $this->load->view('include/topbar');
                $this->load->view('include/sidebar');
                $this->load->view('Vendor/vendor_list');
                $this->load->view('include/footer');
                $this->load->view('Vendor/vendor_list_script');
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
						$where="vendormail='$request->username' ";
					}else if($ismobile){
						$where="vendorcontacts=$request->username";
					}
					$where.=" and isactive=true";
					$res=$this->Model_Db->select(10,null,$where);
					if($res!=false){
						if(count($res)>1){
							$data['status']=false;
							$data['message']="Uexpected error occoured.Please contact admin.";
						}else{
							if($res[0]->authactive==true && password_verify($request->password,$res[0]->auth)){
								$data['message']="Password matched.";
								$data['status']=true;
                                $id=$res[0]->id;
					            $where="vendorid=$id and isactive=true";
                                $res_vb=$this->Model_Db->select(12,null,$where);
                                $bankname="";
                                $accountnumber="";
                                $accountholdername="";
                                $ifsccode="";
                                if($res_vb!=false){
                                    if($res_vb[0]->bankname!=null){
                                        $bankname = $res_vb[0]->bankname;
                                    }else{
                                        $bankname="";
                                    }
                                    if($res_vb[0]->accountnumber!=null){
                                        $accountnumber = $res_vb[0]->accountnumber;
                                    }else{
                                        $accountnumber="";
                                    }
                                    if($res_vb[0]->accountholdername!=null){
                                        $accountholdername = $res_vb[0]->accountholdername;
                                    }else{
                                        $accountholdername="";
                                    }
                                    if($res_vb[0]->ifsccode!=null){
                                        $ifsccode = $res_vb[0]->ifsccode;
                                    }else{
                                        $ifsccode="";
                                    }
                                }
                                $info=array(
                                    'usertype'=>'Vendor',
                                    'userid'=>$res[0]->id,
                                    'vendortypeid'=>$res[0]->vendortypeid,
                                    'name'=>$res[0]->vendorname,
                                    'contactnumber'=>$res[0]->vendorcontacts,
                                    'altcontact'=>$res[0]->altcontact,
                                    'emailid'=>$res[0]->vendormail,
                                    'address'=>$res[0]->vendoraddress,
                                    'ownername'=>$res[0]->ownername,
                                    'pincode'=>$res[0]->pincode,
                                    'photograph'=>$res[0]->photograph,
                                    'gstnumber'=>$res[0]->gstnumber,
                                    'pannumber'=>$res[0]->pannumber,
                                    'aadharnumber'=>$res[0]->aadharnumber,
                                    'companydetails'=>$res[0]->companydetails,
                                    'flagid'=>$res[0]->flagid,
                                    'bankname'=>$bankname,
                                    'accountnumber'=>$accountnumber,
                                    'accountholdername'=>$accountholdername,
                                    'ifsccode'=>$ifsccode,
                                    'iscomplete'=>$res[0]->iscomplete
                                );
								$this->session->set_userdata('adminLogin',$info);
								$this->session->set_userdata('ismodalshown',0);
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
    public function new_registration(){
        try{
                $data=array();
                $insertvendor=array();
                $insertbank=array();
                $status=true;
                $request = json_decode(json_encode($_POST), false);
                if(isset($request->inputVendorTypeId) && preg_match("/^[0-9]{1,2}$/",$request->inputVendorTypeId )){
                    $insertvendor[0]['vendortypeid']=$request->inputVendorTypeId ;
                }else{
                    $status=false;
                    $data['title'] = "Error!!";
                    $data['message'] = "Select Vendor Type";
                }
                if(isset($request->txtVendorName) && preg_match("/[a-zA-Z0-9 ]{3,50}$/",$request->txtVendorName )){
                    $insertvendor[0]['vendorname']=$request->txtVendorName ;
                }else{
                    $status=false;
                    $data['title'] = "Error!!";
                    $data['message'] = "Enter a Valid Vendor Name";
                }

                if(isset($request->inputContactNumber) && preg_match("/^[6,7,8,9]{1}[0-9]{9}$/",$request->inputContactNumber )){
                    $insertvendor[0]['vendorcontacts']=$request->inputContactNumber ;
                }else{
                    $status=false;
                    $data['title'] = "Error!!";
                    $data['message'] = "Enter a Valid Mobile Number";
                }

                if(isset($request->inputEmail) && preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/",$request->inputEmail )){
                    $insertvendor[0]['vendormail']=$request->inputEmail ;
                }else{
                    $status=false;
                    $data['title'] = "Error!!";
                    $data['message'] = "Enter a Valid Email ID";
                }
                $geolocation = array();
            if(isset($request->txtLat) && $request->txtLat !=null ){
                if(isset($request->txtLng) && $request->txtLng !=null ){
                    $geolocation['location']=array(
                        'lat'=>$request->txtLat,
                        'lang'=>$request->txtLng
                    );
                    $insertvendor[0]['geolocation']=json_encode($geolocation) ;
                }else{
                    $status=false;
                    $data['title'] = "Error!!";
                    $data['message'] = "Enter a Valid Email ID";
                }
            }else{
                $status=false;
                $data['title'] = "Error!!";
                $data['message'] = "Enter a Valid Email ID";
            }
                if(isset($request->txtPassword) && preg_match("/^[a-zA-Z0-9-_@.!@#$%&*()]{8,16}$/",$request->txtPassword) and ($request->txtConfirmPassword) && preg_match("/^[a-zA-Z0-9-_@.!@#$%&*()]{8,16}$/",$request->txtConfirmPassword) ){
                    if($request->txtPassword == $request->txtConfirmPassword){
                        $insertvendor[0]['auth']= password_hash($request->txtPassword,PASSWORD_ARGON2I);
                    }else{
                        $status=false;
                        $data['title'] = "Error!!";
                        $data['message'] = "Password Mismatch";
                    }
                }else{
                    $status=false;
                    $data['title'] = "Error!!";
                    $data['message'] = "Enter Your Password";
                }
                if($status){
                    if(isset($request->txtid) && is_numeric($request->txtid)){
                        if($request->txtid>0){
                         redirect('welcome/');
                        }else if($request->txtid==0){
                            $insertvendor[0]['flagid']=1;
                            $insertvendor[0]['entryby']=1;
                            $insertvendor[0]['authactive']=1;
                            $insertvendor[0]['entryat']=date("Y-m-d H:i:s");
                            $res=$this->Model_Db->insert(10,$insertvendor);
                            if($res!=false){
                                $data['title']="Successful";
                                $data['message']="Inserted successfully.";
                                $data['status']=true;
                            }else{
                                $data['title']="Failed";
                                $data['message']="Data not inserted";
                                $data['status']=false;
                            }
                        }else{
                            $data['title']="Error!!";
                            $data['message']="Some error occurred.Please try again.";
                            $data['status']=false;
                        }
                    }else{
                        $data['title']="Error!!";
                        $data['message']="Some error occurred.Please try again.";
                        $data['status']=false;
                    }
                }else{
                    $data['title']="Error!!";
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
    public function complete_vendor_registraton()
    {
        try {
            $data = array();
            $request = json_decode(json_encode($_POST), false);
            $uid = $this->session->adminLogin['userid'];
            $where = "id=$uid";
            $res = $this->Model_Db->select(10, null, $where);
            if ($res != false) {
                foreach ($res as $r) {
                    $data=array(
                        'vendortypeid'=>$r->vendortypeid,
                        'vendorname'=>$r->vendorname,
                        'vendoraddress'=>$r->vendoraddress,
                        'vendorcontacts'=>$r->vendorcontacts,
                        'vendormail'=>$r->vendormail,
                        'altcontact'=>$r->altcontact,
                        'ownername'=>$r->ownername,
                        'pincode'=>$r->pincode,
                        'photograph'=>$r->photograph,
                        'gstnumber'=>$r->gstnumber,
                        'pannumber'=>$r->pannumber,
                        'aadharnumber'=>$r->aadharnumber,
                        'companydetails'=>$r->companydetails
                    );
                }
            }else{
                $data['message'] = "Completed";
                $data['status'] = false;
            }
            echo json_encode($data);
            exit();
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
            exit();
        }
    }
    public function check_registration_details(){
        try{
//            $this->session->set_userdata('ismodalshown',1);
                $this->load->view('Dashboard/vendor_form_complete');
        }catch (Exception $e){
            echo "Message:".$e->getMessage();
        }
    }
}
