<?php
/*
Template Name: Versâtis™
*/
get_header(); ?>

<?php do_action( 'foundationpress_before_content' ); ?>
	
	<?php
	global $row_counter;
	$row_counter = 1;	
	?>
	
	<?php get_template_part('template-parts/page', 'slider'); ?>
	
	<section class="versatis-video text-center">
		<?php $video_poster = get_field('video_poster'); ?>
<?php if (ICL_LANGUAGE_CODE == 'zh-hans') : ?>	
	<?php
	$video_markup = '<a class="versatis-video vp-a vp-mp4-type" href="' . get_field('video_url') . '" data-autoplay="1" data-dwrap="1">' .  wp_get_attachment_image($video_poster, 'full') . '</a>';
	echo apply_filters('the_content', $video_markup);
	$video_inner = '<div class="video-overlay">';
	ob_start();
	get_template_part('assets/images/play', 'button.svg');
	$play_button = ob_get_contents();
	ob_end_clean();
	$video_inner .= $play_button;
	$video_inner .= '<br /><p>' . get_field('video_title') . '</p></div>';
	?>
	<script>
		jQuery('a.home-video').html('<?php echo $video_inner; ?>');
	</script>
<?php else: ?>
	<a class="versatis-video" href="<?php echo get_field('video_url'); ?>?autoplay=1&modestbranding=1&showinfo=0&rel=0" data-featherlight="iframe" data-featherlight-iframe-width="960" data-featherlight-iframe-height="540">
		<?php echo wp_get_attachment_image($video_poster, 'full'); ?>
		<div class="video-overlay">
			<div class="video-button-title">
				<?php get_template_part('assets/images/play', 'button-simple.svg'); ?><br />
				<p><?php echo get_field('video_title'); ?></p>
			</div>
		</div>
	</a>
<?php endif; ?>
	</section>
	
	<section class="versatis-intro">
		<div class="row">
			<div class="large-12 columns">
				<?php echo get_field('intro'); ?>
			</div>		
		</div>
	</section> <!-- intro -->
	
	<section class="photos-two-up">
		<div class="large-6 medium-6 columns no-padding">
			<?php echo wp_get_attachment_image( get_field('photos_twoup_left_photo'), 'width=960&height=460&crop=1' ); ?>
		</div>
		<div class="large-6 medium-6 columns no-padding">
			<?php echo wp_get_attachment_image( get_field('photos_twoup_right_photo'), 'width=960&height=460&crop=1' ); ?>
		</div>		
	</section> <!-- photos-two-up -->
		
	<section class="versatis-animation">
		<div class="row">
			<div class="large-12 columns">
				<h2><?php echo get_field('animation_title'); ?></h2>
				<?php echo get_field('animation_intro'); ?>
				<div id="versatis-animation" class="animation-container" data-time="7am">
					<div class="main-animation-container">
						<?php get_template_part('assets/images/drag', 'line.svg'); ?>
						<?php get_template_part('assets/images/dotted', 'line.svg'); ?>
						<div class="versatis-text-container">
							<div class="time-text time7am">
								<?php echo get_field('animation_content700am'); ?>
							</div>
							<div class="time-text time10am">
								<?php echo get_field('animation_content1000am'); ?>
							</div>
							<div class="time-text time12pm">
								<?php echo get_field('animation_content1200pm'); ?>
							</div>
							<div class="time-text time3pm">
								<?php echo get_field('animation_content300pm'); ?>
							</div>
							<div class="time-text time7pm">
								<?php echo get_field('animation_content700pm'); ?>
							</div>
							<div class="time-text time830pm">
								<?php echo get_field('animation_content830pm'); ?>
							</div>																		
						</div> <!-- versatis-text-container -->
					</div> <!-- main-animation-container -->
					<div class="versatis-tops">
						<div class="text-right">
							<p>Versâtis™</p>
						</div>
						<div class="versatis-top time7am">
							<?php get_template_part('assets/images/7am.svg'); ?>
						</div>
						<div class="versatis-top time10am">
							<?php get_template_part('assets/images/10am.svg'); ?>
						</div>
						<div class="versatis-top time12pm">
							<?php get_template_part('assets/images/12pm.svg'); ?>
						</div>
						<div class="versatis-top time3pm">
							<?php get_template_part('assets/images/3pm.svg'); ?>
						</div>
						<div class="versatis-top time7pm">
							<?php get_template_part('assets/images/7pm.svg'); ?>
						</div>
						<div class="versatis-top time830pm">
							<?php get_template_part('assets/images/830pm.svg'); ?>
						</div>																		
					</div> <!-- versatis-tops -->					
				</div>
				<script>
