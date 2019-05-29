<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
?>
		</section>
				
		<div id="footer-container">
			<footer id="footer">
				<div class="row">
					<div class="large-12 columns text-center">
						<?php get_template_part('assets/images/eurokera', 'logo.svg'); ?>
						<?php get_template_part('template-parts/social'); ?>
					</div>
					<!-- <div class="large-2 medium-2 columns small-text-center">
						<?php get_template_part('assets/images/eurokera', 'logo.svg'); ?>
					</div>
					<div class="large-8 medium-8 columns">
						<div class="text-center">
							<h2>Innovation & News</h2>
						</div>
						<?php
						$query = new WP_Query(
						    array( 'orderby' => 'date', 'posts_per_page' => '1')
						);
						while($query->have_posts()) : $query->the_post(); ?>
						    <a class="home-blog-link" href="<?php echo get_permalink(); ?>">
						        <span class="title"><?php the_title(); ?></span> <span class="show-for-small"><br /></span><span><?php echo get_the_excerpt(); ?></span>
						    </a>
						<?php endwhile; ?>
						<div class="text-center">
							<div class="button outline white"><a href="<?php echo get_permalink( get_option('page_for_posts' ) ); ?>">Blog</a></div>
						</div>
					</div> -->
				</div> <!-- row -->
				
				<div class="row">
					<div class="large-12 medium-12 columns copyright text-center">
						<?php 
						$terms_page = get_page_by_path('terms-of-use');
						$icl_term_page_id = icl_object_id($terms_page->ID, 'page', true);
						$privacy_page = get_page_by_path('privacy-policy');
						$icl_privacy_page_id = icl_object_id($privacy_page->ID, 'page', true);
						$sitemap_page = get_page_by_path('sitemap');
						$icl_sitemap_page_id = icl_object_id($sitemap_page->ID, 'page', true);
						$cookie_page = get_page_by_path('cookie-policy');
						$icl_cookie_page_id = icl_object_id($cookie_page->ID, 'page', true);
						?>
						<p><?php _e( 'Copyright ', 'textdomain' ); ?> &copy;<?php echo date('Y'); ?> <?php bloginfo('name'); ?>.  <span class="no-break"><?php _e( 'All rights reserved.', 'textdomain' ); ?></span> <span class="show-for-small"><br /></span><a href="<?php echo get_permalink($icl_term_page_id); ?>"><?php _e('Terms of Use'); ?></a>. <a href="<?php echo get_permalink($icl_privacy_page_id); ?>"><?php _e('Privacy Policy'); ?></a>. <a href="<?php echo get_permalink($icl_cookie_page_id); ?>"><?php _e('Cookie Policy'); ?></a>.</p>
					</div>
					<!-- <div class="large-6 medium-6 columns drum hide-on-print text-right small-text-center">
						<a href="http://www.drumcreative.com" target="_blank"><?php _e( 'Web Design by: Drum Creative', 'textdomain' ); ?></a>
					</div> -->
				</div>
			</footer>
		</div> <!-- footer-container -->
		
<div class="cookie-policy transition">
	<div class="row">
		<div class="large-8 medium-8 columns small-text-center">
			<p><?php _e('We use cookies to offer you a better browsing experience, analyze site traffic, and improve our customer service. Read about how we use cookies by clicking on "Cookie Policy". If you continue to use this site, you consent to our use of cookies.'); ?></p>
		</div>
		<div class="large-2 medium-2 columns text-center">

			<a class="cookie-policy-link" href="<?php echo get_permalink($icl_cookie_page_id); ?>"><strong><?php _e('Cookie Policy'); ?></strong></a>
		</div>
		<div class="large-2 medium-2 columns small-text-center">
			<div class="button small reverse"><a id="accept-cookies" href="#"><?php _e('Accept Cookies'); ?></a></div>
		</div>
	</div>
</div> <!-- cookie-policy -->

