<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Kalon
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function kalon_body_classes( $classes ) {

    global $post;
    
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
    
    // Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
		$classes[] = 'custom-background-color';
	}
    
    if( !( is_active_sidebar( 'right-sidebar' ) ) ) {
        $classes[] = 'full-width'; 
    }
    
    if( is_page() ){
        $sidebar_layout = get_post_meta( $post->ID, 'kalon_sidebar_layout', true );
        if( $sidebar_layout == 'no-sidebar' )
        $classes[] = 'full-width';
    }

	return $classes;
}
add_filter( 'body_class', 'kalon_body_classes' );

/**
 * Callback for Social Links 
 */
function kalon_social_cb(){

    $facebook  = get_theme_mod( 'kalon_facebook' );
    $twitter   = get_theme_mod( 'kalon_twitter' );
    $instagram = get_theme_mod( 'kalon_instagram' );
    $pinterest = get_theme_mod( 'kalon_pinterest' );
    $linkedin  = get_theme_mod( 'kalon_linkedin' );
    $youtube   = get_theme_mod( 'kalon_youtube' );
    
    if( $facebook || $twitter || $instagram || $pinterest || $linkedin || $youtube ){
    ?>
    <ul class="social-networks">
		<?php if( $facebook ){?>
            <li><a href="<?php echo esc_url( $facebook );?>" target="_blank" title="<?php esc_html_e( 'Facebook', 'kalon' ); ?>"><span class="fa fa-facebook"></span></a></li>
         <?php } if( $instagram ){?>
            <li><a href="<?php echo esc_url( $instagram );?>" target="_blank" title="<?php esc_html_e( 'Instagram', 'kalon' ); ?>"><span class="fa fa-instagram"></span></a></li>
		<?php } if( $twitter ){?>    
            <li><a href="<?php echo esc_url( $twitter );?>" target="_blank" title="<?php esc_html_e( 'Twitter', 'kalon' ); ?>"><span class="fa fa-twitter"></span></a></li>
            <?php } if( $pinterest ){?>
            <li><a href="<?php echo esc_url( $pinterest );?>" target="_blank" title="<?php esc_html_e( 'Pinterest', 'kalon' ); ?>"><span class="fa fa-pinterest-p"></span></a></li>
		<?php } if( $linkedin ){?>
            <li><a href="<?php echo esc_url( $linkedin );?>" target="_blank" title="<?php esc_html_e( 'LinkedIn', 'kalon' ); ?>"><span class="fa fa-linkedin"></span></a></li>
        <?php } if( $youtube ){?>
            <li><a href="<?php echo esc_url( $youtube );?>" target="_blank" title="<?php esc_html_e( 'YouTube', 'kalon' ); ?>"><span class="fa fa-youtube"></span></a></li>    
        <?php } ?>
	</ul>
    <?php
    }
}
add_action( 'kalon_social', 'kalon_social_cb' );
 
/**
 * Callback for Home Page Slider 
 **/
