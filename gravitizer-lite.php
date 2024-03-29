<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://codecanyon.net/user/divdojo/portfolio
 * @since             1.0.0
 * @package           Gravitizer_Lite
 *
 * @wordpress-plugin
 * Plugin Name:       Gravitizer Lite
 * Plugin URI:        https://codecanyon.net/item/gravitizer-gravity-forms-material-ui-styler/26570055
 * Description:       Convert your traditional looking Gravity Forms into Material UI in one click
 * Version:           2.0.1
 * Author:            DivDojo
 * Author URI:        https://codecanyon.net/user/divdojo/portfolio
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gravitizer-lite
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
define( 'GRAVITIZER_LITE_VERSION', '2.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-gravitizer-lite-activator.php
 */
function gravitizer_lite_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gravitizer-lite-activator.php';
	Gravitizer_Lite_Activator::activate();
	add_option('Gravitizer_Lite_Version', GRAVITIZER_LITE_VERSION);

	update_option('maybe_gravitizer_installed', 'yes');

	// show Admin notice for how to use after activation
	update_option('how_to_use_notice_dismissed', 'no');
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-gravitizer-lite-deactivator.php
 */
function gravitizer_lite_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gravitizer-lite-deactivator.php';
	Gravitizer_Lite_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'gravitizer_lite_activate' );
register_deactivation_hook( __FILE__, 'gravitizer_lite_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( !is_plugin_active( 'gravitizer/gravitizer.php' ) ) {
	//pro version is not activated, so we can proceed on the free version
	require plugin_dir_path( __FILE__ ) . 'includes/class-gravitizer-lite.php';
	/**
	 * Begins execution of the plugin.
	 *
	 * Since everything within the plugin is registered via hooks,
	 * then kicking off the plugin from this point in the file does
	 * not affect the page life cycle.
	 *
	 * @since    1.0.0
	 */
	function gravitizer_lite_run() {

		$plugin = new Gravitizer_Lite();
		$plugin->run();

	}

	gravitizer_lite_run();

} 




