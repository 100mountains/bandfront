<?php
/**
 * Downloads Template and UI
 */
function custom_downloads_template() {
    $downloads = WC()->customer->get_downloadable_products();
    $has_downloads = (bool) $downloads;

    if ($has_downloads) {
        $grouped_downloads = array();
        
        // Group downloads by product
        foreach ($downloads as $download) {
            $product_id = $download['product_id'];
            if (!isset($grouped_downloads[$product_id])) {
                $grouped_downloads[$product_id] = array(
                    'product_name' => $download['product_name'],
                    'downloads_remaining' => $download['downloads_remaining'],
                    'access_expires' => $download['access_expires'],
                    'files' => array()
                );
            }
            $grouped_downloads[$product_id]['files'][] = $download;
        }

        // Add security nonce for AJAX calls
        wp_nonce_field('audio_conversion_nonce', 'audio_security');

        // Output grouped downloads
        foreach ($grouped_downloads as $product_id => $product) {
            echo '<div class="product-downloads" data-product-id="' . esc_attr($product_id) . '">';
            echo '<h3 class="bluu-text">' . esc_html($product['product_name']) . '</h3>';
            echo '<div class="download-info">';
            if ($product['downloads_remaining']) {
                echo '<span class="downloads-remaining">Downloads remaining: ' . esc_html($product['downloads_remaining']) . '</span>';
            }
            if ($product['access_expires']) {
                $expires = strtotime($product['access_expires']);
                echo '<span class="access-expires">Expires: ' . date('F j, Y', $expires) . '</span>';
            }
            echo '</div>';
            if (count($product['files']) > 1) {
                echo '<div class="download-all-wrapper">';
                echo '<div class="download-dropdown">';
                echo '<button class="download-all-files button alt"><span class="button-text">Download All As...</span><span class="spinner" style="display:none;margin-left:8px;vertical-align:middle;width:18px;height:18px;"></span></button>';
                echo '<div class="download-format-menu">';
                echo '<a href="#" data-format="wav" class="format-option alacti-text">WAV (Original)</a>';
                echo '<a href="#" data-format="mp3" class="format-option alacti-text">MP3</a>';
                echo '<a href="#" data-format="flac" class="format-option alacti-text">FLAC</a>';
                echo '<a href="#" data-format="aiff" class="format-option alacti-text">AIFF</a>';
                echo '<a href="#" data-format="alac" class="format-option alacti-text">ALAC</a>';
                echo '<a href="#" data-format="ogg" class="format-option alacti-text">OGG Vorbis</a>';
                echo '</div></div>';
                // Caret button directly under dropdown
                echo '<button class="expand-button" aria-expanded="false" aria-controls="files-' . esc_attr($product_id) . '" style="display:block;margin:0.5em auto 1em auto;background:none;border:none;color:#ffd700;font-size:1.5em;cursor:pointer;">▼</button>';
                echo '</div>';
            }
            // Product files list, hidden by default
            echo '<ul class="download-files" id="files-' . esc_attr($product_id) . '" style="display:none;">';
            foreach ($product['files'] as $file) {
                echo '<li class="download-file">';
                echo '<a href="' . esc_url($file['download_url']) . '" class="woocommerce-MyAccount-downloads-file">';
                echo esc_html($file['file']['name']);
                echo '</a>';
                echo '</li>';
            }
            echo '</ul>';
            echo '</div>';
        }
    }
}

// Replace default downloads template with custom one
remove_action('woocommerce_available_downloads', 'woocommerce_order_downloads_table', 10);
add_action('woocommerce_available_downloads', 'custom_downloads_template', 10);

function enqueue_downloads_styles() {
    if (is_account_page()) {
        wp_enqueue_style('downloads-style', get_stylesheet_directory_uri() . '/downloads.css', array(), '1.0');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_downloads_styles');
?>
