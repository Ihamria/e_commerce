<?php
/**
 * Space input Custom Control Class
 *
 * @package Cookie Notice & Consent Banner
 */

if ( ! class_exists( 'CNCB_Space_Custom_Control' ) ) :
	/**
	 * Space input Custom Control
	 */
	class CNCB_Space_Custom_Control extends CNCB_Custom_Control {
		/**
		 * The type of control being rendered
		 *
		 * @var $type
		 */
		public $type = 'cncb_space_control';
		/**
		 * The units of control being rendered
		 *
		 * @var $label_units
		 */
		public $label_units = '';

		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			$input_id         = '_customize-input-' . $this->id;
			$description_id   = '_customize-description-' . $this->id;
			$describedby_attr = ( ! empty( $this->description ) ) ? ' aria-describedby="' . esc_attr( $description_id ) . '" ' : '';
			if ( ! empty( $this->label ) ) : ?>
				<label for="<?php echo esc_attr( $input_id ); ?>" class="customize-control-title cncb-customize-control-title"><?php echo esc_html( $this->label ); ?><span class="label-units"><?php echo esc_html( $this->label_units ); ?></span></label>
			<?php endif; ?>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span id="<?php echo esc_attr( $description_id ); ?>" class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>
			<div class="controls-group controls-group_col-4 js-margin-group">
				<input
					id="<?php echo esc_attr( $input_id ); ?>"
					class="js-value"
					type="<?php echo esc_attr( $this->type ); ?>"
					<?php echo $describedby_attr; ?>
					<?php $this->input_attrs(); ?>
					<?php if ( ! isset( $this->input_attrs['value'] ) ) : ?>
						value="<?php echo esc_attr( $this->value() ); ?>"
					<?php endif; ?>
					<?php $this->link(); ?>
				/>
				<label class="choose-num">
					<input type="number" pattern="[0-9.]+" min="0" class="js-top">
					<span class="choose-num__txt"><?php esc_html_e( 'top', 'cncb' ); ?></span>
				</label>
				<label class="choose-num">
					<input type="number" pattern="[0-9.]+" min="0" class="js-right">
					<span class="choose-num__txt"><?php esc_html_e( 'right', 'cncb' ); ?></span>
				</label>
				<label class="choose-num">
					<input type="number" pattern="[0-9.]+" min="0" class="js-bottom">
					<span class="choose-num__txt"><?php esc_html_e( 'bottom', 'cncb' ); ?></span>
				</label>
				<label class="choose-num">
					<input type="number" pattern="[0-9.]+" min="0" class="js-left">
					<span class="choose-num__txt"><?php esc_html_e( 'left', 'cncb' ); ?></span>
				</label>
			</div>
			<?php
		}
	}
endif;
