<?php get_header(); ?>

	<section>
		<div class="inner">
			<div class="featured-outer">
				<?php if ( have_posts() ) : while (have_posts() ) : the_post(); ?>
					<?php
						$featuredPost = $post;
						$featuredPostImage = get_the_post_thumbnail_url($featuredPost->ID, 'full');
						$readTimeInMinutes = round(str_word_count($featuredPost->post_content)/200);
						$readTimeInMinutes = ($readTimeInMinutes == 0) ? 1 : $readTimeInMinutes;
						$category = get_the_category($featuredPost->ID)[0]->name;
						$categoryId = get_the_category($featuredPost->ID)[0]->cat_ID;
					?>
					<article class="post page featured">
						<h3><?php echo $featuredPost->post_title ?></h3>
						<?php
							if($featuredPostImage != '') echo '<img src="'. $featuredPostImage .'" alt="' . $featuredPost->post_title . '">';
						?>
						<div class="post-meta">
							<div class="date"><?php the_time("M j, Y") ?></div>
							<div class="category"><a href="<?php echo get_category_link($categoryId) ?>"><?php echo $category ?></a></div>
							<div class="read-time"><?php echo $readTimeInMinutes ?> Minute Read</div>
						</div>
						<p><?php echo the_content() ?></p>

						<?php //comments_template(); ?>
					</article>

				<?php endwhile; ?>

				<?php else : ?>
					<article>
						<h1><?php esc_html_e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
					</article>
				<?php endif; ?>
			</div>
			<div class="full-width-arrow"><div class="arrow"></div></div>

			<div class="posts-outer">
				<?php
					
					$args = array('numberposts' => 4);	
					$argspress = array('numberposts' => 4, 'post_type' => 'pressnews',);
					$args = ('pressnews' == get_post_type() ?  $argspress : $args);
					
					$posts = get_posts($args);
					$count = count($posts);
					if ($count > 3) {
						foreach ($posts as $post){
							$postImage = get_the_post_thumbnail_url($post->ID, 'full');
							$readTimeInMinutes = round(str_word_count($post->post_content)/200);
							$readTimeInMinutes = ($readTimeInMinutes == 0) ? 1 : $readTimeInMinutes;
							$category = get_the_category($post->ID)[0]->name;
							$categoryId = get_the_category($post->ID)[0]->cat_ID;
							echo '<article class="post">'.
								'	<div class="img"><img src="'. $postImage . '" alt=""></div>'.
								'	<div class="post-meta">'.
								'		<div class="date">'. date("M j, Y", strtotime($post->post_date)) . '</div>'.
								'		<div class="category"><a href="' . get_category_link($categoryId) . '">'. $category . '</a></div>'.
								'		<div class="read-time">'. $readTimeInMinutes . ' Minute Read</div>'.
								'	</div>'.
								'	<h3><a href="'. get_permalink($post->ID) . '">'. $post->post_title . '</a></h3>'.
								'	<div class="divider"></div>'.
								'	<a class="read-more" href="'. get_permalink($post->ID) . '">READ MORE</a>'.
								'</article>';
						}
					}
				?>
			</div>
		</div>
	</section>

<?php get_footer(); ?>
