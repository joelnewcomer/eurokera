	<section id="concept" class="versatis-animation">
		<div class="row">
			<div class="large-12 columns">
				<h2><?php echo get_field('animation_title'); ?></h2>
				<div class="hide-for-small">
					<?php echo get_field('animation_intro'); ?>
				</div>
				<div class="show-for-small">
					<?php echo get_field('animation_intro_mobile'); ?>
				</div>
				<div id="versatis-animation" class="animation-container" data-time="7am">
					<div class="main-animation-container">
						<div class="hide-for-small">
							<?php get_template_part('assets/images/drag', 'line.svg'); ?>
							<?php get_template_part('assets/images/dotted', 'line.svg'); ?>
						</div>
						<div class="show-for-small text-center anim-mobile-nav">
							<div class="anim-nav-left">
								<?php get_template_part('assets/images/gold-arrow', 'left.svg'); ?>
							</div>
							<?php get_template_part('assets/images/sun.svg'); ?>
							<div class="anim-nav-right">
								<?php get_template_part('assets/images/gold-arrow', 'right.svg'); ?>
							</div>
							<div class="svg-time">
								7:00am
							</div>
							<script>
								var times = ["7:00am", "10:00am", "12:00pm", '3:00pm', '7:00pm', '8:30pm'];
								var arrayLength = times.length;
								jQuery(".anim-nav-left").on( "click", function() {
								  	currentTime = jQuery('.svg-time').html();
									for (var i = 0; i < arrayLength; i++) {
								    	if (times[i] == currentTime) {
									    	var prevTimeIndex = i - 1;
									    	if (prevTimeIndex >= 0) {
										    	jQuery('.svg-time').html(times[prevTimeIndex]);
										    	updateTime(times[prevTimeIndex]);
										    }
										    break;
								    	}	
								    }
								});								
								jQuery(".anim-nav-right").on( "click", function() {
								  	currentTime = jQuery('.svg-time').html();
									for (var i = 0; i < arrayLength; i++) {
								    	if (times[i] == currentTime) {
									    	var nextTimeIndex = i + 1;
									    	if (nextTimeIndex <= 5) {
										    	jQuery('.svg-time').html(times[nextTimeIndex]);
										    	updateTime(times[nextTimeIndex]);
										    }
										    break;
								    	}	
								    }
								});
								
								function updateTime(time) {
									if (time == '7:00am') {
									  	jQuery('#versatis-animation').attr('data-time', '7am');
									} else if (time == '10:00am') {
										jQuery('#versatis-animation').attr('data-time', '10am');
									} else if (time == '12:00pm') {
										jQuery('#versatis-animation').attr('data-time', '12pm');
									} else if (time == '3:00pm') {
										jQuery('#versatis-animation').attr('data-time', '3pm');
									} else if (time == '7:00pm') {
										jQuery('#versatis-animation').attr('data-time', '7pm');
									} else {
										jQuery('#versatis-animation').attr('data-time', '830pm');
									}																											
								}
							</script>
						</div>
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
	  jQuery(".svg-time").text('7:00am');
	  jQuery('#versatis-animation').attr('data-time', '7am');
  } else if (point.x > 150 && point.x < 351) {
	  jQuery(".svg-time").text('10:00am');
	  jQuery('#versatis-animation').attr('data-time', "10am" ); 
  } else if (point.x > 350 && point.x < 751) {
	  jQuery(".svg-time").text('12:00pm');
	  jQuery('#versatis-animation').attr('data-time', "12pm" );	  
  } else if (point.x > 750 && point.x < 1101) {
	  jQuery(".svg-time").text('3:00pm');
	  jQuery('#versatis-animation').attr('data-time', "3pm" );  
  } else if (point.x > 1100 && point.x < 1301) {
	  jQuery(".svg-time").text('7:00pm');
	  jQuery('#versatis-animation').attr('data-time', "7pm" );  
  } else {
	  jQuery(".svg-time").text('8:30pm');
	  jQuery('#versatis-animation').attr('data-time', "830pm" );  
  } 
   // jQuery(".svg-time").text(point.x);
   
   
    
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
