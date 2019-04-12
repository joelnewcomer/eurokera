<?php
/*
Template Name: Front
*/
get_header(); ?>

<?php do_action( 'foundationpress_before_content' ); ?>

	<section class="home-slider">
		<div class="slider-container">
		    <ul class="bxslider">
				<?php if( have_rows('slides') ):
					while ( have_rows('slides') ) : the_row(); ?>
		                <?php
			            $photo = get_sub_field('photo');
			            $photo_url = wp_get_attachment_image_src($photo, 'width=1366&height=683&crop=1');
		                ?>
		                	<li>
		                		<div class="slide-inner" style="background:url(<?php echo $photo_url[0]; ?>) center center no-repeat;"></div>
						</li>					
					<?php endwhile;
				endif; ?>
		    </ul>
		    <div class="home-slider-overlay text-center">
			    <h1><?php echo get_field('slider_header'); ?></h1>
		    </div>
		</div> <!-- slider-container -->
	</section> <!-- home-slider -->
	
	<section class="home-intro">
		<div class="row">
			<div class="large-12 columns">
				<?php echo get_field('intro'); ?>
			</div>
		</div>
	</section> <!-- home-intro -->

	<section class="most-popular">
		<div class="row">
			<div class="large-12 columns">
				<h2 class="orange"><?php echo get_field('most_popular_title'); ?></h2>
			</div>
		</div>
		<div class="row flex">
			<?php if(get_field('most_popular')): ?>
				<?php while(has_sub_field('most_popular')): ?>
					<a href="<?php echo get_sub_field('link'); ?>" class="large-3 medium-3 small-6 columns most-popular-block">
						<?php echo wp_get_attachment_image( get_sub_field('photo'), 'width=327&height=220&crop=1'); ?>
						<h3><?php echo get_sub_field('title'); ?></h3>
						<div class="most-popular-content">
							<p><?php echo get_sub_field('description'); ?></p>
							<div class="text-center bottom-button">
								<div class="faux-button blue"><?php _e('Learn More'); ?></div>
							</div>
						</div>
					</a>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</section> <!-- most-popular -->
	
	<section class="all-solutions">
		<div class="row">
			<div class="large-12 columns solutions-intro">
				<?php echo get_field('all_solutions_intro'); ?>
			</div>
		</div>
		<?php if(get_field('all_solutions')): ?>
			<?php while(has_sub_field('all_solutions')): ?>
				<div class="row solution-row flex">
					<div class="large-6 medium-6 columns solution-about">
						<h3><a class="blue" href="<?php echo get_sub_field('link'); ?>"><?php echo get_sub_field('title'); ?></a></h3>
						<div class="most-popular-content">
							<?php echo get_sub_field('about'); ?>
						</div>
					</div>
					<?php $src = wp_get_attachment_image_src( get_sub_field('image'), 'width=640&height=350&crop=1'); ?>
					<a href="<?php echo get_sub_field('link'); ?>" class="large-6 medium-6 columns solution-photo" style="background:url(<?php echo $src[0]; ?>) center center no-repeat;">
					</a>
				</div> <!-- solution-row -->
			<?php endwhile; ?>
		<?php endif; ?>
	</section> <!-- all-solutions -->
	
	<?php
	$video_poster = get_field('video_poster');
	if (is_numeric($video_poster)) {
		$video_poster_url = wp_get_attachment_image_src($video_poster, 'full');
		$video_poster = $video_poster_url[0];
	}
	?>
<?php if (ICL_LANGUAGE_CODE == 'zh-hans') : ?>	
	<?php
	$video_markup = '<a class="home-video vp-a vp-mp4-type" style="background-image: url(' . $video_poster . ');" href="' . get_field('video_url') . '" data-autoplay="1" data-dwrap="1"></a>';
	echo apply_filters('the_content', $video_markup);
	$video_inner = '<div class="row"><div class="large-12 columns text-center">';
	ob_start();
	get_template_part('assets/images/play', 'button.svg');
	$play_button = ob_get_contents();
	ob_end_clean();
	$video_inner .= $play_button;
	$video_inner .= '<br />' . get_field('video_title') . '</div></div>';
	?>
	<script>
		jQuery('a.home-video').html('<?php echo $video_inner; ?>');
	</script>
<?php else: ?>
	<a class="home-video" href="<?php echo get_field('video_url'); ?>?autoplay=1&modestbranding=1&showinfo=0&rel=0" data-featherlight="iframe" data-featherlight-iframe-width="960" data-featherlight-iframe-height="540" style="background-image: url(<?php echo $video_poster; ?>);">
		<div class="row">
			<div class="large-12 columns text-center">
				<?php get_template_part('assets/images/play', 'button.svg'); ?><br />
				<?php echo get_field('video_title'); ?>
			</div>
		</div>
	</a>
<?php endif; ?>

<section class="home-blog">
	<div class="row">
		<div class="large-12 columns">
			<h2><?php echo get_field('blog_title'); ?></h2>
		</div>
	</div>
	<div class="blog-row row">
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
		<div class="large-12 columns text-center">
			<div class="button small"><a href="<?php echo get_field('blog_link'); ?>"><?php echo get_field('blog_button_text'); ?></a></div>
		</div>
	</div> <!-- blog-row --> 
</section> <!-- home-blog -->

<script>
if (typeof bxSlider === "function") { 	
    var slider = jQuery('.bxslider').bxSlider({
        auto: false,
	    	pager: true,
        controls: true,
        mode: 'fade',
        speed: 1000,
    });	
} else {
	jQuery(window).load(function(){
    	var slider = jQuery('.bxslider').bxSlider({
    	    auto: false,
    	    pager: (jQuery(".bxslider > li").length > 1) ? true: false,
    	    controls: true,
    	    mode: 'fade',
    	    speed: 1000,
    	});		
	});
}
</script>	

<?php do_action( 'foundationpress_after_content' ); ?>

<?php get_footer(); ?>