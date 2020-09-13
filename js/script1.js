function $$$(id) {
	return document.getElementById(id);
}
function	Forward(url) {
	window.location.href = url;
}
function	_postback() {
	return void(1);
}
//----------------------------------------------------------------------------------------------------------------------
function ajaxFunction() {
	var xmlHttp=null;
	try {
		// Firefox, Internet Explorer 7. Opera 8.0+, Safari.
		xmlHttp = new XMLHttpRequest();
	}
	catch (e) {
		// Internet Explorer 6.
		try {
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e) {
			try{
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e) {
				return false;
			}
		}
	}
}
//----------------------------------------------------------------------------------------------------------------------
/**
 *
 * @param obj
 * @returns {string}
 */
function jQueryquery(obj) {
	var query = "";
	jQuery(obj).find("input").each(function(i){
		var t = jQuery(obj).find("input").eq(i);
		if ((t.attr("type") != "checkbox") && (t.attr("type") != "button") && (t.attr("type") != "radio") ) {
			if (t.attr("type") != "password") {
				query += "&"+t.attr("name")+"="+encodeURIComponent(t.val());
			} else {
				query += "&"+t.attr("name")+"="+document.getElementById(t.attr("name")).value;
			}
		}
		else {
			if(t.attr("type") == "checkbox") {
				if (t.is(":checked"))
					query += "&"+t.attr("name")+"="+t.attr("value");
			}
			else if (t.attr("type") == "radio") {
				if (t.is(":checked"))
					query += "&"+t.attr("name")+"="+t.attr("value");
			}
		}
	});
	jQuery(obj).find("textarea").each(function(i) {
		var t = jQuery(obj).find("textarea").eq(i);
		query += "&"+t.attr("name")+"="+encodeURIComponent(t.val());
	});
	jQuery(obj).find("select").each(function(i) {
		var t = jQuery(obj).find("select").eq(i);
		query += "&"+t.attr("name")+"="+encodeURIComponent(t.val());
	});

	return query.substring(1);
}
//----------------------------------------------------------------------------------------------------------------------
function jQueryquery_unt(obj) {
	var query = "";
	jQuery(obj).find("input").each(function(i){
		var t = jQuery(obj).find("input").eq(i);
		if((t.attr("type") != "button") && (t.attr("type") != "submit") && (t.attr("type") != "reset") && (t.attr("type") != "hidden")) {
			if ((t.attr("type") != "checkbox") && (t.attr("type") != "radio") ) {
				t.val('');
			} else {
				t.attr("checked", false);
			}
		} else {}
	});
	jQuery(obj).find("textarea").each(function(i) {
		var t = jQuery(obj).find("textarea").eq(i);
		t.val('');
	});
	return true;
}
//----------------------------------------------------------------------------------------------------------------------
function showLoader() {
	jQuery("#_loading").html("<div style=\"position: fixed; top: 50%; right: 50%; text-align: center; background: transparent; z-index: 999999999;\"><div class=\"windows8\"> <div class=\"wBall\" id=\"wBall_1\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_2\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_3\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_4\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_5\"> <div class=\"wInnerBall\"> </div> </div> </div></div>").hide().fadeIn(10);
	block = true;
}
//----------------------------------------------------------------------------------------------------------------------
function closeLoader() {
	jQuery("#_loading").html("").hide().fadeOut(100);
	block = false;
}
//----------------------------------------------------------------------------------------------------------------------
function showResult(type,data) {
	closeLoader();
	jQuery("#"+type+"").html(data).hide().fadeIn(100);
	block = false;
}
//----------------------------------------------------------------------------------------------------------------------
jQuery(document).ready(function() {
	jQuery(window).scroll(function() {
		if(jQuery(this).scrollTop() > 50){
			jQuery('#go-top').stop().animate({
				bottom: '50px'
			}, 500);
		}
		else{
			jQuery('#go-top').stop().animate({
				bottom: '-50px'
			}, 500);
		}
	});
	jQuery('#go-top').click(function() {
		jQuery('html, body').stop().animate({
			scrollTop: 0
		}, 500, function() {
			jQuery('#go-top').stop().animate({
				bottom: '-50px'
			}, 500);
		});
	});
	jQuery(function () {
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 150 && window.innerWidth > 960) {
				jQuery('.menu-home').addClass('fixed fadeInDown');
			} else {
				jQuery('.menu-home').removeClass('fixed fadeInDown');
			}
		});
	});
});
(function(jQuery) {
	jQuery.fn.menumaker = function(options) {
		var navigation = jQuery(this), settings = jQuery.extend({
			title: "",
			format: "dropdown",
			sticky: false
		}, options);

		return this.each(function() {
			navigation.find('li ul').parent().addClass('has-sub');
			multiTg = function() {
				navigation.find(".has-sub ul li.active").parents('.has-sub').addClass('active');
			};
			multiTg();
		});
	};
	jQuery(document).ready(function(){
		jQuery(document).ready(function() {
			jQuery("nav .navigation").menumaker({
				title: "",
				format: "multitoggle"
			});
		});
	});
})(jQuery);
//----------------------------------------------------------------------------------------------------------------------
function sendMail1(type, id) {
	var dataList = new FormData(jQuery('#'+id)[0]);
    dataList.append("url", type);
    showLoader();
    jQuery.ajax({
        url:'/action.php',
        type: 'POST',
        data: dataList,
        async: false,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'html',
        success: function(data){
            closeLoader();
            alert('Cảm ơn bạn đã gửi review!');
            jQuery('#MainContent').append(data);
        }
    })
}
//----------------------------------------------------------------------------------------------------------------------
function sendMail(type, id) {
	var dataList = jQueryquery('#'+id);
	showLoader();
	jQuery.ajax({
		url:'/action.php',
		type: 'POST',
		data: 'url='+type+'&'+dataList,
		dataType: "html",
		success: function(data){
			closeLoader();
			jQueryquery_unt('#'+id);
			alert(data);
		}
	});
	return false;
}
function sendOrder(type, id) {
	var dataList = jQueryquery('#'+id);
	showLoader();
	jQuery.ajax({
		url:'/action.php',
		type: 'POST',
		data: 'url='+type+'&'+dataList,
		dataType: "html",
		success: function(data){
			closeLoader();
			jQueryquery_unt('#'+id);
			alert(data, function() {
				window.location.reload();
			});
			//alert(data);
		}
	});
	return false;
}
function sendQuestion(type, id) {
	var dataList = jQueryquery('#'+id);
	showLoader();
	jQuery.ajax({
		url:'/action.php',
		type: 'POST',
		data: 'url='+type+'&'+dataList,
		dataType: "html",
		success: function(data){
			closeLoader();
			jQueryquery_unt('#'+id);
			//alert(data, function() {
			//window.location.reload();
			//});
			alert(data);
		}
	});
	return false;
}
function sendRegEmail() {
	var email = document.forms['email_register']['email'].value;
	var email_filter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)jQuery/i;
	var test = true;
	var lang = document.forms['email_register']['lang'].value;
	test = email_filter.test(email);
	if(test==false) {
		alert('Email address is not valid.');
		return false;
	} else {
		showLoader();
		jQuery.ajax({ 
			url:'/action.php',
			type: 'POST',
			data: 'url=register_email&email='+email+'&lang='+lang,
			dataType: "html",
			success: function(data){
				closeLoader();
				jQuery('#_reg_email').val('');
				alert(data);
			}
		});
	}
	return false;
}
// --------------------------------------------------------------------------------------------------------------------

