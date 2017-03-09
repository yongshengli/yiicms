yii2-widget-affix
=================

Extends [Yii Menu widget](https://github.com/yiisoft/yii2/blob/master/framework/widgets/Menu.php). This widget offers a [scrollspy](http://getbootstrap.com/javascript/#scrollspy) and [affixed](http://getbootstrap.com/javascript/#affix) enhanced navigation (upto 2-levels) to highlight sections and secondary sections in each page. The affix widget can be used to generate both the:

- **Sidebar Menu:** Displays the scrollspy/affix navigation menu as a sidebar, and/or
- **Main Body:** Displays the main body sections based on the section & subsection headings and content passed.

> **Note:**
> If you have the `header` section fixed to the top, you must add a CSS class `kv-header` to the header container. Similarly, for a fixed footer you must add the class `kv-footer` to your footer container. This will ensure a correct positioning of the affix widget on the page.

The parameters to pass are:

- `type` The affix content type. Must be either `menu` or `body`. Defaults to `menu`
- `items`: The affix content items as an array. Check the [affix combined usage](http://demos.krajee.com/widget-details/affix#affix-menu-body) for a detailed example.

> NOTE: This extension is a sub repo split of [yii2-widgets](https://github.com/kartik-v/yii2-widgets). The split has been done since 08-Nov-2014 to allow developers to install this specific widget in isolation if needed. One can also use the extension the previous way with the whole suite of [yii2-widgets](http://demos.krajee.com/widgets).

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/). Check the [composer.json](https://github.com/kartik-v/yii2-widget-affix/blob/master/composer.json) for this extension's requirements and dependencies. Read this [web tip /wiki](http://webtips.krajee.com/setting-composer-minimum-stability-application/) on setting the `minimum-stability` settings for your application's composer.json.

To install, either run

```
$ php composer.phar require kartik-v/yii2-widget-affix "*"
```

or add

```
"kartik-v/yii2-widget-affix": "*"
```

to the ```require``` section of your `composer.json` file.

## Latest Release

> NOTE: The latest version of the module is v1.0.0 released on 08-Nov-2014. Refer the [CHANGE LOG](https://github.com/kartik-v/yii2-widget-affix/blob/master/CHANGE.md) for details.

## Demo

You can refer detailed [documentation and demos](http://demos.krajee.com/widget-details/affix) on usage of the extension.

## Usage

```php
use kartik\affix\Affix;

$content = 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.';
$items = [[
	'url' => '#sec-1',
	'label' => 'Section 1',
	'icon' => 'play-circle',
	'content' => $content,
	'items' => [
		['url' => '#sec-1-1', 'label' => 'Section 1.1', 'content' => $content],
		['url' => '#sec-1-2', 'label' => 'Section 1.2', 'content' => $content],
		['url' => '#sec-1-3', 'label' => 'Section 1.3', 'content' => $content],
		['url' => '#sec-1-4', 'label' => 'Section 1.4', 'content' => $content],
		['url' => '#sec-1-5', 'label' => 'Section 1.5', 'content' => $content],
	],
]];

// Displays sidebar menu
echo Affix::widget([
	'items' => $items, 
	'type' => 'menu'
]);

// Displays body sections
echo Affix::widget([
	'items' => $items, 
	'type' => 'body'
]);
```

## License

**yii2-widget-affix** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.