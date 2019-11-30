<?php
namespace Beans_WPForms_Uikit3_Addon;

add_filter( 'wpforms_upgrade_link', __NAMESPACE__.'\wpforms_upgrade_link', 10, 4  );
/**
 * Add finical development support via affiliate system.
 *
 * @param string $url
 * @return string
 */
function wpforms_upgrade_link($url){
    return 'https://shareasale.com/r.cfm?b=837827&u=2241463&m=64312&urllink=&afftrack=';
}
