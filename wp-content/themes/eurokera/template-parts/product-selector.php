<section id="product-selector" class="product-selector">
	<div class="row">
		<div class="large-12 columns text-center">
			<h2>Product Selector</h2>
			
			<form id="product-selector">
				<select id="glass-color" class="product-dropdown">
					<option value="">Glass-Ceramic Color</option>
					<option value="black">Black</option>
					<option value="grey">Grey (Slate)</option>
					<option value="transparent">Transparent</option>
					<option value="transparent">Transparent - Silver</option>
					<option value="transparent">Transparent - Slate Grey</option>
					<option value="transparent">Transparent - Anthracite</option>
					<option value="transparent">Transparent - UltraBlack</option>
					<option value="white">White</option>				
				</select>
				<select id="display" class="product-dropdown">
					<option value="">Display Options</option>
					<option value="all-color">Any Color including white</option>
					<option value="red">Red/Orange</option>
					<option value="monochromatic">Monochromatic</option>
					<option value="none">No Display</option>				
				</select>
				
				<div class="form-divider no-divider-small"><div>Heat Source</div></div>
				<input class="stacked-radio" type="checkbox" name="heat-source" id="gas" value="gas"><label for="gas">Gas</label>
				<input class="stacked-radio" type="checkbox" name="heat-source" id="induction" value="induction"><label for="induction">Induction</label>
				<input class="stacked-radio" type="checkbox" name="heat-source" id="radiant" value="radiant"><label for="radiant">Radiant</label>

				<div class="form-divider"><div>Custom Top Decoration</div></div>
				<input class="stacked-radio placebo" type="checkbox" name="decor" id="complex" value="complex"><label for="complex">Complex Patterns</label>
				<input class="stacked-radio placebo" type="checkbox" name="decor" id="reflective" value="reflective"><label for="reflective">Reflective Inks</label>
				<input class="stacked-radio placebo" type="checkbox" name="decor" id="multi" value="multi"><label for="multi">Multi-Colors</label>

				<div class="form-divider"><div>Additional Design Options</div></div>
				<input class="round placebo" type="checkbox" name="holes" id="holes" value="complex"><label for="holes">Holes</label>
				<input class="round placebo" type="checkbox" name="bevels" id="bevels" value="bevels"><label for="bevels">Bevels</label>
				<input class="round" type="checkbox" name="woks" id="woks" value="woks"><label for="woks">Woks</label>
				<input class="round" type="checkbox" name="3d" id="3d" value="3d"><label for="3d">3D Shapes</label>
				<input class="round placebo" type="checkbox" name="custom-edge" id="custom-edge" value="custom-edge"><label for="custom-edge">Custom Edge Profiles</label>
				<input class="round placebo" type="checkbox" name="custom-shape" id="custom-shape" value="custom-shape"><label for="custom-shape">Custom Shapes</label>
				
				<div class="radio-group">
					<input class="placebo" type="radio" name="use" id="retail" value="retail"><label for="retail">Retail</label>
					<input class="placebo" type="radio" name="use" id="pro" value="pro"><label for="pro">Professional</label>
				</div>
			</form>
				
				<p>EuroKera was founded with the goal of serving appliance manufacturers like you. Your ideas inspire us to continually develop new technologies, materials and designs. Let us help you <a href="<?php echo get_site_url(); ?>/contact">build</a> a custom design.</p>
			
			<div id="products">
				<h2 class="no-matches">No products match your selected criteria.<br />Please try different selections.</h2>
				<?php
				$args = array(
					'post_type' => 'products',
					'posts_per_page' => -1
				);					
				$the_query = new WP_Query( $args ); ?>
				<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<?php
						$white = '';
						$title = get_the_title();
						if (strpos($title, 'White') !== false) {
							$white = 'white';	
						}
						$classes = '';
						$classes .= strtolower(get_field('glass_color'));
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
						?>
						<div class="large-4 medium-4 small-6 columns text-center product-selector-product <?php echo $classes; ?> <?php echo $white; ?>" data-href="<?php the_permalink(); ?>">
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
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
				<script>
				// When they choose a glass color, update their "Display Options" selections
				jQuery('select#glass-color').on( 'change', function() {
					// Remove All Options	
					jQuery('select#display').find('option').remove();
					// Grey and White are the only glass colors with limitations
					// black - all, grey - red/orange, transparent - all, white - red/orange
					if (jQuery(this).val() != 'grey' && jQuery(this).val() != 'white') {
						jQuery('select#display').append('<option value="">Display Options</option>');
						jQuery('select#display').append('<option value="all-color">Any Color including white</option>');
					}
					jQuery('select#display').append('<option value="red">Red/Orange</option>');
					if (jQuery(this).val() != 'grey' && jQuery(this).val() != 'white') {
						jQuery('select#display').append('<option value="monochromatic">Monochromatic</option>');
						jQuery('select#display').append('<option value="none">No Display</option>');
					}
				});
				jQuery('#product-selector input:not(.placebo), #product-selector select').on( 'change', function() {
					var selectedClasses = '';
					// Get all selected form elements
					jQuery('#product-selector input:not(.placebo):checked, #product-selector select').each(function() {
						if (jQuery(this).val() != '') {
							selectedClasses += '.' + jQuery(this).val();
						}
					});
					var numDivs = jQuery('.product-selector-product:not(' + selectedClasses + ')').length;
					if (jQuery('.product-selector-product:not(' + selectedClasses + ')').length ) {
						jQuery('.product-selector-product:not(' + selectedClasses + ')').fadeOut({
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
				jQuery(".product-selector-product").on('click', function() {
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
							if (selectedValue == 'Gas' || selectedValue == 'Induction' || selectedValue == 'Radiant') {
								heatSource += ', ' + selectedValue;
							} else if (selectedValue == 'Complex Patterns' || selectedValue == 'Reflective Inks' || selectedValue == 'Multi-Colors') {
								customTop += ', ' + selectedValue;
							} else if (selectedValue == 'Retail' || selectedValue == 'Professional') {
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