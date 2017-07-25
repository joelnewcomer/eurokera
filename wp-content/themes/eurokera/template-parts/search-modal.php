<?php
/**
 * The template for displaying search form
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

do_action( 'foundationpress_before_searchform' ); ?>
<div class="search-popup-container">
	<div class="search-popup" id="search-modal">
		<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
			<?php do_action( 'foundationpress_searchform_top' ); ?>
			<input type="text" value="" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'foundationpress' ); ?>">
			<svg class="cross-out" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 viewBox="0 0 224.512 224.512" style="enable-background:new 0 0 224.512 224.512;" xml:space="preserve">
				<polygon style="fill:#010002;" points="224.507,6.997 217.521,0 112.256,105.258 6.998,0 0.005,6.997 105.263,112.254
					0.005,217.512 6.998,224.512 112.256,119.24 217.521,224.512 224.507,217.512 119.249,112.254 	"/>
			</svg>
			<input type="submit" class="search" id="searchsubmit" value="&#xf002;">
			<svg class="search-icon" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1216 832q0-185-131.5-316.5t-316.5-131.5-316.5 131.5-131.5 316.5 131.5 316.5 316.5 131.5 316.5-131.5 131.5-316.5zm512 832q0 52-38 90t-90 38q-54 0-90-38l-343-342q-179 124-399 124-143 0-273.5-55.5t-225-150-150-225-55.5-273.5 55.5-273.5 150-225 225-150 273.5-55.5 273.5 55.5 225 150 150 225 55.5 273.5q0 220-124 399l343 343q37 37 37 90z"/></svg>
			<?php do_action( 'foundationpress_searchform_bottom' ); ?>
		</form>
	</div> <!-- search-modal -->
</div>

<!-- Set keyboard focus to search input -->
<script>
	jQuery( document ).ready(function() {
		jQuery('.search-button').featherlight({
			namespace: 'fl-modal',
			variant: 'fl-search',
			closeIcon: '&#10005;',			
			afterContent: function(event){
				setTimeout(function() {
					jQuery( 'input#s' ).focus();
				}, 500);
			},
		});
	});
</script>

<?php do_action( 'foundationpress_after_searchform' ); ?>