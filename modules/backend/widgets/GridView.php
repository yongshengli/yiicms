<?php
namespace app\modules\backend\widgets;

use kartik\form\ActiveForm;
use yii\bootstrap\Html;
use yii\grid\GridView as YiiGridView;
use yii\helpers\Url;
use Yii;

/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/1/5
 * Time: 10:56
 * Email:liyongsheng@meicai.cn
 */
class GridView extends YiiGridView
{
    /**
     * @var string the layout that determines how different sections of the list view should be organized.
     * The following tokens will be replaced with the corresponding section contents:
     *
     * - `{summary}`: the summary section. See [[renderSummary()]].
     * - `{errors}`: the filter model error summary. See [[renderErrors()]].
     * - `{items}`: the list items. See [[renderItems()]].
     * - `{sorter}`: the sorter. See [[renderSorter()]].
     * - `{pager}`: the pager. See [[renderPager()]].
     */
    public $layout = "<div style='height: 30px'><div class='pull-left'>{operation}</div><div class='pull-right'>{summary}</div></div>\n{items}\n{pager}";
    /**
     * Renders a section of the specified name.
     * If the named section is not supported, false will be returned.
     * @param string $name the section name, e.g., `{summary}`, `{items}`.
     * @return string|boolean the rendering result of the section, or false if the named section is not supported.
     */
    public function renderSection($name)
    {
        switch ($name) {
            case '{operation}':
                return $this->renderOperation();
            default:
                return parent::renderSection($name);
        }
    }

    public function renderOperation()
    {
        $buttonList = [
            Html::tag('button', '审核',[
                'class'=>'btn btn-xs btn-success',
                'onclick'=>'this.form.action=\''.Url::to(['check']).'\';this.form.submit();this.disabled=true;'
            ]),
            Html::tag('button', '取消审核',[
                'class'=>'btn btn-xs btn-warning',
                'onclick'=>'this.form.action=\''.Url::to(['unCheck']).'\';this.form.submit();this.disabled=true;'
            ]),
            Html::tag('button', '删除',[
                'class'=>'btn btn-xs btn-danger',
                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                'onclick'=>'this.form.action=\''.Url::to(['deleteAll']).'\';this.form.submit();this.disabled=true;'
            ]),
        ];
        return Html::tag('div', implode('', $buttonList), [
            'class'=>'btn-group'
        ]);
    }
    public function run()
    {
        ob_start();
        ob_implicit_flush(false);
        ActiveForm::begin();
        parent::run();
        ActiveForm::end();
        return ob_get_clean();
    }
}