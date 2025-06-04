To customize the WooCommerce "My Account" page using the Storefront theme without paid plugins, you can employ code-based methods. Here's how:

ICONS FOR MENU ITEMS 

Dashboard – fa-tachometer-alt (tachometer icon)

Orders – fa-shopping-basket or fa-shopping-cart

Downloads – fa-file-alt or fa-file-download

Addresses – fa-home

Payment methods – fa-credit-card

Account details – fa-user

Log out – fa-sign-out-alt

--------

Core CSS Classes and Structure
Main Container Classes
css/* Main wrapper */
.woocommerce-account {
    /* Your styles */
}

/* Navigation and content wrapper */
.woocommerce-MyAccount-navigation,
.woocommerce-MyAccount-content {
    /* Your styles */
}
Navigation Menu Classes
css/* Navigation container */
.woocommerce-MyAccount-navigation {
    float: left;
    width: 25%;
}

/* Navigation list */
.woocommerce-MyAccount-navigation ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

/* Individual menu items */
.woocommerce-MyAccount-navigation ul li {
    padding: 0;
    margin: 0 0 5px;
    list-style: none;
    position: relative;
}

/* Menu item links */
.woocommerce-MyAccount-navigation ul li a {
    display: block;
    padding: 10px 15px;
    text-decoration: none;
}

/* Active/current menu item */
.woocommerce-MyAccount-navigation ul li.is-active a {
    background-color: #333;
    color: #fff;
}

/* Specific endpoint classes */
.woocommerce-MyAccount-navigation-link--dashboard {}
.woocommerce-MyAccount-navigation-link--orders {}
.woocommerce-MyAccount-navigation-link--downloads {}
.woocommerce-MyAccount-navigation-link--edit-address {}
.woocommerce-MyAccount-navigation-link--edit-account {}
.woocommerce-MyAccount-navigation-link--customer-logout {}
Content Area Classes
css/* Main content container */
.woocommerce-MyAccount-content {
    float: right;
    width: 73%;
}
Complete Storefront-Specific My Account CSS
For WooCommerce Storefront theme, you can use FontAwesome icons Users InsightsMisha Rudrastyh. Here's a complete CSS solution:
Enhanced Navigation with Icons
css/* Base navigation styles */
.woocommerce-MyAccount-navigation {
    background: #f8f8f8;
    border: 1px solid #e1e1e1;
    border-radius: 3px;
    padding: 20px;
}

.woocommerce-MyAccount-navigation ul {
    margin: 0;
    padding: 0;
}

.woocommerce-MyAccount-navigation ul li {
    list-style: none;
    margin-bottom: 8px;
    border-bottom: 1px solid #e1e1e1;
}

.woocommerce-MyAccount-navigation ul li:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.woocommerce-MyAccount-navigation ul li a {
    color: #515151;
    display: block;
    font-weight: 600;
    padding: 12px 15px;
    position: relative;
    text-decoration: none;
    transition: all 0.3s ease;
}

/* Hover effect */
.woocommerce-MyAccount-navigation ul li a:hover {
    background: #f0f0f0;
    color: #000;
    padding-left: 20px;
}

/* Active state */
.woocommerce-MyAccount-navigation ul li.is-active a {
    background: #333;
    color: #fff;
    border-radius: 3px;
}

/* FontAwesome Icons for Storefront */
.woocommerce-MyAccount-navigation ul li a::before {
    font-family: 'FontAwesome';
    display: inline-block;
    margin-right: 10px;
    width: 20px;
    text-align: center;
}

/* Specific icons for each endpoint */
.woocommerce-MyAccount-navigation-link--dashboard a::before {
    content: "\f0e4"; /* Dashboard icon */
}

.woocommerce-MyAccount-navigation-link--orders a::before {
    content: "\f291"; /* Shopping cart icon */
}

.woocommerce-MyAccount-navigation-link--downloads a::before {
    content: "\f019"; /* Download icon */
}

.woocommerce-MyAccount-navigation-link--edit-address a::before {
    content: "\f015"; /* Home icon */
}

.woocommerce-MyAccount-navigation-link--edit-account a::before {
    content: "\f007"; /* User icon */
}

