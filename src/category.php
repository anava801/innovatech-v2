<?php get_header(); ?>

	<section>
		<div class="inner">
			<h1>Topic - <?php echo get_the_category()[0]->name ?></h1>
			<div class="posts-outer">
				<div class="posts">
					<?php
						$categoryId = get_category(get_query_var('cat'))->cat_ID;
						$args = array('numberposts' => 100, 'category' => $categoryId);
						$posts = get_posts($args);
						foreach ($posts as $post){
							$postImage = get_the_post_thumbnail_url($post->ID, 'full');
							$readTimeInMinutes = round(str_word_count($post->post_content)/200);
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
					?>
				</div>
			</div>
		</div>
	</section>

<?php get_footer(); ?>
