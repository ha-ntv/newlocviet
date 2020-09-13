<?php
$id = isset($_GET['id']) ? $_GET['id']+0: 0;
if($id) {
    $db->table = "province";
    $db->condition = "province_id = ". $id;
    $db->order = "";
    $db->limit = "";
    $rows = $db->select('price');
    echo $rows[0]['price'];
} else return false;



?>