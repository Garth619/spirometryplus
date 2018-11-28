<?php 
/*** TS Portfolio ***/
if( !class_exists('TS_Portfolios') ){
	class TS_Portfolios{
	
		public $post_type;
		public $thumb_size_name;
		public $thumb_size_array;
		public $like_meta_key = '_ts_portfolio_like_num';
		public $like_user_meta_key = '_ts_portfolio_likes';
		
		function __construct(){
			$this->post_type = 'ts_portfolio';
			$this->thumb_size_name = 'ts_portfolio_thumb';
			$this->thumb_size_array = array(380, 300);
			$this->add_image_size();
			
			add_action('init', array($this, 'register_post_type'));
			add_action('init', array($this, 'register_taxonomy'));
			
			if( is_admin() ){
				add_filter('enter_title_here', array($this, 'enter_title_here'));
				add_filter('manage_'.$this->post_type.'_posts_columns', array($this, 'custom_column_headers'), 10);
				add_action('manage_'.$this->post_type.'_posts_custom_column', array($this, 'custom_columns'), 10, 2);
			}
			
			/* Ajax update like */
			add_action('wp_ajax_ts_portfolio_update_like', array($this, 'update_like'));
			add_action('wp_ajax_nopriv_ts_portfolio_update_like', array($this, 'update_like'));
			
		}
		
		function add_image_size(){
			global $_wp_additional_image_sizes;
			if( !isset($_wp_additional_image_sizes[$this->thumb_size_name]) ){
				add_image_size($this->thumb_size_name, $this->thumb_size_array[0], $this->thumb_size_array[1], true);
			}
		}
		
		function register_post_type(){
			register_post_type($this->post_type, array(
				'labels' => array(
							'name' 					=> esc_html_x('Portfolios', 'post type general name','themesky'),
							'singular_name' 		=> esc_html_x('Portfolios', 'post type singular name','themesky'),
							'all_items' 			=> esc_html__('All Portfolios', 'themesky'),
							'add_new' 				=> esc_html_x('Add Portfolio', 'Team','themesky'),
							'add_new_item' 			=> esc_html__('Add Portfolio','themesky'),
							'edit_item' 			=> esc_html__('Edit Portfolio','themesky'),
							'new_item' 				=> esc_html__('New Portfolio','themesky'),
							'view_item' 			=> esc_html__('View Portfolio','themesky'),
							'search_items' 			=> esc_html__('Search Portfolio','themesky'),
							'not_found' 			=> esc_html__('No Portfolio found','themesky'),
							'not_found_in_trash' 	=> esc_html__('No Portfolio found in Trash','themesky'),
							'parent_item_colon' 	=> '',
							'menu_name' 			=> esc_html__('Portfolios','themesky'),
				)
				,'singular_label' 		=> esc_html__('Portfolio','themesky')
				,'public' 				=> true
				,'publicly_queryable' 	=> true
				,'show_ui' 				=> true
				,'show_in_menu' 		=> true
				,'capability_type' 		=> 'post'
				,'hierarchical' 		=> false
				,'supports'  			=> array('title', 'custom-fields', 'editor', 'thumbnail')
				,'has_archive' 			=> false
				,'rewrite' 				=> array('slug' => str_replace('ts_', '', $this->post_type), 'with_front' => true)
				,'query_var' 			=> false
				,'can_export' 			=> true
				,'show_in_nav_menus' 	=> false
				,'menu_position' 		=> 5
				,'menu_icon' 			=> ''
			));	
		}
		
		function register_taxonomy(){
			$args = array(
					'labels' => array(
								'name'                => esc_html_x( 'Categories', 'taxonomy general name', 'themesky' ),
								'singular_name'       => esc_html_x( 'Category', 'taxonomy singular name', 'themesky' ),
								'search_items'        => esc_html__( 'Search Categories', 'themesky' ),
								'all_items'           => esc_html__( 'All Categories', 'themesky' ),
								'parent_item'         => esc_html__( 'Parent Category', 'themesky' ),
								'parent_item_colon'   => esc_html__( 'Parent Category:', 'themesky' ),
								'edit_item'           => esc_html__( 'Edit Category', 'themesky' ),
								'update_item'         => esc_html__( 'Update Category', 'themesky' ),
								'add_new_item'        => esc_html__( 'Add New Category', 'themesky' ),
								'new_item_name'       => esc_html__( 'New Category Name', 'themesky' ),
								'menu_name'           => esc_html__( 'Categories', 'themesky' )
								)
					,'public' 				=> true
					,'hierarchical' 		=> true
					,'show_ui' 				=> true
					,'show_admin_column' 	=> true
					,'query_var' 			=> true
					,'show_in_nav_menus' 	=> false
					,'show_tagcloud' 		=> false
					);
			register_taxonomy('ts_portfolio_cat', $this->post_type, $args);
		}
		
		function enter_title_here( $title ) {
			if( get_post_type() == $this->post_type ) {
				$title = esc_html__('Enter the portfolio title here', 'themesky');
			}
			return $title;
		}
		
		function get_portfolios( $args = array() ){
			$defaults = array(
				'limit' 		=> 5
				,'orderby' 		=> 'menu_order'
				,'order' 		=> 'DESC'
				,'id' 			=> 0
				,'category' 	=> 0
				,'size' 		=> $this->thumb_size_name
			);

			$args = wp_parse_args($args, $defaults);

			$query_args = array();
			$query_args['post_type'] = $this->post_type;
			$query_args['posts_per_page'] = $args['limit'];
			$query_args['orderby'] = $args['orderby'];
			$query_args['order'] = $args['order'];

			if ( is_numeric($args['id']) && (intval($args['id']) > 0) ) {
				$query_args['p'] = intval( $args['id'] );
			}

			/* Whitelist checks */
			if ( !in_array($query_args['orderby'], array( 'none', 'ID', 'author', 'title', 'date', 'modified', 'parent', 'rand', 'comment_count', 'menu_order', 'meta_value', 'meta_value_num' )) ) {
				$query_args['orderby'] = 'date';
			}

			if ( !in_array( $query_args['order'], array( 'ASC', 'DESC' ) ) ) {
				$query_args['order'] = 'DESC';
			}

			if ( !in_array( $query_args['post_type'], get_post_types() ) ) {
				$query_args['post_type'] = $this->post_type;
			}
			
			$tax_field_type = '';
			/* If the category ID is specified */
			if ( is_numeric( $args['category'] ) && 0 < intval( $args['category'] ) ) {
				$tax_field_type = 'id';
			}

			/* If the category slug is specified */
			if ( !is_numeric( $args['category'] ) && is_string( $args['category'] ) ) {
				$tax_field_type = 'slug';
			}

			/* Setup the taxonomy query */
			if ( '' != $tax_field_type ) {
				$term = $args['category'];
				if ( is_string( $term ) ) { $term = esc_html( $term ); } else { $term = intval( $term ); }
				$query_args['tax_query'] = array( array( 'taxonomy' => 'ts_portfolio_cat', 'field' => $tax_field_type, 'terms' => array( $term ) ) );
			}

			/* The Query */
			$query = get_posts( $query_args );

			/* The Display */
			if ( !is_wp_error( $query ) && is_array( $query ) && count( $query ) > 0 ) {
				foreach ( $query as $k => $v ) {
					$meta = get_post_custom( $v->ID );

					/* Get the image */
					$query[$k]->image = $this->get_image( $v->ID, $args['size'] );

					/* Get custom meta data */
				}
			} else {
				$query = false;
			}

			return $query;
		}
		
		function get_image( $id, $size = '' ){
			$response = '';

			if ( has_post_thumbnail( $id ) ) {
				if ( ( is_int( $size ) || ( 0 < intval( $size ) ) ) && ! is_array( $size ) ) {
					$size = array( intval( $size ), intval( $size ) );
				} elseif ( ! is_string( $size ) && ! is_array( $size ) ) {
					$size = $this->thumb_size_array;
				}
				$response = get_the_post_thumbnail( intval( $id ), $size );
			}

			return $response;
		}
		
		function custom_columns( $column_name, $id ){
			global $wpdb, $post;

			$meta = get_post_custom( $id );
			switch ( $column_name ) {
				case 'image':
					$value = '';
					$value = $this->get_image( $id, 40 );
					echo $value;
				break;
				default:
				break;

			}
		}
		
		function custom_column_headers( $defaults ){
			$new_columns = array( 'image' => esc_html__( 'Image', 'themesky' ) );
			$last_item = '';
			if( isset($defaults['date']) ) { unset($defaults['date']); }
			if( count($defaults) > 2 ) {
				$last_item = array_slice($defaults, -1);
				array_pop($defaults);
			}
			
			$defaults = array_merge($defaults, $new_columns);
			if( $last_item != '' ) {
				foreach ( $last_item as $k => $v ) {
					$defaults[$k] = $v;
					break;
				}
			}

			return $defaults;
		}
		
		function get_like( $post_id = 0 ){
			global $post;
			if( !$post_id ){
				return 0;
			}
			$like_num = get_post_meta($post_id, $this->like_meta_key, true);
			$like_num = apply_filters('ts_portfolio_like_num', $like_num, $post_id);
			return absint($like_num);
		}
		
		function update_like(){
			if( !is_user_logged_in() ){
				die('');
			}
			
			if( isset($_POST['post_id']) ){
				$post_id = $_POST['post_id'];
				$like_num = $this->get_like( $post_id );
				if( $this->user_already_like( $post_id ) ){ /* Unlike */
					$like_num--;
					$this->user_update_like($post_id, false);
				}
				else{
					$like_num++;
					$this->user_update_like($post_id, true);
				}
				update_post_meta($post_id, $this->like_meta_key, $like_num);
				die((string)$like_num);
			}
			
			die('');
		}
		
		function user_already_like( $post_id ){
			if( is_user_logged_in() ){
				$user_id = get_current_user_id();
				$user_likes = get_user_meta($user_id, $this->like_user_meta_key, true);
				$user_likes = maybe_unserialize( $user_likes );
				if( is_array($user_likes) && in_array($post_id, $user_likes) ){
					return true;
				}
			}
			return apply_filters('ts_portfolio_already_like', false, $post_id);
		}
		
		function user_update_like( $post_id, $is_like = true ){
			if( is_user_logged_in() ){
				$user_id = get_current_user_id();
				$user_likes = get_user_meta($user_id, $this->like_user_meta_key, true);
				$user_likes = maybe_unserialize( $user_likes );
				if( $is_like ){
					if( !is_array($user_likes) ){
						$user_likes = array();
					}
					$user_likes[] = $post_id;
				}
				else{ /* Unlike */
					if( is_array($user_likes) && in_array($post_id, $user_likes) ){
						$key = array_search($post_id, $user_likes);
						unset($user_likes[$key]);
						$user_likes = array_values($user_likes);
					}
				}
				$user_likes = serialize($user_likes);
				update_user_meta($user_id, $this->like_user_meta_key, $user_likes);
			}
		}
		
	}
}
global $ts_portfolios;
$ts_portfolios = new TS_Portfolios();

