<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Kalon
 */

get_header(); ?>
	
	<div class="error-page">
		
        <h2><?php esc_html_e( 'Page Not Found!','kalon'); ?></h2>
		<span><?php esc_html_e( '404','kalon'); ?></span>
		<p>
			<?php esc_html_e( 'We&rsquo;re sorry, but we can&rsquo;t find the page you were looking for.
			 It&rsquo;s probably some thing we&rsquo;ve done wrong but<br> now we know about it and 
			 we&rsquo;ll try to fix it. In the meantime, try one of these options:' ,'kalon'); ?>
		</p>
		<ul>
			<li><a href="javascript:javascript:history.go(-1)"><?php esc_html_e( 'Go to Previous Page','kalon'); ?></a></li>
			<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go to Homepage','kalon'); ?></a></li>
		</ul>
		
	</div>

<?php
get_footer();