<?php
add_action('widgets_init', 'ts_gravatar_profile_load_widgets');

function ts_gravatar_profile_load_widgets()
{
	register_widget('TS_Gravatar_Profile_Widget');
}

if( !class_exists('TS_Gravatar_Profile_Widget') ){
	class TS_Gravatar_Profile_Widget extends WP_Widget {

		function __construct() {
			$widgetOps = array('classname' => 'ts-gravatar-profile-widget', 'description' => esc_html__('Display a mini version of your Gravatar Profile', 'themesky'));
			parent::__construct('ts_gravatar_profile', esc_html__('TS - Gravatar Profile', 'themesky'), $widgetOps);
		}

		function widget( $args, $instance ) {
			extract($args);
			$title 					= apply_filters('widget_title', $instance['title']);
			$email 					= $instance['email'];
			$show_account_links 	= empty($instance['show_account_links'])?0:$instance['show_account_links'];
			
			if( !$email ){
				return;
			}
			
			echo $before_widget;
			if( !empty($title) ){
				echo $before_title . $title . $after_title;
			}
			
			$profile = $this->get_profile( $email );
			if( !empty($profile) ){
			?>
			<div class="widget-content-wrapper">
			<?php
				$profile = wp_parse_args( $profile, array(
					'thumbnailUrl' => ''
					,'profileUrl'   => ''
					,'displayName'  => ''
					,'aboutMe'      => ''
					,'urls'         => array()
					,'accounts'     => array()
				) );
				$gravatar_url = add_query_arg( 's', 320, $profile['thumbnailUrl'] );
				?>
				<div class="thumbnail">
					<img src="<?php echo esc_url($gravatar_url); ?>" alt="<?php echo esc_attr($profile['displayName']); ?>" />
				</div>
				<div class="meta">
					<h4><a href="<?php echo esc_url($profile['profileUrl']); ?>"><?php echo esc_html($profile['displayName']); ?></a></h4>
					<p><?php echo wp_kses_post($profile['aboutMe']); ?></p>
				</div>
				<?php
				if( $show_account_links ){
					$this->display_accounts( (array) $profile['accounts'] );
				}
			?>
			</div>
			<?php
			}
			
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;		
			$instance['title'] 					= strip_tags($new_instance['title']);	
			$instance['email'] 					= trim($new_instance['email']);	
			$instance['email_user'] 			= intval($new_instance['email_user']);
			$instance['show_account_links'] 	= $new_instance['show_account_links'];

			if( $instance['email_user'] > 0 ){
				$user = get_userdata( $instance['email_user'] );
				if( $user !== false ){
					$instance['email'] = $user->user_email;
				}
			}
			
			$cache_key = $this->get_cache_key( $instance['email'] );
			delete_transient( $cache_key );
			
			return $instance;
		}

		function form( $instance ) {
			$defaults = array(
				'title'					=> 'About me'
				,'email'				=> ''
				,'email_user'			=> ''
				,'show_account_links'	=> ''
			);
		
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			$profile_url = admin_url('profile.php');
			$gravatar_url = 'https://gravatar.com';
			
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Enter your title', 'themesky'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('email_user'); ?>"><?php esc_html_e('User', 'themesky'); ?> </label>
				<?php 
				wp_dropdown_users( array(
					'show_option_none' => esc_html__('Custom', 'themesky'),
					'selected'         => $instance['email_user'],
					'name'             => $this->get_field_name('email_user'),
					'id'               => $this->get_field_id('email_user'),
					'class'            => 'widefat',
				) );
				?>
				<span class="description"><?php esc_html_e('Select a user or pick "Custom" and enter a custom email address below', 'themesky'); ?></span>
			</p>
		
			<p>
				<label for="<?php echo $this->get_field_id('email'); ?>"><?php esc_html_e('Custom email address', 'themesky'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr($instance['email']); ?>" />
			</p>
			
			<p>
				<input type="checkbox" id="<?php echo $this->get_field_id('show_account_links'); ?>" name="<?php echo $this->get_field_name('show_account_links'); ?>" value="1" <?php echo ($instance['show_account_links'])?'checked':''; ?> />
				<label for="<?php echo $this->get_field_id('show_account_links'); ?>"><?php esc_html_e('Show social icons', 'themesky'); ?></label>
			</p>
			
			<p>
				<a href="<?php echo esc_url($profile_url) ?>" target="_blank"><?php esc_html_e('Edit Your Profile', 'themesky') ?></a> | 
				<a href="<?php echo esc_url($gravatar_url) ?>" target="_blank"><?php esc_html_e('What is Gravatar?', 'themesky') ?></a>
			</p>
			<?php 
		}
		
		function get_cache_key( $email = '' ){
			$hashed_email = md5( strtolower( trim( $email ) ) );
			$cache_key = 'ts-gprofile-' . $hashed_email;
			return $cache_key;
		}
		
		private function get_profile( $email ) {
			$hashed_email = md5( strtolower( trim( $email ) ) );
			$cache_key = $this->get_cache_key( $email );

			if( ! $profile = get_transient( $cache_key ) ) {
				$profile_url = esc_url_raw( sprintf( '%s.gravatar.com/%s.json', ( is_ssl() ? 'https://secure' : 'http://www' ), $hashed_email ), array( 'http', 'https' ) );

				$expire = 300;
				$response = wp_remote_get( $profile_url, array( 'user-agent' => 'WordPress.com Gravatar Profile Widget' ) );
				$response_code = wp_remote_retrieve_response_code( $response );
				if ( 200 == $response_code ) {
					$profile = wp_remote_retrieve_body( $response );
					$profile = json_decode( $profile, true );

					if ( is_array( $profile ) && ! empty( $profile['entry'] ) && is_array( $profile['entry'] ) ) {
						$expire = 3600; /* Cache 1 hour */
						$profile = $profile['entry'][0];
					} else {
						$profile = array();
					}

				} else {
					$profile = array();
				}

				set_transient( $cache_key, $profile, $expire );
			}
			return $profile;
		}
		
		function display_accounts( $accounts = array() ){
			if( empty( $accounts ) ){
				return;
			}
			?>
			<div class="ts-social-icons">
				<ul class="social-icons">
				<?php foreach( $accounts as $account ) :
					if( $account['verified'] != 'true' ){
						continue;
					}
					$shortname = $account['shortname'];
					$url = $account['url'];
					$sanitized_service_name = $this->get_sanitized_service_name( $shortname );
					$shortname .= ($shortname == 'google')?'-plus':'';
					?>
					<li class="<?php echo esc_attr($shortname) ?>">
						<a href="<?php echo esc_url($url); ?>" title="<?php echo esc_html($sanitized_service_name) ?>">
							<i class="fa fa-<?php echo esc_attr($shortname); ?> icon"></i>
						</a>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
			<?php
		}
		
		private function get_sanitized_service_name( $shortname ) {
			switch( $shortname ) {
				case 'friendfeed':
					return 'FriendFeed';
				case 'linkedin':
					return 'LinkedIn';
				case 'yahoo':
					return 'Yahoo!';
				case 'youtube':
					return 'YouTube';
				case 'wordpress':
					return 'WordPress';
				case 'tripit':
					return 'TripIt';
				case 'myspace':
					return 'MySpace';
				case 'foursquare':
					return 'foursquare';
				case 'google':
					return 'Google+';
				default:
					$shortname = ucwords( $shortname );
			}
			return $shortname;
		}
	}
}

