<?php
    if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
    $date = new DateClass();
    $stringObj = new String();

    $id = $_POST['id'];
?> 
<div class="col-md-6 col-sm-6 col-xs-6 left_newhome">
    <?php
        $db->table = "article";
        $db->condition = "is_active = 1 AND article_menu_id = ".$id;
        $db->order = "created_time DESC";
        $db->limit = "0,1";
        $rows = $db->select();
        foreach ($rows as $key) {
            $datetime = $date->vnFull($key['created_time']);
            $datetime0 = explode(',', $datetime);
            $datetime1 = $datetime0[1];
            $datetime2 = explode('/', $datetime1);
            $ngay = $datetime2[0];
            $thang = $datetime2[1];
            $nam = $datetime2[2];
            $time = $ngay.'/'.$thang.'/'.$nam;
    ?>
        <div class="tongleft_newhome">
            <div class="imgtong_newhome">
                <a href="<?php echo HOME_URL_LANG?>/<?php echo $key['slug'];?>">
                    <?php if($key['img']=="" || $key['img']=="no"){ ?>
                        <img src="<?php echo HOME_URL;?>/images/575x428.png">
                    <?php }else{ ?>
                        <img src="<?php echo HOME_URL;?>/uploads/article/575x428<?php echo $key['img'];?>">
                    <?php } ?>
                </a>
            </div>
            <div class="content_newhome">
                <p class="namenew_home"><a href="<?php echo HOME_URL_LANG?>/<?php echo $key['slug'];?>"><?php echo $key['name'];?></a></p>
                <p class="timenew_home"><?php echo $time;?></p>
            </div>
        </div>
    <?php } ?>
</div>
<div class="col-md-6 col-sm-6 col-xs-6 right_newhome">
    <div class="row row_newitemhome">
        <?php
            $db->table = "article";
            $db->condition = "is_active = 1 AND article_menu_id = ".$id;
            $db->order = "created_time DESC";
            $db->limit = "1,4";
            $rows = $db->select();
            foreach ($rows as $key) {
                $datetime = $date->vnFull($key['created_time']);
                $datetime0 = explode(',', $datetime);
                $datetime1 = $datetime0[1];
                $datetime2 = explode('/', $datetime1);
                $ngay = $datetime2[0];
                $thang = $datetime2[1];
                $nam = $datetime2[2];
                $time = $ngay.'/'.$thang.'/'.$nam;
                    
        ?>
            <div class="col-md-6 col-sm-6 col-xs-6 right_newhomeitem">
                <div class="tongit_newhome">
                    <div class="imgit_newhome">
                        <a href="<?php echo HOME_URL_LANG?>/<?php echo $key['slug'];?>">
                            <?php if($key['img']=="" || $key['img']=="no"){ ?>
                                <img src="<?php echo HOME_URL;?>/images/278x179.png">
                            <?php }else{ ?>
                                <img src="<?php echo HOME_URL;?>/uploads/article/278x179<?php echo $key['img'];?>">
                            <?php } ?>
                        </a>
                    </div>
                    <div class="ct_itemhome">
                        <p class="tenitem"><a href="<?php echo HOME_URL_LANG?>/<?php echo $key['slug'];?>"><?php echo $key['name'];?></a></p>
                        <p class="timenew_home"><?php echo $time;?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 nernew_mbile" style="display: none;">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php 
                $db->table = "article";
                $db->condition = "is_active = 1 AND article_menu_id = ".$id;
                $db->order = "created_time DESC";
                $db->limit = "";
                $rows = $db->select();
                foreach ($rows as $key) {
                    $datetime = $date->vnFull($key['created_time']);
                    $datetime0 = explode(',', $datetime);
                    $datetime1 = $datetime0[1];
                    $datetime2 = explode('/', $datetime1);
                    $ngay = $datetime2[0];
                    $thang = $datetime2[1];
                    $nam = $datetime2[2];
                    $time = $ngay.'/'.$thang.'/'.$nam;
            ?>
                <div class="swiper-slide tongleft_newhome">
                        <div class="imgtong_newhome">
                            <a href="<?php echo HOME_URL_LANG?>/<?php echo $key['slug'];?>">
                                <?php if($key['img']=="" || $key['img']=="no"){ ?>
                                    <img src="<?php echo HOME_URL;?>/images/575x428.png">
                                <?php }else{ ?>
                                    <img src="<?php echo HOME_URL;?>/uploads/article/575x428<?php echo $key['img'];?>">
                                <?php } ?>
                            </a>
                        </div>
                        <div class="content_newhome">
                            <p class="namenew_home"><a href="<?php echo HOME_URL_LANG?>/<?php echo $key['slug'];?>"><?php echo $key['name'];?></a></p>
                            <p class="timenew_home"><?php echo $time;?></p>
                        </div>
                </div>
            <?php } ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<script>
    var x = window.innnerWidth;
    if(x>425){
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            slidesPerColumn: 2,
            spaceBetween: 1,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    }else{
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            slidesPerColumn: 2,
            spaceBetween: 1,
            autoplay: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    }
</script>