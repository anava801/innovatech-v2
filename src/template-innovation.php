<?php /* Template Name: Innovation Template */ get_header(); ?>	
<?php
	$parentId = $post->post_parent;
	$parentLink = get_permalink($parentId);
	$parentTitle = get_the_title($parentId);

	$documentation = get_field('document');
?>
	<main role="main" aria-label="Content">
		<section id="heading">
			<div class="inner">
				<h1><?php the_title(); ?></h1>
				<ul>
					<li><a href="<?php echo $parentLink ?>"><?php echo $parentTitle ?></a></li>
				</ul>
				<?php if($documentation != '') echo '<a class="btn no-fill" href="' . $documentation . '" target="_blank">Documentation</a>' ?>
			</div>
		</section>

		<section class="intro">
			<div class="inner">
				<div class="text">
					<?php the_content(); ?>
				</div>

				<div class="slider-nav">
					<!-- <a class="interactive" href="">Interactive Tour</a> -->
					<ul>
						<?php 
							while( have_rows('slides') ) : the_row();
								$image = get_sub_field('image');
								$index = get_row_index();
								$activeClass = ($index == 1)?'active':'';
								$label = ($index<10) ? '0'.$index : $index;
								echo '<li><a class="' . $activeClass . '" href="#">' . $label . '</a></li>'; 
							endwhile;
						?>
					</ul>
				</div>
			</div>
		</section>

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
		<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

		<script>
			var slider;
			var slideAnimComplete = true;
			$(document).ready(function(){
				slider = $('#image-slider').bxSlider({
					pager: false,
					controls: false,
					auto: true,
					speed: 1000,
					pause: 5000,
					onSlideBefore: function($elem, oldIdx, newIdx){
						slideAnimComplete = false;
						$('.slider-nav li a').removeClass('active');
						$('.slider-nav li').eq(newIdx).find('a').addClass('active');
					},
					onSlideAfter:function($elem, oldIdx, newIdx){
						slideAnimComplete = true;
					}
				});
			});

			$('.slider-nav li a').click(function(){
				event.preventDefault();
				if(!slideAnimComplete) return;
				var idx = $(this).parent().index();
				slider.stopAuto();
				slider.startAuto();
				slider.goToSlide(idx);
			});
		</script>
		<section id="slider">
			<div class="inner">
				<div id="image-slider">
					<?php 
						while( have_rows('slides') ) : the_row();
							$image = get_sub_field('slide_image');
							$index = get_row_index();
							echo '<img src="' . $image . '" alt="slide ' . $index . '">'; 
						endwhile;
					?>
				</div>
			</div>
		</section>

		<section id="casestudy">
			<div class="inner">
				<div class="col">
					<div class="gradient-bar gold"></div>
					<h3>Challenge</h3>
					<p><?php echo get_field('challenge') ?></p>
				</div>
				<div class="col">
					<div class="gradient-bar gold"></div>
					<h3>Solution</h3>
					<p><?php echo get_field('solution') ?></p>
				</div>
			</div>
		</section>

		<section id="quote">
			<div class="inner">
				<?php
					if(get_field('quote_image') != ''){
				?>
				<div class="img">
					<img src="<?php echo get_field('quote_image') ?>" alt="quote">
				</div>
				<?php
					}
				?>
				<div class="quote">
					<p><?php echo get_field('quote') ?></p>
					<div class="person">
						<strong><?php echo get_field('employee') ?></strong>
						<?php echo get_field('title') ?>
					</div>
				</div>
			</div>
		</section>

		<section id="related">
			<div class="inner">
				<h2>Related Innovations</h2>
				<?php 
					while( have_rows('innovations') ) : the_row();
						$title = get_sub_field('innovation_title');
						$image = get_sub_field('innovation_image');
						$link = get_sub_field('innovation_link');
						$body = get_sub_field('innovation_description');
						$cssClass = (get_row_index() % 2 > 0) ? 'lr' : 'rl';

						echo '<div class="pannel ' . $cssClass . '">'.
							'	<div class="panne-inner">'.
							'		<div class="col-text">'.
							'			<h3>' . $title . '</h3>'.
							'			<p>' . $body . '</p>'.
							'			<a class="btn no-fill" href="' . $link . '">Learn More</a>'.
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
	</main>

<?php get_footer(); ?>