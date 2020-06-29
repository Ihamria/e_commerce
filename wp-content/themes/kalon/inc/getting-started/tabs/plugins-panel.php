<?php
/**
 * Help Panel.
 *
 * @package Kalon
 */
?>
<!-- Updates panel -->
<div id="plugins-panel" class="panel-left visible">
	<h4><?php esc_html_e( 'Recommended Plugins', 'kalon' ); ?></h4>

	<?php if( KALON_THEME_NAME === 'Kalon Chic' ){ ?> 
		<p><?php printf( esc_html__( 'Here is a list of recommended plugins you should install to get most out of the %1$s. Though every plugin is optional, we recommend you to at least install %2$sBlossomThemes Email Newsletter%3$s, %2$sRara One Click Demo Import%3$s & %2$sBlossomThemes Instagram Feed%3$s to create a website similar to the %1$s demo and also to ensure every feature of the theme works correctly.', 'kalon' ), KALON_THEME_NAME,'<strong>','</strong>' ); ?></p>
	<?php }else{ ?>
		<p><?php printf( esc_html__( 'Here is a list of recommended plugins you should install to get most out of the %1$s. Though every plugin is optional, we recommend you to at least install %2$sRara One Click Demo Import%3$s to create a website similar to the %1$s demo and also to ensure every feature of the theme works correctly.', 'kalon' ), KALON_THEME_NAME,'<strong>','</strong>' ); ?></p>
	<?php } ?>
	

	<hr/>

	<?php 
	$free_plugins = array(              
		'rara-one-click-demo-import' => array(
			'slug' 	 	=> 'rara-one-click-demo-import',
			'filename'  => 'rara-one-click-demo-import.php',
		)             
	);

	 if( KALON_THEME_NAME === 'Kalon Chic' ){
	       $free_plugins = array(
			'blossomthemes-email-newsletter' => array(
				'slug'     	=> 'blossomthemes-email-newsletter',
				'filename' 	=> 'blossomthemes-email-newsletter.php',
			),                
			'blossomthemes-instagram-feed' => array(
				'slug' 		=> 'blossomthemes-instagram-feed',
				'filename' 	=> 'blossomthemes-instagram-feed.php',
			),                
			'rara-one-click-demo-import' => array(
				'slug' 	 	=> 'rara-one-click-demo-import',
				'filename'  => 'rara-one-click-demo-import.php',
			),                
		);
    }

	if( $free_plugins ){ ?>
		<h4 class="recomplug-title"><?php esc_html_e( 'Free Plugins', 'kalon' ); ?></h4>
		<p><?php esc_html_e( 'These Free Plugins might be handy for you.', 'kalon' ); ?></p>
		<div class="recomended-plugin-wrap">
    		<?php
    		foreach( $free_plugins as $plugin ) {
    			$info     = kalon_call_plugin_api( $plugin['slug'] );
    			$icon_url = kalon_check_for_icon( $info->icons ); ?>    
    			<div class="recom-plugin-wrap">
    				<div class="plugin-img-wrap">
    					<img src="<?php echo esc_url( $icon_url ); ?>" />
    					<div class="version-author-info">
    						<span class="version"><?php printf( esc_html__( 'Version %s', 'kalon' ), $info->version ); ?></span>
    						<span class="seperator">|</span>
    						<span class="author"><?php echo esc_html( strip_tags( $info->author ) ); ?></span>
    					</div>
    				</div>
    				<div class="plugin-title-install clearfix">
    					<span class="title" title="<?php echo esc_attr( $info->name ); ?>">
    						<?php echo esc_html( $info->name ); ?>	
    					</span>
                        <div class="button-wrap">
    					   <?php echo Kalon_Getting_Started_Page_Plugin_Helper::instance()->get_button_html( $plugin['slug'], $plugin['filename'] ); ?>
                        </div>
    				</div>
    			</div>
    			<?php
    		} 
            ?>
		</div>
	<?php
	} 
?>
</div><!-- .panel-left -->