<?php 
global $boxshop_theme_options, $post;

get_header();

$extra_class = "";

boxshop_breadcrumbs_title(true, $boxshop_theme_options['ts_portfolio_title'], get_the_title());
if( isset($boxshop_theme_options['ts_breadcrumb_layout']) ){
	$extra_class = 'show_breadcrumb_'.$boxshop_theme_options['ts_breadcrumb_layout'];
}

$video_url = get_post_meta($post->ID, 'ts_video_url', true);
?>
<div id="content" class="page-container container-post <?php echo esc_attr($extra_class) ?>">
	
	<!-- main-content -->
	<div id="main-content" class="ts-col-24">
		<article class="single single-post single-portfolio">
			<!-- Blog Thumbnail -->
			<?php if( $boxshop_theme_options['ts_portfolio_thumbnail'] ): ?>
			<div class="thumbnails">
				<?php if( empty($video_url) ): ?>
					<figure>
						<?php
						$gallery = get_post_meta($post->ID, 'ts_gallery', true);
						if( $gallery ){
							$gallery_ids = explode(',', $gallery);
						}
						else{
							$gallery_ids = array();
						}
						
						if( is_array($gallery_ids) && has_post_thumbnail() ){
							array_unshift($gallery_ids, get_post_thumbnail_id());
						}
						foreach( $gallery_ids as $gallery_id ){
							$image_url = '';
							$image_src = wp_get_attachment_image_src($gallery_id, 'full');
							if( $image_src ){
								$image_url = $image_src[0];
							}
								
							echo '<a href="'.$image_url.'" rel="prettyPhoto[portfolio-gallery]">';
							echo wp_get_attachment_image( $gallery_id, 'full' );
							echo '</a>';
						}						
						?>
					</figure>
				<?php 
				else:
					echo do_shortcode('[ts_video src="'.esc_url($video_url).'"]');
				endif;
				?>
			</div>
			<?php endif; ?>
			<div class="entry-content">	
			
				<div class="info-content">
					<!-- Portfolio Title -->
					<?php if( $boxshop_theme_options['ts_portfolio_title'] ): ?>
						<h2 class="entry-title"><?php the_title() ?></h2>
					<?php endif; ?>
					
					<!-- Portfolio Content -->
					<?php if( $boxshop_theme_options['ts_portfolio_content'] ): ?>
						<div class="portfolio-content">
							<?php the_content(); ?>
						</div>
					<?php endif; ?>
				</div>
				
				<div class="meta-content">
				
					<!-- Portfolio Date -->
					<?php if( $boxshop_theme_options['ts_portfolio_custom_field'] ): ?>
						<div class="portfolio-info">
							<p><?php echo esc_html($boxshop_theme_options['ts_portfolio_custom_field_title']); ?></p>
							<div class="custom-field">
								<?php echo do_shortcode( stripslashes( htmlspecialchars_decode( $boxshop_theme_options['ts_portfolio_custom_field_content'] ) ) ) ?>
							</div>
						</div>
					<?php endif; ?>
					
					<!-- Portfolio Date -->
					<?php if( $boxshop_theme_options['ts_portfolio_date'] ): ?>
						<div class="portfolio-info">
							<p><?php esc_html_e('Date', 'boxshop') ?></p>
							<span class="date-time"><?php echo get_the_time(get_option('date_format')); ?></span>
						</div>
					<?php endif; ?>
					
					<!-- Portfolio URL -->
					<?php if( $boxshop_theme_options['ts_portfolio_url'] ): ?>
						<?php 
						$portfolio_url = get_post_meta($post->ID, 'ts_portfolio_url', true);
						if( $portfolio_url == '' ){
							$portfolio_url = get_the_permalink();
						}
						?>
						<div class="portfolio-info">
							<p><?php esc_html_e('Project URL', 'boxshop') ?></p>
							<span class="portfolio-url"><?php echo esc_url($portfolio_url); ?></span>
						</div>
					<?php endif; ?>
					
					<!-- Portfolio Categories -->
					<?php
					$categories_list = get_the_term_list($post->ID, 'ts_portfolio_cat', '', ', ', '');
					if ( $categories_list && $boxshop_theme_options['ts_portfolio_categories'] ):
					?>
						<div class="portfolio-info">
							<p><?php esc_html_e('Categories', 'boxshop'); ?></p>
							<span class="cat-links"><?php echo  $categories_list; ?></span>
						</div>
					<?php endif; ?>
					
					<?php if( $boxshop_theme_options['ts_portfolio_sharing'] || $boxshop_theme_options['ts_portfolio_likes'] ): ?>
					<div class="group-button-social-like">
						<!-- Portfolio Sharing -->
						<?php if( $boxshop_theme_options['ts_portfolio_sharing'] && function_exists('ts_template_social_sharing') ): ?>
							<div class="social-sharing style-2">
								<?php ts_template_social_sharing(); ?>
							</div>
						<?php endif; ?>
						
						<!-- Portfolio Likes -->
						<?php if( $boxshop_theme_options['ts_portfolio_likes'] ): ?>
							<?php 
							global $ts_portfolios;
							$like_num = 0;
							$already_like = false;
							if( is_a($ts_portfolios, 'TS_Portfolios') && method_exists($ts_portfolios, 'get_like') ){
								$like_num = $ts_portfolios->get_like($post->ID);
								$already_like = $ts_portfolios->user_already_like($post->ID);
							}
							?>
							<div class="portfolio-like">
								<span class="ic-like <?php echo ($already_like)?'already-like':'' ?>" data-post_id="<?php echo esc_attr($post->ID) ?>"></span>
								<span class="like-num"><?php echo esc_html($like_num); ?></span>
								<?php esc_html_e('Likes', 'boxshop'); ?>
							</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				
				</div>
				
				<!-- Next Prev Portfolio -->
				<div class="single-navigation">
				<?php
					previous_post_link('%link', esc_html__('Prev Project', 'boxshop'));
					next_post_link('%link', esc_html__('Next Project', 'boxshop'));
				?>
				</div>
				
			</div>
			
			<!-- Related Posts-->
			<?php 
			if( $boxshop_theme_options['ts_portfolio_related_posts'] ){
				get_template_part('templates/related-portfolios');
			}
			?>
		</article>
	</div><!-- end main-content -->
	
</div>
<?php get_footer(); ?>
