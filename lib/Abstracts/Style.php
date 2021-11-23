<?php
/**
 * Registers Styles to WordPress
 *
 * @since   1.0.0
 * @package Underpin\Abstracts
 */


namespace Underpin\Styles\Abstracts;

use Underpin\Loaders\Logger;
use Underpin\Traits\Feature_Extension;
use Underpin\Traits\With_Middleware;
use WP_Error;


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Style
 * Class Styles
 *
 * @since   1.0.0
 * @package Underpin\Abstracts
 */
abstract class Style {
	use Feature_Extension;
	use With_Middleware;

	/**
	 * The handle for this style.
	 *
	 * @since 1.0.0
	 * @var string the style handle.
	 */
	protected $handle;

	/**
	 * The version.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	protected $ver = false;

	/**
	 * The source url for this style.
	 *
	 * @since 1.0.0
	 * @var bool|string
	 */
	protected $src = false;

	/**
	 * The dependencies for this style.
	 *
	 * @since 1.0.0
	 * @var array
	 */
	protected $deps = [];

	/**
	 * If this style should be displayed in the footer.
	 *
	 * @since 1.0.0
	 * @var bool
	 */
	protected $in_footer = false;


	/**
	 * Params to send to the style when it is enqueued.
	 *
	 * @since 1.0.0
	 *
	 * @var array Array of params.
	 */
	protected $localized_params = [];

	/**
	 * The variable name for the localized object.
	 * Defaults to the handle if not set.
	 *
	 * @since 1.0.0
	 *
	 * @var string The localized object name.
	 */
	protected $localized_var;

	/**
	 * Style constructor.
	 */
	public function __construct() {
		if ( empty( $this->localized_var ) ) {
			$this->localized_var = $this->handle;
		}

		if ( is_string( $this->ver ) && file_exists( $this->ver ) ) {
			$file       = wp_parse_args( require( $this->ver ), [ 'dependencies' => [], 'version' => '' ] );
			$this->ver  = $file['version'];
		} else {
			Logger::log(
				'error',
				'dependencies_file_not_found',
				'A dependency file was specified, but it could not be found.',
				[
					'handle' => $this->handle,
					'file'   => $this->ver,
				]
			);
			$this->ver = false;
		}
	}


	/**
	 * @inheritDoc
	 */
	public function do_actions() {
		add_action( 'init', [ $this, 'register' ] );
	}

	/**
	 * Callback to retrieve the localized parameters for this style.
	 * If this is empty, localize does not fire.
	 *
	 * @since 1.0.0
	 * @return array list of localized params as key => value pairs.
	 */
	public function get_localized_params() {
		return $this->localized_params;
	}

	/**
	 * Returns true if the style has been enqueued. Bypasses doing it wrong check.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function is_enqueued() {
		return (bool) wp_styles()->query( $this->handle, 'enqueued' );
	}


	/**
	 * Retrieves the specified localized param.
	 *
	 * @since 1.0.0
	 *
	 * @param $param
	 * @return mixed|WP_Error
	 */
	public function get_param( $param ) {
		if ( isset( $this->localized_params[ $param ] ) ) {
			return $this->localized_params[ $param ];
		}

		return new \WP_Error( 'param_not_set', 'The localized param ' . $param . ' is not set.' );
	}

	/**
	 * Registers this style.
	 * In-general, this should automatically run based on the contexts provided in the class.
	 *
	 * @since 1.0.0
	 */
	public function register() {
		$registered = wp_register_style( $this->handle, $this->src, $this->deps, $this->ver, $this->in_footer );

		if ( false === $registered ) {
			Logger::log(
				'error',
				'style_was_not_registered',
				'The style ' . $this->handle . ' failed to register. That is all I know, unfortunately.',
				['ref' => $this->handle]
			);
		} else {
			Logger::log(
				'notice',
				'style_was_registered',
				'The style ' . $this->handle . ' registered successfully.',
				['ref' => $this->handle]
			);
		}

	}

	/**
	 * Enqueues the style, and auto-localizes values if necessary.
	 *
	 * @since 1.0.0
	 */
	public function enqueue() {
		wp_enqueue_style( $this->handle );

		// Confirm it was enqueued.
		if ( wp_style_is( $this->handle ) ) {
			Logger::log(
				'notice',
				'style_was_enqueued',
				'The style ' . $this->handle . ' has been enqueued.',
				['ref' => $this->handle]
			);
		} else {
			Logger::log(
				'error',
				'style_failed_to_enqueue',
				'The style ' . $this->handle . ' failed to enqueue.',
				['ref' => $this->handle]
			);
		}

	}
	public function __get( $key ) {
		if ( isset( $this->$key ) ) {
			return $this->$key;
		} else {
			return new WP_Error( 'post_template_param_not_set', 'The batch task key ' . $key . ' could not be found.' );
		}
	}

}