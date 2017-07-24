<?php

// Abort if uninstall.php is not called by WordPress.
if ( ! defined('WP_UNINSTALL_PLUGIN') ) die;

delete_option( 'fps_post_types' );
delete_option( 'fps_post_statuses' );
