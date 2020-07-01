<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
header("Access-Control-Allow-Origin: *");
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        try{
            $this->load->view('include/header');
            $this->load->view('include/topbar');
            $this->load->view('include/sidebar');
            $this->load->view('user/frmUser');
            $this->load->view('include/footer');
            $this->load->view('user/user_script');
        }catch (Exception $e){
            $data['message']= "Message:".$e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
            exit();
        }
    }
    public function create_user()
    {
        try {
            $data = array();
            $insert = array();
            $status = true;
            $request = json_decode(json_encode($_POST), false);
            if (isset($request->txtFirstname) && preg_match("/[a-zA-Z ]{3,30}$/", $request->txtFirstname)) {
                $insert[0]['firstname'] = $request->txtFirstname;
            } else {
                $status = false;
                $data['data'] = "First Name Error";
            }
            if (isset($request->txtMiddlename) && preg_match("/[a-zA-Z ]{3,30}$/", $request->txtMiddlename)) {
                $insert[0]['middlename'] = $request->txtMiddlename;
            } else {
                $status = false;
                $data['data'] = "Middle Name Error";
            }
            if (isset($request->txtLastname) && preg_match("/[a-zA-Z ]{3,30}$/", $request->txtLastname)) {
                $insert[0]['lastname'] = $request->txtLastname;
            } else {
                $status = false;
                $data['data'] = "Last Name Error";
            }
            if(isset($request->txtMobileno) && preg_match("/[6,7,8,9]{1}[0-9]{9}/",$request->txtMobileno)){
                $insert[0]['mobile'] = $request->txtMobileno;
            }else{
                $status=false;
                $data['data']="Mobile No error";
            }
            if(isset($request->txtEmail) && preg_match("/[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{1,50}$/",$request->txtEmail)){
                $insert[0]['emailid']=$request->txtEmail;
            }else{
                $status=false;
                $data['data']="Email Id error";
            }
            if (isset($request->Gender) && is_numeric($request->Gender)) {
                $insert[0]['gender'] = $request->Gender;
            } else {
                $status = false;
                $data['data'] = "Gender Error";
            }
            if(isset($request->txtPan) && preg_match("/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/",$request->txtPan)){
                $insert[0]['pancard'] = $request->txtPan;
            }else{
                $status=false;
                $data['data']="Mobile No error";
            }
            if($status){
                if(isset($request->txtid) && is_numeric($request->txtid)){
                    if($request->txtid>0){
                        if(isset($this->session->editForm['id']) && $this->session->editForm['id']==$request->txtid){
                            $insert[0]['updateby'] = $this->session->login['userid'];
                            $insert[0]['updateat']=date("Y-m-d H:i:s");
                            $res=$this->Model_Db->update(21,$insert,"id",$request->txtid);
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
                        }else{
                            $data['status']=false;
                            $data['message']='Invalid edit request';
                            $data['data']='You have exceeded the max time limit of 30 seconds to edit this form.';
                        }
                    }else if($request->txtid==0){
                        $insert[0]['entryby']=1;
                        $insert[0]['entryat']=date("Y-m-d H:i:s");
                        $res=$this->Model_Db->insert(21,$insert);
                        if($res!=false){
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
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
        }
    }
    public function report_user()
    {
        try {
            $data = array();
            $request = json_decode(json_encode($_POST), false);
            if (isset($request->onlyactive) && is_numeric($request->onlyactive)) {
                $where = "isactive=true";
            } else {
                $where = "1=1";
            }
            $orderby="id asc";
            $res = $this->Model_Db->select(21,null,$where,$orderby);
            if ($res != false) {
                $data['status'] = true;
                foreach ($res as $r) {
                    $data['data'][] = array(
                        'id' => $r->id,
                        'firstname'=>$r->firstname,
                        'middlename'=>$r->middlename,
                        'lastname'=>$r->lastname,
                        'mobile'=>$r->mobile,
                        'emailid'=>$r->emailid,
                        'gender'=>$r->gender,
                        'pancard'=>$r->pancard,
                        'isactive' => $r->isactive
                    );
                }
            } else {
                $data['status']=false;
                $data['message'] = "No data found.";
                $data['data'] = "Requested data not found.";
            }
            echo json_encode($data);
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
        }
    }
    public function edit_user(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST),false);
            if(isset($request->rowid) && is_numeric($request->rowid) && $request->rowid>0) {
                $where = "id=$request->rowid and isactive=true";
                $res = $this->Model_Db->select(21, null, $where);
                if ($res != false){
                    $data['status'] = true;
                    foreach ($res as $r) {
                        $data['data'][] = array(
                            'id'=>$r->id,
                            'firstname'=>$r->firstname,
                            'middlename'=>$r->middlename,
                            'lastname'=>$r->lastname,
                            'mobile'=>$r->mobile,
                            'emailid'=>$r->emailid,
                            'gender'=>$r->gender,
                            'pancard'=>$r->pancard,
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
        }catch (Exception $e){
            $data['message']=$e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
    public function load_user()
    {
        try {
            $data = array();
            $where = "isactive=true";
            $request = json_decode(json_encode($_POST), false);
            $orderby='id asc';
            $res = $this->Model_Db->select(21, null, $where,$orderby);
            $data[] = "<option value=''>Select</option>";
            if ($res != false) {
                foreach ($res as $r) {
                    $data[] = "<option value='$r->id'>$r-></option>";
                }
            }
            echo json_encode($data);
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
        }
    }
    public function isactive_user(){
        try{
            $request=json_decode(json_encode($_POST));
            $data=array();
            if(isset($request->rowid) && is_numeric($request->rowid) && $request->rowid>0){
                $where="id=$request->rowid ";
                $update=array();
                $update[]=array(
                    'updateby'=>$this->session->login['userid'],
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
                $res=$this->Model_Db->select(21,null,$where);
                if($res!=false){
                    $result=$this->Model_Db->update(21,$update,'id',$request->rowid);
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
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
}
