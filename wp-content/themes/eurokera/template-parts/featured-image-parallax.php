<!-- Parallax Featured Image -->
<?php
/** If this is the blog page then get the featured image for it **/
if (is_home() && get_option('page_for_posts') ) {
	$image_url = get_the_post_thumbnail_url(get_option('page_for_posts'));
	$title = get_the_title(get_option('page_for_posts'));
} else {
	$image_url = get_the_post_thumbnail_url();
	$title = get_the_title();
}
// Default featured image
if ($image_url == null) {
	$image_url = get_template_directory_uri() . '/assets/images/default-featured.jpg';
}
$subtitle = get_field('subtitle');
?>
<div class="featured-image" data-paroller-factor="0.3" style="background: url(<?php echo $image_url; ?>) center center no-repeat;">
			<div class="text-center" style="display:table;width:100%;height:100%;">
			  <div style="display:table-cell;vertical-align:middle;">
			    <div style="text-align:center;"><h1 class="entry-title"><?php echo $title; ?></h1></div>
			    <?php if ($subtitle != '') : ?>
			    	<h2 class="subtitle"><?php echo $subtitle; ?></h2>
				<?php endif; ?>
			  </div>
			</div>
	<div class="down-arrow bounce animated"><?php get_template_part('assets/images/acc', 'arrow.svg'); ?></div>
</div>

<script>
jQuery('.down-arrow').click(function() {
	jQuery('html, body').animate({ scrollTop: jQuery('#page').offset().top}, 1000);
});
</script>