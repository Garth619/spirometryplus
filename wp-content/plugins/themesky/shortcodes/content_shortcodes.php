<?php 
/************************************
*** Custom Post Type Shortcodes
*************************************/
/*** Shortcode Team memmber ***/
function ts_team_member_shortcode($atts){
	extract(shortcode_atts(array(
						'id'				=> ''
						,'target'			=> '_blank'
						,'excerpt_words'	=> 30						
					), $atts ));
					
	if( strlen(trim($id)) == 0 || !is_numeric($id) ){
		return;
	}
	if( !is_numeric($excerpt_words) ){
		$excerpt_words = 30;
	}
	
	ob_start();
	global $post, $ts_team_members;
	$thumb_size_name = isset($ts_team_members->thumb_size_name)?$ts_team_members->thumb_size_name:'ts_team_thumb';
	
	$args = array(
				'post_type'				=> 'ts_team'
				,'post_status'			=> 'publish'
				,'ignore_sticky_posts'	=> true
				,'p'					=> $id
			);
	
	$team = new WP_Query($args);
	if( $team->have_posts() ){
		while( $team->have_posts() ){
			$team->the_post();
			$profile_link = get_post_meta($post->ID, 'ts_profile_link', true);
			if( $profile_link == '' ){
				$profile_link = '#';
			}
			$name = get_the_title($post->ID);
			if( function_exists('boxshop_the_excerpt_max_words') ){
				$content = boxshop_the_excerpt_max_words($excerpt_words, $post, true, '', false);
			}
			else{
				$content = substr(wp_strip_all_tags($post->post_content), 0, 300);
			}
			$role = get_post_meta($post->ID, 'ts_role', true);
			
			$facebook_link = get_post_meta($post->ID, 'ts_facebook_link', true);
			$twitter_link = get_post_meta($post->ID, 'ts_twitter_link', true);
			$google_plus_link = get_post_meta($post->ID, 'ts_google_plus_link', true);
			$linkedin_link = get_post_meta($post->ID, 'ts_linkedin_link', true);
			$rss_link = get_post_meta($post->ID, 'ts_rss_link', true);
			$dribbble_link = get_post_meta($post->ID, 'ts_dribbble_link', true);
			$pinterest_link = get_post_meta($post->ID, 'ts_pinterest_link', true);
			$instagram_link = get_post_meta($post->ID, 'ts_instagram_link', true);
			$custom_link = get_post_meta($post->ID, 'ts_custom_link', true);
			$custom_link_icon_class = get_post_meta($post->ID, 'ts_custom_link_icon_class', true);
			
			$social_content = '';
			
			if( $facebook_link ){
				$social_content .= '<a class="facebook" href="'.esc_url($facebook_link).'" target="'.$target.'"><i class="fa fa-facebook"></i></a>';
			}
			if( $twitter_link ){
				$social_content .= '<a class="twitter" href="'.esc_url($twitter_link).'" target="'.$target.'"><i class="fa fa-twitter"></i></a>';
			}
			if( $google_plus_link ){
				$social_content .= '<a class="google" href="'.esc_url($google_plus_link).'" target="'.$target.'"><i class="fa fa-google-plus"></i></a>';
			}
			if( $linkedin_link ){
				$social_content .= '<a class="linked" href="'.esc_url($linkedin_link).'" target="'.$target.'"><i class="fa fa-linkedin"></i></a>';
			}
			if( $rss_link ){
				$social_content .= '<a class="rss" href="'.esc_url($rss_link).'" target="'.$target.'"><i class="fa fa-rss"></i></a>';
			}
			if( $dribbble_link ){
				$social_content .= '<a class="dribbble" href="'.esc_url($dribbble_link).'" target="'.$target.'"><i class="fa fa-dribbble"></i></a>';
			}
			if( $pinterest_link ){
				$social_content .= '<a class="pinterest" href="'.esc_url($pinterest_link).'" target="'.$target.'"><i class="fa fa-pinterest-p"></i></a>';
			}
			if( $instagram_link ){
				$social_content .= '<a class="instagram" href="'.esc_url($instagram_link).'" target="'.$target.'"><i class="fa fa-instagram"></i></a>';
			}
			if( $custom_link ){
				$social_content .= '<a class="custom" href="'.esc_url($custom_link).'" target="'.$target.'"><i class="fa '.esc_attr($custom_link_icon_class).'"></i></a>';
			}
			
			?>
			<div class="ts-team-member">
				<div class="content-thumbnail">
					<?php if( has_post_thumbnail() ): ?>
						<div class="image-thumbnail">
							<figure>
							<?php the_post_thumbnail($thumb_size_name); ?>
							</figure>
						</div>
					<?php endif; ?>
					<div class="member-social"><?php echo $social_content; ?></div>
				</div>
				<header>
					<div class="member-name"><h3><a class="name" href="<?php echo esc_url($profile_link); ?>" target="<?php echo esc_attr($target) ?>"><?php echo esc_html($name); ?></a></h3></div>
					<div class="member-role"><?php echo esc_html($role); ?></div>
					<div class="member-excerpt"><?php echo esc_html($content); ?></div>
				</header>
			</div>
			<?php
		}
	}
	
	wp_reset_postdata();
	
	return ob_get_clean();
}
add_shortcode('ts_team_member', 'ts_team_member_shortcode');

/*** Shortcode Feature ***/
function ts_feature_shortcode( $atts ){
	extract(shortcode_atts(array(
						'style'						=> 'feature-horizontal'
						,'text_style'				=> 'text-default'
						,'horizontal_style'			=> 'icon-small'
						,'class_icon' 				=> ''
						,'class_icon' 				=> ''
						,'has_background' 			=> 0
						,'has_border' 				=> 1
						,'background_color'			=> "#f8f8f8"
						,'border_color'				=> "#ebebeb"
						,'img_id'					=> ''
						,'img_url'					=> ''
						,'thumbnail_hover_effect'	=> 1
						,'title' 					=> ''
						,'excerpt' 					=> ''
						,'link' 					=> ''		
						,'target' 					=> '_blank'
						,'active_feature'			=> 0
						,'extra_class'				=> ''
					), $atts ));
	
	ob_start();
	
	$classes = array();
	$classes[] = 'ts-feature-wrapper';
	$classes[] = $extra_class;
	$classes[] = $style;
	$classes[] = $text_style;
	$classes[] = $horizontal_style;
	if ($has_background){
		$classes[] = 'has-background';
	}
	if($has_border){
		$classes[] = 'has-border';
	}
	if( strlen($img_id) > 0 || strlen($img_url) > 0 ){
		$classes[] = 'has-image';
	}
	if( $link == '' ){
		$classes[] = 'no-link';
	}
	if( $thumbnail_hover_effect == 1){
		$classes[] = 'thumbnail-hover-effect';
	}
	if( $active_feature == 1){
		$classes[] = 'active-feature';
	}
	?>
	<div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
		<div class="feature-content" style="<?php echo $has_background?'background-color:'.$background_color.';':''; echo $has_border?'border-color:'.$border_color:''; ?>">
			<div class="feature-wrapper">
				<?php if( (strlen($class_icon) > 0) && ( strlen($img_id) <= 0 ) && (strlen($img_url) <= 0 ) ): ?>
					<a target="<?php echo esc_attr($target); ?>" class="feature-icon" href="<?php echo ($link != '')?esc_url($link):'javascript: void(0)' ?>">
						<i class="<?php echo esc_attr($class_icon); ?>"></i>
					</a>
				<?php endif; ?>
				
				<?php if(( strlen($img_id) > 0 )|| (strlen($img_url) > 0 )) : ?>
					
					<a target="<?php echo esc_attr($target); ?>" class="feature-thumbnail" href="<?php echo ($link != '')?esc_url($link):'javascript: void(0)' ?>" >
						<?php 
						if( $img_url != '' ){
						?>
							<img title="<?php echo esc_attr($title) ?>" alt="<?php echo esc_attr($title) ?>" src="<?php echo esc_url($img_url) ?>" />
						<?php
						}
						else{
							if( apply_filters('ts_page_intro_feature_filter', false) ){
								$image_loading = get_template_directory_uri() . '/images/prod_loading.gif';
								$image_src = wp_get_attachment_image_src($img_id, 'full');
								if( is_array($image_src) ){
								?>
								<img src="<?php echo esc_url($image_loading) ?>" data-src="<?php echo esc_url($image_src[0]) ?>" alt="<?php echo esc_attr($title) ?>" width="<?php echo esc_attr($image_src[1]) ?>" height="<?php echo esc_attr($image_src[2]) ?>" class="img lazy-loading" />
								<?php
								}
							}
							else{
								echo wp_get_attachment_image($img_id, 'full', 0, array('class'=>'img'));
							}
						}
						?> 
						<span class="overlay"></span>
					</a>
					
				<?php endif; ?>
				
					<header class="feature-header">
				
					<?php if( strlen($title) > 0 ): ?>
						<h3 class="feature-title heading-title entry-title">
							<a target="<?php echo esc_attr($target); ?>" href="<?php echo ($link != '')?esc_url($link):'javascript: void(0)' ?>"><?php echo esc_html($title); ?></a>
						</h3>
					<?php endif; ?>
					
					<?php if( strlen($excerpt) > 0 ): ?>
						<div class="feature-excerpt">
							<?php echo esc_html($excerpt); ?>
						</div>
					<?php endif; ?>
				
					</header>
			</div>
		</div>
	</div>
	<?php
	
	return ob_get_clean();
}
add_shortcode('ts_feature', 'ts_feature_shortcode');

