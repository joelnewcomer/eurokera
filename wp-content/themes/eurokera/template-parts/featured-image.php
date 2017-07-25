<!-- This outputs the featured image. This also works for the blog page.
Uses Aqua Resize and Picturefill to dynamically size and load the featured image for multiple devices.
library/drum-functions.php
-->
<?php
/** If this is the blog page then get the featured image for it **/
if (is_home() && get_option('page_for_posts') ) {
	$image_id = get_post_thumbnail_id(get_option('page_for_posts'));
} else {
	$image_id = get_post_thumbnail_id();
}
?>
<?php if ($image_id != null) : ?>
	<div class="featured-image">
		<?php
		$small = array("width" => 640,"height" => 175);
		$medium = array("width" => 1025,"height" => 280);
		$large = array("width" => 1100,"height" => 300);
		echo drum_image($image_id,$small,$medium,$large,false);
		?>
	</div>
<?php endif; ?>