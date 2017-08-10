<?php
/*
Template Name: Design Gallery
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image-parallax' ); ?>

<?php do_action( 'foundationpress_before_content' ); ?>

<section class="users-gallery design-gallery text-center">
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
		<?php 
		$images = get_field('gallery');
		$gallery_dot_width = (100 / count($images));
		?>
		<style>
			.owl-theme.users-gallery-carousel .owl-dots .owl-dot {
				width: <?php echo $gallery_dot_width; ?>%;
			}
		</style>
	
	<div class="users-gallery-carousel owl-theme owl-carousel" data-featherlight-gallery data-featherlight-filter="a">
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
				?>
			    <div class="item users-gallery-image<?php echo $cat_classes; ?>">
				    <a class="gallery" href="<?php echo $full_size_url[0]; ?>">
			    		<?php echo wp_get_attachment_image( $image['ID'], 'width=936&height=475&crop=1' ) ?>
				    </a>
			        <p class="caption"><?php echo $image['caption']; ?></p>
			    </div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<script>
		jQuery(window).load(function(){
			var owl = jQuery('.owl-carousel').owlCarousel({
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
			});
			/* animate filter */
			var owlAnimateFilter = function(even) {
				jQuery(this)
				.addClass('__loading')
				.delay(70 * jQuery(this).parent().index())
				.queue(function() {
					jQuery(this).dequeue().removeClass('__loading')
				})
			}
			jQuery('.btn-filter-wrap').on('click', '.btn-filter', function(e) {
				var filter_data = jQuery(this).data('filter');			
				/* return if current */
				if(jQuery(this).hasClass('btn-active')) return;
				/* active current */
				jQuery(this).addClass('btn-active').siblings().removeClass('btn-active');
				/* Filter */
				owl.owlFilter(filter_data, function(_owl) { 
					jQuery(_owl).find('.item').each(owlAnimateFilter); 
				});
			}); 			

			jQuery.featherlightGallery.prototype.afterContent = function() {
				var caption = this.$currentTarget.closest('.caption').html();
				this.$instance.find('.caption').remove();
				jQuery('<div class="caption">').text(caption).appendTo(this.$instance.find('.featherlight-content'));
			};
				
		});		
	</script>
</section>

<?php do_action( 'foundationpress_after_content' ); ?>

<?php get_footer(); ?>