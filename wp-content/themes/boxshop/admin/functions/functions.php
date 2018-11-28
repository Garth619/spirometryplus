<?php 
function boxshop_before_save_of_data_filter( $data ){
	global $boxshop_theme_options;
	if( isset($boxshop_theme_options['ts_color_scheme'], $data['ts_color_scheme']) && $boxshop_theme_options['ts_color_scheme'] != $data['ts_color_scheme'] ){
		$color_name = $data['ts_color_scheme'];
		$xml_folder = get_template_directory() . '/admin/color_xml/';
		$file_path = $xml_folder . $color_name . '.xml';
		$obj_xml = simplexml_load_file( $file_path );
		if( $obj_xml !== false ){
			foreach($obj_xml->children() as $child ){
				if( isset($child->name, $child->value) ){
					$name = (string)$child->name;
					$value = (string)$child->value;
					if( isset($data[$name]) ){
						$data[$name] = $value;
					}
				}
			}
		}
	}
	
	return $data;
}
add_filter('boxshop_of_options_before_save', 'boxshop_before_save_of_data_filter', 10, 1);
?>
