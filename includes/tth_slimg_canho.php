<?php
    if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
    $date = new DateClass();
    $stringObj = new String();
?>
<style type="text/css">
    .swiper-container {
      width: 100%;
      height: 100%;
    }
    .swiper-slide {
      text-align: center;
      font-size: 18px;
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }
</style>
<div class="imgcanho_list swiper-container" style="">
    <div class="swiper-wrapper">
        <?php
            $list_img = "";
            $db->table = "uploads_tmp";
            $db->condition = "upload_id = ".($row['upload_id']+0);
            $db->order = "";
            $db->limit = 1;
            $rows_gal = $db->select();

            foreach ($rows_gal as $row_gal){
                $list_img = $row_gal['list_img'];
            }
            $img = explode(";",$list_img);
            if($list_img!="") {
                for($i=0;$i<count($img);$i++) {
                    if($img[$i] != ""){
        ?>
            <div class="swiper-slide canho_img_slider">
                <div class="imgch_slider">
                    <a class="fancy-box" rel="gallery-group" href="<?php echo HOME_URL_LANG;?>/uploads/photos/full_<?php echo $img[$i];?>" title="<?php echo $alt;?>">
                        <img src="<?= HOME_URL;?>/uploads/photos/554x350<?php echo $img[$i];?>">
                    </a>
                </div>
            </div>
        <?php } } } ?>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
<script> 
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 2.5,
        slidesPerColumn: 1,
        spaceBetween: 0,
        //autoplay: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            414: {
                slidesPerView: 1,
            },
            667: {
                slidesPerView: 2.1,
            },
            1366: {
                slidesPerView: 2.5,
            },
            1920: {
                slidesPerView: 3.2,
            }
        }
    });
</script>