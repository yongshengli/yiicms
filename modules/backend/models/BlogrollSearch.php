<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/1/12
 * Time: 14:01
 * Email:liyongsheng@meicai.cn
 */

namespace app\modules\backend\models;


use app\models\Blogroll;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class BlogrollSearch extends Blogroll
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id',], 'integer'],
            [['title', 'link', 'created_at'], 'safe'],
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
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Blogroll::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'link', $this->link]);
        $createAt = $this->getCreatedAt();
        if(is_array($createAt)) {
            $query->andFilterWhere(['>=','created_at', $createAt[0]])
                ->andFilterWhere(['<=','created_at', $createAt[1]]);
        }else{
            $query->andFilterWhere(['created_at'=>$createAt]);
        }
        return $dataProvider;
    }
}