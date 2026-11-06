<?php
/**
 * Plugin Name: Mon Plugin Test
 * Description: Plugin de démarrage pour expérimenter (shortcode, page admin, hooks).
 * Version:     0.1.0
 * Author:      Andry
 * Text Domain: mon-plugin-test
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MPT_VERSION', '0.1.0' );
define( 'MPT_PATH', plugin_dir_path( __FILE__ ) );
define( 'MPT_URL', plugin_dir_url( __FILE__ ) );

/* Activation / désactivation */
register_activation_hook( __FILE__, function () {
	add_option( 'mpt_message', 'Bonjour depuis Mon Plugin Test !' );
	error_log( '[mon-plugin-test] activé' );
} );

register_deactivation_hook( __FILE__, function () {
	error_log( '[mon-plugin-test] désactivé' );
} );

/* Shortcode : [mpt_hello nom="Andry"] */
add_shortcode( 'mpt_hello', function ( $atts ) {
	$atts = shortcode_atts( array( 'nom' => 'visiteur' ), $atts, 'mpt_hello' );
	return sprintf(
		'<p class="mpt-hello">%s — %s</p>',
		esc_html( get_option( 'mpt_message' ) ),
		esc_html( $atts['nom'] )
	);
} );

/* Page de réglages dans Réglages > Mon Plugin Test */
add_action( 'admin_menu', function () {
	add_options_page( 'Mon Plugin Test', 'Mon Plugin Test', 'manage_options', 'mon-plugin-test', 'mpt_render_settings' );
} );

add_action( 'admin_init', function () {
	register_setting( 'mpt_settings', 'mpt_message', array( 'sanitize_callback' => 'sanitize_text_field' ) );
} );

function mpt_render_settings() {
	?>
	<div class="wrap">
		<h1>Mon Plugin Test</h1>
		<form method="post" action="options.php">
			<?php settings_fields( 'mpt_settings' ); ?>
			<table class="form-table">
				<tr>
					<th scope="row"><label for="mpt_message">Message</label></th>
					<td><input name="mpt_message" id="mpt_message" type="text" class="regular-text"
						value="<?php echo esc_attr( get_option( 'mpt_message' ) ); ?>"></td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
		<p>Utilisation : <code>[mpt_hello nom="Andry"]</code></p>
	</div>
	<?php
}
