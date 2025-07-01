<?php
/**
 * Audio Processing Security and Validation
 */
function validate_audio_format($format) {
    $allowed_formats = ['wav', 'mp3', 'flac', 'aiff', 'alac', 'ogg'];
    return in_array(strtolower($format), $allowed_formats) ? strtolower($format) : false;
}

function handle_bulk_audio_processing() {
    // Enable error reporting for debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    // Security checks
    if (!is_user_logged_in()) {
        wp_send_json_error('User not logged in');
        return;
    }
    
    if (!current_user_can('read')) {
        wp_send_json_error('User lacks read capability');
        return;
    }

    if (!check_ajax_referer('audio_conversion_nonce', 'security', false)) {
        error_log('Nonce verification failed in handle_bulk_audio_processing');
        wp_send_json_error('Invalid security token - Please refresh the page');
        return;
    }

    // Get parameters
    $format = isset($_POST['format']) ? sanitize_text_field($_POST['format']) : '';
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

    if (!$format || !$product_id) {
        wp_send_json_error('Missing required parameters');
        return;
    }

    // Validate format
    $valid_format = validate_audio_format($format);
    if (!$valid_format) {
        wp_send_json_error('Invalid audio format');
        return;
    }

    // Check if FFmpeg is available
    $ffmpeg_test = shell_exec('which ffmpeg 2>&1');
    if (empty($ffmpeg_test)) {
        error_log('FFmpeg not found on system');
        wp_send_json_error('FFmpeg is not installed on the server');
        return;
    }

    try {
        // Get user's downloadable files for this product
        $downloads = WC()->customer->get_downloadable_products();
        error_log('=== DEBUG: All WC downloads for customer ===');
        error_log(print_r($downloads, true));
        $product_files = array();
        
        foreach ($downloads as $download) {
            if ($download['product_id'] == $product_id) {
                $product_files[] = $download;
            }
        }
        error_log('=== DEBUG: Filtered product_files for product_id ' . $product_id . ' ===');
        error_log(print_r($product_files, true));

        if (empty($product_files)) {
            wp_send_json_error('No files found for this product');
            return;
        }

        // Sort product_files by filename to ensure correct order and inclusion
        usort($product_files, function($a, $b) {
            return strcmp($a['file']['file'], $b['file']['file']);
        });

        // Create unique temp directory
        $temp_id = uniqid('audio_convert_');
        $temp_dir = sys_get_temp_dir() . '/' . $temp_id;
        
        // Setup WooCommerce upload directory
        $upload_dir = wp_upload_dir();
        $woo_upload_dir = $upload_dir['basedir'] . '/woocommerce_uploads';
        
        error_log('Upload directory: ' . $woo_upload_dir);
        error_log('Temp directory: ' . $temp_dir);
        
        if (!file_exists($woo_upload_dir)) {
            wp_mkdir_p($woo_upload_dir);
        }
        
        if (!wp_mkdir_p($temp_dir) || !wp_mkdir_p($woo_upload_dir)) {
            wp_send_json_error('Failed to create directories');
            return;
        }

        // Get product name and sanitize for matching
        $product_name = isset($product_files[0]['product_name']) ? $product_files[0]['product_name'] : '';
        $sanitized_product_name = strtolower(preg_replace('/[^a-z0-9]+/', '-', $product_name));

        // Only process audio files
        $audio_extensions = ['wav', 'mp3', 'flac', 'aiff', 'alac', 'ogg'];
        $converted_files = array();
        $debug_info = array();

        // Build audio_files array directly from WooCommerce downloads for this product
        $audio_files = array();
        foreach ($product_files as $download) {
            $file_path = $download['file']['file'];
            $ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
            if (in_array($ext, $audio_extensions)) {
                // Try to resolve the absolute path
                $possible_paths = array();

                // If it's already an absolute path
                if (file_exists($file_path)) {
                    $possible_paths[] = $file_path;
                }

                // Try relative to uploads dir
                $upload_dir = wp_upload_dir();
                $woo_upload_dir = $upload_dir['basedir'] . '/woocommerce_uploads';
                if (strpos($file_path, '/wp-content/uploads/') === 0) {
                    $possible_paths[] = $upload_dir['basedir'] . '/' . ltrim(substr($file_path, strlen('/wp-content/uploads/')), '/');
                }
                // Try in woocommerce_uploads
                $possible_paths[] = $woo_upload_dir . '/' . basename($file_path);

                // Try with year/month structure (if present in file path)
                if (preg_match('#(\d{4})/(\d{2})#', $file_path, $matches)) {
                    $possible_paths[] = $woo_upload_dir . '/' . $matches[1] . '/' . $matches[2] . '/' . basename($file_path);
                }

                // Try with just the basename in all subdirs
                $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($woo_upload_dir));
                foreach ($rii as $file) {
                    if ($file->isFile() && $file->getFilename() === basename($file_path)) {
                        $possible_paths[] = $file->getPathname();
                    }
                }

                // Find the first existing file
                $actual_file_path = null;
                foreach ($possible_paths as $path) {
                    if (file_exists($path)) {
                        $actual_file_path = $path;
                        break;
                    }
                }
                if ($actual_file_path) {
                    $audio_files[] = $actual_file_path;
                } else {
                    $debug_info[] = 'File not found: ' . basename($file_path);
                }
            }
        }

        // Find and include the cover PNG with the nearest date to the first audio file
        if (!empty($audio_files)) {
            $first_audio = $audio_files[0];
            $first_audio_time = file_exists($first_audio) ? filemtime($first_audio) : false;
            $cover_dir = dirname($first_audio);
            $cover_files = glob($cover_dir . '/cover-*.png');
            $nearest_cover = null;
            $nearest_diff = PHP_INT_MAX;
            foreach ($cover_files as $cover_file) {
                $diff = abs(filemtime($cover_file) - $first_audio_time);
                if ($diff < $nearest_diff) {
                    $nearest_diff = $diff;
                    $nearest_cover = $cover_file;
                }
            }
            if ($nearest_cover) {
                $dest = $temp_dir . '/cover.png';
                if (copy($nearest_cover, $dest)) {
                    $converted_files[] = $dest;
                    error_log('Copied nearest cover image to: ' . $dest);
                } else {
                    error_log('Failed to copy nearest cover image: ' . $nearest_cover);
                }
            }
        }

        // Process each found audio file
        foreach ($audio_files as $actual_file_path) {
            $filename = pathinfo($actual_file_path, PATHINFO_FILENAME);
            $extension = pathinfo($actual_file_path, PATHINFO_EXTENSION);

            // --- Clean up filename for output ---
            $clean_title = $filename;
            $clean_title = preg_replace('/-[a-z0-9]{6,}$/i', '', $clean_title);
            $clean_title = preg_replace('/-DIRECTORS-COMMENTARY-\d{4}$/i', '', $clean_title);
            $clean_title = preg_replace('/-THE-ROB-REMASTER-\d{4}$/i', '', $clean_title);
            $clean_title = preg_replace('/-GAPLESS-MIX$/i', '', $clean_title);
            $clean_title = preg_replace('/--+/', '-', $clean_title);
            $clean_title = trim($clean_title, '-_ ');

            $track_title = $clean_title;
            $safe_track_title = sanitize_file_name($track_title);
            $track_number = '';
            if (preg_match('/(\d{2,3})/', $filename, $matches)) {
                $track_number = $matches[1];
            } elseif (preg_match('/(\d)/', $filename, $matches)) {
                $track_number = '0' . $matches[1];
            }
            if ($track_number !== '') {
                $output_base = $track_number . ' - ' . $safe_track_title;
            } else {
                $output_base = $safe_track_title;
            }
            $output_file = null;
            $command = null;

            switch ($valid_format) {
                case 'mp3':
                    $output_file = $temp_dir . '/' . $output_base . '.mp3';
                    $command = sprintf('ffmpeg -i %s -codec:a libmp3lame -qscale:a 2 %s -y 2>&1',
                        escapeshellarg($actual_file_path), escapeshellarg($output_file));
                    break;
                case 'flac':
                    $output_file = $temp_dir . '/' . $output_base . '.flac';
                    $command = sprintf('ffmpeg -i %s -codec:a flac %s -y 2>&1',
                        escapeshellarg($actual_file_path), escapeshellarg($output_file));
                    break;
                case 'aiff':
                    $output_file = $temp_dir . '/' . $output_base . '.aiff';
                    $command = sprintf('ffmpeg -i %s -f aiff %s -y 2>&1',
                        escapeshellarg($actual_file_path), escapeshellarg($output_file));
                    break;
                case 'alac':
                    $output_file = $temp_dir . '/' . $output_base . '.m4a';
                    $command = sprintf('ffmpeg -i %s -codec:a alac %s -y 2>&1',
                        escapeshellarg($actual_file_path), escapeshellarg($output_file));
                    break;
                case 'ogg':
                    $output_file = $temp_dir . '/' . $output_base . '.ogg';
                    $command = sprintf('ffmpeg -i %s -codec:a libvorbis -qscale:a 5 %s -y 2>&1',
                        escapeshellarg($actual_file_path), escapeshellarg($output_file));
                    break;
                case 'wav':
                    $output_file = $temp_dir . '/' . $output_base . '.wav';
                    if (copy($actual_file_path, $output_file)) {
                        $converted_files[] = $output_file;
                        error_log('Copied WAV file to: ' . $output_file);
                    } else {
                        error_log('Failed to copy WAV file');
                    }
                    continue 2;
            }

            // Execute conversion
            if ($command) {
                error_log('Executing command: ' . $command);
                $output = array();
                $return_var = 0;
                exec($command, $output, $return_var);
                
                if ($return_var !== 0) {
                    error_log('FFmpeg conversion failed with code ' . $return_var . ': ' . implode("\n", $output));
                    $debug_info[] = 'Conversion failed for ' . basename($actual_file_path);
                } else {
                    if (file_exists($output_file) && filesize($output_file) > 0) {
                        $converted_files[] = $output_file;
                        error_log('Successfully converted: ' . $output_file);
                    } else {
                        error_log('Output file not created or empty: ' . $output_file);
                        $debug_info[] = 'Output file not created for ' . basename($actual_file_path);
                    }
                }
            }
        }

        // Check if we have any converted files
        if (empty($converted_files)) {
            wp_send_json_error('No files were converted. Debug info: ' . implode(', ', $debug_info));
            return;
        }

        // Create zip file
        // Use product name for zip filename
        $product_name = sanitize_file_name($product_files[0]['product_name']);
        $zip_filename = $product_name . "_" . $valid_format . "_" . date("Y-m-d") . ".zip";
        $zip_path = $woo_upload_dir . "/" . $zip_filename;
        
        error_log('Creating zip at: ' . $zip_path);
        
        $zip = new ZipArchive();
        $zip_result = $zip->open($zip_path, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        
        if ($zip_result === TRUE) {
            $files_added = 0;
            foreach ($converted_files as $file) {
                if (is_file($file)) {
                    $added = $zip->addFile($file, basename($file));
                    if ($added) {
                        $files_added++;
                        error_log('Added to zip: ' . basename($file));
                    } else {
                        error_log('Failed to add to zip: ' . basename($file));
                    }
                }
            }
            $zip->close();
            
            error_log('Zip created with ' . $files_added . ' files');
            
            // Verify zip was created
            if (!file_exists($zip_path) || filesize($zip_path) == 0) {
                wp_send_json_error('Zip file creation failed - file does not exist or is empty');
                return;
            }
        } else {
            $error_msg = 'Failed to create zip file. Error code: ' . $zip_result;
            error_log($error_msg);
            wp_send_json_error($error_msg);
            return;
        }

        // === NEW: Move zip to public directory ===
        $public_zip_dir = $upload_dir['basedir'] . '/audio_zips';
        if (!file_exists($public_zip_dir)) {
            wp_mkdir_p($public_zip_dir);
        }
        $public_zip_path = $public_zip_dir . '/' . $zip_filename;
        if (!rename($zip_path, $public_zip_path)) {
            error_log('Failed to move zip to public directory: ' . $public_zip_path);
            wp_send_json_error('Failed to move zip to public directory');
            return;
        }
        $zip_url = $upload_dir['baseurl'] . '/audio_zips/' . $zip_filename;
        // === END NEW ===

        // Clean up temp directory
        $all_temp_files = glob($temp_dir . '/*');
        foreach ($all_temp_files as $file) {
            if (is_file($file)) {
                unlink($file);
            } elseif (is_dir($file)) {
                // Recursively remove any subdirectories (shouldn't exist, but just in case)
                array_map('unlink', glob($file . '/*'));
                rmdir($file);
            }
        }
        rmdir($temp_dir);

        // Return download URL
        wp_send_json_success([
            'message' => 'Conversion successful',
            'download_url' => $zip_url,
            'filename' => $zip_filename,
            'files_converted' => count($converted_files),
            'debug_info' => $debug_info
        ]);

    } catch (Exception $e) {
        error_log('Exception in audio processing: ' . $e->getMessage());
        wp_send_json_error('Conversion failed: ' . $e->getMessage());
    }
}
add_action('wp_ajax_handle_bulk_audio_processing', 'handle_bulk_audio_processing');
