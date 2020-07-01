<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
header("Access-Control-Allow-Origin: *");
class Item extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Db');
    }
	public function index()
	{
		try{
			if(isset($this->session->adminLogin['userid'])){
				$this->load->view('include/header');
				$this->load->view('include/topbar');
				$this->load->view('include/sidebar');
				$this->load->view('Item_form/item_creation');
				$this->load->view('include/footer');
				$this->load->view('Item_form/item_creation_script');
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
	public function item_creation(){
		try{
			$data=array();
			$insert=array();
			$status=true;
			$request = json_decode(json_encode($_POST), false);
//			echo "<pre>";
//			print_r($request);
//			exit();
            if(isset($request->cboProductId) && preg_match("/^[0-9]{1,10}$/",$request->cboProductId )){
                $insert[0]['productid']=$request->cboProductId;
            }else{
                $status=false;
                $data['message'] = "Error";
                $data['data'] = "Product id error";
            }
            if(isset($request->cboBrandId) && is_numeric($request->cboBrandId )){
                $insert[0]['brandid']=$request->cboBrandId;
            }else{
                $status=false;
                $data['message'] = "Error";
                $data['data'] = "Brand id error";
            }
			if(isset($request->txtItemName) && preg_match("/[a-zA-Z0-9() ]{3,50}$/",$request->txtItemName)){
				$insert[0]['itemname']=$request->txtItemName;
			}else{
				$status=false;
				$data['message'] = "Error";
				$data['data'] = "Item name error";
			}
            if(isset($request->txtItemCode) && preg_match("/[a-zA-Z0-9]{1,50}$/",$request->txtItemCode)){
                $insert[0]['itemcode']=$request->txtItemCode;
            }else{
                $status=false;
                $data['message'] = "Error";
                $data['data'] = "Item name error";
            }
			if(isset($request->cboTaxRate) && is_numeric($request->cboTaxRate)){
				$insert[0]['taxrateid']=$request->cboTaxRate;
			}else{
				$status=false;
				$data['message'] = "Error";
				$data['data'] = "Tax rate error";
			}

			if($status){
				if(isset($request->txtid) && is_numeric($request->txtid)){
					if($request->txtid>0){
						$insert[0]['updateby']=$this->session->adminLogin['userid'];
						$insert[0]['updateat']=date("Y-m-d H:i:s");
						$res=$this->Model_Db->update(26,$insert,"id",$request->txtid);
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
					}else if($request->txtid==0){
						$insert[0]['entryby']=$this->session->adminLogin['userid'];
						$insert[0]['entryat']=date("Y-m-d H:i:s");
						$res=$this->Model_Db->insert(26,$insert);
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
//						$data['data']="Some error occurred.Please try again.";
						$data['status']=false;
					}
				}else{
					$data['message']="Insufficient/Invalid data.";
//					$data['data']="Some error occurred.Please try again.";
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
				$res = $this->Model_Db->select(26, null, $where,$orderby);
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
    public function report_item_data()
    {
        try {
            set_time_limit(0);
            if(isset($this->session->adminLogin['userid'])){
                $data = array();
                $request = json_decode(json_encode($_POST), false);
                if (isset($request->onlyactive) && is_numeric($request->onlyactive)) {
                    $where = "isactive=true";
                } else {
                    $where = "1=1";
                }
                $orderby="id asc";
                $limit=500;
                $res = $this->Model_Db->select(26,null,$where,$orderby,null,$limit);
                $catagory = $this->Model_Db->select(2,null,$where,$orderby);
                $sub_catagory = $this->Model_Db->select(6,null,$where,$orderby);
                $product = $this->Model_Db->select(4,null,$where,$orderby);
                $brand = $this->Model_Db->select(11,null,$where,$orderby);
                $taxrate = $this->Model_Db->select(27,null,$where,$orderby);
                if ($res != false) {
//                    $data['status'] = true;
                    $i=0;
                    foreach ($res as $r) {
                        $data[$i]= array(
                            'id' => $r->id,
                            'itemcode' => $r->itemcode,
                            'productid'=>$r->productid,
                            'brandid'=>$r->brandid,
                            'itemname'=>$r->itemname,
                            'taxrate'=>$r->taxrateid,
                            'islive'=>$r->islive,
                            'iscustome'=>$r->iscustome,
                            'isactive' => $r->isactive
                        );

                        foreach ($product as $p) {
                            if ($p->id == $r->productid) {
                                $data[$i]['product'] = array(
                                    'id' => $p->id,
                                    'productname' => $p->productname,
                                    'subcatid' => $p->subcatid
                                );
                            }
                        }
//                            foreach ($sub_catagory as $sc){
//                                if($p->subcatid == $sc->id){
//                                    $data['subcategory']=array(
//                                        'id' => $sc->id,
//                                        'subcategoryname' => $sc->subcategoryname,
//                                        'catid' => $sc->catid
//                                    );
//                                    foreach ($catagory as $c){
//                                        if($sc->catid == $c->id){
//                                            $data['category']=array(
//                                                'id' => $c->id,
//                                                'categoryname' => $c->categoryname
//                                            );
//                                        }
//                                    }
//                                }
//
//                            }

                        foreach ($brand as $b) {
                            if ($b->id == $r->brandid) {
                                $data[$i]['brand'] = array(
                                    'id' => $b->id,
                                    'brandname' => $b->manufacturer
                                );
                            }
                        }
                        foreach ($taxrate as $tr) {
                            if ($tr->id == $r->taxrateid) {
                                $data[$i]['taxrate'] = array(
                                    'id' => $tr->id,
                                    'taxratename' => $tr->taxratename
                                );
                            }
                        }

//                            foreach ($unit as $u){
//                            if($u->id == $r->unitid){
//                                $data[$i]['unit']=array(
//                                    'id' => $u->id,
//                                    'unitname' => $u->unitname
//                                );
//                            }



//                        }
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
    public function load_taxrate()
    {
        try {
            $data = array();
            $where = "isactive=true";
            $request = json_decode(json_encode($_POST), false);
            $orderby='id asc';
            $res = $this->Model_Db->select(27, null, $where,$orderby);
            $data[] = "<option value=''>Select</option>";
            if ($res != false) {
                foreach ($res as $r) {
                    $data[] = "<option value='$r->id'>$r->id - $r->taxratename</option>";
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
    public function edit_item()
    {
        try {
            if(isset($this->session->adminLogin['userid'])){
                $data = array();
                $status=true;
                $request = json_decode(json_encode($_POST), false);
                if (isset($request->rowid) && is_numeric($request->rowid)) {
                    $where ="id=$rowid";
                }
                if (isset($request->isactive)) {
                    if($request->isactive != false){
                        $where .="isactive=$request->$isactive";
                    }else{
                        $status=false;
                    }
                }
                $res = $this->Model_Db->select(26,null,$where);
                if ($res != false) {
                    $i=0;
                    foreach ($res as $r) {
                        $data[$i]= array(
                            'id' => $r->id,
                            'itemcode' => $r->itemcode,
                            'productid'=>$r->productid,
                            'brandid'=>$r->brandid,
                            'itemname'=>$r->itemname,
                            'itemimage'=>$r->image,
                            'mrp'=>$r->mrp,
                            'taxrate'=>$r->taxrateid,
                            'unitid'=>$r->unitid,
                            'quantity'=>$r->quantity,
                            'dimension'=>$r->dimension,
                            'islive'=>$r->islive,
                            'iscustome'=>$r->iscustome,
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
                $status=true;
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
    public function findVariantType(){
        try{
            if(isset($this->session->adminLogin['userid'])){
                extract($_POST);
                $data = array();
                $status=true;
                if(isset($itemid) && $itemid!=null) {
                    $where="id=$itemid and isactive=true";
                    $res = $this->Model_Db->select(26,null,$where);
                    if ($res != false) {
                        $resid = $res[0]->productid;
                            $where="productid=$resid";
                            $res_product = $this->Model_Db->select(29,null,$where);
                            if($res_product != false){
                               foreach ($res_product as $rp) {
                                   $vroids[] = $rp->variantid;
                               }
                               if(count($vroids)>0){
                                    $vroid=implode(",",$vroids);
                                   $where="id in ($vroid)";
                                   $res_variant = $this->Model_Db->select(28,null,$where);
                                   if($res_variant != false){
                                     foreach ($res_variant as $rv){
                                         $data[]=array(
                                             'id'=>$rv->id,
                                             'variantname'=>$rv->variantname
                                         );
                                     }
                                   }
                                 }
                                 }
//                            }else{
//                                $data['status']=false;
//                                $data['title'] = "Error";
//                                $data['message'] = "Requested data not found.";
//                            }
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
