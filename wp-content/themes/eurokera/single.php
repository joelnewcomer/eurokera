<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<?php get_template_part( 'template-parts/featured-image-parallax' ); ?>

<div id="single-post" role="main">
	<div class="row">	
	<?php do_action( 'foundationpress_before_content' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article class="main-content large-12 columns" <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<header>
					<?php drum_entry_meta(); ?>
				</header>
			<?php do_action( 'foundationpress_post_before_entry_content' ); ?>
			<div class="entry-content">
			
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
	<div class="more-articles text-center">
		<a href="<?php echo get_permalink( get_option( 'page_for_posts' )); ?>"><?php _e('Read more articles...'); ?></a>
	</div>
	
	
	<?php do_action( 'foundationpress_after_content' ); ?>
	</div> <!-- row -->
</div> <!-- #single-post -->
<?php get_footer(); ?>