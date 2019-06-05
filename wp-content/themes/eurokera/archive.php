<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image-parallax' ); ?>

<?php $current_cat_id = get_queried_object()->term_id; ?>

<div id="page" class="white-bg" role="main">
    <div class="row">
	    <div class="blog-cats large-12 text-center">
		    <a href="<?php echo get_permalink( get_option( 'page_for_posts' )); ?>"><?php _e('All'); ?></a>
			<?php
			$args = array(
			    'orderby' => 'name',
			    'order' => 'ASC',
			    'hide_empty' => 0
			);
			$active = '';
			$categories = get_categories($args);
			foreach($categories as $category) { 
				if ($category->term_id == $current_cat_id) {
					$active = 'class="active" ';
				}
			    echo '<a ' . $active . 'href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all articles in %s" ), $category->name ) . '" ' . '>' . $category->name;
			    echo '</a>';
			    $active = '';
			}
			?>		    
	    </div>
    </div>
    <div class="blog-row row">
		<?php if ( have_posts() ) : ?>
		
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
            	<?php
	            // Check for alternate featured image first
	            $featured_id = get_field('alt_featured');
	            if ($featured_id == null) {
		            $featured_id = get_post_thumbnail_id();
	            }
	            // Default featured image
	            if ($featured_id == null) {
		            $featured_id = 729;
	            }
	            ?>
                <div class="large-4 medium-4 columns blog-columns">
	                <a href="<?php the_permalink(); ?>" class="blog-block">
		                <div class="text-center">
			                <?php echo wp_get_attachment_image( $featured_id, 'width=316&height=316&crop=1' ) ?>
							<h2><?php the_title(); ?></h2>
		                </div>
		                <?php the_excerpt(); ?>
	                </a>
                </div>
			<?php endwhile; ?>
		
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
		
			<?php endif; // End have_posts() check. ?>
		
			<?php /* Display navigation to next/previous pages when applicable */ ?>
			<?php if ( function_exists( 'foundationpress_pagination' ) ) { foundationpress_pagination(); } else if ( is_paged() ) { ?>
				<nav id="post-nav">
					<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'foundationpress' ) ); ?></div>
					<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'foundationpress' ) ); ?></div>
				</nav>
			<?php } ?>
		
	</div> <!-- row -->
</div> <!-- #page -->

<script>
jQuery(document).ready(function(){
	jQuery('.blog-block').matchHeight();
});
</script>

<?php get_footer();
