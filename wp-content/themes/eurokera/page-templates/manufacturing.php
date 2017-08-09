<?php
/*
Template Name: Worldclass Manufacturing
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image-parallax' ); ?>

<?php do_action( 'foundationpress_before_content' ); ?>

<section class="manu-intro">
	<div class="row">
		<div class="large-12 columns">
			<?php echo get_field('intro'); ?>
		</div>
	</div>
</section>

<section class="shipped">
	<div class="row">
		<div class="large-12 columns text-center">
			<?php get_template_part('assets/images/shipping.svg'); ?><br />
			<?php echo get_field('shipped_content'); ?>
		</div>
	</div>
</section>

<section class="locations">
	<div class="large-6 medium-6 columns text-center no-padding">
		<h2 class="reverse secondary">Europe & North America</h2>
		<div class="location europe-usa">
			<div style="display:table;width:100%;height:100%;">
			  <div style="display:table-cell;vertical-align:middle;">
			    <div style="text-align:center;">
				    			<?php get_template_part('assets/images/france.svg'); ?>
			<p>Château-Thierry, France</p>
			<?php get_template_part('assets/images/usa.svg'); ?>
			<p>Fountain Inn, SC USA</p>
			    </div>
			  </div>
			</div>

		</div>
	</div>
	<div class="large-6 medium-6 columns text-center no-padding">
		<h2 class="reverse primary">China & Thailand</h2>
		<div class="location asia">
			<div style="display:table;width:100%;height:100%;">
				<div style="display:table-cell;vertical-align:middle;">
			    	<div style="text-align:center;">
				    	<?php get_template_part('assets/images/china.svg'); ?>
						<p>Guangzhou, China</p>
						<?php get_template_part('assets/images/thailand.svg'); ?>
						<p>Rayong, Thailand</p>
			    </div>
			  </div>
			</div>
		</div>
	</div>	
</section>

<section class="final-steps">
	<div class="row">
		<div class="large-12 columns text-center">
			<?php echo get_field('final_steps'); ?>
		</div>
	</div>
</section>

<section class="let-us">
	<div class="row">
		<div class="large-12 columns text-center">
			<h2>Let Us Build Your Future Innovative Cooking Surface</h2>
			<div class="site-links">
				<div class="button">
					<a href="<?php echo get_site_url(); ?>/cooktop-makers">Cooktop Makers</a>
				</div>
				<div class="button blue">
					<a href="<?php echo get_site_url(); ?>/cooktop-users">Cooktop Users</a>
				</div>
			</div>
		</div>
	</div>
</section>

<?php do_action( 'foundationpress_after_content' ); ?>

<?php get_footer(); ?>