<section id="contact" class="ready">
	<div class="row">
		<div class="large-12 columns text-center">
			<!-- <h2><?php _e('Ready To Build An Innovative Cooktop?','foundationpress'); ?></h2>
			<?php $contact_page = get_page_by_path('contact');
			$icl_contact_page_id = icl_object_id($contact_page->ID, 'page', true);	
			?>
			<div class="button reverse"><a href="<?php echo get_permalink($icl_contact_page_id); ?>" id="work-together-btn"><?php _e('Let\'s Work Together','foundationpress'); ?></a></div> -->
			<h2><?php _e('Let\'s Work Together','foundationpress'); ?></h2>
			<?php
			/*
			Form Options:
			Home Cooking	
			Fireplaces
			Versâtis
			Specialties
			Professional Cooking
			*/
			$field_values = "";
			$solution = __(get_sub_field('auto_populate', 'foundationpress'));
			if ($solution != '') {
				$field_values = " field_values='solution=" . $solution . "'";
			} else {
				if (is_page_template('page-templates/versatis.php')) {
					$solution = _('Versâtis','foundationpress');
					$field_values = " field_values='solution=" . __('Versâtis','foundationpress') . "'";
				}
				if (is_page_template('page-templates/cooking.php')) {
					$field_values = " field_values='solution=" . __('Home Cooking','foundationpress') . "'";
				}
				if (is_page_template('page-templates/cooktop-makers.php')) {
					$field_values = " field_values='solution=" . __('Home Cooking','foundationpress') . "'";
				}
				if (is_page_template('page-templates/cooktop-users.php')) {
					$field_values = " field_values='solution=" . __('Home Cooking','foundationpress') . "'";
				}				
			}
			?>
			<?php echo do_shortcode('[gravityform id="1" title="false" description="false"' . $field_values . ']'); ?>
		</div>
	</div>
</section>