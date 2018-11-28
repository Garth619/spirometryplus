<?php  
class TS_Shortcodes{
	
	function __construct(){
		
		add_filter('the_content', array($this, 'remove_extra_p_tag'));
		add_filter('widget_text', array($this, 'remove_extra_p_tag'));
		
		add_action('wp_enqueue_scripts', array($this, 'register_scripts'));
		add_action('admin_enqueue_scripts', array($this, 'register_admin_scripts'));
		$this->add_shortcode_files();
	}
	
	function remove_extra_p_tag( $content ){
	
		$block = join("|", array('ts_button'));
		/* opening tag */
		$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
			
		/* closing tag */
		$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
	 
		return $rep;
	}
	
	function register_scripts(){
		global $boxshop_theme_options;
		$gmap_api_key = !empty($boxshop_theme_options['ts_gmap_api_key'])?$boxshop_theme_options['ts_gmap_api_key']:'';
		
		$js_dir = plugin_dir_url( __FILE__ ).'js';
		$css_dir = plugin_dir_url( __FILE__ ).'css';
		
		$deps = array();
		if( class_exists('Vc_Manager') ){
			$deps = array('js_composer_front');
		}
		
		wp_register_style('ts-shortcode', $css_dir.'/shortcode.css', $deps);
		wp_enqueue_style('ts-shortcode');
		
		wp_register_style( 'owl-carousel', $css_dir . '/owl.carousel.css' );
		wp_enqueue_style( 'owl-carousel' );
		
		wp_register_script('ts-shortcode', $js_dir.'/shortcode.js', array('jquery'), null, true);
		wp_enqueue_script('ts-shortcode');
		
		wp_register_script( 'owl-carousel', $js_dir.'/owl.carousel.min.js', array(), null, true);
		wp_enqueue_script( 'owl-carousel' );
		
		$gmap_api_link = 'https://maps.googleapis.com/maps/api/js';
		if( $gmap_api_key ){
			$gmap_api_link .= '?key=' . $gmap_api_key;
		}
		wp_register_script('gmap-api', $gmap_api_link, array(), null, true);
		
		if( defined('ICL_LANGUAGE_CODE') ){
			$ajax_uri = admin_url('admin-ajax.php?lang='.ICL_LANGUAGE_CODE, 'relative');
		}
		else{
			$ajax_uri = admin_url('admin-ajax.php', 'relative');
		}
		$data = array(
			'ajax_uri'	=> $ajax_uri
		);
		wp_localize_script('ts-shortcode', 'ts_shortcode_params', $data);
	}
	
	function register_admin_scripts(){
		$css_dir = plugin_dir_url( __FILE__ ).'css';
		
		wp_register_style('ts-core-admin', $css_dir.'/admin.css');
		wp_enqueue_style('ts-core-admin');
	}
	
	function add_shortcode_files(){
		$file_names = array('content_shortcodes','woo_shortcodes');
		$dir = plugin_dir_path( __FILE__ ).'shortcodes';
		foreach( $file_names as $file_name ){
			$file = $dir.'/'.$file_name.'.php';
			if( file_exists($file) )
				require_once $file;
		}
		
	}
	
}
new TS_Shortcodes();
?>
