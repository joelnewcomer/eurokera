<?php
/*
Template Name: Enamels
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image-parallax' ); ?>

<div id="page" role="main">
	<section class="enamels-page-intro">
		<div class="row">
			<div class="large-12 columns text-center">
				<p><?php echo get_field('enamels_page_intro'); ?></p>
			</div>
		</div>
	</section> <!-- enamles-page-intro -->
	<section class="enamels-slider">
		<div class="slider-container">
		    <ul class="bxslider">
				<?php if( have_rows('slider') ):
					while ( have_rows('slider') ) : the_row(); ?>
		                <?php
			            $type = get_sub_field('slider_type');
			            $title = get_sub_field('title');
			            $photo = get_sub_field('photo');
			            $photo_url = wp_get_attachment_image_src($photo, 'full');
			            $link = get_sub_field('button_link');
			            $button_title = $link['title'];
			            $button_target = $link['target'];
			            $button_url = $link['url'];
		                ?>
		                <?php if ($type == 'content') : ?>
		                	<li class="<?php echo $type; ?>">	
		                		<div class="slide-inner">
									<div class="content-photo">
										<div class="photo-container" style="background:url(<?php echo $photo_url[0]; ?>) left center no-repeat;"></div>
										<h2><?php echo $title; ?></h2>
										<?php echo get_sub_field('content'); ?>
										<?php if ($button_title != '') : ?>
											<div class="button white"><a href="<?php echo $button_url; ?>" <?php if ($button_target != '') : ?>target="_blank"<?php endif; ?>><?php echo $button_title; ?></a>
										<?php endif; ?>
									</div> <!-- content-photo -->
								</div> <!-- slide-inner -->
							</li>
						<?php endif; ?>
		                <?php if ($type == 'photo') : ?>
		                	<li class="<?php echo $type; ?>">
		                		<div class="slide-inner" style="background:url(<?php echo $photo_url[0]; ?>) left center no-repeat;">
									<div style="display:table;width:100%;height:100%;">
									  <div style="display:table-cell;vertical-align:middle;">
									    <div style="text-align:center;">
										    <h2><?php echo $title; ?></h2>
											<?php if ($button_title != '') : ?>
												<div class="button white"><a href="<?php echo $button_url; ?>" <?php if ($button_target != '') : ?>target="_blank"<?php endif; ?>><?php echo $button_title; ?></a>
											<?php endif; ?>
									    </div>
									  </div>
									</div>									
								</div> <!-- slide-inner -->
		                	</li>
						<?php endif; ?>
		                <?php if ($type == 'video') : ?>
							<li class="<?php echo $type; ?>">
		                		<div class="slide-inner">
									<div style="display:table;width:100%;height:100%;">
										<div style="display:table-cell;vertical-align:middle;">
									    	<div style="text-align:center;">
												<?php
												$video = get_sub_field('video'); // OEmbed Code
												$video_url = get_sub_field('video', FALSE, FALSE); // URL
												?>
												<a class="video" href="<?php echo $video_url; ?>?autoplay=1&modestbranding=1&showinfo=0&rel=0" data-featherlight="iframe" data-featherlight-iframe-width="960" data-featherlight-iframe-height="540"  style="background:url(<?php echo $photo_url[0]; ?>) left center no-repeat;">
										    		<?php get_template_part('assets/images/play', 'button.svg'); ?>
													<h2><?php echo $title; ?></h2>
												</a>											
									    	</div>
										</div>
									</div>									
								</div> <!-- slide-inner -->
							</li>
						<?php endif; ?>						
					<?php endwhile;
				endif; ?>
		    </ul>
		</div> <!-- slider-container -->
	</section> <!-- enamles-slider -->
	<section class="enamels">
		<div class="row">
			<div class="large-12 columns text-center">
				<h2><?php echo get_field('enamels_title'); ?></h2>
			</div>
			<div class="large-12 columns">
				<?php echo get_field('enamels_intro'); ?>
				
				<div class="filter-bar small-text-center">
				   	<form id="search" class="links-search">
				   		<input id="search-enamels" type="text" name="search" placeholder="<?php _e('Search'); ?>">
				   		<span><?php _e('or'); ?></span>
				   		<select class="filter glass-color">
					   		<option value=""><?php _e('Glass-Ceramic Substrate'); ?></option>
				   			<option value="glass-black"><?php _e('Black'); ?></option>
				   			<option value="glass-white"><?php _e('White'); ?></option>
				   		</select>
				   		<select class="filter enamel-type">
					   		<option value=""><?php _e('Enamel Type'); ?></option>
				   			<option value="matte"><?php _e('Matte'); ?></option>
				   			<option value="metallic"><?php _e('Metallic'); ?></option>
				   			<option value="reflective"><?php _e('Reflective'); ?></option>
				   		</select>
				   		<select class="filter color-type">
					   		<option value=""><?php _e('Color Type'); ?></option>
					   		<option value="color-grey"><?php _e('Grey'); ?></option>
					   		<option value="color-red"><?php _e('Red'); ?></option>
					   		<option value="color-blue"><?php _e('Blue'); ?></option>
					   		<option value="color-green"><?php _e('Green'); ?></option>
					   		<option value="color-brown"><?php _e('Brown'); ?></option>
					   		<option value="color-black"><?php _e('Black'); ?></option>
					   		<option value="color-metallic"><?php _e('Metallic'); ?></option>
					   		<option value="color-white"><?php _e('White'); ?></option>
					   		<option value="color-pink"><?php _e('Pink'); ?></option>
					   		<option value="color-yellow"><?php _e('Yellow'); ?></option>
				   		</select>
				   		<a class="reset" href="#"><?php _e('Reset Filters'); ?></a>
				   	</form>
				</div>
				
				<div class="enamels-container">
					<?php if(get_field('enamels')): ?>
						<?php while(has_sub_field('enamels')): ?>
							<div class="enamel-block glass-<?php echo strtolower(get_sub_field('glass_color')); ?> <?php echo strtolower(get_sub_field('enamel_type')); ?> color-<?php echo strtolower(get_sub_field('color_type')); ?>">
								<?php echo wp_get_attachment_image(get_sub_field('image'), 'full'); ?>
								<p><?php echo get_sub_field('title'); ?></p>

								<?php $contact_page = get_page_by_path('contact-us');
								$icl_contact_page_id = icl_object_id($contact_page->ID, 'page', true);
								$contact_url = get_permalink($icl_contact_page_id); ?>									
								
								
								
								<a href="<?php echo $contact_url; ?>?subject=<?php echo sprintf( __('Inquiry About %s', 'foundationpress'), get_sub_field('title')); ?>&message=<?php echo sprintf( __('Please send me more info about %s', 'foundationpress'), get_sub_field('title')); ?>"><?php _e('Inquire About This Enamel'); ?></a>
								
							</div> <!-- enamel-block -->
						<?php endwhile; ?>
					<?php endif; ?>
				</div> <!-- enamels-container -->
				
			</div> <!-- columns -->
		</div> <!-- row -->
	</section> <!-- enamels -->
	
</div> <!-- #page -->

<script>
if (typeof bxSlider === "function") { 	
    var slider = jQuery('.bxslider').bxSlider({
        auto: false,
    	pager: true,
        controls: false,
        mode: 'fade',
        speed: 1000,
    });	
} else {
	jQuery(window).load(function(){
    	var slider = jQuery('.bxslider').bxSlider({
    	    auto: false,
    	    pager: (jQuery(".bxslider > li").length > 1) ? true: false,
    	    controls: false,
    	    mode: 'fade',
    	    speed: 1000,
    	});		
	});
}

// Filters
jQuery('select.filter').on('change', function() {
	jQuery('.enamel-block').removeClass('hidden');
	jQuery('#search-enamels').val('');
	var filters = '';
	jQuery("select.filter").each(function() {
		if (jQuery(this).val() != '') {
			filters += '.' + jQuery(this).val();
		}
	});
	jQuery('.enamel-block:not(' + filters + ')').addClass('hidden');
	jQuery('.enamel-block' + filters).removeClass('hidden');
});

// Reset Filters
jQuery("a.reset").on( "click", function(e) {
	e.preventDefault();
	jQuery('.enamel-block').removeClass('hidden');
	jQuery("select.filter").each(function() {
		jQuery(this).prop('selectedIndex',0);
	});	
});

// Search	
jQuery( document).ready(function() {
	var h = holmes({
		// queryselector for the input
		input: '#search-enamels',
		// queryselector for element to search in
		find: '.enamels-container .enamel-block',
		// (optional) text to show when no results
		placeholder: 'no results',
		class: {
		  // (optional) class to add to matched elements
		  visible: 'visible',
		  // (optional) class to add to non-matched elements
		  hidden: 'hidden'
		},
		// (optional) if true, this will refresh the content every search
		dynamic: false,
		// (optional) in case you don't want to wait for DOMContentLoaded before starting Holmes:
		instant: true,
		// (optional) if you want to start searching after a certain amount of characters are typed
		minCharacters: 2,
		onInput: function(){
			jQuery("select.filter").each(function() {
			    jQuery(this).prop('selectedIndex',0);
			});
		}
	});
});

</script>


<?php get_footer(); ?>