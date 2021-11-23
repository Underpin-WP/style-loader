<?php

use Underpin\Abstracts\Underpin;
use Underpin\Factories\Observers\Loader;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add this loader.
Underpin::attach( 'setup', new Loader( 'styles', [ 'class' => 'Underpin\Styles\Loaders\Styles' ] ) );