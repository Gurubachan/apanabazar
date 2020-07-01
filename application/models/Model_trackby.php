<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Model_trackby extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function trackby(){
        try{
            $data=array(
                1 => 'Batch No',
                2 => 'Serial No',
                3 => 'IMEI No',
                4 => 'Barcode No'
            );
            return $data;
        }catch (Exception $e) {
            echo "Message:" . $e->getMessage();
        }
    }
}
