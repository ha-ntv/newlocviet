<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
$product_id = $_POST["id"] ? $_POST["id"] : 0;
$qty = $_POST["qty"] ? $_POST["qty"] : 1;
if($product_id) {
    addToCart($product_id, $qty);
    echo json_encode(array(
        'html' => showCartItem(),
        'number' => count($_SESSION['cart'])
    ));
}
?>