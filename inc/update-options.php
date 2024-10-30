<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$can_change_all = false;
$mclovin_nonce_set = false;
$mclovin_nonce_name = '';
if ( isset( $_POST['mclovin_nonce_name'] ) ) {
	$mclovin_nonce_set = isset( $_POST['mclovin_nonce_name'] );
	$mclovin_nonce_name = $_POST['mclovin_nonce_name'];
}
$mclovin_nonce_verify = wp_verify_nonce( $mclovin_nonce_name, 'mclovin_nonce_action' );
if ( current_user_can( 'manage_woocommerce' ) && $mclovin_nonce_set && $mclovin_nonce_verify ) {
	$can_change_all = true;
}
// Update settings
if ( isset( $_POST['mclovin_type'] ) && $can_change_all ) {
	update_option( 'mclovin_type', sanitize_text_field( $_POST['mclovin_type'] ) );
	echo '<div id="message" class="updated fade">
		<p>' . __( 'Your settings are now updated', 'mclovin' ) . '</p>
	</div>';
}
