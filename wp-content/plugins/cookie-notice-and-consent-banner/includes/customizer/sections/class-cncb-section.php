<?php
/**
 * Custom section with description
 *
 * @package Cookie Notice & Consent Banner
 */
class CNCB_Section extends WP_Customize_Section {
	/**
	 * The type of control being rendered
	 *
	 * @var $type
	 */
	public $type = 'cncb-section';
	/**
	 * The title
	 *
	 * @var $custom_title
	 */
	public $custom_title = '';
	/**
	 * The description
	 *
	 * @var $custom_description
	 */
	public $custom_description = '';

	/**
	 * Render the section, and the controls that have been added to it.
	 */
	protected function render() {
		$custom_title       = ! empty( $this->custom_title ) ? esc_attr( $this->custom_title ) : false;
		$custom_description = ! empty( $this->custom_description ) ? esc_attr( $this->custom_description ) : false;
		?>
		<li id="accordion-section-<?php echo esc_attr( $this->id ); ?>" class="cncb-section accordion-section control-section control-section-<?php echo esc_attr( $this->id ); ?>">
			<?php if ( $custom_title ) : ?>
				<span class="customize-control-title customize-section-title-menu_locations-heading cncb-section-control-title"><?php echo esc_html( $custom_title ); ?></span>
			<?php endif; ?>
			<?php if ( $custom_description ) : ?>
				<p class="customize-control-description customize-section-title-menu_locations-description"><?php echo esc_html( $custom_description ); ?></p>
			<?php endif; ?>
			<h3 class="accordion-section-title cncb-accordion-section-title">
				<?php echo esc_html( $this->title ); ?>
				<span class="screen-reader-text"><?php esc_html_e( 'Press return or enter to open this section' ); ?></span>
			</h3>
			<ul class="accordion-section-content">
				<li class="customize-section-description-container section-meta
				<?php
				if ( $this->description_hidden ) {
					?>
					 customize-info <?php } ?>">
					<div class="customize-section-title">
						<button class="customize-section-back" tabindex="-1">
							<span class="screen-reader-text"><?php esc_html_e( 'Back' ); ?></span>
						</button>
						<h3>
							<span class="customize-action">
								<?php
								if ( $this->panel ) {
									/* translators: &#9656; is the unicode right-pointing triangle. %s: Section title in the Customizer. */
									echo sprintf( __( 'Customizing &#9656; %s' ), esc_html( $this->manager->get_panel( $this->panel )->title ) );
								} else {
									esc_html_e( 'Customizing' );
								}
								?>
							</span>
							<?php echo esc_html( $this->title ); ?>
						</h3>
						<?php if ( $this->description && $this->description_hidden ) { ?>
							<button type="button" class="customize-help-toggle dashicons dashicons-editor-help" aria-expanded="false"><span class="screen-reader-text"><?php esc_html_e( 'Help' ); ?></span></button>
							<div class="description customize-section-description">
								<?php echo esc_html( $this->description ); ?>
							</div>
						<?php } ?>
						<div class="customize-control-notifications-container"></div>
					</div>
					<?php if ( $this->description && ! $this->description_hidden ) { ?>
						<div class="description customize-section-description">
							<?php echo esc_html( $this->description ); ?>
						</div>
					<?php } ?>
				</li>
			</ul>
		</li>
		<?php
	}
}
