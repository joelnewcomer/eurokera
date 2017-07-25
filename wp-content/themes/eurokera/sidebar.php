<?php
/**
 * The sidebar containing the main widget area
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<aside class="sidebar sr large-4 medium-4 columns <?php if (is_page_template( 'page-templates/page-sidebar-left.php' )) { echo 'large-pull-8 medium-pull-8'; }?>">
	<?php do_action( 'foundationpress_before_sidebar' ); ?>
	<?php dynamic_sidebar( 'sidebar-widgets' ); ?>
	<?php do_action( 'foundationpress_after_sidebar' ); ?>
</aside>
