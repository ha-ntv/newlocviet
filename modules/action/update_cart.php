<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
$arr = $_POST["qty"] ? $_POST["qty"] : NULL;
if(!empty($arr)) {
    $arr = json_decode($arr,true);
    updateCart( $arr);
    echo 'success';
}
?>