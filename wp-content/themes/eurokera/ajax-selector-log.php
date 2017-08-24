<?php
include '../../../wp-load.php';
// productName : productName, glassColor : glassColor, displayOptions : displayOptions, heatSource : heatSource, customTop : customTop, retailPro : retailPro, addlOptions : addlOptions 
$product_name = ltrim($_REQUEST['productName'], ', ');
$glass_color = ltrim($_REQUEST['glassColor'], ', ');
$display_options = ltrim($_REQUEST['productName'], ', ');
$heat_source = ltrim($_REQUEST['heatSource'], ', ');
$custom_top = ltrim($_REQUEST['customTop'], ', ');
$retail_pro = ltrim($_REQUEST['retailPro'], ', ');
$addl_options = ltrim($_REQUEST['addlOptions'], ', ');

$postarr = array(
	"post_status" => "publish",
	"post_type" => "selector_log",
	"post_title" => $product_name,
);
$post_id = wp_insert_post($postarr);
update_field('glass_color', $glass_color, $post_id);
update_field('display', $display_options, $post_id);
update_field('heat_source', $heat_source, $post_id);
update_field('custom_top', $custom_top, $post_id);
update_field('retail_pro', $retail_pro, $post_id);
update_field('addl_options', $addl_options, $post_id);
?>

