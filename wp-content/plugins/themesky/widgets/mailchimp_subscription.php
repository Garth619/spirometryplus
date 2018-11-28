<?php
add_action('widgets_init', 'ts_mailchimp_subscription_load_widgets');

function ts_mailchimp_subscription_load_widgets()
{
	register_widget('TS_Mailchimp_Subscription_Widget');
}

if( !class_exists('TS_Mailchimp_Subscription_Widget') ){
	class TS_Mailchimp_Subscription_Widget extends WP_Widget {

		function __construct() {
			$widgetOps = array('classname' => 'mailchimp-subscription', 'description' => esc_html__('Display Mailchimp Subscription Form', 'themesky'));
			parent::__construct('ts_mailchimp_subscription', esc_html__('TS - Mailchimp Subscription', 'themesky'), $widgetOps);
		}

		function widget( $args, $instance ) {
			extract($args);
			$title = apply_filters('widget_title', $instance['title']);
			
			$intro_text = $instance['intro_text'];
			$bg_image = $instance['bg_image'];
			$form = $instance['form'];
			$text_style = $instance['text_style'];
			
			if( !$form ){
				return;
			}
			
			$before_widget = str_replace('mailchimp-subscription', 'mailchimp-subscription ' . esc_attr($text_style), $before_widget);
			echo $before_widget;
			
			if( $title ){
				echo $before_title . $title . $after_title;
			}
			?>
			<?php if( $bg_image != '' ): ?>
			<img class="bg-newsletter" src="<?php echo esc_url($bg_image); ?>" alt="<?php echo esc_attr($title) ?>" />
			<?php endif; ?>
			<div class="subscribe-widget" >
				
				<?php if( $intro_text != '' ): ?>
				<div class="newsletter">
					<p><?php echo esc_html($intro_text); ?></p>
				</div>
				<?php endif; ?>
				
				<?php echo do_shortcode('[mc4wp_form id="'.$form.'"]'); ?>
			</div>

			<?php
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance 				= $old_instance;		
			$instance['title'] 		= $new_instance['title'];
			$instance['intro_text'] = $new_instance['intro_text'];
			$instance['bg_image'] 	= $new_instance['bg_image'];
			$instance['form'] 		= $new_instance['form'];
			$instance['text_style'] = $new_instance['text_style'];
			return $instance;
		}

		function form( $instance ) {
			
			$defaults = array(
				'title' 			=> 'Newsletter' 
				,'intro_text' 		=> 'Enjoy our newsletter to stay updated with the latest news and special sales. Let\'s your email address here!'
				,'form' 			=> ''
				,'bg_image'			=> ''
				,'text_style'		=> 'text-default'
			);
		
			$instance = wp_parse_args( (array) $instance, $defaults );
			$mc_forms = array();
			if( function_exists('boxshop_get_mailchimp_forms') ){
				$mc_forms = boxshop_get_mailchimp_forms();
			}
		?>
			<p>
				<label for="<?php echo $this->get_field_id('form'); ?>"><?php esc_html_e('Select Form', 'themesky'); ?></label>
				<select class="widefat" id="<?php echo $this->get_field_id('form'); ?>" name="<?php echo $this->get_field_name('form'); ?>">
					<option value="" <?php selected($instance['form'], '') ?>></option>
					<?php foreach( $mc_forms as $mc_form ): ?>
					<option value="<?php echo esc_attr($mc_form['id']) ?>" <?php selected($instance['form'], $mc_form['id']) ?>><?php echo esc_html($mc_form['title']) ?></option>
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Enter title', 'themesky'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('intro_text'); ?>"><?php esc_html_e('Enter intro text', 'themesky'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('intro_text'); ?>" name="<?php echo $this->get_field_name('intro_text'); ?>" value="<?php echo esc_attr($instance['intro_text']); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('bg_image'); ?>"><?php esc_html_e('Background image', 'themesky'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('bg_image'); ?>" name="<?php echo $this->get_field_name('bg_image'); ?>" value="<?php echo esc_attr($instance['bg_image']); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('text_style'); ?>"><?php esc_html_e('Text Style', 'themesky'); ?></label>
				<select class="widefat" id="<?php echo $this->get_field_id('text_style'); ?>" name="<?php echo $this->get_field_name('text_style'); ?>">
					<option value="text-default" <?php selected($instance['text_style'], 'text-default') ?>><?php esc_html_e('Default', 'themesky') ?></option>
					<option value="text-light" <?php selected($instance['text_style'], 'text-light') ?>><?php esc_html_e('Light', 'themesky') ?></option>
				</select>
			</p>			
			<?php 
		}
	}
}

