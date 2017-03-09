<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2016
 * @package yii2-widgets
 * @subpackage yii2-widget-depdrop
 * @version 1.0.4
 */

namespace kartik\depdrop;

use Yii;
use Closure;
use yii\base\Action;
use yii\web\Response;

/**
 * Dependent Dropdown action that can be used to generate the dependent option values via ajax response. A typical
 * usage of this action in your controller could look like below:
 *
 * ```php
 *
 *   //inside the controller
 *
 *    public function actions()
 *    {
 *        return \yii\helpers\ArrayHelper::merge(parent::actions(), [
 *            'subcategory' => [
 *                'class' => \kartik\depdrop\DepDropAction::className(),
 *                'outputCallback' => function ($selectedId, $params) {
 *                    return [
 *                        [
 *                            'id' => 1,
 *                            'name' => 'Car',
 *                        ],
 *                        [
 *                            'id' => 2,
 *                            'name' => 'bike',
 *                        ],
 *                    ];
 *
 *                    // with optgroup
 *                    return [
 *                        'group1' => [
 *                            ['id' => '<sub-cat-id-1>', 'name' => '<sub-cat-name1>'],
 *                            ['id' => '<sub-cat_id_2>', 'name' => '<sub-cat-name2>']
 *                        ],
 *                        'group2' => [
 *                            ['id' => '<sub-cat-id-3>', 'name' => '<sub-cat-name3>'],
 *                            ['id' => '<sub-cat-id-4>', 'name' => '<sub-cat-name4>']
 *                        ]
 *                    ];
 *                }
 *            ]
 *        ]);
 *    }
 * ```
 *
 * @see http://plugins.krajee.com/dependent-dropdown
 * @see http://github.com/kartik-v/dependent-dropdown
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0.4
 *
 */
class DepDropAction extends Action
{
    /**
     * @var string parent parameter name for the dependent dropdown
     */
    public $parentParam = 'depdrop_parents';

    /**
     * @var string other parameter name for the dependent dropdown
     */
    public $otherParam = 'depdrop_params';

    /**
     * @var Closure the output callback function
     */
    public $outputCallback;

    /**
     * @var Closure the selected callback function
     */
    public $selectedCallback;

    /**
     * @inheritdoc
     */
    public function run()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->getRequest();
        if (($selected = $request->post($this->parentParam)) && is_array($selected) && !empty($selected[0])) {
            $params = $request->post($this->otherParam, []);
            $id = $selected[0];
            return ['output' => $this->getOutput($id, $params), 'selected' => $this->getSelected($id, $params)];
        }
        return ['output' => '', 'selected' => ''];
    }

    /**
     * Return select option values output
     *
     * @param string $id the selected value identifier
     * @param array  $params the parameters passed
     *
     * @return mixed the option values
     */
    protected function getOutput($id, $params = [])
    {
        return $this->parseCallback('outputCallback', $id, $params);
    }

    /**
     * Return selected value
     *
     * @param string $id the selected value identifier
     * @param array  $params the parameters passed
     *
     * @return string the selected value
     */
    protected function getSelected($id, $params = [])
    {
        return $this->parseCallback('selectedCallback', $id, $params);
    }

    /**
     * Parses the callback function name and if callable, executes it to return value
     *
     * @param string $funcName the function name
     * @param string $id the selected value identifier
     * @param array  $params the parameters passed
     *
     * @return mixed the parsed value
     */
    protected function parseCallback($funcName, $id, $params = [])
    {
        if (!isset($this->$funcName)) {
            return '';
        }
        $func = $this->$funcName;
        if (is_callable($func)) {
            return $func($id, $params);
        }
        return '';
    }
}
