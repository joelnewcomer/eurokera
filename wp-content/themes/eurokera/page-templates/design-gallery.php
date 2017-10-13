<?php
/*
Template Name: Design Gallery
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image-parallax' ); ?>

<?php do_action( 'foundationpress_before_content' ); ?>

<section class="users-gallery design-gallery text-center">
	<div class="row">
		
	<div class="btn-filter-wrap">
		<button class="btn-filter btn-active" data-filter="*">All</button>
		<button class="btn-filter" data-filter=".lcd">LCD</button>
		<button class="btn-filter" data-filter=".grooves">Grooves</button>
		<button class="btn-filter" data-filter=".wok">Wok</button>
		<button class="btn-filter" data-filter=".holes">Holes</button>
		<button class="btn-filter" data-filter=".shapes">Shapes</button>
		<button class="btn-filter" data-filter=".touch-sliders">Touch Sliders</button>
		<button class="btn-filter" data-filter=".bevels">Bevels</button>
		<button class="btn-filter" data-filter=".decorations">Decorations</button>
		<button class="btn-filter" data-filter=".enamel-colors">Enamel Colors</button>
	</div>
	
	<?php $images = get_field('gallery'); ?>
	
	<div class="users-gallery" data-featherlight-gallery data-featherlight-filter="a">
		<?php
		if( $images ): ?>
			<?php foreach( $images as $image ): ?>
				<?php
				$categories = get_field('categories', $image['ID']);
				$cat_classes = '';
				foreach ($categories as $category) {
					$cat_classes .= ' ' . sanitize_title($category);
				}
				$full_size_url = wp_get_attachment_image_src( $image['ID'], 'full' );
				$cropped_url = wp_get_attachment_image_src( $image['ID'], 'width=936&height=475&crop=1' ) 
				?>
				<a class="gallery<?php echo $cat_classes; ?>" href="<?php echo $full_size_url[0]; ?>">
					<div class="hero" style="background-image: url(<?php echo $cropped_url[0]; ?>);"></div>
				</a>
			        <!-- <p class="caption"><?php echo $image['caption']; ?></p> -->
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	
	<script>
		jQuery(window).load(function(){
			jQuery.featherlightGallery.prototype.afterContent = function() {
				var caption = this.$currentTarget.closest('.caption').html();
				this.$instance.find('.caption').remove();
				jQuery('<div class="caption">').text(caption).appendTo(this.$instance.find('.featherlight-content'));
			};
		});
		jQuery('.btn-filter').on( "click", function() {
			jQuery('.btn-filter').removeClass('btn-active');
			jQuery(this).addClass('btn-active');
			var galleryFilter = jQuery(this).data('filter');
			// All
			if (galleryFilter == '*') {
				jQuery('a.gallery').fadeIn('fast', function() {
					resetClasses();
				});
			} else {
				jQuery('a.gallery:not(' + galleryFilter + ')').fadeOut( "fast", function() {
					jQuery('a.gallery' + galleryFilter).fadeIn('fast', function() {
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
	jQuery('a.gallery').removeClass('first-item fourth-item fifth-item');
	jQuery('a.gallery:visible').each(function (i) {
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