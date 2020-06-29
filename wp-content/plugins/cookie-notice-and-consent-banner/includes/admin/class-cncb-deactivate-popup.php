<?php
/**
 * Init CNCB_Deactivate_Popup class.
 *
 * @file
 *
 * @package Cookie Notice & Consent Banner
 */

if ( ! class_exists( 'CNCB_Deactivate_Popup' ) ) :
    /**
     * CNCB_Deactivate_Popup Class.
     *
     * @since 1.2.0
     */
    class CNCB_Deactivate_Popup {
	    /**
	     * CNCB_Deactivate_Popup
	     *
	     * @var $instance
	     **/
	    private static $instance = null;

	    /**
	     * Google endpoint which collect data form popup
	     *
	     * @var string
	     **/
        private $google_endpoint = 'https://script.google.com/macros/s/AKfycbwD_D_NxLmxpX4IZj5heSyc6pdmWq3Z2Xfxr0wJHhbCB3AOOdTM/exec';

        /**
	     * Create $instance
	     *
	     * @return object
	     *
	     * @access public
	     */
	    public static function init() {
		    if ( is_null( self::$instance ) ) {
			    self::$instance = new CNCB_Deactivate_Popup();
		    }
		    return self::$instance;
	    }
	    /**
	     * Define menu in admin
	     **/
	    private function __construct() {
		    add_action( 'current_screen', function () {
			    if ( ! $this->is_plugins_screen() ) {
				    return;
			    }

			    add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_feedback_dialog_scripts' ] );
		    } );

		    // Ajax.
		    add_action( 'wp_ajax_cncb_deactivate_feedback', [ $this, 'ajax_cncb_deactivate_feedback' ] );
	    }
	    /**
	     * Enqueue feedback dialog scripts.
	     *
	     * Registers the feedback dialog scripts and enqueues them.
	     *
	     * @since 1.2.0
	     * @access public
	     */
	    public function enqueue_feedback_dialog_scripts() {
		    add_action( 'admin_footer', [ $this, 'print_deactivate_feedback_dialog' ] );

		    $min = CNCB_Banner_Helper::get_min_prefix();

		    wp_enqueue_style( 'cncb-admin-feedback-css', CNCB_URI . '/css/admin' . $min . '.css', array(), CNCB_VERSION, 'all' );

		    wp_register_script(
			    'cncb-admin-feedback',
			    CNCB_URI . '/js/admin-deactivate-popup' . $min . '.js',
			    [
				    'jquery',
			    ],
			    CNCB_VERSION,
			    true
		    );

		    wp_enqueue_script( 'cncb-admin-feedback' );

		    wp_enqueue_script( 'jquery-ui-dialog' );
		    wp_enqueue_style( 'wp-jquery-ui-dialog' );
	    }

	    /**
	     * Print deactivate feedback dialog.
	     *
	     * Display a dialog box to ask the user why he deactivated CNCB.
	     *
	     * Fired by `admin_footer` filter.
	     *
	     * @since 1.2.0
	     * @access public
	     */
	    public function print_deactivate_feedback_dialog() {
		    $deactivate_reasons = [
			    'specific_feature' => [
				    'title' => __( 'I need a specific feature that plugin doesn\'t support', 'cncb' ),
				    'input_placeholder' => __( 'What features are missing?', 'cncb'),
			    ],
			    'found_a_better_plugin' => [
				    'title' => __( 'I found a better plugin', 'cncb' ),
				    'input_placeholder' => __( 'What\'s the plugin\'s name?', 'cncb'),
			    ],
			    'broke_site' => [
				    'title' => __( 'The plugin broke my site', 'cncb' ),
				    'input_placeholder' => '',
			    ],
			    'no_longer_needed' => [
				    'title' => __( 'I no longer need the plugin', 'cncb' ),
				    'input_placeholder' => '',
			    ],
                'short_period' => [
                    'title' => __( 'I only needed the plugin for a short period', 'cncb' ),
                    'input_placeholder' => '',
                ],
			    'couldnt_get_the_plugin_to_work' => [
				    'title' => __( 'The plugin suddenly stopped working', 'cncb' ),
				    'input_placeholder' => '',
			    ],

			    'temporary_deactivation' => [
				    'title' => __( 'It\'s a temporary deactivation', 'cncb' ),
				    'input_placeholder' => '',
			    ],
			    'other' => [
				    'title' => __( 'Other', 'cncb' ),
				    'input_placeholder' => __( 'Kindly tell us the reason so we can improve.', 'cncb' ),
			    ],
		    ];

		    ?>
            <div id="cncb-deactivate-feedback-dialog-wrapper" title="<?php echo __( 'Quick Feedback', 'cncb' ); ?>">
                <form id="cncb-deactivate-feedback-dialog-form" method="post">
				    <?php
					    wp_nonce_field( '_cncb_deactivate_feedback_nonce' );
				    ?>
                    <input type="hidden" name="action" value="cncb_deactivate_feedback" />
                    <div class="cncb-deactivate-feedback-dialog-form-caption">
                        <h3><?php echo __( 'If you have a moment, please let us know why you are deactivating:', 'cncb' ); ?><h3>
                    </div>
                    <div id="cncb-deactivate-feedback-dialog-form-body">
					    <?php foreach ( $deactivate_reasons as $reason_key => $reason ) : ?>
                            <div class="cncb-deactivate-feedback-dialog-input-wrapper">
                                <label for="cncb-deactivate-feedback-<?php echo esc_attr( $reason_key ); ?>" class="cncb-deactivate-feedback-dialog-label">
                                    <input id="cncb-deactivate-feedback-<?php echo esc_attr( $reason_key ); ?>" class="cncb-deactivate-feedback-dialog-input" type="radio" name="reason_key" value="<?php echo esc_attr( $reason_key ); ?>" />
                                    <?php echo esc_html( $reason['title'] ); ?>
	                                <?php if ( ! empty( $reason['input_placeholder'] ) ) : ?>
                                        <textarea class="cncb-feedback-text" type="text" name="reason_<?php echo esc_attr( $reason_key ); ?>" placeholder="<?php echo esc_attr( $reason['input_placeholder'] ); ?>"></textarea>
	                                <?php endif; ?>
                                </label>
                            </div>
					    <?php endforeach; ?>
                    </div>
                </form>
            </div>
		    <?php
	    }

	    /**
	     * @since 1.2.0
	     * @access private
	     */
	    private function is_plugins_screen() {
		    return in_array( get_current_screen()->id, [ 'plugins', 'plugins-network' ] );
	    }

	    /**
	     * Ajax cncb deactivate feedback.
	     *
	     * Send the user feedback when CNCB is deactivated.
	     *
	     * Fired by `wp_ajax_cncb_deactivate_feedback` action.
	     *
	     * @since 1.2.0
	     * @access public
	     */
	    public function ajax_cncb_deactivate_feedback() {
		    if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], '_cncb_deactivate_feedback_nonce' ) ) {
			    wp_send_json_error();
		    }

		    $reason_text = '1';
		    $reason_key = '';

		    if ( ! empty( $_POST['reason_key'] ) ) {
			    $reason_key = $_POST['reason_key'];
		    }

		    if ( ! empty( $_POST[ "reason_{$reason_key}" ] ) ) {
			    $reason_text = $_POST[ "reason_{$reason_key}" ];
		    }

		    wp_remote_get( $this->google_endpoint .'?' . $reason_key . '=' . $reason_text);

		    wp_send_json_success();
	    }

    }
	CNCB_Deactivate_Popup::init();
endif;
