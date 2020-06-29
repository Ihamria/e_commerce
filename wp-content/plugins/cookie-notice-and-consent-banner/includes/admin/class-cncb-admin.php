<?php
/**
 * Init CNCB_Admin class.
 *
 * @file
 *
 * @package Cookie Notice & Consent Banner
 */

if ( ! class_exists( 'CNCB_Admin' ) ) :
	/**
	 * CNCB_Admin Class.
	 *
	 * @since 1.0.0
	 */
	class CNCB_Admin {

		/**
		 * CNCB_Admin
		 *
		 * @var $instance
		 **/
		private static $instance = null;

		/**
		 * Menu position in admin
		 *
		 * @var $menu_pos
		 **/
		public $menu_pos = 78;

		/**
		 * Menu slug in admin. Used as "key" in menus
		 *
		 * @var $menu_slug
		 **/
		public $menu_slug = 'cncb_options';

		/**
		 * Create $instance
		 *
		 * @return object
		 *
		 * @access public
		 */
		public static function init() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new CNCB_Admin();
			}
			return self::$instance;
		}
		/**
		 * Define menu in admin
		 **/
		private function __construct() {
			add_action( 'plugins_loaded', array( $this, 'register_settings' ) );
			add_action( 'admin_menu', array( $this, 'admin_menu_add_external_links_as_submenu' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_settings_scripts' ) );
		}

		/**
		 * Enqueue settings scripts and styles.
		 *
		 * Registers the scripts / styles and enqueues them.
		 *
		 * @since 1.4.0
		 * @access public
		 */
		public function enqueue_settings_scripts() {
			$min = CNCB_Banner_Helper::get_min_prefix();

			wp_enqueue_style( 'cncb-admin-settings-css', CNCB_URI . '/css/admin-settings' . $min . '.css', array(), CNCB_VERSION, 'all' );
			wp_enqueue_script( 'cncb-admin-settings-js', CNCB_URI . '/js/admin-settings' . $min . '.js', array('jquery'), CNCB_VERSION, 'true' );
		}
		/**
		 * Generate customizer panel url
		 *
		 * @return string
		 */
		private function get_customizer_panel_url() {
			return CNCB_Banner_Helper::get_customizer_panel_url();
		}
		/**
		 * Register admin settings
		 *
		 * @return void
		 */
		public function register_settings() {
			add_option( 'cncb_show_banner', 'on' );
			add_option( 'cncb_by_scroll', 'off' );
			add_option( 'cncb_by_click', 'off' );
			add_option( 'cncb_by_delay', 'off' );
			add_option( 'cncb_by_scroll_value', '100', '', 'yes' );
			add_option( 'cncb_by_delay_value', '10000', '', 'yes' );
			add_option( 'cncb_refuse_code' );
			register_setting( 'cncb_options_group', 'cncb_show_banner' );
			register_setting( 'cncb_options_group', 'cncb_by_scroll' );
			register_setting( 'cncb_options_group', 'cncb_by_delay' );
			register_setting( 'cncb_options_group', 'cncb_by_click' );
			register_setting( 'cncb_options_group', 'cncb_refuse_code' );
			register_setting( 'cncb_options_group', 'cncb_by_scroll_value' );
			register_setting( 'cncb_options_group', 'cncb_by_delay_value' );
		}
		/**
		 * Create submenu link
		 *
		 * @return void
		 */
		public function admin_menu_add_external_links_as_submenu() {
			global $submenu;

			add_menu_page(
				esc_html__( 'Cookie Notice & Consent Banner Settings', 'cncb' ),
				esc_html__( 'Cookie Notice & Consent Banner', 'cncb' ),
				'read',
				$this->menu_slug,
				array( $this, 'options_page' ),
				'dashicons-shield',
				$this->menu_pos
			);

			add_submenu_page( 'cncb_options', '', '', 'manage_options', 'cncb_manage_options' );
            // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
			$submenu[ $this->menu_slug ][0][0] = esc_html__( 'Settings', 'cncb' );
            // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
			$submenu[ $this->menu_slug ][1] = array( esc_html__( 'Customize Design', 'cncb' ), 'manage_options', $this->get_customizer_panel_url() );
		}

		/**
		 * Render admin option page
		 *
		 * @return void
		 */
		public function options_page() {
			?>
			<div class="wrap">
				<h1><?php esc_html_e( 'Cookie Notice & Consent Banner', 'cncb' ); ?></h1>
				<form method="post" action="options.php">
					<?php settings_fields( 'cncb_options_group' ); ?>
					<table class="form-table cncb-form-table">
						<tbody>
                            <tr>
                                <th>
                                    <label for="cncb_show_banner"><?php esc_html_e( 'Show banner?', 'cncb' ); ?></label>
                                </th>
                                <td>
                                    <input name="cncb_show_banner" id="cncb_show_banner" type="checkbox" class="regular-text code"  <?php echo ( get_option( 'cncb_show_banner', 'on' ) === 'on' ) ? 'checked' : ''; ?>>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <?php esc_html_e( 'Customize banner', 'cncb' ); ?>
                                </th>
                                <td>
                                    <a href="<?php echo esc_url( $this->get_customizer_panel_url() ); ?>" id="cncb_go_customizer" class="button"><?php esc_html_e( 'Customize Design', 'cncb' ); ?></a>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <label for="cncb_refuse_code"><?php esc_html_e( 'Script blocking', 'cncb' ); ?></label>
                                </th>
                                <td>
                                    <textarea name="cncb_refuse_code" id="cncb_refuse_code" class="large-text" cols="50" rows="10"><?php echo html_entity_decode( trim( get_option( 'cncb_refuse_code' ) ) ); ?></textarea>
                                    <p class="description"><?php esc_html_e( 'Enter non functional cookies Javascript code here (for e.g. Google Analitycs) to be used after the consent is given.', 'cncb' ); ?></p>
                                </td>
                            </tr>
						</tbody>
					</table>
                    <div class="cncb-settings-section">
                        <h2><?php esc_html_e('Auto Accept and Hide', 'cncb'); ?></h2>
                        <p><?php esc_html_e( 'Under GDPR explicit consent for the cookies is required. Use this options with discretion especially if you serve EU countries', 'cncb' ); ?></p>
                    </div>
                     <table  class="form-table cncb-form-table">
                         <tbody>
                             <tr>
                                 <th>
                                     <?php esc_html_e( 'On scroll', 'cncb' ); ?>
                                 </th>
                                 <td>
                                     <fieldset>
                                         <input name="cncb_by_scroll" id="cncb_by_scroll" type="checkbox" class="regular-text code cncb_parent_field"  <?php echo ( get_option( 'cncb_by_scroll', 'on' ) === 'on' ) ? 'checked' : ''; ?>>
                                         <label for="cncb_by_scroll">
                                            <?php esc_html_e('Auto accept and hide banner after scroll.', 'cncb'); ?>
                                         </label>
                                         <div class="cncb_sub_field_wrapper <?php echo ( get_option( 'cncb_by_scroll', 'on' ) === 'on' ) ? 'cncb-show' : ''; ?>">
                                             <input type="text" name="cncb_by_scroll_value" id="cncb_by_scroll_value" value="<?php echo esc_attr(get_option( 'cncb_by_scroll_value' )); ?>">
                                             <p class="description">
		                                         <?php esc_html_e('Number of pixels user has to scroll to accept the notice and make it disappear', 'cncb'); ?>
                                             </p>
                                         </div>
                                     </fieldset>
                                 </td>
                             </tr>
                            <tr>
                                <th>
                                    <?php esc_html_e( 'After Delay', 'cncb' ); ?>
                                </th>
                                <td>
                                    <fieldset>
                                        <input name="cncb_by_delay" id="cncb_by_delay" type="checkbox" class="regular-text code cncb_parent_field"  <?php echo ( get_option( 'cncb_by_delay' ) === 'on' ) ? 'checked' : ''; ?>>
                                        <label for="cncb_by_delay">
                                            <?php esc_html_e('Auto accept and hide banner when time passed', 'cncb'); ?>
                                        </label>
                                        <div class="cncb_sub_field_wrapper <?php echo ( get_option( 'cncb_by_delay') === 'on' ) ? 'cncb-show' : ''; ?>">
                                            <input type="text" name="cncb_by_delay_value" id="cncb_by_delay_value" value="<?php echo esc_attr(get_option( 'cncb_by_delay_value' )); ?>">
                                            <p class="description">
                                                <?php esc_html_e('Milliseconds until hidden', 'cncb'); ?>
                                            </p>
                                        </div>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <?php esc_html_e( 'On Click', 'cncb' ); ?>
                                </th>
                                <td>
                                    <fieldset>
                                        <label>
                                            <input name="cncb_by_click" id="cncb_by_click" type="checkbox" class="regular-text code"  <?php echo ( get_option( 'cncb_by_click' ) === 'on' ) ? 'checked' : ''; ?>>
                                            <?php esc_html_e('Auto accept and hide banner when user clicks anywhere on the page', 'cncb'); ?>
                                        </label>
                                    </fieldset>
                                </td>
                            </tr>
                         </tbody>
                     </table>
					<?php submit_button(); ?>
				</form>
			</div>
			<?php
		}
	}
	CNCB_Admin::init();
endif;
