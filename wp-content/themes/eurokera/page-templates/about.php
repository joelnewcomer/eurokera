<?php
/*
Template Name: About
*/
get_header(); ?>

<?php do_action( 'foundationpress_before_content' ); ?>

	<?php
	$video_poster = get_field('video_poster', get_option( 'page_on_front' ));
	if (is_numeric($video_poster)) {
		$video_poster_url = wp_get_attachment_image_src($video_poster, 'full');
		$video_poster = $video_poster_url[0];
	}
	?>
<?php if (ICL_LANGUAGE_CODE == 'zh-hans') : ?>	
	<?php
	$video_markup = '<a class="home-video vp-a vp-mp4-type" style="background-image: url(' . $video_poster . ');" href="' . get_field('video_url', get_option( 'page_on_front' )) . '" data-autoplay="1" data-dwrap="1"></a>';
	echo apply_filters('the_content', $video_markup);
	$video_inner = '<div class="row"><div class="large-12 columns text-center">';
	ob_start();
	get_template_part('assets/images/play', 'button.svg');
	$play_button = ob_get_contents();
	ob_end_clean();
	$video_inner .= $play_button;
	$video_inner .= '<br />' . get_field('video_title', get_option( 'page_on_front' )) . '</div></div>';
	?>
	<script>
		jQuery('a.home-video').html('<?php echo $video_inner; ?>');
	</script>
<?php else: ?>
	<a class="home-video" href="<?php echo get_field('video_url', get_option( 'page_on_front' )); ?>?autoplay=1&modestbranding=1&showinfo=0&rel=0" data-featherlight="iframe" data-featherlight-iframe-width="960" data-featherlight-iframe-height="540" style="background-image: url(<?php echo $video_poster; ?>);">
		<div class="row">
			<div class="large-12 columns text-center">
				<?php get_template_part('assets/images/play', 'button.svg'); ?><br />
				<?php echo get_field('video_title', get_option( 'page_on_front' )); ?>
			</div>
		</div>
	</a>
<?php endif; ?>

<section class="timeline">
	<div class="row">
		<div class="large-12 columns text-center about-logos">
			<div class="saint-gobain history-logo">
				<a href="<?php echo get_field('saint_gobain_website'); ?>" target="_blank">
					<?php get_template_part('assets/images/saint-gobain', 'logo.svg'); ?>
				</a>
			</div>
			<div class="plus">+</div>
			<div class="corning history-logo">
				<a href="<?php echo get_field('corning_website'); ?>" target="_blank">
					<?php get_template_part('assets/images/corning', 'logo.svg'); ?><br />
				</a>
			</div>
			<div class="equals">=</div>
			<br />
			<div class="num-one history-logo">
				<?php get_template_part('assets/images/eurokera', 'logo.svg'); ?><br />
			</div>
		</div>
		
		<div class="large-12 columns text-center timeline-columns">
			<?php if(get_field('timeline')): ?>
				<?php while(has_sub_field('timeline')): ?>
				<article class="flip-container">
					<div class="card">
					    <figure class="front">
					    	<div style="display:table;width:100%;height:100%;">
					    		<div style="display:table-cell;vertical-align:middle;">
					    	    	<div style="text-align:center;"><?php the_sub_field('year'); ?></div>
					    		</div>
					    	</div>
					    </figure>
					    <figure class="back">
					    	<div style="display:table;width:100%;height:100%;">
					    		<div style="display:table-cell;vertical-align:middle;">
					    	    	<div class="back-inner" style="text-align:center;"><?php the_sub_field('blurb'); ?></div>
					    		</div>
					    	</div>
					    </figure>
					</div>
				</article>
				<?php endwhile; ?>

				<!-- CURRENT YEAR AUTO-UPDATED -->
				<article class="flip-container">
					<div class="card">
					    <figure class="front">
					    	<div style="display:table;width:100%;height:100%;">
					    		<div style="display:table-cell;vertical-align:middle;">
					    	    	<div style="text-align:center;"><?php echo date("Y"); ?></div>
					    		</div>
					    	</div>
					    </figure>
					    <figure class="back">
					    	<div style="display:table;width:100%;height:100%;">
					    		<div style="display:table-cell;vertical-align:middle;">
								<?php
								$num_cooktops = 100; // Start at 100+ Million Cooktops
								$num_start = 1514764800; // Jan 2018	
								$num_increment = 5; // Increment 5 Million every six months
								$current_date = time();
								$six_months = 15780000;
								$time_diff = $current_date - $num_start;
								$increment_by = intval($time_diff / $six_months);
								$num_cooktops = ($num_increment*$increment_by) + $num_cooktops;
								?>
								<div class="back-inner" style="text-align:center;"><?php echo $num_cooktops; ?>+ <?php _e('million cooking surfaces made','foundationpress'); ?></div>
					    		</div>
					    	</div>
					    </figure>
					</div>
				</article>


			<?php endif; ?>

			<script>
				jQuery(document).ready(function() {
				    jQuery('.flip-container').on('mouseenter', function(){
					    // Flip others back over
					    jQuery('.flip-container.flipped').find('.back').css('transform','rotateY(180deg)');
						jQuery('.flip-container.flipped').find('.front').css('transform','rotateY(0deg)');
						jQuery('.flip-container.flipped').removeClass('flipped');
							
						// Flip this one
						jQuery(this).find('.back').css('transform','rotateY(0deg)');
						jQuery(this).find('.front').css('transform','rotateY(180deg)');
						jQuery(this).addClass('flipped');
					});
					jQuery('.flip-container').on('mouseleave', function(){
				        	jQuery(this).find('.back').css('transform','rotateY(180deg)');
							jQuery(this).find('.front').css('transform','rotateY(0deg)');
							jQuery(this).removeClass('flipped');
				    });

					// When timeline is in viewport then flip first year
					var ranOnce = false;
					jQuery('.timeline-columns').bind('inview', function (event, visible) {
						if (visible == true && !ranOnce) {
							setTimeout(function(){  
								jQuery('.flip-container:first-child').find('.back').css('transform','rotateY(0deg)');
								jQuery('.flip-container:first-child').find('.front').css('transform','rotateY(180deg)');
								jQuery('.flip-container:first-child').addClass('flipped');
								ranOnce = true;
							}, 1000);
					  	}
					});	

				});
				
			
			</script>

		</div> <!-- columns -->

	</div> <!-- row -->
