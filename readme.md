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
	'class' => 'Underpin_Styles\Factories\Style_Instance',
	'args'  => [
		[
		    'src'         => 'path/to/style/src',
			'name'        => 'test',
			'destyleion' => 'The destyleion'
		]
	],
] );
```

Alternatively, you can extend `Style` and reference the extended class directly, like so:

```php
underpin()->styles()->add('key','Namespace\To\Class');
```
