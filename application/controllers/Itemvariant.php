<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
header("Access-Control-Allow-Origin: *");
class Itemvariant extends CI_Controller
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
				$this->load->view('itemvariant/frmItemvariant');
				$this->load->view('include/footer');
				$this->load->view('itemvariant/itemvariant_script');
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
    public function load_variant_page()
    {
        try{
            if(isset($this->session->adminLogin['userid'])){
                $this->load->view('item_form/variant_creation_form');
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
    public function create_itemvariant()
    {
        try {
            $item =array();
            $data = array();
            $insert = array();
            $status = true;
            $request = json_decode(json_encode($_POST), false);
//            echo "<pre>";
//            print_r($request);
            if (isset($request->itemid) && is_numeric($request->itemid)) {
                $insert[0]['itemid'] = $request->itemid;
            } else {
                $status = false;
                $data['data'] = "Item id Error";
            }
//            if (isset($request->cboAttribute) && is_numeric($request->cboAttribute)) {
//                $insert[0]['attributeid'] = $request->cboAttribute;
//            } else {
//                $status = false;
//                $data['data'] = "Attribute id Error";
//            }

            if(isset($request->CboUnitId) && preg_match("/^[0-9]{1,10}$/",$request->CboUnitId )){
                $insert[0]['unitid']=$request->CboUnitId;
            }else{
                $status=false;
                $data['message'] = "Error";
                $data['data'] = "Unit id error";
            }
            if(isset($request->txtQuantity) && is_numeric($request->txtQuantity )){
                $insert[0]['quantity']=$request->txtQuantity;
            }else{
                $status=false;
                $data['message'] = "Error";
                $data['data'] = "Quantity error";
            }
            if(isset($request->txtDimension) && preg_match("/^[0-9X]{3,50}$/",$request->txtDimension )){
                $insert[0]['dimension']=$request->txtDimension;
            }else{
                $status=false;
                $data['message'] = "Error";
                $data['data'] = "Dimension error";
            }
            $this->load->library('Image_resize');
            if($return_val=$this->image_resize->upload_image('fileImage','./assets/images/ItemImage/')){
                $insert[0]['image']=$return_val['raw_name'];
            }else{
                $status=false;
                $data['data'] = "Image Upload Error.";
            }

            if(isset($request->txtMrp) && preg_match("/[0-9]{1,11}$/",$request->txtMrp)){
                $insert[0]['mrp']=$request->txtMrp;
            }else{
                $status=false;
                $data['message'] = "Error";
                $data['data'] = "Mrp error";
            }
            $variantdetails=array();
            if (isset($request->txtVariantDetails)) {
                    $i=0;
                    foreach ($request->txtVariantID as $vi){
                        $variantdetails['id'][]=$vi;
                        $variantdetails['variantdetails'][]=array(
                            'id'=>$vi,
                            'variantname'=>$request->txtVariantName[$i],
                            'variantvalue'=>$request->txtVariantDetails[$i],
                        );
                        $i++;
                    }
                $insert[0]['variantdetails'] =json_encode($variantdetails);
            } else {
                $status = false;
                $data['data'] = "Variant details Error";
            }
            if($status){
                if(isset($request->txtid) && is_numeric($request->txtid)){
                    if($request->txtid>0){
                        if(isset($this->session->editForm['id']) && $this->session->editForm['id']==$request->txtid){
                            $insert[0]['updateby'] = $this->session->login['userid'];
                            $insert[0]['updateat']=date("Y-m-d H:i:s");
                            $res=$this->Model_Db->update(19,$insert,"id",$request->txtid);
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
                        $res=$this->Model_Db->insert(19,$insert);
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
    public function report_itemvariant()
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
            $res = $this->Model_Db->select(19,null,$where,$orderby);
            if ($res != false) {
                $data['status'] = true;
                foreach ($res as $r) {
                    $data['data'][] = array(
                        'id' => $r->id,
                        'item'=>$r->itemid,
                        'variantdetails'=>$r->variantdetails,
                        'unitid'=>$r->unitid,
                        'quantity'=>$r->quantity,
                        'mrp'=>$r->mrp,
                        'dimension'=>$r->dimension,
                        'image'=>$r->image,
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
                $res = $this->Model_Db->select(19, null, $where);
                if ($res != false){
                    $data['status'] = true;
                    foreach ($res as $r) {
                        $data['data'][] = array(
                            'id'=>$r->id,
                            'attribute'=>$r->attributeid,
//                            'item'=>$r->itemid,
                            'variantdetails'=>$r->variantdetails,
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
    public function load_itemvariant()
    {
        try {
            $data = array();
            $where = "isactive=true";
            $request = json_decode(json_encode($_POST), false);
            $orderby='id asc';
            $res = $this->Model_Db->select(17, null, $where,$orderby);
            $data[] = "<option value=''>Select</option>";
            if ($res != false) {
                foreach ($res as $r) {
                    $data[] = "<option value='$r->id'>$r->attributeid</option>";
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
    public function isactive_itemvariant(){
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
                $res=$this->Model_Db->select(19,null,$where);
                if($res!=false){
                    $result=$this->Model_Db->update(19,$update,'id',$request->rowid);
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
    public function checkItemDataAvailability()
    {
        try{
            if(isset($this->session->adminLogin['userid'])){
              extract($_POST);
              $data=array();
              $status=true;
              if(isset($itemid) and $itemid != ""){
                    $where="itemid=$itemid and isactive=true";
                    $res = $this->Model_Db->select(19,null,$where);
                    if($res != false){
                        $data[]=array(
                            'id'=>$res[0]->id,
                            'variantdetails'=>$res[0]->variantdetails,
                            'unitid'=>$res[0]->unitid,
                            'quantity'=>$res[0]->quantity,
                            'mrp'=>$res[0]->mrp,
                            'dimension'=>$res[0]->dimension,
                            'image'=>$res[0]->image
                        );
                    }else{
//                        $data['title']= "Error";
//                        $data['message']= "No data found";
                        $data['status']=false;
//                        $data['error']=true;
                    }
              }else{
                  $data['title']= "Error";
                  $data['message']= "Item id not found";
                  $data['status']=false;
                  $data['error']=true;
              }
                echo json_encode($data);
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
}

