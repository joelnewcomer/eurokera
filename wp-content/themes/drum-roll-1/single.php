<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>


<div id="single-post" role="main">
	<div class="row">	
	<?php do_action( 'foundationpress_before_content' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article class="main-content large-8 medium-8 columns" <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php drum_entry_meta(); ?>
			</header>
			<?php do_action( 'foundationpress_post_before_entry_content' ); ?>
			<div class="entry-content">
	
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="featured-image">
					<?php the_post_thumbnail( array( 'width' => 770, 'height' => 420, 'crop' => true )); ?>
				</div>
			<?php endif; ?>
	
			<?php the_content(); ?>
			</div>
			<footer>
				<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
				<p><?php the_tags(); ?></p>
			</footer>
			<?php do_action( 'foundationpress_post_before_comments' ); ?>
			<?php comments_template(); ?>
			<?php do_action( 'foundationpress_post_after_comments' ); ?>
		</article>
	<?php endwhile;?>
	
	<?php do_action( 'foundationpress_after_content' ); ?>
	<?php get_sidebar(); ?>
	</div> <!-- row -->
</div> <!-- #single-post -->
<?php get_footer(); ?>