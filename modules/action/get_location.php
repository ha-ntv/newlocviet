<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if(isset($_POST['city'])) {
	$city = $_POST['city'];
	echo loadListDistrict($city, '') . '<i class="fa fa-pa fa-map-marker"></i>';
}