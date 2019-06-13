<div class="site-links">
	<div class="button">
		<?php $manufact_page = get_page_by_path('cooking/cooktop-manufacturers');
		$icl_manufact_page_id = icl_object_id($manufact_page->ID, 'page', true);
		?>
		<a href="<?php echo get_permalink($icl_manufact_page_id); ?>"><?php _e('Cooktop Manufacturers'); ?></a>
	</div>
	<div class="button blue">
		<?php $users_page = get_page_by_path('cooking/cooktop-users');
		$icl_users_page_id = icl_object_id($users_page->ID, 'page', true); ?>
		<a href="<?php echo get_permalink($icl_users_page_id); ?>"><?php _e('Cooktop Users'); ?></a>
	</div>
</div>