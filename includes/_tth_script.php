<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
?>

<script type="text/javascript" src="<?php echo HOME_URL;?>/js/modernizr.custom.js"></script>
<script type="text/javascript" src="<?php echo HOME_URL;?>/js/jquery.easing.js"></script>

<script type='text/javascript' src='<?php echo HOME_URL;?>/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.4.1'></script>

<script type="text/javascript" src="<?php echo HOME_URL;?>/js/jquery.popup/jquery.modal.min.js"></script>
<?php if($_SESSION["language"]=="vi"){?>
	<script type="text/javascript" src="<?php echo HOME_URL;?>/js/script.js"></script>
<?php }else{?>
	<script type="text/javascript" src="<?php echo HOME_URL;?>/js/script1.js"></script>
<?php } ?>


<?php if($_SESSION["language"]=="vi"){?>
	<script type="text/javascript" src="<?php echo HOME_URL;?>/js/jquery.popup/jquery.boxes.js"></script>
<?php }else{?>
	<script type="text/javascript" src="<?php echo HOME_URL;?>/js/jquery.popup/jquery.boxes1.js"></script>
<?php } ?>

<script type="text/javascript" src="<?php echo HOME_URL;?>/js/jquery.popup/jquery.boxes.repopup.js"></script>
<script type="text/javascript" src="<?php echo HOME_URL;?>/js/jquery.calendar/jquery.datetimepicker.js"></script>

<script src="<?php echo HOME_URL; ?>/js/full_bao/fullcalendar.min.js"></script>

<script type="text/javascript" src="<?php echo HOME_URL;?>/js/bootstrap/fileinput.js"></script>

<?php echo getConstant('google_analytics')?>
<?php echo getConstant('chat_online')?>
