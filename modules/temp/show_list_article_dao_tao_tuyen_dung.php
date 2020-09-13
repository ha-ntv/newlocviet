<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
?>
<div class="container-fluid fluid_tit">
    <div class="row">
        <div class="container ner_titlelt">
            <p class="brow_tit">
                <a href="<?php echo HOME_URL_LANG;?>">Trang chủ</a>
                <a href="<?php echo HOME_URL_LANG;?>/dao-tao-tuyen-dung">Đào tạo & tuyển dụng</a>
            </p>
        </div>
    </div>
</div>
<div class="container nerabout_list">
	<div class="row tong_listabout">
		<?php 
            foreach ($rows as $row) {
        ?>
            <div class="col-md-3 col-sm-3 col-xs-3 item_vanhoapdv item_vanhoapdv_new">
                <div class="trumvh_pdv">
                    <div class="img_vanhoapdv">
                        <a href="<?php echo HOME_URL_LANG;?>/<?php echo $row['slug'];?>">
                            <?php if($row['img']=="" || $row['img']=="no"){ ?>
                                <img src="<?php echo HOME_URL;?>/images/352x260.png">
                            <?php }else{ ?>
                                <img src="<?php echo HOME_URL;?>/uploads/article/352x260<?php echo $row['img'];?>">
                            <?php } ?>
                        </a>
                    </div>
                    <div class="content_vanhoa">
                        <p class="namevh_listff"><a href="<?php echo HOME_URL_LANG;?>/<?php echo $row['slug'];?>"><?php echo $stringObj->crop(stripcslashes($row['name']), 12);?></a></p>
                        <p class="timevh"><i class="far fa-clock"></i>&nbsp;&nbsp;<?php echo date('d/m/Y', $row['created_time']);?></p>
                        <p class="prevhoa_list"><?php echo $stringObj->crop(stripcslashes($row['comment']), 50);?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
	</div>
</div>