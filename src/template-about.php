<?php /* Template Name: About Us Template */ get_header(); ?>	
	<main role="main" aria-label="Content">
		<section id="heading" style="background-image: url(<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail')[0]; ?>)">
			<h1><?php echo the_title() ?></h1>
		</section>

		<section class="intro">
			<div class="inner">
				<div class="col1">
					<?php 
						while( have_rows('main_content') ) : the_row();
							$title = get_sub_field('title');
							$body = get_sub_field('body');
							$logo1 = get_sub_field('logo1');
							$logo2 = get_sub_field('logo2');

							echo '<h2>' . $title . '</h2>'.
								'<p>' . $body . '</p>';
						endwhile;
					?>
				</div>
				<div class="col2">
					<img src="<?php echo $logo1 ?>" alt="Innovatech">
					<img src="<?php echo $logo2 ?>" alt="BZI">
				</div>
			</div>
		</section>

		<section class="team">
			<div class="inner">
				<h2><span class="gold">The</span> Innovatech Team</h2>
				<?php 
					while( have_rows('team_members') ) : the_row();
						$name = get_sub_field('member_name');
						$title = get_sub_field('member_title');
						$bio = get_sub_field('member_bio');
						$photo = get_sub_field('member_photo');

						echo '<div class="bio">'.
							'	<div class="img">'.
							'		<img class="full-width" src="' . $photo . '" alt="' . $name . '">'.
							'	</div>'.
							'	<div class="content">'.
							'			<h3>' . $name . '</h3>'.
							'			<h4>' . $title . '</h4>'.
							$bio .
							'	</div>'.
							'</div>';
					endwhile;
				?>
			</div>
		</section>

		<section class="partners">
			<script>
				var arrParterData = new Array();
				<?php 
					while( have_rows('partners') ) : the_row();
						$title = get_sub_field('partner_title');
						$desc = get_sub_field('partner_description');
						echo 'arrParterData.push({title:"' . $title . '", desc:"' . $desc . '"});';
					endwhile;
				?>
				$(document).ready(function(){
					$('.partners-outer li').click(function(){
						$('.partners-outer li').removeClass('active');
						$(this).addClass('active');
						
						var idx = $(this).index();
						$('#partner-title, #partner-desc').hide();
						$('#partner-title').text(arrParterData[idx].title);
						$('#partner-desc').text(arrParterData[idx].desc);
						$('#partner-title, #partner-desc').fadeIn('fast');
					});
				});
			</script>
			<div class="inner">
				<h2><span class="gold">Our</span> Partners</h2>
				<div class="partners-outer">
					<ul>
					<?php 
						while( have_rows('partners') ) : the_row();
							$title = get_sub_field('partner_title');
							$logo = get_sub_field('partner_logo');
							$index = get_row_index();
							$activeClass = ($index == 1)?'active':'';

							echo '<li class="' . $activeClass . '"><img src="' . $logo . '" alt="' . $title . '"><div class="gradient-bar"></div></li>';
						endwhile;
					?>
					</ul>
					<h3 id="partner-title">Xtreme Manufacturing</h3>
					<p id="partner-desc">Xtreme Manufacturing offers the largest product line of rough terrain telescopic handlers (telehandlers) in North America. Spanning 15 models, with lifting capacities ranging from 5,900 lbs. (2,676kg) to 70,000 lbs. (31,751kg), and maximum lift heights of up to 70 ft. Doing business differently made Xtreme Manufacturing instantly distinguishable and respected within the industry in 2003 with a customer-focused and reputation-first perspective.</p>
				</div>
			</div>
		</section>
	</main>

<?php get_footer(); ?>