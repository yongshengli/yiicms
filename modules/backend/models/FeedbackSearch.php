<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/11
 * Time: 13:42
 * Email:liyongsheng@meicai.cn
 */

namespace app\modules\backend\models;

use yii\base\Model;
use app\models\Feedback;
use yii\data\ActiveDataProvider;

class FeedbackSearch extends Feedback
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'phone', 'email', 'subject', 'create_at'], 'safe'],
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
     * @param int $pageSize
     * @return ActiveDataProvider
     */
    public function search($params, $pageSize=20)
    {
        $query = Feedback::find();

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'phone' => $this->phone,
            'email' => $this->email,
        ]);

        $query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'name', $this->name]);
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