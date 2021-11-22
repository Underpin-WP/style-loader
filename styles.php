<?php

use Underpin\Abstracts\Underpin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add this loader.
Underpin::attach( 'setup', new \Underpin\Factories\Observer( 'styles', [
	'update' => function ( Underpin $plugin, $args ) {
	require_once( plugin_dir_path( __FILE__ ) . 'lib/abstracts/Style.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'lib/loaders/Styles.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'lib/factories/Style_Instance.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'lib/factories/Enqueue_Admin_Style.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'lib/factories/Enqueue_Style.php' );
	$plugin->loaders()->add( 'styles', [
		'registry' => 'Underpin_Styles\Loaders\Styles',
	] );
	},
] ) );