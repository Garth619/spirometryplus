<?php
/*** Comment ***/
function boxshop_list_comments( $comment, $args, $depth ){
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>"  class="comment-wrapper">
			<div class="avatar">
				<?php echo get_avatar( $comment, 100, 'mystery' ); ?>
			</div>
			<div class="comment-detail">
				<div class="comment-meta">
					<span class="author">
					<?php echo sprintf( '<a href="%1$s" rel="external nofollow" class="url">%2$s</a>', get_comment_author_url(), get_comment_author() ); ?>
					</span>
					<span class="date-time"><?php echo get_comment_date(); ?></span>
						
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'boxshop' ); ?></em>
					<?php endif; ?>
						
					<?php edit_comment_link( esc_html__( '(Edit)', 'boxshop' ), ' ' ); ?>
				</div>
				<div class="comment-text"><?php comment_text(); ?></div>
				<?php if( !( $depth == 0 || $args['max_depth'] <= $depth ) ): ?>
					<span class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'respond_id' => 'comment-wrapper' ) ) ); ?></span>
				<?php endif; ?>
			</div>
		</div>

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php esc_html_e( 'Pingback:', 'boxshop' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( '(Edit)', 'boxshop' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}

function boxshop_comment_form( $args = array(), $post_id = null ){
	global $user_identity;

	if( null === $post_id ){
		$post_id = get_the_ID();
	}
	
	$allowed_html = array(
		'span'	=> array( 'class' => array() )
		,'a' 	=> array( 'href' => array(), 'title' => array() )
	);

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	
	$comment_author = '';
	$comment_author_email = '';
	$comment_author_url = '';
	
	extract(array_filter(array(
		'comment_author'		=>	esc_attr($commenter['comment_author'])
		,'comment_author_email'	=>	esc_attr($commenter['comment_author_email'])
		,'comment_author_url'	=>	esc_attr($commenter['comment_author_url'])
	)), EXTR_OVERWRITE);
	
	$fields =  array(
		'author' => '<p><label>'.wp_kses( __('Your Name <span class="required">*</span>','boxshop'), $allowed_html ).'</label>' . '<input id="author" class="input-text" name="author" type="text" value="' .$comment_author. '" size="30"' . $aria_req . ' />' . '</p>'
		,'email'  => '<p><label>'.wp_kses( __('Your Email <span class="required">*</span>','boxshop'), $allowed_html ).'</label><input id="email" class="input-text" name="email" type="text" value="' . $comment_author_email . '" size="30"' . $aria_req . '/>' . '</p>'
		,'url'    => '<p><label>'.esc_html__('Website','boxshop').'</label><input id="url" class="input-text" name="url" type="text" value="'.$comment_author_url.'" size="30"/>' . '</p>'
	);

	$required_text = sprintf( ' ' . wp_kses( __('Required fields are marked %s','boxshop'), $allowed_html ), '<span class="required">*</span>' );
	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields )
		,'fields_before'		   => '<div class="info-wrapper">'
		,'fields_after'		   => '</div>'
		,'comment_field'        => '<div class="message-wrapper"><p><label>'.esc_html__('Your Comment', 'boxshop').'</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p></div>'
		,'must_log_in'          => '<p class="must-log-in">' .  sprintf( wp_kses( __( 'You must be <a href="%s">logged in</a> to post a comment.','boxshop' ), $allowed_html ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>'
		,'logged_in_as'         => '<p class="logged-in-as">' . sprintf( wp_kses( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','boxshop' ), $allowed_html ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>'
		,'comment_notes_before' => ''
		,'comment_notes_after'  => ''
		,'id_form'              => 'commentform'
		,'id_submit'            => 'submit'
		,'title_reply'          => esc_html__( 'Leave a comment', 'boxshop' )
		,'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'boxshop')
		,'cancel_reply_link'    => esc_html__( 'Cancel reply', 'boxshop' )
		,'label_submit'         => esc_html__( 'Post comment', 'boxshop' )
	);

	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	?>
		<?php if ( comments_open() ) : ?>
			<?php do_action( 'comment_form_before' ); ?>
			<section id="comment-wrapper">
				<header class="heading-wrapper">
					<h2 class="heading-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h2>
				</header>
				
				<?php 
					if( get_option( 'comment_registration' ) && !is_user_logged_in() ):
						echo  $args['must_log_in'];
						do_action( 'comment_form_must_log_in_after' );
					else: 
				?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
						<?php 
							do_action( 'comment_form_top' );
							if ( is_user_logged_in() ){
								echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );
								do_action( 'comment_form_logged_in_after', $commenter, $user_identity );
							}
							else{
								echo  $args['comment_notes_before'];
								echo  $args['fields_before'];
								do_action( 'comment_form_before_fields' );
								foreach ( (array) $args['fields'] as $name => $field ) {
									echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
								}
								echo  $args['fields_after'];								
							}
							echo apply_filters( 'comment_form_field_comment', $args['comment_field'] );
							echo  $args['comment_notes_after'];
							if ( !is_user_logged_in() ){ 
								do_action( 'comment_form_after_fields' ); 
							}
						?>
						<p class="form-submit">
							<button class="button" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>"><?php echo esc_attr( $args['label_submit'] ); ?></button>

							<?php comment_id_fields( $post_id ); ?>
						</p>
						<?php do_action( 'comment_form', $post_id ); ?>
					</form>
				<?php endif; ?>
			</section>
			<?php do_action( 'comment_form_after' ); ?>
		<?php else : ?>
			<?php do_action( 'comment_form_comments_closed' ); ?>
		<?php endif; ?>
<?php
}

/* Change footer for the individual page */
add_filter('widget_display_callback', 'boxshop_change_footer_for_individual_page', 10, 3);
function boxshop_change_footer_for_individual_page( $instance, $object, $args ){
	global $post;
	if( is_page() && ($args['name'] == esc_html__('Footer Widget Area', 'boxshop') || $args['name'] == esc_html__('Footer Copyright Widget Area', 'boxshop')) 
		&& get_class($object) == 'TS_Footer_Block_Widget' ){
		if( $args['name'] == esc_html__('Footer Widget Area', 'boxshop') ){
			$block_id = get_post_meta($post->ID, 'ts_footer_id', true);
		}
		else{
			$block_id = get_post_meta($post->ID, 'ts_footer_copyright_id', true);
		}
		if( $block_id ){
			$instance['block_id'] = $block_id;
		}
	}
	return $instance;
}

add_filter('document_title_separator', function(){ return '|'; });

/* Remove bbpress title */
remove_filter('wp_title', 'bbp_title', 10, 3);

/* Body classes filter */
add_filter('body_class', 'boxshop_body_classes_filter');
function boxshop_body_classes_filter( $classes ){
	global $boxshop_theme_options, $boxshop_page_datas;
	
	$classes[] = isset($boxshop_theme_options['ts_layout_style'])?$boxshop_theme_options['ts_layout_style']:'';
	
	if( isset($boxshop_theme_options['ts_layout_fullwidth']) && $boxshop_theme_options['ts_layout_fullwidth'] ){
		$classes[] = 'layout-fullwidth';
	}
	
	if( is_rtl() || ( isset($boxshop_theme_options['ts_enable_rtl']) && $boxshop_theme_options['ts_enable_rtl'] ) ){
		$classes[] = 'rtl';
	}
	
	if( !wp_is_mobile() ){
		$classes[] = 'ts_desktop';
	}
	
	if( !empty($boxshop_page_datas['ts_display_vertical_menu_by_default']) ){
		$classes[] = 'display-vertical-menu';
	}
	
	if( !empty($boxshop_theme_options['ts_vertical_menu_style']) ){
		$classes[] = 'vertical-menu-' . $boxshop_theme_options['ts_vertical_menu_style'];
	}
	
	if( ( is_page_template('page-templates/blog-template.php') || is_category() || is_tag() ) && !empty($boxshop_theme_options['ts_blog_style']) ){
		$classes[] = 'blog-' . esc_attr($boxshop_theme_options['ts_blog_style']) . '-style';
	}
	
	return $classes;
}
?>