.woocommerce-MyAccount-navigation-link--customer-logout a::before {
    content: "\f08b"; /* Sign out icon */
}
Horizontal Navigation Layout
To display the navigation horizontally instead of vertically WooCommerce: Horizontal My Account Navigation Menu:
css/* Storefront horizontal navigation */
@media (min-width: 768px) {
    .woocommerce-MyAccount-navigation {
        float: none;
        width: 100%;
        margin-bottom: 30px;
        background: transparent;
        border: none;
        padding: 0;
    }
    
    .woocommerce-MyAccount-navigation ul {
        display: flex;
        justify-content: center;
        border-bottom: 2px solid #e1e1e1;
    }
    
    .woocommerce-MyAccount-navigation ul li {
        border-bottom: none;
        border-right: 1px solid #e1e1e1;
        margin-bottom: 0;
        flex: 1;
    }
    
    .woocommerce-MyAccount-navigation ul li:last-child {
        border-right: none;
    }
    
    .woocommerce-MyAccount-navigation ul li a {
        text-align: center;
        padding: 15px 10px;
    }
    
    .woocommerce-MyAccount-navigation ul li.is-active a {
        background: transparent;
        color: #333;
        border-bottom: 3px solid #333;
        border-radius: 0;
    }
    
    .woocommerce-MyAccount-content {
        float: none;
        width: 100%;
    }
}
Modern Card-Based Design
css/* Modern card design for My Account */
.woocommerce-account .woocommerce-MyAccount-navigation {
    background: #fff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border: none;
    border-radius: 8px;
}

.woocommerce-MyAccount-navigation ul li {
    border-bottom: 1px solid #f0f0f0;
}

.woocommerce-MyAccount-navigation ul li a {
    font-size: 15px;
    color: #666;
    padding: 15px 20px;
}

.woocommerce-MyAccount-navigation ul li a:hover {
    background: #f8f9fa;
    color: #333;
    padding-left: 25px;
}

.woocommerce-MyAccount-navigation ul li.is-active a {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    font-weight: 600;
}

/* Content area styling */
.woocommerce-MyAccount-content {
    background: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
Mobile Responsive Design
css/* Mobile styles */
@media (max-width: 767px) {
    .woocommerce-MyAccount-navigation,
    .woocommerce-MyAccount-content {
        float: none;
        width: 100%;
    }
    
    .woocommerce-MyAccount-navigation {
        margin-bottom: 20px;
    }
    
    .woocommerce-MyAccount-navigation ul li a {
        padding: 12px 15px;
        font-size: 14px;
    }
    
    .woocommerce-MyAccount-navigation ul li a::before {
        margin-right: 8px;
        font-size: 14px;
    }
}
Additional Enhancements
css/* Remove underlines from Storefront links (v2.4.5+) */
.woocommerce-MyAccount-content a {
    text-decoration: none;
}

/* Style tables in account pages */
.woocommerce-MyAccount-content table.shop_table {
    border: 1px solid #e1e1e1;
    border-radius: 3px;
}

.woocommerce-MyAccount-content table.shop_table th {
    background: #f8f8f8;
    font-weight: 600;
}

/* Style buttons */
.woocommerce-MyAccount-content .button {
    background: #333;
    color: #fff;
    padding: 10px 20px;
    border-radius: 3px;
    transition: all 0.3s ease;
}

.woocommerce-MyAccount-content .button:hover {
    background: #555;
    color: #fff;
}

/* Style form fields */
.woocommerce-MyAccount-content input[type="text"],
.woocommerce-MyAccount-content input[type="email"],
.woocommerce-MyAccount-content input[type="password"],
.woocommerce-MyAccount-content textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 3px;
}

/* Welcome message styling */
.woocommerce-MyAccount-content > p:first-child {
    font-size: 18px;
    color: #666;
    margin-bottom: 30px;
}
Body Classes for Page-Specific Styling
Each endpoint has its own body class 0.1 Powerful Stylish Navigation for WooCommerce My Account:
css/* Target specific account pages */
body.woocommerce-account.woocommerce-orders { }
body.woocommerce-account.woocommerce-view-order { }
body.woocommerce-account.woocommerce-downloads { }
body.woocommerce-account.woocommerce-edit-address { }
body.woocommerce-account.woocommerce-edit-account { }




