<?php
/*
Template Name: Worldclass Manufacturing
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image-parallax' ); ?>

<?php do_action( 'foundationpress_before_content' ); ?>

<section class="manu-intro">
	<div class="row">
		<div class="large-12 columns entry-content">
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
		<h2 class="reverse secondary"><?php _e('Europe & North America'); ?></h2>
		<div class="location europe-usa">
			<div style="display:table;width:100%;height:100%;">
			  <div style="display:table-cell;vertical-align:middle;">
			    <div style="text-align:center;">
				    			<?php get_template_part('assets/images/france.svg'); ?>
			<p><?php _e('Château-Thierry, France'); ?></p>
			<?php get_template_part('assets/images/usa.svg'); ?>
			<p><?php _e('Fountain Inn, SC USA'); ?></p>
			    </div>
			  </div>
			</div>

		</div>
	</div>
	<div class="large-6 medium-6 columns text-center no-padding">
		<h2 class="reverse primary"><?php _e('China & Thailand'); ?></h2>
		<div class="location asia">
			<div style="display:table;width:100%;height:100%;">
				<div style="display:table-cell;vertical-align:middle;">
			    	<div style="text-align:center;">
				    	<?php get_template_part('assets/images/china.svg'); ?>
						<p><?php _e('Guangzhou, China'); ?></p>
						<?php get_template_part('assets/images/thailand.svg'); ?>
						<p><?php _e('Rayong, Thailand'); ?></p>
			    </div>
			  </div>
			</div>
		</div>
	</div>	
</section>

<section class="final-steps">
	<div class="row">
		<div class="large-12 columns text-center entry-content">
			<?php echo get_field('final_steps'); ?>
		</div>
	</div>
</section>

<section class="let-us">
	<div class="row">
		<div class="large-12 columns text-center">
			<h2><?php _e('Let Us Build Your Future Innovative Cooking Surface'); ?></h2>
			<div class="site-links">
				<div class="button">
					<?php $contact_page = get_page_by_path('contact'); ?>
					<a href="<?php echo get_permalink($contact_page->ID); ?>"><?php _e('Contact Us'); ?></a>
				</div>
			</div>
		</div>
	</div>
</section>

<?php do_action( 'foundationpress_after_content' ); ?>

<?php get_footer(); ?>