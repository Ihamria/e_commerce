<?php
/**
 * Palette Radio Button Custom Control
 *
 * @package Cookie Notice & Consent Banner
 */

if ( ! class_exists( 'CNCB_Palette_Radio_Button_Custom_Control' ) ) :
	/**
	 * Palette Radio Button Custom Control
	 */
	class CNCB_Palette_Radio_Button_Custom_Control extends CNCB_Custom_Control {
		/**
		 * The type of control being rendered
		 *
		 * @var $type
		 */
		public $type = 'palette_radio_button';

		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			<div class="controls-group-container">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<div class="controls-group controls-group_col-5">
					<?php foreach ( $this->choices as $key => $value ) { ?>
						<label class="color-choose">
							<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>"  <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>>
							<div class="color-choose__visual">
								<div class="color-choose__left" style="background: <?php echo esc_attr( $value['colors']['left'] ); ?>"></div>
								<div class="color-choose__right" style="background: <?php echo esc_attr( $value['colors']['right'] ); ?>"></div>
							</div>
						</label>
					<?php	} ?>
				</div>
			</div>
			<?php
		}
	}
endif;
