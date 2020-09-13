<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
?>
<div class="container-fluid fluid_tit">
	<div class="row">
		<div class="container ner_titlelt">
			<p class="brow_tit">
				<a href="<?php echo HOME_URL_LANG;?>">Trang chủ</a>
				<a href="<?php echo HOME_URL_LANG;?>/lien-he">Liên hệ</a>
			</p>
		</div>
	</div>
</div>

<div class="container nerlhe">
	<h2>LIÊN HỆ - GÓP Ý</h2>
	<div class="row tonglhe">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 left_lhe">
			<h3><span> LIÊN HỆ</span></h3>
			<div class="contact-info">
				<ul>
					<li><strong><i class="fa fa-home"></i></strong> <?php echo getConstant('address_contact') ?></li>
					<li><strong><i class="fa fa-phone fa-fw"></i></strong><?php echo getConstant('tell_contact') ?></li>
					<li><strong><i class="fa fa-phone fa-fw"></i></strong><?php echo getConstant('hotline') ?></li>
					<li><strong><i class="fa fa-envelope-o fa-fw"></i></strong><?php echo getConstant('email_contact') ?></li>
					<li><strong><i class="fa fa-globe fa-fw fa-lg"></i></strong><?php echo getConstant('website') ?></li>
					<li><strong><img src="/images/shop-store.svg" style="width:20px"></strong><?php echo getConstant('showroom') ?></li>
				</ul>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right_lhe">
			<h3><span> FORM LIÊN HỆ - GÓP Ý</span></h3>
			<div class="formlienhe"> 
				<input type="hidden" name="lang_field" value="<?php echo $txtEnter_field;?>"/>
				<input type="hidden" name="lang_email" value="<?php echo $txtEnter_email;?>"/>
				<input type="hidden" name="lang_phone" value="<?php echo $txtEnter_tell;?>"/>
				<form id="_frm_contact" name="frm_contact" class="frm f-space20" method="post" onsubmit="return sendMail('send_contact', '_frm_contact');">
					<input type="hidden" name="lang" value="<?php echo TTH_LANGUAGE ?>">
					<div class="row input_lienhe">
						<div class="trum_2input">
							<div class="col-md-6 col-sm-6 col-xs-6 in_name">
								<input type="text" id="full_name" autocomplete="off" name="full_name" placeholder="<?php echo $txtContact_name; ?>"maxlength="250">
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6 in_phone">
								<input type="text" id="tel" autocomplete="off" name="tell" placeholder="<?=$txtContact_fone?>" maxlength="20">
							</div>
						</div>
						<div class="trum_2inputsau">
							<div class="col-md-6 col-sm-6 col-xs-6 in_phone">
								<input type="text" id="add" autocomplete="off" name="add" placeholder="<?=$txtContact_address?>" maxlength="20">
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6 in_email">
								<input type="email" id="email" autocomplete="off" name="email" placeholder="<?=$txtContact_email?>" maxlength="250">
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 text_noidung">
							<textarea name="content" id="content" placeholder="<?=$txtContact_content?>" cols="60" rows="4"></textarea>
						</div>
					</div>
					<div class="btn_submit send_lienhe">
						<input style="" class="" type="submit" id="_send_contact" value="<?= $gd;?>" name="send_contact" >
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="map_ctac">
		<?= getpage('map_contact');?>
	</div>
</div>
<script>
	window.onload = check_contact();
</script>