<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.nickyreinert.de
 * @since      1.0.0
 *
 * @package    Coii
 * @subpackage Coii/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Coii
 * @subpackage Coii/public
 * @author     Nicky Reinert <mail@nickyreinert.de>
 */
class Coii_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;


	}

	/**
	 * For testing purposes only to force the control cookie.
	 *
	 * @since    1.0.0
	 * @param      string    $allow_tracking_pixel       whether or not to allow tracking
	 */

	public function set_control_cookie($allow_tracking_pixel = FALSE) {

		if ($allow_tracking_pixel === FALSE) {

			setcookie('coii_allow_tracking_pixel', 'no', (time()+3600));

		} else {

			setcookie('coii_allow_tracking_pixel', 'yes', (time()+3600));
		}

	}

	/**
	 * Get tracking pixels from users options and prepare them for output
	 *
	 * @since    1.0.0
	 * @param      string    $tracking_pixel_array      the prepared tracking pixels
	 */

	public function get_tracking_pixel_array() {

		$default_tracking_pixel = NULL;

		$dirty_tracking_pixel  = get_option('coii_tracking_pixel',  $default_tracking_pixel, NULL);

		$dirty_tracking_pixel_doc = new DOMDocument();

		$dirty_tracking_pixel_doc->loadHTML($dirty_tracking_pixel);

		$tracking_pixel_array = array();

		foreach($dirty_tracking_pixel_doc->getElementsByTagName('script') as $script_index => $dirty_script) {

			if ($dirty_script->getAttribute('src') != NULL) {

				$tracking_pixel_array[$script_index]['src'] = $dirty_script->getAttribute('src');

			} else {

				$tracking_pixel_array[$script_index]['src'] = FALSE;

			}

			$tracking_pixel_array[$script_index]['text'] = str_replace("\n", "", str_replace("\r", "", str_replace("'", "\"", $dirty_script->textContent)));

		}

		return $tracking_pixel_array;

	}

	/**
	 * Display the COII dialogue at the front page
	 *
	 * @since    1.0.0
	 * @param      string    $tracking_pixel       the user defined tracking pixel
	 */

	public function show_coii_dialogue() {

		$tracking_pixel_array = $this->get_tracking_pixel_array();

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/coii-public.css', array(), $this->version, 'all' );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/coii-public.js', array( 'jquery' ), $this->version, false );

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/coii-public-display.php';

	}

	/**
	 * Condition checker to check if COII cookie is set and if so
	 * if tracking is enabled
	 * this is called in includes/class-coii.php
	 *
	 * @since    1.0.0
	 * @param      string    $allow_tracking_pixel       whether or not to allow tracking
	 */

	public function set_tracking_pixel($tracking_pixel_array) {

		if(!isset($_COOKIE['coii_allow_tracking_pixel'])) {

			// NO COII COOKIE FOUND, SO SHOW THE OPT IN DIALOGUE

			$this->show_coii_dialogue();

		} else {

			// COII COOKIE FOUND, CHECK IF TRACKING IS ENABLED

			if ($_COOKIE['coii_allow_tracking_pixel'] === 'yes') {

				// ECHO TRACKING PIXEL
				echo '<script>(function( $ ) {"use strict";';
				$tracking_pixel_array = $this->get_tracking_pixel_array();

				foreach ($tracking_pixel_array as $script_index => $tracking_script) { ?>

					var script<?php echo $script_index; ?> = document.createElement("script");

					<?php if ($tracking_script['src'] != FALSE) { ?>

						$(script<?php echo $script_index; ?>).attr('src', '<?php echo $tracking_script['src']; ?>');

					<?php } ?>

					script<?php echo $script_index; ?>.innerHTML = '<?php echo $tracking_script['text']; ?>';

					document.body.appendChild(script<?php echo $script_index; ?>);

				<?php }

				echo '})( jQuery );</script>';
			}

		}

	}


	/**
	 * Register the shortcode that shows the dialogue at any given page
	 * this is called in includes/class-coii.php
	 *
	 * @since    1.0.0
	 */
	public function register_shortcode() {

		$this->show_coii_dialogue();

	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 * this is called in includes/class-coii.php
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Coii_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Coii_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/coii-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 * this is called in includes/class-coii.php
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Coii_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Coii_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/coii-public.js', array( 'jquery' ), $this->version, false );

	}

}
