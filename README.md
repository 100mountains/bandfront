# Bandfront

A WordPress child theme extension for Storefront that transforms WooCommerce into a Bandcamp-like platform for musicians. Bandfront enables bands to sell and distribute digital music with professional audio processing and download management capabilities.

## Features

### 🎵 Music Distribution
- **Multi-format Audio Processing**: Convert and serve audio in multiple formats (WAV, MP3, FLAC, AIFF, ALAC, OGG)
- **Bulk Audio Conversion**: Process entire albums or collections with one click
- **Download Management**: Organized customer downloads with format selection
- **Audio Format Validation**: Security-focused file handling with format verification

### 🎨 Band-Focused Design
- **Storefront Child Theme**: Extends the popular Storefront theme with music-specific features
- **Clean Download Interface**: User-friendly download dropdowns with format options
- **Responsive Design**: Mobile-optimized for fans accessing music on any device
- **Customizable Styling**: Easy-to-modify CSS for brand consistency

### 🔧 WooCommerce Integration
- **Digital Product Support**: Seamless integration with WooCommerce digital downloads
- **Customer Account Integration**: Downloads accessible through standard WooCommerce accounts
- **Purchase Protection**: Secure download links with user authentication
- **Download Limits**: Respect WooCommerce download count and expiration settings

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
├── workspace/                # Development workspace (can be excluded)
└── deploy-to-theme.sh        # Development deployment script
```

## Usage

### For Store Owners
1. **Add Digital Products**: Create WooCommerce products with digital downloads
2. **Upload Audio Files**: Add your master audio files to products
3. **Configure Formats**: Set which audio formats to offer customers
4. **Manage Downloads**: Monitor customer downloads through WooCommerce

### For Customers
1. **Purchase Music**: Buy digital albums or tracks through your store
2. **Access Downloads**: Visit "My Account" → "Downloads"
3. **Choose Format**: Select preferred audio format from dropdown
4. **Download**: Get high-quality audio files instantly

## Security Features

- **Nonce Verification**: CSRF protection for all AJAX requests
- **User Authentication**: Download access restricted to logged-in customers
- **File Validation**: Audio format verification before processing
- **Capability Checks**: User permission validation
- **Error Logging**: Comprehensive logging for debugging

## Requirements

- **WordPress**: 5.0 or higher
- **PHP**: 7.4 or higher
- **WooCommerce**: 5.0 or higher
- **Storefront Theme**: Latest version
- **Server**: Audio processing capabilities (FFmpeg recommended)

## License

This project is licensed under the GNU General Public License v2 or later.

---

**Transform your WordPress site into a professional music distribution platform with Bandfront!** 🎸🥁🎹
