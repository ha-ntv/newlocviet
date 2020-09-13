<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//

function product($act, $typeFunc, $product_id, $product_menu_id, $name, $slug, $img, $img_note, $product_keys, $price, $guarantee, $sale, $comment, $content, $huongdan, $upload_img_id, $is_active, $hot, $pin, $created_time, $title, $description, $keywords, $error) {
	global $db, $tth;
	$db->table = "product_menu";
	$db->condition = "`product_menu_id` = $product_menu_id";
	$db->order = "";
	$db->limit = 1;
	$rows = $db->select();
	foreach($rows as $row){
		dashboardCoreAdminTwo($tth.";".$row['category_id']);
	}
	//---
	$link_id = 0;
	$db->table = "link";
	$db->condition = "`link` LIKE '". $db->clearText($slug) . "'";
	$db->order = "";
	$db->limit = 1;
	$rows = $db->select();
	foreach($rows as $row) {
		$link_id = $row['link_id'];
	}
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-files-o"></i> Nội dung sản phẩm
			</div>
			<div class="panel-body">
				<div class="table-respon">
					<form action="<?php echo $act?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="typeFunc" value="<?php echo $typeFunc?>" />
						<input type="hidden" name="product_id" value="<?php echo $product_id?>" />
						<input type="hidden" name="img" value="<?php echo $img?>" />
						<input type="hidden" name="upload_img_id" value="<?php echo $upload_img_id?>">
						<div class="panel-show-error">
							<?php echo $error?>
						</div>
						<table class="table table-hover">
							<tr>
								<td width="12%"><label>Tiêu đề:</label></td>
								<td width="88%" colspan="3"><input class="form-control" type="text" id="name" name="name" maxlength="255" value="<?php echo stripslashes($name)?>" required="required" ></td>
							</tr>
							<tr>
								<td><label>Liên kết tĩnh:</label></td>
								<td class="element-relative" colspan="3">
									<input class="form-control" type="text" id="slug" name="slug" maxlength="255" value="<?php echo stripslashes($slug)?>" >
									<div data-toggle="tooltip" data-placement="top" title="Tạo liên kết tĩnh" class="btn-get-slug" onclick="return getSlug2(<?php echo $link_id;?>);"></div>
								</td>
							</tr>
							<tr>
								<td><label>Mục:</label></td>
								<td colspan="3"><?php echo categoryName($product_menu_id);?></td>
							</tr>
							<tr>
								<td width="12%" class="ver-top"><label>Hình đại diện:</label></td>
								<td width="38%" class="ver-top">
									<input class="form-control file file-img" type="file" name="img" data-show-upload="false" data-max-file-count="1" accept="image/*" >
								</td>
								<td width="12%" class="ver-top"><label>Ghi chú hình:</label></td>
								<td width="38%" class="ver-top"><input class="form-control" type="text" name="img_note" maxlength="255" value="<?php echo stripslashes($img_note)?>" ></td>
							</tr>
							<tr>
								<td><label>Mã sản phẩm:</label></td>
								<td><input class="form-control" type="text" name="product_keys" maxlength="50" value="<?=stripslashes($product_keys)?>" ></td>
								<td><label>Giá:</label></td>
								<td><input class="form-control auto-number" type="text" name="price" data-a-sep="." data-a-dec="," data-v-max="9999999999" data-v-min="0" maxlength="15" placeholder="0 =  Liên hệ" value="<?=stripslashes($price)?>"></td>
								<?php if($product_id==-100){?>
									<td><label>Sale: (%)</label></td>
									<td><input class="form-control auto-number" type="text" name="sale" maxlength="2" value="<?=stripslashes($sale)?>" data-a-sep="." data-a-dec="," data-v-max="99" data-v-min="0" autocomplete="off"></td>
								<?php } ?>
							</tr>
							<tr>
								<!-- <td><label>Giá:</label></td>
								<td><input class="form-control auto-number" type="text" name="price" data-a-sep="." data-a-dec="," data-v-max="9999999999" data-v-min="0" maxlength="15" placeholder="0 =  Liên hệ" value="<?=stripslashes($price)?>"></td> -->
								<?php if($product_id==-100){?>
									<td><label>Đơn vị:</label></td>
									<td><input class="form-control" type="text" name="guarantee" maxlength="255" value="<?=stripslashes($guarantee)?>"></td>
								<?php } ?>
							</tr>
							<tr>
								<td align="left" class="ver-top"><label>Mô tả:</label></td>
								<td colspan="3">
									<textarea class="form-control" rows="3" name="comment"><?php echo stripslashes($comment)?></textarea>
								</td>
							</tr>
							<tr>
								<td class="ver-top"><label>Nội dung:</label></td>
								<td colspan="3">
									<textarea class="form-control" id="content" name="content"><?php echo stripslashes($content)?></textarea>
								</td>
							</tr>
							<tr>
								<td class="ver-top"><label>Hướng dẫn sử dụng:</label></td>
								<td colspan="3">
									<textarea class="form-control" id="huongdan" name="huongdan"><?php echo stripslashes($huongdan)?></textarea>
								</td>
							</tr>
							<tr>
								<td class="ver-top"><label>Upload photos:</label></td>
								<td colspan="3">
									<input id="album" class="form-control file" type="file" name="images[]" data-max-file-count="15" accept="image/*" multiple>
								</td>
							</tr>
							<tr>
								<td><label>Trạng thái:</label></td>
								<td colspan="3">
									<label class="radio-inline"><input type="radio" name="is_active" value="0" <?php echo $is_active==0?"checked":""?> > Đóng&nbsp;</label>
									<label class="radio-inline"><input type="radio" name="is_active" value="1" <?php echo $is_active==1?"checked":""?> > Mở&nbsp;</label>
								</td>
							</tr>
							<tr>
								<td><label>Nổi bật:</label></td>
								<td colspan="3">
									<label class="radio-inline"><input type="radio" name="hot" value="0" <?php echo $hot==0?"checked":""?> > Đóng&nbsp;</label>
									<label class="radio-inline"><input type="radio" name="hot" value="1" <?php echo $hot==1?"checked":""?> > Mở&nbsp;</label>
								</td>
							</tr>
							<tr>
								<td><label>Ghim trang chủ:</label></td>
								<td colspan="3">
									<label class="radio-inline"><input type="radio" name="pin" value="0" <?php echo $pin==0?"checked":""?> > Đóng&nbsp;</label>
									<label class="radio-inline"><input type="radio" name="pin" value="1" <?php echo $pin==1?"checked":""?> > Mở&nbsp;</label>
								</td>
							</tr>
							<tr>
								<td><label>Ngày đăng:</label></td>
								<td colspan="3"><input class="form-control input-datetime" type="text" name="created_time" style="width: 160px;"  value="<?php echo $created_time?>" ></td>
							</tr>
							<tr>
								<td class="tth-bg-df" colspan="4"><strong>SEO</strong> -<span class="tth-gp-text">Không bắt buộc phải nhập, dữ liệu được lấy tự động nếu rỗng.</span></td>
							</tr>
							<tr>
								<td class="tth-gp-l"><label>Title:</label></td>
								<td class="tth-gp-r" colspan="3"><input class="form-control" type="text" name="title" maxlength="255" value="<?php echo stripslashes($title)?>" ></td>
							</tr>
							<tr>
								<td class="tth-gp-l"><label>Description:</label></td>
								<td class="tth-gp-r" colspan="3"><input class="form-control" type="text" name="description" maxlength="255" value="<?php echo stripslashes($description)?>" ></td>
							</tr>
							<tr>
								<td class="tth-gp-l tth-gp-b"><label>Keywords:</label></td>
								<td class="tth-gp-r tth-gp-b" colspan="3"><input class="form-control" type="text" name="keywords" data-role="tagsinput" value="<?php echo stripslashes($keywords)?>" ></td>
							</tr>
							<tr>
								<td colspan="4" align="center">
									<button type="submit" class="btn btn-form-primary btn-form">Đồng ý</button> &nbsp;
									<button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
									<button type="button" class="btn btn-form-info btn-form" onclick="location.href='?<?php echo TTH_PATH?>=product_list&id=<?php echo $product_menu_id?>'">Thoát</button>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- The blueimp Gallery widget -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
	<div class="slides"></div>
	<h3 class="title"></h3>
	<a class="prev">‹</a>
	<a class="next">›</a>
	<a class="close">×</a>
	<a class="play-pause"></a>
	<ol class="indicator"></ol>
</div>
<?php
$dir_dest = ROOT_DIR . DS .'uploads'. DS .'photos';
$list_img = "";
$p1 = $p2 = array();
$db->table = "uploads_tmp";
$db->condition = "upload_id = ".$upload_img_id;
$db->order = "";
$db->limit = "";
$rows = $db->select();
foreach ($rows as $row){
	$list_img = $row['list_img'];
}

$files_img = explode(";", $list_img);
if(count($files_img)>0) {
	for ($i = 0; $i < count($files_img); $i++) {
		if ($files_img[$i] != "" && file_exists($dir_dest . DS . $files_img[$i])) {
			$src = "/uploads/photos/" . $files_img[$i];
			$l_key = explode("_", $files_img[$i]);
			$key = $l_key[0];
			$url = '/uploads/upload.php?type=2&id='.$upload_img_id.'&item='.$files_img[$i].'&lang='.TTH_LANGUAGE;
			$p1[$i] = '"<a href=\''.$src.'\' data-gallery><img src=\''.$src.'\' class=\'file-preview-image\'></a>"';
			$p2[$i] = '{url: "'.$url.'", key: '.$key.'}';
		}
	}
}
?>
<script>
	$(".file-img").fileinput({
		<?php if($img!='no' && $img!='') { ?>
		initialPreview: [
			"<img src='../uploads/product/<?php echo $img?>' class='file-preview-image' title='<?php echo $img?>' alt='<?php echo $img?>'>"
		],
		<?php } ?>
		'allowedFileExtensions' : ['jpg', 'png','gif']
	});
	$("#album").fileinput({
		uploadUrl: "/uploads/upload.php?type=1&id=<?php echo $upload_img_id?>&lang=<?php echo TTH_LANGUAGE?>",
		uploadAsync: false,
		initialPreview: [
			<?php echo implode(',', $p1);?>
		],
		initialPreviewConfig: [
			<?php echo implode(',', $p2);?>
		]
	});
	/*CKEDITOR.replace('comment', {
		height: 150
	});*/
	
	CKEDITOR.replace('content', {
		height: 250
	});
	CKEDITOR.replace('huongdan', {
		height: 250
	});
	$('.input-datetime').datetimepicker({
		mask:'39/19/9999 29:59',
		lang:'vi',
		format:'<?php echo TTH_DATETIME_FORMAT?>'
	});
</script>
<?php
}
/**
 * @param $id
 * @param $par
 */
