<?php
/**
 * Entry meta information for posts
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

if ( ! function_exists( 'foundationpress_entry_meta' ) ) :
	function drum_entry_meta() {
		global $post;
		$author = get_field('author');
		if ($author == '') {
			$author = get_the_author();
		}
		echo '<ul class="post-meta group">';
			echo '<li><div class="byline"><span>By: ' . $author . '</div></li>'; ?>
		</ul> <!-- post-meta -->
	<?php }
endif; ?>
