<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//--
?>
<div class="container-fluid fluid_tit">
    <div class="row">
        <div class="container ner_titlelt">
            <p class="brow_tit">
                <a href="<?php echo HOME_URL_LANG;?>">Trang chủ</a>
                <a href="javascript:;">Trang thông báo</a>
            </p>
        </div>
    </div>
</div>
<div class="updating">
    <p><?php echo $lgTxt_updating;?> <a href="<?php echo HOME_URL_LANG;?>"><?php echo $lgTxt_page404_click;?></a> <?php echo $lgTxt_page404_back;?> <a href="<?php echo HOME_URL_LANG;?>"><?php echo $lgTxt_menu_home;?></a>.</p>
    <p><i class="fa fa-edit color-green"></i></p>
</div> 