/*** Shortcode Price Table ***/
function ts_price_table_shortcode( $atts ){
	extract(shortcode_atts(array(
						'active_table' 					=> 0
						,'color_scheme'					=> '#e5493a'
						,'title'						=> ''
						,'price' 						=> ''
						,'currency' 					=> ''
						,'during_price' 				=> '/month'
						,'during_price_description' 	=> ''
						,'rating'						=> 0
						,'description'					=> ''
						,'button_text'					=> ''
						,'link'							=> '#'
					), $atts ));
	
	static $ts_price_table_counter = 1;
	$unique_class = 'ts-price-table-' . $ts_price_table_counter;
	$selector = '.' . $unique_class;
	$ts_price_table_counter++;
	
	$inline_style = '<div class="ts-shortcode-custom-style hidden">';
	if( $active_table ){
		$inline_style .= $selector.'{border-color:'.$color_scheme.';}';
	}
	$inline_style .= $selector.':hover{border-color:'.$color_scheme.';}';
	$inline_style .= $selector.' .button-price-table{background:'.$color_scheme.';border-color:'.$color_scheme.';}';
	$inline_style .= $selector.' .button-price-table:hover{';
	$inline_style .= 'background:transparent;color:'.$color_scheme.';border-color:'.$color_scheme.';';
	$inline_style .= '}';
	$inline_style .= '</div>';
	ob_start();
	?>
	<div class="ts-price-table <?php echo esc_attr($unique_class) ?> <?php echo ($active_table)?'active-table':'' ?>">
		<?php echo trim($inline_style); ?>
		<header>
			<span class="table-price" style="color:<?php echo $color_scheme ?>"><span><?php echo esc_html($currency) ?></span><?php echo esc_html($price) ?></span>
			<span class="desc-price" style="color:<?php echo $color_scheme ?>"><?php echo esc_html($during_price) ?></span>
			<div class="during-price-description"><?php echo esc_html($during_price_description) ?></div>
			<h3 class="table-title" style="color:<?php echo $color_scheme ?>"><?php echo esc_html($title) ?></h3>
		</header>
		<div class="table-description">
			<?php if( $rating ): ?>
			<div class="rating" title="Rated <?php echo esc_attr($rating) ?> out of 5">
				<span style="width: <?php echo $rating*100/5; ?>%"></span>
			</div>
			<?php endif; ?>
			<?php echo strip_tags($description, '<ul></ul><li></li><b></b><strong></strong><i></i>'); ?>
			<a class="button button-price-table" href="<?php echo esc_url($link) ?>"><?php echo esc_html($button_text) ?></a>
		</div>
	</div>
	<?php
	
	return ob_get_clean();
}
add_shortcode('ts_price_table', 'ts_price_table_shortcode');

/*** Shortcode Testimonial ***/
function ts_testimonial_shortcode($atts){
	extract(shortcode_atts(array(
						'categories'			=> ''
						,'per_page'				=> 4
						,'show_avatar'			=> 1
						,'text_color_style'		=> 'text-default'
						,'ids'					=> ''
						,'excerpt_words'		=> 50
						,'is_slider'			=> 1
						,'show_nav'				=> 1
						,'show_dots'			=> 0
						,'auto_play'			=> 1
					), $atts ));
	
	if( !is_numeric($excerpt_words) ){
		$excerpt_words = 50;
	}
	
	if( $show_dots ){
		$show_nav = 0;
	}
	
	ob_start();
	
	global $post, $ts_testimonials;
	
	$args = array(
			'post_type'				=> 'ts_testimonial'
			,'post_status'			=> 'publish'
			,'ignore_sticky_posts'	=> true
			,'posts_per_page' 		=> $per_page
			,'orderby' 				=> 'date'
			,'order' 				=> 'desc'
		);
		
	$categories = str_replace(' ', '', $categories);
	if( strlen($categories) > 0 ){
		$categories = explode(',', $categories);
	}
	
	if( is_array($categories) && count($categories) > 0 ){
		$field_name = is_numeric($categories[0])?'term_id':'slug';
		$args['tax_query'] = array(
								array(
									'taxonomy' => 'ts_testimonial_cat',
									'terms' => $categories,
									'field' => $field_name,
									'include_children' => false
								)
							);
	}
	
	if( strlen(trim($ids)) > 0 ){
		$ids = array_map('trim', explode(',', $ids));
		if( is_array($ids) && count($ids) > 0 ){
			$args['post__in'] = $ids;
		}
	}
	
	$testimonials = new WP_Query($args);
	if( $testimonials->have_posts() ){
		if( isset($testimonials->post_count) && $testimonials->post_count <= 1 ){
			$is_slider = false;
		}
		?>
		<div class="ts-testimonial-wrapper <?php echo esc_attr($text_color_style) ?> <?php echo ($show_nav)?'show-navi':'';?> <?php echo ($show_dots)?'show-dots':'';?> <?php echo ($is_slider)?'ts-slider loading':''; ?>" 
			data-nav="<?php echo esc_attr($show_nav) ?>" data-dots="<?php echo esc_attr($show_dots) ?>" data-autoplay="<?php echo esc_attr($auto_play) ?>">
		<?php
		while( $testimonials->have_posts() ){
			$testimonials->the_post();
			if( function_exists('boxshop_the_excerpt_max_words') ){
				$content = boxshop_the_excerpt_max_words($excerpt_words, $post, true, '', false);
			}
			else{
				$content = substr(wp_strip_all_tags($post->post_content), 0, 300);
			}
			$byline = get_post_meta($post->ID, 'ts_byline', true);
			$url = get_post_meta($post->ID, 'ts_url', true);
			if( $url == '' ){
				$url = '#';
			}
			$rating = get_post_meta($post->ID, 'ts_rating', true);
			$rating_percent = '0';
			if( $rating != '-1' && $rating != '' ){
				$rating_percent = $rating * 100 / 5;
			}
			
			$gravatar_email = get_post_meta($post->ID, 'ts_gravatar_email', true);
			$has_image = false;
			if( has_post_thumbnail() || ($gravatar_email != '' && is_email($gravatar_email)) ){
				$has_image = true;
			}
			?>
			<div class="item <?php echo (($has_image) && ($show_avatar))?'has-image':'no-image'; ?>">
				<div class="testimonial-content">
					<?php if( ($has_image) && ($show_avatar) ): ?>
					<div class="image">
						<?php echo $ts_testimonials->get_image($post->ID); ?>
					</div>
					<?php endif; ?>
					
					<?php if( $rating != '-1' && $rating != '' ): ?>
					<div class="rating" title="<?php printf(esc_html__('Rated %s out of 5', 'themesky'), $rating); ?>">
						<span style="width: <?php echo $rating_percent.'%'; ?>"><?php printf(esc_html__('Rated %s out of 5', 'themesky'), $rating); ?></span>
					</div>
					<?php endif; ?>
					
					<div class="content">
						<?php echo esc_html($content); ?>
					</div>
					
					<h4 class="name">
						<a href="<?php echo esc_url($url); ?>" target="_blank">
							<?php echo get_the_title($post->ID); ?>
						</a>
					</h4>
					
					<?php if( $byline ): ?>
					<div class="byline">
						<?php echo esc_html($byline); ?>
					</div>
					<?php endif; ?>
					
				</div>
			</div>
			<?php
		}
		?>
		</div>
		<?php
	}
	
	wp_reset_postdata();
	return ob_get_clean();
}
add_shortcode('ts_testimonial', 'ts_testimonial_shortcode');

