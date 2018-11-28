<?php
get_header(); 
?>
	<div class="fullwidth-template">
		<div id="main-content">	
			<div id="primary" class="site-content">
				<article>
					<?php 
					$allowed_html = array(
						'h1'	=> array()
						,'h2'	=> array()
						,'p'	=> array()
						,'br'	=> array()
						,'a'	=> array( 'href' => array(), 'title' => array() )
					);
					echo sprintf( wp_kses( __( '<h1>404</h1><h2>Oops! Page Not Found</h2>
					<p>The link you clicked might be corrupted, or the page may have been removed.<br/>
					You can back to <a href="%s">homepage</a> or search anything.</p>'
					, 'boxshop' ), $allowed_html ), esc_url( home_url('/') ) );
					
					get_search_form();
					?>
				</article>
			</div>
		</div>
	</div>
<?php
get_footer();
