<?php
    if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
    $date = new DateClass();
    $stringObj = new String();
?>
<style type="text/css">
    .canho .owl-nav{
        display: none !important;
    }.canho .owl-dots{
        margin-left: -40px;
        line-height: 0;
    }.canho .owl-dots .owl-dot.active span, .canho .owl-dots .owl-dot:hover span {
        background: #000;
    }.canho .owl-dots .owl-dot span {
        width: 20px;
        height: 3px;
        margin: 0px 7px;
        border-radius: 30px;
        background: #d1d1d1;
        position: relative;
        padding-bottom: 3px;
    }
</style>
<div class="owl-carousel canho owl-theme" style="">
    <?php
        // $url = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; 
        // $url1 = explode('/', $url);
        // $dem = count($url1);
        // $dem1 = $dem-2;
        // $bien = $url1[$dem1];
        $loc = array();
        $db->table = "article_menu";
        $db->condition = "is_active = 1 AND category_id = 10";
        $db->order = "";
        $db->limit = "";
        $rows = $db->select();
        $i = 0;
        foreach ($rows as $rowt) {
            $loc[$i] = $rowt['article_menu_id'];
            $i++;
        }
        $loc = implode(',', $loc);
        $db->table = "article";
        $db->condition = "is_active = 1 AND article_menu_id IN (".$loc.")";
        $db->order = "created_time DESC";
        $db->limit = "5";
        $rowg = $db->select();
        $i = 0;
        foreach ($rowg as $row) {
            // $name2 = getSlugMenu($row['article_menu_id'], 'article');
            // $name3 = $stringObj->getLinkHtml($row['name'],$row['article_id']);
            $name3 = $row['slug'];
            $i++;
    ?>
        <div class="item item_canhohome">
            <div class="tr_canhosl">
                <div class="td_canho td_canho1a" style="display: none;">
                    <a href="<?= HOME_URL_LANG;?>/<?= $name3;?>">
                        <?php if($row['img'] == "no" || $row['img'] == ""){?>
                            <img src="<?= HOME_URL?>/images/819x403.png" width="100%">
                        <?php }else{?>
                            <img src="<?=HOME_URL?>/uploads/article/819x403<?= $row['img'];?>" width="100%">
                        <?php } ?>
                    </a>
                    <span class="soslider soslider<?php echo $i;?>" data-id="<?php echo $i;?>"><?php echo '0'.$i;?></span>
                </div>
                <div class="content_canho">
                    <p class="info_canho info_canho0"><?php echo $ttch;?></p>
                    <p class="namecanho"><a href="<?= HOME_URL_LANG;?>/<?= $name3;?>"><?php echo $stringObj->crop(stripcslashes($row['name']), 15)?></a></p>
                    <p class="precanho"><?php echo $stringObj->crop(stripcslashes($row['comment']), 50)?></p>
                    <div class="thongtin_canho">
                        <p class="phongngu"><?php echo $row['phongngu'];?></p>
                        <p class="phongtam"><?php echo $row['phongtam'];?></p>
                        <p class="dientich"><?php echo $row['dientich'];?> m<sup>2</sup></p>
                    </div>
                    <p class="xemthemch"><a href="<?php echo HOME_URL_LANG;?>/<?= $name3;?>"><?= $xt;?></a></p>
                </div>
                <div class="td_canho">
                    <a href="<?= HOME_URL_LANG;?>/<?= $name3;?>">
                        <?php if($row['img'] == "no" || $row['img'] == ""){?>
                            <img src="<?= HOME_URL?>/images/819x403.png" width="100%">
                        <?php }else{?>
                            <img src="<?=HOME_URL?>/uploads/article/819x403<?= $row['img'];?>" width="100%">
                        <?php } ?>
                    </a>
                    <span class="soslider soslider<?php echo $i;?>" data-id="<?php echo $i;?>"><?php echo '0'.$i;?></span>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<script type="text/javascript">
    function set_soslider() {
        jQuery(".canho .owl-item.active .soslider").addClass("hienso"); 
    }
    jQuery(document).ready(function() {
        set_soslider();
    });
    jQuery(window).resize(function() {
        set_soslider();
    });
    var owl = jQuery('.canho');
    btt: true,
    owl.owlCarousel({
        loop:true,
        margin:30,
        //autoplay:true,
        responsiveClass:true,
        autoplayTimeout:5000,
        smartSpeed:2500,
        nav:true,
        responsive:{
            0:{
            items:1
            },
        },
    });
    owl.on('translated.owl.carousel', function(event) {
        jQuery(".canho .owl-item .soslider").removeClass("hienso");
        jQuery(".canho .owl-item.active .soslider").addClass("hienso");
    });
    owl.on('translate.owl.carousel', function(e){
        jQuery(".canho .owl-item .soslider").removeClass("hienso");
    })
</script>