/*** Shortcode Portfolio ***/
if( !function_exists('ts_portfolio_shortcode') ){
	function ts_portfolio_shortcode( $atts ){
		extract(shortcode_atts(array(
							'title'				=> ''
							,'columns'			=> 2
							,'per_page'			=> 8
							,'categories'		=> ''
							,'orderby'			=> 'none'
							,'order'			=> 'DESC'
							,'show_filter_bar'	=> 1
							,'show_load_more'	=> 1
							,'load_more_text'	=> 'Show more'
							,'show_title'		=> 1
							,'show_categories'	=> 1
							,'show_link_icon'	=> 1
							,'show_like_icon'	=> 1
							,'is_slider'		=> 0
							,'show_nav'			=> 1
							,'auto_play'		=> 1
							,'include'			=> '' // Used for related portfolio
						), $atts ));
						
		if( $is_slider ){
			$show_filter_bar = 0;
			$show_load_more = 0;
		}
		
		$args = array(
			'post_type'				=> 'ts_portfolio'
			,'posts_per_page'		=> $per_page
			,'post_status'			=> 'publish'
			,'ignore_sticky_posts'	=> 1
			,'orderby'				=> $orderby
			,'order'				=> $order
		);	
		
		if( $include ){
			$args['post__in'] = array_map('trim', explode(',', $include));
		}
		
		$categories = str_replace(' ', '', $categories);
		if( strlen($categories) > 0 ){
			$ar_categories = explode(',', $categories);
			if( is_array($ar_categories) && count($ar_categories) > 0 ){
				$field_name = is_numeric($ar_categories[0])?'term_id':'slug';
				$args['tax_query']	= array(
							array(
								'taxonomy'	=> 'ts_portfolio_cat'
								,'field'	=> $field_name
								,'terms'	=> $ar_categories
							)
						);
			}
		}
		ob_start();
		global $post, $wp_query, $ts_portfolios;
		$extra_class = '';
		if(strlen($title) <= 0 && $is_slider){
			$extra_class .= 'no-title ';
		}
		$posts = new WP_Query( $args );
		if( $posts->have_posts() ){
			$atts = compact('columns', 'per_page', 'categories', 'orderby', 'order', 'show_filter_bar', 'show_title','show_categories'
							, 'show_link_icon', 'show_like_icon', 'is_slider', 'show_nav', 'auto_play');
			?>
			<div class="ts-portfolio-wrapper ts-shortcode loading <?php echo $extra_class; ?> <?php echo ($is_slider)?'ts-slider':'ts-masonry columns-'.$columns ?>" data-atts="<?php echo htmlentities(json_encode($atts)); ?>">
			
			<?php if( strlen($title) > 0 && $is_slider ): ?>
				<header class="shortcode-heading-wrapper">
					<h3 class="heading-title"><?php echo esc_html($title); ?></h3>
				</header>
			<?php endif; ?>
			
			<?php
			/* Get filter bar */
			if( $show_filter_bar ){
				$terms = array();
				foreach( $posts->posts as $p ){
					$post_terms = wp_get_post_terms($p->ID, 'ts_portfolio_cat');
					if( is_array($post_terms) ){
						foreach( $post_terms as $term ){
							$terms[$term->slug] = $term->name;
						}
					}
				}
				
				if( !empty($terms) ){
					?>
					<ul class="filter-bar">
						<li data-filter="*" class="current"><?php esc_html_e('All', 'themesky'); ?></li>
						<?php
						foreach( $terms as $slug => $name ){
						?>
						<li data-filter="<?php echo '.'.$slug; ?>"><?php echo esc_attr($name) ?></li>
						<?php
						}
						?>
					</ul>
					<?php
				}
			}
			?>
				<div class="portfolio-inner">
				<?php
					ts_get_portfolio_items_content_shortcode($atts, $posts);
				?>
				</div>
				<?php if( $show_load_more ){ ?>
				<div class="load-more-wrapper">
					<a href="#" class="load-more button" data-paged="2"><?php echo esc_html($load_more_text) ?></a>
				</div>
				<?php } ?>
			</div>
			
			<?php
		}
		
		wp_reset_postdata();
		return ob_get_clean();
	}
}
add_shortcode('ts_portfolio', 'ts_portfolio_shortcode');

add_action('wp_ajax_ts_portfolio_load_items', 'ts_get_portfolio_items_content_shortcode');
add_action('wp_ajax_nopriv_ts_portfolio_load_items', 'ts_get_portfolio_items_content_shortcode');
if( !function_exists('ts_get_portfolio_items_content_shortcode') ){
	function ts_get_portfolio_items_content_shortcode($atts, $posts = null){
		
		global $post, $ts_portfolios;
		
		if( defined( 'DOING_AJAX' ) && DOING_AJAX ){
			if( !isset($_POST['atts']) ){
				die('0');
			}
			$atts = $_POST['atts'];
			$paged = isset($_POST['paged'])?absint($_POST['paged']):1;
			
			extract($atts);
			
			$args = array(
				'post_type'				=> 'ts_portfolio'
				,'posts_per_page'		=> $per_page
				,'post_status'			=> 'publish'
				,'ignore_sticky_posts'	=> 1
				,'paged' 				=> $paged
				,'orderby'				=> $orderby
				,'order'				=> $order
			);	
			$categories = str_replace(' ', '', $categories);
			if( strlen($categories) > 0 ){
				$categories = explode(',', $categories);
				if( is_array($categories) ){
					$field_name = is_numeric($categories[0])?'term_id':'slug';
					$args['tax_query']	= array(
								array(
									'taxonomy'	=> 'ts_portfolio_cat'
									,'field'	=> $field_name
									,'terms'	=> $categories
								)
							);
				}
			}
			$posts = new WP_Query( $args );
			ob_start();
		}
		
		extract($atts);
		
		if( $posts->have_posts() ):
			while( $posts->have_posts() ): $posts->the_post();
				$classes = '';
				$post_terms = wp_get_post_terms($post->ID, 'ts_portfolio_cat');
				if( is_array($post_terms) ){
					foreach( $post_terms as $term ){
						$classes .= $term->slug . ' ';
					}
				}
				
				$link = esc_url(get_post_meta($post->ID, 'ts_portfolio_url', true));
				if( $link == '' ){
					$link = get_permalink();
				}
				
				$bg_color = get_post_meta($post->ID, 'ts_bg_color', true);
				if( $bg_color == '' ){
					$bg_color = '#000';
				}
				
				/* Get Like */
				$like_num = 0;
				$user_already_like = false;
				if( is_a($ts_portfolios, 'TS_Portfolios') ){
					$like_num = $ts_portfolios->get_like( $post->ID );
					$user_already_like = $ts_portfolios->user_already_like( $post->ID );
				}
				?>
				<div class="item <?php echo esc_attr($classes) ?>">
					<figure>
						<span class="bg-hover" style="background-color: <?php echo esc_attr($bg_color); ?>"></span>
						<?php 
						if( has_post_thumbnail() ){
							the_post_thumbnail('ts_portfolio_thumb');
						}
						?>							
					</figure>
					<div class="portfolio-meta">
						<?php if( $show_title ){ ?>
							<h3>
								<a href="<?php echo esc_url($link); ?>">
									<?php echo get_the_title(); ?>
								</a>
							</h3>
						<?php } 
						$categories_list = get_the_term_list($post->ID, 'ts_portfolio_cat', '', ' / ', '');
						if ( $show_categories && $categories_list ):
						?>
						<div class="cats-portfolio">
							<?php echo $categories_list; ?>
						</div>
						<?php endif; ?>
						<div class="icon-group">
							<?php if( $show_link_icon ){ ?>
							<a href="<?php echo esc_url($link); ?>" class="link"></a>
							<?php } ?>
							<?php if( $show_like_icon ){ ?>
							<a href="#" class="like <?php echo ($user_already_like)?'already-like':'' ?>" 
								data-post_id="<?php echo esc_attr($post->ID) ?>" title="<?php echo ($user_already_like)?esc_html__('You liked it', 'themesky'):esc_html__('Like it', 'themesky') ?>"
								data-liked-title="<?php esc_html_e('You liked it', 'themesky') ?>" data-like-title="<?php esc_html_e('Like it', 'themesky') ?>">
								<?php echo esc_html($like_num); ?>
							</a>
							<?php } ?>
						</div>
					</div>
				</div>
			<?php
			endwhile;
		endif;
		
		wp_reset_postdata();
		
		if( defined( 'DOING_AJAX' ) && DOING_AJAX ){
			die(ob_get_clean());
		}
		
	}
}

