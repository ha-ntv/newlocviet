<?php

if (!defined('TTH_SYSTEM')) { die('Please stop!'); }

?>

<style>

   .input_muahng3 {

       margin-bottom: 15px;

   }

   .input_muahng {

       display: inline-block;

   }

    .input_muahng2 {

        line-height: 35px;

        display: inline-block;

        text-align: right;

    }

    select {

        height:35px;

    }

</style>

<script type="text/javascript" src="<?php echo HOME_URL;?>/json/huyen.js"></script>

<script type="text/javascript" src="<?php echo HOME_URL;?>/json/tinh.js"></script>

<?php

//---------------[ box-wp BEGIN ]---------------------------

$category_id = 0;

$breadcrumb_home = '<a href="'. HOME_URL_LANG . '" title="' . $lgTxt_menu_home . '"><i class="fa fa-home"></i></a>';

$breadcrumb_category = $breadcrumb_menu_parent = $breadcrumb_menu = '';



$db->table = "category";

$db->condition = "is_active = 1 and slug = '".$slug_cat."'";

$db->order = "";

$db->limit = 1;

$rows = $db->select();

foreach ($rows as $row) {

	$category_id = $row['category_id']+0;

	$breadcrumb_category = '<a href="' . HOME_URL_LANG . '/' . $slug_cat . '" title="' . stripslashes($row['name']) . '">' . stripslashes($row['name']) . '</a>';

}

if (!defined('TTH_SYSTEM')) { die('Please stop!'); }

//

if(isset($_POST['remove'])) {

	removeCart();

}

if (isset($_SESSION['cart']))

	$cart = $_SESSION['cart'];

else

	$cart = array();

$_SESSION['cart'] = $cart;



if(isset($_POST['addCart']) && isset($_POST['id'])) {

	addToCart($_POST['id']+0, $_POST['qty']+0);

}

if(isset($_GET['del']) && isset($_GET['del'])) {

	delItemCart($_GET['del']); 

}

?>

<div class="container-fluid fluid_tit">

    <div class="row">

        <div class="container ner_titlelt">

            <p class="brow_tit">

                <a href="<?php echo HOME_URL_LANG;?>">Trang chủ</a>

                <a href="<?php echo HOME_URL_LANG;?>/mua-hang">Giỏ hàng</a>

            </p>

        </div>

    </div>

</div>

<div class="container breadcr" style="max-width:966px">



<div class="row checkout_cart_info">

    <div class="col-md-8 col-sm-12 col-xs-12">

        <h3 class="cart-header">Thông tin đặt hàng</h3>

        <div class="f-space15 carthang cart-form" >

            <form id="frm_order" name="frm_order" class="frm shopping" method="post" onsubmit="return sendMail2('send_order', 'frm_order');">

                <input type="hidden" name="lang_field" id="txtEnterField" value="<?=$txtEnter_field?>"/>

                <input type="hidden" name="lang_email" id="txtEnterMail" value="<?=$txtEnter_email?>"/>

                <input type="hidden" name="lang_phone" id="txtEnterTell" value="<?=$txtEnter_tell?>"/>
                <input type="hidden" name="shipping_cost" id="shipping_cost" value="0"/>
                <div class="cart-form-wrapper">

                    <div class="row input_muahng3">

                        <div class="col-xs-12 col-sm-3 col-md-3 input_muahng2">

                            Họ tên:

                        </div>

                        <div class="col-xs-12 col-sm-9 col-md-9 input_muahng">

                            <input type="text" id="txtName" name="name" placeholder="<?=$txtContact_name?>" value="" maxlength="250">

                        </div>

                    </div>

                    <div class="row input_muahng3">

                        <div class="col-xs-12 col-sm-3 col-md-3 input_muahng2">

                            Điện thoại:

                        </div>

                        <div class="col-xs-12 col-sm-9 col-md-9 input_muahng">

                            <input type="text" id="txtTell" name="tel" placeholder="<?=$txtContact_fone?>" value="" maxlength="20">

                        </div>

                    </div>

                    <div class="row input_muahng3">

                        <div class="col-xs-12 col-sm-3 col-md-3 input_muahng2">

                            Email:

                        </div>

                        <div class="col-xs-12 col-sm-9 col-md-9 input_muahng">

                            <input type="text" id="txtEmail" name="email" placeholder="<?=$txtContact_email?>" value="" maxlength="250">

                        </div>

                    </div>

                    <div class="row input_muahng3">

                        <div class="col-xs-12 col-sm-3 col-md-3 input_muahng2">

                            Tỉnh thành:

                        </div>

                        <div class="col-xs-12 col-sm-9 col-md-9 input_muahng">

                            <select id="cityTxt" name="city" >

                            </select>

                        </div>

                    </div>

                    <div class="row input_muahng3">

                        <div class="col-xs-12 col-sm-3 col-md-3 input_muahng2">

                            Quận huyện:

                        </div>

                        <div class="col-xs-12 col-sm-9 col-md-9 input_muahng">

                            <select id="districtTxt" name="district">

                                <option selected="selected" value="">--Chọn quận/huyện--</option>

                            </select>

                        </div>

                    </div>

                    <div class="row input_muahng3">

                        <div class="col-xs-12 col-sm-3 col-md-3 input_muahng2">

                            Địa chỉ chi tiết:

                        </div>

                        <div class="col-xs-12 col-sm-9 col-md-9 input_muahng">

                            <input type="text" id="txtAddress" name="address" placeholder="<?=$txtContact_address?>" value="" maxlength="250">

                        </div>

                    </div>

                    <div class="row input_muahng3">

                        <div class="col-xs-12 col-sm-3 col-md-3 input_muahng2">

                            Yêu cầu:

                        </div>

                        <div class="col-xs-12 col-sm-9 col-md-9 input_muahng">

                            <textarea id="txtContent" name="txtContent" placeholder="<?=$txtContact_content?>" cols="60" rows="3"></textarea>

                        </div>

                    </div>

                </div>

                    <div class="row payment-method">

                        <div class="col-xs-12 col-sm-12 col-md-12 input_chuyenkhoan">

                            <p class="htthanhtoan">Hình thức thanh toán</p>

                            <div class="radio_mot">

                                <input type="radio" checked="checked" name="thanhtoan" value="1"><label><b>Thanh toán tại nhà</b><br>Quý khách sẽ thanh toán bằng tiền mặt khi nhận hàng</label>

                            </div>

                            <div class="radio_hai">

                                <input type="radio" name="thanhtoan" value="2"><label><b>Thanh toán chuyển khoản</b></label>

                                <div class="trum_ptk" style="display:none;" id="detail_transfer_account">

                                    <?php echo getPage('sotk');?>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-12">

                            <div class="round">

                                <input id="ctl00" type="checkbox" name="ctl00" checked="checked"><label for="ctl00">Tôi đồng ý với các chính sách và quy định mua hàng tại website</label>

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 nutmuahang">

                            <input type="button" id="redirect_product" name="redirectProduct" onclick="location.href='/san-pham'" value="Tiếp tục mua hàng">

                            <input type="submit" id="_send_order" name="btnSendOrder" value="Mua hàng">

                        </div>	

                    </div> 

                </form>

                <script>

                    window.onload = check_order();

                </script>

            </div>

        </div>

        <div class="col-md-4 col-sm-12 col-xs-12">

            <div class="cart-parent">

                <div class="show-cart"><?=readCartForSideMenu2();?></div>

            </div>

        </div>

    </div>

