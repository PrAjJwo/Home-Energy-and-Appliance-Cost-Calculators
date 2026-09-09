<?php
/**
 * VoltMetrics Theme Functions and Definitions
 */

if ( ! function_exists( 'voltmetrics_setup' ) ) :
    function voltmetrics_setup() {
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        // Let WordPress manage the document title.
        add_theme_support( 'title-tag' );

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support( 'post-thumbnails' );

        // Register navigation menus
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary Menu', 'voltmetrics' ),
            'footer-hvac' => esc_html__( 'Footer HVAC Menu', 'voltmetrics' ),
            'footer-backup' => esc_html__( 'Footer Backup Menu', 'voltmetrics' ),
        ) );
    }
endif;
add_action( 'after_setup_theme', 'voltmetrics_setup' );

/**
 * Enqueue scripts and styles.
 */
function voltmetrics_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style( 'voltmetrics-style', get_stylesheet_uri(), array(), '1.0.0' );

    // Enqueue currency conversion script globally
    wp_enqueue_script( 'voltmetrics-currency', get_template_directory_uri() . '/assets/js/currency.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'voltmetrics_scripts' );

/**
 * Load global configurations
 */
function voltmetrics_load_global_config() {
    $rates_path = get_template_directory() . '/inc/rates.php';
    if (file_exists($rates_path)) {
        require_once $rates_path;
    }
}
add_action('init', 'voltmetrics_load_global_config');