/*** TS Team ***/
if( !class_exists('TS_Team_Members') ){
	class TS_Team_Members{
	
		public $post_type;
		public $thumb_size_name;
		public $thumb_size_array;
		
		function __construct(){
			$this->post_type = 'ts_team';
			$this->thumb_size_name = 'ts_team_thumb';
			$this->thumb_size_array = array(380, 286);
			$this->add_image_size();
			
			add_action('init', array($this, 'register_post_type'));
			
			if( is_admin() ){
				add_filter('enter_title_here', array($this, 'enter_title_here'));
				add_filter('manage_'.$this->post_type.'_posts_columns', array($this, 'custom_column_headers'), 10);
				add_action('manage_'.$this->post_type.'_posts_custom_column', array($this, 'custom_columns'), 10, 2);
			}
		}
		
		function add_image_size(){
			global $_wp_additional_image_sizes;
			if( !isset($_wp_additional_image_sizes[$this->thumb_size_name]) ){
				add_image_size($this->thumb_size_name, $this->thumb_size_array[0], $this->thumb_size_array[1], true);
			}
		}
		
		function register_post_type(){
			register_post_type($this->post_type, array(
				'labels' => array(
							'name' 					=> esc_html_x('Team Members', 'post type general name','themesky'),
							'singular_name' 		=> esc_html_x('Team Members', 'post type singular name','themesky'),
							'all_items' 			=> esc_html__('All Team Members', 'themesky'),
							'add_new' 				=> esc_html_x('Add Member', 'Team','themesky'),
							'add_new_item' 			=> esc_html__('Add Member','themesky'),
							'edit_item' 			=> esc_html__('Edit Member','themesky'),
							'new_item' 				=> esc_html__('New Member','themesky'),
							'view_item' 			=> esc_html__('View Member','themesky'),
							'search_items' 			=> esc_html__('Search Member','themesky'),
							'not_found' 			=> esc_html__('No Member found','themesky'),
							'not_found_in_trash' 	=> esc_html__('No Member found in Trash','themesky'),
							'parent_item_colon' 	=> '',
							'menu_name' 			=> esc_html__('Team Members','themesky'),
				)
				,'singular_label' 		=> esc_html__('Team','themesky')
				,'public' 				=> false
				,'publicly_queryable' 	=> true
				,'exclude_from_search' 	=> true
				,'show_ui' 				=> true
				,'show_in_menu' 		=> true
				,'capability_type' 		=> 'page'
				,'hierarchical' 		=> false
				,'supports'  			=> array('title', 'custom-fields', 'editor', 'thumbnail')
				,'has_archive' 			=> false
				,'rewrite' 				=> array('slug' => str_replace('ts_', '', $this->post_type), 'with_front' => true)
				,'query_var' 			=> false
				,'can_export' 			=> true
				,'show_in_nav_menus' 	=> false
				,'menu_position' 		=> 5
				,'menu_icon' 			=> ''
			));	
		}
		
		function enter_title_here( $title ) {
			if( get_post_type() == $this->post_type ) {
				$title = esc_html__('Enter the member name here', 'themesky');
			}
			return $title;
		}
		
		function get_team_members( $args = array() ){
			$defaults = array(
				'limit' => 5
				,'orderby' => 'menu_order'
				,'order' => 'DESC'
				,'id' => 0
				,'size' => $this->thumb_size_name
			);

			$args = wp_parse_args($args, $defaults);

			$query_args = array();
			$query_args['post_type'] = $this->post_type;
			$query_args['posts_per_page'] = $args['limit'];
			$query_args['orderby'] = $args['orderby'];
			$query_args['order'] = $args['order'];

			if ( is_numeric($args['id']) && (intval($args['id']) > 0) ) {
				$query_args['p'] = intval( $args['id'] );
			}

			/* Whitelist checks */
			if ( !in_array($query_args['orderby'], array( 'none', 'ID', 'author', 'title', 'date', 'modified', 'parent', 'rand', 'comment_count', 'menu_order', 'meta_value', 'meta_value_num' )) ) {
				$query_args['orderby'] = 'date';
			}

			if ( !in_array( $query_args['order'], array( 'ASC', 'DESC' ) ) ) {
				$query_args['order'] = 'DESC';
			}

			if ( !in_array( $query_args['post_type'], get_post_types() ) ) {
				$query_args['post_type'] = $this->post_type;
			}

			/* The Query */
			$query = get_posts( $query_args );

			/* The Display */
			if ( !is_wp_error( $query ) && is_array( $query ) && count( $query ) > 0 ) {
				foreach ( $query as $k => $v ) {
					$meta = get_post_custom( $v->ID );

					/* Get the image */
					$query[$k]->image = $this->get_image( $v->ID, $args['size'] );

					/* Get custom meta data */
				}
			} else {
				$query = false;
			}

			return $query;
		}
		
		function get_image( $id, $size = '' ){
			$response = '';

			if ( has_post_thumbnail( $id ) ) {
				if ( ( is_int( $size ) || ( 0 < intval( $size ) ) ) && ! is_array( $size ) ) {
					$size = array( intval( $size ), intval( $size ) );
				} elseif ( ! is_string( $size ) && ! is_array( $size ) ) {
					$size = $this->thumb_size_array;
				}
				$response = get_the_post_thumbnail( intval( $id ), $size );
			}

			return $response;
		}
		
		function custom_columns( $column_name, $id ){
			global $wpdb, $post;

			$meta = get_post_custom( $id );
			switch ( $column_name ) {
				case 'image':
					$value = '';
					$value = $this->get_image( $id, 40 );
					echo $value;
				break;
				case 'role':
					if( isset($meta['_role'][0]) ){
						echo $meta['_role'][0];
					}
					else{
						echo '';
					}
				break;
				default:
				break;

			}
		}
		
		function custom_column_headers( $defaults ){
			$new_columns = array( 'image' => esc_html__( 'Image', 'themesky' ), 'role' => esc_html__( 'Role', 'themesky' ) );
			$last_item = '';
			if( isset($defaults['title']) ) { $defaults['title'] = esc_html__('Member name', 'themesky'); }
			if( isset($defaults['date']) ) { unset($defaults['date']); }
			if( count($defaults) > 2 ) {
				$last_item = array_slice($defaults, -1);
				array_pop($defaults);
			}
			
			$defaults = array_merge($defaults, $new_columns);
			if( $last_item != '' ) {
				foreach ( $last_item as $k => $v ) {
					$defaults[$k] = $v;
					break;
				}
			}

			return $defaults;
		}
		
	}
}
global $ts_team_members;
$ts_team_members = new TS_Team_Members();

