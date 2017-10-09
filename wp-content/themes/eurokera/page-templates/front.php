<?php
/*
Template Name: Front
*/
get_header(); ?>

<?php do_action( 'foundationpress_before_content' ); ?>

<section class="ceo">
	<div class="large-6 medium-6 columns ceo-photo text-right match-quote" style="background-image: url(<?php echo get_field('ceo_photo'); ?>);">
		<div class="short-quote">
			<?php get_template_part('assets/images/quote.svg'); ?><br />
			<h2><?php echo get_field('short_quote'); ?></h2>
			<p class="ceo-name show-for-small"><?php echo get_field('ceo_name'); ?>, CEO</p>
		</div>
	</div>
	<div class="large-6 medium-6 columns long-quote match-quote">
		<p><?php echo get_field('long_quote'); ?></p>
		<div class="hide-for-small">
			<?php get_template_part('assets/images/quote.svg'); ?><br />	
			<p class="ceo-name"><?php echo get_field('ceo_name'); ?>, CEO</p>
		</div>
	</div>
</section>

<section class="numbers">
	<div class="row">
		<div class="large-12 columns text-center">
			<h2><?php echo get_field('num_of_cooktops'); ?> MILLION +</h2>
			<h3>Cooktops</h3>
			<div class="partner saint-gobain">
				<?php get_template_part('assets/images/saint-gobain', 'logo.svg'); ?><br />
				350 years
			</div>
			<div class="plus">+</div>
			<div class="partner corning">
				<?php get_template_part('assets/images/corning', 'logo.svg'); ?><br />
				120 years
			</div><br />
			<div class="num-one partner">
				<?php get_template_part('assets/images/eurokera', 'logo.svg'); ?><br />
				Global Leader in Glass-Ceramic Manufacturing 
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
				<div class="button reverse"><a href="<?php echo get_field('about_us_page'); ?>">About Us</a></div>
			</div>
		</div>
	</div>
</section>

<a class="home-video" href="<?php echo get_field('video_url'); ?>?autoplay=1&modestbranding=1&showinfo=0&rel=0" data-featherlight="iframe" data-featherlight-iframe-width="960" data-featherlight-iframe-height="540" style="background-image: url(<?php echo get_field('video_poster'); ?>);">
	<div class="row">
		<div class="large-12 columns text-center">
			<?php get_template_part('assets/images/play', 'button.svg'); ?><br />
			<?php echo get_field('video_title'); ?>
		</div>
	</div>
</a>

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