/*** Shortcode Banner ***/
function ts_banner_shortcode( $atts ){
	extract(shortcode_atts(array(
						'text_align'						=> 'text-left'
						,'heading_title'					=> ''
						,'heading_title_small'				=> ''
						,'description'						=> ''
						,'show_button'						=> 1
						,'button_text'						=> 'Shop now'
						,'text_color'					=> '#ffffff'
						,'button_text_color'				=> '#000000'
						,'button_background_color'			=> '#ffffff'
						,'button_text_color_hover'			=> '#ffffff'
						,'button_background_color_hover'	=> '#e72304'
						,'bg_id'							=> ''
						,'bg_url'							=> ''
						,'bg_color'							=> '#ffffff'
						,'position_content'					=> 'left-top'
						,'link' 							=> ''
						,'style_effect'						=> 'background-scale'
						,'responsive_size'					=> 1
						,'link_title' 						=> ''						
						,'target' 							=> '_blank'
						,'extra_class'						=> ''
					), $atts ));

	static $ts_banner_counter = 1;
	$unique_class = 'ts-banner-'.$ts_banner_counter;
	$selector = '.' . $unique_class;
	$ts_banner_counter++;
	
	$style = '<div class="ts-shortcode-custom-style hidden">';
	$style .= $selector. ' .banner-wrapper{
				background-color: '. $bg_color . ';
			}';
	$style .= $selector.' header h2{
			  color:'.$text_color.';
			  }';
	$style .= $selector.' header h3{
			  color:'.$text_color.';
			  }';
	$style .= $selector.' header .description{
			  color:'.$text_color.';
			  }';
	if( $show_button){
		$style .= $selector.' .button-banner{
				  color:'.$button_text_color.';
				  background-color:'.$button_background_color.';
				  border-color:'.$button_background_color.';
				  }';
		$style .= $selector.' .button-banner:hover{
				  color:'.$button_text_color_hover.';
				  background-color:'.$button_background_color_hover.';
				  border-color:'.$button_background_color_hover.';
				  }';
	}
	$style .= '</div>';
	
	ob_start();
	
	?>
	<div class="ts-banner <?php echo $text_align ?> <?php echo esc_attr($unique_class) ?> <?php echo esc_attr($style_effect) ?> <?php echo ($responsive_size)?'responsive-size':'' ?> <?php echo esc_attr($position_content) ?> <?php echo esc_attr($extra_class) ?>">
		<?php echo trim($style); ?>
		<div class="banner-wrapper">
			<?php if( $link != '' && !$show_button ): ?>
				<a title="<?php echo esc_attr($link_title) ?>" target="<?php echo esc_attr($target); ?>" class="banner-link" href="<?php echo esc_url($link) ?>" ></a>
			<?php endif;?>
			
			<div class="ts-banner-wrapper">
				<div class="banner-bg">
				<?php 
				if( $bg_url != '' ){
				?>
					<img alt="<?php echo esc_attr($link_title) ?>" title="<?php echo esc_attr($link_title) ?>" class="img" src="<?php echo esc_url($bg_url); ?>">
				<?php
				}
				else{
					echo wp_get_attachment_image($bg_id, 'full', 0, array('class'=>'img'));
				}
				?>
				</div>
				
				<header>
					<?php if($heading_title_small != ""): ?>
					<h3><?php echo wp_kses($heading_title_small, array('span' => array('class'=>array()))) ?></h3>
					<?php endif; ?>
				
					<?php if($heading_title != ""): ?>				
					<h2><?php echo wp_kses($heading_title, array('span' => array('class'=>array()))) ?></h2>
					<?php endif; ?>
					
					<?php if($description != ""): ?>
					<div class="description"><?php echo esc_attr($description) ?></div>
					<?php endif; ?>
					
					<?php if( $show_button):?>
					<a title="<?php echo esc_attr($link_title) ?>" target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($link) ?>" class="button-banner button"><?php echo esc_attr($button_text) ?></a>
					<?php endif; ?>
					
				</header>
			</div>
		</div>
	</div>
	<?php
	
	return ob_get_clean();
}
add_shortcode('ts_banner', 'ts_banner_shortcode');

/*** Shortcode Single Image ***/
if( !function_exists('ts_single_image_shortcode') ){
	function ts_single_image_shortcode( $atts ){
		extract(shortcode_atts(array(
							'img_id'			=> ''
							,'img_url'			=> ''
							,'img_size'			=> ''
							,'style_effect'		=> 'eff-widespread-corner-left-right'
							,'effect_color'		=> '#ffffff'
							,'link' 			=> ''
							,'link_title' 		=> ''						
							,'target' 			=> '_blank'
						), $atts ));
						
		if( $img_size == '' ){
			$img_size = 'full';
		}
		
		ob_start();
		?>
		<div class="ts-single-image ts-effect-image <?php echo esc_attr($style_effect) ?>">
			<a title="<?php echo esc_attr($link_title) ?>" target="<?php echo esc_attr($target); ?>" class="image-link" href="<?php echo esc_url($link) ?>" >
				<?php 
				if( $img_url != '' ){
				?>
					<img alt="<?php echo esc_attr($link_title) ?>" title="<?php echo esc_attr($link_title) ?>" class="img" src="<?php echo esc_url($img_url); ?>">
				<?php
				}
				else{
					echo wp_get_attachment_image($img_id, $img_size, 0, array('class'=>'img'));
				}
				?> 
				<span class="overlay" style="background:<?php echo esc_attr($effect_color); ?>;border-color:<?php echo esc_attr($effect_color); ?>"></span>
			</a>
		</div>
		<?php
		
		return ob_get_clean();
	}
}
add_shortcode('ts_single_image', 'ts_single_image_shortcode');

/*** Shortcode Single Image ***/
if( !function_exists('ts_banner_image_shortcode') ){
	function ts_banner_image_shortcode( $atts ){
		extract(shortcode_atts(array(
							'img_bg_id'				=> ''
							,'img_bg_url'			=> ''
							,'img_text_id'			=> ''
							,'img_text_url'			=> ''
							,'img_size'				=> ''
							,'style_effect'			=> 'eff-scale-opacity'
							,'position_img_text'	=> 'left-top'
							,'effect_color'			=> '#ffffff'
							,'link' 				=> ''
							,'link_title' 			=> ''						
							,'target' 				=> '_blank'
						), $atts ));
						
		if( $img_size == '' ){
			$img_size = 'full';
		}
		
		ob_start();
		?>
		<div class="ts-banner-image <?php echo esc_attr($style_effect) ?> <?php echo esc_attr($position_img_text) ?>">
			<a title="<?php echo esc_attr($link_title) ?>" target="<?php echo esc_attr($target); ?>" class="image-link" href="<?php echo esc_url($link) ?>" >
				<?php 
				if( $position_img_text == "static-top"){
					if( $img_text_url != '' ){
					?>
						<img alt="<?php echo esc_attr($link_title) ?>" title="<?php echo esc_attr($link_title) ?>" class="img text-image" src="<?php echo esc_url($img_text_url); ?>">
					<?php
					}
					else{
						echo wp_get_attachment_image($img_text_id, $img_size, 0, array('class'=>'img text-image'));
					}
					if( $img_bg_url != '' ){
					?>
						<img alt="<?php echo esc_attr($link_title) ?>" title="<?php echo esc_attr($link_title) ?>" class="img bg-image" src="<?php echo esc_url($img_bg_url); ?>">
					<?php
					}
					else{
						echo wp_get_attachment_image($img_bg_id, $img_size, 0, array('class'=>'img bg-image'));
					}
				}
				else{	
					if( $img_bg_url != '' ){
					?>
						<img alt="<?php echo esc_attr($link_title) ?>" title="<?php echo esc_attr($link_title) ?>" class="img bg-image" src="<?php echo esc_url($img_bg_url); ?>">
					<?php
					}
					else{
						echo wp_get_attachment_image($img_bg_id, $img_size, 0, array('class'=>'img bg-image'));
					}
					if( $img_text_url != '' ){
					?>
						<img alt="<?php echo esc_attr($link_title) ?>" title="<?php echo esc_attr($link_title) ?>" class="img text-image" src="<?php echo esc_url($img_text_url); ?>">
					<?php
					}
					else{
						echo wp_get_attachment_image($img_text_id, $img_size, 0, array('class'=>'img text-image'));
					}
				}
				?>
				<span class="overlay" style="background:<?php echo esc_attr($effect_color); ?>;border-color:<?php echo esc_attr($effect_color); ?>"></span>
			</a>
		</div>
		<?php
		
		return ob_get_clean();
	}
}
add_shortcode('ts_banner_image', 'ts_banner_image_shortcode');


