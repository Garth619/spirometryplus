<?php 
if( !class_exists('WooCommerce') ){
	return;
}
class Boxshop_Product_Filter_By_Color{
	public $attr_slug;
	public $term_slug = 'color';
	public function __construct(){
		$this->constant();
	}
	
	function constant(){
		$this->attr_slug = '';
		
		$attribute_name  = wc_attribute_taxonomy_name( $this->term_slug );
		$attribute_name_array = wc_get_attribute_taxonomy_names();
		$taxonomy_exists = in_array($attribute_name,$attribute_name_array);
		
		if( $taxonomy_exists ){
			$this->attr_slug = $attribute_name;
			add_image_size('boxshop_prod_color_thumb', 30, 30, true);
			
			$this->init_handle();
			
			add_action( 'admin_enqueue_scripts', array($this, 'register_admin_scripts') );
		}
	}
	
	function init_handle(){
		add_action( $this->attr_slug.'_edit_form_fields', array($this, 'edit_color_attribute'), 100000, 2 );
		add_action( $this->attr_slug.'_add_form_fields', array($this, 'add_color_attribute'), 100000 );
		
		add_action( 'created_term', array( $this, 'save_color_fields'), 10,3 );
		add_action( 'edit_term', array( $this, 'save_color_fields'), 10,3 );
		add_action( 'delete_term', array( $this, 'remove_color_fields'), 10,3 );
	}
	
	function register_admin_scripts(){
		wp_enqueue_style( 'wp-color-picker');
		wp_enqueue_script( 'wp-color-picker');
	}
	
	function edit_color_attribute( $term, $taxonomy ){
		$datas = get_term_meta($term->term_id, 'ts_product_color_config', true);
		if( strlen($datas) > 0 ){
			$datas = unserialize($datas);	
		}else{
			$datas = array(
						'ts_color_color' 				=> "#ffffff"
						,'ts_color_image' 				=> 0
					);
		}
		
		if( absint($datas['ts_color_image']) > 0 ){
			$image = wp_get_attachment_thumb_url( $datas['ts_color_image'] );
		}
		else{
			$image = '';
		}
		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label><?php esc_html_e( 'Color', 'boxshop' ); ?></label></th>
			<td>
				<input name="ts_color_color" id="hex-color" class="ts_colorpicker" data-default-color="<?php echo esc_attr($datas['ts_color_color']);?>" type="text" value="<?php echo esc_attr($datas['ts_color_color']);?>" size="40" aria-required="true">
				<span class="description"><?php esc_html_e('Use color picker to pick one color.','boxshop'); ?></span>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label><?php esc_html_e( 'Thumbnail Image', 'boxshop' ); ?></label></th>
			<td>
				<input name="ts_color_image" type="hidden" class="ts_color_image" value="<?php echo absint($datas['ts_color_image']);?>" />
				<img style="padding-bottom:5px;" src="<?php echo esc_url( $image ) ;?>" class="ts_color_preview_image" width="30px" height="30px" /><br />
				<input class="ts_color_upload_image_button button" type="button"  size="40" value="Choose Image" />
				<input class="ts_color_remove_image_button button" type="button"  size="40" value="Remove Image" />
			</td>
		</tr>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				"use strict";
				
				jQuery('.ts_colorpicker').wpColorPicker();
				
				if ( jQuery('input.ts_color_image').val() == '0' )
					jQuery('.ts_color_remove_image_button').hide();

				var file_frame;

				jQuery(document).on( 'click', '.ts_color_upload_image_button', function( event ){

					event.preventDefault();

					if ( file_frame ) {
						file_frame.open();
						return;
					}

					file_frame = wp.media.frames.downloadable_file = wp.media({
						title: '<?php esc_html_e( 'Choose an image', 'boxshop' ); ?>',
						button: {
							text: '<?php esc_html_e( 'Use image', 'boxshop' ); ?>',
						},
						multiple: false
					});

					file_frame.on( 'select', function() {
						var attachment = file_frame.state().get('selection').first().toJSON();

						jQuery('input.ts_color_image').val( attachment.id );
						jQuery('.ts_color_preview_image').attr('src', attachment.url );
						jQuery('.ts_color_remove_image_button').show();
					});

					file_frame.open();
				});

				jQuery(document).on( 'click', '.ts_color_remove_image_button', function( event ){
					jQuery('.ts_color_preview_image').attr('src', '');
					jQuery('input.ts_color_image').val('');
					jQuery('.ts_color_remove_image_button').hide();
					return false;
				});
			});
		</script>
		<?php
	}
	
	function add_color_attribute(){
		?>
		<div class="form-field">
			<label><?php esc_html_e( 'Color', 'boxshop' ); ?></label>
			<input name="ts_color_color" id="hex-color" class="ts_colorpicker" data-default-color="#ffffff" type="text" value="#ffffff" size="40" aria-required="true">
			<span class="description"><?php esc_html_e('Use color picker to pick one color.','boxshop'); ?></span>
		</div>

		<div class="form-field">
			<label><?php esc_html_e( 'Thumbnail Image', 'boxshop' ); ?></label>
			<input name="ts_color_image" type="hidden" class="ts_color_image" value="" />
			<img style="padding-bottom:5px;" src="" class="ts_color_preview_image" width="30px" height="30px" /><br />
			<input class="ts_color_upload_image_button button" type="button"  size="40" value="Choose Image" />
			<input class="ts_color_remove_image_button button" type="button"  size="40" value="Remove Image" />
		</div>
		
		<script type="text/javascript">
			jQuery(document).ready(function(){
				"use strict";
				
				jQuery('.ts_colorpicker').wpColorPicker(); 
				
				if ( jQuery('input.ts_color_image').val() == '' )
					jQuery('.ts_color_remove_image_button').hide();

				var file_frame;

				jQuery(document).on( 'click', '.ts_color_upload_image_button', function( event ){

					event.preventDefault();

					if ( file_frame ) {
						file_frame.open();
						return;
					}

					file_frame = wp.media.frames.downloadable_file = wp.media({
						title: '<?php esc_html_e( 'Choose an image', 'boxshop' ); ?>',
						button: {
							text: '<?php esc_html_e( 'Use image', 'boxshop' ); ?>',
						},
						multiple: false
					});

					file_frame.on( 'select', function() {
						var attachment = file_frame.state().get('selection').first().toJSON();

						jQuery('input.ts_color_image').val( attachment.id );
						jQuery('.ts_color_preview_image').attr('src', attachment.url );
						jQuery('.ts_color_remove_image_button').show();
					});

					file_frame.open();
				});

				jQuery(document).on( 'click', '.ts_color_remove_image_button', function( event ){
					jQuery('.ts_color_preview_image').attr('src', '');
					jQuery('input.ts_color_image').val('');
					jQuery('.ts_color_remove_image_button').hide();
					return false;
				});
			});
		</script>
		<?php
	}
	
	function save_color_fields( $term_id, $tt_id, $taxonomy ){
		if( isset($_POST['ts_color_color'], $_POST['ts_color_image']) ){
			$datas = array();
			$datas['ts_color_color'] = $_POST['ts_color_color'];
			$datas['ts_color_image'] = $_POST['ts_color_image'];
			update_term_meta( $term_id, 'ts_product_color_config', serialize($datas) );
		}
	}
	
	function remove_color_fields( $term_id, $tt_id, $taxonomy ){
		delete_term_meta( $term_id, 'ts_product_color_config' );
	}
}
new Boxshop_Product_Filter_By_Color();
?>
