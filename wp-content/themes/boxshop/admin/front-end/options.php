<div class="wrap" id="of_container">

	<div id="of-popup-save" class="of-save-popup">
		<div class="of-save-save"><?php esc_html_e('Options Updated', 'boxshop') ?></div>
	</div>
	
	<div id="of-popup-reset" class="of-save-popup">
		<div class="of-save-reset"><?php esc_html_e('Options Reset', 'boxshop') ?></div>
	</div>
	
	<div id="of-popup-fail" class="of-save-popup">
		<div class="of-save-fail"><?php esc_html_e('Error!', 'boxshop') ?></div>
	</div>
	
	<span style="display: none;" id="hooks"><?php echo json_encode(boxshop_of_get_header_classes_array()); ?></span>
	<input type="hidden" id="reset" value="<?php if(isset($_REQUEST['reset'])) echo esc_attr($_REQUEST['reset']); ?>" />
	<input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('of_ajax_nonce'); ?>" />

	<form id="of_form" method="post" action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" enctype="multipart/form-data" >
	
		<div id="header">
		
			<div class="logo">
				<h2><?php echo esc_html(THEMENAME); ?></h2>
				<span><?php echo ('v'. esc_html(THEMEVERSION)); ?></span>
			</div>
		
			<div id="js-warning"><?php esc_html_e('Warning- This options panel will not work properly without javascript!', 'boxshop') ?></div>
			<div class="icon-option"></div>
			<div class="clear"></div>
		
    	</div>

		<div id="info_bar">
		
			<a>
				<div id="expand_options" class="expand"><?php esc_html_e('Expand', 'boxshop') ?></div>
			</a>
						
			<img style="display:none" src="<?php echo esc_url(ADMIN_DIR); ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="" />

			<button id="of_save" type="button" class="button-primary">
				<?php esc_html_e('Save All Changes', 'boxshop');?>
			</button>
			
		</div><!--.info_bar--> 	
		
		<div id="main">
		
			<div id="of-nav">
				<ul>
				  <?php echo boxshop_theme_options_get_menu_html(); ?>
				</ul>
			</div>

			<div id="content">
		  		<?php echo boxshop_theme_options_get_options_html(); ?>
		  	</div>
		  	
			<div class="clear"></div>
			
		</div>
		
		<div id="ts-footer-theme-options-sticky">
			<div id="ts-footer-theme-options" class="save_bar"> 
			
				<img style="display:none" src="<?php echo esc_url(ADMIN_DIR); ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="" />
				<button id ="of_save" type="button" class="button-primary"><?php esc_html_e('Save All Changes', 'boxshop'); ?></button>			
				<button id ="of_reset" type="button" class="button submit-button reset-button" ><?php esc_html_e('Options Reset', 'boxshop'); ?></button>
				<img style="display:none" src="<?php echo esc_url(ADMIN_DIR); ?>assets/images/loading-bottom.gif" class="ajax-reset-loading-img ajax-loading-img-bottom" alt="" />
				
			</div><!--.save_bar--> 
		</div>
 
	</form>
	
	<div style="clear:both;"></div>

</div><!--wrap-->
<div class="smof_footer_info"><?php esc_html_e('Slightly Modified Options Framework', 'boxshop') ?> <strong><?php echo esc_html(SMOF_VERSION); ?></strong></div>

<!-- Ads banner -->
<?php $ads_theme_url = 'https://themeforest.net/item/sanzo-responsive-woocommerce-wordpress-theme/17492330?ref=skygroup'; ?>
<div id="ts-ads-banner-theme-options" class="hidden">
	<a href="<?php echo esc_url($ads_theme_url) ?>" target="_blank">
		<img src="<?php echo esc_url(ADMIN_DIR); ?>assets/images/ads-theme-banner.jpg" alt="" />
	</a>
</div>
