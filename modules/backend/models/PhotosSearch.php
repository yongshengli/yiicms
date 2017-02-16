<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/24
 * Time: 13:58
 * Email:liyongsheng@meicai.cn
 */

namespace app\modules\backend\models;


use app\models\Photos;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class PhotosSearch extends Photos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type','admin_user_id'], 'integer'],
            [['title', 'status','image', 'description', 'created_at'], 'safe'],
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
     * @param int $pageSize
     *
     * @return ActiveDataProvider
     */
    public function search($params, $pageSize=20)
    {
        $query = Photos::find();

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder'=>['id'=>SORT_DESC]],
            'pagination' => ['pageSize'=>$pageSize]
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
            'status' => $this->status,
            'admin_user_id' => $this->admin_user_id,
            'hits' => $this->hits,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);
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