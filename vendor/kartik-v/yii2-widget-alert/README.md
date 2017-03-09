yii2-widget-alert
=================

This extension contains a couple of useful widgets. The `Alert` widget extends the `\yii\bootstrap\Alert` widget with more easy styling and auto fade out options. In addition, it includes a `AlertBlock` widget that groups multiple `\kartik\widget\Alert` or `kartik\widget\Growl` widgets in one single block and renders them stacked vertically on the current page. 
You can choose the `TYPE_ALERT` style or the `TYPE_GROWL` style for your notifications. You can also set the widget to automatically read and display session flash 
messages (which is the default setting). Alternatively, you can setup and configure your own block of custom alerts.

 > NOTE: This extension is a sub repo split of [yii2-widgets](https://github.com/kartik-v/yii2-widgets). The split has been done since 08-Nov-2014 to allow developers to install this specific widget in isolation if needed. One can also use the extension the previous way with the whole suite of [yii2-widgets](http://demos.krajee.com/widgets).

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/). Check the [composer.json](https://github.com/kartik-v/yii2-widget-alert/blob/master/composer.json) for this extension's requirements and dependencies. Read this [web tip /wiki](http://webtips.krajee.com/setting-composer-minimum-stability-application/) on setting the `minimum-stability` settings for your application's composer.json.

To install, either run

```
$ php composer.phar require kartik-v/yii2-widget-alert "*"
```

or add

```
"kartik-v/yii2-widget-alert": "*"
```

to the ```require``` section of your `composer.json` file.

## Latest Release

> NOTE: The latest version of the module is v1.1.0 released on 19-Nov-2014. Refer the [CHANGE LOG](https://github.com/kartik-v/yii2-widget-alert/blob/master/CHANGE.md) for details.

## Demo

You can refer detailed documentation and demos for [Alert](http://demos.krajee.com/widget-details/alert) and [AlertBlock](http://demos.krajee.com/widget-details/alert-block) widgets on usage of the extension.

## Usage

### Alert
```php
use kartik\alert\Alert;

echo Alert::widget([
	'type' => Alert::TYPE_INFO,
	'title' => 'Note',
	'titleOptions' => ['icon' => 'info-sign'],
	'body' => 'This is an informative alert'
]);
```

### AlertBlock
```php
use kartik\alert\AlertBlock;

echo AlertBlock::widget([
	'type' => AlertBlock::TYPE_ALERT,
	'useSessionFlash' => true
]);
```

## License

**yii2-widget-alert** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.