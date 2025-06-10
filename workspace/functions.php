<?php
/**
 * Storefront Child Theme functions and definitions
 */

/**
 * Enqueue parent theme's stylesheet and child theme's stylesheet
 */
function storefront_child_enqueue_styles() {
    $parent_style = 'storefront-style';
    
    // Enqueue parent theme's stylesheet
    wp_enqueue_style(
        $parent_style, 
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme('storefront')->get('Version')
    );
    
    // Enqueue child theme's stylesheet with parent's as dependency
    wp_enqueue_style(
        'storefront-child-style',
        get_stylesheet_uri(),
        array($parent_style),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'storefront_child_enqueue_styles', 11);

// Disable WooCommerce product image zoom
add_action( 'template_redirect', function() {
    remove_theme_support( 'wc-product-gallery-zoom' );
}, 100 );

/**
 * Remove Breadcrumbs
 */
add_action( 'init', 'storefront_remove_storefront_breadcrumbs' );

function storefront_remove_storefront_breadcrumbs() {
    remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );
}

// Redirect only logged-out users trying to access my-account page
add_action('template_redirect', function() {
    if (is_account_page() && !is_user_logged_in()) {
        wp_redirect(home_url('/login/'));
        exit;
    }
});

// Include separate files
require_once get_stylesheet_directory() . '/audio-processing.php';
require_once get_stylesheet_directory() . '/downloads-template.php';

function enqueue_download_all_script() {
    if (is_account_page()) {
        wp_enqueue_script('download-all', get_stylesheet_directory_uri() . '/js/download-all.js', array('jquery'), '1.0', true);
        wp_localize_script('download-all', 'downloadAjax', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('audio_conversion_nonce')
        ));
    }
}
add_action('wp_enqueue_scripts', 'enqueue_download_all_script');
