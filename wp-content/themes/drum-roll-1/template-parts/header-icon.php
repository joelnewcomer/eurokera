<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
	<?php if ( get_theme_mod( 'drum_logo' ) ) : ?>
	    <img src="<?php echo get_theme_mod( 'drum_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> Logo">
	<?php else : ?>
	   	<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo@2x.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> Logo"/>
	<?php endif; ?>
</a>