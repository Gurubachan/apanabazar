<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
header("Access-Control-Allow-Origin: *");
class Aggregator extends CI_Controller
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
            $this->load->view('aggregator/aggregator');
            $this->load->view('include/footer');
            $this->load->view('aggregator/aggregator_script');
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
    public function delivery_boy()
    {
        try{
            if(isset($this->session->adminLogin['userid'])){
                $this->load->view('include/header');
                $this->load->view('include/topbar');
                $this->load->view('include/sidebar');
                $this->load->view('deliveryboy/delivery_boy');
                $this->load->view('include/footer');
                $this->load->view('deliveryboy/delivery_boy_script');
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
    public function create_aggregator()
    {
        try {
            extract($_POST);
            if(isset($this->session->adminLogin['userid'])){
            $data = array();
            $insert = array();
            $status = true;
            $request = json_decode(json_encode($_POST), false);

            if (isset($request->txtName) && preg_match("/[a-zA-Z0-9 ]{0,100}$/", $request->txtName)) {
                $insert[0]['companyname'] = $request->txtName;
            } else {
                $status = false;
                $data['data'] = "Error";
                $data['message'] = "stateid Error";
            }
            if (isset($request->txtAddress) && preg_match("/[a-zA-Z0-9, ]{0,100}$/", $request->txtAddress)) {
                $insert[0]['address'] = $request->txtAddress;
            } else {
                $status = false;
                $data['data'] = "Error";
                $data['message'] = "stateid Error";
            }
            if (isset($request->txtContact) && preg_match("/[0-9]{10}$/", $request->txtContact)) {
                $insert[0]['mobile'] = $request->txtContact;
                $insert[0]['ismobileverified'] = true;
            } else {
                $status = false;
                $data['data'] = "Error";
                $data['message'] = "Mobile number error";
            }
            if (isset($request->txtEmail) && preg_match("/[a-zA-Z@.0-9]{10}$/", $request->txtEmail)) {
                $insert[0]['emailid'] = $request->txtEmail;
                $insert[0]['ismailverified'] = true;
            } else {
                $status = false;
                $data['data'] = "Error";
                $data['message'] = "Emailid  Error";
            }
            if (isset($request->txtPan) && preg_match("/[a-zA-Z0-9]{10}$/", $request->txtPan)) {
                $insert[0]['pancard'] = $request->txtPan;
            } else {
                $status = false;
                $data['data'] = "Error";
                $data['message'] = "PAN Number error";
            }
            if (isset($request->txtGst) && preg_match("/^([0-9]{2}[a-zA-Z]{4}([a-zA-Z]{1}|[0-9]{1})[0-9]{4}[a-zA-Z]{1}([a-zA-Z]|[0-9]){3}){0,15}$/", $request->txtGst)) {
                $insert[0]['gstnumber'] = $request->txtGst;
            } else {
                $status = false;
                $data['message']="GST Error";
                $data['data']="Error";
            }
            if($status){
                if(isset($request->txtid) && is_numeric($request->txtid)){
                    if($request->txtid>0){
                        if(isset($this->session->editForm['id']) && $this->session->editForm['id']==$request->txtid){
                            $insert[0]['updateby'] = $this->session->admiLogin['userid'];
                            $insert[0]['updateat']=date("Y-m-d H:i:s");
                            $res=$this->Model_Db->update(32,$insert,"id",$request->txtid);
                            if($res!=false){
                                $data['message']="Successful.";
                                $data['data']="Data updated successfully.";
                                $data['status']=true;
                            }else{
                                $data['message']="Failed.";
                                $data['data']="Data not updated successfully.";
                                $data['status']=false;
                            }
                        }else{
                            $data['status']=false;
                            $data['message']='Invalid edit request';
                            $data['data']='You have exceeded the max time limit of 30 seconds to edit this form.';
                        }
                    }else if($request->txtid==0){
						$insert[0]['entryby'] = $this->session->adminLogin['userid'];
                        $insert[0]['entryat']=date("Y-m-d H:i:s");
                        $res=$this->Model_Db->insert(32,$insert);
                        if($res!=false){
                            $data['message']="Successful.";
                            $data['data']="Data inserted successfully.";
                            $data['status']=true;
                        }else{
                            $data['message']="Failed.";
                            $data['data']="Data not inserted successfully";
                            $data['status']=false;
                        }
                    }else{
                        $data['message']="Insufficient/Invalid data1.";
                        $data['data']="Some error occurred.Please try again.";
                        $data['status']=false;
                    }
                }else{
                    $data['message']="Insufficient/Invalid data2.";
                    $data['data']="Some error occurred.Please try again.";
                    $data['status']=false;
                }
            }else{
//                $data['message']="Insufficient/Invalid data3.";
                $data['status']=false;
            }
            echo json_encode($data);
            exit();
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
    public function create_deliveryboy()
    {
        try {
            extract($_POST);
            if(isset($this->session->adminLogin['userid'])){
                $data = array();
                $insert = array();
                $status = true;
                $request = json_decode(json_encode($_POST), false);
                if (isset($request->txtName) && preg_match("/[a-zA-Z ]{0,100}$/", $request->txtName)) {
                    $insert[0]['name'] = $request->txtName;
                } else {
                    $status = false;
                    $data['data'] = "Error";
                    $data['message'] = "stateid Error";
                }
                if (isset($request->txtGuardian) && preg_match("/[a-zA-Z ]{0,100}$/", $request->txtGuardian)) {
                    $insert[0]['guardianname'] = $request->txtGuardian;
                } else {
                    $status = false;
                    $data['data'] = "Error";
                    $data['message'] = "stateid Error";
                }
                if (isset($request->txtPresentAddress) && preg_match("/[a-zA-Z- ]{0,100}$/", $request->txtPresentAddress)) {
                    $insert[0]['presntaddress'] = $request->txtPresentAddress;
                } else {
                    $status = false;
                    $data['data'] = "Error";
                    $data['message'] = "Present Address Error.";
                }
                if (isset($request->txtPermanentAddress) && preg_match("/[a-zA-Z-]{0,100}$/", $request->txtPermanentAddress)) {
                    $insert[0]['permanentaddress'] = $request->txtPermanentAddress;
                } else {
                    $status = false;
                    $data['data'] = "Error";
                    $data['message'] = "stateid Error";
                }
                if (isset($request->txtGender) && is_numeric($request->txtGender)) {
                    $insert[0]['genderid'] = $request->txtGender;
                }else{
                    $status = false;
                    $data['data']="error";
                    $data['message']="Gender error";
                }
                if (isset($request->txtAge) && preg_match("/[0-9]{1,3}$/", $request->txtAge)) {
                    $insert[0]['age'] = $request->txtAge;
                } else {
                    $status = false;
                    $data['data']="error";
                    $data['message'] = "Age Error";
                }

                if (isset($request->txtContact) && preg_match("/[0-9]{10}$/", $request->txtContact)) {
                    $insert[0]['mobile'] = $request->txtContact;
                    $insert[0]['ismobileverified'] = true;
                } else {
                    $status = false;
                    $data['data'] = "Error";
                    $data['message'] = "Mobile number error";
                }
                if (isset($request->txtEmail) && preg_match("/[a-zA-Z@.0-9]{10}$/", $request->txtEmail)) {
                    $insert[0]['emailid'] = $request->txtEmail;
                    $insert[0]['ismailverified'] = true;
                } else {
                    $status = false;
                    $data['data'] = "Error";
                    $data['message'] = "Emailid  Error";
                }
                if (isset($request->txtAadhar) && preg_match("/[a-zA-Z0-9]{10}$/", $request->txtAadhar)) {
                    $insert[0]['aadharnumber'] = $request->txtAadhar;
                } else {
                    $status = false;
                    $data['data'] = "Error";
                    $data['message'] = "PAN Number error";
                }
                if (isset($request->txtPan) && preg_match("/[a-zA-Z0-9]{10}$/", $request->txtPan)) {
                    $insert[0]['pancard'] = $request->txtPan;
                } else {
                    $status = false;
                    $data['data'] = "Error";
                    $data['message'] = "PAN Number error";
                }
                if($status){
                    if(isset($request->txtid) && is_numeric($request->txtid)){
                        if($request->txtid>0){
                            if(isset($this->session->editForm['id']) && $this->session->editForm['id']==$request->txtid){
                                $insert[0]['updateby'] = $this->session->admiLogin['userid'];
                                $insert[0]['updateat']=date("Y-m-d H:i:s");
                                $res=$this->Model_Db->update(33,$insert,"id",$request->txtid);
                                if($res!=false){
                                    $data['message']="Successful.";
                                    $data['data']="Data updated successfully.";
                                    $data['status']=true;
                                }else{
                                    $data['message']="Failed.";
                                    $data['data']="Data not updated successfully.";
                                    $data['status']=false;
                                }
                            }else{
                                $data['status']=false;
                                $data['message']='Invalid edit request';
                                $data['data']='You have exceeded the max time limit of 30 seconds to edit this form.';
                            }
                        }else if($request->txtid==0){
                            $insert[0]['entryby'] = $this->session->adminLogin['userid'];
                            $insert[0]['entryat']=date("Y-m-d H:i:s");
                            $res=$this->Model_Db->insert(33,$insert);
                            if($res!=false){
                                $data['message']="Successful.";
                                $data['data']="Data inserted successfully.";
                                $data['status']=true;
                            }else{
                                $data['message']="Failed.";
                                $data['data']="Data not inserted successfully";
                                $data['status']=false;
                            }
                        }else{
                            $data['message']="Insufficient/Invalid data1.";
                            $data['data']="Some error occurred.Please try again.";
                            $data['status']=false;
                        }
                    }else{
                        $data['message']="Insufficient/Invalid data2.";
                        $data['data']="Some error occurred.Please try again.";
                        $data['status']=false;
                    }
                }else{
//                $data['message']="Insufficient/Invalid data3.";
                    $data['status']=false;
                }
                echo json_encode($data);
                exit();
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
    public function report_aggregator()
    {
        try {
            if(isset($this->session->adminLogin['userid'])){
            $data = array();
            extract($_POST);
            $where="isactive=true";
            $orderby="id asc";
            $res = $this->Model_Db->select(32,null,$where,$orderby);
            if ($res != false) {
                $data['status'] = true;
                foreach ($res as $r) {
                    $data['data'][] = $r;
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
    public function report_deliveryboy()
    {
        try {
            if(isset($this->session->adminLogin['userid'])){
                $data = array();
                extract($_POST);
                $where="isactive=true";
                $orderby="id asc";
                $res = $this->Model_Db->select(33,null,$where,$orderby);
                if ($res != false) {
                    $data['status'] = true;
                    foreach ($res as $r) {
                        $data['data'][] = $r;
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
    public function edit_dist(){
        try{
            if(isset($this->session->adminLogin['userid'])){
                $data=array();
                $request = json_decode(json_encode($_POST),false);
                if(isset($request->rowid) && is_numeric($request->rowid) && $request->rowid>0) {
                    $where = "id=$request->rowid and isactive=true";
                    $res = $this->Model_Db->select(23, null, $where);
                    if ($res != false){
                        $data['status'] = true;
                        foreach ($res as $r) {
                            $data['data'][] = array(
                                'id'=>$r->id,
                                'stateid'=>$r->stateid,
                                'code'=>$r->code,
                                'name'=>$r->name,
                                'isactive'=>$r->isactive
                            );
                        }
                        $this->session->set_tempdata('editForm',$data['data'][0],30);
                    }else{
                        $data['status'] = false;
                        $data['message'] = "No data found.";
                        $data['data'] = "Requested data not found.";
                    }
                    echo json_encode($data);
                }else{
                    $data['status']=false;
                    $data['message']="Bad request";
                    $data['data']="Invalid request for delete";
                    echo json_encode($data);
                }
            }else{
                redirect('Welcome/');
            }
        }catch (Exception $e){
            $data['message']=$e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
    public function load_dist()
    {
        try {
            if(isset($this->session->adminLogin['userid'])){
                $data = array();
                $where = "isactive=true";
                $request = json_decode(json_encode($_POST), false);
                if(isset($request->stateid) && is_numeric($request->stateid)){
                	$where.=" and stateid=$request->stateid";
				}else{
                	$data['status']=false;
                	$data['data']="Invalid state id.";
                	$data['message']="State id error.";
                	echo json_encode($data);
                	exit();
				}
                $orderby='id asc';
                $res = $this->Model_Db->select(23, null, $where,$orderby);
                $data[] = "<option value=''>--Select--</option>";
                if ($res != false) {
                    foreach ($res as $r) {
                        $data[] = "<option value='$r->id'>$r->code - $r->name</option>";
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
    public function isactive_aggregator(){
        try{
            if(isset($this->session->adminLogin['userid'])){
                $request=json_decode(json_encode($_POST));
                $data=array();
                if(isset($request->rowid) && is_numeric($request->rowid) && $request->rowid>0){
                    $where="id=$request->rowid ";
                    $update=array();
                    $update[]=array(
                        'updateby'=>$this->session->adminLogin['userid'],
                        'updateat'=>date('Y-m-d H:i:s')
                    );
                    if(isset($request->isactive) && is_numeric($request->isactive)){
                        if ($request->isactive==1){
                            $update[0]['isactive']=false;
                            $where.=" and isactive=true";
                        }elseif ($request->isactive==0){
                            $update[0]['isactive']=true;
                            $where.=" and isactive=false";
                        }else{
                            $data['status']=false;
                            $data['message']="Bad request";
                            $data['data']="Invalid request for delete";
                            echo json_encode($data);
                            exit();
                        }
                    }
                    $res=$this->Model_Db->select(32,null,$where);
                    if($res!=false){
                        $result=$this->Model_Db->update(32,$update,'id',$request->rowid);
                        if($result!=false){
                            $data['status']=true;
                            $data['message']="Operation successful";
                            $data['data']="Your request executed successfully.";
                        }else{
                            $data['status']=false;
                            $data['message']="Delete failed.";
                            $data['data']="Some error occurred .Please try again.";
                        }
                    }else{
                        $data['status']=false;
                        $data['message']="Invalid rowid";
                        $data['data']="Invalid request for delete";
                    }
                    echo json_encode($data);
                }else{
                    $data['status']=false;
                    $data['message']="Bad request";
                    $data['data']="Invalid request generated.";
                    echo json_encode($data);
                }
            }else{
                redirect('Welcome/');
            }
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
}
