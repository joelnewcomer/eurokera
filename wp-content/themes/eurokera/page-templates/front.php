<?php
/*
Template Name: Front
*/
get_header(); ?>

<?php do_action( 'foundationpress_before_content' ); ?>

	<section class="home-slider main-home-slider">
		<div class="slider-container">
		    <ul class="bxslider">
				<?php if( have_rows('slides') ):
					while ( have_rows('slides') ) : the_row(); ?>
		                <?php
			            $photo = get_sub_field('photo');
			            $photo_url = wp_get_attachment_image_src($photo, 'width=1366&height=683&crop=1');
		                $button = get_sub_field('button');
		                // print_r($button_array);
		                ?>
		                <li>
		                	<div class="slide-inner" style="background:url(<?php echo $photo_url[0]; ?>) center center no-repeat;">
			                	<div class="home-center-banner" style="display:table;width: 100%; height:100%; text-align: center;">
									<div style="display:table-cell;vertical-align:middle;text-align:center;width: 100%;">
										<h1><?php echo get_sub_field('header'); ?></h1>
										<?php if ($button != '') : ?>
											<div class="button"><a href="<?php echo $button['url']; ?>"><?php echo $button['title']; ?></a></div>
										<?php endif; ?>
									</div>
   								</div>
		                	</div>
						</li>					
					<?php endwhile;
				endif; ?>
		    </ul>
		    <!-- <div class="home-slider-overlay text-center">
			    <h1><?php echo get_field('slider_header'); ?></h1>
		    </div> -->
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
		<div class="row flex most-popular-blocks">
			<?php if(get_field('most_popular')): ?>
				<?php while(has_sub_field('most_popular')): ?>
					<a href="<?php echo get_sub_field('link'); ?>" class="large-3 medium-6 small-12 columns most-popular-block">
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
				<div class="row solution-row flex-medium-up">
					<?php $src = wp_get_attachment_image_src( get_sub_field('image'), 'width=640&height=350&crop=1'); ?>
					<?php 
					$solution_photo_class = 'large-12';
					$solution_about_class = 'large-12';
					if ($src[0] != '') {
						$solution_about_class = 'large-6 large-pull-6 medium-pull-6 medium-6';
						$solution_photo_class = 'large-6 large-push-6 medium-push-6 medium-6';
						?>
						<a href="<?php echo get_sub_field('link'); ?>" class="<?php echo $solution_photo_class; ?> columns solution-photo" style="background:url(<?php echo $src[0]; ?>) center center no-repeat;"></a>
					<?php } ?>
					<div class="<?php echo $solution_about_class; ?> columns solution-about">
						<h3><a class="blue" href="<?php echo get_sub_field('link'); ?>"><?php echo get_sub_field('title'); ?></a></h3>
						<div class="most-popular-content">
							<?php echo get_sub_field('about'); ?>
						</div>
					</div>
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

<?php get_template_part('template-parts/latest', 'blogs'); ?>

<script>
if (typeof bxSlider === "function") { 	
    var slider = jQuery('.bxslider').bxSlider({
        auto: true,
	    	pager: (jQuery(".bxslider > li").length > 1) ? true: false,
        controls: true,
        mode: 'fade',
        speed: 1000,
		onSlideAfter: function() {
		    slider.stopAuto();
		    slider.startAuto();
		}        
    });	
} else {
	jQuery(window).load(function(){
    	var slider = jQuery('.bxslider').bxSlider({
    	    auto: true,
    	    pager: (jQuery(".bxslider > li").length > 1) ? true: false,
    	    controls: true,
    	    mode: 'fade',
    	    speed: 1000,
			onSlideAfter: function() {
			    slider.stopAuto();
			    slider.startAuto();
			}      	    
    	});		
	});
}

jQuery("ul.bxslider li:first-child img").on('load', function() { 
	jQuery('.bxslider').show();
});
</script>	

<?php do_action( 'foundationpress_after_content' ); ?>

<?php get_footer(); ?>