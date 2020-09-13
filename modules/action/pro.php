<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
$id = $_POST['id'];
?>
<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php 
            $db->table = "article";
            $db->condition = "is_active = 1 AND article_menu_id = ".$id;
            $db->order = "created_time DESC";
            $db->limit = "";
            $rows = $db->select();
            foreach ($rows as $keyt) {
        ?>
            <div class="swiper-slide">
                <div class="tongimg_sliduan">
                    <a href="<?php echo HOME_URL_LANG.'/'.$keyt['slug'];?>">
                        <?php if($keyt['img']=="" || $keyt['img']=="no"){?>
                            <img src="<?php echo HOME_URL;?>/images/465x333.png">
                        <?php }else{ ?>
                            <img src="<?php echo HOME_URL?>/uploads/article/465x333<?php echo $keyt['img'];?>">
                        <?php } ?>
                    </a>
                    <p class="namepro_home"><a href="<?php echo HOME_URL_LANG.'/'.$keyt['slug'];?>"><?php echo $keyt['name']?></a></p>
                    <div class="content_detail">
                        <p class="namepro_home_pst"><a href="<?php echo HOME_URL_LANG.'/'.$keyt['slug'];?>"><?php echo $keyt['name']?></a></p>
                        <p class="cmpro_home"><a href="<?php echo HOME_URL_LANG.'/'.$keyt['slug'];?>"><?php echo $keyt['comment']?></a></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="swiper-pagination"></div>
</div>
<script>
    var x = window.innnerWidth;
    if(x>425){
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 3,
            slidesPerColumn: 2,
            spaceBetween: 3,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                667: {
                    slidesPerView: 2,
                    spaceBetween: 1,
                },
                425: {
                    slidesPerView: 1,
                    spaceBetween: 1,
                }
            }
        });
    }else{
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 3,
            slidesPerColumn: 2,
            spaceBetween: 3,
            autoplay: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                667: {
                    slidesPerView: 2,
                    spaceBetween: 1,
                },
                425: {
                    slidesPerView: 1,
                    spaceBetween: 1,
                }
            }
        });
    }
</script>