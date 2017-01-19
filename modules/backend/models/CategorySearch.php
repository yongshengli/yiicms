<?php

namespace app\modules\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Category;
use yii\helpers\ArrayHelper;

/**
 * CategorySearch represents the model behind the search form about `app\models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['id', 'pid', 'type', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    /**
     * 获取取全部 分类
     * @param array $params
     * @param return array
     * @return array
     */
    public function listData($params)
    {
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return [];
        }
        $query = Category::find();

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'pid' => $this->pid,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->orderBy('pid asc, id asc');
        // add conditions that should always apply here
        return $query->asArray()->all();
    }
    /**
     * 取树形结构结果
     * @param $params
     * @return array
     */
    public function tree($params)
    {
        $data = $this->listData($params);
        $map = [];
        $tree = [];
        foreach($data as $key=>$item){
            $map[$item['id']] = isset($map[$item['id']])?array_merge($item,$map[$item['id']]):$item;
            if($item['pid']==0){
                $tree[$item['id']] = &$map[$item['id']];
            }else{
                if(!isset($map[$item['pid']])){
                    $map[$item['pid']] = [];
                }
                if(!isset($map[$item['pid']]['children'])){
                    $map[$item['pid']]['children'] = [];
                }
                $map[$item['pid']]['children'][$item['id']] = &$map[$item['id']];
            }
        }
        return $tree;
    }
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return new ActiveDataProvider();
        }
        $query = Category::find();

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'pid' => $this->pid,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        // add conditions that should always apply here
        return new ActiveDataProvider([
            'query' =>$query
        ]);
    }
}
