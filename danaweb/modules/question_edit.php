<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
?>

<!-- Menu path -->
<div class="row">
	<ol class="breadcrumb">
		<li>
			<a href="<?=ADMIN_DIR?>"><i class="fa fa-home"></i> Trang chủ</a>
		</li>
		<li>
			<a href="?<?=TTH_PATH?>=question_list"><i class="fa fa-edit"></i> Quản lý nội dung</a>
		</li>
		<li>
			<a href="?<?=TTH_PATH?>=question_list"><i class="fa fa-file-text-o"></i> Phần Hỏi đáp</a>
		</li>
		<li>
			<i class="fa fa-cog"></i> Chỉnh sửa trang
		</li>
	</ol>
</div>
<!-- /.row -->
<?php
//
$question_id = isset($_GET['id']) ? $_GET['id']+0 : $question_id+0;
$db->table = "question";
$db->condition = "question_id = ".$question_id;
$db->order = "";
$db->select();
if($db->RowCount==0) loadPageAdmin("Trang bổ sung không tồn tại.","?".TTH_PATH."=question_list");


include_once (_A_TEMPLATES . DS . "question.php");
if(empty($typeFunc)) $typeFunc = "no";

$date = new DateClass();

$OK = false;
$error = '';
if($typeFunc=='edit'){
	if(empty($name)) $error = '<span class="show-error">Vui lòng nhập tên câu hỏi.</span>';
	else if(empty($email)) $error = '<span class="show-error">Vui lòng nhập email.</span>';
	else if(empty($reply)) $error = '<span class="show-error">Vui lòng nhập nội dung trả lời.</span>';
	else {
		$db->table = "question";
		$data = array(
			'name'=>$db->clearText($name),
			'address'=>$db->clearText($address),
			'email'=>$db->clearText($email),
			'phone'=>$db->clearText($phone),
			'comment'=>$db->clearText($comment),
			'reply'=>$db->clearText($reply),
			'is_active'=>$is_active+0,
			'is_hide'=>$is_hide+0,
			'modified_time'=>time()
		);
		$db->condition = "question_id = ".$question_id;
		$db->update($data);
		loadPageSucces("Đã chỉnh sửa Trang thành công.","?".TTH_PATH."=question_list");
		$OK = true;

	}
}
else {
	$db->table = "question";
	$db->condition = "question_id = ".$question_id;
	$rows = $db->select();
	foreach($rows as $row) {
		$name			    = $row['name'];
		$address            = $row['address'];
		$email        	    = $row['email'];
		$phone	            = $row['phone'];
		$comment            = $row['comment'];
		$reply	            = $row['reply'];
		$is_active		    = $row['is_active']+0;
		$is_hide		    = $row['is_hide']+0;
	}
}
if(!$OK) QuestionPlugin("?".TTH_PATH."=question_edit", "edit", $question_id, $name, $address, $email, $phone, $comment, $reply, $is_active, $is_hide, $error);
?>