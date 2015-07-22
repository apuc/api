<?php

    namespace backend\modules\task\models\form;

    use Yii;
    use yii\base\Model;
    use yii\data\ActiveDataProvider;
    use backend\modules\task\models\db\Order;

    /**
     * OrderSearch represents the model behind the search form about `backend\modules\task\models\db\Order`.
     */
    class OrderSearch extends Order
    {
        public function rules()
        {
            return [
                [['id', 'user_id', 'service_id', 'date', 'quantity', 'status'], 'integer'],
                [['task', 'limits'], 'safe'],
                [['task_url'], 'string', 'max' => 255],
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
            $query = Order::find();

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
                'id'         => $this->id,
                'user_id'    => $this->user_id,
                'service_id' => $this->service_id,
                'date'       => $this->date,
                'quantity'   => $this->quantity,
                'status'     => $this->status,
            ]);

            $query->andFilterWhere(['like', 'task', $this->task])
                ->andFilterWhere(['like', 'task_url', $this->task_url])
                ->andFilterWhere(['like', 'limits', $this->limits]);

            return $dataProvider;
        }
    }
