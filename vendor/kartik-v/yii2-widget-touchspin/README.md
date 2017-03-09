yii2-widget-touchspin
=======================

[![Latest Stable Version](https://poser.pugx.org/kartik-v/yii2-widget-touchspin/v/stable)](https://packagist.org/packages/kartik-v/yii2-widget-touchspin)
[![License](https://poser.pugx.org/kartik-v/yii2-widget-touchspin/license)](https://packagist.org/packages/kartik-v/yii2-widget-touchspin)
[![Total Downloads](https://poser.pugx.org/kartik-v/yii2-widget-touchspin/downloads)](https://packagist.org/packages/kartik-v/yii2-widget-touchspin)
[![Monthly Downloads](https://poser.pugx.org/kartik-v/yii2-widget-touchspin/d/monthly)](https://packagist.org/packages/kartik-v/yii2-widget-touchspin)
[![Daily Downloads](https://poser.pugx.org/kartik-v/yii2-widget-touchspin/d/daily)](https://packagist.org/packages/kartik-v/yii2-widget-touchspin)

The TouchSpin widget is a Yii 2 wrapper for for the [bootstrap-touchspin](http://www.virtuosoft.eu/code/bootstrap-touchspin) plugin by István Ujj-Mészáros, with certain additional enhancements. This input widget is a mobile and touch friendly input spinner component for Bootstrap 3. You can use the widget buttons to rapidly increase and decrease numeric and/or decimal values in your input field. The widget can be setup to include model validation rules for the related model attribute.

> NOTE: This extension is a sub repo split of [yii2-widgets](https://github.com/kartik-v/yii2-widgets). The split has been done since 08-Nov-2014 to allow developers to install this specific widget in isolation if needed. One can also use the extension the previous way with the whole suite of [yii2-widgets](http://demos.krajee.com/widgets).

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/). Check the [composer.json](https://github.com/kartik-v/yii2-widget-touchspin/blob/master/composer.json) for this extension's requirements and dependencies. Read this [web tip /wiki](http://webtips.krajee.com/setting-composer-minimum-stability-application/) on setting the `minimum-stability` settings for your application's composer.json.

To install, either run

```
$ php composer.phar require kartik-v/yii2-widget-touchspin "*"
```

or add

```
"kartik-v/yii2-widget-touchspin": "*"
```

to the ```require``` section of your `composer.json` file.

## Latest Release

> NOTE: The latest version of the module is v1.2.1. Refer the [CHANGE LOG](https://github.com/kartik-v/yii2-widget-touchspin/blob/master/CHANGE.md) for details.

## Demo

You can refer detailed [documentation and demos](http://demos.krajee.com/widget-details/touchspin) on usage of the extension.

## Usage

```php
use kartik\touchspin\TouchSpin;

echo TouchSpin::widget([
    'name' => 'volume',
    'options' => ['placeholder' => 'Adjust...'],
    'pluginOptions' => ['step' => 1]
]);
```

## License

**yii2-widget-touchspin** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.
