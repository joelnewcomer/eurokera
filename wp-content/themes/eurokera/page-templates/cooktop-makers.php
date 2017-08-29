<?php
/*
Template Name: Cooktop Makers
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
					$link_type = get_sub_field('link_type');
					if ($link_type != 'URL') {
						$link = get_sub_field('link');
					} else {
						$link = get_sub_field('url');
					}
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

<?php echo get_template_part('template-parts/product','selector'); ?>

<section class="customers">
	<div class="row">
		<div class="large-12 columns text-center">
			<h2>Among Our Valued Customers</h2>
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

<section class="makers-details">
	<?php $glass_ceramic_img = wp_get_attachment_image_src( get_field('glass_ceramic_image'), 'full' ); ?>
	<div class="large-6 medium-6 columns glass-ceramic text-center" style="background: url(<?php echo $glass_ceramic_img[0]; ?>);">
		<div style="display:table;width:100%;height:100%;">
		  <div style="display:table-cell;vertical-align:middle;">
		    <div style="text-align:center;"><h2><?php echo get_field('glass_ceramic_title'); ?></h2></div>
		  </div>
		</div>
	</div>
	<div class="large-6 medium-6 columns cooking-methods text-center">
		<div style="display:table;width:100%;height:100%;">
		  <div style="display:table-cell;vertical-align:middle;">
		    <div style="text-align:center;">
				<h2>Different Cooking Methods</h2>
				<a href="<?php echo get_field('cooking_methods_link'); ?>" class="heat-source gas">
					<?php get_template_part('assets/images/gas.svg'); ?><br />
					Gas
				</a>		
				<a href="<?php echo get_field('cooking_methods_link'); ?>" class="heat-source induction">
					<?php get_template_part('assets/images/induction.svg'); ?><br />
					Induction
				</a>	
				<a href="<?php echo get_field('cooking_methods_link'); ?>" class="heat-source radiant">
					<?php get_template_part('assets/images/radiant.svg'); ?><br />
					Radiant
				</a>				    
		    </div>
		  </div>
		</div>		
	</div>
</section>

<?php echo get_template_part('template-parts/content','ready'); ?>

<?php do_action( 'foundationpress_after_content' ); ?>

<div id="work-together" class="epop-content transition">
	<div class="epop-overlay"></div>
	<div class="epop-form text-center">		
		<?php gravity_form(4, false, false, false, '', true, 12); ?>
	</div>
</div>

<?php get_footer(); ?>

<script>
jQuery( "#work-together-btn" ).on( "click", function(e) {
	e.preventDefault();
	jQuery('#work-together').toggleClass('active');
});

jQuery( ".epop-overlay" ).on( "click", function() {
	jQuery('.epop-content').removeClass('active');
});
</script>

<script type="text/javascript">
jQuery(document).bind('gform_confirmation_loaded', function(event, formId){
    setTimeout(function(){ jQuery('.epop-content').removeClass('active'); }, 3000);
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