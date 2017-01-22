<?php
namespace app\modules\backend\widgets;

use yii\widgets\Pjax;
use kartik\form\ActiveForm;
use yii\bootstrap\Html;
use yii\grid\GridView as YiiGridView;
use yii\helpers\Url;
use Yii;
use app\modules\backend\grid\DataColumn;
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/1/5
 * Time: 10:56
 * Email:liyongsheng@meicai.cn
 */
class GridView extends YiiGridView
{
    public $dataColumnClass = DataColumn::Class;
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
    public $layout = "<div style='height: 30px'><div class='pull-left'>{operation}</div><div class='pull-right'>{summary}</div></div>\n{items}\n<div style='height: 30px'><div class='pull-left'>{operation}</div><div class='pull-right'>{summary}</div></div>{pager}\n";
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
        $id = $this->options['id'];
        $buttonList = [
            Html::tag('button', '审核',[
                'class'=>'content-operation btn btn-xs btn-success',
                'data-action'=>Url::to(['check']),
            ]),
            Html::tag('button', '取消审核',[
                'class'=>'content-operation btn btn-xs btn-warning',
                'data-action'=>Url::to(['un-check']),
            ]),
            Html::tag('button', '删除',[
                'class'=>'content-operation btn btn-xs btn-danger',
                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                'data-action'=>Url::to(['delete-all'])
            ]),
        ];
        $view = $this->getView();
        $view->registerJs('$(\'.content-operation\').click(function(){
            var self = this;
            this.disabled =true;
            var url = $(this).data(\'action\');
            var ids = $(\'#'.$id.'\').yiiGridView(\'getSelectedRows\');
            if(!url){
                alert(\'action不能为空\');
            }
            if(!ids){
                alert(\'请选择要处理的记录\');return;
            }
            $.ajax({
                "url":url,
                "type":"post",
                "data":{"ids":ids},
                "dataType":"json"
            }).done(function(res){
                if(res.code==1){
                    alert(res.data);
                }
                alert(\'操作成功\');
                $(\'#'.$id.'\').yiiGridView(\'applyFilter\');
                self.disabled = false;
            });
        });');
        return Html::tag('div', implode('', $buttonList), [
            'class'=>'btn-group'
        ]);
    }
    public function run()
    {
        ob_start();
        ob_implicit_flush(false);
        Pjax::begin();
        parent::run();
        Pjax::end();
        return ob_get_clean();
    }
}