<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/19
 * Time: 21:17
 * Email:liyongsheng@meicai.cn
 */

namespace app\modules\backend\models;


use app\models\Downloads;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class DownloadsSearch extends Downloads
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type','admin_user_id','hits'], 'integer'],
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
     * 创建时间
     * @return array|false|int
     */
    public function getCreatedAt()
    {
        if(empty($this->created_at)){
            return null;
        }
        $createdAt = is_string($this->created_at)?strtotime($this->created_at):$this->created_at;
        if(date('H:i:s', $createdAt)=='00:00:00'){
            return [$createdAt, $createdAt+3600*24];
        }
        return $createdAt;
    }
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param int $pageSize
     * @return ActiveDataProvider
     */
    public function search($params, $pageSize=20)
    {
        $query = Downloads::find();

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
        $createdAt = $this->getCreatedAt();

        if(is_array($createdAt)) {
            $query->andFilterWhere(['>=','created_at', $createdAt[0]])
                ->andFilterWhere(['<=','created_at', $createdAt[1]]);
        }else{
            $query->andFilterWhere(['created_at'=>$createdAt]);
        }

        return $dataProvider;
    }
}