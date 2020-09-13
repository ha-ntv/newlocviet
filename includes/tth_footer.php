<?php
	if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
	$date = new DateClass();
	$stringObj = new String();
?>
<div id="services" class="hidden-xs clearfix">
	<div class="container">
		<div id="text-4" class="widget_text">
			<div class="textwidget">
				<div class="row">
					<div class="col-md-3 col-sm-3">
						<i class="fa fa-truck"></i></p>
						<h2>Vận chuyển</h2>
						<p>Ship hàng COD toàn quốc</p>
					</div>
					<div class="col-md-3 col-sm-3">
						<p><i class="fa fa-hand-o-right"></i></p>
						<h2>Cam kết</h2>
						<p>Sản phẩm đúng như trên web</p>
					</div>
					<div class="col-md-3 col-sm-3">
						<p><i class="fa fa-money"></i></p>
						<h2>Thanh toán</h2>
						<p>Tiền mặt hoặc chuyển khoản</p>
					</div>
					<div class="col-md-3 col-sm-3">
						<p><i class="fa fa-support"></i></p>
						<h2>Tư vấn miễn phí 24/7</h2>
						<p>Hotline: <?php echo getConstant('hotline')?>
						</p>
					</div>
				</div>
			</div>
		</div>			
	</div>
</div>
<div id="botsl">
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-md-5 col-xs-12">
				<div class="widget-about-us">
					<div id="text-2" class="widget_text"><h3><span>TINH DẦU LỘC PHÚC - NGUYÊN CHẤT TỪ THIÊN NHIÊN</span></h3>
						<div class="textwidget">
							<p><strong>Lộc Phúc</strong> chuyên cung cấp các sản phẩm tinh dầu thiên nhiên, sản phẩm được chứng nhận chất lượng. Lộc Phúc có đầy đủ các mùi vị tinh dầu</p>
							<div class="contact-info">
								<ul>
									<li><i class="fa fa-map-marker"></i> <?php echo getConstant('address_contact') ?></li>
									<li><i class="fa fa-phone-square"></i> <?php echo getConstant('hotline') ?></li>
									<li><i class="fa fa-globe"></i> <?php echo getConstant('website') ?> &#8211; <i class="fa fa-envelope-square"></i> <?php echo getConstant('email_contact') ?></li>
								</ul>
							</div>
							<h4 class="widget-title">FOLLOW US</h4>
							<div class="textwidget">
								<div class="list-social no-name ">
									<ul>
										<li class="youtube"><a class="hvr-push" href="<?php echo getConstant('link_youtube') ?>" target="_blank" rel="noopener noreferrer"><img src="<?php echo HOME_URL ?>/images/icon-youtube.png" alt="youtube" title="youtube"></a></li>
										<li class="facebook"><a class="hvr-push" href="<?php echo getConstant('link_facebook') ?>" target="-blank" rel="noopener noreferrer"><img src="<?php echo HOME_URL ?>/images/icon-facebook.png" alt="facebook" title="facebook"></a></li>
										<li class="googleplus"><a class="hvr-push" href="/" target="_blank" rel="noopener noreferrer"><img src="<?php echo HOME_URL ?>/images/google-photo-icon.png" alt="google image" title="google image"></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>		
				</div>
			</div>
			<div class="col-sm-8 col-md-7 footer-right">
				<div class="footer-right-bottom clearfix">
					<div id="text-5" class="widget_text">
						<div class="textwidget">
							<div class="row">
								<div class="col-sm-4 col-md-4 col-xs-6">
									<div class="widget_text">
										<h3 class="widget-title">THÔNG TIN LỘC PHÚC</h3>
										<ul class="links">
											<li><a href="/gioi-thieu/"><span>Giới thiệu Lộc Phúc</span></a></li>
											<li><a href="/lien-he">Địa chỉ liên hệ</a></li>
											<li><a href="/gio-hang">Đặt hàng và thanh toán</a></li>
										</ul>
									</div>
								</div>
								<div class="col-sm-4 col-md-4 col-xs-6">
									<div class="widget_text">
										<h3 class="widget-title">DỊCH VỤ VÀ HỖ TRỢ</h3>
										<ul class="links">
											<li><a href="/chinh-sach-ban-hang/"><span>CHÍNH SÁCH BÁN HÀNG</span></a></li>
											<li><a href="/chinh-sach-bao-hanh/"><span>CHÍNH SÁCH BẢO HÀNH</span></a></li>
											<li><a href="/huong-dan-mua-hang/">HƯỚNG DẪN MUA HÀNG</a></li>
											<li><a href="/chinh-sach-doi-tra/">CHÍNH SÁCH ĐỔI TRẢ</a></li>
											<li><a href="/bao-mat-thong-tin-khach-hang/">BẢO MẬT THÔNG TIN KHÁCH HÀNG</a></li>
										</ul>
									</div>
								</div>
								<div class="col-sm-4 col-md-4 hidden-xs">
									<div class="widget_text">
										<h3 class="widget-title">SẢN PHẨM</h3>
										<ul class="links">
											<li><a href="/tinh-dau">Tinh Dầu bán chạy</a></li>
											<li><a href="/tinh-dau">Sản phẩm được Yêu thích</a></li>
											<li><a href="/may-khuech-tan-tinh-dau">Đèn xông tinh dầu</a></li>
										</ul>			
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<a href="tel:<?php echo str_replace(' ','',getConstant('hotline'))?>" title="Hotline" class="btn-call2"><span><i class="fa fa-phone"></i></span><p class="d-none d-md-block"><strong><?php echo getConstant('hotline')?></strong></p></a>
<!--footer-->
<footer id="footer" class="clearfix">
	<div class="container">
		<div class="copyright">COPYRIGHT © <?php echo date("Y"); ?> <strong>TINH DẦU LỘC PHÚC</strong></div>
	</div>
</footer><!--end footer-->

<script type="text/javascript">
jQuery('.top_panel_cart_button').on('click', function(e) {
		"use strict";
		e.preventDefault();
		jQuery(this).siblings('.sidebar_cart').slideToggle();
	});
function add_cart_this(id) {
	jQuery.ajax({
		url:'/action.php',
		type: 'POST',
		data: 'url=add_cart&id='+id,
		dataType: "json",
		success: function(data){
			jQuery('.widget_area .hide_cart_widget_if_empty').html(data.html);
			jQuery('.cart_items').html(data.number);
		}
	});
}
function see_cart(id) {
 $('body').addClass('cart-opened');
 $('body').append('<div id="sidebar_cart"></div>');
 $('body').append('<div class="body-mask"></div>');
 var qty = $('#product_qty').length ? $('#product_qty').val() : 1;
 jQuery.ajax({
		url:'/action.php',
		type: 'POST',
		data: 'url=see_sidebar_cart&proId='+id + '&qty='+qty,
		dataType: "html",
		success: function(data){
			jQuery('#sidebar_cart').html(data);
		}
	});
}
function close_cart_sidebar() {
	$('body').removeClass('cart-opened');
 	$('#sidebar_cart').remove();
	 $('.body-mask').remove();
}
jQuery('body').on('click', '.remove_from_cart_button', function(e){
	e.preventDefault();
	var id = jQuery(this).attr('data-product_id');
	jQuery.ajax({
		url:'/action.php',
		type: 'POST',
		data: 'url=delete_cart&id='+id,
		dataType: "json",
		success: function(data){
			jQuery('.widget_area .hide_cart_widget_if_empty').html(data.html);
			jQuery('.cart_items').html(data.number);
		}
	});
})
</script>