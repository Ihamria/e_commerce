<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}
/**
 * Delete settings from DB.
 */
function cncb_delete_plugin() {
	$options = array(
		'cncb_show_banner',
		'cncb_refuse_code',
		'cncb_by_scroll',
		'cncb_by_click',
		'cncb_by_delay',
		'cncb_by_scroll_value',
		'cncb_by_delay_value'
	);

	$theme_mods_options = array(
		'cncb_theme',
		'cncb_type',
		'cncb_widget_type',
		'cncb_position',
		'cncb_corner',
		'cncb_buttons_type',
		'cncb_blind_screen',
		'cncb_text',
		'cncb_text_color',
		'cncb_text_font_family',
		'cncb_widget_link_text',
		'cncb_widget_link_href',
		'cncb_link_color',
		'cncb_text_font_family',
		'cncb_vertical_btn',
		'cncb_allow_text',
		'cncb_ab_text_color',
		'cncb_ab_font_family',
		'cncb_ab_border_radius',
		'cncb_ab_border_width',
		'cncb_ab_border_color',
		'cncb_ab_shadow',
		'cncb_ab_shadow_style',
		'cncb_ab_gradient',
		'cncb_ab_gradient_style',
		'cncb_ab_bg_color',
		'cncb_ab_hover_text_color',
		'cncb_ab_hover_border_color',
		'cncb_ab_hover_gradient',
		'cncb_ab_hover_gradient_style',
		'cncb_ab_hover_bg_color',
		'cncb_decline_text',
		'cncb_db_text_color',
		'cncb_db_font_family',
		'cncb_db_border_radius',
		'cncb_db_border_width',
		'cncb_db_border_color',
		'cncb_db_shadow',
		'cncb_db_gradient',
		'cncb_db_shadow_style',
		'cncb_db_gradient_style',
		'cncb_db_bg_color',
		'cncb_db_hover_text_color',
		'cncb_db_hover_border_color',
		'cncb_db_hover_gradient',
		'cncb_db_hover_gradient_style',
		'cncb_db_hover_bg_color',
		'cncb_animation',
		'cncb_animation_delay',
		'cncb_animation_duration',
		'cncb_show_border',
		'cncb_border_width',
		'cncb_border_radius',
		'cncb_border_color',
		'cncb_shadow',
		'cncb_shadow_style',
		'cncb_banner_padding',
		'cncb_banner_width',
		'cncb_banner_margin'
	);

	foreach ( $options as $option ) {
		if ( get_option( $option ) ) {
			delete_option( $option );
		}
	}

	foreach ( $theme_mods_options as $option ) {
		remove_theme_mod( $option );
	}

}

cncb_delete_plugin();
