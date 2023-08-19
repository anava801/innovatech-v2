<?php /* Template Name: Contact Us Template */ get_header(); ?>
<?php 
	while( have_rows('contact_info') ) : the_row();
		$phoneNumberSales = get_sub_field('sales_phone_number');
		$emailSales = get_sub_field('sales_email_address');
		$phoneNumberSupport = get_sub_field('support_phone_number');
		$emailSupport = get_sub_field('support_email_address');
		$bottomImage = get_fields()['bottom_image'];
	endwhile;
?>
	<main role="main" aria-label="Content">
	<section id="heading" style="background-image: url(<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail')[0]; ?>)">
			<h1><?php echo the_title() ?></h1>
		</section>

		<section class="intro">
			<div class="inner">
				<div class="col1">
					<h2>Contact Sales</h2>
					<div class="box">
						<img src="<?php echo esc_url( get_template_directory_uri()) ?>/img/cellphone-black.svg" alt="call">
						<?php echo $phoneNumberSales ?>
					</div>
					<div class="box">
						<img src="<?php echo esc_url( get_template_directory_uri()) ?>/img/email-black.svg" alt="email">
						<a href="mailto:<?php echo $emailSales ?>"><?php echo $emailSales ?></a>
					</div>
				</div>
				<div class="divider"></div>
				<div class="col2">
					<h2>Contact Support</h2>
					<div class="box">
						<img src="<?php echo esc_url( get_template_directory_uri()) ?>/img/cellphone-gold.svg" alt="call">
						<?php echo $phoneNumberSupport ?>
					</div>
					<div class="box">
						<img src="<?php echo esc_url( get_template_directory_uri()) ?>/img/email-gold.svg" alt="email">
						<a href="mailto:<?php echo $emailSupport ?>"><?php echo $emailSupport ?></a>
					</div>
				</div>
			</div>
		</section>

		<section class="form">
			<div class="inner">
				<div class="col1">
					<div class="col-inner">
						<h2>Request a Call</h2>
						<div class="divider"></div>
						<p>Ready to discuss our offerings, or to connect on a project? We’d love to hear from you.</p>
						<?php the_content(); ?>
					</div>
				</div>
				<div class="col2">
					<div class="col-inner">
						<div class="location-content">
							<h2>Our Location</h2>
							<div class="divider"></div>
							<p><?php echo get_field('address') ?></p>
							<a href="https://goo.gl/maps/5Dw7YUf9einvrmRU6" target="_blank">Open Map</a>
						</div>
						<iframe width="100%" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&height=600&hl=en&q=Innovatech+<?php echo urlencode(get_field('address')) ?>&t=&z=10&output=embed"></iframe>
					</div>
				</div>
			</div>
		</section>

		<section class="img">
			<img src="<?php echo $bottomImage ?>" alt="contact us">
		</section>
	</main>

<?php get_footer(); ?>