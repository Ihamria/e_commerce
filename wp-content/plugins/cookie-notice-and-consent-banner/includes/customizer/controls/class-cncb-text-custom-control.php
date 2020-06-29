<?php
/**
 * Text input Custom Control Class
 *
 * @package Cookie Notice & Consent Banner
 */

if ( ! class_exists( 'CNCB_Text_Custom_Control' ) ) :
	/**
	 * Text input Custom Control
	 */
	class CNCB_Text_Custom_Control extends CNCB_Custom_Control {
		/**
		 * The type of control being rendered
		 *
		 * @var $type
		 */
		public $type = 'cncb_text_control';

		/**
		 * The units of control being rendered
		 *
		 * @var $units
		 */
		public $units = '';

		/**
		 * The description of control being rendered
		 *
		 * @var $custom_description
		 */

		public $custom_description = '';

		/**
		 * The width of control being rendered
		 *
		 * @var $full_width
		 */
		public $full_width = '';

		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			$input_id         = '_customize-input-' . $this->id;
			$description_id   = '_customize-description-' . $this->id;
			$describedby_attr = ( ! empty( $this->description ) ) ? ' aria-describedby="' . esc_attr( $description_id ) . '" ' : '';
			if ( ! empty( $this->label ) ) : ?>
				<label for="<?php echo esc_attr( $input_id ); ?>" class="customize-control-title cncb-customize-control-title"><?php echo esc_html( $this->label ); ?></label>
			<?php endif; ?>
			<?php if ( ! empty( $this->custom_description ) ) : ?>
				<span id="<?php echo esc_attr( $description_id ); ?>" class="description cncb-customize-control-description"><?php echo esc_html( $this->custom_description ); ?></span>
			<?php endif; ?>
			<input
				id="<?php echo esc_attr( $input_id ); ?>"
				class="cncb-text-control <?php echo $this->full_width ? 'full-width' : ''; ?>"
				type="<?php echo esc_attr( $this->type ); ?>"
				<?php echo ( $this->type === 'number' ) ? 'pattern="[0-9.]+" min="0"' : ''; ?>
				<?php echo $describedby_attr; ?>
				<?php $this->input_attrs(); ?>
				<?php if ( ! isset( $this->input_attrs['value'] ) ) : ?>
					value="<?php echo esc_attr( $this->value() ); ?>"
				<?php endif; ?>
				<?php $this->link(); ?>
			/>
			<?php if ( ! empty( $this->units ) ) : ?>
				<span class="cncb-text-control-units"><?php echo esc_html( $this->units ); ?></span>
				<?php
			endif;
		}
	}
endif;

if ( ! function_exists( 'cncb_text_sanitization' ) ) {
	/**
	 * Text sanitization
	 *
	 * @param  string $input Input to be sanitized (either a string containing a single string or multiple, separated by commas).
	 * @return string Sanitized input
	 */
	function cncb_text_sanitization( $input ) {
		if ( strpos( $input, ',' ) !== false ) {
			$input = explode( ',', $input );
		}
		if ( is_array( $input ) ) {
			foreach ( $input as $key => $value ) {
				$input[ $key ] = sanitize_text_field( $value );
			}
			$input = implode( ',', $input );
		} else {
			$input = sanitize_text_field( $input );
		}
		return $input;
	}
}
