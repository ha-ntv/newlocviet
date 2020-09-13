<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//------------------------------------------
$url = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; 
$url1 = explode('/', $url);
$url3 = count($url1);
$bien = $url3 - 1;
	$url2 = $url1[$bien];
	$db->table = "gallery";
	$db->condition = "gallery_menu_id = 114";
	$db->order = "";
	$db->limit = "";
	$rs = $db->select('img');
	$src_img = $rs[0]['img']!= 'no' && $rs[0]['img']!='' ? HOME_URL. '/uploads/gallery/full_'.$rs[0]['img']: HOME_URL. '/images/banner.jpg';
	$new_src_img =  HOME_URL. '/images/header_banner.jpg';
?> 
<header id="header" class="t3-header" style="background:url('<?php echo $new_src_img ?>') center no-repeat;background-size: cover;">
	<div class="header clearfix">
		<div class="container">
			<div class="row">		
				<div class="col-lg-8 col-md-8 col-sm-5">
					<h1 id="site-title">
						<a href="<?php echo HOME_URL ?>">Lộc Phúc &#8211; Tinh dầu thiên nhiên &#8211; Máy xông tinh dầu</a>
					</h1>
					<a href="<?php echo HOME_URL ?>" title="Lộc Phúc Tinh dầu thiên nhiên &#8211; Máy xông tinh dầu">
						<img class="logo" alt="Lộc Phúc Tinh dầu thiên nhiên &#8211; Máy xông tinh dầu" src="<?php echo HOME_URL ?>/images/new_logo2.png">
					</a>
				</div>		
				<div class="col-lg-4 col-md-4 col-sm-6 hidden-xs">
					<div class="hotline pull-right">
        				<div class="textwidget">
							<p>
								<span class="number"><?php echo getConstant('tell_contact') ?> </span>
								<span class="email"><?php echo getConstant('email_contact') ?></span>
							</p>
						</div>
				    </div>
					       
				</div>
			</div>
		</div>	
    </div>    
	<nav id="primarynav" class="navbar navbar-default">
		<div class="container">		
			<div class="navbar-collapse">
				<ul id="menu-primary-menu" class="nav navbar-nav hidden-xs">
					<li id="menu-item-14" class="menu-item menu-item-type-custom menu-item-object-custom <?=( $slug_cat =='home' ? 'current-menu-item current_page_item active': '') ?> menu-item-home menu-item-14 "><a title="Trang chủ" href="<?php echo HOME_URL ?>">Trang chủ</a></li>
					<?php
						$db->table = "category";
						$db->condition = "`is_active` = 1";
						$db->order = "sort_hide ASC";
						$db->limit = "6";
						$rows = $db->select();
						foreach($rows as $r) {
							
							echo '<li class="menu-item menu-item-type-custom menu-item-object-custom  menu-item-home '.( $slug_cat == $r['slug'] ? 'current-menu-item current_page_item active': ''). (checkMenuHasChild($r['category_id'], $r['type_id'])?  ' has-child':'').'"><a href="/'.$r['slug'].'" >'.$r['name'].(checkMenuHasChild($r['category_id'], $r['type_id']) ? '<i class="fa fa-chevron-down"></i>' : '').'</a>'.loadSubMenu($r['category_id'], $r['type_id']).'</li>';
						}
						?>
					<li id="menu-item-285" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-285 <?=$slug_cat == 'lien-he' ? 'current-menu-item current_page_item active':''?>"><a title="Liên hệ" href="<?php echo HOME_URL ?>/lien-he/">Liên hệ</a></li>
				</ul>		
				<button data-effect="off-canvas-effect-4" data-nav="#t3-off-canvas" data-pos="left" type="button" class="pull-left btn-inverse off-canvas-toggle visible-xs">
					<i class="fa fa-bars"></i>
				</button>
				<div class="cart pull-right">						
					<a href="#" class="top_panel_cart_button">
						<i class="fa fa-shopping-cart"></i>
						
						<span class="contact_cart_totals">
							<span class="cart_items">
								<?php echo isset($_SESSION['cart']) ?  count($_SESSION['cart']) : 0 ?>
								
							</span>
						</span>
					</a>
					<ul class="widget_area sidebar_cart sidebar">
						<li>
							<div class="widget woocommerce widget_shopping_cart">
								<div class="hide_cart_widget_if_empty">
									<?php echo showCartItem() ?>
								</div>
							</div>
						</li>
					</ul>
				</div>    
				<div class="search-box hidden-sm">
					<form action="<?php echo HOME_URL ?>/search" method="get" id="search_mini_form">
						<input placeholder="tìm kiếm sản phẩm..." value="" maxlength="70" name="k" id="search" type="text">
						<input name="post_type" value="product" type="hidden">
						<button type="submit" class="search-btn-bg"><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
					</form>
				</div>
				
			</div>					
		</div>
	</nav>
</header>
