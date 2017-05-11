<?php
/**
 * Plugin Name: Login error msg
 * Plugin URI: http://kildedal.no
 * Description: This plugin changes the message you get if you enter a incorrect password
 * Version: 1.0.0
 * Author: Marius Kildedal
 * Author URI: http://kildedal.no
 * License: GPL2
 */
 
 //remember some security is nice!
 if ( ! defined( 'ABSPATH' ) ) exit;
 
 add_filter('login_errors','login_error_message');

function login_error_message( $error ){
    $error = get_option('error_msg');
    return $error;
}


//Settings menu

add_action('admin_menu', 'login_error_msg_plugin_menu');

function login_error_msg_plugin_menu() {
	add_menu_page('Login Error Msg Settings', 'Login Error Msg Settings', 'administrator', 'login_error_msg_plugin_settings', 'login_error_msg_settings_page', 'dashicons-admin-generic');
}


add_action( 'admin_init', 'login_error_msg_plugin_settings' );

function login_error_msg_plugin_settings() {
	register_setting( 'login-error-msg-plugin-settingss-group', 'error_msg' );
	
}

//Setting page

function login_error_msg_settings_page() {
?>
<div class="wrap">
<h2>Error Message</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'login-error-msg-plugin-settingss-group' ); ?>
    <?php do_settings_sections( 'login-error-msg-plugin-settingss-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Your custom error message:</th>
        <td><input type="text" name="error_msg" value="<?php echo esc_attr( get_option('error_msg') ); ?>" /></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div> 
 <?php } ?>