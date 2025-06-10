
Description
Features of the Music Player for WooCommerce, Dokan, WCFM Marketplace, and MultivendorX:

♪ Integrate a music player into the WooCommerce products, Dokan, WCFM Marketplace, and MultivendorX
♪ Includes an audio player that supports formats: OGA, MP3, WAV, WMA
♪ Supports M3U, M3U8 playlists
♪ Includes multiple skins for the Music Player
♪ Supports all most popular web browsers and mobile devices
♪ Includes a widget to insert a playlist on sidebars
♪ Includes a block to insert the playlists on pages using Gutenberg
♪ Includes a widget to insert the playlists on pages using Elementor
♪ Includes a widget for inserting the playlists on pages with Page Builder by SiteOrigin
♪ Includes a control for inserting the playlists on pages with BeaverBuilder
♪ Includes an element for inserting the playlists on pages with Visual Composer
♪ Includes a module for inserting the playlists on pages with DIVI

Note: for the other editors, insert directly the playlists’ shortcodes.

Music Player for WooCommerce includes the MediaElement.js music player in the pages of the products with audio files associated, and in the store’s pages. It allows the integration with the multivendor stores generated with Dokan, WCFM Marketplace, and MultivendorX. Furthermore, the plugin allows selecting between multiple skins.

MediaElement.js is an music player compatible with all major browsers: Internet Explorer, Firefox, Opera, Safari, Chrome and mobile devices: iPhone, iPad, Android. The music player is developed following the html5 standard. The music player supports the following file formats: MP3, WAV, WMA and OGA.

The basic version of the plugin, available for free from the WordPress Directory, has the features needed to include a music player in the pages of the products and the store.


Premium Features

Allows playing the audio files in secure mode to prevent unauthorized downloading of the audio files.
Allows to define the percent of the audio file’s size to be played in secure mode.

Supports integration with plugins:

WooCommerce
Dokan
WCFM – Marketplace
WC Vendors
MultivendorX
Advanced AJAX Product Filters by berocket
Load More Products for WooCommerce by berocket
Themify – WooCommerce Product Filter by Themify
YITH WooCommerce Ajax Product Filter by YITH
WOOF – Products Filter for WooCommerce by realmag777
Product Filter by WooBeWoo
Support post_type like auctions, included by third-party plugins.

And third-party players like:

Compact Audio Player
CP Media Player
HTML5 Audio Player
MP3 jPlayer
Interface
Global Settings of Music Players

The global settings are accessible through the menu option: “Settings/Music Player for WooCommerce”.

Include music player in all all products: checkbox to include the music player in all products.
Include in: radio button to decide where to display the music player, in pages with a single entry, multiple entries, or both (both cases by default).
Include players in cart: checkbox to include the music players on the cart page or not.
Merge in grouped products: in grouped products, display the “Add to cart” buttons and quantity fields in the players rows.
Player layout: list of available skins for the music player.
Show a single player instead of one player per audio file.
Preload: to decide if preload the audio files, their metadata, or don’t preload nothing at all.
Play all: play all players in the page (one after the other).
Loop: plays the audio player on the product page in a loop.
Player controls: determines the controls to include in the music player.
Display the player’s title: show/hide the name associated to the downloadable file.
Protect the file: checkbox to playback the songs in secure mode (only available in the pro version of the plugin).
Percent of audio used for protected playbacks: integer number from 0 to 100, that represents the percent of the size of the original audio file that will be used in the audio file for demo (only available in the pro version of the plugin).
Apply the previous settings to all products pages in the website: tick the checkbox to apply the previous settings to all products overwriting the products’ settings.
Google Analytics Integration

Tracking id: Enter the tracking id in the property settings of Google Analytics account.
Setting up the Music Players through the products’ pages

The Music Players are configured from the products pages, the Dokan interface, WCFM Marketplace, and MultivendorX.

Settings Interface

Include music player: checkbox to include the music player in the product’s page, or not.
Include in: radio button to decide where to display the music player, in pages with a single entry, multiple entries, or both (both cases by default).
Merge in grouped products: in grouped products, display the “Add to cart” buttons and quantity fields in the players rows.
Player layout: list of available skins for the music player.
Show a single player instead of one player per audio file.
Preload: to decide if preload the audio files, their metadata, or don’t preload nothing at all.
Play all: play all players in the page (one after the other).
Loop: plays the audio player on the product page in a loop.
Player controls: determines the controls to include in the music player.
Display the player’s title: show/hide the name associated to the downloadable file.
Protect the file: checkbox to playback the songs in secure mode (only available in the pro version of the plugin).
Percent of audio used for protected playbacks: integer number from 0 to 100, that represents the percent of the size of the original audio file that will be used in the audio file for demo (only available in the pro version of the plugin).
Select my own demo files: checkbox to use different audio files for demo, than the audio files for selling (only available in the pro version of the plugin).
Demo files: section similar to the audio files for selling, but in this case it allows to select different audio files for demo, and their names (only available in the pro version of the plugin).

How the Pro version of the Music Player for WooCommerce protect the audio files?

If the “Protect the file” checkbox was ticked in the product’s page, and was entered an integer number through the attribute: “Percent of audio used for protected playbacks”, the plugin will create a truncated copy of the audio files for selling (or the audio files for demo) into the “/wp-content/plugins/wcmp” directory, to be used as demo. The sizes of the audio files for demo are a percentage of the sizes of the original files (the integer number entered in the player’s settings). So, the users cannot access to the original audio files, from the public pages of the products.

