<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add this loader.
add_action( 'underpin/before_setup', function ( $file, $class ) {
	require_once( plugin_dir_path( __FILE__ ) . 'lib/abstracts/Style.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'lib/loaders/Styles.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'lib/factories/Style_Instance.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'lib/factories/Enqueue_Admin_Style.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'lib/factories/Enqueue_Style.php' );
	Underpin\underpin()->get( $file, $class )->loaders()->add( 'styles', [
		'registry' => 'Underpin_Styles\Loaders\Styles',
	] );
}, 5, 2 );