// Closest Point on Path
// https://bl.ocks.org/mbostock/8027637

jQuery( document ).ready(function() {
	
var DEG = 180 / Math.PI;

var drag = document.querySelector("#drag");
var path = document.querySelector("#path");

var pathLength = path.getTotalLength() || 0;
var startPoint = path.getPointAtLength(0);
var startAngle = getRotation(startPoint, path.getPointAtLength(0.1));

TweenLite.set(drag, {
  transformOrigin: "center",
  rotation: startAngle + "_rad",
  xPercent: -50,
  yPercent: -50,
  x: startPoint.x,
  y: startPoint.y
});

var draggable = new Draggable(drag, {  
  liveSnap: {
    points: pointModifier
  }
});

TweenLite.set(".animation-container", {
  autoAlpha: 1
});

function pointModifier(point) {
  
  var p = closestPoint(path, pathLength, point);
  
  
  
  // Set time
  if (point.x <= 150) {
	  jQuery("#svg-time").text('7:00am');
	  jQuery('#versatis-animation').attr('data-time', '7am');
  } else if (point.x > 150 && point.x < 351) {
	  jQuery("#svg-time").text('10:00am');
	  jQuery('#versatis-animation').attr('data-time', "10am" ); 
  } else if (point.x > 350 && point.x < 751) {
	  jQuery("#svg-time").text('12:00pm');
	  jQuery('#versatis-animation').attr('data-time', "12pm" );	  
  } else if (point.x > 750 && point.x < 1101) {
	  jQuery("#svg-time").text('3:00pm');
	  jQuery('#versatis-animation').attr('data-time', "3pm" );  
  } else if (point.x > 1100 && point.x < 1301) {
	  jQuery("#svg-time").text('7:00pm');
	  jQuery('#versatis-animation').attr('data-time', "7pm" );  
  } else {
	  jQuery("#svg-time").text('8:30pm');
	  jQuery('#versatis-animation').attr('data-time', "830pm" );  
  } 
   // jQuery("#svg-time").text(point.x);
   
   
    
  TweenLite.set(drag, {
    rotation: p.rotation
  });
  
  return p.point;
}

function closestPoint(pathNode, pathLength, point) {
  
  var precision = 8,
      best,
      bestLength,
      bestDistance = Infinity;

  // linear scan for coarse approximation
  for (var scan, scanLength = 0, scanDistance; scanLength <= pathLength; scanLength += precision) {
    if ((scanDistance = distance2(scan = pathNode.getPointAtLength(scanLength))) < bestDistance) {
      best = scan, bestLength = scanLength, bestDistance = scanDistance;
    }
  }  
  
  // binary search for precise estimate
  precision /= 2;
  while (precision > 0.5) {
    var before,
        after,
        beforeLength,
        afterLength,
        beforeDistance,
        afterDistance;
    if ((beforeLength = bestLength - precision) >= 0 && (beforeDistance = distance2(before = pathNode.getPointAtLength(beforeLength))) < bestDistance) {
    	best = before, bestLength = beforeLength, bestDistance = beforeDistance;
    } else if ((afterLength = bestLength + precision) <= pathLength && (afterDistance = distance2(after = pathNode.getPointAtLength(afterLength))) < bestDistance) {
    	best = after, bestLength = afterLength, bestDistance = afterDistance;
    } else {
    	precision /= 2;
    }
  }

  var len2 = bestLength + (bestLength === pathLength ? -0.1 : 0.1);
  var rotation = getRotation(best, pathNode.getPointAtLength(len2));
    
  return {
    point: best,
    rotation: rotation * DEG,
    // distance: Math.sqrt(bestDistance),
  };

  function distance2(p) {
    var dx = p.x - point.x,
        dy = p.y - point.y;
    return dx * dx + dy * dy;
  }
}

function getRotation(p1, p2) {
  var dx = p2.x - p1.x;
  var dy = p2.y - p1.y;
  return Math.atan2(dy, dx);
}

});
				</script>
			</div>
		</div>
	</section> <!-- versatis-animation -->
	
	<section class="full-width-photo">
		<?php echo wp_get_attachment_image( get_field('fullwidth_photo'), 'width=1910&height=510&crop=1' ); ?>
	</section> <!-- full-width-photo -->


	<section class="icon-blocks key-features">
		<div class="row">
			<div class="large-12 columns">
				<h2><?php echo get_field('key_features_title'); ?></h2>
			</div>
		</div>
		<div class="row">
			<?php if(get_field('blocks')): ?>
				<?php while(has_sub_field('blocks')): ?>
					<div class="large-4 medium-4 small-6 columns text-center icon-block">
						<div class="icon-container">
							<?php echo file_get_contents(get_sub_field('icon')); ?>
						</div>
						<h3><?php echo get_sub_field('title'); ?></h3>
						<p><?php echo get_sub_field('paragraph'); ?></p>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</section> <!-- key-features -->

			
	<section class="dedicated-team">
		<div class="large-8 medium-8 columns dedicated-team-content">
			<?php echo get_field('dedicated_team_content'); ?>
		</div>
		<?php $team_photo = wp_get_attachment_image_src( get_field('dedicated_team_photo'), 'full'); ?>
		<div class="large-4 medium-4 columns dedicated-team-photo" style="background-image: url(<?php echo $team_photo[0]; ?>);">
			
		</div>
	</section> <!-- dedicated-team -->
	
	<section class="page-gallery versatis-gallery">
		<div class="row">
			<div class="large-12 columns">
				<h2><?php echo get_field('gallery_title'); ?></h2>
			</div>
		</div>
		<div class="row">
			<?php 
			$images = get_field('images');								
			if( $images ): ?>
				<div class=" slider-container slider-container-<?php echo $row_counter; ?>">
				<ul class="bxslider gallery-<?php echo $row_counter; ?>">
			    		<?php foreach( $images as $image ): ?>
			        		<li>
			            		<?php echo wp_get_attachment_image( $image['ID'], 'width=1080&height=640&crop=1' ); ?>
			            		<p class="gallery-slide-caption"><?php echo wp_get_attachment_caption($image['ID']); ?></p>
			            </li>
			        <?php endforeach; ?>
			    </ul>
			    <p class="gallery-caption"></p>
				</div>
				<script>
					jQuery(window).load(function(){
						function loadCaption(currentSlide) {
							var caption = currentSlide.find('p.gallery-slide-caption').html();
							jQuery('.slider-container-<?php echo $row_counter; ?> p.gallery-caption').html(caption);
						}										
						var slider = jQuery('.gallery-<?php echo $row_counter; ?>').bxSlider({
						    auto: false,
						    pager: (jQuery(".bxslider > li").length > 1) ? true: false,
						    controls: true,
						    mode: 'fade',
						    speed: 1000,
						    onSliderLoad: function(currentIndex) {     
								var currentSlide = jQuery('.slider-container-<?php echo $row_counter; ?>').find('.bx-viewport').find('ul').children().eq(currentIndex);
								loadCaption(currentSlide);
    							},
						    onSlideBefore: function($slideElement) {
								loadCaption($slideElement);
    							},
						});
					});

				</script>								    
			<?php endif; ?>
		</div> <!-- row -->
	</section> <!-- versatis-gallerypage-gallery -->
	
	<section class="luxury">
		<div class="large-8 medium-8 columns luxury-content">
			<?php echo get_field('luxury_content'); ?>
		</div>
		<?php $luxury_photo = wp_get_attachment_image_src( get_field('luxury_photo'), 'full'); ?>
		<div class="large-4 medium-4 columns luxury-photo" style="background-image: url(<?php echo $luxury_photo[0]; ?>);">
			
		</div>		
	</section> <!-- luxury -->
	
	<?php get_template_part('template-parts/latest', 'blogs'); ?>
	
	<?php echo get_template_part('template-parts/content','ready'); ?>
	

<?php do_action( 'foundationpress_after_content' ); ?>

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