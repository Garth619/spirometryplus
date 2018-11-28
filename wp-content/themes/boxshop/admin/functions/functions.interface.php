<?php 
/**
 * SMOF Interface
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.4.0
 * @author      Syamil MJ
 */
 
 
/**
 * Admin Init
 *
 * @uses wp_verify_nonce()
 * @uses header()
 *
 * @since 1.0.0
 */
function boxshop_optionsframework_admin_init() 
{
	// Rev up the Options Machine
	global $boxshop_of_options, $boxshop_options_machine, $boxshop_theme_options, $boxshop_smof_details;
	if (!isset($boxshop_options_machine))
		$boxshop_options_machine = new Boxshop_Options_Machine($boxshop_of_options);

	do_action('boxshop_optionsframework_admin_init_before', array(
			'of_options'		=> $boxshop_of_options,
			'options_machine'	=> $boxshop_options_machine,
			'smof_data'			=> $boxshop_theme_options
		));
	
	if (empty($boxshop_theme_options['smof_init'])) { // Let's set the values if the theme's already been active
		boxshop_of_save_options($boxshop_options_machine->Defaults);
		boxshop_of_save_options(date('r'), 'smof_init');
		$boxshop_theme_options = boxshop_of_get_options();
		$boxshop_options_machine = new Boxshop_Options_Machine($boxshop_of_options);
	}

	do_action('boxshop_optionsframework_admin_init_after', array(
			'of_options'		=> $boxshop_of_options,
			'options_machine'	=> $boxshop_options_machine,
			'smof_data'			=> $boxshop_theme_options
		));

}

/**
 * Create Options page
 *
 * @uses add_theme_page()
 * @uses add_action()
 *
 * @since 1.0.0
 */
function boxshop_optionsframework_add_admin() {
	
    $of_page = add_theme_page( THEMENAME, 'Theme Options', 'edit_theme_options', 'optionsframework', 'boxshop_optionsframework_options_page');

	// Add framework functionaily to the head individually
	add_action("admin_print_scripts-$of_page", 'boxshop_of_load_only');
	add_action("admin_print_styles-$of_page",'boxshop_of_style_only');
	
}

function boxshop_theme_options_get_menu_html(){
	global $boxshop_options_machine;
	return $boxshop_options_machine->Menu;
}

function boxshop_theme_options_get_options_html(){
	global $boxshop_options_machine;
	return $boxshop_options_machine->Inputs;
}

/**
 * Build Options page
 *
 * @since 1.0.0
 */
function boxshop_optionsframework_options_page(){
	
	global $boxshop_options_machine;
	
	include_once ADMIN_PATH . 'front-end/options.php';

}

/**
 * Create Options page
 *
 * @uses wp_enqueue_style()
 *
 * @since 1.0.0
 */
function boxshop_of_style_only(){
	wp_enqueue_style('boxshop-of-admin-style', ADMIN_DIR . 'assets/css/admin-style.css');
	wp_enqueue_style('jquery-ui-custom', ADMIN_DIR .'assets/css/jquery-ui-custom.css');

	if ( !wp_style_is( 'wp-color-picker','registered' ) ) {
		wp_register_style( 'wp-color-picker', ADMIN_DIR . 'assets/css/color-picker.min.css' );
	}
	wp_enqueue_style( 'wp-color-picker' );
	do_action('boxshop_of_style_only_after');
}	

/**
 * Create Options page
 *
 * @uses add_action()
 * @uses wp_enqueue_script()
 *
 * @since 1.0.0
 */
