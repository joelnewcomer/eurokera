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
	
	<section class="versatis-video text-center">
		<?php $video_poster = get_field('video_poster'); ?>
<?php if (ICL_LANGUAGE_CODE == 'zh-hans') : ?>	
	<?php
	$video_markup = '<a class="versatis-video vp-a vp-mp4-type" href="' . get_field('video_url') . '" data-autoplay="1" data-dwrap="1">' .  wp_get_attachment_image($video_poster, 'full') . '</a>';
	echo apply_filters('the_content', $video_markup);
	$video_inner = '<div class="video-overlay">';
	ob_start();
	get_template_part('assets/images/play', 'button.svg');
	$play_button = ob_get_contents();
	ob_end_clean();
	$video_inner .= $play_button;
	$video_inner .= '<br /><p>' . get_field('video_title') . '</p></div>';
	?>
	<script>
		jQuery('a.home-video').html('<?php echo $video_inner; ?>');
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
		
	<section class="versatis-animation">
		<div class="row">
			<div class="large-12 columns">
				<h2><?php echo get_field('animation_title'); ?></h2>
				<?php echo get_field('animation_intro'); ?>
			</div>
		</div>
	</section> <!-- versatis-animation -->
	
	<section class="full-width-photo">
		<?php echo wp_get_attachment_image( get_field('fullwidth_photo'), 'width=1910&height=510&crop=1' ); ?>
	</section> <!-- full-width-photo -->


	<section class="icon-blocks key-features">
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
		<div class="large-8 medium-8 columns dedicated-team-content">
			<?php echo get_field('dedicated_team_content'); ?>
		</div>
		<?php $team_photo = wp_get_attachment_image_src( get_field('dedicated_team_photo'), 'full'); ?>
		<div class="large-4 medium-4 columns dedicated-team-photo" style="background-image: url(<?php echo $team_photo[0]; ?>);">
			
		</div>
	</section> <!-- dedicated-team -->
	
	<section class="page-gallery versatis-gallery">
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
							jQuery('.slider-container-<?php echo $row_counter; ?> p.gallery-caption').html(caption);
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
	
	<section class="luxury">
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

<?php get_footer(); ?>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.entry-content section a[href^="#"]').click(function() {
            var target = jQuery(this.hash);
            if (target.length == 0) target = jQuery('a[name="' + this.hash.substr(1) + '"]');
            if (target.length == 0) target = jQuery('html');
            jQuery('html, body').animate({ scrollTop: target.offset().top - 70}, 500);
            return false;
        });
    });
</script>