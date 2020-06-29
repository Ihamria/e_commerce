<?php
/**
 * Helper class that provides easy access to useful plugin functions.
 *
 * Class CNCB_Banner_Helper
 *
 * @package Cookie Notice & Consent Banner
 */
class CNCB_Banner_Helper {
	/**
	 * Parse string margin value '0px 0px 0px 0px' and return array.
	 *
	 * array( 0px, 0px, 0px, 0px )
	 *
	 * @access public
	 * @since 1.3.1
	 * @param string $margin_value The css margin value.
	 * @return array
	 */
	public static function calculate_margin_values($margin_value) {
		return explode(" ", $margin_value);
	}

	public static function filterNotSomething(&$array, $val) {
		foreach($array as $k => $v) {
			if($v === $val) {
				unset($array[$k]);
			}
			elseif(is_array($v)) {
				self::filterNotSomething($array[$k], $val);
			}
		}
		return $array;
	}

	/**
	 * Get customizer options array for global javascript object.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return array
	 */
	public static function get_options_data_array() {
		$options = array(
			'theme'             => get_theme_mod( 'cncb_theme', 'CodGrayWhite' ),
			'type'              => get_theme_mod( 'cncb_type', 'confirm' ),
			'bannerBlockType'   => get_theme_mod( 'cncb_widget_type', 'line' ),
			'position'          => get_theme_mod( 'cncb_position', 'bottom' ),
			'corner'            => get_theme_mod( 'cncb_corner' ) ? 'round' : 'rectangle',
			'buttonType'        => get_theme_mod( 'cncb_buttons_type', 'rectangle' ),
			'blind'             => array(
				'visible' => get_theme_mod( 'cncb_blind_screen', 0 ),
			),
			'message'           => array(
				'html'   => get_theme_mod( 'cncb_text', esc_html__( 'This website uses cookies to improve your browsing experience.', 'cncb' ) ),
				'styles' => array(
					'color'       => (get_theme_mod( 'cncb_text_color' )) ? get_theme_mod( 'cncb_text_color' ) : 'is_filtered',
					'font-family' => (get_theme_mod( 'cncb_text_font_family' )) ? get_theme_mod( 'cncb_text_color' ) : 'is_filtered',
				),
			),
			'link'              => array(
				'html'        => get_theme_mod( 'cncb_widget_link_text', esc_html__( 'Learn More', 'cncb' ) ),
				'href'        => get_theme_mod( 'cncb_widget_link_href', esc_attr__( 'https://gdprinfo.eu/' ) ),
				'styles'      => array(
					'color'       => get_theme_mod( 'cncb_link_color' ) ? get_theme_mod( 'cncb_link_color' ) : 'is_filtered',
					'font-family' => get_theme_mod( 'cncb_text_font_family' ) ? get_theme_mod( 'cncb_text_font_family' ) : 'is_filtered',
					'display'     => get_theme_mod( 'cncb_widget_link_show', 1 ) ? 'inline' : 'none',
				),
				'stylesHover' => array(
					'color' => get_theme_mod( 'cncb_link_hover_color' ) ? get_theme_mod( 'cncb_link_hover_color' ) : 'is_filtered',
				),
			),
			'buttonDirection'   => ( get_theme_mod( 'cncb_vertical_btn', 0 ) && get_theme_mod( 'cncb_widget_type' ) !== 'line' ) ? 'column' : 'row',
			'buttonAllow'       => array(
				'html'        => get_theme_mod( 'cncb_allow_text', esc_html__( 'ALLOW', 'cncb' ) ),
				'styles'      => array(
					'color'         => get_theme_mod( 'cncb_ab_text_color' ) ? get_theme_mod( 'cncb_ab_text_color' ) : 'is_filtered',
					'font-family'   => get_theme_mod( 'cncb_ab_font_family' ) ? get_theme_mod( 'cncb_ab_font_family' ) : 'is_filtered',
					'border-style'  => 'solid',
					'border-radius' => get_theme_mod( 'cncb_ab_border_radius', 0 ) ? get_theme_mod( 'cncb_ab_border_radius' ) . 'px' : 'is_filtered',
					'border-width'  => get_theme_mod( 'cncb_ab_border_width', 0 ) ? get_theme_mod( 'cncb_ab_border_width' ) . 'px' : 'is_filtered',
					'border-color'  => get_theme_mod( 'cncb_ab_border_color' ) ? get_theme_mod( 'cncb_ab_border_color' ) : 'is_filtered',
					'box-shadow'    => get_theme_mod( 'cncb_ab_shadow', 0 ) ? get_theme_mod( 'cncb_ab_shadow' ) : 'is_filtered',
					'background'    => get_theme_mod( 'cncb_ab_gradient', 0 ) ? get_theme_mod( 'cncb_ab_gradient_style' ) : get_theme_mod( 'cncb_ab_bg_color', 'is_filtered' ),
				),
				'stylesHover' => array(
					'color'        => get_theme_mod( 'cncb_ab_hover_text_color' ) ? get_theme_mod( 'cncb_ab_hover_text_color' ) : 'is_filtered',
					'border-style'  => 'solid',
					'border-color' => get_theme_mod( 'cncb_ab_hover_border_color' ) ? get_theme_mod( 'cncb_ab_hover_border_color' ) : 'is_filtered',
					'background'   => get_theme_mod( 'cncb_ab_hover_gradient', 0 ) ? get_theme_mod( 'cncb_ab_hover_gradient_style' ) : get_theme_mod( 'cncb_ab_hover_bg_color', 'is_filtered' ),
				),
			),
			'buttonDismiss'     => array(
				'html'        => get_theme_mod( 'cncb_dismiss_text', esc_html__( 'OK', 'cncb' ) ),
				'styles'      => array(
					'color'         => get_theme_mod( 'cncb_ab_text_color' ) ? get_theme_mod( 'cncb_ab_text_color' ) : 'is_filtered',
					'font-family'   => get_theme_mod( 'cncb_ab_font_family' ) ? get_theme_mod( 'cncb_ab_font_family' ) : 'is_filtered',
					'border-style'  => 'solid',
					'border-radius' => get_theme_mod( 'cncb_ab_border_radius', 0 ) ? get_theme_mod( 'cncb_ab_border_radius' ) . 'px' : 'is_filtered',
					'border-width'  => get_theme_mod( 'cncb_ab_border_width', 0 ) ? get_theme_mod( 'cncb_ab_border_width' ) . 'px' : 'is_filtered',
					'border-color'  => get_theme_mod( 'cncb_ab_border_color' ) ? get_theme_mod( 'cncb_ab_border_color' ) : 'is_filtered',
					'box-shadow'    => get_theme_mod( 'cncb_ab_shadow' ) ? get_theme_mod( 'cncb_ab_shadow_style' ) : 'is_filtered',
					'background'    => get_theme_mod( 'cncb_ab_gradient' ) ? get_theme_mod( 'cncb_ab_gradient_style' ) : get_theme_mod( 'cncb_ab_bg_color', 'is_filtered' ),
				),
				'stylesHover' => array(
					'color'        => get_theme_mod( 'cncb_ab_hover_text_color' ) ? get_theme_mod( 'cncb_ab_hover_text_color' ) : 'is_filtered',
					'border-style'  => 'solid',
					'border-color' => get_theme_mod( 'cncb_ab_hover_border_color' ) ? get_theme_mod( 'cncb_ab_hover_border_color' ) : 'is_filtered',
					'background'   => get_theme_mod( 'cncb_ab_hover_gradient' ) ? get_theme_mod( 'cncb_ab_hover_gradient_style' ) : get_theme_mod( 'cncb_ab_hover_bg_color', 'is_filtered' ),
				),
			),
			'buttonDecline'     => array(
				'html'        => get_theme_mod( 'cncb_decline_text', esc_html__( 'DECLINE', 'cncb' ) ),
				'styles'      => array(
					'color'         => get_theme_mod( 'cncb_db_text_color' ) ? get_theme_mod( 'cncb_db_text_color' ) : 'is_filtered',
					'font-family'   => get_theme_mod( 'cncb_db_font_family' ) ? get_theme_mod( 'cncb_db_font_family' ) : 'is_filtered',
					'border-style'  => 'solid',
					'border-radius' => get_theme_mod( 'cncb_db_border_radius', 0 ) ? get_theme_mod( 'cncb_db_border_radius' ) . 'px' : 'is_filtered',
					'border-width'  => get_theme_mod( 'cncb_db_border_width', 0 ) ? get_theme_mod( 'cncb_db_border_width' ) . 'px' : 'is_filtered',
					'border-color'  => get_theme_mod( 'cncb_db_border_color' ) ? get_theme_mod( 'cncb_db_border_color' ) : 'is_filtered',
					'box-shadow'    => get_theme_mod( 'cncb_db_shadow', 0 ) ? get_theme_mod( 'cncb_db_shadow_style' ) : 'is_filtered',
					'background'    => get_theme_mod( 'cncb_db_gradient', 0 ) ? get_theme_mod( 'cncb_db_gradient_style' ) : get_theme_mod( 'cncb_db_bg_color', 'is_filtered' ),
				),
				'stylesHover' => array(
					'color'        => get_theme_mod( 'cncb_db_hover_text_color' ) ? get_theme_mod( 'cncb_db_hover_text_color' ) : 'is_filtered',
					'border-style'  => 'solid',
					'border-color' => get_theme_mod( 'cncb_db_hover_border_color' ) ? get_theme_mod( 'cncb_db_hover_border_color' ) : 'is_filtered',
					'background'   => get_theme_mod( 'cncb_db_hover_gradient', 0 ) ? get_theme_mod( 'cncb_db_hover_gradient_style' ) : get_theme_mod( 'cncb_db_hover_bg_color', 'is_filtered' ),
				),
			),
			'animationType'     => get_theme_mod( 'cncb_animation', 'no' ),
			'animationDelay'    => get_theme_mod( 'cncb_animation_delay', '0' ) . 'ms',
			'animationDuration' => get_theme_mod( 'cncb_animation_duration', '600' ) . 'ms',
			'popupStyles'       => array(
				'border-style'  => get_theme_mod( 'cncb_show_border', 0 ) ? 'solid' : 'none',
				'border-width'  => get_theme_mod( 'cncb_border_width', 0 ) ? get_theme_mod( 'cncb_border_width' ) . 'px': 'is_filtered',
				'border-radius' => get_theme_mod( 'cncb_border_radius', 0 ) ? get_theme_mod( 'cncb_border_radius' ) . 'px': 'is_filtered',
				'border-color'  => get_theme_mod( 'cncb_border_color' ) ? get_theme_mod( 'cncb_border_color' ) : 'is_filtered',
				'box-shadow'    => get_theme_mod( 'cncb_shadow', 0 ) ? get_theme_mod( 'cncb_shadow_style' ) : 'is_filtered',
				'margin-top' => self::calculate_margin_values(get_theme_mod( 'cncb_banner_margin', 'auto auto auto auto'))[0],
				'margin-right' => self::calculate_margin_values(get_theme_mod( 'cncb_banner_margin', 'auto auto auto auto'))[1],
				'margin-bottom' => self::calculate_margin_values(get_theme_mod( 'cncb_banner_margin', 'auto auto auto auto'))[2],
				'margin-left' =>self::calculate_margin_values(get_theme_mod( 'cncb_banner_margin', 'auto auto auto auto'))[3],
				'width' => 	get_theme_mod( 'cncb_banner_width', 0 ) ? get_theme_mod( 'cncb_banner_width' ) . 'px' : 'is_filtered'
			),
			'accept' => array(
				'byScroll' => (get_option('cncb_by_scroll') === 'on') ? get_option('cncb_by_scroll_value') . 'px' : 'is_filtered',
				'byTime' => (get_option('cncb_by_delay') === 'on') ? get_option('cncb_by_delay_value') : 'is_filtered', // -1
				'byClick' => (get_option('cncb_by_click') === 'on') ? true : 'is_filtered' // false
			)
		);

		$options = self::filterNotSomething($options, 'is_filtered');

		return $options;
	}

	/**
	 * Generate customizer panel url
	 *
	 * @return string
	 */
	public static function get_customizer_panel_url() {
		return get_admin_url() . 'customize.php?autofocus[panel]=cncb_settings';
	}

	/**
	 * Generate min prefix for assets if prod env
	 *
	 * @return string
	 */
	public static function get_min_prefix() {
		return ( WP_DEBUG ? '' : '.min' );
	}
}
