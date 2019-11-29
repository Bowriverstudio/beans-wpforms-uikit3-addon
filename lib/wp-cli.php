<?php
/**
 * Add developer support for Beans / wpfomrs via WP CLI
 *
 * Beans_WPForms_Uikit3_Addon
 *
 * @since beans 2.0.0
 */

if (defined('WP_CLI') && WP_CLI) {

    /**
     * Manage Beans And WPForms via cli.
     */
    class Beans_WPForms_Uikit3_CLI
    {


        /**
         * Creates a form for wpforms.
         *
         * Overwrite - allows forces posts and pages to be overwritten if exists.
         *
         * ## EXAMPLES
         *
         *  $ wp beans create_form --user:admin
         *
         * @param array $args Positional arguments.
         * @param array $assoc_args Stores all the arguments defined like --key=value or --flag or --no-flag.
         * @since 2.0.0
         *
         */
        public function create_form($args, $assoc_args)
        {
            require_once BEANS_WPFORMS_PLUGIN_PATH . 'lib/onboarding.php';
            require_once BEANS_ADMIN_PATH . 'onboarding/functions.php';

            WP_CLI::log( 'makes your you use `wp beans-wpforms create_form --user=xxx`' );

            // @TODO - specify form.
//				if( sizeof($args) != 1){
//                    WP_CLI::error( 'Need to specify a form' );
//                }

            Beans_WPForms_Uikit3_Addon\maybe_create_wpforms_form($args[0]);

            WP_CLI::success( 'Created a the wpform contact_template' );
        }


        /**
         * Sets the wpforms option to "no Styling".
         *
         * @param $args
         * @param $assoc_args
         */
        public function update_option_to_no_styling($args, $assoc_args){
            require_once BEANS_WPFORMS_PLUGIN_PATH . 'lib/functions.php';

            Beans_WPForms_Uikit3_Addon\update_wpforms_styling_option(3);
            WP_CLI::success( 'WPForms Option is now no styling' );
        }
    }

    WP_CLI::add_command('beans-wpforms',   'Beans_WPForms_Uikit3_CLI');
}

