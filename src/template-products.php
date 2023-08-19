<?php /* Template Name: Products Template */ get_header(); ?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
	<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

	<!-- UIkit -->
	<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()) ?>/css/uikit.css" />
	<script src="https://cdn.jsdelivr.net/npm/uikit@3.15.12/dist/js/uikit.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/uikit@3.15.12/dist/js/uikit-icons.min.js"></script>

	<script>
		var slider;
		$(document).ready(function(){
			slider = $('#slider-wrapper').bxSlider({
				pager: true,
				controls: false,
				auto: true
			});
		});
	</script>

	<script>
		$(document).ready(function(){
			$('.tabs li').click(function(){
				$('.tabs li').removeClass('active');
				$(this).addClass('active');
				$('.tab-content').hide();
				$('.tab-content').eq($(this).index()).show();
			});
		});

		// $(window).resize(function(){
		// 	if($(window).outerWidth() < 850){
		// 		$('.resource').each(function(){
		// 			var videoElem = $(this).find('.col2 .video-wrapper').detach();
		// 			$(this).find('.col1 .mobile-video').append(videoElem);
		// 		});
		// 	}else{
		// 		$('.resource').each(function(){
		// 			var videoElem = $(this).find('.col1 .mobile-video .video-wrapper').detach();
		// 			$(this).find('.col2').append(videoElem);
		// 		});
		// 	}
		// });
	</script>
	<main role="main" aria-label="Content">
		<section class="intro">
			<?php 
				$heading1 = get_field('heading_1');
				$heading2 = get_field('heading_2');
				$body = get_field('body');
				$image = get_field('intro_image');
				$documentation = get_field('documentation');
			?>
			<div class="inner">
				<div class="col2">
					<img src="<?php echo $image ?>" alt="<?php echo $heading2 ?>">
				</div>
				<div class="col1">
					<h2><?php echo $heading1 ?></h2>
					<h1><?php echo $heading2 ?></h1>
					<div class="divider"></div>
					<p><?php echo $body ?></p>
					<a class="gold" href="/contact-us">Request A Quote</a>
					<a href="<?php echo $documentation ?>">Documentation</a>
				</div>
			</div>
		</section>

		<section class="case-study">
			<?php 
				$challenge = get_field('challenge');
				$solution = get_field('solution');
				$image = get_field('casestudy_image');
				$video = get_field('embed_code');
			?>
			<div class="inner">
				<div class="col1">
					<?php
						if($video != ''){
							echo '	<div id="video1" class="uk-flex-top" uk-modal>'.
								'		<div class="uk-modal-dialog uk-width-auto uk-margin-auto-vertical">'.
								'			<button class="uk-modal-close-outside" type="button" uk-close></button>'.
								'			<iframe width="1100" height="540" src="' . $video . '" uk-video uk-responsive title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>'.
								'		</div>'.
								'	</div>'.
								'	<div class="thumbnail"><a href="#video1" uk-toggle><img src="' . $image . '" alt="case study"><img class="play-icon" src="' . esc_url(get_template_directory_uri()) . '/img/icons/circle-play.svg"></a></div>';
						}else{
							echo '<img src="' . $image . '" alt="case study">';
						}
					?>
				</div>
				<div class="col2">
					<h3>Challenge</h3>
					<p><?php echo $challenge ?></p>
					
					<h3>Solution</h3>
					<p><?php echo $solution ?></p>
				</div>
			</div>
		</section>

		<script>
			$(document).ready(function(){
				$('#interactive .item').click(function(e){
					var idx = $(this).index();
					$('#interactive .item').removeClass('active');
					$(this).addClass('active');
					$('#interactive-outer, #gallery-outer').removeClass('active');

					$('#interactive .background').removeClass('right');
					if(idx == 2) $('#interactive .background').addClass('right');

					if(idx == 1){
						$('#interactive-outer').addClass('active');
						$('#video')[0].play();
						//$('.bx-controls').hide();
						$('.interactive-nav').show();
					}else{
						$('#gallery-outer').addClass('active');
						//$('.bx-controls').show();
						$('.interactive-nav').hide();
						slider.reloadSlider();
						resetVideo();
					}
				});

				$('.interactive-nav li').click(function(e){
					var skipTo = $(this).attr('data-skip');
					$('#video')[0].currentTime = skipTo;
					$('#video')[0].play();

					$('.interactive-nav li').removeClass('active');
					$(this).addClass('active');
				});

				$('#video')[0].ontimeupdate = function() {
					var currentTime = $('#video')[0].currentTime;
					$('.interactive-nav li').each(function(idx){
						var li = $('.interactive-nav li').eq(idx);
						if(currentTime > $(li).attr('data-skip')){
							$('.interactive-nav li').removeClass('active');
							$(li).addClass('active');
						}
					});
				};
			}); 

			function resetVideo(){
				$('.interactive-nav li').removeClass('active');
				$('.interactive-nav li').eq(1).addClass('active');
				$('#video')[0].pause();
				$('#video')[0].currentTime = 0;
			}
		</script>
		<section class="gallery">
			<div class="inner">
				<?php 
					$showInteractive = get_field("video") ? true : false;
				?>
				
				<?php if($showInteractive) :?>
					<div id="interactive-outer" class="active">
						<div class="video-wrapper">
							<video autoplay muted id="video" src="<?php echo get_field("video") ?>"></video>
						</div>
					</div>
				<?php endif; ?>

				<div id="gallery-outer" <?php if(!$showInteractive) { echo 'class="active"'; }?>>
					<div id="slider-wrapper">
						<?php
							$playbackPointCount = 0;
							while( have_rows('images') ) : the_row();
								$image = get_sub_field('image');
								echo '<img src="'. $image .'" alt="gallery">';
							endwhile;
						?>
						<!-- <img src="<?php //echo esc_url(get_template_directory_uri()) ?>/img/Frame 202.jpg" alt=""> -->
					</div>
				</div>

				<ul class="interactive-nav">
					<?php
						$playbackPointCount = 0;
						while( have_rows('playback_points') ) : the_row();
							$seconds = get_sub_field('seconds');
							$activeClass = "";
							if($playbackPointCount==0) $activeClass = 'class="active"';
							$label = $playbackPointCount+1;
							echo '<li data-skip="'. $seconds .'" '. $activeClass .'>'. $label .'</li>';
							$playbackPointCount++;
						endwhile;
					?>
				</ul>

				<?php
					if($showInteractive){
				?>
				<div class="interactive-switch-outer">
					<div id="interactive">
						<div class="item background">&nbsp;</div>
						<?php if($showInteractive) :?>
							<div class="item active">Interactive</div>
						<?php endif; ?>
						<div class="item" <?php if(!$showInteractive) { echo 'class="active"'; }?>>Gallery</div>
					</div>
				</div>
				<?php
					}
				?>
			</div>
		</section>

		<section class="features">
			<?php 
				$features = get_field('features');
				$specs = get_field('specifications');
				$formName = get_field('form_name');
			?>
			<div class="inner">
				<ul class="tabs">
					<li class="active">Features</li>
					<li>Specifications</li>
				</ul>

				<div class="content">
					<div class="col1">
						<div id="group1" class="tab-content">
							<h3>Features</h3>
							<?php echo $features ?>
						</div>
						<div id="group2" class="tab-content">
							<h3>Specifications</h3>
							<?php echo $specs ?>
						</div>
					</div>
					<div class="col2">
						<h3>Request a Quote</h3>
						<?php gravity_form( 'Request A Quote', false, false, false, '', true ); ?>
					</div>
				</div>
			</div>
		</section>

		<section class="quote">
			<?php 
				$quote = get_field('quote');
				$name = get_field('name');
				$title = get_field('title');
				$image = get_field('quote_image');
			?>
			<div class="inner">
				<div class="col1">
					<img src="<?php echo $image ?>" alt="case study">
				</div>
				<div class="col2">
					<h3>"<?php echo $quote ?>"</h3>
					<p class="name"><?php echo $name ?></p>
					<p class="title"><?php echo $title ?></p>
				</div>
			</div>
		</section>
	</main>

<?php get_footer(); ?>