<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
function QuestionPlugin($act, $typeFunc, $question_id, $name, $address, $email, $phone, $comment, $reply, $is_active, $is_hide, $error) {
	dashboardCoreAdmin();
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-files-o"></i> Nội dung trang
			</div>
			<div class="panel-body">
				<form action="<?=$act?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="typeFunc" value="<?=$typeFunc?>" />
					<input type="hidden" name="question_id" value="<?=$question_id?>" />
					<div class="panel-show-error">
						<?=$error?>
					</div>
					<table class="table table-hover">
						<tr>
							<td><label>Tên người dùng:</label></td>
							<td><input class="form-control" type="text" name="name" maxlength="255" value="<?=stripslashes($name)?>" required="required" ></td>
						</tr>
						<tr>
							<td width="150px"><label>Địa chỉ:</label></td>
							<td><input class="form-control" type="text" name="address" maxlength="255" value="<?=stripslashes($address)?>" required="required" ></td>
						</tr>
						<tr>
							<td width="150px"><label>Email:</label></td>
							<td><input class="form-control" type="text" name="email" maxlength="255" value="<?=stripslashes($email)?>" required="required" ></td>
						</tr>
						<tr>
							<td width="150px"><label>Điện thoại:</label></td>
							<td><input class="form-control" type="text" name="phone" maxlength="255" value="<?=stripslashes($phone)?>" required="required" ></td>
						</tr>
						<tr>
							<td class="ver-top"><label>Nội dung câu hỏi:</label></td>
							<td>
								<textarea class="form-control" rows="3" name="comment"><?=stripslashes($comment)?></textarea>
							</td>
						</tr>
						<tr>
							<td><label>Trả lời:</label></td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2">
								<textarea class="form-control" name="reply" id="reply" required="required" ><?=stripslashes($reply)?></textarea>
							</td>
						</tr>
						<tr>
							<td><label>Trạng trạng:</label></td>
							<td>
								<label class="radio-inline"><input type="radio" name="is_active" value="0" <?=$is_active==0?"checked":""?> > Đã xem</label>
								<label class="radio-inline"><input type="radio" name="is_active" value="1" <?=$is_active==1?"checked":""?> > Chưa xem</label>
							</td>
						</tr>
						<tr>
							<td><label>Trạng thái:</label></td>
							<td>
								<label class="radio-inline"><input type="radio" name="is_hide" value="0" <?=$is_hide==0?"checked":""?> > Đóng</label>
								<label class="radio-inline"><input type="radio" name="is_hide" value="1" <?=$is_hide==1?"checked":""?> > Mở</label>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<button type="submit" class="btn btn-form-primary btn-form">Đồng ý</button> &nbsp;
								<button type="reset" class="btn btn-form-success btn-form">Làm lại</button> &nbsp;
								<button type="button" class="btn btn-form-info btn-form" onclick="location.href='?<?=TTH_PATH?>=question_list'">Thoát</button>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	CKEDITOR.replace( 'reply');
</script>
<?php
}
?>
