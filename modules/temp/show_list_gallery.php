<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }

$date = new DateClass();
$stringObj = new String();

echo '</section>';
?>
<head>
	<link rel="stylesheet" type="text/css" href="/css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="/css/demo.css" />
	<link rel="stylesheet" type="text/css" href="/css/bookblock.css" />
	<link rel="stylesheet" type="text/css" href="/css/component.css" />
	<script src="/js/modernizr.custom.js"></script>
</head>
<div class="container fluid_lbra" style="">
	<div class="tit_home">
		<p><?= $tv;?></p>
	</div>
	<div class="menutab">
		<a class="active" id="buttonhinhanh" data-toggle="tab" href="#hinhanh"><?= $ha;?></a><div class="line-break768"></div>
		<a data-toggle="tab" id="buttonvideo" href="#video">VIDEO</a><div class="line-break768"></div>
		<a data-toggle="tab" id="buttonanpham" href="#anpham"><?= $ap;?></a><div class="line-break768"></div>
	</div>
	<div class="container">
		<div class="row animationnormal" style="margin-top: 35px;">
			<div class="tab-content animationnormal" style="">
				<div id="hinhanh" class="row animationfast tab-pane fade in active">
					<?php 
						$db->table = "gallery";
						$db->condition = "is_active = 1 and gallery_menu_id= 113";
						$db->order = "created_time DESC";
						$db->limit = "9";
						$rowhinh=$db->select();
				        foreach($rowhinh as $hinh)
				        {
				            $i=0;
				            $list_img = "";
				            $db->table = "uploads_tmp";
				            $db->condition = "upload_id = ".($hinh['upload_id']+0);
				            $db->order = "";
				            $db->limit = "";
				            $rows_gal = $db->select();
				            foreach ($rows_gal as $row_gal){
				                $list_img = $row_gal['list_img'];
				            }
				            $img = explode(";",$list_img);
				    ?>	
		           		<div class="col-md-4 col-sm-4 col-xs-6 hinhanhthuvien">
		           			<?php 
		           				if($list_img!="") {
				                for($i=0;$i<count($img);$i++) {
				                if($img[$i] != ""){
				            ?>
		           			<!-- <a rel="gallery-group-<?php echo $hinh['upload_id'] ?>" class="various fancy-box" href="<?php echo HOME_URL; ?>/uploads/photos/full_<?php echo $img[$i]; ?>"> -->
		           				<a href="<?php echo HOME_URL; ?>/<?php echo $hinh['slug'];?>">
		           			<?php } } }?>
		           				<img src="<?php echo HOME_URL; ?>/uploads/gallery/355x204<?php echo $hinh['img'] ?>" style="width: 100%;" />

		           				<div class="namehinhanh animationnormal line-clamp-1"> <?php echo $hinh['name'] ?></div>
		           				<div class="namehinhanh2 animationnormal line-clamp-1"> <?php echo $hinh['name'] ?></div>
		           			</a>
		           			<!-- <?php
			                    foreach($img as $hinhcon){
			                ?>
			                    <a rel="gallery-group-<?php echo $hinh['upload_id'] ?>" title="" href="<?php echo HOME_URL; ?>/uploads/photos/full_<?php echo $hinhcon ?>" style="display:none;"></a>
			                <?php } ?> -->
			                <!-- <script>
			                	$("a[rel=group<?php echo $hinh['upload_id'] ?>]").fancybox({
			                        helpers : { 
			                            title : { type : 'over' }
			                        },
			                        beforeShow : function() {
			                            this.title = (this.title ? '' + this.title + '' : '') + 'Hình ' + (this.index + 1) + ' / ' + (this.group.length - 1);
			                        }
			                    });
		                	</script>  --> 
			        	</div>
		           <?php } ?>
				</div>
				<div id="video" class="animationfast tab-pane fade">
					<div class="row">
		                <?php
		                    $db->table = "gallery";
		                    $db->condition = "`is_active` = 1 AND gallery_menu_id = 108";
		                    $db->order = "created_time DESC";
		                    $db->limit = "12";
		                    $videos=$db->select();
		                    $i=0;
		                    foreach($videos as $video){
		                        $links = $video['link'];
					            $link = getYoutubeVideo($links);
					            $link1 = 'https://www.youtube.com/embed/'.$link;
		                ?>
	                        <div class="col-md-4 col-sm-4 col-xs-6 itemvideo">
	                            <div id="player" class="video-home"> 
						            <iframe id="ytplayer" src="https://www.youtube.com/embed/<?php echo $link;?>?rel=0&amp;autoplay=0&amp;mute=1&amp;controls=1&amp;showinfo=0&amp;loop=1&amp;playlist=<?php echo $link; ?>&amp;iv_load_policy=3&amp;enablejsapi=1?rel=0&amp;autoplay=0&amp;mute=1&amp;controls=1&amp;showinfo=0&amp;loop=1&amp;iv_load_policy=3&amp;enablejsapi=1" frameborder="0" ></iframe>
						        </div>
	                            <div class="namevideo line-clamp-1 animationnormal">
	                                <?php echo $video['name']; ?>
	                            </div>
	                            <div class="commentvideo line-clamp-2" style="max-height: 40px;">
	                                <?php echo $video['comment']; ?>
	                            </div>
	                        </div>
		                <?php } ?>
		            </div>
				</div>
				<div id="anpham" class="animationfast tab-pane fade">
					<head>
						<meta charset="UTF-8" />
						<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
						<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
						<title>Book Preview with BookBlock</title>
						<meta name="description" content="Book Preview with BookBlock" />
						<meta name="keywords" content="BookBlock, book preview, look inside, css, transforms, animations, css3, 3d, perspective, fullscreen" />
						<meta name="author" content="Codrops" />
						<link rel="shortcut icon" href="../favicon.ico">
						<link rel="stylesheet" type="text/css" href="<?php echo HOME_URL ?>/css/book/normalize.css" />
						<link rel="stylesheet" type="text/css" href="<?php echo HOME_URL ?>/css/book/demo.css" />
						<link rel="stylesheet" type="text/css" href="<?php echo HOME_URL ?>/css/book/bookblock.css" />
						<link rel="stylesheet" type="text/css" href="<?php echo HOME_URL ?>/css/book/component.css" />
						<script src="<?php echo HOME_URL ?>/js/book/modernizr.custom.js"></script>
					</head>
					<body>
						<div id="scroll-wrap" class="container nerbook">
							<div class="main">
								<div id="bookshelf" class="bookshelf desktop">
									<?php 
										$db->table = "gallery";
										$db->condition = "is_active = 1 and gallery_menu_id= 105";
										$db->order = "created_time DESC";
										$db->limit = "";
										$rowanpham=$db->select();
								        foreach($rowanpham as $anpham){
								    ?>
								    <!-- 355x204 -->
						        		<figure>
											<div class="book" data-book="<?php echo $anpham['gallery_id'] ?>"
												style="background: url(/uploads/gallery/full_<?php echo $anpham['img'] ?>);background-size:cover;">
											</div>
											<div class="buttons"><a href="#"><?= $doc;?></a><a href="#"><?= $mt;?></a></div>
											<figcaption><h3 class="nameaph"><?php echo $anpham['name'] ?></span></h3></figcaption>
											<div class="details">
												<ul>
													<li class="motaanpham line-clamp-4">
														<?php echo $anpham['comment'];?>
													</li>
													<li>Copyright by Phuc Dai Viet</li>
												</ul>
											</div>
										</figure>
								    <?php } ?>
								</div>
								<div id="bookshelf" class="bookshelf mobile" style="display: none;">
									<?php 
										$db->table = "gallery";
										$db->condition = "is_active = 1 and gallery_menu_id= 105";
										$db->order = "created_time DESC";
										$db->limit = "";
										$rowanpham=$db->select();
								        foreach($rowanpham as $anpham)
								        {
								        	?>
								        		<figure>
													<div class="book" data-book="<?php echo $anpham['gallery_id'] ?>mobile"
														style="background: url(/uploads/gallery/355x204<?php echo $anpham['img'] ?>);background-size: 100% 100%;">
															
													</div>
													<div class="buttons"><a href="#">Đọc</a><a href="#">Mô tả</a></div>
													<figcaption><h3><?php echo $anpham['name'] ?></span></h3></figcaption>
													<div class="details">
														<ul>
															<li class="motaanpham line-clamp-4">
																<?php echo $anpham['comment']; ?>
															</li>
															<li>Copyright by Phuc Dai Viet</li>
														</ul>
													</div>

												</figure>

								        	<?php
								        }
									?>
									
									
								</div>
							</div><!-- /main -->
						</div><!-- /container -->
						<style type="text/css">
							.book div{ display: none; }
						</style>
						<!-- Fullscreen BookBlock -->
						<!-- for demo purpose we repeat each bookblock -->
						<?php 
							foreach($rowanpham as $anpham){
								$i=0;
					           	$list_img = "";
					           	$db->table = "uploads_tmp";
					           	$db->condition = "upload_id = ".($anpham['upload_id']+0);
					           	$db->order = "";
					          	$db->limit = "";
					          	$rows_gal = $db->select();
					           	foreach ($rows_gal as $row_gal){
					               $list_img = $row_gal['list_img'];

						        }
						        $img = explode(";",$list_img);
						?>
				        	<div class="bb-custom-wrapper desktop" id="<?php echo $anpham['gallery_id'] ?>">
								<div class="bb-bookblock">
									<div class="bb-item">
										<div class="bb-custom-side page-layout-3" style="position: relative;">
											<div class="logoanpham" style="padding:0">
												<img src="/images/logo.png">
											</div>
										</div>
										<div class="bb-custom-side page-layout-3" style="position: relative;">
											<img src="/uploads/gallery/739x726<?php echo $anpham['img'] ?>" class="trangbia">
											<div class="nameanphanchitiet line-clamp-1">
												<?php echo $anpham['name'] ?>
											</div>
										</div>
									</div>
									<div class="bb-item">
										<?php 
											$i=0;
											foreach($img as $trangcon){
												if($trangcon != ""){
													if($i==2){
														$i=0;
														echo '</div><div class="bb-item">';
													}
										?>
											<div class="bb-custom-side page-layout-1">
													<img class="trangcon" style="" src="/uploads/photos/739x726<?php echo $trangcon ?>">
											</div>
										<?php $i++; } } ?>
									</div>
								</div><!-- /bb-bookblock -->
								<nav>
									<a href="#" class="bb-nav-prev">Previous</a>
									<a href="#" class="bb-nav-next">Next</a>
									<a href="#" class="bb-nav-close">Close</a>
								</nav>
							</div><!-- /bb-custom-wrapper -->
							<div class="bb-custom-wrapper mobile" id="<?php echo $anpham['gallery_id'] ?>mobile">
								<div class="bb-bookblock">
									<div class="bb-item">
										<div class="bb-custom-side page-layout-3" style="position: relative;">
											<div class="logoanpham" style="padding:0">
												<img src="/images/lunacy/logo.svg">
											</div>
										</div>
									</div>
									<div class="bb-item">
										<div class="bb-custom-side page-layout-3" style="position: relative;">
											<img src="/uploads/gallery/trangchu-<?php echo $anpham['img'] ?>" class="trangbia">
											<div class="nameanphanchitiet line-clamp-1">
												<?php echo $anpham['name'] ?>
											</div>
										</div>
									</div>
									<?php 
										foreach($img as $trangcon){
											if($trangcon != ""){
									?>
										<div class="bb-item">
											<div class="bb-custom-side page-layout-1">
												<img class="trangcon" style="" src="/uploads/photos/chitietanpham_<?php echo $trangcon ?>">
											</div>
										</div>
									<?php } } ?>
								</div><!-- /bb-bookblock -->
								<nav>
									<a href="#" class="bb-nav-prev">Previous</a>
									<a href="#" class="bb-nav-next">Next</a>
									<a href="#" class="bb-nav-close">Close</a>
								</nav>
							</div><!-- /bb-custom-wrapper -->
				        <?php } ?>
						<script src="<?php echo HOME_URL ?>/js/book/bookblock.min.js"></script>
						<script src="<?php echo HOME_URL ?>/js/book/classie.js"></script>
						<script src="<?php echo HOME_URL ?>/js/book/bookshelf.js"></script>
					</body>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    $('.menutab a').click(function(){
        $('.menutab a').removeClass('active');
        $(this).addClass('active');
    });
</script>
<!-- <?php 
	if($_GET['tabopen'] != ""){
		$idopen=$_GET['tabopen'];
?>
	<script type="text/javascript">
		// alert("<?php echo $idopen; ?>");
		$("#button<?php echo $idopen; ?>").triggerHandler('click');
		$(".tab-content div").removeClass('in');
		$(".tab-content div").removeClass('active');
		$("#<?php echo $idopen; ?>").addClass('in');
		$("#<?php echo $idopen; ?>").addClass('active');
	</script>
<?php } ?> -->