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
            if(isset($request->txtVendorName) && preg_match("/[a-zA-Z0-9 ]{3,50}$/",$request->txtVendorName )){
                $insertvendor[0]['vendorname']=$request->txtVendorName ;
            }else{
                $status=false;
                $data['data'] = "vendorname Error";
            }
            if(isset($request->txtCompanyName) && preg_match("/[a-zA-Z ]{3,50}$/",$request->txtCompanyName )){
//                $insertvendor[0]['companydetails']="{'name':'$request->txtCompanyName'}" ;
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
                $insertvendor[0]['vendormail']=$request->inputEmail ;
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
            if(isset($request->txtGSTN) && preg_match("/[0-9A-Z]{15}$/",$request->txtGSTN)){
                $insertvendor[0]['gstnumber']=strtoupper($request->txtGSTN);
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
                $insertvendor[0]['pannumber']=strtoupper($request->txtPANnumber);
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
            $this->load->library('Image_resize');
            if($return_val=$this->image_resize->upload_image('imgVendor','./assets/images/vendor')){
                $insertvendor[0]['photograph']=$return_val['raw_name'];
            }else{
                $status=false;
                $data['data'] = "Image Upload Error.";
            }
            if(isset($request->txtPassword) && preg_match("/^[a-zA-Z0-9-_@.!@#$%&*()]{8,16}$/",$request->txtPassword) and ($request->txtReEnterPassword) && preg_match("/^[a-zA-Z0-9-_@.!@#$%&*()]{8,16}$/",$request->txtReEnterPassword) ){
                if($request->txtPassword == $request->txtReEnterPassword){
                    $insertvendor[0]['auth']= password_hash($request->txtPassword,PASSWORD_ARGON2I);
                }else{
                    $status=false;
                    $data['data'] = "Password Error";
                }
            }else{
                $status=false;
                $data['data'] = "Password Error";
            }
				if($status){
					if(isset($request->txtid) && is_numeric($request->txtid)){
						if($request->txtid>0){
							if(isset($this->session->editForm['id']) && $this->session->editForm['id']==$request->txtid){
                                $insertvendor[0]['updateby'] = $this->session->adminLogin['userid'];
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
                            $insertvendor[0]['flagid']=1;
                            $insertvendor[0]['entryby']=$this->session->adminLogin['userid'];
                            $insertvendor[0]['entryat']=date("Y-m-d H:i:s");
							$res=$this->Model_Db->insert(10,$insertvendor);
							if($res!=false){
                                $insertbank[0]['vendorid']=$res;
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
	public function load_vendors()
	{
		try {
			if(isset($this->session->adminLogin['userid'])){
				$data = array();
				if($this->session->adminLogin['usertype']=="Vendor"){
					$data[] = "<option value='".$this->session->adminLogin['userid']."'>".$this->session->adminLogin['name']."</option>";
				}else{
					$data[] = "<option value=''>--Select--</option>";
					$where = "isactive=true";
					$request = json_decode(json_encode($_POST), false);
					$orderby='id asc';
					$res = $this->Model_Db->select(10, null, $where,$orderby);
					if ($res != false) {
						foreach ($res as $r) {
							$data[] = "<option value='$r->id'>$r->vendorname</option>";
						}
					}
				}
				echo json_encode($data);
			}else{
				redirect('Welcome/');
			}
		} catch (Exception $e) {
			$data['message'] = $e->getMessage();
			$data['status'] = false;
			$data['error'] = true;
			echo json_encode($data);
		}
	}
    public function report_vendors_data()
    {
        try {
            if(isset($this->session->adminLogin['userid'])){
                $data = array();
                $request = json_decode(json_encode($_POST), false);
                if (isset($request->onlyactive) && is_numeric($request->onlyactive)) {
                    $where = "isactive=true";
                } else {
                    $where = "1=1";
                }
                $orderby="id asc";
                $res = $this->Model_Db->select(10,null,$where,$orderby);
                if ($res != false) {
                    $i=0;
                    foreach ($res as $r) {
                        $data[$i]= array(
                            'id' => $r->id,
                            'vendortypeid' => $r->vendortypeid,
                            'vendorname' => $r->vendorname,
                            'vendoraddress' => $r->vendoraddress,
                            'vendorcontacts' => $r->vendorcontacts,
                            'vendormail' => $r->vendormail,
                            'altcontact'=>$r->altcontact,
                            'ownername'=>$r->ownername,
                            'pincode'=>$r->pincode,
                            'photograph'=>$r->photograph,
                            'gstnumber'=>$r->gstnumber,
                            'pannumber'=>$r->pannumber,
                            'aadharnumber'=>$r->aadharnumber,
//                            'companydetails'=>$r->companydetails,
                            'geolocation'=>$r->geolocation,
                            'isactive' => $r->isactive
                        );
                        $i++;
                    }
                } else {
                    $data['status']=false;
                    $data['message'] = "No data found.";
                    $data['data'] = "Requested data not found.";
                }
                echo json_encode($data);
            }else{
                redirect('Welcome/');
            }
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
        }
    }
    public function complete_vendor()
    {
        try{
            if(isset($this->session->adminLogin['userid'])) {

                $data = array();
                $insertvendor = array();
                $insertbank = array();
                $status = true;
                $request = json_decode(json_encode($_POST), false);
                if (isset($request->inputAltContactNumber) && preg_match("/^[6,7,8,9]{1}[0-9]{9}$/", $request->inputAltContactNumber)) {
                    $insertvendor[0]['altcontact'] = $request->inputAltContactNumber;
                } else {
//                    $status = true;
                    $status = false;
                    $data['title']="Error!!";
                    $data['message']="Enter a valid Alternate number";
                }
                if (isset($request->txtOwnerName) && preg_match("/[a-zA-Z ]{3,50}$/", $request->txtOwnerName)) {
                    $insertvendor[0]['ownername'] = $request->txtOwnerName;
                } else {
//                    $status = true;
                    $status = false;
                    $data['title']="Error!!";
                    $data['message']="Owner name error";
                }
                if (isset($request->txtPINcode) && preg_match("/^[0-9]{6}$/", $request->txtPINcode)) {
                    $insertvendor[0]['pincode'] = $request->txtPINcode;
                } else {
//                    $status = true;
                    $status = false;
                    $data['title']="Error!!";
                    $data['message']="Enter a valid Pincode";
                }
                if (isset($request->inputPlot) && preg_match("/[a-zA-Z-,\/0-9 ]{3,50}$/", $request->inputPlot)) {
                    $insertvendor[0]['vendoraddress'] = $request->inputPlot;
                } else {
                    $status = false;
                    $data['title']="Error!!";
                    $data['message']="Plot number error";
                }
                if (isset($request->inputPo) && preg_match("/[a-zA-Z -0-9]{3,50}$/", $request->inputPo)) {
                    $insertvendor[0]['vendoraddress'] .= ", " . $request->inputPo;
                } else {
                    $status = false;
                    $data['title']="Error!!";
                    $data['message']="Post Office error";
                }
                if (isset($request->inputStreet) && preg_match("/[a-zA-Z0-9 \-,\/]{3,50}$/", $request->inputStreet)) {
                    $insertvendor[0]['vendoraddress'] .= ", " . $request->inputStreet;
                } else {
                    $status = false;
                    $data['title']="Error!!";
                    $data['message']="Street name error";
                }
                if (isset($request->inputState) && preg_match("/^[0-9]{1,2}$/", $request->inputState)) {
                    $insertvendor[0]['vendoraddress'] .= ", " . $request->inputState;
                } else {
                    $status = false;
                    $data['title']="Error!!";
                    $data['message']="State errro";
                }
                if (isset($request->inputCity) && preg_match("/^[0-9]{1,2}$/", $request->inputCity)) {
                    $insertvendor[0]['vendoraddress'] .= ", " . $request->inputCity;
                } else {
                    $status = false;
                    $data['title']="Error!!";
                    $data['message']="City error";
                }
                if (isset($request->inputDistrict) && preg_match("/^[0-9]{1,2}$/", $request->inputDistrict)) {
                    $insertvendor[0]['vendoraddress'] .= ", " . $request->inputDistrict;
                } else {
                    $status = false;
                    $data['title']="Error!!";
                    $data['message']="District error";
                }
                if (isset($request->txtGSTN) && preg_match("/[0-9A-Z]{15}$/", $request->txtGSTN)) {
                    $insertvendor[0]['gstnumber'] = $request->txtGSTN;
                } else {
                    $status = false;
                    $data['title']="Error!!";
                    $data['message']="Enter a valid GST number";
                }
                if (isset($request->txtAadhaar) && preg_match("/^[0-9]{12}$/", $request->txtAadhaar)) {
                    $insertvendor[0]['aadharnumber'] = $request->txtAadhaar;
                } else {
                    $status = false;
                    $data['title']="Error!!";
                    $data['message']="Enter a valid Aadhar number";
                }
//                if (isset($request->txtPANnumber) && preg_match("([A-Z]{3}[PCHFATBLJG]{1}[A-Z]{1}[0-9]{4}[A-Z]{1})",$request->txtPANnumber)) {
                if (isset($request->txtPANnumber) && $request->txtPANnumber!=null) { //regurlar
                    $insertvendor[0]['pannumber'] = $request->txtPANnumber;
                } else {
                    $status = false;
                    $data['title']="Error!!";
                    $data['message']="Enter a valid PAN number";
                }
                if (isset($request->txtBankName) && preg_match("/[a-zA-Z]{1,50}$/", $request->txtBankName)) {
                    $insertbank[0]['bankname'] = $request->txtBankName;
                } else {
                    $status = false;
                    $data['title']="Error!!";
                    $data['message']="Bank Name error";
                }
                if (isset($request->txtAccountHolderName) && preg_match("/[a-zA-Z]{3,100}$/", $request->txtAccountHolderName)) {
                    $insertbank[0]['accountholdername'] = $request->txtAccountHolderName;
                } else {
                    $status = false;
                    $data['title']="Error!!";
                    $data['message']="Account holder name error";
                }
                if (isset($request->txtAccountNumber) && preg_match("/[A-Z0-9]{1,20}$/", $request->txtAccountNumber)) {
                    $insertbank[0]['accountnumber'] = $request->txtAccountNumber;
                } else {
                    $status = false;
                    $data['title']="Error!!";
                    $data['message']="Account number error";
                }
                if (isset($request->txtIFSC) && preg_match("/^[A-Z0-9]{11}$/", $request->txtIFSC)) {
                    $insertbank[0]['ifsccode'] = $request->txtIFSC;
                } else {
                    $status = false;
                    $data['title']="Error!!";
                    $data['message']="Enter a valid IFSC Code";
                }
                $this->load->library('Image_resize');
                if ($return_val = $this->image_resize->upload_image('imgVendor', './assets/images/vendor')) {
                    $insertvendor[0]['photograph'] = $return_val['raw_name'];
                } else {
                    $status = false;
                    $data['title']="Error!!";
                    $data['message']="Photo error";
                }
                if ($status) {
                    if (isset($request->txtid) && is_numeric($request->txtid)) {
                        if ($request->txtid > 0) {
                            $insertvendor[0]['updateby'] = $this->session->adminLogin['userid'];
                            $insertvendor[0]['updateat'] = date("Y-m-d H:i:s");
                            $res = $this->Model_Db->update(10, $insertvendor, "id", $this->session->adminLogin['userid']);
                            if ($res != false) {
                                $data['title'] = "Successful";
                                $data['message'] = "Data updated successfully.";
                                $data['status'] = true;
                            } else {
                                $data['title'] = "Failed";
                                $data['message'] = "Failed to update";
                                $data['status'] = false;
                            }
                            $userid = $this->session->adminLogin['userid'];
                            $where = "vendorid=$userid";
                            $result = $this->Model_Db->select(12, null, $where);
                            if ($result != false) {
                                $insertbank[0]['updateby'] = $this->session->adminLogin['userid'];
                                $insertbank[0]['updateat'] = date("Y-m-d H:i:s");
                                $vendorid = $this->session->adminLogin['userid'];
                                $res = $this->Model_Db->update(12, $insertbank, "vendorid", $vendorid);
                                if ($res != false) {
                                    $data['title'] = "Successful";
                                    $data['message'] = "Data updated successfully.";
                                    $data['status'] = true;
                                } else {
                                    $data['title'] = "Failed";
                                    $data['message'] = "Failed to update";
                                    $data['status'] = false;
                                }
                            } else {
                                $insertbank[0]['entryby'] = $this->session->adminLogin['userid'];
                                $insertbank[0]['vendorid'] = $this->session->adminLogin['userid'];
                                $res = $this->Model_Db->insert(12, $insertbank);
                                if ($res != false) {
                                    $data['title'] = "successful.";
                                    $data['message'] = "Data Inserted successfully.";
                                    $data['status'] = true;
                                } else {
                                    $data['title'] = "failed.";
                                    $data['message'] = "Data not Inserted successfully.";
                                    $data['status'] = false;
                                }
                            }
                            $iscomplete = true;
                            if ($res != false) {
                                if ($this->session->adminLogin['address'] == "") {
                                    $this->session->set_userdata('address',$res[0]['address']);
                                }else{
                                    $iscomplete = true;
//                                    $data['data'] = "Address Not Available";
                                }
                                    if ($this->session->adminLogin['altcontact'] == 0) {
                                        $this->session->set_userdata('altcontact',$res[0]['altcontact']);
                                    }else{
                                        $iscomplete = true;
//                                        $data['data'] = "Altcontact Not Available";
                                    }
                                    if ($this->session->adminLogin['ownername'] == "") {
                                        $this->session->set_userdata('ownername',$res[0]['ownername']);
                                    }else{
                                        $iscomplete = true;
//                                        $data['data'] = "Ownername Not Available";
                                    }
                                    if ($this->session->adminLogin['pincode'] == "") {
                                        $this->session->set_userdata('pincode',$res[0]['pincode']);
                                    }else{
                                        $iscomplete = true;
//                                        $data['data'] = "Pincode Not Available";
                                    }
                                    if ($this->session->adminLogin['photograph'] == "") {
                                        $this->session->set_userdata('photograph',$res[0]['photograph']);
                                    }else{
                                        $iscomplete = true;
//                                        $data['data'] = "Photograph Not Available";
                                    }
                                    if ($this->session->adminLogin['gstnumber'] == "") {
                                        $this->session->set_userdata('gstnumber',$res[0]['gstnumber']);
                                    }else{
                                        $iscomplete = true;
//                                        $data['data'] = "Gstnumber Not Available";
                                    }
                                    if ($this->session->adminLogin['pannumber'] == "") {
                                        $this->session->set_userdata('pannumber',$res[0]['pannumber']);
                                    }else{
                                        $iscomplete = true;
//                                        $data['data'] = "Pannumber Not Available";
                                    }
                                    if ($this->session->adminLogin['aadharnumber'] == "") {
                                        $this->session->set_userdata('aadharnumber',$res[0]['aadharnumber']);
                                    }else{
                                        $iscomplete = true;
//                                        $data['data'] = "aadharnumber Not Available";
                                    }
                                    if ($this->session->adminLogin['bankname'] == "") {
                                        $this->session->set_userdata('bankname',$res[0]['bankname']);
                                    }else{
                                        $iscomplete = true;
//                                        $data['data'] = "bankname Not Available";
                                    }
                                    if ($this->session->adminLogin['accountholdername'] == "") {
                                        $this->session->set_userdata('accountholdername',$res[0]['accountholdername']);
                                    }else{
                                        $iscomplete = true;
//                                        $data['data'] = "accountholdername Not Available";
                                    }
                                    if ($this->session->adminLogin['ifsccode'] == "") {
                                        $this->session->set_userdata('ifsccode',$res[0]['ifsccode']);
                                    }else{
                                        $iscomplete = true;
//                                        $data['data'] = "ifsccode Not Available";
                                    }
                                    if ($this->session->adminLogin['accountnumber'] == "") {
                                        $this->session->set_userdata('accountnumber',$res[0]['accountnumber']);
                                    }else{
                                        $iscomplete = true;
//                                        $data['data'] = "accountnumber Not Available";
                                    }
                                    if ($iscomplete) {
                                        $insertvendor[0]['iscomplete'] = 1;
                                        $res = $this->Model_Db->update(10, $insertvendor, "id", $this->session->adminLogin['userid']);
                                        if ($res != false) {
                                            $this->session->set_userdata('ismodalshown',1);
                                            $data['title'] = "successful.";
                                            $data['message'] = "Data insert successfully.";
                                            $data['status'] = true;
                                        } else {
                                            $this->session->set_userdata('ismodalshown',0);
                                            $data['title'] = "Failed.";
                                            $data['message'] = "Data not Inserted1.";
                                            $data['status'] = false;
                                        }
                                    } else {
                                        $data['title'] = "Failed.";
                                        $data['status'] = false;
                                    }
                                } else {
                                    $data['title'] = "Failed.";
//                                $data['data']="Data not Inserted2.";
                                    $data['status'] = false;
                                }
                            }
                        } else {
                            $data['message'] = "Insufficient/Invalid data.";
                            $data['data'] = "Some error occurred.Please try again.";
                            $data['status'] = false;
                        }
                    } else {
                        $data['title'] = "Error";
                        $data['status'] = false;
                    }
                    echo json_encode($data);
                    exit();
                } else {
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
    public function vendor_details()
    {
        try {
            if(isset($this->session->adminLogin['userid'])){
                $data = array();
                $status =true;
                $request = json_decode(json_encode($_POST), false);
                if (isset($request->vendorid) && is_numeric($request->vendorid)) {
                    $where ="id=$request->vendorid and isactive=true";
                } else {
                    $status = false;
                }
               if($status){
                   $res = $this->Model_Db->select(10,null,$where);
                   if ($res != false) {
                       $i=0;
                       foreach ($res as $r) {
                           $data[$i]= array(
                               'id' => $r->id,
                               'vendortypeid' => $r->vendortypeid,
                               'vendorname' => $r->vendorname,
                               'vendoraddress' => $r->vendoraddress,
                               'vendorcontacts' => $r->vendorcontacts,
                               'vendormail' => $r->vendormail,
                               'altcontact'=>$r->altcontact,
                               'ownername'=>$r->ownername,
                               'pincode'=>$r->pincode,
                               'photograph'=>$r->photograph,
                               'gstnumber'=>$r->gstnumber,
                               'pannumber'=>$r->pannumber,
                               'aadharnumber'=>$r->aadharnumber,
//                            'companydetails'=>$r->companydetails,
                               'geolocation'=>$r->geolocation,
                               'isactive' => $r->isactive
                           );
                           $i++;
                       }
                   } else {
                       $data['status']=false;
                       $data['title'] = "Error";
                       $data['message'] = "Requested data not found.";
                   }
               }else{
                   $data['status']=false;
                   $data['title'] = "Error";
                   $data['message'] = "Requested data not found.";
               }
                echo json_encode($data);
            }else{
                redirect('Welcome/');
            }
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
        }
    }
    public function vendor_inventory_details()
    {
        try {
            if(isset($this->session->adminLogin['userid'])){
                $data = array();
                $status =true;
                $request = json_decode(json_encode($_POST), false);
                if (isset($request->vendorid) && is_numeric($request->vendorid)) {
                    $where="vendorid=$request->vendorid and isactive=true";
                    $res = $this->Model_Db->select(14,null,$where);
//                    print_r($request->vendorid);
//                    echo "<pre>";
//                    print_r($res);
//                    echo "</pre>";
                    $where="1=1";
                    $res_itemvariant = $this->Model_Db->select(19,null,$where);
                    $res_item = $this->Model_Db->select(26,null,$where);
                    if ($res != false) {
                        $i=0;
                        foreach ($res as $r) {
                            $data[$i]= array(
                                'id' => $r->id,
                                'itemidvariantid'=>$r->itemid, //itermvariant id
                                'isactive' => $r->isactive
                            );
                            foreach($res_itemvariant as $riv){
                                if($riv->id == $r->itemid){
                                    $data[$i]['itemvariant']=array(
                                        'id'=>$riv->id,
                                        'itemid'=>$riv->itemid, //same itemid repetition
                                        'variantdetails'=>json_decode($riv->variantdetails)
                                    );
                                }
                            }
                            foreach ($res_item as $ri){
                                if($ri->id == $riv->itemid ){
                                    $data[$i]['item']=array(
                                        'id'=>$ri->id,
                                        'itemname'=>$ri->itemname,
                                        'productid'=>$ri->productid
                                    );
                                }
                            }
                            $i++;
                        }
                }
               }else{
                   $data['status']=false;
                   $data['title'] = "Error";
                   $data['message'] = "Requested data not found.";
               }
                echo json_encode($data);
            }else{
                redirect('Welcome/');
            }
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
        }
    }
}
