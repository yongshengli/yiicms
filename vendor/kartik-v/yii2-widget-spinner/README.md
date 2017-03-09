yii2-widget-spinner
===================

The Spinner widget is a wrapper for the [spin.js](http://fgnass.github.io/spin.js). It enables you to add an animated CSS3 loading spinner which allows VML fallback for IE.
Since, its not image based, it allows you to configure the spinner style, size, color, and other CSS attributes. The major advantage of using the CSS3 based spinner, is
that the animation can be made visible to user for non-ajax based scenarios. For example on  events like window.load or window.unload (thereby enabling you to show a 
page loading progress without using ajax).

- **Sidebar Menu:** Displays the scrollspy/spinner navigation menu as a sidebar, and/or
- **Main Body:** Displays the main body sections based on the section & subsection headings and content passed.

> **Note:**
> If you have the `header` section fixed to the top, you must add a CSS class `kv-header` to the header container. Similarly, for a fixed footer you must add the class `kv-footer` to your footer container. This will ensure a correct positioning of the spinner widget on the page.

The parameters to pass are:

- `type` The spinner content type. Must be either `menu` or `body`. Defaults to `menu`
- `items`: The spinner content items as an array. Check the [spinner combined usage](http://demos.krajee.com/widget-details/spinner#spinner-menu-body) for a detailed example.

> NOTE: This extension is a sub repo split of [yii2-widgets](https://github.com/kartik-v/yii2-widgets). The split has been done since 08-Nov-2014 to allow developers to install this specific widget in isolation if needed. One can also use the extension the previous way with the whole suite of [yii2-widgets](http://demos.krajee.com/widgets).

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/). Check the [composer.json](https://github.com/kartik-v/yii2-widget-spinner/blob/master/composer.json) for this extension's requirements and dependencies. Read this [web tip /wiki](http://webtips.krajee.com/setting-composer-minimum-stability-application/) on setting the `minimum-stability` settings for your application's composer.json.

To install, either run

```
$ php composer.phar require kartik-v/yii2-widget-spinner "*"
```

or add

```
"kartik-v/yii2-widget-spinner": "*"
```

to the ```require``` section of your `composer.json` file.

## Latest Release

> NOTE: The latest version of the module is v1.0.0 released on 08-Nov-2014. Refer the [CHANGE LOG](https://github.com/kartik-v/yii2-widget-spinner/blob/master/CHANGE.md) for details.

## Demo

You can refer detailed [documentation and demos](http://demos.krajee.com/widget-details/spinner) on usage of the extension.

## Usage

```php
use kartik\spinner\Spinner;
<div class="well">
<?= Spinner::widget([
    'preset' => Spinner::LARGE,
    'color' => 'blue',
    'align' => 'left'
])?>
</div>
```

## License

**yii2-widget-spinner** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.