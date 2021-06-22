<?php


namespace Underpin_Styles\Factories;


use Underpin\Abstracts\Middleware;
use Underpin_Styles\Abstracts\Style;
use function Underpin\underpin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Enqueue_Admin_Style extends Middleware {

	public $description = 'Sets up script params necessary for AJAX and REST requests';
	public $name        = 'REST Middleware';

	function do_actions() {
		if ( $this->loader_item instanceof Style ) {
			add_action( 'admin_enqueue_script', [ $this->loader_item, 'enqueue' ] );
		} else {
			underpin()->logger()->log( 'warning', 'rest_middleware_action_failed_to_run', 'Middleware action failed to run. Rest_Middleware expects to run on a Script loader.', [
				'loader'  => get_class( $this->loader_item ),
				'expects' => 'Underpin_Scripts\Abstracts\Script',
			] );
		}
	}

}