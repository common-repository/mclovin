<?php
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

$mclovin_options = array(
	'mclovin_type', 
);

foreach ( $mclovin_options as $mclovin_option ) {
	delete_option( $mclovin_option );
	delete_site_option( $mclovin_option );
}
