# Bandfront

A WordPress child theme extension for Storefront that transforms WooCommerce into a Bandcamp-like platform for musicians. Bandfront enables bands to sell and distribute digital music with professional audio processing and download management capabilities.

## Features

- **Parent & Child Stylesheet Enqueue:**  
  Loads both parent and child theme stylesheets in the correct order.

- **WooCommerce Product Image Zoom Disabled:**  
  Removes the zoom feature from WooCommerce product images.

- **Breadcrumbs Removed:**  
  Disables default WooCommerce breadcrumbs.

- **Blocked Email Registration:**  
  - Prevents registration for emails listed in `blocked-emails.txt`.

### Setting up blocked emails  
Create a `blocked-emails.txt` file in the theme root with one email address per line.  
The file is listed in `.gitignore`, so it will never be committed to the repository.  
This allows each installation to maintain its own private block list.

- **Custom Styles and Scripts:**  
  - Enqueues custom CSS for downloads UI.
---

## Installation

1. **Prerequisites**:
   - WordPress installation
   - WooCommerce plugin installed and activated
   - Storefront parent theme installed
   - Music Player for WooCommerce (recommended for audio preview)

2. **Theme Installation**:
   ```bash
   cd /wp-content/themes/
   git clone https://github.com/yourusername/bandfront.git storefront-child
   ```

3. **Activate the Theme**:
   - Go to WordPress Admin → Appearance → Themes
   - Activate "Storefront Child"

## File Structure

```
bandfront/
├── style.css                 # Child theme styles and custom CSS
├── functions.php             # Theme functions and WooCommerce integration
├── audio-processing.php      # Audio format conversion and validation
├── downloads-template.php    # Customer download interface
├── downloads.css             # Download interface styling
├── js/
│   └── download-all.js       # Frontend JavaScript for download interactions
├── myaccount-vault.php       # Custom Vault tab content for My Account
├── blocked-emails.txt        # List of blocked emails for registration
└── README.md                 # Project documentation
```

## Usage

### For Store Owners
1. **Add Digital Products**: Create WooCommerce products with digital downloads.
2. **Upload Audio Files**: Add your master audio files to products.
3. **Configure Formats**: Set which audio formats to offer customers.
4. **Manage Downloads**: Monitor customer downloads through WooCommerce.

### For Customers
1. **Purchase Music**: Buy digital albums or tracks through your store.
2. **Access Downloads**: Visit "My Account" → "Downloads".
3. **Choose Format**: Select preferred audio format from dropdown.
4. **Download**: Get high-quality audio files instantly.

## Security Features

- **Nonce Verification**: CSRF protection for all AJAX requests.
- **User Authentication**: Download access restricted to logged-in customers.
- **File Validation**: Audio format verification before processing.
- **Capability Checks**: User permission validation.
- **Error Logging**: Comprehensive logging for debugging.

## Requirements

- **WordPress**: 5.0 or higher
- **PHP**: 7.4 or higher
- **WooCommerce**: 5.0 or higher
- **Storefront Theme**: Latest version
- **Server**: Audio processing capabilities (FFmpeg recommended)

## License

This project is not licensed.

---

**Transform your WordPress site into a professional music distribution platform with Bandfront!** 🎸🥁🎹

WARP TERMINAL:

** Get Warp Terminal to admin your server - make sure you know wtf its doing :) 