/*** TS Testimonial ***/
if( !class_exists('TS_Testimonials') ){
	class TS_Testimonials{
		public $post_type;
		public $thumb_size_name;
		public $thumb_size_array;
		
		function __construct(){
			$this->post_type = 'ts_testimonial';
			$this->thumb_size_name = 'ts_testimonial_thumb';
			$this->thumb_size_array = array(100, 100);
			$this->add_image_size();
			
			add_action('init', array($this, 'register_post_type'));
			add_action('init', array($this, 'register_taxonomy'));
			
			if( is_admin() ){
				add_filter('enter_title_here', array($this, 'enter_title_here'));
				add_filter('manage_'.$this->post_type.'_posts_columns', array($this, 'custom_column_headers'), 10);
				add_action('manage_'.$this->post_type.'_posts_custom_column', array($this, 'custom_columns'), 10, 2);
			}
		}
		
		function add_image_size(){
			global $_wp_additional_image_sizes;
			if( !isset($_wp_additional_image_sizes[$this->thumb_size_name]) ){
				add_image_size($this->thumb_size_name, $this->thumb_size_array[0], $this->thumb_size_array[1], true);
			}
		}
		
		function register_post_type(){
			$labels = array(
				'name' 				=> esc_html_x( 'Testimonials', 'post type general name', 'themesky' ),
				'singular_name' 	=> esc_html_x( 'Testimonial', 'post type singular name', 'themesky' ),
				'add_new' 			=> esc_html_x( 'Add New', 'testimonial', 'themesky' ),
				'add_new_item' 		=> esc_html__( 'Add New Testimonial', 'themesky' ),
				'edit_item' 		=> esc_html__( 'Edit Testimonial', 'themesky' ),
				'new_item' 			=> esc_html__( 'New Testimonial', 'themesky' ),
				'all_items' 		=> esc_html__( 'All Testimonials', 'themesky' ),
				'view_item' 		=> esc_html__( 'View Testimonial', 'themesky' ),
				'search_items' 		=> esc_html__( 'Search Testimonials', 'themesky' ),
				'not_found' 		=> esc_html__( 'No Testimonials Found', 'themesky' ),
				'not_found_in_trash'=> esc_html__( 'No Testimonials Found In Trash', 'themesky' ),
				'parent_item_colon' => '',
				'menu_name' 		=> esc_html__( 'Testimonials', 'themesky' )
			);
			$args = array(
				'labels' 			=> $labels,
				'public' 			=> true,
				'publicly_queryable'=> true,
				'show_ui' 			=> true,
				'show_in_menu' 		=> true,
				'query_var' 		=> true,
				'rewrite' 			=> array( 'slug' => $this->post_type ),
				'capability_type' 	=> 'post',
				'has_archive' 		=> 'ts_testimonials',
				'hierarchical' 		=> false,
				'supports' 			=> array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
				'menu_position' 	=> 5,
				'menu_icon' 		=> ''
			);
			register_post_type( $this->post_type, $args );
		}
		
		function register_taxonomy(){
			$args = array(
					'labels' => array(
								'name'                => esc_html_x( 'Categories', 'taxonomy general name', 'themesky' ),
								'singular_name'       => esc_html_x( 'Category', 'taxonomy singular name', 'themesky' ),
								'search_items'        => esc_html__( 'Search Categories', 'themesky' ),
								'all_items'           => esc_html__( 'All Categories', 'themesky' ),
								'parent_item'         => esc_html__( 'Parent Category', 'themesky' ),
								'parent_item_colon'   => esc_html__( 'Parent Category:', 'themesky' ),
								'edit_item'           => esc_html__( 'Edit Category', 'themesky' ),
								'update_item'         => esc_html__( 'Update Category', 'themesky' ),
								'add_new_item'        => esc_html__( 'Add New Category', 'themesky' ),
								'new_item_name'       => esc_html__( 'New Category Name', 'themesky' ),
								'menu_name'           => esc_html__( 'Categories', 'themesky' )
								)
					,'public' 				=> true
					,'hierarchical' 		=> true
					,'show_ui' 				=> true
					,'show_admin_column' 	=> true
					,'query_var' 			=> true
					,'show_in_nav_menus' 	=> false
					,'show_tagcloud' 		=> false
					);
			register_taxonomy('ts_testimonial_cat', $this->post_type, $args);
		}
		
		function enter_title_here( $title ) {
			if( get_post_type() == $this->post_type ) {
				$title = esc_html__('Enter the customer\'s name here', 'themesky');
			}
			return $title;
		}
		
		function get_image( $id, $size = '' ){
			$response = '';
			if( $size == '' ){
				$size = $this->thumb_size_array[0];
			}
			if ( has_post_thumbnail( $id ) ) {
				if ( ( is_int( $size ) || ( 0 < intval( $size ) ) ) && ! is_array( $size ) ) {
					$size = array( intval( $size ), intval( $size ) );
				} elseif ( ! is_string( $size ) && ! is_array( $size ) ) {
					$size = $this->thumb_size_array;
				}
				$response = get_the_post_thumbnail( intval( $id ), $size );
			} else {
				$gravatar_email = get_post_meta( $id, 'ts_gravatar_email', true );
				if ( '' != $gravatar_email && is_email( $gravatar_email ) ) {
					$response = get_avatar( $gravatar_email, $size );
				}
			}

			return $response;
		}
		
		function custom_columns( $column_name, $id ){
			global $wpdb, $post;

			$meta = get_post_custom( $id );
			switch ( $column_name ) {
				case 'image':
					$value = '';
					$value = $this->get_image( $id, 40 );
					echo $value;
				break;
				default:
				break;

			}
		}
		
		function custom_column_headers( $defaults ){
			$new_columns = array( 'image' => esc_html__( 'Image', 'themesky' ) );
			$last_item = '';
			
			if( isset($defaults['date']) ) { unset($defaults['date']); }
			if( count($defaults) > 2 ) {
				$last_item = array_slice($defaults, -1);
				array_pop($defaults);
			}
			
			$defaults = array_merge($defaults, $new_columns);
			if( $last_item != '' ) {
				foreach ( $last_item as $k => $v ) {
					$defaults[$k] = $v;
					break;
				}
			}

			return $defaults;
		}
	}
}
global $ts_testimonials;
$ts_testimonials = new TS_Testimonials();

