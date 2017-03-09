yii2-widget-depdrop
===================

[![Latest Stable Version](https://poser.pugx.org/kartik-v/yii2-widget-depdrop/v/stable)](https://packagist.org/packages/kartik-v/yii2-widget-depdrop)
[![License](https://poser.pugx.org/kartik-v/yii2-widget-depdrop/license)](https://packagist.org/packages/kartik-v/yii2-widget-depdrop)
[![Total Downloads](https://poser.pugx.org/kartik-v/yii2-widget-depdrop/downloads)](https://packagist.org/packages/kartik-v/yii2-widget-depdrop)
[![Monthly Downloads](https://poser.pugx.org/kartik-v/yii2-widget-depdrop/d/monthly)](https://packagist.org/packages/kartik-v/yii2-widget-depdrop)
[![Daily Downloads](https://poser.pugx.org/kartik-v/yii2-widget-depdrop/d/daily)](https://packagist.org/packages/kartik-v/yii2-widget-depdrop)

The DepDrop widget is a Yii 2 wrapper for the [dependent-dropdown jQuery plugin by Krajee](http://plugins.krajee.com/dependent-dropdown). This plugin allows multi level dependent dropdown with nested dependencies. The plugin thus enables to convert normal select inputs to a dependent input field, whose options are derived based on value selected in another input/or a group of inputs. It works both with normal select options and select with optgroups as well.

> NOTE: This extension is a sub repo split of [yii2-widgets](https://github.com/kartik-v/yii2-widgets). The split has been done since 08-Nov-2014 to allow developers to install this specific widget in isolation if needed. One can also use the extension the previous way with the whole suite of [yii2-widgets](http://demos.krajee.com/widgets).

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/). Check the [composer.json](https://github.com/kartik-v/yii2-widget-depdrop/blob/master/composer.json) for this extension's requirements and dependencies. Read this [web tip /wiki](http://webtips.krajee.com/setting-composer-minimum-stability-application/) on setting the `minimum-stability` settings for your application's composer.json.

To install, either run

```
$ php composer.phar require kartik-v/yii2-widget-depdrop "@dev"
```

or add

```
"kartik-v/yii2-widget-depdrop": "@dev"
```

to the ```require``` section of your `composer.json` file.

## Latest Release

> NOTE: The latest version of the module is v1.0.4. Refer the [CHANGE LOG](https://github.com/kartik-v/yii2-widget-depdrop/blob/master/CHANGE.md) for details.

## Demo

You can refer detailed [documentation and demos](http://demos.krajee.com/widget-details/depdrop) on usage of the extension.

## Usage

```php
use kartik\depdrop\DepDrop;

// Normal parent select
echo $form->field($model, 'cat')->dropDownList($catList, ['id'=>'cat-id']);

// Dependent Dropdown
echo $form->field($model, 'subcat')->widget(DepDrop::classname(), [
     'options' => ['id'=>'subcat-id'],
     'pluginOptions'=>[
         'depends'=>['cat-id'],
         'placeholder' => 'Select...',
         'url' => Url::to(['/site/subcat'])
     ]
 ]);
```

## License

**yii2-widget-depdrop** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.