<script>
	jQuery(window).load(function() {
		var acceptCookies = basil.get('accept-cookies');
		if (acceptCookies != 'yes') {
			jQuery('.cookie-policy').addClass('active');
		}
	});
	
	jQuery( "#accept-cookies" ).on( "click", function(e) {
		e.preventDefault();
		basil.set('accept-cookies', 'yes');
		jQuery('.cookie-policy').removeClass('active');
	});
</script>

	<?php if(!preg_match('/(?i)msie [5-9]/',$_SERVER['HTTP_USER_AGENT'])) : ?>
		</div> <!-- animsition -->
	<?php endif; ?>	

		<?php get_template_part( 'template-parts/search-modal' ); ?>

		<a class="cd-top"><?php _e( 'Top', 'textdomain' ); ?></a>

		<?php do_action( 'foundationpress_layout_end' ); ?>

<script>
// Function to automatically update all links to a particular language code
function updateWPMLLinks(langCode) {
	jQuery('section#content a, .epop-content a').each(function() {
		var thisHREF = jQuery(this).attr('href');
		if (typeof(thisHREF) !== 'undefined' && thisHREF.indexOf('.jpg') < 0 && thisHREF.indexOf('.jpeg') < 0 ) {
			if (thisHREF.indexOf("<?php echo site_url(); ?>/" + langCode) < 0) {
				thisHREF = thisHREF.replace("<?php echo site_url(); ?>", "<?php echo site_url(); ?>/" + langCode);
		   	}
		   	if (thisHREF.startsWith('/')) {
			   	thisHREF = '/' + langCode + thisHREF;
		   	}
		    jQuery(this).attr('href', thisHREF);
		}
	});
}
</script>	


<!-- Automatically update links for languages -->
<?php
$langCodes = array('ko','zh-hans','fr','es','th','vi');
foreach ($langCodes as $langCode) {
	if (ICL_LANGUAGE_CODE == $langCode) : ?> 
		<script>
		jQuery(function(){
			updateWPMLLinks('<?php echo $langCode; ?>');
		});		
		</script>
	<?php endif;
} ?>

<?php wp_footer(); ?>

<?php do_action( 'foundationpress_before_closing_body' ); ?>

<script>
// If Contact section exists on page, hijack Contact link and make it scroll
if(jQuery('#contact').length) {
	jQuery(document).on( "click", 'a[href="<?php echo get_site_url(); ?>/contact/"]', function(e) {
		e.preventDefault();
        var target = jQuery('#contact');
        jQuery('html, body').animate({ scrollTop: target.offset().top - 70}, 500);
		if(jQuery(window).width()<641) {
			jQuery('ul.slimmenu').fadeOut();
		}
        return false;		
	});	
}
</script>

<script type="text/javascript">
_linkedin_partner_id = "576260";
window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
window._linkedin_data_partner_ids.push(_linkedin_partner_id);
</script><script type="text/javascript">
(function(){var s = document.getElementsByTagName("script")[0];
var b = document.createElement("script");
b.type = "text/javascript";b.async = true;
b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
s.parentNode.insertBefore(b, s);})();
</script>
<noscript>
<img height="1" width="1" style="display:none;" alt="" src="https://dc.ads.linkedin.com/collect/?pid=576260&fmt=gif" />
</noscript>

<?php if (ICL_LANGUAGE_CODE != 'zh-hans') : ?>
<!-- Project Huddle http://brands.drumcreative.com/ -->
<!-- <script>
	(function (d, t, g) {
		var ph    = d.createElement(t), s = d.getElementsByTagName(t)[0];
		ph.type   = 'text/javascript';
		ph.async   = true;
		ph.charset = 'UTF-8';
		ph.src     = g + '&v=' + (new Date()).getTime();
		s.parentNode.insertBefore(ph, s);
	})(document, 'script', '//brands.drumcreative.com/?p=116688&ph_apikey=1533515fcd54ac9e44f77fcb4de2fcf6');
</script> -->
<?php endif; ?>
</body>
</html>