function categoryName($id) {
	echo '<select name="product_menu_id" class="form-control">';
	global $db;
	$db->table = "category";
	$db->condition = "type_id = 6";
	$db->order = "sort ASC";
	$db->limit = "";
	$rows = $db->select();
	foreach($rows as $row) {
		echo "<option value='".$row["category_id"]."' disabled";
		echo ">".stripslashes($row["name"])."</option>";
		loadMenuCategory($db, 0, 0, $row["category_id"], $id);
	}
	echo '</select>';

}

/**
 * @param $db
 * @param $level
 * @param $parent
 * @param $category_id
 * @param $par
 */
function loadMenuCategory($db, $level, $parent, $category_id, $id){
	$space = "-&nbsp;-&nbsp;";
	for($i=0; $i<$level; $i++){
		$space.="-&nbsp;";
	}
	$db->table = "product_menu";
	$db->condition = "category_id = ".$category_id." and parent = ".$parent;
	$db->order = "sort ASC";
	$db->limit = "";
	$rows2 = $db->select();
	foreach($rows2 as $row) {
		if ($level <= 3){
			echo "<option value='".$row["product_menu_id"]."'";
			if ($id==$row["product_menu_id"]) echo " selected ";
			echo ">".$space.stripslashes($row["name"])."</option>";
				loadMenuCategory($db, $level+2, $row["product_menu_id"]+0, $row["category_id"]+0, $id);
		}
	}
}

function loadStreet($db, $id) {
	$result = '';
	$selected = '';
	if($id==0) $selected = 'selected';
	$result .= '<select class="form-control selectpicker" name="street" data-live-search="true">';
	$result .= '<option value="0" ' . $selected . '>Chọn đường phố...</option>';

	$db->table = "others";
	$db->condition = "`is_active` = 1 AND `others_menu_id` IN (SELECT `others_menu_id` FROM `".TTH_DATA_PREFIX."others_menu` WHERE `category_id` = 87)";
	$db->order = "`sort` ASC";
	$db->limit = "";
	$rows = $db->select();
	foreach($rows as $row) {
		$selected = '';
		if($row['others_id']==$id) $selected = 'selected';
		$result .= '<option value="' . $row['others_id'] . '" ' . $selected . '>' . stripslashes($row['name']) . '</option>';
	}

	$result .= '</select>';
	return $result;
}
