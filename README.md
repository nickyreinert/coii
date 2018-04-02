## COII - Cookie-Opt-In-Interface for Wordpress

COII offers the visitor of your blog to choose between enabling or disabling tracking by, for example, Google Analytics.

### Description

When a user visits your site for the first time, a dialogue will pop up. The user has to decide whether he allows the usage of tracking or not.

The plugin requires you to add your tracking pixel in the backend. You also may define the message, the user will see.

Besides you can use the shortcode [coii_dialogue] to place the dialogue inside any page or post.

### Installation

1. Upload `coii` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place the shortcode [coii_dialogue] inside any given page or post, if required
4. Edit the dialogue text and insert your tracking pixel

### Known bugs

COII offers default values for the dialogue, but you have to save them for yourself. Go to the settings-page of this plugin (Settings / Cookie-OptIn-Interface) and simply push the save-button. Or edit the message text.

### Changelog

#### 1.1.2
* fix: empty po/mo-files, wrong i18n-folder declaration

#### 1.1.1
* fix: pixels not fired after cookies was set
* add: default text
* fix: plenk / header already sent

#### 1.1.0
* add: do not reload page after user confirm tracking
* add: german translation
* add: support for more than one tracking-pixel
* add: support for new Google's global site tag
* fix: shortcodes-engine throws an notice because of missing property
* remove: debugging messages, as there currently is no debug-flag in the backend

#### 1.0.2
* fix: wrong domain cookie
* add: default values for dialogue text, yes-no-buttons

#### 1.0.1
* fatal error when installing plugin because hook-function „add“
requires 6 instead of 4 parameters
* renamed debug-functions globally
* changed short description text

#### 1.0
* first release with all basic features
* opt-in dialogue for first-time visitors
* shortcode to be used on pages / posts to opt-in for tracking
* options page with custom tracking-code and customizable opt-in-message
