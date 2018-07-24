<?php
/*
Template Name: Design Gallery
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image-parallax' ); ?>

<?php do_action( 'foundationpress_before_content' ); ?>

<section class="design-gallery text-center">
	<div class="row">
		
	<div class="btn-filter-wrap">
		<button class="btn-filter btn-active" data-filter="*"><?php _e("All"); ?></button>
		<button class="btn-filter" data-filter=".lcd"><?php _e("LCD"); ?></button>
		<button class="btn-filter" data-filter=".grooves"><?php _e("Grooves"); ?></button>
		<button class="btn-filter" data-filter=".wok"><?php _e("Wok"); ?></button>
		<button class="btn-filter" data-filter=".holes"><?php _e("Holes"); ?></button>
		<button class="btn-filter" data-filter=".shapes"><?php _e("Shapes"); ?></button>
		<button class="btn-filter" data-filter=".touch-sliders"><?php _e("Touch Sliders"); ?></button>
		<button class="btn-filter" data-filter=".bevels"><?php _e("Bevels"); ?></button>
		<button class="btn-filter" data-filter=".decorations"><?php _e("Decorations"); ?></button>
		<button class="btn-filter" data-filter=".enamels"><?php _e("Enamel Colors"); ?></button>
	</div>
	
	<?php $images = get_field('gallery'); ?>
	
	<div class="users-gallery" data-featherlight-gallery data-featherlight-filter="a.gallery-image">
		<?php
		if( $images ): ?>
			<?php foreach( $images as $image ): ?>
				<?php $categories = get_field('categories', $image['ID']); ?>
				<?php if (!in_array ( 'Enamels' , $categories)) : ?>
					<?php
					$cat_classes = '';
					foreach ($categories as $category) {
						$cat_classes .= ' ' . sanitize_title($category);
					}
					$full_size_url = wp_get_attachment_image_src( $image['ID'], 'full' );
					$cropped_url = wp_get_attachment_image_src( $image['ID'], 'width=936&height=475&crop=1' ) 
					?>
					<div class="gallery-link gallery-image gallery<?php echo $cat_classes; ?>">
						<a class="gallery-image" href="<?php echo $full_size_url[0]; ?>" data-caption="<?php echo $image['caption']; ?>">
							<div class="hero gallery-image" style="background-image: url(<?php echo $cropped_url[0]; ?>);"></div>
						</a>
						<?php
						echo '<div class="img-social transition">Share: ';
						
						// Facebook
						echo '<a href="https://www.facebook.com/sharer.php?u=' . $full_size_url[0] . '" target="_blank" onclick="ga(\'send\', \'event\', \'Social\', \'Click\', \'Social Media – Facebook\');">';
						get_template_part('assets/images/social/facebook','official.svg');
						echo '</a>';
						// Twitter
						echo '<a href="https://twitter.com/intent/tweet?url=' . $full_size_url[0] . '&text=' . urlencode($image['caption']) . '" target="_blank" onclick="ga(\'send\', \'event\', \'Social\', \'Click\', \'Social Media – Twitter\');">';
						get_template_part('assets/images/social/twitter','official.svg');
						echo '</a>';
						// Pinterest
						echo '<a href="https://pinterest.com/pin/create/bookmarklet/?media=' . $full_size_url[0] . '&url=' . $full_size_url[0] . '&is_video=false&description=' . $title . '" target="_blank" onclick="ga(\'send\', \'event\', \'Social\', \'Click\', \'Social Media – Pinterest\');">';
						get_template_part('assets/images/social/pinterest-p','official.svg');
						echo '</a>';				
						// LinkedIn
						echo '<a href="https://www.linkedin.com/shareArticle?url=' . get_permalink() . '&title=' . urlencode($image['caption']) . '" target="_blank" onclick="ga(\'send\', \'event\', \'Social\', \'Click\', \'Social Media – LinkedIn\');">';
						get_template_part('assets/images/social/linkedin','official.svg');
						echo '</a>';				
					echo '</div>';
					?>
					</div> <!-- gallery-link -->
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>



	<div class="enamels text-center">
		<h2><?php _e('Enamel Color Samples'); ?></h2>
		<?php $contact_page = get_page_by_path('contact'); ?>
		<?php $contact_url = get_permalink($contact_page->ID); ?>
		<?php $contact_string = sprintf( __('The color samples below are digital renderings with for only intend to illustrate the possibilities in terms of decoration offered by EuroKera. For any enquiry, we recommend to <a href="%s">contact EuroKera</a>.', 'foundationpress'), $contact_url); ?>
		<p class="small"><?php echo $contact_string; ?></p>

		<?php
		if( $images ): ?>
			<?php foreach( $images as $image ): ?>
				<?php $categories = get_field('categories', $image['ID']); ?>
				<?php if (in_array ( 'Enamels' , $categories)) : ?>
					<?php
					$cat_classes = '';
					foreach ($categories as $category) {
						$cat_classes .= ' ' . sanitize_title($category);
					}
					$full_size_url = wp_get_attachment_image_src( $image['ID'], 'full' );
					$cropped_url = wp_get_attachment_image_src( $image['ID'], 'width=936&height=526&crop=0' ) 
					?>
					<div class="gallery-link enamel gallery-image gallery<?php echo $cat_classes; ?>">
						<a class="gallery-image" href="<?php echo $full_size_url[0]; ?>" data-caption="<?php echo $image['caption']; ?>">
							<div class="hero gallery-image" style="background-image: url(<?php echo $cropped_url[0]; ?>);"></div>
						</a>
						<?php
						echo '<div class="img-social transition">Share: ';
						
						// Facebook
						echo '<a href="https://www.facebook.com/sharer.php?u=' . $full_size_url[0] . '" target="_blank">';
						get_template_part('assets/images/social/facebook','official.svg');
						echo '</a>';
						// Twitter
						echo '<a href="https://twitter.com/intent/tweet?url=' . $full_size_url[0] . '&text=' . urlencode($image['caption']) . '" target="_blank">';
						get_template_part('assets/images/social/twitter','official.svg');
						echo '</a>';
						// Pinterest
						echo '<a href="https://pinterest.com/pin/create/bookmarklet/?media=' . $full_size_url[0] . '&url=' . $full_size_url[0] . '&is_video=false&description=' . $title . '" target="_blank">';
						get_template_part('assets/images/social/pinterest-p','official.svg');
						echo '</a>';				
						// LinkedIn
						echo '<a href="https://www.linkedin.com/shareArticle?url=' . get_permalink() . '&title=' . urlencode($image['caption']) . '" target="_blank">';
						get_template_part('assets/images/social/linkedin','official.svg');
						echo '</a>';				
					echo '</div>';
					?>
					</div> <!-- gallery-link -->
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>


	</div> <!-- enamels -->

	</div>
	

	
	<script>
		jQuery(window).load(function(){
			jQuery.featherlight.prototype.beforeOpen = function(event) {
				if(!jQuery(event.target).hasClass('gallery-image')) {
					window.open = jQuery(event.target).attr('href');
					return false;
    			}
			}
			jQuery.featherlightGallery.prototype.afterContent = function() {
				var caption = this.$currentTarget.data('caption');
				var imgURL = this.$instance.find('.featherlight-content').find('img').attr("src");
				var pageURL = '<?php echo get_the_permalink(); ?>';
				// Facebook
				var facebookIcon = '<?php echo load_template_part('assets/images/social/facebook','official.svg'); ?>';
				var facebookURL = encodeURI('https://www.facebook.com/sharer.php?u=' + imgURL);
				var facebookFullLink = '<a href="' + facebookURL + '" target="_blank">' + facebookIcon + '</a>';
				// Twitter
				var twitterIcon = '<?php echo load_template_part('assets/images/social/twitter','official.svg'); ?>';
				var twitterURL = encodeURI('https://twitter.com/intent/tweet?url=' + imgURL + '&text=' + caption);
				var twitterFullLink = '<a href="' + twitterURL + '" target="_blank">' + twitterIcon + '</a>';
				// Pinterest
				var pinterestIcon = '<?php echo load_template_part('assets/images/social/pinterest-p','official.svg'); ?>';
				var pinterestURL = encodeURI('https://pinterest.com/pin/create/bookmarklet/?media=' + imgURL + '&url=' + imgURL + '&is_video=false&description=' + caption);
				var pinterestFullLink = '<a href="' + pinterestURL + '" target="_blank">' + pinterestIcon + '</a>';
				// LinkedIn
				var linkedinIcon = '<?php echo load_template_part('assets/images/social/linkedin','official.svg'); ?>';
				var linkedinURL = encodeURI('https://www.linkedin.com/shareArticle?url=' + pageURL + '&title=' + caption);
				var linkedinFullLink = '<a href="' + linkedinURL + '" target="_blank">' + linkedinIcon + '</a>';
				
				this.$instance.find('.caption').remove();
				this.$instance.find('.img-social').remove();
				jQuery('<div class="caption">').text(caption).appendTo(this.$instance.find('.featherlight-content'));
				jQuery('<div class="img-social transition">Share: ' + facebookFullLink + twitterFullLink + pinterestFullLink + linkedinFullLink + '</div>').appendTo(this.$instance.find('.featherlight-content'));
			};
		});
		jQuery('.btn-filter').on( "click", function() {
			jQuery('.btn-filter').removeClass('btn-active');
			jQuery(this).addClass('btn-active');
			var galleryFilter = jQuery(this).data('filter');
			// All
			if (galleryFilter == '*') {
				jQuery('.gallery').fadeIn('fast', function() {
					resetClasses();
				});
				jQuery('.enamels').fadeIn('fast');
			} else if (galleryFilter == '.enamels') {
				jQuery('.gallery:not(' + galleryFilter + ')').fadeOut( "fast", function() {
					jQuery('.enamels').fadeIn('fast');
				});
			} else {
				jQuery('.enamels').fadeOut('fast');
				jQuery('.gallery:not(' + galleryFilter + ')').fadeOut( "fast", function() {
					jQuery('.gallery' + galleryFilter).fadeIn('fast', function() {
						resetClasses();
					});
				});
			}
		});
	</script>
	</div>
</section>

<script>
function resetClasses() {
	var loopCounter = 1;
	jQuery('.gallery').removeClass('first-item fourth-item fifth-item');
	jQuery('.gallery:visible:not(.enamel)').each(function (i) {
		if (loopCounter == 1) {
			jQuery(this).addClass('first-item');
		}
		if (loopCounter == 4) {
			jQuery(this).addClass('fourth-item');
		}
		if (loopCounter == 5) {
			jQuery(this).addClass('fifth-item');
		}			
	    loopCounter++;
	    if (loopCounter == 6) {
		    loopCounter = 1;
	    }
	});
}
resetClasses();
</script>

<?php do_action( 'foundationpress_after_content' ); ?>

<?php get_footer(); ?>