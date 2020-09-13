<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
$product_id = $_POST["id"] ? $_POST["id"] : 0;
if($product_id) {
    delItemCart($product_id, 1);
    echo json_encode(array(
        'html' => showCartItem(),
        'number' => count($_SESSION['cart'])
    ));
}
?>