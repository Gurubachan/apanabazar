<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
header("Access-Control-Allow-Origin: *");
class Inventory extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'Model_Db',
            'Model_trackby'
        ));
    }
	public function index()
	{
		try{
			if(isset($this->session->adminLogin['userid'])){
				$this->load->view('include/header');
				$this->load->view('include/topbar');
				$this->load->view('include/sidebar');
				$this->load->view('Inventory/inventory_creation_through_item');
				$this->load->view('include/footer');
				$this->load->view('Inventory/inventory_creation_script');
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
	public function inventory_creation(){
		try{
			$data=array();
			$insert=array();
			$status=true;
			$request = json_decode(json_encode($_POST), false);
            if(isset($request->cboItemId) && preg_match("/^[0-9]{1,10}$/",$request->cboItemId )){
                $insert[0]['itemid']=$request->cboItemId;
            }else{
                $status=false;
                $data['message'] = "Error";
                $data['data'] = "Item id error";
            }
            if(isset($request->cboVendorId) && preg_match("/^[0-9]{1,10}$/",$request->cboVendorId )){
                $insert[0]['vendorid']=$request->cboVendorId;
            }else{
                $status=false;
                $data['message'] = "Error";
                $data['data'] = "Vendor id error";
            }
            if(isset($request->txtSalePrice) && preg_match("/^[0-9]{1,11}$/",$request->txtSalePrice )){
                $insert[0]['saleprice']=$request->txtSalePrice;
            }else{
                $status=false;
                $data['message'] = "Error";
                $data['data'] = "Sales price error";
            }
            if(isset($request->txtDiscount) && preg_match("/^[0-9.%]{1,11}$/",$request->txtDiscount )){
                $insert[0]['discount']=$request->txtDiscount;
            }else{
                $status=false;
                $data['message'] = "Error";
                $data['data'] = "Discount price error";
            }
            if(isset($request->txtOpeningStock) && is_numeric($request->txtOpeningStock )){
                $insert[0]['openingstock']=$request->txtOpeningStock;
            }else{
                $status=false;
                $data['message'] = "Error";
                $data['data'] = "Opening Stock error";
            }
//            if(isset($request->txtInwardStock) && is_numeric($request->txtInwardStock )){
//                $insert[0]['inwardstock']=$request->txtInwardStock;
//            }else{
//                $status=false;
//                $data['message'] = "Error";
//                $data['data'] = "Inward Stock error";
//            }
//            if(isset($request->txtOutwardStock) && is_numeric($request->txtOutwardStock )){
//                $insert[0]['outwardstock']=$request->txtOutwardStock;
//            }else{
//                $status=false;
//                $data['message'] = "Error";
//                $data['data'] = "Outward Stock error";
//            }
            if(isset($request->cboTrackById) && is_numeric($request->cboTrackById )){
                $insert[0]['trackby']=$request->cboTrackById;
            }else{
                $status=false;
                $data['message'] = "Error";
                $data['data'] = "Tracking error";
            }
			if($status){
				if(isset($request->txtid) && is_numeric($request->txtid)){
					if($request->txtid>0){
						$insert[0]['updateby']=$this->session->adminLogin['userid'];
						$insert[0]['updateat']=date("Y-m-d H:i:s");
						$res=$this->Model_Db->update(14,$insert,"id",$request->txtid);
						if($res!=false){
							$data['title']="Success";
							$data['message']="Data updated successfully.";
							$data['status']=true;
							$this->session->unset_tempdata('editForm');
						}else{
							$data['title']="Failed";
							$data['message']="Data not updated successfully.";
							$data['status']=false;
						}
					}else if($request->txtid==0){
						$insert[0]['entryby']=$this->session->adminLogin['userid'];
						$insert[0]['entryat']=date("Y-m-d H:i:s");
						$res=$this->Model_Db->insert(14,$insert);
						if($res!=false){
                            $data['title']="Success";
							$data['message']="Data inserted successfully.";
							$data['status']=true;
							$data['itemid']=$res;
						}else{
                            $data['title']="Failed";
							$data['message']="Data not inserted successfully";
							$data['status']=false;
						}
					}else{
						$data['title']="Insufficient/Invalid data.";
						$data['message']="Some error occurred.Please try again.";
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
	public function load_items()
	{
		try {
			if(isset($this->session->adminLogin['userid'])){
				$data = array();
				$where = "isactive=true";
				$request = json_decode(json_encode($_POST), false);
				if(isset($request->productid) && is_numeric($request->productid) && $request->productid>0){
					$where.=" and productid=$request->productid";
				}else{
					$data['data']="Invalid Productid.";
					$data['message']="Bad request.";
					$data['status']=false;
					echo json_encode($data);
					exit();
				}
				if(isset($request->vendorid) && is_numeric($request->vendorid) && $request->vendorid>0){
					$where.=" and vendorid=$request->vendorid";
				}else{
					$data['data']="Invalid vendorid.";
					$data['message']="Bad request.";
					$data['status']=false;
					echo json_encode($data);
					exit();
				}
				if(isset($request->brandid) && is_numeric($request->brandid) && $request->brandid>0){
					$where.=" and brandid=$request->brandid";
				}else{
					$data['data']="Invalid brandid.";
					$data['message']="Bad request.";
					$data['status']=false;
					echo json_encode($data);
					exit();
				}
				$orderby='id asc';
				$res = $this->Model_Db->select(14, null, $where,$orderby);
				$data[] = "<option value=''>--Select--</option>";
				if ($res != false) {
					foreach ($res as $r) {
						$data[] = "<option value='$r->id'>$r->itemname</option>";
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
    public function report_inventory_data()
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
                $res = $this->Model_Db->select(14,null,$where,$orderby);
                if ($res != false) {
//                    $data['status'] = true;
                    $i=0;
                    foreach ($res as $r) {
                        $data[$i]= array(
                            'id' => $r->id,
                            'itemid'=>$r->itemid,
                            'vendorid'=>$r->vendorid,
                            'saleprice'=>$r->saleprice,
                            'discount'=>$r->discount,
                            'openingstock'=>$r->openingstock,
                            'inwardstock'=>$r->inwardstock,
                            'outwardstock'=>$r->outwardstock,
                            'trackby'=>$r->trackby,
                            'isactive' => $r->isactive
                        );
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
    public function fetch_item_details(){
        try{
            if(isset($this->session->adminLogin['userid'])){
                extract($_POST);
                $data = array();
                if(isset($itemname) && $itemname!=null) {
                    $where="itemname  LIKE '%$itemname%' and isactive=true";
                    $limit=5;
//                    $orderby="itemname asc";
                    $res = $this->Model_Db->select(26,null,$where,null,null,$limit);
                    if ($res != false) {
                        $i=0;
                        foreach ($res as $r) {
                            $data[$i]=array(
                                'id' => $r->id,
                                'itemname' =>$r->itemname
                            );
                            $i++;
                        }
                    }else{
                        $data[0]=array(
                            'id'=>'',
                            'itemname'=>'not found'
                        );
                    }
                }else {
                    $data['status']=false;
                    $data['title'] = "No data found.";
                    $data['message'] = "Requested data not found.";
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
    public function fetch_item_from_itmevariant(){
        try{
            if(isset($this->session->adminLogin['userid'])){
                extract($_POST);
                $data = array();
                if(isset($itemid) && $itemid!=null) {
                    $where="itemid=$itemid and isactive=true";
                    $res = $this->Model_Db->select(19,null,$where);
                    $where="id=$itemid and isactive=true";
                    $res_item = $this->Model_Db->select(26,null,$where);
                    if ($res != false) {
                       foreach ($res as $r){
                           $data['result'][]=array(
                               'id' => $r->id,
                               'itemid' =>$r->itemid,
                               'variantdetails'=>$r->variantdetails,
                               'unitid'=>$r->unitid,
                               'quantity'=>$r->quantity,
                               'mrp'=>$r->mrp,
                               'dimension'=>$r->dimension,
                               'image'=>$r->image
                           );
                           foreach($res_item as $ri) {
                             if($r->itemid == $ri->id){
                                 $data['itemname'][]= array(
                                     'id'=>$ri->id,
                                     'itemname' => $ri->itemname
                                 );
                             }
                           }
                       }
                        $this->load->view("Inventory/itemvariant_availability_report",$data);
                    } else {
                        $data['itemid']=$itemid;
                        $data['status']=false;
                        $data['message']="No data found";
                        $this->load->view("Inventory/errormsg",$data);
                    }
                }else {
                    $data['status']=false;
                    $data['title'] = "No data found.";
                    $data['message'] = "Requested data not found.";
                }
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
    public function check_inventory_details(){
        try{
            if(isset($this->session->adminLogin['userid'])){
                extract($_POST);
                $data = array();
                if(isset($itemvariantid) && $itemvariantid!=null) {
                    if($this->session->adminLogin['usertype']=="Admin"){
                        $where="itemid=$itemvariantid and isactive=true";
                    }else{
                        $vendorid = $this->session->adminLogin['userid'];
                        $where="itemid=$itemvariantid and vendorid=$vendorid and isactive=true";
                    }
                    $res = $this->Model_Db->select(14,null,$where);
                    $where="1=1";
                    $res_vendor = $this->Model_Db->select(10,null,$where);
                    $trackby = $this->Model_trackby->trackby();
                    if ($res != false) {
                        $i=0;
                        foreach ($res as $r) {
                            $data[$i]=array(
                                'id' => $r->id,
                                'itemid' =>$r->itemid,
                                'vendorid' =>$r->vendorid,
                                'saleprice' =>$r->saleprice,
                                'discount' =>$r->discount,
                                'openingstock' =>$r->openingstock,
                                'inwardstock' =>$r->inwardstock,
                                'outwardstock' =>$r->outwardstock,
                                'trackby' =>$r->trackby
                            );
                            foreach ($trackby as $key => $value){
                                    if($r->trackby == $key){
                                       $data[$i]['trackbyid']=array(
                                           'track' => $value
                                       );
                                    }
                            }
                            foreach ($res_vendor as $rv){
                                    if($r->vendorid == $rv->id){
                                       $data[$i]['vendor']=array(
                                           'id' => $rv->id,
                                           'vendorname'=>$rv->vendorname
                                       );
                                    }
                            }
                            $i++;
                        }
                    }else{
                        $data['status']=false;
                        $data['title'] = "Error";
                        $data['message'] = "Requested data not found.";
                    }
                }else {
                    $data['status']=false;
                    $data['title'] = "No data found.";
                    $data['message'] = "Requested data not found.";
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
    public function check_vendor_wise_inventory_data(){
        try{
            if(isset($this->session->adminLogin['userid'])){
                extract($_POST);
                $data = array();
                if(isset($vendorid) && $vendorid!=null) {
                    $where="vendorid=$vendorid and itemid=$itemid and isactive=true";
                    $res = $this->Model_Db->select(14,null,$where);
                    $where="1=1";
                    $res_vendor = $this->Model_Db->select(10,null,$where);
                    $trackby = $this->Model_trackby->trackby();
                    if ($res != false) {
                        $i=0;
                        foreach ($res as $r) {
                            $data[$i]=array(
                                'id' => $r->id,
                                'itemid' =>$r->itemid,
                                'vendorid' =>$r->vendorid,
                                'saleprice' =>$r->saleprice,
                                'discount' =>$r->discount,
                                'openingstock' =>$r->openingstock,
                                'inwardstock' =>$r->inwardstock,
                                'outwardstock' =>$r->outwardstock,
                                'trackby' =>$r->trackby
                            );
                            foreach ($trackby as $key => $value){
                                    if($r->trackby == $key){
                                       $data[$i]['trackbyid']=array(
                                           'track' => $value
                                       );
                                    }
                            }
                            foreach ($res_vendor as $rv){
                                    if($r->vendorid == $rv->id){
                                       $data[$i]['vendor']=array(
                                           'id' => $rv->id,
                                           'vendorname'=>$rv->vendorname
                                       );
                                    }
                            }
                            $i++;
                        }
                    }else{
                        $data['status']=false;
                        $data['title'] = "Error";
                        $data['message'] = "Requested data not found.";
                    }
                }else {
                    $data['status']=false;
                    $data['title'] = "No data found.";
                    $data['message'] = "Requested data not found.";
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

