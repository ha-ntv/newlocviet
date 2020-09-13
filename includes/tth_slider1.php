<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//-------------
$stringObj = new String();
?>
<div id="wowslider-container1">
    <div class="ws_images">
        <ul>
            <?php
                $db->table = "category";
                $db->condition = "is_active = 1 AND slug = '".$slug_cat."'";
                $db->order = "created_time desc";
                $db->limit = "";
                $rowsl = $db->select();
                foreach ($rowsl as $rowl){ 
            ?>
                <li>
                    <img src="<?php echo HOME_URL?>/uploads/category/full_<?= $rowl['img'] ?>" title="" id="wows1_0"/>
                    <div class="in_imgsl">
                        <p class="name_slg"><?= $rowl['name'];?></p>
                        <p class="pre_slg"><?= $rowl['comment'];?></p>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
<script type="text/javascript" src="<?php echo HOME_URL;?>/js/wow/wowslider.js"></script>
<script type="text/javascript" src="<?php echo HOME_URL;?>/js/wow/script.js"></script>
