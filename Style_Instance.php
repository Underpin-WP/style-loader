<?php
/**
 * Style Factory
 *
 * @since   1.0.0
 * @package Underpin\Abstracts
 */


namespace Underpin_Styles\Factories;


use Underpin\Traits\Instance_Setter;
use Underpin_Styles\Abstracts\Style;

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
	use Instance_Setter;

	public function __construct( $args = [] ) {
		$this->set_values( $args );

		parent::__construct();
	}

}