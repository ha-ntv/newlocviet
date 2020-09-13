<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//-------------
?>
<!-- .banner -->
<section class="box-banner">
<?php
// Banner photo
$photo_avt = '<img src="'. HOME_URL .'/images/banner.jpg" alt="Banner">';
$id = ($id_category>0) ? $id_category : 89;
//
$db->table = "category";
$db->condition = "`is_active` = 1 AND `category_id` = $id";
$db->order = "";
$db->limit = 1;
$rows = $db->select();
foreach ($rows as $row) {
    if(file_exists(ROOT_DIR  . DS . 'uploads' . DS . 'category' . DS . 'banner-' . $row['img']) && $row['img']!='') {
        $photo_avt = '<img src="'. HOME_URL .'/uploads/category/banner-'. $row['img'] . '" alt="' . stripslashes($row['name']) . '">';
    }
}
if($id_menu > 0) {
    $parent = $id_menu;
    $role = 1;
    while($parent>0 && $role==1) {
        $db->table = "article_menu";
        $db->condition = "`article_menu_id` = $parent";
        $db->order = "";
        $db->limit = 1;
        $rows = $db->select();
        if($db->RowCount>0) {
            foreach ($rows as $row) {
                $parent = intval($row['parent']);
                if(file_exists(ROOT_DIR  . DS . 'uploads' . DS . 'article_menu' . DS . 'banner-' . $row['img']) && $row['img']!='') {
                    $photo_avt = '<img src="'. HOME_URL .'/uploads/article_menu/banner-'. $row['img'] . '" alt="' . stripslashes($row['name']) . '">';
                    $role = 0;
                }
            }
        } else $parent = 0;
    }
}
echo '<div class="img">' . $photo_avt . '</div>';
?>
</section>
<!-- / .banner -->