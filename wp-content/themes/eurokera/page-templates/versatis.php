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
	</section>



					<?php
					$num_columns = get_sub_field('columns');
					if ($num_columns == 3) {
						$columns = 'large-4 medium-4';
					} else {
						$columns = 'large-3 medium-3';
					}
					?>
				
					<section class="icon-blocks">
						<div class="row">
							<div class="large-12 columns">
								<h2><?php echo get_sub_field('title'); ?></h2>
							</div>
						</div>
						<div class="row">
							<?php if(get_sub_field('blocks')): ?>
								<?php while(has_sub_field('blocks')): ?>
									<div class="<?php echo $columns; ?> columns text-center icon-block">
										<div class="icon-container">
											<?php echo file_get_contents(get_sub_field('icon')); ?>
										</div>
										<h3><?php echo get_sub_field('title'); ?></h3>
										<p><?php echo get_sub_field('paragraph'); ?></p>
									</div>
								<?php endwhile; ?>
							<?php endif; ?>
						</div>
					</section> <!-- icon-blocks -->



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