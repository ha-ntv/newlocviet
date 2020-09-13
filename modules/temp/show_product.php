<script type='text/javascript' src='<?php echo HOME_URL ?>/js/jquery.flexslider.min.js'></script>
<script type='text/javascript' src='<?php echo HOME_URL ?>/js/jquery.zoom.min.js'></script>
<?php
if (!defined('TTH_SYSTEM')) {
	die('Please stop!');
}
//
$sumView = 0;
$db->table = "product";
$db->condition = "is_active = 1 and product_id = " . $id;
$db->order = "";
$db->limit = "";
$rows = $db->select();
if ($db->RowCount > 0) {
	foreach ($rows as $row) {
		$viewas = $row['views'];
		$img_dt = $row['img'];
		$name_pro = $row['name'];
		$upl = ($row['upload_id'] + 0);
		$gia = $row['price'];
		if ($gia == "" || $gia == 0) {
			$gias = "Liên hệ";
			$oldPrice = "Liên hệ";
		} else {
			$gias = number_format($gia, 0, ',', '.') . ' VNĐ';
			$oldPrice = number_format($gia + $plus_price, 0, ',', '.') . ' VNĐ';
		}
		$db->table = "product";
		$db->condition = "is_active = 1 and product_menu_id = " . ($row['product_menu_id'] + 0) . ' and product_id <> ' . $id;
		$db->order = "created_time DESC";
		$db->limit = 8;
		$rows2 = $db->select();
		$total = $db->RowCount;
		$list_img = "";
		$db->table = "uploads_tmp";
		$db->condition = "upload_id = " . $upl;
		$db->order = "";
		$db->limit = 1;
		$rows_gal = $db->select();

		foreach ($rows_gal as $row_gal) {
			$list_img = $row_gal['list_img'];
		}
		$img_list = [];
		$img = explode(";", $list_img);
		$img_src = ($img_dt  == "" || $img_dt  == "no" ) ?  '/images/360x360.png' : '/uploads/product/360x360'. $row['img'];
		

		for ($i = 0; $i < count($img); $i++) {
			if ($img[$i] != "") {
				if($i < 4)
					$img_list[] = HOME_URL . '/uploads/photos/full_' . $img[$i];
			}
		}
	
?>
		<div class="container-fluid fluid_tit">
			<div class="row">
				<div class="container ner_titlelt">
					<p class="brow_tit">
						<a href="<?php echo HOME_URL_LANG; ?>">Trang chủ</a>
						<a href="<?php echo HOME_URL_LANG; ?>/san-pham">Sản phẩm</a>
					</p>
				</div>
			</div>
		</div>
		<div class="container ner_listpro">
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-12 left_menupro">
					<?php include(_F_INCLUDES . DS . "tth_left.php"); ?>
				</div>
				<div class="col-md-9 col-sm-9 col-xs-12 right_dtprolist">
					<div class="row_trpro">
						<div class="left_imgpro">
							<div class="tr_imgprol">
								<?php if(count($img_list)) : ?>
								<div class="woocommerce-product-gallery woocommerce-product-gallery--with-images flexslider">
									<ul class="woocommerce-product-gallery__wrapper slides">
										<?php

										for ($i = 0; $i < count($img_list); $i++) {
											if ($img_list[$i] != "") {
										?>
												<li data-thumb="<?= $img_list[$i] ?>" class="woocommerce-product-gallery__image">
													<a href="<?= $row['slug'] ?>">
														<img src="<?= $img_list[$i] ?>" class="wp-post-image" alt="<?= $row['name'] ?>" title="<?= $row['name'] ?>" data-caption="" data-src="<?= $img_list[$i] ?>" data-large_image="<?= $img_list[$i] ?>" srcset="<?= $img_list[$i] ?> ,<?= $img_list[$i] ?> ,<?= $img_list[$i] ?> ,<?= $img_list[$i] ?> , <?= $img_list[$i] ?>,<?= $img_list[$i] ?> , <?= $img_list[$i] ?>" sizes="(max-width: 416px) 100vw, 416px" />
													</a>
												</li>

										<?php
											}
										}
										?>
									</ul>
								</div>
									<?php else: 
									
										?>
										<p><img src="<?php echo $img_src; ?>"></p>
									<?php endif; ?>
							</div>
						</div>
						<div class="right_listpro">
							<div class="tr_detailpro">
								<p class="name_proli"><?php echo $row['name']; ?></p>
								<p class="mapro">Mã sản phẩm: <?php echo $row['product_keys']; ?></p>
								<p class="giasp"><span>Giá:</span> <span style="text-decoration:line-through"><?php echo $oldPrice; ?></span></p>
								<p class="giasp"><span>Giá sales:</span> <span><?php echo $gias; ?></span></p>
								<div class="content_prodt">
									<?php echo $row['content']; ?>
								</div>
							</div>
							<div class="datmuasanpham">

								<p class="soluongtren">Số lượng:</p>
								<div style="display: inline-block;position: relative;">
									<span class="tru" onclick="truso()">-</span>
									<input id="product_qty" type="number" class="qtyu" name="qty" value="1" onchange="kiemtraso()">
									<span class="cong" onclick="congso()">+</span>
									<input type="hidden" name="id" value="<?= $row['product_id'] ?>">
									<button type="button" id="book_now" class="submitdatmua" name="addCart" value="mua-hang">Đặt hàng ngay</button>
									<button type="button" id="see_cart" class="submitdatmua" name="addCart" value="sub" onclick="see_cart(<?= $id ?>)"><img src="<?= HOME_URL ?>/images/giohang.png" align="left" style="padding-right: 10px;padding-top: 5px;">Thêm vào giỏ hàng</button>
								</div>

							</div>
						</div>

						<script type="text/javascript">
							function congso() {
								var num1 = jQuery('.qtyu').val()
								if (num1 < 0) {
									alert('Bạn không thể cộng')
									jQuery('.qtyu').val(Number(1))
								} else {
									num1 = Number(num1) + Number(1)
									jQuery('.qtyu').val(Number(num1))
								}
							}

							function truso() {
								var num1 = jQuery('.qtyu').val()
								if (num1 <= 1) {
									alert('Bạn không thể tiếp tục giảm sản phẩm')
									jQuery('.qtyu').val(Number(1))
								} else {
									num1 = num1 - 1
									jQuery('.qtyu').val(Number(num1))
								}
							}

							function kiemtraso() {
								var num1 = jQuery('.qtyu').val()
								if (isNaN(num1)) {
									alert("Bạn hảy nhập vào giá trị là số")
									jQuery('.qtyu').val(Number(1))
								} else if (num1 < 1) {
									alert('Bạn phải nhập giá trị lớn hơn 0')
									jQuery('.qtyu').val(Number(1))
								} else {
									jQuery('.qtyu').val(1)
								}
							}
							jQuery(document).ready(function() {

								jQuery('#book_now').click(function() {
									var qty = jQuery('.qtyu').val();
									add_cart_this(<?= $id ?>, qty);
									setTimeout(function() {
										location.href = "/gio-hang";
									}, 500)
								})
							})
						</script>
					</div>
					<div class="row rowdiv_hai">
						<div class="col-md-7 col-sm-7 col-xs-7 left_huongdan">
							<div class="tr_huongdan">
								<p class="tit_huongdan">Hướng dẫn sử dụng</p>
								<div class="content_huongdan">
									<?php echo $row['huongdan']; ?>
								</div>
							</div>
						</div>
						<div class="col-md-5 col-sm-5 col-xs-5 right_lhepro" style="display:none">
							<div class="tr_td_khpro">
								<div class="thm_pro">
									<p><span class="thacmac">Bạn có thắc mắc?</span><br /><span class="lh_chungtoi">Hãy liên hệ với chúng tôi</span></p>
								</div>
								<div class="phone_lhpro">
									<p><?php echo getConstant('tell_contact'); ?></p>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 trum_mang">
							<div class="mangxahoi">
								<div class="fb-like" data-href="https://www.facebook.com/tinhdaulocphuc/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>
								<div onclick="javascript:window.open('https://twitter.com/intent/tweet?source=webclient&text=locviet&url=<?php echo site_url() ?>&hashtags=locviet','_blank')" class="share_twitter"><img src="<?php echo HOME_URL; ?>/images/twi.png">&nbsp;Tweet</div>
								<div onclick="javascript:window.open('https://plus.google.com/share?url=<?php echo site_url() ?>','_blank')" class="share_plus"><img src="<?php echo HOME_URL; ?>/images/pl.png"></div>
							</div>
							<div class="comment_fbok">
								<div class="fb-comments" data-href="<?php echo site_url() ?>" data-width="100%" data-numposts="10"></div>
							</div>
						</div>
					</div>
					<p class="spcungloai">Sản phẩm cùng loại</p>
					<div class="row orthe_proend">
						<div class="tong_prolist_cungloai">
							<?php
							$db->table = "product";
							$db->condition = "is_active = 1 AND product_menu_id = " . $id_menu . " AND product_id != " . $id;
							$db->order = "created_time DESC";
							$db->limit = "4";
							$rowb = $db->select();
							foreach ($rowb as $valueb) {
								$gia = $valueb['price'];
								if ($gia == "" || $gia == 0) {
									$gias = "Liên hệ";
									$oldPrice = "Liên hệ";
								} else {
									$oldPrice = number_format($gia + $plus_price, 0, ',', '.') . ' VNĐ';
									$gias = number_format($gia, 0, ',', '.') . ' VNĐ';
								}
							?>
								<div class="col-md-3 col-sm-6 col-xs-6 item_spham item_spham_dt">
									<div class="tong_sphamhome">
										<div class="imgspham">
											<a href="<?php echo HOME_URL_LANG; ?>/<?= $valueb['slug']; ?>">
												<?php if ($valueb['img'] == "" || $valueb['img'] == "no") { ?>
													<img src="<?= HOME_URL; ?>/images/209x209.png">
												<?php } else { ?>
													<img src="<?= HOME_URL; ?>/uploads/product/209x209<?= $valueb['img']; ?>">
												<?php } ?>
											</a>
										</div>
										<div class="cten_sphamhome">
											<p class="name_sphome"><a href="<?php echo HOME_URL_LANG; ?>/<?= $valueb['slug']; ?>"><?php echo $valueb['name']; ?></a></p>
											<div class="product_meta">
												<span class="price price-old"><?php echo $oldPrice; ?></span>
												<span class="price price-sale"><?php echo $gias; ?></span>
												<input type="submit" name="addCart" value="MUA NGAY" class="btn btn-mua" onClick="add_cart_this(<?= $valueb['product_id'] ?>)" />
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>

		</div>

		<script type='text/javascript'>
			$(window).load(function() {
				$('.woocommerce-product-gallery').flexslider({
					"rtl": false,
					"animation": "slide",
					"smoothHeight": true,
					"directionNav": true,
					"controlNav": "thumbnails",
					"slideshow": false,
					"animationSpeed": 500,
					"animationLoop": false,
					"allowOneSlide": false,
				});
				$('.woocommerce-product-gallery__image').zoom()
			});
		</script>
<?php
		$sumView = $viewas + 1;
	}
	$db->table = "product";
	$data = array(
		'views' => $sumView
	);
	$db->condition = "product_id = " . $id;
	$db->update($data);
} else include(_F_MODULES . DS . "error_404.php");
