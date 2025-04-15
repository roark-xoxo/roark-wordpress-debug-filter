<?php

/**
 * Plugin Name: ROARK Debug Filter
 * Description: Suppress _load_textdomain_just_in_time Notice
 * Version: 1.0.0
 * Author: ROARK
 * Author URI: https://roark.at
 * License: MIT
 * Text Domain: roark-debug-filter
 */

if (! defined('ABSPATH')) {
    exit;
}

add_filter('doing_it_wrong_trigger_error', 'roark_filter_doing_it_wrong_notices', 10, 2);

function roark_filter_doing_it_wrong_notices($trigger, $function_name) {
    if ('_load_textdomain_just_in_time' === $function_name) {
        return false;
    }
    return $trigger;
}
