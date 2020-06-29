<?php
/**
 * CNCB Custom Control class.
 *
 * @package Cookie Notice & Consent Banner
 */

if ( ! class_exists( 'CNCB_Custom_Control' ) ) :
	/**
	 * Custom Control Base Class
	 */
	class CNCB_Custom_Control extends WP_Customize_Control {
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			$min = CNCB_Banner_Helper::get_min_prefix();
			wp_enqueue_script( 'cncb-custom-controls-js', CNCB_URI . '/js/customizer' . $min . '.js', array( 'jquery' ), CNCB_VERSION, true );
			wp_enqueue_style( 'cncb-custom-controls-css', CNCB_URI . '/css/customizer' . $min . '.css', array(), CNCB_VERSION, 'all' );
		}
	}
endif;
