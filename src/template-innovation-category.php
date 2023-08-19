<?php /* Template Name: Innovation Category Template */ get_header(); ?>
	<main role="main" aria-label="Content">
		<section id="heading">
			<div class="inner">
				<h1><?php the_title(); ?></h1>
				<ul>
					<?php
						wp_list_pages(array(
							'depth' => 1,
							'child_of' => $post->post_parent,
							'exclude' => $post->ID,
							'title_li' => '',
						));					
					?>
				</ul>
			</div>
		</section>

		<section class="intro">
			<div class="inner">
				<div class="text">
					<?php the_content(); ?>
				</div>
			</div>
		</section>

		<section class="innovations">
			<div class="inner">
				<?php 
					while( have_rows('innovations') ) : the_row();
						$rowCount = count(get_field('innovations', $services));
						$index = get_row_index();
						$title = get_sub_field('title');
						$description = get_sub_field('description');
						$image = get_sub_field('image');
						$page = get_sub_field('page');

						echo '<div class="innovation">'.
							'	<div class="img">'.
							'		<img src="' . $image . '" alt="' . $title . '">'.
							'	</div>'.
							'	<div class="text">'.
							'		<h3>' . $title . '</h3>'.
							'		<p>' . $description . '</p>'.
							'		<a href="' . $page . '" class="btn no-fill">Learn More</a>'.
							'	</div>'.
							'</div>';
						
						if($index < $rowCount){
							echo '<div class="gradient-bar gray"></div>';
						}
					endwhile;
				?>
			</div>
		</section>
	</main>

<?php get_footer(); ?>