<?php /* Template Name: Our Process Template */ get_header(); ?>	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
	<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

	<script>
		$(document).ready(function(){
			var slider = $('#image-slider').bxSlider({
				pager: false,
				controls: false,
				auto: true,
				speed: 1200,
				pause: 5000,
				onSlideBefore: function($elem, oldIdx, newIdx){
					$('#text-items div.active').removeClass('active').delay(200).hide(0);
					$('#text-items').find('div').eq(newIdx).show(0).addClass('active');

					$('#slider-nav li').removeClass('active');
					$('#slider-nav').find('li').eq(newIdx).toggleClass('active');
				}
			});
		});
	</script>
	
	<main role="main" aria-label="Content">
		<section id="heading" style="background-image: url(<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail')[0]; ?>)">
			<h1><?php the_title() ?></h1>
		</section>

		<section class="videos">
			<?php 
				while( have_rows('process') ) : the_row();
					$title = get_sub_field('title');
					$desc = get_sub_field('description');
					$videoUrl = get_sub_field('video_url');
					$image = get_sub_field('image');
					$index = get_row_index();

					if($index == 1){
						echo '<div class="pannel' . $index . '">'.
							'	<div class="inner">'.
							'		<div class="number">0' . $index . '</div>'.
							'		<h2>' . $title . '</h2>'.
							'		<div class="gradient-bar gold"></div>'.
							'		<div class="col1">'.
							'			<p>' . $desc . '</p>'.
							'			<div class="plus"><img src="' . esc_url( get_template_directory_uri()) . '/img/process-plus1.png" alt="plus"></div>'.
							'		</div>'.
							'		<div class="col2">'.
							'			<img src="' . $image . '" alt="' . $title . '">';
							if($videoUrl != ''){
								echo '			<a class="gradient-gold" href="#video1" uk-toggle>Play Video</a>';
							}
							echo '		</div>'.
							'	</div>'.
							'	<div id="video1" class="uk-flex-top" uk-modal>'.
							'		<div class="uk-modal-dialog uk-width-auto uk-margin-auto-vertical">'.
							'			<button class="uk-modal-close-outside" type="button" uk-close></button>'.
							'			<iframe width="1280" height="720" src="' . $videoUrl . '" uk-video uk-responsive title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>'.
							'		</div>'.
							'	</div>'.
							'</div>';
					}elseif($index == 2){
						echo '<div class="pannel' . $index . '">'.
							'	<div class="inner">'.
							'		<div class="col2">'.
							'			<div class="number">0' . $index . '</div>'.
							'			<h2>' . $title . '</h2>'.
							'			<div class="gradient-bar gold"></div>'.
							'			<p>' . $desc . '</p>'.
							'			<div class="plus"><img src="' . esc_url( get_template_directory_uri()) . '/img/process-plus2.png" alt="plus"></div>'.
							'		</div>'.
							'		<div class="col1">'.
							'			<img src="' . $image . '" alt="' . $title . '">';
							if($videoUrl != ''){
								echo '			<a class="gradient-gold" href="#video2" uk-toggle>Play Video</a>';
							}
							echo '		</div>'.
							'	</div>'.
							'	<div id="video2" class="uk-flex-top" uk-modal>'.
							'		<div class="uk-modal-dialog uk-width-auto uk-margin-auto-vertical">'.
							'			<button class="uk-modal-close-outside" type="button" uk-close></button>'.
							'			<iframe width="1280" height="720" src="' . $videoUrl . '" uk-video uk-responsive title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>'.
							'		</div>'.
							'	</div>'.
							'</div>';
					}else{
						echo '<div class="pannel' . $index . '">'.
							'	<div class="inner">'.
							'		<div class="number">0' . $index . '</div>'.
							'		<h2>' . $title . '</h2>'.
							'		<div class="gradient-bar white"></div>'.
							'		<div class="col1">'.
							'			<p>' . $desc . '</p>'.
							'			<div class="plus"><img src="' . esc_url( get_template_directory_uri()) . '/img/process-plus1.png" alt="plus"></div>'.
							'		</div>'.
							'		<div class="col2">'.
							'		<img src="' . $image . '" alt="' . $title . '">';
							if($videoUrl != ''){
								echo '			<a class="gradient-gold" href="#video3" uk-toggle>Play Video</a>';
							}
							echo '		</div>'.
							'	</div>'.
							'	<div id="video3" class="uk-flex-top" uk-modal>'.
							'		<div class="uk-modal-dialog uk-width-auto uk-margin-auto-vertical">'.
							'			<button class="uk-modal-close-outside" type="button" uk-close></button>'.
							'			<iframe width="1280" height="720" src="' . $videoUrl . '" uk-video uk-responsive title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>'.
							'		</div>'.
							'	</div>'.
							'</div>';
					}
				endwhile;
			?>
		</section>
	</main>

<?php get_footer(); ?>