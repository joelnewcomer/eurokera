<?php
/*
Template Name: Cooktop Users
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image-parallax' ); ?>

<?php do_action( 'foundationpress_before_content' ); ?>

<section class="intro">
	<div class="row">
		<div class="large-12 columns">
			<?php echo get_field('intro'); ?>
		</div>
	</div>
</section>

<section class="image-links">
	<div class="row">
		<?php if(get_field('image_links')): ?>
			<?php while(has_sub_field('image_links')): ?>
				<div class="large-4 medium-4 small-6 columns text-center">
					<?php
					$link = get_sub_field('link');
					if ($link != null) {
						echo '<a class="image-link" href="' . $link . '">';
					} else {
						echo '<div class="image-link">';
					}
					echo wp_get_attachment_image( get_sub_field('image'), 'width=261&height=261&crop=1' ); ?>
					
					<div class="overlay">
						<div style="display:table;width:100%;height:100%;">
							<div style="display:table-cell;vertical-align:middle;">
								<div style="text-align:center;"><h3><?php echo get_sub_field('title'); ?></h3></div>
							</div>
						</div>
					</div>
					
					<?php
					if ($link != null) {
						echo '</a>';
					} else {
						echo '</div>';
					}
					?>					
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>

<section class="users-gallery">
	<div class="row">
		<div class="large-12 columns text-center">
			<h2>Transform the Heart of Your Home with EuroKera</h2>
		</div>
		<div class="large-12 columns text-center">
			<div class="logo-carousel owl-theme owl-carousel">
				<?php if(get_field('customer_logos')): ?>
					<?php while(has_sub_field('customer_logos')): ?>
						<div class="customer-logo">
							<div style="display:table;width:100%;height:100%;">
							  <div style="display:table-cell;vertical-align:middle;">
							    <div style="text-align:center;"><?php echo wp_get_attachment_image( get_sub_field('logo'), 'width=250&height=115&crop=0' ); ?></div>
							  </div>
							</div>		
						</div>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<script>
		jQuery(document).ready(function(){
			jQuery('.owl-carousel').owlCarousel({
			    loop:true,
			    margin:10,
			    nav:true,
			    dots: false,
			    autoplay: true,
			    responsive:{
			        0:{
			            items:1
			        },
			        600:{
			            items:3
			        },
			        1000:{
			            items:4
			        }
			    }
			})
		});		
	</script>
</section>

<section class="cooking-methods">
	<div style="display:table;width:100%;height:100%;">
	  <div style="display:table-cell;vertical-align:middle;">
	    <div style="text-align:center;">
			<h2>Different Cooking Methods</h2>
			<div class="heat-source gas">
				<?php get_template_part('assets/images/gas.svg'); ?><br />
				Gas
			</div>		
			<div class="heat-source induction">
				<?php get_template_part('assets/images/induction.svg'); ?><br />
				Induction
			</div>	
			<div class="heat-source radiant">
				<?php get_template_part('assets/images/radiant.svg'); ?><br />
				Radiant
			</div>				    
	    </div>
	  </div>
	</div>		
</section>


<?php do_action( 'foundationpress_after_content' ); ?>

<?php get_footer(); ?>