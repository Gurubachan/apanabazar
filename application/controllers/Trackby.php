<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
header("Access-Control-Allow-Origin: *");
class Trackby extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Db');
        $this->load->model('Model_trackby');
    }
    public function load_trackbylist() {
        try {
            $data = array();
            $data[] = "<option value=''>Select</option>";
            $data = array(
                '1'=>'Batch No',
                '2'=>'Serial No',
                '3'=>'IMEI No',
                '4'=>'Barcode No'
            );
            foreach ($data as $key => $value) {
                $data[] = "<option value='$key'>$key - $value</option>";
            }
            echo json_encode($data);
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
        }
    }

    public function load_trackby()
    {
        try {
            $data = array();
            $res = $this->Model_trackby->trackby();
            $data[] = "<option value=''>Select</option>";
            foreach ($res as $key => $value) {
                $data[] .= "<option value='$key'>$key - $value</option>";
            }

            echo json_encode($data);
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['status'] = false;
            $data['error'] = true;
            echo json_encode($data);
        }
    }
}
