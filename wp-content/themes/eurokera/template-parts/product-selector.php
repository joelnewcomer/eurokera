<section id="product-selector" class="product-selector">
	<div class="row">
		<div class="large-12 columns text-center">
			<h2><?php _e('Product Selector'); ?></h2>
			<p><?php _e('Use the selector below to guide you to the perfect EuroKera glass-ceramic solution or scroll down to see all of our substrates.'); ?></p>
			
			<form id="product-selector">
				<div class="product-dropdown">
					<div class="dropdown-title"><?php _e('Glass-Ceramic Color'); ?></div>
					<div class="dropdown-options">
						<input type="radio" name="glass-color" id="black" value="black"><label for="black"><?php _e('Black'); ?></label>
						<input type="radio" name="glass-color" id="grey" value="grey"><label for="grey"><?php _e('Grey (Slate)'); ?></label>
						<input type="radio" name="glass-color" id="trans" value="transparent"><label for="trans"><?php _e('Transparent'); ?></label>
						<input type="radio" name="glass-color" id="trans-champagne" value="transparent"><label for="trans-champagne"><?php _e('Transparent - Champagne'); ?></label>
						<input type="radio" name="glass-color" id="trans-silver" value="transparent"><label for="trans-silver"><?php _e('Transparent - Silver'); ?></label>
						<input type="radio" name="glass-color" id="trans-grey" value="transparent"><label for="trans-grey"><?php _e('Transparent - Slate Grey'); ?></label>
						<input type="radio" name="glass-color" id="trans-anthra" value="transparent"><label for="trans-anthra"><?php _e('Transparent - Anthracite'); ?></label>
						<input type="radio" name="glass-color" id="white" value="white"><label for="white"><?php _e('White'); ?></label>
					</div>
				</div>
				
				<div class="product-dropdown">
					<div class="dropdown-title"><?php _e('Display Option'); ?></div>
					<div class="dropdown-options" id="display">
						<input type="radio" name="display" id="all-color" value="all-color"><label for="all-color"><?php _e('Any Color including white'); ?></label>
						<input type="radio" name="display" id="red" value="red"><label for="red"><?php _e('Red/Orange'); ?></label>
						<input type="radio" name="display" id="monochromatic" value="monochromatic"><label for="monochromatic"><?php _e('Monochromatic'); ?></label>
						<input type="radio" name="display" id="none" value="none"><label for="none"><?php _e('No Display'); ?></label>
					</div>	
				</div>
				
				<div class="product-dropdown">
					<div class="dropdown-title"><?php _e('Heat Source'); ?></div>
					<div class="dropdown-options">
						<input type="checkbox" name="heat-source" id="gas" value="gas"><label for="gas"><?php _e('Gas'); ?></label>
						<input type="checkbox" name="heat-source" id="induction" value="induction"><label for="induction"><?php _e('Induction'); ?></label>
						<input type="checkbox" name="heat-source" id="radiant" value="radiant"><label for="radiant"><?php _e('Radiant'); ?></label>
					</div>
				</div>
				
				<div class="product-dropdown">
					<div class="dropdown-title"><?php _e('Decoration'); ?></div>
					<div class="dropdown-options">
						<input class="placebo" type="checkbox" name="decor" id="complex" value="complex"><label for="complex"><?php _e('Complex Patterns'); ?></label>
						<input class="placebo" type="checkbox" name="decor" id="reflective" value="reflective"><label for="reflective"><?php _e('Reflective Inks'); ?></label>
						<input class="placebo" type="checkbox" name="decor" id="multi" value="multi"><label for="multi"><?php _e('Multi-Colors'); ?></label>
					</div>
				</div>

				<div class="product-dropdown">
					<div class="dropdown-title"><?php _e('Design Options'); ?></div>
					<div class="dropdown-options">
						<input class="placebo" type="checkbox" name="holes" id="holes" value="complex"><label for="holes"><?php _e('Holes'); ?></label>
						<input class="placebo" type="checkbox" name="bevels" id="bevels" value="bevels"><label for="bevels"><?php _e('Bevels'); ?></label>
						<input type="checkbox" name="woks" id="woks" value="woks"><label for="woks"><?php _e('Woks'); ?></label>
						<input type="checkbox" name="3d" id="3d" value="3d"><label for="3d"><?php _e('3D Shapes'); ?></label>
						<input class="placebo" type="checkbox" name="custom-edge" id="custom-edge" value="custom-edge"><label for="custom-edge"><?php _e('Custom Edge Profiles'); ?></label>
						<input class="placebo" type="checkbox" name="custom-shape" id="custom-shape" value="custom-shape"><label for="custom-shape"><?php _e('Custom Shapes'); ?></label>
					</div>
				</div>
					
				<div class="product-dropdown">
					<div class="dropdown-title"><?php _e('Type of Use'); ?></div>
					<div class="dropdown-options">
						<input type="radio" name="use" id="retail" value="retail"><label for="retail"><?php _e('Retail'); ?></label>
						<input type="radio" name="use" id="pro" value="pro"><label for="pro"><?php _e('Professional'); ?></label>
					</div>
				</div>
			</form>
			
			<script>
				jQuery(".dropdown-title").on( "click", function() {
					var toggleClass = 'active';
					if (jQuery(this).parent().hasClass('active')) {
						toggleClass = '';
					}
					jQuery('.product-dropdown').removeClass('active');
					jQuery(this).parent().addClass(toggleClass);
				});
			</script>
				
				<?php $contact_page = get_page_by_path('contact');
				$icl_contact_page_id = icl_object_id($contact_page->ID, 'page', true);
				$contact_url = get_permalink($icl_contact_page_id); ?>	
				
				<?php $contact_string = sprintf( __('Let us help you <a href="%s">build</a> a custom design.', 'foundationpress'), $contact_url); ?>
				<p><?php _e('EuroKera was founded with the goal of serving appliance manufacturers like you. Your ideas inspire us to continually develop new technologies, materials and designs.'); ?> <?php echo $contact_string; ?></p>
			
			<div id="products">
				<h2 class="no-matches"><?php _e('No products match your selected criteria.'); ?><br /><?php _e('Please try different selections.'); ?></h2>
				<?php
				$args = array(
					'post_type' => 'products',
					'posts_per_page' => -1
				);					
				$the_query = new WP_Query( $args ); ?>
				<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<?php
						global $post;
						$white = '';
						$classes = '';
						$title = get_the_title();
						if (strpos($title, 'White') !== false) {
							$white = 'white';	
						}
						$classes = '';
						$glass_colors = get_field('glass_color');
						if (is_array($glass_colors)) {			
							foreach ($glass_colors as $glass_color) {
								$classes .= ' ' . strtolower($glass_color);
							}
						} else {
							$classes .= ' ' . strtolower($glass_colors);
						}
						$led_colors = get_field('led_colors');
						foreach ($led_colors as $led_color) {
							$classes .= ' ' . sanitize_title($led_color);
						}
						$heat_sources = get_field('heat_source');
						foreach ($heat_sources as $heat_source) {
							$classes .= ' ' . strtolower($heat_source);
						}
						if (get_field('3d_shapes')) {
							$classes .= ' 3d';
						}
						if (get_field('woks')) {
							$classes .= ' woks';
						}
						$retail_pro = get_field('retail_pro');
						foreach ($retail_pro as $market) {
							$classes .= ' ' . strtolower($market);
						}
						?>
						<div class="large-4 medium-4 small-6 columns text-center product-selector-product <?php echo $classes; ?> <?php echo $white; ?>" data-href="<?php echo get_permalink(apply_filters( 'wpml_object_id', $post->ID, 'products')); ?>">
							
							<?php echo wp_get_attachment_image( get_field('thumbnail'), 'width=355&height=203&crop=1' ); ?>
							<div class="overlay">
								<div style="display:table;width:100%;height:100%;">
								  <div style="display:table-cell;vertical-align:middle;">
								    <div style="text-align:center;" class="product-name"><?php the_title(); ?></div>
								  </div>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
					

						<?php $pro_cooking_page = get_page_by_path('professional-cooking');
						$icl_pro_cooking_page_id = icl_object_id($enamels_page->ID, 'page', true);
						$pro_cooking_url = get_permalink($icl_pro_cooking_page_id); ?>	
						
						<a class="large-4 medium-4 small-6 columns text-center product-selector-product always-show" href="<?php echo $pro_cooking_url; ?>">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/pro-cooking-product.jpg" alt="<?php _e('Enamels'); ?>"> 
							<div class="overlay">
								<div style="display:table;width:100%;height:100%;">
								  <div style="display:table-cell;vertical-align:middle;">
								    <div style="text-align:center;" class="product-name"><?php _e('Professional Cooking'); ?></div>
								  </div>
								</div>
							</div>
						</a>

						
						<?php $enamels_page = get_page_by_path('enamels');
						$icl_enamels_page_id = icl_object_id($enamels_page->ID, 'page', true);
						$enamels_url = get_permalink($icl_enamels_page_id); ?>	
						
						<a class="large-4 medium-4 small-6 columns text-center product-selector-product always-show" href="<?php echo $enamels_url; ?>">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/enamels-product.png" alt="<?php _e('Enamels'); ?>"> 
							<div class="overlay">
								<div style="display:table;width:100%;height:100%;">
								  <div style="display:table-cell;vertical-align:middle;">
								    <div style="text-align:center;" class="product-name"><?php _e('Top Decoration Enamels'); ?></div>
								  </div>
								</div>
							</div>
						</a>
					
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
				<script>
				// When they choose a glass color, update their "Display Options" selections
				jQuery('input[name="glass-color"]').on( 'change', function() {
					// Remove All Options	
					jQuery('#display').find('input').remove();
					jQuery('#display').find('label').remove();
					// Grey and White are the only glass colors with limitations
					// black - all, grey - red/orange, transparent - all, white - red/orange
					if (jQuery(this).val() != 'grey' && jQuery(this).val() != 'white') {
						jQuery('#display').append('<input type="radio" name="display" id="all-color" value="all-color"><label for="all-color"><?php _e('Any Color including white'); ?></label>');
					}
					jQuery('#display').append('<input type="radio" name="display" id="red" value="red"><label for="red"><?php _e('Red/Orange'); ?></label>');
					if (jQuery(this).val() != 'grey' && jQuery(this).val() != 'white') {
						jQuery('#display').append('<input type="radio" name="display" id="monochromatic" value="monochromatic"><label for="monochromatic"><?php _e('Monochromatic'); ?></label>');
					}
					if (jQuery(this).val() == 'white') {
						jQuery('#display').append('<input type="radio" name="display" id="none" value="none"><label for="none"><?php _e('No Display'); ?></label>');
					}
					// Reset Display Options if this have no value
					if (jQuery(this).val() == '') {
						jQuery('#display input').prop( "checked", false );
					}
				});
				jQuery(document).on( 'change', '#product-selector input:not(.placebo)', function() {
					var selectedClasses = '';
					// Get all selected form elements
					jQuery('#product-selector input:not(.placebo):checked').each(function() {
						// if (jQuery(this).val() != '' &&  jQuery(this).val() != 'all-color') {
						if (jQuery(this).val() != '') {
							selectedClasses += '.' + jQuery(this).val();
						}
					});
					var numDivs = jQuery('.product-selector-product:not(' + selectedClasses + ')').length;
					if (jQuery('.product-selector-product:not(' + selectedClasses + ')').length ) {
						jQuery('.product-selector-product:not(' + selectedClasses + '):not(".always-show")').fadeOut({
							duration: "fast",
							complete: function() {
								// if( --numDivs > 0 ) return; removed 4/16/19 why was this here? JSN
								jQuery('.product-selector-product' + selectedClasses).fadeIn();
							}
						});
					} else {
						jQuery('.product-selector-product' + selectedClasses).fadeIn();
					}
					// If no products match current selection, show message
					if ( jQuery('.product-selector-product' + selectedClasses).length === 0) {
						jQuery('h2.no-matches').fadeIn();
					} else {
						jQuery('h2.no-matches').fadeOut();
					}
				});
				// When user clicks on product, email their form selections to EuroKera
				jQuery(".product-selector-product:not('.always-show')").on('click', function() {
					var productUrl = jQuery(this).data('href');
					var productName = jQuery(this).find('.product-name').html();
					var glassColor = "";
					var displayOptions = "";
					var heatSource = "";
					var customTop = ""
					var retailPro = "";
					var addlOptions = "";
					// Get all selected form elements
					jQuery('#product-selector input:checked').each(function() {
						fieldType = jQuery(this).get(0).tagName;
						if (jQuery(this).val() != '') {
							var selectedValue = jQuery('label[for="' + jQuery(this).attr('id') + '"]').html();
							if (selectedValue == '<?php _e('Black'); ?>' || selectedValue == '<?php _e('Grey (Slate)'); ?>' || selectedValue == '<?php _e('Transparent'); ?>' || selectedValue == '<?php _e('Transparent - Champagne'); ?>' || selectedValue == '<?php _e('Transparent - Silver'); ?>' || selectedValue == '<?php _e('Transparent - Slate Grey'); ?>' || selectedValue == '<?php _e('Transparent - Anthracite'); ?>' || selectedValue == '<?php _e('White'); ?>') {
								glassColor += ', ' + selectedValue;
							} else if (selectedValue == '<?php _e('Any Color including white'); ?>' || selectedValue == '<?php _e('Red/Orange'); ?>' || selectedValue == '<?php _e('Monochromatic'); ?>' || selectedValue == '<?php _e('No Display'); ?>') {
								displayOptions += ', ' + selectedValue;
							} else if (selectedValue == '<?php _e('Gas'); ?>' || selectedValue == '<?php _e('Induction'); ?>' || selectedValue == '<?php _e('Radiant'); ?>') {
								heatSource += ', ' + selectedValue;
							} else if (selectedValue == '<?php _e('Complex Patterns'); ?>' || selectedValue == '<?php _e('Reflective Inks'); ?>' || selectedValue == '<?php _e('Multi-Colors'); ?>') {
								customTop += ', ' + selectedValue;
							} else if (selectedValue == '<?php _e('Retail'); ?>' || selectedValue == '<?php _e('Professional'); ?>') {
								retailPro += ', ' + selectedValue;
							} else {
								addlOptions += ', ' + selectedValue;
							}
						}
					});
					jQuery.ajax({
    					url: '<?php echo get_stylesheet_directory_uri(); ?>/ajax-selector-log.php',
    					type: 'POST',
    					data: { productName : productName, glassColor : glassColor, displayOptions : displayOptions, heatSource : heatSource, customTop : customTop, retailPro : retailPro, addlOptions : addlOptions },
    				});
    				// Go to the product they clicked on
    				window.location.href = productUrl;
				});
				</script>
			</div>
							
		</div>
	</div>
</section>