<?php

namespace backend\modules\service\models\form;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\service\models\db\Service;

/**
 * ServiceSearch represents the model behind the search form about `backend\modules\service\models\db\Service`.
 */
class ServiceSearch extends Service
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'minimum_all_likes', 'minimum_tasks', 'minimum_likes_per_task'], 'integer'],
            [['model_name', 'name'], 'safe'],
            [['price_per_like'], 'number'],
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
        $query = Service::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'minimum_all_likes' => $this->minimum_all_likes,
            'minimum_tasks' => $this->minimum_tasks,
            'minimum_likes_per_task' => $this->minimum_likes_per_task,
            'price_per_like' => $this->price_per_like,
        ]);

        $query->andFilterWhere(['like', 'model_name', $this->model_name])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
