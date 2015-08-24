<?php

    namespace backend\modules\autopromotion\models\form;

    use backend\modules\task\models\db\Order;
    use common\models\db\Promotion;
    use Yii;
    use yii\base\Model;
    use yii\data\ActiveDataProvider;

    /**
     * OrderSearch represents the model behind the search form about `backend\modules\task\models\db\Order`.
     */
    class PromotionSearch extends Promotion
    {
        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                [['id', 'user_id', 'page_id', 'status'], 'integer'],
                [['url',], 'string'],
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
            $query = Promotion::find()->where(['status' => [Promotion::NOT_MODERATED]]);

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
                'id'      => $this->id,
                'user_id' => $this->user_id,
                'page_id' => $this->page_id,
                'status'  => $this->status,
            ]);

            $query->andFilterWhere(['like', 'url', $this->url]);

            return $dataProvider;
        }
    }
