<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
header("Access-Control-Allow-Origin: *");
class Delivery_address extends CI_Controller
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
				$this->load->view('deliveryadd/add');
				$this->load->view('include/footer');
				$this->load->view('deliveryadd/add_script');
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
    public function create_add()
    {
        try {
            if(isset($this->session->adminLogin['userid'])){
            $data = array();
            $insert = array();
            $status = true;
            $request = json_decode(json_encode($_POST), false);
            if (isset($request->cboState) && is_numeric($request->cboState)) {
                $insert[0]['state'] = $request->cboState;
            } else {
                $status = false;
                $data['data'] = "state Error";
            }
            if (isset($request->cboUserid) && is_numeric($request->cboUserid)) {
                $insert[0]['userid'] = $request->cboUserid;
            } else {
                $status = false;
                $data['data'] = "Userid Error";
            }
            if (isset($request->cboCity) && is_numeric($request->cboCity)) {
                $insert[0]['city'] = $request->cboCity;
            } else {
                $status = false;
                $data['data'] = "city Error";
            }
            if (isset($request->txtpincode) && preg_match("/[0-9]{6}$/", $request->txtpincode)) {
                $insert[0]['pincode'] = $request->txtpincode;
            } else {
                $status = false;
                $data['data'] = "pincode Error";
            }
            if(isset($request->txtName) && preg_match("/[a-zA-Z0-9 ]{3,50}$/",$request->txtName )){
                $insert[0]['name']=$request->txtName ;
            }else{
                $status=false;
                $data['data'] = "name Error";
            }
            if(isset($request->inputContactNumber) && preg_match("/^[6,7,8,9]{1}[0-9]{9}$/",$request->inputContactNumber )){
                $insert[0]['mobile']=$request->inputContactNumber ;
            }else{
                $status=false;
                $data['data'] = "mobile Error";
            }
            if(isset($request->inputAltContactNumber) && preg_match("/^[6,7,8,9]{1}[0-9]{9}$/",$request->inputAltContactNumber )){
                $insert[0]['altmobile']=$request->inputAltContactNumber ;
            }else{
                $status=false;
                $data['data'] = "altcontact Error";
            }
            if(isset($request->txtaddress) && preg_match("/[a-zA-Z0-9 ]{3,100}$/",$request->txtaddress)){
                $insert[0]['address1']=$request->txtaddress ;
            }else{
                $status=false;
                $data['data'] = "name Error";
            }
            if(isset($request->txtaddre) && preg_match("/[a-zA-Z0-9 ]{3,100}$/",$request->txtaddre )){
                $insert[0]['address2']=$request->txtaddre ;
            }else{
                $status=false;
                $data['data'] = "address2 Error";
            }
            if(isset($request->txtlandmark) && preg_match("/[a-zA-Z0-9 ]{3,100}$/",$request->txtlandmark )){
                $insert[0]['landmark']=$request->txtlandmark ;
            }else{
                $status=false;
                $data['data'] = "landmark Error";
            }
            if (isset($request->txtaddtype) && is_numeric($request->txtaddtype)) {
                $insert[0]['addresstype'] = $request->txtaddtype;
            } else {
                $status = false;
                $data['data'] = "addresstype Error";
            }
            if($status){
                if(isset($request->txtid) && is_numeric($request->txtid)){
                    if($request->txtid>0){
                        if(isset($this->session->editForm['id']) && $this->session->editForm['id']==$request->txtid){
                            $insert[0]['updateby'] = $this->session->admiLogin['userid'];
                            $insert[0]['updateat']=date("Y-m-d H:i:s");
                            $res=$this->Model_Db->update(25,$insert,"id",$request->txtid);
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
						$insert[0]['entryby'] = $this->session->admiLogin['userid'];
                        $insert[0]['entryat']=date("Y-m-d H:i:s");
                        $res=$this->Model_Db->insert(25,$insert);
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
    public function report_add()
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
            $res = $this->Model_Db->select(25,null,$where,$orderby);
            if ($res != false) {
                $data['status'] = true;
                foreach ($res as $r) {
                    $data['data'][] = array(
                        'id' => $r->id,
                        'name'=>$r->name,
                        'mobile'=>$r->mobile,
                        'altmobile'=>$r->altmobile,
                        'addresstype'=>$r->addresstype,
                        'pincode'=>$r->pincode,
                        'landmark'=>$r->landmark,
                        'city'=>$r->city,
                        'state'=>$r->state,
                        'address1'=>$r->address1,
                        'address2'=>$r->address2,
                        'userid'=>$r->userid,
                        'isactive' => $r->isactive
                    );
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
    public function edit_add(){
        try{
            if(isset($this->session->adminLogin['userid'])){
                $data=array();
                $request = json_decode(json_encode($_POST),false);
                if(isset($request->rowid) && is_numeric($request->rowid) && $request->rowid>0) {
                    $where = "id=$request->rowid and isactive=true";
                    $res = $this->Model_Db->select(25, null, $where);
                    if ($res != false){
                        $data['status'] = true;
                        foreach ($res as $r) {
                            $data['data'][] = array(
                                'id'=>$r->id,
                                'name'=>$r->name,
                                'mobile'=>$r->mobile,
                                'altmobile'=>$r->altmobile,
                                'addresstype'=>$r->addresstype,
                                'pincode'=>$r->pincode,
                                'landmark'=>$r->landmark,
                                'city'=>$r->city,
                                'state'=>$r->state,
                                'address1'=>$r->address1,
                                'address2'=>$r->address2,
                                'userid'=>$r->userid,
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
    public function load_add()
    {
        try {
            if(isset($this->session->adminLogin['userid'])){
                $data = array();
                $where = "isactive=true";
                $request = json_decode(json_encode($_POST), false);
                $orderby='id asc';
                $res = $this->Model_Db->select(25, null, $where,$orderby);
                $data[] = "<option value=''>--Select--</option>";
                if ($res != false) {
                    foreach ($res as $r) {
                        $data[] = "<option value='$r->id'>$r->name</option>";
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
    public function isactive_add(){
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
                    $res=$this->Model_Db->select(25,null,$where);
                    if($res!=false){
                        $result=$this->Model_Db->update(25,$update,'id',$request->rowid);
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
