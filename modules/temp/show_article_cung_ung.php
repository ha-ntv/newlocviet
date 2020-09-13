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
                <a href="<?php echo HOME_URL_LANG;?>/cung-ung-nhan-luc">Cung ứng nhân lực</a>
            </p>
        </div>
    </div>
</div>
<div class="container nerabout">
	<div class="tit_home">
		<div class="leftgt_dt">
            <div class="img_gtdt">
                <?php if($row['img']=="" || $row['img']=="no"){ ?>
                    <img src="<?= HOME_URL;?>/images/450x332.png" width="100%">
                <?php }else{ ?>
                    <img src="<?= HOME_URL;?>/uploads/article/450x332<?= $row['img'];?>" width="100%">
                <?php } ?>
            </div>
        </div>
        <div class="rightgt_dt">
            <div class="ctent_dtgt">
                <p class="mota_gthieu"><?php echo $row['comment'];?></p>
                <?php echo $row['content'];?>
            </div>
        </div>
	</div>
</div>
<div class="container nen_daotaohome">
    <p class="tit_dtao">Các khóa đào tạo</p>
    <div class="owl-carousel daotao owl-theme">
        <?php
            $db->table = "article";
            $db->condition = "is_active = 1 AND article_menu_id = 630";
            $db->order = "created_time DESC";
            $db->limit = "20";
            $rowb = $db->select();
            foreach ($rowb as $valueb) {
        ?>
        <div class="item item_daotao">
            <div class="tong_daotaohome">
                <div class="imgdaotao">
                    <a href="<?php echo HOME_URL_LANG;?>/<?= $valueb['slug'];?>">
                        <?php if($valueb['img']=="" || $valueb['img']=="no"){ ?>
                            <img src="<?= HOME_URL;?>/images/353x232.png">
                        <?php }else{ ?>
                            <img src="<?= HOME_URL;?>/uploads/article/353x232<?= $valueb['img'];?>">
                        <?php } ?>
                    </a>
                </div>
                <div class="cten_dthome">
                    <p class="name_dthome"><a href="<?php echo HOME_URL_LANG;?>/<?= $valueb['slug'];?>"><?php echo $valueb['name'];?></a></p>
                    <p class="pre_dthome"><?php echo $valueb['comment'];?></p>
                </div>
            </div>
        </div>
        <?php } ?>
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