function boxshop_of_load_only() 
{
	//add_action('admin_head', 'smof_admin_head');
	
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-input-mask', ADMIN_DIR .'assets/js/jquery.maskedinput-1.2.2.js', array( 'jquery' ));
	wp_enqueue_script('tipsy', ADMIN_DIR .'assets/js/jquery.tipsy.js', array( 'jquery' ));
	wp_enqueue_script('cookie', ADMIN_DIR . 'assets/js/cookie.js', 'jquery');
	wp_enqueue_script('boxshop-smof', ADMIN_DIR .'assets/js/smof.js', array( 'jquery' ));

	wp_localize_script('boxshop-smof', 'boxshop_google_font_weight', boxshop_get_list_google_font_weight());
	
	/* ace editor */
	wp_enqueue_script('ace-editor', ADMIN_DIR .'assets/js/ace/ace.js', array( 'jquery' ), false, true);
	wp_enqueue_script('theme-monokai', ADMIN_DIR .'assets/js/ace/theme-monokai.js', array( 'jquery' ), false, true);

	// Enqueue colorpicker scripts for versions below 3.5 for compatibility
	if ( !wp_script_is( 'wp-color-picker', 'registered' ) ) {
		wp_register_script( 'iris', ADMIN_DIR .'assets/js/iris.min.js', array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false, 1 );
		wp_register_script( 'wp-color-picker', ADMIN_DIR .'assets/js/color-picker.min.js', array( 'jquery', 'iris' ) );
	}
	wp_enqueue_script( 'wp-color-picker' );
	

	/**
	 * Enqueue scripts for file uploader
	 */
	
	if ( function_exists( 'wp_enqueue_media' ) ){
		wp_enqueue_media();
	}

	do_action('boxshop_of_load_only_after');

}

function boxshop_get_list_google_font_weight(){
	$list_font_weight = array();
	if( defined('RS_PLUGIN_PATH') ){
		include RS_PLUGIN_PATH . 'includes/googlefonts.php';
		if( isset($googlefonts) && is_array($googlefonts) ){
			foreach( $googlefonts as $font_name => $val ){
				$font_weight = $val['variants'];
				$font_weight = array_filter($font_weight, 'boxshop_remove_italic_from_google_font_weight');
				$list_font_weight[$font_name] = $font_weight;
			}
		}
	}
	return $list_font_weight;
}

function boxshop_remove_italic_from_google_font_weight( $font_weight ){
	if( strpos($font_weight, 'italic') === false ){
		return true;
	}
	return false;
}

/**
 * Ajax Save Options
 *
 * @uses get_option()
 *
 * @since 1.0.0
 */
function boxshop_of_ajax_callback() 
{
	global $boxshop_options_machine, $boxshop_of_options;

	$nonce=$_POST['security'];
	
	if (! wp_verify_nonce($nonce, 'of_ajax_nonce') ) die('-1'); 
			
	//get options array from db
	$all = boxshop_of_get_options();
	
	$save_type = $_POST['type'];
	
	//Uploads
	if($save_type == 'upload')
	{
		
		$clickedID = $_POST['data']; // Acts as the name
		$filename = $_FILES[$clickedID];
       	$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
		
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);
		 
			$upload_tracking[] = $clickedID;
				
			//update $options array w/ image URL			  
			$upload_image = $all; //preserve current data
			
			$upload_image[$clickedID] = $uploaded_file['url'];
			
			boxshop_of_save_options($upload_image);
		
		 if(!empty($uploaded_file['error'])) {echo esc_html__('Upload Error: ', 'boxshop') . $uploaded_file['error']; }	
		 else { echo esc_url($uploaded_file['url']); } // Is the Response
		 
	}
	elseif($save_type == 'image_reset')
	{
			
			$id = $_POST['data']; // Acts as the name
			
			$delete_image = $all; //preserve rest of data
			$delete_image[$id] = ''; //update array key with empty value	 
			boxshop_of_save_options($delete_image ) ;
	
	}
	elseif($save_type == 'backup_options')
	{
			
		$backup = $all;
		$backup['backup_log'] = date('r');
		
		boxshop_of_save_options($backup, BACKUPS) ;
			
		die('1'); 
	}
	elseif($save_type == 'restore_options')
	{
			
		$boxshop_theme_options = boxshop_of_get_options(BACKUPS);

		boxshop_of_save_options($boxshop_theme_options);
		
		die('1'); 
	}
	elseif($save_type == 'import_options'){


		$boxshop_theme_options = json_decode(stripslashes($_POST['data']), true);
		boxshop_of_save_options($boxshop_theme_options);

		
		die('1'); 
	}
	elseif ($save_type == 'save')
	{

		wp_parse_str(stripslashes($_POST['data']), $boxshop_theme_options);
		unset($boxshop_theme_options['security']);
		unset($boxshop_theme_options['of_save']);
		boxshop_of_save_options($boxshop_theme_options);
		
		
		die('1');
	}
	elseif ($save_type == 'reset')
	{
		boxshop_of_save_options($boxshop_options_machine->Defaults);
		
        die('1'); //options reset
	}

  	die();
}
