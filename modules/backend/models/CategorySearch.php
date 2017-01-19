<?php

namespace app\modules\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Category;

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
     * @return array|ArrayDataProvider|\yii\db\ActiveRecord[]
     */
    public function getList($params)
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
    public function getTree($params)
    {
        $data = $this->getList($params);
        $map = [];
        $tree = [];
        foreach($data as $key=>$item){
            if($item['pid']==0){
                $item['level'] = 1;
                $map[$item['id']] = $item;
                $tree[$item['id']] = &$map[$item['id']];
            }else{
                $item['level'] =  &$map[$item['pid']]['level']+1;
                $item['children'] = &$map[$item['id']];
                $map[$item['pid']]['children'][$item['id']] = $item;
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
        $query->orderBy('pid asc, id asc');
        // add conditions that should always apply here
        return new ActiveDataProvider([
            'query' =>$query
        ]);
    }
}
