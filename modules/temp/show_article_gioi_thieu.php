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
