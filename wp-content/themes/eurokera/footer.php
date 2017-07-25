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
			<footer id="footer" class="row">
				<?php do_action( 'foundationpress_before_footer' ); ?>
				<?php dynamic_sidebar( 'footer-widgets' ); ?>
				<?php do_action( 'foundationpress_after_footer' ); ?>

				<div class="large-6 medium-6 columns copyright small-text-center">

					<p><?php _e( 'Copyright ', 'textdomain' ); ?> &copy;<?php echo date('Y'); ?> <?php bloginfo('name'); ?>.  <span class="no-break"><?php _e( 'All rights reserved.', 'textdomain' ); ?></span></p>
				</div>
				<div class="large-6 medium-6 columns drum hide-on-print text-right small-text-center">
					<a href="http://www.drumcreative.com" target="_blank"><?php _e( 'Web Design by: Drum Creative', 'textdomain' ); ?></a>
				</div>
			</footer>
		</div> <!-- footer-container -->

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