</div>

<script type="text/javascript">

$(document).ready(function(){

    // generate data for provinces

    var proData = JSON.parse(provinceList)

    var txt = '<option selected="selected" data-id="" value="">--Chọn tỉnh thành--</option>';

    proData.map(function(item) {

        txt += '<option value="'+item.name+'" data-id="'+item.id+'">'+item.name+'</option>'

    })

    $('#cityTxt').html(txt);



    // handle quantity input change in cart detail

    $('.qty-input').change(function(){

        var val = $(this).val();

        var productId = $(this).attr('data-id');

        var oldVal = $(this).attr('data-old-val');

        var price = $(this).attr('data-price');

        var total = $('#total_temp_val').attr('data-val');

        var shipping = $('#shipping_val').attr('data-val');

        if(isNaN(val) || +val === 0) $(this).val(oldVal);

        else {

            var req = JSON.stringify({[productId]: val});

            $.ajax({

                url:'/action.php',

                type: 'POST',

                dataType: "html",

                url: 'action.php',

                data: 'url=update_cart&qty='+req,

                success: function(data) {

                    console.log(data)

                },

                error: function(err) {

                    console.log(err)

                }

            })

            var oldPrice = +oldVal*(+price);

            var valPrice = +val*(+price);

            var newTotal = +total - oldPrice + valPrice;

            var newTotalWithShipping = newTotal + (+shipping);

            var newVal = valPrice.toLocaleString('de-DE');

            var newTotalFormat = newTotal.toLocaleString('de-DE');

            var newTotalWithShippingFormat = newTotalWithShipping.toLocaleString('de-DE');

            var ancestor = $(this).closest('li').find('.temp_val').html(newVal + '<sup>đ</sup>');

            $('#total_temp_val').html(newTotalFormat + '<sup>đ</sup>');

            $('#total_temp_val_with_shipping').html(newTotalWithShippingFormat + '<sup>đ</sup>');

        }

    })

    // hanlde payment method change

    $('input[name="thanhtoan"]').change(function(){

        var val = $(this).val()

        if(val == 2) $('#detail_transfer_account').slideDown()

        else  $('#detail_transfer_account').slideUp()

    })

})

jQuery('#cityTxt').change(function(){

    var val = $(this).find(':selected').attr('data-id')

    if(+val > 0) {

        var mydata = JSON.parse(districtData);

        var listDistrict = mydata.filter(function(item) {

            return item.tinh_id == val;

        })

        var str = "";

        if(Array.isArray(listDistrict) && listDistrict.length) {

            str +='<option selected="selected" value="">--Chọn quận/huyện--</option>';

            for(var i = 0; i < listDistrict.length; i++) {

                str +='<option value="'+listDistrict[i].name+'">'+listDistrict[i].name+'</option>\n'

            }

        }

        $('#districtTxt').html(str);
        $.ajax({

            url:'/action.php',

            type: 'GET',

            dataType: "html",

            url: 'action.php',

            data: 'url=get_shipping_fee&id='+val,

            success: function(data) {
                $('#shipping_val').html(+data.toLocaleString('de-DE') + '<sup> đ</sup>');
                $('#shipping_val').attr('data-val', data);
                var temp = $('#total_temp_val').attr('data-val');
                $('#total_temp_val_with_shipping').html(((+data)+(+temp)).toLocaleString('de-DE') + '<sup> đ</sup>')
                
                $('#shipping_cost').val(data);
            },

            error: function(err) {

                console.log(err)

            }

        })

    } else {
        $('#shipping_val').html('');
        $('#shipping_val').attr('data-val', '0');
        var temp = $('#total_temp_val').attr('data-val');
        $('#total_temp_val_with_shipping').html((+temp).toLocaleString('de-DE') + '<sup> đ</sup>')
        $('#shipping_cost').val('0');
    }

})



</script>

