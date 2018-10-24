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
				<p><?php echo get_field('enamels_intro'); ?></p>
				
				<div class="filter-bar">
				   	<form id="search" class="links-search">
				   		<input id="search-enamels" type="text" name="search" placeholder="Search by reference #">
				   		<span>or</span>
				   		<select class="filter glass-color">
					   		<option value="">Glass-Ceramic Substitute</option>
				   			<option value="glass-black">Black</option>
				   			<option value="glass-white">White</option>
				   		</select>
				   		<select class="filter enamel-type">
					   		<option value="">Enamel Type</option>
				   			<option value="matte">Matte</option>
				   			<option value="Mettalic">Mettalic</option>
				   		</select>
				   		<select class="filter color-type">
					   		<option value="">Color Type</option>
					   		<option value="color-grey">Grey</option>
					   		<option value="color-red">Red</option>
					   		<option value="color-blue">Blue</option>
					   		<option value="color-green">Green</option>
					   		<option value="color-brown">Brown</option>
					   		<option value="color-black">Black</option>
					   		<option value="color-metallic">Metallic</option>
					   		<option value="color-white">White</option>
					   		<option value="color-pink">Pink</option>
					   		<option value="color-yellow">Yellow</option>
				   		</select>
				   		<a class="reset" href="#">Reset Filters</a>
				   	</form>
				</div>
				
				<div class="enamels-container">
					<?php if(get_field('enamels')): ?>
						<?php while(has_sub_field('enamels')): ?>
							<div class="enamel-block glass-<?php echo strtolower(get_sub_field('glass_color')); ?> <?php echo strtolower(get_sub_field('enamel_type')); ?> color-<?php echo strtolower(get_sub_field('color_type')); ?>">
								<?php echo wp_get_attachment_image(get_sub_field('image'), 'enamels'); ?>
								<p><?php echo get_sub_field('title'); ?></p>
								<a href=" <?php echo get_site_url(); ?>/contact">Inquire About This Enamel</a>
								
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
        pager: false,
        controls: true,
        mode: 'fade',
        speed: 1000,
    });	
} else {
	jQuery(window).load(function(){
    	var slider = jQuery('.bxslider').bxSlider({
    	    auto: false,
    	    pager: false,
    	    controls: true,
    	    mode: 'fade',
    	    speed: 1000,
    	});		
	});
}

jQuery('select.filter').on('change', function() {
	jQuery('#search-enamels').val('');
	var filters = '';
	jQuery("select.filter").each(function() {
		if (jQuery(this).val() != '') {
			filters += '.' + jQuery(this).val();
		}
	});
	jQuery('.enamel-block:not(' + filters + ')').fadeOut();
	jQuery('.enamel-block' + filters).fadeIn();
});

</script>


<?php get_footer(); ?>