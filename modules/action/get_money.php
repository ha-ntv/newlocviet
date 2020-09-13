<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if(isset($_POST['type'])) {
	$type = $_POST['type'];
	if($type=='hosting') {
		$year   = isset($_POST['year']) ? $_POST['year']+0 : 0;
		$id     = isset($_POST['id']) ? $_POST['id']+0 : 0;
		$db->table = "article";
		$db->condition = "`article_id` = $id";
		$db->order = "";
		$db->limit = 1;
		$rows = $db->select();
		if($db->RowCount>0) {
			foreach($rows as $row) {
				echo formatNumberVN($row['price']*$year) . $lgTxt_svc_money_unit;
			}
		} else echo '0' . $lgTxt_svc_money_unit;
	} elseif($type=='domain') {
		$year   = isset($_POST['year']) ? $_POST['year']+0 : 0;
		$id     = isset($_POST['id']) ? $_POST['id'] : '';
		$db->table = 'others';
		$db->condition = "name LIKE '$id'";
		$db->order = "";
		$db->limit = 1;
		$rows = $db->select();
		if($db->RowCount>0) {
			foreach($rows as $row) {
				echo formatNumberVN($row['price']*$year) . $lgTxt_svc_money_unit;
			}
		} else echo '0' . $lgTxt_svc_money_unit;
	} elseif($type=='total') {
		$domain = isset($_POST['domain']) ? $_POST['domain'] : '';
		$year   = isset($_POST['year']) ? $_POST['year'] : 0;
		$total  = 0;
		if(count($domain) > 0) {
			for ($i = 0; $i < count($domain); $i++) {
				$pos = strpos($domain[$i], '.');
				$domain_ex = substr($domain[$i], 0, $pos);
				$ext = substr($domain[$i], $pos);
				$price = 0;
				$db->table = 'others';
				$db->condition = "name LIKE '$ext'";
				$db->order = "";
				$db->limit = 1;
				$rows = $db->select();
				foreach ($rows as $row) {
					$price = $row['price'] + 0;
				}
				$total = $total + ($price * $year[$i]);
			}
			echo formatNumberVN($total) . $lgTxt_svc_money_unit;
		} else echo '0' . $lgTxt_svc_money_unit;
	}
} else echo 'Error--';