/*** Shortcode Logo ***/
if( !function_exists('ts_logos_slider_shortcode') ){
	function ts_logos_slider_shortcode( $atts, $content = null ){
		extract(shortcode_atts(array(
					'title'				=> ''
					,'categories' 		=> ''
					,'style_logo'		=> 'style-default'
					,'per_page' 		=> 7
					,'rows' 			=> 1
					,'active_link'		=> 1
					,'show_nav' 		=> 1
					,'auto_play' 		=> 1
					,'margin_image'		=> 20
					), $atts));
		if( !class_exists('TS_Logos') )
			return;
		
		$args = array(
			'post_type'				=> 'ts_logo'
			,'post_status'			=> 'publish'
			,'ignore_sticky_posts'	=> 1
			,'posts_per_page' 		=> $per_page
			,'orderby' 				=> 'date'
			,'order' 				=> 'desc'
		);
		
		$categories = str_replace(' ', '', $categories);
		if( strlen($categories) > 0 ){
			$categories = explode(',', $categories);
		}
		if( is_array($categories) && count($categories) > 0 ){
			$field_name = is_numeric($categories[0])?'term_id':'slug';
			$args['tax_query'] = array(
									array(
										'taxonomy' => 'ts_logo_cat'
										,'terms' => $categories
										,'field' => $field_name
										,'include_children' => false
									)
								);
		}
		
		$logos = new WP_Query($args);
		
		global $post;
		ob_start();
		if( $logos->have_posts() ):
			$count_posts = $logos->post_count;
			
			$classes = array();
			$classes[] = $style_logo;
			if( strlen($title) <= 0 ){
				$classes[] = 'no-title';
			}
			else{
				$classes[] = 'has-title';
			}
			if( $count_posts > 1 && $count_posts > $rows ){
				$classes[] = 'loading';
			}
			if( $show_nav ){
				$classes[] = 'show-nav';
			}
			
			$settings_option = get_option('ts_logo_setting', array());
			$data_break_point = isset($settings_option['responsive']['break_point'])?$settings_option['responsive']['break_point']:array();
			$data_item = isset($settings_option['responsive']['item'])?$settings_option['responsive']['item']:array();
			
			$data_attr = array();
			$data_attr[] = 'data-margin="'.$margin_image.'"';
			$data_attr[] = 'data-nav="'.$show_nav.'"';
			$data_attr[] = 'data-auto_play="'.$auto_play.'"';
			$data_attr[] = 'data-break_point="'.htmlentities(json_encode( $data_break_point )).'"';
			$data_attr[] = 'data-item="'.htmlentities(json_encode( $data_item )).'"';
			?>
			<div class="ts-logo-slider-wrapper ts-slider ts-shortcode <?php echo esc_attr( implode(' ', $classes) ); ?>" <?php echo implode(' ', $data_attr); ?>>
				<?php if( strlen($title) > 0 ): ?>
				<header class="shortcode-heading-wrapper">
					<h3 class="heading-title"><?php echo esc_html($title); ?></h3>
				</header>
				<?php endif; ?>
				<div class="content-wrapper">
					<div class="logos">
					<?php 
					$count = 0;
					while( $logos->have_posts() ): $logos->the_post(); 
						if( $rows > 1 && $count % $rows == 0 ){
							echo '<div class="logo-group">';
						}
					?>
						<div class="item">
							<?php if( $active_link ):
							$logo_url = get_post_meta($post->ID, 'ts_logo_url', true);
							$logo_target = get_post_meta($post->ID, 'ts_logo_target', true);
							?>
								<a href="<?php echo esc_url($logo_url); ?>" target="<?php echo esc_attr($logo_target); ?>">
							<?php endif; ?>
								<?php 
								if( has_post_thumbnail() ){
									the_post_thumbnail('ts_logo_thumb');
								}
								?>
							<?php if( $active_link ): ?>
								</a>
							<?php endif; ?>
						</div>
					<?php 
						if( $rows > 1 && ($count % $rows == $rows - 1 || $count == $count_posts - 1) ){
							echo '</div>';
						}
						$count++;
					endwhile; 
					?>
					</div>
				</div>
			</div>
		<?php
		endif;
		wp_reset_postdata();
		return ob_get_clean();
	}
}
add_shortcode('ts_logos_slider', 'ts_logos_slider_shortcode');

/************************************
*** Element Shortcodes
*************************************/

/*** Shortcode Button ***/
function ts_button_shortcode($atts, $content=null){
	extract(shortcode_atts(array(	
					'link'					=> '#'
					,'bg_color'				=> '#ffffff'
					,'bg_color_hover'		=> '#000000'
					,'border_color'			=> '#cccccc'
					,'border_color_hover'	=> '#000000'
					,'border_width'			=> '0'
					,'text_color'			=> '#000000'
					,'text_color_hover'		=> '#ffffff'
					,'font_icon'			=> ''
					,'target'				=> '_self' /* _self, _blank */
					,'size'					=> 'small' /* small, medium, large, x-large */
					), $atts));
	static $ts_button_counter = 1;		
	$style = '';
	$style_hover = '';
	$selector = '.ts-button-wrapper a.ts-button-'.$ts_button_counter;
	
	if( $bg_color ){
		$style .= 'background:'.$bg_color.';';
	}
	if( $border_color ){
		$style .= 'border-color:'.$border_color.';';
	}
	if( $border_width != '' ){
		$style .= 'border-width:'.absint($border_width).'px ;';
	}
	if( $text_color ){
		$style .= 'color:'.$text_color.';';
	}
		
	if( $bg_color_hover ){
		$style_hover .= 'background:'.$bg_color_hover.';';
	}
	if( $border_color_hover ){
		$style_hover .= 'border-color:'.$border_color_hover.';';
	}
	if( $text_color_hover ){
		$style_hover .= 'color:'.$text_color_hover.';';
	}
	
	$html = '<div class="ts-button-wrapper">';
	$html .= '<div class="ts-shortcode-custom-style hidden">';
	$html .= $selector.'{';
	$html .= $style;
	$html .= '}';
	
	$html .= $selector.':hover{';
	$html .= $style_hover;
	$html .= '}';
	$html .= '</div>';
	
	if( $font_icon ){
		$font_icon = 'fa '.$font_icon;
	}
	
	$html .= '<a href="'.esc_url($link).'" target="'.$target.'" class="ts-button ts-button-'.$ts_button_counter.' '.$size.' '.$font_icon.' ">'.do_shortcode($content).'</a>';
	$html .= '</div>';
	
	$ts_button_counter++;
	return $html;
}
add_shortcode('ts_button', 'ts_button_shortcode');

if( !function_exists('ts_mailchimp_subscription_shortcode') ){
	function ts_mailchimp_subscription_shortcode( $atts ){
		extract(shortcode_atts(array(	
					'title'				=> 'Newsletter'
					,'intro_text'		=> ''
					,'form'				=> ''
					,'bg_image'			=> ''
					,'text_style'		=> 'text-default'
					,'style'			=> 'style-1'
					), $atts));
		$bg_img = wp_get_attachment_url( $bg_image );
		$bg_image = '';
					
		if( !class_exists('TS_Mailchimp_Subscription_Widget') ){
			return;
		}
		
		$instance = compact('title', 'intro_text','bg_image', 'form', 'text_style');
		
		ob_start();
		
		echo '<div class="ts-mailchimp-subscription-shortcode '.$style.' " style="background-image:url('.$bg_img.')" >';
		
		the_widget('TS_Mailchimp_Subscription_Widget', $instance);
		
		echo '</div>';
		
		return ob_get_clean();
	}
}
add_shortcode('ts_mailchimp_subscription', 'ts_mailchimp_subscription_shortcode');

/*** Shortcode Dropcap ***/
function ts_dropcap_shortcode($atts, $content=null){
	extract(shortcode_atts(array(	
					'style'					=> '1'
					), $atts));
	return '<span class="ts-dropcap'.' style-'.$style.'">' .do_shortcode($content). '</span>';
}
add_shortcode('ts_dropcap', 'ts_dropcap_shortcode');

/*** Shortcode Quote ***/
function ts_quote_shortcode($atts, $content=null){
	return '<span class="ts-quote">'.do_shortcode($content).'</span>';
}
add_shortcode('ts_quote', 'ts_quote_shortcode');

/*** Shortcode Heading ***/
if( !function_exists('ts_heading_shortcode') ){
	function ts_heading_shortcode($atts, $content = null){
		extract(shortcode_atts(array(
			'size' 				=> '1'
			,'text' 			=> ''
			,'style'			=> 'default'
		), $atts));
		return '<div class="ts-heading heading-'.$size.' '.$style.'"><h'.$size.'>'.do_shortcode($text).'</h'.$size.'></div>';
	}
}
add_shortcode('ts_heading', 'ts_heading_shortcode');

