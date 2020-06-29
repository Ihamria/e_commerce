<?php
/**
 * Image Radio Button Custom Control class.
 *
 * @package Cookie Notice & Consent Banner
 */

if ( ! class_exists( 'CNCB_Image_Radio_Button_Custom_Control' ) ) :
	/**
	 * Image Radio Button Custom Control
	 */
	class CNCB_Image_Radio_Button_Custom_Control extends CNCB_Custom_Control {
		/**
		 * The type of control being rendered
		 *
		 * @var $type
		 */
		public $type = 'image_radio_button';

		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			<div class="image_radio_button_control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<div class="image-radio-buttons-container">
					<?php foreach ( $this->choices as $key => $value ) { ?>
						<label class="radio-button-label <?php echo ( ! empty( $value['class'] ) ) ? esc_attr( $value['class'] ) : ''; ?>">
							<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
							<img src="<?php echo esc_attr( $value['image'] ); ?>" alt="<?php echo esc_attr( $value['name'] ); ?>" title="<?php echo esc_attr( $value['name'] ); ?>" data-img-value="<?php echo esc_attr( $key ); ?>" />
						</label>
					<?php	} ?>
				</div>
			</div>
			<?php
		}
	}
endif;