1. Using Hooks and Filters (functions.php)
The most flexible free method is adding code to your child theme's functions.php file. Here are the key hooks:
Reorder Menu Items
phpadd_filter('woocommerce_account_menu_items', 'reorder_my_account_menu');
function reorder_my_account_menu($menu_items) {
    $new_order = array(
        'dashboard' => $menu_items['dashboard'],
        'orders' => $menu_items['orders'],
        'downloads' => $menu_items['downloads'],
        'edit-address' => $menu_items['edit-address'],
        'edit-account' => $menu_items['edit-account'],
        'customer-logout' => $menu_items['customer-logout'],
    );
    return $new_order;
}
Rename Menu Items
phpadd_filter('woocommerce_account_menu_items', 'rename_my_account_menu_items');
function rename_my_account_menu_items($items) {
    $items['edit-account'] = __('My Details', 'woocommerce');
    $items['orders'] = __('My Orders', 'woocommerce');
    return $items;
}
Remove Menu Items
phpadd_filter('woocommerce_account_menu_items', 'remove_my_account_links');
function remove_my_account_links($menu_links) {
    unset($menu_links['downloads']); // Remove Downloads
    unset($menu_links['payment-methods']); // Remove Payment Methods
    return $menu_links;
}
Add Custom Endpoints/Tabs
php// 1. Register the endpoint
add_action('init', 'add_custom_endpoint');
function add_custom_endpoint() {
    add_rewrite_endpoint('loyalty', EP_PAGES);
}

// 2. Add to menu
add_filter('woocommerce_account_menu_items', 'add_loyalty_tab');
function add_loyalty_tab($items) {
    $items['loyalty'] = __('Loyalty Program', 'woocommerce');
    return $items;
}

// 3. Add content
add_action('woocommerce_account_loyalty_endpoint', 'loyalty_content');
function loyalty_content() {
    echo '<h3>Your Loyalty Points</h3>';
    echo '<p>Your custom content here</p>';
}
2. Template Overrides
Create a woocommerce folder in your child theme, then add the necessary files maintaining the default WooCommerce file structure How to Customize the My Account Page in WooCommerce - Users Insights +2:

Copy files from: /wp-content/plugins/woocommerce/templates/myaccount/
Paste to: /wp-content/themes/your-child-theme/woocommerce/myaccount/

Common files to override:

dashboard.php - Main dashboard content
my-account.php - Overall page structure
navigation.php - Menu navigation

3. Using Shortcodes
The My Account page is built with the [woocommerce_my_account] shortcode The My account page Documentation - WooCommerce. You can create custom pages and add content using shortcodes:
php// Display custom content in dashboard
add_action('woocommerce_account_dashboard', 'custom_dashboard_content');
function custom_dashboard_content() {
    echo do_shortcode('[your_custom_shortcode]');
}
4. CSS Customization
Add custom CSS through the WordPress Customizer (Appearance > Customize > Additional CSS):
Change Menu Icons (Storefront uses Font Awesome)
css.woocommerce-MyAccount-navigation ul li.woocommerce-MyAccount-navigation-link--orders a::before {
    content: "\f291"; /* Shopping cart icon */
}

.woocommerce-MyAccount-navigation ul li.woocommerce-MyAccount-navigation-link--edit-account a::before {
    content: "\f007"; /* User icon */
}
Style the Navigation
css.woocommerce-MyAccount-navigation {
    background: #f5f5f5;
    padding: 20px;
    border-radius: 5px;
}

.woocommerce-MyAccount-navigation ul li {
    margin-bottom: 10px;
}

.woocommerce-MyAccount-navigation ul li a {
    padding: 10px 15px;
    display: block;
    border-radius: 3px;
}

.woocommerce-MyAccount-navigation ul li.is-active a {
    background: #333;
    color: #fff;
}
5. Key Action Hooks for Content
Visual hooks available on the My Account page WooCommerce Visual Hook Guide: My Account Pages:

woocommerce_before_account_navigation - Before navigation menu
woocommerce_after_account_navigation - After navigation menu
woocommerce_account_dashboard - Dashboard content
woocommerce_before_my_account - Before entire My Account content
woocommerce_after_my_account - After entire My Account content

Example usage:
phpadd_action('woocommerce_before_account_navigation', 'add_welcome_message');
function add_welcome_message() {
    $current_user = wp_get_current_user();
    echo '<h2>Welcome back, ' . $current_user->display_name . '!</h2>';
}
Important Notes:

