<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://codecanyon.net/user/divdojo/portfolio
 * @since      1.0.0
 *
 * @package    Gravitizer_Lite
 * @subpackage Gravitizer_Lite/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Gravitizer_Lite
 * @subpackage Gravitizer_Lite/includes
 * @author     DivDojo <divdojo@gmail.com>
 */
class Gravitizer_Lite {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Gravitizer_Lite_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'GRAVITIZER_LITE_VERSION' ) ) {
			$this->version = GRAVITIZER_LITE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'gravitizer-lite';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Gravitizer_Lite_Loader. Orchestrates the hooks of the plugin.
	 * - Gravitizer_Lite_i18n. Defines internationalization functionality.
	 * - Gravitizer_Lite_Admin. Defines all hooks for the admin area.
	 * - Gravitizer_Lite_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-gravitizer-lite-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-gravitizer-lite-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-gravitizer-lite-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-gravitizer-lite-public.php';

		$this->loader = new Gravitizer_Lite_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Gravitizer_Lite_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Gravitizer_Lite_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Gravitizer_Lite_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		// Function for automatically updating this plugin
		// $this->loader->add_filter( 'auto_update_plugin', $plugin_admin, 'allow_auto_update', 10, 2 );

		// Check if plugin was updated
		$this->loader->add_action('plugins_loaded', $plugin_admin, 'if_plugin_updated');

		//Customizer
		$this->loader->add_action( 'customize_register', $plugin_admin, 'gravitizer_visual_customizer' );

		$this->loader->add_action( 'customize_preview_init', $plugin_admin, 'gravitizer_customizer_live_preview' );
		$this->loader->add_action( 'customize_controls_enqueue_scripts', $plugin_admin, 'gravitizer_customizer_control_scripts' );
		

		$this->loader->add_action( 'gform_field_appearance_settings', $plugin_admin, 'gravitizer_field_settings_items', 10, 2 );
		$this->loader->add_action( 'gform_editor_js', $plugin_admin, 'gravitizer_editor_script' );

		// Apply to all forms
		$this->loader->add_filter( 'gform_field_input', $plugin_admin, 'gravitizer_custom_input', 10, 5 );
		$this->loader->add_filter( 'gform_field_content', $plugin_admin, 'gravitizer_custom_input_content', 10, 5 );
		$this->loader->add_filter( 'gform_field_choice_markup_pre_render', $plugin_admin, 'gravitizer_choices_markup', 10, 4 );

		$this->loader->add_action( 'wp_head', $plugin_admin, 'gravitizer_customizer_css' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Gravitizer_Lite_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Gravitizer_Lite_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
