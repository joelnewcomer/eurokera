<?php
/*
Template Name: Contact
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image-parallax' ); ?>

<div id="page" role="main">
	<?php do_action( 'foundationpress_before_content' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class(array('main-content')) ?> id="post-<?php the_ID(); ?>">
			<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
			<div class="entry-content">
				<?php if ( post_password_required() ) : ?>
					<div class="row password-protected-row">
						<div class="large-12 columns">
							<?php echo get_the_password_form(); ?>
						</div>
					</div>
				<?php else : ?>
	        		<?php get_template_part('template-parts/content', 'columns'); ?>
				<?php endif; ?>
			</div> <!-- entry-content -->
		</article>
	<?php endwhile;?>
	<?php do_action( 'foundationpress_after_content' ); ?>
</div> <!-- #page -->

			        		<script>
				    	    	jQuery( document ).ready(function() {
				    	    		jQuery('#user-faq').easyResponsiveTabs({
					    	    		type: 'accordion',
										tabidentify: 'user-faq', // The tab groups identifier
            						});
				    	    	});
				    	    </script>

<?php get_footer(); ?>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.entry-content section a[href^="#"]').click(function() {
            var target = jQuery(this.hash);
            if (target.length == 0) target = jQuery('a[name="' + this.hash.substr(1) + '"]');
            if (target.length == 0) target = jQuery('html');
            jQuery('html, body').animate({ scrollTop: target.offset().top - 70}, 500);
            return false;
        });
    });
</script>