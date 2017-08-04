<?php
include '../../../wp-load.php';
$selected = $_REQUEST['selected'];

$message = '<h1>User Details from the Product Selector</h1>';
$message .= $selected;
$headers = 'From: <info@website.com>' . "\r\n";
wp_mail( 'joel@drumcreative.com', 'Product Selector Details', $message, $headers );
?>

