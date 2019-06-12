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
global $row_counter;
$row_counter = 1;
$background = "";
$section_id = '';

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
	        		<?php echo $before_parallax_prepend; ?><div <?php if ($section_id != 'undefined') { echo 'id="' . $section_id . '" ' ; } ?>class="parallax-window" data-paroller-factor="0.5" style="background: url('<?php echo wp_get_attachment_image_url(get_sub_field("parallax_image"), $size = "full"); ?>');"><?php echo $before_parallax_append; ?>
						<div class="row">
							<div class="large-12 columns entry-content">
								<?php echo get_sub_field('one_column'); ?>
							</div>
						</div> <!-- row -->
					<?php echo $after_parallax_prepend; ?></div><?php echo $after_parallax_append; ?>

				<!-- One Column Not Parallax -->
	        	<?php else : ?>
	        		<section <?php if ($section_id != 'undefined') { echo 'id="' . $section_id . '" ' ; } ?>class="<?php echo $background; ?>">
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
	        		</div></div><div <?php if ($section_id != 'undefined') { echo 'id="' . $section_id . '" ' ; } ?>class="parallax-window" data-parallax="scroll" data-image-src="<?php echo wp_get_attachment_image_url(get_sub_field('parallax_image'), $size = 'full'); ?>"><div class="row"><div class="large-12 columns">
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
	        		<section <?php if ($section_id != 'undefined') { echo 'id="' . $section_id . '" ' ; } ?>class="<?php echo $background; ?>">
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
				<section <?php if ($section_id != 'undefined') { echo 'id="' . $section_id . '" ' ; } ?>class="<?php echo $background; ?>">
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
	        	<section <?php if ($section_id != 'undefined') { echo 'id="' . $section_id . '" ' ; } ?>class="<?php echo $background; ?>">
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
	        	<section <?php if ($section_id != 'undefined') { echo 'id="' . $section_id . '" ' ; } ?>class="<?php echo $background; ?>">
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
				<section <?php if ($section_id != 'undefined') { echo 'id="' . $section_id . '" ' ; } ?>class="<?php echo $background; ?>">
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
				<section <?php if ($section_id != 'undefined') { echo 'id="' . $section_id . '" ' ; } ?>class="<?php echo $background; ?>">
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
				<section <?php if ($section_id != 'undefined') { echo 'id="' . $section_id . '" ' ; } ?>class="<?php echo $background; ?>">
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
					
					<?php get_template_part('template-parts/page', 'slider'); ?>

				<?php elseif( get_row_layout() == 'icon_blocks' ): ?>
				
					<?php
					$section_id = get_sub_field('section_id');	
					$num_columns = get_sub_field('columns');
					if ($num_columns == 3) {
						$columns = 'large-4 medium-4';
					} else {
						$columns = 'large-3 medium-3';
					}
					?>
				
					<section <?php if ($section_id != 'undefined') { echo 'id="' . $section_id . '" ' ; } ?>class="icon-blocks">
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


				<?php elseif( get_row_layout() == 'block_sections' ): ?>
				
					<?php $section_id = get_sub_field('section_id'); ?>
				
					<section <?php if ($section_id != 'undefined') { echo 'id="' . $section_id . '" ' ; } ?>class="block-sections">
						<div class="row">
							<div class="large-12 columns block-section-intro">
								<?php echo get_sub_field('intro'); ?>
							</div>
						</div>
						<div class="row">
							<?php if(get_sub_field('block_sections')): ?>
								<?php while(has_sub_field('block_sections')): ?>
									<div class="large-12 columns block-section-title">
										<h3><?php echo get_sub_field('title'); ?></h3>
									</div>
									<?php if(get_sub_field('blocks')): ?>
										<div class="flex">
										<?php while(has_sub_field('blocks')): ?>
											<div class="large-4 medium-4 columns page-block text-center">
												<div class="page-block-image flex">
													<?php echo wp_get_attachment_image(get_sub_field('image'), 'full'); ?>
												</div>
												<h4><?php echo get_sub_field('title'); ?></h4>
												<p><?php echo get_sub_field('description'); ?></p>
												<?php
												$button_text = get_sub_field('button_text');	
												$download = get_sub_field('download');	
												?>
												<?php if ($button_text != '' && $download != '') : ?>
													<div class="button small blue"><a href="<?php echo $download; ?>"><?php echo $button_text; ?></a></div>
												<?php endif; ?>
											</div> <!-- page-block -->
										<?php endwhile; ?>
										</div> <!-- flex -->
									<?php endif; ?>
								<?php endwhile; ?>
							<?php endif; ?>
						</div>
						
						<?php
						$button_link = get_sub_field('bottom_button_link');
						$button_text = get_sub_field('bottom_button_text')
						?>
						<?php if ($button_link != '' && $button_text != '') : ?>
						<div class="row">
							<div class="large-12 columns text-center">
								<div class="button"><a href="<?php echo $button_link; ?>"><?php echo $button_text; ?></a></div>
							</div>	
						</div>
						<?php endif; ?>
						
					</section> <!-- block-sections -->					

				<?php elseif( get_row_layout() == 'gallery' ): ?>
				
					<?php $section_id = get_sub_field('section_id'); ?>
				
					<section <?php if ($section_id != 'undefined') { echo 'id="' . $section_id . '" ' ; } ?>class="page-gallery">
						<div class="row">
							<div class="large-12 columns">
								<h2><?php echo get_sub_field('title'); ?></h2>
							</div>
						</div>
						<div class="row">
							<?php 
							$images = get_sub_field('images');								
							if( $images ): ?>
								<div class=" slider-container slider-container-<?php echo $row_counter; ?>">
								<ul class="bxslider gallery-<?php echo $row_counter; ?>">
							    		<?php foreach( $images as $image ): ?>
							        		<li>
							            		<?php echo wp_get_attachment_image( $image['ID'], 'width=1080&height=640&crop=1' ); ?>
							            		<p class="gallery-slide-caption"><?php echo wp_get_attachment_caption($image['ID']); ?></p>
							            </li>
							        <?php endforeach; ?>
							    </ul>
							    <p class="gallery-caption"></p>
								</div>
								<script>
									jQuery(window).load(function(){
										function loadCaption(currentSlide) {
											var caption = currentSlide.find('p.gallery-slide-caption').html();
											/* jQuery('.slider-container-<?php echo $row_counter; ?> p.gallery-caption').html(caption); */
										}										
										var slider = jQuery('.gallery-<?php echo $row_counter; ?>').bxSlider({
										    auto: false,
										    pager: (jQuery(".bxslider > li").length > 1) ? true: false,
										    controls: true,
										    mode: 'fade',
										    speed: 1000,
										    onSliderLoad: function(currentIndex) {     
												var currentSlide = jQuery('.slider-container-<?php echo $row_counter; ?>').find('.bx-viewport').find('ul').children().eq(currentIndex);
												loadCaption(currentSlide);
    											},
										    onSlideBefore: function($slideElement) {
												loadCaption($slideElement);
    											},
    										onSlideAfter: function() {
												slider.stopAuto();
												slider.startAuto();
											}  
										});
									});

								</script>								    
							<?php endif; ?>
						</div> <!-- row -->
					</section> <!-- page-gallery -->
										
					
				<?php elseif( get_row_layout() == 'image_bg_section' ): ?>
				
					<?php $section_id = get_sub_field('section_id'); ?>
				
					<section <?php if ($section_id != 'undefined') { echo 'id="' . $section_id . '" ' ; } ?>class="page-bg-section no-padding">
						<div class="flex">
							<?php
							$section_one = get_sub_field('section_one');
							// print_r($section_one);
							$section_two = get_sub_field('section_two');
							$width = $section_one['width'];
							if ($width == 'wide') {
								$columns_1 = 'large-8 medium-8 columns';
								$columns_2 = 'large-4 medium-4 columns';
							} else {
								$columns_1 = 'large-4 medium-4 columns';
								$columns_2 = 'large-8 medium-8 columns';
							}
							$img_src = wp_get_attachment_image_src($section_one['bg_image']['ID'], 'full');
							?>
							<div class="<?php echo $columns_1; ?> <?php echo $section_one['vert_align']; ?> text-<?php echo $section_one['text_color']; ?>" style="background-image: url(<?php echo $img_src[0] ?>);">
								<?php echo $section_one['content']; ?>
							</div>
							<?php $img_src = wp_get_attachment_image_src($section_two['bg_image']['ID'], 'full'); ?>
							<div class="<?php echo $columns_2; ?> <?php echo $section_two['vert_align']; ?> text-<?php echo $section_two['text_color']; ?>" style="background-image: url(<?php echo $img_src[0] ?>);">
								<?php echo $section_two['content']; ?>
							</div>
						</div> <!-- flex -->
					</section> <!-- page-bg-section -->				

				<?php elseif( get_row_layout() == 'blog_section' ): ?>
				
					<?php get_template_part('template-parts/latest', 'blogs'); ?>
				
				<?php elseif( get_row_layout() == 'work_together' ): ?>
				
					<?php echo get_template_part('template-parts/content','ready'); ?>

				<?php elseif( get_row_layout() == 'quality_videos' ): ?>
				
								<section <?php if ($section_id != 'undefined') { echo 'id="' . $section_id . '" ' ; } ?>class="<?php echo $background; ?>">
					<div class="row">
						<div class="large-12 columns">

				<?php
	$rows = get_field('quality_videos','option');
	if($rows) {
		shuffle( $rows );
		$counter = 1;
		echo '<div class="product-videos">';
		foreach($rows as $row) { ?>
		
			<?php if (ICL_LANGUAGE_CODE == 'zh-hans') : ?>	
				<?php
				$video_markup = '<a id="quality-video-' . $counter . '" class="quality-video vp-a vp-mp4-type" href="' . $row['video_url'] . '" data-autoplay="1" data-dwrap="1"></a>';
				echo apply_filters('the_content', $video_markup);
				$video_inner = '<div class="product-addl-video">' . wp_get_attachment_image( $row['video_poster'], 'width=310&height=228&crop=1' );
				ob_start();
				get_template_part('assets/images/play', 'button.svg');
				$play_button = ob_get_contents();
				ob_end_clean();
				$video_inner .= $play_button;
				$video_inner .= '</div><div class="video-title" style="display:table;height:100%;"><div style="display:table-cell;vertical-align:middle;"><div><h2>' . $row['video_title'] . '</h2></div></div></div>';
				?>
				<script>
					jQuery('a#quality-video-<?php echo $counter; ?>').html('<?php echo $video_inner; ?>');
				</script>
			<?php else: ?>
		
		
			<a class="quality-video" href="<?php echo $row['video_url']; ?>?autoplay=1&modestbranding=1&showinfo=0&rel=0" data-featherlight="iframe" data-featherlight-iframe-width="960" data-featherlight-iframe-height="540">
				<div class="product-addl-video">
					<?php echo  wp_get_attachment_image( $row['video_poster'], 'width=310&height=228&crop=1' ); ?>
					<?php get_template_part('assets/images/play', 'button.svg'); ?>
				</div>
				<div class="video-title" style="display:table;height:100%;">
				  <div style="display:table-cell;vertical-align:middle;">
				    <div><h2><?php echo $row['video_title']; ?></h2></div>
				  </div>
				</div>
			</a>
			
			<?php endif; ?>
			<?php
			$counter++;
		}
		echo '</div>';
	} ?>
						</div>


		        		</div> <!-- row -->
					</section>



				
				
	        <?php endif;
		    $row_counter++;
	    endwhile;
	endif;
?>