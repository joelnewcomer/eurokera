<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
?>
		</section>
				
		<div id="footer-container">
			<footer id="footer">
				<div class="row">
					<div class="large-12 columns text-center">
						<?php get_template_part('assets/images/eurokera', 'logo.svg'); ?>
						<?php get_template_part('template-parts/social'); ?>
					</div>
					<!-- <div class="large-2 medium-2 columns small-text-center">
						<?php get_template_part('assets/images/eurokera', 'logo.svg'); ?>
					</div>
					<div class="large-8 medium-8 columns">
						<div class="text-center">
							<h2>Innovation & News</h2>
						</div>
						<?php
						$query = new WP_Query(
						    array( 'orderby' => 'date', 'posts_per_page' => '1')
						);
						while($query->have_posts()) : $query->the_post(); ?>
						    <a class="home-blog-link" href="<?php echo get_permalink(); ?>">
						        <span class="title"><?php the_title(); ?></span> <span class="show-for-small"><br /></span><span><?php echo get_the_excerpt(); ?></span>
						    </a>
						<?php endwhile; ?>
						<div class="text-center">
							<div class="button outline white"><a href="<?php echo get_permalink( get_option('page_for_posts' ) ); ?>">Blog</a></div>
						</div>
					</div> -->
				</div> <!-- row -->
				
				<div class="row">
					<div class="large-6 medium-6 columns copyright small-text-center">
						<p><?php _e( 'Copyright ', 'textdomain' ); ?> &copy;<?php echo date('Y'); ?> <?php bloginfo('name'); ?>.  <span class="no-break"><?php _e( 'All rights reserved.', 'textdomain' ); ?></span> <span class="show-for-small"><br /></span><a href="<?php echo get_site_url(); ?>/terms-of-use">Terms of Use</a>. <a href="<?php echo get_site_url(); ?>/privacy-policy">Privacy Policy</a>. <a href="<?php echo get_site_url(); ?>/sitemap">Sitemap</a></p>
					</div>
					<!-- <div class="large-6 medium-6 columns drum hide-on-print text-right small-text-center">
						<a href="http://www.drumcreative.com" target="_blank"><?php _e( 'Web Design by: Drum Creative', 'textdomain' ); ?></a>
					</div> -->
				</div>
			</footer>
		</div> <!-- footer-container -->
		
<div class="cookie-policy transition">
	<div class="row">
		<div class="large-8 medium-8 columns small-text-center">
			<p>We use cookies to offer you a better browsing experience, analyze site traffic, and improve our customer service. Read about how we use cookies by clicking on "Cookie Policy". If you continue to use this site, you consent to our use of cookies.</p>
		</div>
		<div class="large-2 medium-2 columns text-center">
			<a class="cookie-policy-link" href="<?php echo get_site_url(); ?>/cookie-policy"><strong>Cookie Policy</strong></a>
		</div>
		<div class="large-2 medium-2 columns small-text-center">
			<div class="button small reverse"><a id="accept-cookies" href="#">Accept Cookies</a></div>
		</div>
	</div>
</div> <!-- cookie-policy -->

<script>
	jQuery(window).load(function() {
		var acceptCookies = basil.get('accept-cookies');
		if (acceptCookies != 'yes') {
			jQuery('.cookie-policy').addClass('active');
		}
	});
	
	jQuery( "#accept-cookies" ).on( "click", function(e) {
		e.preventDefault();
		basil.set('accept-cookies', 'yes');
		jQuery('.cookie-policy').removeClass('active');
	});
</script>

	<?php if(!preg_match('/(?i)msie [5-9]/',$_SERVER['HTTP_USER_AGENT'])) : ?>
		</div> <!-- animsition -->
	<?php endif; ?>	

		<?php get_template_part( 'template-parts/search-modal' ); ?>

		<a class="cd-top"><?php _e( 'Top', 'textdomain' ); ?></a>

		<?php do_action( 'foundationpress_layout_end' ); ?>

<?php wp_footer(); ?>

<?php do_action( 'foundationpress_before_closing_body' ); ?>
</body>
</html>