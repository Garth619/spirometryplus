<?php
/**
 * SMOF Admin
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.4.0
 * @author      Syamil MJ
 */

/**
 * Change activation message
 *
 * @since 1.0.0
 */
function boxshop_optionsframework_admin_message() { 
	
	//Tweaked the message on theme activate
	?>
    <script type="text/javascript">
    jQuery(function(){
    	"use strict";
        var message = '<p>This theme comes with an <a href="<?php echo admin_url('admin.php?page=optionsframework'); ?>">options panel</a> to configure settings. This theme also supports widgets, please visit the <a href="<?php echo admin_url('widgets.php'); ?>">widgets settings page</a> to configure them.</p>';
    	jQuery('.themes-php #message2').html(message);
    
    });
    </script>
    <?php
	
}

/**
 * Get header classes
 *
 * @since 1.0.0
 */
function boxshop_of_get_header_classes_array() 
{
	global $boxshop_of_options;
	
	foreach ($boxshop_of_options as $value) 
	{
		if ($value['type'] == 'heading')
			$hooks[] = str_replace(' ','',strtolower($value['name']));	
	}
	
	return $hooks;
}

/**
 * Get options from the database and process them with the load filter hook.
 *
 * @author Jonah Dahlquist
 * @since 1.4.0
 * @return array
 */
function boxshop_of_get_options($key = null, $data = null) {
	global $boxshop_theme_options;

	do_action('boxshop_of_get_options_before', array(
		'key'=>$key, 'data'=>$data
	));
	if ($key != null) { // Get one specific value
		$data = get_theme_mod($key, $data);
	} else { // Get all values
		$data = get_theme_mods();	
	}
	$data = apply_filters('boxshop_of_options_after_load', $data);
	if ($key == null) {
		$boxshop_theme_options = $data;
	} else {
		$boxshop_theme_options[$key] = $data;
	}
	do_action('boxshop_of_option_setup_before', array(
		'key'=>$key, 'data'=>$data
	));
	return $data;

}

/**
 * Save options to the database after processing them
 *
 * @param $data Options array to save
 * @author Jonah Dahlquist
 * @since 1.4.0
 * @uses update_option()
 * @return void
 */

function boxshop_of_save_options($data, $key = null) {
	global $boxshop_theme_options;
    if (empty($data))
        return;	
    do_action('boxshop_of_save_options_before', array(
		'key'=>$key, 'data'=>$data
	));
	$data = apply_filters('boxshop_of_options_before_save', $data);
	if ($key != null) { // Update one specific value
		if ($key == BACKUPS) {
			unset($data['smof_init']); // Don't want to change this.
		}
		set_theme_mod($key, $data);
	} else { // Update all values in $data
		foreach ( $data as $k=>$v ) {
			if (!isset($boxshop_theme_options[$k]) || $boxshop_theme_options[$k] != $v) { // Only write to the DB when we need to
				set_theme_mod($k, $v);
			} else if (is_array($v)) {
				foreach ($v as $key=>$val) {
					if ($key != $k && $v[$key] == $val) {
						set_theme_mod($k, $v);
						break;
					}
				}
			}
	  	}
	}
    do_action('boxshop_of_save_options_after', array(
		'key'=>$key, 'data'=>$data
	));

}


/* Fix bug activate theme no value default */
function boxshop_of_option_setup()	
{
	global $boxshop_of_options, $boxshop_options_machine;
	$ts_data = boxshop_of_get_options();
	$boxshop_options_machine = new Boxshop_Options_Machine($boxshop_of_options);
	$ts_data = boxshop_array_atts($boxshop_options_machine->Defaults, $ts_data);
	boxshop_of_save_default_options($ts_data);	
}

function boxshop_of_save_default_options($data){
	foreach ( $data as $k=>$v ) {
		if (is_array($v)) {
			foreach ($v as $key=>$val) {
				if ($key != $k && $v[$key] == $val) {
					set_theme_mod($k, $v);
					break;
				}
			}
		} else {
			set_theme_mod($k, $v);
		}		
	}
}


/**
 * For use in themes
 *
 * @since forever
 */



$data = boxshop_of_get_options();
if (!isset($boxshop_smof_details))
	$boxshop_smof_details = array();
