<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- Icons for Apple Devices -->
		<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/touch-icon-iphone.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/touch-icon-ipad.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/touch-icon-iphone-retina.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/touch-icon-ipad-retina.png">


		<?php wp_head(); ?>

		<script src="https://use.typekit.net/xxf2jbi.js"></script>
		<script>try{Typekit.load({ async: true });}catch(e){}</script>

		<!-- Polyfills to make various versions of IE play nicer -->
		<script>
			jQuery( document ).ready(function() {
				conditionizr.polyfill('<?php echo get_template_directory_uri(); ?>/assets/javascript/polyfills/respond.min.js', ['ie7', 'ie8']);
				conditionizr.polyfill('<?php echo get_template_directory_uri(); ?>/assets/javascript/polyfills/nwmatcher-1.3.4.min.js', ['ie7', 'ie8']);
				conditionizr.polyfill('<?php echo get_template_directory_uri(); ?>/assets/javascript/polyfills/selectivizr-min.js', ['ie7', 'ie8']);
				conditionizr.polyfill('<?php echo get_template_directory_uri(); ?>/assets/javascript/polyfills/html5shiv.min.js', ['ie7', 'ie8', 'ie9']);
				conditionizr.polyfill('<?php echo get_template_directory_uri(); ?>/assets/javascript/polyfills/css3-multi-column.min.js', ['ie7', 'ie8', 'ie9']);
				conditionizr.polyfill('<?php echo get_template_directory_uri(); ?>/assets/javascript/polyfills/flexibility.js', ['ie8', 'ie9']);
				conditionizr.config({
					tests: {
						'ie7': ['class'],
						'ie8': ['class'],
						'ie9': ['class'],
					}
				});
			})
		</script>

	</head>
	<body <?php body_class(); ?>>
	<?php do_action( 'foundationpress_after_body' ); ?>
	<?php do_action( 'foundationpress_layout_start' ); ?>

	<?php if(!preg_match('/(?i)msie [5-9]/',$_SERVER['HTTP_USER_AGENT'])) : ?>
		<div class="animsition">
	<?php endif; ?>	
	
	<?php if (is_front_page()) : ?>
		<section class="home-banner text-center" data-paroller-factor="0.3" style="background: url('<?php the_post_thumbnail_url('full'); ?>') center center no-repeat;">
			<div class="hide-for-small"><?php get_template_part('template-parts/header-icon'); ?><br /></div>
			<?php
			// Insert a line break after the first period
			$desc = get_bloginfo('description');
			$period_pos = strpos($desc, '.');
			$desc = substr_replace($desc, '<br />', $period_pos, 0);
			?>
			<h1><?php echo $desc; ?></h1>
			<?php get_template_part('template-parts/content','site-links'); ?>
			<div class="down-arrow bounce animated"><?php get_template_part('assets/images/acc', 'arrow.svg'); ?></div>
		</section>
	
		<script>
			jQuery( document ).ready(function() {
				var nav = jQuery('.header-wrapper').offset();
				var $window = jQuery(window);

				$window.scroll(function () {
				    if ($window.scrollTop() >= nav.top) {
				        jQuery(".header-wrapper").addClass("stuck");
				    } else {
					    jQuery(".header-wrapper").removeClass("stuck");
				    }
				});

				jQuery('.home-banner .down-arrow').click(function() {
				    jQuery('html, body').animate({ scrollTop: jQuery('#masthead').offset().top}, 1000);
				});
    		});			
		</script>
	<?php endif; ?>

	<div class="header-wrapper match-header">
	<header id="masthead" class="site-header match-header" role="banner">
		<nav id="site-navigation" class="main-navigation top-bar row" role="navigation">
			<div class="top-bar-left">
				<?php get_template_part('template-parts/header-icon'); ?>
			</div> <!-- top-bar-left -->
			<div class="top-bar-right">
				<?php foundationpress_main_menu(); ?>
				<div class="icon-wrapper hide-for-small">
					<?php
					// Search Icon
					get_template_part('assets/images/search.svg');
					?>
				</div> <!-- icon-wrapper -->
			</div> <!-- top-bar-right -->
		</nav> <!-- #site-navigation -->
	</header> <!-- #masthead -->
	</div> <!-- header-wrapper -->

	<?php do_action( 'foundationpress_after_header' ); ?>

	<section class="container">