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
	 * Display the COII dialogue at the front page
	 *
	 * @since    1.0.0
	 * @param      string    $allow_tracking_pixel       whether or not to allow tracking
	 */

	public function show_coii_dialogue() {

		debug('showing dialogue');

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/coii-public.css', array(), $this->version, 'all' );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/coii-public.js', array( 'jquery' ), $this->version, false );

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/coii-public-display.php';

	}


	public function set_tracking_pixel() {

		// TODO - implement default tracking pixel? Maybe not, maybe yes

		$default_tracking_pixel = NULL;

		$tracking_pixel  = get_option('coii_tracking_pixel',  $default_tracking_pixel, NULL);

		if(!isset($_COOKIE['coii_allow_tracking_pixel'])) {

			debug('control cookie not set');

			$this->show_coii_dialogue();

		} else {

			debug('control cookie is set');

			if ($_COOKIE['coii_allow_tracking_pixel'] === 'yes') {

				debug('enabling tracking by setting up the pixel');

				echo '<script>'.$tracking_pixel.'</script>';

			} else {

				debug('disabled tracking, no action to take');

			}

		}

	}

	public function register_shortcode() {

		$this->show_coii_dialogue();
	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
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
