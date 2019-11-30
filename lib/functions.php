<?php
namespace Beans_WPForms_Uikit3_Addon;

/**
 * Sets the wpfroms styling setting.
 *
 * Updates the field "Include Form Styling" the section "Dashboard->WP Forms-> General -> Setting
 *
 * @param int $setting: 1 -> "Base and Form Styling", 2 -> "Base Style only", 3 -> "No Styling"
 * @TODO -> Can add validation checks.
 *
 * @return null
 */
function update_wpforms_styling_option(int $setting){
    $wpforms_settings = get_option('wpforms_settings');
//    d($wpforms_settings);
//    if( is_array($wpforms_settings) && array_key_exists('disable-css', $wpforms_settings)) {
        $wpforms_settings['disable-css'] = $setting;
        update_option('wpforms_settings', $wpforms_settings);
//    }
}

