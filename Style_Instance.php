<?php
/**
 * Style Factory
 *
 * @since   1.0.0
 * @package Underpin\Abstracts
 */


namespace Underpin_Styles\Factories;


use Underpin_Styles\Abstracts\Style;
use function Underpin\underpin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Style_Instance
 * Handles creating custom admin bar menus
 *
 * @since   1.0.0
 * @package Underpin\Abstracts
 */
class Style_Instance extends Style {

	public function __construct( $args = [] ) {
		// Override default params.
		foreach ( $args as $arg => $value ) {
			if ( isset( $this->$arg ) ) {
				$this->$arg = $value;
				unset( $args[ $arg ] );
			}
		}

		parent::__construct();
	}

}