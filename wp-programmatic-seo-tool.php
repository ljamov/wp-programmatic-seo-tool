<?php
/*
Plugin Name: Programmatic SEO Tool
Description: A WordPress tool for programmatic SEO analysis of published posts.
Version: 1.0
Author: Kristijan Ljamov
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Autoload classes
require_once __DIR__ . '/includes/class-seo-analyzer.php';
require_once __DIR__ . '/includes/class-admin.php';
require_once __DIR__ . '/includes/class-rest-api.php';

// Initialize the plugin
add_action('plugins_loaded', 'initialize_seo_tool');

function initialize_seo_tool() {
    // Admin functionality
    Programmatic_SEO_Tool\Admin::init();

    // REST API functionality
    Programmatic_SEO_Tool\REST_API::init();
}
