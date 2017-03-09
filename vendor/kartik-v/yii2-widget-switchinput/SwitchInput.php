<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2016
 * @package yii2-widgets
 * @subpackage yii2-widget-switchinput
 * @version 1.3.1
 */

namespace kartik\switchinput;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;
use kartik\base\InputWidget;

/**
 * Switch widget is a Yii2 wrapper for the Bootstrap Switch plugin by Mattia, Peter, & Emanuele. This input widget is a
 * jQuery based replacement for checkboxes and radio buttons and converts them to toggle switchinputes.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 * @see http://www.bootstrap-switch.org/
 */
class SwitchInput extends InputWidget
{
    const CHECKBOX = 1;
    const RADIO = 2;

    /**
     * @var int the input type - one of the constants above.
     */
    public $type = self::CHECKBOX;

    /**
     * @var boolean whether to enable third indeterminate behavior when type is `SwitchInput::CHECKBOX`. Defaults to
     *     `false`.
     */
    public $tristate = false;

    /**
     * @var string|int the value for indeterminate state when `tristate` is true and type is `SwitchInput::CHECKBOX`.
     *     Defaults to `null`.
     */
    public $indeterminateValue = null;

    /**
     * @var array | boolean HTML attributes for the toggle indicator to turn indeterminate state on and off. The
     *     following special attributes are recognized:
     * - `label`: string, the indeterminate toggle icon markup. Defaults to `&times;`
     * If this is set to `false` the indeterminate toggle icon will not be shown.
     */
    public $indeterminateToggle = [];

    /**
     * @var array the list of items for radio input (applicable only if `type` = 2). The following keys could be setup:
     * - label: string the label of each radio item. If this is set to `false` or null, the label will not be displayed.
     * - value: string the value of each radio item
     * - options: array, HTML attributes for the radio item
     * - labelOptions: array, HTML attributes for each radio item label
     */
    public $items = [];

    /**
     * @var boolean whether label is aligned on same line. Defaults to `true`. If set to `false`, the label and input
     *     will be on separate lines.
     */
    public $inlineLabel = true;

    /**
     * @var array default HTML attributes for each radio item (applicable only if `type` = 2)
     */
    public $itemOptions = [];

    /**
     * @var array default HTML attributes for each radio item label
     */
    public $labelOptions = [];

    /**
     * @var string the separator content between each radio item (applicable only if `type` = 2)
     */
    public $separator = " &nbsp;";

    /**
     * @var array HTML attributes for the container (applicable only if `type` = 2)
     */
    public $containerOptions = ['class' => 'form-group'];

    /**
     * @inheritdoc
     */
    public $pluginName = 'bootstrapSwitch';

    /**
     * @inheritdoc
     */
    public function run()
    {
        parent::run();
        if (empty($this->type) && $this->type !== self::CHECKBOX && $this->type !== self::RADIO) {
            throw new InvalidConfigException("You must define a valid 'type' which must be either 1 (for checkbox) or 2 (for radio).");
        }
        if ($this->type == self::RADIO) {
            if (empty($this->items) || !is_array($this->items)) {
                throw new InvalidConfigException("You must setup the 'items' array for the 'radio' type.");
            }
        }
        $this->registerAssets();
        echo $this->renderInput();
    }

    /**
     * Renders the source Input for the Switch plugin. Graceful fallback to a normal HTML checkbox or radio input in
     * case JQuery is not supported by the browser
     *
     * @return string
     */
    protected function renderInput()
    {
        if ($this->type == self::CHECKBOX) {
            if (empty($this->options['label'])) {
                $this->options['label'] = null;
            }
            $input = $this->getInput('checkbox');
            $output = ($this->inlineLabel) ? $input : Html::tag('div', $input);
            $output = $this->mergeIndToggle($output);
            return Html::tag('div', $output, $this->containerOptions) . "\n";
        }
        $output = '';
        Html::addCssClass($this->containerOptions, 'kv-switch-container');
        foreach ($this->items as $item) {
            if (!is_array($item)) {
                continue;
            }
            $label = ArrayHelper::getValue($item, 'label', false);
            $options = ArrayHelper::merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
            $labelOptions = ArrayHelper::merge($this->labelOptions, ArrayHelper::getValue($item, 'labelOptions', []));
            $value = ArrayHelper::getValue($item, 'value', null);
            $options['value'] = $value;
            $input = Html::radio($this->name, ($value == $this->value), $options);

            $output .= Html::label($label, $this->name, $labelOptions) . "\n" .
                (($this->inlineLabel) ? $input : Html::tag('div', $input)) . "\n" .
                $this->separator;
        }
        return Html::tag('div', $output, $this->containerOptions) . "\n";
    }

    /**
     * Merges the rendered indeterminate toggle indicator
     *
     * @var string $output the content to merge with the output
     * @return string
     */
    protected function mergeIndToggle($output)
    {
        if (!$this->tristate || $this->indeterminateToggle === false) {
            return $output;
        }
        $icon = ArrayHelper::remove($this->indeterminateToggle, 'label', '&times;');
        $this->indeterminateToggle['data-kv-switch'] = ($this->type == self::CHECKBOX) ? $this->options['id'] : $this->name;
        Html::addCssClass($this->indeterminateToggle, 'close kv-ind-toggle');
        $icon = Html::tag('span', $icon, $this->indeterminateToggle);
        $options = ArrayHelper::remove($this->indeterminateToggle, 'containerOptions', []);
        $size = 'kv-size-' . ArrayHelper::getValue($this->pluginOptions, 'size', 'normal');
        Html::addCssClass($options, 'kv-ind-container ' . $size);
        return Html::tag('div', $icon . "\n" . $output, $options);
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        SwitchInputAsset::register($view);
        if (!isset($this->pluginOptions['animate']) || !is_bool($this->pluginOptions['animate'])) {
            $this->pluginOptions['animate'] = true;
        }
        $ind = $this->indeterminateValue;
        $this->pluginOptions['indeterminate'] = $this->tristate && $this->value === $ind && $this->type !== self::RADIO;
        $this->pluginOptions['disabled'] = $this->disabled;
        $this->pluginOptions['readonly'] = $this->readonly;
        $id = $this->type == self::RADIO ? 'jQuery("[name = \'' . $this->name . '\']")' :
            'jQuery("#' . $this->options['id'] . '")';
        $this->registerPlugin($this->pluginName, $id);
        if (!$this->tristate || $this->indeterminateToggle === false || $this->type == self::RADIO) {
            return;
        }
        $tog = 'jQuery("[data-kv-switch=\'' . $this->options['id'] . '\']")';
        $js = <<< JS
{$tog}.on('click',function(){
    var el={$id}, val;
    el.{$this->pluginName}('toggleIndeterminate');
    val = el.prop('indeterminate') ? '{$ind}' : (el.is(':checked').length > 0 ? 1 : 0);
    el.val(val);
});
JS;
        $view->registerJs($js);
    }
}
