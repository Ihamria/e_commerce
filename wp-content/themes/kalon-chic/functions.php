<?php
/**
 * Theme functions and definitions
 *
 * @package Kalon_Chic
 */

/**
 * After setup theme hook
 */
function kalon_chic_theme_setup(){
    /*
     * Make chile theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'kalon-chic', get_stylesheet_directory() . '/languages' );

}
add_action( 'after_setup_theme', 'kalon_chic_theme_setup' );

/**
 * Load assets.
 *
 */
function kalon_chic_enqueue_styles() {
    $my_theme = wp_get_theme();
    $version = $my_theme['Version'];

    wp_enqueue_style( 'kalon-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'kalon-chic-style', get_stylesheet_directory_uri() . '/style.css', array( 'kalon-style' ), $version );

    $query_args = array(
        'family' => 'Lusitana:400,700|Nunito+Sans:400,400i,700,700i|Dancing Script:400,700',
        'subset' => 'latin,latin-ext',
    );
    wp_enqueue_style( 'kalon-chic-google-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
    wp_enqueue_script( 'kalon-chic-custom', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery', 'masonry' ), '1.0.0', true );
    
}
add_action( 'wp_enqueue_scripts', 'kalon_chic_enqueue_styles' );

function kalon_chic_dequeue_styles(){
     wp_dequeue_style( 'kalon-google-fonts' );
}
add_action( 'wp_enqueue_scripts','kalon_chic_dequeue_styles',99 ); 

function kalon_category_list(){
    $categories_list = get_the_category_list( ' ' );
    if ( $categories_list && kalon_categorized_blog() ) {
        echo '<span class="category">' . $categories_list . '</span>'; // WPCS: XSS OK.
    }       
}

function kalon_chic_footer(){
    $copyright_text = get_theme_mod( 'kalon_footer_copyright_text' );
    $text  = '<div class="site-info"><p>';
    if( $copyright_text ){
        $text .=  wp_kses_post( $copyright_text ).'&verbar;';
      }else{
        $text .=  esc_html__( 'Copyright &copy; ', 'kalon-chic' ) . esc_html( date_i18n( __( 'Y', 'kalon-chic' ) ) ); 
        $text .= ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a> &verbar; ';
      }
    $text .= esc_html__( 'Kalon Chic by : ', 'kalon-chic' );
    $text .= '<a href="' . esc_url( 'https://rarathemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Rara Theme', 'kalon-chic' ) . '</a> &verbar; ';
    $text .= sprintf( esc_html__( 'Powered by: %s', 'kalon-chic' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'kalon-chic' ) ) .'" target="_blank">WordPress.</a>' );
    if ( function_exists( 'the_privacy_policy_link' ) ) {
        $text .= get_the_privacy_policy_link();
    }
    $text .= '</p></div>';

    return $text;
}
add_filter( 'kalon_footer_text','kalon_chic_footer' );

function kalon_customizer_theme_info( $wp_customize ) {
    
    $wp_customize->add_section( 'theme_info' , array(
        'title'       => __( 'Information Links' , 'kalon-chic' ),
        'priority'    => 6,
        ));

    $wp_customize->add_setting('theme_info_theme',array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
        ));
    
    $theme_info = '';
    $theme_info .= '<h3 class="sticky_title">' . __( 'Need help?', 'kalon-chic' ) . '</h3>';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'View demo', 'kalon-chic' ) . ': </label><a href="' . esc_url( 'https://demo.rarathemes.com/kalon-chic/' ) . '" target="_blank">' . __( 'here', 'kalon-chic' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'View documentation', 'kalon-chic' ) . ': </label><a href="' . esc_url( 'https://docs.rarathemes.com/docs/kalon-chic/' ) . '" target="_blank">' . __( 'here', 'kalon-chic' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Support ticket', 'kalon-chic' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/support-ticket/' ) . '" target="_blank">' . __( 'here', 'kalon-chic' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="more-detail row-element">' . __( 'More Details', 'kalon-chic' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/wordpress-themes/' ) . '" target="_blank">' . __( 'here', 'kalon-chic' ) . '</a></span><br />';
    

    $wp_customize->add_control( new Kalon_Theme_Info( $wp_customize ,'theme_info_theme',array(
        'label'       => __( 'About Kalon' , 'kalon-chic' ),
        'section'     => 'theme_info',
        'description' => $theme_info
        )));

    $wp_customize->add_setting('theme_info_more_theme',array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
        ));

}

/**
 * Function for sanitizing Hex color 
 */
function kalon_chic_sanitize_hex_color( $color ){
    if ( '' === $color )
        return '';

    // 3 or 6 hex digits, or the empty string.
    if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
        return $color;
}
/**
 * Convert '#' to '%23'
*/
function kalon_chic_hash_to_percent23( $color_code ){
    $color_code = str_replace( "#", "%23", $color_code );
    return $color_code;
}

