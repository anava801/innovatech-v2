<?php /* Template Name: News Template */ get_header(); ?>	
	<main role="main" aria-label="Content">
		<section id="heading" style="background-image: url(<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail')[0]; ?>)">
			<h1><?php echo the_title() ?></h1>
		</section>

		<section class="featured">
			<div class="inner">
				<h2><span class="gold">Featured</span> Story</h2>
				<div class="featured-outer">
					<?php
						$featuredPost = get_field('featured_post');
						$featuredPostImage = get_the_post_thumbnail_url($featuredPost->ID, 'full');
						$readTimeInMinutes = round(str_word_count($featuredPost->post_content)/200);
						$readTimeInMinutes = ($readTimeInMinutes == 0) ? 1 : $readTimeInMinutes;
						$category = get_the_category($featuredPost->ID)[0]->name;
						$categoryId = get_the_category($featuredPost->ID)[0]->cat_ID;
						//print_r(get_the_category($featuredPost->ID));
					?>
					<article class="post featured">
						<?php 
							if($featuredPostImage != ''){
						?>
						<img src="<?php echo $featuredPostImage ?>" alt="">
						<?php
							}
						?>
						<div class="post-meta">
							<div class="date"><?php echo date("M j, Y", strtotime($featuredPost->post_date)) ?></div>
							<div class="category"><a href="<?php echo get_category_link($categoryId) ?>"><?php echo $category ?></a></div>
							<div class="read-time"><?php echo $readTimeInMinutes ?> Minute Read</div>
						</div>
						<h3><a href="<?php echo get_permalink($featuredPost->ID) ?>"><?php echo $featuredPost->post_title ?></a></h3>
						<div class="divider"></div>
						<p><?php echo wp_trim_words( $featuredPost->post_content, 28, '...' ) ?></p>
						<a class="read-more" href="<?php echo get_permalink($featuredPost->ID) ?>">READ MORE</a>
					</article>
					
				</div>

				<div class="posts-outer">
					<?php
						$args = array('numberposts' => 100, 'post_type' => 'news');
						$posts = get_posts($args);
						foreach ($posts as $post){
							if($post->ID == $featuredPost->ID) continue;
							$postImage = get_the_post_thumbnail_url($post->ID, 'full');
							$readTimeInMinutes = round(str_word_count($post->post_content)/200);
							$category = get_the_category($post->ID)[0]->name;
							$categoryId = get_the_category($post->ID)[0]->cat_ID;
							echo '<article class="post">';
							if($postImage != '') echo '	<div class="img"><img src="'. $postImage . '" alt=""></div>';
							echo '	<div class="post-meta">'.
								'		<div class="date">'. date("M j, Y", strtotime($post->post_date)) . '</div>'.
								'		<div class="category"><a href="' . get_category_link($categoryId) . '">'. $category . '</a></div>'.
								'		<div class="read-time">'. $readTimeInMinutes . ' Minute Read</div>'.
								'	</div>'.
								'	<h3><a href="'. get_permalink($post->ID) . '">'. $post->post_title . '</a></h3>'.
								'	<div class="divider"></div>'.
								'	<a class="read-more" href="'. get_permalink($post->ID) . '">READ MORE</a>'.
								'</article>';
						}
					?>
				</div>
			</div>
		</section>
	</main>

<?php get_footer(); ?>