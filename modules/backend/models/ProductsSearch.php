<?php

namespace app\modules\backend\models;

use app\models\Products;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\News;

/**
 * ContentSearch represents the model behind the search form about `app\models\Content`.
 */
class ProductsSearch extends Products
{
    const PAGE_SIZE = 20;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type','admin_user_id'], 'integer'],
            [['title', 'image', 'description', 'create_at'], 'safe'],
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
     * 创建时间
     * @return array|false|int
     */
    public function getCreateAt()
    {
        if(empty($this->create_at)){
            return null;
        }
        $createAt = is_string($this->create_at)?strtotime($this->create_at):$this->create_at;
        if(date('H:i:s', $createAt)=='00:00:00'){
            return [$createAt, $createAt+3600*24];
        }
        return $createAt;
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
        $query = Products::find();

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize'=>self::PAGE_SIZE]
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
            'type' => Products::TYPE_PRODUCTS,
            'status' => $this->status,
            'admin_user_id' => $this->admin_user_id,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);
        $createAt = $this->getCreateAt();

        if(is_array($createAt)) {
            $query->andFilterWhere(['>=','create_at', $createAt[0]])
                ->andFilterWhere(['<=','create_at', $createAt[1]]);
        }else{
            $query->andFilterWhere(['create_at'=>$createAt]);
        }

        return $dataProvider;
    }
}
