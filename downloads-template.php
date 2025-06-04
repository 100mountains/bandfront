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
            // Get product image URL
            $product_obj = wc_get_product($product_id);
            $image_url = $product_obj ? wp_get_attachment_image_url($product_obj->get_image_id(), 'thumbnail') : '';
            echo '<div class="product-downloads" data-product-id="' . esc_attr($product_id) . '" style="background:#181818;padding:1.5em 1.5em 1em 1.5em;border-radius:12px;margin-bottom:2em;">';
            // Flex row for info and image
            echo '<div style="display:flex;align-items:center;justify-content:space-between;">';
            echo '<div style="flex:1;min-width:0;">';
            echo '<h3 class="bluu-text" style="margin-top:0;">' . esc_html($product['product_name']) . '</h3>';
            echo '<div class="download-info">';
            if ($product['downloads_remaining']) {
                echo '<span class="downloads-remaining">Downloads remaining: ' . esc_html($product['downloads_remaining']) . '</span>';
            }
            if ($product['access_expires']) {
                $expires = strtotime($product['access_expires']);
                echo '<span class="access-expires">Expires: ' . date('F j, Y', $expires) . '</span>';
            }
            echo '</div>';
            echo '</div>';
            if ($image_url) {
                echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($product['product_name']) . '" style="max-width:140px;max-height:140px;margin-left:1.5em;border-radius:8px;box-shadow:0 2px 12px rgba(0,0,0,0.18);object-fit:cover;">';
            }
            echo '</div>';
            if (count($product['files']) > 1) {
                // Dropdown and caret inside the background box
                echo '<div class="download-all-wrapper" style="display:flex;align-items:center;justify-content:space-between;margin-top:1em;">';
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
                echo '<button class="expand-button" aria-expanded="false" aria-controls="files-' . esc_attr($product_id) . '" style="margin-left:1em;background:none;border:none;color:#ffd700;font-size:1.2em;cursor:pointer;align-self:center;">▼</button>';
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