/*** Shortcode Blog ***/
if( !function_exists('ts_blogs_shortcode') ){
	function ts_blogs_shortcode( $atts, $content = null){
		extract(shortcode_atts(array(
					'title'				=> ''
					,'columns'			=> 3
					,'categories'		=> ''
					,'per_page'			=> 5
					,'orderby'			=> 'none'
					,'order'			=> 'DESC'
					,'style'			=> 1
					,'show_title'		=> 1
					,'show_thumbnail'	=> 1
					,'show_author'		=> 1
					,'show_date'		=> 1
					,'show_comment'		=> 1
					,'show_view'		=> 1
					,'show_excerpt'		=> 1
					,'show_readmore'	=> 1
					,'excerpt_words'	=> 18
					,'layout'			=> 'grid'
					,'show_nav'			=> 1
					,'auto_play'		=> 1
					,'margin'			=> 20
					,'show_load_more'	=> 0
					,'load_more_text'	=> 'Show more'
				), $atts));
		
		if( !is_numeric($excerpt_words) ){
			$excerpt_words = 18;
		}
		
		$is_slider = 0;
		$is_masonry = 0;
		if( $layout == 'slider' ){
			$is_slider = 1;
		}
		if( $layout == 'masonry' ){
			$is_masonry = 1;
		}
		
		$columns = absint($columns);
		if( !in_array($columns, array(1, 2, 3, 4, 6)) ){
			$columns = 4;
		}
		
		$args = array(
			'post_type' 			=> 'post'
			,'post_status' 			=> 'publish'
			,'ignore_sticky_posts' 	=> 1
			,'posts_per_page'		=> $per_page
			,'orderby'				=> $orderby
			,'order'				=> $order
		);
		
		$categories = str_replace(' ', '', $categories);
		if( strlen($categories) > 0 ){
			$ar_categories = explode(',', $categories);
			if( is_array($ar_categories) && count($ar_categories) > 0 ){
				$field_name = is_numeric($ar_categories[0])?'term_id':'slug';
				$args['tax_query'] = array(
										array(
											'taxonomy' => 'category'
											,'terms' => $ar_categories
											,'field' => $field_name
											,'include_children' => false
										)
									);
			}
		}
		
		global $post;
		$posts = new WP_Query($args);
		
		ob_start();
		if( $posts->have_posts() ):
			if( $posts->post_count <= 1 ){
				$is_slider = 0;
			}
			if( $is_slider ){
				$show_load_more = 0;
			}
			
			$classes = array();
			$classes[] = 'ts-blogs-wrapper ts-shortcode ts-blogs';
			$classes[] = $title?'':'no-title';
			if( $is_slider ){
				$classes[] = 'ts-slider loading';
			}
			if( $is_masonry ){
				$classes[] = 'ts-masonry';
			}
			
			$atts = compact('title', 'columns', 'categories', 'per_page', 'orderby', 'order'
							,'style', 'show_title', 'show_thumbnail', 'show_author', 'show_view'
							,'show_date', 'show_comment', 'show_excerpt', 'show_readmore', 'excerpt_words'
							,'is_slider', 'show_nav', 'auto_play', 'margin', 'is_masonry', 'show_load_more');
			?>
			<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" data-atts="<?php echo htmlentities(json_encode($atts)); ?>">
				<?php if( strlen($title) > 0 ): ?>
				<header class="shortcode-heading-wrapper">
					<h3 class="heading-title"><?php echo esc_html($title); ?></h3>
				</header>
				<?php endif; ?>
				<div class="content-wrapper">
					<div class="blogs">
						<?php ts_get_blog_items_content_shortcode($atts, $posts); ?>
					</div>
					<?php if( $show_load_more ): ?>
					<div class="load-more-wrapper">
						<a href="#" class="load-more button" data-paged="2"><?php echo esc_html($load_more_text) ?></a>
					</div>
					<?php endif; ?>
				</div>
			</div>
		<?php
		endif;
		wp_reset_postdata();
		return ob_get_clean();
	}	
}
add_shortcode('ts_blogs', 'ts_blogs_shortcode');

add_action('wp_ajax_ts_blogs_load_items', 'ts_get_blog_items_content_shortcode');
add_action('wp_ajax_nopriv_ts_blogs_load_items', 'ts_get_blog_items_content_shortcode');
if( !function_exists('ts_get_blog_items_content_shortcode') ){
	function ts_get_blog_items_content_shortcode($atts, $posts = null){
		
		global $post;
		
		if( defined( 'DOING_AJAX' ) && DOING_AJAX ){
			if( !isset($_POST['atts']) ){
				die('0');
			}
			$atts = $_POST['atts'];
			$paged = isset($_POST['paged'])?absint($_POST['paged']):1;
			
			extract($atts);
			
			$args = array(
				'post_type' 			=> 'post'
				,'post_status' 			=> 'publish'
				,'ignore_sticky_posts' 	=> 1
				,'posts_per_page'		=> $per_page
				,'orderby'				=> $orderby
				,'order'				=> $order
				,'paged'				=> $paged
			);
			
			$categories = str_replace(' ', '', $categories);
			if( strlen($categories) > 0 ){
				$categories = explode(',', $categories);
			}
			if( is_array($categories) && count($categories) > 0 ){
				$field_name = is_numeric($categories[0])?'term_id':'slug';
				$args['tax_query'] = array(
										array(
											'taxonomy' => 'category'
											,'terms' => $categories
											,'field' => $field_name
											,'include_children' => false
										)
									);
			}
			
			$posts = new WP_Query($args);
			ob_start();
		}
		
		extract($atts);
		
		if( $posts->have_posts() ):
			$item_class = '';
			if( !$is_slider ){
				$item_class = 24/(int)$columns;
				$item_class = 'ts-col-'.$item_class;
			}
			$key = -1;
			while( $posts->have_posts() ): $posts->the_post();
			
				$post_format = get_post_format(); /* Video, Audio, Gallery, Quote */
				if( $is_slider && $post_format == 'gallery' ){ /* Remove Slider in Slider */
					$post_format = false;
				}
				
				$key++;
				$item_extra_class = ($key % $columns == 0)?'first':(($key % $columns == $columns - 1)?'last':''); ?>
				<article class="item <?php echo esc_attr($post_format); ?> <?php echo esc_attr($item_class.' '.$item_extra_class) ?>">
					<?php if( $show_thumbnail && $post_format != 'quote' ){ ?>
						<div class="thumbnail-content">
							<?php 
							if( $post_format == 'gallery' || $post_format === false || $post_format == 'standard' ){
							?>
								<a class="thumbnail <?php echo esc_attr($post_format); ?> <?php echo ($post_format == 'gallery')?'loading':''; ?>" href="<?php echo ($post_format == 'gallery')?'javascript: void(0)':get_permalink() ?>">
									<figure>
									<?php 
									
									if( $post_format == 'gallery' ){
										$gallery = get_post_meta($post->ID, 'ts_gallery', true);
										$gallery_ids = explode(',', $gallery);
										if( is_array($gallery_ids) && has_post_thumbnail() ){
											array_unshift($gallery_ids, get_post_thumbnail_id());
										}
										foreach( $gallery_ids as $gallery_id ){
											echo wp_get_attachment_image( $gallery_id, 'boxshop_blog_shortcode_thumb' );
										}
									}
									
									if( $post_format === false || $post_format == 'standard' ){
										if( has_post_thumbnail() ){
											the_post_thumbnail('boxshop_blog_shortcode_thumb'); 
										}
									}
									
									?>
									</figure>
									<div class="effect-thumbnail"></div>
								</a>
								
								
							<?php 
							}
							
							if( $post_format == 'video' ){
								$video_url = get_post_meta($post->ID, 'ts_video_url', true);
								echo do_shortcode('[ts_video src="'.$video_url.'"]');
							}
							
							if( $post_format == 'audio' ){
								$audio_url = get_post_meta($post->ID, 'ts_audio_url', true);
								if( strlen($audio_url) > 4 ){
									$file_format = substr($audio_url, -3, 3);
									if( in_array($file_format, array('mp3', 'ogg', 'wav')) ){
										echo do_shortcode('[audio '.$file_format.'="'.$audio_url.'"]');
									}
									else{
										echo do_shortcode('[ts_soundcloud url="'.$audio_url.'" width="100%" height="122"]');
									}
								}
							}
						?>
						</div>
					<?php } ?>
					
					<?php if( $post_format != 'quote' ): ?>
					
						<?php if( $show_title ): ?>
						<header>
							<h3 class="heading-title entry-title">
								<a class="post-title heading-title" href="<?php the_permalink() ; ?>"><?php the_title(); ?></a>
							</h3>
						</header>
						<?php endif; ?>
						
						<div class="entry-meta <?php echo $show_date ?"has-datetime":"" ?> <?php echo $show_author?"has-author":"" ?>">
							<!-- Blog Date Time -->
							<?php if( $show_date ) : ?>
							<div class="date-time">
								<span><?php echo get_the_time('d'); ?></span>
								<span><?php echo get_the_time('M'); ?></span>
							</div>
							<?php endif; ?>
							
							<!-- Blog Comment -->
							<?php if( $show_comment ): ?>
							<span class="comment-count">
								<i class="pe-7s-chat"></i>
								<span class="number">
									<?php 
									if( function_exists('boxshop_post_comment_count') ){
										boxshop_post_comment_count();
									}
									?>
								</span>
							</span>
							<?php endif; ?>
							
							<!-- Blog view -->
							<?php if( $show_view ): ?>
							<span class="view-count">
								<i class="pe-7s-look"></i>
								<span class="number">
									<?php 
									if( function_exists('boxshop_post_view_count') ){
										boxshop_post_view_count(); 
									}
									?>
								</span>
							</span>
							<?php endif; ?>
							
							<!-- Blog Author -->
							<?php if( $show_author ): ?>
							<span class="vcard author"><?php esc_html_e('Post by ', 'themesky'); ?><?php the_author_posts_link(); ?></span>
							<?php endif; ?>
				
						</div>
						
						<?php if( $show_excerpt && function_exists('boxshop_the_excerpt_max_words') ): ?>
						<div class="excerpt"><?php boxshop_the_excerpt_max_words($excerpt_words, '', true, '', true); ?></div>
						<?php endif; ?>
						
						<div class="entry-bottom">
							<!-- Blog Read More Button -->
							<?php if( $show_readmore ): ?>
							<a class="button button-secondary transparent button-readmore" href="<?php the_permalink() ; ?>"><?php esc_html_e('Read More', 'themesky'); ?></a>
							<?php endif; ?>
						</div>
						
					<?php else: /* Post format is quote */ ?>
						<div class="quote-wrapper">
							<blockquote>
								<?php 
								$quote_content = get_the_excerpt();
								if( !$quote_content ){
									$quote_content = get_the_content();
								}
								echo do_shortcode($quote_content);
								?>
							</blockquote>
							
							<div class="entry-meta <?php echo $show_date ?"has-datetime":"" ?>">
								<!-- Blog Date Time -->
								<?php if( $show_date ) : ?>
								<div class="date-time">
									<i class="pe-7s-date"></i>
									<?php echo get_the_time( get_option('date_format') ); ?>
								</div>
								<?php endif; ?>
								
								<!-- Blog Author -->
								<?php if( $show_author ): ?>
								<span class="vcard author"><?php esc_html_e('Post by ', 'themesky'); ?><?php the_author_posts_link(); ?></span>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
					
				</article>
			<?php 
			endwhile;
		endif;
		
		wp_reset_postdata();
		
		if( defined( 'DOING_AJAX' ) && DOING_AJAX ){
			die(ob_get_clean());
		}
		
	}
}

