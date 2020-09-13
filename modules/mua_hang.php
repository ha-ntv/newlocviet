<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
?>
<script type="text/javascript">
	  jQuery(document).ready(function()
	    {
		jQuery("body,html").animate({scrollTop:500},1000);
		
		});	
</script>
<?php
//---------------[ box-wp BEGIN ]---------------------------
$category_id = 0;
$breadcrumb_home = '<a href="'. HOME_URL_LANG . '" title="' . $lgTxt_menu_home . '"><i class="fa fa-home"></i></a>';
$breadcrumb_category = $breadcrumb_menu_parent = $breadcrumb_menu = '';

$db->table = "category";
$db->condition = "is_active = 1 and slug = '".$slug_cat."'";
$db->order = "";
$db->limit = 1;
$rows = $db->select();
foreach ($rows as $row) {
	$category_id = $row['category_id']+0;
	$breadcrumb_category = '<a href="' . HOME_URL_LANG . '/' . $slug_cat . '" title="' . stripslashes($row['name']) . '">' . stripslashes($row['name']) . '</a>';
}
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if(isset($_POST['remove'])) {
	removeCart();
}
if (isset($_SESSION['cart']))
	$cart = $_SESSION['cart'];
else
	$cart = array();
$_SESSION['cart'] = $cart;

if(isset($_POST['addCart']) && isset($_POST['id'])) {
	addToCart($_POST['id']+0, $_POST['qty']+0);
}
if(isset($_GET['del']) && isset($_GET['del'])) {
	delItemCart($_GET['del']); 
}
if(isset($_POST['updates']) && isset($_POST['qty'])) {
	updateCart($_POST['qty']);
}
?>
<div class="container-fluid fluid_tit">
    <div class="row">
        <div class="container ner_titlelt">
            <p class="brow_tit">
                <a href="<?php echo HOME_URL_LANG;?>">Trang chủ</a>
                <a href="<?php echo HOME_URL_LANG;?>/mua-hang">Giỏ hàng</a>
            </p>
        </div>
    </div>
</div>
<div class="container breadcr">
	<div class="row">
	    <div class="col-xs-12 col-sm-12 col-md-12 mainsanphamchinh">
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-3 left_menupro">
					<?php include(_F_INCLUDES . DS . "tth_left.php"); ?>
				</div>
				<div class="col-md-9 col-sm-9 col-xs-9 right_muahng">
					<div class="cart-parent">
						<div class="show-cart"><?=showCart();?></div>
					</div>
					<div id="order-form" class="f-space15 carthang"  style="margin-bottom: 20px;">
						<form id="frm_order" name="frm_order" class="frm shopping" method="post" onsubmit="return sendMail2('send_order', 'frm_order');">
							<input type="hidden" name="lang_field" id="txtEnterField" value="<?=$txtEnter_field?>"/>
							<input type="hidden" name="lang_email" id="txtEnterMail" value="<?=$txtEnter_email?>"/>
							<input type="hidden" name="lang_phone" id="txtEnterTell" value="<?=$txtEnter_tell?>"/>
							<div class="row f-space05 clearfix">
								<div class="col-xs-6 col-sm-6 col-md-6 input_muahng">
									<input type="text" id="txtName" name="name" placeholder="<?=$txtContact_name?>" value="" maxlength="250">
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6 input_muahng">
									<input type="text" id="txtAddress" name="address" placeholder="<?=$txtContact_address?>" value="" maxlength="250">
								</div>
								<div class="clearfix"></div>
								<div class="col-xs-6 col-sm-6 col-md-6 input_muahng">
									<input type="text" id="txtEmail" name="email" placeholder="<?=$txtContact_email?>" value="" maxlength="250">
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6 input_muahng"> 
									<input type="text" id="txtTell" name="tel" placeholder="<?=$txtContact_fone?>" value="" maxlength="20">
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 input_muahng">
									<textarea id="txtContent" name="txtContent" placeholder="<?=$txtContact_content?>" cols="60" rows="5"></textarea>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 input_chuyenkhoan">
									<p class="htthanhtoan">Hình thức thanh toán</p>
									<div class="radio_mot">
										<input type="radio" checked="checked" name="thanhtoan" value="Thanh toán tại nhà"><label>Thanh toán tại nhà</label>
									</div>
									<div class="radio_hai">
										<input type="radio" name="thanhtoan" value="Thanh toán chuyển khoản"><label>Thanh toán chuyển khoản</label>
										<div class="trum_ptk">
											<?php echo getPage('sotk');?>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 nutmuahang">
									<input type="submit" id="_send_order" name="btnSendOrder" value="">
								</div>	
							</div>
						</form>
						<script>
							window.onload = check_order();
							jQuery('.btn-booking_oline').click(function(){
								jQuery('#order-form').slideToggle();
							})
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	