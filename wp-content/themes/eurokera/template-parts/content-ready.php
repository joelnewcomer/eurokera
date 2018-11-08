<section class="ready">
	<div class="row">
		<div class="large-12 columns text-center">
			<h2><?php _e('Ready To Build An Innovative Cooktop?','foundationpress'); ?></h2>
			<?php $contact_page = get_page_by_path('contact');
			$icl_contact_page_id = icl_object_id($contact_page->ID, 'page', true);	
			?>
			<div class="button reverse"><a href="<?php echo get_permalink($icl_contact_page_id); ?>" id="work-together-btn"><?php _e('Let\'s Work Together','foundationpress'); ?></a></div>
		</div>
	</div>
</section>