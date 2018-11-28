<?php
	include_once('wp-load.php');
	global $wpdb;
	$wp_prefix = $wpdb->base_prefix;
	
	$message = '';
	
	if( isset($_POST) && isset($_POST['site_url']) && strlen(trim($_POST['site_url'])) > 0 ){
		$current_url = get_option( "siteurl", "" );
		$new_url = $_POST['site_url'];
		
		$result_1 = $wpdb->query("update `{$wp_prefix}options` set `option_value`='{$new_url}' where `option_name` in('siteurl','home');");
		
		$result_2 = $wpdb->query("update `{$wp_prefix}links` set `link_url` = replace(`link_url`, '{$current_url}', '{$new_url}');");
		$result_3 = $wpdb->query("update `{$wp_prefix}posts` set `guid` = replace(`guid`, '{$current_url}', '{$new_url}');");
		$result_4 = $wpdb->query("update `{$wp_prefix}posts` set `post_content` = replace(`post_content`, '{$current_url}', '{$new_url}');");
		$result_5 = $wpdb->query("update `{$wp_prefix}postmeta` set `meta_value` = replace(`meta_value`, '{$current_url}', '{$new_url}');");
		
		/* Only for Gon theme */
		$result_6 = $wpdb->query("update `{$wp_prefix}usermeta` set `meta_value` = replace(`meta_value`, '{$current_url}', '{$new_url}') where `meta_key`='author_box_bg';");
		
		/* Update revolution slider images */
		$slides = $wpdb->get_results('select * from '.$wp_prefix.'revslider_slides');
		if( is_array($slides) ){
			foreach( $slides as $slide ){
				$params = json_decode($slide->params);
				$layers = json_decode($slide->layers);
				if( isset($params->image) ){
					$params->image = str_replace($current_url, $new_url, $params->image);
				}
				if( isset($params->slide_thumb) ){
					$params->slide_thumb = str_replace($current_url, $new_url, $params->slide_thumb);
				}
				
				if( isset($params->slide_bg_html_mpeg) ){
					$params->slide_bg_html_mpeg = str_replace($current_url, $new_url, $params->slide_bg_html_mpeg);
				}
				if( isset($params->slide_bg_html_webm) ){
					$params->slide_bg_html_webm = str_replace($current_url, $new_url, $params->slide_bg_html_webm);
				}
				if( isset($params->slide_bg_html_ogv) ){
					$params->slide_bg_html_ogv = str_replace($current_url, $new_url, $params->slide_bg_html_ogv);
				}
				
				if( is_array($layers) && count($layers) > 0 ){
					foreach( $layers as $key => $layer ){
						if( isset($layers[$key]->image_url) ){
							$layers[$key]->image_url = str_replace($current_url, $new_url, $layers[$key]->image_url);
						}
					}
				}
				
				$params = addslashes(json_encode($params));
				$layers = addslashes(json_encode($layers));
				
				$wpdb->query( "update `{$wp_prefix}revslider_slides` set `params`='{$params}', `layers`='{$layers}' where `id`={$slide->id}" );
			}
		}
		/* Update revolution slider images */
		
		if( $result_1===false || $result_2===false || $result_3===false || $result_4===false || $result_5===false ){
			$message = 'Update failed';
		}else{
			$message = 'Update successful. You need to save Permalinks(Settings > Permalinks) again';
		}
	}
?>
<div class="form-wrapper">
	<form name="input" action="" method="post">
		<h2>Input your site url</h2>
		<input type="text" name="site_url" autofocus autocomplete="off" />
		<p class="description">Without '/' at the end of url</p>
		<input type="submit" value="Change URL" />
	</form> 
	<?php if( $message != '' ): ?>
	<div class="message">
		<?php echo $message; ?>
	</div>
	<?php endif; ?>
</div>

<style type="text/css">
	.form-wrapper{
		width: 600px;
		text-align: center;
		margin: 0 auto;
		padding: 20px 10px;
		font-size: 17px;
	}
	.form-wrapper h2{
		text-transform: uppercase;
	}
	.form-wrapper input[type="text"]{
		width: 90%;
		height: 30px;
		line-height: 30px;
		font-size: 16px;
		padding: 2px 5px;
	}
	.form-wrapper .description{
		diplay: block;
		padding: 5px 5px;
		font-style: italic;
	}
	.form-wrapper input[type="submit"]{
		background-color: #2E9AFE;
		color: #fff;
		border: none;
		padding: 5px 10px;
		font-size: 16px;
	}
	.form-wrapper input[type="submit"]:hover{
		cursor: pointer;
		background-color: #58ACFA;
	}
	.form-wrapper .message{
		color: #FF00FF;
	}
</style>
