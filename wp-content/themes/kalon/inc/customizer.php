<?php
/**
 * Kalon Theme Customizer.
 *
 * @package Kalon
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kalon_customize_register( $wp_customize ) {
    
    if ( version_compare( get_bloginfo('version'),'4.9', '>=') ) {
        $wp_customize->get_section( 'static_front_page' )->title = __( 'Static Front Page', 'kalon' );
    }
    /** Default Settings */    
    $wp_customize->add_panel( 
        'wp_default_panel',
         array(
            'priority' => 10,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => __( 'Default Settings', 'kalon' ),
            'description' => __( 'Default section provided by wordpress customizer.', 'kalon' ),
        ) 
    );
    
    $wp_customize->get_section( 'title_tagline' )->panel     = 'wp_default_panel';
    $wp_customize->get_section( 'colors' )->panel            = 'wp_default_panel';
    $wp_customize->get_section( 'background_image' )->panel  = 'wp_default_panel';
    $wp_customize->get_section( 'static_front_page' )->panel = 'wp_default_panel'; 

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'refresh';
    $wp_customize->get_setting( 'background_image' )->transport = 'refresh';

    /** Slider Settings */
    $wp_customize->add_section(
        'kalon_slider_settings',
        array(
            'title'       => __( 'Slider Settings', 'kalon' ),
            'description' => __( 'In order to show posts in slider, make the posts sticky.', 'kalon' ),
            'priority'    => 20,
            'capability'  => 'edit_theme_options',
        )
    );
    
    /** Enable/Disable Slider */
    $wp_customize->add_setting(
        'kalon_ed_slider',
        array(
            'default' => '',
            'sanitize_callback' => 'kalon_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'kalon_ed_slider',
        array(
            'label' => __( 'Enable Home Page Slider', 'kalon' ),
            'section' => 'kalon_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Auto Transition */
    $wp_customize->add_setting(
        'kalon_slider_auto',
        array(
            'default' => '1',
            'sanitize_callback' => 'kalon_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'kalon_slider_auto',
        array(
            'label' => __( 'Enable Slider Auto Transition', 'kalon' ),
            'section' => 'kalon_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Loop */
    $wp_customize->add_setting(
        'kalon_slider_loop',
        array(
            'default' => '1',
            'sanitize_callback' => 'kalon_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'kalon_slider_loop',
        array(
            'label' => __( 'Enable Slider Loop', 'kalon' ),
            'section' => 'kalon_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Control */
    $wp_customize->add_setting(
        'kalon_slider_control',
        array(
            'default' => '1',
            'sanitize_callback' => 'kalon_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'kalon_slider_control',
        array(
            'label' => __( 'Enable Slider Control', 'kalon' ),
            'section' => 'kalon_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Caption */
    $wp_customize->add_setting(
        'kalon_slider_caption',
        array(
            'default' => '1',
            'sanitize_callback' => 'kalon_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'kalon_slider_caption',
        array(
            'label' => __( 'Enable Slider Caption', 'kalon' ),
            'section' => 'kalon_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Slider Animation */
    $wp_customize->add_setting(
        'kalon_slider_animation',
        array(
            'default' => 'slide',
            'sanitize_callback' => 'kalon_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'kalon_slider_animation',
        array(
            'label' => __( 'Choose Slider Animation', 'kalon' ),
            'section' => 'kalon_slider_settings',
            'type' => 'select',
            'choices' => array(
                'fade' => __( 'Fade', 'kalon' ),
                'slide' => __( 'Slide', 'kalon' ),
            )
        )
    );
    
    /** Slider Speed */
    $wp_customize->add_setting(
        'kalon_slider_speed',
        array(
            'default' => '7000',
            'sanitize_callback' => 'kalon_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
        'kalon_slider_speed',
        array(
            'label' => __( 'Slider Speed', 'kalon' ),
            'section' => 'kalon_slider_settings',
            'type' => 'text',
        )
    );
    
    /** Slider Readmore */
    $wp_customize->add_setting(
        'kalon_slider_readmore',
        array(
            'default' => __( 'Continue Reading', 'kalon' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'kalon_slider_readmore',
        array(
            'label' => __( 'Readmore Text', 'kalon' ),
            'section' => 'kalon_slider_settings',
            'type' => 'text',
        )
    );
    /** Slider Settings Ends */
    


	 /** Social Settings */
    $wp_customize->add_section(
        'kalon_social_settings',
        array(
            'title' => __( 'Social Settings', 'kalon' ),
            'description' => __( 'Leave blank if you do not want to show the social link.', 'kalon' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Enable/Disable Social in Header */
    $wp_customize->add_setting(
        'kalon_ed_social',
        array(
            'default' => '',
            'sanitize_callback' => 'kalon_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'kalon_ed_social',
        array(
            'label' => __( 'Enable Social Links', 'kalon' ),
            'section' => 'kalon_social_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Facebook */
    $wp_customize->add_setting(
        'kalon_facebook',
        array(
            'default' => '',
            'sanitize_callback' => 'kalon_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'kalon_facebook',
        array(
            'label' => __( 'Facebook', 'kalon' ),
            'section' => 'kalon_social_settings',
            'type' => 'text',
        )
    );
    
    
    /** Instagram */
    $wp_customize->add_setting(
        'kalon_instagram',
        array(
            'default' => '',
            'sanitize_callback' => 'kalon_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'kalon_instagram',
        array(
            'label' => __( 'Instagram', 'kalon' ),
            'section' => 'kalon_social_settings',
            'type' => 'text',
        )
    );
    
        /** Twitter */
    $wp_customize->add_setting(
        'kalon_twitter',
        array(
            'default' => '',
            'sanitize_callback' => 'kalon_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'kalon_twitter',
        array(
            'label' => __( 'Twitter', 'kalon' ),
            'section' => 'kalon_social_settings',
            'type' => 'text',
        )
    );
    
    /** Pinterest */
    $wp_customize->add_setting(
        'kalon_pinterest',
        array(
            'default' => '',
            'sanitize_callback' => 'kalon_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'kalon_pinterest',
        array(
            'label' => __( 'Pinterest', 'kalon' ),
            'section' => 'kalon_social_settings',
            'type' => 'text',
        )
    );
    
    /** LinkedIn */
    $wp_customize->add_setting(
        'kalon_linkedin',
        array(
            'default' => '',
            'sanitize_callback' => 'kalon_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'kalon_linkedin',
        array(
            'label' => __( 'LinkedIn', 'kalon' ),
            'section' => 'kalon_social_settings',
            'type' => 'text',
        )
    );
    
    /** YouTube */
    $wp_customize->add_setting(
        'kalon_youtube',
        array(
            'default' => '',
            'sanitize_callback' => 'kalon_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'kalon_youtube',
        array(
            'label' => __( 'YouTube', 'kalon' ),
            'section' => 'kalon_social_settings',
            'type' => 'text',
        )
    );
    /** Social Settings Ends */
    
    if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
        /** Custom CSS*/
        $wp_customize->add_section(
            'kalon_custom_settings',
            array(
                'title' => __( 'Custom CSS Settings', 'kalon' ),
                'priority' => 50,
                'capability' => 'edit_theme_options',
            )
        );
        
        $wp_customize->add_setting(
            'kalon_custom_css',
            array(
                'default' => '',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'kalon_sanitize_css'
                )
        );
        
        $wp_customize->add_control(
            'kalon_custom_css',
            array(
                'label' => __( 'Custom Css', 'kalon' ),
                'section' => 'kalon_custom_settings',
                'description' => __( 'Put your custom CSS', 'kalon' ),
                'type' => 'textarea',
            )
        );
        /** Custom CSS Ends */
    }
    /** Footer Section */
    $wp_customize->add_section(
        'kalon_footer_section',
        array(
            'title'    => __( 'Footer Settings', 'kalon' ),
            'priority' => 60,
        )
    );
    
    /** Copyright Text */
    $wp_customize->add_setting(
        'kalon_footer_copyright_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'kalon_footer_copyright_text',
        array(
            'label'   => __( 'Copyright Info', 'kalon' ),
            'section' => 'kalon_footer_section',
            'type'    => 'textarea',
        )
    );
        
    /**
     * Sanitization Functions
     * 
     * @link https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php 
     */ 
    function kalon_sanitize_url( $url ){
        return esc_url_raw( $url );
    }
    
    function kalon_sanitize_checkbox( $checked ){
        // Boolean check.
	   return ( ( isset( $checked ) && true == $checked ) ? true : false );
    }

    function kalon_sanitize_select( $input, $setting ) {
        // Ensure input is a slug.
        $input = sanitize_key( $input );
        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;
        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }
    
    function kalon_sanitize_number_absint( $number, $setting ) {
        // Ensure $number is an absolute integer (whole number, zero or greater).
        $number = absint( $number );
        // If the input is an absolute integer, return it; otherwise, return the default
        return ( $number ? $number : $setting->default );
    }
    
    function kalon_sanitize_css( $css ){
   	    return wp_strip_all_tags( $css );
    }
}
add_action( 'customize_register', 'kalon_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function kalon_customize_preview_js() {
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'kalon_customizer', get_template_directory_uri() . '/js' . $build . '/customizer' . $suffix . '.js', array( 'customize-preview' ), KALON_THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'kalon_customize_preview_js' );

/**
 * Customize Control Scripts
 */
function kalon_customize_scripts() {
    wp_enqueue_style( 'kalon-customize-style',get_template_directory_uri().'/inc/css/customize.css','',KALON_THEME_VERSION );    
    wp_enqueue_script( 'kalon-admin-js', get_template_directory_uri().'/inc/js/admin.js', array( 'jquery' ), '', true );
}
add_action( 'customize_controls_enqueue_scripts', 'kalon_customize_scripts' );