<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
header("Access-Control-Allow-Origin: *");
class City extends CI_Controller
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
            $this->load->view('city/city');
            $this->load->view('include/footer');
            $this->load->view('city/cityscript');
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
    public function create_city()
    {
        try {
            if(isset($this->session->adminLogin['userid'])){
            $data = array();
            $insert = array();
            $status = true;
            $request = json_decode(json_encode($_POST), false);
            if (isset($request->cboDistrict) && is_numeric($request->cboDistrict)) {
                $insert[0]['districtid'] = $request->cboDistrict;
            } else {
                $status = false;
                $data['data'] = "districtid Error";
            }
            if (isset($request->txtCode) && preg_match("/[0-9]{4}$/", $request->txtCode)) {
                $insert[0]['code'] = $request->txtCode;
            } else {
                $status = false;
                $data['data'] = "code Error";
            }
            if (isset($request->txtCity) && preg_match("/[a-zA-Z0-9 ]{3,30}$/", $request->txtCity)) {
                $insert[0]['name'] = $request->txtCity;
            } else {
                $status = false;
                $data['data'] = "name Error";
            }
            if($status){
                if(isset($request->txtid) && is_numeric($request->txtid)){
                    if($request->txtid>0){
                        if(isset($this->session->editForm['id']) && $this->session->editForm['id']==$request->txtid){
                            $insert[0]['updateby'] = $this->session->admiLogin['userid'];
                            $insert[0]['updateat']=date("Y-m-d H:i:s");
                            $res=$this->Model_Db->update(24,$insert,"id",$request->txtid);
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
//                            $insert[0]['entryby'] = $this->session->admiLogin['userid'];
                        $insert[0]['entryby'] = 1;
                        $insert[0]['entryat']=date("Y-m-d H:i:s");
                        $res=$this->Model_Db->insert(24,$insert);
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
    public function report_city()
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
            $res = $this->Model_Db->select(24,null,$where,$orderby);
            if ($res != false) {
                $data['status'] = true;
                foreach ($res as $r) {
                    $data['data'][] = array(
                        'id' => $r->id,
                        'districtid'=>$r->districtid,
                        'code'=>$r->code,
                        'name'=>$r->name,
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
    public function edit_city(){
        try{
            if(isset($this->session->adminLogin['userid'])){
                $data=array();
                $request = json_decode(json_encode($_POST),false);
                if(isset($request->rowid) && is_numeric($request->rowid) && $request->rowid>0) {
                    $where = "id=$request->rowid and isactive=true";
                    $res = $this->Model_Db->select(24, null, $where);
                    if ($res != false){
                        $data['status'] = true;
                        foreach ($res as $r) {
                            $data['data'][] = array(
                                'id'=>$r->id,
                                'districtid'=>$r->districtid,
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
    public function load_city()
    {
        try {
            if(isset($this->session->adminLogin['userid'])){
                $data = array();
                $where = "isactive=true";
                $request = json_decode(json_encode($_POST), false);
				if(isset($request->districtid) && is_numeric($request->districtid)){
					$where.=" and districtid=$request->districtid";
				}else{
					$data['status']=false;
					$data['data']="Invalid state id.";
					$data['message']="State id error.";
					echo json_encode($data);
					exit();
				}
                $orderby='id asc';
                $res = $this->Model_Db->select(24, null, $where,$orderby);
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
    public function isactive_city(){
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
                    $res=$this->Model_Db->select(24,null,$where);
                    if($res!=false){
                        $result=$this->Model_Db->update(24,$update,'id',$request->rowid);
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