/*** TS Logos ***/
if( !class_exists('TS_Logos') ){
	class TS_Logos{
		public $post_type;
		public $thumb_size_name;
		public $thumb_size_array;
		
		function __construct(){
			$this->post_type = 'ts_logo';
			$this->thumb_size_name = 'ts_logo_thumb';
			$size_options = get_option('ts_logo_setting', array());
			$logo_width = isset($size_options['size']['width'])?$size_options['size']['width']:240;
			$logo_height = isset($size_options['size']['height'])?$size_options['size']['height']:130;
			$this->thumb_size_array = array($logo_width, $logo_height);
			$this->add_image_size();
			
			add_action('init', array($this, 'register_post_type'));
			add_action('init', array($this, 'register_taxonomy'));
			
			if( is_admin() ){
				add_action('admin_menu', array( $this, 'register_setting_page' ));
			}
		}
		
		function add_image_size(){
			global $_wp_additional_image_sizes;
			if( !isset($_wp_additional_image_sizes[$this->thumb_size_name]) ){
				add_image_size($this->thumb_size_name, $this->thumb_size_array[0], $this->thumb_size_array[1], true);
			}
		}
		
		function register_post_type(){
			$labels = array(
				'name' 				=> esc_html_x( 'Logos', 'post type general name', 'themesky' ),
				'singular_name' 	=> esc_html_x( 'Logo', 'post type singular name', 'themesky' ),
				'add_new' 			=> esc_html_x( 'Add New', 'logo', 'themesky' ),
				'add_new_item' 		=> esc_html__( 'Add New Logo', 'themesky' ),
				'edit_item' 		=> esc_html__( 'Edit Logo', 'themesky' ),
				'new_item' 			=> esc_html__( 'New Logo', 'themesky' ),
				'all_items' 		=> esc_html__( 'All Logos', 'themesky' ),
				'view_item' 		=> esc_html__( 'View Logo', 'themesky' ),
				'search_items' 		=> esc_html__( 'Search Logos', 'themesky' ),
				'not_found' 		=>  esc_html__( 'No Logos Found', 'themesky' ),
				'not_found_in_trash'=> esc_html__( 'No Logos Found In Trash', 'themesky' ),
				'parent_item_colon' => '',
				'menu_name' 		=> esc_html__( 'Logos', 'themesky' )
			);
			$args = array(
				'labels' 			=> $labels,
				'public' 			=> true,
				'publicly_queryable'=> true,
				'show_ui' 			=> true,
				'show_in_menu' 		=> true,
				'query_var' 		=> true,
				'rewrite' 			=> array( 'slug' => str_replace('ts_', '', $this->post_type) ),
				'capability_type' 	=> 'post',
				'has_archive' 		=> false,
				'hierarchical' 		=> false,
				'supports' 			=> array( 'title', 'thumbnail' ),
				'menu_position' 	=> 5,
				'menu_icon' 		=> ''
			);
			register_post_type( $this->post_type, $args );
		}
		
		function register_taxonomy(){
			$args = array(
					'labels' => array(
								'name'                => esc_html_x( 'Categories', 'taxonomy general name', 'themesky' ),
								'singular_name'       => esc_html_x( 'Category', 'taxonomy singular name', 'themesky' ),
								'search_items'        => esc_html__( 'Search Categories', 'themesky' ),
								'all_items'           => esc_html__( 'All Categories', 'themesky' ),
								'parent_item'         => esc_html__( 'Parent Category', 'themesky' ),
								'parent_item_colon'   => esc_html__( 'Parent Category:', 'themesky' ),
								'edit_item'           => esc_html__( 'Edit Category', 'themesky' ),
								'update_item'         => esc_html__( 'Update Category', 'themesky' ),
								'add_new_item'        => esc_html__( 'Add New Category', 'themesky' ),
								'new_item_name'       => esc_html__( 'New Category Name', 'themesky' ),
								'menu_name'           => esc_html__( 'Categories', 'themesky' )
								)
					,'public' 				=> true
					,'hierarchical' 		=> true
					,'show_ui' 				=> true
					,'show_admin_column' 	=> true
					,'query_var' 			=> true
					,'show_in_nav_menus' 	=> false
					,'show_tagcloud' 		=> false
					);
			register_taxonomy('ts_logo_cat', $this->post_type, $args);
		}
		
		function register_setting_page(){
			add_submenu_page('edit.php?post_type='.$this->post_type, esc_html__('Logo Settings','themesky'), 
						esc_html__('Settings','themesky'), 'manage_options', 'ts-logo-settings', array($this, 'setting_page_content'));
		}
		
		function setting_page_content(){
			$options_default = array(
							'size' => array(
								'width' => 160
								,'height' => 70
								,'crop' => 1
							)
							,'responsive' => array(
								'break_point'	=> array(0,300, 600, 850, 1180)
								,'item'			=> array(1, 2, 3, 4, 5)
							)
						);
						
			$options = get_option('ts_logo_setting', $options_default);
			if(isset($_POST['ts_logo_save_setting'])){
				$options['size']['width'] = $_POST['width'];
				$options['size']['height'] = $_POST['height'];
				$options['size']['crop'] = $_POST['crop'];
				$options['responsive']['break_point'] = $_POST['responsive']['break_point'];
				$options['responsive']['item'] = $_POST['responsive']['item'];
				update_option('ts_logo_setting', $options);
			}
			if( isset($_POST['ts_logo_reset_setting']) ){
				update_option('ts_logo_setting', $options_default);
				$options = $options_default;
			}
			?>
			<h2 class="ts-logo-settings-page-title"><?php esc_html_e('Logo Settings','themesky'); ?></h2>
			<div id="ts-logo-setting-page-wrapper">
				<form method="post">
					<h3><?php esc_html_e('Image Size', 'themesky'); ?></h3>
					<p class="description"><?php esc_html_e('You must regenerate thumbnails after changing','themesky'); ?></p>
					<table class="form-table">
						<tbody>
							<tr>
								<th scope="row"><label><?php esc_html_e('Image width','themesky'); ?></label></th>
								<td>
									<input type="number" min="1" step="1" name="width" value="<?php echo esc_attr($options['size']['width']); ?>" />
									<p class="description"><?php esc_html_e('Input image width (In pixels)','themesky'); ?></p>
								</td>
							</tr>
							<tr>
								<th scope="row"><label><?php esc_html_e('Image height','themesky'); ?></label></th>
								<td>
									<input type="number" min="1" step="1" name="height" value="<?php echo esc_attr($options['size']['height']); ?>" />
									<p class="description"><?php esc_html_e('Input image height (In pixels)','themesky'); ?></p>
								</td>
							</tr>
							<tr>
								<th scope="row"><label><?php esc_html_e('Crop','themesky'); ?></label></th>
								<td>
									<select name="crop">
										<option value="1" <?php echo ($options['size']['crop']==1)?'selected':''; ?>>Yes</option>
										<option value="0" <?php echo ($options['size']['crop']==0)?'selected':''; ?>>No</option>
									</select>
									<p class="description"><?php esc_html_e('Crop image after uploading','themesky'); ?></p>
								</td>
							</tr>
						</tbody>
					</table>
					<h3><?php esc_html_e('Slider Responsive Options', 'themesky'); ?></h3>
					<div class="responsive-options-wrapper">
						<ul>
							<?php foreach( $options['responsive']['break_point'] as $k => $break){ ?>
							<li>
								<label><?php esc_html_e('Breakpoint from','themesky'); ?></label>
								<input name="responsive[break_point][]" type="number" min="0" step="1" value="<?php echo (int)$break; ?>" class="small-text" />
								<span>px</span>
								<input name="responsive[item][]" type="number" min="0" step="1" value="<?php echo (int)$options['responsive']['item'][$k]; ?>" class="small-text" />
								<label><?php esc_html_e('Items','themesky'); ?></label>
							</li>
							<?php } ?>
						</ul>
					</div>
					
					<input type="submit" name="ts_logo_save_setting" value="<?php esc_html_e('Save changes','themesky'); ?>" class="button button-primary" />
					<input type="submit" name="ts_logo_reset_setting" value="<?php esc_html_e('Reset','themesky'); ?>" class="button" />
				</form>
			</div>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					"use strict";
					jQuery('input[name="ts_logo_reset_setting"]').bind('click', function(e){
						var ok = confirm('Do you want to reset all settings?');
						if( !ok ){
							e.preventDefault();
						}
					});
				});
			</script>
			<?php
		}
	}
}
new TS_Logos();