Always use a child theme to prevent losing customizations during theme updates
Clear permalinks after adding new endpoints (Settings > Permalinks > Save)
Test thoroughly on a staging site first

2. Add Custom Endpoints

Endpoints are additional tabs in the "My Account" page.

In your child theme's functions.php, register a new endpoint:

php
Copy
Edit
function custom_add_my_account_endpoint() {
    add_rewrite_endpoint('custom-endpoint', EP_ROOT | EP_PAGES);
}
add_action('init', 'custom_add_my_account_endpoint');
Add the endpoint to the query variables:

php
Copy
Edit
function custom_my_account_query_vars($vars) {
    $vars[] = 'custom-endpoint';
    return $vars;
}
add_filter('query_vars', 'custom_my_account_query_vars');
Display content for the new endpoint:

php
Copy
Edit
function custom_my_account_endpoint_content() {
    echo '<h3>Custom Content</h3>';
    echo '<p>This is your custom endpoint content.</p>';
}
add_action('woocommerce_account_custom-endpoint_endpoint', 'custom_my_account_endpoint_content');
Flush rewrite rules after adding the endpoint by visiting Settings > Permalinks in your WordPress dashboard.

3. Modify the Account Menu

To change the order or labels of the menu items:

Use the woocommerce_account_menu_items filter in your functions.php:

php
Copy
Edit
function custom_my_account_menu_items($items) {
    // Add new item
    $items['custom-endpoint'] = 'Custom Tab';
    // Reorder items
    $new_order = array(
        'dashboard' => $items['dashboard'],
        'orders' => $items['orders'],
        'custom-endpoint' => $items['custom-endpoint'],
        'edit-account' => $items['edit-account'],
        'customer-logout' => $items['customer-logout'],
    );
    return $new_order;
}
add_filter('woocommerce_account_menu_items', 'custom_my_account_menu_items');
4. Customize Templates

To change the layout or content of specific sections:

Copy the template files from woocommerce/templates/myaccount/ to your child theme's woocommerce/myaccount/ directory.

Edit these files as needed. For example, to customize the dashboard, edit dashboard.php.

5. Add Custom CSS

To style the "My Account" page:

Add your custom CSS to the child theme's style.css file. For example:

css
Copy
Edit
.woocommerce-MyAccount-navigation-link--custom-endpoint a {
    color: #0073aa;
}
By following these steps, you can effectively customize the WooCommerce "My Account" page within the Storefront theme without relying on paid plugins.


RANDOM CSS SNIPPETS


How to remove gap in Storefront Theme footer
.footer-widgets { padding-top: 0; }

How to change the background color and text color of the Storefront Theme Demo store notice
.woocommerce-store-notice
{
color:white;
background-color:black
}

How to remove space between Storefront Theme page content and footer
.home #primary,
.home #main,
.home #main &gt; article {
margin-bottom: 5px;
}

How to show Shop page products in two columns (mobile view)
/* 2 column-mobile */
ul.products li.product {
width:46.411765%;
float:left;
margin-right: 5.8823529412%;
}

ul.products li.product:nth-of-type( 2n ) {
margin-right:0;
}

@media only screen and (min-width:768px) {
ul.products li.product:nth-of-type( 2n ) {
margin-right:5.8823529412%;
}
}

How to remove the Storefront Theme header but keep the menu
#masthead &gt; .col-full,
#masthead .site-header-cart {
display: none;
}

How to remove the underline from Storefront Theme Hyperlinks
In version 2.4.5 of the Storefront theme links are underlined by default. If you want to remove them then the following CSS will do it for you.


a {
    text-decoration: none !important;
}
view rawgistfile1.txt hosted with ❤ by GitHub
How to remove featured images on Posts on WooCommerce Storefront theme
Click here to get the snippet – add to your functions file

How to change the colour of the Horizontal lines on the Storefront Theme homepage
Simply add the following code to your child theme’s custom.css file. Thanks to James Koster for this one

.page-template-template-homepage .hentry .entry-header,
.page-template-template-homepage .hentry,
.page-template-template-homepage .storefront-product-section {
border-color: red;
}
view rawgistfile1.txt hosted with ❤ by GitHub
How to style Storefront Theme widgets
Add and amend the following css to your child theme’s custom.css file