function kalon_chic_dynamic_color(){
    $primary_color  = get_theme_mod( 'primary_color', '#f69581' );
    echo "<style type='text/css' media='all'>"; ?>
        :root{
            --primary-color: <?php echo kalon_chic_sanitize_hex_color( $primary_color ); ?>;
        }
        .post .read-more:after{
            background: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='<?php echo kalon_chic_hash_to_percent23( kalon_chic_sanitize_hex_color( $primary_color ) ); ?>' viewBox='0 0 448 512'%3E%3Cpath d='M340.485 366l99.03-99.029c4.686-4.686 4.686-12.284 0-16.971l-99.03-99.029c-7.56-7.56-20.485-2.206-20.485 8.485v71.03H12c-6.627 0-12 5.373-12 12v32c0 6.627 5.373 12 12 12h308v71.03c0 10.689 12.926 16.043 20.485 8.484z'/%3E%3C/svg%3E") center center no-repeat;
        }

        .banner-text .text .read-more:hover:after,
        .banner-text .text .read-more:focus:after{
            background: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='<?php echo kalon_chic_hash_to_percent23( kalon_chic_sanitize_hex_color( $primary_color ) ); ?>' viewBox='0 0 448 512'%3E%3Cpath d='M340.485 366l99.03-99.029c4.686-4.686 4.686-12.284 0-16.971l-99.03-99.029c-7.56-7.56-20.485-2.206-20.485 8.485v71.03H12c-6.627 0-12 5.373-12 12v32c0 6.627 5.373 12 12 12h308v71.03c0 10.689 12.926 16.043 20.485 8.484z'/%3E%3C/svg%3E") center center no-repeat;
            -webkit-transform: translate(10px, -50%);
            -moz-transform: translate(10px, -50%);
            transform: translate(10px, -50%);
        }

        .post .read-more:hover:after,
        .post .read-more:focus:after{
            background: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='<?php echo kalon_chic_hash_to_percent23( kalon_chic_sanitize_hex_color( $primary_color ) ); ?>' viewBox='0 0 448 512'%3E%3Cpath d='M340.485 366l99.03-99.029c4.686-4.686 4.686-12.284 0-16.971l-99.03-99.029c-7.56-7.56-20.485-2.206-20.485 8.485v71.03H12c-6.627 0-12 5.373-12 12v32c0 6.627 5.373 12 12 12h308v71.03c0 10.689 12.926 16.043 20.485 8.484z'/%3E%3C/svg%3E") center center no-repeat;
        }

        .widget-area .widget.widget_kalon_featured_post .readmore:after{
            background: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='<?php echo kalon_chic_hash_to_percent23( kalon_chic_sanitize_hex_color( $primary_color ) ); ?>' viewBox='0 0 448 512'%3E%3Cpath d='M340.485 366l99.03-99.029c4.686-4.686 4.686-12.284 0-16.971l-99.03-99.029c-7.56-7.56-20.485-2.206-20.485 8.485v71.03H12c-6.627 0-12 5.373-12 12v32c0 6.627 5.373 12 12 12h308v71.03c0 10.689 12.926 16.043 20.485 8.484z'/%3E%3C/svg%3E") center center no-repeat;
        }

        .post .entry-content blockquote:before,
        .page .entry-content blockquote:before{
            background-image: url('data:image/svg+xml; utf-8, <svg xmlns="http://www.w3.org/2000/svg" width="33.576" height="22.415" viewBox="0 0 33.576 22.415"><g transform="translate(-7.924 -21.936)" fill="<?php echo kalon_chic_hash_to_percent23( kalon_chic_sanitize_hex_color( $primary_color ) ); ?>"><g transform="translate(7.924 21.936)"><path d="M24.276,30.09a8.153,8.153,0,0,0-8.154-8.154c-4.5,0-7.772,3.525-8.154,8.012-.582,6.847,4.619,12.58,10.934,14.4a8.147,8.147,0,0,1-3.9-6.2,7.969,7.969,0,0,0,1.124.089A8.153,8.153,0,0,0,24.276,30.09Z" transform="translate(-7.924 -21.936)"/><path d="M67.4,30.09a8.153,8.153,0,0,0-8.154-8.154c-4.5,0-7.772,3.525-8.154,8.012-.582,6.847,4.619,12.58,10.935,14.4a8.148,8.148,0,0,1-3.9-6.2,7.974,7.974,0,0,0,1.124.089A8.153,8.153,0,0,0,67.4,30.09Z" transform="translate(-33.829 -21.936)"/></g></g></svg>');
        }
    <?php echo "</style>";
}
add_action( 'wp_head','kalon_chic_dynamic_color',101 );

