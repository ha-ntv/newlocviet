<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
$breadcrumb_category = '<a class="error" href="' . HOME_URL_LANG . '" title="' . $lgTxt_error_page . '">' . $lgTxt_error_page . '</a>';
?>
<style type="text/css">
	.brow_loi{
		padding: 8px 15px;
	}.brow_loi a{
		font-size: 15px;
		line-height: 22px;
		color: #fff;
	}.error404{
		text-align: center;
		margin-top: 15px;
		margin-bottom: 30px;
	}.error404 p{
		color: #4a4a4a;
		font-size: 15px;
		line-height: 22px;
	}.error404 p a{
		color: #00923f;
	}.error404 p i{
		color: red;
		font-size: 70px;
		margin-top: 20px;
	}
</style>
<section class="container-fluid" style="background-color: #00923f;">
	<div class="row">
		<div class="container">
			<div class="brow_loi">
				<?php echo $breadcrumb_category;?>
			</div>
		</div>
	</div>
</section>
<section class="container">
	<div class="col-md-12 col-sm-12 col-xs-12 err_loi">
		<div class="error404">
		    <p><?php echo $lgTxt_page404;?> <a href="<?php echo HOME_URL_LANG;?>"><?php echo $lgTxt_page404_click;?></a> <?php echo $lgTxt_page404_back;?> <a href="<?php echo HOME_URL_LANG;?>"><?php echo $lgTxt_menu_home;?></a>.</p>
		    <p><i class="fa fa-warning color-red"></i></p>
		</div>
	</div>
</section>