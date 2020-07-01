<?php
defined("BASEPATH") or exit('No direct script access allowed.');
date_default_timezone_set("Asia/Kolkata");

class Image_resize
{
	protected $CI;
	public function __construct()
	{
		$this->CI=& get_instance();
	}
	public function upload_image($fieldname,$upload_path){
		try{
			$config['upload_path']          = $upload_path;
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 2048;
			$config['max_width']            = 2048;
			$config['max_height']           = 2048;
			$config['file_name']           = 'productimage'.date("YmdHis");
			$this->CI->load->library('upload', $config);
			if ( $this->CI->upload->do_upload($fieldname)){
				$upload_photo = $this->CI->upload->data();
				$this->resize_image($upload_path,$upload_photo);
				return $upload_photo;
			}else{
				return false;
//                echo $this->upload->display_errors();
			}
		}catch (Exception $e){
			$data['message']= $e->getMessage();
			$data['status']=false;
			$data['error']=true;
			echo json_encode($data);
		}
	}
	private function resize_image($upload_path,$image){
		try{
			$config['image_library'] = 'gd2';
			$config['source_image'] = $upload_path."/".$image['file_name'];
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = FALSE;
			$config['quality'] = "50%";
			$config['width']         = 80;
			$config['height']       = 80;
			$config['thumb_marker']       = "";
			$config['new_image'] = './assets/thumbnails/'.$image['raw_name']."80X80.jpg";
			$this->CI->load->library('Image_lib', $config);
			$this->CI->image_lib->resize();
			$config['width']         = 160;
			$config['height']       = 160;
			$config['new_image'] = './assets/thumbnails/'.$image['raw_name']."160X160.jpg";
			$this->CI->image_lib->initialize($config);
			$this->CI->image_lib->resize();
			$config['width']         = 256;
			$config['height']       = 256;
			$config['new_image'] = './assets/thumbnails/'.$image['raw_name']."256X256.jpg";
			$this->CI->image_lib->initialize($config);
			$this->CI->image_lib->resize();
			$config['width']         = 512;
			$config['height']       = 512;
			$config['new_image'] = './assets/thumbnails/'.$image['raw_name']."512X512.jpg";
			$this->CI->image_lib->initialize($config);
			$this->CI->image_lib->resize();
			return true;
		}catch (Exception $e){
			$data['message']= $e->getMessage();
			$data['status']=false;
			$data['error']=true;
			echo json_encode($data);
		}
	}
}
