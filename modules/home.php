<?php
	if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
	$date = new DateClass();
	$stringObj = new String();
?>

<div id="home-products" class="clearfix">
	<div class="container">
		<div class="widget-product clearfix carousel">		
			<div class="box-heading">
				<h4><a href="<?php echo HOME_URL ?>/tinh-dau/">Sản phẩm mới</a></h4>	
			</div>		
			<div class="carousel-4 owl-carousel owl-theme">
			
			<?php
			$sql = "SELECT * from olala3w_product WHERE hot = 1 AND is_active = 1  AND product_menu_id IN ( SELECT product_menu_id FROM olala3w_product_menu WHERE category_id = 3 ) LIMIT 8";
			$rks = $db->sql_query($sql);
			foreach($rks as $ks) {
				if($ks['img']=="" || $ks['img']=="no"){ 
					$src =  HOME_URL. '/images/209x209.png';
					}else{ $src= HOME_URL .'/uploads/product/209x209'. $ks['img'] ;
				} 
				?>
				<div class="item">				
					<div class="product-image">
						<a href="<?php echo HOME_URL .'/'.$ks['slug'] ?>" title="<?php echo $ks['name']?>">	
							<img src="<?php echo $src ?>" class="img-responsive wp-post-image" alt="<?php echo $ks['name']?>" />
						</a>
					</div>
					<h2 class="product-name"><a href="<?php echo HOME_URL .'/' .$ks['slug'] ?>" title="<?php echo $ks['name']?>l"><?php echo $ks['name']?></a></h2>
					<div class="product-meta">
						<span class="price price-old"><?php echo $ks["price"] ?  number_format($ks["price"] + $plus_price,0,',','.'). ' VNĐ': 'Liên hệ'?></span>
						<span class="price price-sale"><?php echo $ks["price"] ?  number_format($ks["price"],0,',','.'). ' VNĐ': 'Liên hệ'?></span>				
						
							<input type="submit" name="addCart" value="MUA NGAY" class="btn btn-mua" onClick="add_cart_this(<?= $ks['product_id'] ?>)"/>
						
					</div>
				</div>			
				<?php
				}
				?>
			</div>
		</div>
		<div class="widget-product clearfix grid">		
			<div class="box-heading">
				<h4><a href="/san-pham/">Sản phẩm Bán chạy</a></h4>	
			</div>	
			<div class="mod-products">
				<?php
				$sql = "SELECT * from olala3w_product WHERE hot = 1 AND is_active = 1  AND product_menu_id IN ( SELECT product_menu_id FROM olala3w_product_menu WHERE category_id = 3 )";
				$rks = $db->sql_query($sql);
				foreach($rks as $ks) {
					if($ks['img']=="" || $ks['img']=="no") { 
						$src =  HOME_URL. '/images/209x209.png';
						} else { $src= HOME_URL .'/uploads/product/209x209'. $ks['img'] ;
					} 
					?>
				<div class="product-block">					
					<div class="product-image">
						<div class="hover">
							<a href="<?php echo HOME_URL.'/'.$ks['slug'] ?>" title="<?php echo $ks['name']?>">XEM THÊM</a>
						</div>						
						<img src="<?php echo $src ?>" class="img-responsive wp-post-image" alt="<?php echo $ks['name']?>" />
					</div>
					<h2 class="product-name"><a href="<?php echo HOME_URL .'/'.$ks['slug'] ?>" title="<?php echo $ks['name']?>l"><?php echo $ks['name']?></a></h2>
					<div class="product-meta">
						<span class="price price-old"><?php echo $ks["price"] ?  number_format($ks["price"]+ $plus_price,0,',','.'). ' VNĐ': 'Liên hệ'?></span>
						<span class="price price-sale"><?php echo $ks["price"] ?  number_format($ks["price"],0,',','.'). ' VNĐ': 'Liên hệ'?></span>				
						
							<input type="submit" name="addCart" value="MUA NGAY" class="btn btn-mua" onClick="add_cart_this(<?= $ks['product_id'] ?>)"/>
						
					</div>
				</div>
					<?php
				}
				?>
			</div>
		</div>
		</div>
		<div id="home-news" class="clearfix">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-12">
							<h3>Chỉ đường tới Lộc Phúc</h3>	
								<div class="textwidget">
								<?= getpage('map_contact');?>
								</div>
							</div>	
							<div class="col-md-4 col-sm-6">
								<div class="widget_bulletin classic">
									<h3 class="widget-title"><span>Tư vấn sử dụng</span></h3>
									<ul>	
									<?php
										$sql = "SELECT * from olala3w_article WHERE hot = 1 AND is_active = 1  AND article_menu_id IN ( SELECT article_menu_id FROM olala3w_article_menu WHERE category_id = 5 ) LIMIT 3";
										$rss = $db->sql_query($sql);
										 foreach($rss as $r) {
											 $src = '';
											 if($r['img']=="" || $r['img']=="no"){ 
												$src =  HOME_URL. '/images/450x332.png';
											 }else{ $src= HOME_URL .'/uploads/article/450x332'. $r['img'] ;
											} 
											 ?>
											 <li>
												<a href="<?php echo HOME_URL .'/'. $r['slug'] ?>" title="<?php echo $r['name'] ?>">
													<img src="<?php echo $src ?>" class="attachment-small-thumb size-small-thumb wp-post-image" alt="<?php echo $r['name'] ?>" />
												</a>
												<h4>
													<a href="<?php echo HOME_URL .'/'. $r['slug'] ?>" title="<?php echo $r['name'] ?> " rel="bookmark"><?php echo $r['name'] ?> </a>
												</h4>
												<time class="meta-date" ><?php echo date('d/m/Y', $r['created_time']); ?></time>
											</li>											
											 <?php
											 }
											?>					
									</ul>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<h3>Facebook Fanpage Lộc Phúc</h3>
								<div class="textwidget"><div class="fb-page" data-href="https://www.facebook.com/tinhdaulocphuc/" data-small-header="true" data-adapt-container-width="true" data-show-facepile="true"></div></div>
							</div>
						</div>
					</div>
				</div>
												
										
										
					
					