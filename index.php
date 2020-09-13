<?php
@ob_start();
@session_start();
// System
define( 'TTH_SYSTEM', true );

$url = isset($_GET['url']) ? $_GET['url'] : 'home';
$path = array();
$path = explode('/',$url);
if($path[0]=='en') {
	$_SESSION["language"] = 'en';
} elseif($path[0]=='vi') {
	$_SESSION["language"] = 'vi';
} else {
	$_SESSION["language"] = 'vi';
	array_unshift($path, 'vi');
}
//----------------------------------------------------------------------------------------------------------------------
require_once(str_replace( DIRECTORY_SEPARATOR, '/', dirname( __file__ ) ) . '/define.php');
//---
require_once(ROOT_DIR . DS ."lang" . DS . TTH_LANGUAGE . ".lang");

include_once(_F_FUNCTIONS . DS . "Function.php");
try {
	$db =  new ActiveRecord(TTH_DB_HOST, TTH_DB_USER, TTH_DB_PASS, TTH_DB_NAME);
}
catch(DatabaseConnException $e) {
	echo $e->getMessage();
}
$account["id"] = empty($_SESSION["user_id"]) ? 0 : $_SESSION["user_id"]+0;
include_once(_F_INCLUDES . DS . "_tth_constants.php");
include_once(_F_INCLUDES . DS . "_tth_url.php");
include_once(_F_INCLUDES . DS . "_tth_online_daily.php");
?>
<!DOCTYPE html>
<html lang="<?php echo TTH_LANGUAGE;?>">


<head>
	<?php
		include(_F_INCLUDES . DS . "_tth_head.php");
		include(_F_INCLUDES . DS . "_tth_script.php");
	?>
	<!-- Start Shema.org -->
  
</head>
<body  class="<?php echo $slug_cat ?> blog">

<?php
echo getConstant('script_body');
?>
<div class="t3-off-canvas" id="t3-off-canvas">
  <div class="t3-off-canvas-header">
    <span class="t3-off-canvas-header-title">SELECT MENU</span>
    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">X</button>
  </div>
  <div class="t3-off-canvas-body">
    <div id="mobile-menu-wrap" class="t3-module module "><div class="module-ct"></div></div>
  </div>
</div>

<div class="t3-wrapper">
<div class="hfeed site">
<!-- #wrapper -->
<div id="wrapper" style="max-width: 1920px; position: relative;" class="body_wrap">
	<div class="page_wrap">
		
	<?php
		$plus_price = 30000;
		include(_F_INCLUDES . DS . "tth_header.php");
		if($slug_cat=="home" || $slug_cat=="-error-404" || $slug_cat=="search" || $slug_cat=="mua-hang"){
		//	include(_F_INCLUDES . DS . "tth_slider.php");
		}else{
		//	include(_F_INCLUDES . DS . "tth_slider1.php");
		}
    ?>
	<!-- .container -->
	<div class="page_content_wrap page_paddings_no">
		<div class="content_wrap <?php echo $slug_cat != "home" ? ' full_width' : ''?>">
			<div class="content">
	<?php
			include(_F_MODULES . DS .  str_replace('-','_',$slug_cat) . ".php");
		?>
		</div>
		</div>	
		</div>
		
	<!-- / .container -->
	<?php
	include(_F_INCLUDES . DS . "tth_footer.php");
	?>
	</div>
</div>

<!-- / #wrapper -->

<?php
echo getConstant('script_bottom');

?>
</div>
</div>
<div id="_loading"></div>
</body>
</html>