/* TS Google Map shortcode */
if( !function_exists('ts_google_map_shortcode') ){
	function ts_google_map_shortcode($atts, $content = null){
		extract(shortcode_atts(array(
						'address'			=> ''
						,'height'			=> 360
						,'zoom'				=> 12
						,'map_type'			=> 'ROADMAP'
						,'title'			=> ''
					), $atts));
					
		ob_start();	
		wp_enqueue_script('gmap-api');
		?>
		<div class="google-map-container" style="height:<?php echo esc_attr($height); ?>px" 
			data-address="<?php echo esc_attr($address) ?>" data-zoom="<?php echo esc_attr($zoom) ?>" data-map_type="<?php echo esc_attr($map_type) ?>" data-title="<?php echo esc_attr($title) ?>">
			<div style="height:<?php echo esc_attr($height); ?>px"></div>
		</div>
		<?php
		return ob_get_clean();
	}
}
add_shortcode('ts_google_map', 'ts_google_map_shortcode');

/* Shortcode Video - Support Youtube and Vimeo video */
if( !function_exists('ts_video_shortcode') ){
	function ts_video_shortcode($atts){
		extract( shortcode_atts(array(
				'src' 		=> '',
				'height' 	=> '450',
				'width' 	=> '800'
			), $atts
		));
	if( $src == '' ){
		return;
	}
	
	$extra_class = '';
	if( !isset($atts['height']) || !isset($atts['width']) ){
		$extra_class = 'auto-size';
	}
	
	$src = ts_parse_video_link($src);
    ob_start();
	?>
		<div class="ts-video <?php echo esc_attr($extra_class); ?>" style="width:<?php echo esc_attr($width) ?>px; height:<?php echo esc_attr($height) ?>px;">
			<iframe width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>" src="<?php echo esc_url($src); ?>" allowfullscreen></iframe>
		</div>
	<?php
	return ob_get_clean();
	}
}
add_shortcode('ts_video', 'ts_video_shortcode');

if( !function_exists('ts_parse_video_link') ){
	function ts_parse_video_link( $video_url ){
		if( strstr($video_url, 'youtube.com') || strstr($video_url, 'youtu.be') ){
			preg_match('%(?:youtube\.com/(?:user/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_url, $match);
			if( count($match) >= 2 ){
				return '//www.youtube.com/embed/' . $match[1];
			}
		}
		elseif( strstr($video_url, 'vimeo.com') ){
			preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $match);
			if( count($match) >= 2 ){
				return '//player.vimeo.com/video/' . $match[1];
			}
			else{
				$video_id = explode('/', $video_url);
				if( is_array($video_id) && !empty($video_id) ){
					$video_id = $video_id[count($video_id) - 1];
					return '//player.vimeo.com/video/' . $video_id;
				}
			}
		}
		return $video_url;
	}
}

/* Shortcode SoundCloud */
if( !function_exists('ts_soundcloud_shortocde') ){
	function ts_soundcloud_shortocde( $atts, $content ){
		extract(shortcode_atts(array(
			'params'		=> "color=ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false"
			,'url'			=> ''
			,'width'		=> '100%'
			,'height'		=> '166'
			,'iframe'		=> 1
		),$atts));
		
		$atts = compact( 'params', 'url', 'width', 'height', 'iframe' );
		
		if( $iframe ){
			return ts_soundcloud_iframe_widget( $atts );
		}
		else{ 
			return ts_soundcloud_flash_widget( $atts );
		}
	}
}
add_shortcode('ts_soundcloud','ts_soundcloud_shortocde');


function ts_soundcloud_iframe_widget($options) {
	$url = 'https://w.soundcloud.com/player/?url=' . $options['url'] . '&' . $options['params'];
	$unique_class = 'ts-soundcloud-'.rand();
	$style = '.'.$unique_class.' iframe{width: '.$options['width'].'; height:'.$options['height'].'px;}';
	$style = '<style type="text/css" scoped>'.$style.'</style>';
	return '<div class="ts-soundcloud '.$unique_class.'">'.$style.'<iframe src="'.esc_url( $url ).'"></iframe></div>';
}

