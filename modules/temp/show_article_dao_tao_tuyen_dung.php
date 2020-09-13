<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
?>
<?php 
	$sumView = 0;
	$db->table = "article";
	$db->condition = "is_active = 1 and article_id = ".$id;
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	if($db->RowCount>0){ 
		foreach($rows as $row) {
			$db->table = "article";
			$db->condition = "is_active = 1 and article_menu_id = ".($row['article_menu_id']+0).' and article_id <> '.$id;
			$db->order = "created_time DESC";
			$db->limit = 4;
			$rows2 = $db->select();
			$total = $db->RowCount;
?>
<div class="container-fluid fluid_tit">
    <div class="row">
        <div class="container ner_titlelt">
            <p class="brow_tit">
                <a href="<?php echo HOME_URL_LANG;?>">Trang chủ</a>
                <a href="<?php echo HOME_URL_LANG;?>/dao-tao-tuyen-dung">Đào tạo & tuyển dụng</a>
            </p>
        </div>
    </div>
</div>	
<div class="container ner_newdetail">
	<div class="row tongdetail_vh">
		<div class="col-md-9 col-sm-9 col-xs-9 leftdt_vhoa">
			<div class="tongleft_dtvh">
				<p class="namedt_vh"><?php echo $row['name'];?></p>
				<p class="timevhdt"><i class="far fa-clock"></i>&nbsp;&nbsp;<?php echo date('d/m/Y', $row['created_time']);?></p>
				<p class="pre_tindetail"><?php echo $row['comment'];?></p>
				<div class="cten_dtvh">
					<?php echo $row['content'];?>
				</div>
				<div class="tr_nophoso">
					<p class="nophoso_bt">Nộp hồ sơ</p>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-3 col-xs-3 rightdt_vh">
			<div class="other_listtin">
				<p class="us_other"><?= $ctlq;?></p>
				<?php
					$db->table = "article";
					$db->condition = "is_active = 1 and article_id != ".$id." AND article_menu_id = ".$id_menu;
					$db->order = "created_time DESC";
					$db->limit = 3;
					$rowt = $db->select();
					foreach($rowt as $rowp) {
				?>
					<div class="col-md-12 col-sm-12 col-xs-12 item_vanhoapdv item_vanhoapdv_dt">
						<div class="trumvh_pdv">
							<div class="img_vanhoapdv">
								<a href="<?php echo HOME_URL_LANG;?>/<?php echo $rowp['slug'];?>">
									<?php if($rowp['img']=="" || $rowp['img']=="no"){ ?>
										<img src="<?php echo HOME_URL;?>/images/353x232.png">
									<?php }else{ ?>
										<img src="<?php echo HOME_URL;?>/uploads/article/353x232<?php echo $rowp['img'];?>">
									<?php } ?>
								</a>
							</div>
							<div class="content_vanhoa">
								<p class="namevh_list"><a href="<?php echo HOME_URL_LANG;?>/<?php echo $rowp['slug'];?>"><?php echo $stringObj->crop(stripcslashes($rowp['name']), 12);?></a></p>
								<p class="timevh"><i class="far fa-clock"></i>&nbsp;&nbsp;<?php echo date('d/m/Y', $rowp['created_time']);?></p>
								<p class="prevhoa_list"><?php echo $stringObj->crop(stripcslashes($rowp['comment']), 50);?></p>
							</div>
						</div>
					</div>
				<?php } ?>
				<ul class="linew_orther" style="display: none;">
					<?php
						$db->table = "article";
						$db->condition = "is_active = 1 and article_id != ".$id." AND article_menu_id = ".$id_menu;
						$db->order = "created_time DESC";
						$db->limit = 7;
						$rowt = $db->select();
						foreach($rowt as $rowp) {
					?>
						<li><a href="<?php echo HOME_URL_LANG;?>/<?php echo $rowp['slug'];?>"><?php echo $rowp['name'];?></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<div class="tongform_nhs">
			<div class="tr_formnophs">
				<i class="fa fa-times close_btnbt" aria-hidden="true"></i>
				<p class="titnhs">Nộp hồ sơ</p>
				<input type="hidden" name="lang_field" value="<?php echo $txtEnter_field;?>"/>
				<input type="hidden" name="lang_email" value="<?php echo $txtEnter_email;?>"/>
				<input type="hidden" name="lang_phone" value="<?php echo $txtEnter_tell;?>"/>
				<form id="_nophoso_daotao" name="nophoso_daotao" enctype="multipart/form-data" class="frm f-space20" method="post" onsubmit="return sendMail1('send_nophoso', '_nophoso_daotao',  '<?php echo $ale;?>');">
					<input type="hidden" name="lang" value="<?php echo TTH_LANGUAGE ?>">
					<input type="hidden" name="typeFunc" value="ungtuyen">
					<div class="input_hoso">
						<div class="tr_inpuths">
							<div class="col-md-6 col-sm-6 col-xs-6 iput_hoso">
								<input type="text" id="name" name="name" placeholder="Họ tên" maxlength="250">
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6 iput_hoso">
								<input type="email" id="email" name="email" placeholder="Email" maxlength="250">
							</div>
							<input type="hidden" id="name_khoa" name="name_khoa" value="<?php echo $row['name'];?>">
							<div class="clear-fix"></div>
							<div class="col-md-6 col-sm-6 col-xs-6 iput_hoso">
								<input type="text" id="phone" name="phone" placeholder="Số điện thoại" maxlength="10">
							</div>
							<div class="clear-fix"></div>
							<div class="col-md-6 col-sm-6 col-xs-6 iput_hoso">
								<select name="male">
									<option value=''>Giới tính</option>
									<option value='Nam'>Nam</option>
									<option value='Nữ'>Nữ</option>
									<option value='Khác'>Khác</option>
								</select>
							</div>
							<div class="clear-fix"></div>
							<!-- <div style="display: none">
								<input class="form-control file file-img" type="file" name="img" data-show-upload="false" data-max-file-count="1" accept="image/*">
							</div> -->
							<div class="col-md-6 col-sm-6 col-xs-6 iput_hoso">
								<input type="text" id="age" name="age" placeholder="Tuổi" maxlength="20">
							</div>
							<div class="clear-fix"></div>
							<div class="col-md-6 col-sm-6 col-xs-6 iput_hoso iput_hoso12">
								<input class="form-control file file-doc" type="file" name="file" data-show-upload="false" data-show-preview="false" data-max-file-count="1" placeholder="CV" required="required">
							</div>
							<div class="clear-fix"></div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 btn_smhoso">
							<input type="submit" id="_send_hoso" value="Nộp" name="send_hoso">
						</div>
					</div>
				</form>
			</div>
		</div>
		<script type="text/javascript">
			window.onload = check_hoso();
			// $('.file-img').fileinput({
			// 	allowedFileExtensions : ['jpg', 'png','gif']
			// });
			$('.nophoso_bt').click(function(){
				$('.tongform_nhs').css('display', 'block')
				$('body').css('overflow', 'hidden')
			})
			$('.close_btnbt').click(function(){
				$('.tongform_nhs').css('display', 'none')
				$('body').css('overflow', 'inherit')
			})
		</script>
	</div>
</div>
<?php
		$sumView = $row['views']+1;
	}
	$db->table = "article";
	$data = array(
		'views'=>$sumView
	);
	$db->condition = "article_id = ".$id;
	$db->update($data);

}
else include(_F_MODULES . DS . "error_404.php");