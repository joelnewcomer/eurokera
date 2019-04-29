<!-- Parallax Featured Image -->
<?php
/** If this is the blog page then get the featured image for it **/
if ((is_home() || is_archive()) && get_option('page_for_posts') ) {
	$image_url = get_the_post_thumbnail_url(get_option('page_for_posts'));
	$title = get_the_title(get_option('page_for_posts'));
} else {
	$image_url = get_the_post_thumbnail_url();
	$title = get_the_title();
}
if (is_archive()) {
	$title = single_cat_title('',false);
}
// Default featured image
if ($image_url == null) {
	$image_url = get_template_directory_uri() . '/assets/images/default-featured.jpg';
}
$subtitle = get_field('subtitle');
$video_url = get_field('featured_video_url');
$display_title = get_field('display_title');
if ($display_title != null) {
	$title = $display_title;
}
$no_featured = get_field('remove_header_image');
?>
<?php if (!$no_featured) : ?>
<div class="featured-image" data-paroller-factor="0.3" style="background: url(<?php echo $image_url; ?>) center center no-repeat;">
			<div class="text-center" style="display:table;width:100%;height:100%;">
			  <div style="display:table-cell;vertical-align:middle;">
			    <div style="text-align:center;"><h1 class="entry-title"><?php echo $title; ?></h1></div>
			    <?php if ($subtitle != '') : ?>
			    	<h2 class="subtitle"><?php echo $subtitle; ?></h2>
				<?php endif; ?>
				<?php if ($video_url != '') : ?>
					<a class="product-video" href="<?php echo $video_url; ?>?autoplay=1&modestbranding=1&showinfo=0&rel=0" data-featherlight="iframe" data-featherlight-iframe-width="960" data-featherlight-iframe-height="540">
						<?php _e('Play Video'); ?><br />
						<?php get_template_part('assets/images/play', 'button.svg'); ?><br />
					</a>
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

<?php else: ?>
<header class="no-image">
	<div class="row">
		<div class="large-12 columns">
			<div style="text-align:center;"><h1 class="entry-title"><?php echo $title; ?></h1></div>
		</div>
	</div>
</header>
<?php endif; ?>