<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
$stringObj = new String();
?>
<nav id="menu">
	<ul>
		<li <?php if($slug_cat=='home') echo 'class="mm-selected"'; ?> ><a href="<?php echo HOME_URL_LANG;?>"><?php echo $lgTxt_menu_home; ?></a></li>
		<?php
		$db->table = "category";
		$db->condition = "`is_active` = 1";
		$db->order = "sort_hide ASC";
		$db->limit = "6";
		$rows = $db->select();
		foreach ($rows as $row) {
			$active = '';
			if ($slug_cat == $row['slug']) $active = ' class="mm-selected"';
			echo '<li' . $active . '><a href="' . HOME_URL_LANG . '/' . stripslashes($row['slug']) . '" title="' . stripslashes($row['name']) . '"><span>' . stripslashes($row['name']) . '</span></a>' . loadMenuChild('article_menu', $row['category_id'], 0, $slug_cat, $id_menu, 'mm-selected') . loadMenuChild('product_menu', $row['category_id'], 0, $slug_cat, $id_menu, 'mm-selected') . '</li>';
		}
		?>
		<li <?php if($slug_cat=='lien-he') echo 'class="mm-selected"'; ?>>
			<a class="hvr-from-center" href="<?php echo HOME_URL_LANG . '/' . $lgTxt_slug_contact; ?>" title="<?php echo $lgTxt_menu_contact; ?>" >
				<span><?php echo $lgTxt_menu_contact; ?></span>
			</a>
		</li>
	</ul>
	
</nav>
<script type="text/javascript">
	$(function() {
		$('nav#menu').mmenu({
			extensions	: [ 'effect-slide-menu', 'pageshadow' ],
			searchfield	: true,
			counters	: false,
			dividers	: {
				fixed 	: true
			},
			navbar 		: {
				title	: "Lộc Việt"
			},
			offCanvas   : {
				position: "top"
			},
			navbars 	: [
				{
					position	: 'top',
					content		: [ 'searchfield' ]
				}, {
					position	: 'top',
					content		: [
						'prev',
						'title',
						'close'
					]
				}, 
				// {
				// 	"position": "bottom",
				// 	"content": [
				// 		<?php
				// 		if(getConstant('link_facebook')!="") echo '\'<a class="facebook fab fa-facebook-f" target="_blank" href="' . getConstant('link_facebook') .'" title="Facebook"></a>\',';
				// 		if(getConstant('link_youtube')!="") echo '\'<a class="youtube fab fa-youtube" target="_blank" href="' . getConstant('link_youtube') .'" title="Youtube"></a>\',';
				// 		if(getConstant('link_twitter')!="") echo '\'<a class="twitter fab fa-twitter" target="_blank" href="' . getConstant('link_twitter') .'" title="Twitter"></a>\',';
				// 		if(getConstant('link_instagram')!="") echo '\'<a class="instagram fab fa-instagram" target="_blank" href="' . getConstant('link_instagram') .'" title="Instagram"></a>\',';
				// 		?>
				// 	]
				// }
			]
		});
	});
</script>