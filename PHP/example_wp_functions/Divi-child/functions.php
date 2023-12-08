<?php


add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}


/*
*
*
* All functions are related to User experience
*
*
*/


/**
 * my_wp_mail_from_name
 *
 * @param  mixed $email
 * @return void
 */
function my_wp_mail_from_name($email) {
return 'Le Parnasse Versailles';
}
add_filter('wp_mail_from_name', 'my_wp_mail_from_name');



/**
 * restrict_dashboard_access
 *
 * @return void
 */
function restrict_dashboard_access() {
    if (!current_user_can('manage_options') && $_SERVER['PHP_SELF'] != '/wp-admin/admin-ajax.php') {
        wp_redirect(home_url());
        exit;
    }
}
add_action('admin_init', 'restrict_dashboard_access');



/**
 * remove_admin_bar
 *
 * @return void
 */
function remove_admin_bar() {
    if(!current_user_can('administrator') && !is_admin() && !current_user_can('editor')) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'remove_admin_bar');


/**
 * theme_restrict_mime_types
 *
 * @param  mixed $mime_types
 * @return void
 */
function theme_restrict_mime_types( $mime_types )
{
    $mime_types = array(

        'jpg|jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'bmp' => 'image/bmp'
    );
    return $mime_types;
}
add_filter( 'upload_mimes', 'theme_restrict_mime_types' );


/*
**
** Add the PWA Manifest
*
*
*/

function add_pwa_manifest_link() {
    echo '<link rel="manifest" href="' . get_stylesheet_directory_uri() . '/ajax/manifest.json">';
}
add_action('wp_head', 'add_pwa_manifest_link');


?>