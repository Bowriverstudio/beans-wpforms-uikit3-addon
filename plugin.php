<?php
/**
 * Beans using uikit 3 and wp forms
 *
 * https://getuikit.com/v2/
 *
 * @package    Beans_WPForms_Uikit3_Addon
 * @since      0.1
 * @author     Maurice Tadros, Yaidel Ferralize, Disnel Rodriguez
 * @link       https://bowriverstudio.com
 * @license    GNU-2.0+
 *
 * @wordpress-plugin
 * Plugin Name:    Beans - UiKit 3.2  -  WP Forms - Addon
 * Description:     An Addon for wpforms that uses Beans and uikit 3: Plugin is free as beer and In Development.
 *
 */
namespace Beans_WPForms_Uikit3_Addon;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Hello, Hello, Hello, what\'s going on here then?' );
}


require_once 'lib/functions.php';
require_once 'lib/uikit3.php';


if( defined('BEANS_FRONTEND_FRAMEWORK') ){

    define( 'BEANS_WPFORMS_PLUGIN_PATH', plugin_dir_path(__FILE__)  );

    require_once 'lib/wp-cli.php';

}

/**
 * Plugin Name: WPForms Custom Templates
 * Description: This plugin loads custom form templates.
 * Version:     1.0.0
 */

add_action( 'wpforms_loaded', __NAMESPACE__ .'\wpf_load_contact_templates' );
/**
 * Load the wp-forms contact template.
 *
 * @TODO extend to allow multiple templates to be defined.
 * @TODO handle support for lite and pro.
 */
function wpf_load_contact_templates() {

    require_once 'lib/onboarding.php';

    // Template code here
   include_once( get_contact_template_path() );
}
