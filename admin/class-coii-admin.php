<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.nickyreinert.de
 * @since      1.0.0
 *
 * @package    Coii
 * @subpackage Coii/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Coii
 * @subpackage Coii/admin
 * @author     Nicky Reinert <mail@nickyreinert.de>
 */
class Coii_Admin {

	/**
		 * The options name to be used in this plugin
		 *
		 * @since  	1.0.0
		 * @access 	private
		 * @var  	string 		$option_name 	Option name of this plugin
		 */
	private $option_name = 'coii';

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
		 * The default dialogue text
		 *
		 * @since  	1.0.0
		 * @access 	private
		 * @var  	string 		$default_dialogue_text 	default dialogue text
		 */
	private $default_dialogue_text = NULL;

		/**
		 * The default text for the accept button
		 *
		 * @since  	1.0.0
		 * @access 	private
		 * @var  	string 		$default_yes_button_text 	default accept button text
		 */
	private $default_yes_button_text = 'yes';

		/**
		 * The The default text for the disallow button
		 *
		 * @since  	1.0.0
		 * @access 	private
		 * @var  	string 		$default_no_button_text 	default disallow button text
		 */
	private $default_no_button_text = 'no';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->default_dialogue_text = __('Do you want to help us improving user experience by allowing tracking with Matomo / Piwik?', 'coii');

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/coii-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/coii-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page()
	{

		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Cookie-OptIn-Interface Settings', 'coii' ),
			__( 'Cookie-OptIn-Interface', 'coii' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);

	}

	/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function display_options_page()
	{

		include_once 'partials/coii-admin-display.php';

	}

	public function register_setting()
	{
		/*
			display introducing text
		*/
		add_settings_section(
			$this->option_name . '_general',
			__( 'General', 'coii' ),
			array( $this, $this->option_name . '_general' ),
			$this->plugin_name
		);

		/*
		 *      TRACKING-PIXEL
		 * */

		add_settings_field(
			$this->option_name . '_tracking_pixel',
			__( 'Tracking-Pixel', 'coii' ),
			array( $this, $this->option_name . '_tracking_pixel_text' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_tracking_pixel' )
		);

		register_setting(
			$this->plugin_name,	// thats the settings page, see 4th param in add_settings_field
			$this->option_name . '_tracking_pixel' // name of the setting, first param in add_settings_field
		);

		/*
		 *      DIALOGUE-TEXT
		 * */

		add_settings_field(
			$this->option_name . '_dialogue',
			__( 'Dialogue Text', 'coii' ),
			array( $this, $this->option_name . '_dialogue_text' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_dialogue' )
		);

		register_setting(
			$this->plugin_name,	// thats the settings page, see 4th param in add_settings_field
			$this->option_name . '_dialogue' // name of the setting, first param in add_settings_field
		);

		/*
		 * YES-BUTTON
		 * */

		add_settings_field(
			$this->option_name . '_yes_button',
			__( 'Yes Button', 'coii' ),
			array( $this, $this->option_name . '_yes_button_text' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_yes_button' )
		);

		register_setting(
			$this->plugin_name,	// thats the settings page, see 4th param in add_settings_field
			$this->option_name . '_yes_button' // name of the setting, first param in add_settings_field
		);

		/*
		 * NO-BUTTON
		 * */

		add_settings_field(
			$this->option_name . '_no_button',
			__( 'No Button', 'coii' ),
			array( $this, $this->option_name . '_no_button_text' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_no_button' )
		);

		register_setting(
			$this->plugin_name,	// thats the settings page, see 4th param in add_settings_field
			$this->option_name . '_no_button' // name of the setting, first param in add_settings_field
		);

	}

	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function coii_general()
	{
		echo '<p>' . __( 'Please add all tracking pixel of your tracking service (Matomo/Piwik, Google Analytics). Just add the complete script including it`s wrapping < script > - Tags', 'coii' ) . '</p>';
	}

	/**
	**
	 * Render the text field for the tracking pixel
	 *
	 * @since  1.0.0
	 */
	public function coii_tracking_pixel_text() {

		$tracking_pixel = get_option( $this->option_name . '_tracking_pixel', NULL);
		echo '<textarea name="' . $this->option_name . '_tracking_pixel' . '" id="' . $this->option_name . '_tracking_pixel' . '" cols="50" rows="10"> ';
		echo $tracking_pixel;
		echo '</textarea>';

	}

	/**
	 **
	 * Render the text field for the coii dialogue
	 *
	 * @since  1.0.0
	 */
	public function coii_dialogue_text() {

		$dialogue_text = get_option( $this->option_name . '_dialogue', NULL);

		if ($dialogue_text == '') {

			$dialogue_text = $this->default_dialogue_text;

		}

		echo '<textarea name="' . $this->option_name . '_dialogue' . '" id="' . $this->option_name . '_dialogue' . '" cols="50" rows="10"> ';
		echo $dialogue_text;
		echo '</textarea>';

	}

	/**
	 **
	 * Render the text field for the yes-button
	 *
	 * @since  1.0.0
	 */
	public function coii_yes_button_text() {

		$yes_button_text = get_option( $this->option_name . '_yes_button', NULL);

		if ($yes_button_text == '') {

			$yes_button_text = $this->default_yes_button_text;

		}

		echo '<input type="text" value="'.$yes_button_text.'"name="' . $this->option_name . '_yes_button' . '" id="' . $this->option_name . '_yes_button' . '"/> ';
	}

	/**
	 **
	 * Render the text field for the no-button
	 *
	 * @since  1.0.0
	 */
	public function coii_no_button_text() {

		$no_button_text = get_option( $this->option_name . '_no_button', NULL);

		if ($no_button_text == '') {

			$no_button_text = $this->default_no_button_text;

		}

		echo '<input type="text" value="'.$no_button_text.'" name="' . $this->option_name . '_no_button' . '" id="' . $this->option_name . '_no_button' . '"/> ';

	}


}
