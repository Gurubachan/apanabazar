<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
header("Access-Control-Allow-Origin: *");
class Itemsummery extends CI_Controller
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
				$this->load->view('itemsummery/frmItemsummery');
				$this->load->view('include/footer');
				$this->load->view('itemsummery/itemsummery_script');
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
    public function create_itemsummery()
    {
        try {
            $data = array();
            $insert = array();
            $status = true;
            $request = json_decode(json_encode($_POST), false);
//            if (isset($request->cboItem) && is_numeric($request->cboItem)) {
//                $insert[0]['itemid'] = $request->cboItem;
//            } else {
//                $status = false;
//                $data['data'] = "item Id Error";
//            }
            if (isset($request->txtOpeningstock) && preg_match("/^[0-9]{1,11}$/", $request->txtOpeningstock)) {
                $insert[0]['openingstock'] = $request->txtOpeningstock;
            } else {
                $status = false;
                $data['data'] = "Openingstock Details Error";
            }
            if (isset($request->txtStockinward) && preg_match("/^[0-9]{1,11}$/", $request->txtStockinward)) {
                $insert[0]['stockinward'] = $request->txtStockinward;
            } else {
                $status = false;
                $data['data'] = "stock In-Ward Details Error";
            }
            if (isset($request->txtStockoutward) && preg_match("/^[0-9]{1,11}$/", $request->txtStockoutward)) {
                $insert[0]['stockoutward'] = $request->txtStockoutward;
            } else {
                $status = false;
                $data['data'] = "stock Out-Ward Details Error";
            }
            if (isset($request->txtRemain) && preg_match("/^[0-9]{1,11}$/", $request->txtRemain)) {
                $insert[0]['remain'] = $request->txtRemain;
            } else {
                $status = false;
                $data['data'] = "Remain Details Error";
            }
            if($status){
                if(isset($request->txtid) && is_numeric($request->txtid)){
                    if($request->txtid>0){
                        if(isset($this->session->editForm['id']) && $this->session->editForm['id']==$request->txtid){
                            $insert[0]['updateby'] = $this->session->login['userid'];
                            $insert[0]['updateat']=date("Y-m-d H:i:s");
                            $res=$this->Model_Db->update(20,$insert,"id",$request->txtid);
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
                        $res=$this->Model_Db->insert(20,$insert);
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
    public function report_itemsummery()
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
            $res = $this->Model_Db->select(20,null,$where,$orderby);
            if ($res != false) {
                $data['status'] = true;
                foreach ($res as $r) {
                    $data['data'][] = array(
                        'id' => $r->id,
//                        'item'=>$r->itemid,
                        'openingstock'=>$r->openingstock,
                        'stockinward'=>$r->stockinward,
                        'stockoutward'=>$r->stockoutward,
                        'remain'=>$r->remain,
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
    public function edit_itemvariant(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST),false);
            if(isset($request->rowid) && is_numeric($request->rowid) && $request->rowid>0) {
                $where = "id=$request->rowid and isactive=true";
                $res = $this->Model_Db->select(20, null, $where);
                if ($res != false){
                    $data['status'] = true;
                    foreach ($res as $r) {
                        $data['data'][] = array(
                            'id'=>$r->id,
//                            'item'=>$r->itemid,
                            'openingstock'=>$r->openingstock,
                            'stockinward'=>$r->stockinward,
                            'stockoutward'=>$r->stockoutward,
                            'remain'=>$r->remain,
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
    public function load_itemsummery()
    {
        try {
            $data = array();
            $where = "isactive=true";
            $request = json_decode(json_encode($_POST), false);
            $orderby='id asc';
            $res = $this->Model_Db->select(20, null, $where,$orderby);
            $data[] = "<option value=''>Select</option>";
            if ($res != false) {
                foreach ($res as $r) {
                    $data[] = "<option value='$r->id'>$r->itemid</option>";
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
    public function isactive_itemsummery(){
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
                $res=$this->Model_Db->select(20,null,$where);
                if($res!=false){
                    $result=$this->Model_Db->update(20,$update,'id',$request->rowid);
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
