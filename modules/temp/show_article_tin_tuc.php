<?php
if (!defined('TTH_SYSTEM')) {
	die('Please stop!');
}
?>
<?php
if (isset($_POST['comment'])) {
	$author = $_POST['comment_author'];
	$email = $_POST['comment_email'];
	$content = $_POST['comment_content'];
	if (!empty($author) && !empty($email) && !empty($content)) {
		$db->table = "comment";
		$data = array(
			'article_id' => $id,
			'email' => $email,
			'content' => $content,
			'author' => $author,
			'created_time' => time()
		);
		$db->insert($data);
	}
}
$sumView = 0;
$db->table = "article";
$db->condition = "is_active = 1 and article_id = " . $id;
$db->order = "";
$db->limit = "";
$rows = $db->select();
if ($db->RowCount > 0) {
	foreach ($rows as $row) {
		$db->table = "article";
		$db->condition = "is_active = 1 and article_menu_id = " . ($row['article_menu_id'] + 0) . ' and article_id <> ' . $id;
		$db->order = "created_time DESC";
		$db->limit = 4;
		$rows2 = $db->select();
		$total = $db->RowCount;
?>
		<div class="container-fluid fluid_tit">
			<div class="row">
				<div class="container ner_titlelt">
					<p class="brow_tit">
						<a href="<?php echo HOME_URL_LANG; ?>">Trang chủ</a>
						<?= $slug_cat == 'tin-tuc' ? '<a href="/tin-tuc">Tin tức</a>' : '<a href="/chinh-sach">Chính sách</a>' ?>
					</p>
				</div>
			</div>
		</div>
		<div class="container ner_newdetail">
			<div class="row tongdetail_vh">
				<div class="col-md-9 col-sm-9 col-xs-9 leftdt_vhoa news_detail">
					<div class="tongleft_dtvh">
						<p class="namedt_vh"><?php echo $row['name']; ?></p>
						<p class="timevhdt">Đăng bởi Admin | <?php echo date('d/m/Y', $row['created_time']); ?> | <?php echo  calCulateComment($row['article_id']); ?> bình luận</p>
						<p class="pre_tindetail"><?php echo $row['comment']; ?></p>
						<div class="cten_dtvh">
							<?php echo $row['content']; ?>
						</div>
					</div>
					<div class="comment_section">
						<div id="article-comments">
							<h5 class="title-form-coment">BÌNH LUẬN:</h5>
							<?php
							$db->table = "comment";
							$db->condition = "article_id = " . $id;
							$db->order = "";
							$db->limit = "";
							$comments = $db->select();
							if ($comments) : ?>
								<div class="hidden"><?php echo count($comments); ?> bình luận</div>
								<?php foreach ($comments as $item) : ?>
									<div class="article-comment clearfix">
										<figure class="article-comment-user-image">
											<img src="https://www.gravatar.com/avatar/5bbb4c220f5190b02ba6e5ac0751c884?s=110&amp;d=identicon" alt="binh-luan" class="block">
										</figure>

										<div class="article-comment-user-comment">
											<p class="user-name-comment"><strong><?php echo $item['author']; ?></strong>
												<a href="#article_comments" class="btn-link pull-xs-right hidden">Trả lời</a></p>

											<p><?php echo $item['content']; ?></p>
											<span class="article-comment-date-bull"><?php echo date('d/m/Y', $item['created_time']); ?></span>

										</div>
									</div>
								<?php endforeach; ?>

							<?php endif; ?>
						</div>
						<form accept-charset="utf-8" action="<?php echo HOME_URL . '/' . $row['slug'] ?>" id="article_comments" method="post">
							<input name="FormType" type="hidden" value="article_comments">
							<input name="utf8" type="hidden" value="true">
							<div class="form-coment">

								<div class="margin-top-40">
									<h5 class="title-form-coment">VIẾT BÌNH LUẬN CỦA BẠN:</h5>
								</div>
								<div>
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-6">
											<fieldset class="form-group">
												<input placeholder="Họ tên*" type="text" class="form-control form-control-lg" value="" id="full-name" name="comment_author" required>
											</fieldset>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6">
											<fieldset class="form-group">
												<input placeholder="Email*" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" type="email" class="form-control form-control-lg" value="" name="comment_email" required>
											</fieldset>
										</div>
									</div>
								</div>
								<fieldset class="form-group ">
									<textarea placeholder="Nội dung*" class="form-control form-control-lg" name="comment_content" rows="6" required=""></textarea>
								</fieldset>
								<div class="margin-bottom-50 clearfix">
									<button type="submit" class=" btn-primary f-right" name="comment">Gửi bình luận</button>
								</div>

							</div> <!-- End form mail -->
						</form>
					</div>

				</div>
				<div class="col-md-3 col-sm-3 col-xs-12 left_menupro">
					<?php include(_F_INCLUDES . DS . "tth_left_news.php"); ?>
				</div>
			</div>
		</div>

<?php
		$sumView = $row['views'] + 1;
	}
	$db->table = "article";
	$data = array(
		'views' => $sumView
	);
	$db->condition = "article_id = " . $id;
	$db->update($data);
} else include(_F_MODULES . DS . "error_404.php");
?>
<script>
	if (window.history.replaceState) {
		window.history.replaceState(null, null, window.location.href);
	}
</script>