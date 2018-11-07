<div class="site-links">
	<div class="button">
		<?php $manufact_page = get_page_by_path('cooktop-manufacturers'); ?>
		<a href="<?php echo apply_filters( 'wpml_permalink', get_permalink($manufact_page)); ?>"><?php _e('Cooktop Manufacturers'); ?></a>
	</div>
	<div class="button blue">
		<?php $users_page = get_page_by_path('cooktop-users'); ?>
		<a href="<?php echo apply_filters( 'wpml_permalink', get_permalink($users_page)); ?>"><?php _e('Cooktop Users'); ?></a>
	</div>
</div>