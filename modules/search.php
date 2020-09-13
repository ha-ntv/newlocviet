<?php
	if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
	//
	$date = new DateClass();
	$stringObj = new String();

    $hoa =  isset($_GET['k']) ? $_GET['k'] : "";
    if($hoa=="'"){
    	$hoa = "";
    }else{
    	$hoa = $hoa;
    }
?>
<div class="container-fluid fluid_tit">
    <div class="row">
        <div class="container ner_titlelt">
            <p class="brow_tit">
                <a href="<?php echo HOME_URL_LANG;?>">Trang chủ</a>
                <a href="javascript:;" style="color: #fff !important;cursor: default;">Kết quả tìm kiếm</a>
            </p>
        </div>
    </div>
</div>	
<div class="container nervhoa">
	<div class="tongtkiem">
		<div class="row">
			<?php
				$db->table = "product";
				$db->condition = "name like '%".$hoa."%'";
				$db->order = "created_time DESC";
				$db->limit = "";
				$row = $db->select();
				$total = $db->RowCount;
				if($total > 0){
				$slug_submenu = "";
			    $parent = false;
			    $total_pages = 0;
			    $per_page = 12;
			    if($total%$per_page==0) $total_pages = $total/$per_page;
			    else $total_pages = floor($total/$per_page)+1;
			    if($page<=0) $page=1;
			    $start=($page-1)*$per_page;

			    $db->table = "product";
				$db->condition = "name like '%".$hoa."%'";
				$db->order = "";
				$db->limit = $start.','.$per_page;
				$rowqqqw = $db->select();
				foreach ($rowqqqw as $valueb) {
			    		$gia = $valueb['price'];
		            	if($gia=="" || $gia==0){
		            		$gias = "Liên hệ";
		            	}else{
		            		$gias = number_format($gia,0,',','.').' VNĐ';
		            	}
				?>
					<div class="col-md-3 col-sm-3 col-xs-3 item_spham ititem_spham_list">
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
				            	<p class="giasp"><span>Giá:</span> <span><?php echo $gias;?></span></p>
				            </div>
				        </div>
			        </div>
			<?php } ?>
		</div>
	</div>
	<?php showPageNavigation($page, $total_pages,'/'.$slug_cat.'/'.$slug_submenu.'?p='); }else{?>
	<div class="container timkiemc" style="">
		<?php
			echo "Rất tiếc, <b>Lộc Việt</b> không tìm thấy kết quả nào phù hợp với từ khóa"." "."'".$hoa."'";
		?>
		<h3 style="font-weight: 600; font-stretch: normal; font-size: 16px; line-height: 18px; font-family: Helvetica, Arial, &quot;DejaVu Sans&quot;, &quot;Liberation Sans&quot;, Freesans, sans-serif; outline: none; zoom: 1;margin-top: 10px;">Để tìm được kết quả chính xác hơn, bạn vui lòng:</h3>
		<ul style="margin: 10px 0px;list-style: none; line-height: 20px; font-family: Helvetica, Arial, &quot;DejaVu Sans&quot;, &quot;Liberation Sans&quot;, Freesans, sans-serif; font-size: 14px;">
			<li style="list-style-position: inside; list-style-type: disc;">Kiểm tra lỗi chính tả của từ khóa đã nhập</li>
			<li style="list-style-position: inside; list-style-type: disc;">Thử lại bằng từ khóa khác</li>
			<li style="list-style-position: inside; list-style-type: disc;">Thử lại bằng những từ khóa tổng quát hơn</li>
			<li style="list-style-position: inside; list-style-type: disc;">Thử lại bằng những từ khóa ngắn gọn hơn</li>
		</ul>
	</div>
</div>
<?php
	}
?>