<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if(isset($_POST['domain'])) {
	$domain = empty($_POST['domain']) ? '' : $_POST['domain'];
	?>
	<div class="modal-dialog">
		<div class="modal-header">
			<h3><i class="fa fa-tags fa-fw"></i> Thông tin Tên miền</h3>
		</div>
		<div class="modal-body">
			<iframe class="modal-iframe" src="http://www.matbao.net/ViewWhois.aspx?domain=<?php echo $domain;?>">
			</iframe>
		</div>
	</div>
<?php
} else echo 'Error--';
