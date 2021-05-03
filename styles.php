<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add this loader.
add_action( 'underpin/before_setup', function ( $class ) {
	if ( 'Underpin\Underpin' === $class ) {
		require_once( plugin_dir_path( __FILE__ ) . 'Style.php' );
		require_once( plugin_dir_path( __FILE__ ) . 'Styles.php' );
		require_once( plugin_dir_path( __FILE__ ) . 'Style_Instance.php' );
		Underpin\underpin()->loaders()->add( 'styles', [
			'registry' => 'Underpin_Styles\Loaders\Styles',
		] );
	}
} );