function kalon_site_header(){
    ?>
    <header id="masthead" class="site-header" role="banner" itemscope itemtype="http://schema.org/WPHeader">
        <div class="header-top">
            <div class="container">
                <?php if( get_theme_mod('kalon_ed_social') ) do_action( 'kalon_social' ); ?>
                <div class="search-holder">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
        <div class="site-branding" itemscope itemtype="http://schema.org/Organization">
            <?php 
                if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                    the_custom_logo();
                } 
                if ( is_front_page() && is_home() ) : ?>
                    <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                <?php
                else : ?>
                    <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                <?php
                endif;
                $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) : ?>
                   <p class="site-description" itemprop="description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
            <?php
               endif; 
            ?>
        </div><!-- .site-branding -->
        <div class="header-bottom">
            <div class="container">
                <nav id="site-navigation" class="main-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
                    <div class="menu">
                         <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => '', 'menu_class' => '' ) ); ?>
                    </div>
                </nav>
            </div>
        </div>
    </header><!-- #masthead -->
    <?php
}

function kalon_chic_added_customizer_settings( $wp_customize ){

    $wp_customize->add_setting(
        'primary_color',
        array(
            'default'           => '#f69581',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
        $wp_customize, 
        'primary_color', 
        array(
            'label'      => __( 'Primary Color', 'kalon-chic' ),
            'section'    => 'colors',
        ) ) 
    );

    /** Instagram Settings */
    $wp_customize->add_section(
        'kalon_chic_instagram',
        array(
            'title'      => __( 'Instagram Settings', 'kalon-chic' ),
            'priority'   => 50,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Blossom Instagram  */
     $wp_customize->add_setting(
        'ed_blossom_instagram_shortcode',
        array(
            'default'           => false,
            'sanitize_callback' => 'kalon_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'ed_blossom_instagram_shortcode',
        array(
            'label'       => __( 'Enable Blossom Instagram', 'kalon-chic' ),
            'description' => sprintf( esc_html__( ' You can make Instagram Grid using %1$sBlossomThemes Instagram Feed%2$s', 'kalon-chic' ), '<b>', '</b>' ),
            'section'     => 'kalon_chic_instagram',
            'type'        => 'checkbox',
            'active_callback' => 'kalon_chic_is_btif_activated'
        )
    );

    /** Newsletter Settings  */
    $wp_customize->add_section(
        'kalon_chic_newsletter',
        array(
            'title'      => __( 'Newsletter Settings', 'kalon-chic' ),
            'priority'   => 55,
            'capability' => 'edit_theme_options',
        )
    );

    $wp_customize->add_setting(
        'ed_blossom_newsletter_shortcode',
        array(
            'default'           => false,
            'sanitize_callback' => 'kalon_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'ed_blossom_newsletter_shortcode',
        array(
            'label'       => __( 'Enable Blossom Email Newsletter', 'kalon-chic' ),
            'description' => sprintf( esc_html__( ' You can make Newsletter in the Homepage by using %1$sBlossomThemes Email Newsletter%2$s', 'kalon-chic' ), '<b>', '</b>' ),
            'section'     => 'kalon_chic_newsletter',
            'type'        => 'checkbox',
            'active_callback' => 'kalon_chic_is_btnw_activated'
        )
    );

    $wp_customize->add_setting(
        'blossom_newsletter_shortcode',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );

    $wp_customize->add_control(
        'blossom_newsletter_shortcode',
        array(
            'label'       => __( 'Blossom Email Newsletter', 'kalon-chic' ),
            'description' => __( 'Enter Blossom Email Newsletter Shortcode', 'kalon-chic' ),
            'section'     => 'kalon_chic_newsletter',
            'type'        => 'text',
            'active_callback' => 'kalon_chic_is_btnw_activated'
        )
    );

}
add_action( 'customize_register', 'kalon_chic_added_customizer_settings' );

function kalon_chic_blossom_instagram(){
    $instagram = get_theme_mod( 'ed_blossom_instagram_shortcode',false );
    if( kalon_chic_is_btif_activated() ){
     $options = get_option( 'blossomthemes_instagram_feed_settings', true );
     if( !isset( $options['username'] ) || $options['username'] == '' ){
            return;
        }
    }
    if( $instagram && is_front_page() ){ ?>
        <div class="instagram-section">
            <?php echo do_shortcode( '[blossomthemes_instagram_feed]' ); ?>
        </div>
    <?php }
}

function kalon_chic_blossom_newsletter(){
    $newsletter           = get_theme_mod( 'ed_blossom_newsletter_shortcode',false );
    $newsletter_shortcode = get_theme_mod( 'blossom_newsletter_shortcode');
    if( $newsletter && is_front_page() ){
        echo do_shortcode( $newsletter_shortcode );
    }
}

/**
 * Is BlossomThemes Email Newsletters active or not
*/
function kalon_chic_is_btnw_activated(){
    return class_exists( 'Blossomthemes_Email_Newsletter' ) ? true : false;        
}

/**
 * Is BlossomThemes Instagram Feed active or not
*/
function kalon_chic_is_btif_activated(){
    return class_exists( 'Blossomthemes_Instagram_Feed' ) ? true : false;
}