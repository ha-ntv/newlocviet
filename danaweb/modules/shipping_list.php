<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ini_set('error_log','../hantv99.log');
//
?>

<!-- Menu path -->
<div class="row">
	<ol class="breadcrumb">
		<li>
			<a href="<?php echo ADMIN_DIR?>"><i class="fa fa-home"></i> Trang chủ</a>
		</li>
		<li>
			<i class="fa fa-edit"></i> Quản lý nội dung
		</li>
		<li>
			<i class="fa fa-shopping-cart"></i> Phí ship theo tỉnh
		</li>
	</ol>
</div>
<!-- /.row -->
<?php echo dashboardCoreAdmin(); ?>
<?php
// if(isset($_POST['idDel'])){

// 	$idDel = implode(',',$_POST['idDel']);

// 	$db->table = "province";
// 	$db->condition = "province_id IN (".$idDel.")";
// 	$db->delete();
// 	loadPageSucces("Đã thực hiện thao tác Xóa thành công.","?".TTH_PATH."=shipping_list");
// }

if(isset($_POST['edit_shipping_fee'])) {
	$provinceID = $_POST['province_id'];
	$price =  formatNumberToInt($_POST['price']);
	$db->table = "province";
	$data = array(
		'price' => $price
	);
	$db->condition = "province_id = ".$provinceID;
	$db->update($data);
	loadPageSucces("Đã update thành công.","?".TTH_PATH."=shipping_list");
}
?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default panel-no-bprovince">
			<div class="table-responsive">
				
					<table class="table display table-manager" cellspacing="0" cellpadding="0" id="dataTablesList">
						<thead>
						<tr>
							<th width="50px">STT</th>
							<th>Tên tỉnh</th>
							<th>Phí ship</th>
							<th>Trạng thái</th>
							<th>Chọn</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$date = new DateClass();

						$db->table = "province";
						$db->condition = "";
						$db->order = "province_id ASC";
						$rows = $db->select();

						$totalpages = 0;
						$perpage = 80;
						$total = $db->RowCount;
						if($total%$perpage==0) $totalpages=$total/$perpage;
						else $totalpages = floor($total/$perpage)+1;
						if(isset($_GET["page"])) $page=$_GET["page"]+0;
						else $page=1;
						$start=($page-1)*$perpage;
						$i=0+($page-1)*$perpage;

						$db->table = "province";
						$db->condition = "";
						$db->order = "province_id ASC";
						$db->limit = $start.','.$perpage;
						$rows = $db->select();

						foreach($rows as $row) {
							$i++;
							?>
							<tr>
								<td align="center"><?php echo $i?></td>
								<td><?php echo stripslashes($row['name'])?></td>
								<td align="center"><?php echo number_format($row['price'], 0, ',', '.')?></td>
								<td align="center"> Hoạt động
								</td>
								<td class="details-control" align="center">
									<span class="btn btn-primary btn-sm-sm" data-toggle="modal" data-target="#_province" onclick="return open_modal_province(<?php echo $row['province_id']?>);">Điều chỉnh phí ship</span>&nbsp;
								</td>
							</tr>
						<?php
						}
						?>
						</tbody>
					</table>
					<!-- Modal -->
					<div class="modal fade" id="_province" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
					<!-- /.modal -->
					<div class="row">
						<div class="col-sm-6"><?php echo showPageNavigation($page, $totalpages,'?'.TTH_PATH.'=shipping_list&page=')?></div>
						<!--<div class="col-sm-6" align="right" style="padding: 7px 0;">
								<label class="radio-inline"><input type="checkbox" id="selecctall"  data-toggle="tooltip" data-placement="top" title="Chọn xóa tất cả" ></label>
								<input type="button" class="btn btn-primary btn-xs confirmManager" value="Xóa" name="delete">
							</div>-->
					</div>
			</div>
			<!-- /.table-responsive -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-6 -->
</div>
<script>
	$(document).ready(function() {
		$('#dataTablesList').dataTable( {
			"language": {
				"url": "<?php echo ADMIN_DIR?>/js/plugins/dataTables/de_DE.txt"
			},
			"aoColumnDefs" : [ {
				"bSortable" : false,
				"aTargets" : [ 3, "no-sort" ]
			} ],
			"paging":   false,
			"info":     false,
			"province": [ 0, "asc" ]
		} );

		$('#selecctall').click(function(event) {
			if(this.checked) {
				$('.checkbox').each(function() {
					this.checked = true;
				});
			}else{
				$('.checkbox').each(function() {
					this.checked = false;
				});
			}
		});
	});
	$(".confirmManager").click(function() {
		var element = $(this);
		var action = element.attr("id");
		confirm("Tất cả các dữ liệu liên quan sẽ được xóa và không thể phục hồi.\nBạn có muốn thực hiện không?", function() {
			if(this.data == true) document.getElementById("delete").submit();
		});
	});
</script>