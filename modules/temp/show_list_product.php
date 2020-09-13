<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
?> 
<?php
	$url = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; 
	$url1 = explode('/', $url);
	$dem = count($url1);
	$dem1 = $dem-1;
	$bien = $url1[$dem1];
?>
<div class="container-fluid fluid_tit">
    <div class="row">
        <div class="container ner_titlelt">
            <p class="brow_tit">
                <a href="<?php echo HOME_URL_LANG;?>">Trang chủ</a>
                <a href="<?php echo HOME_URL_LANG;?>/san-pham">Sản phẩm</a>
            </p>
        </div>
    </div>
</div>
<div class="container ner_listpro">
	<div class="row">
		<div class="col-md-3 col-sm-3  left_menupro">
			<?php include(_F_INCLUDES . DS . "tth_left.php"); ?>
		</div>
		<div class="col-md-9 col-sm-9 col-xs-12 right_listpro">
			<?php 
				if($id_menu != 0){
					$db->table = "product_menu";
					$db->condition = "product_menu_id = ".$id_menu;
					$db->order = "";
					$db->limit = "";
					$rowk = $db->select();
					foreach ($rowk as $row) {
						if($row['img']=="" || $row['img']=="no"){}else{
			?>
				<div class="img_edit_menuid">
					<img src="<?php echo HOME_URL;?>/uploads/product_menu/full_<?php echo $row['img'];?>" width="100%">
					<?php if($row['comment']==""){}else{?>
						<div class="pre_pro_editsau"><?php echo $row['comment'];?></div>
					<?php } ?>
				</div>
			<?php } } } ?>
			<div class="row">
				<?php
			    	foreach ($rows as $valueb) {
			    		$gia = $valueb['price'];
		            	if($gia=="" || $gia==0){
							$gias = "Liên hệ";
							$oldPrice = "Liên hệ";
		            	}else{
							$oldPrice = number_format($gia + $plus_price,0,',','.').' VNĐ';
							$gias = number_format($gia,0,',','.').' VNĐ';
		            	}
				?>
					<div class="col-md-4 col-sm-6 col-xs-6 item_spham item_spham_list">
			        	<div class="tong_sphamhome">
				            <div class="imgspham">
				                <a href="<?php echo HOME_URL_LANG;?>/<?= $valueb['slug'];?>">
				                    <?php if($valueb['img']=="" || $valueb['img']=="no"){ ?>
				                        <img src="<?= HOME_URL;?>/images/209x209.png">
				                    <?php }else{ ?>
				                        <img src="<?= HOME_URL;?>/uploads/product/209x209<?= $valueb['img'];?>">
				                    <?php } ?>
				                </a>
				            </div>
				            <div class="cten_sphamhome">
				            	<p class="name_sphome"><a href="<?php echo HOME_URL_LANG;?>/<?= $valueb['slug'];?>"><?php echo $valueb['name'];?></a></p>
				            	
								<div class="product_meta">
									<span class="price price-old"><?php echo $oldPrice;?></span>
									<span class="price price-sale"><?php echo $gias;?></span>
									<input type="submit" name="addCart" value="MUA NGAY" class="btn btn-mua" onClick="add_cart_this(<?= $valueb['product_id'] ?>)"/>
								</div>
				            </div>
				        </div>
			        </div>
				<?php }?>
			</div>
		</div>
	</div>
</div>
			
	