<?php
/**
 * The template for displaying column contents
 *
 * @subpackage DrumStarter
 * @since DrumStarter 1.0
 */
?>

<?php
$before_parallax_prepend = '</div><!-- entry-content --><div class="parallax-container">';
$before_parallax_append = '';
$after_parallax_prepend = '';
$after_parallax_append = '</div><div class="entry-content">';
$tabs_counter = 1;
$row_counter = 1;
$background = "";

function drum_animate($column, $row, $script = false) {
	$animate = get_sub_field('column_' . $column . '_animation_animate');
	if ($animate) {
		$animate_class = 'sr' . $row;
		$effect = get_sub_field('column_' . $column . '_animation_effect');
		$origin = get_sub_field('column_' . $column . '_animation_direction');
		$duration = get_sub_field('column_' . $column . '_animation_duration');
		$delay = get_sub_field('column_' . $column . '_animation_delay');
		$scale = 0;
		$rotate = 0;
		if ($effect == 'zoom-in') {
			$scale = 0.7;
		}  
		if ($effect == 'zoom-out') {
			$scale = 1.5;
		}
		if ($effect == 'rotate') {
			$rotate = 180;
		}
		if ($script) : ?>
		<script>
			jQuery( window ).load(function() {
				sr.reveal('.<?php echo $animate_class; ?>', { origin: '<?php echo $origin; ?>', duration: <?php echo $duration; ?>, delay: <?php echo $delay; ?>, rotate: { x: 0, y: 0, z: <?php echo $rotate; ?> }, scale: <?php echo $scale; ?>  });
			});
		</script>
		<?php endif; ?>
	<?php
	} else {
		$animate_class = 'sr';
	}
	if (!$script) {
		return $animate_class;
	}
}


	// check if the flexible content field has rows of data
	if( have_rows('content') ):
	     // loop through the rows of data
	    while ( have_rows('content') ) : the_row();

			// One Column
	        if( get_row_layout() == 'one_column' ): ?>
	        	<?php
		        if (get_sub_field('advanced_section_features')) {
		        	$background = get_sub_field('background_color'); 
	        		$section_id = get_sub_field('section_id');
	        	} else {
		        	$background = 'default-background';
	        	}
	        	?>
				<!-- One Column Parallax -->
	        	<?php if (get_sub_field('parallax') ) : ?>
	        		<?php echo $before_parallax_prepend; ?><div <?php if ($section_id != null) { echo 'id="' . $section_id . '" ' ; } ?>class="parallax-window" data-paroller-factor="0.5" style="background: url('<?php echo wp_get_attachment_image_url(get_sub_field("parallax_image"), $size = "full"); ?>');"><?php echo $before_parallax_append; ?>
						<div class="row">
							<div class="large-12 columns entry-content">
								<?php echo get_sub_field('one_column'); ?>
							</div>
						</div> <!-- row -->
					<?php echo $after_parallax_prepend; ?></div><?php echo $after_parallax_append; ?>

				<!-- One Column Not Parallax -->
	        	<?php else : ?>
	        		<section <?php if ($section_id != null) { echo 'id="' . $section_id . '" ' ; } ?>class="<?php echo $background; ?>">
		        		<div class="row">
		        			<div class="large-12 columns entry-content <?php echo drum_animate('1', $row_counter); ?>">
		        				<?php echo get_sub_field('one_column'); ?>
							</div>
		        		</div> <!-- row -->
		        		<?php echo drum_animate('1', $row_counter, true); ?>
					</section>
	        	<?php endif; ?>

	        <!-- Two Columns -->
	        <?php elseif( get_row_layout() == 'two_columns' ): ?>
	        	<?php
		        $section_header = get_sub_field('section_header');
		        if (get_sub_field('advanced')) {
		        	$background = get_sub_field('background_color'); 
	        		$section_id = get_sub_field('section_id');
	        	} else {
		        	$background = 'default-background';
	        	}
	        	?>

	        	<!-- Two Columns Parallax -->
	        	<?php if (get_sub_field('parallax') ) : ?>
	        		</div></div><div <?php if ($section_id != null) { echo 'id="' . $section_id . '" ' ; } ?>class="parallax-window" data-parallax="scroll" data-image-src="<?php echo wp_get_attachment_image_url(get_sub_field('parallax_image'), $size = 'full'); ?>"><div class="row"><div class="large-12 columns">
						<section>
							<div class="row">
								<?php if ($section_header != null) : ?>
									<div class="large-12 columns text-center">
										<h2><?php echo $section_header; ?></h2>
									</div>
								<?php endif; ?>
								<div class="large-6 medium-6 columns entry-content">
									<?php echo get_sub_field('column_1'); ?>
								</div>
								<div class="large-6 medium-6 columns entry-content">
									<?php echo get_sub_field('column_2'); ?>
								</div>
							</div> <!-- row -->
						</section>
					</div></div></div><div class="row"><div class="entry-content">

				<!-- Two Columns Not Parallax -->
	        	<?php else : ?>
	        		<section <?php if ($section_id != null) { echo 'id="' . $section_id . '" ' ; } ?>class="<?php echo $background; ?>">
		        		<div class="row">
							<?php if ($section_header != null) : ?>
								<div class="large-12 columns text-center">
									<h2><?php echo $section_header; ?></h2>
								</div>
							<?php endif; ?>			        		
		        			<div class="large-6 medium-6 columns entry-content <?php echo drum_animate('1', $row_counter); ?>">
		        				<?php echo get_sub_field('column_1'); ?>
		        				<?php echo drum_animate('1', $row_counter, true); ?>
		        			</div>
		        			<div class="large-6 medium-6 columns entry-content <?php echo drum_animate('2', $row_counter); ?>">
		        				<?php echo get_sub_field('column_2'); ?>
		        				<?php echo drum_animate('2', $row_counter, true); ?>
		        			</div>
		        		</div> <!-- row -->
	        		</section>
	        	<?php endif; ?>

	        <!-- Three Columns -->
	        <?php elseif( get_row_layout() == 'three_columns' ): ?>
	        	<?php
		        $section_header = get_sub_field('section_header');	
		        if (get_sub_field('advanced')) {
		        	$background = get_sub_field('background_color'); 
	        		$section_id = get_sub_field('section_id');
	        	} else {
		        	$background = 'default-background';
					$section_id = '';
	        	}
	        	?>
				<section <?php if ($section_id != null) { echo 'id="' . $section_id . '" ' ; } ?>class="<?php echo $background; ?>">
					<div class="row">
						<?php if ($section_header != null) : ?>
							<div class="large-12 columns text-center">
								<h2><?php echo $section_header; ?></h2>
							</div>
						<?php endif; ?>						
		        		<div class="large-4 medium-4 columns entry-content <?php echo drum_animate('1', $row_counter); ?>">
		        			<?php echo get_sub_field('column_1'); ?>
		        			<?php echo drum_animate('1', $row_counter, true); ?>
		        		</div>
		        		<div class="large-4 medium-4 columns entry-content <?php echo drum_animate('2', $row_counter); ?>">
		        			<?php echo get_sub_field('column_2'); ?>
		        			<?php echo drum_animate('2', $row_counter, true); ?>
		        		</div>
		        		<div class="large-4 medium-4 columns entry-content <?php echo drum_animate('3', $row_counter); ?>">
		        			<?php echo get_sub_field('column_3'); ?>
		        			<?php echo drum_animate('3', $row_counter, true); ?>
		        		</div>
					</div> <!-- row -->
				</section>
	        <?php elseif( get_row_layout() == 'four_columns' ): ?>
	        	<?php
		        $section_header = get_sub_field('section_header');	
		        if (get_sub_field('advanced')) {
		        	$background = get_sub_field('background_color'); 
	        		$section_id = get_sub_field('section_id');
	        	} else {
		        	$background = 'default-background';
					$section_id = '';
	        	}
	        	?>
	        	<section <?php if ($section_id != null) { echo 'id="' . $section_id . '" ' ; } ?>class="<?php echo $background; ?>">
		        	<div class="row">
						<?php if ($section_header != null) : ?>
							<div class="large-12 columns text-center">
								<h2><?php echo $section_header; ?></h2>
							</div>
						<?php endif; ?>			        	
		        		<div class="large-3 medium-3 columns entry-content <?php echo drum_animate('1', $row_counter); ?>">
		        			<?php echo get_sub_field('column_1'); ?>
		        			<?php echo drum_animate('1', $row_counter, true); ?>
		        		</div>
		        		<div class="large-3 medium-3 columns entry-content <?php echo drum_animate('2', $row_counter); ?>">
		        			<?php echo get_sub_field('column_2'); ?>
		        			<?php echo drum_animate('2', $row_counter, true); ?>
		        		</div>
		        		<div class="large-3 medium-3 columns entry-content <?php echo drum_animate('3', $row_counter); ?>">
		        			<?php echo get_sub_field('column_3'); ?>
		        			<?php echo drum_animate('3', $row_counter, true); ?>
		        		</div>
		        		<div class="large-3 medium-3 columns entry-content <?php echo drum_animate('4', $row_counter); ?>">
		        			<?php echo get_sub_field('column_4'); ?>
		        			<?php echo drum_animate('4', $row_counter, true); ?>
		        		</div>
		        	</div> <!-- row -->
	        	</section>
	        <?php elseif( get_row_layout() == 'right_sidebar' ): ?>
	        	<?php
		        $section_header = get_sub_field('section_header');	
		        if (get_sub_field('advanced')) {
		        	$background = get_sub_field('background_color'); 
	        		$section_id = get_sub_field('section_id');
	        	} else {
		        	$background = 'default-background';
					$section_id = '';
	        	}
	        	?>
	        	<section <?php if ($section_id != null) { echo 'id="' . $section_id . '" ' ; } ?>class="<?php echo $background; ?>">
		        	<div class="row">
						<?php if ($section_header != null) : ?>
							<div class="large-12 columns text-center">
								<h2><?php echo $section_header; ?></h2>
							</div>
						<?php endif; ?>			        	
		        		<div class="large-8 medium-8 columns entry-content <?php echo drum_animate('1', $row_counter); ?>">
		        			<?php echo get_sub_field('wide_column'); ?>
		        			<?php echo drum_animate('1', $row_counter, true); ?>
		        		</div>
		        		<div class="large-4 medium-4 columns entry-content <?php echo drum_animate('2', $row_counter); ?>">
		        			<?php echo get_sub_field('narrow_column'); ?>
		        			<?php echo drum_animate('2', $row_counter, true); ?>
		        		</div>
		        	</div> <!-- row -->
	        	</section>
	        <?php elseif( get_row_layout() == 'left_sidebar' ): ?>
	        	<?php
		        $section_header = get_sub_field('section_header');	
		        if (get_sub_field('advanced')) {
		        	$background = get_sub_field('background_color'); 
	        		$section_id = get_sub_field('section_id');
	        	} else {
		        	$background = 'default-background';
					$section_id = '';
	        	}
	        	?>
				<section <?php if ($section_id != null) { echo 'id="' . $section_id . '" ' ; } ?>class="<?php echo $background; ?>">
					<div class="row">
						<?php if ($section_header != null) : ?>
							<div class="large-12 columns text-center">
								<h2><?php echo $section_header; ?></h2>
							</div>
						<?php endif; ?>						
		        		<div class="large-4 medium-4 columns entry-content <?php echo drum_animate('1', $row_counter); ?>">
		        			<?php echo get_sub_field('narrow_column'); ?>
		        			<?php echo drum_animate('1', $row_counter, true); ?>
		        		</div>
		        		<div class="large-8 medium-8 columns entry-content <?php echo drum_animate('2', $row_counter); ?>">
		        			<?php echo get_sub_field('wide_column'); ?>
		        			<?php echo drum_animate('2', $row_counter, true); ?>
		        		</div>
					</div> <!-- row -->
				</section>
			<!-- SEPARATE ACCORDION SECTION DEPRECATED 7/20/17 - KEPT FOR BACKWARDS COMPATIBILITY -->
	        <?php elseif( get_row_layout() == 'accordion' ): ?>
	        	<?php
		        $section_header = get_sub_field('section_header');	
		        if (get_sub_field('advanced')) {
		        	$background = get_sub_field('background_color'); 
	        		$section_id = get_sub_field('section_id');
	        	} else {
		        	$background = 'default-background';
					$section_id = '';
	        	}
	        	?>
				<section <?php if ($section_id != null) { echo 'id="' . $section_id . '" ' ; } ?>class="<?php echo $background; ?>">
					<div class="row">
						<?php if ($section_header != null) : ?>
							<div class="large-12 columns text-center">
								<h2><?php echo $section_header; ?></h2>
							</div>
						<?php endif; ?>						
		        		<div class="large-12 columns <?php echo drum_animate('1', $row_counter); ?>">
			        		<div class="tabs-container">
			        			<div id="tabs-<?php echo $tabs_counter; ?>">
								<?php if(get_sub_field('accordion')): ?>
									<ul class="resp-tabs-list tabs-<?php echo $tabs_counter; ?>">
									<?php while(has_sub_field('accordion')): ?>
										<li><?php the_sub_field('section_title'); ?><?php get_template_part('assets/images/acc', 'arrow.svg'); ?><br /> </li>
									<?php endwhile; ?>
									</ul> <!-- resp-tabs-list -->
									<div class="resp-tabs-container tabs-<?php echo $tabs_counter; ?>">
									<?php while(has_sub_field('accordion')): ?>
										<div><div class="tab-content-inner entry-content"><?php the_sub_field('section_content'); ?></div></div>
									<?php endwhile; ?>
									</div> <!-- resp-tabs-container -->
								<?php endif; ?>
			        			</div>  <!-- tabs -->
			        		</div> <!-- tabs-container -->
			        		<script>
				    	    	jQuery( document ).ready(function() {
				    	    		jQuery('#tabs-<?php echo $tabs_counter; ?>').easyResponsiveTabs({
					    	    		type: 'accordion',
										tabidentify: 'tabs-<?php echo $tabs_counter; ?>', // The tab groups identifier
            						});
				    	    	});
				    	    </script>
			        		<?php echo drum_animate('1', $row_counter, true); ?>
		        		</div> <!-- columns -->
					</div> <!-- row -->
				</section> <!-- sr -->
				<?php $tabs_counter++; ?>
	        <?php elseif( get_row_layout() == 'tabs' ): ?>
	        	<?php
		        $section_header = get_sub_field('section_header');	
		        if (get_sub_field('advanced')) {
		        	$background = get_sub_field('background_color'); 
	        		$section_id = get_sub_field('section_id');
	        	} else {
		        	$background = 'default-background';
					$section_id = '';
	        	}
	        	$type = get_sub_field('type');
	        	?>
				<section <?php if ($section_id != null) { echo 'id="' . $section_id . '" ' ; } ?>class="<?php echo $background; ?>">
					<div class="row">
						<?php if ($section_header != null) : ?>
							<div class="large-12 columns text-center">
								<h2><?php echo $section_header; ?></h2>
							</div>
						<?php endif; ?>						
		        		<div class="large-12 columns <?php echo drum_animate('1', $row_counter); ?>">
			        		<div class="tabs-container">
			        			<div id="tabs-<?php echo $tabs_counter; ?>">
								<?php if(get_sub_field('tabs')): ?>
									<ul class="resp-tabs-list tabs-<?php echo $tabs_counter; ?>">
									<?php while(has_sub_field('tabs')): ?>
										<li><?php the_sub_field('tab_title'); ?><?php get_template_part('assets/images/acc', 'arrow.svg'); ?></li>
									<?php endwhile; ?>
									</ul> <!-- resp-tabs-list -->
									<div class="resp-tabs-container tabs-<?php echo $tabs_counter; ?>">
									<?php while(has_sub_field('tabs')): ?>
										<div><div class="tab-content-inner entry-content"><?php the_sub_field('tab_content'); ?></div></div>
									<?php endwhile; ?>
									</div> <!-- resp-tabs-container -->
								<?php endif; ?>
			        			</div>  <!-- tabs -->
			        		</div> <!-- tabs-container -->
			        		<script>
				    	    	jQuery( document ).ready(function() {
				    	    		jQuery('#tabs-<?php echo $tabs_counter; ?>').easyResponsiveTabs({
					    	    		type: '<?php echo $type; ?>',
										tabidentify: 'tabs-<?php echo $tabs_counter; ?>', // The tab groups identifier
            						});
				    	    	});
				    	    </script>
				    	    <?php echo drum_animate('1', $row_counter, true); ?>
		        		</div> <!-- columns -->
					</div> <!-- row -->
				</section> <!-- sr -->
				<?php $tabs_counter++; ?>
				
				<?php elseif( get_row_layout() == 'slider' ): ?>
				
					<section class="page-slider">
						<div class="slider-container">
						    <ul class="bxslider page-slider-<?php echo $row_counter; ?>">
								<?php if( have_rows('slides') ):
									while ( have_rows('slides') ) : the_row(); ?>
						                <?php
							            $photo = get_sub_field('photo');
							            $photo_url = wp_get_attachment_image_src($photo, 'width=1366&height=683&crop=1');
							            $bg = '';
							            $bg_color = get_sub_field('overlay_bg');
							            $bg_opacity = get_sub_field('bg_opacity');
							            if ($bg_color != 'none') {
								            if ($bg_color == 'blue') {
									            $bg = 'style="background: rgba(44,145,153,.' . $bg_opacity . ')"'; 
								            }
								            if ($bg_color == 'orange') {
									            $bg = 'style="background: rgba(255,130,0,.' . $bg_opacity . ')"'; 
								            }
								            if ($bg_color == 'black') {
									            $bg = 'style="background: rgba(0,0,0,.' . $bg_opacity . ')"'; 
								            }
							            }
							            $align = '';
							            if (get_sub_field('align')) {
								            $align = 'overlay-right'; 
							            }
						                ?>
						                	<li>
						                		<div class="slide-inner" style="background:url(<?php echo $photo_url[0]; ?>) <?php echo get_sub_field('photo_align'); ?> center no-repeat;"></div>
						                		<div class="page-slider-overlay text-center flex <?php echo get_sub_field('content_size'); ?> <?php echo $align; ?>" <?php echo $bg; ?>>
												<div class="page-slider-content">
													<?php echo get_sub_field('overlay_content'); ?>
												</div>
						    					</div>
										</li>					
									<?php endwhile;
								endif; ?>
						    </ul>

						</div> <!-- slider-container -->
					</section> <!-- slider -->
					<script>
						jQuery(window).load(function(){
							var slider = jQuery('.page-slider-<?php echo $row_counter; ?>').bxSlider({
							    auto: false,
							    pager: (jQuery(".page-slider-<?php echo $row_counter; ?> > li").length > 1) ? true: false,
							    controls: true,
							    mode: 'fade',
							    speed: 1000,
							});	
						});
					</script>

				<?php elseif( get_row_layout() == 'icon_blocks' ): ?>
				
					<?php
					$num_columns = get_sub_field('columns');
					if ($num_columns == 3) {
						$columns = 'large-4 medium-4';
					} else {
						$columns = 'large-3 medium-3';
					}
					?>
				
					<section class="icon-blocks">
						<div class="row">
							<div class="large-12 columns">
								<h2><?php echo get_sub_field('title'); ?></h2>
							</div>
						</div>
						<div class="row">
							<?php if(get_sub_field('blocks')): ?>
								<?php while(has_sub_field('blocks')): ?>
									<div class="<?php echo $columns; ?> columns text-center icon-block">
										<div class="icon-container">
											<?php echo file_get_contents(get_sub_field('icon')); ?>
										</div>
										<h3><?php echo get_sub_field('title'); ?></h3>
										<p><?php echo get_sub_field('paragraph'); ?></p>
									</div>
								<?php endwhile; ?>
							<?php endif; ?>
						</div>
					</section> <!-- icon-blocks -->
				
	        <?php endif;
	    endwhile;
	endif;
?>