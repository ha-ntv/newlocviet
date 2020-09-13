<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
$sumView = 0;
$db->table = "gallery";
$db->condition = "is_active = 1 and gallery_id = ".$id;
$db->order = "";
$db->limit = "";
$rows = $db->select();
if($db->RowCount>0){
	foreach($rows as $row) {
		$db->table = "gallery";
		$db->condition = "is_active = 1 and gallery_menu_id = ".($row['gallery_menu_id']+0).' and gallery_id <> '.$id;
		$db->order = "created_time DESC";
		$db->limit = 5;
		$rows2 = $db->select();
		$total = $db->RowCount;
?>
<div class="container fluid_lbra">
	<div class="tit_home">
		<p><?= $tv;?></p>
	</div>
	<p class="titname_imgdetail"><?php echo $row['name'];?></p>
	<div class="row">
		<?php 
			$i=0;
	        $list_img = "";
	        $db->table = "uploads_tmp";
	        $db->condition = "upload_id = ".($row['upload_id']+0);
	        $db->order = "";
	        $db->limit = "";
	        $rows_gal = $db->select();
	        foreach ($rows_gal as $row_gal){
	            $list_img = $row_gal['list_img'];
	        }
	        $img = explode(";",$list_img);
	        if($list_img!="") {
	        for($i=0;$i<count($img);$i++) {
	        if($img[$i] != ""){
		?>
		<div class="col-md-4 col-sm-4 col-xs-4 itemanh_tvien">
			<div class="tong_anhtvien">
				<a rel="gallery" class="various fancy-box" href="<?php echo HOME_URL;?>/uploads/photos/full_<?php echo $img[$i];?>">
					<img src="<?php echo HOME_URL; ?>/uploads/photos/554x350<?php echo $img[$i] ?>" />
				</a>
			</div>
		</div>
		<?php } } } ?>
	</div>
</div>
<?php
		$sumView = $row['views']+1;
	}
	$db->table = "gallery";
	$data = array(
		'views'=>$sumView
	);
	$db->condition = "gallery_id = ".$id;
	$db->update($data);
}
else include(_F_MODULES . DS . "error_404.php");