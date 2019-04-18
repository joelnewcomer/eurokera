<section class="home-blog">
	<div class="row">
		<div class="large-12 columns">
			<h2><?php echo get_field('blog_title', get_option( 'page_on_front' )); ?></h2>
		</div>
	</div>
	<div class="blog-row row flex">
		<?php
		$the_query = new WP_Query(
			array( 'post_type' => 'post', 'posts_per_page' => '3')
		);
		while($the_query->have_posts()) : $the_query->the_post(); ?>
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
							<h2 class="blog-title"><?php the_title(); ?></h2>
		                </div>
		                <?php the_excerpt(); ?>
	                </a>
                </div>
		<?php endwhile;
		wp_reset_query();
		?>
	</div> <!-- blog-row --> 
	<div class="row">
		<div class="large-12 columns text-center">
			<div class="button small"><a href="<?php echo get_field('blog_link', get_option( 'page_on_front' )); ?>"><?php echo get_field('blog_button_text', get_option( 'page_on_front' )); ?></a></div>
		</div>
	</div> <!-- row --> 
</section> <!-- home-blog -->