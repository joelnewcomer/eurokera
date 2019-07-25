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
		
		<?php if (ICL_LANGUAGE_CODE != 'zh-hans') : ?>

			<!-- Global site tag (gtag.js) - Google Analytics -->
			<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-54647743-1"></script>
			<script>
			  window.dataLayer = window.dataLayer || [];
			  function gtag(){dataLayer.push(arguments);}
			  gtag('js', new Date());
			
			  gtag('config', 'UA-54647743-1');
			</script> -->
			
		<?php endif; ?>

		<!-- Load Korean font kit -->
		<?php if(ICL_LANGUAGE_CODE=='ko') : ?>
			<script>
  (function(d) {
    var config = {
      kitId: 'amh7lzl',
      scriptTimeout: 3000,
      async: true
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);
</script>
		<!-- Load Chinese/Vietnamese font kit -->
		<?php elseif (ICL_LANGUAGE_CODE=='zh-hans' || ICL_LANGUAGE_CODE=='vi') : ?>
			<script>
			(function(d) {
				var config = {
					kitId: 'mwj6guo',
					scriptTimeout: 3000,
					async: true
    			},
				h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);
			</script>
		<!-- English font kit -->
		<?php else : ?>
			<link rel="stylesheet" href="https://use.typekit.net/xxf2jbi.css">	
		<?php endif; ?>



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
		
		<?php if (ICL_LANGUAGE_CODE != 'zh-hans') : ?>
		
<!-- Google Tag Manager (noscript) 
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WJ9W8VH<https://www.googletagmanager.com/ns.html?id=GTM-WJ9W8VH>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

	<?php endif; ?>

		<a class="skip-link sr-only" href="#content"><?php _e( 'Skip to content', 'drumroll' ); ?></a>
	<?php do_action( 'foundationpress_after_body' ); ?>
	<?php do_action( 'foundationpress_layout_start' ); ?>

	<?php if(!preg_match('/(?i)msie [5-9]/',$_SERVER['HTTP_USER_AGENT'])) : ?>
		<div class="animsition-shell">
		<script>
			// jQuery('.animsition-shell').addClass( 'animsition' );
		</script>
	<?php endif; ?>	
	
	<!-- Load Basil -->
	<script>
	jQuery( document ).ready(function() {
		options = {
			expireDays: 365
		};
		basil = new window.Basil(options);
	});
	</script>
	
	<?php
	$has_secondary_nav = true;
	if (get_field('menu') == 'none' || is_page_template('page-templates/about.php') || is_page_template('page-templates/front.php') || is_page_template('page-templates/page-contact.php') || is_page_template('page-templates/library.php') || is_home() || is_archive() || is_singular('post')) {
		$has_secondary_nav = false;
	}
	?>
	
	<div class="header-wrapper match-header <?php if (!$has_secondary_nav) { echo 'no-secondary-nav'; } ?>">
		
	<div class="top-header">
		<div class="row">
			<div class="large-12 columns small-text-center">
				<div class="show-for-small top-menu-trigger">
					<?php get_template_part('assets/images/top', 'menu-hamburger.svg'); ?>
				</div>
				<div class="mobile-menu-container">
					<div class="mobile-menu-inner">
						<div class="show-for-small close-top-menu">
							×
						</div>
						<?php top_menu(); ?>
						<?php top_menu_right(); ?>
					</div>
				</div> <!-- mobile-menu-container -->
			</div>
		</div>
		<script>
			jQuery("li.wpml-ls-current-language > a").removeAttr("href");
			
			jQuery(".top-menu-trigger").on( "click", function() {
				jQuery('body').addClass('mobile-menu-active');
			});
			jQuery(".close-top-menu").on( "click", function() {
				jQuery('body').removeClass('mobile-menu-active');
			});
		</script>	
	</div>
	
	<header id="masthead" class="site-header match-header" role="banner">
		<nav id="site-navigation" class="main-navigation top-bar row" role="navigation">
			<div class="top-bar-left">
				<?php get_template_part('template-parts/header-icon'); ?>
				<?php
				if (get_field('menu') == 'none' || is_page_template('page-templates/about.php') || is_page_template('page-templates/page-contact.php') || is_page_template('page-templates/library.php') || is_home() || is_archive() || is_singular('post') || is_page_template('page-templates/front.php')) {
					echo '<p class="tagline">' . get_field('slider_header', get_option( 'page_on_front' )) . '</p>';	
				}	
				?>
			</div> <!-- top-bar-left -->
			<div class="top-bar-right">
				<?php
				$on_page_nav = false;
				if (is_page_template('page-templates/versatis.php')) {
					echo '<div class="show-for-small menu-label">Versâtis™ Options</div>';
					versatis_menu();
					$on_page_nav = true;
				} elseif (get_field('menu') == 'fireplaces') {
					echo '<div class="show-for-small menu-label">Fireplace Options</div>';
					fireplaces_menu();
					$on_page_nav = true;
				} elseif (get_field('menu') == 'specialties') {
					echo '<div class="show-for-small menu-label">Specialties Menu</div>';
					specialties_menu();
					$on_page_nav = true;
				} elseif (!$has_secondary_nav) {
					// do nothing
				} else {
					echo '<div class="show-for-small menu-label">Cooking Options</div>';
					foundationpress_main_menu();
				}
				?>
				<script>
				jQuery(".menu-label").on( "click", function() {
					jQuery(this).siblings('.menu-collapser').find('.collapse-button').trigger( "click" );
				});
				</script>
			</div> <!-- top-bar-right -->

<?php if ($on_page_nav) : ?>

<!-- Add active class to nav on scroll -->
<script>
jQuery( document ).ready(function() {
	// Cache selectors
	var topMenu = jQuery("ul.slimmenu"),
    topMenuHeight = topMenu.outerHeight()+15,
    // All list items
    menuItems = topMenu.find('a[href^="#"]'),
    // Anchors corresponding to menu items
    scrollItems = menuItems.map(function(){
    	var item = jQuery(jQuery(this).attr("href"));
		if (item.length) { return item; }
    });
    
	// Bind to scroll
	jQuery(window).scroll(function(){
		// Get container scroll position
		var fromTop = jQuery(this).scrollTop()+topMenuHeight;

		// Get id of current scroll item
		var cur = scrollItems.map(function(){
		if (jQuery(this).offset().top < fromTop)
    		return this;
   		});
   		// Get the id of the current element
   		cur = cur[cur.length-1];
   		var id = cur && cur.length ? cur[0].id : "";
   		// Set/remove active class
   		menuItems
   		.parent().removeClass("active")
   		.end().filter("[href='#"+id+"']").parent().addClass("active");
	});
});
</script>

<?php endif; ?>

	<?php if (is_singular('products')) : ?>
		<div class="all-products transition">
			<div class="row">
				<div id="view-all"><?php _e('View All Products'); ?></div>
				<div class="large-12 columns text-center transition">
					<?php
					$args = array(
						'post_type' => 'products',
						'posts_per_page' => -1
					);							
					$the_query = new WP_Query( $args ); ?>
					<?php if ( $the_query->have_posts() ) : ?>
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<?php
							$thumb = wp_get_attachment_image_src( get_field('thumbnail'), 'width=143&height=103&crop=1' );
							$product_title = get_the_title();
							$white = '';
							if (strpos(strtolower($product_title), 'white') !== false) {
								$white = ' white';
							}	
							?>
							<a href="<?php the_permalink(); ?>" class="product-thumb<?php echo $white; ?>" style="background: url(<?php echo $thumb[0]; ?>);">
								<div style="display:table;width:100%;height:100%;">
									<div style="display:table-cell;vertical-align:middle;">
										<div style="text-align:center;"><?php the_title(); ?></div>
									</div>
								</div>
							</a>
						<?php endwhile; ?>
						<?php wp_reset_query(); ?>
					<?php endif; ?>
				</div> <!-- columns -->
			</div> <!-- row -->
		</div> <!-- all-products -->
		<script>
			jQuery('#view-all').on( "click", function() {
				jQuery('.all-products').toggleClass('open');
			});
		</script>
	<?php endif; ?>
			
		</nav> <!-- #site-navigation -->
	</header> <!-- #masthead -->
	</div> <!-- header-wrapper -->

	<?php do_action( 'foundationpress_after_header' ); ?>

	<section id="content" class="container">