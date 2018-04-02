<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.nickyreinert.de
 * @since      1.0.0
 *
 * @package    Coii
 * @subpackage Coii/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Coii
 * @subpackage Coii/includes
 * @author     Nicky Reinert <mail@nickyreinert.de>
 */
class Coii_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'coii',
			false,
			basename( plugin_dir_path(  dirname( __FILE__ , 1) ) ).'/languages/'
		);

	}



}
