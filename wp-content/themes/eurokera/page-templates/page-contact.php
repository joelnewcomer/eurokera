<?php
/*
Template Name: Contact
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image-parallax' ); ?>

<div id="page" role="main">
	<?php do_action( 'foundationpress_before_content' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class(array('main-content')) ?> id="post-<?php the_ID(); ?>">
			<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
			<div class="entry-content">
				<?php if ( post_password_required() ) : ?>
					<div class="row password-protected-row">
						<div class="large-12 columns">
							<?php echo get_the_password_form(); ?>
						</div>
					</div>
				<?php else : ?>
	        		<?php get_template_part('template-parts/content', 'columns'); ?>
				<?php endif; ?>
			</div> <!-- entry-content -->
		</article>
	<?php endwhile;?>
	<?php do_action( 'foundationpress_after_content' ); ?>

<section class="contact-locations">
	<div class="row">
		<div class="large-12 columns text-center">
			<h2><?php _e('Our Locations'); ?></h2>
			
			<div class="location">
				<div class="icon-container">
					<div style="display:table;width:100%;height:100%;">
						<div style="display:table-cell;vertical-align:middle;">
							<div style="text-align:center;">
								<?php get_template_part('assets/images/france.svg'); ?>
							</div>
						</div>
					</div>
				</div>
				<h3><?php _e('EuroKera S.N.C.'); ?></h3>
				<p><?php _e('1 Avenue du Général de Gaulle,'); ?><br />
				<?php _e('02400 Chierry, France'); ?></p>
				<div class="button small"><a href="https://www.google.com/maps/place/EuroKera/@49.0404694,3.4142716,17z/data=!4m8!1m2!2m1!1s1+Avenue+du+G%C3%A9n%C3%A9ral+de+Gaulle,%091+Avenue+du+G%C3%A9n%C3%A9ral+de+Gaulle,+02400+Chierry,+France!3m4!1s0x47e8e648f63a46bd:0x995490721e9c1e88!8m2!3d49.0409721!4d3.418197" target="_blank">Map</a></div>
			</div>
		
			<div class="location">
				<div class="icon-container">
					<div style="display:table;width:100%;height:100%;">
						<div style="display:table-cell;vertical-align:middle;">
							<div style="text-align:center;">
								<?php get_template_part('assets/images/keraglass.svg'); ?>
							</div>
						</div>
					</div>								
				</div>
				<h3><?php _e('KeraGlass'); ?></h3>
				<p><?php _e('KeraGlass Rue Saint-Laurent, 77167'); ?><br />
				<?php _e('Bagneaux-sur-Loing, France'); ?></p>
				<div class="button small"><a href="https://www.google.com/maps/place/Keraglass/@48.229388,2.7031996,17z/data=!3m1!4b1!4m5!3m4!1s0x47e588f317c5ffad:0x18733bcfa0e80251!8m2!3d48.2293844!4d2.7053936" target="_blank">Map</a></div>
			</div>
			
			<div class="location">
				<div class="icon-container">
					<div style="display:table;width:100%;height:100%;">
						<div style="display:table-cell;vertical-align:middle;">
							<div style="text-align:center;">
								<?php get_template_part('assets/images/usa.svg'); ?>
							</div>
						</div>
					</div>								
				</div>
				<h3><?php _e('EuroKera North America Inc.'); ?></h3>
				<p><?php _e('140 Southchase Boulevard,'); ?><br />
				<?php _e('Fountain Inn, SC 29644-8082'); ?></p>
				<div class="button small"><a href="https://www.google.com/maps/place/140+Southchase+Blvd,+Fountain+Inn,+SC+29644/@34.6928534,-82.241657,17z/data=!3m1!4b1!4m5!3m4!1s0x885820c880d3f8d1:0x7fcc3c63e7e8ee80!8m2!3d34.692849!4d-82.239463" target="_blank">Map</a></div>
			</div>
			
			<div class="location">
				<div class="icon-container">
					<div style="display:table;width:100%;height:100%;">
						<div style="display:table-cell;vertical-align:middle;">
							<div style="text-align:center;">
								<?php get_template_part('assets/images/china.svg'); ?>
							</div>
						</div>
					</div>								
				</div>
				<h3><?php _e('EuroKera China'); ?></h3>
				<p><?php _e('Building 11, American Industrial Park,'); ?><br />
				<?php _e('48 Hongmian Road, Xinhua Town Huadu District, Guangzhou 510800'); ?></p>
				<div class="button small"><a href="https://www.google.com/maps/place/48+Hong+Mian+Da+Dao+Bei,+Huadu+Qu,+Guangzhou+Shi,+Guangdong+Sheng,+China/@23.408007,113.1686408,17z/data=!4m5!3m4!1s0x3402e8950732003d:0x9e7bcf4a5c37924f!8m2!3d23.408006!4d113.170818" target="_blank">Map</a></div>
			</div>
			
			<div class="location">
				<div class="icon-container">
					<div style="display:table;width:100%;height:100%;">
						<div style="display:table-cell;vertical-align:middle;">
							<div style="text-align:center;">
								<?php get_template_part('assets/images/thailand.svg'); ?>
							</div>
						</div>
					</div>								
				</div>
				<h3><?php _e('EuroKera Thailand'); ?></h3>
				<p><?php _e('Hemaraj Eastern Seaboard No.500/61'); ?><br />
				<?php _e('Moo3, Tambol Tasit, Amphur P, Luakdaeng Rayong 21140'); ?></p>
				<div class="button small"><a href="https://www.google.com/maps/search/Hemaraj+Eastern+Seaboard+No.500%2F61+Moo+3,+Tambol+Tasit,+Amphur+PLuakdaeng+Rayong+21140/@12.9587766,101.1035924,11z/data=!3m1!4b1" target="_blank">Map</a></div>
			</div>
		</div>
	</div>	
</section>	<!-- locations -->
	
</div> <!-- #page -->

			        		<script>
				    	    	jQuery( document ).ready(function() {
				    	    		jQuery('#user-faq').easyResponsiveTabs({
					    	    		type: 'accordion',
										tabidentify: 'user-faq', // The tab groups identifier
            						});
				    	    	});
				    	    </script>

<?php get_footer(); ?>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.entry-content section a[href^="#"]').click(function() {
            var target = jQuery(this.hash);
            if (target.length == 0) target = jQuery('a[name="' + this.hash.substr(1) + '"]');
            if (target.length == 0) target = jQuery('html');
            jQuery('html, body').animate({ scrollTop: target.offset().top - 70}, 500);
            return false;
        });
    });
</script>