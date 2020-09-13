<?php
if (!defined('TTH_SYSTEM')) {
    die('Please stop!');
}
?>
<div class="container-fluid fluid_tit">
    <div class="row">
        <div class="container ner_titlelt">
            <p class="brow_tit">
                <a href="<?php echo HOME_URL_LANG; ?>">Trang chủ</a>
                <?= $slug_cat == 'tin-tuc' ? '<a href="/tin-tuc">Tin tức</a>' : '<a href="/chinh-sach">Chính sách</a>' ?>
            </p>
        </div>
    </div>
</div>
<div class="container nerabout_list">
    <div class="row ">
        <div class="col-md-3 col-sm-3 col-xs-12 left_menupro">
            <?php include(_F_INCLUDES . DS . "tth_left.php"); ?>
        </div>
        <div class="col-md-9 col-sm-9 col-xs-12 right_dtprolist rightgt_dt list_news">
            <div class="row tong_listabout list_flex">
                <?php
                foreach ($rows as $row) {
                    $src = $row['img'] == "" || $row['img'] == "no" ?  HOME_URL . '/images/352x260.png' : HOME_URL . '/uploads/article/352x260' . $row['img'];
                    $comment_count = calCulateComment($row['article_id']);
                ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 item_vanhoapdv item_vanhoapdv_new isotope_item isotope_item_classic isotope_item_classic_3 isotope_column_3      isotope_item_show">

                        <div class="post_item post_item_classic post_item_classic_3	 post_format_standard odd">

                            <div class="post_featured">
                                <div class="post_thumb" data-title="<?php echo $row['name'] ?>">
                                    <a class="hover_icon hover_icon_link" href="<?php echo HOME_URL . '/' . $row['slug'] ?>"><img class="wp-post-image" width="370" height="270" alt="<?php echo $row['name'] ?>" src="<?php echo $src ?>"></a> </div>
                            </div>

                            <div class="post_content isotope_item_content">

                                <div class="post_info">
                                    <span class="post_info_item post_info_posted"> Đăng bởi Admin | <span class="post_info_date"><?php echo date('d/m/Y', $row['created_time']); ?></span><span class="comment"> |<?php echo $comment_count ?> bình luận</span></span>
                                </div>
                                <h5 class="post_title"><a href="<?php echo HOME_URL . '/' . $row['slug'] ?>"><?php echo $row['name'] ?></a></h5>

                                <div class="post_descr">
                                    <p><?php echo $stringObj->crop(stripcslashes($row['comment']), 50); ?></p><a href="<?php echo HOME_URL . '/' . $row['slug'] ?>" class="btn-link">Xem thêm</a>
                                </div>

                            </div> <!-- /.post_content -->
                        </div> <!-- /.post_item -->

                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>