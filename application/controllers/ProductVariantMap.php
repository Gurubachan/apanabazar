<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
header("Access-Control-Allow-Origin: *");
class ProductVariantMap extends CI_Controller
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
				$this->load->view('product_variant_map/frmProductVariantMap');
				$this->load->view('include/footer');
				$this->load->view('product_variant_map/productVariantMap_script');
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
    public function create_product_variant_map()
    {
        try {
            $data = array();
            $insert = array();
            $status = true;
            $request = json_decode(json_encode($_POST), false);
            if (isset($request->cboProductList) && is_numeric($request->cboProductList)) {
                $insert[0]['productid'] = $request->cboProductList;
            } else {
                $status = false;
                $data['data'] = "Product loading Error";
            }
            if (isset($request->cboVariantList) && is_numeric($request->cboVariantList)) {
                $insert[0]['variantid'] = $request->cboVariantList;
            } else {
                $status = false;
                $data['data'] = "Variant loading Error";
            }
            if($status){
                if(isset($request->txtid) && is_numeric($request->txtid)){
                    if($request->txtid>0){
                        if(isset($this->session->editForm['id']) && $this->session->editForm['id']==$request->txtid){
                            $insert[0]['updateby'] = $this->session->login['userid'];
                            $insert[0]['updateat']=date("Y-m-d H:i:s");
                            $res=$this->Model_Db->update(29,$insert,"id",$request->txtid);
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
                        $res=$this->Model_Db->insert(29,$insert);
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
    public function report_product_variant_map()
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
            $res = $this->Model_Db->select(29,null,$where,$orderby);
            $res_product = $this->Model_Db->select(4,null,$where);
            $res_variant = $this->Model_Db->select(28,null,$where);
            if ($res != false) {
//                $data['status'] = true;
                $i=0;
                foreach ($res as $r) {
                    $data[$i] = array(
                        'id' => $r->id,
                        'variantid'=>$r->variantid,
                        'productid'=>$r->productid,
                        'isactive' => $r->isactive
                    );
                    foreach ($res_product as $rp){
                        if($r->productid == $rp->id){
                            $data[$i]['product'] = array(
                                'id'=> $rp->id,
                                'productname' => $rp->productname
                            );
                        }
                    }
                    foreach ($res_variant as $rv){
                        if($r->variantid == $rv->id){
                            $data[$i]['variant'] = array(
                                'id'=> $rv->id,
                                'variantname' => $rv->variantname
                            );
                        }
                    }
                    $i++;
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
    public function edit_variant(){
        try{
            $data=array();
            $request = json_decode(json_encode($_POST),false);
            if(isset($request->rowid) && is_numeric($request->rowid) && $request->rowid>0) {
                $where = "id=$request->rowid and isactive=true";
                $res = $this->Model_Db->select(28, null, $where);
                if ($res != false){
                    $data['status'] = true;
                    foreach ($res as $r) {
                        $data['data'][] = array(
                            'id'=>$r->id,
                            'attribute'=>$r->name,
                            'attributegroup'=>$r->attributegroupid,
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
    public function load_variant()
    {
        try {
            $data = array();
            extract($_POST);
            $status = true;
            if(isset($productid) && $productid != null){
                $where = "productid=$productid and isactive=true";
                $orderby='id asc';
                $res = $this->Model_Db->select(29, null, $where,$orderby);
                $where="1=1";
                $res_variant = $this->Model_Db->select(28, null, $where);
                if ($res != false) {
                    $i=0;
                    foreach ($res as $r) {
                        $data[$i]=array(
                            'id'=>$r->id,
                            'variantid'=>$r->variantid
                        );
                        foreach ($res_variant as $rv){
                            if($r->variantid == $rv->id){
                                $data[$i]['variant']=array(
                                    'id'=>$rv->id,
                                    'variantname'=>$rv->variantname
                                );
                            }
                        }
                        $i++;
                    }
                }else{
                    $data['title']="error";
                    $data['message']='Something went error';
                    $data['status']=false;
                }
            }else{
                $data['title']="error";
                $data['message']='Product id not found';
                $data['status']=false;
            }
            echo json_encode($data);
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
        }
    }
    public function isactive_variant(){
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
                $res=$this->Model_Db->select(28,null,$where);
                if($res!=false){
                    $result=$this->Model_Db->update(28,$update,'id',$request->rowid);
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