</section> <!-- timeline -->

<section class="about-intro">
	<?php
	$intro_photo = get_field('intro_photo');
	if (is_numeric($intro_photo)) {
		$intro_photo_url = wp_get_attachment_image_src($intro_photo, 'full');
		$intro_photo = $intro_photo_url[0];
	}
	?>
	<div class="about-photo match-intro" style="background-image: url(<?php echo $intro_photo; ?>);"></div>
	<div class="about-content match-intro">
		<?php echo get_field('intro'); ?>
	</div>
</section>

<section class="about-video">
	<?php $new_video = false; ?>
	<div class="row">
		<?php if ($new_video) : ?>
		<div class="large-4 medium-4 columns">
	<?php
	$video_poster = get_field('video_poster');
	if (is_numeric($video_poster)) {
		$video_poster_url = wp_get_attachment_image_src($video_poster, 'full');
		$video_poster = $video_poster_url[0];
	}
	?>
<?php if (ICL_LANGUAGE_CODE == 'zh-hans') : ?>	
	<?php
	$video_markup = '<a class="about-video vp-a vp-mp4-type" style="background-image: url(' . $video_poster . ');" href="' . get_field('video_url') . '" data-autoplay="1" data-dwrap="1"></a>';
	echo apply_filters('the_content', $video_markup);
	$video_inner = '<div class="video-overlay text-center">';
	ob_start();
	get_template_part('assets/images/play', 'button.svg');
	$play_button = ob_get_contents();
	ob_end_clean();
	$video_inner .= $play_button;
	$video_inner .= '<br />' . get_field('video_title') . '</div>';
	?>
	<script>
		jQuery('a.about-video').html('<?php echo $video_inner; ?>');
	</script>
<?php else: ?>
	<a class="about-video" href="<?php echo get_field('video_url'); ?>?autoplay=1&modestbranding=1&showinfo=0&rel=0" data-featherlight="iframe" data-featherlight-iframe-width="960" data-featherlight-iframe-height="540" style="background-image: url(<?php echo $video_poster; ?>);">
		<div class="video-overlay text-center">
			<?php get_template_part('assets/images/play', 'button.svg'); ?><br />
			<?php echo get_field('video_title'); ?>
		</div>
	</a>
<?php endif; ?>			
		</div>
		<div class="large-8 medium-8 columns about-video-content">
			<?php else : ?>
				<div class="large-12 columns about-video-content">
			<?php endif; ?>
			<?php echo get_field('video_video_content'); ?>
		</div>
