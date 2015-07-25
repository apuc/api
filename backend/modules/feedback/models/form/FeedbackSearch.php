<?php

    namespace backend\modules\feedback\models\form;

    use Yii;
    use yii\base\Model;
    use yii\data\ActiveDataProvider;
    use backend\modules\feedback\models\db\Feedback;

    /**
     * FeedbackSearch represents the model behind the search form about `backend\modules\feedback\models\db\Feedback`.
     */
    class FeedbackSearch extends Feedback
    {
        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                [['id', 'created_at', 'updated_at'], 'integer'],
                [['email', 'name', 'text', 'status'], 'safe'],
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
            $query = Feedback::find();

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
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]);

            $query->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'text', $this->text])
                ->andFilterWhere(['like', 'status', $this->status]);

            return $dataProvider;
        }
    }
