<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
$product_id = $_POST["proId"] ? $_POST["proId"] : 0;
$qty =  $_POST["qty"] ? $_POST["qty"] : 1;
if($product_id) {
    addToCart($product_id, $qty);
}
 readCartForSideMenu();
 ?>