<?php
// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// add admin options page
function cookies_bar_menu_page() {
	add_options_page( esc_html__( 'Cookies Bar', 'cookies-bar' ), esc_html__( 'Cookies Bar', 'cookies-bar' ), 'manage_options', 'cookies-bar', 'cookies_bar_options_page' );
}
add_action( 'admin_menu', 'cookies_bar_menu_page' );

// add admin settings and such
function cookies_bar_admin_init() {
	add_settings_section( 'cookies-bar-section', esc_html__( 'Settings', 'cookies-bar' ), '', 'cookies-bar' );

	add_settings_field( 'cookies-bar-field-1', esc_html__( 'Uninstall', 'cookies-bar' ), 'cookies_bar_field_callback_1', 'cookies-bar', 'cookies-bar-section' );
	register_setting( 'cookies-bar-options', 'cookies-bar-setting-1', array( 'sanitize_callback' => 'sanitize_key' ) );

	add_settings_field( 'cookies-bar-field-2', esc_html__( 'Cookies Bar', 'cookies-bar' ), 'cookies_bar_field_callback_2', 'cookies-bar', 'cookies-bar-section' );
 	register_setting( 'cookies-bar-options', 'cookies-bar-setting-2', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	add_settings_field( 'cookies-bar-field-3', esc_html__( 'Expiration', 'cookies-bar' ), 'cookies_bar_field_callback_3', 'cookies-bar', 'cookies-bar-section' );
 	register_setting( 'cookies-bar-options', 'cookies-bar-setting-3', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	add_settings_field( 'cookies-bar-field-4', esc_html__( 'Message', 'cookies-bar' ), 'cookies_bar_field_callback_4', 'cookies-bar', 'cookies-bar-section' );
 	register_setting( 'cookies-bar-options', 'cookies-bar-setting-4', array( 'sanitize_callback' => 'wp_kses_post' ) );

	add_settings_field( 'cookies-bar-field-5', esc_html__( 'Button', 'cookies-bar' ), 'cookies_bar_field_callback_5', 'cookies-bar', 'cookies-bar-section' );
 	register_setting( 'cookies-bar-options', 'cookies-bar-setting-5', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	add_settings_field( 'cookies-bar-field-6', esc_html__( 'Privacy Policy', 'cookies-bar' ), 'cookies_bar_field_callback_6', 'cookies-bar', 'cookies-bar-section' );
 	register_setting( 'cookies-bar-options', 'cookies-bar-setting-6', array( 'sanitize_callback' => 'esc_url_raw' ) );

	add_settings_field( 'cookies-bar-field-7', esc_html__( 'Button', 'cookies-bar' ), 'cookies_bar_field_callback_7', 'cookies-bar', 'cookies-bar-section' );
 	register_setting( 'cookies-bar-options', 'cookies-bar-setting-7', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	add_settings_field( 'cookies-bar-field-8', esc_html__( 'Background', 'cookies-bar' ), 'cookies_bar_field_callback_8', 'cookies-bar', 'cookies-bar-section' );
	register_setting( 'cookies-bar-options', 'cookies-bar-setting-8', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	add_settings_field( 'cookies-bar-field-9', esc_html__( 'Color', 'cookies-bar' ), 'cookies_bar_field_callback_9', 'cookies-bar', 'cookies-bar-section' );
	register_setting( 'cookies-bar-options', 'cookies-bar-setting-9', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	add_settings_field( 'cookies-bar-field-10', esc_html__( 'Background', 'cookies-bar' ), 'cookies_bar_field_callback_10', 'cookies-bar', 'cookies-bar-section' );
 	register_setting( 'cookies-bar-options', 'cookies-bar-setting-10', array( 'sanitize_callback' => 'sanitize_text_field' ) );

	add_settings_field( 'cookies-bar-field-11', esc_html__( 'Color', 'cookies-bar' ), 'cookies_bar_field_callback_11', 'cookies-bar', 'cookies-bar-section' );
 	register_setting( 'cookies-bar-options', 'cookies-bar-setting-11', array( 'sanitize_callback' => 'sanitize_text_field' ) );
}
add_action( 'admin_init', 'cookies_bar_admin_init' );

// field callbacks
function cookies_bar_field_callback_1() {
	$value = get_option( 'cookies-bar-setting-1' );
	?>
	<input type="hidden" name="cookies-bar-setting-1" value="no">
	<label><input type="checkbox" name="cookies-bar-setting-1" <?php checked( esc_attr( $value ), 'yes' ); ?> value="yes"> <?php esc_html_e( 'Do not delete plugin settings from the database.', 'cookies-bar' ); ?></label>
	<?php
}

function cookies_bar_field_callback_2() {
	$value = get_option( 'cookies-bar-setting-2' );
 	?>
	<select id="cookies-bar-setting-2" name="cookies-bar-setting-2">
		<option value="off" <?php echo ( $value == 'off' ) ? 'selected' : ''; ?>><?php esc_html_e( 'Off', 'cookies-bar' ); ?></option>
		<option value="on" <?php echo ( $value == 'on' ) ? 'selected' : ''; ?>><?php esc_html_e( 'On', 'cookies-bar' ); ?></option>
	</select>
	<?php
}

function cookies_bar_field_callback_3() {
	$value = get_option( 'cookies-bar-setting-3' );
 	?>
	<select id="cookies-bar-setting-2" name="cookies-bar-setting-3">
		<option value="month" <?php echo ( $value == 'month' ) ? 'selected' : ''; ?>><?php esc_html_e( 'Month', 'cookies-bar' ); ?></option>
		<option value="week" <?php echo ( $value == 'week' ) ? 'selected' : ''; ?>><?php esc_html_e( 'Week', 'cookies-bar' ); ?></option>
		<option value="day" <?php echo ( $value == 'day' ) ? 'selected' : ''; ?>><?php esc_html_e( 'Day', 'cookies-bar' ); ?></option>
		<option value="hour" <?php echo ( $value == 'hour' ) ? 'selected' : ''; ?>><?php esc_html_e( 'Hour', 'cookies-bar' ); ?></option>
	</select>
	<?php
}

function cookies_bar_field_callback_4() {
	$value = get_option( 'cookies-bar-setting-4' );
	$placeholder = __( 'We use cookies to make our site work. If you continue to use the site, we assume that you agree with this.', 'cookies-bar' );
	?>
	<textarea name="cookies-bar-setting-4" rows="5" cols="50" maxlength="2000" style="min-width:50%;" placeholder="<?php echo esc_attr( $placeholder ); ?>"><?php echo wp_kses_post( $value ); ?></textarea>
	<?php
}

function cookies_bar_field_callback_5() {
	$value = get_option( 'cookies-bar-setting-5' );
	$placeholder = __( 'Ok', 'cookies-bar' );
	?>
	<input type="text" size="40" maxlength="25" name="cookies-bar-setting-5" placeholder="<?php echo esc_attr( $placeholder ); ?>" value="<?php echo esc_attr( $value ); ?>" />
	<?php
}

function cookies_bar_field_callback_6() {
	$value = get_option( 'cookies-bar-setting-6' );
	$placeholder = __( 'URL of your Privacy Policy page', 'cookies-bar' );
	?>
	<input type="url" size="40" maxlength="25" name="cookies-bar-setting-6" placeholder="<?php echo esc_attr( $placeholder ); ?>" value="<?php echo esc_attr( $value ); ?>" />
	<?php
}

function cookies_bar_field_callback_7() {
	$value = get_option( 'cookies-bar-setting-7' );
	$placeholder = __( 'Privacy Policy', 'cookies-bar' );
	?>
	<input type="text" size="40" maxlength="25" name="cookies-bar-setting-7" placeholder="<?php echo esc_attr( $placeholder ); ?>" value="<?php echo esc_attr( $value ); ?>" />
	<?php
}

function cookies_bar_field_callback_8() {
	$value = get_option( 'cookies-bar-setting-8' );
	if ( empty( $value ) ) {
		$value = '#333333';
	}
	$value_submit = __( 'Reset', 'cookies-bar' );
	?>
	<script>function resetEight(value){document.getElementById("cookies-bar-setting-8").value="#333333";}</script>
	<input type="color" maxlength="10" id="cookies-bar-setting-8" name="cookies-bar-setting-8" value="<?php echo esc_attr( $value ); ?>" />
	<input type="button" class="button button-secondary" onclick="resetEight()" value="<?php echo esc_attr( $value_submit ); ?>">
	<p><?php esc_html_e( 'Bar', 'cookies-bar' ); ?></p>
	<?php
}

function cookies_bar_field_callback_9() {
	$value = get_option( 'cookies-bar-setting-9' );
	if ( empty( $value ) ) {
		$value = '#ffffff';
	}
	$value_submit = __( 'Reset', 'cookies-bar' );
	?>
	<script>function resetNine(value){document.getElementById("cookies-bar-setting-9").value="#ffffff";}</script>
	<input type="color" maxlength="10" id="cookies-bar-setting-9" name="cookies-bar-setting-9" value="<?php echo esc_attr( $value ); ?>" />
	<input type="button" class="button button-secondary" onclick="resetNine()" value="<?php echo esc_attr( $value_submit ); ?>">
	<p><?php esc_html_e( 'Bar', 'cookies-bar' ); ?></p>
	<?php
}

function cookies_bar_field_callback_10() {
	$value = get_option( 'cookies-bar-setting-10' );
	if ( empty( $value ) ) {
		$value = '#f26535';
	}
	$value_submit = __( 'Reset', 'cookies-bar' );
	?>
	<script>function resetTen(value){document.getElementById("cookies-bar-setting-10").value="#f26535";}</script>
	<input type="color" maxlength="10" id="cookies-bar-setting-10" name="cookies-bar-setting-10" value="<?php echo esc_attr( $value ); ?>" />
	<input type="button" class="button button-secondary" onclick="resetTen()" value="<?php echo esc_attr( $value_submit ); ?>">
	<p><?php esc_html_e( 'Button', 'cookies-bar' ); ?></p>
	<?php
}

function cookies_bar_field_callback_11() {
	$value = get_option( 'cookies-bar-setting-11' );
	if ( empty( $value ) ) {
		$value = '#ffffff';
	}
	$value_submit = __( 'Reset', 'cookies-bar' );
	?>
	<script>function resetEleven(value){document.getElementById("cookies-bar-setting-11").value="#ffffff";}</script>
	<input type="color" maxlength="10" id="cookies-bar-setting-11" name="cookies-bar-setting-11" value="<?php echo esc_attr( $value ); ?>" />
	<input type="button" class="button button-secondary" onclick="resetEleven()" value="<?php echo esc_attr( $value_submit ); ?>">
	<p><?php esc_html_e( 'Button', 'cookies-bar' ); ?></p>
	<?php
}

// display admin options page
function cookies_bar_options_page() {
?>
<div class="wrap">
	<h1><?php esc_html_e( 'Cookies Bar', 'cookies-bar' ); ?></h1>
	<?php $cookies_bar = get_option( 'cookies-bar-setting-2' );
	if ( $cookies_bar == 'on' ) { ?>
		<p style="padding:10px;background:#eff9f1;border-left:4px solid #4ab866;font-size:1.2em;"><?php esc_html_e( 'Cookies Bar is active', 'cookies-bar' ); ?></p>
	<?php } ?>
	<form action="options.php" method="POST">
		<?php settings_fields( 'cookies-bar-options' );
		do_settings_sections( 'cookies-bar' );
		submit_button(); ?>
	</form
</div>
<?php
}
