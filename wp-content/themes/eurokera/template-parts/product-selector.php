<section id="product-selector" class="product-selector">
	<div class="row">
		<div class="large-12 columns text-center">
			<h2><?php _e('Product Selector'); ?></h2>
			<p><?php _e('Use the selector below to guide you to the perfect EuroKera glass-ceramic solution or scroll down to see all of our substrates.'); ?></p>
			
			<form id="product-selector">
				<select id="glass-color" class="product-dropdown">
					<option value=""><?php _e('Glass-Ceramic Color'); ?></option>
					<option value="black"><?php _e('Black'); ?></option>
					<option value="grey"><?php _e('Grey (Slate)'); ?></option>
					<option value="transparent"><?php _e('Transparent'); ?></option>
					<option value="transparent"><?php _e('Transparent - Champagne'); ?></option>
					<option value="transparent"><?php _e('Transparent - Silver'); ?></option>
					<option value="transparent"><?php _e('Transparent - Slate Grey'); ?></option>
					<option value="transparent"><?php _e('Transparent - Anthracite'); ?></option>
					<!-- <option value="transparent"><?php _e('Transparent - UltraBlack'); ?></option> -->
					<option value="white"><?php _e('White'); ?></option>				
				</select>
				<select id="display" class="product-dropdown">
					<option value=""><?php _e('Display Options'); ?></option>
					<option value="all-color"><?php _e('Any Color including white'); ?></option>
					<option value="red"><?php _e('Red/Orange'); ?></option>
					<option value="monochromatic"><?php _e('Monochromatic'); ?></option>
					<option value="none"><?php _e('No Display'); ?></option>				
				</select>
				
				<div class="form-divider no-divider-small"><div><?php _e('Heat Source'); ?></div></div>
				<input class="stacked-radio" type="checkbox" name="heat-source" id="gas" value="gas"><label for="gas"><?php _e('Gas'); ?></label>
				<input class="stacked-radio" type="checkbox" name="heat-source" id="induction" value="induction"><label for="induction"><?php _e('Induction'); ?></label>
				<input class="stacked-radio" type="checkbox" name="heat-source" id="radiant" value="radiant"><label for="radiant"><?php _e('Radiant'); ?></label>

				<div class="form-divider"><div><?php _e('Custom Top Decoration'); ?></div></div>
				<input class="stacked-radio placebo" type="checkbox" name="decor" id="complex" value="complex"><label for="complex"><?php _e('Complex Patterns'); ?></label>
				<input class="stacked-radio placebo" type="checkbox" name="decor" id="reflective" value="reflective"><label for="reflective"><?php _e('Reflective Inks'); ?></label>
				<input class="stacked-radio placebo" type="checkbox" name="decor" id="multi" value="multi"><label for="multi"><?php _e('Multi-Colors'); ?></label>

				<div class="form-divider"><div><?php _e('Additional Design Options'); ?></div></div>
				<input class="round placebo" type="checkbox" name="holes" id="holes" value="complex"><label for="holes"><?php _e('Holes'); ?></label>
				<input class="round placebo" type="checkbox" name="bevels" id="bevels" value="bevels"><label for="bevels"><?php _e('Bevels'); ?></label>
				<input class="round" type="checkbox" name="woks" id="woks" value="woks"><label for="woks"><?php _e('Woks'); ?></label>
				<input class="round" type="checkbox" name="3d" id="3d" value="3d"><label for="3d"><?php _e('3D Shapes'); ?></label>
				<input class="round placebo" type="checkbox" name="custom-edge" id="custom-edge" value="custom-edge"><label for="custom-edge"><?php _e('Custom Edge Profiles'); ?></label>
				<input class="round placebo" type="checkbox" name="custom-shape" id="custom-shape" value="custom-shape"><label for="custom-shape"><?php _e('Custom Shapes'); ?></label>
				
				<div class="radio-group">
					<input type="radio" name="use" id="retail" value="retail"><label for="retail"><?php _e('Retail'); ?></label>
					<input type="radio" name="use" id="pro" value="pro"><label for="pro"><?php _e('Professional'); ?></label>
				</div>
			</form>
				
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
						<div class="large-4 medium-4 small-6 columns text-center product-selector-product <?php echo $classes; ?> <?php echo $white; ?>" data-href="<?php echo get_permalink(icl_object_id($post->ID, 'products', false, ICL_LANGUAGE_CODE)); ?>">
							
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
					
					<?php if (is_super_admin()) : ?>
						
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
					
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
				<script>
				// When they choose a glass color, update their "Display Options" selections
				jQuery('select#glass-color').on( 'change', function() {
					// Remove All Options	
					jQuery('select#display').find('option').remove();
					// Grey and White are the only glass colors with limitations
					// black - all, grey - red/orange, transparent - all, white - red/orange
					if (jQuery(this).val() != 'grey') {
						jQuery('select#display').append('<option value=""><?php _e('Display Options'); ?></option>');
					}
					if (jQuery(this).val() != 'grey' && jQuery(this).val() != 'white') {
						jQuery('select#display').append('<option value="all-color"><?php _e('Any Color including white'); ?></option>');
					}
					jQuery('select#display').append('<option value="red"><?php _e('Red/Orange'); ?></option>');
					if (jQuery(this).val() != 'grey' && jQuery(this).val() != 'white') {
						jQuery('select#display').append('<option value="monochromatic"><?php _e('Monochromatic'); ?></option>');
					}
					if (jQuery(this).val() == 'white') {
						jQuery('select#display').append('<option value="none"><?php _e('No Display'); ?></option>');
					}
					// Reset Display Options if this have no value
					if (jQuery(this).val() == '') {
						jQuery('select#display').prop('selectedIndex',0);
					}
				});
				jQuery('#product-selector input:not(.placebo), #product-selector select').on( 'change', function() {
					var selectedClasses = '';
					// Get all selected form elements
					jQuery('#product-selector input:not(.placebo):checked, #product-selector select').each(function() {
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
								if( --numDivs > 0 ) return;
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
					jQuery('#product-selector input:checked, #product-selector select').each(function() {
						fieldType = jQuery(this).get(0).tagName;
						if (jQuery(this).val() != '' && fieldType == 'SELECT') {
							if (jQuery(this).attr('id') == 'glass-color') {
								glassColor += ', ' + jQuery(this).find('option:selected').text();
							} else {
								displayOptions += ', ' + jQuery(this).find('option:selected').text();
							}
						} else if (jQuery(this).val() != '') {
							var selectedValue = jQuery('label[for="' + jQuery(this).attr('id') + '"]').html();
							if (selectedValue == 'Gas' || selectedValue == '<?php _e('Induction'); ?>' || selectedValue == '<?php _e('Radiant'); ?>') {
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