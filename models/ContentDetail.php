<?php

namespace app\models;

use app\components\AppActiveRecord;

/**
 * This is the model class for table "content_detail".
 *
 * @property integer $id
 * @property integer $content_id
 * @property integer $detail
 * @property Content $content
 */
class ContentDetail extends AppActiveRecord
{
    const SCENARIO_DOWNLOADS = 'download';

    const SCENARIO_PRODUCTS = 'product';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content_detail';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_DOWNLOADS] = ['content_id','detail', 'file_url'];
        $scenarios[self::SCENARIO_PRODUCTS] = ['content_id','detail', 'params'];
        return $scenarios;
    }

    /** @var  Content */
    protected $_content;
    /**
     * 获取主表数据
     */
    public function getContent()
    {
        if(empty($this->_content)) {
            $this->_content = $this->content();
        }
        return $this->_content;
    }

    /**
     * need rewrite
     * @return \app\models\Content
     */
    public function content()
    {

    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content_id', 'detail'], 'required'],
            [['content_id', 'detail','file_url'], 'required', 'on'=>self::SCENARIO_DOWNLOADS],
            ['params', 'string', 'max' => 3000],
            [['content_id', 'detail','params'], 'required', 'on'=>self::SCENARIO_PRODUCTS],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content_id'=>'主表ID不能为空',
            'detail' => '内容',
            'file_url' => '文件路径',
            'params' => '参数',
        ];
    }
}
