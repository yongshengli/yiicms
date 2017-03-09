yii2-widget-rangeinput
======================

[![Latest Stable Version](https://poser.pugx.org/kartik-v/yii2-widget-rangeinput/v/stable)](https://packagist.org/packages/kartik-v/yii2-widget-rangeinput)
[![License](https://poser.pugx.org/kartik-v/yii2-widget-rangeinput/license)](https://packagist.org/packages/kartik-v/yii2-widget-rangeinput)
[![Total Downloads](https://poser.pugx.org/kartik-v/yii2-widget-rangeinput/downloads)](https://packagist.org/packages/kartik-v/yii2-widget-rangeinput)
[![Monthly Downloads](https://poser.pugx.org/kartik-v/yii2-widget-rangeinput/d/monthly)](https://packagist.org/packages/kartik-v/yii2-widget-rangeinput)
[![Daily Downloads](https://poser.pugx.org/kartik-v/yii2-widget-rangeinput/d/daily)](https://packagist.org/packages/kartik-v/yii2-widget-rangeinput)

The RangeInput widget is a customized range slider control widget based on HTML5 range input. The widget enhances the default HTML range input with various features including the following:

* Specially styled for Bootstrap 3.0 with customizable caption showing the output of the control.
* Ability to prepend and append addons (very useful to show the min and max ranges, and the slider measurement unit).
* Allow the input to be changed both via the control or the text box.
* Automatically degrade to normal text input for unsupported Internet Explorer versions.

> NOTE: This extension is a sub repo split of [yii2-widgets](https://github.com/kartik-v/yii2-widgets). The split has been done since 08-Nov-2014 to allow developers to install this specific widget in isolation if needed. One can also use the extension the previous way with the whole suite of [yii2-widgets](http://demos.krajee.com/widgets).

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/). Check the [composer.json](https://github.com/kartik-v/yii2-widget-rangeinput/blob/master/composer.json) for this extension's requirements and dependencies. Read this [web tip /wiki](http://webtips.krajee.com/setting-composer-minimum-stability-application/) on setting the `minimum-stability` settings for your application's composer.json.

To install, either run

```
$ php composer.phar require kartik-v/yii2-widget-rangeinput "*"
```

or add

```
"kartik-v/yii2-widget-rangeinput": "*"
```

to the ```require``` section of your `composer.json` file.

## Latest Release

> NOTE: The latest version of the module is v1.0.1 released on 22-Nov-2015. Refer the [CHANGE LOG](https://github.com/kartik-v/yii2-widget-rangeinput/blob/master/CHANGE.md) for details.

## Demo

You can refer detailed [documentation and demos](http://demos.krajee.com/widget-details/rangeinput) on usage of the extension.

## Usage

```php
use kartik\range\RangeInput;

// Usage with ActiveForm and model
echo $form->field($model, 'rating')->widget(RangeInput::classname(), [
    'options' => ['placeholder' => 'Select range ...'],
    'html5Options' => ['min'=>0, 'max'=>1, 'step'=>1],
    'addon' => ['append'=>['content'=>'star']]
]);

// With model & without ActiveForm
echo '<label class="control-label">Adjust Contrast</label>';
echo RangeInput::widget([
    'model' => $model,
    'attribute' => 'contrast',
    'addon' => ['append'=>['content'=>'%']]
]);
```

## License

**yii2-widget-rangeinput** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.
