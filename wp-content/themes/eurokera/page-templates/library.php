<?php
/*
Template Name: Library
*/
get_header(); ?>

<div id="page" role="main">
	<?php do_action( 'foundationpress_before_content' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class(array('main-content')) ?> id="post-<?php the_ID(); ?>">
			<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
			<div class="entry-content">
				<div class="row">
					<div class="large-12 columns text-center library-title">
						<h1 class="entry-title gray"><?php echo get_the_title(); ?></h1>
					</div>
				</div>
				<section class="library-items">
					<div class="row">
						<div class="large-12 columns">
							<?php if(get_field('library_items')): ?>
								<?php while(has_sub_field('library_items')): ?>
									<a href="<?php echo get_sub_field('file'); ?>" target="_blank"><?php echo get_sub_field('title'); ?></a>
								<?php endwhile; ?>
							<?php endif; ?>
						</div>
					</div> <!--row -->
				</section>
			</div> <!-- entry-content -->
		</article>
	<?php endwhile;?>
	<?php do_action( 'foundationpress_after_content' ); ?>
</div> <!-- #page -->

<?php get_footer(); ?>