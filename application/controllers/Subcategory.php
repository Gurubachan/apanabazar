<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
header("Access-Control-Allow-Origin: *");
class Subcategory extends CI_Controller
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
			$this->load->view('Subcategory/frmSubcategory');
			$this->load->view('include/footer');
            $this->load->view('Subcategory/subcategory_script');
            }catch (Exception $e){
			$data['message']= "Message:".$e->getMessage();
			$data['status']=false;
			$data['error']=true;
			echo json_encode($data);
			exit();
		}
    }
    public function create_subcategory()
    {
        try {
                $data = array();
                $insert = array();
                $status = true;
                $request = json_decode(json_encode($_POST), false);
               $config['upload_path']          = './assets/images/Subcategory';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048;
            $config['max_width']            = 2048;
            $config['max_height']           = 2048;
            $config['file_name']           = 'subcategoryimage'.date("YmdHis");
            $this->load->library('upload', $config);
            if ( $this->upload->do_upload('txtSubimage')){
                $upload_photo = $this->upload->data();
                $insert[0]['subcategoryimage']=$upload_photo['file_name'] ;
            }
            else{
                $status=false;
                $data['data'] = $this->upload->display_errors();
            }
                if (isset($request->cboCategory) && preg_match("/^[0-9]{1,2}$/", $request->cboCategory)) {
                    $insert[0]['catid'] = $request->cboCategory;
                } else {
                    $status = false;
                    $data['data'] = "Category Error";
                }
                if (isset($request->txtSubcategory) && preg_match("/[a-zA-Z ]{3,50}$/", $request->txtSubcategory)) {
                    $insert[0]['subcategoryname'] = $request->txtSubcategory;
                } else {
                    $status = false;
                    $data['data'] = "Subcategory Error";
                }
               if(isset($request->txtDescription) && preg_match("/[a-zA-Z ,.\-]{5,500}$/",$request->txtDescription)){
                $insert[0]['description']=$request->txtDescription;
               }else{
                $status=false;
                $data['data'] = "Description Error";
              }
              if($status){
                if(isset($request->txtid) && is_numeric($request->txtid)){
                    if($request->txtid>0){
                        if(isset($this->session->editForm['id']) && $this->session->editForm['id']==$request->txtid){
                            $insert[0]['updateby'] = $this->session->adminLogin['userid'];
                            $insert[0]['updateat']=date("Y-m-d H:i:s");
                            $res=$this->Model_Db->update(6,$insert,"id",$request->txtid);
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
//                        $insert[0]['entryby']=1;
                        $insert[0]['entryby']=$this->session->adminLogin['userid'];
                        $insert[0]['entryat']=date("Y-m-d H:i:s");
                        $res=$this->Model_Db->insert(6,$insert);
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
    public function report_subcategory()
    {
        try {
                $data = array();
                $request = json_decode(json_encode($_POST), false);
                if (isset($request->onlyactive) && is_numeric($request->onlyactive)) {
                    $where = "isactive=true";
                } else {
                    $where = "1=1";
                }
               if (isset($request->catid) && is_numeric($request->catid)) {
                $where .= "and catid=$request->catid";
                 }else{
                /*$data['status']=false;
                $data['message'] = "catid Not found.";
                $data['data'] = "Please Select a state to View Report.";
                echo json_encode($data);
                exit();*/
               }
                $orderby="id asc";
                $res = $this->Model_Db->select(6,null,$where,$orderby);
                if ($res != false) {
                    $data['status'] = true;
                    foreach ($res as $r) {
                        $data['data'][] = array(
                            'id' => $r->id,
                            'categoryid'=>$r->catid,
                            'subcategoryname'=>$r->subcategoryname,
                            'subcategoryimage'=>$r->subcategoryimage,
                            'description'=>$r->description,
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
    public function edit_subcategory(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST),false);
            if(isset($request->rowid) && is_numeric($request->rowid) && $request->rowid>0) {
                $where = "id=$request->rowid and isactive=true";
                $res = $this->Model_Db->select(6, null, $where);
                if ($res != false){
                    $data['status'] = true;
                    foreach ($res as $r) {
                        $data['data'][] = array(
                            'id'=>$r->id,
                            'categoryid'=>$r->catid,
                            'subcategoryname'=>$r->subcategoryname,
                            'subcategoryimage'=>$r->subcategoryimage,
                            'description'=>$r->description,
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
    public function load_subcategory()
    {
        try {
                $data = array();
                $where = "isactive=true";
                $request = json_decode(json_encode($_POST), false);
            if(isset($request->catid) && is_numeric($request->catid) && $request->catid>0){
                $where.=" and catid=$request->catid";
            }else{
                $data['data']="Invalid Categoryid.";
                $data['message']="Bad request.";
                $data['status']=false;
                echo json_encode($data);
                exit();
            }
                $orderby='id asc';
                $res = $this->Model_Db->select(6, null, $where,$orderby);
                $data[] = "<option value=''>--Select--</option>";
                if ($res != false) {
                    foreach ($res as $r) {
                        $data[] = "<option value='$r->id'>$r->subcategoryname</option>";
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
    public function isactive_subcategory(){
        try{
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
                    $res=$this->Model_Db->select(6,null,$where);
                    if($res!=false){
                        $result=$this->Model_Db->update(6,$update,'id',$request->rowid);
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
