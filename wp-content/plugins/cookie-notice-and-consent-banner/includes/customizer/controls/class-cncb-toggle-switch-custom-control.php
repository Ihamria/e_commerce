<?php
/**
 * CNCB_Toggle_Switch_Custom_Control Class
 *
 * @package Cookie Notice & Consent Banner
 */

if ( ! class_exists( 'CNCB_Toggle_Switch_Custom_Control' ) ) :
	/**
	 * Toggle Switch Custom Control
	 */
	class CNCB_Toggle_Switch_Custom_Control extends CNCB_Custom_Control {
		/**
		 * The type of control being rendered
		 *
		 * @var $type
		 */
		public $type = 'toggle_switch';

		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			<div class="toggle-switch-control">
				<div class="toggle-switch">
					<input type="checkbox" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" class="toggle-switch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>"
														  <?php
															$this->link();
															checked( $this->value() );
															?>
					>
					<label class="toggle-switch-label" for="<?php echo esc_attr( $this->id ); ?>">
						<span class="toggle-switch-inner"></span>
						<span class="toggle-switch-switch"></span>
					</label>
				</div>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
			</div>
			<?php
		}
	}
endif;

if ( ! function_exists( 'cncb_switch_sanitization' ) ) {
	/**
	 * Switch sanitization
	 *
	 * @param  string $input  Switch value
	 * @return integer  Sanitized value
	 */
	function cncb_switch_sanitization( $input ) {
		if ( true === $input ) {
			return 1;
		}
		return 0;
	}
}
