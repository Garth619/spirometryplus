<?php
add_action('widgets_init', 'ts_footer_block_load_widgets');

function ts_footer_block_load_widgets()
{
	register_widget('TS_Footer_Block_Widget');
}

if( !class_exists('TS_Footer_Block_Widget') ){
	class TS_Footer_Block_Widget extends WP_Widget {

		function __construct() {
			$widgetOps = array('classname' => 'ts-footer-block', 'description' => esc_html__('Insert your footer block', 'themesky'));
			parent::__construct('ts_footer_block', esc_html__('TS - Footer Block', 'themesky'), $widgetOps);
		}

		function widget( $args, $instance ) {
			extract($args);
			$block_id = isset($instance['block_id'])?absint($instance['block_id']):'';
			if( !$block_id ){
				return;
			}
			
			global $post;
			
			$args = array(
				'post_type' 		=> 'ts_footer_block'
				,'posts_per_page' 	=> 1
				,'include' 			=> $block_id
			);
			$posts = get_posts($args);
			
			if( is_array($posts) ){
				echo $before_widget;
				foreach( $posts as $post ){
					setup_postdata($post);
					echo do_shortcode(get_the_content());
				}
				echo $after_widget;
			}
			wp_reset_postdata();
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;		
			$instance['block_id'] 	= $new_instance['block_id'];		
			return $instance;
		}

		function form( $instance ) {
			
			$defaults = array(
				'block_id'		=> ''
			);
		
			$instance = wp_parse_args( (array) $instance, $defaults );	
			$footer_blocks = $this->get_footer_blocks();
		?>
			<p>
				<label for="<?php echo $this->get_field_id('block_id'); ?>"><?php esc_html_e('Footer Block', 'themesky'); ?> </label>
				<select name="<?php echo $this->get_field_name('block_id'); ?>" id="<?php echo $this->get_field_id('block_id'); ?>" class="widefat">
					<option value=""></option>
					<?php foreach( $footer_blocks as $block ): ?>
					<option value="<?php echo $block->ID; ?>" <?php selected($block->ID, $instance['block_id']) ?>><?php echo esc_html($block->post_title); ?></option>
					<?php endforeach; ?>
				</select>
			</p>
			<?php 
		}
		
		function get_footer_blocks(){
			$args = array(
				'post_type'			=> 'ts_footer_block'
				,'post_status'	 	=> 'publish'
				,'posts_per_page' 	=> -1
			);
			$posts = new WP_Query($args);
			if( isset($posts->posts) ){
				return $posts->posts;
			}
			return array();
		}
	}
}