/*** TS Footer Blocks ***/
if( !class_exists('TS_Footer_Blocks') ){
	class TS_Footer_Blocks{
		public $post_type;
		
		function __construct(){
			$this->post_type = 'ts_footer_block';
			add_action('init', array($this, 'register_post_type'));
			add_action('wp_head', array($this, 'add_custom_css'));
		}
		
		function register_post_type(){
			$labels = array(
				'name' 				=> esc_html_x( 'Footer Blocks', 'post type general name', 'themesky' ),
				'singular_name' 	=> esc_html_x( 'Footer Block', 'post type singular name', 'themesky' ),
				'add_new' 			=> esc_html_x( 'Add New', 'logo', 'themesky' ),
				'add_new_item' 		=> esc_html__( 'Add New', 'themesky' ),
				'edit_item' 		=> esc_html__( 'Edit Footer Block', 'themesky' ),
				'new_item' 			=> esc_html__( 'New Footer Block', 'themesky' ),
				'all_items' 		=> esc_html__( 'All Footer Blocks', 'themesky' ),
				'view_item' 		=> esc_html__( 'View Footer Block', 'themesky' ),
				'search_items' 		=> esc_html__( 'Search Footer Block', 'themesky' ),
				'not_found' 		=> esc_html__( 'No Footer Blocks Found', 'themesky' ),
				'not_found_in_trash'=> esc_html__( 'No Footer Blocks Found In Trash', 'themesky' ),
				'parent_item_colon' => '',
				'menu_name' 		=> esc_html__( 'Footer Blocks', 'themesky' )
			);
			$args = array(
				'labels' 			=> $labels,
				'public' 			=> true,
				'publicly_queryable'=> false,
				'show_ui' 			=> true,
				'show_in_menu' 		=> true,
				'query_var' 		=> true,
				'rewrite' 			=> array( 'slug' => $this->post_type ),
				'capability_type' 	=> 'post',
				'has_archive' 		=> false,
				'hierarchical' 		=> false,
				'supports' 			=> array( 'title', 'editor' ),
				'menu_position' 	=> 5,
			);
			register_post_type( $this->post_type, $args );
		}
		
		function add_custom_css(){
			global $post;
			$args = array(
				'post_type' 		=> $this->post_type
				,'posts_per_page' 	=> -1
				,'post_status'		=> 'publish'
			);
			$posts = new WP_Query($args);
			if( $posts->have_posts() ){
				$custom_css = '';
				while( $posts->have_posts() ){
					$posts->the_post();
					$custom_css .= get_post_meta( $post->ID, '_wpb_shortcodes_custom_css', true );
				}
				if( !empty($custom_css) ){
					echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
					echo $custom_css;
					echo '</style>';
				}
			}
			wp_reset_postdata();
		}
	}
}
new TS_Footer_Blocks();

?>
