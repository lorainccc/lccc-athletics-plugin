<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.lorainccc.edu
 * @since             1.0.0
 * @package           Lccc_Athletics_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       LCCC Athletics Plugin
 * Plugin URI:        http://www.lorainccc.edu/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            LCCC Web Dev Team
 * Author URI:        http://www.lorainccc.edu
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       lccc-athletics-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-lccc-athletics-plugin-activator.php
 */
function activate_lccc_athletics_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lccc-athletics-plugin-activator.php';
	Lccc_Athletics_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-lccc-athletics-plugin-deactivator.php
 */
function deactivate_lccc_athletics_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lccc-athletics-plugin-deactivator.php';
	Lccc_Athletics_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_lccc_athletics_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_lccc_athletics_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-lccc-athletics-plugin.php';

require_once( plugin_dir_path( __FILE__ ).'php/cpt-lccc-players.php' );

require_once( plugin_dir_path( __FILE__ ).'php/lccc-player-metabox.php' );

//require_once( plugin_dir_path( __FILE__ ).'php/cpt-lccc-rosters.php' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_lccc_athletics_plugin() {

	$plugin = new Lccc_Athletics_Plugin();
	$plugin->run();

}
run_lccc_athletics_plugin();
