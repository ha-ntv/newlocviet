<?php
$typeFunc = isset($_POST['typeFunc']) ? $_POST['typeFunc'] : ''; 
$date = new DateClass();
$stringObj  = new String();

$file_max_size = FILE_MAX_SIZE;
$dir_dest = ROOT_DIR . DS .'uploads' . DS . "document" . DS;
$OK = $file_ck = false;
$error = '';

if($typeFunc=='ungtuyen'){

	$txtName = $_POST['name'];
	$txtEmail = $_POST['email'];
	$txtKhoa = $_POST['name_khoa'];
	$txtTel = $_POST['phone'];
	$txtMale = $_POST['male'];
	$txtAge = $_POST['age']; 

	if(empty($HTTP_X_FORWARDED_FOR)) $IP_NUMBER = getenv("REMOTE_ADDR");
	else $IP_NUMBER = $HTTP_X_FORWARDED_FOR;
	$domain = $_SERVER['HTTP_HOST'];
	$email_to = getConstant('email_contact');
	$time_now = time(); 
	$datetime_now = $date->vnDateTime($time_now);

	$file_type = $_FILES['file']['type'];
	$file_name = $_FILES['file']['name'];
	$file_size = $_FILES['file']['size'];

	$allowedTypes = array(
			'application/msword'			=>	'doc',
			'application/excel'				=>	'xls',
			'application/vnd.ms-powerpoint'	=>	'ppt',

			'application/vnd.openxmlformats-officedocument.wordprocessingml.document'	=>	'docx',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'			=>	'xlsx',
			'application/vnd.openxmlformats-officedocument.presentationml.presentation'	=>	'pptx',

			'application/download'			=>	'zip',
			'application/x-zip-compressed'	=>	'zip',
			'application/zip'				=>	'zip',
			'application/x-rar-compressed'	=>	'rar',
			'application/rar'				=>	'rar',
			'application/pdf'				=>	'pdf',
	);

	if (array_key_exists($file_type, $allowedTypes) && (strtolower(File::getExt($file_name)) == $allowedTypes[$file_type])) {
		$file_type = '.' . $allowedTypes[$file_type];
	}else {
		$file_type = 'unk';
	}

	$file_type = trim(strrchr($file_name,'.'));
	$file_full_name = "tmp_".time().$file_type;

	if ( ($file_size > 0) && ($file_size <= $file_max_size)) {
		if ($file_type != "unk") {
			if ( @move_uploaded_file($_FILES['file']['tmp_name'], $dir_dest . $file_full_name) ) {
				$OK = true;
				$file_ck = true;
			}
			else
				$error = '<span class="show-error">Không thể tải tệp tin lên.</span>';
		}
		else
		{
			$error = '<span class="show-error">Sai định dạng tệp - Không thể tải tệp tin lên.</span>';
		}
	}else {
		if ($file_size == 0) {
			$OK		    = true;
			$file_ck	= false;
		} {
			$error = '<span class="show-error">Tệp tin của bạn chọn vượt quá kích thước cho phép.</span>';
		}
	}
	

	if($OK) {
		$id_query = 0;

		$subject = '[HỒ SƠ] '.$txtName.' ('.$datetime_now.')';	
		$message = '<div marginwidth="0" marginheight="0" style="font-family:Arial,serif;"><table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" style="table-layout:fixed;"><tbody><tr><td width="100%" valign="top" bgcolor="#f5f5f5" style="border-top:3px solid #579902;padding:0;"><table border="0" cellpadding="0" cellspacing="0" align="center" style="margin:0 auto;width:100%;"><tbody><tr><td bgcolor="white" style="padding:10px 0; text-align: center;"><a href="' . HOME_URL_LANG .'" target="_blank"><img src="'. HOME_URL . getConstant('file_logo') .'" style="max-height:70px;max-width:80%;" alt="' . getConstant('meta_site_name') . '" border="0"></a></td></tr></tbody></table><div style="min-height:35px">&nbsp;</div><table border="0" cellpadding="0" cellspacing="0" align="center" style="min-width:290px;margin:0 auto;font-size:13px;color:#666666;font-weight:normal;text-align:left;font-family:Arial,serif;line-height:18px;" width="620"><tbody><tr><td style="border-left:6px solid #fb651b;font-size:13px;color:#666666;font-weight:normal;text-align:left;font-family:Arial,serif;line-height:18px;vertical-align:top;padding:15px 8px 25px 20px;" bgcolor="#fdfdfd"><p style="margin: 10px 0">Chào <b> '.$txtName.'</b>,</p><p style="margin: 10px 0">Xin chân thành cảm ơn Quý khách đã quan tâm và sử dụng dịch vụ của chúng tôi! Yêu cầu của Quý khách đã gửi thành công. Chúng tôi sẽ phản hồi lại trong vòng 24h tới.</p><p style="margin: 10px 0"><b style="text-decoration:underline;">THÔNG TIN CỦA QUÝ KHÁCH:</b><br/><label style="font-weight:600;padding-left:12px;">Họ và tên: </label> ' .$txtName.'<br/><label style="font-weight:600;padding-left:12px;">Email: </label> '.$txtEmail.'<br/><label style="font-weight:600;padding-left:12px;">Số điện thoại: </label> '.$txtTel.'<br/><label style="font-weight:600;padding-left:12px;">Giới tính: </label> '.$txtMale.'<br/><label style="font-weight:600;padding-left:12px;">Tuổi: </label> '.$txtAge.'<br/><label style="font-weight:600;padding-left:12px;">Tên khóa đào tạo: </label> '.$txtKhoa.'<br/><label style="font-weight:600;padding-left:12px;">IP: </label> '.$IP_NUMBER.'<br/><label style="font-weight:600;padding-left:12px;">Ngày gửi liên hệ: </label> '.$datetime_now.'<br/></p><p style="margin: 10px 0">Đây là hộp thư tự động. Sau thời gian trên nếu quý khách chưa nhận được phản hồi từ nhân viên của chúng tôi, rất có thể đã gặp sự cố nhỏ nào đó vì vậy Quý khách có thể liên hệ trực tiếp chúng tôi để nhận được những thông tin nhanh nhất.</p><p style="margin: 10px 0">Chân thành cảm ơn!</p></td></tr></tbody></table><div style="min-height:35px">&nbsp;</div><table width="100%" border="0" cellpadding="0" cellspacing="0" align="center"><tbody><tr><td bgcolor="#e1e1e1" style="padding:15px 10px 25px"><table border="0" cellpadding="0" cellspacing="0" align="center" style="margin:0 auto;min-width:290px;" width="620"><tbody><tr><td><table width="80%" cellpadding="0" cellspacing="0" border="0" align="left"><tbody><tr><td valign="top" style="font-size:12px;color:#5e5e5e;font-family:Arial,serif;line-height:15px;">' . getConstant('meta_site_name') . '</td></tr></tbody></table><table width="20%" cellpadding="0" cellspacing="0" border="0"><tbody><tr><td style="font-size:13px;color:#5e5e5e;font-family:Arial,serif;line-height:1;vertical-align:top;text-align:right;font-style:italic;"><span>Follow us on</span><br><a href="' . getConstant('link_facebook') . '" target="_blank"><img src="https://ci5.googleusercontent.com/proxy/PMSfAkbhhMLEe-tDCLFilReG-hlq_DWsTblTQ2qp8Dsq9KFW1UyFcKTr_uwU3EqyR8AhiFIooeExoAw9Oe3G5c6hvIEoOnU=s0-d-e1-ft#https://www.livecoding.tv/static/img/email/fb.png" width="27" height="27" alt="Facebook logo" title="Facebook" border="0" style="padding:3px;"></a>&nbsp;<a href="' . getConstant('link_twitter') . '" target="_blank"><img src="https://ci3.googleusercontent.com/proxy/GNHxgrYKL99Apyic0XnGYk6IqVZAc-wFuhgCDxzBYMr80NGggmI1nRORIBVRIkPkJHbQHGGMrTFtbzTDoxk5dc0i_H0HOc0=s0-d-e1-ft#https://www.livecoding.tv/static/img/email/tw.png" width="27" height="27" alt="Twitter logo" title="Twitter" border="0" style="padding:3px;"></a></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></div>';

		$db->table = "order";
		$data = array(
			'name'=>$db->clearText($txtName),
			// 'address'=>$db->clearText($txtAddress),
			'email'=>$db->clearText($txtEmail),
			'phone'=>$db->clearText($txtTel),
			'content'=>$db->clearText($message),
			'ip'=>$db->clearText($IP_NUMBER),
			'icon'=>'fa-car',
			'type'=>1,
			'created_time'=>$time_now
		); 
		$db->insert($data);

		$send_mail = sendMailFn($txtEmail, $txtName, $email_to, '', $subject, $message, '', $txtEmail, $txtName);

		$id_query = $db->LastInsertID;

		if ($file_ck) {
			$u_file = getRandomString().'-'.$id_query.'-'.substr($stringObj->getSlug($name),0,120) . $file_type;
			@rename($dir_dest . $file_full_name, $dir_dest . $u_file);
			$db->table = "order";
			$data = array(
					'file'=>$db->clearText($u_file)
				);
			$db->condition = "order_id = ".$id_query;
			$db->update($data);
		}
		echo "Đã nộp hồ sơ thành công.";
		$OK = true;
	}
}
