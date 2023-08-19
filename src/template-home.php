<?php /* Template Name: Home Page Template */ get_header(); ?>	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
	<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

	<script>
		var slideAnimComplete = true;
		
		$(document).ready(function(){
			var slider = $('#image-slider').bxSlider({
				pager: false,
				controls: false,
				auto: true,
				speed: 1200,
				pause: 5000,
				onSlideBefore: function($elem, oldIdx, newIdx){
					slideAnimComplete = false;

					$('#text-items div.active').removeClass('active').hide(0);
					$('#text-items').find('div').eq(newIdx).show(0).addClass('active');

					$('#slider-nav li').removeClass('active');
					$('#slider-nav').find('li').eq(newIdx).toggleClass('active');
				},
				onSlideAfter:function($elem, oldIdx, newIdx){
					slideAnimComplete = true;
				}
			});

			$('#slider-nav li').click(function(){
				event.preventDefault();
				if(!slideAnimComplete) return;
				var idx = $(this).index();
				slider.stopAuto();
				slider.startAuto();
				slider.goToSlide(idx);
			});

			$('#text-items div').hide(0);
			$('#text-items').find('div').eq(0).show(0).addClass('active');
		});
	</script>
	
	<main role="main" aria-label="Content">
		<section id="slider">
			<div id="image-slider">
				<?php 
					while( have_rows('silder') ) : the_row();
						$image = get_sub_field('image');
						$line2 = get_sub_field('line2');

						echo '<img src="' . $image . '" alt="' . $line2 . '">';
					endwhile;
				?>
			</div>

			<div id="slider-text">
				<div id="text-items">
					<?php 
						while( have_rows('silder') ) : the_row();
							$line1 = get_sub_field('line1');
							$line2 = get_sub_field('line2');
							$line3 = get_sub_field('line3');
							$btnLabel = get_sub_field('button_label');
							$btnLink = get_sub_field('button_link');
							$textPosition = strtolower(get_sub_field('text_position'));
							$colorScheme = strtolower(get_sub_field('color_scheme'));
							$index = get_row_index();
							$activeClass = ($index == 1)?'active':'';
							
							echo '<div class="' . $activeClass . ' ' . $colorScheme . ' ' . $textPosition . '">'.
								'	<h2>' . $line1 . '</h2>'.
								'	<h3>' . $line2 . '</h3>'.
								'	<p>' . $line3 . '</p>';
							if($btnLink != ''){
								echo '<a href="' . $btnLink . '">' . $btnLabel . '</a>';
							}
							echo '</div>'; 
						endwhile;
					?>
				</div>
			</div>

			<ul id="slider-nav">
				<?php 
					while( have_rows('silder') ) : the_row();
						$category = get_sub_field('category');
						$index = get_row_index();
						$activeClass = ($index == 1)?'active':'';

						echo '<li class="' . $activeClass . '">&nbsp;</li>';
					endwhile;
				?>
			</ul>
		</section>
		
		<section id="intro">
			<div class="inner">
				<p><?php the_content(); ?></p>
			</div>
		</section>

		<section id="innovations">
			<div class="inner">
				<h2>Our <span class="gold">Innovations</span></h2>
				<?php 
					while( have_rows('innovations') ) : the_row();
						$title = get_sub_field('title');
						$image = get_sub_field('image');
						$link = get_sub_field('link');
						$body = get_sub_field('body');
						$cssClass = (get_row_index() % 2 > 0) ? 'lr' : 'rl';

						echo '<div class="pannel ' . $cssClass . '">'.
							'	<div class="panne-inner">'.
							'		<div class="col-text">'.
							'			<h3>' . $title . '</h3>'.
							'			<p>' . $body . '</p>'.
							'			<a class="btn dark-fill" href="' . $link . '">Learn More</a>'.
							'		</div>'.
							'		<div class="col-img">'.
							'			<img src="' . $image . '" alt="' . $title . '">'.
							'		</div>'.
							'	</div>'.
							'</div>';
					endwhile;
				?>
			</div>
		</section>

		<section id="news">
			<div class="inner">
				<h2><span class="gold">Innovations</span> News</h2>
				<div class="news-items">
					<?php
						$query_args = array(  
							'post_type' => 'news',
							'post_status' => 'publish',
							'posts_per_page' => 3,
							'order' => 'DESC'
						);
						$loop = new WP_Query( $query_args );
						$newsItems = $loop->posts;
						$i = 0;
						foreach($newsItems as $newsItem){
							echo '<div class="news-item">';
							echo '<h4>' . $newsItem->post_title . '</h4>';
							echo '<p>' . wp_trim_words( $newsItem->post_content, 20, '...' ) . '</p>';
							echo '<a class="btn" href="/news?id=' . $newsItem->ID . '">More</a>';
							echo '</div>';

							$i++;
							if($i == 2) break;
							if($i < count($newsItems)){
								echo '<div class="divider"></div>';
							}
						}
					?>
				</div>
			</div>
		</section>
	</main>

<?php get_footer(); ?>