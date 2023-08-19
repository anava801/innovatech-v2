<?php
	$templateDir = esc_url( get_template_directory_uri());
?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<title><?php wp_title( '' ); ?><?php if ( wp_title( '', false ) ) { echo ' : '; } ?><?php bloginfo( 'name' ); ?></title>

		<!-- <script src="http://innovatech/livereload.js"></script> -->

		<link href="//www.google-analytics.com" rel="dns-prefetch">
		<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons/favicon.ico?v=1" rel="shortcut icon">
		<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons/touch.png?v=1" rel="apple-touch-icon-precomposed">
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

		<!-- UIkit -->
		<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()) ?>/css/uikit.css" />
		<script src="https://cdn.jsdelivr.net/npm/uikit@3.15.12/dist/js/uikit.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/uikit@3.15.12/dist/js/uikit-icons.min.js"></script>

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo( 'description' ); ?>">
		<?php //gravity_form_enqueue_scripts(2, true); ?>
		<!-- header -->
		<?php wp_head(); ?>
		<script>
			// conditionizr.com
			// configure environment tests
			conditionizr.config({
				assets: '<?php echo $templateDir; ?>',
				tests: {}
			});

			$(document).ready(function(){
				headerResized();
				resizeNav();
				//resizeFonts();

				$('#nav-icon4').click(function(){
					$(this).toggleClass('open');
					$('nav').toggleClass('open');
					$('main').toggleClass('no-scroll');
				});
			});

			$(window).resize(function(){
				headerResized();
				resizeNav();
				//resizeFonts();
			});

			$(document).scroll(function(){
				if($(window).outerWidth() <= 990){
					$('header').removeClass('header-below');
				}else{
					if($(window).scrollTop() > 10){
						$('header').addClass('header-below');
					}else{
						$('header').removeClass('header-below');
					}
					resizeNav();

				}
			});

			function resizeFonts(){
				if($(window).outerWidth() <= 1220){
					$('html').css('fontSize', ($(window).outerWidth()/1220 * 62.5) + '%');
				}
			}

			function headerResized(){
				var headerH = $('header').height();
				$('#header-spacer').height(headerH);
			}

			function resizeNav(){
				if($(window).outerWidth() <= 990){
					$('nav').css('height', '');
					$('nav > div > a').css('paddingTop','').css('paddingBottom','');
				}else{
					var logoH = $('.logo').height();
					var tNavH = $('#tertiary-nav').height();
					var linkH = $('nav > div > a').height();
					var navH = logoH - tNavH - linkH - 5;
					console.log(logoH + ':' + tNavH + ':' + linkH)
					$('nav').height(navH);
					
					$('nav > div > a').css('paddingTop', navH/2 - linkH/2).css('paddingBottom', navH/2 - linkH/2);
				}
			}
		</script>

	</head>
	<body <?php body_class(); ?>>
		<header class="header clear" role="banner">
			<div class="logo">
				<a href="<?php echo esc_url(home_url()); ?>">
					<h1><img src="<?php echo $templateDir ?>/img/logo2.svg" alt="Innovatech -  Engineered to do more." class="logo-img"></h1>
				</a>
			</div>

			<ul id="tertiary-nav">
				<?php
					$locations = get_nav_menu_locations();
					$menu = wp_get_nav_menu_object($locations['extra-menu']);
					$tertiaryMenuItems = wp_get_nav_menu_items($menu->term_id);
					foreach($tertiaryMenuItems as $item){
						echo '<li><a href="' . $item->url . '">' . $item->title . '</a></li>'."\n";
					}
				?>
			</ul>

			<nav>
				<?php
					$menu = wp_get_nav_menu_object($locations['header-menu']);
					$menuItems = wp_get_nav_menu_items($menu->term_id);
					function buildNav($menuItems, $parentId){
						$menuHtml = '';
						foreach($menuItems as $item){
							$itemParentId = $item->menu_item_parent;
							if($itemParentId == $parentId){
								$menuHtml .= '<div class="nav-item"><a href="' . $item->url . '">' . $item->title . '</a>'."\n";
								$menuHtml .= '<div class="sub">' . buildNav($menuItems, $item->ID) . '</div>'."\n";
								$menuHtml .= '</div>'."\n";
							}
						}
						return $menuHtml;
					}
					echo buildNav($menuItems, 0);

					foreach($tertiaryMenuItems as $item){
						echo '<div class="nav-item mobile"><a href="' . $item->url . '">' . $item->title . '</a></div>'."\n";
					}
				?>
			</nav>

			

			<div id="nav-icon4">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</header>
		<div id="header-spacer"></div>
