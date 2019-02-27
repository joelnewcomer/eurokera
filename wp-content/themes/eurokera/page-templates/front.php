<?php
/*
Template Name: Front
*/
get_header(); ?>

<?php do_action( 'foundationpress_before_content' ); ?>

<section class="home-banner text-center" data-paroller-factor="0.3" style="background-image: url('<?php the_post_thumbnail_url("full"); ?>');">
   <?php
   // Insert a line break after the first period
   $desc = get_bloginfo('description');
   $desc = __('EuroKera glass-ceramic. Transform the soul of your home.', 'foundationpress');
   if (ICL_LANGUAGE_CODE!='zh-hans' && ICL_LANGUAGE_CODE!='vi') {
	   $period_pos = strpos($desc, '.') + 1;
	   $desc = substr_replace($desc, '<br />', $period_pos, 0);
	}
	?>
	<div class="center-banner" style="display:table;width: 100%; height:100%; text-align: center;">
       	<div style="display:table-cell;vertical-align:middle;text-align:center;width: 100%;">
	          <h1><?php echo $desc; ?></h1>
   <?php get_template_part('template-parts/content','site-links'); ?>
       </div>
   </div>

   <div class="down-arrow bounce animated"><?php get_template_part('assets/images/acc', 'arrow.svg'); ?></div>
   <script>
      jQuery( document ).ready(function() {
      	var nav = jQuery('.header-wrapper').offset();
      	var $window = jQuery(window);
   
      	$window.scroll(function () {
      	    if ($window.scrollTop() >= nav.top) {
      	        jQuery(".header-wrapper").addClass("stuck");
      	    } else {
      		    jQuery(".header-wrapper").removeClass("stuck");
      	    }
      	});
   
      	jQuery('.home-banner .down-arrow').click(function() {
      	    jQuery('html, body').animate({ scrollTop: jQuery('#masthead').offset().top}, 1000);
      	});
      });			
   </script>
</section>



<?php $content = get_field('homepage_content'); ?>
<?php if ($content != '') : ?>
<section class="homepage-content">
	<div class="large-12 columns">
		<?php echo $content; ?>
	</div>
</section>
<?php endif; ?>

<section class="ceo">
	<?php
	$ceo_photo = get_field('ceo_photo');
	if (is_numeric($ceo_photo)) {
		$ceo_photo_url = wp_get_attachment_image_src($ceo_photo, 'full');
		$ceo_photo = $ceo_photo_url[0];
	}
	?>
	<div class="large-6 medium-6 columns ceo-photo text-right match-quote" style="background-image: url(<?php echo $ceo_photo; ?>);">
		<div class="short-quote">
			<?php get_template_part('assets/images/quote.svg'); ?><br />
			<h2><?php echo get_field('short_quote'); ?></h2>
			<p class="ceo-name show-for-small"><?php echo get_field('ceo_name'); ?>, <?php _e('CEO'); ?></p>
		</div>
	</div>
	<div class="large-6 medium-6 columns long-quote match-quote">
		<p><?php echo get_field('long_quote'); ?></p>
		<div class="hide-for-small">
			<?php get_template_part('assets/images/quote.svg'); ?><br />	
			<p class="ceo-name"><?php echo get_field('ceo_name'); ?>, <?php _e('CEO'); ?></p>
		</div>
	</div>
</section>

<section class="numbers">
	<div class="row">
		<div class="large-12 columns text-center">
			<?php $num_cooktops = get_field('num_of_cooktops'); ?>
			<h2><?php echo sprintf( __('%s MILLION +', 'foundationpress'), $num_cooktops); ?></h2>
			<h3><?php _e('Cooktops'); ?></h3>
			<div class="partner saint-gobain">
				<a href="https://www.saint-gobain.com" target="_blank">	
					<?php get_template_part('assets/images/saint-gobain', 'logo.svg'); ?>
				</a><br />
				350 <?php _e('years'); ?>
			</div>
			<div class="plus">+</div>
			<div class="partner corning">
				<a href="http://www.corning.com/" target="_blank">
					<?php get_template_part('assets/images/corning', 'logo.svg'); ?>
				</a><br />
				160 <?php _e('years'); ?>
			</div><br />
			<div class="num-one partner">
				<?php get_template_part('assets/images/eurokera', 'logo.svg'); ?><br />
				<?php _e('Global Leader in Glass-Ceramic Manufacturing '); ?>
			</div>
		</div>
	</div>
</section>

<section class="about" data-paroller-factor="0.3">
	<div class="row">
		<div class="large-12 columns">
			<div class="text-center">
				<h2><?php echo get_field('about_title'); ?></h2>
			</div>
			<div class="small-text-center">
				<p><?php echo get_field('about_us_content'); ?></p>
			</div>
			<div class="text-center">
				<div class="button reverse"><a href="<?php echo get_field('about_us_page'); ?>"><?php _e('About Us'); ?></a></div>
			</div>
		</div>
	</div>
</section>

	<?php
	$video_poster = get_field('video_poster');
	if (is_numeric($video_poster)) {
		$video_poster_url = wp_get_attachment_image_src($video_poster, 'full');
		$video_poster = $video_poster_url[0];
	}
	?>
<?php if (ICL_LANGUAGE_CODE == 'zh-hans') : ?>	
	<?php
	$video_markup = '<a class="home-video vp-s vp-mp4-type" href="' . get_field('video_url') . '" data-autoplay="1" data-dwrap="1" style="background-image: url(' . $video_poster . ');"></a>';
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

<section class="site-links">
	<div class="row">
		<div class="large-12 columns text-center">
			<?php get_template_part('template-parts/content','site-links'); ?>
		</div>
	</div>
</section>

<script>
	jQuery( window ).load(function() {
		jQuery('.match-quote').matchHeight();
	});
</script>

<?php do_action( 'foundationpress_after_content' ); ?>

<?php get_footer(); ?>