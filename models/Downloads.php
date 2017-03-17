<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/9
 * Time: 10:17
 * Email:liyongsheng@meicai.cn
 */

namespace app\models;

use Yii;
use app\components\behaviors\UploadBehavior;
use yii\db\ActiveRecord;

/**
 * Class Downloads
 * @package app\models
 * @property \yii\web\UploadedFile $file
 * @method uploadFile()
 */
class Downloads extends Content
{
    static $currentType = Parent::TYPE_DOWNLOADS;

    /**
     * @return \app\models\ContentDetail|ActiveRecord
     */
    public function detail()
    {
        if ($this->isNewRecord) {
            return new ContentDetail(['scenario' => ContentDetail::SCENARIO_DOWNLOADS]);
        } else {
            $model = $this->hasOne(ContentDetail::className(), ['content_id' => 'id'])->one();
            $model->scenario = ContentDetail::SCENARIO_DOWNLOADS;
            return $model;
        }
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'type', 'status','category_id'], 'required'],
            [['file'], 'file', 'extensions' => 'zip,rar',],
            [['type', 'status', 'admin_user_id', 'category_id','created_at', 'updated_at'], 'integer'],
            [['title', 'image', 'description', 'keywords'], 'string', 'max' => 255],
        ];
    }

    public function beforeSave($insert)
    {
        $res = parent::beforeSave($insert);
        if($res==false){
            return $res;
        }
        if (!$this->validate()) {
            Yii::info('Model not updated due to validation error.', __METHOD__);
            return false;
        }
        try {
            $file = $this->uploadFile();
        } catch (\Exception $e) {
            $this->addError('file', $e->getMessage());
            return false;
        }
        if($file){
            $this->detail->file_url = $file;
        }
        if(empty($this->detail->file_url)){
            $this->addError('file', '文件不能为空');
            return false;
        }
        return true;
    }
    public function behaviors()
    {
        return [
            [
                'class'=>UploadBehavior::className(),
                'saveDir'=>'downloads/'
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'typeText'=>'类型',
            'category_id'=>'分类',
            'file_url' => '文件路径',
            'file' => '文件',
            'description' => '描述',
            'status' => '状态',
            'statusText' => '状态',
            'hits' => '点击数',
            'created_at'=>'创建时间'
        ];
    }
}