Music Player for WooCommerce – Playlist Widget

The widget allows to include a playlist on sidebars, with the downloadable files associated to all products with the music player enabled, or for only some of the products.

The widget settings:

Title: the title of the widget on sidebar.
Products IDs: enter the ids of products to include in the playlist, separated by comma, or the * symbol to include all products.
Playlist layout: select between the new playlist layout and the original one.
Player layout: select the layout of music players (the widget uses only the play/pause control)
Preload: to decide if preload the audio files, their metadata, or don’t preload nothing at all. This attribute has a global scope, and will modify the default settings.
Play all: play all players in the page (one after the other). This attribute has a global scope, and will modify the default settings.
Highlight the current product: if the checkbox is ticked, and the user is in the page of a product, and it is included in the playlist, the corresponding item would be highlighted in the playlist.
Continue playing after navigate: if the checkbox is ticked, and there is a song playing when navigates, the player will continue playing after loading the webpage, in the same position.
Note: In mobiles devices where the direct action of user is required for playing audios and videos, the plugin cannot start playing dynamically.

Music Player for WooCommerce – [wcmp-playlist] shortcode

The [wcmp-playlist] shortcode allows to include a playlist on the pages’ contents, with all products, or for some of them.

The shortcode attributes are:

products_ids: enter the ids of products to include in the playlist, separated by comma, or the * symbol to include all products

[wcmp-playlist products_ids="*"]
title: enter the title text to display prominently above the playlist

[wcmp-playlist products_ids="*" title="My Playlist"]
product_categories: this feature enables you to load all products belonging to one or multiple categories at once, eliminating the need to enter their IDs individually. To filter by product categories, simply input their slugs, separated by commas

[wcmp-playlist products_ids="*" product_categories="category-1,category-2"]
product_tags: just like filtering by product categories, you can also filter products by tags. To do this, simply enter the tag slugs, separated by commas

[wcmp-playlist products_ids="*" product_tags="tag-1,tag-2"]
layout: allows to select the new or original layouts with the values: new or classic (“new” is the value by default)

[wcmp-playlist products_ids="*" layout="new"]
player_style: select the layout of music players (the playlist displays only the play/pause control)

[wcmp-playlist products_ids="*" player_style="mejs-classic"]
highlight_current_product: if the playlist is included in a product’s page, the corresponding item would be highlighted in the playlist

[wcmp-playlist products_ids="*" highlight_current_product="1"]
continue_playing: if there is a song playing when navigates, the player will continue playing after loading the webpage in the same position

[wcmp-playlist products_ids="*" continue_playing="1"]
Note: In mobiles devices where the direct action of user is required for playing audios and videos, the plugin cannot start playing dynamically.

controls: allows to configure the controls to be used with the players on playlist. The possible values are: track or all, to include only a play/pause button or all player’s controls respectively:

[wcmp-playlist products_ids="*" controls="track"]
loop: plays all playlist items in an endless loop. The accepted values are: 1 or 0

[wcmp-playlist products_ids="*" loop="1"]
cover: allows to include the featured images in the playlist. The possible values are: 0 or 1, 0 is the value by default

[wcmp-playlist products_ids="*" cover="1"]
purchased_only: includes only the audio files associated with the purchased products (Plugin commercial version)

[wcmp-playlist products_ids="*" purchased_only="1"]
purchased_products: generates the list of products purchased by the logged user (Plugin commercial version)

[wcmp-playlist purchased_products="1"]
Hooks (actions and filters)

wcmp_before_player_shop_page: action called before the players containers in the shop pages.
wcmp_after_player_shop_page: action called after the players containers in the shop pages.
wcmp_before_players_product_page: action called before the players containers in the products pages.
wcmp_after_players_product_page: action called after the players containers in the products pages.

wcmp_audio_tag: filter called when the audio tag is generated. The callback function receives four parameters: the audio tag, the product’s id, the file’s id, URL to the audio file;

wcmp_file_name: filter called when the file’s name is included with the player. The callback function receives three parameters: the file’s name, the product’s id, and the file’s id;

wcmp_widget_audio_tag: filter called when the audio tag is generated as a widget on sidebars. The callback function receives four parameters: the audio tag, the product’s id, the file’s id, URL to the audio file;

wcmp_widget_file_name: filter called when the file’s name is included with the player as a widget on sidebars. The callback function receives three parameters: the file’s name, the product’s id, and the file’s id;

wcmp_purchased_product: filter called to know if the product was purchased or not. The callback function receives two parameters: false and the product’s id.

wcmp_ffmpeg_time: filter called to determine the duration of truncated copies of the audio files for demos when the FFmpeg application is used to generate them.

Other recommended plugins

If your project is a music store, and WooCommerce is more than you need it is possible to use Music Store plugin
Or if you need a general purpose music and video player, not especific for WooCommerce, CP Media Player – Audio Player and Video Player plugin
Screenshots
Blocks
This plugin provides 1 block.

WooCommerce Music Player Playlist
FAQ
Q: Why the audio file is played partially?
Q: Why the music player is not loading on page?
Q: What can I do if the woocommerce_music_player directory exists and the premium version of plugin cannot be installed?
Q: Can be modified the size of audio files played in secure mode?
Contributors & Developers
“Music Player for WooCommerce” is open source software. The following people have contributed to this plugin.