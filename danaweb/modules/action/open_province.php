<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if(isset($_POST['id'])) {
	$id = $_POST['id'];
	$content = '';
	$date = new DateClass();
	$title = '';

	$db->table = "province";
	$db->condition = "province_id = $id";
	$db->order = "";
	$db->limit = 1;
	$rows = $db->select();
	if($db->RowCount > 0) {
		foreach($rows as $row) {
			
			 $title = '[PHÍ SHIP]: ' . stripslashes($row['name']);
                $content = '<div class="modal-dialog">
                                <div class="modal-content" style="max-width:500px">
                                <script type="text/javascript" src="./js/autoNumeric.js"></script>
                                <script>
                                $(".auto-number").autoNumeric("init");
                                </script>
                                <form action="?'.TTH_PATH. '=shipping_list" method="post" enctype="multipart/form-data" id="delete">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">' . $title .'</h4>
                                            <input type="hidden" name="province_id" value="'.$row['province_id'].'" >
                                        </div>
                                        <div class="modal-body"><p><input style="width: 350px" class="form-control auto-number" type="text" name="price" data-a-sep="." data-a-dec="," data-v-max="9999999999" data-v-min="0" maxlength="15" placeholder="0 =  Liên hệ" value="'.stripslashes($row['price']).'"></p></div>
                                        <div class="modal-footer">
                                            <button  class="btn btn-form-primary btn-form" type="submit" name="edit_shipping_fee" >LƯU</button>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>';
		}
	}
	echo $content;
}