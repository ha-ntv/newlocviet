<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//

$sumView = 0;
$db->table = "product";
$db->condition = "is_active = 1 and product_id = ".$id;
$db->order = "";
$db->limit = "";
$rows = $db->select();
if($db->RowCount>0){
	foreach($rows as $row) {
		$db->table = "product";
		$db->condition = "is_active = 1 and product_menu_id = ".($row['product_menu_id']+0).' and product_id <> '.$id;
		$db->order = "created_time DESC";
		$db->limit = 9;
		$rows2 = $db->select();
		$total = $db->RowCount;

		$photo_avt = '';
		$alt = ($row['img_note']!="") ? stripslashes($row['img_note']) : stripslashes($row['name']);
		if($row['img']!="" && $row['img']!="no") {
			$photo_avt = '<img u="image" src="'. HOME_URL .'/uploads/product/'. $row['img'] . '" alt="' . $alt . '" />';
		} else {
			$photo_avt = '<img src="'. HOME_URL .'/images/hoan-vu-decor.jpg" alt="'.$alt.'" />';
		}
		$sale = '';
		if($row['sale']>0) $sale = '<div class="sale"><p>-' . $row['sale']  . '%</p></div>';
		$price = '';
		if($row['price']>0) $price = '<p class="price">Giá bán: ' . stripslashes(formatNumberVN($row['price']))  . '/Cuộn</p>';
		else $price = '<p class="price">Giá bán: Liên hệ</p>';
		//$sale = $price = '';
		//if($row['sale']>0) $sale = '<span class="_sale_">-' . $row['sale']  . '%</span>';
		//if($row['price']>0) $price = '<div class="price-tb-bx"><p class="price-tb-dea">' . $sale . '<span class="price-sw">' . formatNumberVN($row['price']) . '<sup>' . //$lgTxt_price_unitTour . '</sup></span></p></div>';
		//else $price = '<div class="price-tb-bx"><p class="price-tb-dea"><span class="price-sw">' . $lgTxt_price . '<sup>' . $lgTxt_price_contact . '</sup></span></p></div>';
?>
<div class="send_product animated fadeIn" style="display:none;">
	<a href="#close-modal" class="close-modal" rel="modal:close"><input type="reset" id="reset" class="hide_send_product" value="Hủy"></a>
	<form id="_frm_order" action="" name="frm_order" class="frm modal booking" method="post" onsubmit="return sendOrder('send_order', '_frm_order');">
		<div class="title-order">
			<h3>THÔNG TIN MUA HÀNG</h3>
		</div>
		<input type="hidden" name="lang_field" value="<?php echo $txtEnter_field;?>"/>
		<input type="hidden" name="lang_email" value="<?php echo $txtEnter_email;?>"/>
		<input type="hidden" name="lang_phone" value="<?php echo $txtEnter_tell;?>"/>
		<div class="f-space05 clearfix">
			<input type="hidden" name="id" value="<?php echo $row['product_id'];?>">
            <div class="form-item form-im clearfix">
                <div class="img">
					<?php echo $photo_avt; ?>
				</div>
				<div class="form-con">
					<h3 style="font-size:15px;"><?php echo $row['name']; ?> </h3>
					<p class="keys">Mã SP: <?php echo stripslashes($row['product_keys']); ?></p>
					<p class="model">Nhà sản xuất: <?php echo stripslashes($row['model']); ?></p>
					<?php echo $price; ?>
				</div>
            </div>
            <div class="form-item form-sm">
                <input type="text" name="full_name" placeholder="Họ và tên:" value="" maxlength="250" >
                <i class="fa fa-user"></i>
            </div>
            <div class="form-item form-sm">
                <input type="text" name="address" placeholder="Địa chỉ:" value="" maxlength="250">
                <i class="fa fa-map-marker"></i>
            </div>
			<div class="form-item form-sm">
                <input type="text" name="email" placeholder="Email:" value="" maxlength="250">
                <i class="fa fa-envelope"></i>
            </div>
            <div class="form-item form-sm">
                <input type="text" name="tell" placeholder="Số điện thoại:" value="" maxlength="20">
                <i class="fa fa-phone fa-lg"></i>
            </div>
			<div class="clearfix"></div>
			<div class="form-item form-bg">
				<h4 class="title-bo"><?php echo getNameCategory(80); ?></h4>
			</div>
			<div class="clearfix"></div>
			<div class="form-item" style="padding: 0px">
				<?php
				$db->table = "others_menu";
				$db->condition = "`is_active` = 1 AND `parent` = 0 AND `category_id` = 80";
				$db->order = "`sort` ASC";
				$db->limit = "";
				$rows = $db->select();
				foreach($rows as $row_it){
					echo '<div class="form-sm"><input type="radio" name="vehicle" checked value="' . stripslashes($row_it['name']) . '"><label class="radio">' . stripslashes($row_it['name']) .'</label></div>';
				}
				?>
			</div>
            <div class="clearfix"></div>
        </div>
        <div class="form-bg button">
            <div class="form-item hvr-icon-pop clearfix">
                <input type="submit" id="send_order" name="send_order" value="Đặt Hàng">
			</div>
        </div>
		<div class="form-item form-bg">
		</div>
    </form>
    <script>
        window.onload = check_booking();
    </script>
</div>
<?php
		$sumView = $row['views']+1;
	}
	$db->table = "product";
	$data = array(
		'views'=>$sumView
	);
	$db->condition = "product_id = ".$id;
	$db->update($data);

}
else include(_F_MODULES . DS . "error_404.php");