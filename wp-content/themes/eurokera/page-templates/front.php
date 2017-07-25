<?php
/*
Template Name: Front
*/
get_header(); ?>

<?php do_action( 'foundationpress_before_content' ); ?>

<?php while ( have_posts() ) : the_post(); ?>
<section class="intro" role="main">
	<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
		<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
		<div class="entry-content row">
			<div class="large-12 columns">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</section>

<?php endwhile;?>
<?php do_action( 'foundationpress_after_content' ); ?>

<?php get_footer(); ?>