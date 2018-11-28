<?php
/** @var $this WPBakeryShortCode_VC_Row */
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = $full_width = $equal_height = $full_height = $css_animation = '';
$disable_element = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

if( $parallax_speed != '' && $bg_type == 'image' && $bg_image_new != '' ){
	$bg_image = $bg_image_new;
}

$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );

$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if ( ! empty( $atts['gap'] ) ) {
	$css_classes[] = 'vc_column-gap-' . $atts['gap'];
}

if ( ! empty( $full_height ) ) {
	$css_classes[] = 'vc_row-o-full-height';
	if ( ! empty( $columns_placement ) ) {
		$flex_row = true;
		$css_classes[] = 'vc_row-o-columns-' . $columns_placement;
		if ( 'stretch' === $columns_placement ) {
			$css_classes[] = 'vc_row-o-equal-height';
		}
	}
}

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

$style = '';

/* Row Layout */
$css_classes[] = $layout;
/* Background parallax */
$data_attr = '';
if( $parallax_speed != '' && $bg_type == 'image' ){
	$css_classes[] = 'ts-parallax-bg';
	
	$parallax_speed = floatval($parallax_speed);
	if( $parallax_speed == false ){
		$parallax_speed = 0.1;
	}
	$data_attr .= ' data-prlx-speed="' . $parallax_speed . '"';
	
	if ( (int) $bg_image > 0 && ( $image_url = wp_get_attachment_url( $bg_image ) ) !== false ) {
		$style = ' style="background-image: url(' . $image_url . ');"';
	}
}

if( ($bg_type == 'u_iframe' && $u_video_url != '') || ( $bg_type == 'video' && ($video_url != '' || $video_url_2 != '') ) ){
	$css_classes[] = 'ts-video-bg';
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
?>
	<div <?php echo isset( $el_id ) && ! empty( $el_id ) ? "id='" . esc_attr( $el_id ) . "'" : ""; ?> <?php
	?>class="<?php echo esc_attr( $css_class ); ?><?php if ( $full_width == 'stretch_row_content_no_spaces' ): echo ' vc_row-no-padding'; endif; ?>" <?php if ( ! empty( $full_width ) ) {
	echo ' data-vc-full-width="true" data-vc-full-width-init="false" ';
	if ( $full_width == 'stretch_row_content' || $full_width == 'stretch_row_content_no_spaces' ) {
		echo ' data-vc-stretch-content="true"';
	}
} ?> <?php echo trim($style); ?> <?php echo trim($data_attr); ?>><?php

/* Youtube video - Hosted vide */
if( $bg_type == 'u_iframe' && $u_video_url != '' ){
	$data_property = '{videoURL:\''.$u_video_url.'\',containment:\'self\',opacity:1,ratio:\'16/9\',quality:\'hd720\'';
	if( $u_start_time != '' ){
		$data_property .= ',startAt:'.$u_start_time;
	}
	else{
		$data_property .= ',startAt:0';
	}
	if( $u_stop_time != '' ){
		$data_property .= ',stopAt:'.$u_stop_time;
	}
	$video_opts = explode(',', $video_opts);
	if( is_array($video_opts) ){
		if( in_array('loop', $video_opts) ){
			$data_property .= ',loop:true';
		}
		else{
			$data_property .= ',loop:false';
		}
		
		if( in_array('muted', $video_opts) ){
			$data_property .= ',mute:true';
		}
		else{
			$data_property .= ',mute:false';
		}
		
		if( in_array('auto_play', $video_opts) ){
			$data_property .= ',autoPlay:true';
		}
		else{
			$data_property .= ',autoPlay:false';
		}
	}
	$data_property .= '}';
	echo '<div class="ts-youtube-video-bg" data-property="'.$data_property.'" data-poster="'.wp_get_attachment_url($video_poster).'"></div>';
}

if( $bg_type == 'video' && ($video_url != '' || $video_url_2 != '') ){
	$video_opts = explode(',', $video_opts);
	$preload = 'none';
	
	if( !empty($_SERVER['HTTP_USER_AGENT']) ){
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		$ios_regex = array('/iphone/i', '/ipad/i', '/ipod/i');
		foreach( $ios_regex as $regex ){
			if( preg_match($regex, $user_agent) ){
				$preload = 'auto';
				break;
			}
		}
	}
	
	?>
	<div class="ts-hosted-video-bg" data-poster="<?php echo wp_get_attachment_url($video_poster); ?>">
		<div class="video-control"></div>
		<video class="<?php echo in_array('auto_play', $video_opts)? 'autoplay':'' ;?> <?php echo in_array('loop', $video_opts)? 'loop':'' ;?> <?php echo in_array('muted', $video_opts)? 'muted':'' ;?>" preload="<?php echo esc_attr($preload); ?>">
			<?php if( $video_url ){ ?>
			<source src="<?php echo esc_url($video_url);?>" type="video/mp4">
			<?php } ?>
			<?php if( $video_url_2 ){ 
				if( strpos('.ogg', $video_url_2) > 0 ){
					$video_type = 'video/ogg';
				} 
				else{
					$video_type = 'video/webm';
				}
			?>
			<source src="<?php echo esc_url($video_url_2);?>" type="<?php echo esc_attr($video_type); ?>">
			<?php } ?>
		</video>
	</div>
	<?php
}

echo wpb_js_remove_wpautop( $content );
?></div><?php 
if ( ! empty( $full_width ) ) {
	echo '<div class="vc_row-full-width"></div>';
}