function check_order(){
	var input = document.forms['frm_order'].getElementsByTagName('input');
	var txtarea = document.forms['frm_order'].getElementsByTagName('textarea');
	var err_field = jQuery('#txtEnterField').val();
	var err_email = jQuery('#txtEnterMail').val();
	var err_tell = jQuery('#txtEnterTell').val();

	var inputs = new Array();
	for(var i=0; i<(input.length+txtarea.length); i++){
		if(i<input.length) inputs[i]=input[i];
		else inputs[i]=txtarea[i-input.length];
	}
	var run_onchange = false;
	var emailfilter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)jQuery/i;
	var pass ='';
	function valid(){
		var errors = false;
		for(var i=0; i<inputs.length; i++){
			var value = inputs[i].value;
			var id = inputs[i].getAttribute('id');

			var span = document.createElement('span');
			var p = inputs[i].parentNode;
			if(p.lastChild.nodeName == 'SPAN') {p.removeChild(p.lastChild);}

			if( value == ''){
				if(id == 'hoten') {
					span.innerHTML = 'Nhập họ tên';
				}
				else if(id == 'email') {
					span.innerHTML = 'Nhập email';
				}
				else if(id == 'quoctich') {
					span.innerHTML = 'Chọn quốc tịch';
				}
				else if(id == 'sodienthoai') {
					span.innerHTML = 'Nhập số điện thoại';
				}
				else if(id == 'loaiphong') {
					span.innerHTML = 'Chọn loại phòng';
				}
				else if(id == 'ngaynhan') {
					span.innerHTML = 'Nhập ngày nhận';
				}
				else if(id == 'ngaytra') {
					span.innerHTML = 'Nhập ngày trả';
				}
				else if(id == 'songuoi') {
					span.innerHTML = 'Chọn số người';
				}
				else if(id == 'sotreem') {
					span.innerHTML = 'Chọn số trẻ em';
				}
				else if(id != '_send_order') {
					span.innerHTML = err_field;
				}
			}
			if(id == 'email' && value != '') {
				var returnval=emailfilter.test(value);
				if(returnval==false){span.innerHTML = err_email;}
			}
			if(id == 'sodienthoai' && value != ''){
				if(isNaN(value) == true || value.indexOf('.')!=-1 || value < 0){span.innerHTML = err_tell;}
				if(isNaN(value) == false && value.length < 10){span.innerHTML = err_tell;}
			}

			if(span.innerHTML != ''){
				inputs[i].parentNode.appendChild(span);
				span.setAttribute('class', 'show-error');
				errors = true;
				run_onchange = true;
				inputs[i].style.border = '1px solid #ff6e69';
			}
		}
		return !errors;
	}

	var register = document.getElementById('_send_order');
	register.onclick = function(){
		return valid();
	}

	for(var i=0; i<inputs.length; i++){
		var id = inputs[i].getAttribute('id');
		inputs[i].onchange = function(){
			if(run_onchange == true){
				this.style.border = '1px solid #e0e1e0';
				valid();
			}
		}
	}
}

