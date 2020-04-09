<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Model_Db extends CI_Model
{
    public function __construct(){
        parent::__construct();
    }
    public function find_table($tblno){
        try{
            $table=array(
                '1'=>'tbl_admin','2'=>'tbl_category',
				'3'=>'tbl_company',
                '4'=>'tbl_product','5'=>'tbl_product_creation',
                '6'=>'tbl_sub_category','7'=>'tbl_usertype',
                '8'=>'tbl_vendor_flag','9'=>'tbl_vendor_type',
                '10'=>'tbl_vendors','11'=>'tbl_manufacturer',
                '12'=>'tbl_vendor_bank_details','13'=>'',
            );
            if($table[$tblno]){
                return $table[$tblno];
            }else{
                return false;
            }
        }catch (Exception $e){
            echo "Message:".$e->getMessage();
        }
    }
    public function select($tblno,$select=null,$where=null,$orderby=null,$groupby=null,$limit=0,$distinct=null,$offset=0){
        try{
            $table=$this->find_table($tblno);
            if($table!=false){
                if($select!=null){
                    $this->db->select($select);
                }
                if($where!=null){
                    $this->db->where($where);
                }
                if($orderby!=null){
                    $this->db->order_by($orderby);
                }
                if($groupby!=null){
                    $this->db->group_by($groupby);
                }
                if($limit>0){
                    $this->db->limit($limit);
                    if($offset>0){
                        $this->db->offset($offset);
                    }
                }
                if($distinct!=null){
                    $this->db->distinct($distinct);
                }
                $response=$this->db->get($table);
                if($response->num_rows()>0){
                    return $response->result();
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }catch (Exception $e){
            echo "Message:".$e->getMessage();
        }
    }
    public function insert($tblno,$data=array())
    {
        try{
            $this->db->trans_begin();
            $table=$this->find_table($tblno);
            if($table!=false){
                if(count($data)==1){
                    $this->db->insert($table,$data[0]);
                    if($this->db->affected_rows()>0){
                        $id=$this->db->insert_id();
                    }else{
                        $id=false;
                    }
                    if($this->db->trans_status() === FALSE){
                        $this->db->trans_rollback();
                        $id=false;
                    }else{
                        $this->db->trans_commit();
                    }
                    return $id;
                }else{
                    $this->db->insert_batch($table,$data);
                    $res=$this->db->affected_rows();
                    if($this->db->trans_status() === FALSE){
                        $this->db->trans_rollback();
                        $res=0;
                    }else{
                        $this->db->trans_commit();
                    }
                    if($res>0){
                        return true;
                    }else{
                        return false;
                    }
                }
            }else{
                return false;
            }
        }catch (Exception $e)
        {
            echo "Message :".$e->getMessage();
        }
    }
    public function update($tblno,$data=array(),$column_name,$ids,$where=null)
    {
        try{
            $table=$this->find_table($tblno);
            if($table!=false){
                $this->db->set($data[0]);
                if($where!=null){
                    $this->db->where($where);
                }else{
                    $this->db->where_in($column_name,$ids);
                }
                $this->db->update($table);
                if($this->db->affected_rows()>0)
                {
                    if($where!=null){
                        return $this->db->affected_rows();
                    }else{
                        return true;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }catch (Exception $e)
        {
            echo "Message :".$e->getMessage();
        }
    }
    public function query($query,$type=null){
        try{
            if($query!=""){
                $res=$this->db->query($query);
                if($type!=null){
                    return	$this->db->affected_rows();
                }else{
                    if($res->num_rows()>0){
                        return $res->result();
                    }else{
                        return false;
                    }
                }
            }else{
                return false;
            }
        }catch (Exception $e){
            echo "Message :".$e->getMessage();
        }
    }
}