</section>

<section class="about-ceo">
	<?php
	$intro_photo = get_field('ceo_block_photo');
	if (is_numeric($intro_photo)) {
		$intro_photo_url = wp_get_attachment_image_src($intro_photo, 'full');
		$intro_photo = $intro_photo_url[0];
	}
	?>
	<div class="ceo-photo match-ceo" style="background-image: url(<?php echo $intro_photo; ?>);"></div>
	<div class="ceo-content match-ceo text-center flex-center">
		<p><i><?php echo get_field('ceo_block_quote'); ?></i></p>
		<p class="ceo-name"><?php echo get_field('ceo_block_name'); ?>,<br />
		<?php echo get_field('ceo_block_title'); ?></p>
	</div>
</section>

<section class="process">
	<div class="row">
		<div class="large-12 columns text-center">
			<h2 class="orange"><?php echo get_field('manu_process_title'); ?></h2>
		</div>
	</div>
	<div class="process-steps flex">
		<?php $counter = 1; ?>
		<?php if(get_field('manufacturing_process')): ?>
			<?php while(has_sub_field('manufacturing_process')): ?>
				<div class="process-step">
					<div class="process-inner">
						<div class="process-icon">
							<?php echo file_get_contents(get_sub_field('icon')); ?>
						</div>
						<div class="process-content">
							<h3><span class="process-num"><?php echo $counter; ?> </span> <?php echo get_sub_field('title'); ?></h3>
							<?php echo get_sub_field('description'); ?>
						</div>
					</div> <!-- process-inner -->
				</div> <!-- process-step -->
				<?php $counter++; ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div> <!-- process-steps -->
</section> <!-- process -->

