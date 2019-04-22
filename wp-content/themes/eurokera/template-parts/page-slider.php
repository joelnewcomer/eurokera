<?php global $row_counter; ?>
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