function kalon_slider_cb(){
    
    $slider_caption  = get_theme_mod( 'kalon_slider_caption', '1' );    
    $slider_readmore = get_theme_mod( 'kalon_slider_readmore', __( 'Continue Reading', 'kalon' ) );
    $sticky_post     = get_option( 'sticky_posts' ); //get all sticky posts
    
    $args = array( 
        'post_type'           => 'post', 
        'post_status'         => 'publish',
        'posts_per_page'      => -1,
        'post__in'            => ( isset( $sticky_post ) && !empty( $sticky_post ) ) ? $sticky_post: array(-1),
        'ignore_sticky_posts' => 1, 
    );
    $kalon_qry = new WP_Query ( $args );
    
    if( $kalon_qry->have_posts() ){?>
        <div class="slider">
            <div id="lightSlider" class="slides owl-carousel owl-theme">
                <?php
                while( $kalon_qry->have_posts() ){
                    $kalon_qry->the_post();
                ?>
                    <?php if( has_post_thumbnail() ){?>
                    <div>
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'kalon-slider', array( 'itemprop' => 'image' ) ); ?></a>
                        <?php if( $slider_caption ){ ?>
                        <div class="banner-text">
                            <div class="container">
                                <div class="text">
                                    <?php kalon_category_list(); ?>
                                    <h2><?php the_title(); ?></h2>
                                    <a class="read-more" href="<?php the_permalink(); ?>"><?php echo esc_html( $slider_readmore );?></a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
    wp_reset_postdata();       
        
}
add_action( 'kalon_slider', 'kalon_slider_cb' );

/**
 * Function to exclude sticky post from main query
*/
function kalon_exclude_sticky_post( $query ){
    //get all sticky posts
    $stickies = get_option( 'sticky_posts' );

    if ( ! is_admin() && $query->is_home() && $query->is_main_query() && get_theme_mod( 'kalon_ed_slider' ) && $stickies ) {
        $query->set( 'post__not_in',        $stickies );
        $query->set( 'ignore_sticky_posts', true      );
    }    
}
add_filter( 'pre_get_posts', 'kalon_exclude_sticky_post' );

/**
 * Callback function for Comment List
 * 
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments 
 */
function kalon_comment( $comment, $args, $depth ){
    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body" itemscope itemtype="http://schema.org/UserComments">
    <?php endif; ?>
    <div class="comment-author vcard">
    <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
    <?php printf( __( '<b class="fn" itemprop="creator" itemscope itemtype="http://schema.org/Person">%s</b>', 'kalon' ), get_comment_author_link() ); ?>
    </div>
    <?php if ( $comment->comment_approved == '0' ) : ?>
        <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'kalon' ); ?></em>
        <br />
    <?php endif; ?>

    <div class="comment-metadata commentmetadata">
        <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
            <?php echo get_comment_date(); ?>
        </a>
        <?php edit_comment_link( __( 'Edit', 'kalon' ), '  ', '' ); ?>
    </div>
    
    <div class="comment-content">
       <?php comment_text(); ?>
    </div>
    
    <div class="reply">
    <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
<?php
}

/**
 * 
*/
function kalon_intro_header(){
    
    if( is_archive() ){ ?>
        <div class="category">
			<?php the_archive_title( '<h4 class="category-title">', '</h4>' ); ?>
		</div><!-- .category -->
    <?php
    }
    
    if( is_search() ){ 
        global $wp_query;    
    ?>
        <div class="search-section">
			<p class="page-title"><?php printf( esc_html__( 'Search Results for %s', 'kalon' ), get_search_query() ); ?>
			<span><?php printf( esc_html__( '(Showing %s Results)','kalon' ), $wp_query->found_posts ); ?></span>
			</p>
		</div><!-- .search-section -->
    <?php
    }
}
add_action( 'kalon_header', 'kalon_intro_header' );

/**
 * Custom CSS
*/
if ( function_exists( 'wp_update_custom_css_post' ) ) {
    // Migrate any existing theme CSS to the core option added in WordPress 4.7.
    $css = get_theme_mod( 'kalon_custom_css' );
    if ( $css ) {
        $core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
        $return = wp_update_custom_css_post( $core_css . $css );
        if ( ! is_wp_error( $return ) ) {
            // Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
            remove_theme_mod( 'kalon_custom_css' );
        }
    }
} else {
    function kalon_custom_css(){
        $custom_css = get_theme_mod( 'kalon_custom_css' );
        if( !empty( $custom_css ) ){
    		echo '<style type="text/css">';
    		echo wp_strip_all_tags( $custom_css );
    		echo '</style>';
    	}
    }
    add_action( 'wp_head', 'kalon_custom_css', 100 );
}
if ( ! function_exists( 'kalon_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function kalon_excerpt_more( $more ) {
	return is_admin() ? $more : ' &hellip; ';
}
add_filter( 'excerpt_more', 'kalon_excerpt_more' );
endif;

if ( ! function_exists( 'kalon_excerpt_length' ) ) :
/**
 * Changes the default 55 character in excerpt 
*/
function kalon_excerpt_length( $length ) {
	return 60;
}
add_filter( 'excerpt_length', 'kalon_excerpt_length', 999 );
endif;

/**
 * Footer Credits 
*/
function kalon_footer_credit(){
    $copyright_text = get_theme_mod( 'kalon_footer_copyright_text' );
    $text  = '<div class="site-info"><p>';
    if( $copyright_text ){
        $text .=  wp_kses_post( $copyright_text ).'&verbar;';
      }else{
        $text .=  esc_html__( 'Copyright &copy; ', 'kalon' ) . esc_html( date_i18n( __( 'Y', 'kalon' ) ) ); 
        $text .= ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a> &verbar; ';
      }
    $text .= esc_html__( 'Kalon by : ', 'kalon' );
    $text .= '<a href="' . esc_url( 'https://rarathemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Rara Theme', 'kalon' ) . '</a> &verbar; ';
    $text .= sprintf( esc_html__( 'Powered by: %s', 'kalon' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'kalon' ) ) .'" target="_blank">WordPress.</a>' );
    if ( function_exists( 'the_privacy_policy_link' ) ) {
        $text .= get_the_privacy_policy_link();
    }
    $text .= '</p></div>';
    echo apply_filters( 'kalon_footer_text', $text );    
}
add_action( 'kalon_footer', 'kalon_footer_credit' );

/**
 * Return sidebar layouts for pages
*/
function kalon_sidebar_layout(){
    global $post;
    
    if( get_post_meta( $post->ID, 'kalon_sidebar_layout', true ) ){
        return get_post_meta( $post->ID, 'kalon_sidebar_layout', true );    
    }else{
        return 'right-sidebar';
    }
}

if( ! function_exists( 'kalon_single_post_schema' ) ) :
/**
 * Single Post Schema
 *
 * @return string
 */
function kalon_single_post_schema() {
    if ( is_singular( 'post' ) ) {
        global $post;
        $custom_logo_id = get_theme_mod( 'custom_logo' );

        $site_logo   = wp_get_attachment_image_src( $custom_logo_id , 'kalon-schema' );
        $images      = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
        $excerpt     = kalon_escape_text_tags( $post->post_excerpt );
        $content     = $excerpt === "" ? mb_substr( kalon_escape_text_tags( $post->post_content ), 0, 110 ) : $excerpt;
        $schema_type = ! empty( $custom_logo_id ) && has_post_thumbnail( $post->ID ) ? "BlogPosting" : "Blog";

        $args = array(
            "@context"  => "http://schema.org",
            "@type"     => $schema_type,
            "mainEntityOfPage" => array(
                "@type" => "WebPage",
                "@id"   => get_permalink( $post->ID )
            ),
            "headline"  => ( function_exists( '_wp_render_title_tag' ) ? wp_get_document_title() : wp_title( '', false, 'right' ) ),
            "image"     => array(
                "@type"  => "ImageObject",
                "url"    => $images[0],
                "width"  => $images[1],
                "height" => $images[2]
            ),
            "datePublished" => get_the_time( DATE_ISO8601, $post->ID ),
            "dateModified"  => get_post_modified_time(  DATE_ISO8601, __return_false(), $post->ID ),
            "author"        => array(
                "@type"     => "Person",
                "name"      => kalon_escape_text_tags( get_the_author_meta( 'display_name', $post->post_author ) )
            ),
            "publisher" => array(
                "@type"       => "Organization",
                "name"        => get_bloginfo( 'name' ),
                "description" => get_bloginfo( 'description' ),
                "logo"        => array(
                    "@type"   => "ImageObject",
                    "url"     => $site_logo[0],
                    "width"   => $site_logo[1],
                    "height"  => $site_logo[2]
                )
            ),
            "description" => ( class_exists('WPSEO_Meta') ? WPSEO_Meta::get_value( 'metadesc' ) : $content )
        );

        if ( has_post_thumbnail( $post->ID ) ) :
            $args['image'] = array(
                "@type"  => "ImageObject",
                "url"    => $images[0],
                "width"  => $images[1],
                "height" => $images[2]
            );
        endif;

        if ( ! empty( $custom_logo_id ) ) :
            $args['publisher'] = array(
                "@type"       => "Organization",
                "name"        => get_bloginfo( 'name' ),
                "description" => get_bloginfo( 'description' ),
                "logo"        => array(
                    "@type"   => "ImageObject",
                    "url"     => $site_logo[0],
                    "width"   => $site_logo[1],
                    "height"  => $site_logo[2]
                )
            );
        endif;

        echo '<script type="application/ld+json">' , PHP_EOL;
        echo wp_json_encode( $args, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) , PHP_EOL;
        echo '</script>' , PHP_EOL;
    }
}
endif;
add_action( 'wp_head', 'kalon_single_post_schema' );

if( ! function_exists( 'kalon_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 *
 * @return string
 */
function kalon_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

if( ! function_exists( 'kalon_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
*/
function kalon_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );    
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label class="screen-reader-text" for="author">' . esc_html__( 'Name*', 'kalon' ) . '</label><input id="author" name="author" placeholder="' . esc_attr__( 'Name*', 'kalon' ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . esc_html__( 'Email*', 'kalon' ) . '</label><input id="email" name="email" placeholder="' . esc_attr__( 'Email*', 'kalon' ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label class="screen-reader-text" for="url">' . esc_html__( 'Website', 'kalon' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'kalon' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'kalon_change_comment_form_default_fields' );

if( ! function_exists( 'kalon_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
*/
function kalon_change_comment_form_defaults( $fields ){ 
    $comment_field = $fields['comment'];   
    $fields['comment'] = '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . esc_html__( 'Comment', 'kalon' ) . '</label><textarea id="comment" name="comment" cols="40" rows="8" required="required" placeholder="' . esc_attr__( 'Comment','kalon' ) . '"></textarea></p>';;
    
    return $fields;    
}
endif;
add_filter( 'comment_form_fields', 'kalon_change_comment_form_defaults' );

if( ! function_exists( 'wp_body_open' ) ) :
/**
 * Fire the wp_body_open action.
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
*/
function wp_body_open() {
	/**
	 * Triggered after the opening <body> tag.
    */
	do_action( 'wp_body_open' );
}
endif;

/**
 * Query WooCommerce activation
 */
function is_woocommerce_activated() {
    return class_exists( 'woocommerce' ) ? true : false;
}