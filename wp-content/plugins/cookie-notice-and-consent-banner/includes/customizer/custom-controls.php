<?php
/**
 * Includes classes.
 *
 * @file
 *
 * @package Cookie Notice & Consent Banner
 */

add_action( 'customize_register', 'cncb_custom_sections_register' );
add_action( 'customize_register', 'cncb_custom_controls_register' );

/**
 * Register custom section types.
 *
 * @return void
 */
function cncb_custom_sections_register() {
	require_once CNCB_PATH . 'includes/customizer/sections/class-cncb-section.php';
}

/**
 * Register custom control types.
 *
 * @return void
 */
function cncb_custom_controls_register() {
	require_once CNCB_PATH . 'includes/customizer/controls/class-cncb-custom-control.php';
	require_once CNCB_PATH . 'includes/customizer/controls/class-cncb-text-custom-control.php';
	require_once CNCB_PATH . 'includes/customizer/controls/class-cncb-space-custom-control.php';
	require_once CNCB_PATH . 'includes/customizer/controls/class-cncb-image-radio-button-custom-control.php';
	require_once CNCB_PATH . 'includes/customizer/controls/class-cncb-palette-radio-button-custom-control.php';
	require_once CNCB_PATH . 'includes/customizer/controls/class-cncb-toggle-switch-custom-control.php';
}
