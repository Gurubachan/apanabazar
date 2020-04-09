<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
header("Access-Control-Allow-Origin: *");
class Company extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function create_company(){
        try{
            $data=array();
            $insert=array();
            $status=true;
            $request = json_decode(json_encode($_POST), false);
            $config['upload_path']          = './assets/images/photo';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048;
            $config['max_width']            = 2048;
            $config['max_height']           = 2048;
            $config['file_name']           = 'logo'.date("Y-m-d@H-i-s");
            $this->load->library('upload', $config);
            if ( $this->upload->do_upload('txtImage')){
                $upload_photo = $this->upload->data();
                $insert[0]['logo']=$upload_photo['file_name'] ;
            }else{
                $status=false;
                $data['data'] = $this->upload->display_errors();
            }
            if(isset($request->txtCompany) && preg_match("/[a-zA-Z ]{3,50}$/",$request->txtCompany )){
                $insert[0]['name']=$request->txtCompany ;
            }else{
                $status=false;
                $data['data'] = "Companyname Error";
            }
            if(isset($request->txtPannumber) && preg_match("/^[A-Z]){5}([0-9]){4}([A-Z]){1}$/",$request->txtPannumber)){
                $insert[0]['pannumber']=$request->txtPannumber;
            }else{
                $status=false;
                $data['data'] = "pannumber Error";
            }
            if(isset($request->txtGstnumber) && preg_match("/[A-Z0-9]{1,10}$/",$request->txtGstnumber)){
                $insert[0]['gstnumber']=$request->txtGstnumber;
            }else{
                $status=false;
                $data['data'] = "gstnumber Error";
            }
            if(isset($request->txtaddress) && preg_match("/[a-zA-Z -,\/]{3,500}$/",$request->txtaddress)){
                $insert[0]['address']=$request->txtaddress;
            }else{
                $status=false;
                $data['data'] = "address Error";
            }
            if($status){
                if(isset($request->txtid) && is_numeric($request->txtid)){
                    if($request->txtid>0){
                        if(isset($this->session->editForm['id']) && $this->session->editForm['id']==$request->txtid){
                            $insert[0]['updateby'] = $this->session->adminLogin['userid'];
                            $insert[0]['updateat']=date("Y-m-d H:i:s");
                            $res=$this->Model_Db->update(3,$insert,"id",$request->txtid);
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
                        $insert[0]['entryby']=$this->session->adminLogin['userid'];
                        $insert[0]['entryat']=date("Y-m-d H:i:s");
                        $res=$this->Model_Db->insert(3,$insert);
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
        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
    public function report_company(){
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
                        'name'=>$r->name,
                        'pannumber'=>$r->pannumber,
                        'gstnumber'=>$r->gstnumber,
                        'logo'=>$r->logo,
                        'address'=>$r->address,
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
    public function edit_company(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST),false);
            if(isset($request->rowid) && is_numeric($request->rowid) && $request->rowid>0) {
                $where = "id=$request->rowid and isactive=true";
                $res = $this->Model_Db->select(3, null, $where);
                if ($res != false){
                    $data['status'] = true;
                    foreach ($res as $r) {
                        $data['data'][] = array(
                            'id'=>$r->id,
                            'name'=>$r->name,
                            'pannumber'=>$r->pannumber,
                            'gstnumber'=>$r->gstnumber,
                            'logo'=>$r->logo,
                            'address'=>$r->address,
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
    public function load_company(){
        try{
            $data=array();
            $where="isactive=true";
            $orderby="id asc";
            $res=$this->Model_Db->select(3,null,$where,$orderby);
            $data[]="<option value=''>Select</option>";
            if($res!=false){
                foreach ($res as $r){
                    $data[]="<option value='$r->id'>$r->name</option>";
                }
            }
            echo json_encode($data);

        }catch (Exception $e){
            $data['message']= $e->getMessage();
            $data['status']=false;
            $data['error']=true;
            echo json_encode($data);
        }
    }
    public function isactive_company(){
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
                $res=$this->Model_Db->select(3,null,$where);
                if($res!=false){
                    $result=$this->Model_Db->update(3,$update,'id',$request->rowid);
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