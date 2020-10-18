/* 
 * Theme options page.
 * ==============================================================
 */
 
 // Get Default Options - TEST
<?php 
function rs_get_default_theme_options() {
	$options = array (
		'color' => '#dadada',
		'color2' => '#444'
	);
	
	return $options;
}

// Add options to database -TEST
function rs_options_init() {
	//Set options equal to defaults
	global $rs_options;
	$rs_options = get_option( 'rs-theme-options' );
	if ( false == $rs_options ) {
		$rs_options = rs_get_default_theme_options();
	}
	update_option( 'rs-theme-options', $rs_options );
}
	// Initialise Theme Options
add_action( 'after_setup_theme', 'rs_options_init', 9 );


// Create the options page and hook into the appearance menu
function rs_admin_menu() {
	$page = add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'rs-theme-options', 'rs_theme_options' );
	add_action( 'admin_print_styles-' . $page, 'rs_admin_scripts' );
}

add_action( 'admin_menu', 'rs_admin_menu' );

function rs_admin_scripts() {
	wp_enqueue_style( 'farbtastic' );
	wp_enqueue_script( 'farbtastic' );
	wp_enqueue_script( 'rs-theme-options', get_template_directory_uri() . '/js/theme-options.js', array( 'farbtastic', 'jquery' ) );
}


//Settings, Sections, Fields
function rs_admin_init() {
	register_setting( 'rs-theme-options', 'rs-theme-options', 'rs_theme_options_validate' );
	add_settings_section( 'section_general', 'General Settings', 'rs_section_general', 'rs-theme-options' );
	add_settings_field( 'color', 'Colour', 'rs_setting_color', 'rs-theme-options', 'section_general' );
}

add_action( 'admin_init', 'rs_admin_init' );

//Info text about the General settings section
function rs_section_general() {
	_e( 'General section description', 'rs-theme' );
}

//Colour value input
function rs_setting_color() {
	$options = get_option( 'rs-theme-options' );
	?>
	<div class="color-picker" style="position:relative;">
		<input type="text" name="rs-theme-options[color]" class="color" value="<?php echo esc_attr( $options['color'] ); ?>"/>
		<div class="colorpicker" style="position:absolute;"></div>
	</div>
	<div class="color-picker" style="position:relative;">
		<input type="text" name="rs-theme-options[color2]" class="color" value="<?php echo esc_attr( $options['color2'] ); ?>"/>
		<div class="colorpicker" style="position:absolute;"></div>
	</div>
	<div class="color-picker2" style="position:relative;">
		<input type="text" name="rs-theme-options[color2]" class="color2" value="<?php echo esc_attr( $options['color2'] ); ?>"/>
		<div class="colorpicker2" style="position:absolute;"></div>
	</div>

	<?php
}

//Options page contents
function rs_theme_options() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2>Theme Options</h2>
		<?php if ( isset( $_GET['settings-updated'] ) ) {
               echo "<div class='updated'><p>Theme settings updated successfully.</p></div>";
          } ?>
		<form method="post" action="options.php">
			<?php wp_nonce_field( 'update-options' ); ?>
			<?php settings_fields( 'rs-theme-options' ); ?>
			<?php do_settings_sections( 'rs-theme-options' ); ?>
			<p class="submit">
				<input name="Submit" type="submit" class="button-primary" value="Save Changes"/>
			</p>
		</form>
	</div>
	<?php
}
 
function rs_theme_options_validate( $input ) {
	$output = $defaults = rs_get_default_theme_options();
	
	// Link color must be 3 or 6 hexadecimal characters
	if ( isset( $input['color'] ) && preg_match( '/^#?([a-f0-9]{3}){1,2}$/i', $input['color'] ) )
		$output['color'] = '#' . strtolower( ltrim( $input['color'], '#' ) );
		
		return apply_filters( 'rs_theme_options_validate', $output, $input, $defaults );
		
	// Link color must be 3 or 6 hexadecimal characters
	if ( isset( $input['color2'] ) && preg_match( '/^#?([a-f0-9]{3}){1,2}$/i', $input['color2'] ) )
		$output['color2'] = '#' . strtolower( ltrim( $input['color2'], '#' ) );
		
		return apply_filters( 'rs_theme_options_validate', $output, $input, $defaults );
}