<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
	<?php
	$logo = str_replace( site_url() . '/', '', get_theme_mod( 'drum_logo' ));
	echo file_get_contents(ABSPATH . $logo);
	?>    
</a>