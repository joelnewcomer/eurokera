<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */
get_header(); ?>

<script>
	jQuery( document ).ready(function() {
		options = {
			expireDays: 365
		};
		basil = new window.Basil(options);
	});
</script>

<?php get_template_part( 'template-parts/featured-image-parallax' ); ?>

<section class="product-intro">
	<div class="row">
		<div class="large-12 columns product-intro-pp">
			<?php echo get_field('description'); ?>
		</div>
		<div class="large-6 medium-6 columns text-center">
			<h2>Heat Source</h2>
			<?php
			$all_heat_sources = array('Gas','Induction','Radiant');
			$this_heat_sources = get_field('heat_source');
			foreach ($all_heat_sources as $heat_source) {
				$active = false;
				if (in_array($heat_source, $this_heat_sources)) {
					$active = " active";
				}
				echo '<div class="heat-source ' . strtolower($heat_source) . $active . '">';
				get_template_part('assets/images/' . strtolower($heat_source) . '.svg');
				echo '<br />' . strtolower($heat_source);
				echo '</div>';
			}
			?>
		</div>
		<div class="large-6 medium-6 columns text-center">
			<h2>Display Colors</h2>
			<div class="led-colors">
			<?php
			$all_led_colors = array('red/orange','monochromatic','no display','any color including white');
			$this_led_colors = get_field('led_colors');
			foreach ($all_led_colors as $led_color) {
				if ($led_color == 'no display') {
					$led_color_in_array = 'none';
				} elseif ($led_color == 'red/orange') {
					$led_color_in_array = 'red';
				} elseif ($led_color == 'any color including white') {
					$led_color_in_array = 'all color';
				} else {
					$led_color_in_array = $led_color;
				}
				$active = false;
				if (in_array($led_color_in_array, $this_led_colors)) {
					$active = " active";
				}
				echo '<span class="led-color ' . strtolower($led_color) . $active . '">' . $led_color . '</span>';
			}
			?>
			</div>
		</div>
		<?php 
		$data_sheet = get_field('product_data_sheet');
		if ($data_sheet != null) : ?>
		<div class="large-12 columns text-center intro-pds">
			<div class="button"><a id="data-sheet-dl" href="#">Download Product Data Sheet</a></div>
		</div>
		<?php endif; ?>
	</div>
</section>

<section class="features">
	<?php $counter = 1; ?>
	<?php if(get_field('features')): ?>
		<?php while(has_sub_field('features')): ?>
			<?php
			$large = false;
			if ($counter == 1) {
				$img_src = wp_get_attachment_image_src( get_sub_field('feature_image'), 'width=1400&height=454&crop=1' );
				$large = ' large';
			} else {
				$img_src = wp_get_attachment_image_src( get_sub_field('feature_image'), 'width=694&height=454&crop=1' );
			}
			echo '<div class="feature' . $large . '"><div class="feature-inner" style="background-image: url(' . $img_src[0] . '); ">';
			
			echo '<div style="display:table;width:100%;height:100%;">
			  <div style="display:table-cell;vertical-align:middle;">
			    <div style="text-align:center;">' . get_sub_field('feature_title') . '</div>
			  </div>
			</div>';
			
			$counter++;
			if ($counter > 3) {
				$counter = 1;
			}
			echo '</div></div>';
			?>
		<?php endwhile; ?>
	<?php endif; ?>
</section>

<section class="inspire">
	<div class="row">
		<div class="large-12 columns text-center">
			<h2>Design Gallery Inspiration</h2>
			<div class="button reverse"><a href="">See What We Can Do</a></div>
		</div>
	</div>
</section>

<?php if(get_field('quality_videos','option')): ?>
	<section class="product-videos">
		<div class="row">
			<div class="large-12 columns text-center">
				<h2>Our Quality is Above All Others</h2>
			</div>
			<div class="large-12 columns small-text-center">
				
				<?php				
				$rows = get_field('quality_videos','option');
				if($rows) {
					shuffle( $rows );
					$counter = 1;
					foreach($rows as $row) { ?>
						<a class="quality-video" href="<?php echo $row['video_url']; ?>?autoplay=1&modestbranding=1&showinfo=0&rel=0" data-featherlight="iframe" data-featherlight-iframe-width="960" data-featherlight-iframe-height="540">
							<div class="product-addl-video">
								<?php echo  wp_get_attachment_image( $row['video_poster'], 'width=310&height=228&crop=1' ) ?>
								<?php get_template_part('assets/images/play', 'button.svg'); ?>
							</div>
							<div class="video-title" style="display:table;height:100%;">
							  <div style="display:table-cell;vertical-align:middle;">
							    <div><h2><?php echo $row['video_title']; ?></h2></div>
							  </div>
							</div>
						</a>
						<?php
						$counter++;
						if ($counter > 2) {
							break;
						}
					}
				}
				?>
					
				<div class="button"><a href="<?php echo get_site_url(); ?>/cooktop-manufacturers/quality/">Experience The EuroKera Quality</a></div>
			</div>
		</div>
	</section>
<?php endif; ?>


<?php echo get_template_part('template-parts/content','ready'); ?>

<?php if ($data_sheet != null) : ?>

			<div class="data-sheet-modal">
				<div class="modal-overlay transition"></div>
				<div class="modal-form transition">					
					<?php gravity_form(5, false, false, false, array('product' => get_the_title()), true, 12); ?>
				</div>
			</div>
			<script>
				jQuery( document ).ready(function() {
					// Check for persistent variable 
					// basil.remove('formCompleted');
					var formCompleted = basil.get('formCompleted');
					jQuery('#data-sheet-dl').on( "click", function(e) {
						e.preventDefault();
						if (formCompleted != 'yes') {
							jQuery('.data-sheet-modal').addClass('open');
						} else {
							window.location = '<?php echo get_field('product_data_sheet'); ?>';
						}
					});	
					// When form is completed, set persistent variable, download data sheet, and close the modal
					jQuery(document).bind('gform_confirmation_loaded', function(event, formId){
						basil.set('formCompleted', 'yes');
						setTimeout(function(){ 
							jQuery('.data-sheet-modal').removeClass('open');
							window.location = '<?php echo get_field('product_data_sheet'); ?>';
						}, 2000);
					});
					// Close modal 
					jQuery('.modal-overlay').on( "click", function() {
						jQuery('.data-sheet-modal').removeClass('open');
					});
					
				});
			</script>

<?php endif; ?>

<?php get_footer(); ?>