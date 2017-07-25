<script>
	var isReadingTime = false;
	var isUnslider = false;
</script>
<?php
/**
* The template for displaying pages
*
* This is the template that displays all pages by default.
* Please note that this is the WordPress construct of pages and that
* other "pages" on your WordPress site will use a different template.
*
* @package FoundationPress
* @since FoundationPress 1.0.0
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image-parallax' ); ?>

<div id="page" role="main">
	<?php do_action( 'foundationpress_before_content' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class(array('main-content')) ?> id="post-<?php the_ID(); ?>">
			<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
				<section class="breadcrumbs">
					<div class="row">
						<div class="large-12 columns">
							<?php
							if ( function_exists('yoast_breadcrumb') ) {
								yoast_breadcrumb('<p id="breadcrumbs">','</p>');
							}
							?>
						</div>
					</div>
				</section>
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

<?php get_footer();