.widget-area .widget {
    color: red;
    font-size: 1em;
}
view rawgistfile1.txt hosted with ❤ by GitHub
How to customise the Storefront Theme WooCommerce on sale badge
Add the following code to your child theme’s custom.css file.

.onsale {
    background-color: #FFFFFF;
    border-color: #FF0000;
    color: #FF0000;
}
view rawgistfile1.txt hosted with ❤ by GitHub
How to move the Storefront Theme sale badge (i.e below the product picture)
Add the following code to your child theme’s custom.css file.


ul.products li.product .onsale {
    position: absolute;
    top: 137px;
    right: 62px;
}
view rawgistfile1.txt hosted with ❤ by GitHub
Thanks to Nicola Mustone for this one
How to the change the size of the logo, secondary navigation and search bar for the Storefront Theme
Add the following code to your child theme’s custom.css file.

@media screen and (min-width: 768px) {
    /* LOGO */
    .site-header .site-branding, .site-header .site-logo-anchor, .site-header .site-logo-link { width: 30% !important; /* Use px values if you want, eg. 350px */ }

    /* SECONDARY NAVIGATION */
    .site-header .secondary-navigation { width: 40% !important;  /* Use px values if you want, eg. 350px */ }

    /* SEARCH BAR */
    .site-header .site-search { width: 30% !important;  /* Use px values if you want, eg. 350px */ }
}
view rawgistfile1.txt hosted with ❤ by GitHub
Thanks again to Nicola Mustone for this one

How to Remove the Storefront Theme sidebar on WooCommerce product pages so they go full width
Add the following code to your child theme’s functions.php file.


add_action( 'get_header', 'remove_storefront_sidebar' );
	if ( is_product() ) {
		remove_action( 'storefront_sidebar', 'storefront_get_sidebar',			10 );
	}
}
view rawgistfile1.txt hosted with ❤ by GitHub
Also add this css
body.woocommerce #primary { width: 100%; }
view rawgistfile1.txt hosted with ❤ by GitHub
Thanks to Matty Cohen for this one

How to align your menu to the right of the logo on Storefront Theme
We’ve developed a free plugin that will do this for you. You can get our free Storefront Align Menu right extension here.

How to add a top bar to Storefont Theme (for cool things like social icons or a welcome message)
Open you child theme’s functions.php file and paste the following code in.


<?php
/**
 * Adds a top bar to Storefront, before the header.
 */
function storefront_add_topbar() {
    ?>
    <div id="topbar">
        <div class="col-full">
            <p>Your text here</p>
        </div>
    </div>
    <?php
}
add_action( 'storefront_before_header', 'storefront_add_topbar' );
view rawfunctions.php hosted with ❤ by GitHub
Then add some css to your custom.css file – here’s an example (thanks to WooThemes for this tutorial)
#topbar {
    background-color: #1F1F20;
    height: 40px;
    line-height: 40px;
}

#topbar p {
    color: #fff;
}
view rawstyle.css hosted with ❤ by GitHub
How to add a custom message to your Storefront Theme top bar
Find the code that you used when you created the top bar (see previous tweak).

Replace with this


<?php
/**
 * Adds a top bar to Storefront, before the header.
 */
function storefront_add_topbar() {
    global $current_user;
    get_currentuserinfo();

    if ( ! empty( $current_user->user_firstname ) ) {
        $user = $current_user->user_firstname;
    } else {
        $user = __( 'guest', 'storefront-child' );
    }

    ?>
    <div id="topbar">
        <div class="col-full">
            <p>Welcome <?php echo $user ?>!</p>
        </div>
    </div>
    <?php
}
add_action( 'storefront_before_header', 'storefront_add_topbar' );
view rawfunctions.php hosted with ❤ by GitHub
For more options visit this WooThemes support article. Note: We’ve also found this new plugin that adds extra widget areas to your header. Visit the Storefront Top Bar plugin on WordPress.org.
How to make Meta Slider full width with the Storefont Theme
Meta slider is one of the most popular free sliders available on WordPress.org. This bit of code will stretch the slider to be full width. Add this code to your child theme’s functions.php

add_action( 'init', 'child_theme_init' );
function child_theme_init() {
	add_action( 'storefront_before_content', 'woa_add_full_slider', 5 );
}

