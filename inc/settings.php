<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Admin menu
function mclovin_menu() {
	add_submenu_page( 
		'woocommerce-marketing',
		__( 'Facebook Product ID', 'mclovin' ), 
		__( 'Facebook Product ID', 'mclovin' ), 
		'manage_woocommerce', 
		'mclovin_settings', 
		'mclovin_options',
		11
	);
}

// Function for getting saved option with fallback
function get_mclovin_options( $option, $new_line_to_space = false, $fallback = '', $esc = false ) {
	$option = get_option( $option );
	if ( !$option && $fallback ) {
		$option = $fallback;
	}
	if ( $new_line_to_space ) {
		$remove = array( "\n", "\r\n", "\r" );
		$option = str_replace( $remove, ' ', $option );
	}
	if ( $esc ) {
		$option = esc_attr( $option );
	}
	return stripslashes( $option );
}

// Admin page
add_action( 'admin_menu', 'mclovin_menu', 100 );
function mclovin_options() {
	include_once( 'update-options.php' );
	$mclovin_type = get_mclovin_options( 'mclovin_type', false, '', true );
	?>

	<div class="wrap">
		<h1><?php _e( 'Facebook Product ID', 'mclovin' ); ?></h1>
		<p><?php _e( 'Choose what "content_ids" to use for products in the Meta Pixel', 'mclovin' ); ?></p>
		<form method="post">
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php _e( 'Type', 'mclovin' ); ?></th>
					<td>
						<select name="mclovin_type" id="mclovin_type" class="large-text">
							<option value=""<?php if ($mclovin_type == '') { echo ' selected'; } ?>>Default</option>
							<option value="id"<?php if ($mclovin_type == 'id') { echo ' selected'; } ?>>ID</option>
							<option value="sku"<?php if ($mclovin_type == 'sku') { echo ' selected'; } ?>>SKU</option>
						</select>
					</td> 
				</tr>
			</table>
			<div class="submit">
				<input type="submit" name="save_mclovin_type_settings" value="<?php _e( 'Save Settings' , 'mclovin' ); ?>" class="button-primary" />
			</div>
			<?php
				wp_nonce_field( 'mclovin_nonce_action', 'mclovin_nonce_name', false );
			?>
		</form>
	</div>
<?php
}