// --------------------------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------------------------
function check_review(){
	var input = document.forms['frm_review'].getElementsByTagName('input');
	var txtarea = document.forms['frm_review'].getElementsByTagName('textarea');
	var err_field = jQuery("[name='lang_field']").val();
	var err_email = jQuery("[name='lang_email']").val();
	var err_phone = jQuery("[name='lang_phone']").val();

	var inputs = new Array();
	for(var i=0; i<(input.length+txtarea.length); i++){
		if(i<input.length) inputs[i]=input[i];
		else inputs[i]=txtarea[i-input.length];
	}
	var run_onchange = false;
	var email_filter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)jQuery/i;
	var pass ='';
	function valid(){
		var errors = false;
		for(var i=0; i<inputs.length; i++){
			var value = inputs[i].value;
			var name = inputs[i].getAttribute('name');

			var span = document.createElement('span');
			var p = inputs[i].parentNode;
			if(p.lastChild.nodeName == 'SPAN') {p.removeChild(p.lastChild);}

			if( value == ''){
				if(name == 'full_name') {
					span.innerHTML = 'Nhập họ tên';
				}
				else if(name == 'job') {
					span.innerHTML = 'Nhập nghề nghiệp';
				}
				else if(name == 'national') {
					span.innerHTML = 'Nhập quốc tịch';
				}
				else if(name == 'img') {
					span.innerHTML = 'Nhập ảnh đại diện';
				}
				else if(name == 'content') {
					span.innerHTML = 'Nhập nội dung';
				}
				else if(name != 'send_review') {
					span.innerHTML = err_field;
				}
			}
			if(name == 'email' && value != '') {
				var return_val=email_filter.test(value);
				if(return_val==false){span.innerHTML = err_email;}
			}
			if(name == 'tell' && value != ''){
				if(isNaN(value) == true || value.indexOf('.')!=-1 || value < 0){span.innerHTML = err_phone;}
				if(isNaN(value) == false && value.length < 10){span.innerHTML = err_phone;}
			}

			if(span.innerHTML != ''){
				inputs[i].parentNode.appendChild(span);
				span.setAttribute('class', 'show-error');
				errors = true;
				run_onchange = true;
				inputs[i].style.border = '1px solid #ff6e69';
			}
		}
		return !errors;
	}
	var register = document.getElementById('_send_review');
	register.onclick = function(){
		return valid();
	}
	for(var i=0; i<inputs.length; i++){
		var id = inputs[i].getAttribute('id');
		inputs[i].onchange = function(){
			if(run_onchange == true){
				this.style.border = '1px solid #cecfce';
				valid();
			}
		}
	}
}
//----------------------------------------------------------------------------------------------------------------------
function check_contact(){
	var input = document.forms['frm_contact'].getElementsByTagName('input');
	var txtarea = document.forms['frm_contact'].getElementsByTagName('textarea');
	var err_field = jQuery("[name='lang_field']").val();
	var err_email = jQuery("[name='lang_email']").val();
	var err_phone = jQuery("[name='lang_phone']").val();

	var inputs = new Array();
	for(var i=0; i<(input.length+txtarea.length); i++){
		if(i<input.length) inputs[i]=input[i];
		else inputs[i]=txtarea[i-input.length];
	}
	var run_onchange = false;
	var email_filter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)jQuery/i;
	var pass ='';
	function valid(){
		var errors = false;
		for(var i=0; i<inputs.length; i++){
			var value = inputs[i].value;
			var name = inputs[i].getAttribute('name');

			var span = document.createElement('span');
			var p = inputs[i].parentNode;
			if(p.lastChild.nodeName == 'SPAN') {p.removeChild(p.lastChild);}

			if( value == ''){
				if(name == 'full_name') {
					span.innerHTML = 'Full name';
				}
				else if(name == 'email') {
					span.innerHTML = 'Email';
				}
				else if(name == 'add') {
					span.innerHTML = 'Address';
				}
				else if(name == 'tell') {
					span.innerHTML = 'Phone number';
				}
				else if(name == 'content') {
					span.innerHTML = 'Request';
				}
				else if(name != 'company'  && name != 'send_contact') {
					span.innerHTML = err_field;
				}
			}
			if(name == 'email' && value != '') {
				var return_val=email_filter.test(value);
				if(return_val==false){span.innerHTML = err_email;}
			}
			if(name == 'tell' && value != ''){
				if(isNaN(value) == true || value.indexOf('.')!=-1 || value < 0){span.innerHTML = err_phone;}
				if(isNaN(value) == false && value.length < 10){span.innerHTML = err_phone;}
			}

			if(span.innerHTML != ''){
				inputs[i].parentNode.appendChild(span);
				span.setAttribute('class', 'show-error');
				errors = true;
				run_onchange = true;
				inputs[i].style.border = '1px solid #ff6e69';
			}
		}
		return !errors;
	}
	var register = document.getElementById('_send_contact');
	register.onclick = function(){
		return valid();
	}
	for(var i=0; i<inputs.length; i++){
		var id = inputs[i].getAttribute('id');
		inputs[i].onchange = function(){
			if(run_onchange == true){
				this.style.border = '1px solid #cecfce';
				valid();
			}
		}
	}
}
//----------------------------------------------------------------------------------------------------------------------
function check_booking(){
	var input = document.forms['frm_order'].getElementsByTagName('input');
	var txtarea = document.forms['frm_order'].getElementsByTagName('textarea');
	var err_field = jQuery("[name='lang_field']").val();
	var err_email = jQuery("[name='lang_email']").val();
	var err_phone = jQuery("[name='lang_phone']").val();

	var inputs = new Array();
	for(var i=0; i<(input.length+txtarea.length); i++){
		if(i<input.length) inputs[i]=input[i];
		else inputs[i]=txtarea[i-input.length];
	}
	var run_onchange = false;
	var email_filter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)jQuery/i;
	var pass ='';
	function valid(){
		var errors = false;
		for(var i=0; i<inputs.length; i++){
			var value = inputs[i].value;
			var name = inputs[i].getAttribute('name');

			var span = document.createElement('span');
			var p = inputs[i].parentNode;
			if(p.lastChild.nodeName == 'SPAN') {p.removeChild(p.lastChild);}
			var input_unt = ['hotel', 'room', 'content', 'send_order',  'date_end'];
			var cke = input_unt.indexOf(name);
			if( value == '' && cke < 0){
				span.innerHTML = err_field;
			}
			if(name == 'email' && value != '') {
				var return_val = email_filter.test(value);
				if(return_val == false){ span.innerHTML = err_email; }
			}
			if(name == 'phone' && value != ''){
				if(isNaN(value) == true || value.indexOf('.')!=-1 || value < 0){span.innerHTML = err_phone;}
				if(isNaN(value) == false && value.length < 10){span.innerHTML = err_phone;}
			}

			if(span.innerHTML != ''){
				inputs[i].parentNode.appendChild(span);
				span.setAttribute('class', 'show-error');
				errors = true;
				run_onchange = true;
				inputs[i].style.border = '1px solid #ff6e69';
			}
		}
		return !errors;
	}
	var register = document.getElementById('send_order');
	register.onclick = function(){
		return valid();
	}
	for(var i=0; i<inputs.length; i++){
		inputs[i].onchange = function(){
			if(run_onchange == true){
				this.style.border = '1px solid #cecfce';
				valid();
			}
		}
	}
}
//----------------------------------------------------------------------------------------------------------------------
function open_shopping(id) {
	jQuery.post('/action.php?url=shopping&id='+id, function(html) {
		jQuery(html).appendTo('body').modal();
	});
}
//----------------------------------------------------------------------------------------------------------------------
function check_question(){
	var input = document.forms['frm_question'].getElementsByTagName('input');
	var txtarea = document.forms['frm_question'].getElementsByTagName('textarea');
	var err_field = jQuery("[name='lang_field']").val();
	var err_email = jQuery("[name='lang_email']").val();
	var err_phone = jQuery("[name='lang_phone']").val();

	var inputs = new Array();
	for(var i=0; i<(input.length+txtarea.length); i++){
		if(i<input.length) inputs[i]=input[i];
		else inputs[i]=txtarea[i-input.length];
	}
	var run_onchange = false;
	var email_filter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)jQuery/i;
	var pass ='';
	function valid(){
		var errors = false;
		for(var i=0; i<inputs.length; i++){
			var value = inputs[i].value;
			var name = inputs[i].getAttribute('name');

			var span = document.createElement('span');
			var p = inputs[i].parentNode;
			if(p.lastChild.nodeName == 'SPAN') {p.removeChild(p.lastChild);}

			if( value == ''){
				if(name != 'tell' && name != 'company'  && name != 'send_question') {
					span.innerHTML = err_field;
				}
			}
			if(name == 'email' && value != '') {
				var return_val=email_filter.test(value);
				if(return_val==false){span.innerHTML = err_email;}
			}
			if(name == 'tell' && value != ''){
				if(isNaN(value) == true || value.indexOf('.')!=-1 || value < 0){span.innerHTML = err_phone;}
				if(isNaN(value) == false && value.length < 10){span.innerHTML = err_phone;}
			}

			if(span.innerHTML != ''){
				inputs[i].parentNode.appendChild(span);
				span.setAttribute('class', 'show-error');
				errors = true;
				run_onchange = true;
				inputs[i].style.border = '1px solid #ff6e69';
			}
		}
		return !errors;
	}

	var register = document.getElementById('_send_question');
	register.onclick = function(){
		return valid();
	}

	for(var i=0; i<inputs.length; i++){
		var id = inputs[i].getAttribute('id');
		inputs[i].onchange = function(){
			if(run_onchange == true){
				this.style.border = '1px solid #cecfce';
				valid();
			}
		}
	}
}
function lien_ket(a){
	if(a!=''){
		window.open(''+a+'','_blank');
	}
}
//----------------------------------------------------------------------------------------------------------------------