<!-- <section class="facts">
	<div class="row">
		<div class="large-6 medium-6 columns cooktop">
			<div class="facts-box match-facts">
				<?php get_template_part('assets/images/cooktop.svg'); ?>
				<?php echo sprintf( __('<h3 class="green">%s</h3><p>EuroKera glass-ceramic panels produced since 1990</p>','foundationpress'), get_field('qty_produced')); ?>
			</div>
		</div>
		<div class="large-6 medium-6 columns stopwatch">
			<div class="facts-box border match-facts">
				<?php get_template_part('assets/images/stopwatch.svg'); ?>
				<?php _e('<p>We produce a glass-ceramic cooking surface</p>
				<h3>Every <span class="caps green">5 seconds</span></h3>','foundationpress'); ?>
			</div>		
		</div>
	</div>
</section> -->

<section class="reach text-center">
	<img class="hide-for-small" src="<?php echo get_template_directory_uri(); ?>/assets/images/global-reach-bg-hires.jpg" alt="EuroKera Worldwide Locations Map">
	<div class="reach-overlay">
		<div class="hide-for-small" style="display:table;width:100%;height:100%;">
			<div style="display:table-cell;vertical-align:middle;">
		    	<div style="text-align:center;"><h2><?php _e('Global Reach','foundationpress'); ?></h2></div>
		  	</div>
		</div>
		<div class="show-for-small">
			<h2><?php _e('Global Reach','foundationpress'); ?></h2>
			<div class="global-locations show-for-small text-center">
				<p>
					<?php _e('Château-Thierry, France','foundationpress'); ?><br />
					<?php _e('Bagneaux-sur-Loing, France','foundationpress'); ?><br />
					<?php _e('Fountain Inn, SC, USA','foundationpress'); ?><br />
					<?php _e('Guangzhou, China','foundationpress'); ?><br />
					<?php _e('Rayong, Thailand','foundationpress'); ?>
				</p>
			</div>
		</div>
		<!-- <div class="button gray"><a href="<?php echo get_field('wm_page'); ?>"><?php _e('Worldwide Manufacturing','foundationpress'); ?></a></div> -->
	</div> <!-- reach-overlay -->
</section>

<section class="mission-vision">
	<div class="row">
		<div class="large-4 medium-4 columns">
			<?php echo get_field('mission'); ?>
		</div>
		<div class="large-4 medium-4 columns">
			<?php echo get_field('vision'); ?>
		</div>
		<div class="large-4 medium-4 columns">
			<?php echo get_field('values'); ?>
		</div>		
	</div>
</section> <!-- mission-vision -->

<section id="environment" class="enviro">
	<div class="row enviro-intro">
		<div class="large-12 columns">
			<?php echo get_field('enviro_content'); ?>
		</div>
	</div>
	<div class="row enviro-facts text-center">
		<div class="recycled fact">
			<?php $recycle_year = get_field('recycle_year'); ?>
			<p><?php echo sprintf( __('<span class="h2"><span id="recycled-glass"></span>+</span> tons of glass recycled in %s within our manufacturing process at KeraGlass.','foundationpress'), $recycle_year); ?></p>
			<script>
				jQuery(document).ready(function(){
					// Make sure ID exists
					if(jQuery("#recycled-glass").length != 0) {
						var easingFn = function (t, b, c, d) {
						  var ts = (t /= d) * t;
						  var tc = ts * t;
						  return b + c * (tc + -3 * ts + 3 * t);
						}
						var glass = {
						  useEasing : true,
						  easingFn: easingFn,
						  useGrouping : true,
						  separator : ',',
						  decimal : '.',
						  prefix : '',
						  suffix : ''
						};
						var tonsofglass = new CountUp("recycled-glass", 0, <?php echo get_field('recycle_tons'); ?>, 0, 6, glass);
						// tonsofgalass.start();
						function startTonsAnim() {
							tonsofglass.start();
						}
						inView('#environment').on('enter', startTonsAnim);
					}
				});
			</script>
		</div>
		<div class="substrates fact large">
			<?php get_template_part('assets/images/eurokera-enviro', 'logo.svg'); ?><br />
			<p><?php _e('<strong><span class="caps">No</span> arsenic or antimony</strong> used to manufacture black substrates.','foundationpress'); ?></p>
		</div>		
		<div class="landfill fact">
			<h2 id="landfills"></h2>
			<p><?php _e('reduction in landfill waste between 2011 and 2014','foundationpress'); ?></p>

				<script>


						jQuery(document).ready(function(){
							var easingFn = function (t, b, c, d) {
							  var ts = (t /= d) * t;
							  var tc = ts * t;
							  return b + c * (tc + -3 * ts + 3 * t);
							}
							var options = {
							  useEasing : true,
							  easingFn: easingFn,
							  useGrouping : true,
							  separator : ',',
							  decimal : '.',
							  prefix : '',
							  suffix : '%'
							};
							var landfills = new CountUp("landfills", 0, 50, 0, 6, options);
							//landfills.start();

							function startLandfillsAnim() {
								landfills.start();
							}
							inView('#environment').on('enter', startLandfillsAnim);
						});
				</script>
			
		</div>		
	</div>
</section>

	<section class="all-solutions">
		<div class="row">
			<div class="large-12 columns solutions-intro">
				<h2 class="orange"><?php echo get_field('solutions_title'); ?></h2>
			</div>
		</div>
		<?php if(get_field('all_solutions', get_option( 'page_on_front' ))): ?>
			<?php while(has_sub_field('all_solutions', get_option( 'page_on_front' ))): ?>
				<div class="row solution-row flex-medium-up">
					<?php $src = wp_get_attachment_image_src( get_sub_field('image'), 'width=640&height=350&crop=1'); ?>
					<a href="<?php echo get_sub_field('link'); ?>" class="large-6 large-push-6 medium-push-6 medium-6 columns solution-photo" style="background:url(<?php echo $src[0]; ?>) center center no-repeat;">
					</a>
					<div class="large-6 large-pull-6 medium-pull-6 medium-6 columns solution-about">
						<h3><a class="blue" href="<?php echo get_sub_field('link'); ?>"><?php echo get_sub_field('title'); ?></a></h3>
						<div class="most-popular-content">
							<?php echo get_sub_field('about'); ?>
						</div>
					</div>
				</div> <!-- solution-row -->
			<?php endwhile; ?>
		<?php endif; ?>
	</section> <!-- all-solutions -->

<?php do_action( 'foundationpress_after_content' ); ?>

<?php get_footer(); ?>

<script>
	jQuery( window ).load(function() {
		jQuery('.match-intro').matchHeight();
		jQuery('.match-ceo').matchHeight();
		jQuery('.match-facts').matchHeight({byRow:false});
	});
</script>

<script>
// When page loads, scroll to hash
jQuery(window).load(function() {
    if (window.location.hash != '') {
        jQuery('html, body').animate({ scrollTop: jQuery(window.location.hash).offset().top - 70}, 500); 
    }
});
</script>