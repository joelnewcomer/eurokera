<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */
get_header(); ?>

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
				get_template_part('assets/images/' . $heat_source . '.svg');
				echo '<br />' . $heat_source;
				echo '</div>';
			}
			?>
		</div>
		<div class="large-6 medium-6 columns text-center">
			<h2>LED Colors</h2>
			<div class="led-colors">
			<?php
			$all_led_colors = array('red','blue','monochromatic','white','all color');
			$this_led_colors = get_field('led_colors');
			foreach ($all_led_colors as $led_color) {
				$active = false;
				if (in_array($led_color, $this_led_colors)) {
					$active = " active";
				}
				echo '<span class="led-color ' . strtolower($led_color) . $active . '">' . $led_color . '</span>';
			}
			?>
			</div>
		</div>
		<div class="large-12 columns text-center intro-pds">
			<div class="button"><a href="<?php echo get_field('product_data_sheet'); ?>">Download Product Data Sheet</a></div>
		</div>
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
			<div class="button"><a href=""></a></div>
		</div>
	</div>
</section>


<?php get_footer(); ?>