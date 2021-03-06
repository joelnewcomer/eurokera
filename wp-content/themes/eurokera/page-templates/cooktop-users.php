<?php
/*
Template Name: Cooktop Users
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image-parallax' ); ?>

<?php do_action( 'foundationpress_before_content' ); ?>

<?php
$epops = ""; 
global $post;	
?>

<section class="users-gallery text-center">
	<div class="row">
		<div class="large-12 columns text-center">
			<h2><?php _e('Transform the Heart of Your Home with EuroKera'); ?></h2>
		</div>
	</div>

		<?php 
		$images = get_post_meta($post->ID, 'gallery', true);
		$gallery_dot_width = (100 / count($images));
		?>
		<style>
			.owl-theme.users-gallery-carousel .owl-dots .owl-dot {
				width: <?php echo $gallery_dot_width; ?>%;
			}
		</style>
	
	<div class="users-gallery-carousel owl-theme owl-carousel" data-featherlight-gallery data-featherlight-filter="a">
		<?php	
		// print_r($images);
		if( $images ): ?>
			<?php foreach( $images as $image ): ?>
				<?php	
				if (!is_numeric($image)) {
					$caption = $image['caption'];
					$image = $image['ID'];
				} else {
					$image_object = get_post($image);
					$caption = $image_object->post_excerpt;
				}
				?>
				<?php $src = wp_get_attachment_image_src( $image, 'full' ) ?>
			    <a href="<?php echo $src[0]; ?>" class="users-gallery-image">
			    	<?php echo wp_get_attachment_image( $image, 'width=936&height=475&crop=1' ) ?>
			        <p class="caption"><?php echo $caption; ?></p>
			    </a>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<script>
		jQuery(document).ready(function(){
			jQuery('.owl-carousel').owlCarousel({
				loop: true,
				margin: 0,
				nav: true,
				dots: false,
				center: true,
				autoplay: true,
				autoplayTimeout: 10000,
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
			    <h2><?php _e('How to Clean Your Cooktop'); ?></h2>
			    <?php
				$clean_link = get_field('clean_link');
				if (is_numeric($clean_link)) {
					$clean_link = get_permalink($clean_link);
				}
				?>
				<div class="button reverse"><a href="<?php echo $clean_link; ?>"><?php _e('Learn More'); ?></a></div>
		    </div>
		  </div>
		</div>
		
	</div>
	<?php $video_poster = wp_get_attachment_image_src( get_field('video_poster'), 'width=700&height=400&crop=1' ); ?>
	<div class="large-6 medium-6 columns user-video text-center" style="background-image: url(<?php echo $video_poster[0]; ?>);">


<?php if (ICL_LANGUAGE_CODE == 'zh-hans') : ?>	
	<?php
	$video_markup = '<a class="tutorial-video vp-a vp-mp4-type" href="' . get_field('video_url') . '" data-autoplay="1" data-dwrap="1"></a>';
	echo apply_filters('the_content', $video_markup);
	$video_inner = '<div class="product-addl-video">';
	ob_start();
	get_template_part('assets/images/play', 'button.svg');
	$play_button = ob_get_contents();
	ob_end_clean();
	$video_inner .= $play_button;
	$video_inner .= '</div><div class="video-title"><h2>' . get_field('video_title') . '</h2></div>';
	?>
	<script>
		jQuery('a.tutorial-video').html('<?php echo $video_inner; ?>');
	</script>
<?php else: ?>

		<a href="<?php echo get_field('video_url'); ?>?autoplay=1&modestbranding=1&showinfo=0&rel=0" data-featherlight="iframe" data-featherlight-iframe-width="960" data-featherlight-iframe-height="540">
			<div class="product-addl-video">
				<?php get_template_part('assets/images/play', 'button.svg'); ?>
			</div>
			<div class="video-title">
			    <h2><?php echo get_field('video_title'); ?></h2>
			</div>
		</a>
		<?php endif; ?>

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
		<?php $epop_counter = 1; ?>
		<?php if(get_field('image_links')): ?>
			<?php while(has_sub_field('image_links')): ?>
				<div class="large-4 medium-4 small-6 columns text-center">
					<?php $epop_id = 'epop_' . $epop_counter; ?>
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
				<?php $epop_counter++; ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>

<section class="cooking-methods users-cooking-methods">
	<div style="display:table;width:100%;height:100%;">
	  <div style="display:table-cell;vertical-align:middle;">
	    <div style="text-align:center;">
			<h2><?php _e('Different Cooking Methods'); ?></h2>
			<?php
			$cooking_methods_link = get_field('cooking_methods_link');
			if (is_numeric($cooking_methods_link)) {
				$cooking_methods_link = get_permalink($cooking_methods_link);
			}
			?>
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
</section>

<section class="locate-support">
	<div class="large-6 medium-6 columns text-center locate">
		<div style="display:table;width:100%;height:100%;">
		  <div style="display:table-cell;vertical-align:middle;">
		    <div style="text-align:center;">
			    <h2><?php _e('Where Can I Find a EuroKera Cooktop?'); ?></h2>
				<?php
				$locate_now_link = get_field('locate_now_link');
				if (is_numeric($locate_now_link)) {
					$locate_now_link = get_permalink($locate_now_link);
				}
				?>			    
				<div class="button reverse"><a href="<?php echo $locate_now_link; ?>"><?php _e('Locate Now'); ?></a></div>
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
					<h2><?php _e('How to Identify EuroKera Cooktops'); ?></h2>
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
				<h3><?php _e('Look for these Logos On Your Cooktop'); ?></h3><br />
				<?php get_template_part('assets/images/k.svg'); ?>
				<?php get_template_part('assets/images/eurokera', 'logo.svg'); ?>
				<img class="euro-k" src="<?php echo get_template_directory_uri(); ?>/assets/images/identi-k.png">
				<img class="identi-logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/identi-logo.png">
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