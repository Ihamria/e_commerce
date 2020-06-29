<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kalon
 */

?>
            </div><!-- .row -->
        </div><!-- .container -->
	</div><!-- #content -->
    
	<footer id="colophon" class="site-footer" role="contentinfo">
    
		<?php if( is_active_sidebar( 'footer-one' ) || is_active_sidebar( 'footer-two' ) || is_active_sidebar( 'footer-three' ) ){?>
    		<div class="widget-area">
    			<div class="container">
    				<div class="row">
    					<?php if( is_active_sidebar( 'footer-one' ) ){ ?>
        					<div class="column">
        					   <?php dynamic_sidebar( 'footer-one' ); ?>	
        					</div>
                        <?php } ?>
    					
                        <?php if( is_active_sidebar( 'footer-two' ) ){ ?>
                            <div class="column">
        					   <?php dynamic_sidebar( 'footer-two' ); ?>	
        					</div>
                        <?php } ?>
                        
                        <?php if( is_active_sidebar( 'footer-three' ) ){ ?>
                            <div class="column">
        					   <?php dynamic_sidebar( 'footer-three' ); ?>	
        					</div>
                        <?php } ?>
    				</div>
    			</div>
    		</div>
		<?php } ?>

		<?php do_action( 'kalon_footer' ); ?>
        
	</footer><!-- #colophon -->
    <div class="overlay"></div>
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
