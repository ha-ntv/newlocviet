<?php
if (!defined('TTH_SYSTEM')) {
    die('Please stop!');
}
$date = new DateClass();
$stringObj = new String();

$url = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
$url1 = explode('/', $url);
$url3 = count($url1);
$bien = $url3 - 1;
$url2 = $url1[$bien];

$pare = getParent($id_menu);
if ($pare == 0) {
    $pare = $id_menu;
} else {
    $pare = $pare;
}
?>
<div class="tr_menuprol">
    <p>Danh mục sản phẩm</p>
    <div class="menu_wrapper">
        <ul class="danhmuculli">
            <?php
            $db->table = "product_menu";
            $db->condition = "parent = 0 AND is_active = 1 AND (category_id = 3 OR category_id = 9)";
            $db->order = "sort ASC";
            $db->limit = "";
            $rowas = $db->select();
            foreach ($rowas as $key) {
                $name = $key['name'];
                $id_pro = $key['product_menu_id'];
            
            ?>
                <li class="lidau">
                    <a href="<?php echo HOME_URL_LANG ?>/<?php echo $key['slug']; ?>" class=""><img src="/images/<?php echo  $key['product_menu_id']!= 287 ? 'drop-icon.png':'evaporation.png' ?>"><span><?= $name ?></span></a>
                </li>
            <?php } ?>
        </ul>
    </div>
    

    <div class="img_advpro">
        <p>Sản phẩm mới nhất</p>
        <?php 
            $db->table = "product";
            $db->condition = "is_active = 1";
            $db->order = "created_time DESC";
            $db->limit = "5";
            $productList = $db->select();
            if($productList) {
                echo '<ul class="product-list-left">';
                foreach($productList as $item) {
                    $main_src = $item['img'] == "" || $item['img'] == "no" ? HOME_URL . '/images/450x332.png' : HOME_URL . '/uploads/product/' . $item['img'];
                    echo '<li>
                            <a href="'.HOME_URL.'/'.$item['slug'].'"><img src="'.$main_src.'" alt="'.$item['name'].'"><span class="product-title">'.$item['name'].'</span></a>
                            <del><span class=" amount">'.($item['price'] > 0 ? formatNumberVN($item['price']+$plus_price) : 'Liên hệ').'<span class="currencySymbol">VNĐ</span></span></del>
                            <ins><span class=" amount">'.($item['price'] > 0 ? formatNumberVN($item['price']) : 'Liên hệ').'<span class="currencySymbol">VNĐ</span></span></ins>
                         </li>';
                }
                echo '</ul>';
            }
        ?>
       

    </div>
</div>
<script type="text/javascript">
    jQuery('.danhmuculli li').click(function() {
        if (jQuery(this).hasClass('active_prod')) {
            jQuery(this).removeClass('active_prod')
            jQuery(this).find('ul').slideUp()
        } else {
            jQuery('.danhmuculli li ul').slideUp()
            jQuery('.danhmuculli li').removeClass('active_prod')
            jQuery(this).addClass('active_prod')
            jQuery(this).find('ul').slideDown()
        }
    })
</script>