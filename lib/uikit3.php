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

add_filter( 'render_block', __NAMESPACE__.'\render_block', 10, 4  );
/**
 * Replace stripped @ char from uikit classes.
 *
 * Note - the function wpforms_sanitize_classes strips the "@" from the class.
 * @todo - can add support of other classes.
 *
 * @param string $block_content
 * @param array $block
 * @return string
 */
function render_block( string $block_content, array $block){
    if( $block['blockName'] == 'wpforms/form-selector'){
        $block_content = str_replace('uk-width-1-2m', 'uk-width-1-2@m', $block_content);
    }
    return $block_content;
}