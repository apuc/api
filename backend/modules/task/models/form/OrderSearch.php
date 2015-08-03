<?php

    namespace backend\modules\task\models\form;

    use backend\modules\task\models\db\Order;
    use Yii;
    use yii\base\Model;
    use yii\data\ActiveDataProvider;

    /**
     * OrderSearch represents the model behind the search form about `backend\modules\task\models\db\Order`.
     */
    class OrderSearch extends Order
    {
        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                [['id', 'user_id', 'service_id', 'date', 'status', 'kind', 'members_count', 'cost', 'sex', 'age_min',
                  'age_max', 'friends_count', 'country', 'city', 'minute_1', 'minutes_5', 'hour_1', 'hours_4', 'day_1'],
                 'integer'],
                [['title', 'url', 'tag_list', 'city_text'], 'safe'],
                [['sum'], 'number'],
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
            $query = Order::find()->where(['status' => [Order::DONE, Order::PROCESSED, Order::NOT_MODERATED]]);

            $dataProvider = new ActiveDataProvider([
                'query'      => $query,
                'sort'       => ['defaultOrder' => ['id' => SORT_DESC]],
                'pagination' => ['pageSize' => 20],
            ]);

            $this->load($params);

            if (!$this->validate()) {
                // uncomment the following line if you do not want to return any records when validation fails
                // $query->where('0=1');
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id'            => $this->id,
                'user_id'       => $this->user_id,
                'service_id'    => $this->service_id,
                'date'          => $this->date,
                'status'        => $this->status,
                'kind'          => $this->kind,
                'members_count' => $this->members_count,
                'cost'          => $this->cost,
                'sex'           => $this->sex,
                'age_min'       => $this->age_min,
                'age_max'       => $this->age_max,
                'friends_count' => $this->friends_count,
                'country'       => $this->country,
                'city'          => $this->city,
                'minute_1'      => $this->minute_1,
                'minutes_5'     => $this->minutes_5,
                'hour_1'        => $this->hour_1,
                'hours_4'       => $this->hours_4,
                'day_1'         => $this->day_1,
                'sum'           => $this->sum,
            ]);

            $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'url', $this->url])
                ->andFilterWhere(['like', 'tag_list', $this->tag_list])
                ->andFilterWhere(['like', 'city_text', $this->city_text]);

            return $dataProvider;
        }
    }