function ts_soundcloud_flash_widget( $options ){
	$url = 'https://player.soundcloud.com/player.swf?url=' . $options['url'] . '&' . $options['params'];
	
	return preg_replace('/\s\s+/', '', sprintf('<div class="ts-soundcloud"><object width="%s" height="%s">
							<param name="movie" value="%s"></param>
							<param name="allowscriptaccess" value="always"></param>
							<embed width="%s" height="%s" src="%s" allowscriptaccess="always" type="application/x-shockwave-flash"></embed>
						  </object></div>', $options['width'], $options['height'], esc_url( $url ), $options['width'], $options['height'], esc_url( $url )));
}

/* Twitter Slider Shortcode */
if( !function_exists('ts_twitter_slider_shortcode') ){
	function ts_twitter_slider_shortcode($atts){
		extract(shortcode_atts(array(
			'username'				=> ''
			,'limit'				=> 4
			,'exclude_replies'		=> 'false'
			,'text_color_style'		=> 'text-default'
			,'show_nav'				=> 1
			,'show_dots'			=> 0
			,'auto_play'			=> 1
			,'cache_time'			=> 12
			,'consumer_key'			=> ''
			,'consumer_secret'		=> ''
			,'access_token'			=> ''
			,'access_token_secret'	=> ''
		),$atts));
		
		if( $username == '' || !class_exists('TwitterOAuth') ){
			return;
		}
		
		if( $show_dots ){
			$show_nav = 0;
		}
		
		if( $consumer_key == '' || $consumer_secret == '' || $access_token == '' || $access_token_secret == '' ){
			$consumer_key 			= "ZLlLWJ6CXHDMcdWtanbJDqpUL";
			$consumer_secret 		= "1PIVXWtA3bjw32cNQSbrV7Q6bkl4SKDg6LsALDEzkYx8q1u87U";
			$access_token 			= "908339957399351296-UmemaSSE33FO2ZOwkQNmlxm5grBe95T";
			$access_token_secret	= "gVPSftM7oNEiET9q5IVyjehTYO1VZvKtd1HoKimopzQ7P";
		}
		unset($atts['consumer_key']);
		unset($atts['consumer_secret']);
		unset($atts['access_token']);
		unset($atts['access_token_secret']);
		$atts['text_color_style'] = ($text_color_style == 'text-default')? 1: 2;
		$atts['exclude_replies'] = ($exclude_replies == 'false')? 1: 2;
		
		$transient_key = 'twitter_'.implode('', $atts);
		$cache = get_transient($transient_key);
		
		if( $cache !== false ){
			return $cache;
		}
		else{
			$connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
			$tweets = $connection->get('https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name='.$username.'&count='.$limit.'&exclude_replies='.$exclude_replies);
			if( !isset($tweets->errors) && is_array($tweets) ){
				ob_start();
				$extra_class = $text_color_style;
				if( $show_nav || $show_dots ){
					$extra_class .= ' show-nav';
				}
				echo '<div class="ts-twitter-slider ts-shortcode ts-slider loading '.$extra_class.'" data-nav="'.$show_nav.'" data-dots="'.$show_dots.'" data-autoplay="'.$auto_play.'">';
				foreach( $tweets as $tweet ){
					$tweet_link = 'http://twitter.com/'.$tweet->user->screen_name.'/statuses/'.$tweet->id;
					$user_link = 'http://twitter.com/'.$tweet->user->screen_name;
					?>
					<div class="item">
						<div class="twitter-content">
							<div class="icon">
								<i class="fa fa-twitter"></i>
							</div>
							<div class="content">
								<?php echo esc_html($tweet->text); ?>
							</div>
							<h4 class="name">
								<a href="<?php echo esc_url($user_link); ?>" target="_blank"><?php echo '@'.esc_html($tweet->user->name); ?></a>
							</h4>
							<div class="date-time">
							<?php 
								echo ts_relative_time($tweet->created_at); 
								esc_html_e(' on ', 'themesky');
							?>
								<a href="<?php echo esc_url($tweet_link); ?>" target="_blank"><?php esc_html_e('Twitter.com', 'themesky') ?></a>
							</div>
						</div>
					</div>
					<?php
				}
				echo '</div>';
				
				$output = ob_get_clean();
				set_transient($transient_key, $output, $cache_time * HOUR_IN_SECONDS);
				return $output;
			}
		}
		
	}
}
add_shortcode('ts_twitter_slider', 'ts_twitter_slider_shortcode');

if( !function_exists('ts_relative_time') ){
	function ts_relative_time( $time = '' ){
		if( empty($time) ){
			return '';
		}
		
		$second = 1;
		$minute = 60 * $second;
		$hour = 60 * $minute;
		$day = 24 * $hour;
		$month = 30 * $day;

		$delta = strtotime('+0 hours') - strtotime($time);
		if ($delta < 2 * $minute) {
			return esc_html__('1 min ago', 'themesky');
		}
		if ($delta < 45 * $minute) {
			return floor($delta / $minute) . esc_html__(' min ago', 'themesky');
		}
		if ($delta < 90 * $minute) {
			return esc_html__('1 hour ago', 'themesky');
		}
		if ($delta < 24 * $hour) {
			return floor($delta / $hour) . esc_html__(' hours ago', 'themesky');
		}
		if ($delta < 48 * $hour) {
			return esc_html__('yesterday', 'themesky');
		}
		if ($delta < 30 * $day) {
			return floor($delta / $day) . esc_html__(' days ago', 'themesky');
		}
		if ($delta < 12 * $month) {
			$months = floor($delta / $day / 30);
			return $months <= 1 ? esc_html__('1 month ago', 'themesky') : $months . esc_html__(' months ago', 'themesky');
		} else {
			$years = floor($delta / $day / 365);
			return $years <= 1 ? esc_html__('1 year ago', 'themesky') : $years . esc_html__(' years ago', 'themesky');
		}
	}
}

/* Milestone shortcode */
if( !function_exists('ts_milestone_shortcode') ){
	function ts_milestone_shortcode( $atts ){
		extract( shortcode_atts(array(
				'number'			=> 0
				,'subject'			=> ''
				,'text_color_style'	=> 'text-default'
			), $atts)
		);
		
		if( !is_numeric($number) ){
			$number = 0;
		}
		
		ob_start();
		?>
		<div class="ts-milestone <?php echo esc_attr($text_color_style) ?>" data-number="<?php echo esc_attr($number); ?>">
			<span class="number">
				<?php echo esc_html($number); ?>
			</span>
			<h3 class="subject">
				<?php echo esc_html($subject); ?>
			</h3>
		</div>
		<?php
		return ob_get_clean();
	}
}
add_shortcode('ts_milestone', 'ts_milestone_shortcode');

/* Countdown shortcode */
if( !function_exists('ts_countdown_shortcode') ){
	function ts_countdown_shortcode( $atts ){
		extract( shortcode_atts(array(
				'style'				=> 'style-default'
				,'day'				=> ''
				,'month'			=> ''
				,'year'				=> ''
				,'text_color_style'	=> 'text-default'
			), $atts)
		);
		
		if( empty($month) || empty($day) || empty($year) ){
			return;
		}
		
		if( !checkdate($month, $day, $year) ){
			return;
		}
		
		$date = mktime(0, 0, 0, $month, $day, $year);
		$current_time = current_time('timestamp');
		$delta = $date - $current_time;
		
		if( $delta <= 0 ){
			return;
		}
		
		$time_day = 60 * 60 * 24;
		$time_hour = 60 * 60;
		$time_minute = 60;
		
		$day = floor( $delta / $time_day );
		$delta -= $day * $time_day;
		
		$hour = floor( $delta / $time_hour );
		$delta -= $hour * $time_hour;
		
		$minute = floor( $delta / $time_minute );
		$delta -= $minute * $time_minute;
		
		if( $delta > 0 ){
			$second = $delta;
		}
		else{
			$second = 0;
		}
		
		$day = zeroise($day, 2);
		$hour = zeroise($hour, 2);
		$minute = zeroise($minute, 2);
		$second = zeroise($second, 2);
		
		ob_start();
		?>
		<div class="ts-countdown <?php echo esc_attr($text_color_style) ?> <?php echo esc_attr($style) ?>">
			<div class="counter-wrapper days-<?php echo strlen($day); ?>">
				<div class="days">
					<div class="number-wrapper">
						<span class="number"><?php echo esc_html($day); ?></span>
					</div>
					<div class="ref-wrapper">
						<?php esc_html_e('Days', 'themesky'); ?>
					</div>
				</div>
				<div class="hours">
					<div class="number-wrapper">
						<span class="number"><?php echo esc_html($hour); ?></span>
					</div>
					<div class="ref-wrapper">
						<?php esc_html_e('Hours', 'themesky'); ?>
					</div>
				</div>
				<div class="minutes">
					<div class="number-wrapper">
						<span class="number"><?php echo esc_html($minute); ?></span>
					</div>
					<div class="ref-wrapper">
						<?php esc_html_e('Mins', 'themesky'); ?>
					</div>
				</div>
				<div class="seconds">
					<div class="number-wrapper">
						<span class="number"><?php echo esc_html($second); ?></span>
					</div>
					<div class="ref-wrapper">
						<?php esc_html_e('Secs', 'themesky'); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
}
add_shortcode('ts_countdown', 'ts_countdown_shortcode');

/* Image Gallery */
if( !function_exists('ts_image_gallery_shortcode') ){
	function ts_image_gallery_shortcode( $atts ){
		extract( shortcode_atts(array(
				'title' 				=> ''
				,'images' 				=> ''
				,'image_size'			=> 'thumbnail'
				,'layout' 				=> 'slider' /* slider, grid */
				,'columns' 				=> 6
				,'on_click'				=> 'none' /* none, prettyphoto, custom_link */
				,'custom_links' 		=> ''
				,'custom_link_target' 	=> '_self' /* _self, _blank */
				,'show_nav' 			=> 1
				,'auto_play' 			=> 1
				,'margin' 				=> 0
			), $atts)
		);
		
		$images = str_replace(' ', '', $images);
		if( $images == '' ){
			return;
		}
		$images = explode(',', $images);
		
		if( !$image_size ){
			$image_size = 'full';
		}
		
		if( $custom_links != '' ){
			$custom_links = array_map('trim', explode(',', $custom_links));
		}
		else{
			$custom_links = array();
		}
		
		$columns = absint($columns);
		
		if( $on_click == 'prettyphoto' ){
			$rel_id = 'ts-gallery-'.mt_rand();
		}
		
		ob_start();
		$classes = array();
		$classes[] = 'ts-image-gallery-wrapper ts-shortcode';
		$classes[] = $layout == 'slider'?'ts-slider':$layout;
		
		$data_attr = array();
		if( $layout == 'slider' ){
			$data_attr[] = 'data-nav="'.$show_nav.'"';
			$data_attr[] = 'data-autoplay="'.$auto_play.'"';
			$data_attr[] = 'data-columns="'.$columns.'"';
			$data_attr[] = 'data-margin="'.absint($margin).'"';
		}
		?>
		<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" <?php echo implode(' ', $data_attr); ?>>
			<?php if( strlen($title) > 0 ): ?>
			<header class="shortcode-heading-wrapper">
				<h3 class="heading-title"><?php echo esc_html($title); ?></h3>
			</header>
			<?php endif; ?>
			<div class="images <?php echo ($layout == 'slider')?'loading':''; ?>">
				<?php 
				foreach( $images as $index => $image ): 
				$item_classes = array();
				if( $layout == 'grid' ){
					if( $columns > 1 ){
						$item_classes[] = 'ts-col-'.(24/$columns);
						if( $index % $columns == 0 ){
							$item_classes[] = 'first';
						}
						if( $index % $columns == $columns - 1 || $index == count($images) - 1 ){
							$item_classes[] = 'last';
						}
					}
				}
				?>
				<div class="item <?php echo implode(' ', $item_classes); ?>">
					<?php 
					if( $on_click == 'prettyphoto' || $on_click == 'custom_link' ){
						if( $on_click == 'prettyphoto' ){
							$href = wp_get_attachment_url($image);
							$data_rel = 'data-rel="prettyPhoto['.$rel_id.']"';
							$target = '';
						}
						else{
							$href = isset($custom_links[$index])?$custom_links[$index]:'#';
							$data_rel = '';
							$target = 'target="'.$custom_link_target.'"';
						}
						echo '<a class="'.$on_click.'" href="'.esc_url($href).'" '.$data_rel.' '.$target.'>';
					}
					echo wp_get_attachment_image($image, $image_size);
					if( $on_click == 'prettyphoto' || $on_click == 'custom_link' ){
						echo '</a>';
					}
					?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
}
add_shortcode('ts_image_gallery', 'ts_image_gallery_shortcode');
?>
