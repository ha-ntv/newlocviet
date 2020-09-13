<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if(isset($_POST['id'])) {
	$type   = isset($_POST['type']) ? $_POST['type'] : '';
	$id     = empty($_POST['id']) ? 0 : $_POST['id']+0;
	if($type=='hosting') {
		$db->table = "article";
		$db->condition = "`article_id` = $id";
		$db->order = "";
		$db->limit = 1;
		$rows = $db->select();
		foreach($rows as $row) {
			?>
			<div class="modal-dialog">
				<div class="modal-header">
					<h3><i class="fa fa-tags fa-fw"></i> Đăng ký dịch vụ</h3>
				</div>
				<div class="modal-body">
					<input type="hidden" name="lang_field" value="<?php echo $txtEnter_field;?>">
					<input type="hidden" name="lang_email" value="<?php echo $txtEnter_email;?>">
					<input type="hidden" name="lang_phone" value="<?php echo $txtEnter_tell;?>">
					<form id="_frm_order" name="frm_order" class="frm" method="post" onsubmit="return sendMail('send_order', '_frm_order');">
						<input type="hidden" name="id" value="<?php echo $id;?>">
						<input type="hidden" name="type" value="hosting">
						<div class="info-svc clearfix">
							<label><?php echo getTableOl($row['article_menu_id'], 'article_menu', 'article_menu_id', 'icon') . ' - ' . stripslashes($row['name']);?></label>
							<label>
								<select name="year" onclick="return get_money(this.value, <?php echo $id;?>, 'hosting', '');">
									<option value="1" selected>1 năm</option>
									<option value="2">2 năm</option>
									<option value="3">3 năm</option>
									<option value="4">4 năm</option>
									<option value="5">5 năm</option>
									<option value="6">6 năm</option>
									<option value="7">7 năm</option>
									<option value="8">8 năm</option>
									<option value="9">9 năm</option>
									<option value="10">10 năm</option>
								</select>
							</label>
							<label><span class="tt"><?php echo $lgTxt_svc_money;?></span><span id="_money"><?php echo formatNumberVN($row['price']) . $lgTxt_svc_money_unit;?></span><span class="vat"><?php echo $lgTxt_svc_money_vat;?></span></label>
						</div>
						<div class="clearfix">
							<div class="form-item form-sm">
								<input type="text" name="name" placeholder="<?php echo $txtContact_name?>" maxlength="180" required="required" autocomplete="off">
								<i class="fa fa-user"></i>
							</div>
							<div class="form-item form-sm">
								<input type="text" name="address" placeholder="<?php echo $txtContact_address?>" maxlength="250" required="required" autocomplete="off">
								<i class="fa fa-building-o"></i>
							</div>
						</div>
						<div class="clearfix">
							<div class="form-item form-sm">
								<input type="text" name="email" placeholder="<?php echo $txtContact_email?>" maxlength="250" required="required" autocomplete="off">
								<i class="fa fa-envelope"></i>
							</div>
							<div class="form-item form-sm">
								<input type="text" name="tel" placeholder="<?php echo $txtContact_fone?>" maxlength="20" required="required" autocomplete="off">
								<i class="fa fa-mobile fa-lg"></i>
							</div>
						</div>
						<div class="form-item form-bg">
							<textarea name="content" placeholder="<?php echo $lgTxt_svc_frm_content;?>" cols="60" rows="3"></textarea>
							<i class="fa fa-pencil"></i>
						</div>
						<div class="frm-button"><input type="submit" id="_send_order" class="btn btn-primary btn-round" name="order" value="Đăng ký"></div>
					</form>
				</div>
				<div class="modal-footer"><?php echo $lgTxt_hotline; ?><i class="fa fa-phone"></i> <a style="color: #da251d; font-weight: 600;" href="tel:<?php echo getConstant('tell_contact') ?>"><?php echo getConstant('tell_contact') ?></a></div>
				<script>
					window.onload = check_order();
				</script>
			</div>
			<?php
		}
	} elseif($type=='domain') {
		$domain = isset($_POST['reg']) ? $_POST['reg'] : '';
		$domain = explode(',', $domain);
		?>
		<div class="modal-dialog">
			<div class="modal-header">
				<h3><i class="fa fa-tags fa-fw"></i> Đăng ký Tên miền</h3>
			</div>
			<div class="modal-body">
				<input type="hidden" name="lang_field" value="<?php echo $txtEnter_field;?>">
				<input type="hidden" name="lang_email" value="<?php echo $txtEnter_email;?>">
				<input type="hidden" name="lang_phone" value="<?php echo $txtEnter_tell;?>">
				<form id="_frm_order" name="frm_order" class="frm" method="post" onsubmit="return sendMail('send_order', '_frm_order');">
					<input type="hidden" name="type" value="domain">
					<div class="info-svc clearfix">
						<div class="it-title">
							<div class="it"><label>Tên miền</label><label>Thời hạn</label><label>Số tiền</label></div>
						</div>
						<?php
						$total = 0;
						for($i=0; $i<count($domain); $i++) {
							$pos = strpos($domain[$i], '.');
							$domain_ex = substr($domain[$i], 0, $pos);
							$ext       = substr($domain[$i], $pos);
							$price = 0;
							$db->table = 'others';
							$db->condition = "name LIKE '$ext'";
							$db->order = "";
							$db->limit = 1;
							$rows = $db->select();
							foreach ($rows as $row){
								$price = $row['price']+0;
							}
							$total = $total + $price;
							?>
							<div class="it">
								<label><?php echo $domain[$i];?><input type="hidden" name="domain[]" value="<?php echo $domain[$i];?>"></label>
								<label>
									<select name="year[]" onclick="return get_money(this.value, '<?php echo $ext;?>', 'domain', <?php echo $i;?>);">
										<option value="1" selected>1 năm</option>
										<option value="2">2 năm</option>
										<option value="3">3 năm</option>
										<option value="4">4 năm</option>
										<option value="5">5 năm</option>
										<option value="6">6 năm</option>
										<option value="7">7 năm</option>
										<option value="8">8 năm</option>
										<option value="9">9 năm</option>
										<option value="10">10 năm</option>
									</select>
								</label>
								<label><span id="_money<?php echo $i;?>"><?php echo formatNumberVN($price) . $lgTxt_svc_money_unit;?></span></label>
							</div>
						<?php } ?>
						<div class="it total">
							<label>&nbsp;</label>
							<label class="total">TỔNG TIỀN:</label>
							<label><span id="_total"><?php echo formatNumberVN($total) . $lgTxt_svc_money_unit;?></span><span class="vat"><?php echo $lgTxt_svc_money_vat;?></span></label>
						</div>
					</div>
					<div class="clearfix">
						<div class="form-item form-sm">
							<input type="text" name="name" placeholder="<?php echo $txtContact_name?>" maxlength="180" required="required" autocomplete="off">
							<i class="fa fa-user"></i>
						</div>
						<div class="form-item form-sm">
							<input type="text" name="address" placeholder="<?php echo $txtContact_address?>" maxlength="250" required="required" autocomplete="off">
							<i class="fa fa-building-o"></i>
						</div>
					</div>
					<div class="clearfix">
						<div class="form-item form-sm">
							<input type="text" name="email" placeholder="<?php echo $txtContact_email?>" maxlength="250" required="required" autocomplete="off">
							<i class="fa fa-envelope"></i>
						</div>
						<div class="form-item form-sm">
							<input type="text" name="tel" placeholder="<?php echo $txtContact_fone?>" maxlength="20" required="required" autocomplete="off">
							<i class="fa fa-mobile fa-lg"></i>
						</div>
					</div>
					<div class="form-item form-bg">
						<textarea name="content" placeholder="<?php echo $lgTxt_svc_frm_content;?>" cols="60" rows="3"></textarea>
						<i class="fa fa-pencil"></i>
					</div>
					<div class="frm-button"><input type="submit" id="_send_order" class="btn btn-primary btn-round" name="order" value="Đăng ký"></div>
				</form>
			</div>
			<div class="modal-footer"><?php echo $lgTxt_hotline; ?><i class="fa fa-phone"></i> <a style="color: #da251d; font-weight: 600;" href="tel:<?php echo getConstant('tell_contact') ?>"><?php echo getConstant('tell_contact') ?></a></div>
			<script>
				window.onload = check_order();
			</script>
		</div>
		<?php
	} elseif($type=='general') {
		$db->table = "article";
		$db->condition = "`article_id` = $id";
		$db->order = "";
		$db->limit = 1;
		$rows = $db->select();
		foreach($rows as $row) {
			?>
			<div class="modal-dialog">
				<div class="modal-header">
					<h3><i class="fa fa-tags fa-fw"></i> Đăng ký dịch vụ</h3>
				</div>
				<div class="modal-body">
					<input type="hidden" name="lang_field" value="<?php echo $txtEnter_field;?>">
					<input type="hidden" name="lang_email" value="<?php echo $txtEnter_email;?>">
					<input type="hidden" name="lang_phone" value="<?php echo $txtEnter_tell;?>">
					<form id="_frm_order" name="frm_order" class="frm" method="post" onsubmit="return sendMail('send_order', '_frm_order');">
						<input type="hidden" name="id" value="<?php echo $id;?>">
						<input type="hidden" name="type" value="general">
						<div class="info-svc"><?php echo stripslashes($row['name']);?></div>
						<div class="clearfix">
							<div class="form-item form-sm">
								<input type="text" name="name" placeholder="<?php echo $txtContact_name?>" maxlength="180" required="required" autocomplete="off">
								<i class="fa fa-user"></i>
							</div>
							<div class="form-item form-sm">
								<input type="text" name="address" placeholder="<?php echo $txtContact_address?>" maxlength="250" required="required" autocomplete="off">
								<i class="fa fa-building-o"></i>
							</div>
						</div>
						<div class="clearfix">
							<div class="form-item form-sm">
								<input type="text" name="email" placeholder="<?php echo $txtContact_email?>" maxlength="250" required="required" autocomplete="off">
								<i class="fa fa-envelope"></i>
							</div>
							<div class="form-item form-sm">
								<input type="text" name="tel" placeholder="<?php echo $txtContact_fone?>" maxlength="20" required="required" autocomplete="off">
								<i class="fa fa-mobile fa-lg"></i>
							</div>
						</div>
						<div class="form-item form-bg">
							<textarea name="content" placeholder="<?php echo $lgTxt_svc_frm_content;?>" cols="60" rows="3"></textarea>
							<i class="fa fa-pencil"></i>
						</div>
						<div class="frm-button"><input type="submit" id="_send_order" class="btn btn-primary btn-round" name="order" value="Đăng ký"></div>
					</form>
				</div>
				<div class="modal-footer"><?php echo $lgTxt_hotline; ?><i class="fa fa-phone"></i> <a style="color: #da251d; font-weight: 600;" href="tel:<?php echo getConstant('tell_contact') ?>"><?php echo getConstant('tell_contact') ?></a></div>
				<script>
					window.onload = check_order();
				</script>
			</div>
			<?php
		}
	}
} else echo 'Error--';