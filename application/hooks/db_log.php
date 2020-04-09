<?php
/**
 * Created by PhpStorm.
 * User: way2g
 * Date: 17-09-2018
 * Time: 11:34
 */

// Name of Class as mentioned in $hook['post_controller]
defined('BASEPATH') OR exit('No direct script access allowed');
class Db_log {
    function __construct() {
        // Anything except exit() :P
    }
	public static function systemInfo()
	{
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		$os_platform    = "Unknown OS Platform";
		$os_array       = array('/windows phone 8/i'    =>  'Windows Phone 8',
			'/windows phone os 7/i' =>  'Windows Phone 7',
			'/windows nt 10/i' =>  'Windows 10',
			'/windows nt 6.3/i'     =>  'Windows 8.1',
			'/windows nt 6.2/i'     =>  'Windows 8',
			'/windows nt 6.1/i'     =>  'Windows 7',
			'/windows nt 6.0/i'     =>  'Windows Vista',
			'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
			'/windows nt 5.1/i'     =>  'Windows XP',
			'/windows xp/i'         =>  'Windows XP',
			'/windows nt 5.0/i'     =>  'Windows 2000',
			'/windows me/i'         =>  'Windows ME',
			'/win98/i'              =>  'Windows 98',
			'/win95/i'              =>  'Windows 95',
			'/win16/i'              =>  'Windows 3.11',
			'/windows/i'              =>  'Windows',
			'/macintosh|mac os x/i' =>  'Mac OS X',
			'/mac_powerpc/i'        =>  'Mac OS 9',
			'/android 1/i'            =>  'Android 1',
			'/android 2/i'            =>  'Android 2',
			'/android 3/i'            =>  'Android 3',
			'/android 4/i'            =>  'Android 4',
			'/android 5/i'            =>  'Android 5',
			'/android 6/i'            =>  'Android 6',
			'/android 7/i'            =>  'Android 7',
			'/android 8/i'            =>  'Android 8',
			'/android 9/i'            =>  'Android 9',
			'/android 10/i'            =>  'Android 10',
			'/android 11/i'            =>  'Android 11',
			'/android/i'            =>  'Android',
			'/centos/i'              =>  'Cent OS',
			'/ubuntu/i'             =>  'Ubuntu',
			'/linux/i'              =>  'Linux',
			'/iphone/i'             =>  'iPhone',
			'/ipod/i'               =>  'iPod',
			'/ipad/i'               =>  'iPad',
			'/blackberry/i'         =>  'BlackBerry',
			'/webos/i'              =>  'Mobile');
		$found = false;
		$device = '';
		foreach ($os_array as $regex => $value)
		{
			if($found)
				break;
			else if (preg_match($regex, $user_agent))
			{
				$found=true;
				$os_platform    =   $value;
				$device = !preg_match('/(windows|mac|linux|ubuntu)/i',$os_platform)
					?'MOBILE':(preg_match('/phone/i', $os_platform)?'MOBILE':'SYSTEM');
			}
		}
		if($device=='MOBILE'){
			$device=self::device_name($user_agent);
		}
		return array('os'=>$os_platform,'device'=>$device);
	}
	public static function device_name($str){
    	$start=strpos($str,';') + 1;
    	$end=strpos($str,')');
    	$len=$end-$start;
    	return substr($str,$start,$len);
	}
// Name of function same as mentioned in Hooks Config
    function logQueries() {
        $CI = & get_instance();
        $filepath = APPPATH . 'logs/Query-log-' . date('Y-m-d') . '.sql'; // Creating Query Log file with today's date in application/logs folder
        $handle = fopen($filepath, "a+");                 // Opening file with pointer at the end of the file
        $times = $CI->db->query_times;                   // Get execution time of all the queries executed by controller
        if(isset($CI->session->login)){
			$uid=$CI->session->login['userid'].'-'.$CI->session->login['username'];              //Get Login usser id
		}else{
        	$uid="";
		}
        $computer= getenv('COMPUTERNAME');
        $computer_user= getenv('USERNAME');
		if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
			if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
				$proxy = $_SERVER["HTTP_CLIENT_IP"];
			} else {
				$proxy = $_SERVER["REMOTE_ADDR"];
			}
			$ip_address = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} else {
			if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
				$ip_address = $_SERVER["HTTP_CLIENT_IP"];
			} else {
				$ip_address = $_SERVER["REMOTE_ADDR"];
			}
		}
        foreach ($CI->db->queries as $key => $query) {
            $sql = $query . "; \n --Execution Time:" . $times[$key]."\n --Query Executed By:" .$uid  ."-"."\n --IP Address:" .$ip_address."\n --Computer Name :" .$computer."\n --Computer User name :" .$computer_user."\n --Executed At :".date("Y-m-d H:i:s"); // Generating SQL file alongwith execution time
            if(isset($proxy)){
            	$sql .="\n --Proxy Server ip:" . $proxy;
			}
			$sql .="\n --Browser:" . $_SERVER['HTTP_USER_AGENT'];
            $platform=self::systemInfo();
			$sql .="\n --Device:".$platform['device'] ;
			$sql .="\n --OS:".$platform['os'] ;
			fwrite($handle, $sql . "\n\n");
            // Writing it in the log file
        }
        fclose($handle);      // Close the file
    }
}
