<?php
include '../../../wp-load.php';
$selected = $_REQUEST['selected'];

$message = $selected;
$headers = 'From: <info@website.com>' . "\r\n";
wp_mail( 'joel@drumcreative.com', 'Product Selector Fields', $message, $headers );
?>

