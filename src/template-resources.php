<?php /* Template Name: Resources Template */ get_header(); ?>
	<script>
		$(document).ready(function(){
			$('.documentation-container h4').click(function(){
				event.preventDefault();
				$(this).parent().find('ul').slideToggle();
				$(this).toggleClass('open');
			});

			$('.tabs li').click(function(){
				$('.tabs li').removeClass('active');
				$(this).addClass('active');
				$('.tab-content').hide();
				$('.tab-content').eq($(this).index()).show();
			});
		});

		$(window).resize(function(){
			if($(window).outerWidth() < 850){
				$('.resource').each(function(){
					var videoElem = $(this).find('.col2 .video-wrapper').detach();
					$(this).find('.col1 .mobile-video').append(videoElem);
				});
			}else{
				$('.resource').each(function(){
					var videoElem = $(this).find('.col1 .mobile-video .video-wrapper').detach();
					$(this).find('.col2').append(videoElem);
				});
			}
		});
	</script>

	<main role="main" aria-label="Content">
		<section id="heading" style="background-image: url(<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail')[0]; ?>)">
			<h1><?php echo the_title() ?></h1>
		</section>

		<section class="main">
			<div class="inner">
				<ul class="tabs">
					<li class="active"><?php echo get_field('tab_label_1') ?></li>
					<li><?php echo get_field('tab_label_2') ?></li>
				</ul>

				<div id="group1" class="tab-content">
				<?php 
						while( have_rows('group_1_items') ) : the_row();
							$title = get_sub_field('title');
							$desc = get_sub_field('description');
							$video = get_sub_field('video_embed');
							$videoId = substr($video, strripos($video, '/')+1);

							echo '<div class="resource">'.
								'<h2>' . $title . '</h2>'.
								'<div class="divider"></div>'.
								'<div class="content">'.
								'	<div class="col1">'.
								'		<h3>Product Overview</h3>'.
								'		<p>' . $desc . '</p>';
							if(have_rows('documentation')){
								echo '<div class="mobile-video"></div>'.
									'<div class="documentation-container">'.
									'	<h4>Documentation</h4>'.
									'	<ul class="list">';
								while( have_rows('documentation') ) : the_row();
									$title = get_sub_field('title');
									$file = get_sub_field('file');
		
									echo '<li><a href="' . $file . '" target="_blank">' . $title . '</a></li>';
								endwhile;
								echo '	</ul>'.
									'	</div>';
							}

							echo '	</div>'.
								'	<div class="col2">'.
								'		<div class="video-wrapper"><iframe width="560" height="315" src="https://www.youtube.com/embed/' . $videoId . '?autoplay=0" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>'.
								'	</div>'.
								'</div>'.
								'</div>';
						endwhile;
					?>
				</div>
				
				<div id="group2" class="tab-content">
					<?php 
						while( have_rows('group_2_items') ) : the_row();
						$title = get_sub_field('title');
						$desc = get_sub_field('description');

						echo '<div class="resource">'.
							'<h2>' . $title . '</h2>'.
							'<div class="divider"></div>'.
							'<div class="content">'.
							'	<div class="col-full">'.
							'		<p>' . $desc . '</p>';
						if(have_rows('documentation')){
							echo '<div class="mobile-video"></div>'.
								'<div class="documentation-container">'.
								'	<h4>Documentation</h4>'.
								'	<ul class="list">'.
								'	</ul>'.
								'	</div>';
						}

						echo '	</div>'.
							'</div>'.
							'</div>';
					endwhile;
					?>
				</div>
			</div>
		</section>
	</main>

<?php get_footer(); ?>