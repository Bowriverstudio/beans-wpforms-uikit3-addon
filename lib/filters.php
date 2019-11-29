<?php
namespace Beans_WPForms_Uikit3_Addon;


add_action('wpforms_display_fields_before', __NAMESPACE__ .'\wpforms_display_fields_before');
/**
 * Add Ukit grid container to fields
 */
function wpforms_display_fields_before(){
    echo '<div uk-grid>';
}

add_action('wpforms_display_fields_after', __NAMESPACE__ .'\wpforms_display_fields_after');
/**
 * Close uikit grid
 */
function wpforms_display_fields_after(){
    echo '</div>';
}


add_filter( 'wpforms_field_properties', __NAMESPACE__.'\wpforms_field_properties', 10, 4 );
/**
 * Use uikit 3 class instead of wpforms.
 *
 * @param array $properties
 * @param array $field
 *
 * @return array   Adjusted properties
 */
function wpforms_field_properties(array $properties, array $field){

    switch( $field['type']){
        case 'name':
        case 'email':
            $properties['inputs']['primary']['class'] = array ('uk-input');
            break;

        case 'textarea':
            $properties['inputs']['primary']['class'] = array ('uk-textarea');
            $properties['inputs']['primary']['attr']['rows'] = '5';
            break;
    }

    return $properties;
}