function woa_add_full_slider() { ?>
	<div id="slider">
		<?php echo do_shortcode("[metaslider id=388 percentwidth=100]"); ?>
	</div>
<?php
}
view rawgistfile1.txt hosted with ❤ by GitHub
How to add extra Google Fonts to the Storefront Theme
Here’s a great plugin that will do this for you. Visit the Google Fonts WordPress plugin.

How to remove the search bar from the Storefront Theme header
Add this code to your child theme’s functions.php


add_action( 'init', 'jk_remove_storefront_header_search' );
function jk_remove_storefront_header_search() {
remove_action( 'storefront_header', 'storefront_product_search', 	40 );
}
view rawadd_action( 'init', 'jk_remove_storefront_header_search' ); function jk_remove_storefront_header_search() { remove_action( 'storefront_header', 'storefront_product_search', 40 ); } hosted with ❤ by GitHub
Note: An easier way to do this is by using the WooThemes Storefront WooCommerce Customizer plugin.
How to hide the Page Titles in the Storefront Theme
Here’s a free plugin that will help you do hide page titles in Storefront.

How to remove ‘designed by WooThemes’ in Storefront footer
Add the following code to your child theme’s funtctions.php file

add_action( 'init', 'custom_remove_footer_credit', 10 );

function custom_remove_footer_credit () {
    remove_action( 'storefront_footer', 'storefront_credit', 20 );
    add_action( 'storefront_footer', 'custom_storefront_credit', 20 );
} 

function custom_storefront_credit() {
	?>
	<div class="site-info">
		&copy; <?php echo get_bloginfo( 'name' ) . ' ' . get_the_date( 'Y' ); ?>
	</div><!-- .site-info -->
	<?php
}
view rawgistfile1.txt hosted with ❤ by GitHub
How to add Font Awesome icons to your Storefront Theme menu
Here’s a free plugin that should do this for you. Visit the Font Awesome for menus plugin on WordPress.org.

How to rename ‘Navigation’ in mobile view on the Storefront Theme
Paste this code into your child theme’s functions.php file


function storefront_primary_navigation() {
		?>
	<nav id="site-navigation" class="main-navigation" role="navigation">
		<button class="menu-toggle"><?php _e( 'Primary Menu', 'storefront' ); ?></button>
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	</nav><!-- #site-navigation -->
	<?php
}
view rawgistfile1.txt hosted with ❤ by GitHub
Then just modify the text here
<button class="menu-toggle"><?php _e( 'Primary Menu', 'storefront' ); ?></button>
view rawgistfile1.txt hosted with ❤ by GitHub
Note: You’ll need to be using a child theme for this one to work

How to add a customer avatar in the Storefront Theme ‘My Account page’
Add the following code to your child theme’s function.php file


/**
 * Print the customer avatar in My Account page, after the welcome message
 */
function storefront_myaccount_customer_avatar() {
    $current_user = wp_get_current_user();

    echo '<div class="myaccount_avatar">' . get_avatar( $current_user->user_email, 72, '', $current_user->display_name ) . '</div>';
}
add_action( 'woocommerce_before_my_account', 'storefront_myaccount_customer_avatar', 5 );
view rawfunctions.php hosted with ❤ by GitHub
Then add the following css to your child theme’s custom.css file
.myaccount_avatar {
    border-right: 1px solid rgba(0, 0, 0, 0.1);
    float: left;
    padding-right: 10px;
    width: 83px;
}

.myaccount_user {
    border-left: 3px solid #787E87;
    float: right;
    padding-left: 10px;
    width: 88%;
}
view rawstyle.css hosted with ❤ by GitHub
Where can I find free video tutorials on the Storefront Theme?
We’ve produced the following free WooThemes Storefront video tutorials on a) How to set up Storefront b) How to add a parallax hero area to Storefront c) How to use the WooCommerce Storefront Customizer d) How to use the Storefront Designer.

How to customise the blog layout on the Storefront Theme
Here’s a little video tutorial that shows you how to do this. This uses the Storefront Blog customizer plugin from WooThemes.



How to find out what’s changed in the latest version of the Storefront Theme
You can view the changelog for WooThemes Storefront here.

Where can I get a free Storefront Child theme
You can download our free blank Storefront child theme here.

How to change the WooCommerce Storefront Theme Footer Height
Here’s some simple css 🙂


section.footer-widgets {
    padding-top: 25px;
}

div.site-info {
    padding-top: 16px;
    padding-bottom: 25px;
} 