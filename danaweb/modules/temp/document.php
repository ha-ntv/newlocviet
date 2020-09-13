<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
function document($act, $typeFunc, $document_id, $document_menu_id, $name, $slug, $file, $img, $model, $release_date, $effective_date, $comment, $content, $is_active, $hot, $created_time, $error) {
	global $db, $tth;
	$category = 0;
	$db->table = "document_menu";
	$db->condition = "document_menu_id = ".$document_menu_id;
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	foreach($rows as $row){
		dashboardCoreAdminTwo($tth.";".$row['category_id']);
		$category = $row['category_id'];
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
				<i class="fa fa-files-o"></i> Nội dung tệp tin
			</div>
			<div class="panel-body">
				<form action="<?=$act?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="typeFunc" value="<?=$typeFunc?>" />
					<input type="hidden" name="img" value="<?=$img?>" />
					<input type="hidden" name="document_id" value="<?=$document_id?>" />
					<input type="hidden" name="file" value="<?=$file?>" />
					<div class="panel-show-error">
						<?=$error?>
					</div>
					<table class="table table-hover" style="width: 70%;">
						<tr>
							<td width="150px"><label>Tiêu đề:</label></td>
							<td><input class="form-control" type="text" name="name" id="name" value="<?=stripslashes($name)?>" required="required" ></td>
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
							<td><?=categoryName($document_menu_id);?></td>
						</tr>
						<tr>
							<td class="ver-top"><label>Tệp tin:</label></td>
							<td>
								<input class="form-control file file-doc" type="file" name="file" data-show-upload="false" data-show-preview="false" data-max-file-count="1" <?=($typeFunc=='add') ? 'required="required"' : ''?> >
							</td>
						</tr>
						<tr style="display: none">
							<td class="ver-top"><label>Hình đại diện:</label></td>
							<td>
								<input class="form-control file file-img" type="file" name="img" data-show-upload="false" data-max-file-count="1" accept="image/*">
							</td>
						</tr>
						<tr>
							<td><label>Số/Kí hiệu:</label></td>
							<td><input class="form-control" type="text" name="model" maxlength="100" value="<?=stripslashes($model)?>"></td>
						</tr>
						<tr>
							<td><label>Ngày phát hành:</label></td>
							<td><input class="form-control ipt-date" type="text" name="release_date" style="width: 160px;"  value="<?=$release_date?>" ></td>
						</tr>
						<tr>
							<td><label>Ngày hiệu lực:</label></td>
							<td><input class="form-control ipt-date" type="text" name="effective_date" style="width: 160px;"  value="<?=$effective_date?>" ></td>
						</tr>
						<tr>
							<td class="ver-top"><label>Tóm tắt:</label></td>
							<td>
								<textarea class="form-control" rows="3" name="comment"><?=stripslashes($comment)?></textarea>
							</td>
						</tr>
						<tr>
							<td><label>Nội dung chi tiết:</label></td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2">
								<textarea class="form-control  ckeditor" name="content" required="required" ><?=stripslashes($content)?></textarea>
							</td>
						</tr>
						<tr>
							<td><label>Trạng thái:</label></td>
							<td>
								<label class="radio-inline"><input type="radio" name="is_active" value="0" <?=$is_active==0?"checked":""?> > Đóng</label>
								<label class="radio-inline"><input type="radio" name="is_active" value="1" <?=$is_active==1?"checked":""?> > Mở</label>
							</td>
						</tr>
						<tr>
							<td><label>Nổi bật:</label></td>
							<td>
								<label class="radio-inline"><input type="radio" name="hot" value="0" <?=$hot==0?"checked":""?> > Đóng</label>
								<label class="radio-inline"><input type="radio" name="hot" value="1" <?=$hot==1?"checked":""?> > Mở</label>
							</td>
						</tr>
						<tr>
							<td><label>Ngày đăng:</label></td>
							<td><input class="form-control" id="input-datetime" type="text" name="created_time" style="width: 160px;"  value="<?=$created_time?>" ></td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<button type="submit" class="btn btn-form-primary btn-form">Đồng ý</button> &nbsp;
								<button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
								<button type="button" class="btn btn-form-info btn-form" onclick="location.href='?<?=TTH_PATH?>=document_list&id=<?=$document_menu_id?>'">Thoát</button>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$('.ipt-date').datetimepicker({
		lang:'vi',
		timepicker: false,
		format:'<?=TTH_DATE_FORMAT?>'
	});
	$('.file-doc').fileinput({
		<?php if($file!='no' && $file!='') echo 'initialCaption: "' . $file . '"'; ?>
	});
	$('.file-img').fileinput({
		<?php if($img!='no' && $img!='') { ?>
		initialPreview: [
			"<img src='../uploads/document/<?=$img?>' class='file-preview-image' title='<?=$img?>' alt='<?=$img?>'>"
		],
		<?php } ?>
		allowedFileExtensions : ['jpg', 'png','gif']
	});
	$('#input-datetime').datetimepicker({
		mask:'39/19/9999 29:59',
		lang:'vi',
		format:'<?=TTH_DATETIME_FORMAT?>'
	});
</script>
<?php
}

function categoryName($id) {
	echo '<select name="document_menu_id" class="form-control">';
	global $db;
	$db->table = "category";
	$db->condition = "type_id = 21";
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
	$db->table = "document_menu";
	$db->condition = "category_id = ".$category_id." and parent = ".$parent;
	$db->order = "sort ASC";
	$db->limit = "";
	$rows2 = $db->select();
	foreach($rows2 as $row) {
		if ($level <= 3){
			echo "<option value='".$row["document_menu_id"]."'";
			if ($id==$row["document_menu_id"]) echo " selected ";
			echo ">".$space.stripslashes($row["name"])."</option>";
				loadMenuCategory($db, $level+2, $row["document_menu_id"]+0, $row["category_id"]+0, $id);
		}
	}
}
?>
