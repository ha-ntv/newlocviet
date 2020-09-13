<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
$date = new DateClass();
$events = array();
$db->table = "others";
$db->condition = "`is_active` = 1";
$db->order = "";
$db->limit = "";
$rows = $db->select();
if($db->RowCount>0) {
	foreach($rows as $row) {
		$id = $row['others_id'];
		if($filter==0) {
			$e = array();
			$e['id'] = $id;
			$e['title'] = stripslashes($row['name']);
			$e['description'] = stripslashes($row['p_to']);
			$e['start'] = $date->vnOther($row['p_from'], 'Y-m-d') . ' 0:0:0';
			$e['end'] = $date->vnOther($row['p_from'], 'Y-m-d') . ' 23:59:59';
			$e['allDay'] = true;
			array_push($events, $e);
		}
	}
}
echo json_encode($events);