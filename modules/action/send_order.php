<?php
	$date = new DateClass();
	$stringObj = new String();
	$item = array();

	$txtName = $_POST['name'];
	$txtAddress = $_POST['address'];
	$txtCity =  $_POST['city'];
	$txtDistrict =  $_POST['district'];
	$txtEmail = $_POST['email'];
	$txtTell = $_POST['tel'];
	$txtContent = $_POST['txtContent'];
	$txtThanhtoan = $_POST['thanhtoan'];
	$shipping = $_POST['shipping_cost']+0;
	if(empty($HTTP_X_FORWARDED_FOR)) $IP_NUMBER = getenv("REMOTE_ADDR");
	else $IP_NUMBER = $HTTP_X_FORWARDED_FOR;
	$domain = $_SERVER['HTTP_HOST'];
	$emailTo = getConstant('email_contact');
	$time_now = time();
	$datetime_now = $date->vnDateTime(time());
    
    $db->table = "order";
 
	$data = array(
		'name'=>$db->clearText($txtName),
		'phone'=>$db->clearText($txtTell),
		'email'=>$db->clearText($txtEmail),
		'city' => $db->clearText($txtCity),
		'district' => $db->clearText($txtDistrict),
		//'content'=>$db->clearText($message),
		'icon'=>'fa-shopping',
		'type'=>0,
		'is_active' => 1,
		'created_time'=>$time_now
	);
	$db->insert($data);
	$idca = $db->LastInsertID;

	$subject = "[ĐẶT HÀNG] ".$txtName." (". $datetime_now .")";
	$message = '<div style="line-height: 20px;margin-left: 10px;"><b>----- THÔNG TIN KHÁCH HÀNG ------</b><br/>Họ và tên: <b>'.$txtName.'</b><br/>Địa chỉ: <b>'. $txtAddress.', '.  $txtDistrict . ', '.$txtCity . '</b><br/>Email: <b>'.$txtEmail.'</b><br/>Số điện thoại: <b>'.$txtTell.'</b><br/>Nội dung: <b>'.$txtContent.'</b><br/>Hình thức thanh toán: <b>' . ((int)$txtThanhtoan == 1 ? 'Thanh toán tại nhà': 'Chuyển khoản ngân hàng') .'</b><br/>Đặt hàng từ website http://'.$domain.'</div><p>&nbsp;</p>';

	$message .= '<div><p><b>---- Mã đơn hàng: '.'MDH_'.$idca.' -----</b></p><br />';
	$message .= '<table cellpadding="5" cellspacing="0" class="form-order" style="box-sizing: border-box; border-width: 0px 1px 1px 0px; border-right-style: solid; border-bottom-style: solid; border-right-color: rgb(221, 221, 221); border-bottom-color: rgb(221, 221, 221); max-width: 100%;" width="100%"><thead style="box-sizing: border-box; border: 0px;"><tr align="center" style="box-sizing: border-box; border: 0px;"><td style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221); color: rgb(255, 255, 255); font-weight: bold; background: #08608a;" width="12%">Hình ảnh</td><td style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221); color: rgb(255, 255, 255); font-weight: bold; background: #08608a;">Sản phẩm</td><td style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221); color: rgb(255, 255, 255); font-weight: bold; background: #08608a;">Đơn giá</td><td style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221); color: rgb(255, 255, 255); font-weight: bold; background: #08608a;" width="12%">Số lượng</td><td style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221); color: rgb(255, 255, 255); font-weight: bold; background: #08608a;">Thành tiền</td></tr></thead>';


	foreach($_SESSION['cart'] as $key=>$value) {
		$item[] = $key;
	}
	$str = empty($item) ? 0 : implode(",",$item);

	

	$db->table = "product";
	$db->condition = "is_active = 1 and product_id IN ($str)";
	$db->order = "created_time DESC";
	$db->limit = "";
	$rows = $db->select();

	if($db->RowCount>0) {
		$total = 0;
		$contact = false;
		foreach($rows as $row) {
			$img_product    = '';
			$name_product   = '';
			$price_product  = '';
			$money_price    = '';
			$price          = 0;
			$price_amount   = 0;

			$alt = stripslashes($row['name']);
			if($row['img']!="" && $row['img']!="no") {
				$img_product = '<img width="100px" src="'. HOME_URL .'/uploads/product/'.$row['img'].'" alt="'.$alt.'" />';
				$img_product = '<a title="'.stripslashes($row['name']).'">'.$img_product.'</a>';
			} else {
				$img_product = '<img width="100px" src="'. HOME_URL .'/images/404.png/" alt="'.$alt.'" />';
			}

			$name_product   = '<a title="'.stripslashes($row['name']).'">'.stripslashes($row['name']).'</a>';
			$price          = $row['price']+0;
			$price_product  = ($price==0) ? 'Liên hệ'  : number_format($price,0,"",".");
			$price_amount   = $price*$_SESSION['cart'][$row['product_id']];
			$money_price    = ($price==0) ? 'Liên hệ'  : number_format($price_amount,0,"",".");
			if($price==0) $contact = true;
			$total = $total + $price_amount;

			$message .= '<tr style="box-sizing: border-box; border: 0px;"><td align="center" class="img" style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221); line-height: 0;">'.$img_product.'</td><td align="center" style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221);">'.$name_product.'</td><td align="center" style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221);">'.$price_product.'</td><td align="center" style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221);">'.$_SESSION['cart'][$row['product_id']].'</td><td align="center" style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221);">'.$money_price.'</td></tr>';

		}
		$total_money = ($contact==true) ? 'Liên hệ'  : number_format(($total),0,"",".");
		$total_money2 = ($contact==true) ? 'Liên hệ'  : number_format(($total+$shipping),0,"",".");
		$message .= '<tr style="box-sizing: border-box; border: 0px;"><td align="right" colspan="4" style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221);"><strong style="box-sizing: border-box; border: 0px;"><strong>Tổng tiền hàng:</strong></td><td align="center" class="total" style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221); font-weight: bold; color: rgb(155, 99, 46); text-transform: uppercase; text-decoration: underline;">'.$total_money.'</td></tr>';
		$message .= $shipping ? '<tr style="box-sizing: border-box; border: 0px;"><td align="right" colspan="4" style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221);"><strong style="box-sizing: border-box; border: 0px;"><strong>Tiền ship:</strong></td><td align="center" class="total" style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221); font-weight: bold; color: rgb(155, 99, 46); text-transform: uppercase; text-decoration: underline;">'.number_format(($shipping),0,"",".").'</td></tr>': '';
		$message .= '<tr style="box-sizing: border-box; border: 0px;"><td align="right" colspan="4" style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221);"><strong style="box-sizing: border-box; border: 0px;"><strong>Tổng tiền thanh toán:</strong></td><td align="center" class="total" style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221); font-weight: bold; color: rgb(155, 99, 46); text-transform: uppercase; text-decoration: underline;">'.$total_money2.'</td></tr>';

	} else {
		$message .= '<tr style="box-sizing: border-box; border: 0px;"><td align="center" colspan="5" style="box-sizing: border-box; padding: 5px; border-width: 1px 0px 0px 1px; border-top-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221);" ><strong>Giỏ hàng rỗng</strong></td></tr>';
	}

	$message .= '</table></div>';

	$db->table = "order";

	$data = array(
		'content'=>$db->clearText($message)
	);
	$db->condition = "order_id =".$idca;
	$db->update($data);
	$idca = $db->LastInsertID;
	$send_mail = sendMailFn($txtEmail, $txtName, $emailTo, '', $subject, $message, '', $txtEmail, $txtName);
	if($send_mail == TRUE) {
		unset($_SESSION['cart']);
		session_destroy();
		echo $txtOrder_sendOk;
	}
	else { 
		unset($_SESSION['cart']);
		session_destroy();
		echo $txtOrder_sendOk;
	}