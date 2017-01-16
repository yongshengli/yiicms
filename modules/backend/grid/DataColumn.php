<?php
namespace app\modules\backend\grid;

use yii\grid\DataColumn as YiiDataColumn;
use yii\bootstrap\Html;
use yii\base\Model;
use kartik\date\DatePicker;
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/1/16
 * Time: 12:48
 * Email:liyongsheng@meicai.cn
 */
class DataColumn extends YiiDataColumn
{
    public $filterType ='input';
    /**
     * @inheritdoc
     */
    protected function renderFilterCellContent()
    {
        if (is_string($this->filter)) {
            return $this->filter;
        }

        $model = $this->grid->filterModel;

        if ($this->filter !== false && $model instanceof Model && $this->attribute !== null && $model->isAttributeActive($this->attribute)) {
            if ($model->hasErrors($this->attribute)) {
                Html::addCssClass($this->filterOptions, 'has-error');
                $error = ' ' . Html::error($model, $this->attribute, $this->grid->filterErrorOptions);
            } else {
                $error = '';
            }
            if (is_array($this->filter)) {
                $options = array_merge(['prompt' => ''], $this->filterInputOptions);
                return Html::activeDropDownList($model, $this->attribute, $this->filter, $options) . $error;
            } elseif($this->filterType=='date'){
                return DatePicker::widget([
                    'pickerButton'=>false,
                    'type'=>DatePicker::TYPE_COMPONENT_APPEND,
                    'name'=>Html::getInputName($model, $this->attribute),
                    'value'=>Html::getAttributeValue($model, $this->attribute),
                    'options'=>$this->filterInputOptions,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);
            }else{
                return Html::activeTextInput($model, $this->attribute, $this->filterInputOptions) . $error;
            }
        } else {
            return parent::renderFilterCellContent();
        }
    }
}