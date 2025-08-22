<?php
/**
 * Storefront Child Theme functions and definitions
 */

/*--------------------------------------------------------------
# Stylesheets
--------------------------------------------------------------*/

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

/*--------------------------------------------------------------
# WooCommerce Customizations
--------------------------------------------------------------*/

/**
 * Remove WooCommerce breadcrumbs from Storefront theme
 */
add_action('init', 'storefront_remove_storefront_breadcrumbs');
function storefront_remove_storefront_breadcrumbs() {
    remove_action('storefront_before_content', 'woocommerce_breadcrumb', 10);
}


/*--------------------------------------------------------------
# Registration Email Blocking
--------------------------------------------------------------*/

/**
 * Get blocked emails from file
 *
 * @return array
 */
function get_blocked_emails() {
    static $blocked_emails = null;
    if ($blocked_emails === null) {
        $file = get_stylesheet_directory() . '/blocked-emails.txt';
        $blocked_emails = file_exists($file)
            ? array_map('strtolower', array_map('trim', file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)))
            : array();
    }
    return $blocked_emails;
}

/**
 * Block specific emails from registering
 *
 * @param WP_Error $errors
 * @param string $sanitized_user_login
 * @param string $user_email
 * @return WP_Error
 */
function block_specific_emails($errors, $sanitized_user_login, $user_email) {
    $blocked_emails = get_blocked_emails();
    if (in_array(strtolower($user_email), $blocked_emails)) {
        $errors->add('email_blocked', __('This email address is not allowed to register.', 'storefront-staging'));
    }
    return $errors;
}
add_filter('registration_errors', 'block_specific_emails', 10, 3);

/*--------------------------------------------------------------
# Page Template Styles
--------------------------------------------------------------*/

/*--------------------------------------------------------------
# Shop Page Banner
--------------------------------------------------------------*/

/**
 * Output shop page footer notice banner
 */
function add_shop_page_footer_text() {
    if (is_shop()) {
        get_template_part('templates/shop-notice-banner');
    }
}
add_action('woocommerce_after_main_content', 'add_shop_page_footer_text');

 
