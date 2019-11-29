<?php
/**
 * Beans WPForms helper functions.
 *
 * Assists with the creation of a WPForms form, and the replacement of contact
 * page content with a working contact form block during one-click theme setup.
 *
 */

namespace Beans_WPForms_Uikit3_Addon;

/**
 * Returns the path to the contact template (can be overwritten in child theme).
 * @TODO Add support for pro.
 *
 * @return string
 */
function get_contact_template_path(){
    $child_template_path = get_stylesheet_directory() . 'config/wpforms-lite/contact.php';
    if ( is_readable($child_template_path) ){
        return $child_template_path;
    } else {
        return BEANS_WPFORMS_PLUGIN_PATH . 'config/wpforms-lite/contact.php';
    }
}



/**
 * Creates a WPForms form if one added by a Beans theme does not exist.
 *
 * @return int|null ID of form if one exists or gets created. Null if form creation fails or WPForms is inactive.
 * @since Beans 2.0.0
 *
 */
function maybe_create_wpforms_form() {

    if ( ! function_exists( 'wpforms' ) ) {
        return;
    }

    // Form creation requires WPForms 1.5.2 or higher.
    // If the site already as an earlier version of the plugin installed, don't create a form.
    // Plugins do not get upgraded during one-click theme setup.
    if ( function_exists( 'get_plugins' ) ) {
        $plugin_data          = get_plugins();
        $wpforms_lite_version = isset( $plugin_data['wpforms-lite/wpforms.php']['Version'] ) ? $plugin_data['wpforms-lite/wpforms.php']['Version'] : '';

        if ( version_compare( $wpforms_lite_version, '1.5.2', '<' ) ) {
            return;
        }
    }

    $existing_form_id = get_option( 'beans_onboarding_wpforms_id' );

    if ( $existing_form_id ) {
        $wpform = get_post( $existing_form_id );

        // Don't create another form if a valid one already exists.
        if ( $wpform && 'wpforms' === $wpform->post_type ) {
            return $existing_form_id;
        }

        // Stored ID no longer points to a WPForms form.
        delete_option( 'beans_onboarding_wpforms_id' );
    }

    // Creates a form using the WPForms 'contact' template.
    $new_form_id = wpforms()->form->add(
        esc_html__( 'Contact Form', 'tm-beans' ),
        [],
        [
            'template' => 'contact_form',  // @TODO make generic.
            'builder'  => false,
        ]
    );

    if ( $new_form_id ) {
        update_option( 'beans_onboarding_wpforms_id', $new_form_id, false );
        return $new_form_id;
    }

}

/**
 * Replace contact page placeholder content with a block displaying the form.
 *
 * @since Beans 2.0.0
 * @return string - html for embedding a
 */
function get_wpforms_contact_form_html(){

    $form_id = maybe_create_wpforms_form();

    if ($form_id ) {
        return "<!-- wp:wpforms/form-selector {\"formId\":\"{$form_id}\"} /-->";
    } else {
        return '';
    }

}
