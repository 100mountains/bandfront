<?php
/**
 * Bandfront Roles Management
 * Handles role creation and access control for the membership system
 */

if (!defined('ABSPATH')) {
    exit;
}

class BandfrontRoles {
    
    /**
     * Initialize the roles system
     */
    public static function init() {
        add_action('after_setup_theme', array(__CLASS__, 'setup_roles'));
        add_action('template_redirect', array(__CLASS__, 'restrict_backstage_access'));
        add_shortcode('bandfront_backstage_content', array(__CLASS__, 'backstage_content_shortcode'));
    }
    
    /**
     * Create the backers role if it doesn't exist
     */
    public static function setup_roles() {
        // Create the default backers role
        if (!get_role('bandfront_backers')) {
            add_role('bandfront_backers', 'Bandfront Backers', array(
                'read' => true,
                'level_0' => true,
                'access_backstage_content' => true,
            ));
        }
        
        // Check if plugin settings specify a different role
        $settings = get_option('bfm_settings', []);
        $custom_role = $settings['backer_role'] ?? '';
        
        // If a custom role is specified and doesn't exist, create it
        if ($custom_role && $custom_role !== 'bandfront_backers' && !get_role($custom_role)) {
            add_role($custom_role, ucfirst($custom_role), array(
                'read' => true,
                'level_0' => true,
                'access_backstage_content' => true,
            ));
        }
    }
    
    /**
     * Restrict access to the backstage page based on plugin settings
     */
    public static function restrict_backstage_access() {
        $settings = get_option('bfm_settings', []);
        $posts_page = $settings['posts_page'] ?? '';
        $backer_role = $settings['backer_role'] ?? 'bandfront_backers';
        
        // Check if we're on the restricted page
        if ($posts_page && is_page($posts_page)) {
            if (!is_user_logged_in()) {
                // Redirect to login with return URL
                $redirect_url = add_query_arg('redirect_to', urlencode(get_permalink()), wp_login_url());
                wp_redirect($redirect_url);
                exit;
            }
            
            // Check if user has the required role
            if (!self::user_has_backstage_access()) {
                // Show a custom template or redirect
                self::show_access_denied_message();
                exit;
            }
        }
    }
    
    /**
     * Check if current user has backstage access
     */
    public static function user_has_backstage_access($user_id = null) {
        if (!$user_id) {
            $user_id = get_current_user_id();
        }
        
        if (!$user_id) {
            return false;
        }
        
        $settings = get_option('bfm_settings', []);
        $backer_role = $settings['backer_role'] ?? 'bandfront_backers';
        
        $user = new WP_User($user_id);
        
        // Check if user has the specified role or admin capabilities
        return $user->has_role($backer_role) || $user->has_cap('manage_options');
    }
    
    /**
     * Show access denied message
     */
    private static function show_access_denied_message() {
        // Get the join page URL from plugin settings
        $join_page_url = home_url('/become-a-backer/'); // Default fallback
        
        if (isset($GLOBALS['BandfrontMembers'])) {
            $config = $GLOBALS['BandfrontMembers']->getConfig();
            $join_page_id = $config->get('join_page');
            
            if ($join_page_id) {
                $join_page_url = get_permalink($join_page_id);
            }
        }
        
        get_header();
        ?>
        <div class="backstage-access-denied">
            <div class="container">
                <h1 class="bluu-title">Backstage Access Required</h1>
                <div class="bluu-text">
                    <p>This content is exclusively available to our Bandfront Backers.</p>
                    <p>Join our community of supporters to access exclusive content, early releases, and behind-the-scenes material.</p>
                    <div class="backstage-actions">
                        <a href="<?php echo esc_url($join_page_url); ?>" class="button">Become a Backer</a>
                        <a href="<?php echo home_url(); ?>" class="button secondary">Return Home</a>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .backstage-access-denied {
                min-height: 60vh;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                padding: 40px 20px;
            }
            .backstage-access-denied .container {
                max-width: 600px;
            }
            .backstage-actions {
                margin-top: 30px;
            }
            .backstage-actions .button {
                display: inline-block;
                padding: 12px 30px;
                margin: 0 10px;
                background: #FD8F35;
                color: #000;
                text-decoration: none;
                font-family: 'Alacti', sans-serif;
                transition: all 0.3s ease;
            }
            .backstage-actions .button:hover {
                background: #ff6b35;
            }
            .backstage-actions .button.secondary {
                background: transparent;
                border: 2px solid #FD8F35;
                color: #FD8F35;
            }
            .backstage-actions .button.secondary:hover {
                background: #FD8F35;
                color: #000;
            }
        </style>
        <?php
        get_footer();
    }
    
    /**
     * Shortcode for protecting backstage content
     */
    public static function backstage_content_shortcode($atts, $content = null) {
        if (!is_user_logged_in()) {
            return '<div class="backstage-login-required bluu-text">
                <p>Please <a href="' . wp_login_url(get_permalink()) . '">log in</a> to view this content.</p>
            </div>';
        }
        
        if (!self::user_has_backstage_access()) {
            // Get the join page URL from plugin settings
            $join_page_url = home_url('/become-a-backer/'); // Default fallback
            
            if (isset($GLOBALS['BandfrontMembers'])) {
                $config = $GLOBALS['BandfrontMembers']->getConfig();
                $join_page_id = $config->get('join_page');
                
                if ($join_page_id) {
                    $join_page_url = get_permalink($join_page_id);
                }
            }
            
            return '<div class="backstage-membership-required bluu-text">
                <p>This content is for Bandfront Backers only.</p>
                <p><a href="' . esc_url($join_page_url) . '">Become a Backer</a> to access exclusive content.</p>
            </div>';
        }
        
        return do_shortcode($content);
    }
}

// Initialize the roles system
BandfrontRoles::init();
