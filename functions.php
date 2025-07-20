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

add_action( 'wp', function() {
    remove_theme_support( 'wc-product-gallery-zoom' );
});


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

// Removed download-related includes and functions as they have been moved to the player plugin

function get_blocked_emails() {
    static $blocked_emails = null;
    if ($blocked_emails === null) {
        $file = get_stylesheet_directory() . '/blocked-emails.txt';
        $blocked_emails = file_exists($file) ?
            array_map('strtolower', array_map('trim', file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES))) :
            array();
    }
    return $blocked_emails;
}

function block_specific_emails($errors, $sanitized_user_login, $user_email) {
    $blocked_emails = get_blocked_emails();
    if (in_array(strtolower($user_email), $blocked_emails)) {
        $errors->add('email_blocked', __('This email address is not allowed to register.', 'storefront-staging'));
    }
    return $errors;
}
add_filter('registration_errors', 'block_specific_emails', 10, 3);

function enqueue_page_list_cat_css() {
    if (is_page_template('page-list-cat.php')) {
        wp_enqueue_style('page-list-cat-style', get_stylesheet_directory_uri() . '/page-list-cat.css', array(), '1.0');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_page_list_cat_css');


// Add registration date column to users list
add_filter('manage_users_columns', function($columns) {
    $columns['registered'] = 'Registered';
    return $columns;
});

add_filter('manage_users_custom_column', function($value, $column_name, $user_id) {
    if ($column_name == 'registered') {
        $user = get_userdata($user_id);
        return $user->user_registered;
    }
    return $value;
}, 10, 3);

// Make the column sortable
add_filter('manage_users_sortable_columns', function($columns) {
    $columns['registered'] = 'registered';
    return $columns;
});

function add_shop_page_footer_text() {
    if (is_shop()) {
        echo '<div class="shop-notice-banner">
            <p><strong>therob.lol</strong> never processes, stores, or has access to your financial information, which remains completely private and protected.<br>
            All transactions are securely handled by PayPal using industry-standard encryption.<br>
            </p>
        </div>';
    }
}
add_action('woocommerce_after_main_content', 'add_shop_page_footer_text');

// Helper functions for accessing Bandfront Members plugin settings
function get_bandfront_setting($key, $default = null) {
    if (isset($GLOBALS['BandfrontMembers'])) {
        return $GLOBALS['BandfrontMembers']->getConfig()->get($key, $default);
    }
    return $default;
}

function get_bandfront_join_page_url() {
    $page_id = get_bandfront_setting('join_page');
    return $page_id ? get_permalink($page_id) : home_url('/become-a-backer/');
}

function get_bandfront_posts_page_url() {
    $page_id = get_bandfront_setting('posts_page');
    return $page_id ? get_permalink($page_id) : '';
}

// Helper functions for accessing Bandfront Members plugin
function is_bandfront_backer($user_id = null) {
    if (isset($GLOBALS['BandfrontMembers'])) {
        return $GLOBALS['BandfrontMembers']->getRoles()->userHasBackstageAccess($user_id);
    }
    return false;
}

function get_bandfront_join_url() {
    if (isset($GLOBALS['BandfrontMembers'])) {
        $config = $GLOBALS['BandfrontMembers']->getConfig();
        $page_id = $config->get('join_page');
        return $page_id ? get_permalink($page_id) : home_url('/become-a-backer/');
    }
    return home_url('/become-a-backer/');
}

// Add debug to check if WooCommerce product loop is running
add_action('woocommerce_before_shop_loop', function() {
    error_log('[BFP DEBUG] woocommerce_before_shop_loop fired');
});

add_action('woocommerce_shop_loop', function() {
    error_log('[BFP DEBUG] woocommerce_shop_loop fired');
});

add_action('woocommerce_after_shop_loop_item', function() {
    error_log('[BFP DEBUG] woocommerce_after_shop_loop_item fired for product: ' . get_the_ID());
}, 5); // Before our hook

add_action('init', function() {
    if (is_front_page()) {
        error_log('[BFP DEBUG] On front page');
    }
    if (is_shop()) {
        error_log('[BFP DEBUG] On shop page');
    }
});
