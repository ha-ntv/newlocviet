<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//-------------
$stringObj = new String();
?>
<section class="slider_wrap slider_fullwide slider_engine_revo slider_alias_home-1">
<rs-module-wrap id="rev_slider_1_1_wrapper" data-source="gallery" style="background:transparent;padding:0;margin:0px auto;margin-top:0;margin-bottom:0;max-width:">
				<rs-module id="rev_slider_1_1" style="display:none;" data-version="6.1.3">
					<rs-slides>
                           
            <?php 
                $db->table = "gallery";
                $db->condition = "is_active = 1 AND gallery_menu_id = 112";
                $db->order = "created_time desc";
                $db->limit = "";
                $rowsl = $db->select();
                $count = 0;
                foreach ($rowsl as $rowl){
                    $count++;
            ?>
               <rs-slide data-key="rs-<?php echo $count ?>" data-title="Slide" data-anim="ei:d;eo:d;s:600;r:0;t:fade;sl:d;">
                    <img src="<?php echo HOME_URL?>/uploads/gallery/full_<?= $rowl['img'] ?>" title="" data-panzoom="d:10000;ss:100;se:110;os:-100/-30;oe:100/30;" class="rev-slidebg" data-no-retina>
                    
                    <rs-layer
								id="slider-1-slide-1-layer-<?php echo $count?>" 
								class="Home-1-Subtitle"
								data-type="text"
								data-color="rgba(233,228,208,1)"
								data-rsp_ch="on"
								data-xy="x:c;y:364px;"
								data-text="s:40;l:40;fw:200;"
								data-frame_0="o:1;tp:600;"
								data-frame_0_chars="y:-100%;o:1;rZ:35deg;"
								data-frame_0_mask="u:t;"
								data-frame_1="tp:600;e:Power4.easeInOut;st:500;sp:2000;"
								data-frame_1_mask="u:t;"
								data-frame_999="o:0;tp:600;e:nothing;st:w;"
								style="z-index:5;font-family:Playfair Display;"
							><?php echo $rowl['name'];?>
                            </rs-layer>
                            <rs-layer
								id="slider-1-slide-1-layer-<?php echo $count?>" 
								class="Home-1-Title"
								data-type="text"
								data-color="rgba(233,228,208,1)"
								data-rsp_ch="on"
								data-xy="x:c;y:420px;"
								data-text="s:90;l:120;fw:700;"
								data-frame_0="o:1;tp:600;"
								data-frame_0_chars="y:-100%;o:1;rZ:35deg;"
								data-frame_0_mask="u:t;"
								data-frame_1="tp:600;e:Power4.easeInOut;st:500;sp:2000;"
								data-frame_1_mask="u:t;"
								data-frame_999="o:0;tp:600;e:nothing;st:w;"
								style="z-index:6;font-family:Playfair Display;"
							><?php echo $rowl['comment'];?>
                            </rs-layer>
                            <rs-layer
								id="slider-1-slide-1-layer-<?php echo $count?>" 
								class="Home-1-Shortcodes"
								data-type="text"
								data-color="rgba(255,255,255,1)"
								data-xy="x:c;y:597px;"
								data-text="s:14;l:14;"
								data-rsp_bd="off"
								data-frame_0="y:bottom;sX:2;sY:2;o:1;rZ:90deg;tp:600;"
								data-frame_1="tp:600;st:500;sp:1500;"
								data-frame_999="o:0;tp:600;e:nothing;st:w;"
								style="z-index:7;font-family:Arial;"
							><a href="/tinh-dau/" class="sc_button sc_button_square sc_button_style_filled sc_button_size_medium">Mua hàng</a> 
							</rs-layer>
                            </rs-slide>
            <?php } ?>
       
					
					</rs-slides>
					<rs-progress class="rs-bottom" style="visibility: hidden !important;"></rs-progress>
				</rs-module>
				<script type="text/javascript">
					setREVStartSize({c: 'rev_slider_1_1',rl:[1240,1024,778,480],el:[],gw:[1240],gh:[955],layout:'fullwidth',mh:"0"});
					var	revapi1,
						tpj;
					jQuery(function() {
						tpj = jQuery;
						if(tpj("#rev_slider_1_1").revolution == undefined){
							revslider_showDoubleJqueryError("#rev_slider_1_1");
						}else{
							revapi1 = tpj("#rev_slider_1_1").show().revolution({
								jsFileLocation:"//oliveoil.ancorathemes.com/wp-content/plugins/revslider/public/assets/js/",
								visibilityLevels:"1240,1024,778,480",
								gridwidth:1240,
								gridheight:955,
								minHeight:"",
								spinner:"spinner0",
								responsiveLevels:"1240,1024,778,480",
								disableProgressBar:"on",
								navigation: {
									onHoverStop:false
								},
								fallbacks: {
									allowHTML5AutoPlayOnAndroid:true
								},
							});
						}
						
					});
				</script>
			</rs-module-wrap>
			<!-- END REVOLUTION SLIDER -->
                </section>