function listDistrict(value) {
	showLoader();
	jQuery.ajax({
		url:'/action.php',
		type: 'POST',
		data: 'url=get_location&city='+value,
		dataType: "html",
		success: function(data){
			showResult('_district', data);
		}
	});
	return false;
}
jQuery(document).ready(function () {
	window.asd = jQuery('.SlectBox').SumoSelect({ csvDispCount: 3, selectAll:true, captionFormatAllSelected: "Select all" });
	window.test = jQuery('.testsel').SumoSelect({okCancelInMulti:true, captionFormatAllSelected: "Select all" });
	window.testSelAll = jQuery('.testSelAll').SumoSelect({okCancelInMulti:true, selectAll:true });
	window.testSelAll2 = jQuery('.testSelAll2').SumoSelect({selectAll:true});
	window.testSelAlld = jQuery('.SlectBox-grp').SumoSelect({okCancelInMulti:true, selectAll:true, isClickAwayOk:true });
	window.Search = jQuery('.search-box').SumoSelect({ csvDispCount: 3, search: true, searchText:'Enter here.' });
	window.sb = jQuery('.SlectBox-grp-src').SumoSelect({ csvDispCount: 3, search: true, searchText:'Enter here.', selectAll:true });
	window.searchSelAll = jQuery('.search-box-sel-all').SumoSelect({ csvDispCount: 3, selectAll:true, search: true, searchText:'Enter here.', okCancelInMulti:true });
	window.searchSelAll = jQuery('.search-box-open-up').SumoSelect({ csvDispCount: 3, selectAll:true, search: false, searchText:'Enter here.', up:true });
	window.groups_eg_g = jQuery('.groups_eg_g').SumoSelect({selectAll:true, search:true });
	jQuery('.SlectBox').on('sumo:opened', function(o) {
		console.log("dropdown opened", o)
	});
});
// --------------------------------------------slider carousel-----------------------------------------
function owl_doitac(){
	var owl = jQuery('.doitac_khachhang');
	btt: true,
	owl.owlCarousel({
	    loop:true,
	    margin:30,
	    autoplay:true,
	    responsiveClass:true,
		autoplayTimeout:5000,
		smartSpeed:2500,
	    nav:false,
		responsive:{
	        0:{
            items:1
	        },
	        425:{
            items:2
	        },
	        667:{
            items:3
	        },
	        1000:{
            items:5
	        },
	    },
	});
}
function owl_bandh(){
	var owl = jQuery('.bandh');
	btt: true,
	owl.owlCarousel({
	    loop:true,
	    margin:30,
	    autoplay:true,
	    responsiveClass:true,
		autoplayTimeout:5000,
		smartSpeed:2500,
	    nav:false,
		responsive:{
	        0:{
            items:1
	        },
	        425:{
            items:2
	        },
	        667:{
            items:3
	        },
	        1000:{
            items:5
	        },
	    },
	});
}
jQuery(document).ready(function() {
	owl_doitac();
	owl_bandh();
});
jQuery(window).resize(function() {
	owl_doitac();
	owl_bandh();
});


