<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.nickyreinert.de
 * @since             1.0.0
 * @package           Coii
 *
 * @wordpress-plugin
 * Plugin Name:       Cookie-OptIn-Interface
 * Plugin URI:        https://www.nickyreinert.de/coii
 * Description:       Allow users to decide whether being tracked or not
 * Version:           1.1.1
 * Author:            Nicky Reinert
 * Author URI:        https://www.nickyreinert.de
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       coii
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'COII_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-coii-activator.php
 */
function activate_coii() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-coii-activator.php';
	Coii_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-coii-deactivator.php
 */
function deactivate_coii() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-coii-deactivator.php';
	Coii_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_coii' );
register_deactivation_hook( __FILE__, 'deactivate_coii' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-coii.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_coii() {

	$plugin = new Coii();
	$plugin->run();

}



/**
*	log function to send debug information to browser console
*
*/

function debug_coii($message = NULL, $priority = 1 ){
	// TODO implement on options page
	// on settings page, debug level will be defined
	// MAX_DEBUG_PRIORITY = 0 - no messages at all
	// MAX_DEBUG_PRIORITY = 1 - errors & warnings only
	// MAX_DEBUG_PRIORITY = 2 - every piece of information

	if ($priority >= 1) {

		$message = json_encode($message, JSON_PRETTY_PRINT);

		echo "<script>console.log('COII|DEBUG: ' + ".$message.");</script>";

	}
}

run_coii();
