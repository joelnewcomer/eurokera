<?php
/*
Template Name: Versâtis™
*/
get_header(); ?>

<?php do_action( 'foundationpress_before_content' ); ?>
	
	<?php
	global $row_counter;
	$row_counter = 1;	
	?>
	
	<?php get_template_part('template-parts/page', 'slider'); ?>
	
	<section id="intro" class="versatis-video text-center">
		<?php $video_poster = get_field('video_poster'); ?>
<?php if (ICL_LANGUAGE_CODE == 'zh-hans') : ?>	
	<?php
	$video_markup = '<a class="versatis-video vp-a vp-mp4-type" href="' . get_field('video_url') . '" data-autoplay="1" data-dwrap="1">' .  wp_get_attachment_image($video_poster, 'full') . '</a>';
	echo apply_filters('the_content', $video_markup);
	$video_inner = '<div class="video-overlay">';
	$video_inner .= '<div class="video-button-title">';
	ob_start();
	get_template_part('assets/images/play', 'button-simple.svg');
	$play_button = ob_get_contents();
	ob_end_clean();
	$video_inner .= $play_button;
	$video_inner .= '<br /><p>' . get_field('video_title') . '</p></div></div>';
	?>
	<script>
		jQuery('a.versatis-video').html('<?php echo $video_inner; ?>');
	</script>
<?php else: ?>
	<a class="versatis-video" href="<?php echo get_field('video_url'); ?>?autoplay=1&modestbranding=1&showinfo=0&rel=0" data-featherlight="iframe" data-featherlight-iframe-width="960" data-featherlight-iframe-height="540">
		<?php echo wp_get_attachment_image($video_poster, 'full'); ?>
		<div class="video-overlay">
			<div class="video-button-title">
				<?php get_template_part('assets/images/play', 'button-simple.svg'); ?><br />
				<p><?php echo get_field('video_title'); ?></p>
			</div>
		</div>
	</a>
