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
		<?php $epop_counter = 1; ?>
		<?php if(get_field('image_links')): ?>
			<?php while(has_sub_field('image_links')): ?>
				<div class="large-4 medium-4 small-6 columns text-center">
					<?php
					$link_type = get_sub_field('link_type');
					if ($link_type == 'Page') {
						$link = get_sub_field('link');
					} elseif ($link_type == 'URL') {
						$link = get_sub_field('url');
					} elseif ($link_type == 'Pop-Up') {
						$link = null;
						$epop_id = 'epop-' . $epop_counter;
						echo '<a href="#" class="epop-link image-link" data-epop="#' .  $epop_id . '">';
					}
					if ($link != null) {
						echo '<a class="image-link" href="' . $link . '">';
					} else {
						if ($link == null & $link_type != 'Pop-Up') {
							echo '<div class="image-link">';
						}
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
					if ($link == null & $link_type != 'Pop-Up') {
						echo '</div>';
					} else {
						echo '</a>';
					}
	
					if ($link_type == 'Pop-Up') {
						$epop_bg = wp_get_attachment_image_src( get_sub_field("image"), "width=644&height=644&crop=1" );
						$epops .= '<div class="epop-content" id="' . $epop_id . '">
							<div class="epop-overlay"></div>
							<div class="epop-inner text-center" style="background-image: url(' . $epop_bg[0] . ');">
								<div class="epop-inner-tint"></div>
								<div class="epop-close">&times;</div>
								<div class="epop-inner-content" style="display:table;width:100%;height:100%;">
								  <div style="display:table-cell;vertical-align:middle;">
								    <div style="text-align:center;">' . get_sub_field('pop-up_content') . '</div>
								  </div>
								</div> <!-- epop-inner-content -->
							</div> <!-- epop-inner -->
						</div> <!-- epop-content -->'; 
					}
					?>


				</div>
				<?php $epop_counter++; ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>

<?php echo get_template_part('template-parts/product','selector'); ?>

<!-- <section class="customers">
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
</section> -->

<section class="makers-details">
	<?php
	$glass_ceramic_link = get_field('glass_ceramic_link');
	if (is_numeric($glass_ceramic_link)) {
		$glass_ceramic_link = get_permalink($glass_ceramic_link);
	}
	?>	
	<?php $glass_ceramic_img = wp_get_attachment_image_src( get_field('glass_ceramic_image'), 'full' ); ?>
	<a href="<?php echo $glass_ceramic_link; ?>" class="large-6 medium-6 columns glass-ceramic text-center" style="background: url(<?php echo $glass_ceramic_img[0]; ?>);">
		<div class="transition" style="display:table;width:100%;height:100%;">
		  <div style="display:table-cell;vertical-align:middle;">
		    <div style="text-align:center;"><h2><?php echo get_field('glass_ceramic_title'); ?></h2></div>
		  </div>
		</div>
	</a>
	<div class="large-6 medium-6 columns cooking-methods text-center">
		<div style="display:table;width:100%;height:100%;">
		  <div style="display:table-cell;vertical-align:middle;">
		    <div style="text-align:center;">
				<?php
				$cooking_methods_link = get_field('cooking_methods_link');
				if (is_numeric($cooking_methods_link)) {
					$cooking_methods_link = get_permalink($cooking_methods_link);
				}
				?>
				<h2><?php _e('Different Cooking Methods'); ?></h2>
				<a href="<?php echo $cooking_methods_link; ?>" class="heat-source gas">
					<?php get_template_part('assets/images/gas.svg'); ?><br />
					<?php _e('Gas'); ?>
				</a>		
				<a href="<?php echo $cooking_methods_link; ?>" class="heat-source induction">
					<?php get_template_part('assets/images/induction.svg'); ?><br />
					<?php _e('Induction'); ?>
				</a>	
				<a href="<?php echo $cooking_methods_link; ?>" class="heat-source radiant">
					<?php get_template_part('assets/images/radiant.svg'); ?><br />
					<?php _e('Radiant'); ?>
				</a><br />
				<a href="<?php echo $cooking_methods_link; ?>"><?php _e('Click to Learn More'); ?></a>			    
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
		<!-- <div class="epop-close">&times;</div> -->
		<?php gravity_form(4, false, false, false, '', true, 12); ?>
	</div>
</div>

<?php get_footer(); ?>

<script>
jQuery( "#work-together-btn" ).on( "click", function(e) {
	e.preventDefault();
	jQuery('#work-together').toggleClass('active');
});

jQuery( ".epop-overlay,.epop-close" ).on( "click", function() {
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

<?php echo $epops; ?>

<script>
jQuery( ".epop-link" ).on( "click", function(e) {
	e.preventDefault();
	var epopID = jQuery(this).data('epop');
	jQuery(epopID).toggleClass('active');
});

jQuery( ".epop-close, .epop-overlay" ).on( "click", function() {
	jQuery('.epop-content').removeClass('active');
});
</script>