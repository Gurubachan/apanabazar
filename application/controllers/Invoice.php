<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
header("Access-Control-Allow-Origin: *");
class Invoice extends CI_Controller
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
            $this->load->view('invoice/invoice');
            $this->load->view('include/footer');
            $this->load->view('invoice/invoice_script');
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
    public function transactions()
    {
        try{
            if(isset($this->session->adminLogin['userid'])){
                $this->load->view('include/header');
                $this->load->view('include/topbar');
                $this->load->view('include/sidebar');
                $this->load->view('Sales/transactions');
                $this->load->view('include/footer');
                $this->load->view('Sales/transactions_script');
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
    public function report_orderlist()
    {
        try {
            if(isset($this->session->adminLogin['userid'])){
                $data = array();
                $request = json_decode(json_encode($_POST), false);
                if (isset($request->onlyactive) && is_numeric($request->onlyactive)) {
                    $where = "isactive=true";
                } else {
                    $where = "isactive=true and ispurchased=false";
                }
                $orderby="id asc";
                $res = $this->Model_Db->select(30,null,$where,$orderby);
                $where="1=1";
//                if($this->session->adminLogin['usertype']=='Vendor'){
//                    $vendorid=$this->session->adminLogin['userid'];
//                    $where="vendorid=$vendorid";
//                }else{
//                    $where="1=1";
//                }
                $res_inventory = $this->Model_Db->select(31,null,$where);
                if ($res != false) {
//                    $data['status'] = true;
                    $i=0;
                    foreach ($res as $r) {
                        $data[$i] = array(
                            'id' => $r->id,
                            'created_at'=>$r->created_at,
                            'userid'=>$r->userid,
                            'inventoryid'=>$r->inventoryid,
                            'noofitems'=>$r->noofitems,
                            'ispurchased'=>$r->ispurchased,
                            'isdeleted'=>$r->isdeleted,
                            'isactive' => $r->isactive
                        );
                        foreach ($res_inventory as $ri){
                            if($ri->id==$r->inventoryid){
                                $data[$i]['inventory']=array(
                                    'id'=>$ri->id,
                                    'itemid'=>$ri->itemid,
                                    'variantid'=>$ri->variantid,
                                    'itemname'=>$ri->itemname,
                                    'itemcode'=>$ri->itemcode,
                                    'iscustome'=>$ri->iscustome,
                                    'brandid'=>$ri->brandid,
                                    'taxrateid'=>$ri->taxrateid,
                                    'taxratename'=>$ri->taxratename,
                                    'taxratevalue'=>$ri->taxratevalue,
                                    'manufacturer'=>$ri->manufacturer,
                                    'variantdetails'=>$ri->variantdetails,
                                    'quantity'=>$ri->quantity,
                                    'unitid'=>$ri->unitid,
                                    'unitname'=>$ri->unitname,
                                    'shortname'=>$ri->shortname,
                                    'mrp'=>$ri->mrp,
                                    'image'=>$ri->image,
                                    'vendorid'=>$ri->vendorid,
                                    'vendorname'=>$ri->vendorname,
                                    'saleprice'=>$ri->saleprice,
                                    'discount'=>$ri->discount,
                                    'productname'=>$ri->productname,
                                    'productid'=>$ri->productid,
                                    'remainstock'=>$ri->remainstock,
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
    public function invoice_generate($id=null)
    {
        try {
            if(isset($this->session->adminLogin['userid'])){
                $data = array();
//                $request = json_decode(json_encode($_POST), false);
                if ($id!=null) {
                    $where = "id=$id and isactive=true";
                }
                $res = $this->Model_Db->select(30,null,$where);
                $where="1=1";
                $res_inventory = $this->Model_Db->select(31,null,$where);
                $res_vendor = $this->Model_Db->select(10,null,$where);
                if ($res != false) {
//                    $data['status'] = true;
                    $i=0;
                    foreach ($res as $r) {
                        $data['result'][]= array(
                            'id' => $r->id,
                            'created_at'=>$r->created_at,
                            'userid'=>$r->userid,
                            'inventoryid'=>$r->inventoryid,
                            'noofitems'=>$r->noofitems,
                            'ispurchased'=>$r->ispurchased,
                            'isdeleted'=>$r->isdeleted,
                            'isactive' => $r->isactive
                        );
                        foreach ($res_inventory as $ri){
                            if($ri->id==$r->inventoryid){
                                $data['inventory'][]=array(
                                    'id'=>$ri->id,
                                    'itemid'=>$ri->itemid,
                                    'variantid'=>$ri->variantid,
                                    'itemname'=>$ri->itemname,
                                    'itemcode'=>$ri->itemcode,
                                    'iscustome'=>$ri->iscustome,
                                    'brandid'=>$ri->brandid,
                                    'taxrateid'=>$ri->taxrateid,
                                    'taxratename'=>$ri->taxratename,
                                    'taxratevalue'=>$ri->taxratevalue,
                                    'manufacturer'=>$ri->manufacturer,
                                    'variantdetails'=>$ri->variantdetails,
                                    'quantity'=>$ri->quantity,
                                    'unitid'=>$ri->unitid,
                                    'unitname'=>$ri->unitname,
                                    'shortname'=>$ri->shortname,
                                    'mrp'=>$ri->mrp,
                                    'image'=>$ri->image,
                                    'vendorid'=>$ri->vendorid,
                                    'vendorname'=>$ri->vendorname,
                                    'saleprice'=>$ri->saleprice,
                                    'discount'=>$ri->discount,
                                    'productname'=>$ri->productname,
                                    'productid'=>$ri->productid,
                                    'remainstock'=>$ri->remainstock
                                );
                                foreach ($res_vendor as $rv){
                                    if($rv->id == $ri->vendorid){
                                       $data['vendor'][]=array(
                                           'id'=>$rv->id,
                                           'vendorname'=>$rv->vendorname,
                                           'vendoraddress'=>$rv->vendoraddress,
                                           'vendorcontacts'=>$rv->vendorcontacts,
                                           'vendoremails'=>$rv->vendormail
                                       );
                                    }
                                }
                            }else{
                                $data['status']=false;
                                $data['message'] = "No data found.";
                                $data['data'] = "Requested data not found.";
                            }
                        }
                        $i++;
                    }
                } else {
                    $data['status']=false;
                    $data['message'] = "No data found.";
                    $data['data'] = "Requested data not found.";
                }
                $this->load->view('Sales/generate_invoice',$data);
//                echo json_encode($data);
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
