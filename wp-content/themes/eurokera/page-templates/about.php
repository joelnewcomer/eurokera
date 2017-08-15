<?php
/*
Template Name: About
*/
get_header(); ?>

<?php do_action( 'foundationpress_before_content' ); ?>

<?php get_template_part( 'template-parts/featured-image-parallax' ); ?>

<section class="timeline">
	<div class="row">
		<div class="large-12 columns text-center about-logos">
			<div class="saint-gobain history-logo">
				<?php get_template_part('assets/images/saint-gobain', 'logo.svg'); ?>
			</div>
			<div class="plus">+</div>
			<div class="corning history-logo">
				<?php get_template_part('assets/images/corning', 'logo.svg'); ?><br />
			</div>
			<div class="equals hide-for-small">=</div>
			<div class="num-one history-logo">
				<?php get_template_part('assets/images/eurokera', 'logo.svg'); ?><br />
			</div>
		</div>
		
		<div class="large-12 columns text-center timeline-columns">
			<?php if(get_field('timeline')): ?>
				<?php while(has_sub_field('timeline')): ?>
				<article class="flip-container">
					<div class="card">
					    <figure class="front">
					    	<div style="display:table;width:100%;height:100%;">
					    		<div style="display:table-cell;vertical-align:middle;">
					    	    	<div style="text-align:center;"><?php the_sub_field('year'); ?></div>
					    		</div>
					    	</div>
					    </figure>
					    <figure class="back">
					    	<div style="display:table;width:100%;height:100%;">
					    		<div style="display:table-cell;vertical-align:middle;">
					    	    	<div class="back-inner" style="text-align:center;"><?php the_sub_field('blurb'); ?></div>
					    		</div>
					    	</div>
					    </figure>
					</div>
				</article>
				<?php endwhile; ?>
			<?php endif; ?>

			<script>
				jQuery(document).ready(function() {
				    jQuery('.flip-container').on('mouseenter', function(){
					    // Flip others back over
					    jQuery('.flip-container.flipped').find('.back').css('transform','rotateY(180deg)');
						jQuery('.flip-container.flipped').find('.front').css('transform','rotateY(0deg)');
						jQuery('.flip-container.flipped').removeClass('flipped');
							
						// Flip this one
						jQuery(this).find('.back').css('transform','rotateY(0deg)');
						jQuery(this).find('.front').css('transform','rotateY(180deg)');
						jQuery(this).addClass('flipped');
					});
					jQuery('.flip-container').on('mouseleave', function(){
				        	jQuery(this).find('.back').css('transform','rotateY(180deg)');
							jQuery(this).find('.front').css('transform','rotateY(0deg)');
							jQuery(this).removeClass('flipped');
				    });

					// When timeline is in viewport then flip first year
					var ranOnce = false;
					jQuery('.timeline-columns').bind('inview', function (event, visible) {
						if (visible == true && !ranOnce) {
							setTimeout(function(){  
								jQuery('.flip-container:first-child').find('.back').css('transform','rotateY(0deg)');
								jQuery('.flip-container:first-child').find('.front').css('transform','rotateY(180deg)');
								jQuery('.flip-container:first-child').addClass('flipped');
								ranOnce = true;
							}, 1000);
					  	}
					});	

				});
				
			
			</script>

		</div> <!-- columns -->

	</div> <!-- row -->
</section> <!-- timeline -->

<section class="about-intro">
	<div class="about-photo match-intro" style="background-image: url(<?php echo get_field('intro_photo'); ?>);"></div>
	<div class="about-content match-intro">
		<?php echo get_field('intro'); ?>
	</div>
</section>

<section class="facts">
	<div class="row">
		<div class="large-6 medium-6 columns cooktop">
			<div class="facts-box">
				<?php get_template_part('assets/images/cooktop.svg'); ?>
				<h3 class="green">More than <br />100 <span class="caps">million</span></h3>
				<p>panels produced since 1990</p>
			</div>
		</div>
		<div class="large-6 medium-6 columns stopwatch">
			<div class="facts-box border">
				<?php get_template_part('assets/images/stopwatch.svg'); ?>
				<h3>Every <span class="caps green">5 seconds</span></h3>
				<p>a glass-ceramic cooking surface is manufactured by Eurokera</p>
			</div>		
		</div>
	</div>
</section>

<section class="reach text-center">
	<h2>Global Reach</h2>
	<div class="global-locations show-for-small text-center">
		<p>
			Fountain Inn, SC, USA<br />
			Bagneaux-sur-Loing, France<br />
			Château-Thierry, France<br />
			Guangzhou, China<br />
			Rayong, Thailand
		</p>
	</div>
	<div class="button gray"><a href="<?php echo get_field('wm_page'); ?>">Worldwide Manufacturing</a></div>
</section>

<section id="environment" class="enviro text-center">
	<div class="row enviro-intro">
		<div class="large-8 medium-10 columns large-offset-2 medium-offset-1">
			<?php echo get_field('enviro_content'); ?>
		</div>
	</div>
	<div class="row enviro-facts">
		<div class="recycled fact">
			<h2 id="recycled-glass"></h2>
			<p>Tons of Glass Recycled</p>
			<script>
				jQuery(document).ready(function(){
					var easingFn = function (t, b, c, d) {
					  var ts = (t /= d) * t;
					  var tc = ts * t;
					  return b + c * (tc + -3 * ts + 3 * t);
					}
					var glass = {
					  useEasing : true,
					  easingFn: easingFn,
					  useGrouping : true,
					  separator : ',',
					  decimal : '.',
					  prefix : '',
					  suffix : ''
					};
					var tonsofglass = new CountUp("recycled-glass", 0, 600, 0, 6, glass);
					// tonsofgalass.start();
					function startTonsAnim() {
						tonsofglass.start();
					}
					inView('#environment').on('enter', startTonsAnim);
				});
			</script>
		</div>
		<div class="substrates fact large">
			<?php get_template_part('assets/images/eurokera-enviro', 'logo.svg'); ?><br />
			<p><strong><span class="caps">All</span> of EuroKera’s black substrates</strong> are arsenic- and antimony-free. All of our glass-ceramic is fully recyclable.</p>
		</div>		
		<div class="landfill fact">
			<h2 id="landfills"></h2>
			<p>Reduction in Landfill Waste Since 2010</p>

				<script>


						jQuery(document).ready(function(){
							var easingFn = function (t, b, c, d) {
							  var ts = (t /= d) * t;
							  var tc = ts * t;
							  return b + c * (tc + -3 * ts + 3 * t);
							}
							var options = {
							  useEasing : true,
							  easingFn: easingFn,
							  useGrouping : true,
							  separator : ',',
							  decimal : '.',
							  prefix : '',
							  suffix : '%'
							};
							var landfills = new CountUp("landfills", 0, 80, 0, 6, options);
							//landfills.start();

							function startLandfillsAnim() {
								landfills.start();
							}
							inView('#environment').on('enter', startLandfillsAnim);
						});
				</script>
			
		</div>		
	</div>
</section>

<section class="site-links">
	<div class="row">
		<div class="large-12 columns text-center">
			<?php get_template_part('template-parts/content','site-links'); ?>
		</div>
	</div>
</section>

<?php do_action( 'foundationpress_after_content' ); ?>

<?php get_footer(); ?>

<script>
	jQuery( window ).load(function() {
		jQuery('.match-intro').matchHeight();
	});
</script>

<script>
// When page loads, scroll to hash
jQuery(window).load(function() {
    if (window.location.hash != '') {
        jQuery('html, body').animate({ scrollTop: jQuery(window.location.hash).offset().top - 70}, 500); 
    }
});
</script>