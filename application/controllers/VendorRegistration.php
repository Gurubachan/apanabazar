<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
header("Access-Control-Allow-Origin: *");

class VendorRegistration extends CI_Controller
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
				$this->load->view('Vendor/create_vendors');
				$this->load->view('include/footer');
				$this->load->view('Vendor/create_vendor-script');
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
	public function create_vendor()
	{
		try{
			if(isset($this->session->adminLogin['userid'])){

				$data=array();
				$insertvendor=array();
                $insertbank=array();
				$status=true;
				$request = json_decode(json_encode($_POST), false);
            if(isset($request->inputVendorType) && preg_match("/^[0-9]{1,2}$/",$request->inputVendorType )){
                    $insertvendor[0]['vendortypeid']=$request->inputVendorType ;
				}else{
					$status=false;
					$data['data'] = "Vendortypeid Error";
				}
				if(isset($request->cboflagId) && preg_match("/^[0-9]{1,2}$/",$request->cboflagId )){
                $insertvendor[0]['flagid']=$request->cboflagId ;
                  }else{
                $status=false;
                $data['data'] = "flagID Error";
                }
            if(isset($request->txtVendorName) && preg_match("/[a-zA-Z0-9 ]{3,50}$/",$request->txtVendorName )){
                $insertvendor[0]['vendorname']=$request->txtVendorName ;
            }else{
                $status=false;
                $data['data'] = "vendorname Error";
            }
            if(isset($request->txtCompanyName) && preg_match("/[a-zA-Z ]{3,50}$/",$request->txtCompanyName )){
                $insertvendor[0]['companyname']=$request->txtCompanyName ;
            }else{
                $status=false;
                $data['data'] = "companyname Error";
            }
            if(isset($request->inputContactNumber) && preg_match("/^[6,7,8,9]{1}[0-9]{9}$/",$request->inputContactNumber )){
                $insertvendor[0]['vendorcontacts']=$request->inputContactNumber ;
            }else{
                $status=false;
                $data['data'] = "vendorcontacts Error";
            }
            if(isset($request->inputAltContactNumber) && preg_match("/^[6,7,8,9]{1}[0-9]{9}$/",$request->inputAltContactNumber )){
                $insertvendor[0]['altcontact']=$request->inputAltContactNumber ;
            }else{
                $status=false;
                $data['data'] = "altcontact Error";
            }
            if(isset($request->inputEmail) && preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/",$request->inputEmail )){
                $insertvendor[0]['email']=$request->inputEmail ;
            }else{
                $status=false;
                $data['data'] = "email Error";
            }
            if(isset($request->txtOwnerName) && preg_match("/[a-zA-Z ]{3,50}$/",$request->txtOwnerName )){
                $insertvendor[0]['ownername']=$request->txtOwnerName ;
            }else{
                $status=false;
                $data['data'] = "ownername Error";
            }
            if(isset($request->txtPINcode) && preg_match("/^[0-9]{6}$/",$request->txtPINcode )){
                $insertvendor[0]['pincode']=$request->txtPINcode ;
            }else{
                $status=false;
                $data['data'] = "pincode Error";
            }
            $insertvendor[0]['vendoraddress']="";
            if(isset($request->inputPlot) && preg_match("/[a-zA-Z-,\/0-9 ]{3,50}$/",$request->inputPlot )){
                $insertvendor[0]['vendoraddress']=$request->inputPlot ;
            }else{
                $status=false;
                $data['data'] = "inputPlot Error";
            }
            if(isset($request->inputPo) && preg_match("/[a-zA-Z -0-9]{3,50}$/",$request->inputPo )){
                $insertvendor[0]['vendoraddress'].=", ".$request->inputPo ;
            }else{
                $status=false;
                $data['data'] = "Post Error";
            }
            if(isset($request->inputStreet) && preg_match("/[a-zA-Z0-9 \-,\/]{3,50}$/",$request->inputStreet )){
                $insertvendor[0]['vendoraddress'].=", ".$request->inputStreet ;
            }else{
                $status=false;
                $data['data'] = "Street Error";
            }
            if(isset($request->inputState) && preg_match("/^[0-9]{1,2}$/",$request->inputState )){
                $insertvendor[0]['vendoraddress'].=", ".$request->inputState ;
            }else{
                $status=false;
                $data['data'] = "State Error";
            }
            if(isset($request->inputCity) && preg_match("/^[0-9]{1,2}$/",$request->inputCity )){
                $insertvendor[0]['vendoraddress'].=", ".$request->inputCity ;
            }else{
                $status=false;
                $data['data'] = "City Error";
            }
            if(isset($request->inputDistrict) && preg_match("/^[0-9]{1,2}$/",$request->inputDistrict)){
                    $insertvendor[0]['vendoraddress'].=", ".$request->inputDistrict;
				}else{
					$status=false;
					$data['data'] = "District Error";
				}
            if(isset($request->txtGSTN) && preg_match("/^[0-9A-Z]{15}$/",$request->txtGSTN)){
                $insertvendor[0]['gstnumber']=$request->txtGSTN;
            }else{
                $status=false;
                $data['data'] = "GSTN Error";
            }
            if(isset($request->txtAadhaar) && preg_match("/^[0-9]{12}$/",$request->txtAadhaar)){
                $insertvendor[0]['aadharnumber']=$request->txtAadhaar;
            }else{
                $status=false;
                $data['data'] = "aadharnumber Error";
            }
            if(isset($request->txtPANnumber) && preg_match("/^([A-Z]){5}([0-9]){4}([A-Z]){1}$/",$request->txtPANnumber)){
                $insertvendor[0]['pannumber']=$request->txtPANnumber;
            }else{
                $status=false;
                $data['data'] = "PANnumber Error";
            }
            if(isset($request->txtBankName) && preg_match("/[a-zA-Z]{1,50}$/",$request->txtBankName)){
                $insertbank[0]['bankname']=$request->txtBankName;
            }else{
                $status=false;
                $data['data'] = "BankName Error";
            }
            if(isset($request->txtAccountHolderName) && preg_match("/[a-zA-Z]{3,100}$/",$request->txtAccountHolderName)){
                $insertbank[0]['accountholdername']=$request->txtAccountHolderName;
            }else{
                $status=false;
                $data['data'] = "AccountHolderName Error";
            }
            if(isset($request->txtAccountNumber) && preg_match("/[A-Z0-9]{1,10}$/",$request->txtAccountNumber)){
                $insertbank[0]['accountnumber']=$request->txtAccountNumber;
            }else{
                $status=false;
                $data['data'] = "AccountNumber Error";
            }
            if(isset($request->txtIFSC) && preg_match("/^[A-Z0-9]{11}$/",$request->txtIFSC)){
                $insertbank[0]['ifsccode']=$request->txtIFSC;
            }else{
                $status=false;
                $data['data'] = "ifsccode Error";
            }
				if($status){
					if(isset($request->txtid) && is_numeric($request->txtid)){
						if($request->txtid>0){
							if(isset($this->session->editForm['id']) && $this->session->editForm['id']==$request->txtid){
                                $insertvendor[0]['updateby'] = $this->session->login['userid'];
                                $insertvendor[0]['updateat']=date("Y-m-d H:i:s");
								$res=$this->Model_Db->update(10,$insertvendor,"id",$request->txtid);
								if($res!=false){
                                    $insertbank[0]['updateby']=$this->session->adminLogin['userid'];
                                    $insertbank[0]['updateat']=date("Y-m-d H:i:s");
                                    $res=$this->Model_Db->update(12,$insertbank,"vendorid",$request->txtid);
                                    if($res!=false){
                                        $data['message']="Update successful.";
                                        $data['data']="Data updated successfully.";
                                        $data['status']=true;
                                        $this->session->unset_tempdata('editForm');
                                    }else{
                                        $data['message']="Update failed.";
                                        $data['data']="Data not updated successfully.";
                                        $data['status']=false;
                                    }
									$data['message']="Update successful.";
									$data['data']="Data updated successfully.";
									$data['status']=true;
									$this->session->unset_tempdata('editForm');
								}else{
									$data['message']="Update failed.";
									$data['data']="Data not updated successfully.";
									$data['status']=false;
								}

							}else{
								$data['status']=false;
								$data['message']='Invalid edit request';
								$data['data']='You have exceeded the max time limit of 30 seconds to edit this form.';
							}
						}else if($request->txtid==0){
//                            $insertvendor[0]['entryby']=1;
                            $insertvendor[0]['entryby']=$this->session->adminLogin['userid'];
                            $insertvendor[0]['entryat']=date("Y-m-d H:i:s");
							$res=$this->Model_Db->insert(10,$insertvendor);
							if($res!=false){
                                $insertbank[0]['vendorid']=$res;
//                                $insertbank[0]['entryby']=1;
                                $insertbank[0]['entryby']=$this->session->adminLogin['userid'];
                                $insertbank[0]['entryat']=date("Y-m-d H:i:s");
                                $res=$this->Model_Db->insert(12,$insertbank);
                                if($res!=false){
                                    $data['message']="insert successful.";
                                    $data['data']="Data inserted successfully.";
                                    $data['status']=true;
                                }else{
                                    $data['message']="Insert failed.";
                                    $data['data']="Data not inserted successfully";
                                    $data['status']=false;
                                }
								$data['message']="insert successful.";
								$data['data']="Data inserted successfully.";
								$data['status']=true;
							}else{
								$data['message']="Insert failed.";
								$data['data']="Data not inserted successfully";
								$data['status']=false;
							}
						}else{
							$data['message']="Insufficient/Invalid data.";
							$data['data']="Some error occurred.Please try again.";
							$data['status']=false;
						}
					}else{
						$data['message']="Insufficient/Invalid data.";
						$data['data']="Some error occurred.Please try again.";
						$data['status']=false;
					}
				}else{
					$data['message']="Insufficient/Invalid data.";
					$data['status']=false;
				}
				echo json_encode($data);
				exit();

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
    public function report_vendors(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST),false);
            if(isset($request->onlyactive) && is_numeric($request->onlyactive)){
                $where="isactive=true";
            }else{
                $where="1=1 ";
            }
            $orderby="id asc";
            $res=$this->Model_Db->select(3,null,$where,$orderby);
            if($res!=false){
                $data['status']=true;
                foreach ($res as $r){
                    $data['data'][]=array(
                        'id'=>$r->id,
                        'isactive'=>$r->isactive
                    );
                }
            }else{
                $data['status']=false;
                $data['message']="No data found.";
                $data['data']="Requested data not found.";
            }
            echo json_encode($data);

        }catch (Exception $e){
            $data['message']=$e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
}
