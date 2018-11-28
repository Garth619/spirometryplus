<?php
add_action('widgets_init', 'ts_flickr_load_widgets');

function ts_flickr_load_widgets()
{
	register_widget('TS_Flickr_Widget');
}

if(!class_exists('TS_Flickr_Widget')){
	class TS_Flickr_Widget extends WP_Widget {

		function __construct() {
			$widgetOps = array('classname' => 'ts-flickr-widget', 'description' => esc_html__('Display your photos from Flickr', 'themesky'));
			parent::__construct('ts_flickr', esc_html__('TS - Flickr', 'themesky'), $widgetOps);
		}

		function widget( $args, $instance ) {
			
			extract($args);
			$title = apply_filters('widget_title', $instance['title']);
			if( strlen(trim($instance['id'])) == 0 ){
				return;
			}
			
			$id 			= $instance['id'];
			$number 		= absint($instance['number']);
			$column 		= absint($instance['column']);
			$display 		= $instance['display'];
			$size 			= $instance['size'];
			$cache_time 	= absint($instance['cache_time']);
			$type 			= 'user';
			
			if( $cache_time == 0 ){
				$cache_time = 12;
			}
			
			echo $before_widget;
			if( $title ){
				echo $before_title . $title . $after_title; 
			}
			unset($instance['title']);
			$transient_key = 'flickr_'.implode('_', $instance);
			
			$cache = get_transient($transient_key);
			
			if( $cache !== false ){
				echo $cache;
			}
			else{
				$url = 'https://www.flickr.com/badge_code_v2.gne?source='.$type.'&'.$type.'='.$id.'&count='.$number.'&display='.$display.'&layout=x&size='.$size;
				
				$args = array(
								'method'      =>    'GET',
								'timeout'     =>    5,
								'redirection' =>    5,
								'httpversion' =>    '1.0',
								'blocking'    =>    true,
								'headers'     =>    array(),
								'body'        =>    null,
								'cookies'     =>    array()
							);
				$statuses = wp_remote_get( $url, $args );
				if( !is_wp_error( $statuses ) ) {
					$statuses =  $statuses['body'];
					$math = preg_match_all('/<a.*?href="(.*?)".*?src="(.*?)".*?<\/a>/ism', $statuses, $match);
					if( is_array($match[0]) ){
						ob_start();
						?>
						<div class="ts-flickr-wrapper columns-<?php echo esc_attr($column); ?>">
							<?php foreach( $match[0] as $index => $image ){
								$item_class = '';
								if( $index % $column == 0 ){
									$item_class = 'first';
								}
								elseif( $index % $column == ($column - 1) ){
									$item_class = 'last';
								}
							?>
							<div class="item <?php echo esc_attr($item_class); ?>"><?php echo  $image; ?></div>
							<?php } ?>
						</div>
						<?php
						$output = ob_get_clean();
						echo $output;
						set_transient($transient_key, $output, $cache_time * HOUR_IN_SECONDS);
					}
				}
			}
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;	
			$instance['title'] 				=  strip_tags($new_instance['title']);
			$instance['id'] 				=  $new_instance['id'];
			$instance['number'] 			=  $new_instance['number'];
			$instance['column'] 			=  $new_instance['column'];
			$instance['display'] 			=  $new_instance['display'];
			$instance['size'] 				=  $new_instance['size'];									
			$instance['cache_time'] 		=  $new_instance['cache_time'];									
			return $instance;
		}

		function form( $instance ) {
			$array_default = array(
							'title'			=> 'Flickr'
							,'id' 			=> ''
							,'number' 		=> 9
							,'column' 		=> 3
							,'display' 		=> 'latest'
							,'size' 		=> 's'
							,'cache_time'	=> 12
							);
							
			$instance = wp_parse_args( (array) $instance, $array_default );
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Enter your title', 'themesky'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('id'); ?>"><?php esc_html_e('Flickr ID', 'themesky'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo esc_attr($instance['id']); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('number'); ?>"><?php esc_html_e('Number of photos', 'themesky'); ?> </label>
				<input class="widefat" type="number" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo esc_attr($instance['number']); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('column'); ?>"><?php esc_html_e('Column', 'themesky'); ?> </label>
				<select class="widefat" id="<?php echo $this->get_field_id('column'); ?>" name="<?php echo $this->get_field_name('column'); ?>" >
					<?php for( $i = 1; $i <= 4; $i++ ): ?>
					<option value="<?php echo $i; ?>" <?php selected($instance['column'], $i); ?> ><?php echo $i; ?></option>
					<?php endfor; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('display'); ?>"><?php esc_html_e('Display', 'themesky'); ?> </label>
				<select class="widefat" id="<?php echo $this->get_field_id('display'); ?>" name="<?php echo $this->get_field_name('display'); ?>" >
					<option value="latest" <?php selected($instance['display'], 'latest'); ?> ><?php esc_html_e('Latest', 'themesky') ?></option>
					<option value="random" <?php selected($instance['display'], 'random'); ?> ><?php esc_html_e('Random', 'themesky') ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('size'); ?>"><?php esc_html_e('Size', 'themesky'); ?> </label>
				<select class="widefat" id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>" >
					<option value="s" <?php selected($instance['size'], 's'); ?> ><?php esc_html_e('Standard', 'themesky') ?></option>
					<option value="m" <?php selected($instance['size'], 'm'); ?> ><?php esc_html_e('Medium', 'themesky') ?></option>
					<option value="t" <?php selected($instance['size'], 't'); ?> ><?php esc_html_e('Thumbnail', 'themesky') ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('cache_time'); ?>"><?php esc_html_e('Cache time (hours)', 'themesky'); ?> </label>
				<input class="widefat" type="number" min="1" id="<?php echo $this->get_field_id('cache_time'); ?>" name="<?php echo $this->get_field_name('cache_time'); ?>" value="<?php echo esc_attr($instance['cache_time']); ?>" />
			</p>
			
			<?php }
	}
}

