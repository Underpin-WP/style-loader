# Underpin Style Loader

Loader That assists with adding styles to a WordPress website.

## Installation

### Using Composer

`composer require underpin/loaders/styles`

### Manually

This plugin uses a built-in autoloader, so as long as it is required _before_
Underpin, it should work as-expected.

`require_once(__DIR__ . '/underpin-styles/styles.php');`

## Setup

1. Install Underpin. See [Underpin Docs](https://www.github.com/underpin-wp/underpin)
1. Register new styles as-needed.

## Example

A very basic example could look something like this.

```php
underpin()->styles()->add( 'test', [
	'src'         => 'path/to/style/src',
	'name'        => 'test',
	'description' => 'The description',
] );

```

Alternatively, you can extend `Style` and reference the extended class directly, like so:

```php
underpin()->styles()->add('key','Namespace\To\Class');
```

## Enqueuing Styles

To enqueue a styles, run the loader and reference the style ID, like so:

```php
underpin()->style()->enqueue('test'); // Enqueue the test style
```

### Enqueuing With Middleware

In circumstances where you _always_ need to enqueue the style, you can use the provided enqueue middleware.

To enqueue on admin screens:

```php
underpin()->styles()->add( 'test', [
        'handle'      => 'test',
        'src'         => 'path/to/style/src',
        'name'        => 'test',
        'description' => 'The description',
        'middlewares' => [
          'Underpin_Styles\Factories\Enqueue_Admin_Style'
        ]
] );
```

To enqueue on the front-end:

```php
underpin()->styles()->add( 'test', [
        'handle'      => 'test',
        'src'         => 'path/to/style/src',
        'name'        => 'test',
        'description' => 'The description',
        'middlewares' => [
          'Underpin_Styles\Factories\Enqueue_Style'
        ]
] );
```

To enqueue on both front-end and back-end:

```php
underpin()->styles()->add( 'test', [
        'handle'      => 'test',
        'src'         => 'path/to/style/src',
        'name'        => 'test',
        'description' => 'The description',
        'middlewares' => [
          'Underpin_Styles\Factories\Enqueue_Style',
          'Underpin_Styles\Factories\Enqueue_Admin_Style'
        ]
] );
```

### Create Your Own Middleware

The `middlewares` array uses `Underpin::make_class` to create the class instances. This means that you can pass either:

1. a string that references an instance of `Style_Middleware` (see example above).
1. An array of arguments to construct an instance of `Style_Middleware` on-the-fly.

```php
underpin()->styles()->add( 'test', [
	'handle'      => 'test',
	'src'         => 'path/to/style/src',
	'name'        => 'test',
	'description' => 'The description',
	'middlewares' => [
		'Underpin_Styles\Factories\Enqueue_Style',            // Will enqueue the style on the front end all the time.
		[                                                     // Will instantiate an instance of Style_Middleware_Instance using the provided arguments
			'name'                => 'Custom setup params',
			'description'         => 'Sets up custom parameters specific to this style',
			'priority'            => 10, // Optional. Default 10.
			'do_actions_callback' => function ( \Underpin_Styles\Abstracts\Style $loader_item ) {
				// Do actions
			},
		],
	],
] );
```