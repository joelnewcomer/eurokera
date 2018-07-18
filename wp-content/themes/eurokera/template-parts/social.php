<div class="social text-center">
	<?php if(get_field('social_networks', 'option')): ?>
		<?php while(has_sub_field('social_networks', 'option')): ?>
			<?php
			$social_url = get_sub_field('url');
			$social = get_sub_field('social_network');
			?>
			<a href="<?php echo $social_url; ?>" class="<?php echo $social; ?>" target="_blank" onclick="ga('send', 'event', 'Social', 'Click', 'Social Media – <?php echo $social; ?>');">
			<?php
			get_template_part('assets/images/social/' . $social , 'official.svg');
			if ($social == 'wechat') {
				echo wp_get_attachment_image(get_sub_field('wechat_qr_code'), full, false, array( 'class' => "wechat-hover" ));
			}
			echo '</a>';
			?>
		<?php endwhile; ?>
	<?php endif; ?>
</div> <!-- social -->