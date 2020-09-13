<?php
    if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
    $date = new DateClass();
    $stringObj = new String();
    $page   = (isset($_GET['p'])) ? $_GET['p'] : 0;
    $id = $_POST['id'];
?>
<div class="row list_newp">
    <?php 
        // $db->table = "article";
        // $db->condition = "is_active = 1 AND article_menu_id = ".$id;
        // $db->order = "created_time DESC";
        // $db->limit = "";
        // $rows = $db->select();
        // foreach ($rows as $keyt) {
            $db->table = "article";
            $db->condition = "is_active = 1 AND article_menu_id = ".$id;
            $db->order = "created_time DESC";
            $db->limit = "";
            $rows = $db->select();
            $total = $db->RowCount;
            if($total > 0){
                $slug_submenu = "";
                $parent = false; 
                $total_pages = 0;
                $per_page = 8;
                if($total%$per_page==0) $total_pages = $total/$per_page;
                else $total_pages = floor($total/$per_page)+1;
                if($page<=0) $page=1;
                $start=($page-1)*$per_page;

            $db->table = "article";
            $db->condition = "is_active = 1 AND article_menu_id = ".$id;
            $db->order = "created_time DESC";
            $db->limit = $start.','.$per_page;
            $rows = $db->select();
            $sp = $db->RowCount;
            foreach ($rows as $keyt) {
    ?>
        <div class="col-md-3 col-sm-3 col-xs-3 item_vanhoapdv item_ttsk_sau">
            <div class="trumvh_pdv">
                <div class="img_vanhoapdv">
                    <a href="<?php echo HOME_URL_LANG;?>/<?php echo $keyt['slug'];?>">
                        <?php if($keyt['img']=="" || $keyt['img']=="no"){ ?>
                            <img src="<?php echo HOME_URL;?>/images/278x179.png">
                        <?php }else{ ?>
                            <img src="<?php echo HOME_URL;?>/uploads/article/278x179<?php echo $keyt['img'];?>">
                        <?php } ?>
                    </a>
                </div>
                <div class="content_vanhoa">
                    <p class="namevh_list"><a href="<?php echo HOME_URL_LANG;?>/<?php echo $keyt['slug'];?>"><?php echo $stringObj->crop(stripcslashes($keyt['name']), 12);?></a></p>
                    <p class="timevh"><i class="far fa-clock"></i>&nbsp;&nbsp;<?php echo date('d/m/Y', $keyt['created_time']);?></p>
                    <p class="prevhoa_list"><?php echo $stringObj->crop(stripcslashes($keyt['comment']), 50);?></p>
                </div>
            </div>
        </div>
    <?php } showPageNavigation($page, $total_pages,'/'.'tin-tuc-su-kien'.'/'.$slug_submenu.'?p='); }?>
</div>