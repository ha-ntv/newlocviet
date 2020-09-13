<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if($_POST['email'] !=  "") {
	$date = new DateClass();
	
	$txt_name =  isset($_POST['name']) ? $_POST['name'] : "";
	$txt_phone =  isset($_POST['phone']) ? $_POST['phone'] : "";
	$txt_email =  isset($_POST['email']) ? $_POST['email'] : "";

	if(empty($HTTP_X_FORWARDED_FOR)) $IP_NUMBER = getenv("REMOTE_ADDR");
	else $IP_NUMBER = $HTTP_X_FORWARDED_FOR;
	$domain = $_SERVER['HTTP_HOST'];
	$email_to = getConstant('email_contact');
	$date = new DateClass();
	$time_now = time();
	$datetime_now = $date->vnDateTime(time());

	$subject = "[ĐĂNG KÝ E-MAIL]: (".$datetime_now.")";
	$message = getPage('reg_email');
	//---------
	$db->table = "register_email";
	$data = array(
		'name'=>$db->clearText($txt_name),
		'phone'=>$db->clearText($txt_phone),
		'email'=>$db->clearText($txt_email),
		'ip'=>$db->clearText($IP_NUMBER),
		'created_time'=>time()
	);
	$db->insert($data);
	echo $gem;
}
else{
	echo $vln;
}