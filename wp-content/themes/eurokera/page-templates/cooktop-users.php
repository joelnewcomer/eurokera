<?php
/*
Template Name: Cooktop Users
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image-parallax' ); ?>

<?php do_action( 'foundationpress_before_content' ); ?>

<?php $epops = ""; ?>

<section class="users-gallery text-center">
	<div class="row">
		<div class="large-12 columns text-center">
			<h2>Transform the Heart of Your Home with EuroKera</h2>
		</div>
	</div>

		<?php 
		$images = get_field('gallery');
		$gallery_dot_width = (100 / count($images));
		?>
		<style>
			.owl-theme.users-gallery-carousel .owl-dots .owl-dot {
				width: <?php echo $gallery_dot_width; ?>%;
			}
		</style>
	
	<div class="users-gallery-carousel owl-theme owl-carousel">
		<?php
		if( $images ): ?>
			<?php foreach( $images as $image ): ?>
			    <div class="users-gallery-image">
			    	<?php echo wp_get_attachment_image( $image['ID'], 'width=936&height=475&crop=1' ) ?>
			        <p class="caption"><?php echo $image['caption']; ?></p>
			    </div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<script>
		jQuery(document).ready(function(){
			jQuery('.owl-carousel').owlCarousel({
				loop: true,
				margin: 0,
				nav: false,
				dots: true,
				center: true,
				autoplay: true,
			    responsive:{
			        0:{
			            items:1
			        },
			        600:{
			            items:2
			        },
			        1000:{
			            items:2
			        }
			    }
			})
		});		
	</script>
</section>

<section class="clean-identify">
	<div class="large-6 medium-6 columns clean-cooktop text-center">
		<div style="display:table;width:100%;height:100%;">
		  <div style="display:table-cell;vertical-align:middle;">
		    <div style="text-align:center;">
			    <h2>How to Clean Your Cooktop</h2>
				<div class="button reverse"><a href="<?php echo get_field('clean_link'); ?>">Learn More</a></div>
		    </div>
		  </div>
		</div>
		
	</div>
	<div class="large-6 medium-6 columns coming-soon text-center">
		<div style="display:table;width:100%;height:100%;">
		  <div style="display:table-cell;vertical-align:middle;">
		    <div style="text-align:center;"><h2>Content Coming Soon</h2></div>
		  </div>
		</div>
	</div>	
</section>



<section class="users-intro intro">
	<div class="row">
		<div class="large-12 columns text-center entry-content">
			<?php echo get_field('intro'); ?>
		</div>
	</div>
</section>

<section class="image-links">
	<div class="row">
		<?php if(get_field('image_links')): ?>
			<?php while(has_sub_field('image_links')): ?>
				<div class="large-4 medium-4 small-6 columns text-center">
					<?php $epop_id = sanitize_title(get_sub_field('title')); ?>
					<a href="#" class="epop-link image-link" data-epop="#<?php echo $epop_id; ?>">
						<?php
						echo wp_get_attachment_image( get_sub_field('image'), 'width=261&height=261&crop=1' ); ?>
						<div class="overlay">
							<div style="display:table;width:100%;height:100%;">
								<div style="display:table-cell;vertical-align:middle;">
									<div style="text-align:center;"><h3><?php echo get_sub_field('title'); ?></h3></div>
								</div>
							</div>
						</div>
					</a>				
				</div>
				<?php
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
						</div>
					</div>
				</div>'; ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>

<section class="cooking-methods users-cooking-methods">
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
</section>

<section class="locate-support">
	<div class="large-6 medium-6 columns text-center locate">
		<div style="display:table;width:100%;height:100%;">
		  <div style="display:table-cell;vertical-align:middle;">
		    <div style="text-align:center;">
			    <h2>Where Can I Find a EuroKera Cooktop?</h2>
				<div class="button reverse"><a href="<?php echo get_field('locate_now_link'); ?>">Locate Now</a></div>
		    </div>
		  </div>
		</div>
	</div>
	<div class="large-6 medium-6 columns identify-cooktop text-center">
		<a class="epop-link" data-epop="#identify" href="#">
			<div style="display:table;width:100%;height:100%;">
			  <div style="display:table-cell;vertical-align:middle;">
			    <div style="text-align:center;">
				    <?php get_template_part('assets/images/cooktop.svg'); ?><br />
					<h2>How to Identify EuroKera Cooktops</h2>
			    </div>
			  </div>
			</div>			
		</a>
	</div>		
	<!-- <div class="large-6 medium-6 columns text-center support">
		<div style="display:table;width:100%;height:100%;">
		  <div style="display:table-cell;vertical-align:middle;">
		    <div style="text-align:center;">
			    <h2>We Can Help You With Your Cooktop</h2>
				<div class="button reverse"><a href="<?php echo get_field('support_link'); ?>">Service & Support</a></div>
		    </div>
		  </div>
		</div>
	</div> -->
</section>

		<div class="epop-content transition" id="identify">
			<div class="epop-overlay"></div>
			<div class="epop-identify text-center">
				<div class="epop-close">&times;</div>
				<h3>Look for these Logos On Your Cooktop</h3><br />
				<?php get_template_part('assets/images/k.svg'); ?>
				<?php get_template_part('assets/images/eurokera', 'logo.svg'); ?>
			</div>
		</div>

<?php do_action( 'foundationpress_after_content' ); ?>

<?php get_footer(); ?>

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