<?php endif; ?>
	</section>
	
	<section class="versatis-intro">
		<div class="row">
			<div class="large-12 columns">
				<?php echo get_field('intro'); ?>
			</div>		
		</div>
	</section> <!-- intro -->
	
	<section class="photos-two-up">
		<div class="large-6 medium-6 columns no-padding">
			<?php echo wp_get_attachment_image( get_field('photos_twoup_left_photo'), 'width=960&height=460&crop=1' ); ?>
		</div>
		<div class="large-6 medium-6 columns no-padding">
			<?php echo wp_get_attachment_image( get_field('photos_twoup_right_photo'), 'width=960&height=460&crop=1' ); ?>
		</div>		
	</section> <!-- photos-two-up -->
		
	<?php // get_template_part('template-parts/versatis', 'animation'); ?>
	
	<section class="full-width-photo">
		<?php echo wp_get_attachment_image( get_field('fullwidth_photo'), 'width=1910&height=510&crop=1' ); ?>
	</section> <!-- full-width-photo -->


	<section id="features" class="icon-blocks key-features">
		<div class="row">
			<div class="large-12 columns">
				<h2><?php echo get_field('key_features_title'); ?></h2>
			</div>
		</div>
		<div class="row">
			<?php if(get_field('blocks')): ?>
				<?php while(has_sub_field('blocks')): ?>
					<div class="large-4 medium-4 small-6 columns text-center icon-block">
						<div class="icon-container">
							<?php echo file_get_contents(get_sub_field('icon')); ?>
						</div>
						<h3><?php echo get_sub_field('title'); ?></h3>
						<p><?php echo get_sub_field('paragraph'); ?></p>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</section> <!-- key-features -->

			
	<section class="dedicated-team">
		<?php $team_photo = wp_get_attachment_image_src( get_field('dedicated_team_photo'), 'full'); ?>
		<div class="large-4 large-push-8 medium-12 columns dedicated-team-photo no-padding" style="background-image: url(<?php echo $team_photo[0]; ?>);">
					<div class="slider-container">
		    <ul class="bxslider">
				<?php if( have_rows('dedicated_team_slideshow') ):
					while ( have_rows('dedicated_team_slideshow') ) : the_row(); ?>
		                <?php
			            $photo = get_sub_field('photo');
			            $photo_url = wp_get_attachment_image_src($photo, 'full');
		                ?>
		                	<li>
		                		<div class="slide-inner" style="background:url(<?php echo $photo_url[0]; ?>) center center no-repeat;"></div>
						</li>					
					<?php endwhile;
				endif; ?>
		    </ul>
		    <!-- <div class="home-slider-overlay text-center">
			    <h1><?php echo get_field('slider_header'); ?></h1>
		    </div> -->
		</div> <!-- slider-container -->
		</div>
		<div class="large-8 large-pull-4 medium-12 columns dedicated-team-content">
			<?php echo do_shortcode(get_field('dedicated_team_content')); ?>
		</div>
	</section> <!-- dedicated-team -->
	
	<section id="gallery" class="page-gallery versatis-gallery">
		<div class="row">
			<div class="large-12 columns">
				<h2><?php echo get_field('gallery_title'); ?></h2>
			</div>
		</div>
		<div class="row">
			<?php 
			$images = get_field('images');								
			if( $images ): ?>
				<div class=" slider-container slider-container-<?php echo $row_counter; ?>">
				<ul class="bxslider gallery-<?php echo $row_counter; ?>">
			    		<?php foreach( $images as $image ): ?>
			        		<li>
			            		<?php echo wp_get_attachment_image( $image['ID'], 'width=1080&height=640&crop=1' ); ?>
			            		<p class="gallery-slide-caption"><?php echo wp_get_attachment_caption($image['ID']); ?></p>
			            </li>
			        <?php endforeach; ?>
			    </ul>
			    <p class="gallery-caption"></p>
				</div>
				<script>
					jQuery(window).load(function(){
						function loadCaption(currentSlide) {
							var caption = currentSlide.find('p.gallery-slide-caption').html();
							/* jQuery('.slider-container-<?php echo $row_counter; ?> p.gallery-caption').html(caption); */
						}										
						var slider = jQuery('.gallery-<?php echo $row_counter; ?>').bxSlider({
						    auto: false,
						    pager: (jQuery(".bxslider > li").length > 1) ? true: false,
						    controls: true,
						    mode: 'fade',
						    speed: 1000,
						    onSliderLoad: function(currentIndex) {     
								var currentSlide = jQuery('.slider-container-<?php echo $row_counter; ?>').find('.bx-viewport').find('ul').children().eq(currentIndex);
								loadCaption(currentSlide);
    							},
						    onSlideBefore: function($slideElement) {
								loadCaption($slideElement);
    							},
						});
					});

				</script>								    
			<?php endif; ?>
		</div> <!-- row -->
	</section> <!-- versatis-gallerypage-gallery -->
	
	<section id="inspiration" class="luxury">
		<div class="large-8 medium-8 columns luxury-content">
			<?php echo get_field('luxury_content'); ?>
		</div>
		<?php $luxury_photo = wp_get_attachment_image_src( get_field('luxury_photo'), 'full'); ?>
		<div class="large-4 medium-4 columns luxury-photo" style="background-image: url(<?php echo $luxury_photo[0]; ?>);">
			
		</div>		
	</section> <!-- luxury -->
	
	<?php get_template_part('template-parts/latest', 'blogs'); ?>
	
	<?php echo get_template_part('template-parts/content','ready'); ?>
	

<?php do_action( 'foundationpress_after_content' ); ?>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.entry-content section a[href^="#"], .top-bar-right a[href^="#"]').click(function() {
            var target = jQuery(this.hash);
            if (target.length == 0) target = jQuery('a[name="' + this.hash.substr(1) + '"]');
            if (target.length == 0) target = jQuery('html');
            jQuery('html, body').animate({ scrollTop: target.offset().top - 70}, 500);
			if(jQuery(window).width()<641) {
				jQuery('ul.slimmenu').fadeOut();
			} 
			return false;
        });
    });
</script>

<script>
if (typeof bxSlider === "function") { 	
    var slider = jQuery('.bxslider').bxSlider({
        auto: true,
	    	pager: (jQuery(".bxslider > li").length > 1) ? true: false,
        controls: true,
        mode: 'fade',
        speed: 1000,     
    });	
} else {
	jQuery(window).load(function(){
    	var slider = jQuery('.bxslider').bxSlider({
    	    auto: true,
    	    /* pager: (jQuery(".bxslider > li").length > 1) ? true: false, */
    	    pager: false,
    	    controls: true,
    	    mode: 'fade',
    	    speed: 1000,      	    
    	});		
	});
}

jQuery("ul.bxslider li:first-child img").on('load', function() { 
	jQuery('.bxslider').show();
});
</script>	

<?php get_footer(); ?>